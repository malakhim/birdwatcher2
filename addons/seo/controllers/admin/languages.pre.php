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

	$condition = fn_get_seo_company_condition('?:seo_names.company_id');     

	// Delete seo names
	if ($mode == 'delete_languages') {
		if (!empty($_REQUEST['lang_codes'])) {
			foreach ((array)$_REQUEST['lang_codes'] as $v) {
				db_query("DELETE FROM ?:seo_names WHERE lang_code = ?s ?p", $v, $condition);
			}
		}
	}

	// Add static seo rules
	if ($mode == 'add_languages') {
		$new_language = $_REQUEST['language'];
		if (!empty($new_language['lang_code']) && !empty($new_language['name'])) {
			$is_exists = db_get_field("SELECT COUNT(*) FROM ?:seo_names WHERE lang_code = ?s ?p", $new_language['lang_code'], $condition);
			if (empty($is_exists)) {
				$global_total = db_get_fields("SELECT dispatch FROM ?:seo_names WHERE object_id = '0' AND type = 's' ?p GROUP BY dispatch", $condition);
				foreach ($global_total as $disp) {
					fn_create_seo_name(0, 's', str_replace('.', '-', $disp), 0, $disp, '', $new_language['lang_code']);
				}
			}
		}
	}
}

// Delete seo names
if ($mode == 'delete_language') {
	$condition = fn_get_seo_company_condition('?:seo_names.company_id');

	if (!empty($_REQUEST['lang_code'])) {
		db_query("DELETE FROM ?:seo_names WHERE lang_code = ?s ?p", $_REQUEST['lang_code'], $condition);
	}
}

?>