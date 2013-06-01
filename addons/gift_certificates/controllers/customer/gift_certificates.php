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


if ( !defined('AREA') ) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'do_verify') {
		return array(CONTROLLER_STATUS_REDIRECT, "gift_certificates.verify?verify_code=$_POST[verify_code]");
	}

	if ($mode == 'add') {

		if (!empty($_REQUEST['gift_cert_data']) && is_array($_REQUEST['gift_cert_data'])) {

			$gift_cert_data = $_REQUEST['gift_cert_data'];

			if (PRODUCT_TYPE == 'ULTIMATE' && defined ('COMPANY_ID')) {
				$gift_cert_data['company_id'] = COMPANY_ID;
			}

			// Cart is empty, create it
			if (empty($_SESSION['cart'])) {
				fn_clear_cart($_SESSION['cart']);
			}

			if (!empty($_REQUEST['gift_cert_data']['email']) && !fn_validate_email($_REQUEST['gift_cert_data']['email'], true)) {
				if (defined('AJAX_REQUEST')) {
					exit();
				} else {
					return array(CONTROLLER_STATUS_OK, "gift_certificates.add");
				}
			}

			// Gift certificates is empty, create it
			if (empty($_SESSION['cart']['gift_certificates'])) {
				$_SESSION['cart']['gift_certificates'] = array();
			}

			$previous_cart_total = isset($_SESSION['cart']['total']) ? floatval($_SESSION['cart']['total']) : 0;
			list($gift_cert_id, $gift_cert) = fn_add_gift_certificate_to_cart($gift_cert_data, $auth);

			if (!empty($gift_cert_id)) {
				$_SESSION['cart']['gift_certificates'][$gift_cert_id] = $gift_cert;
				$gift_cert['gift_cert_id'] = $gift_cert_id;

				$gift_cert['display_subtotal'] = $gift_cert['amount'];
				if (isset($gift_cert_data['products']) && !empty($gift_cert_data['products'])) {
					fn_calculate_cart_content($_SESSION['cart'], $auth, 'S', true, 'F', true);
					$gift_cert['display_subtotal'] = $_SESSION['cart']['gift_certificates'][$gift_cert_id]['display_subtotal'];
				}

				$view->assign('gift_cert', $gift_cert);
				$msg = $view->display('views/products/components/product_notification.tpl', false);
				fn_set_notification('P', fn_get_lang_var('gift_certificate_added_to_cart'), $msg, 'I');
			}

			fn_save_cart_content($_SESSION['cart'], $auth['user_id']);

			if (defined('AJAX_REQUEST')) {
				fn_calculate_cart_content($_SESSION['cart'], $auth, false, false, 'F', false);
			}
		}
	}


	if ($mode == 'update') {

		if (!empty($_REQUEST['gift_cert_data']) && !empty($_REQUEST['gift_cert_id']) && $_REQUEST['type'] == 'C') {
			fn_delete_cart_gift_certificate($_SESSION['cart'], $_REQUEST['gift_cert_id']);

			list($gift_cert_id, $gift_cert) = fn_add_gift_certificate_to_cart($_REQUEST['gift_cert_data'], $auth);

			if (!empty($gift_cert_id)) {
				$_SESSION['cart']['gift_certificates'][$gift_cert_id] = $gift_cert;
			}

			fn_save_cart_content($_SESSION['cart'], $auth['user_id'], $_REQUEST['type']);
		}
	}

	if ($mode == 'preview') {
		if (!empty($_REQUEST['gift_cert_data'])) {
			fn_correct_gift_certificate($_REQUEST['gift_cert_data']);
			fn_show_postal_card($_REQUEST['gift_cert_data']);
			exit;
		}
	}

	return array(CONTROLLER_STATUS_OK, "checkout.cart");
}

if ($mode == 'verify') {

	fn_add_breadcrumb(fn_get_lang_var('gift_certificate_verification'));

	$verify_id = db_get_field("SELECT gift_cert_id FROM ?:gift_certificates WHERE gift_cert_code = ?s ?p", $_REQUEST['verify_code'], fn_get_gift_certificate_company_condition('?:gift_certificates.company_id'));
	if (!empty($verify_id)) {
		Registry::set('navigation.tabs', array (
			'detailed' => array (
				'title' => fn_get_lang_var('detailed_info'),
				'js' => true
			),
			'log' => array (
				'title' => fn_get_lang_var('history'),
				'js' => true
			)
		));

		list($log, $sort_order, $sort_by) = fn_get_gift_certificate_log($verify_id, $_REQUEST);

		$view->assign('log', $log);
		$view->assign('sort_order', $sort_order);
		$view->assign('sort_by', $sort_by);

		$verify_data = fn_get_gift_certificate_info($verify_id, 'B');
		if (false != ($last_item = reset($log))) {
			$verify_data['amount'] = $last_item['debit'];
			$verify_data['products'] = $last_item['debit_products'];
		}

		$view->assign('verify_data', $verify_data);
	}

} elseif ($mode == 'add') {

	fn_add_breadcrumb(fn_get_lang_var('gift_certificates'));

	$view->assign('templates', fn_get_gift_certificate_templates());
	$view->assign('states', fn_get_all_states());
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));

} elseif ($mode == 'update') {

	if (!empty($_REQUEST['gift_cert_id']) && !isset($_SESSION['cart']['gift_certificates'][$_REQUEST['gift_cert_id']])) {
		return array(CONTROLLER_STATUS_REDIRECT, "gift_certificates.add");
	}

	fn_add_breadcrumb(fn_get_lang_var('gift_certificates'));

	if (!empty($_REQUEST['gift_cert_id'])) {
		$gift_cert_data = fn_get_gift_certificate_info($_REQUEST['gift_cert_id'], 'C');

		if (!empty($gift_cert_data['extra']['exclude_from_calculate'])) {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		$view->assign('gift_cert_data', $gift_cert_data);
		$view->assign('gift_cert_id', $_REQUEST['gift_cert_id']);
	}

	$view->assign('templates', fn_get_gift_certificate_templates());
	$view->assign('states', fn_get_all_states());
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('type', 'C');

} elseif ($mode == 'delete') {

	if (isset($_REQUEST['gift_cert_id'])) {
		$cart = & $_SESSION['cart'];
		fn_delete_cart_gift_certificate($cart, $_REQUEST['gift_cert_id']);

		if (fn_cart_is_empty($cart) == true) {
			fn_clear_cart($cart);
		}

		fn_save_cart_content($cart, $auth['user_id']);

		$cart['recalculate'] = true;
		fn_calculate_cart_content($cart, $auth, 'A', true, 'F', true);

		$redirect_mode = empty($_REQUEST['redirect_mode']) ? 'checkout' : $_REQUEST['redirect_mode'];
		return array(CONTROLLER_STATUS_REDIRECT, "checkout." . $redirect_mode);
	}
}

?>