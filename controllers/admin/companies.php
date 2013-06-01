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
	$suffix = '';
	
	// Define trusted variables that shouldn't be stripped
	fn_trusted_vars (
		'company_data'
	);
	
	
	//
	// Processing additon of new company
	//
	if ($mode == 'add') {

		$suffix = '.add';

		if (!empty($_REQUEST['company_data']['company'])) {  // Checking for required fields for new company

			if ((PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') && isset($_REQUEST['company_data']['is_create_vendor_admin']) && $_REQUEST['company_data']['is_create_vendor_admin'] == 'Y') {
				if (!empty($_REQUEST['company_data']['admin_username']) && db_get_field("SELECT COUNT(*) FROM ?:users WHERE user_login = ?s", $_REQUEST['company_data']['admin_username']) > 0) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_admin_not_created_name_already_used'));
					fn_save_post_data();
					$suffix = '.add';
				} else {
					// Adding company record
			
					$company_id = fn_update_company($_REQUEST['company_data']);

					if (!empty($company_id)) {
						$suffix = ".update?company_id=$company_id";
						if ((PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') && isset($_REQUEST['company_data']['is_create_vendor_admin']) && $_REQUEST['company_data']['is_create_vendor_admin'] == 'Y') {

							if (db_get_field("SELECT COUNT(*) FROM ?:users WHERE email = ?s", $_REQUEST['company_data']['email']) > 0) {
								fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_admin_not_created_email_already_used'));
							} else {

								// Add company's administrator
								if (fn_is_restricted_admin($_REQUEST) == true) {
									return array(CONTROLLER_STATUS_DENIED);
								}

								$user_data['fields'] = isset($_REQUEST['user_data']['fields']) ? $_REQUEST['user_data']['fields'] : '';
					
								if (!empty($_REQUEST['company_data']['admin_username'])) {
									$user_data['user_login'] = $_REQUEST['company_data']['admin_username'];
								} else {
									$user_data['user_login'] = $_REQUEST['company_data']['email'];
								}

								$user_data['user_type'] = 'V';
								$user_data['password1'] = fn_generate_password();
								$user_data['password2'] = $user_data['password1'];
								$user_data['status'] = $_REQUEST['company_data']['status'];
								$user_data['company_id'] = $company_id;
								$user_data['email'] = $_REQUEST['company_data']['email'];
								$user_data['company'] = $_REQUEST['company_data']['company'];
								$user_data['last_login'] = 0;
								$user_data['lang_code'] = $_REQUEST['company_data']['lang_code'];
								$user_data['password_change_timestamp'] = 0;
								$user_data['is_root'] = 'N';

								// Copy vendor admin billing and shipping addresses from the company's credentials
								$user_data['firstname'] = $user_data['b_firstname'] = $user_data['s_firstname'] = (!empty($_REQUEST['company_data']['admin_firstname'])) ? $_REQUEST['company_data']['admin_firstname'] : '';
								$user_data['lastname'] = $user_data['b_lastname'] = $user_data['s_lastname'] = (!empty($_REQUEST['company_data']['admin_lastname'])) ? $_REQUEST['company_data']['admin_lastname'] : '';

								$user_data['b_address'] = $user_data['s_address'] = $_REQUEST['company_data']['address'];
								$user_data['b_city'] = $user_data['s_city'] = $_REQUEST['company_data']['city'];
								$user_data['b_country'] = $user_data['s_country'] = $_REQUEST['company_data']['country'];
								$user_data['b_state'] = $user_data['s_state'] = $_REQUEST['company_data']['state'];
								$user_data['b_zipcode'] = $user_data['s_zipcode'] = $_REQUEST['company_data']['zipcode'];

								// Create new user, avoiding switching to the vendor admin's session ($null as the 3rd argument)
								list($added_user_id, $null) = fn_update_user(0, $user_data, $null, false, true, true);
								if ($added_user_id) {
									$msg = fn_get_lang_var('new_administrator_account_created') . "<a href=?dispatch=profiles.update&user_id=$added_user_id>" . fn_get_lang_var('you_can_edit_account_details') . '</a>';
									fn_set_notification('N', fn_get_lang_var('notice'), $msg, 'K');
								}
							}
						}
					}
				}
			} else {
				$company_id = fn_update_company($_REQUEST['company_data']);
				if (!empty($company_id)) {
					$suffix = ".update?company_id=$company_id";
				}
			}
		}
		

	}

	//
	// Processing updating of company element
	//
	if ($mode == 'update') {
		if (!empty($_REQUEST['company_data']['company'])) {
			if (!empty($_REQUEST['company_id']) && defined('COMPANY_ID') && COMPANY_ID != $_REQUEST['company_id']) {
				fn_company_access_denied_notification();
			} else {
				// Updating company record
				fn_update_company($_REQUEST['company_data'], $_REQUEST['company_id'], DESCR_SL);
			}
			

		}

		$suffix = ".update?company_id=$_REQUEST[company_id]";
	}
	
	if ($mode == 'm_delete') {

		if (!empty($_REQUEST['company_ids'])) {
			foreach ($_REQUEST['company_ids'] as $v) {
				fn_delete_company($v);
			}
		}

		return array(CONTROLLER_STATUS_OK, "companies.manage");
	}

	
	if ($mode == 'merge') {
		if (!isset($_SESSION['auth']['is_root']) || $_SESSION['auth']['is_root'] != 'Y' || defined('COMPANY_ID')) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		if (isset($_REQUEST['from_company_id']) && isset($_REQUEST['to_company_id']) && fn_chown_company($_REQUEST['from_company_id'], $_REQUEST['to_company_id'])) {
			fn_delete_company($_REQUEST['from_company_id']);
		}

		return array(CONTROLLER_STATUS_REDIRECT, "companies.manage");
	}
	
	
	if ($mode == 'payouts_m_delete' && !defined('COMPANY_ID')) {
		if (!empty($_REQUEST['payout_ids'])) {
			fn_companies_delete_payout($_REQUEST['payout_ids']);
		}
		
		$suffix = '.balance';
	}
	
	if ($mode == 'payouts_add' && !defined('COMPANY_ID')) {
		if (!empty($_REQUEST['payment']['amount'])) {
			fn_companies_add_payout($_REQUEST['payment']);
		}
		
		$suffix = '.balance';
	}

	if ($mode == 'update_payout_comments' && !defined('COMPANY_ID')) {
		if (!empty($_REQUEST['payout_comments'])) {
			foreach ($_REQUEST['payout_comments'] as $payout_id => $comment) {
				db_query('UPDATE ?:vendor_payouts SET comments = ?s WHERE payout_id = ?i', $comment, $payout_id);
			}
		}
	}

	if ($mode == 'm_activate' || $mode == 'm_disable') {
		if ($mode == 'm_activate') {
			$status = 'A';
			$reason = !empty($_REQUEST['action_reason_activate']) ? $_REQUEST['action_reason_activate'] : '';
			$msg = fn_get_lang_var('text_companies_activated');
		} else {
			$status = 'D';
			$reason = !empty($_REQUEST['action_reason_disable']) ? $_REQUEST['action_reason_disable'] : '';
			$msg = fn_get_lang_var('text_companies_disabled');
		}

		$notification = !empty($_REQUEST['action_notification']) && $_REQUEST['action_notification'] == 'Y';

		$result = array();
		foreach ($_REQUEST['company_ids'] as $company_id) {
			$status_from = '';
			$res = fn_companies_change_status($company_id, $status, $reason, $status_from, false, $notification);
			if ($res) {
				$result[] = $company_id;
			}
		}

		if ($result) {
			fn_set_notification('N', fn_get_lang_var('notice'), $msg);
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'), 'I');
		}

		return array(CONTROLLER_STATUS_REDIRECT, "companies.manage");
	}

	return array(CONTROLLER_STATUS_OK, "companies$suffix");
}

if ($mode == 'payout_delete' && !defined('COMPANY_ID')) {
	fn_companies_delete_payout($_REQUEST['payout_id']);
}

if ($mode == 'manage') {

	list($companies, $search) = fn_get_companies($_REQUEST, $auth, Registry::get('settings.Appearance.admin_elements_per_page'));
	
	$view->assign('companies', $companies);
	$view->assign('search', $search);

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());

} elseif ($mode == 'delete') {

	fn_delete_company($_REQUEST['company_id']);

	return array(CONTROLLER_STATUS_REDIRECT);
	
} elseif ($mode == 'update' || $mode == 'add') {

	$company_id = !empty($_REQUEST['company_id']) ? $_REQUEST['company_id'] : 0;
	$company_data = !empty($company_id) ? fn_get_company_data($company_id) : array();
	
	if ($mode == 'update' && empty($company_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);	
	}

	if (!empty($_SESSION['saved_post_data']['company_data'])) {
		foreach ((array)$_SESSION['saved_post_data'] as $k => $v) {
			$view->assign($k, $v);
		}

		$company_data = $_SESSION['saved_post_data']['company_data'];
		unset($_SESSION['saved_post_data']['company_data']);

	} else {
		$view->assign('company_data', $company_data);
	}
	

	
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	
	$manifest_definition = fn_companies_get_manifest_definition();
	$view->assign('manifest_definition', $manifest_definition);

	if (PRODUCT_TYPE != 'MULTIVENDOR' && PRODUCT_TYPE != 'ULTIMATE') {
		$company_id = null;
	}
	$view->assign('manifests', array(
		'customer' => fn_get_manifest('customer', CART_LANGUAGE, $company_id),
		'admin' => fn_get_manifest('admin', CART_LANGUAGE, $company_id),
	));

	$profile_fields = fn_get_profile_fields('A', array(), CART_LANGUAGE, array('get_custom' => true, 'get_profile_required' => true));

	$view->assign('profile_fields', $profile_fields);

	// [Breadcrumbs]
	if (PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') {
		$lang_var = 'vendors';
	} else {
		$lang_var = 'suppliers';
	}
	fn_add_breadcrumb(fn_get_lang_var($lang_var), 'companies.manage');
	// [/Breadcrumbs]

	// [Page sections]
	$tabs['detailed'] = array (
		'title' => fn_get_lang_var('general'),
		'js' => true
	);
	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$tabs['description'] = array (
			'title' => fn_get_lang_var('description'),
			'js' => true
		);
		$tabs['logos'] = array (
			'title' => fn_get_lang_var('logos'),
			'js' => true
		);
		$tabs['categories'] = array (
			'title' => fn_get_lang_var('categories'),
			'js' => true
		);
		
	} elseif (PRODUCT_TYPE == 'ULTIMATE') {
		$tabs['regions'] = array (
			'title' => fn_get_lang_var('regions'),
			'js' => true
		);
		
		if ($mode == 'add') {
			$tabs['skin_selector'] = array (
				'title' => fn_get_lang_var('skin_selector'),
				'js' => true
			);
		}
	}
	
	Registry::set('navigation.tabs', $tabs);

	if (!defined('COMPANY_ID')) {
		$shippings = db_get_hash_single_array("SELECT a.shipping_id, b.shipping FROM ?:shippings as a LEFT JOIN ?:shipping_descriptions as b ON a.shipping_id = b.shipping_id AND b.lang_code = ?s WHERE a.status = 'A' AND company_id = 0 ORDER BY a.position", array('shipping_id', 'shipping'), DESCR_SL);
		$view->assign('shippings', $shippings);

		if (PRODUCT_TYPE != 'ULTIMATE') {
			$tabs['shipping_methods'] = array (
				'title' => fn_get_lang_var('shipping_methods'),
				'js' => true
			);
		}
		
		$tabs['addons'] = array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		);
		
		Registry::set('navigation.tabs', $tabs);
	}
	// [/Page sections]
} elseif ($mode == 'merge') {

	if (!isset($_SESSION['auth']['is_root']) || $_SESSION['auth']['is_root'] != 'Y' || defined('COMPANY_ID')) {
		return array(CONTROLLER_STATUS_DENIED);
	}

	if (empty($_REQUEST['company_id'])) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	$company_id = $_REQUEST['company_id'];
	unset ($_REQUEST['company_id']);
	$company_data = !empty($company_id) ? fn_get_company_data($company_id) : array();

	if (empty($company_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	$_REQUEST['exclude_company_id'] = $company_id;

	list($companies, $search) = fn_get_companies($_REQUEST, $auth, Registry::get('settings.Appearance.admin_elements_per_page'));

	$view->assign('company_name', $company_data['company']);
	$view->assign('companies', $companies);
	$view->assign('search', $search);
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());

	// [Breadcrumbs]
	if (PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') {
		$lang_var = 'vendors';
	} else {
		$lang_var = 'suppliers';
	}
	fn_add_breadcrumb(fn_get_lang_var($lang_var), 'companies.manage');
	// [/Breadcrumbs]
} elseif ($mode == 'balance') {
	if (PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') {
		$params = $_REQUEST;
		list($payouts, $search, $total) = fn_companies_get_payouts($params);
		
		$view->assign('payouts', $payouts);
		$view->assign('search', $search);
		$view->assign('total', $total);
	}
} elseif ($mode == 'update_status') {

	$notification = !empty($_REQUEST['notify_user']) && $_REQUEST['notify_user'] == 'Y';

	if (fn_companies_change_status($_REQUEST['id'], $_REQUEST['status'], '', $status_from, false, $notification)) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'));
		$ajax->assign('return_status', $status_from);
	}

	exit;

} elseif ($mode == 'picker') {
	list($companies, $search) = fn_get_companies($_REQUEST, $auth, Registry::get('settings.Appearance.admin_elements_per_page'));
	
	$view->assign('companies', $companies);
	$view->assign('search', $search);

	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());


	$view->display('pickers/companies_picker_contents.tpl');
	exit;
}



?>
