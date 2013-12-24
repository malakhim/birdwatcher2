<?php

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($mode == 'update'){

		// Get data and modify it such that it is passable into fn_update_company
		// Do we need to check if user exists? In that case get code from companies.php line 50
		
		$udata = $_REQUEST['user_data'];

		$vdata = array(
			'timestamp' => TIME,
			'status' => 'A',
			'request_user_id' => $_REQUEST['user_id'],
			'company' => $udata['fields'][36] ? $udata['fields'][36] : $udata['b_firstname'] . ' ' . $udata['b_lastname'],
			'company_description' => ' ',
			'lang_code' => 'EN',
			'admin_firstname' => $udata['b_firstname'],
			'admin_lastname' => $udata['b_lastname'],
			'email' => $udata['email'],
			'phone' => isset($udata['b_phone']) ? $udata['b_phone'] : 0,
			'url' => ' ',
			'fax' => ' ',
			'address' => isset($udata['b_address']) ? $udata['b_address'] : ' ',
			'city' => isset($udata['b_city']) ? $udata['b_city'] : ' ',
			'country' => isset($udata['b_country']) ? $udata['b_country'] : 0,
			'state' => isset($udata['b_state']) ? $udata['b_state'] : 0,
			'zipcode' => isset($udata['b_zipcode']) ? $udata['b_zipcode'] : 0
		);

		$account_data = array();
		$account_data['fields'] = isset($_REQUEST['user_data']['fields']) ? $_REQUEST['user_data']['fields'] : '';
		$account_data['admin_firstname'] = isset($_REQUEST['company_data']['admin_firstname']) ? $_REQUEST['company_data']['admin_firstname'] : '';
		$account_data['admin_lastname'] = isset($_REQUEST['company_data']['admin_lastname']) ? $_REQUEST['company_data']['admin_lastname'] : '';
		$vdata['request_account_data'] = serialize($account_data);

		$company_id = fn_update_company($vdata);

		if(!$company_id){
			fn_save_post_data();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_error_adding_request'));
			return array(CONTROLLER_STATUS_REDIRECT, "profiles.add");
		}

		// Log user in as vendor
		
		$_POST['password'] = $udata['password1'];

		$vreg_data = array(
			'return_url' => 'profiles.update',
			'user_login' => $udata['email'],
			'password' => $udata['password1'],
			'dispatch' => 'vendor.php?dispatch=auth.login'
		);

		list($status, $user_data, $user_login, $password, $salt) = fn_auth_routines($vreg_data, $auth);

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

			// Change user type to Vendor and company ID to the one that was just created
			db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('user_type' => 'V', 'company_id' => $company_id), $user_data['user_id']);
		}
	}
}


?>