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

	if (AREA == 'A') {
		$_auth = NULL;
	} else {
		$_auth = &$auth;
	}

	//
	// Create/Update user
	//
	if ($mode == 'update') {
		$user_id = $auth['user_id'];

		if (AREA == 'A') {
			if ((isset($_REQUEST['user_data']['password_change']) && $_REQUEST['user_data']['password_change'] === true) || !isset($_REQUEST['user_data']['password_change'])) {
				$user_id = !empty($_REQUEST['user_id']) ? $_REQUEST['user_id'] : 0;
			}

			if ((PRODUCT_TYPE == "ULTIMATE" || PRODUCT_TYPE == "MULTIVENDOR") && $user_id == $auth['user_id'] && defined('RESTRICTED_ADMIN')) {
				$_REQUEST['user_type'] = '';
				$_REQUEST['user_data']['user_type'] = $auth['user_type'];
			}
		}

		$params = $_REQUEST;
		$params['user_id'] = $user_id;
		fn_trusted_vars('user_data');
		$params['user_data']['password1'] = $_REQUEST['user_data']['password1'];
		$params['user_data']['password2'] = $_REQUEST['user_data']['password2'];
		$_REQUEST = $params;

		if ((PRODUCT_TYPE == "ULTIMATE" || PRODUCT_TYPE == "MULTIVENDOR") && defined("COMPANY_ID") && $user_id != $auth['user_id']) {
			$_REQUEST['user_data']['user_type'] = !empty($_REQUEST['user_type']) ? $_REQUEST['user_type'] : 'C';
		}

		if (fn_is_restricted_admin($params) == true || (empty($_REQUEST['user_id'])) && AREA == 'A' && isset($_REQUEST['user_data']['password_change']) && $_REQUEST['user_data']['password_change'] != true) {
			return array(CONTROLLER_STATUS_DENIED);
		}
		
		$suffix = '';

		if (isset($_REQUEST['copy_address']) && empty($_REQUEST['copy_address'])) {
			$_REQUEST['ship_to_another'] = 'Y';
		}

		if (AREA == 'A' && !empty($_REQUEST['user_id'])) {
			$suffix .= 'user_id=' . $_REQUEST['user_id'] . '&';
		}

		if (AREA == 'A' && !empty($_REQUEST['user_type'])) {
			$suffix .= 'user_type=' . $_REQUEST['user_type'] . '&';
		}

		if (!empty($_REQUEST['return_url'])) {
			$suffix .= 'return_url=' . urlencode($_REQUEST['return_url']) . '&';
		}

		if ($res = fn_update_user($user_id, $_REQUEST['user_data'], $_auth, !empty($_REQUEST['ship_to_another']), (AREA == 'A' ? !empty($_REQUEST['notify_customer']) : true))) {
			list($user_id, $profile_id) = $res;

			
			if (!empty($_REQUEST['user_data']['user_type'])) {
				$usergroup_links = db_get_fields("SELECT ul.link_id FROM ?:usergroups AS u JOIN ?:usergroup_links AS ul ON u.usergroup_id = ul.usergroup_id WHERE ul.user_id = ?i AND ul.status = 'A' AND u.type = ?s", $user_id, in_array($_REQUEST['user_data']['user_type'], array('A', 'V')) ? 'C' : 'A');

				if (!empty($usergroup_links)) {
					$result = db_query("DELETE FROM ?:usergroup_links WHERE link_id IN (?a)", $usergroup_links);
				}
			}
			

			unset($_SESSION['saved_post_data']['user_data']);
			
			if ($user_id != $auth['user_id']) {
				$suffix .= "user_id=$user_id&";
			}
			if (Registry::get('settings.General.user_multiple_profiles') == 'Y') {
				$suffix .= "profile_id=$profile_id&";
			}

			if (AREA != 'A') {
				// Cleanup user info stored in cart
				if (!empty($_SESSION['cart']) && !empty($_SESSION['cart']['user_data'])) {
					unset($_SESSION['cart']['user_data']);
				}

				// Delete anonymous authentication
				if ($cu_id = fn_get_session_data('cu_id') && !empty($_auth['user_id'])) {
					fn_delete_session_data('cu_id');
				}
				
				Session::regenerate_id();
			}

			if (!empty($_REQUEST['return_url'])) {
				return array(CONTROLLER_STATUS_OK, $_REQUEST['return_url']);			
			}			

		} else {
			fn_delete_notification('changes_saved');
		}

		if (isset($_REQUEST['return_to_list']) && $_REQUEST['return_to_list'] == 'Y' && !fn_check_permissions('profiles', 'manage', 'admin')) {
			$_REQUEST['redirect_url'] = 'index.index';
		}

		$redirect_mode = !empty($user_id) ? "update" : "add";

		return array(CONTROLLER_STATUS_OK, "profiles." . $redirect_mode . "?" . $suffix);
	}
}

if ($mode == 'add' || $mode == 'update') {

	if ((PRODUCT_TYPE == "ULTIMATE" || PRODUCT_TYPE == "MULTIVENDOR") && !empty($_REQUEST['user_id']) && !empty($_REQUEST['user_type'])) {
		if ($_REQUEST['user_id'] == $auth['user_id'] && defined('RESTRICTED_ADMIN') && !in_array($_REQUEST['user_type'], array('A', ''))) {
			return array(CONTROLLER_STATUS_REDIRECT, "profiles.update?user_id=" . $_REQUEST['user_id']);
		}
	}

	if (AREA == 'A' && fn_is_restricted_admin($_REQUEST) == true) {
		return array(CONTROLLER_STATUS_DENIED);
	}
	
	$uid = 0;
	$user_data = array();
	$profile_id = empty($_REQUEST['profile_id']) ? 0 : $_REQUEST['profile_id'];
	if (AREA == 'A') {
		$_uid = !empty($profile_id) ? db_get_field("SELECT user_id FROM ?:user_profiles WHERE profile_id = ?i", $profile_id) : $auth['user_id'];
		$uid = empty($_REQUEST['user_id']) ? (($mode == 'add') ? '' : $_uid) : $_REQUEST['user_id'];
	} elseif ($mode == 'update' || $mode == 'add') {
		fn_add_breadcrumb(fn_get_lang_var(($mode == 'add') ? 'registration' : 'editing_profile'));
		$uid = $auth['user_id'];
	}

	if (!empty($profile_id)) {
		$user_data = fn_get_user_info($uid, true, $profile_id);
	} elseif (!empty($_REQUEST['profile']) && $_REQUEST['profile'] == 'new') {
		$user_data = fn_get_user_info($uid, false, $profile_id);
	} else {
		$user_data = fn_get_user_info($uid, true, $profile_id);
	}
	
	if (!empty($_SESSION['saved_post_data']['user_data'])) {
		foreach ((array)$_SESSION['saved_post_data'] as $k => $v) {
			$view->assign($k, $v);
		}

		$user_data = fn_array_merge($user_data, $_SESSION['saved_post_data']['user_data']);
		unset($_SESSION['saved_post_data']['user_data']);

	} else {
		if ($mode == 'update') {

			if (!empty($profile_id)) {
				$is_allowed = db_get_field("SELECT user_id FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i", $uid, $profile_id);
				if (empty($is_allowed)) {

					return array(CONTROLLER_STATUS_REDIRECT, "profiles.update" . (!empty($_REQUEST['user_id']) ? "?user_id=$_REQUEST[user_id]" : ''));
				}
			}

			if (empty($user_data)) {
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
		}

		if ($mode == 'add' && !empty($_SESSION['cart']) && !empty($_SESSION['cart']['user_data']) && AREA != 'A') {
			$user_data = $_SESSION['cart']['user_data'];
		}
	}

	$user_type = (!empty($_REQUEST['user_type'])) ? ($_REQUEST['user_type']) : (!empty($user_data['user_type']) ? $user_data['user_type'] : 'C');
	if (AREA == 'A') {
		fn_add_breadcrumb(fn_get_lang_var('users'), "profiles.manage.reset_view");
		fn_add_breadcrumb(fn_get_lang_var('search_results'), "profiles.manage.last_view");
		fn_add_breadcrumb(fn_get_user_type_description($user_type, true), "profiles.manage?user_type=" . $user_type);
	} else {
		Registry::set('navigation.tabs.general', array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		));
	}
	
	$usergroups = fn_get_usergroups((fn_check_user_type_admin_area($user_type) ? 'F' : 'C'), CART_LANGUAGE);
	if (AREA != 'A' && Registry::get('settings.General.allow_usergroup_signup') != 'Y') {
		$hide_tab = true;
		if (!empty($user_data['usergroups'])) {
			foreach ($user_data['usergroups'] as $_user_group) {
				if ($_user_group['status'] == 'A') {
					$hide_tab = false;
					break;
				}
			}
		}
		if ($hide_tab) {
			$usergroups = array();
		}
	}
	
	$user_data['user_type'] = empty($user_data['user_type']) ? 'C' : $user_data['user_type'];
	$user_data['user_id'] = empty($user_data['user_id']) ? (!empty($uid) ? $uid : 0) : $user_data['user_id'];
	
	$auth['is_root'] = isset($auth['is_root']) ? $auth['is_root'] : '';
	if (empty($user_data['is_root'])) {
		$user_data['is_root'] = db_get_field("SELECT is_root FROM ?:users WHERE user_id = ?i", $uid);
	}

	if ($mode == 'update' && 
		(
			AREA == 'A' 
			&& 
			(
				(!fn_check_user_type_admin_area($user_type) && !defined('COMPANY_ID')) // Customers
				|| 
				(fn_check_user_type_admin_area($user_type) && !defined('COMPANY_ID') && $auth['is_root'] == 'Y' && (!empty($user_data['company_id']) || (empty($user_data['company_id']) && (!empty($user_data['is_root']) && $user_data['is_root'] != 'Y')))) // root admin for other admins
				||
				($user_data['user_type'] == 'V' && defined('COMPANY_ID') && $auth['is_root'] == 'Y' && $user_data['user_id'] != $auth['user_id'] && $user_data['company_id'] == COMPANY_ID) // vendor for other vendor admins
			)
			|| 
			AREA != 'A' && !fn_check_user_type_admin_area($user_type) && !empty($usergroups)
		)
	) {
		Registry::set('navigation.tabs.usergroups', array (
			'title' => fn_get_lang_var('usergroups'),
			'js' => true
		));
	} else {
		$usergroups = array();
	}
	$view->assign('usergroups', $usergroups);
	
	$profile_fields = fn_get_profile_fields($user_type);
	$view->assign('user_type', $user_type);
	$view->assign('profile_fields', $profile_fields);
	$view->assign('user_data', $user_data);
	$view->assign('ship_to_another', fn_check_shipping_billing($user_data, $profile_fields));

	$company_id = !empty($user_data['company_id']) ? $user_data['company_id'] : 0;
	$view->assign('titles', fn_get_static_data_section('T', false, '', $company_id));

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('uid', $uid);
	if (Registry::get('settings.General.user_multiple_profiles') == 'Y' && !empty($uid)) {
		$view->assign('user_profiles', fn_get_user_profiles($uid));
	}

// Delete profile
} elseif ($mode == 'delete_profile') {

	if (AREA == 'A' && (fn_is_restricted_admin($_REQUEST) == true || defined('COMPANY_ID'))) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	if (AREA == 'A') {
		$uid = empty($_REQUEST['user_id']) ? $auth['user_id'] : $_REQUEST['user_id'];
	} else {
		$uid = $auth['user_id'];
	}

	$can_delete = db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i AND profile_id = ?i AND profile_type = 'S'", $uid, $_REQUEST['profile_id']);
	if (!empty($can_delete)) {
		db_query("DELETE FROM ?:user_profiles WHERE profile_id = ?i", $_REQUEST['profile_id']);
	}

	return array(CONTROLLER_STATUS_OK, "profiles.update?user_id=" . $uid);

} elseif ($mode == 'request_usergroup') {

	if (AREA == 'A' && fn_is_restricted_admin($_REQUEST) == true || empty($_REQUEST['status']) || empty($_REQUEST['usergroup_id'])) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	$uid = $auth['user_id'];
	if (!empty($uid)) {
		$_data = array(
			'user_id' => $uid,
			'usergroup_id' => $_REQUEST['usergroup_id'],
		);

		if ($_REQUEST['status'] == 'A' || $_REQUEST['status'] == 'P') {
			$_data['status'] = 'F';

		} elseif ($_REQUEST['status'] == 'F' || $_REQUEST['status'] == 'D') {
			$_data['status'] = 'P';
			$usergroup_request = true;
		} else {
			return array(CONTROLLER_STATUS_DENIED);
		}

		db_query("REPLACE INTO ?:usergroup_links SET ?u", $_data);

		if (!empty($usergroup_request)) {
			$user_data = fn_get_user_info($uid);

			$from_email = array(
				'email' => Registry::get('settings.Company.company_users_department'),
				'name' => Registry::get('settings.Company.company_name'),
			);
			
			if (PRODUCT_TYPE == 'ULTIMATE') {
				$user_data['company_name'] = fn_get_company_name($user_data['company_id']);
				$from_email['email'] = CSettings::instance()->get_value('company_users_department', 'Company', $user_data['company_id']);
				$from_email['name'] = $user_data['company_name'];
			}
			

			Registry::get('view_mail')->assign('user_data', $user_data);
			Registry::get('view_mail')->assign('usergroups', fn_get_usergroups('F', Registry::get('settings.Appearance.admin_default_language')));
			Registry::get('view_mail')->assign('usergroup_id', $_REQUEST['usergroup_id']);

			fn_send_mail($from_email['email'], $from_email, 'profiles/usergroup_request_subj.tpl', 'profiles/usergroup_request.tpl', '', Registry::get('settings.Appearance.admin_default_language'), $user_data['email']);
		}
	}

	return array(CONTROLLER_STATUS_OK, "profiles.update");

}

?>