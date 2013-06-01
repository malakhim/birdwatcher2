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

if (!empty($_REQUEST['order_id']) && $mode != 'search') {
	// If user is not logged in and trying to see the order, redirect him to login form
	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}

	$orders_company_condition = '';


	if (!empty($auth['user_id'])) {
		$allowed_id = db_get_field("SELECT user_id FROM ?:orders WHERE user_id = ?i AND order_id = ?i $orders_company_condition", $auth['user_id'], $_REQUEST['order_id']);

	} elseif (!empty($auth['order_ids'])) {
		$allowed_id = in_array($_REQUEST['order_id'], $auth['order_ids']);
	}

	// Check order status (incompleted order)
	if (!empty($allowed_id)) {
		$status = db_get_field("SELECT status FROM ?:orders WHERE order_id = ?i $orders_company_condition", $_REQUEST['order_id']);
		if ($status == STATUS_INCOMPLETED_ORDER) {
			$allowed_id = 0;
		}
	}

	fn_set_hook('is_order_allowed', $_REQUEST['order_id'], $allowed_id);

	if (empty($allowed_id)) { // Access denied
		return array(CONTROLLER_STATUS_DENIED);
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'repay') {
		$view->assign('order_action', fn_get_lang_var('processing'));
		$view->display('views/orders/components/placing_order.tpl');
		fn_flush();

		$order_info = fn_get_order_info($_REQUEST['order_id']);

		$payment_info = empty($_REQUEST['payment_info']) ? array() : $_REQUEST['payment_info'];

		// Save payment information
		if (!empty($payment_info)) {
			$ccards = fn_get_static_data_section('C', true);
			if (!empty($payment_info['card']) && !empty($ccards[$payment_info['card']])) {
				// Check if cvv2 number required and unset it if not
				if ($ccards[$payment_info['card']]['param_2'] != 'Y') {
					unset($payment_info['cvv2']);
				}
				// Check if start date exists and required and convert it to string
				if ($ccards[$payment_info['card']]['param_3'] != 'Y') {
					unset($payment_info['start_month'], $payment_info['start_year']);
				}
				// Check if issue number required
				if ($ccards[$payment_info['card']]['param_4'] != 'Y') {
					unset($payment_info['issue_number']);
				}
			}

			$_data = array (
				'order_id' => $_REQUEST['order_id'],
				'type' => 'P', //payment information
				'data' => fn_encrypt_text(serialize($payment_info)),
			);

			db_query("REPLACE INTO ?:order_data ?e", $_data);
		} else {
			db_query("DELETE FROM ?:order_data WHERE type = 'P' AND order_id = ?i", $_REQUEST['order_id']);
		}

		// Change payment method
		$update_order['payment_id'] = $_REQUEST['payment_id'];
		$update_order['repaid'] = ++ $order_info['repaid'];

		// Add new customer notes
		if (!empty($_REQUEST['customer_notes'])) {
			$update_order['notes'] = (!empty($order_info['notes']) ? $order_info['notes'] . "\n" : '') . $_REQUEST['customer_notes'];
		}

		// Update total and surcharge amount
		$payment = fn_get_payment_method_data($_REQUEST['payment_id']);
		if (!empty($payment['p_surcharge']) || !empty($payment['a_surcharge'])) {
			$surcharge_value = 0;
			if (floatval($payment['a_surcharge'])) {
				$surcharge_value += $payment['a_surcharge'];
			}
			if (floatval($payment['p_surcharge'])) {
				$surcharge_value += fn_format_price(($order_info['total'] - $order_info['payment_surcharge']) * $payment['p_surcharge'] / 100);
			}
			$update_order['payment_surcharge'] = $surcharge_value;
			if (PRODUCT_TYPE == 'MULTIVENDOR' && fn_take_payment_surcharge_from_vendor($order_info['items'])) {
				$update_order['total'] = fn_format_price($order_info['total']);
			} else {
				$update_order['total'] = fn_format_price($order_info['total'] - $order_info['payment_surcharge'] + $surcharge_value);
			}
		} else {
			if (PRODUCT_TYPE == 'MULTIVENDOR' && fn_take_payment_surcharge_from_vendor($order_info['items'])) {
				$update_order['total'] = fn_format_price($order_info['total']);
			} else {
				$update_order['total'] = fn_format_price($order_info['total'] - $order_info['payment_surcharge']);
			}
			$update_order['payment_surcharge'] = 0;
		}

		db_query('UPDATE ?:orders SET ?u WHERE order_id = ?i', $update_order, $_REQUEST['order_id']);

		// Change order status back to Open and restore amount.
		fn_change_order_status($order_info['order_id'], 'O', $order_info['status'], fn_get_notification_rules(array(), false));

		$_SESSION['cart']['placement_action'] = 'repay';

		// Process order (payment)
		fn_start_payment($order_info['order_id'], array(), $payment_info);

		fn_order_placement_routines($order_info['order_id'], array(), true, 'repay');
	}

	return array(CONTROLLER_STATUS_OK, "orders.details?order_id=$_REQUEST[order_id]");
}

fn_add_breadcrumb(fn_get_lang_var('orders'), $mode == 'search' ? '' : "orders.search");

//
// Show invoice
//
if ($mode == 'invoice') {
	fn_add_breadcrumb(fn_get_lang_var('order') . ' #' . $_REQUEST['order_id'], "orders.details?order_id=$_REQUEST[order_id]");
	fn_add_breadcrumb(fn_get_lang_var('invoice'));

	$view->assign('order_info', fn_get_order_info($_REQUEST['order_id']));

//
// Show invoice on separate page
//
} elseif ($mode == 'print_invoice') {
	$order_info = fn_get_order_info($_REQUEST['order_id']);
	$view_mail->assign('order_info', $order_info);
	$view_mail->assign('order_status', fn_get_status_data($order_info['status'], STATUSES_ORDER, $order_info['order_id'], CART_LANGUAGE));
	$view_mail->assign('payment_method', fn_get_payment_data((!empty($order_info['payment_method']['payment_id']) ? $order_info['payment_method']['payment_id'] : 0), $order_info['order_id'], CART_LANGUAGE));
	$view_mail->assign('profile_fields', fn_get_profile_fields('I'));

	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$view_mail->assign('take_surcharge_from_vendor', fn_take_payment_surcharge_from_vendor($order_info['items']));
	}

	if (!empty($_REQUEST['format']) && $_REQUEST['format'] == 'pdf') {
		fn_disable_translation_mode();
		$view_mail->assign('index_script', Registry::get('config.current_location') . '/' . $index_script);
		fn_html_to_pdf($view_mail->display('orders/print_invoice.tpl', false), fn_get_lang_var('invoice') . '-' . $_REQUEST['order_id']);
	} else {
		$view_mail->display('orders/print_invoice.tpl');
	}
	exit;

//
// Track orders by ekey
//
} elseif ($mode == 'track') {
	if (!empty($_REQUEST['ekey'])) {
		$email = db_get_field("SELECT object_string FROM ?:ekeys WHERE object_type = 'T' AND ekey = ?s AND ttl > ?i", $_REQUEST['ekey'], TIME);

		// Cleanup keys
		db_query("DELETE FROM ?:ekeys WHERE object_type = 'T' AND ttl < ?i", TIME);

		if (empty($email)) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		$auth['order_ids'] = db_get_fields("SELECT order_id FROM ?:orders WHERE email = ?s", $email);

		if (!empty($_REQUEST['o_id']) && in_array($_REQUEST['o_id'], $auth['order_ids'])) {
			return array(CONTROLLER_STATUS_REDIRECT, "orders.details?order_id=$_REQUEST[o_id]");
		} else {
			return array(CONTROLLER_STATUS_REDIRECT, "orders.search");
		}
	} else {
		return array(CONTROLLER_STATUS_DENIED);
	}

	exit;

//
// Request for order tracking
//
} elseif ($mode == 'track_request') {

	if (Registry::get('settings.Image_verification.use_for_track_orders') == 'Y' && fn_image_verification('track_orders_' . $_REQUEST['field_id'], empty($_REQUEST['verification_answer']) ? '' : $_REQUEST['verification_answer']) == false) {
		exit;
	}

	$condition = fn_get_company_condition('?:orders.company_id');

	if (!empty($auth['user_id'])) {
		
		$allowed_id = db_get_field(
			'SELECT user_id '
			. 'FROM ?:orders '
			. 'WHERE user_id = ?i AND order_id = ?i AND is_parent_order != ?s' . $condition,
			$auth['user_id'], $_REQUEST['track_data'], 'Y'
		);

		if (!empty($allowed_id)) {
			$ajax->assign('force_redirection', 'orders.details?order_id=' . $_REQUEST['track_data']);
			exit;
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('warning_track_orders_not_allowed'));
		}
	} else {
		$email = '';
		
		if (!empty($_REQUEST['track_data'])) {
			$o_id = 0;
			// If track by email
			if (strpos($_REQUEST['track_data'], '@') !== false) {
				$order_info = db_get_row("SELECT order_id, email, company_id, lang_code FROM ?:orders WHERE email = ?s $condition ORDER BY timestamp DESC LIMIT 1", $_REQUEST['track_data']);
			// Assume that this is order number
			} else {
				$order_info = db_get_row("SELECT order_id, email, company_id, lang_code FROM ?:orders WHERE order_id = ?i $condition", $_REQUEST['track_data']);
			}
		}

		if (!empty($order_info['email'])) {
			// Create access key
			$ekey_data = array (
				'object_string' => $order_info['email'],
				'object_type' => 'T',
				'ekey' => md5(uniqid(rand())),
				'ttl' => strtotime("+1 hour"), // FIXME!!! hardcoded
			);

			db_query("REPLACE INTO ?:ekeys ?e", $ekey_data);

			$view_mail->assign('access_key', $ekey_data['ekey']);
			$view_mail->assign('o_id', $order_info['order_id']);

   			$company_id = fn_get_company_id('orders', 'order_id', $order_info['order_id']);
			$company = fn_get_company_placement_info($company_id);
			Registry::get('view_mail')->assign('company_placement_info', $company);

			$result = fn_send_mail($order_info['email'], array('email' => $company['company_orders_department'], 'name' => $company['company_name']), 'orders/track_subj.tpl', 'orders/track.tpl', '', $order_info['lang_code']);
			if ($result) {
				fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_track_instructions_sent'));
			}
		} else {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('warning_track_orders_not_found'));
		}
	}

	return array(CONTROLLER_STATUS_OK, $_REQUEST['return_url']);
//
// Show order details
//
} elseif ($mode == 'details') {

	fn_add_breadcrumb(fn_get_lang_var('order_info'));

	$order_info = fn_get_order_info($_REQUEST['order_id']);
	
	if (empty($order_info)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}
	
	if ($order_info['is_parent_order'] == 'Y') {
		$child_ids = db_get_fields("SELECT order_id FROM ?:orders WHERE parent_order_id = ?i", $_REQUEST['order_id']);
		fn_redirect(INDEX_SCRIPT . "?dispatch[orders.search]=Search&period=A&order_id=" . implode(',', $child_ids));
	}

	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$view->assign('take_surcharge_from_vendor', fn_take_payment_surcharge_from_vendor($order_info['items']));
	}
	// Repay functionality
	$statuses = fn_get_statuses(STATUSES_ORDER, false, true);

	if (Registry::get('settings.General.repay') == 'Y' && (!empty($statuses[$order_info['status']]['repay']) && $statuses[$order_info['status']]['repay'] == 'Y')) {
		fn_prepare_repay_data(empty($_REQUEST['payment_id']) ? 0 : $_REQUEST['payment_id'], $order_info, $auth, $view);
	}

	$navigation_tabs = array(
		'general' => array(
			'title' => fn_get_lang_var('general'),
			'js' => true,
			'href' => 'orders.details?order_id=' . $_REQUEST['order_id'] . '&selected_section=general'
		),
	);
	
	if (Registry::get('settings.General.use_shipments') == 'Y') {
		$navigation_tabs['shipment_info'] = array(
			'title' => fn_get_lang_var('shipment_info'),
			'js' => true,
			'href' => 'orders.details?order_id=' . $_REQUEST['order_id'] . '&selected_section=shipment_info'
		);

		$shipments = db_get_array('SELECT ?:shipments.shipment_id, ?:shipments.comments, ?:shipments.tracking_number, ?:shipping_descriptions.shipping AS shipping, ?:shipments.carrier FROM ?:shipments LEFT JOIN ?:shipment_items ON (?:shipments.shipment_id = ?:shipment_items.shipment_id) LEFT JOIN ?:shipping_descriptions ON (?:shipments.shipping_id = ?:shipping_descriptions.shipping_id) WHERE ?:shipment_items.order_id = ?i AND ?:shipping_descriptions.lang_code = ?s GROUP BY ?:shipments.shipment_id', $order_info['order_id'], DESCR_SL);
		
		if (!empty($shipments)) {
			foreach ($shipments as $id => $shipment) {
				$shipments[$id]['items'] = db_get_array('SELECT item_id, amount FROM ?:shipment_items WHERE shipment_id = ?i', $shipment['shipment_id']);
			}
		}
		
		$view->assign('shipments', $shipments);
	}
	

	Registry::set('navigation.tabs', $navigation_tabs);
	$view->assign('order_info', $order_info);
	$view->assign('status_settings', $statuses[$order_info['status']]);
	
	if (!empty($_REQUEST['selected_section'])) {
		$view->assign('selected_section', $_REQUEST['selected_section']);
	}

//
// Search orders
//
} elseif ($mode == 'search') {

	$params = $_REQUEST;
	if (!empty($auth['user_id'])) {
		$params['user_id'] = $auth['user_id'];

	} elseif (!empty($auth['order_ids'])) {
		if (empty($params['order_id'])) {
			$params['order_id'] = $auth['order_ids'];
		} else {
			$ord_ids = is_array($params['order_id']) ? $params['order_id'] : explode(',', $params['order_id']);
			$params['order_id'] = array_intersect($ord_ids, $auth['order_ids']);
		}

	} else {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}

	list($orders, $search) = fn_get_orders($params, Registry::get('settings.Appearance.orders_per_page'));

	$view->assign('orders', $orders);
	$view->assign('search', $search);

//
// Reorder order
//
} elseif ($mode == 'reorder') {

	fn_reorder($_REQUEST['order_id'], $_SESSION['cart'], $auth);

	return array(CONTROLLER_STATUS_REDIRECT, "checkout.cart");

} elseif ($mode == 'downloads') {

	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	fn_add_breadcrumb(fn_get_lang_var('downloads'));

	$view->assign('products', fn_get_user_edp($auth['user_id'], empty($auth['user_id']) ? $auth['order_ids'] : 0, empty($_REQUEST['page']) ? 1 : $_REQUEST['page']));

} elseif ($mode == 'order_downloads') {

	if (empty($auth['user_id']) && empty($auth['order_ids'])) {
		return array(CONTROLLER_STATUS_REDIRECT, $index_script);
	}

	if (!empty($_REQUEST['order_id'])) {
		if (empty($auth['user_id']) && !in_array($_REQUEST['order_id'], $auth['order_ids'])) {
			return array(CONTROLLER_STATUS_DENIED);
		}
		$orders_company_condition = '';


		$order = db_get_row("SELECT user_id, order_id FROM ?:orders WHERE ?:orders.order_id = ?i AND is_parent_order != 'Y' $orders_company_condition", $_REQUEST['order_id']);

		if (empty($order) && fn_is_empty($order)) {
			return array(CONTROLLER_STATUS_NO_PAGE);
		}

		fn_add_breadcrumb(fn_get_lang_var('order') . ' #' . $_REQUEST['order_id'], "orders.details?order_id=" . $_REQUEST['order_id']);
		fn_add_breadcrumb(fn_get_lang_var('downloads'));

		$view->assign('products', fn_get_user_edp($order['user_id'], $_REQUEST['order_id']));
	} else {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

} elseif ($mode == 'get_file') {

	$field = empty($_REQUEST['preview']) ? 'file_path' : 'preview_path';
	
	if (($field == 'file_path' && !empty($_REQUEST['ekey']) || $field == 'preview_path')) {

		if (!empty($_REQUEST['ekey'])) {

			$ekey_info = fn_get_product_edp_info($_REQUEST['product_id'], $_REQUEST['ekey']);

			if (empty($ekey_info) || $ekey_info['file_id'] != @$_REQUEST['file_id']) {
				return array(CONTROLLER_STATUS_DENIED);
			}

			// Increase downloads for this file
			$max_downloads = db_get_field("SELECT max_downloads FROM ?:product_files WHERE file_id = ?i", $_REQUEST['file_id']);
			$file_downloads = db_get_field("SELECT downloads FROM ?:product_file_ekeys WHERE ekey = ?s AND file_id = ?i", $_REQUEST['ekey'], $_REQUEST['file_id']);

			if (!empty($max_downloads)) {
				if ($file_downloads >= $max_downloads) {
					return array(CONTROLLER_STATUS_DENIED);
				}
			}
			db_query('UPDATE ?:product_file_ekeys SET ?u WHERE file_id = ?i AND product_id = ?i AND order_id = ?i', array('downloads' => $file_downloads + 1), $_REQUEST['file_id'], $ekey_info['product_id'], $ekey_info['order_id']);
		}

		$file = db_get_row("SELECT $field, file_name, product_id FROM ?:product_files LEFT JOIN ?:product_file_descriptions ON ?:product_file_descriptions.file_id = ?:product_files.file_id AND ?:product_file_descriptions.lang_code = ?s WHERE ?:product_files.file_id = ?i", CART_LANGUAGE, $_REQUEST['file_id']);
		if (!empty($file)) {
			fn_get_file(DIR_DOWNLOADS . $file['product_id'] . '/' . $file[$field]);
		}
	}

	return array(CONTROLLER_STATUS_DENIED);

//
// Display list of files for downloadable product
//
} elseif ($mode == 'download') {
	if (!empty($_REQUEST['ekey'])) {

		$ekey_info = fn_get_product_edp_info($_REQUEST['product_id'], $_REQUEST['ekey']);

		if (empty($ekey_info)) {
			return array(CONTROLLER_STATUS_DENIED);
		}

		$product = array(
			'ekey' => $_REQUEST['ekey'],
			'product_id' => $ekey_info['product_id'],
		);

		if (!empty($product['product_id'])) {
			$product['product'] = db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $product['product_id'], CART_LANGUAGE);
			$product['files'] = fn_get_product_files($product['product_id'], false, $ekey_info['order_id']);
		}
	}

	if (!empty($auth['user_id'])) {
		fn_add_breadcrumb(fn_get_lang_var('downloads'), "profiles.downloads");
	}

	fn_add_breadcrumb($product['product'], "products.view?product_id=$product[product_id]");
	fn_add_breadcrumb(fn_get_lang_var('download'));

	if (!empty($product['files'])) {
		$view->assign('product', $product);
	} else {
		return array(CONTROLLER_STATUS_DENIED);
	}
	
} elseif ($mode == 'get_custom_file') {
	$filename = !empty($_REQUEST['filename']) ? $_REQUEST['filename'] : '';
	
	if (!empty($_REQUEST['file']) && !empty($_REQUEST['order_id'])) {
		$file_path = DIR_CUSTOM_FILES . 'order_data/' . $_REQUEST['order_id'] . '/' . fn_basename($_REQUEST['file']);
		
		if (file_exists($file_path)) {
			fn_get_file($file_path, $filename);
		}
		
	} elseif (!empty($_REQUEST['file'])) {
		$file_path = DIR_CUSTOM_FILES . '/sess_data/' . fn_basename($_REQUEST['file']);
		
		if (file_exists($file_path)) {
			fn_get_file($file_path, $filename);
			
		}
	}
}

function fn_reorder($order_id, &$cart, &$auth)
{
	$order_info = fn_get_order_info($order_id, false, false, false, true);
    unset($_SESSION['shipping_hash']);
    unset($_SESSION['edit_step']);

	fn_set_hook('reorder', $order_info, $cart, $auth);

	foreach ($order_info['items'] as $k => $item) {
		// refresh company id
		$company_id = db_get_field("SELECT company_id FROM ?:products WHERE product_id = ?i", $item['product_id']);
		$order_info['items'][$k]['company_id'] = $company_id;
		
		unset($order_info['items'][$k]['extra']['ekey_info']);
		$order_info['items'][$k]['product_options'] = empty($order_info['items'][$k]['extra']['product_options']) ? array() : $order_info['items'][$k]['extra']['product_options'];
		$order_info['items'][$k]['main_pair'] = fn_get_cart_product_icon($item['product_id'], $order_info['items'][$k]);
	}
	
	if (!empty($cart) && !empty($cart['products'])) {
		$cart['products'] = fn_array_merge($cart['products'], $order_info['items']);
	} else {
		$cart['products'] = $order_info['items'];
	}

	foreach ($cart['products'] as $k => $v) {
		$_is_edp = db_get_field("SELECT is_edp FROM ?:products WHERE product_id = ?i", $v['product_id']);
		if ($amount = fn_check_amount_in_stock($v['product_id'], $v['amount'], $v['product_options'], $k, $_is_edp, 0, $cart)) {
			$cart['products'][$k]['amount'] = $amount;
			
			// Change the path of custom files
			if (!empty($v['extra']['custom_files'])) {
				$sess_dir_path = DIR_CUSTOM_FILES . 'sess_data';
				
				foreach ($v['extra']['custom_files'] as $option_id => $_data) {
					if (!empty($_data)) {
						foreach ($_data as $file_id => $file) {
							$cart['products'][$k]['extra']['custom_files'][$option_id][$file_id]['path'] = $sess_dir_path . '/' . fn_basename($file['path']);
						}
					}
				}
			}
		} else {
			unset($cart['products'][$k]);
		}
	}
	
	// Restore custom files for editing
	$dir_path = DIR_CUSTOM_FILES . 'order_data/' . $order_id;
	
	if (is_dir($dir_path)) {
		fn_mkdir(DIR_CUSTOM_FILES . 'sess_data');
		fn_copy($dir_path, DIR_CUSTOM_FILES . 'sess_data');
	}

	// Redirect customer to step three after reordering
	$cart['payment_updated'] = true;

	fn_save_cart_content($cart, $auth['user_id']);
}

function fn_prepare_repay_data($payment_id, $order_info, $auth, &$templater)
{
	if (empty($payment_id)) {
		$payment_id = $order_info['payment_id'];
	}
	
	//Get payment methods
	$payment_methods = fn_get_payment_methods($auth);

	fn_set_hook('prepare_repay_data', $payment_id, $order_info, $auth, $templater, $payment_methods);

	if (!empty($payment_methods)) {
		// Get payment method info
		$payment_groups = fn_prepare_checkout_payment_methods($order_info, $auth);
		if (!empty($payment_id)) {
			$order_payment_id = $payment_id;
		} else {
			$first = reset($payment_methods);
			$order_payment_id = $first['payment_id'];
		}

		$payment_data = fn_get_payment_method_data($order_payment_id);
		$payment_data['surcharge_value'] = 0;

		if (floatval($payment_data['a_surcharge'])) {
			$payment_data['surcharge_value'] += $payment_data['a_surcharge'];
		}

		if (floatval($payment_data['p_surcharge'])) {
			if (PRODUCT_TYPE == 'MULTIVENDOR' && fn_take_payment_surcharge_from_vendor($order_info['items'])) {
				$payment_data['surcharge_value'] += fn_format_price($order_info['total']);
			} else {
				$payment_data['surcharge_value'] += fn_format_price(($order_info['total'] - $order_info['payment_surcharge']) * $payment_data['p_surcharge'] / 100);
			}
		}

		$templater->assign('payment_methods', $payment_groups);
		$templater->assign('credit_cards', fn_get_static_data_section('C', true));
		$templater->assign('order_payment_id', $order_payment_id);
		$templater->assign('payment_method', $payment_data);
	}
}
?>