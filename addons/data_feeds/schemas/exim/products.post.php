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

$schema['export_fields']['Product id'] = array (
	'db_field' => 'product_id',
	'export_only' => true
);

$schema['export_fields']['Sale price'] = array (
	'table' => 'product_prices',
	'db_field' => 'price',
	'process_get' => array('fn_exim_google_export_format_price', '#this', '#key')
);

//
// Apply discounts to product price and format sale_price field
// Parameters:
// @product_price - original product price
// @product_id - current product id
function fn_exim_google_export_format_price($product_price, $product_id = 0)
{
	$auth = fn_fill_auth();
	$product = fn_get_product_data($product_id, $auth, CART_LANGUAGE, true, true, false, false, false);
	fn_promotion_apply('catalog', $product, $auth);

	$_discount = 0;
	if (!empty($product['discount'])) {
		$_discount = $product['discount'];
	}

	return fn_format_price($product_price - $_discount, CART_PRIMARY_CURRENCY, null, false);
}
?>