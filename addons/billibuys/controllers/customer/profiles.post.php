<?php

if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if($mode == 'update'){

		//This part creates the company
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

		define(COMPANY_ID,$company_id);

		if(!$company_id){
			fn_save_post_data();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_error_adding_request'));
			return array(CONTROLLER_STATUS_REDIRECT, "profiles.add");
		}

		// Log user in as vendor (doesn't work!)
		$_POST['password'] = $udata['password1'];

		$vreg_data = array(
			'return_url' => 'profiles.update',
			'user_login' => $udata['email'],
			'password' => $udata['password1'],
		);

		list($status, $user_data, $user_login, $password, $salt) = fn_auth_routines($vreg_data, $auth);

		// Change user type to Vendor and company ID to the one that was just created
		db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('user_type' => 'V', 'company_id' => $company_id), $user_data['user_id']);

		if ($status === false) {
			fn_save_post_data();
			$suffix = (strpos($_SERVER['HTTP_REFERER'], '?') !== false ? '&' : '?') . 'login_type=login' . (!empty($_REQUEST['return_url']) ? '&return_url=' . urlencode($_REQUEST['return_url']) : '');
			return array(CONTROLLER_STATUS_REDIRECT, "$_SERVER[HTTP_REFERER]$suffix");
		}

		// To retrieve the new company status and user type
		list($status, $user_data, $user_login, $password, $salt) = fn_auth_routines($vreg_data, $auth);

		//
		// Success login
		//
		if (!empty($user_data) && !empty($password) && fn_generate_salted_password($password, $salt) == $user_data['password']) {

			// check user data exists
			// $user_data_v = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i $condition", $user_data['user_id']);

			//set area
			$area = 'V';

			if (!empty($user_data)) {
				// build session data
				$sess_data = array(
					'auth' => fn_fill_auth($user_data, array(), false, $area),
					'last_status' => empty($_SESSION['last_status']) ? '' : $_SESSION['last_status'],
				);

				$sess_data['auth']['area'] = 'A';

				// based on $area, set account_type
				$sess_name = str_replace(ACCOUNT_TYPE, 'vendor', SESS_NAME);
				// get session id
				$sess_id = fn_get_cookie($sess_name);

				// Get user session data, modify parts of it to make it into vendor session data and save
				// Oh dear god what have I done
				// IM SORRY THERE WAS NO OTHER WAY
				$sess_data = $_SESSION;
				$sess_data['auth']['area'] = 'V';
				$sess_data['auth']['user_type'] = 'V';
				$sess_data['auth']['company_id'] = db_get_field('SELECT company_id FROM ?:users WHERE user_id = ?i',$user_data['user_id']);



				// echo db_quote('SELECT company_id FROM ?:users WHERE user_id = ?i',$user_data['user_id']);
				// var_dump($sess_id);
				// var_dump($sess_data);
				// $raw = '' ;
				// $line = 0 ;
				// $keys = array_keys($sess_data) ;

				// foreach ($keys as $key) {
				// 	$value = $data[$key] ;
				// 	$line++;

				// 	$raw .= $key . '|' . serialize($value);
				// }

				// $_row = array(
				// 	'session_id' => $sess_id,
				// 	'area' => $area,
				// 	'expiry' => $new_expire,
				// 	'data' => $sess_data					
				// );

				// db_query('REPLACE INTO ?:sessions ?e', $_row);

				// db_query("UPDATE ?:sessions SET data = ?s WHERE session_id = ?s AND area = 'A'",$raw,$sess_id);
				$c_sess_id = session_id();
				var_dump($c_sess_id);
				Session::save($c_sess_id,$_SESSION,'C');
				Session::save($sess_id,$sess_data,'A');
				
				// Session::regenerate_id();
				// fn_login_user($user_data['user_id']);
				// Helpdesk::auth();
				// $new->write(session_id(),$_SESSION);
				// die;
				// var_dump($sess_id);
				// initialise session
				// fn_init_user_session_data($sess_data, $user_data['user_id']);
				// build session id if it doesn't exist
				// if (empty($sess_id)) {
					// change session name and generate new session id
				// $sess_name = str_replace(ACCOUNT_TYPE, 'customer', SESS_NAME);
				// session_name($sess_name);
				// session_regenerate_id();
				// $sess_id = session_id();
				// }
				// $current_session_id = Session::get_id();
				// set session id for session
				// save session_id
				// var_dump(session_id());
				// Session::save($sess_id, $_SESSION, 'C');
				// Session::set_id($current_session_id);

				// var_dump($user_data);
				// var_dump($sess_data);
				// var_dump($sess_id);die;

			// Regenerate session_id for security reasons
			// Session::regenerate_id();
			// fn_login_user($user_data['user_id']);
			// Helpdesk::auth();
			
			// Set system notifications
			// if (Registry::get('config.demo_mode') != true && AREA == 'A' && !defined('DEVELOPMENT')) {

			// 	// If username equals to the password
			// 	if (fn_compare_login_password($user_data, $password)) {
			// 		if (Registry::get('settings.General.use_email_as_login') == 'Y') {
			// 			$msg = fn_get_lang_var('warning_insecure_password_email');
			// 		} else {
			// 			$msg = fn_get_lang_var('warning_insecure_password');
			// 		}
			// 		$msg = str_replace('[link]', fn_url('profiles.update'), $msg);
			// 		fn_set_notification('E', fn_get_lang_var('warning'), $msg, 'S', 'insecure_password');
			// 	}
			// 	if (empty($auth['company_id']) && !empty($auth['user_id'])) {
			// 		// Insecure admin script
			// 		if (Registry::get('config.admin_index') == 'admin.php') {
			// 			fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('warning_insecure_admin_script'), 'S');
			// 		}

			// 		fn_set_hook('set_admin_notification', $auth);
			// 	}	
			// }

			// if (!empty($_REQUEST['remember_me'])) {
			// 	fn_set_session_data(AREA_NAME . '_user_id', $user_data['user_id'], COOKIE_ALIVE_TIME);
			// 	fn_set_session_data(AREA_NAME . '_password', $user_data['password'], COOKIE_ALIVE_TIME);
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

			return array(CONTROLLER_STATUS_OK, "billibuys.view");
		}
	}
}


?>