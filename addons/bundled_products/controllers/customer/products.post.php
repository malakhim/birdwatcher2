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


if ($mode == 'view' || $mode == 'quick_view') {
	$is_restricted = false;
	$show_notices = false;
			
	fn_set_hook('bundled_products_restricted_product', $_REQUEST['product_id'], $auth, $is_restricted, $show_notices);
	
	if (!$is_restricted) {
		$params['product_id'] = $_REQUEST['product_id'];
		$params['status'] = 'A';
		$params['full_info'] = true;
		$chains = fn_bundled_products_get_chains($params, $auth);

		if (!empty($chains)) {
			foreach ($chains as $k => $v) {
				foreach ($v['products'] as $product) {
					$check_arr = db_get_row('SELECT tracking, amount FROM ?:products WHERE product_id=?i', $product['product_id']);
					if ($check_arr['tracking'] != 'D' && $check_arr['amount'] < $product['amount']) {
						$chains[$k]['stock'] = 'N';
					}
				}
			}
		}

		$view->assign('chains', $chains);
	}
}

?>