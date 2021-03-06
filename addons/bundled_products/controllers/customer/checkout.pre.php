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

if ($mode == 'place_order') {
	$cart = &$_SESSION['cart'];
	$auth = &$_SESSION['auth'];
	
	// Check for the valid combinations
	if (fn_bundled_products_calculate_cart_items($cart, $cart['products'], $auth) == false) {
		return array(CONTROLLER_STATUS_REDIRECT, "checkout.cart");
	}
}

?>