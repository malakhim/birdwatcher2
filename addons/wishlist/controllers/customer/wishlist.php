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

$_SESSION['wishlist'] = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : array();
$wishlist = & $_SESSION['wishlist'];
$_SESSION['continue_url'] = isset($_SESSION['continue_url']) ? $_SESSION['continue_url'] : '';
$auth = & $_SESSION['auth'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Add product to the wishlist
	if ($mode == 'add') {
		// wishlist is empty, create it
		if (empty($wishlist)) {
			$wishlist = array(
				'products' => array()
			);
		}

		$prev_wishlist = $wishlist['products'];

		$product_ids = fn_add_product_to_wishlist($_REQUEST['product_data'], $wishlist, $auth);

		fn_save_cart_content($wishlist, $auth['user_id'], 'W');

		$added_products = array_diff_assoc($wishlist['products'], $prev_wishlist);

		if (defined('AJAX_REQUEST')) {
			if (!empty($added_products)) {
				foreach ($added_products as $key => $data) {
					$product = fn_get_product_data($data['product_id'], $auth);
					$product['extra'] = !empty($data['extra']) ? $data['extra'] : array();
					fn_gather_additional_product_data($product, true, true);
					$added_products[$key]['product_option_data'] = fn_get_selected_product_options_info($data['product_options']);
					$added_products[$key]['display_price'] = $product['price'];
					$added_products[$key]['amount'] = empty($data['amount']) ? 1 : $data['amount'];
					$added_products[$key]['main_pair'] = fn_get_cart_product_icon($data['product_id'], $data);
				}
				$view->assign('added_products', $added_products);
				
				if (Registry::get('settings.General.allow_anonymous_shopping') == 'P') {
					$view->assign('hide_amount', true);
				}
				
				$title = fn_get_lang_var('product_added_to_wl');
			} else {
				if ($product_ids) {
					$view->assign('empty_text', fn_get_lang_var('product_in_wishlist'));
					$title = fn_get_lang_var('notice');
				} else {
					exit;
				}
			}
			$view->assign('n_type', 'L');
			$msg = $view->display('views/products/components/product_notification.tpl', false);
			fn_set_notification('L', $title, $msg, 'I');
		}
		unset($_REQUEST['redirect_url']);
	}

	return array(CONTROLLER_STATUS_OK, "wishlist.view");
}

if ($mode == 'clear') {
	$wishlist = array();

	fn_save_cart_content($wishlist, $auth['user_id'], 'W');
	return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");

} elseif ($mode == 'delete' && !empty($_REQUEST['cart_id'])) {
	fn_delete_wishlist_product($wishlist, $_REQUEST['cart_id']);

	fn_save_cart_content($wishlist, $auth['user_id'], 'W');
	return array(CONTROLLER_STATUS_OK, "wishlist.view");

} elseif ($mode == 'view') {

	fn_add_breadcrumb(fn_get_lang_var('wishlist_content'));

	$products = !empty($wishlist['products']) ? $wishlist['products'] : array();
	$extra_products = array();
	
	if (!empty($products)) {
		foreach($products as $k => $v) {
			$_options = array();
			$extra = $v['extra'];
			if (!empty($v['product_options'])) {
				$_options = $v['product_options'];
			}
			$products[$k] = fn_get_product_data($v['product_id'], $auth);
			
			if (empty($products[$k])) {
				unset($products[$k], $wishlist['products'][$k]);
				continue;
			}
			$products[$k]['extra'] = empty($products[$k]['extra']) ? array() : $products[$k]['extra'];
			$products[$k]['extra'] = array_merge($products[$k]['extra'], $extra);
			
			if (isset($products[$k]['extra']['product_options']) || $_options) {
				$products[$k]['selected_options'] = empty($products[$k]['extra']['product_options']) ? $_options : $products[$k]['extra']['product_options'];
			}
			
			if (!empty($products[$k]['selected_options'])) {
				$options = fn_get_selected_product_options($v['product_id'], $v['product_options'], CART_LANGUAGE);
				foreach ($products[$k]['selected_options'] as $option_id => $variant_id) {
					foreach ($options as $option) {
						if ($option['option_id'] == $option_id && !in_array($option['option_type'], array('I', 'T', 'F')) && empty($variant_id)) {
							$products[$k]['changed_option'] = $option_id;
							break 2;
						}
					}
				}
			}
			$products[$k]['display_subtotal'] = $products[$k]['price'] * $v['amount'];
			$products[$k]['display_amount'] = $v['amount'];
			$products[$k]['cart_id'] = $k;
			/*$products[$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $v['product_options'], CART_LANGUAGE);
			$products[$k]['price'] = fn_apply_options_modifiers($v['product_options'], $products[$k]['price'], 'P');*/
			if (!empty($products[$k]['extra']['parent'])) {
				$extra_products[$k] = $products[$k];
				unset($products[$k]);
				continue;
			}
		}
	}
	fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true));

	$view->assign('show_qty', true);
	$view->assign('products', $products);
	$view->assign('extra_products', $extra_products);
	$view->assign('wishlist', $wishlist);
	$view->assign('continue_url', $_SESSION['continue_url']);
	
} elseif ($mode == 'delete_file' && isset($_REQUEST['cart_id'])) {
	if (isset($wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']])) {
		// Delete saved custom file
		$file = $wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']];
		
		@unlink($file['path']);
		@unlink($file['path'] . '_thumb');
		
		unset($wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']]);
		
		if (defined('AJAX_REQUEST')) {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_product_file_has_been_deleted'));
		}
	}

	return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");
}

/**
 * Add product to wishlist
 *
 * @param array $product_data array with data for the product to add)(product_id, price, amount, product_options, is_edp)
 * @param array $wishlist wishlist data storage
 * @param array $auth user session data
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_add_product_to_wishlist($product_data, &$wishlist, &$auth)
{
	// Check if products have cusom images
	list($product_data, $wishlist) = fn_add_product_options_files($product_data, $wishlist, $auth, false, 'wishlist');
	
	fn_set_hook('pre_add_to_wishlist', $product_data, $wishlist, $auth);

	if (!empty($product_data) && is_array($product_data)) {
		$wishlist_ids = array();
		foreach ($product_data as $product_id => $data) {
			if (empty($data['amount'])) {
				$data['amount'] = 1;
			}
			if (!empty($data['product_id'])) {
				$product_id = $data['product_id'];
			}

			if (empty($data['extra'])) {
				$data['extra'] = array();
			}

			// Add one product
			if (!isset($data['product_options'])) {
				$data['product_options'] = fn_get_default_product_options($product_id);
			}

			// Generate wishlist id
			$data['extra']['product_options'] = $data['product_options'];
			$_id = fn_generate_cart_id($product_id, $data['extra']);
			
			$_data = db_get_row('SELECT is_edp, options_type, tracking FROM ?:products WHERE product_id = ?i', $product_id);
			$data['is_edp'] = $_data['is_edp'];
			$data['options_type'] = $_data['options_type'];
			$data['tracking'] = $_data['tracking'];
			
			// Check the sequential options
			if (!empty($data['tracking']) && $data['tracking'] == 'O' && $data['options_type'] == 'S') {
				$inventory_options = db_get_fields("SELECT a.option_id FROM ?:product_options as a LEFT JOIN ?:product_global_option_links as c ON c.option_id = a.option_id WHERE (a.product_id = ?i OR c.product_id = ?i) AND a.status = 'A' AND a.inventory = 'Y'", $product_id, $product_id);
				
				$sequential_completed = true;
				if (!empty($inventory_options)) {
					foreach ($inventory_options as $option_id) {
						if (!isset($data['product_options'][$option_id]) || empty($data['product_options'][$option_id])) {
							$sequential_completed = false;
							break;
						}
					}
				}
				
				if (!$sequential_completed) {
					fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('select_all_product_options'));
					// Even if customer tried to add the product from the catalog page, we will redirect he/she to the detailed product page to give an ability to complete a purchase
					$redirect_url = fn_url('products.view?product_id=' . $product_id . '&combination=' . fn_get_options_combination($data['product_options']));
					$_REQUEST['redirect_url'] = $redirect_url; //FIXME: Very very very BAD style to use the global variables in the functions!!!
					
					return false;
				}
			}
			
			$wishlist_ids[] = $_id;
			$wishlist['products'][$_id]['product_id'] = $product_id;
			$wishlist['products'][$_id]['product_options'] = $data['product_options'];
			$wishlist['products'][$_id]['extra'] = $data['extra'];
			$wishlist['products'][$_id]['amount'] = $data['amount'];	
		}

		return $wishlist_ids;
	} else {
		return false;
	}
}

/**
 * Delete product from the wishlist
 *
 * @param array $wishlist wishlist data storage
 * @param int $wishlist_id ID of the product to delete from wishlist
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_delete_wishlist_product(&$wishlist, $wishlist_id)
{
	fn_set_hook('delete_wishlist_product', $wishlist, $wishlist_id);

	if (!empty($wishlist_id)) {
		unset($wishlist['products'][$wishlist_id]);
	}

	return true;
}
?>
