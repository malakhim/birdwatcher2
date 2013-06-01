<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/


if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//
	// Login mode
	//
	if ($mode == 'login') {

		$redirect_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $index_script;

		if (AREA != 'A') {
			if (Registry::get('settings.Image_verification.use_for_login') == 'Y' && fn_image_verification('login_' . $_REQUEST['form_name'], empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
				$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
				return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
			}
		}

		list($status, $user_data, $user_login, $password, $salt) = fn_auth_routines($_REQUEST, $auth);

		if ($status === false) {
			fn_save_post_data();
			$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
			return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
		}
		//
		// Success login
		//
		if (!empty($user_data) && !empty($password) && fn_generate_salted_password($password, $salt) == $user_data['password']) {
			
			// Regenerate session_id for security reasons
			Session::regenerate_id();
			
			//
			// If customer placed orders before login, assign these orders to this account
			//
			if (!empty($auth['order_ids'])) {
				foreach ($auth['order_ids'] as $k => $v) {
					db_query("UPDATE ?:orders SET ?u WHERE order_id = ?i", array('user_id' => $user_data['user_id']), $v);
				}
			}

			fn_login_user($user_data['user_id']);
			
			Helpdesk::auth();
			
			// Set system notifications
			if (Registry::get('config.demo_mode') != true && AREA == 'A' && !defined('DEVELOPMENT')) {

				// If username equals to the password
				if (fn_compare_login_password($user_data, $password)) {
					if (Registry::get('settings.General.use_email_as_login') == 'Y') {
						$msg = fn_get_lang_var('warning_insecure_password_email');
					} else {
						$msg = fn_get_lang_var('warning_insecure_password');
					}
					$msg = str_replace('[link]', fn_url('profiles.update'), $msg);
					fn_set_notification('E', fn_get_lang_var('warning'), $msg, 'S', 'insecure_password');
				}
				if (empty($auth['company_id']) && !empty($auth['user_id'])) {
					// Insecure admin script
					if (Registry::get('config.admin_index') == 'admin.php') {
						fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('warning_insecure_admin_script'), 'S');
					}

					fn_set_hook('set_admin_notification', $auth);
				}
			}

			if (!empty($_REQUEST['remember_me'])) {
				fn_set_session_data(AREA_NAME . '_user_id', $user_data['user_id'], COOKIE_ALIVE_TIME);
				fn_set_session_data(AREA_NAME . '_password', $user_data['password'], COOKIE_ALIVE_TIME);
			}

			// Set last login time
			db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('last_login' => TIME), $user_data['user_id']);

			$_SESSION['auth']['this_login'] = TIME;
			$_SESSION['auth']['ip'] = $_SERVER['REMOTE_ADDR'];

			// Log user successful login
			fn_log_event('users', 'session', array(
				'user_id' => $user_data['user_id']
			));

			if (defined('AJAX_REQUEST') && Registry::get('settings.General.checkout_style') != 'multi_page') {
				$redirect_url = "checkout.checkout";
			} elseif (!empty($_REQUEST['return_url'])) {
				$redirect_url = $_REQUEST['return_url'];
			}

			if (AREA == 'C') {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('successful_login'));
			}

			if (AREA == 'A' && USER_AGENT_MSIE7) {
				$redirect_url = "upgrade_center.ie7notify";
			}

		} else {
		//
		// Login incorrect
		//
			// Log user failed login
			fn_log_event('users', 'failed_login', array (
				'user' => $user_login
			));

			$auth = array();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_incorrect_login'));
			$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
			return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
		}

		unset($_SESSION['edit_step']);
	
		if (!empty($_REQUEST['checkout_login']) && $_REQUEST['checkout_login'] == 'Y') {
			$profiles_num = db_get_field("SELECT COUNT(*) FROM ?:user_profiles WHERE user_id = ?i", $auth['user_id']);
			if ($profiles_num > 1 && Registry::get('settings.General.user_multiple_profiles') == 'Y') {
				$redirect_url = "checkout.customer_info";
			} else {
				$redirect_url = "checkout.checkout";
			}
		}

	}

	//
	// Recover password mode
	//
	if ($mode == 'recover_password') {

		if (!empty($_REQUEST['user_email'])) {

			$condition = '';



			$uid = db_get_field("SELECT user_id FROM ?:users WHERE email = ?s" . $condition, $_REQUEST['user_email']);

			$u_data = fn_get_user_info($uid, false);
			if (!empty($u_data['email'])) {
				$_data = array (
					'object_id' => $u_data['user_id'],
					'object_type' => 'U',
					'ekey' => md5(uniqid(rand())),
					'ttl' => strtotime("+1 day")
				);

				db_query("REPLACE INTO ?:ekeys ?e", $_data);

				$zone = !empty($u_data['user_type']) ? $u_data['user_type'] : 'C';

				$view_mail->assign('ekey', $_data['ekey']);
				$view_mail->assign('zone', $zone);

				$from_email = array(
					'email' => Registry::get('settings.Company.company_users_department'),
					'name' => Registry::get('settings.Company.company_name'),
				);


				fn_send_mail($u_data['email'], $from_email, 'profiles/recover_password_subj.tpl','profiles/recover_password.tpl', '', $u_data['lang_code']);

				fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_password_recovery_instructions_sent'));

			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_login_not_exists'));
				$redirect_url = "auth.recover_password";
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_login_not_exists'));
			$redirect_url = "auth.recover_password";
		}

	}

	return array(CONTROLLER_STATUS_OK, !empty($redirect_url)? $redirect_url : $index_script);
}

//
// Perform user log out
//
if ($mode == 'logout') {

	// Regenerate session_id for security reasons
	Session::regenerate_id();
	
	fn_save_cart_content($_SESSION['cart'], $auth['user_id']);

	$auth = $_SESSION['auth'];

	if (!empty($auth['user_id'])) {
		// Log user logout
		fn_log_event('users', 'session', array(
			'user_id' => $auth['user_id'],
			'time' => TIME - $auth['this_login'],
			'timeout' => false
		));
	}

	unset($_SESSION['auth']);
	fn_clear_cart($_SESSION['cart'], false, true);

	fn_delete_session_data(AREA_NAME . '_user_id', AREA_NAME . '_password');

	unset($_SESSION['product_notifications']);

	return array(CONTROLLER_STATUS_OK, $index_script);
}

//
// Recover password mode
//
if ($mode == 'recover_password') {

	// Cleanup expired keys
	db_query("DELETE FROM ?:ekeys WHERE ttl > 0 AND ttl < ?i", TIME); // FIXME: should be moved to another place

	if (!empty($_REQUEST['ekey'])) {
		$u_id = db_get_field("SELECT object_id FROM ?:ekeys WHERE ekey = ?s AND object_type = 'U' AND ttl > ?i", $_REQUEST['ekey'], TIME);
		if (!empty($u_id)) {
			
			// Delete this key
			db_query("DELETE FROM ?:ekeys WHERE ekey = ?s", $_REQUEST['ekey']);
			
			$user_status = fn_login_user($u_id);

			if ($user_status == LOGIN_STATUS_OK) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_change_password'));
				return array(CONTROLLER_STATUS_OK, "profiles.update&user_id=$u_id");
			} else {
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_login_not_exists'));
				return array(CONTROLLER_STATUS_OK, $index_script);
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_ekey_not_valid'));
			return array(CONTROLLER_STATUS_OK, "auth.recover_password");
		}
	}

	fn_add_breadcrumb(fn_get_lang_var('recover_password'));
}

//
// Display login form in the mainbox
//
if ($mode == 'login_form') {
	if (defined('AJAX_REQUEST') && empty($auth)) {
		exit;
	}

	if (!empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	fn_add_breadcrumb(fn_get_lang_var('my_account'));

} elseif ($mode == 'password_change' && AREA == 'A') {
	if (defined('AJAX_REQUEST') && empty($auth)) {
		exit;
	}

	if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	fn_add_breadcrumb(fn_get_lang_var('my_account'));

	$profile_id = 0;
	$user_data = fn_get_user_info($auth['user_id'], true, $profile_id);
	
	$view->assign('user_data', $user_data);
	$view->assign('view_mode', 'simple');
	
} elseif ($mode == 'change_login') {
	$auth = $_SESSION['auth'];

	if (!empty($auth['user_id'])) {
		// Log user logout
		fn_log_event('users', 'session', array(
			'user_id' => $auth['user_id'],
			'time' => TIME - $auth['this_login'],
			'timeout' => false
		));
	}

	unset($_SESSION['auth'], $_SESSION['cart']['user_data']);

	fn_delete_session_data(AREA_NAME . '_user_id', AREA_NAME . '_password');

	return array(CONTROLLER_STATUS_OK, 'checkout.checkout');
}
?>