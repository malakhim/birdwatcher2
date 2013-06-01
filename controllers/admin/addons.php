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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	fn_trusted_vars (
		'addon_data'
	);

	if ($mode == 'update') {
		if (isset($_REQUEST['addon_data'])) {
			fn_update_addon($_REQUEST['addon_data']);
		}
	}

	return array(CONTROLLER_STATUS_OK, "addons.manage");
}

if ($mode == 'update') {
	$addon_name = addslashes($_REQUEST['addon']);

	$section = CSettings::instance()->get_section_by_name($_REQUEST['addon'], CSettings::ADDON_SECTION);
	if (!empty($section)) {
		$subsections = CSettings::instance()->get_section_tabs($section['section_id'], CART_LANGUAGE);
		$options = CSettings::instance()->get_list($section['section_id']);

		fn_update_lang_objects('sections', $subsections);
		fn_update_lang_objects('options', $options);

		$view->assign('options', $options);
		$view->assign('subsections', $subsections);

		$addon =  db_get_row(
			'SELECT a.addon, a.status, b.name as name, b.description as description, a.separate '
			. 'FROM ?:addons as a LEFT JOIN ?:addon_descriptions as b ON b.addon = a.addon AND b.lang_code= ?s WHERE a.addon=?s'
			. 'ORDER BY b.name ASC',
			CART_LANGUAGE, $_REQUEST['addon']
		);                  

		if ($addon['separate'] == true || !defined('AJAX_REQUEST')) {
			$view->assign('separate', true);
			$view->assign('addon_name', $addon['name']);
			$view->assign('breadcrumbs', array(array('link' => 'addons.manage', 'title' =>fn_get_lang_var('addons')) ));
		}
	} else {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

} elseif ($mode == 'install') {

	fn_install_addon($_REQUEST['addon']);
	return array(CONTROLLER_STATUS_OK, "addons.manage#addon_" . $_REQUEST['addon']);

} elseif ($mode == 'uninstall') {

	fn_uninstall_addon($_REQUEST['addon']);

	return array(CONTROLLER_STATUS_OK, "addons.manage");


} elseif ($mode == 'update_status') {

	if (($res = fn_update_addon_status($_REQUEST['id'], $_REQUEST['status'])) !== true) {
		$ajax->assign('return_status', $res);
	}

	exit;

} elseif ($mode == 'manage') {

	$all_addons = fn_get_dir_contents(DIR_ADDONS, true, false);

	$installed_addons = db_get_hash_array(
		'SELECT a.addon, a.status, b.name as name, b.description as description, a.separate '
		. 'FROM ?:addons as a LEFT JOIN ?:addon_descriptions as b ON b.addon = a.addon AND b.lang_code= ?s'
		. 'ORDER BY b.name ASC',
		'addon', CART_LANGUAGE
	);

	$addons_list = array();
              
	$sections =  CSettings::instance()->get_addons();

	foreach ($installed_addons as $key=>$addon) {
		$installed_addons[$key]['has_options'] = CSettings::instance()->section_exists($sections, $addon['addon']);
	}	

	foreach ($all_addons as $addon) {
		if (!empty($installed_addons[$addon])) {
			$addons_list[$addon] = $installed_addons[$addon];

			fn_update_lang_objects('installed_addon', $addons_list[$addon]);

			// Generate custom description
			$func = 'fn_addon_dynamic_description_' . $addon;
			if (function_exists($func)) {
				$addons_list[$addon]['description'] = $func($addons_list[$addon]['description']);
			}

		} elseif (!defined('COMPANY_ID')) { // Display only installed addons for vendors
			$addon_scheme = Addons_SchemesManager::get_scheme($addon);
			if ($addon_scheme != false){
				$addons_list[$addon] = array(
					'status' => 'N', // Because it's not installed
					'name' => $addon_scheme->get_name(),
					'js_functions' => $addon_scheme->get_js_functions(),
					'description' => $addon_scheme->get_description()
				);
			}
		}
	}

	$view->assign('addons_list', fn_sort_array_by_key($addons_list, 'name', SORT_ASC));
}
?>
