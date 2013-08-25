<?php

if (!defined('AREA')) { die('Access denied'); }

if ($mode == 'add'){

	//Redirect to login screen if user is not logged in, and return back afterwards
	if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode($_SERVER['HTTP_REFERER']));
	}

	$prev_cart_products = empty($cart['products']) ? array() : $cart['products'];

	fn_add_product_to_cart($_REQUEST['product_data'], $cart, $auth);
	fn_save_cart_content($cart, $auth['user_id']);

	$previous_state = md5(serialize($cart['products']));
	fn_calculate_cart_content($cart, $auth, 'S', true, 'F', true);

	if (md5(serialize($cart['products'])) != $previous_state && empty($cart['skip_notification'])) {
		$product_cnt = 0;
		$added_products = array();
		foreach ($cart['products'] as $key => $data) {
			if (empty($prev_cart_products[$key]) || !empty($prev_cart_products[$key]) && $prev_cart_products[$key]['amount'] != $data['amount']) {
				$added_products[$key] = $data;
				$added_products[$key]['product_option_data'] = fn_get_selected_product_options_info($data['product_options']);
				if (!empty($prev_cart_products[$key])) {
					$added_products[$key]['amount'] = $data['amount'] - $prev_cart_products[$key]['amount'];
				}
				$product_cnt += $added_products[$key]['amount'];
			}
		}
		if (!empty($added_products)) {
			$view->assign('added_products', $added_products);
			if (Registry::get('settings.DHTML.ajax_add_to_cart') != 'Y' && Registry::get('settings.General.redirect_to_cart') == 'Y') {
				$view->assign('continue_url', (!empty($_REQUEST['redirect_url']) && empty($_REQUEST['appearance']['details_page'])) ? $_REQUEST['redirect_url'] : $_SESSION['continue_url']);
			}
			$msg = $view->display('views/products/components/product_notification.tpl', false);
			fn_set_notification('P', fn_get_lang_var($product_cnt > 1 ? 'products_added_to_cart' : 'product_added_to_cart'), $msg, 'I');
			$cart['recalculate'] = true;
		} else {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('product_in_cart'));
		}
	}
	
	unset($cart['skip_notification']);

	if (defined('AJAX_REQUEST')) {
		// The redirection is made in order to update the page content to see changes made in the cart when adding a product to it from the 'view cart' or 'checkout' pages. 
		if (strpos($_SERVER['HTTP_REFERER'], 'dispatch=checkout.cart') || strpos($_SERVER['HTTP_REFERER'], 'dispatch=checkout.checkout') || strpos($_SERVER['HTTP_REFERER'], 'dispatch=checkout.summary')) {
			$ajax->assign('force_redirection', $_SERVER['HTTP_REFERER']);
		}
	}

	$_suffix = '.cart';
	
	if (Registry::get('settings.DHTML.ajax_add_to_cart') != 'Y' && Registry::get('settings.General.redirect_to_cart') == 'Y') {
		if (!empty($_REQUEST['redirect_url']) && empty($_REQUEST['appearance']['details_page'])) {
			$_SESSION['continue_url'] = fn_query_remove($_REQUEST['redirect_url'], 'is_ajax', 'result_ids', 'full_render');
		}
		unset($_REQUEST['redirect_url']);
	}
}

?>