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


//
// $Id: companies.php 9088 2010-03-15 10:40:51Z 2tl $
//
if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'apply_for_vendor') {

		if (Registry::get('settings.Suppliers.apply_for_vendor') != 'Y') {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		if (Registry::get('settings.Image_verification.use_for_apply_for_vendor_account') == 'Y' && fn_image_verification('apply_for_vendor_account', empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
			fn_save_post_data();
			return array(CONTROLLER_STATUS_REDIRECT, "companies.apply_for_vendor");
		}

		$data = $_REQUEST['company_data'];
		
		$data['timestamp'] = TIME;
		$data['status'] = 'N';
		$data['request_user_id'] = !empty($auth['user_id']) ? $auth['user_id'] : 0;

		$account_data = array();
		$account_data['fields'] = isset($_REQUEST['user_data']['fields']) ? $_REQUEST['user_data']['fields'] : '';
		$account_data['admin_firstname'] = isset($_REQUEST['company_data']['admin_firstname']) ? $_REQUEST['company_data']['admin_firstname'] : '';
		$account_data['admin_lastname'] = isset($_REQUEST['company_data']['admin_lastname']) ? $_REQUEST['company_data']['admin_lastname'] : '';
		$data['request_account_data'] = serialize($account_data);

		if (empty($data['request_user_id'])) {
			$login_condition = empty($data['request_account_name']) ? '' : db_quote(" OR user_login = ?s", $data['request_account_name']);
			$user_account_exists = db_get_field("SELECT user_id FROM ?:users WHERE email = ?s ?p", $data['email'], $login_condition);

			if ($user_account_exists) {
				fn_save_post_data();
				fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_user_exists'));
				return array(CONTROLLER_STATUS_REDIRECT, "companies.apply_for_vendor");
			}
		}

		$result = fn_update_company($data);

		if (!$result) {
			fn_save_post_data();
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('text_error_adding_request'));
			return array(CONTROLLER_STATUS_REDIRECT, "companies.apply_for_vendor");
		}

		fn_set_notification('N', fn_get_lang_var('information'), fn_get_lang_var('text_successful_request'));

		// Notify user department on the new vendor application
		Registry::get('view_mail')->assign('company_id', $result);
		Registry::get('view_mail')->assign('company', $data);
		fn_send_mail(Registry::get('settings.Company.company_users_department'), Registry::get('settings.Company.company_users_department'), 'companies/apply_for_vendor_notification_subj.tpl', 'companies/apply_for_vendor_notification.tpl', '', Registry::get('settings.Appearance.admin_default_language'));

		$return_url = !empty($_SESSION['apply_for_vendor']['return_url']) ? $_SESSION['apply_for_vendor']['return_url'] : INDEX_SCRIPT;
		unset($_SESSION['apply_for_vendor']['return_url']);
		
		return array(CONTROLLER_STATUS_REDIRECT, $return_url);
	}
	

}



if ($mode == 'view') {

	$company_data = !empty($_REQUEST['company_id']) ? fn_get_company_data($_REQUEST['company_id']) : array();

	if (empty($company_data) || empty($company_data['status']) || !empty($company_data['status']) && $company_data['status'] != 'A') {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}
	
	$company_data['manifest'] = fn_get_manifest('customer', CART_LANGUAGE, $_REQUEST['company_id']);
	$view->assign('company_data', $company_data);
	
	fn_add_breadcrumb(fn_get_lang_var('all_vendors'), 'companies.catalog');
	fn_add_breadcrumb($company_data['company']);

} elseif ($mode == 'catalog') {

	$params = $_REQUEST;
	$params['status'] = 'A';
	$params['get_description'] = 'Y';

	$vendors_per_page = Registry::get('settings.Suppliers.vendors_per_page');
	list($companies, $search) = fn_get_companies($params, $auth, $vendors_per_page);
	
	// get company logos and manifest
	$company_ids = array();
	$base_manifest = parse_ini_file(DIR_SKINS . Registry::get('settings.skin_name_customer') . '/' . SKIN_MANIFEST, true);
	foreach ($companies as &$company) {
		$company_ids[] = $company['company_id'];
		$company['logos'] = !empty($company['logos']) ? unserialize($company['logos']) : array();
		$company['manifest'] = array_merge($base_manifest, $company['logos']);
	}
	
	$alts = db_get_hash_single_array("SELECT object_id, object_holder, description FROM ?:common_descriptions WHERE object_id IN (?a) AND object_holder = ?s AND lang_code = ?s", array('object_id', 'description'), $company_ids, 'Customer_logo', CART_LANGUAGE);
	
	foreach ($companies as &$company) {
		$company['manifest']['Customer_logo']['alt'] = !empty($alts[$company['company_id']]) ? $alts[$company['company_id']] : $company['company'];
	}
	
	$view->assign('companies', $companies);
	$view->assign('search', $search);

	fn_add_breadcrumb(fn_get_lang_var('all_vendors'));

} elseif ($mode == 'apply_for_vendor') {

	if (Registry::get('settings.Suppliers.apply_for_vendor') != 'Y') {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if (!empty($_SESSION['saved_post_data']['company_data'])) {
		foreach ((array)$_SESSION['saved_post_data'] as $k => $v) {
			$view->assign($k, $v);
		}

		unset($_SESSION['saved_post_data']['company_data']);
	}

	$profile_fields = fn_get_profile_fields('A', array(), CART_LANGUAGE, array('get_custom' => true, 'get_profile_required' => true));

	$view->assign('profile_fields', $profile_fields);

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());

	fn_add_breadcrumb(fn_get_lang_var('apply_for_vendor_account'));

	$_SESSION['apply_for_vendor']['return_url'] = !empty($_REQUEST['return_previous_url']) ? $_REQUEST['return_previous_url'] : INDEX_SCRIPT;
}

?>