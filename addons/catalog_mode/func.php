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

function fn_catalog_mode_enabled($company_id)
{
	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		if (empty($company_id)) {
			return Registry::get('addons.catalog_mode.main_store_mode') == 'catalog' ?  'Y' : 'N';
		} else {
			// check if the current vendor is running in the catalog mode
			static $vendors_cache = array();

			if (isset($vendors_cache[$company_id])) {
				return $vendors_cache[$company_id];
			} else {
				$vendors_cache[$company_id] = db_get_field("SELECT catalog_mode FROM ?:companies WHERE company_id = ?s", $company_id);
				return $vendors_cache[$company_id];
			}
		}
	} elseif (PRODUCT_TYPE == 'ULTIMATE') {
		return Registry::get('addons.catalog_mode.main_store_mode') == 'catalog' ?  'Y' : 'N';
	}

	return 'Y';
}

function fn_catalog_mode_may_disable_minicart()
{
	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		if (Registry::get('addons.catalog_mode.main_store_mode') == 'store' || Registry::get('addons.catalog_mode.add_to_cart_empty_buy_now_url') == 'Y') {
			return 'N';
		}
		if (db_get_field("SELECT COUNT(*) FROM ?:companies WHERE catalog_mode = 'N'")) {
			return 'N';
		}
	} elseif (PRODUCT_TYPE == 'ULTIMATE') {
		if (Registry::get('addons.catalog_mode.main_store_mode') == 'store' || Registry::get('addons.catalog_mode.add_to_cart_empty_buy_now_url') == 'Y') {
			return 'N';
		}
	}

	return Registry::get('addons.catalog_mode.add_to_cart_empty_buy_now_url') == 'Y' ? 'N' : 'Y';
}

function fn_is_add_to_cart_allowed($product_id)
{
	// No need to involve heavy SQL requests performed by fn_get_products()
	if (Registry::get('addons.catalog_mode.add_to_cart_empty_buy_now_url') == 'Y' && db_get_field("SELECT buy_now_url FROM ?:products WHERE product_id = ?i", $product_id) == '') {
		return true;
	}

	return false;
}

function fn_catalog_mode_pre_add_to_cart($product_data, $cart, $auth, $update)
{
	if (AREA == 'C') {
		// Firebug protection
		if (PRODUCT_TYPE == 'MULTIVENDOR' || PRODUCT_TYPE == 'ULTIMATE') {
			foreach ($product_data as $key => &$product) {
				$product_id = (!empty($product['product_id'])) ? $product['product_id'] : $key;
				$company = fn_get_company_by_product_id($product_id);

				if (!isset($company['company_id'])) {
					$company['company_id'] = 0;
				}

				if (fn_catalog_mode_enabled($company['company_id']) == 'Y' && !fn_is_add_to_cart_allowed($product_id)) {
					$product = array();
				}
			}
		} else {
			foreach ($product_data as $key => &$product) {
				$product_id = (!empty($product['product_id'])) ? $product['product_id'] : $key;
				if (!fn_is_add_to_cart_allowed($product_id)) {
					$product = array();
				}
			}
		}
	}
}

function fn_catalog_mode_update_product_post($product_data, $product_id, $lang_code, $create)
{
	if (!empty($product_data['buy_now_url']) && !floatval($product_data['price']) && !empty($product_data['zero_price_action']) && $product_data['zero_price_action'] == 'R') {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_catalog_mode_zero_price_action_notice'));
	}
}
?>