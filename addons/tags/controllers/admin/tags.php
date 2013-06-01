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

if ($_SERVER['REQUEST_METHOD']	== 'POST') {

	if ($mode == 'approve') {
		db_query("UPDATE ?:tags SET status = 'A' WHERE tag_id IN (?n)", $_REQUEST['tag_ids']);
	}
	
	if ($mode == 'disapprove') {
		db_query("UPDATE ?:tags SET status = 'D' WHERE tag_id IN (?n)", $_REQUEST['tag_ids']);
	}
	
	if ($mode == 'delete') {
		fn_delete_tags_by_ids($_REQUEST['tag_ids']);
	}
	
	if ($mode == 'm_update') {
		foreach ($_REQUEST['tags_data'] as $tag_id => $tag) {
			fn_update_tag($tag, $tag_id);
		}
	}
	
	if ($mode == 'update') {
		$tag_id = fn_update_tag($_REQUEST['tag_data'], $_REQUEST['tag_id']);
	}	
	
	return array(CONTROLLER_STATUS_OK, "tags.manage");
}

if ($mode == 'manage') {
	$params = $_REQUEST;
	$params['count_objects'] = true;
	list($tags, $search) = fn_get_tags($params, Registry::get('settings.Appearance.admin_elements_per_page'));

	$view->assign('tags', $tags);
	$view->assign('search', $search);
	$view->assign('tag_objects', fn_get_tag_objects());
	
// ajax autocomplete mode	
} elseif ($mode == 'list') {
	if (defined('AJAX_REQUEST')) {
		$tags = db_get_fields("SELECT tag FROM ?:tags WHERE tag LIKE ?l ?p", $_REQUEST['q'] . '%', fn_get_tags_company_condition('?:tags.company_id'));
		Registry::get('ajax')->assign('autocomplete', $tags);	
		
		exit();	
	}

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['tag_id'])) {
		fn_delete_tags_by_ids((array)$_REQUEST['tag_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "tags.manage");
}

function fn_delete_tags_by_ids($tag_ids)
{
	db_query("DELETE FROM ?:tags WHERE tag_id IN (?n)", $tag_ids);
	db_query("DELETE FROM ?:tag_links WHERE tag_id IN (?n)", $tag_ids);
}

function fn_get_tag_objects()
{
	$types = array();

	if (Registry::get('addons.tags.tags_for_products') == 'Y') {
		$types['P'] = array(
			'name' => 'products',
			'url' => 'products.manage',
		);
	}
	if (Registry::get('addons.tags.tags_for_pages') == 'Y') {
		$types['A'] = array(
			'name' => 'pages',
			'url' => 'pages.manage',
		);
	}

	fn_set_hook('get_tag_objects', $types);

	return $types;
}

function fn_update_tag($tag_data, $tag_id = 0)
{
	// check if such tag is exists
	$existing_id = db_get_field("SELECT tag_id FROM ?:tags WHERE tag = ?s ?p", $tag_data['tag'], fn_get_tags_company_condition('?:tags.company_id'));

	// Update tag
	if (!empty($tag_id)) {
		if (empty($existing_id) || $tag_id == $existing_id) {
			$update_id = $tag_id;
		} else {
			$update_id = $existing_id;
			db_query("DELETE FROM ?:tags WHERE tag_id = ?i ?p", $tag_id, fn_get_tags_company_condition('?:tags.company_id'));
		}

		db_query("UPDATE ?:tags SET ?u WHERE tag_id = ?i ?p", $tag_data, $update_id, fn_get_tags_company_condition('?:tags.company_id'));

		$tag_id = $update_id;
	
	// New tag
	} elseif (empty($existing_id)) {
		if (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID') && empty($tag_data['company_id'])) {
			$tag_data['company_id'] = COMPANY_ID;
		}
		$tag_data['timestamp'] = TIME;
		$tag_id = db_query("INSERT INTO ?:tags ?e", $tag_data);

	// New tag, but tag with same name exists 
	} else {
		db_query("UPDATE ?:tags SET status = ?s WHERE tag_id = ?i ?p", $tag_data['status'], $existing_id, fn_get_tags_company_condition('?:tags.company_id'));

		$tag_id = $existing_id;
	}

	return $tag_id;
}

 
?>