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
	if (!empty($dispatch_extra)) {
		if (!empty($_REQUEST['approval_data'][$dispatch_extra])) {
			$_REQUEST['approval_data'] = $_REQUEST['approval_data'][$dispatch_extra];
		}
	}
	
	if ($mode == 'products_approval' && !empty($_REQUEST['approval_data'])) {
		$status = ACTION == 'approve' ? 'Y' : 'N';
		db_query('UPDATE ?:products SET approved = ?s WHERE product_id = ?i', $status, $_REQUEST['approval_data']['product_id']);
		
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
		
		if (isset($_REQUEST['approval_data']['notify_user_' . $status]) && $_REQUEST['approval_data']['notify_user_' . $status] == 'Y') {
			list($products_data) = fn_get_products(array('pid' => array($_REQUEST['approval_data']['product_id'])));
			$company_data = fn_get_company_data($_REQUEST['approval_data']['company_id'], DESCR_SL, false);
			
			if (!empty($company_data['email'])) {
				$view_mail->assign('company_data', $company_data);
				$view_mail->assign('products', $products_data);
				$view_mail->assign('status', $status);
				$view_mail->assign('reason', $_REQUEST['approval_data']['reason_' . $status]);
				fn_send_mail($company_data['email'], Registry::get('settings.Company.company_support_department'), 'addons/vendor_data_premoderation/notification_subj.tpl', 'addons/vendor_data_premoderation/notification.tpl', '', CART_LANGUAGE);
			}
		}
	} elseif (($mode == 'm_approve' || $mode == 'm_decline') && !empty($_REQUEST['product_ids'])) {
		if ($mode == 'm_approve') {
			$status = 'Y';
			$reason = $_REQUEST['action_reason_approved'];
			$send_notification = isset($_REQUEST['action_notification_approved']) && $_REQUEST['action_notification_approved'] == 'Y' ? true : false;
		} else {
			$status = 'N';
			$reason = $_REQUEST['action_reason_declined'];
			$send_notification = isset($_REQUEST['action_notification_declined']) && $_REQUEST['action_notification_declined'] == 'Y' ? true : false;
		}
		db_query('UPDATE ?:products SET approved = ?s WHERE product_id IN (?n)', $status, $_REQUEST['product_ids']);
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
		
		if ($send_notification) {
			// Group updated products by companies
			$_companies = array();
			foreach ($_REQUEST['product_ids'] as $product_id) {
				if ($_REQUEST['products_data'][$product_id]['current_status'] != $status) {
					$_companies[$_REQUEST['products_data'][$product_id]['company_id']]['products'][] = array(
						'product_id' => $product_id,
						'product' => $_REQUEST['products_data'][$product_id]['product'],
					);
				}
			}
			
			if (!empty($_companies)) {
				$companies_data = db_get_hash_array("SELECT ?:companies.* FROM ?:companies WHERE company_id IN (?a)", 'company_id', array_keys($_companies));
				foreach ($_companies as $company_id => $products) {
					$company_data = $companies_data[$company_id];
					if (!empty($company_data['email'])) {
						$view_mail->assign('company_data', $company_data);
						$view_mail->assign('products', $products['products']);
						$view_mail->assign('status', $status);
						$view_mail->assign('reason', $reason);
						fn_send_mail($company_data['email'], Registry::get('settings.Company.company_support_department'), 'addons/vendor_data_premoderation/notification_subj.tpl', 'addons/vendor_data_premoderation/notification.tpl', '', $company_data['lang_code']);
					}
				}
			}
		}
	}
}

if ($mode == 'products_approval' && !defined('COMPANY_ID')) {
	if (!isset($_REQUEST['vendor'])) {
		$_REQUEST['vendor'] = 'all';
	}
	
	$params = $_REQUEST;
	$params['extend'][] = 'companies';

	list($products, $search, $product_count) = fn_get_products($params, Registry::get('settings.Appearance.admin_products_per_page'), DESCR_SL);
	
	$view->assign('products', $products);
	$view->assign('search', $search);
}

?>