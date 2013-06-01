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


if ( !defined('AREA') )	{ die('Access denied');	}

fn_define('KEEP_UPLOADED_FILES', true);
fn_define('NEW_FEATURE_GROUP_ID', 'OG');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	fn_trusted_vars ('feature_data');

	// Update features
	if ($mode == 'update') {
		fn_update_product_feature($_REQUEST['feature_data'], $_REQUEST['feature_id'], DESCR_SL);
	}

	return array(CONTROLLER_STATUS_OK, "product_features.manage");
}

if ($mode == 'update') {

	$view->assign('feature', fn_get_product_feature_data($_REQUEST['feature_id'], false, false, DESCR_SL));
	list($group_features) = fn_get_product_features(array('feature_types' => 'G'), 0, DESCR_SL);
	$view->assign('group_features', $group_features);
	


} elseif ($mode == 'delete') {

	if (!empty($_REQUEST['feature_id'])) {


		$feature_type = db_get_field("SELECT feature_type FROM ?:product_features WHERE feature_id = ?i", $_REQUEST['feature_id']);

		fn_delete_feature($_REQUEST['feature_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "product_features.manage");

} elseif ($mode == 'manage') {

	$params = $_REQUEST;
	$params['exclude_group'] = true;
	$params['get_descriptions'] = true;
	list($features, $search, $has_ungroupped) = fn_get_product_features($params, Registry::get('settings.Appearance.admin_elements_per_page'), DESCR_SL);

	$view->assign('features', $features);
	$view->assign('search', $search);
	$view->assign('has_ungroupped', $has_ungroupped);

	if (empty($features) && defined('AJAX_REQUEST')) {
		$ajax->assign('force_redirection', "product_features.manage");
	}

	list($group_features) = fn_get_product_features(array('feature_types' => 'G'), 0, DESCR_SL);
	$view->assign('group_features', $group_features);

} elseif ($mode == 'get_feature_variants_list') {
	if (empty($_REQUEST['feature_id'])) {
		exit;
	}

	$pattern = !empty($_REQUEST['pattern']) ? $_REQUEST['pattern'] : '';
	$start = !empty($_REQUEST['start']) ? $_REQUEST['start'] : 0;
	$limit = (!empty($_REQUEST['limit']) ? $_REQUEST['limit'] : 10) + 1;
	$sorting = db_quote("?:product_feature_variants.position, ?:product_feature_variant_descriptions.variant");

	$join = db_quote(" LEFT JOIN ?:product_feature_variant_descriptions ON ?:product_feature_variant_descriptions.variant_id = ?:product_feature_variants.variant_id AND ?:product_feature_variant_descriptions.lang_code = ?s", DESCR_SL);
	$condition = db_quote(" AND ?:product_feature_variants.feature_id = ?i", $_REQUEST['feature_id']);

	fn_set_hook('get_feature_variants_list', $condition, $join, $pattern, $start, $limit);

	$objects = db_get_hash_array("SELECT SQL_CALC_FOUND_ROWS ?:product_feature_variants.variant_id AS value, ?:product_feature_variant_descriptions.variant AS name FROM ?:product_feature_variants $join WHERE 1 $condition AND ?:product_feature_variant_descriptions.variant LIKE ?l ORDER BY ?p LIMIT ?i, ?i", 'value', '%' . $pattern . '%', $sorting, $start, $limit);

	if (defined('AJAX_REQUEST') && sizeof($objects) < $limit) {
		$ajax->assign('completed', true);
	} else {
		array_pop($objects);
	}
	
	if (!defined("COMPANY_ID") && (empty($_REQUEST['enter_other']) || !empty($_REQUEST['enter_other']) && $_REQUEST['enter_other'] != 'N')) {
		$total = db_get_found_rows();
		if ($start + $limit >= $total + 1) {
			$objects[] = array('value' => 'disable_select', 'name' => '-' . fn_get_lang_var('enter_other') . '-');
		}
	}
	
	if (!$start) {
		array_unshift($objects, array('value' => '', 'name' => '-' . fn_get_lang_var('none') . '-'));
	}

	$view->assign('objects', $objects);

	$view->assign('id', $_REQUEST['result_ids']);
	$view->display('common_templates/ajax_select_object.tpl');
	exit;

} elseif ($mode == 'get_variants') {
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : 1;
	$items_per_page = Registry::get('settings.Appearance.admin_elements_per_page');
	if (!empty($_REQUEST['items_per_page'])) {
		$_SESSION['items_per_page'] = $_REQUEST['items_per_page'] > 0 ? $_REQUEST['items_per_page'] : 1;
	}
	if (!empty($_SESSION['items_per_page'])) {
		$items_per_page = $_SESSION['items_per_page'];
	}
	list($variants, $total) = fn_get_product_feature_variants($_REQUEST['feature_id'], 0, $_REQUEST['feature_type'], true, DESCR_SL, $page, $items_per_page);
	fn_paginate($page, $total, $items_per_page);
	$feature_variants = $variants;
	$view->assign('feature_variants', $feature_variants);
	$view->assign('feature_type', $_REQUEST['feature_type']);
	$view->assign('id', $_REQUEST['feature_id']);
	$view->display('views/product_features/components/variants_list.tpl');
	exit;
} elseif ($mode == 'update_status') {

	fn_tools_update_status($_REQUEST);

	if (!empty($_REQUEST['status']) && $_REQUEST['status'] == 'D') {
		$filter_ids = db_get_fields("SELECT filter_id FROM ?:product_filters WHERE feature_id = ?i AND status = 'A'", $_REQUEST['id']);
		if (!empty($filter_ids)) {
			db_query("UPDATE ?:product_filters SET status = 'D' WHERE filter_id IN (?n)", $filter_ids);
			$filter_names_array = db_get_fields("SELECT filter FROM ?:product_filter_descriptions WHERE filter_id IN (?n) AND lang_code = ?s", $filter_ids, DESCR_SL);

			fn_set_notification('W', fn_get_lang_var('warning'), str_replace(array('[url]', '[filters_list]'), array(fn_url('product_filters.manage'), implode(', ', $filter_names_array)), fn_get_lang_var('text_product_filters_were_disabled')));
		}
	}

	exit;
}

?>