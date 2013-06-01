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

@ignore_user_abort(1);
@set_time_limit(0);
if ($mode == 'async') {

	if (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID')) {
		$q = db_get_row("SELECT * FROM ?:se_queue WHERE company_id = ?i ORDER BY queue_id ASC LIMIT 1", COMPANY_ID);
	} else if (PRODUCT_TYPE != 'ULTIMATE') {
		$q = db_get_row("SELECT * FROM ?:se_queue WHERE 1 ORDER BY queue_id ASC LIMIT 1");
	}

	fn_echo('.');

	$xml_header = fn_se_get_xml_header();
	$xml_footer = fn_se_get_xml_footer();

	while (!empty($q)) {
		$xml = '';
		$status = true;
		$company_id = $q['company_id'];
		$lang_code  = $q['lang_code'];
		$data = unserialize($q['data']);
		$private_key = fn_se_get_private_key($company_id, $lang_code);

		if (empty($private_key)) {
			db_query("DELETE FROM ?:se_queue WHERE queue_id = ?i", $q['queue_id']);
			$q = array();
			continue;
		}

		//Note: $q['started'] can be in future.
		if ($q['status'] == 'processing' && ($q['started'] + SE_MAX_PROCESSING_TIME > TIME)) {
			die('PROCESSING');
		}

		if ($q['error_count'] >= SE_MAX_ERROR_COUNT) {
			fn_se_set_import_status('sync_error', $company_id, $lang_code);
			die('DISABLED');
		}
		
		// Set queue to processing state
		db_query("UPDATE ?:se_queue SET `status` = 'processing', `started` = ?s WHERE queue_id = ?i", TIME, $q['queue_id']);

		if ($q['action'] == 'prepare_full_import') {

			db_query("DELETE FROM ?:se_queue WHERE action != 'prepare_full_import' AND company_id = ?i AND lang_code = ?s", $company_id, $lang_code);

			db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES ('N;', 'start_full_import', '{$company_id}', '{$lang_code}')");

			$i = 0;
			$step = SE_PRODUCTS_PER_PASS * 50;

			$sqls_arr = array();

			$min_max = db_get_row('SELECT MIN(`product_id`) as min, MAX(`product_id`) as max FROM ?:products');

			$start = (int)$min_max['min'];
			$max   = (int)$min_max['max'];

			do {
				$end = $start + $step;

				$_product_ids = db_get_fields('SELECT product_id FROM ?:products WHERE product_id >= ?i AND product_id <= ?i LIMIT ?i', $start, $end, $step);

				$start = $end + 1;

				if (empty($_product_ids)) {
					continue;
				}
				$_product_ids = array_chunk($_product_ids, SE_PRODUCTS_PER_PASS);

				foreach($_product_ids as $product_ids) {
					$sqls_arr[] = "('" . serialize($product_ids) . "', 'update', '{$company_id}', '{$lang_code}')";
				}

				if (count($sqls_arr) >= 30) {
					db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES " . join(',', $sqls_arr));
					fn_echo('.');
					$sqls_arr = array();
				}

			} while ($end <= $max);

			if (count($sqls_arr) > 0) {
				db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES " . join(',', $sqls_arr));
			}

			fn_echo('.');
			
			//
			// reSend all active filters
			//

			if (PRODUCT_TYPE != 'COMMUNITY') {
				db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES ('N;', 'facet_delete_all', '{$company_id}', '{$lang_code}')");

				list($filters, ) = fn_get_product_filters(array('get_descriptions' => false, 'get_variants' => false, 'status' => 'A'));

				if (!empty($filters)) {

					foreach ($filters as $filter) {
						$filter_ids[] = $filter['filter_id'];
					}

					db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES ('" . serialize($filter_ids) . "', 'facet_update', '{$company_id}', '{$lang_code}')");
				}
			}

			db_query("INSERT INTO ?:se_queue (`data`, `action`, `company_id`, `lang_code`) VALUES ('N;', 'end_full_import', '{$company_id}', '{$lang_code}')");

			$status = true;

		} elseif ($q['action'] == 'start_full_import') {

			$status = fn_se_send_request('/api/state/update', $private_key, array('full_import' => 'start'));

			if ($status == true) {
				fn_se_set_import_status('processing', $company_id, $lang_code);
			}

		} elseif ($q['action'] == 'end_full_import') {

			$status = fn_se_send_request('/api/state/update', $private_key, array('full_import' => 'done'));

			if ($status == true) {
				fn_se_set_import_status('sent', $company_id, $lang_code);
				fn_se_set_simple_setting('last_resync', TIME);
			}

		} elseif ($q['action'] == 'facet_delete_all') {
			
			$status = fn_se_send_request('/api/facets/delete', $private_key, array('all' => true));
			
		} elseif ($q['action'] == 'facet_update') {

			list($filters, ) = fn_get_product_filters(array('filter_id' => $data, 'get_variants' => true));

			foreach ($filters as $filter) {
				$xml .= fn_se_generate_facet_xml($filter);
			}

			if (!empty($xml)) {
				$status = fn_se_send_request('/api/facets/update', $private_key, array('data' => $xml_header . $xml . $xml_footer));
			}

		} elseif ($q['action'] == 'facet_delete') {

			foreach($data as $facet_attribute) {
				$status = fn_se_send_request('/api/facets/delete', $private_key, array('attribute' => $facet_attribute));

				fn_echo('.');

				if ($status == false) {
					break;
				}
			}

		} elseif ($q['action'] == 'update') {

			list($products) = fn_get_products(array(
				'disable_searchanise' => true,
				'area'    => 'A',
				'sort_by' => 'null',
				'pid'     => $data,
				'extend'  => array('description', 'search_words', 'popularity', 'sales'),
			), 0, $lang_code);

			fn_echo('.');

			if (!empty($products)) {
				foreach ($products as &$_product) {
					$_product['exclude_from_calculate'] = true;//pass additional params to fn_gather_additional_products_data for some speed up
				}

				fn_gather_additional_products_data($products, array('get_features' => false, 'get_icon' => true, 'get_detailed' => true, 'get_options'=> false, 'get_discounts' => false, 'get_taxed_prices' => false));

				fn_echo('.');

				if (PRODUCT_TYPE != 'COMMUNITY') {
					$usergroups = empty($usergroups) ? array_merge(fn_get_default_usergroups(), db_get_hash_array("SELECT a.usergroup_id, a.status, a.type FROM ?:usergroups as a WHERE a.type = 'C' ORDER BY a.usergroup_id", 'usergroup_id')) : $usergroups;
				} else {
					$usergroups = array();
				}

				fn_se_get_products_additionals($products, $company_id, $lang_code);

				fn_se_get_products_features($products, $company_id, $lang_code);

				foreach ($products as $product) {
					$xml .= fn_se_generate_product_xml($product, $usergroups, $lang_code);
				}

				if (!empty($xml)) {
					if (function_exists('gzcompress')) {
						$data = gzcompress($xml_header . $xml . $xml_footer, 5);
					} else {
						$data = $xml_header . $xml . $xml_footer;
					}
					$status = fn_se_send_request('/api/items/update', $private_key, array('data' => $data));
				}
			}

		} elseif ($q['action'] == 'delete') {

			foreach ($data as $product_id) {
				$status = fn_se_send_request('/api/items/delete', $private_key, array('id' => $product_id));

				fn_echo('.');

				if ($status == false) {
					break;
				}
			}

		} elseif ($q['action'] == 'delete_all') {

			$status = fn_se_send_request('/api/items/delete', $private_key, array('all' => true));

		} elseif ($q['action'] == 'phrase') {

			foreach ($data as $phrase) {
				$status = fn_se_send_request('/api/phrases/update', $private_key, array('phrase' => $phrase));

				fn_echo('.');

				if ($status == false) {
					break;
				}
			}
		}

		// Change queue item status
		if ($status == true) {
			db_query("DELETE FROM ?:se_queue WHERE queue_id = ?i", $q['queue_id']);// Done, cleanup queue

			if (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID')) {
				$q = db_get_row("SELECT * FROM ?:se_queue WHERE company_id = ?i AND queue_id > ?i ORDER BY queue_id ASC LIMIT 1", COMPANY_ID, $q['queue_id']);
			} else {
				$q = db_get_row("SELECT * FROM ?:se_queue WHERE 1 AND queue_id > ?i ORDER BY queue_id ASC LIMIT 1", $q['queue_id']);
			}

		} else {
			$next_started_time = (TIME - SE_MAX_PROCESSING_TIME) + $q['error_count'] * 60;

			db_query("UPDATE ?:se_queue SET status = 'processing', error_count = error_count + 1, started = ?s WHERE queue_id = ?i", $next_started_time, $q['queue_id']);

			break; //try later
		}
		fn_echo('.');
	}

	die('OK');
}

if ($mode == 'info') {
	$company_id = fn_se_get_company_id();
	$engines_data = fn_se_get_engines_data($company_id, NULL);

	if (empty($_REQUEST['parent_private_key']) || fn_se_get_parent_private_key($company_id, DEFAULT_LANGUAGE) !== $_REQUEST['parent_private_key']) {
		foreach ($engines_data as $e) {
			$options[$e['company_id']][$e['lang_code']] = $e['api_key'];
		}
	} else {
		$options = $engines_data;
	}

	if (isset($_REQUEST['output'])) {
		echo fn_to_json($options);
	} else {
		fn_print_r($options);
	}

	die();
}

function fn_se_get_products_features(&$products, $company_id, $lang_code)
{
	$product_ids = fn_se_get_products_ids($products);

	$features_data = db_get_array("SELECT v.feature_id, v.value, v.value_int, v.variant_id, f.feature_type, vd.variant, v.product_id FROM ?:product_features_values as v LEFT JOIN ?:product_features as f ON f.feature_id = v.feature_id LEFT JOIN ?:product_feature_variants fv ON fv.variant_id = v.variant_id LEFT JOIN ?:product_feature_variant_descriptions as vd ON vd.variant_id = fv.variant_id AND vd.lang_code = ?s WHERE v.product_id IN (?n) AND (v.variant_id != 0 OR (f.feature_type != 'C' AND v.value != '') OR (f.feature_type = 'C') OR v.value_int != '') AND v.lang_code = ?s", $lang_code, $product_ids, $lang_code);

	if (!empty($features_data)) {
		foreach($features_data as $_data) {
			$product_id = $_data['product_id'];
			$feature_id = $_data['feature_id'];
			
			if (empty($products_features[$product_id][$feature_id])) {
				$products_features[$product_id][$feature_id] = $_data;
			}
				
			if (!empty($_data['variant_id'])) { // feature has several variants
				$products_features[$product_id][$feature_id]['variants'][$_data['variant_id']] = $_data;
			}
		}

		foreach($products as &$product) {
			$product['product_features'] = isset($products_features[$product['product_id']]) ? $products_features[$product['product_id']] : array();
		}
	}
}

function fn_se_get_products_additionals(&$products, $company_id, $lang_code)
{
	$product_ids = fn_se_get_products_ids($products);

	if (PRODUCT_TYPE == 'ULTIMATE') {
		$shared_prices = db_get_hash_multi_array('SELECT product_id, (IF(percentage_discount = 0, price, price - (price * percentage_discount)/100)) as price, usergroup_id FROM ?:ult_product_prices WHERE company_id = ?i AND product_id IN (?n) AND lower_limit = 1', array('product_id', 'usergroup_id'), $company_id, $product_ids);
		$prices = db_get_hash_multi_array('SELECT product_id, (IF(percentage_discount = 0, price, price - (price * percentage_discount)/100)) as price, usergroup_id FROM ?:product_prices WHERE product_id IN (?n) AND lower_limit = 1', array('product_id', 'usergroup_id'), $product_ids);
		$product_categories = db_get_hash_multi_array("SELECT pc.product_id, c.category_id, c.usergroup_ids, c.status FROM ?:categories AS c LEFT JOIN ?:products_categories AS pc ON c.category_id = pc.category_id WHERE c.company_id = ?i AND product_id IN (?n) AND c.status IN ('A', 'H')", array('product_id', 'category_id'), $company_id, $product_ids);
	} else {
		$prices = db_get_hash_multi_array('SELECT product_id, (IF(percentage_discount = 0, price, price - (price * percentage_discount)/100)) as price, usergroup_id FROM ?:product_prices WHERE product_id IN (?n) AND lower_limit = 1', array('product_id', 'usergroup_id'), $product_ids);
		$product_categories = db_get_hash_multi_array("SELECT pc.product_id, c.category_id, c.usergroup_ids, c.status FROM ?:categories AS c LEFT JOIN ?:products_categories AS pc ON c.category_id = pc.category_id WHERE product_id IN (?n) AND c.status IN ('A', 'H')", array('product_id', 'category_id'), $product_ids);
	}

	foreach ($products as &$product) {
		$product_id = $product['product_id'];

		if (isset($shared_prices[$product_id])) {
			$product['se_prices'] = $shared_prices[$product_id];
		} else if (isset($prices[$product_id])) {
			$product['se_prices'] = $prices[$product_id];
		} else {
			$product['se_prices'] = array('0' => array('price' => 0));
		}

		$product['category_ids'] = array();
		$product['category_usergroup_ids'] = array();

		if (!empty($product_categories[$product_id])) {
			foreach ($product_categories[$product_id] as $pc) {
				$product['category_ids'][] = $pc['category_id'];
				$product['category_usergroup_ids'] = array_merge($product['category_usergroup_ids'], explode(',', $pc['usergroup_ids']));
			}
		}

		$product['empty_categories'] = (empty($product['category_ids'])) ? 'Y' : 'N';
	}
}

function fn_se_generate_product_xml($product_data, $usergroups, $lang_code)
{
	$types_map = array(
		'D' => 'int',  // timestamp  (others -> date)
		'M' => 'text', // multicheckbox with enter other input
		'S' => 'text', // select text with enter other input
		'N' => 'float',  // select number with enter other input
		'E' => 'text', // extended
		'C' => 'text', // single checkbox (not avilable for filter)
		'T' => 'text', // input  (others -> text) (not avilable for filterering)
		'O' => 'float',  // input for number (others -> number)
	);

	$entry = '<entry>'."\n";
	$entry .= '<id>' . $product_data['product_id'] . '</id>'."\n";
	$entry .= '<title><![CDATA[' . $product_data['product'] . ']]></title>'."\n";
	$entry .= '<summary><![CDATA[' . (!empty($product_data['short_description']) ? $product_data['short_description'] : $product_data['full_description']) . ']]></summary>'."\n";
	$entry .= '<link href="' . fn_url('products.view?product_id=' . $product_data['product_id'], 'C', 'http', '&amp;', $lang_code) . '" />'."\n";
	$entry .= '<cs:price>' . fn_format_price($product_data['price']) . '</cs:price>'."\n";
	$entry .= '<cs:quantity>' . $product_data['amount'] . '</cs:quantity>'."\n";
	$entry .= '<cs:product_code><![CDATA[' . $product_data['product_code'] . "]]></cs:product_code>\n";//  Product_code

	if (!empty($product_data['main_pair']['icon']['http_image_path'])) {
		$image_link =  'http://' . Registry::get('config.http_host') . $product_data['main_pair']['icon']['http_image_path'];

	} elseif (!empty($product_data['main_pair']['detailed']['http_image_path'])) {
		$image_link =  'http://' . Registry::get('config.http_host') . $product_data['main_pair']['detailed']['http_image_path'];

	} else {
		$image_link = '';
	}

	$entry .= "<cs:image_link><![CDATA[" . $image_link . "]]></cs:image_link>\n";
	
	if (!empty($product_data['search_words'])) {
		$entry .= '<cs:attribute name="search_words" text_search="Y" weight="100"><![CDATA[' . $product_data['search_words'] . "]]></cs:attribute>\n";
	}

	if (!empty($product_data['product_features'])) {
		foreach ($product_data['product_features'] as $f) {
			if ($f['feature_type'] == 'G') {
				continue;
			}

			$entry .= '<cs:attribute name="feature_' . $f['feature_id'] . '" type="' . $types_map[$f['feature_type']] . '">';
			if ($f['feature_type'] == 'M') {
				foreach ($f['variants'] as $fv) {
					$entry .= ' <value><![CDATA[' . $fv['variant_id'] . ']]></value>';
				}
			} else {
				if ($f['feature_type'] == 'S' || $f['feature_type'] == 'E') {
					$entry .= '<![CDATA[' . $f['variant_id'] . ']]>';
				} elseif ($f['feature_type'] == 'N' ) {
					$entry .= $f['variant'];
				} elseif ($f['feature_type'] == 'O' || $f['feature_type'] == 'D') {
					$entry .= $f['value_int'];
				} elseif ($f['feature_type'] == 'C') {
					$entry .= ($f['value'] == 'Y')? '<![CDATA[Y]]>' : '<![CDATA[N]]>';
				} else {// T
					$entry .= '<![CDATA[' . $f['value'] . ']]>';
				}
			}
			$entry .= "</cs:attribute>\n";
		}
	}

	$entry .= '<cs:attribute name="category_id" type="text">';
	foreach ($product_data['category_ids'] as $category_id) {
		$entry .= ' <value>' . intval($category_id) . '</value>';
	}
	$entry .= "</cs:attribute>\n";

	$entry .= '<cs:attribute name="category_usergroup_ids" type="text">';
	$product_data['category_usergroup_ids'] = empty($product_data['category_usergroup_ids'])? array(0) : $product_data['category_usergroup_ids'];
	foreach ($product_data['category_usergroup_ids'] as $usergroup_id) {
		$entry .= ' <value>' . intval($usergroup_id) . '</value>';
	}
	$entry .= "</cs:attribute>\n";

	$product_data['usergroup_ids'] = empty($product_data['usergroup_ids'])? array(0) : explode(',', $product_data['usergroup_ids']);
	$entry .= '<cs:attribute name="usergroup_ids" type="text">';
	foreach ($product_data['usergroup_ids'] as $usergroup_id) {
		$entry .= ' <value>' . intval($usergroup_id) . '</value>';
	}
	$entry .= "</cs:attribute>\n";

	foreach ($usergroups as $usergroup) {
		$usergroup_id = $usergroup['usergroup_id'];
		$price = (!empty($product_data['se_prices'][$usergroup_id]['price'])) ? $product_data['se_prices'][$usergroup_id]['price'] : $product_data['se_prices'][0]['price'];

		$entry .= '<cs:attribute name="price_' . intval($usergroup_id) . '" type="float">' . $price . "</cs:attribute>\n";
	}

	if (!empty($product_data['sales_amount'])) {
		$entry .= '<cs:attribute name="sales_amount" type="int">' . $product_data['sales_amount'] . "</cs:attribute>\n";
	}

	$entry .= '<cs:attribute name="company_id" type="text">' . (int)$product_data['company_id'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="weight" type="float">' . $product_data['weight'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="popularity" type="int">' . (int)$product_data['popularity'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="amount" type="int">' . (int)$product_data['amount'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="timestamp" type="int">' . (int)$product_data['timestamp'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="position" type="int">' . (int)$product_data['position'] . "</cs:attribute>\n";

	$entry .= '<cs:attribute name="free_shipping" type="text">' . $product_data['free_shipping'] . "</cs:attribute>\n";

	$entry .= '<cs:attribute name="empty_categories" type="text">' . $product_data['empty_categories'] . "</cs:attribute>\n";
	$entry .= '<cs:attribute name="status" type="text">' . $product_data['status'] . "</cs:attribute>\n";

	$entry .= "</entry>\n";

	return $entry;
}

function fn_se_generate_facet_xml($filter_data)
{
	$entry = "<entry>\n";
	$entry .= "<title><![CDATA[{$filter_data['filter']}]]></title>\n";
	$entry .= "<cs:position>{$filter_data['position']}</cs:position>\n";

	if (!empty($filter_data['feature_id'])) {
		$entry .= "<cs:attribute>feature_{$filter_data['feature_id']}</cs:attribute>\n";

	} else if(!empty($filter_data['field_type']) && $filter_data['field_type'] == 'P') {
		$entry .= "<cs:attribute>price</cs:attribute>\n";

	} else if(!empty($filter_data['field_type']) && $filter_data['field_type'] == 'F') {
		$entry .= "<cs:attribute>free_shipping</cs:attribute>\n";

	} else if(!empty($filter_data['field_type']) && $filter_data['field_type'] == 'S') {
		$entry .= "<cs:attribute>company_id</cs:attribute>\n";

	} else if(!empty($filter_data['field_type']) && $filter_data['field_type'] == 'A') {
		$entry .= "<cs:attribute>amount</cs:attribute>\n";
	} else {
		return ''; //unknown attribute
	}
	
	$filter_fields = fn_get_product_filter_fields();
	if (!empty($filter_fields[$filter_data['field_type']]['slider'])) {
		$entry .= "<cs:type>slider</cs:type>\n";
	}
	
	if ((!empty($filter_data['feature_type']) && strpos('ODN', $filter_data['feature_type']) !== false) || (!empty($filter_data['field_type']) && !empty($filter_fields[$filter_data['field_type']]['is_range']))) {
		$entry .= "<cs:ranges>\n";

		foreach ($filter_data['ranges'] as $k => $r) {

			if (!empty($filter_data['feature_type']) && $filter_data['feature_type'] == 'D' && !empty($filter_data['dates_ranges'][$k])) {
				$r['to'] = fn_parse_date($filter_data['dates_ranges'][$k]['to']);
				$r['from'] = fn_parse_date($filter_data['dates_ranges'][$k]['from']);
			}
			if (!empty($r['range_name'])) {
				$entry .= "<cs:range from=\"{$r['from']}\" to=\"{$r['to']}\" position=\"{$r['position']}\">{$r['range_name']}</cs:range>\n";
			}
		}
		$entry .= "</cs:ranges>\n";
	}

	$entry .= "</entry>\n";

	return $entry;
}

?>