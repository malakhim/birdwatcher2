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

function fn_vendor_data_premoderation_get_products($params, $fields, $sortings, $condition, $join, $sorting, $group_by, $lang_code)
{
	$sortings['approval'] = 'products.approved';
	
	if (AREA == 'A') {
		if (isset($params['vendor']) && $params['vendor'] != 'all') {
			$condition .= db_quote(' AND products.company_id = ?i', $params['vendor']);
		}
		
		if (!empty($params['approval_status']) && $params['approval_status'] != 'all') {
			$condition .= db_quote(' AND products.approved = ?s', $params['approval_status']);
		}
	} else {
		
		$products_prior_approval = Registry::get('addons.vendor_data_premoderation.products_prior_approval');
		$products_updates_approval = Registry::get('addons.vendor_data_premoderation.products_updates_approval');

		if ($products_prior_approval == 'all' || $products_updates_approval == 'all') {
			$condition .= db_quote(' AND products.approved = ?s', 'Y');
		} elseif ($products_prior_approval == 'custom' || $products_updates_approval == 'custom') {
			$condition .= " AND IF (companies.pre_moderation = 'Y' || companies.pre_moderation_edit = 'Y', products.approved = 'Y', 1) ";
		}
	}
}

function fn_vendor_data_premoderation_get_product_data($product_id, &$field_list, &$join)
{
	if (AREA == 'A') {
		$field_list .= ', companies.pre_moderation as company_pre_moderation';
		$field_list .= ', companies.pre_moderation_edit as company_pre_moderation_edit';
		if (strpos($join, '?:companies') === false) {
			$join .= ' LEFT JOIN ?:companies as companies ON companies.company_id = ?:products.company_id';
		}
	}
}

function fn_vendor_data_premoderation_get_product_data_post($product_data, $auth, $preview)
{
	if (AREA == 'C' && !$preview && isset($product_data['approved']) && $product_data['approved'] != 'Y') {
		$product_data = array();
	}
}

function fn_vendor_data_premoderation_import_pre_moderation($pattern, $import_data, $options, $processed_data)
{
	if (defined('COMPANY_ID') && !empty($import_data)) {
		$company_data = Registry::get('s_companies.' . COMPANY_ID);
		$products_prior_approval = Registry::get('addons.vendor_data_premoderation.products_prior_approval');
		if ($products_prior_approval == 'all' || ($products_prior_approval == 'custom' && $company_data['pre_moderation'] == 'Y')) {
			foreach ($import_data as $id => &$data) {
				$data['approved'] = 'P';
			}
		}
	}
}

function fn_vendor_data_premoderation_update_company_pre(&$company_data, $company_id, $lang_code)
{
	if (PRODUCT_TYPE == 'MULTIVENDOR' && defined('COMPANY_ID')) {
		
		$orig_company_data = fn_get_company_data($company_id, $lang_code);
		$vendor_profile_updates_approval = Registry::get('addons.vendor_data_premoderation.vendor_profile_updates_approval');
		
		if ($orig_company_data['status'] == 'A' && ($vendor_profile_updates_approval == 'all' || ($vendor_profile_updates_approval == 'custom' && !empty($orig_company_data['pre_moderation_edit_vendors']) && $orig_company_data['pre_moderation_edit_vendors'] == 'Y'))) {
	
			$logotypes = fn_filter_uploaded_data('logotypes');			

			// comparison of logo alts
			$new_alts = array();
			$areas = fn_companies_get_manifest_definition();
			foreach ($_REQUEST['logo_alt'] as $area => $alt) {
				$new_alts[$areas[$area]['name']] = $alt;
			}
			$old_alts = db_get_hash_single_array("SELECT description, object_holder FROM ?:common_descriptions WHERE object_id = ?i AND lang_code = ?s", array('object_holder', 'description'), $company_id, CART_LANGUAGE);
			
			// check that some data is changed
			if (array_diff_assoc($company_data, $orig_company_data) || !empty($logotypes) || array_diff_assoc($new_alts, $old_alts)) {
				$company_data['status'] = 'P';
			}
		}
	}
}

function fn_vendor_data_premoderation_set_admin_notification($auth)
{
	if ($auth['company_id'] == 0 && fn_check_permissions('premoderation', 'products_approval', 'admin')) {
		$count = db_get_field('SELECT COUNT(*) FROM ?:products WHERE approved = ?s', 'P');

		if ($count > 0) {
			$msg = fn_get_lang_var('text_not_approved_products');
			$msg = str_replace(array('[', ']') , array('<a href="' . fn_url('premoderation.products_approval?approval_status=P') . '">', '</a>'), $msg);
			fn_set_notification('W', fn_get_lang_var('notice'), $msg, 'K');
		}
	}
}

function fn_vendor_data_premoderation_get_filters_products_count_query_params($values_fields, $join, $sliders_join, $feature_ids, &$where, $sliders_where, $filter_vq, $filter_rq)
{
	$where .= db_quote(" AND ?:products.approved = ?s", 'Y');
}

function fn_change_approval_status($p_ids, $status)
{
	if (is_array($p_ids)) {
		db_query('UPDATE ?:products SET approved = ?s WHERE product_id IN (?a)', $status, $p_ids);
	} else {
		db_query('UPDATE ?:products SET approved = ?s WHERE product_id = ?i', $status, $p_ids);
	}
	
	return true;
}

?>