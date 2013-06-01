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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$suffix = ".manage";

	if ($mode == 'update') {
		$datafeed_id = fn_data_feeds_update_feed($_REQUEST['datafeed_data'], $_REQUEST['datafeed_id'], DESCR_SL);

		$suffix = ".update?datafeed_id=$datafeed_id";
	
	} elseif ($mode == 'm_update') {
		if (!empty($_REQUEST['datafeed_data'])) {
			foreach ($_REQUEST['datafeed_data'] as $datafeed_id => $data) {
				db_query("UPDATE ?:data_feeds SET ?u WHERE datafeed_id = ?i", $data, $datafeed_id);
				db_query("UPDATE ?:data_feed_descriptions SET ?u WHERE datafeed_id = ?i AND lang_code = ?s", $data, $datafeed_id, DESCR_SL);
			}
		}

		$suffix = ".manage";

	} elseif ($mode == 'm_delete') {
		if (!empty($_REQUEST['datafeed_ids'])) {
			db_query('DELETE FROM ?:data_feeds WHERE datafeed_id IN (?a)', $_REQUEST['datafeed_ids']);
			db_query('DELETE FROM ?:data_feed_descriptions WHERE datafeed_id IN (?a)', $_REQUEST['datafeed_ids']);
		}
		
		$suffix = ".manage";
	}

	return array(CONTROLLER_STATUS_REDIRECT, "data_feeds$suffix");
}

if ($mode == 'manage') {
	$datafeeds = fn_data_feeds_get_data(array(), DESCR_SL);
	$view->assign('datafeeds', $datafeeds);
	$view->assign('cron_password', Registry::get('cron_password'));

} elseif ($mode == 'add') {
	$pattern = fn_get_schema('exim', 'products', 'php', false);
	$view->assign('pattern', $pattern);

	$view->assign('export_fields', $pattern['export_fields']);
	$view->assign('feature_fields', fn_data_feeds_get_features_fields());

	fn_add_breadcrumb(fn_get_lang_var('data_feeds'), "data_feeds.manage");

	// [Page sections]
	Registry::set('navigation.tabs', array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'exported_items' => array (
			'title' => fn_get_lang_var('exported_items'),
			'js' => true
		),
		'fields' => array (
			'title' => fn_get_lang_var('map_fields'),
			'js' => true
		),
	));
	// [/Page sections]

} elseif ($mode == 'update') {
	$params['datafeed_id'] = $_REQUEST['datafeed_id'];
	$params['single'] = true;

	$datafeed_data = fn_data_feeds_get_data($params, DESCR_SL);
	
	$view->assign('datafeed_data', $datafeed_data);

	$pattern = fn_get_schema('exim', 'products', 'php', false);
	$view->assign('pattern', $pattern);

	if (empty($datafeed_data['datafeed_id'])) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	$view->assign('export_fields', $pattern['export_fields']);
	$view->assign('feature_fields', fn_data_feeds_get_features_fields());

	fn_add_breadcrumb(fn_get_lang_var('data_feeds'), "data_feeds.manage");

	// [Page sections]
	Registry::set('navigation.tabs', array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'exported_items' => array (
			'title' => fn_get_lang_var('exported_items'),
			'js' => true
		),
		'fields' => array (
			'title' => fn_get_lang_var('map_fields'),
			'js' => true
		),
	));
	// [/Page sections]
	
} elseif ($mode == 'download') {
	$params['datafeed_id'] = $_REQUEST['datafeed_id'];
	$params['single'] = true;

	$datafeed_data = fn_data_feeds_get_data($params, DESCR_SL);
	$filename = DIR_EXIM . $datafeed_data['file_name'];
	
	if (file_exists($filename)) {
		fn_get_file($filename);
	}
	
	exit();
}

function fn_data_feeds_update_feed($feed_data, $feed_id = 0, $lang_code = CART_LANGUAGE)
{
	if (!empty($feed_data['fields'])) {
		$_fields = array();
		
		foreach ($feed_data['fields'] as $key => $field) {
			if (empty($field['export_field_name'])) {
				unset($feed_data['fields'][$key]);
			} else {
				$_fields[intval($field['position'])][] = $field;
			}
		}
	}
	
	if (!empty($_fields)) {
		ksort($_fields);
		unset($feed_data['fields']);
		
		foreach ($_fields as $fields) {
			if (is_array($fields)) {
				foreach ($fields as $field) {
					$feed_data['fields'][] = $field;
				}
			}
		}
	}
	
	$feed_data['fields'] = serialize($feed_data['fields']);
	$feed_data['export_options'] = serialize(!empty($feed_data['export_options']) ? $feed_data['export_options'] : array());

	if (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID')) {
		$feed_data['company_id'] = COMPANY_ID;
	}

	if (empty($feed_id)) {
		$feed_id = db_query("INSERT INTO ?:data_feeds ?e", $feed_data);
		
		if (!empty($feed_id)) {
			$_data = array();
			$_data['datafeed_id'] = $feed_id;
			$_data['datafeed_name'] = $feed_data['datafeed_name'];
	
			foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
				db_query("INSERT INTO ?:data_feed_descriptions ?e", $_data);
			}
		}
		
	} else {
		db_query("UPDATE ?:data_feeds SET ?u WHERE datafeed_id = ?i", $feed_data, $feed_id);
		unset($feed_data['lang_code']);
		
		db_query("UPDATE ?:data_feed_descriptions SET ?u WHERE datafeed_id = ?i AND lang_code = ?s", $feed_data, $feed_id, $lang_code);
	}

	return $feed_id;
}

?>