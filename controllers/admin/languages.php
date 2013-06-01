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

	fn_trusted_vars("lang_data", "new_lang_data");

	//
	// Update language variables
	//
	if ($mode == 'm_update_variables') {
		if (is_array($_REQUEST['lang_data'])) {
			fn_update_lang_var($_REQUEST['lang_data']);
		}
	}

	//
	// Delete language variables
	//
	if ($mode == 'm_delete_variables') {
		if (!empty($_REQUEST['names'])) {
			fn_delete_language_variables($_REQUEST['names']);
		}
	}

	//
	// Add new language variable
	//
	if ($mode == 'update_variables') {
		if (!empty($_REQUEST['new_lang_data'])) {
			$params = array('clear' => false);
			foreach ((array)Registry::get('languages') as $lc => $_v) {
				fn_update_lang_var($_REQUEST['new_lang_data'], $lc, $params);
			}
		}
	}
	

	//
	// Update languages
	//
	if ($mode == 'm_update') {

		if (!defined('COMPANY_ID')) {
			if (!empty($_REQUEST['update_language'])) {
				foreach ($_REQUEST['update_language'] as $lang_code => $data) {
					fn_update_language($data, $lang_code);
				}
			}

			fn_save_languages_integrity();
		}
	}

	//
	// Delete languages
	//
	if ($mode == 'm_delete') {

		if (!empty($_REQUEST['lang_codes'])) {
			fn_delete_languages($_REQUEST['lang_codes']);
		}
	}

	//
	// Create/update language
	//
	if ($mode == 'update') {

		$lc = false;
		if (!defined('COMPANY_ID')) {
			$lc = fn_update_language($_REQUEST['language_data'], $_REQUEST['lang_code']);

			if ($lc !== false) {
				fn_save_languages_integrity();
			}
		}

		if ($lc == false) {
			fn_delete_notification('changes_saved');
		}
	}
	
	$q = (empty($_REQUEST['q'])) ? '' : $_REQUEST['q'];

	return array(CONTROLLER_STATUS_OK, "languages.manage?q=$q");
}

//
// Get language variables values
//
if ($mode == 'manage') {

	$params = $_REQUEST;
	
	$fields = array(
		'lang.value' => true,
		'lang.name' => true,
	);
	
	$tables = array(
		'?:language_values lang',
	);
	
	$left_join = array();
	
	$condition = array();
	
	if (isset($_REQUEST['q']) && fn_string_not_empty($_REQUEST['q'])) {
		$condition[] = db_quote('lang.lang_code = ?s', DESCR_SL);
		$condition[] = db_quote('(lang.name LIKE ?l OR lang.value LIKE ?l)', '%' . trim($_REQUEST['q']) . '%', '%' . trim($_REQUEST['q']) . '%');
	} else {
		$condition[] = db_quote('lang.lang_code = ?s', DESCR_SL);
	}

	fn_set_hook('get_lang_var', $fields, $tables, $left_join, $condition, $params);

	$joins = !empty($left_join) ? ' LEFT JOIN ' . implode(', ', $left_join) : '';

	$page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
	
	$lang_data_count = db_get_field('SELECT COUNT(*) FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition));
	$limit = fn_paginate($page, $lang_data_count, Registry::get('settings.Appearance.admin_elements_per_page'));
	$lang_data = db_get_array('SELECT ' . implode(', ', array_keys($fields)) . ' FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition) . ' ORDER BY lang.name ' . $limit);
	
	Registry::set('navigation.tabs', array (
		'translations' => array (
			'title' => fn_get_lang_var('translations'),
			'js' => true
		),
		'languages' => array (
			'title' => fn_get_lang_var('languages'),
			'js' => true
		),
	));
	
	$view->assign('lang_data', $lang_data);
	$view->assign('langs', Registry::get('languages'));

} elseif ($mode == 'delete_variable') {
	
	fn_set_hook('delete_language_variable', $_REQUEST['name']);
	
	if (!empty($_REQUEST['name'])) {
		db_query("DELETE FROM ?:language_values WHERE name = ?s", $_REQUEST['name']);
	}

	$page = (!empty($_REQUEST['page_id'])) ? '&page=' . $_REQUEST['page_id'] : '';
	$redirect_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'languages.manage';
	
	return array(CONTROLLER_STATUS_REDIRECT, $redirect_url . $page);


//
// Delete languages
//
} elseif ($mode == 'delete_language') {

	if (!empty($_REQUEST['lang_code'])) {
		fn_delete_languages($_REQUEST['lang_code']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "languages.manage?selected_section=languages");


} elseif ($mode == 'update') {
	$lang_data = Registry::get('languages.' . $_REQUEST['lang_code']);
	
	$view->assign('lang_data', $lang_data);
} elseif ($mode == 'update_status') {
	fn_tools_update_status($_REQUEST);
	fn_save_languages_integrity();
	exit;
}

/**
 * Updates language
 *
 * @param array $language_data Language data
 * @param string $lang_code 2-letters language code
 * return string 2-letters language code
 */
function fn_update_language($language_data, $lang_code)
{
	/**
	 * Changes language data before update
	 *
	 * @param array $language_data Language data
	 * @param string $lang_code 2-letters language code
	 */
	fn_set_hook('update_language_pre', $language_data, $lang_code);

	$action = false;

	if (empty($lang_code) || $lang_code != $language_data['lang_code']) {
		$is_exists = db_get_field("SELECT COUNT(*) FROM ?:languages WHERE lang_code = ?s", $language_data['lang_code']);
	}

	if (!empty($is_exists)) {
		fn_set_notification('E', fn_get_lang_var('error'), str_replace('[code]', $language_data['lang_code'], fn_get_lang_var('error_lang_code_exists')));

	} elseif (empty($lang_code)) {
		if (!empty($language_data['lang_code']) && !empty($language_data['name'])) {
			db_query("INSERT INTO ?:languages ?e", $language_data);
			$lang_code = $language_data['lang_code'];
			$clone_from =  !empty($language_data['from_lang_code']) ? $language_data['from_lang_code'] : CART_LANGUAGE;

			fn_clone_language($lang_code, $clone_from);

			$action = 'add';
		}

	} else {
		db_query("UPDATE ?:languages SET ?u WHERE lang_code = ?s", $language_data, $lang_code);

		$action = 'update';
	}

	/**
	 * Adds additional actions after language update
	 *
	 * @param array $language_data Language data
	 * @param string $lang_code 2-letters language code
	 * @param string $action Current action ('add', 'update' or bool false if failed to update language)
	 */
	fn_set_hook('update_language_post', $language_data, $lang_code, $action);

	return $lang_code;

}

/**
 * Deletes language variablle
 *
 * @param array $names List of language variables go be deleted
 * @return boolean Always true
 */
function fn_delete_language_variables($names)
{
	fn_set_hook('delete_language_variables', $names);
	
	if (!empty($names)) {
		db_query("DELETE FROM ?:language_values WHERE name IN (?a)", $names);
	}

	return true;
}

?>