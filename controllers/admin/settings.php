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


if (!defined('AREA') ) { die('Access denied'); }

$section_id = empty($_REQUEST['section_id']) ? 'General' : $_REQUEST['section_id'];
// Convert section name to section_id
$section = CSettings::instance()->get_section_by_name($section_id);
if (isset($section['section_id'])) {
	$section_id = $section['section_id'];
} else {
	return array(CONTROLLER_STATUS_NO_PAGE);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	fn_trusted_vars('update');
	$_suffix = '';

	if ($mode == 'update') {
		if (isset($_REQUEST['update']) && is_array($_REQUEST['update'])) {
			foreach ($_REQUEST['update'] as $k => $v) {
				CSettings::instance()->update_value_by_id($k, $v);
				
				if (!empty($_REQUEST['update_all_vendors'][$k])) {
					CSettings::instance()->reset_all_vendors_settings($k);
				} 				
			}
		}
		$_suffix = ".manage";
	}

	return array(CONTROLLER_STATUS_OK, "settings{$_suffix}?section_id=" . CSettings::instance()->get_section_text_id($section_id));
}

//
// OUPUT routines
//
if ($mode == 'manage') { 
	$subsections = CSettings::instance()->get_section_tabs($section_id, CART_LANGUAGE);

	$options = CSettings::instance()->get_list($section_id);

	fn_update_lang_objects('subsections', $subsections);

	// [Page sections]
	if (!empty($subsections)) {
		Registry::set('navigation.tabs.main', array (
			'title' => fn_get_lang_var('main'),
			'js' => true
		));
		foreach ($subsections as $k => $v) {
			Registry::set('navigation.tabs.' . $k, array (
				'title' => $v['description'],
				'js' => true
			));
		}
	}
	// [/Page sections]
	
	// Set navigation menu
	$sections = CSettings::instance()->get_core_sections();
	
	fn_update_lang_objects('sections', $sections);

	Registry::set('navigation.dynamic.sections', $sections);
	Registry::set('navigation.dynamic.active_section', CSettings::instance()->get_section_text_id($section_id));

	$view->assign('options', $options);
	$view->assign('subsections', $subsections);
	$view->assign('section_id', CSettings::instance()->get_section_text_id($section_id));
	$view->assign('settings_title', CSettings::instance()->get_section_name($section_id));
}

?>
