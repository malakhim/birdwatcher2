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

define('ORDER_MANAGEMENT', true); // Defines that the cart is in order management mode now

$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cart = & $_SESSION['cart'];

$_SESSION['customer_auth'] = isset($_SESSION['customer_auth']) ? $_SESSION['customer_auth'] : array();
$customer_auth = & $_SESSION['customer_auth'];

$_SESSION['shipping_rates'] = isset($_SESSION['shipping_rates']) ? $_SESSION['shipping_rates'] : array();
$shipping_rates = & $_SESSION['shipping_rates'];

if (empty($customer_auth)) {
	$customer_auth = fn_fill_auth(array(), array(), false, 'C');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Update products quantity in the cart
	$_suffix = '';

	// Add product to the cart
	if ($mode == 'add') {
		// Cart is empty, create it
		if (empty($cart)) {
			fn_clear_cart($cart);
		}

		// Remove products with empty amount
		foreach ($_REQUEST['product_data'] as $k => $v) {
			if (empty($v['amount'])) {
				if ($k != 'custom_files') {
					unset($_REQUEST['product_data'][$k]);
				}
			}
		}

		fn_add_product_to_cart($_REQUEST['product_data'], $_SESSION['cart'], $customer_auth);
		$_suffix = ".products";
	}

	// Delete products from the cart
	if ($mode == 'delete') {
		if (!empty($_REQUEST['cart_ids'])) {
			foreach ($_REQUEST['cart_ids'] as $cart_id) {
				unset($cart['products'][$cart_id]);
			}
		}

		$_suffix = ".products";
	}

	// Select customer
	if ($mode == 'select_customer') {
		if (!empty($_REQUEST['selected_user_id'])) {
			$cart['user_id'] = $_REQUEST['selected_user_id'];
			$u_data = db_get_row("SELECT user_id, tax_exempt, user_type FROM ?:users WHERE user_id = ?i", $cart['user_id']);
			$customer_auth = fn_fill_auth($u_data, array(), false, 'C');
			$cart['user_data'] = array();
		}
		$_suffix = ".customer_info";
	}

	if ($mode == 'update') {
		// Clean up saved shipping rates
		unset($_SESSION['shipping_rates']);
		if (is_array($cart['products'])) {
			$product_data = empty($_REQUEST['cart_products']) ? array() : $_REQUEST['cart_products'];
			
			list($product_data, $cart) = fn_add_product_options_files($product_data, $cart, $customer_auth, true);
			unset($product_data['custom_files']);

			foreach ($product_data as $k => $v) {
				if (!isset($cart['products'][$k]['extra']['exclude_from_calculate'])){
					if (empty($v['extra'])) {
						$v['extra'] = array();
					}

					if ($v['price'] < 0) {
						$v['price'] = 0;
					}

					unset($v['object_id']);

					$amount = fn_normalize_amount($v['amount']);
					$price = fn_get_product_price($v['product_id'], $amount, $customer_auth);

					$v['extra'] = empty($cart['products'][$k]['extra']) ? array() : $cart['products'][$k]['extra'];
					$v['extra']['product_options'] = empty($v['product_options']) ? array() : $v['product_options'];
					$_id = fn_generate_cart_id($v['product_id'], $v['extra']);

					if (!isset($cart['products'][$_id])) { //if combination doesn't exist in the cart
						$cart['products'][$_id] = $v;
						$cart['products'][$_id]['company_id'] = !empty($cart['products'][$k]['company_id']) ? $cart['products'][$k]['company_id'] : 0;
						$_product = $cart['products'][$k];

						fn_define_original_amount($v['product_id'], $_id, $cart['products'][$_id], $_product);

						unset($cart['products'][$k]);

					} elseif ($k != $_id) { // if the combination is exist but differs from the current
						$amount += $cart['products'][$_id]['amount'];
						unset($cart['products'][$k]);
					}

					if (empty($amount)) {
						fn_delete_cart_product($cart, $_id);
						continue;
					} else {
						$cart['products'][$_id]['amount'] = fn_check_amount_in_stock($v['product_id'], $amount, @$v['product_options'], $_id, (!empty($cart['products'][$_id]['is_edp']) && $cart['products'][$_id]['is_edp'] == 'Y' ? 'Y' : 'N'), !empty($cart['products'][$_id]['original_amount']) ? $cart['products'][$_id]['original_amount'] : 0, $cart);
						
						if ($cart['products'][$_id]['amount'] == false && !empty($_product)) {
							$cart['products'][$_id] = $_product;
							unset($_product);
						}
					}
					
					if ($k != $_id) {
						$cart['products'][$_id]['prev_cart_id'] = $k;
						
						// save stored taxes for products
						fn_update_stored_cart_taxes($cart, $k, $_id, true);
						
					} elseif (isset($cart['products'][$_id]['prev_cart_id'])) {
						unset($cart['products'][$_id]['prev_cart_id']);
					}

					if (@$v['stored_price'] == 'Y') {
						$cart['products'][$_id]['price'] = $v['price'];
					}

					if (@$v['stored_discount'] == 'Y') {
						$cart['products'][$_id]['discount'] = $v['discount'];
					}

					$cart['products'][$_id]['stored_discount'] = @$v['stored_discount'];
					$cart['products'][$_id]['stored_price'] = @$v['stored_price'];
				}
			}

		}
		
		if ($action == 'continue') {
			fn_delete_notification('changes_saved');
			$_suffix = '.customer_info';
		} else {
			$_suffix = '.products';
		}
	}

	if ($mode == 'update_totals') {

		// Update shipping

		if (!empty($_REQUEST['shipping_ids'])) {
			fn_checkout_update_shipping($cart, $_REQUEST['shipping_ids']);
		}

		// Update payment
		$cart['payment_id'] = (!empty($_REQUEST['payment_id'])) ? $_REQUEST['payment_id'] : 0;
		
		// Update shipping cost
		$cart['stored_shipping'] = array();
		if (!empty($_REQUEST['stored_shipping'])) {
			foreach ($_REQUEST['stored_shipping'] as $sh_id => $v) {
				if ($v === 'Y') {
					$cart['stored_shipping'][$sh_id] = $_REQUEST['stored_shipping_cost'][$sh_id];
				}
			}
		}

		// Update taxes
		if (!empty($_REQUEST['taxes']) && @$_REQUEST['stored_taxes'] == 'Y') {
			foreach ($_REQUEST['taxes'] as $id => $rate) {
				$cart['taxes'][$id]['rate_value'] = $rate;
			}
		}
		$cart['stored_taxes'] = @$_REQUEST['stored_taxes'];


		if (!empty($_REQUEST['stored_subtotal_discount']) && $_REQUEST['stored_subtotal_discount'] == 'Y') {
			$cart['subtotal_discount'] = $_REQUEST['subtotal_discount'];
		} else {
			$cart['subtotal_discount'] = !empty($cart['original_subtotal_discount']) ? $cart['original_subtotal_discount'] : 0;
		}

		// Apply coupon
		if (!empty($_REQUEST['coupon_code'])) {
			fn_trusted_vars('coupon_code');
			$cart['pending_coupon'] = $_REQUEST['coupon_code'];
		}

		if ($action == 'continue') {
			fn_delete_notification('changes_saved');
			$_suffix = '.summary';
		} else {
			$_suffix = '.totals';
		}
		
	}

	if ($mode == 'customer_info') {

		$profile_fields = fn_get_profile_fields('O', $customer_auth);
		// Clean up saved shipping rates
		unset($_SESSION['shipping_rates']);
		if (is_array($_REQUEST['user_data'])) {

			// Fill shipping info with billing if needed
			if (empty($_REQUEST['ship_to_another'])) {
				fn_fill_address($_REQUEST['user_data'], $profile_fields, true);
			}
			// Add descriptions for titles, countries and states
			fn_add_user_data_descriptions($_REQUEST['user_data']);
			$cart['user_data'] = $_REQUEST['user_data'];
			$cart['ship_to_another'] = !empty($_REQUEST['ship_to_another']);

			if (empty($cart['order_id']) && (Registry::get('settings.General.disable_anonymous_checkout') == 'Y' && !empty($_REQUEST['user_data']['password1']))) {
				$cart['profile_registration_attempt'] = true;



				list($user_id, $profile_id) = fn_update_user(0, $cart['user_data'], $customer_auth, !empty($_REQUEST['ship_to_another']), true);

				$cart['profile_id'] = $profile_id;

				if (empty($user_id)) {
					$action = '';
				}
			}
		}

		$_suffix = ($action == 'continue') ? ".totals" : ".customer_info";
	}

	if ($mode == 'place_order') {

		// Clean up saved shipping rates
		unset($_SESSION['shipping_rates']);

		$cart['notes'] = !empty($_REQUEST['customer_notes']) ? $_REQUEST['customer_notes'] : '';
		$cart['payment_info'] = $payment_info = !empty($_REQUEST['payment_info']) ? $_REQUEST['payment_info'] : array();
		
		list($order_id, $process_payment) = fn_place_order($cart, $customer_auth, $action);
		if (!empty($order_id)) {
			if ($action != 'save') {
				$view->assign('order_action', fn_get_lang_var('placing_order'));
				$view->display('views/orders/components/placing_order.tpl');
				fn_flush();
			}

			if ($process_payment == true) {
				fn_start_payment($order_id, fn_get_notification_rules($_REQUEST), $payment_info);
			}

			fn_order_placement_routines($order_id, fn_get_notification_rules($_REQUEST), true, $action);

		} else {
			return array(CONTROLLER_STATUS_REDIRECT, "order_management.summary");
		}
	}

	return array(CONTROLLER_STATUS_OK, "order_management$_suffix");
}

// Delete discount coupon
if ($mode == 'delete_coupon') {
	unset($cart['coupons'][$_REQUEST['c_id']], $cart['pending_coupon']);

	return array(CONTROLLER_STATUS_REDIRECT, "order_management.totals");
}

//
// Edit order
//
if ($mode == 'edit' && !empty($_REQUEST['order_id'])) {

	fn_clear_cart($cart, true);
	$customer_auth = fn_fill_auth(array(), array(), false, 'C');

	$cart_status = md5(serialize($cart));
	fn_form_cart($_REQUEST['order_id'], $cart, $customer_auth);
	
	if ($cart_status == md5(serialize($cart))) {
		// Order info was not found or customer does not have enought permissions
		return array(CONTROLLER_STATUS_DENIED, '');
	}
	$cart['order_id'] = $_REQUEST['order_id'];

	return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");

//
// Create new order
//
} elseif ($mode == 'new') {

	fn_clear_cart($cart, true);
	$customer_auth = fn_fill_auth(array(), array(), false, 'C');

	return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");

//
// Step 1: Products
//
} elseif ($mode == 'products') {

	list ($cart_products, $shipping_rates) = fn_calculate_cart_content($cart, $customer_auth, 'E', false, 'F', false);
	
	if (PRODUCT_TYPE == 'MULTIVENDOR' && !empty($cart['order_id'])) {
		$order_info = fn_get_order_info($cart['order_id']);
		if (isset($order_info['company_id'])) {
			$view->assign('order_company_id', $order_info['company_id']);
		}
	}

	fn_gather_additional_products_data($cart_products, array('get_icon' => false, 'get_detailed' => false, 'get_options' => true, 'get_discounts' => false));

	$view->assign('cart_products', $cart_products);

//
// Step 2: Customer information
//
} elseif ($mode == 'customer_info') {

	if (fn_cart_is_empty($cart)) {
		fn_set_notification('W', fn_get_lang_var('cart_is_empty'),  fn_get_lang_var('cannot_proccess_checkout'));
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");
	}

	$profile_fields = fn_get_profile_fields('O', $customer_auth);

	$cart['profile_id'] = empty($cart['profile_id']) ? 0 : $cart['profile_id'];
	$view->assign('profile_fields', $profile_fields);

	// Clean up saved shipping rates
	unset($_SESSION['shipping_rates']);
	//Get user profiles
	$user_profiles = fn_get_user_profiles($customer_auth['user_id']);
	$view->assign('user_profiles', $user_profiles);

	//Get countries and states
	$view->assign('countries', fn_get_countries(CART_LANGUAGE, true));
	$view->assign('states', fn_get_all_states());
	$view->assign('usergroups', fn_get_usergroups('C', DESCR_SL));

	if (!empty($customer_auth['user_id']) && (empty($cart['user_data']) || (!empty($_REQUEST['profile_id']) && $cart['profile_id'] != $_REQUEST['profile_id']))) {
		$cart['profile_id'] = !empty($_REQUEST['profile_id']) ? $_REQUEST['profile_id'] : 0;
		$cart['user_data'] = fn_get_user_info($customer_auth['user_id'], true, $cart['profile_id']);
	}

	if (!empty($cart['user_data'])) {
		$cart['ship_to_another'] = fn_check_shipping_billing($cart['user_data'], $profile_fields);
	}

	$view->assign('titles', fn_get_static_data_section('T'));

//
// Step 3: Shipping and payment methods
//
} elseif ($mode == 'totals') {

	if (fn_cart_is_empty($cart)) {
		fn_set_notification('N', fn_get_lang_var('cart_is_empty'),  fn_get_lang_var('cannot_proccess_checkout'));
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");
	}

	if (empty($cart['user_data'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.customer_info");
	}

	// Get saved shipping rates
	if (!empty($shipping_rates)) {
		define('CACHED_SHIPPING_RATES', true);
	} else {
		$cart['calculate_shipping'] = true;
	}


	list ($cart_products, $shipping_rates) = fn_calculate_cart_content($cart, $customer_auth, 'A', true, 'I');
	fn_gather_additional_products_data($cart_products, array('get_icon' => false, 'get_detailed' => false, 'get_options' => true, 'get_discounts' => false));
	
	$view->assign('shipping_rates', $shipping_rates);

	//Get payment methods
	$payment_methods = fn_get_payment_methods($customer_auth);

	if (empty($payment_methods)) {
		fn_set_notification('N', fn_get_lang_var('notice'),  fn_get_lang_var('cannot_proccess_checkout_without_payment_methods'));
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.customer_info");
	}

	// Check if payment method has surcharge rates
	foreach ($payment_methods as $k => $v) {
		if (!isset($cart['payment_id'])) {
			$cart['payment_id'] = $v['payment_id'];
		}
		$payment_methods[$k]['surcharge_value'] = 0;
		if (floatval($v['a_surcharge'])) {
			$payment_methods[$k]['surcharge_value'] += $v['a_surcharge'];
		}
		if (floatval($v['p_surcharge'])) {
			$payment_methods[$k]['surcharge_value'] += fn_format_price($cart['total'] * $v['p_surcharge'] / 100);
		}
	}
	fn_update_payment_surcharge($cart, $auth);
	if (!empty($cart['payment_surcharge'])) {
		$payment_methods[$cart['payment_id']]['surcharge_value'] = $cart['payment_surcharge'];
	}

	$view->assign('payment_methods', $payment_methods);
	$view->assign('cart_products', $cart_products);

//
// Step 4: Summary
//
} elseif ($mode == 'summary') {

	if (fn_cart_is_empty($cart)) {
		fn_set_notification('N', fn_get_lang_var('cart_is_empty'),  fn_get_lang_var('cannot_proccess_checkout'));
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");
	}

	if (empty($cart['user_data'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "order_management.customer_info");
	}

	$profile_fields = fn_get_profile_fields('O', $customer_auth);

	//Get payment methods
	if (!empty($cart['payment_id'])) {
		$payment_data = fn_get_payment_method_data($cart['payment_id']);
		$view->assign('payment_method', $payment_data);
		$view->assign('credit_cards', fn_get_static_data_section('C', true, 'credit_card'));
	}

	fn_calculate_cart_content($cart, $customer_auth, 'A', true, 'I');
	fn_update_payment_surcharge($cart, $auth);

//
// Delete product from the cart
//
} elseif ($mode == 'delete' && isset($_REQUEST['cart_id'])) {

	unset($cart['products'][$_REQUEST['cart_id']]);

	return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");
	
} elseif ($mode == 'get_custom_file' && isset($_REQUEST['cart_id']) && isset($_REQUEST['option_id']) && isset($_REQUEST['file'])) {
	if (isset($cart['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']])) {
		$file = $cart['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']];
		
		fn_get_file($file['path'], $file['name']);
	}

} elseif ($mode == 'delete_file' && isset($_REQUEST['cart_id'])) {

	if (isset($cart['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']])) {
		// Delete saved custom file
		$file = $cart['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']];
		
		@unlink($file['path']);
		@unlink($file['path'] . '_thumb');
		
		unset($cart['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']]);
	}
	
	fn_save_cart_content($cart, $customer_auth['user_id']);

	$cart['recalculate'] = true;

	return array(CONTROLLER_STATUS_REDIRECT, "order_management.products");
}

if (!empty($profile_fields)) {
	$view->assign('profile_fields', $profile_fields);
}

$view->assign('cart', $cart);
$view->assign('customer_auth', $customer_auth);

?>