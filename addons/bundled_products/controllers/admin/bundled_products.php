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

	fn_trusted_vars('item_data');
	
	if ($mode == 'update') {

		fn_bundled_products_update_chain($_REQUEST['item_id'], $_REQUEST['product_id'], $_REQUEST['item_data'], $_SESSION['auth'], DESCR_SL);
		
		if (!empty($_REQUEST['product_id']) && !empty($_REQUEST['item_data'])) {

// 			$_params['product_id'] = $_REQUEST['product_id'];
// 			$_params['status'] = 'A';
// 			$_params['full_info'] = true;
// 			$_params['date'] = true;
// 			$chains = fn_bundled_products_get_chains($_params, $_SESSION['auth']);
		
			db_query('UPDATE ?:products SET zero_price_action=?s WHERE product_id=?i', 'P', $_REQUEST['product_id']);
			db_query('UPDATE ?:product_prices SET price=?d WHERE product_id=?i AND lower_limit=?i', 0, $_REQUEST['product_id'], 1);
			db_query('UPDATE ?:products SET tracking=?s WHERE product_id=?i', 'B', $_REQUEST['product_id']);

			if (!empty($_REQUEST['item_data']['products'])) {
				$allowed_amount = 0;
				foreach ($_REQUEST['item_data']['products'] as $k => $v) {
					if (!empty($v['product_id'])) {
						$track = db_get_field('SELECT tracking FROM ?:products WHERE product_id=?i', $v['product_id']);
						if ($track == 'B') {
							$orig_amount = db_get_field('SELECT amount FROM ?:products WHERE product_id=?i', $v['product_id']);
														
							$temp_amount = intval($orig_amount/$v['amount']);
							if (($temp_amount < $allowed_amount) || ($temp_amount !=0 && $allowed_amount == 0)) {
								$allowed_amount = $temp_amount;
							}							
						} 
					}
				}
				db_query('UPDATE ?:products SET amount=?i WHERE product_id=?i', $allowed_amount, $_REQUEST['product_id']);
				
			}
		}

		return array(CONTROLLER_STATUS_OK, "products.update?product_id=" . $_REQUEST['product_id'] . "&selected_section=bundled_products");
	}

	return;
}

if ($mode == 'update') {

	$params = array(
		'chain_id' => $_REQUEST['chain_id'],
		'simple' => true,
		'full_info' => true,
	);
	
	$chain = fn_bundled_products_get_chains($params, array(), DESCR_SL);

	$view->assign('item', $chain);
	
} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['chain_id'])) {
		$product_id = fn_bundled_products_delete_chain($_REQUEST['chain_id']);
		
		return array(CONTROLLER_STATUS_REDIRECT, "products.update?product_id=$product_id&selected_section=bundled_products");
	}
}

?>