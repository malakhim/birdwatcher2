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
	$suffix = '';
	fn_trusted_vars('store_locations', 'add_store_location');

	if ($mode == 'update') {

		$store_location_id = fn_update_store_location($_REQUEST['store_location_data'], $_REQUEST['store_location_id'], DESCR_SL);

		$suffix .= '.manage';
	}

	return array (CONTROLLER_STATUS_OK, 'store_locator' . $suffix);
}

if ($mode == 'delete') {
	if (!empty($_REQUEST['store_location_id'])) {
		db_query('DELETE FROM ?:store_locations WHERE store_location_id = ?i', $_REQUEST['store_location_id']);
		db_query('DELETE FROM ?:store_location_descriptions WHERE store_location_id = ?i', $_REQUEST['store_location_id']);

		$count = db_get_field("SELECT COUNT(*) FROM ?:store_locations");
		if (empty($count)) {
			$view->display('addons/store_locator/views/store_locator/manage.tpl');
		}		
	}
	exit;

} elseif ($mode == 'manage') {

	list($store_locations, $search, $total) = fn_get_store_locations($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'), DESCR_SL);

	$view->assign('store_locations', $store_locations);
	$view->assign('search', $search);
}

function fn_update_store_location($store_location_data, $store_location_id, $lang_code = DESCR_SL)
{
	$store_location_data['localization'] = empty($store_location_data['localization']) ? '' : fn_implode_localizations($store_location_data['localization']);	

	if (empty($store_location_id)) {
		if (empty($store_location_data['position'])) {
			$store_location_data['position'] = db_get_field('SELECT MAX(position) FROM ?:store_locations');
			$store_location_data['position'] += 10;
		}

		$store_location_id = db_query('INSERT INTO ?:store_locations ?e', $store_location_data);

		$store_location_data['store_location_id'] = $store_location_id;

		foreach ((array)Registry::get('languages') as $store_location_data['lang_code'] => $v) {
			db_query("INSERT INTO ?:store_location_descriptions ?e", $store_location_data);
		}
	} else {
		db_query('UPDATE ?:store_locations SET ?u WHERE store_location_id = ?i', $store_location_data, $store_location_id);
		db_query('UPDATE ?:store_location_descriptions SET ?u WHERE store_location_id = ?i AND lang_code = ?s', $store_location_data, $store_location_id, $lang_code);
	}

	return $store_location_id;
}

?>