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
// $Id: order_management.post.php 7688 2009-07-10 05:58:05Z zeke $
//

if ( !defined('AREA') )	{ die('Access denied');	}

$cart = & $_SESSION['cart'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update') {
		if (is_array($cart['products'])) {
			$product_data = $_REQUEST['cart_products'];

			foreach ($product_data as $k => $v) {
				if (isset($cart['products'][$k]['extra']['recurring_plan_id'])){
					$cart['products'][$k]['extra']['recurring_force_calculate'] = true;
				}
			}
		}
	}

	return;
}

?>