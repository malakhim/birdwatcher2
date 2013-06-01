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
// $Id: products.post.php 8238 2009-11-16 14:30:36Z alexions $

if ( !defined('AREA') ) { die('Access denied'); }

if ($mode == 'view' || $mode == 'options') {

	if (!empty($_REQUEST['cart_id'])) {
		$cart = & $_SESSION['cart'];
		if (isset($cart['products'][$_REQUEST['cart_id']])) {
			$product = $view->get_var('product');
			$product['selected_amount'] = $cart['products'][$_REQUEST['cart_id']]['amount'];
			
			$view->assign('product', $product);
			$view->assign('subscription_object_id', $_REQUEST['cart_id']);
			$view->assign('return_mode', !empty($_REQUEST['return_to']) && $_REQUEST['return_to'] == 'cart' ? 'cart' : 'checkout');
		}
		if (isset($cart['products'][$_REQUEST['cart_id']]['extra']['recurring_duration'])) {
			$extra = $cart['products'][$_REQUEST['cart_id']]['extra'];
			$view->assign('alt_recurring_duration', $extra['recurring_duration']);
			$view->assign('selected_plan_id', $extra['recurring_plan_id']);
		}
	}
}

?>