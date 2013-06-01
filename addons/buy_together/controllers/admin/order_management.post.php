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

$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$cart = & $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($mode == 'update') {
		if (!empty($cart['products'])) {
			foreach ($cart['products'] as $_id => $product) {
				if (!empty($product['extra']['buy_together']) && !empty($product['prev_cart_id']) && $product['prev_cart_id'] != $_id) {
					foreach ($cart['products'] as $aux_id => $aux_product) {
						if (!empty($aux_product['extra']['parent']['buy_together']) && $aux_product['extra']['parent']['buy_together'] == $product['prev_cart_id']) {
							$cart['products'][$aux_id]['extra']['parent']['buy_together'] = $_id;
							$cart['products'][$aux_id]['update_c_id'] = true;
						}
					}
				}
			}
			
			foreach ($cart['products'] as $upd_id => $upd_product) {
				if (!empty($upd_product['update_c_id']) && $upd_product['update_c_id'] == true) {
					$new_id = fn_generate_cart_id($upd_product['product_id'], $upd_product['extra'], false);
					
					if (!isset($cart['products'][$new_id])) {
						unset($upd_product['update_c_id']);
						$cart['products'][$new_id] = $upd_product;
						unset($cart['products'][$upd_id]);
						
						// update taxes
						fn_update_stored_cart_taxes($cart, $upd_id, $new_id, false);
					}
				}
			}
		}
	}
}

?>