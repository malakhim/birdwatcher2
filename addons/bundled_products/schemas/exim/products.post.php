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

//
// Schema definition
//

$schema['export_fields']['Price'] = array (
	'table' => 'product_prices',
	'db_field' => 'price',
	'convert_put' => array ('fn_exim_import_price', '@price_dec_sign_delimiter'),
	'process_get' => array ('fn_exim_export_price_bundle', '#this', '#key', '@price_dec_sign_delimiter'),
);


function fn_exim_export_price_bundle($price, $product_id, $decimals_separator)
{
	$bundle = db_get_field('SELECT bundle FROM ?:products WHERE product_id=?i', $product_id);
	
	if ($bundle == 'Y') {

			$_params['product_id'] = $product_id;
			$_params['status'] = 'A';
			$_params['full_info'] = true;
			$_params['date'] = true;
			$chains = fn_bundled_products_get_chains($_params, $_SESSION['auth']);
			$price = $chains[0]['chain_price'];

	} 

	if ($decimals_separator == '.') {
		return $price;
	}
	
	return str_replace('.', $decimals_separator, $price);
}

?>
