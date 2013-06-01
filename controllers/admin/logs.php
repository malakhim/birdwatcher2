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

if ($mode == 'clean') {
	db_query("TRUNCATE TABLE ?:logs");

	return array (CONTROLLER_STATUS_REDIRECT, "logs.manage");
}

if ($mode == 'manage') {

	list($logs, $search, $total) = fn_get_logs($_REQUEST);

	$view->assign('logs', $logs);
	$view->assign('search', $search);
	$view->assign('log_types', fn_get_log_types());
	$view->assign('total', $total);
}

function fn_get_logs($params, $items_per_page = null)
{
	// Init filter
	$params = fn_init_view('logs', $params);

	if ($items_per_page === null) {
		$items_per_page = Registry::get('settings.Appearance.admin_elements_per_page');
	}

	$sortings = array (
		'timestamp' => array ('?:logs.timestamp', '?:logs.log_id'),
		'user' => array ('?:users.lastname', '?:users.firstname'),
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	$fields = array (
		'?:logs.*',
		'?:users.firstname',
		'?:users.lastname'
	);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'asc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'timestamp';
		$params['sort_order'] = 'desc';
	}

	$params['page'] = empty($params['page']) ? 1 : $params['page'];

	if (is_array($sortings[$params['sort_by']])) {
		$sorting = join(' ' . $directions[$params['sort_order']] . ', ', $sortings[$params['sort_by']]) . ' ' . $directions[$params['sort_order']];
	} else {
		$sorting = $sortings[$params['sort_by']] . ' ' . $directions[$params['sort_order']];
	}

	$join = "LEFT JOIN ?:users USING(user_id)";

	$condition = '';

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($time_from, $time_to) = fn_create_periods($params);

		$condition .= db_quote(" AND (?:logs.timestamp >= ?i AND ?:logs.timestamp <= ?i)", $time_from, $time_to);
	}

	if (isset($params['q_user']) && fn_string_not_empty($params['q_user'])) {
		$condition .= db_quote(" AND (?:users.lastname LIKE ?l OR ?:users.firstname LIKE ?l)", "%".trim($params['q_user'])."%", "%".trim($params['q_user'])."%");
	}

	if (!empty($params['q_type'])) {
		$condition .= db_quote(" AND ?:logs.type = ?s", $params['q_type']);
	}

	if (!empty($params['q_action'])) {
		$condition .= db_quote(" AND ?:logs.action = ?s", $params['q_action']);
	}

	fn_set_hook('admin_get_logs', $params, $condition, $join, $sorting, $items_per_page);

	$limit = '';
	$total = 0;
	if (!empty($items_per_page)) {
		$total = db_get_field("SELECT COUNT(DISTINCT(?:logs.log_id)) FROM ?:logs ?p WHERE 1 ?p", $join, $condition);
		$limit = fn_paginate($params['page'], $total, $items_per_page);
	}

	$data = db_get_array("SELECT " . join(', ', $fields) . " FROM ?:logs ?p WHERE 1 ?p ORDER BY $sorting $limit", $join, $condition);

	if (!$total) {
		$total = count($data);
	}

	foreach ($data as $k => $v) {
		$data[$k]['backtrace'] = !empty($v['backtrace']) ? unserialize($v['backtrace']) : array();
		$data[$k]['content'] = !empty($v['content']) ? unserialize($v['content']) : array();
	}

	return array ($data, $params, $total);
}

function fn_get_log_types()
{
	$section = CSettings::instance()->get_section_by_name('Logging');

	$settings = CSettings::instance()->get_list($section['section_id']);

	foreach ($settings['main'] as $setting_id => $setting_data) {
		$types[$setting_data['name']]['type'] = str_replace('log_type_', '', $setting_data['name']);
		$types[$setting_data['name']]['description'] = $setting_data['description'];
		$types[$setting_data['name']]['actions'] = $setting_data['variants'];
	}
       
	return $types;
}

?>