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

/** Inclusions **/
/** /Inclusions **/

/** Body **/

$section_id = isset($_REQUEST['section_id']) ? intval($_REQUEST['section_id']) : '0';
$link_id = isset($_REQUEST['link_id']) ? intval($_REQUEST['link_id']) : '0';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$suffix = '';

	//
	// Add section links
	//
	if ($mode == 'add_links') {
		if (isset($_REQUEST['add_link_data'])) {
			foreach ($_REQUEST['add_link_data'] as $k => $v) {
				if (!empty($v['link'])) {
					$v['section_id'] = $section_id;
					
					fn_set_hook('sitemap_update_object', $v, $section_id, $mode);
					
					$__sid = db_query("INSERT INTO ?:sitemap_links ?e", $v);

					if (!empty($__sid)) {
						$_data = array(
							'object' => $v['link'],
							'object_id' => $__sid,
							'object_holder' => 'sitemap_links'
						);

						foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
							db_query("INSERT INTO ?:common_descriptions ?e", $_data);
						}
					}
				}
			}
		}

		$suffix = ".update?section_id=$section_id";
	}
	//
	// Update section links
	//
	if ($mode == 'update_links') {
		if (isset($_REQUEST['link_data'])) {
			foreach ($_REQUEST['link_data'] as $k => $v) {
				$v['section_id'] = $section_id;
				
				fn_set_hook('sitemap_update_object', $v, $k, $mode);
				
				db_query("UPDATE ?:sitemap_links SET ?u WHERE link_id = ?i", $v, $k);

				$v['object'] = $v['link'];
				db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND lang_code = ?s AND object_holder = 'sitemap_links'", $v, $k, DESCR_SL);
			}
			unset($_data);
		}

		$suffix = ".update?section_id=$section_id";
	}
	//
	// Delete section links
	//
	if ($mode == 'delete_links') {
		if (!empty($_REQUEST['link_ids'])) {
			fn_delete_sitemap_links($_REQUEST['link_ids']);
		}

		$suffix = ".update?section_id=$section_id";
	}

	//
	// Add sitemap sections
	//
	if ($mode == 'add_sitemap_sections') {
		if (isset($_REQUEST['add_section_data'])) {
			foreach ($_REQUEST['add_section_data'] as $k => $v) {
				if (!empty($v['section'])) {
					
					fn_set_hook('sitemap_update_object', $v, $k, $mode);
					
					$_sid = db_query("INSERT INTO ?:sitemap_sections ?e", $v);
					if (!empty($_sid)) {

						$_data = array(
							'object' => $v['section'],
							'object_id' => $_sid,
							'object_holder' => 'sitemap_sections'
						);

						foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
							db_query("INSERT INTO ?:common_descriptions ?e", $_data);
						}
					}
				}
			}
		}

		$suffix = '.manage';
	}
	//
	// Update sitemap sections
	//
	if ($mode == 'update_sitemap_sections') {
		if (isset($_REQUEST['section_data'])) {
			foreach ($_REQUEST['section_data'] as $k => $v) {
			
				fn_set_hook('sitemap_update_object', $v, $k, $mode);
				
				db_query("UPDATE ?:sitemap_sections SET ?u WHERE section_id = ?i", $v, $k);
				$v['object'] = $v['section'];
				db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND lang_code = ?s AND object_holder = 'sitemap_sections'", $v, $k, DESCR_SL);
			}
			unset($_data);
		}

		$suffix = '.manage';
	}
	//
	// Delete sitemap sections
	//
	if ($mode == 'delete_sitemap_sections') {
		if (!empty($_REQUEST['section_ids'])) {
			fn_delete_sitemap_sections($_REQUEST['section_ids']);
		}
		$suffix = '.manage';
	}

	return array(CONTROLLER_STATUS_OK, "sitemap$suffix");
}

// -------------------------------------- GET requests -------------------------------

// Collect section methods data
if ($mode == 'update') {
	if (empty($_REQUEST['section_id'])) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	$section_fields = array(
		's.*',
		'c.object as section'
	);
	
	$section_tables = array(
		'?:sitemap_sections as s',
	);
	
	$section_left_join = array(
		db_quote('?:common_descriptions as c ON c.object_id = s.section_id AND object_holder = ?s AND lang_code = ?s', 'affiliate_plans', DESCR_SL),
	);
	
	$section_condition = array(
		db_quote('s.section_id = ?i', $_REQUEST['section_id']),
	);

	fn_set_hook('sitemap_get_sections', $section_fields, $section_tables, $section_left_join, $section_condition);

	$section = db_get_row('SELECT ' . implode(', ', $section_fields) . ' FROM ' . implode(', ', $section_tables) . ' LEFT JOIN ' . implode(', ', $section_left_join) . ' WHERE ' . implode(' AND ', $section_condition) . ' ORDER BY position, section');
	
	if (empty($section)) {
		return array(CONTROLLER_STATUS_DENIED);
	}
	
	$view->assign('section', $section);

	$links_fields = array(
		'link_id',
		'link_href',
		'section_id',
		'status',
		'position',
		'link_type',
		'description',
		'object as link',
	);
	
	$links_tables = array(
		'?:sitemap_links',
	);
	
	$links_left_join = array(
		db_quote("?:common_descriptions ON ?:common_descriptions.object_id = ?:sitemap_links.link_id AND ?:common_descriptions.object_holder = 'sitemap_links' AND ?:common_descriptions.lang_code = ?s", DESCR_SL),
	);
	
	$links_condition = array(
		db_quote('section_id = ?i', $section_id),
	);

	fn_set_hook('sitemap_get_links', $links_fields, $links_tables, $links_left_join, $links_condition);

	$links = db_get_array('SELECT ' . implode(', ', $links_fields) . ' FROM ' . implode(', ', $links_tables) . ' LEFT JOIN ' . implode(', ', $links_left_join) . ' WHERE ' . implode(' AND ', $links_condition) . ' ORDER BY position, link');
	$view->assign('links', $links);

	fn_add_breadcrumb(fn_get_lang_var('sitemap'),"sitemap.manage");

// Show all section methods
} elseif ($mode == 'manage') {

	$section_fields = array(
		's.*',
		'c.object as section'
	);
	
	$section_tables = array(
		'?:sitemap_sections as s',
	);
	
	$section_left_join = array(
		db_quote('?:common_descriptions as c ON c.object_id = s.section_id AND c.object_holder = ?s AND c.lang_code = ?s', 'sitemap_sections', DESCR_SL),
	);
	
	$section_condition = array();

	fn_set_hook('sitemap_get_sections', $section_fields, $section_tables, $section_left_join, $section_condition);

	$condition = empty($section_condition) ? '' : ' WHERE ' . implode(' AND ', $section_condition);

	$sections = db_get_array('SELECT ' . implode(', ', $section_fields) . ' FROM ' . implode(', ', $section_tables) . ' LEFT JOIN ' . implode(', ', $section_left_join) . $condition . ' ORDER BY position, section');

	$view->assign('sitemap_sections', $sections);

} elseif ($mode == 'delete_sitemap_section') {
	if (!empty($_REQUEST['section_id'])) {
		fn_delete_sitemap_sections((array)$_REQUEST['section_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "sitemap.manage");

} elseif ($mode == 'delete_link') {
	if (!empty($_REQUEST['link_id'])) {
		fn_delete_sitemap_links((array)$_REQUEST['link_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "sitemap.update?section_id=$section_id");
}

/** /Body **/

function fn_delete_sitemap_links($link_ids)
{
	fn_set_hook('sitemap_delete_links', $link_ids);
	
	if (!empty($link_ids)) {
		db_query("DELETE FROM ?:sitemap_links WHERE link_id IN (?n)", $link_ids);
		db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_links' AND object_id IN (?n)", $link_ids);
	}
}

function fn_delete_sitemap_sections($section_ids)
{
	fn_set_hook('sitemap_delete_sections', $section_ids);
	
	if (!empty($section_ids)) {
		db_query("DELETE FROM ?:sitemap_sections WHERE section_id IN (?n)", $section_ids);
		db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_sections' AND object_id IN (?n)", $section_ids);

		$links = db_get_fields("SELECT link_id FROM ?:sitemap_links WHERE section_id IN (?n)", $section_ids);
		if (!empty($links)) {
			db_query("DELETE FROM ?:sitemap_links WHERE section_id IN (?n)", $section_ids);
			db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_links' AND object_id IN (?n)", $links);
		}
	}
}

?>