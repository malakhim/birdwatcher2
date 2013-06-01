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

	if ($mode == 'export_to_iif') {
		header('Content-type: text/csv');
		header('Content-disposition: attachment; filename=orders.iif');

		foreach ($_REQUEST['order_ids'] as $k => $v) {
			$orders[$k] = fn_get_order_info($v);
		}

		$order_users = $order_products = array();
		foreach ($orders as $k => $v) {
			$order_users[$v['user_id'] . '_' . $v['email']] = $v;
			foreach ($v['items'] as $key => $value) {
				$order_products[$value['cart_id']] = $value;
				if (!empty($value['product_options'])) {
					$selected_options = '; ' . fn_get_lang_var('product_options') . ': ';
					foreach ($value['product_options'] as $option) {
						$selected_options .= "$option[option_name]: $option[variant_name];";
					}
					$order_products[$value['cart_id']]['selected_options'] = $selected_options;
				}
			}
		}

		$view->assign('_d', '	');
		$view->assign('orders', $orders, false);
		$view->assign('order_users', $order_users, false);
		$view->assign('order_products', $order_products, false);

		$view->display('addons/quickbooks/views/orders/components/export_to_iif.tpl');
		exit;
	}
}

?>