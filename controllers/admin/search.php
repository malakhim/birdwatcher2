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


if (!defined('AREA')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	return;
}

if ($mode == 'results') {
	$params = $_REQUEST;
	$params['objects'] = array_keys(fn_search_get_customer_objects());
	$params['short_info'] = true;

	if (!empty($params['compact']) && $params['compact'] = 'Y') {
		list($objects, $search) = fn_search($params, Registry::get('settings.Appearance.products_per_page'));
		$view->assign('found_objects', $objects);
		
		if (count($objects) == 1 && !empty($search['detailed_links'][key($objects)])) {
			list($object, $data) = each($objects);
			if ($data['count'] == 1) {
				fn_redirect(str_replace('%id%', $data['id'], $search['detailed_links'][$object]));
			}
		}
		
		$tabs = array();
		
		foreach ($objects as $object => $data) {
			$tabs['manage_' . $object] = array(
				'title' => $search['titles'][$object] . ' (' . $data['count'] . ')',
				'href' => $search['action_links'][$object],
				'ajax' => true
			);
		}
		
		Registry::set('navigation.tabs', $tabs);
		
	} else {
		list($data, $search, $total) = fn_search($params, Registry::get('settings.Appearance.products_per_page'));

		$view->assign('search_results', $data);
		$view->assign('search_results_count', $total);
	}
	
	$view->assign('search', $search);
	$view->assign('params', $params);
}


?>