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

//
// Configurable constants
//
fn_define('SE_SEARCH_TIMEOUT', 3); //Search and navigation request timeout
fn_define('SE_REQUEST_TIMEOUT', 10); // API request timeout
fn_define('SE_PRODUCTS_PER_PASS', 200); // Number of products submitted in a single API request during a full catalog synchronization
fn_define('SE_USE_RELEVANCE_AS_DEFAULT_SORTING', 'Y'); // Y or N  (Set Sorting by relevance as the default sorting on product search in the storefront)

//
// Not configurable constants
//
fn_define('SE_VERSION', '1.2');
fn_define('SE_MAX_ERROR_COUNT', 25);
fn_define('SE_MAX_PROCESSING_TIME', 720);
fn_define('SE_MAX_SEARCH_REQUEST_LENGTH', '8000');
fn_define('SE_SERVICE_URL', 'http://www.searchanise.com');

function fn_searchanise_init_secure_controllers($controllers)
{
	$controllers['searchanise'] = 'passive';
}

function fn_se_check_company_id($company_id = NULL)
{
	if (PRODUCT_TYPE != 'ULTIMATE') {
		$company_id = 0;
	}

	return $company_id;
}

function fn_se_get_company_id()
{
	$company_id = (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID'))? COMPANY_ID : 0;

	return $company_id;
}

function fn_se_get_all_settings($update = false)
{
	static $settings = array();

	if (empty($settings) || !empty($update)) {
		$_settings = db_get_array("SELECT * FROM ?:se_settings");
		foreach ($_settings as $s) {
			$settings[$s['company_id']][$s['lang_code']][$s['name']] = $s['value'];
		}
	}

	return $settings;
}

function fn_se_get_setting($name, $company_id, $lang_code)
{
	$settings = fn_se_get_all_settings();
	return isset($settings[$company_id][$lang_code][$name])? $settings[$company_id][$lang_code][$name] : NULL;
}

function fn_se_set_setting($name, $company_id, $lang_code, $value)
{
	if (empty($name) || empty($lang_code)) {
		return;
	}

	db_replace_into('se_settings', array(
		'name' => $name,
		'company_id' => $company_id,
		'lang_code' => $lang_code,
		'value'     => $value,
	));

	fn_se_get_all_settings(true);// call to update cache
}

function fn_se_get_simple_setting($name)
{
	return fn_se_get_setting($name, fn_se_get_company_id(), DEFAULT_LANGUAGE);
}

function fn_se_set_simple_setting($name, $value)
{
	if (empty($name)) {
		return;
	}

	fn_se_set_setting($name, fn_se_get_company_id(), DEFAULT_LANGUAGE, $value);
}

function fn_se_set_import_status($status, $company_id, $lang_code)
{
	fn_se_set_setting('import_status', $company_id, $lang_code, $status);
}

function fn_se_get_import_status($company_id, $lang_code)
{
	return fn_se_get_setting('import_status', $company_id, $lang_code);
}

function fn_se_get_parent_private_key($company_id, $lang_code)
{
	$keys = db_get_hash_single_array("SELECT lang_code, value FROM ?:se_settings WHERE name = 'parent_private_key' AND company_id = ?i", array('lang_code', 'value'), $company_id);
	if (!empty($keys[$lang_code])) {
		return $keys[$lang_code];
	} else {
		foreach ((array)$keys as $key) {
			if (!empty($key)) {
				return $key;
			}
		}
	}

	return NULL;
}

function fn_se_get_private_key($company_id, $lang_code)
{
	return fn_se_get_setting('private_key', $company_id, $lang_code);
}

function fn_se_get_api_key($company_id, $lang_code)
{
	return fn_se_get_setting('api_key', $company_id, $lang_code);
}

function fn_se_get_engines_count($company_id = NULL)
{
	return db_get_field("SELECT count(*) FROM ?:se_settings WHERE name = 'private_key' AND company_id = ?i", $company_id);
}

function fn_se_is_registered()
{
	return (bool) db_get_field("SELECT count(*) FROM ?:se_settings WHERE name = 'parent_private_key'");
}

function fn_se_add_action($action, $data = NULL, $company_id = NULL, $lang_code = NULL)
{
	if (fn_se_is_registered() == false) {
		return;
	}

	$data = array(serialize((array)$data));
	$company_id = fn_se_check_company_id($company_id);

	if ($action == 'prepare_full_import' && empty($company_id) && empty($lang_code)) {
		//Trucate queue for all
		db_query("TRUNCATE ?:se_queue");
	}

	$engines_data = fn_se_get_engines_data($company_id, $lang_code);

	foreach ($data as $d) {
		foreach ($engines_data as $engine_data) {

			if ($action != 'phrase') {
				//Remove duplicate actions
				db_query("DELETE FROM ?:se_queue WHERE status = 'pending' AND action = ?s AND data = ?s AND company_id = ?i AND lang_code = ?s", $action, $d, $engine_data['company_id'], $engine_data['lang_code']);
			}

			db_query("INSERT INTO ?:se_queue ?e", array(
				'action'     => $action,
				'data'       => $d,
				'company_id' => $engine_data['company_id'],
				'lang_code'  => $engine_data['lang_code'],
			));
		}
	}
}

function fn_searchanise_update_product_amount($new_amount, $product_id, $cart_id, $tracking)
{
	if ($tracking == 'B') { // track whole product inventory only - we don't use combinations yet
		fn_se_add_action('update', $product_id);
	}
}

function fn_searchanise_update_product_post($product_data, $product_id, $lang_code, $create)
{
	fn_se_add_action('update', (int)$product_id);
}

function fn_searchanise_clone_product($product_id, $pid)
{
	fn_se_add_action('update', $pid);
}

function fn_searchanise_global_update_products($table, $field, $value, $type, $msg, $update_data)
{
	if (!empty($update_data['product_ids'])) {
		foreach ($update_data['product_ids'] as $pid) {
			fn_se_add_action('update', (int)$pid);
		}
	} else {
		fn_se_queue_import();
	}
}

function fn_searchanise_delete_product_pre($product_id)
{
	fn_se_add_action('delete', $product_id);
}

function fn_searchanise_import_after_process_data($primary_object_id, $v, $pattern, $options)
{
	if ($pattern['pattern_id'] == 'products') {
		fn_se_add_action('update', $primary_object_id['product_id']);
	}
}

function fn_searchanise_update_category($category_data, $category_id, $lang_code)
{
	$_product_ids = db_get_fields('SELECT product_id FROM ?:products_categories WHERE category_id = ?i', $category_id);

	if (!empty($category_data['usergroup_to_subcats']) && $category_data['usergroup_to_subcats'] == 'Y') {
		$id_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $category_id);
		$_product_ids = array_merge($_product_ids, db_get_fields("SELECT pc.product_id FROM ?:products_categories AS pc LEFT JOIN ?:categories AS c ON pc.category_id = c.category_id WHERE id_path LIKE ?l", "$id_path/%"));
	}

	if (!empty($_product_ids)) {
		$_product_ids = array_chunk($_product_ids, SE_PRODUCTS_PER_PASS);

		foreach ($_product_ids as $product_ids) {
			fn_se_add_action('update', $product_ids);
		}
	}
}

function fn_searchanise_tools_change_status($params, $result)
{
	if (fn_se_is_registered() == false) {
		return;
	}

	if ($params['table'] == 'products' && !empty($result)) {
		fn_se_add_action('update', $params['id']);
	} else if ($params['table'] == 'product_filters' && !empty($result) && !empty($params['id_name']) && $params['id_name'] == 'filter_id' && !empty($params['id'])) {
		if ($params['status'] == 'A') {
			fn_searchanise_update_product_filter(NULL, $params['id']);
		} elseif($params['status'] == 'D') {
			fn_searchanise_delete_product_filter($params['id']);
		}
	} else if ($params['table'] == 'categories' && !empty($result) && !empty($params['id_name']) && $params['id_name'] == 'category_id' && !empty($params['id'])) {

		$_product_ids = db_get_fields('SELECT product_id FROM ?:products_categories WHERE category_id = ?i', $params['id']);
		if (!empty($_product_ids)) {
			$_product_ids = array_chunk($_product_ids, SE_PRODUCTS_PER_PASS);

			foreach ($_product_ids as $product_ids) {
				fn_se_add_action('update', $product_ids);
			}
		}
	} else if ($params['table'] == 'languages' && !empty($result)) {
		$lang_code = $params['id'];

		if ($params['status'] == 'A') {
			fn_se_signup(NULL, $lang_code, false);
			fn_se_queue_import(NULL, $lang_code, false);

			$language_name = db_get_field("SELECT name FROM ?:languages WHERE lang_code = ?s", $lang_code);
			fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[language]', $language_name, fn_get_lang_var('text_se_import_status_queued_language')));

			fn_se_send_addon_status_request('enabled', NULL, $lang_code);
		} else {// D, H
			fn_se_send_addon_status_request('disabled', NULL, $lang_code);
		}
	}
}

function fn_se_get_engines_data($company_id = NULL, $lang_code = NULL, $skip_available_check = false)
{
	static $engines_data = array();

	$company_id = fn_se_check_company_id($company_id);

	if (empty($engines_data) || !empty($skip_available_check)) {
		if (PRODUCT_TYPE == 'ULTIMATE') {
			$available = ($skip_available_check == true)? '1' : "c.status = 'A' AND l.status = 'A'";
			$languages = db_get_array("
				SELECT c.company_id, c.storefront, c.email, l.name, l.lang_code
				FROM ?:languages as l
				INNER JOIN ?:ult_objects_sharing as s ON (s.share_object_id = l.lang_code AND s.share_object_type = 'languages') 
				LEFT JOIN ?:companies as c ON c.company_id = s.share_company_id WHERE ?p ORDER BY l.lang_code = ?s DESC", $available, DEFAULT_LANGUAGE);
		} else {
			$available = ($skip_available_check == true)? '1' : "status = 'A'";
			$languages = db_get_array("SELECT * FROM ?:languages WHERE $available");
		}

		foreach ($languages as $l) {
			$l_code = $l['lang_code'];
			if (PRODUCT_TYPE == 'ULTIMATE') {
				$c_id = $l['company_id'];
				$url = 'http://' . $l['storefront'] . '/?sl=' . $l_code;
			} else {
				$c_id = 0;
				$url = 'http://' . Registry::get('config.http_host') . Registry::get('config.http_path') . '/?sl=' . $l_code;
			}

			$engines_data[$c_id][$l_code] = array(
				'lang_code'     => $l_code,
				'company_id'    => $c_id,
				'language_name' => $l['name'],
				'url'           => $url,
				'api_key'       => fn_se_get_api_key($c_id, $l_code),
				'private_key'   => fn_se_get_private_key($c_id, $l_code),
				'import_status' => fn_se_get_import_status($c_id, $l_code),
				'parent_private_key' => fn_se_get_parent_private_key($c_id, $l_code),
			);
		}
	}

	$return = array();
	foreach ($engines_data as $s_keys_data) {
		foreach ($s_keys_data as $s_l_keys_data) {
			if (!is_null($lang_code) && !is_null($company_id) && $s_l_keys_data['lang_code'] == $lang_code && $s_l_keys_data['company_id'] == $company_id) {
				$return[] = $s_l_keys_data;
			} else if (!is_null($lang_code) && is_null($company_id) && $s_l_keys_data['lang_code'] == $lang_code) {
				$return[] = $s_l_keys_data;
			} else if (is_null($lang_code) && !is_null($company_id) && $s_l_keys_data['company_id'] == $company_id) {
				$return[] = $s_l_keys_data;
			} else if (is_null($lang_code) && is_null($company_id)) {
				$return[] = $s_l_keys_data;
			}
		}
	}

	if (!empty($skip_available_check)) {
		$engines_data = array();
	}

	return $return;
}

function fn_se_clear_unused_engines_data()
{
	$private_keys = array();
	$engines_data = fn_se_get_engines_data(NULL, NULL, true);
	foreach ($engines_data as $engine_data) {
		if (!empty($engine_data['private_key'])) {
			$private_keys[] = $engine_data['private_key'];
		}
	}

	if (empty($private_keys)) {
		return;
	}

	$keys_to_delete = db_get_array("SELECT * FROM ?:se_settings WHERE name = 'private_key' AND value NOT IN (?a)", $private_keys);

	if (empty($keys_to_delete)) {
		return;
	}

	foreach ($keys_to_delete as $k) {
		fn_se_send_request('/api/state/update', $k['value'], array('addon_status' => 'deleted'));
		db_query("DELETE FROM ?:se_settings WHERE company_id = ?i AND lang_code = ?s AND name IN ('api_key', 'private_key', 'import_status', 'parent_private_key')", $k['company_id'], $k['lang_code']);
	}

	fn_se_get_all_settings(true);// call to update cache
}

function fn_se_signup($_company_id = NULL, $_lang_code = NULL, $show_notification = true)
{
	@ignore_user_abort(1);
	@set_time_limit(3600);

	$connected = false;

	$is_showed = false;

	if ((!empty($_company_id) || !empty($_lang_code)) && fn_se_is_registered() == false) {
		return false;
	}

	$email = Registry::if_get(('user_info.email'), db_get_field("SELECT email FROM ?:users WHERE user_id = 1"));

	fn_se_clear_unused_engines_data();

	$engines_data = fn_se_get_engines_data($_company_id, $_lang_code);

	foreach ($engines_data as $engine_data) {
		$lang_code = $engine_data['lang_code'];
		$company_id = $engine_data['company_id'];
		$private_key = $engine_data['private_key'];
		$parent_private_key = fn_se_get_parent_private_key($company_id, $lang_code);

		if (!empty($private_key)) {
			continue;
		}

		if (fn_se_get_engines_count($company_id) + 1 > 5) {
			fn_se_echo_connect_progress('<br /> Error: In the beta version of Searchanise, the number of languages used cannot exceed 5.<br />');
			break;
		}

		if ($show_notification == true && empty($is_showed)) {
			fn_se_echo_connect_progress('Connecting to Searchanise..');
			$is_showed = true;
		}

		list($h, $res) = fn_http_request('POST', SE_SERVICE_URL . '/api/signup', array(
			'url'  => $engine_data['url'],
			'email'   => $email,
			'version' => SE_VERSION,
			'language' => $lang_code,
			'parent_private_key' => $parent_private_key,
			'platform' => 'cs-cart',
		));

		if ($show_notification == true) {
			fn_se_echo_connect_progress('.');
		}

		if (!empty($res)) {

			$res = fn_se_parse_response($res, true);

			if (is_object($res)) {
				$api_key = (string)$res->api;
				$private_key = (string)$res->private;

				if (empty($api_key) || empty($private_key)) {
					return false;
				}

				if (empty($parent_private_key)) {
					fn_se_set_setting('parent_private_key', $company_id, $lang_code, $private_key);
				}

				fn_se_set_setting('api_key', $company_id, $lang_code, $api_key);
				fn_se_set_setting('private_key', $company_id, $lang_code, $private_key);

				$connected = true;
			} else {
				if ($show_notification == true) {
					fn_se_echo_connect_progress(' Error<br />');
				}
				return false;
			}
		}

		fn_se_set_import_status('none', $company_id, $lang_code);
		fn_se_set_setting('use_navigation', $company_id, DEFAULT_LANGUAGE, 'Y');
	}

	if ($connected == true && $show_notification == true) {
		fn_se_echo_connect_progress(' Done<br />');
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_se_just_connected'));
	}

	return $connected;
}

function fn_se_echo_connect_progress($text)
{
	if (!defined('AJAX_REQUEST')) {
		fn_echo($text);
	}
}

function fn_se_queue_import($company_id = NULL, $lang_code = NULL, $show_notification = true)
{
	if (fn_se_is_registered() == false) {
		return;
	}

	fn_se_add_action('prepare_full_import', NULL, $company_id, $lang_code);
	
	$engines_data = fn_se_get_engines_data($company_id, $lang_code);
	foreach ($engines_data as $engine_data) {
		fn_se_set_import_status('queued', $engine_data['company_id'], $engine_data['lang_code']);
	}

	if ($show_notification == true) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_se_import_status_queued'));
	}
}

function fn_searchanise_database_restore()
{
	if (fn_se_is_registered() == false) {
		return;
	}

	$msg = fn_get_lang_var('text_se_database_restore_notice');
	$msg = str_replace('[link]', fn_url('addons.update?addon=searchanise'), $msg);

	fn_set_notification('W', fn_get_lang_var('notice'), $msg);

	return true;
}

function fn_se_get_facet_valid_locations()
{
	return array(
		'index.index',
		'products.search',
		'categories.view',
		'product_features.view'
	);
}

function fn_se_get_valid_sortings()
{
	return array(
		'position',
		'product',
		'price',
		'relevance',
		'timestamp',
	);
}

function fn_se_check_product_filter_block()
{
	return Bm_Block::instance()->is_block_type_active_on_current_location('product_filters');
}

function fn_searchanise_send_search_request($params, $lang_code = CART_LANGUAGE)
{
	$company_id = fn_se_get_company_id();
	$api_key = fn_se_get_api_key($company_id, $lang_code);
	if (empty($api_key)) {
		return;
	}

	$default_params = array(
		'items'       => 'true',
		'facets'      => 'true',
		'output'      => 'json',
	);

	$params = array_merge($default_params, $params);
	if (empty($params['restrictBy'])) {
		unset($params['restrictBy']);
	}

	if (empty($params['union'])) {
		unset($params['union']);
	}

	$query = fn_build_query($params);

	Registry::set('log_cut', true);
	if (strlen($query) > SE_MAX_SEARCH_REQUEST_LENGTH && fn_check_curl()) {
		list($header, $received) = fn_http_request('POST', SE_SERVICE_URL . '/search?api_key=' . $api_key, $params, array(), array(), SE_SEARCH_TIMEOUT);
	} else {
		$params['api_key'] = $api_key;
		list($header, $received) = fn_http_request('GET', SE_SERVICE_URL . '/search', $params, array(), array(), SE_SEARCH_TIMEOUT);
	}
	
	if (empty($received)) {
		return false;
	}

	$result = fn_from_json(trim($received), true);

	if (isset($result['error'])) {
		if ($result['error'] == 'NEED_RESYNC_YOUR_CATALOG') {
			fn_se_queue_import($company_id, $lang_code, false);
			return false;

		} elseif ($result['error'] == 'NAVIGATION_DISABLED') {
			fn_se_set_simple_setting('use_navigation', 'N');
		}
	}

	if (empty($result) || !is_array($result) || !isset($result['totalItems'])) {
		return false;
	}

	return $result;
}

function fn_searchanise_products_sorting($sorting)
{
	if (Registry::if_get('runtime.se_use_relevance_sorting', false) == true) {
		$sorting = array_merge(array('relevance' => array('description' => fn_get_lang_var('se_relevance'), 'default_order' => 'asc')), $sorting);

		//Update settings in template vars.
		$list = array_merge(Registry::get('settings.Appearance.available_product_list_sortings'), array('relevance-asc' => 'Y'));
		Registry::set('settings.Appearance.available_product_list_sortings', $list);
		Registry::get('view')->assign('settings', Registry::get('settings'));
	}
}

function fn_se_prepare_request_params($params)
{
	$restrict_by = $query_by = $union = array();
	
	//
	// Hide products with empty categories and wrong usergroup categories
	//
	$restrict_by['empty_categories'] = 'N';
	$restrict_by['category_usergroup_ids'] = join('|', $_SESSION['auth']['usergroup_ids']);

	//
	// Filters
	//
	$filter_fields = fn_get_product_filter_fields();

	$advanced_variant_ids = $simple_variant_ids = $av_ids = $ranges_ids = $fields_ids = $slider_vals = array();

	if (!empty($params['features_hash'])) {
		list($av_ids, $ranges_ids, $fields_ids, $slider_vals) = fn_parse_features_hash($params['features_hash']);
	}

	if (!empty($params['multiple_variants']) && !empty($params['advanced_filter'])) {
		$simple_variant_ids = $params['multiple_variants'];
	}

	if (!empty($av_ids)) {
		$features_variants_ids = db_get_hash_single_array("SELECT feature_id, GROUP_CONCAT(variant_id) as variant_ids FROM ?:product_feature_variants WHERE variant_id IN (?n) GROUP BY feature_id", array('feature_id', 'variant_ids'), $av_ids);

		foreach ($features_variants_ids as $feature_id => $variant_ids) {
			$restrict_by['feature_'.$feature_id] = str_replace(',', '|', $variant_ids);
		}
	}

	if (!empty($simple_variant_ids)) {
		$features_variants_ids = db_get_hash_single_array("SELECT feature_id, GROUP_CONCAT(variant_id) as variant_ids FROM ?:product_feature_variants WHERE variant_id IN (?n) GROUP BY feature_id", array('feature_id', 'variant_ids'), $simple_variant_ids);

		foreach ($features_variants_ids as $feature_id => $variant_ids) {
			$restrict_by['feature_'.$feature_id] = $variant_ids;
		}
	}

	// Feature ranges
	if (!empty($params['custom_range'])) {
		foreach ($params['custom_range'] as $feature_id => $v) {
			$is_from = isset($v['from']) && fn_string_not_empty($v['from']);
			$is_to   = isset($v['to']) && fn_string_not_empty($v['to']);

			if ($is_from || $is_to) {
				if (!empty($v['type'])) {
					if ($v['type'] == 'D') {
						$v['from'] = fn_parse_date($v['from']);
						$v['to'] = fn_parse_date($v['to']);
					}
				}
				$restrict_by['feature_' . $feature_id] = (($is_from)? $v['from'] : '') . ',' . (($is_to)? $v['to'] : '');
			}
		}
	}
	
	// Product field ranges
	if (!empty($params['field_range'])) {
		foreach ($params['field_range'] as $field_type => $v) {
			$structure = $filter_fields[$field_type];
			if (!empty($structure) && (!empty($v['from']) || !empty($v['to']))) {
				if ($field_type == 'P') { // price
					$v['cur'] = !empty($v['cur']) ? $v['cur'] : CART_SECONDARY_CURRENCY;
					if (empty($v['orig_cur'])) {
						// saving the first user-entered values
						// will be always search by it
						$v['orig_from'] = $v['from'];
						$v['orig_to'] = $v['to'];
						$v['orig_cur'] = $v['cur'];
						$params['field_range'][$field_type] = $v;
					}
					if ($v['orig_cur'] != CART_PRIMARY_CURRENCY) {
						// calc price in primary currency
						$cur_prim_coef  = Registry::get('currencies.' . $v['orig_cur'] . '.coefficient');
						$decimals = Registry::get('currencies.' . CART_PRIMARY_CURRENCY . '.decimals');
						$search_from = round($v['orig_from'] * floatval($cur_prim_coef), $decimals);
						$search_to = round($v['orig_to'] * floatval($cur_prim_coef), $decimals);
					} else {
						$search_from = $v['orig_from'];
						$search_to = $v['orig_to'];
					}
					// if user switch the currency, calc new values for displaying in filter
					if ($v['cur'] != CART_SECONDARY_CURRENCY) {
						if (CART_SECONDARY_CURRENCY == $v['orig_cur']) {
							$v['from'] = $v['orig_from'];
							$v['to'] = $v['orig_to'];
						} else {
							$prev_coef = Registry::get('currencies.' . $v['cur'] . '.coefficient');
							$cur_coef  = Registry::get('currencies.' . CART_SECONDARY_CURRENCY . '.coefficient');
							$v['from'] = floor(floatval($v['from']) * floatval($prev_coef) / floatval($cur_coef));
							$v['to'] = ceil(floatval($v['to']) * floatval($prev_coef) / floatval($cur_coef));
						}
						$v['cur'] = CART_SECONDARY_CURRENCY;
						$params['field_range'][$field_type] = $v;
					}
				}

				$params["$structure[db_field]_from"] = trim(isset($search_from) ? $search_from : $v['from']);
				$params["$structure[db_field]_to"] = trim(isset($search_to) ? $search_to : $v['to']);
			}
		}
	}

	foreach ($ranges_ids as $range_id) {
		$range = db_get_row("SELECT * FROM ?:product_filter_ranges WHERE range_id = ?i", $range_id);
		if (!empty($range)) {
			$feature = 'feature_' . $range['feature_id'];
			$restrict_by[$feature] = empty($restrict_by[$feature])? "{$range['from']},{$range['to']}" : $restrict_by[$feature] . "|{$range['from']},{$range['to']}";
		}
	}

	foreach ($fields_ids as $range_id => $field_type) {
		$feature = $filter_fields[$field_type]['db_field'];

		if ($field_type == 'S') {
			$restrict_by[$feature] = empty($restrict_by[$feature])? $range_id : $restrict_by[$feature] . "|{$range_id}";
		}

		if ($field_type == 'F') {
			$restrict_by[$feature] = ($range_id == '1')? 'Y' : 'N';
		}
	}

	// Slider ranges
	$slider_vals = empty($params['slider_vals']) ? $slider_vals : $params['slider_vals'];
	if (!empty($slider_vals)) {
		foreach ($slider_vals as $field_type => $vals) {
			if (!empty($filter_fields[$field_type])) {
				if ($field_type == 'P') {
					$currency = !empty($vals[2]) ? $vals[2] : CART_PRIMARY_CURRENCY;
					if ($currency != CART_PRIMARY_CURRENCY) {
						$coef = Registry::get('currencies.' . $currency . '.coefficient');
						$decimals = Registry::get('currencies.' . CART_PRIMARY_CURRENCY . '.decimals');
						$vals[0] = round(floatval($vals[0]) * floatval($coef), $decimals);
						$vals[1] = round(floatval($vals[1]) * floatval($coef), $decimals);
					}
				}

				$structure = $filter_fields[$field_type];
				$params["$structure[db_field]_from"] = $vals[0];
				$params["$structure[db_field]_to"] = $vals[1];
			}
		}
	}

	// Checkbox features
	if (!empty($params['ch_filters']) && !fn_is_empty($params['ch_filters'])) {
		foreach ($params['ch_filters'] as $key => $value) {
			if (is_string($key) && !empty($filter_fields[$key])) {
				$restrict_by[$filter_fields[$key]['db_field']] = ($value == 'A')? 'Y|N' : $value;
			} else {
				if (!empty($value)) {
					$feature_id = $key;
					$restrict_by['feature_' . $feature_id] = ($value == 'A')? 'Y|N' : $value;
				}
			}
		}
	}

	//
	// Visibility
	//
	if (AREA == 'C') {
		$restrict_by['status'] = 'A';
		if (PRODUCT_TYPE != 'COMMUNITY') {
			$restrict_by['usergroup_ids'] = join('|', $_SESSION['auth']['usergroup_ids']);
		}

		if (Registry::get('settings.General.inventory_tracking') == 'Y' && Registry::get('settings.General.show_out_of_stock_products') == 'N' && AREA == 'C') {
			$restrict_by['amount'] = '1,';
		}

		//
		// Company_id
		//
		if (PRODUCT_TYPE != 'ULTIMATE' && !isset($restrict_by['company_id'])) {
			if (fn_check_suppliers_functionality()) {
				$se_active_companies = Registry::get('se_active_companies');
				if (!is_null($se_active_companies)) {
					$restrict_by['company_id'] = $se_active_companies;
				}
			} else {
				$restrict_by['company_id'] = 0;
			}

			if (PRODUCT_TYPE != 'ULTIMATE' && defined('COMPANY_ID') && isset($params['company_id'])) {
				$restrict_by['company_id'] = COMPANY_ID;
			}

			if (isset($params['company_id']) && $params['company_id'] != '') {
				$restrict_by['company_id'] = $params['company_id'];
			}
		}
	}

	//
	// Filters coditions for facets request
	//
	if (!empty($params['filters_category_id'])) {
		$c_condition = '';

		if (AREA == 'C') {
			$_c_statuses = array('A', 'H');// Show enabled categories
			$cids = db_get_fields("SELECT a.category_id FROM ?:categories as a WHERE a.category_id IN (?n) AND a.status IN (?a)", $params['filters_category_id'], $_c_statuses);
			$c_condition = db_quote('AND a.status IN (?a) AND (' . fn_find_array_in_set($_SESSION['auth']['usergroup_ids'], 'a.usergroup_ids', true) . ')', $_c_statuses);
		}

		if (Registry::get('settings.General.show_products_from_subcategories') == 'Y') {
			$sub_categories_ids = db_get_fields("SELECT a.category_id FROM ?:categories as a LEFT JOIN ?:categories as b ON b.category_id IN (?n) WHERE a.id_path LIKE CONCAT(b.id_path, '/%') ?p", $params['filters_category_id'], $c_condition);
			$sub_categories_ids = fn_array_merge($cids, $sub_categories_ids, false);
			$restrict_by['category_id'] = join('|', $sub_categories_ids);
		} else {
			$restrict_by['category_id'] = join('|', $cids);
		}
	}

	//
	// Timestamp
	//
	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);
		$restrict_by['timestamp'] = "{$params['time_from']},{$params['time_to']}";
	}

	//
	// Price Union
	//
	if (PRODUCT_TYPE != 'COMMUNITY' && count($_SESSION['auth']['usergroup_ids']) > 1) {
		foreach($_SESSION['auth']['usergroup_ids'] as $usergroup_id) {
			$_prices[] = 'price_' . $usergroup_id;
		}

		$union['price']['min'] = join('|', $_prices);
	}

	//
	// Price
	//
	$is_price_from = (isset($params['price_from']) && fn_is_numeric($params['price_from']));
	$is_price_to   = (isset($params['price_to']) && fn_is_numeric($params['price_to']));

	if ($is_price_from || $is_price_to) {
		$restrict_by['price'] = (($is_price_from)? $params['price_from'] : '') . ',' . (($is_price_to)? $params['price_to'] : '');
	}

	//
	// Weight
	//
	$is_weight_from = (isset($params['weight_from']) && fn_is_numeric($params['weight_from']));
	$is_weight_to   = (isset($params['weight_to']) && fn_is_numeric($params['weight_to']));

	if ($is_weight_from || $is_weight_to) {
		$restrict_by['weight'] = (($is_weight_from)? $params['weight_from'] : '') . ',' . (($is_weight_to)? $params['weight_to'] : '');
	}

	//
	// Amount
	//
	$is_amount_from = (isset($params['amount_from']) && fn_is_numeric($params['amount_from']));
	$is_amount_to   = (isset($params['amount_to']) && fn_is_numeric($params['amount_to']));

	if ($is_amount_from || $is_amount_to) {
		$restrict_by['amount'] = (($is_amount_from)? $params['amount_from'] : '') . ',' . (($is_amount_to)? $params['amount_to'] : '');
	}

	//
	// Popularity
	//
	$is_popularity_from = (isset($params['popularity_from']) && fn_is_numeric($params['popularity_from']));
	$is_popularity_to   = (isset($params['popularity_to']) && fn_is_numeric($params['popularity_to']));

	if ($is_popularity_from || $is_popularity_to) {
		$restrict_by['popularity'] = (($is_popularity_from)? $params['popularity_from'] : '') . ',' . (($is_popularity_to)? $params['popularity_to'] : '');
	}

	if (!empty($params['free_shipping'])) {
		$restrict_by['free_shipping'] = $params['free_shipping'];
	}

	if (isset($params['pcode']) && fn_string_not_empty($params['pcode'])) {
		$query_by['product_code'] = trim($params['pcode']);
	}

	return array($restrict_by, $query_by, $union);
}

function fn_searchanise_get_products_before_select($params, $join, $condition, $u_condition, $inventory_condition, $sortings, $total, $items_per_page, $lang_code)
{
	// disable by core
	if (
		AREA == 'A' ||
		!empty($params['disable_searchanise']) ||
		(empty($params['q']) && fn_se_get_simple_setting('use_navigation') === 'N') ||
		fn_se_get_import_status(fn_se_get_company_id(), $lang_code) != 'done' ||
		!empty($params['pid']) ||
		!empty($params['b_id']) ||
		!empty($params['item_ids']) ||
		!empty($params['feature']) ||
		!empty($params['downloadable']) ||
		!empty($params['tracking']) ||
		!empty($params['shipping_freight_from']) ||
		!empty($params['shipping_freight_to']) ||
		!empty($params['exclude_pid']) ||
		!empty($params['get_query']) ||
		!empty($params['feature_comparison']) ||
		!empty($params['only_short_fields']) ||
		isset($params['amount_to']) ||
		isset($params['amount_from']) ||
		(isset($params['q']) && Registry::get('settings.General.search_objects')) ||
		(isset($params['compact']) && $params['compact'] == 'Y') ||
		(!empty($params['sort_by']) && !in_array($params['sort_by'], fn_se_get_valid_sortings())) ||
		(!empty($params['force_get_by_ids']) && empty($params['pid']) && empty($params['product_id'])) ||
		(!empty($params['tx_features']) && !fn_is_empty($params['tx_features']))
	) {
		return;
	}

	// disable by addons
	if (
		!empty($params['rating']) ||                                                    // discussion
		!empty($params['bestsellers']) ||                                               // bestsellers
		!empty($params['configurable']) ||                                              // product_configurator
		!empty($params['also_bought_for_product_id']) ||                                // also_bought
		!empty($params['for_required_product']) ||                                      // required_products
		(!empty($params['sort_by']) && $params['sort_by'] == 'bestsellers') ||          // bestsellers sorting
		(!empty($params['display']) && $params['display'] == 'affiliate') ||            // affiliates
		(!empty($params['ppcode']) && $params['ppcode'] == 'Y') ||                      // twigmo
		(isset($params['tag']) && fn_string_not_empty($params['tag'])) ||               // tags
		Registry::if_get('addons.age_verification.status', 'D') == 'A' ||               // age_verification was enabled
		Registry::if_get('addons.vendor_data_premoderation.status', 'D') == 'A' ||      // vendor_data_premoderation was enabled
		(!empty($params['picker_for']) && $params['picker_for'] == 'gift_certificates') // recurring_billing
	) {
		return;
	}

	list($restrict_by, $query_by, $union) = fn_se_prepare_request_params($params);

	//
	// Categories
	//
	if (!empty($params['cid'])) {
		$cids = is_array($params['cid']) ? $params['cid'] : array($params['cid']);

		$c_condition = '';

		if (AREA == 'C') {
			$_c_statuses = array('A', 'H');// Show enabled categories
			$cids = db_get_fields("SELECT a.category_id FROM ?:categories as a WHERE a.category_id IN (?n) AND a.status IN (?a)", $cids, $_c_statuses);
			$c_condition = db_quote('AND a.status IN (?a) AND (' . fn_find_array_in_set($_SESSION['auth']['usergroup_ids'], 'a.usergroup_ids', true) . ')', $_c_statuses);
		}

		$sub_categories_ids = db_get_fields("SELECT a.category_id FROM ?:categories as a LEFT JOIN ?:categories as b ON b.category_id IN (?n) WHERE a.id_path LIKE CONCAT(b.id_path, '/%') ?p", $cids, $c_condition);
		$sub_categories_ids = fn_array_merge($cids, $sub_categories_ids, false);

		if (empty($sub_categories_ids)) {
			$params['force_get_by_ids'] = true;
			$params['pid'] = $params['product_id'] = 0;
			return;
		}

		if (!empty($params['subcats']) && $params['subcats'] == 'Y') {
			$restrict_by['category_id'] = join('|', $sub_categories_ids);
		} else {
			$restrict_by['category_id'] = join('|', $cids);
		}
	}

	//
	// Sortings
	//
	$sortings['relevance'] = "FIELD(products.product_id, '')";

	if (!empty($_REQUEST['search_performed'])) {
		Registry::set('runtime.se_use_relevance_sorting', true);
		if (empty($params['sort_by']) && SE_USE_RELEVANCE_AS_DEFAULT_SORTING == 'Y') {
			// For search we put relevance
			$params['sort_by'] = 'relevance';
		}
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params = array_merge($params, fn_get_default_products_sorting());

		if (!empty($params['sort_by']) && !in_array($params['sort_by'], fn_se_get_valid_sortings())) {
			return;
		}

		if (empty($sortings[$params['sort_by']])) {
			$_products_sortings = fn_get_products_sorting(false);
			$params['sort_by'] = key($_products_sortings);
		}
	}

	if (!empty($params['sort_by']) && !in_array($params['sort_by'], fn_se_get_valid_sortings())) {
		return;
	}

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	$default_sorting = fn_get_products_sorting(false);

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		if (!empty($default_sorting[$params['sort_by']]['default_order'])) {
			$params['sort_order'] = $default_sorting[$params['sort_by']]['default_order'];
		} else {
			$params['sort_order'] = 'asc';
		}
	}

	if ($params['sort_by'] == 'product') {
		$sort_by = 'title';
	} elseif ($params['sort_by'] == 'relevance') {
		$params['sort_order'] = 'asc';
		$sort_by = 'relevance';
	} else {
		$sort_by = $params['sort_by'];
	}

	$sort_order = ($params['sort_order'] == 'asc') ? 'asc' : 'desc';

	//
	// Items_per_page
	//
	if (!empty($_REQUEST['items_per_page'])) {
		$_SESSION['items_per_page'] = $_REQUEST['items_per_page'] > 0 ? $_REQUEST['items_per_page'] : 1;
	}

	if (!empty($_SESSION['items_per_page'])) {
		$items_per_page = $_SESSION['items_per_page'];
	}

	$items_per_page = empty($items_per_page) ? 10 : (int)$items_per_page;

	if (!empty($params['limit'])) {
		$max_results = $params['limit'];
	} else {
		$max_results = $items_per_page;
	}

	$get_items = true;
	$get_facets = false;

	if (PRODUCT_TYPE != 'COMMUNITY' && AREA == 'C' && !empty($params['dispatch']) && in_array($params['dispatch'], fn_se_get_facet_valid_locations()) && fn_se_check_product_filter_block() == true) {
		$get_facets = true;
	}

	$request_params = array(
		'sortBy'     => $sort_by,
		'sortOrder'  => $sort_order,

		'union'      => $union,
		'queryBy'    => $query_by,
		'restrictBy' => $restrict_by,

		'items'      => ($get_items == true)? 'true' : 'false',
		'facets'     => ($get_facets == true)? 'true' : 'false',

		'maxResults' => $max_results,
		'startIndex' => ($params['page'] - 1) * $items_per_page,
	);

	if (!empty($params['q']) && fn_strlen($params['q']) > 0) {
		$request_params['q'] = $params['q'];
		$request_params['suggestions'] = 'true';
		$request_params['query_correction'] = 'false';
		$request_params['suggestionsMaxResults'] = 1;
	} else {
		$request_params['q'] = '';
	}

	$result = fn_searchanise_send_search_request($request_params, $lang_code);
	if ($result == false) {
		//revert to standart sorting
		if ($params['sort_by'] == 'relevance') {
			$params['sort_by'] = '';
		}
		Registry::set('runtime.se_use_relevance_sorting', false);
		return;
	}

	if (!empty($result['suggestions']) && count($result['suggestions']) > 0) {
		$params['suggestion'] = reset($result['suggestions']);
	}

	if (!empty($result['items'])) {
		foreach($result['items'] as $product) {
			$params['pid'][] = $product['product_id'];
		}
		if ($params['sort_by'] == 'relevance') {
			$sortings['relevance'] = "FIELD(products.product_id, '" . join("','", $params['pid']) . "')";
			$params['sort_order'] = 'asc';
		}
	} else {
		$products = array();
		$params['force_get_by_ids'] = true;
		$params['pid'] = $params['product_id'] = 0;
	}

	if (isset($result['facets'])) {
		Registry::set('searchanise.received_facets', $result['facets']);
	}

	$total = $result['totalItems'];

	// reset condition with text search && filtering params  - we are get all control under process of  text search and filtering
	$condition = '';
	$join = '';

	return;
}

function fn_searchanise_get_filters_products_count($params)
{
	if (
		AREA == 'A' ||
		!empty($params['disable_searchanise']) ||
		(empty($params['q']) && fn_se_get_simple_setting('use_navigation') === 'N') ||
		fn_se_get_import_status(fn_se_get_company_id(), CART_LANGUAGE) != 'done' ||
		Registry::if_get('addons.age_verification.status', 'D') == 'A' ||            // age_verification was enabled
		Registry::if_get('addons.vendor_data_premoderation.status', 'D') == 'A'      // vendor_data_premoderation was enabled
	) {
		return fn_get_filters_products_count($params);
	}

	$get_custom = !empty($params['get_custom']);

	$received_facets = Registry::get('searchanise.received_facets');

	$r_filters = $view_all = $variants_ids = $feature_variants = $fields_ids = $slider_vals = $category_facets = array();

	if (
		fn_se_check_product_filter_block() == false ||
		!empty($params['check_location']) && !in_array($params['dispatch'], fn_se_get_facet_valid_locations()) ||
		!empty($params['skip_if_advanced']) && !empty($params['advanced_filter']) && $params['advanced_filter'] == 'Y'
		) {
		return array();
	}

	if ($params['dispatch'] == 'categories.view' || $params['dispatch'] == 'product_features.view') {
		$params['simple_link'] = true; // this parameter means that extended filters on this page should be displayed as simple
	}

	$params['filters_category_id'] = empty($params['category_id']) ? 0 : $params['category_id'];

	if (is_null($received_facets) || $get_custom) {

		list($restrict_by, $query_by, $union) = fn_se_prepare_request_params($params);

		$request_params = array(
			'items'  => 'false',
			'facets' => 'true',

			'union'      => $union,
			'queryBy'    => $query_by,
			'restrictBy' => $restrict_by,
		);
		$result = fn_searchanise_send_search_request($request_params);

		if (empty($result)) {
			return fn_get_filters_products_count($params);
		}

		$received_facets = $result['facets'];
	}

	if (empty($received_facets)) { // Nothing found
		return array();
	}

	if ($params['dispatch'] == 'product_features.view') {
		$params['features_hash'] = (!empty($params['features_hash']) ? ($params['features_hash'] . '.') : '') . 'V' . $params['variant_id'];
	}

	if (!empty($params['features_hash'])) {

		list( , , $fields_ids, $slider_vals) = fn_parse_features_hash($params['features_hash']);

		//
		// Get without
		//
		
		list($restrict_by, $query_by, $union) = fn_se_prepare_request_params(array_merge($params, array('features_hash' => '')));

		$request_params = array(
			'items'  => 'false',
			'facets' => 'true',

			'union'      => $union,
			'queryBy'    => $query_by,
			'restrictBy' => $restrict_by,
		);
		$result = fn_searchanise_send_search_request($request_params);

		if (empty($result)) {
			return fn_get_filters_products_count($params);
		} else {
			$category_facets = $result['facets'];
		}
	}

	$fields = fn_get_product_filter_fields();

	$_params = array(
		'get_variants' => true,
		'status' => 'A',
	);

	if ($params['dispatch'] == 'index.index') {
		$_params['show_on_home_page'] = 'Y';
	} elseif (!empty($params['category_id'])) {
		$_params['category_ids'] = array($params['category_id']);
	}

	if (!empty($params['filter_id'])) {
		$_params['filter_id'] = $params['filter_id'];
	}

	list($filters, ) = fn_get_product_filters($_params);

	foreach ($filters as $filter_id => $filter) {

		$r_facet = $c_facet = array();
		foreach ($received_facets as $r) {
			$r_feature_id = str_replace('feature_', '', $r['attribute']);
			if ((!empty($filter['feature_id']) && $r_feature_id == $filter['feature_id']) || (!empty($filter['field_type']) && !empty($fields[$filter['field_type']]['db_field']) && $fields[$filter['field_type']]['db_field'] == $r_feature_id)) {
				$r_facet = $r;
				break;
			}
		}

		if (empty($r_facet) && $get_custom == false) {
			unset($filters[$filter_id]);
			continue;
		}

		foreach ($category_facets as $c) {
			if ($c['attribute'] == $r_facet['attribute']) {
				$c_facet = $c;
				break;
			}
		}

		if ($filter['field_type'] == 'F') {
			$filters[$filter_id]['ranges'] = $filter['ranges'] = array(
				'N' => array(
					'range_id'   => 0,
					'range_name' => fn_get_lang_var('no'),
					'products'   => 0,
				),
				'Y' => array(
					'range_id'   => 1,
					'range_name' => fn_get_lang_var('yes'),
					'products'   => 0,
				)
			);
		} elseif($filter['field_type'] == 'S' && ((count($r_facet['buckets']) == 1 && $r_facet['buckets'][0]['value'] == 0) == false)) {//skip if only default vendor (id=0) range passed
			$_companies = array();
			$companies = db_get_hash_single_array("SELECT ?:companies.company_id, ?:companies.company FROM ?:companies  WHERE status = 'A' ORDER BY ?:companies.company", array('company_id', 'company'));

			foreach ($companies as $company_id => $company) {
				$_companies[$company_id] = array(
					'range_id'   => $company_id,
					'range_name' => $company,
					'products'   => 0,
				);
			}
			$filters[$filter_id]['ranges'] = $filter['ranges'] = $_companies;
		}

		$ranges_count = 0;
		$tmp_ranges = array(
			'selected' => array(),
			'used' => array(),
			'disabled' => array(),
		);

		$filter['ranges'] = isset($filter['ranges'])? $filter['ranges'] : array();

		//
		// Speed up for many variants!
		//
		if (!empty($filter['feature_id']) && !in_array($filter['feature_type'], array('D','N','O'))) {
			$rr_ranges = array();
			foreach ($r_facet['buckets'] as $r) {
				$rr_ranges[$r['value']] = $r;
			}

			$cc_ranges = array();
			if (!empty($c_facet)) {
				foreach ($c_facet['buckets'] as $cc) {
					$cc_ranges[$cc['value']] = $cc;
				}
			}
		}

		foreach ($filter['ranges'] as $s_range_id => $s_range) {
			$r_range = array();

			if (!empty($filter['feature_id']) && !in_array($filter['feature_type'], array('D','N','O'))) {
				// features with variants
				$r_range = (isset($rr_ranges[$s_range['variant_id']]))? $rr_ranges[$s_range['variant_id']] : array();

			} elseif ($filter['field_type'] == 'F') {
				// Free shipping
				foreach ($r_facet['buckets'] as $r) {
					if ($r['value'] == $s_range_id) {
						$r_range = $r;
						break;
					}
				}

			} elseif ($filter['field_type'] == 'S') {
				// Suppliers/Vendors
				foreach ($r_facet['buckets'] as $r) {
					if ($r['value'] == $s_range_id) {
						unset($r['selected']);
						foreach ($fields_ids as $fr_id => $ff_type) {
							if ($ff_type == 'S' && $fr_id == $r['value']) {
								$r['selected'] = true;
							}
						}
						$r_range = $r;
						break;
					}
				}

			} else {// range
				foreach ($r_facet['buckets'] as $r) {
					if (abs($r['from'] - $s_range['from']) < 0.01 && abs($r['to'] - $s_range['to']) < 0.01) {
						$r_range = $r;
						break;
					}
				}
			}

			$range_id = isset($s_range['variant_id'])? $s_range['variant_id'] : $s_range['range_id'];

			$new_range = array(
				'feature_id'   => $filter['feature_id'],
				'range_id'     => $range_id,
				'range_name'   => (isset($s_range['variant']))? $s_range['variant'] : $s_range['range_name'],
				'feature_type' => $filter['feature_type'],
				'filter_id'    => $filter_id,
			);

			if (!empty($r_range)) {
				$new_range['products'] = $r_range['count'];
			}

			if (empty($r_range['selected']) && fn_check_selected_filter($new_range['range_id'], !empty($new_range['feature_type']) ? $new_range['feature_type'] : '', $params, $filter['field_type'])) {
				$new_range['checked'] = true;
			}

			if (!empty($r_range['selected'])) {
				$is_select_found = true;
				$new_range['selected'] = true;
				$tmp_ranges['selected'][$range_id] = $new_range;

			} elseif (!empty($r_range)) {
				$tmp_ranges['used'][$range_id] = $new_range;

			} elseif (!empty($c_facet['buckets'])) {

				$c_range = false;
				if (!empty($filter['feature_id']) && !in_array($filter['feature_type'], array('D','N','O'))) {
					// features with variants
					$c_range = (isset($cc_ranges[$s_range['variant_id']]))? $cc_ranges[$s_range['variant_id']] : array();
		
				} elseif ($filter['field_type'] == 'F') {
					// Free shipping
					foreach ($c_facet['buckets'] as $c) {
						if ($c['value'] == $s_range_id) {
							$c_range = $c;
							break;
						}
					}

				} elseif ($filter['field_type'] == 'S') {
					// Suppliers
					foreach ($c_facet['buckets'] as $c) {
						if ($c['value'] == $s_range_id) {
							$c_range = $c;
							break;
						}
					}

				} else {// range
					foreach ($c_facet['buckets'] as $c) {
						if (abs($c['from'] - $s_range['from']) < 0.01 && abs($c['to'] - $s_range['to']) < 0.01) {
							$c_range = $c;
							break;
						}
					}
				}

				if (!empty($c_range)) {
					$new_range['disabled'] = true;
					$tmp_ranges['disabled'][$range_id] = $new_range;
				}
			}

			$ranges_count++;

		}// \ by store filter ranges

		if (!empty($filters[$filter_id]['slider'])) {
			$is_select_found = true;
			$r_range = $r_facet['buckets'][0];

			$r = array(
				'min' => $r_range['from'],
				'max' => $r_range['to'],
			);

			$field_type = $filters[$filter_id]['field_type'];

			if ($field_type == 'P' && CART_SECONDARY_CURRENCY != CART_PRIMARY_CURRENCY) {
				$coef = Registry::get('currencies.' . CART_SECONDARY_CURRENCY . '.coefficient');
				$r['min'] = floatval($r['min']) / floatval($coef);
				$r['max'] = floatval($r['max']) / floatval($coef);
			}

			$r['min'] = floor($r['min'] / $filters[$filter_id]['round_to']) * $filters[$filter_id]['round_to'];
			$r['max'] = ceil($r['max'] / $filters[$filter_id]['round_to']) * $filters[$filter_id]['round_to'];

			if ($r['max'] - $r['min'] <= $filters[$filter_id]['round_to']) {
				$r['max'] = $r['min'] + $filters[$filter_id]['round_to'];
			}

			if (!empty($slider_vals[$field_type])) {
				if ($field_type == 'P' && $slider_vals['P'][2] != CART_SECONDARY_CURRENCY) {
					$prev_coef = Registry::get('currencies.' . $slider_vals['P'][2] . '.coefficient');
					$cur_coef  = Registry::get('currencies.' . CART_SECONDARY_CURRENCY . '.coefficient');
					$slider_vals['P'][0] = floor(floatval($slider_vals['P'][0]) * floatval($prev_coef) / floatval($cur_coef));
					$slider_vals['P'][1] = ceil(floatval($slider_vals['P'][1]) * floatval($prev_coef) / floatval($cur_coef));
				}

				$r['left'] = $slider_vals[$field_type][0];
				$r['right'] = $slider_vals[$field_type][1];

				if ($r['left'] < $r['min']) {
					$r['left'] = $r['min'];
				}
				if ($r['left'] > $r['max']) {
					$r['left'] = $r['max'];
				}
				if ($r['right'] > $r['max']) {
					$r['right'] = $r['max'];
				}
				if ($r['right'] < $r['min']) {
					$r['right'] = $r['min'];
				}
				if ($r['right'] < $r['left']) {
					$tmp = $r['right'];
					$r['right'] = $r['left'];
					$r['left'] = $tmp;
				}

				$r['left'] = floor($r['left'] / $filters[$filter_id]['round_to']) * $filters[$filter_id]['round_to'];
				$r['right'] = ceil($r['right'] / $filters[$filter_id]['round_to']) * $filters[$filter_id]['round_to'];
			}

			$filters[$filter_id]['range_values'] = $r;
		} else {
			if (empty($tmp_ranges)) {
				unset($filters[$filter_id]);
			} else {
				if (!empty($tmp_ranges['selected'])) {
					$filters[$filter_id]['selected_ranges'] = $tmp_ranges['selected'];
				}

				$filters[$filter_id]['ranges'] = $tmp_ranges['used'] + $tmp_ranges['disabled'];

				// Calculate number of ranges and compare with displaying count
				if (empty($params['get_all'])) {
					if (!empty($filters[$filter_id]['ranges'])) {
						$count = count($filters[$filter_id]['ranges']);
					} else {
						$count = 1;
					}
					if ($count > $filters[$filter_id]['display_more_count']) {
						$filters[$filter_id]['more_ranges'] = array_slice($filters[$filter_id]['ranges'], 0, $filters[$filter_id]['display_more_count'], true);
						$count = $filters[$filter_id]['display_more_count'];
						$filters[$filter_id]['more_cut'] = true;
					} else {
						$filters[$filter_id]['more_ranges'] = $filters[$filter_id]['ranges'];
					}
					$filters[$filter_id]['ranges'] = array_slice($filters[$filter_id]['more_ranges'], 0, $filters[$filter_id]['display_count'], true);
					$filters[$filter_id]['more_ranges'] = array_slice($filters[$filter_id]['more_ranges'], $filters[$filter_id]['display_count'], $count, true);
				}

				if (!empty($params['simple_link']) && $filters[$filter_id]['feature_type'] == 'E') {
					$filters[$filter_id]['simple_link'] = true;
				}
			}
		}
	}

	if (empty($is_select_found) && empty($params['skip_other_variants']) && !empty($params['features_hash'])) {
		fn_set_notification('W', fn_get_lang_var('text_nothing_found'), fn_get_lang_var('text_nothing_found_filter_message'));

		if (defined('AJAX_REQUEST')) {
			die;
		} elseif (!empty($_SERVER['HTTP_REFERER'])) {
			fn_redirect($_SERVER['HTTP_REFERER'], true);
		} else {
			$_params = $params;
			$_params['skip_advanced_variants'] = true;
			$_params['only_selected'] = true;

			if (!empty($params['features_hash']) && empty($params['skip_advanced_variants'])) {
				list(, , , , $field_ranges_ids) = fn_parse_features_hash($params['features_hash']);
			}

			list($_f, $_view_all) = fn_get_filters_products_count($_params);
			foreach ($_f as $filter_id => $filter) {
				if (!empty($field_range_values[$filter_id])) {
					$_f[$filter_id]['range_values'] = $field_range_values[$filter_id];
				}
			}

			return array($_f, $_view_all);
		}
	}

	return array($filters, $view_all);
}

function fn_searchanise_update_product_feature_post($feature_data, $feature_id, $deleted_variants, $lang_code)
{
	//Send products with Select->Number feature
	if (!empty($feature_id) && !empty($feature_data['feature_type']) && $feature_data['feature_type'] == 'N') {
		$_product_ids = db_get_fields("SELECT product_id FROM ?:product_features_values WHERE feature_id = ?i AND lang_code = ?s", $feature_id, DEFAULT_LANGUAGE);

		if (!empty($_product_ids)) {
			$_product_ids = array_chunk($_product_ids, SE_PRODUCTS_PER_PASS);

			foreach ($_product_ids as $product_ids) {
				fn_se_add_action('update', $product_ids);
			}
		}
	}
}

function fn_searchanise_update_product_filter($filter_data, $filter_id)
{
	fn_se_add_action('facet_update', $filter_id);
}

function fn_searchanise_delete_product_filter($filter_id)
{
	$filter = db_get_row("SELECT * FROM ?:product_filters WHERE filter_id = ?i LIMIT 1", $filter_id);

	if (!empty($filter['feature_id'])) {
		$facet_attribute = 'feature_' . $filter['feature_id'];
	} elseif ($filter['field_type'] == 'P') {
		$facet_attribute = 'price';
	} elseif ($filter['field_type'] == 'F') {
		$facet_attribute = 'free_shipping';
	} elseif ($filter['field_type'] == 'S') {
		$facet_attribute = 'company_id';
	} elseif ($filter['field_type'] == 'A') {
		$facet_attribute = 'amount';
	} else {
		return;
	}
	
	$dublicate = db_get_field("SELECT count(*) FROM ?:product_filters WHERE feature_id = ?i AND field_type = ?s LIMIT 1", $filter['feature_id'], $filter['field_type']);

	if ($dublicate > 1) {
		return; // we have dublicate filter => no request
	}

	fn_se_add_action('facet_delete', $facet_attribute);
}

function fn_se_get_xml_header()
{
	return '<?xml version="1.0" encoding="UTF-8"?>
	<feed xmlns="http://www.w3.org/2005/Atom" xmlns:cs="http://searchanise.com/ns/1.0">
	<title>Searchanise data feed</title>
	<updated>' . date('c') . '</updated>
	<id>' . Registry::get('config.http_location') . '</id>
	';
}

function fn_se_get_xml_footer()
{
	return '</feed>';
}

function fn_se_send_addon_status_request($status = 'enabled', $company_id = NULL, $lang_code = NULL)
{
	$engines_data = fn_se_get_engines_data($company_id, $lang_code, true);

	foreach ($engines_data as $engine_data) {
		$private_key = fn_se_get_private_key($engine_data['company_id'], $engine_data['lang_code']);
		fn_se_send_request('/api/state/update', $private_key, array('addon_status' => $status));
	}
}

function fn_se_send_request($url_part, $private_key, $data)
{
	if (empty($private_key)) {
		return;
	}

	$params = array('private_key' => $private_key) + $data;

	Registry::set('log_cut', true);
	list(, $result) = fn_http_request('POST', SE_SERVICE_URL . $url_part, $params, array(), array(), SE_REQUEST_TIMEOUT);

	$res = fn_se_parse_response($result, false);

	fn_se_set_simple_setting('last_request', TIME);
	return $res;
}

/**
 * Parse response from service
 *
 * @param string $res xml service response
 * @return mixed false if errors returned, true if response is ok, xml object if data was passed in the response
 */
function fn_se_parse_response($res, $show_notification = false)
{
	$xml = simplexml_load_string($res, null, LIBXML_NOERROR);

	if (empty($res) || $xml === false) {
		return false;
	}
	
	if (!empty($xml->error)) {
		foreach ($xml->error as $e) {
			if ($show_notification == true) {
				fn_set_notification('E', fn_get_lang_var('error'), 'Searchanise: ' . (string)$e);
			}
		}

		return false;

	} elseif (strtolower($xml->getName()) == 'ok') {
		return true;

	} else {
		return $xml;
	}
}

function fn_se_parse_state_response($xml, $element = false)
{
	$res = array();
	if (!is_object($xml)) {
		return false;
	}

	if ($xml->getName() == 'variable') {
		foreach($xml as $v) {
			$res[$v->getName()] = (string)$v;
		}
	} else {
		return false;
	}

	if (!empty($element)) {
		$res = isset($res[$element])? $res[$element] : false;
	}

	return $res;
}

function fn_se_get_products_ids($products)
{
	$product_ids = array();
	
	foreach ((array)$products as $v) {
		$product_ids[] = $v['product_id'];
	}
	
	return $product_ids;
}

function fn_se_delete_keys($company_id = NULL, $lang_code = NULL)
{
	$engines_data = fn_se_get_engines_data($company_id, $lang_code, true);
	foreach ($engines_data as $engine_data) {
		$c_id = $engine_data['company_id'];
		$l_code = $engine_data['lang_code'];

		fn_se_send_addon_status_request('deleted', $c_id, $l_code);
		db_query("DELETE FROM ?:se_settings WHERE company_id = ?i AND lang_code = ?s AND name IN ('api_key', 'private_key', 'import_status', 'parent_private_key', 'use_navigation')", $c_id, $l_code);
		db_query("DELETE FROM ?:se_queue WHERE company_id = ?i AND lang_code = ?s", $c_id, $l_code);
	}

	fn_se_get_all_settings(true);// call to update cache
	return true;
}

function fn_searchanise_fn_delete_languages_pre($lang_codes)
{
	foreach ((array)$lang_codes as $lang_code) {
		fn_se_delete_keys(NULL, $lang_code);
	}
}

function fn_searchanise_update_language_post($language_data, $lang_code, $action)
{
	if (fn_se_signup(NULL, $language_data['lang_code'], false) == true) {
		fn_se_queue_import(NULL, $language_data['lang_code'], false);
		fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[language]', $language_data['name'], fn_get_lang_var('text_se_new_engine_language')));
	}
}

function fn_searchanise_delete_company_pre($company_id)
{
	fn_se_delete_keys($company_id, NULL);
}

function fn_searchanise_update_company($company_data, $company_id, $lang_code)
{
	if (fn_se_signup($company_id, NULL, false) == true) {
		fn_se_queue_import($company_id, NULL, false);
		fn_set_notification('N', fn_get_lang_var('notice'), str_replace('[store]', $company_data['company'], fn_get_lang_var('text_se_new_engine_store')));
	}
}

function fn_se_check_import_is_done($company_id = NULL, $lang_code = NULL)
{
	$skip_time_check = false;
	$engines_data = fn_se_get_engines_data($company_id, $lang_code);

	foreach ($engines_data as $engine_data) {
		$c_id = $engine_data['company_id'];
		$l_code = $engine_data['lang_code'];

		if ($engine_data['import_status'] == 'sent' && ((TIME - fn_se_get_simple_setting('last_request')) > 10 || $skip_time_check == true)) {
			$xml = fn_se_send_request('/api/state/get', fn_se_get_private_key($c_id, $l_code), array('status' => '', 'full_import' => ''));

			$variables = fn_se_parse_state_response($xml);

			if (!empty($variables) && $variables['status'] == 'normal' && $variables['full_import'] == 'done') {
				$skip_time_check = true;
				fn_se_set_import_status('done', $c_id, $l_code);
			} elseif (!empty($variables) && $variables['status'] == 'disabled') {
				fn_se_set_import_status('none', $c_id, $l_code);//disable status check for disabled engine
			}
		}

	}
}

?>