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


function fn_pro_get_product_filter_fields(&$fields)
{
	if (Registry::get('settings.Suppliers.enable_suppliers') == 'Y') {
		$fields['S'] = array (
			'db_field' => 'company_id',
			'table' => 'products',
			'description' => 'supplier',
			'condition_type' => 'F',
			'range_name' => 'company',
			'foreign_table' => 'companies',
			'foreign_index' => 'company_id'
		);
	}
}

function fn_pro_get_filter_range_name_post($range_name, $range_type, $range_id)
{
	if ($range_type == 'S') {
		$range_name = db_get_field("SELECT company FROM ?:companies WHERE company_id = ?i AND lang_code = ?s", $range_id, CART_LANGUAGE);
	}
}

function fn_pro_update_shipping($data, $shipping_id, $lang_code)
{
	if (Registry::get('settings.Suppliers.enable_suppliers') == 'Y') {
		if (!empty($data['company_id'])) {
			// Remove shipping from "available shippings list" of other companies
			$shipping_list = db_get_array('SELECT company_id, shippings FROM ?:companies WHERE FIND_IN_SET(?i, shippings)', $shipping_id);
			
			if (!empty($shipping_list)) {
				foreach ($shipping_list as $shipping_data) {
					if ($data['company_id'] == $shipping_data['company_id']) {
						continue;
					}
					
					$list = explode(',', $shipping_data['shippings']);
					$key = array_search($shipping_id, $list);
					
					unset($list[$key]);

					$list = implode(',', $list);

					db_query('UPDATE ?:companies SET shippings = ?s WHERE company_id = ?i', $list, $shipping_data['company_id']);
				}
			}
		}
	}
}


?>