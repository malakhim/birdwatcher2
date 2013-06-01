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

// Ajax content
if ($mode == 'get_companies_list') {
	
	$params = $_REQUEST;
	$condition = '';
	$pattern = !empty($params['pattern']) ? $params['pattern'] : '';
	$start = !empty($params['start']) ? $params['start'] : 0;
	$limit = (!empty($params['limit']) ? $params['limit'] : 10) + 1;
	
	if (AREA == 'C') {
		$condition = " AND status = 'A' ";
	}
	
	if (isset($params['exclude_company_id'])) {
		$condition .= db_quote(' AND ?:companies.company_id != ?i', intval($params['exclude_company_id']));
	}
	
	fn_set_hook('get_companies_list', $condition, $pattern, $start, $limit, $params);
	
	$objects = db_get_hash_array("SELECT company_id as value, company AS name, CONCAT('s_company=', company_id) as append FROM ?:companies WHERE 1 $condition AND company LIKE ?l ORDER BY company LIMIT ?i, ?i", 'value', $pattern . '%', $start, $limit);

	if (defined('AJAX_REQUEST') && sizeof($objects) < $limit) {
		$ajax->assign('completed', true);
	} else {
		array_pop($objects);
	}

	if (empty($params['start']) && empty($params['pattern'])) {
		$all_vendors = array();
		
		
		if (PRODUCT_TYPE != "ULTIMATE" && (!isset($params['exclude_company_id']) || isset($params['exclude_company_id']) && $params['exclude_company_id'] != '0')) {
			$all_vendors['0'] = array(
				'name' => Registry::get('settings.Company.company_name') . ' (' . fn_get_lang_var('default') . ')',
				'value' => '0',
				'extra_class' => 'default-company'
			);
		}
		
		
		if (!empty($params['show_all']) && $params['show_all'] == 'Y') {
			$all_vendors['all'] = array(
				'name' => empty($params['default_label']) ? fn_get_lang_var('all_vendors') : fn_get_lang_var($params['default_label']),
				'value' => (!empty($params['search']) && $params['search'] == 'Y') ? '' : 'all',
			);

		}
		
		$objects = $all_vendors + $objects;
	}
	
	if (defined('AJAX_REQUEST') && !empty($params['action'])) {
		$ajax->assign('action', $params['action']);
	}	

	if (!empty($params['onclick'])) {
		$view->assign('onclick', $params['onclick']);
	}
	$view->assign('objects', $objects);
	$view->assign('id', $params['result_ids']);
	$view->display('common_templates/ajax_select_object.tpl');
	exit;
}

?>