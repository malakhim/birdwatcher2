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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($mode == 'update') {
		if ($_REQUEST['product_data']['bundle'] == 'Y') {
			db_query('UPDATE ?:products SET zero_price_action=?s WHERE product_id=?i', 'P', $_REQUEST['product_id']);
			db_query('UPDATE ?:products SET tracking=?s WHERE product_id=?i', 'B', $_REQUEST['product_id']);
			db_query('UPDATE ?:product_prices SET price=?i WHERE product_id=?i AND lower_limit=?i', 0, $_REQUEST['product_id'], 1);
			db_query('DELETE FROM ?:product_prices WHERE product_id=?i AND lower_limit <> ?i', $_REQUEST['product_id'], 1);
		}
	}

}


if ($mode == 'update') {
	$is_restricted = false;
	$show_notice = false;
	
	fn_set_hook('bundled_products_restricted_product', $_REQUEST['product_id'], $auth, $is_restricted, $show_notice);

	$product_data = $view->get_var('product_data');

	if (!$is_restricted && $product_data['bundle'] == 'Y') {
		Registry::set('navigation.tabs.bundled_products', array (
			'title' => fn_get_lang_var('bundled_products'),
			'js' => true
		));
		
		$params = array(
			'product_id' => $_REQUEST['product_id'],
		);
		
		$chains = fn_bundled_products_get_chains($params, array(), DESCR_SL);
	
		$view->assign('chains', $chains);
	}
}

?>
