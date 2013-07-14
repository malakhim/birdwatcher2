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


if (!defined('AREA') ) { die('Access denied'); }

if ($mode == 'list') {
// 	$params['status'] = 'A';
// 	$params['date'] = true;
// 	$params['full_info'] = true;
// 	$params['promotions'] = true;
// 	
// 	$chains = fn_bundled_products_get_chains($params, $auth);
// 	
// 	
// 	if (!empty($chains)) {
// 		foreach ($chains as $k => $v) {
// 			$products[$v['product_id']] = fn_get_product_data($v['product_id'], $auth);
// 		}
// 
// 		$promotions = $view->get_var('promotions');
// 		$promotions['chains'] = $products;
// 		$view->assign('promotions', $promotions);
// 	}

}

?>