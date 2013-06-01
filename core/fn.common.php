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

/**
 * Returns True if the object can be saved, otherwise False. 
 * 
 * @param array $object_data Object data
 * @param string $object_type Object name
 * @param bool $skip_edition_checking Skip edition checking condition
 * @return bool Returns True if the object can be saved, otherwise False. 
 */
function fn_allow_save_object($object_data, $object_type, $skip_edition_checking = false) {
	/**
	 * Perform actions before object checking
	 * 
	 * @param array $object_data Object data
	 * @param string $object_type Object name
	 */
	fn_set_hook('allow_save_object_pre', $object_data, $object_type);

	$allow = true;

	if ($skip_edition_checking) {
		if (defined('COMPANY_ID')) {
			$allow = false;
		}

	} else {
		if ((PRODUCT_TYPE == 'ULTIMATE' || PRODUCT_TYPE == 'MULTIVENDOR') && isset($object_data['company_id']) && defined('COMPANY_ID') && COMPANY_ID != $object_data['company_id']) {
			$allow = false;
		}
	}

	/**
	 * Perform actions after object checking
	 * 
	 * @param array $object_data Object data
	 * @param string $object_type Object name
	 * @param string $allow True if the object can be saved, otherwise False. 
	 */
	fn_set_hook('allow_save_object_post', $object_data, $object_type, $allow);

	return $allow;
}

/**
 * Returns skin_path in the required format
 * 
 * Examples:
 * /var/www/shop/skins/basic/customer/ -> fn_get_skin_path('[skin]/customer/', 'customer')
 * /var/www/shop/skins/basic/admin/index.tpl -> fn_get_skin_path('[skin]/admin/index.tpl', 'admin')
 * /var/www/shop/skins/ -> fn_get_skin_path('', '')
 * /var/www/shop/skins/basic/ -> fn_get_skin_path('[skin]', 'customer')
 * /var/www/shop/skins/basic/mail -> fn_get_skin_path('[skin]/mail/', 'customer') 
 * 
 * In format string:
 * [skin] will be replaced by actual skin name 
 * [repo] will be replaced by real path to repository
 * [skins] will be replaced by real path of actual skins folder
 * [relative] will be replaced by path of actual skins folder relative DIR_ROOT
 * 
 * @param $path string Format string. 
 * @param $zone string Zone to get setting for
 * @param $company_id int Company identifier
 * @return string Path to skin
 */
function fn_get_skin_path($path = '[skin]/customer/', $zone = AREA_NAME, $company_id = null) {
	fn_set_hook('get_skin_path_pre', $path, $zone, $company_id, $cache);
	$zone = $zone == 'mail' ? 'customer' : $zone;

	$cache_name = 'runtime.skin_names.' . $company_id . '.' . $zone;
	Registry::register_cache($cache_name, array('settings', 'addons'), CACHE_LEVEL_STATIC);

	if (Registry::is_exist($cache_name) == true) {
		$skin_name = Registry::get($cache_name);
	} else {
		$demo_skin = fn_get_session_data('demo_skin');
		if (!empty($demo_skin[AREA])) {
			$skin_name = $demo_skin[AREA];
		} else {
			$skin_name = CSettings::instance()->get_value('skin_name_' . $zone, '', $company_id);
		}

		Registry::set($cache_name, $skin_name);
	}

	$path = str_replace('[skin]', $skin_name, $path);

	fn_set_hook('get_skin_path', $skin_name, $path, $zone, $company_id);

	$path = str_replace('[relative]', 'skins', $path);
	$path = str_replace('[skins]', fn_remove_trailing_slash(DIR_SKINS), $path);
	$path = str_replace('[repo]', DIR_ROOT . '/var/skins_repository', $path);

	return $path;
}

/**
 * Prints any data like a print_r function
 * @param mixed Any data to be printed
 */
function fn_print_r()
{
	static $count = 0;
	$args = func_get_args();

	if (!empty($args)) {
		echo '<ol style="font-family: Courier; font-size: 12px; border: 1px solid #dedede; background-color: #efefef; float: left; padding-right: 20px;">';
		foreach ($args as $k => $v) {
			$v = htmlspecialchars(print_r($v, true));
			if ($v == '') {
				$v = '    ';
		}

			echo '<li><pre>' . $v . "\n" . '</pre></li>';
		}
		echo '</ol><div style="clear:left;"></div>';
	}
	$count++;
}

/**
* Redirect browser to the new location
*
* @param string location - destination of redirect
* @param bool no_delay - do not delay redirection if output was performed
* @param bool allow_external_redirect - allow redirection to external resource
* @return
*/
function fn_redirect($location, $no_delay = false, $allow_external_redirect = false)
{
	$external_redirect = false;
	$protocol = defined('HTTPS') ? 'https' : 'http';

	// Cleanup location from &amp; signs and call fn_url()
	$location = str_replace('&amp;', '&', fn_url(str_replace(array("\n", "\r"), array('', ''), $location)));

	// Convert absolute link with location to relative one
	if (strpos($location, '://') !== false || substr($location, 0, 7) == 'mailto:') {
		if (strpos($location, Registry::get('config.http_location')) !== false) {
			$location = str_replace(array(Registry::get('config.http_location') . '/', Registry::get('config.http_location')), '', $location);
			$protocol = 'http';

		} elseif (strpos($location, Registry::get('config.https_location')) !== false) {
			$location = str_replace(array(Registry::get('config.https_location') . '/', Registry::get('config.https_location')), '', $location);
			$protocol = 'https';

		} else {
			if ($allow_external_redirect == false) { // if external redirects aren't allowed, redirect to index script
				$location = INDEX_SCRIPT;
			} else {
				$external_redirect = true;
			}
		}

	// Convert absolute link without location to relative one
	} else {
		$_protocol = "";
		$http_path = Registry::get('config.http_path');
		$https_path = Registry::get('config.https_path');
		if (!empty($http_path) && substr($location, 0, strlen($http_path)) == $http_path) {
			$location = substr($location, strlen($http_path) + 1);
			$_protocol = 'http';

		} elseif (!empty($https_path) && substr($location, 0, strlen($https_path)) == $https_path) {
			$location = substr($location, strlen($https_path) + 1);
			$_protocol = 'https';
		}
		$protocol = (Registry::get('config.http_path') != Registry::get('config.https_path') && !empty($_protocol))? $_protocol : $protocol;
	}

	if ($external_redirect == false) {

		fn_set_hook('redirect', $location);

		$protocol_changed = (defined('HTTPS') && $protocol == 'http') || (!defined('HTTPS') && $protocol == 'https');

		// For correct redirection, location must be absolute with path
		$location = (($protocol == 'http') ? Registry::get('config.http_location') : Registry::get('config.https_location')) . '/' . ltrim($location, '/');

		// Parse the query string
		$fragment = '';
		$query_array = array();
		$parced_location = parse_url($location);
		if (!empty($parced_location['query'])) {
			parse_str($parced_location['query'], $query_array);
			$location = str_replace('?' . $parced_location['query'], '', $location);
		}

		if (!empty($parced_location['fragment'])) {
			$fragment = '#' . $parced_location['fragment'];
			$location = str_replace($fragment, '', $location);
		}

		if ($protocol_changed && (Registry::get('config.http_host') != Registry::get('config.https_host') || Registry::get('config.http_path') != Registry::get('config.https_path'))) {
			$query_array[SESS_NAME] = Session::get_id();
		}

		// If this is not ajax request, remove ajax specific parameters
		if (!defined('AJAX_REQUEST')) {
			unset($query_array['is_ajax']);
			unset($query_array['result_ids']);
		} else {
			$query_array['result_ids'] = implode(',', Registry::get('ajax')->result_ids);
			$query_array['is_ajax'] = Registry::get('ajax')->redirect_type;
			$query_array['full_render'] = !empty($_REQUEST['full_render']) ? $_REQUEST['full_render'] : false;

			$ajax_assigned_vars = Registry::get('ajax')->get_assigned_vars();
			if (!empty($ajax_assigned_vars['html'])) {
				unset($ajax_assigned_vars['html']);
			}
			$query_array['_ajax_data'] = $ajax_assigned_vars;

			fn_define('AJAX_REDIRECT', true);
		}

		if (!empty($query_array)) {
			$location .= '?' . fn_build_query($query_array) . $fragment;
		}

		// Redirect from https to http location
		if ($protocol_changed && defined('HTTPS')) {
			$no_delay = true;

			fn_define('META_REDIRECT', true);
		}
	}

	fn_set_hook('redirect_complete');

	if (!ob_get_contents() && !headers_sent() && !defined('META_REDIRECT')) {
		header('Location: ' . $location);
		exit;
	} else {
		$delay = (Registry::get('runtime.comet') == true || $no_delay == true) ? 0 : 10;
		if ($delay != 0) {
			fn_echo('<a href="' . htmlspecialchars($location) . '" style="text-transform: lowercase;">' . fn_get_lang_var('continue') . '</a>');
		}
		fn_echo('<meta http-equiv="Refresh" content="' . $delay . ';URL=' . htmlspecialchars($location) . '" />');
	}

	fn_flush();
	exit;
}

/**
 * Functions check if subarray with child exists in the given array
 * 
 * @param array $data Array with nodes
 * @param string $childs_name Name of array with child nodes
 * @return boolean true if there are child subarray, false otherwise.
 */
function fn_check_second_level_child_array($data, $childs_name)
{
	foreach ($data as $l2) {
		if (!empty($l2[$childs_name]) && is_array($l2[$childs_name]) && count($l2[$childs_name])) {
			return true;
		}
	}
	
	return false;
}

/**
 * Set notification message
 *
 * @param string $type notification type (E - error, W - warning, N - notice, O - order error on checkout)
 * @param string $title notification title
 * @param string $message notification message
 * @param string $message_state (S - notification will be displayed unless it's closed, K - only once, I - will be closed by timer)
 * @param mixed $extra extra data to save with notification
 * @return boolean always true
 */
function fn_set_notification($type, $title, $message, $message_state = '', $extra = '')
{
	// Back compabilities code
	if ($message_state === false) {
		$message_state = 'K';
		
	} elseif ($message_state === true) {
		$message_state = 'S';
	}
	// \back compabilities code
	
	if (empty($message_state) && $type == 'N') {
		$message_state = 'I';
		
	} elseif (empty($message_state)) {
		$message_state = 'K';
	}
	
	if (empty($_SESSION['notifications'])) {
		$_SESSION['notifications'] = array();
	}

	$key = md5($type . $title . $message . $extra);

	$_SESSION['notifications'][$key] = array(
		'type' => $type,
		'title' => $title,
		'message' => $message,
		'message_state' => $message_state,
		'new' => true,
		'extra' => $extra
	);

	return true;
}

/**
 * Set notification message
 *
 * @param string $extra condition for "extra" parameter
 * @return boolean always true
 */
function fn_delete_notification($extra)
{
	if (!empty($_SESSION['notifications'])) {
		foreach ($_SESSION['notifications'] as $k => $v) {
			if (!empty($v['extra']) && $v['extra'] == $extra) {
				unset($_SESSION['notifications'][$k]);
			}
		}
	}

	return true;
}

/**
 * Check for existing notification message
 *
 * @param string $type notification type - A - any, E - extra (in this case second "value" parameter is required)
 * @param string $value value of the "extra" parameter
 * @return boolean always true
 */
function fn_notification_exists($type, $value)
{
	if (!empty($_SESSION['notifications'])) {
		if ($type == 'A') {
			return true;
		}

		foreach ($_SESSION['notifications'] as $k => $v) {
			if (!empty($v['extra']) && $v['extra'] == $value) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Gets notifications list
 *
 * @return array notifications list
 */
function fn_get_notifications()
{
	if (empty($_SESSION['notifications'])) {
		$_SESSION['notifications'] = array();
	}

	$_notifications = array();

	foreach ($_SESSION['notifications'] as $k => $v) {
		// Display notification if this is not ajax request, or ajax request and notifiactions was just set
		if (!defined('AJAX_REQUEST') || (defined('AJAX_REQUEST') && $v['new'] == true)) {
			$_notifications[$k] = $v;
		}

		if ($v['message_state'] != 'S') {
			unset($_SESSION['notifications'][$k]);
		} else {
			$_SESSION['notifications'][$k]['new'] = false; // preparing notification for display, reset new flag
		}
	}

	return $_notifications;
}

/**
 * Sets all post data, excluding dispatch
 *
 * @return boolean always true
 */
function fn_save_post_data()
{
	unset($_POST['dispatch']);
	$_SESSION['saved_post_data'] = (defined('QUOTES_ENABLED'))? fn_strip_slashes($_POST) : $_POST;

	return true;
}

/**
 * Gets language variable by name
 *
 * @param string $var_name Language variable name
 * @param string $lang_code 2-letter language code
 *
 * @return string Language variable value; in case the value is absent, Language variable name is returned
 */
function fn_get_lang_var($var_name, $lang_code = CART_LANGUAGE, $return_boolean = false)
{
	if (strlen($var_name)==0) {
		return '';
	}

	$lang_cache = & Registry::get('lang_cache');

	if (!is_array($lang_cache)) {
		$lang_cache = array();
	}
	
	$fields = array(
		'lang.value' => true,
	);
	
	$tables = array(
		'?:language_values lang',
	);
	
	$left_join = array();
	
	$condition = array(
		db_quote('lang.lang_code = ?s', $lang_code),
		db_quote('lang.name = ?s', $var_name),
	);

	fn_set_hook('get_lang_var', $fields, $tables, $left_join, $condition);

	$joins = !empty($left_join) ? ' LEFT JOIN ' . implode(', ', $left_join) : '';

	if (!isset($lang_cache[$lang_code][$var_name])) {
		$lang_cache[$lang_code][$var_name] = db_get_field('SELECT ' . implode(', ', array_keys($fields)) . ' FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition));
	}

	if (is_null($lang_cache[$lang_code][$var_name])) {
		if (!$return_boolean) {
			return '_' . $var_name;
		} else {
			return false;
		}
	}

	if (Registry::get('settings.translation_mode') == 'Y' && defined('TRANSLATION_MODE')) {
		return '[lang name=' . $var_name . (preg_match('/\[[\w]+\]/', $lang_cache[$lang_code][$var_name]) ? ' cm-pre-ajax' : '') . ']' . $lang_cache[$lang_code][$var_name] . '[/lang]';
	} else {
		return $lang_cache[$lang_code][$var_name];
	}
}
 
/**
 * Gets language variables by prefix
 *
 * @param string $prefix Language variable prefix
 * @param $lang_code 2-letter language code
 *
 * @return Array of language variables
 */
function fn_get_lang_vars_by_prefix($prefix, $lang_code = CART_LANGUAGE)
{
	$lang_cache = & Registry::get('lang_cache');

	if (!is_array($lang_cache)) {
		$lang_cache = array();
	}

	$lang_vars = array();

	$fields = array(
		'lang.value' => true,
		'lang.name' => true,
	);
	
	$tables = array(
		'?:language_values lang',
	);
	
	$left_join = array();
	
	$condition = array(
		db_quote('lang.lang_code = ?s', $lang_code),
		db_quote('lang.name LIKE ?l', $prefix . '%'),
	);

	fn_set_hook('get_lang_var', $fields, $tables, $left_join, $condition);

	$joins = !empty($left_join) ? ' LEFT JOIN ' . implode(', ', $left_join) : '';

	$result = db_get_hash_array('SELECT ' . implode(', ', array_keys($fields)) . ' FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition), 'name');
	
	if (!empty($result)) {
		foreach ($result as $var_name => $value_info) {
			$lang_cache[$lang_code][$var_name] = $value_info['value'];
			
			if (Registry::get('settings.translation_mode') == 'Y') {
				$lang_vars[$var_name] = '[lang name=' . $var_name . (preg_match('/\[[\w]+\]/', $lang_cache[$lang_code][$var_name]) ? ' cm-pre-ajax' : '') . ']' . $lang_cache[$lang_code][$var_name] . '[/lang]';
			} else {
				$lang_vars[$var_name] = $lang_cache[$lang_code][$var_name];
			}
		}
	}

	return $lang_vars;
}

/**
 * Loads received language variables into language cache
 *
 * @param array $var_names Language variable that to be loaded
 * @param string $lang_code 2-letter language code
 *
 * @return boolean True if any of received language variables were added into cache; false otherwise
 */
function fn_preload_lang_vars($var_names, $lang_code = CART_LANGUAGE)
{
	$lang_cache = & Registry::get('lang_cache');

	if (!is_array($lang_cache)) {
		$lang_cache = array();
	}

	if (empty($lang_cache[$lang_code])) {
		$lang_cache[$lang_code] = array();
	}

	$var_names = array_diff($var_names, array_keys($lang_cache[$lang_code]));

	$fields = array(
		'lang.name' => true,
		'lang.value' => true,
	);
	
	$tables = array(
		'?:language_values lang',
	);
	
	$left_join = array();
	
	$condition = array(
		db_quote('lang.lang_code = ?s', $lang_code),
		db_quote('lang.name IN (?a)', $var_names),
	);

	fn_set_hook('get_lang_var', $fields, $tables, $left_join, $condition);

	$joins = !empty($left_join) ? ' LEFT JOIN ' . implode(', ', $left_join) : '';

	if (!empty($var_names)) {
		$lang_cache[$lang_code] = fn_array_merge($lang_cache[$lang_code], db_get_hash_single_array('SELECT ' . implode(', ', array_keys($fields)) . ' FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition), array('name', 'value')));

		return true;
	}

	return false;
}


function fn_update_lang_objects($tpl_var, &$value)
{
	static $translation_mode, $init = false;
	if (!$init) {
		$translation_mode = Registry::get('settings.translation_mode');
		$init = true;
	}
	
	if ($translation_mode == 'Y') {
		static $schema;
		if (empty($schema)) {
			$schema = fn_get_schema('translate', 'schema');
		}

		if (!empty($schema[CONTROLLER][MODE])) {
			foreach ($schema[CONTROLLER][MODE] as $var_name => $var) {
				if ($tpl_var == $var_name && fn_is_allow_to_translate_language_object($var)) {
					fn_prepare_lang_objects($value, $var['dimension'], $var['fields'], $var['table_name'], $var['where_fields'], (isset($var['inner']) ? $var['inner'] : ''), (isset($var['unescape']) ? $var['unescape'] : ''));
				}
			}
		}
		foreach ($schema['any']['any'] as $var_name => $var) {
			if ($tpl_var == $var_name && fn_is_allow_to_translate_language_object($var)) {
				fn_prepare_lang_objects($value, $var['dimension'], $var['fields'], $var['table_name'], $var['where_fields'], (isset($var['inner']) ? $var['inner'] : ''), (isset($var['unescape']) ? $var['unescape'] : ''));
			}
		}
	}
}

function fn_is_allow_to_translate_language_object($language_object) 
{
	$allow = false;

	$root_only = isset ($language_object['root_only']) ?  $language_object['root_only'] : false;
	$vendor_only = isset ($language_object['vendor_only']) ?  $language_object['vendor_only'] : false;
	
	if (($root_only == $vendor_only) || (!defined('COMPANY_ID') && $root_only) || (defined('COMPANY_ID') && $vendor_only)) {
		$allow = true;
	}

	return $allow;
}

function fn_prepare_lang_objects(&$destination, $dimension, $fields, $table, $field_id, $inner = '', $unescape = '')
{
	if ($dimension > 0) {
		foreach ($destination as $i => $v) {
			fn_prepare_lang_objects($destination[$i], $dimension - 1, $fields, $table, $field_id, $inner, $unescape);
		}
	} else {
		foreach ($fields as $i => $v) {
			if (isset($destination[$v])) {
				$where_fields = '';
				foreach ($field_id as $to_name => $orig_name) {
					if (is_array($orig_name)) {
						foreach ($orig_name as $val) {
							if (!empty($destination[$val])) {
								$where_fields .= '-' . $to_name . '-' . $destination[$val];
							}
						}
					} else {
						$where_fields .= '-' . $to_name . '-' . $destination[$orig_name];
					}
				}
				$what = is_string($i) ? $i : $v;
				
				if ($unescape) {
					$destination[$v] = htmlspecialchars_decode($destination[$v]);
				}

				$pattern = '/\[(lang) name\=([\w-]+?)( [cm\-pre\-ajx]*)?\](.*?)\[\/\1\]/is';
				if (!preg_match($pattern, $destination[$v])) {
					$destination[$v] = "[lang name=$table-$what$where_fields]$destination[$v][/lang]";
				}
				if (!empty($inner) && isset($destination[$inner[0]])) {
					fn_prepare_lang_objects($destination[$inner[0]], $inner[1], $fields, $table, $field_id, false, $unescape);
				}
			}
		}
	}
}

/**
 * This function is deprecated and no longer used.
 * Its reference is kept to avoid fatal error occurances.
 *
 * @deprecated deprecated since version 3.0
 */
function fn_get_setting_description($object_id, $object_type = 'S', $lang_code = CART_LANGUAGE)
{
	fn_generate_deprecated_function_notice('fn_get_setting_description()', 'Settings::get_description($name, $lang_code)');
	return false;	
}

/**
 * Function defines and assigns pages
 *
 * @param integer $page Number of page
 * @param integer $total_items Total number of items
 * @param integer $items_per_page Number of items for displayin on one page
 * @param boolead $get_limit Get only 'LIMIT' part of db-query
 * @param string $object_type Type of pagination object. Will be used as key in $pagination_objects (array with pagination data)
 * @return string 'LIMIT' part of db-query
 */
function fn_paginate($page = 1, $total_items = 10, $items_per_page = 10, $get_limit = false, $object_type = '')
{
	// Avoid meaningless string and zero values 
	$items_per_page = intval($items_per_page);
	if (empty($items_per_page)) {
		$items_per_page = 10;
	}

	$deviation = 7;
	$max_pages = $per_page = 10;
	$original_ipp = $items_per_page;
	$navi_ranges = array();

	if (!empty($_REQUEST['items_per_page'])) {
		$_SESSION['items_per_page'] = $_REQUEST['items_per_page'] > 0 ? $_REQUEST['items_per_page'] : 1;
	}

	if (!empty($_SESSION['items_per_page'])) {
		$items_per_page = $_SESSION['items_per_page'];
	}
	
	$items_per_page = empty($items_per_page) ? $per_page : (int)$items_per_page;
	$total_pages = ceil((int)$total_items / $items_per_page);

	$page = (int) $page;
	if ($page < 1) {
		$page = 1;	
	}
    
	if ($get_limit == false) {
		if ($total_items == 0 || $page == 'full_list') {
			Registry::get('view')->assign('pagination', '');
			return '';
		}

		if ($page > $total_pages) {
			$page = 1;
		}
		    
		// Pagination in other areas displayed as in any search engine
		$page_from = fn_get_page_from($page, $deviation);
		$page_to = fn_get_page_to($page, $deviation, $total_pages);

		$pagination = array (
			'navi_pages' => range($page_from, $page_to),
			'prev_range' => ($page_from > 1) ? $page_from - 1 : 0,
			'next_range' => ($page_to < $total_pages) ? $page_to + 1: 0,
			'current_page' => $page,
			'prev_page' => ($page > 1) ? $page - 1 : 0,
			'next_page' => ($page < $total_pages) ? $page + 1 : 0,
			'total_pages' => $total_pages,
			'total_items' => $total_items,
			'navi_ranges' => $navi_ranges,
			'items_per_page' => $items_per_page,
			'per_page_range' => range($per_page, $per_page * $max_pages, $per_page)
		);

		if ($pagination['prev_range']) {
			$pagination['prev_range_from'] = fn_get_page_from($pagination['prev_range'], $deviation);
			$pagination['prev_range_to'] = fn_get_page_to($pagination['prev_range'], $deviation, $total_pages);
		}

		if ($pagination['next_range']) {
			$pagination['next_range_from'] = fn_get_page_from($pagination['next_range'], $deviation);
			$pagination['next_range_to'] = fn_get_page_to($pagination['next_range'], $deviation, $total_pages);
		}

		if (!in_array($original_ipp, $pagination['per_page_range'])) {
			$pagination['per_page_range'][] = $original_ipp;
			sort($pagination['per_page_range']);
		}

		$pagination['product_steps'] = fn_get_product_pagination_steps();

		Registry::get('view')->assign('pagination', $pagination);
		
		if (!empty($object_type)) {
			$pagination_objects = Registry::get('view')->get_var('pagination_objects');
			$pagination_objects[$object_type] = $pagination;
			Registry::get('view')->assign('pagination_objects', $pagination_objects);
		}
	}

	return 'LIMIT ' . (($page - 1) * $items_per_page) . ", $items_per_page";
}

function fn_get_product_pagination_steps()
{
	$min_range = Registry::get('settings.Appearance.columns_in_products_list') * 4;
	$max_ranges = 4;
	$steps = array();

	for ($i = 0; $i < $max_ranges; $i++) {
		$steps[] = $min_range;
		$min_range = $min_range * 2;
	}

	$steps[] = (int)Registry::get('settings.Appearance.products_per_page');

	$steps = array_unique($steps);

	sort($steps, SORT_NUMERIC);

	return $steps;
}

function fn_get_page_from($page, $deviation)
{
	return ($page - $deviation < 1) ? 1 : $page - $deviation;
}

function fn_get_page_to($page, $deviation, $total_pages)
{
	return ($page + $deviation > $total_pages) ? $total_pages : $page + $deviation;
}

//
// This function splits the array into defined number of columns to
// show it in the frontend
// Params:
// $data - the array that should be splitted
// $size - number of columns/rows to split into
// Example:
// array (a, b, c, d, e, f, g, h, i, j, k);
// fn_split($array, 3);
// Result:
// 0 -> a, b, c, d
// 1 -> e, f, g, h
// 2 -> i, j, k
// ---------------------
// fn_split($array, 3, true)
// Result:
//

function fn_split($data, $size, $vertical_delimition = false, $size_is_horizontal = true)
{

	if ($vertical_delimition == false) {
		return array_chunk($data, $size);
	} else {

		$chunk_count = ($size_is_horizontal == true) ? ceil(count($data) / $size) : $size;
		$chunk_index = 0;
		$chunks = array();
		foreach ($data as $key => $value) {
			$chunks[$chunk_index][] = $value;
			if (++$chunk_index == $chunk_count) {
				$chunk_index = 0;
			}
		}
		return $chunks;
	}
}

//
// Advanced checking for variable emptyness
//
function fn_is_empty($var)
{
    if (!is_array($var)) {
		return (empty($var));
    } else {
        foreach ($var as $k => $v) {
			if (empty($v)) {
				unset($var[$k]);
				continue;
			}

			if (is_array($v) && fn_is_empty($v)) {
				unset($var[$k]);
            }
        }
        return (empty($var)) ? true : false;
    }
}

function fn_is_not_empty($var)
{
	return !fn_is_empty($var);
}

//
// Format price
//

function fn_format_price($price = 0, $currency = CART_PRIMARY_CURRENCY, $decimals = null, $return_as_float = true)
{
	if ($decimals === null) {
		$currency_settings = Registry::get('currencies.' . $currency);
		$decimals = !empty($currency_settings)? $currency_settings['decimals'] + 0 : 2; //set default value if not exist
	}
	$price = sprintf('%.' . $decimals . 'f', round((double) $price + 0.00000000001, $decimals));
	
	return $return_as_float ? (float) $price : $price;
}


//
// Parse email template and attach images
//
function fn_attach_images($body, &$mailer)
{
	$http_location = Registry::get('config.http_location');
	$https_location = Registry::get('config.https_location');
	$http_path = Registry::get('config.http_path');
	$https_path = Registry::get('config.https_path');

	$files = array();
	if (preg_match_all("/(?<=\ssrc=|\sbackground=)('|\")(.*)\\1/SsUi", $body, $matches)) {
		$files = fn_array_merge($files, $matches[2], false);
	}
	if (preg_match_all("/(?<=\sstyle=)('|\").*url\(('|\"|\\\\\\1)(.*)\\2\).*\\1/SsUi", $body, $matches)) {
		$files = fn_array_merge($files, $matches[3], false);
	}
	if (empty($files)) {
		return $body;
	} else {
		$files = array_unique($files);
		foreach ($files as $k => $_path) {
			$cid = 'csimg'.$k;
			$path = str_replace('&amp;', '&', $_path);

			$real_path = '';
			// Replace url path with filesystem if this url is NOT dynamic
			if (strpos($path, '?') === false && strpos($path, '&') === false) {
				if (($i = strpos($path, $http_location)) !== false) {
					$real_path = substr_replace($path, DIR_ROOT, $i, strlen($http_location));
				} elseif (($i = strpos($path, $https_location)) !== false) {
					$real_path = substr_replace($path, DIR_ROOT, $i, strlen($https_location));
				} elseif (!empty($http_path) && ($i = strpos($path, $http_path)) !== false) {
					$real_path = substr_replace($path, DIR_ROOT, $i, strlen($http_path));
				} elseif (!empty($https_path) && ($i = strpos($path, $https_path)) !== false) {
					$real_path = substr_replace($path, DIR_ROOT, $i, strlen($https_path));
				}
			}

			if (empty($real_path)) {
				$real_path = (strpos($path, '://') === false) ? $http_location .'/'. $path : $path;
			}

			list($width, $height, $mime_type) = fn_get_image_size($real_path);

			if (!empty($width)) {
				$cid .= '.' . fn_get_image_extension($mime_type);
				$content = fn_get_contents($real_path);
				$mailer->AddImageStringAttachment($content, $cid, 'base64', $mime_type);
				$body = preg_replace("/(['\"])" . str_replace("/", "\/", preg_quote($_path)) . "(['\"])/Ss", "\\1cid:" . $cid . "\\2", $body);
			}
		}
	}

	return $body;
}

//
// Send email
//
function fn_send_mail($to, $from, $subj, $body, $attachments = array(), $lang_code = CART_LANGUAGE, $reply_to = '', $is_html = true, $company_id = null)
{
	fn_disable_translation_mode();
	$__from = array();
	$__to = array();

	fn_init_mailer();
	$mailer = & Registry::get('mailer');

	fn_set_hook('send_mail_pre', $mailer, $to, $from, $subj, $body, $attachments, $lang_code, $reply_to, $is_html);

	Registry::get('view_mail')->setLanguage($lang_code);

	if (!empty($reply_to)) {
		$mailer->ClearReplyTos();
		$reply_to = fn_format_emails($reply_to);
		foreach ($reply_to as $rep_to) {
			$mailer->AddReplyTo($rep_to);
		}
	}

	if (!is_array($from)) {
		$__from['email'] = $from;
	} else {
		$__from = $from;
	}
	if (empty($__from['email'])) {
		$__from['email'] = Registry::get('settings.Company.company_site_administrator');
	}
	if (empty($__from['name'])) {
		$__from['name'] = Registry::get('settings.Company.company_name');
	}
	$mailer->SetFrom($__from['email'], $__from['name']);

	$mailer->IsHTML($is_html);
	$mailer->CharSet = CHARSET;
	$mailer->Subject = Registry::get('view_mail')->display_mail($subj, false, $company_id);
	$mailer->Subject = trim($mailer->Subject);
	$body = Registry::get('view_mail')->display_mail($body, false, $company_id);
	$mailer->Body = fn_attach_images($body, $mailer);

	if (!empty($attachments)) {
		foreach ($attachments as $name => $file) {
			$mailer->AddAttachment($file, $name);
		}
	}

	$__to = fn_format_emails($to);

	foreach ($__to as $v) {
		$mailer->ClearAddresses();
		$mailer->AddAddress($v, '');
		$result = $mailer->Send(); 
		if (!$result) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_message_not_sent') . ' ' . $mailer->ErrorInfo);
		}

		fn_set_hook('send_mail', $mailer);
	}
	return $result;
}

function fn_format_emails($emails)
{
	$result = array();
	if (!is_array($emails)) {
		$emails = array($emails);
	}
	foreach ($emails as $email) {
		$email = str_replace(';', ',', $email);
		$res = explode(',', $email);
		foreach ($res as &$v) {
			$v = trim($v);
		}
		$result = array_merge($result, $res);
	}
	return array_unique($result);
}

/**
* Send back in stock notifications for subscribed customers
*
* @param int $product_id product id
* @return boolean always true
*/
function fn_send_product_notifications($product_id)
{
	if (empty($product_id)) {
		return false;
	}
	$emails = db_get_fields("SELECT email FROM ?:product_subscriptions WHERE product_id = ?i", $product_id);

	if (!empty($emails)) {
		$product['name'] = fn_get_product_name($product_id, Registry::get('settings.Appearance.customer_default_language'));

		Registry::get('view_mail')->assign('product', $product);
		Registry::get('view_mail')->assign('product_id', $product_id);
		Registry::get('view_mail')->assign('company_info', Registry::get('settings.Company'));

		fn_send_mail($emails, Registry::get('settings.Company.company_orders_department'), 'product/back_in_stock_notification_subj.tpl', 'product/back_in_stock_notification.tpl', '', Registry::get('settings.Appearance.customer_default_language'), Registry::get('settings.Company.company_orders_department')); 

		db_query("DELETE FROM ?:product_subscriptions WHERE product_id = ?i", $product_id);
	}

	return true;
}

/**
 * Add new node the breadcrumbs
 *
 * @param string $lang_value name of language variable
 * @param string $link breadcrumb URL
 * @param boolean $nofollow Include or not "nofollow" attribute
 * @return boolean True if breadcrumbs were added, false otherwise
 */
function fn_add_breadcrumb($lang_value, $link = '', $nofollow = false)
{
	//check permissions in admin area
	if (AREA == 'A' && !fn_check_view_permissions($link, 'GET')) {
		return false;
	}

	$bc = Registry::get('view')->get_var('breadcrumbs');

	if (!empty($link)) {
		fn_set_hook('add_breadcrumb', $lang_value, $link);
	}

	$bc[] = array(
		'title' => fn_html_escape($lang_value, true),  // unescape value to avoid double escaping
		'link' => $link,
		'nofollow' => $nofollow,
	);

	Registry::get('view')->assign('breadcrumbs', $bc);

	return true;
}

/**
 * Merge several arrays preserving keys (recursivelly!) or not preserving
 *
 * @param array ... unlimited number of arrays to merge
 * @param bool ... if true, the array keys are preserved
 * @return array merged data
 */
function fn_array_merge()
{
	$arg_list = func_get_args();
	$preserve_keys = true;
	$result = array();
	if (is_bool(end($arg_list))) {
		$preserve_keys = array_pop($arg_list);
	}

	foreach ((array)$arg_list as $arg) {
		foreach ((array)$arg as $k => $v) {
			if ($preserve_keys == true) {
				$result[$k] = !empty($result[$k]) && is_array($result[$k]) ? fn_array_merge($result[$k], $v) : $v;
			} else {
				$result[] = $v;
			}
		}
	}

	return $result;
}

//
// Restore original variable content (unstripped)
// Parameters should be the variables names
// E.g. fn_trusted_vars("product_data","big_text","etcetc")
function fn_trusted_vars()
{
	$args = func_get_args();
	if (sizeof($args) > 0) {
		foreach ($args as $k => $v) {
			if (isset($_POST[$v])) {
				$_REQUEST[$v] = (!defined('QUOTES_ENABLED')) ? $_POST[$v] : fn_strip_slashes($_POST[$v]);
			} elseif (isset($_GET[$v])) {
				$_REQUEST[$v] = (!defined('QUOTES_ENABLED')) ? $_GET[$v] : fn_strip_slashes($_GET[$v]);
			}
		}
	}

	return true;
}

// EnCrypt text wrapper function
function fn_encrypt_text($text)
{
	if (!defined('CRYPT_STARTED')) {
		fn_init_crypt();
	}

	return base64_encode(Registry::get('crypt')->encrypt($text));
}

// DeCrypt text wrapper function
function fn_decrypt_text($text)
{

	if (!defined('CRYPT_STARTED')) {
		fn_init_crypt();
	}

	return Registry::get('crypt')->decrypt(base64_decode($text));
}

//
// Get settings
//
function fn_get_settings($section_id = '', $subsection_id = '')
{
	fn_generate_deprecated_function_notice('fn_get_settings()', 'Settings::instance()->get_values()');
	return CSettings::instance()->get_values();
}

/**
 * Function updates the value of given setting, cause in some editions we need to update corresponding tables
 *
 * @param string $option_name Name of setting
 * @param string $value New value of setting
 * @param string $section_id Name of settings' section
 * @param string $subsection_id Name of settings' subsection
 * @param boolean $global_update Update or not ?:settings table (key for ULT)
 * @return type 
 */
function fn_set_setting_value($option_name, $value, $section_id = '', $subsection_id = '', $global_update = true)
{	
	fn_generate_deprecated_function_notice('fn_set_setting_value()', 'Settings::instance()->update_value()');
	//fn_set_hook('set_setting_value', $setting_name, $value, $section_id, $subsection_id, $global_update, $condition);
			
	CSettings::instance()->update_value($option_name, $value, $section_id);
	
	return true;
}

function fn_settings_get_sections()
{
	if (fn_check_view_permissions('settings.manage', 'GET')) {
		fn_generate_deprecated_function_notice('fn_settings_get_sections()', 'Settings::instance()->get_core_sections()');
		return CSettings::instance()->get_values();
	} else {
		$sections = array();
	}
	
	return $sections;
}

/**
 * Function returns part of SQL query to get object description from the settings_descriptions table;
 * 
 * @param int $object_id
 * @param string $object_type
 * @param string $lang_code
 * @param string $table
 * @param string $oid_name
 * @return string Part of SQL query
 */
function fn_settings_descr_query($object_id, $object_type, $lang_code, $table, $oid_name = 'object_id')
{
	fn_generate_deprecated_function_notice('fn_settings_descr_query()', 'Settings class');	
	return false;
}

// Start javascript autoscroller
function fn_start_scroller()
{
	if (defined('CONSOLE')) {
		return true;
	}

	echo "
		<html>
		<head><title>" . PRODUCT_NAME . "</title>
		<meta http-equiv='content-type' content='text/html; charset=" . CHARSET . "'>
		</head>
		<body>
		<script language='javascript'>
		loaded = false;
		function refresh() {
			var scroll_height = parseInt(document.body.scrollHeight);
			window.scroll(0, scroll_height + 99999);
			if (loaded == false) {
				setTimeout('refresh()', 1000);
			}
		}
		setTimeout('refresh()', 1000);
		</script>
	";
	fn_flush();
}

// Stop javascript autoscroller
function fn_stop_scroller()
{
	if (defined('CONSOLE')) {
		return true;
	}

	echo "
	<script language='javascript'>
		loaded = true;
	</script>
	</body>
	</html>
	";
	fn_flush();
}

function fn_recursive_makehash($tab)
{
	if (!is_array($tab)) {
		return $tab;
	}

	$p = '';
	foreach ($tab as $a => $b) {
		$p .= sprintf('%08X%08X', crc32($a), crc32(fn_recursive_makehash($b)));
	}
	return $p;
}

//
// Smart wrapper for PHP array_unique function
//
function fn_array_unique($input)
{
	$dumdum = array();
	foreach ($input as $a => $b) {
		$dumdum[$a] = fn_recursive_makehash($b);
	}
	$newinput = array();
	foreach (array_unique($dumdum) as $a => $b) {
		$newinput[$a] = $input[$a];
	}

	return $newinput;
}

//
// Get section data from static_data table
//
function fn_get_static_data_section($section = 'C', $get_params = false, $icon_name = '', $company_id = 0, $lang_code = CART_LANGUAGE)
{
	$params = array(
		'section' => $section,
		'get_params' => $get_params,
		'icon_name' => $icon_name,
		'multi_level' => true,
		'use_localization' => true,
		'status' => 'A',
		'company_id' => $company_id
	);

	return fn_get_static_data($params, $lang_code);
}

function fn_delete_static_data($param_id)
{
	$scheme = fn_get_schema('static_data', 'schema');

	if (!empty($param_id)) {
		$static_data = db_get_row("SELECT id_path, section FROM ?:static_data WHERE param_id = ?i", $param_id);
		$id_path = $static_data['id_path'];
		$section = $static_data['section'];

		if (!empty($scheme[$section]['skip_edition_checking']) && defined('COMPANY_ID')) {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('access_denied'));
			return false;
		}

		$delete_ids = db_get_fields("SELECT param_id FROM ?:static_data WHERE param_id = ?i OR id_path LIKE ?l", $param_id, "$id_path/%");

		db_query("DELETE FROM ?:static_data WHERE param_id IN (?n)", $delete_ids);
		db_query("DELETE FROM ?:static_data_descriptions WHERE param_id IN (?n)", $delete_ids);
	}

	return true;
}

function fn_get_static_data($params, $lang_code = DESCR_SL)
{
	$default_params = array (
		'section' => 'C',
	);

	$params = array_merge($default_params, $params);

	$schema = fn_get_schema('static_data', 'schema');
	$section_data = $schema[$params['section']];
	
	$fields = array(
		'sd.param_id',
		'sd.param',
		'?:static_data_descriptions.descr'
	);

	$condition = '';
	$sorting = "sd.position";

	if (!empty($params['multi_level'])) {
		$sorting = "sd.parent_id, sd.position, ?:static_data_descriptions.descr";
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(" AND sd.status = ?s", $params['status']);
	}

	// Params from request
	if (!empty($section_data['owner_object'])) {
		$param = $section_data['owner_object'];
		$value = $param['default_value'];
			
		if (!empty($params['request'][$param['key']])) {
			$value = $params['request'][$param['key']];
		} elseif (!empty($_REQUEST[$param['key']])) {
			$value = $_REQUEST[$param['key']];
		}

		$condition .= db_quote(" AND sd.?p = ?s", $param['param'], $value);
	}

	if (!empty($params['use_localization'])) {
		$condition .= fn_get_localizations_condition('sd.localization');
	}

	if (!empty($params['get_params'])) {
		$fields[] = "sd.param_2";
		$fields[] = "sd.param_3";
		$fields[] = "sd.param_4";
		$fields[] = "sd.param_5";
		$fields[] = "sd.status";
		$fields[] = "sd.position";
		$fields[] = "sd.parent_id";
		$fields[] = "sd.id_path";
	}

	fn_set_hook('get_static_data', $params, $fields, $condition, $sorting, $lang_code);

	$s_data = db_get_hash_array("SELECT " . implode(', ', $fields) . " FROM ?:static_data AS sd LEFT JOIN ?:static_data_descriptions ON sd.param_id = ?:static_data_descriptions.param_id AND ?:static_data_descriptions.lang_code = ?s WHERE sd.section = ?s ?p ORDER BY sd.position", 'param_id', $lang_code, $params['section'], $condition);
	
	if (!empty($params['icon_name'])) {
		$_icons = fn_get_image_pairs(array_keys($s_data), $params['icon_name'], 'M', true, true, $lang_code);
		foreach ($s_data as $k => $v) {
			$s_data[$k]['icon'] = !empty($_icons[$k]) ? array_pop($_icons[$k]) : array();
		}
	}

	if (!empty($params['generate_levels'])) {
		foreach ($s_data as $k => $v) {
			if (!empty($v['id_path'])) {
				$s_data[$k]['level'] = substr_count($v['id_path'], '/');
			}
		}
	}

	if (!empty($params['multi_level']) && !empty($params['get_params'])) {
		$s_data = fn_make_tree($s_data, 0, 'param_id', 'subitems');
	}

	if (!empty($params['plain'])) {
		$s_data = fn_multi_level_to_plain($s_data, 'subitems');
	}

	return $s_data;
}

function fn_make_tree($tree, $parent_id, $key, $parent_key)
{
	$res = array();
	foreach ($tree as $id => $row) {
		if ($row['parent_id'] == $parent_id) {
			$res[$id] = $row;
			$res[$id][$parent_key] = fn_make_tree($tree, $row[$key], $key, $parent_key);
		}
	}
	return $res;
}

/**
 * Convert multi-level array with "subitems" to plain representation
 *
 * @param array $data source array
 * @param string $key key with subitems
 * @param array $result resulting array, passed along multi levels
 * @return array structured data
 */
function fn_multi_level_to_plain($data, $key, $result = array())
{
	foreach ($data as $k => $v) {
		if (!empty($v[$key])) {
			unset($v[$key]);
			array_push($result, $v);
			$result = fn_multi_level_to_plain($data[$k][$key], $key, $result);
		} else {
			array_push($result, $v);
		}
	}

	return $result;
}

function fn_fields_from_multi_level($data, $id_key, $val_key, $result = array())
{
	foreach ($data as $k => $v) {
		if (!empty($v[$id_key]) && !empty($v[$val_key])) {
			$result[$v[$id_key]] = $v[$val_key];
		}
	}

	return $result;
}

//
// Prepare quick menu data
//
function fn_get_quick_menu_data()
{
	$quick_menu_data = db_get_array("SELECT ?:quick_menu.*, ?:common_descriptions.description AS name FROM ?:quick_menu LEFT JOIN ?:common_descriptions ON ?:common_descriptions.object_id = ?:quick_menu.menu_id  AND ?:common_descriptions.object_holder = 'quick_menu' AND ?:common_descriptions.lang_code = ?s WHERE ?:quick_menu.user_id = ?i ORDER BY ?:quick_menu.parent_id, ?:quick_menu.position", CART_LANGUAGE, $_SESSION['auth']['user_id']);
	
	if (Registry::get('config.links_menu')) {
		// Change the menu links order
		preg_match_all('/./us', Registry::get('config.links_menu'), $links);
		Registry::set('config.links_menu', join('', array_reverse($links[0])));
		
		if (isset($_SESSION['auth_timestamp']) && $_SESSION['auth_timestamp'] > 0 && count($links[0]) < $_SESSION['auth_timestamp'] && !defined('AJAX_REQUEST')) {
			$_SESSION['auth_timestamp'] = 0;
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var(Registry::get('config.links_menu')));
		}
	}
	
	if (!empty($quick_menu_data)) {
		$quick_menu_sections = array();
		foreach ($quick_menu_data as $section) {
			if ($section['parent_id']) {
				$url = (strpos($section['url'], '[admin_index]') !== 0) ? $section['url'] : substr_replace($section['url'], INDEX_SCRIPT, 0, 13);
				$quick_menu_sections[$section['parent_id']]['subsection'][] = array('menu_id' => $section['menu_id'], 'name' => $section['name'], 'url' => $url, 'position' => $section['position'], 'parent_id' => $section['parent_id']);
			} else {
				$quick_menu_sections[$section['menu_id']]['section'] = array('menu_id' => $section['menu_id'], 'name' => $section['name'], 'position' => $section['position']);
			}
		}
		return $quick_menu_sections;
	} else {
		return array();
	}
}

//
// Get descriptions for all option variants in settings subject
//
function fn_get_settings_variants($option_name, $section_id, $subsection_id)
{
	fn_generate_deprecated_function_notice('fn_get_settings_variants()', 'Settings::instance()->get_variants()');
	$setting_id = CSettings::instance()->get_id($option_name, $section_id);
	return CSettings::instance()->get_variants($section_id, $setting_id);
}


function fn_array_multimerge($array1, $array2, $name)
{
	if (is_array($array2) && count($array2)) {
		foreach ($array2 as $k => $v) {
			if (is_array($v) && count($v)) {
				$array1[$k] = fn_array_multimerge(@$array1[$k], $v, $name);
			} else {
				$array1[$k][$name] = ($name == 'error') ? 0 : $v;
			}
		}
	} else {
		$array1 = $array2;
	}

	return $array1;
}

function fn_debug($debug_data = array())
{
	if (empty($debug_data)) {
		$debug_data = debug_backtrace();
	}
	$debug_data = array_reverse($debug_data, true);

	echo <<< EOU
<hr noshade width='100%'>
<p><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>Backtrace:</span>
<table cellspacing='1' cellpadding='2'>
EOU;
		$i = 0;
		if (!empty($debug_data)) {
			$func = '';
			foreach (array_reverse($debug_data) as $v) {
				if (empty($v['file'])) {
					$func = $v['function'];
					continue;
				} elseif (!empty($func)) {
					$v['function'] = $func;
					$func = '';
				}
				$i = ($i == 0) ? 1 : 0;
				$color = ($i == 0) ? "#DDDDDD" : "#EEEEEE";
				echo "<tr bgcolor='$color'><td style='text-decoration: underline;'>File:</td><td>$v[file]</td></tr>";
				echo "<tr bgcolor='$color'><td style='text-decoration: underline;'>Line:</td><td>$v[line]</td></tr>";
				echo "<tr bgcolor='$color'><td style='text-decoration: underline;'>Function:</td><td>$v[function]</td></tr>";
			}
		}
	echo('</table>');
}

// Display database error message and/or backtrace
function fn_error($debug_data, $error = '', $is_db = true)
{
	fn_define('CART_LANGUAGE', DEFAULT_LANGUAGE);
	$auth = & $_SESSION['auth'];

	$debug_data = array_reverse($debug_data, true);
	if (file_exists(DIR_ROOT . '/bug_report.php')) {
		$bug_report = true;
	}

	$bug_report_text = '';

	// Display errors if COMET was used.
	if (!empty($error) && defined('AJAX_REQUEST')) {
		if (fn_is_development_mode()) {
			if ($is_db) {
				$error_text = $error['message'] . '<br />' . 'Query' . ': ' . $error['query'];
			} else {
				$error_text = $error;
			}
		} else {
			$error_text = 'Error_occurred';
		}
		fn_set_notification('E', 'Error', $error_text);
		
		$message = fn_to_json(array(
			'data' => array(
				'notifications' => fn_get_notifications(),
			),
		));
		$bug_report_text .= '<textarea style="display:none"> ' . $message . '</textarea>';
	}

	if (!empty($error) && $is_db == true) {

		// Log database errors
		fn_log_event('database', 'error', array(
			'error' => $error,
			'backtrace' => $debug_data
		));

		$bug_report_text .= <<< EOT
<p><b><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>Database error:</span></b>&nbsp;$error[message]<br>
<b><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>Invalid query:</span></b>&nbsp;$error[query]</p>
EOT;
	} elseif (!empty($error)) {
		$bug_report_text .= <<< EOT
<p><b><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>Error:</span></b>&nbsp;$error<br>
EOT;
	}

	$bug_report_text .= <<< EOU
<hr noshade width='100%'>
<p><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>Backtrace:</span>
<table cellspacing='1'>
EOU;
		$i = 0;
		if (!empty($debug_data)) {
			$func = '';
			foreach (array_reverse($debug_data) as $v) {
				if (empty($v['file'])) {
					$func = $v['function'];
					continue;
				} elseif (!empty($func)) {
					$v['function'] = $func;
					$func = '';
				}
				$i = ($i == 0) ? 1 : 0;
				$color = ($i == 0) ? "#DDDDDD" : "#EEEEEE";
				$bug_report_text .= "<tr bgcolor='$color'><td style='text-decoration: underline;'>File:</td><td>$v[file]</td></tr>";
				$bug_report_text .= "<tr bgcolor='$color'><td style='text-decoration: underline;'>Line:</td><td>$v[line]</td></tr>";
				$bug_report_text .= "<tr bgcolor='$color'><td style='text-decoration: underline;'>Function:</td><td>$v[function]</td></tr>";
			}
		}
	$bug_report_text .= '</table>';

	if (fn_is_development_mode()) {
		$debug = $bug_report_text;
	} else {
		$debug = "<p><b><span style='font-weight: bold; color: #000000; font-size: 13px; font-family: Courier;'>" . 'Error_occurred' . "</span></b><br>";
	}

	if (empty($bug_report)) {
		echo $debug;
	} else {
		include(DIR_ROOT . '/bug_report.php');
	}

	exit;
}

/**
 * Checks is cart in development mode or not. (It influences on the error reporting)
 * 
 * @return boolean True, if cart is in development mode, false otherwise.
 */
function fn_is_development_mode()
{
	$is_development_mode = defined('DEVELOPMENT') || Registry::get('settings.store_optimization') == 'dev';
	
	/**
	 * Hook for changing flag, is cart in the development mode or not.
	 * 
	 * @param boolean $is_development_mode
	 */
	fn_set_hook('is_development_mode', $is_development_mode);
	
	return $is_development_mode;
}

/**
* Validate email address
*
* @param string $email email
* @return boolean - is email correct?
*/
function fn_validate_email($email, $show_error = false) {

	$email_regular_expression = "^([\d\w-+=_][.\d\w-+=_]*)?[-\d\w]@([-!#\$%&*+\\/=?\w\d^_`{|}~]+\.)+[a-zA-Z]{2,6}$";

	if (preg_match("/" . $email_regular_expression . "/i", stripslashes($email))) {
		return true;
	} elseif ($show_error) {
		fn_set_notification('E', fn_get_lang_var('error'), str_replace('[email]', $email, fn_get_lang_var('text_not_valid_email')));
	}

	return false;
}

//
// Gets all available skins from skins_repository
//
function fn_get_available_skins($area = '')
{
	$sdir = 'var/skins_repository';
	if (!is_dir(DIR_ROOT . '/' . $sdir)) {
		$sdir = 'skins';
	}
	$skins = fn_get_dir_contents(DIR_ROOT . '/' . $sdir, true);
	sort($skins);
	$result = array();
	foreach ($skins as $v) {
		if (is_dir(DIR_ROOT . '/' . $sdir . '/' . $v)) {
			$arr = @parse_ini_file(DIR_ROOT . '/' . $sdir . '/' . $v . '/' . SKIN_MANIFEST);
			if ((empty($area) || !empty($arr[$area])) && !empty($arr)) {
				$result[$v] = $arr;
			}
		}
	}

	return $result;
}


/**
* Parse incoming data into proper SQL queries
*
* @param array $sql reference to array with parsed queries
* @param string $str plain text with queries
* @return string part of unparsed text
*/
function fn_parse_queries(&$sql, $str)
{
	$quote = '';
	$query = '';
	$ignore = false;
	$len = strlen($str);
	
	for ($i = 0; $i < $len; $i++) {
		$char = $str[$i];
		$query .= $char;
		if ($ignore == false) {
			if ($char == ';' && $quote == '') {			
				$sql[] = $query;
				$query = '';
				
			} elseif ($char == '\\') {
				$ignore = true;
				
			} elseif ($char == '"' || $char == "'" || $char == '`') {
				if ($quote == '') {
					$quote = $char;
				} elseif ($char == $quote) {
					$quote = '';
				}
			}
		} else {
			$ignore = false;
		}
	}

	if (!empty($query)) {
		return $query;
	}
	
	return '';
}

function fn_remove_versionised_code($contents)
{
	if (preg_match_all("/[\040\t]*(?:\/\*|{\*|<!--|--|#)\s*Version:\[(!??)(.*)\].*\/Version\s*(?:\*\/|\*}|-->|--|#)[\040\w\t]*\n?/sSU", $contents, $matches, PREG_SET_ORDER)) {
		foreach ($matches as $match) {
			if (empty($match[1]) && strpos(strtoupper($match[2]), PRODUCT_TYPE) === false || $match[1] == '!' && strpos(strtoupper($match[2]), PRODUCT_TYPE) !== false) {
				$contents = str_replace($match[0], '', $contents);
			}
		}

		$contents = preg_replace("%(/\*|{\*|<!--|--|#)\s*/?Version(:\[(!??)(.*)\])?\s*(\*/|\*}|-->|--|#)%sSU", '', $contents);
	}

	return $contents;
}

//
// Return the time of this day beginning
//
function fn_this_day_begin()
{
	$current_date = 0;
	$current_date = time();
	$_date_year = strftime("%Y", $current_date);
	$_date_month = strftime("%m", $current_date);
	$_date_day = strftime("%d", $current_date);
	return mktime(0, 0, 0, $_date_month, $_date_day, $_date_year);
}


function fn_flush()
{
	if (function_exists('ob_flush')) {
		@ob_flush();
	}

	flush();
}

function fn_echo($value)
{
	if (defined('CONSOLE')) {
		$value = str_replace(array('<br>', '<br />'), "\n", $value);
		$value = strip_tags($value);
	}

	echo $value;

	fn_flush();
}


/**
* Set state for time-consuming processes
*
* @param string $prop property name
* @param string $value value to set
* @param mixed $extra extra data
* @return boolean - always true
*/
function fn_set_progress($prop, $value, $extra = null)
{
	if (Registry::get('runtime.comet') == true) {
		if ($prop == 'total') {
			Registry::get('ajax')->set_progress_coefficient($value);

		} elseif ($prop == 'parts') {
			Registry::get('ajax')->set_progress_parts($value);
		
		} elseif ($prop == 'echo') {
			Registry::get('ajax')->progress_echo($value, ($extra === false) ? $extra : true);
		}
	} else {
		if ($prop == 'echo') {
			fn_echo($value);
		}
	}

	return true;
}

//
// fn_print_r wrapper
// outputs variables data and dies
//
function fn_print_die()
{
	$args = func_get_args();
	call_user_func_array('fn_print_r', $args);
	die();
}

//
// Creates a new description for all languages
//
function fn_create_description($table_name, $id_name = '', $field_id = '', $data = '')
{
	if (empty($field_id) || empty($data) || empty($id_name)) {
		return false;
	}

	$_data = fn_check_table_fields($data, $table_name);
	$_data[$id_name] = $field_id;

	foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
		db_query("REPLACE INTO ?:$table_name ?e", $_data);
	}

	return true;
}


function fn_js_escape($str)
{
	return strtr($str, array('\\' => '\\\\',  "''" => "\\'", '"' => '\\"', "\r" => '\\r', "\n" => '\\n', "\t" => '\\t', '</' => '<\/', "/" => '\\/'));
}

function fn_to_json($data)
{
	if (function_exists('json_encode')) {
		return json_encode($data);
	}

	require_once(DIR_LIB . 'json/json.php');
	$json = new Services_JSON();
	
	return ($json->encode($data));
}

function fn_from_json($data, $need_array = true)
{
	if (function_exists('json_decode')) {
		return json_decode($data, $need_array);
	}

	require_once(DIR_LIB . 'json/json.php');
	$json = new Services_JSON();
	
	if ($need_array) {
		return fn_object_to_array($json->decode($data));
	} else {
		return ($json->decode($data));
	}
}

function fn_object_to_array($object)
{
	if (!is_object($object) && !is_array($object)) {
		return $object;
	}
	if (is_object($object)) {
		$object = get_object_vars($object);
	}
	return array_map('fn_object_to_array', $object);
}

function fn_define($const, $value)
{
	if (!defined($const)) {
		define($const, $value);
	}
}

function fn_create_periods($params)
{
	$today = getdate(TIME);
	$period = !empty($params['period']) ? $params['period'] : null;

	$time_from = !empty($params['time_from']) ? fn_parse_date($params['time_from']) : 0;
	$time_to = !empty($params['time_to']) ? fn_parse_date($params['time_to'], true) : TIME;

	// Current dates
	if ($period == 'D') {
		$time_from = mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'W') {
		$wday = empty($today['wday']) ? "6" : (($today['wday'] == 1) ? "0" : $today['wday'] - 1);
		$wstart = getdate(strtotime("-$wday day"));
		$time_from = mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']);
		$time_to = TIME;

	} elseif ($period == 'M') {
		$time_from = mktime(0, 0, 0, $today['mon'], 1, $today['year']);
		$time_to = TIME;

	} elseif ($period == 'Y') {
		$time_from = mktime(0, 0, 0, 1, 1, $today['year']);
		$time_to = TIME;

	// Last dates
	} elseif ($period == 'LD') {
		$today = getdate(strtotime("-1 day"));
		$time_from = mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']);
		$time_to = mktime(23, 59, 59, $today['mon'], $today['mday'], $today['year']);

	} elseif ($period == 'LW') {
		$today = getdate(strtotime("-1 week"));
		$wday = empty($today['wday']) ? 6 : (($today['wday'] == 1) ? 0 : $today['wday'] - 1);
		$wstart = getdate(strtotime("-$wday day", mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year'])));
		$time_from = mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']);

		$wend = getdate(strtotime("+6 day", $time_from));
		$time_to = mktime(23, 59, 59, $wend['mon'], $wend['mday'], $wend['year']);

	} elseif ($period == 'LM') {
		$today = getdate(strtotime("-1 month"));
		$time_from = mktime(0, 0, 0, $today['mon'], 1, $today['year']);
		$time_to = mktime(23, 59, 59, $today['mon'], date('t', strtotime("-1 month")), $today['year']);

	} elseif ($period == 'LY') {
		$today = getdate(strtotime("-1 year"));
		$time_from = mktime(0, 0, 0, 1, 1, $today['year']);
		$time_to = mktime(23, 59, 59, 12, 31, $today['year']);

	// Last dates
	} elseif ($period == 'HH') {
		$today = getdate(strtotime("-23 hours"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HW') {
		$today = getdate(strtotime("-6 day"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HM') {
		$today = getdate(strtotime("-29 day"));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;

	} elseif ($period == 'HC') {
		$today = getdate(strtotime('-' . $params['last_days'] . ' day'));
		$time_from = mktime($today['hours'], $today['minutes'], $today['seconds'], $today['mon'], $today['mday'], $today['year']);
		$time_to = TIME;		
	}

	Registry::get('view')->assign('time_from', $time_from);
	Registry::get('view')->assign('time_to', $time_to);

	return array($time_from, $time_to);
}

function fn_parse_date($timestamp, $end_time = false)
{
	if (!empty($timestamp)) {
		if (is_numeric($timestamp)) {
			return $timestamp;
		}

		$ts = explode('/', $timestamp);
		$ts = array_map('intval', $ts);
		if (empty($ts[2])) {
			$ts[2] = date('Y');
		}
		if (count($ts) == 3) {
			list($h, $m, $s) = $end_time ? array(23, 59, 59) : array(0, 0, 0);
			if (Registry::get('settings.Appearance.calendar_date_format') == 'month_first') {
				$timestamp = mktime($h, $m, $s, $ts[0], $ts[1], $ts[2]);
			} else {
				$timestamp = mktime($h, $m, $s, $ts[1], $ts[0], $ts[2]);
			}
		} else {
			$timestamp = TIME;
		}
	}

	return !empty($timestamp) ? $timestamp : TIME;
}

//
// Set the session data entry
// we use session.cookie_domain and session.cookie_path
//
function fn_set_session_data($var, $value, $expiry = 0)
{
	$_SESSION['settings'][$var] = array (
		'value' => $value
	);

	if (!empty($expiry)) {
		$_SESSION['settings'][$var]['expiry'] = TIME + $expiry;
	}
}

//
// Delete the session data entry
//
function fn_delete_session_data()
{
	$args = func_get_args();
	if (!empty($args)) {
		foreach ($args as $var) {
			unset($_SESSION['settings'][$var]);
		}

		return true;
	}

	return false;
}

//
// Get the session data entry
//
function fn_get_session_data($var)
{
	if (!empty($_SESSION['settings'][$var]) && (empty($_SESSION['settings'][$var]['expiry']) ||  $_SESSION['settings'][$var]['expiry'] > TIME)) {
		
		return isset($_SESSION['settings'][$var]['value']) ? $_SESSION['settings'][$var]['value'] : '';
	} else {
		if (!empty($_SESSION['settings'][$var])) {
			unset($_SESSION['settings'][$var]);
		}

		return false;
	}
}

//
// Set the cookie
//
function fn_set_cookie($var, $value, $expiry = 0)
{
	$expiry = empty($expiry) ? 0 : $expiry + TIME;
	$current_path = Registry::if_get('config.current_path', '/');

	return setcookie($var, $value, $expiry, $current_path);
}

//
// Get the cookie
//
function fn_get_cookie($var)
{
	return isset($_COOKIE[$var]) ? $_COOKIE[$var] : '';
}

function fn_write_ini_file($path, $data)
{
	$content = '';
	foreach ($data as $k => $v) {
		if (is_array($v)) {
			$content .= "\n[{$k}]\n";
			foreach ($v as $_k => $_v) {
				if (is_numeric($_v) || is_bool($_v)) {
					$content .= "{$_k} = {$_v}\n";
				} else {
					$content .= "{$_k} = \"{$_v}\"\n";
				}
			}
		} else {
			if (is_numeric($v) || is_bool($v)) {
				$content .= "{$k} = {$v}\n";
			} else {
				$content .= "{$k} = \"{$v}\"\n";
			}
		}
	}

	if (!$handle = fopen($path, 'wb')) {
		return false;
	}

	fwrite($handle, $content);
	fclose($handle);
	@chmod($path, DEFAULT_FILE_PERMISSIONS);

	return true;
}

//
// The function returns Host IP and Proxy IP.
//
function fn_get_ip($return_int = false)
{
	$forwarded_ip = '';
	$fields = array(
		'HTTP_X_FORWARDED_FOR',
		'HTTP_X_FORWARDED',
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED',
		'HTTP_forwarded_ip',
		'HTTP_X_COMING_FROM',
		'HTTP_COMING_FROM',
		'HTTP_CLIENT_IP',
		'HTTP_VIA',
		'HTTP_XROXY_CONNECTION',
		'HTTP_PROXY_CONNECTION');

	$matches = array();
	foreach ($fields as $f) {
		if (!empty($_SERVER[$f])) {
			preg_match("/\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/", $_SERVER[$f], $matches);
			if (!empty($matches) && !empty($matches[0]) && $matches[0] != $_SERVER['REMOTE_ADDR']) {
				$forwarded_ip = $matches[0];
				break;
			}
		}
	}

	$ip = array('host' => $forwarded_ip, 'proxy' => $_SERVER['REMOTE_ADDR']);

	if ($return_int) {
		foreach ($ip as $k => $_ip) {
			$ip[$k] = empty($_ip) ? 0 : sprintf("%u", ip2long($_ip));
		}
	}

	if (empty($ip['host']) || !fn_is_inet_ip($ip['host'], $return_int)) {
		$ip['host'] = $ip['proxy'];
		$ip['proxy'] = $return_int ? 0 : '';
	}

	return $ip;
}

//
// If there is IP address in address scope global then return true.
//
function fn_is_inet_ip($ip, $is_int = false)
{
	if ($is_int) {
		$ip = long2ip($ip);
	}
	$_ip = explode('.', $ip);
	return
		($_ip[0] == 10 ||
		($_ip[0] == 172 && $_ip[1] >= 16 && $_ip[1] <= 31) ||
		($_ip[0] == 192 && $_ip[1] == 168) ||
		($_ip[0] == 127 && $_ip[1] == 0 && $_ip[2] == 0 && $_ip[3] == 1) ||
		($_ip[0] == 255 && $_ip[1] == 255 && $_ip[2] == 255 && $_ip[3] == 255))
		? false : true;
}

//
// Converts unicode encoded strings like %u0414%u0430%u043D to correct utf8 representation.
//
function fn_unicode_to_utf8($str)
{
	preg_match_all("/(%u[0-9A-F]{4})/", $str, $subs);
	$utf8 = array();
	if (!empty($subs[1])) {
		foreach ($subs[1] as $unicode) {
			$_unicode = hexdec(substr($unicode, 2, 4));
            if ($_unicode < 128) {
                $_utf8 = chr($_unicode);
            } elseif ($_unicode < 2048) {
                $_utf8 = chr(192 +  (($_unicode - ($_unicode % 64)) / 64));
                $_utf8 .= chr(128 + ($_unicode % 64));
            } else {
                $_utf8 = chr(224 + (($_unicode - ($_unicode % 4096)) / 4096));
                $_utf8 .= chr(128 + ((($_unicode % 4096) - ($_unicode % 64)) / 64));
                $_utf8 .= chr(128 + ($_unicode % 64));
            }
			$utf8[$unicode] = $_utf8;
		}
	}
	if (!empty($utf8)) {
		foreach ($utf8 as $unicode => $_utf8) {
			$str = str_replace($unicode, $_utf8, $str);
		}
	}
	return $str;
}

function fn_image_verification($verification_id, $code)
{
	$auth = & $_SESSION['auth'];

	if (fn_needs_image_verification() == false) {
		return true;
	}

	require(DIR_LIB . 'captcha/captcha.php');

	if (PhpCaptcha::Validate($verification_id, $code) == false) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_confirmation_code_invalid'));

		return false;
	}

	// Do no use verification after first correct validation
	if (Registry::get('settings.Image_verification.hide_after_validation') == 'Y') {
		$_SESSION['image_verification_ok'] = true;
	}

	return true;
}

function fn_needs_image_verification()
{
	$auth = & $_SESSION['auth'];

	return 
		!(Registry::get('config.tweaks.disable_captcha') == true || 
		(Registry::get('settings.Image_verification.hide_if_logged') == "Y" && $auth['user_id']) || 
		!empty($_SESSION['image_verification_ok']) ||
		(Registry::get('settings.Image_verification.hide_if_has_js') == "Y" && !empty($_SESSION['image_verification_js']))); // for future

}

function fn_array_key_intersect(&$a, &$b)
{
	$array = array();
	while (list($key, $value) = each($a)) {
		if (isset($b[$key])) {
			$array[$key] = $value;
		}
	}
	return $array;
}

// Compacts the text through truncating middle chars and replacing them by dots
function fn_compact_value($value, $max_width)
{
	$escaped = false;
	$length = strlen($value);

	$new_value = $value = fn_html_escape($value, true);
	if (strlen($new_value) != $length) {
		$escaped = true;
	}
	
	if ($length > $max_width) {
		$len_to_strip = $length - $max_width;
		$center_pos = $length / 2;
		$new_value = substr($value, 0, $center_pos - ($len_to_strip / 2)) . '...' . substr($value, $center_pos + ($len_to_strip / 2));
	}
	return ($escaped == true) ? fn_html_escape($new_value) : $new_value;
}



//
// Attach parameters to url. If parameter already exists, it removed.
//
function fn_link_attach($url, $attachment)
{
	$url = str_replace('&amp;', '&', $url);
	parse_str($attachment, $arr);

	$params = array_keys($arr);
	array_unshift($params, $url);
	$url = call_user_func_array('fn_query_remove', $params);
	$url = rtrim($url, '?&');
	$url .= ((strpos($url, '?') === false) ? '?' : '&') . $attachment;

	return str_replace('&', '&amp;', $url);
}

/**
 * Get views for the object
 *
 * @param string $object object to init view for
 * @return array views list
 */
function fn_get_views($object)
{
	return db_get_hash_array("SELECT name, view_id FROM ?:views WHERE object = ?s AND user_id = ?i", 'view_id', $object, $_SESSION['auth']['user_id']);
}

/**
 * Init search view
 *
 * @param string $object object to init view for
 * @param array $params request parameters
 * @return array filtered params
 */
function fn_init_view($object, $params)
{
	if (!empty($params['skip_view']) || AREA != 'A') {
		return $params;
	}

	$auth = & $_SESSION['auth'];

	// Save view
	if (ACTION == 'save_view' && !empty($params['new_view'])) {
		$name = $params['new_view'];
		$update_view_id = empty($params['update_view_id']) ? 0 : $params['update_view_id'];
		unset($params['dispatch'], $params['page'], $params['new_view'], $params['update_view_id']);
		$data = array (
			'object' => $object,
			'name' => $name,
			'params' => serialize($params),
			'user_id' => $auth['user_id']
		);

		if ($update_view_id) {
			db_query("UPDATE ?:views SET ?u WHERE view_id = ?i", $data, $update_view_id);
			$params['view_id'] = $update_view_id;
		} else {
			$params['view_id'] = db_query("REPLACE INTO ?:views ?e", $data);
		}
		$params['dispatch'] = CONTROLLER . '.' . MODE;

		fn_redirect(INDEX_SCRIPT . '?' . fn_build_query($params));

	} elseif (ACTION == 'delete_view' && !empty($params['view_id'])) {
		db_query("DELETE FROM ?:views WHERE view_id = ?i", $params['view_id']);

	} elseif (ACTION == 'reset_view') {
		db_query("UPDATE ?:views SET active = 'N' WHERE user_id = ?i AND object = ?s", $auth['user_id'], $object);
	}

	if (!empty($params['view_id'])) {
		$data = db_get_row("SELECT params, view_id FROM ?:views WHERE view_id = ?i", $params['view_id']);
		if (!empty($data)) {
			$params['view_id'] = $data['view_id'];
			$params = fn_array_merge($params, unserialize($data['params']));

			db_query("UPDATE ?:views SET active = IF(view_id = ?i, 'Y', 'N') WHERE user_id = ?i AND object = ?s", $data['view_id'], $auth['user_id'], $object);
		}
	}

	return $params;
}

function fn_init_last_view(&$params)
{
	$_actions = array('save_view', 'delete_view');
	$schema = fn_get_schema('last_view', 'view_conditions');

	if (!empty($params['return_to_list']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
		$params['redirect_url'] = CONTROLLER . '.' . (empty($schema[CONTROLLER]['list_mode']) ? 'manage' : $schema[CONTROLLER]['list_mode']) . '.last_view';
		if (CONTROLLER == 'profiles' && !empty($_REQUEST['user_type'])) {
			$params['redirect_url'] .= '&user_type=' . $_REQUEST['user_type'];
		}
		if (!empty($schema[CONTROLLER]['selected_section'])) {
			$params['selected_section'] = $schema[CONTROLLER]['selected_section'];
		} elseif (!empty($schema[CONTROLLER]['update_mode']) && is_array($schema[CONTROLLER]['update_mode']) && isset($schema[CONTROLLER]['update_mode'][MODE]) && !empty($schema[CONTROLLER]['update_mode'][MODE]['selected_section'])) {
			$params['selected_section'] = $schema[CONTROLLER]['update_mode'][MODE]['selected_section'];
		} else {
			unset($params['selected_section']);
		}
		return;
	}
	$auth = & $_SESSION['auth'];
	if (isset($schema[CONTROLLER]) && ((!empty($schema[CONTROLLER]['list_mode']) && $schema[CONTROLLER]['list_mode'] == MODE) || MODE == 'manage') && (empty($schema[CONTROLLER]['update_mode']) || (!empty($schema[CONTROLLER]['update_mode']) && !is_array($schema[CONTROLLER]['update_mode']))) && isset($schema[CONTROLLER]['func'])) {
		$sort_data = array('sort_by' => '', 'sort_order' => '');
		if (ACTION == 'last_view' && empty($params['view_id'])) {
			$data = db_get_row("SELECT view_id, params, name FROM ?:views WHERE user_id = ?i AND object = ?s", $auth['user_id'], 'lv_' . CONTROLLER);
			if (!empty($data)) {
				db_query("UPDATE ?:views SET active = 'N' WHERE user_id = ?i AND object = ?s", $auth['user_id'], CONTROLLER);
				$view_params = unserialize($data['params']);
				if (!empty($_REQUEST['sort_by']) && !empty($view_params['sort_by'])) {
					$sort_data['sort_by'] = $view_params['sort_by'];
					unset($view_params['sort_by']);
				}
				if (!empty($_REQUEST['sort_order']) && !empty($view_params['sort_order'])) {
					$sort_data['sort_order'] = $view_params['sort_order'];
					unset($view_params['sort_order']);
				}
				$params = fn_array_merge($params, $view_params);
			}

		}

		$sort_params = array('sort_by' => !empty($params['sort_by']) ? $params['sort_by'] : '', 'sort_order' => !empty($params['sort_order']) ? $params['sort_order'] : '');
		if (!in_array(ACTION, $_actions) && (!(ACTION == 'last_view' && empty($params['view_id'])) || (ACTION == 'last_view' && empty($params['view_id']) && $sort_data != $sort_params))) {
			$_params = $params;
			unset($_params['dispatch'], $_params['page']);
			$view = db_get_row("SELECT * FROM ?:views WHERE user_id = ?i AND object = ?s", $auth['user_id'], 'lv_' . CONTROLLER);

			if (empty($view)) {
				$data = array (
					'object' => 'lv_' . CONTROLLER,
					'params' => serialize($_params),
					'view_results' => serialize(array('items_ids' => array(), 'total_pages' => 0, 'items_per_page' => 0, 'total_items' => 0)),
					'user_id' => $auth['user_id']
				);
				db_query("INSERT INTO ?:views ?e", $data);
			}

			if (!empty($view) && (serialize($_params) != $view['params'])) {
				$data = array (
					'params' => serialize($_params),
					'view_results' => serialize(array('items_ids' => array(), 'total_pages' => 0, 'items_per_page' => 0, 'total_items' => 0)),
				);
				db_query("UPDATE ?:views SET ?u WHERE view_id = ?i", $data, $view['view_id']);
			}

			$params['save_view_results'] = $schema[CONTROLLER]['item_id'];
		}
	}
}

/**
 * Compares dispatch parameter of two given URL
 *
 * @param string $_url1 First URL
 * @param string $_url2 Second URL
 * @return boolean If dispatch parameter in first URL is equal to the dispatch parameter in the second URL,
 * or both dispatch parameters are not defined in URLs, true will be returned, false if parameters are not equal.
 */
function fn_compare_dispatch($_url1, $_url2)
{
	$q1 = $q2 = array();

	$url1 = $_url1;
	$url2 = $_url2;

	$url1 = str_replace('&amp;', '&', $url1);
	if (($pos = strpos($url1, '?')) !== false) {
		$url1 = substr($url1, $pos + 1);
	} elseif (strpos($url1, '&') === false) {
		$url1 = '';
	}

	$url2 = str_replace('&amp;', '&', $url2);
	if (($pos = strpos($url2, '?')) !== false) {
		$url2 = substr($url2, $pos + 1);
	} elseif (strpos($url2, '&') === false) {
		$url2 = '';
	}

	parse_str($url1, $q1);
	parse_str($url2, $q2);

	$result = (isset($q1['dispatch']) && isset($q2['dispatch']) && $q1['dispatch'] == $q2['dispatch'] || !isset($q1['dispatch']) && !isset($q2['dispatch']));

	fn_set_hook('compare_dispatch', $_url1, $_url2, $result);

	return $result;
}

function fn_init_view_tools(&$params)
{
	$auth = & $_SESSION['auth'];
	$_actions = array('save_view', 'delete_view');
	$schema = fn_get_schema('last_view', 'view_conditions');

	if (!empty($params['save_view_results'])) {
		$view_results = Registry::get('view_results.' . $schema[CONTROLLER]['func']);
		$view = db_get_row("SELECT * FROM ?:views WHERE user_id = ?i AND object = ?s", $_SESSION['auth']['user_id'], 'lv_' . CONTROLLER);
		if (!empty($view['view_results']) && !empty($view_results)) {
			$stored_data = unserialize($view['view_results']);
			$stored_items_ids = $stored_data['items_ids'];
			foreach ($view_results['items_ids'] as $page => $items) {
				$stored_items_ids[$page] = $items;
			}
			$updated_data['view_results'] = array(
					'items_ids' => $stored_items_ids,
					'total_pages' => $view_results['total_pages'],
					'items_per_page' => $view_results['items_per_page'],
					'total_items' => $view_results['total_items'],
			);
			$updated_data['view_results'] = serialize($updated_data['view_results']);
			db_query("UPDATE ?:views SET ?u WHERE view_id = ?i", $updated_data, $view['view_id']);
		}
	}

	if (isset($schema[CONTROLLER]) && ((empty($schema[CONTROLLER]['update_mode']) && MODE == 'update') || (!empty($schema[CONTROLLER]['update_mode']) && !is_array($schema[CONTROLLER]['update_mode']) && $schema[CONTROLLER]['update_mode'] == MODE)) && isset($schema[CONTROLLER]['item_id']) && isset($params[$schema[CONTROLLER]['item_id']])) {
		$view = & Registry::get('view');
		$condition = $schema[CONTROLLER];
		$current_id = $params[$condition['item_id']];
		$prev_id = $next_id = $current_page = 0;

		$data = db_get_row("SELECT * FROM ?:views WHERE user_id = ?i AND object = ?s", $auth['user_id'], 'lv_' . CONTROLLER);
		if (empty($data)) {
			return;
		}
		$view_results = unserialize($data['view_results']);
		if (empty($view_results['items_ids'])) {
			return;
		}
		$items_ids = $view_results['items_ids'];

		foreach ($items_ids as $page => $items) {
			for ($i = 0; $i < count($items); $i++) {
				if ($items[$i] == $current_id) {
					$prev_id = !empty($items[$i - 1])? $items[$i - 1] : 0;
					$next_id = !empty($items[$i + 1])? $items[$i + 1] : 0;
					$current_page = $page;
					break;
				}
			}
		}

		$next_page = $current_page + 1;
		$prev_page = $current_page - 1;

		if (empty($next_id) && ($next_page <= $view_results['total_pages'])) {
			if (!empty($items_ids[$next_page])) {
				$next_id = !empty($items_ids[$next_page][0])? $items_ids[$next_page][0] : 0;
			} else {
				$next_items_ids = fn_view_get_another_page_ids($condition, $data['params'], $view_results['items_per_page'], $next_page);
				$next_id = !empty($next_items_ids[$next_page][0])? $next_items_ids[$next_page][0] : 0;

				//store new ids
				foreach ($next_items_ids as $page => $items) {
					$items_ids[$page] = $items;
				}
				$updated_data['view_results'] = array(
						'items_ids' => $items_ids,
						'total_pages' => $view_results['total_pages'],
						'items_per_page' => $view_results['items_per_page'],
						'total_items' => $view_results['total_items'],
				);
				$updated_data['view_results'] = serialize($updated_data['view_results']);
				db_query("UPDATE ?:views SET ?u WHERE view_id = ?i", $updated_data, $data['view_id']);
			}
		}

		if (empty($prev_id) && ($prev_page > 0)) {
			if (!empty($items_ids[$prev_page])) {
				$prev_id = !empty($items_ids[$prev_page][count($items_ids[$prev_page]) - 1])? $items_ids[$prev_page][count($items_ids[$prev_page]) - 1] : 0;//last on previus page
			} else {
				$prev_items_ids = fn_view_get_another_page_ids($condition, $data['params'], $view_results['items_per_page'], $prev_page);
				$prev_id = !empty($prev_items_ids[$prev_page][count($prev_items_ids[$prev_page])-1])? $prev_items_ids[$prev_page][count($prev_items_ids[$prev_page])-1] : 0;

				//store new ids
				foreach ($prev_items_ids as $page => $items) {
					$items_ids[$page] = $items;
				}
				$updated_data['view_results'] = array(
						'items_ids' => $items_ids,
						'total_pages' => $view_results['total_pages'],
						'items_per_page' => $view_results['items_per_page'],
						'total_items' => $view_results['total_items'],
				);
				$updated_data['view_results'] = serialize($updated_data['view_results']);
				db_query("UPDATE ?:views SET ?u WHERE view_id = ?i", $updated_data, $data['view_id']);
			}
		}

		if (!empty($condition['show_item_id'])) {
			$view->assign('show_item_id', $condition['show_item_id']);
		}
		if (!empty($condition['links_label'])) {
			$view->assign('links_label', fn_get_lang_var($condition['links_label']));
		}

		$view->assign('prev_id', $prev_id);
		$view->assign('next_id',$next_id);
	}
}

function fn_view_get_another_page_ids($condition, $params, $items_per_page, $page)
{
	$auth = & $_SESSION['auth'];

	$_ids = array();
	$params = unserialize($params);
	if (!empty($condition['additional_data'])) {
		$params = fn_array_merge($params, $condition['additional_data']);
	}
	$params = fn_array_merge($params, array('page' => $page));

	if (!empty($condition['auth'])) {
		list($items, ) = $condition['func']($params, $auth, $items_per_page);
	} elseif (!empty($condition['skip_param'])) {
		list($items, ) = $condition['func']($params, array(), $items_per_page);
	} else {
		list($items, ) = $condition['func']($params, $items_per_page);

	}
	foreach ($items as $v) {
		$_ids[$page][] = $v[$condition['item_id']];
	}

	Registry::get('view')->assign('pagination', array());	//Unset pagination

	return $_ids;
}

function fn_view_process_results($func, $items, $params, $items_per_page)
{
	fn_set_hook('view_process_results_pre', $func, $items, $params, $items_per_page);

	if (!empty($params['save_view_results']) && !empty($params['page'])) {
		$id = $params['save_view_results'];

		$view = & Registry::get('view');
		$pagination = $view->get_var('pagination');

		if (empty($pagination)) {
			return;
		}

		$current_page = $pagination['current_page'];

		$view_results = array(
			'items_ids' => array(),
			'total_pages' => $pagination['total_pages'],
			'items_per_page' => $pagination['items_per_page'],
			'total_items' =>$pagination['total_items'],
		);

		$items_ids = array();
		foreach ($items as $item) {
			$view_results['items_ids'][$current_page][] = $item[$id];
		}

		Registry::set('view_results.fn_get_' . $func, $view_results);
	}
}

/**
 * Get all schema files (e.g. exim schemas, admin area menu)
 *
 * @param string $schema_dir schema name (subdirectory in /schema directory)
 * @param string $name file name/prefix
 * @param string $type schema type (php/xml)
 * @param bool $caching enable/disable schema caching
 * @param bool $force_addon_init initialize disabled addons also
 * @return array schema definition (if exists)
 */
function fn_get_schema($schema_dir, $name, $type = 'php', $caching = true, $force_addon_init = false, $skip_included = false)
{
	static $permission_schemas;
	
	if ($schema_dir == 'permissions' && !empty($permission_schemas[$name])) {
		return $permission_schemas[$name];
	}
	
	if ($caching == true) {
		Registry::register_cache('schema_' . $schema_dir . '_' . $name, array('settings', 'addons'), CACHE_LEVEL_STATIC); // FIXME: hardcoded for settings-based schemas
		if (Registry::is_exist('schema_' . $schema_dir . '_' . $name) == true) {
			return Registry::get('schema_' . $schema_dir . '_' . $name);
		}
	}

	$files = array();
	$path_name = DIR_SCHEMAS . $schema_dir . '/' . $name;
	if (file_exists($path_name . '.' . $type)) {
		$files[] = $path_name . '.' . $type;
	}

	if (file_exists($path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.' . $type)) {
		$files[] = $path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.' . $type;
	}

	$addons = Registry::get('addons');
	if (!empty($addons)) {
		foreach ($addons as $k => $v) {
			if ($v['status'] == 'D' && $force_addon_init && file_exists(DIR_ADDONS . $k . '/func.php')) { // force addon initialization
				include_once(DIR_ADDONS . $k . '/func.php');
			}

			if ($v['status'] == 'A' || $force_addon_init) {
				$path_name = DIR_ADDONS . $k . '/schemas/' . $schema_dir . '/' . $name;
				if (file_exists($path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.' . $type)) {
					array_unshift($files, $path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.' . $type);
				}
				if (file_exists($path_name . '.' . $type)) {
					array_unshift($files, $path_name . '.' . $type);
				}
				if (file_exists($path_name . '.post.' . $type)) {
					$files[] = $path_name . '.post.' . $type;
				}
				if (file_exists($path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.post.' . $type)) {
					$files[] = $path_name . '_' . fn_strtolower(PRODUCT_TYPE) . '.post.' . $type;
				}
			}
		}
	}
	
	$schema = '';
	
	foreach ($files as $file) {
		if ($type == 'php') {
			if ($skip_included == true) {
				include_once($file);
			} else {
				include($file);
			}
		} else {
			$schema .= file_get_contents($file);
		}
	}

	if ($caching == true) {
		Registry::set('schema_' . $schema_dir . '_' . $name, $schema);
	}

	if ($schema_dir == 'permissions') {
		$permission_schemas[$name] = $schema;
	}

	return $schema;
}

/**
 * Check access permissions for certain controller/modes
 *
 * @param string $controller controller to check permissions for
 * @param string $mode controller mode to check permissions for
 * @param string $schema_name permissions schema name (demo_mode/production)
 * @param string $request_method check permissions for certain method (POST/GET)
 * @return boolean true if access granted, false otherwise
 */
function fn_check_permissions($controller, $mode, $schema_name, $request_method = '', $request_variables = array(), $extra = '')
{
	$request_method = empty($request_method) ? $_SERVER['REQUEST_METHOD'] : $request_method;

	$schema = fn_get_schema('permissions', $schema_name);
	
	if ($schema_name == 'admin') {
		if (defined('COMPANY_ID')) {
			$_result = fn_check_company_permissions($controller, $mode, $request_method, $request_variables, $extra);
			if (!$_result) {
				return false; 
			}
		}
		
		return fn_check_admin_permissions($schema, $controller, $mode, $request_method, $request_variables);
	}
	
	if ($schema_name == 'demo') {

		if (isset($schema[$controller])) {
			if ((isset($schema[$controller]['restrict']) && in_array($request_method, $schema[$controller]['restrict'])) || (isset($schema[$controller]['modes'][$mode]) && in_array($request_method, $schema[$controller]['modes'][$mode]))) {
				return false;
			}
		}
	}

	if ($schema_name == 'trusted_controllers') {
		
		$allow = !empty($schema[$controller]['allow']) ? $schema[$controller]['allow'] : 0;
		if (!is_array($allow)) {
			return $allow;
		} else {
			return (!empty($allow[$mode]) ? $allow[$mode] : 0);	
		}
	}

	return true;
}

function fn_check_company_permissions($controller, $mode, $request_method = '', $request_variables = array(), $extra = '')
{
	$schema = fn_get_schema('permissions', 'vendor');
	$default_permission = isset($schema['default_permission']) ? $schema['default_permission'] : false;
	$schema = $schema['controllers'];
	
	if (isset($schema[$controller])) {
		// Check if permissions set for certain mode
		if (isset($schema[$controller]['modes']) && isset($schema[$controller]['modes'][$mode])) {
			if (isset($schema[$controller]['modes'][$mode]['permissions'])) {
				$permission = is_array($schema[$controller]['modes'][$mode]['permissions']) ? $schema[$controller]['modes'][$mode]['permissions'][$request_method] : $schema[$controller]['modes'][$mode]['permissions'];
				if (isset($schema[$controller]['modes'][$mode]['condition'])) {
					$condition = $schema[$controller]['modes'][$mode]['condition'];
				}
			} elseif (!empty($request_variables['table']) && isset($schema[$controller]['modes'][$mode]['param_permissions']['table_names'][$request_variables['table']])) {
				$permission = $schema[$controller]['modes'][$mode]['param_permissions']['table_names'][$request_variables['table']];
			} elseif (!empty($extra)) {
				if (isset($schema[$controller]['modes'][$mode]['param_permissions']['extra'][$extra])) {
					$permission = $schema[$controller]['modes'][$mode]['param_permissions']['extra'][$extra];
				} elseif (isset($schema[$controller]['modes'][$mode]['param_permissions']['permission'])) {
					$permission = $schema[$controller]['modes'][$mode]['param_permissions']['permission'];
				}
				if (isset($schema[$controller]['modes'][$mode]['condition']['extra'][$extra])) {
					$condition = $schema[$controller]['modes'][$mode]['condition']['extra'][$extra];
				}
			}
		}

		// Check common permissions
		if (!isset($permission) && isset($schema[$controller]['permissions'])) {
			$permission = is_array($schema[$controller]['permissions']) ? $schema[$controller]['permissions'][$request_method] : $schema[$controller]['permissions'];
		}
	}
	
	$permission = isset($permission) ? $permission : $default_permission;
	
	if (isset($condition)) {
		if ($condition['operator'] == 'or') {
			$permission = ($permission || fn_execute_permission_condition($condition));
		} elseif ($condition['operator'] == 'and') {
			$permission = ($permission && fn_execute_permission_condition($condition));
		}
	}
	
	fn_set_hook('check_company_permissions', $permission, $controller, $mode, $request_method, $request_variables, $extra, $schema);
	
	return $permission;
}

function fn_check_admin_permissions(&$schema, $controller, $mode, $request_method = '', $request_variables = array())
{
	static $usergroup_privileges;

	if (empty($_SESSION['auth']['usergroup_ids'])) {
		$_schema = isset($schema['root']) ? $schema['root'] : array();
	} else {
		$_schema = $schema;
	}
	
	if (isset($_schema[$controller])) {
		// Check if permissions set for certain mode
		if (isset($_schema[$controller]['modes']) && isset($_schema[$controller]['modes'][$mode])) {
			if (isset($_schema[$controller]['modes'][$mode]['permissions'])) {
				$permission = is_array($_schema[$controller]['modes'][$mode]['permissions']) ? $_schema[$controller]['modes'][$mode]['permissions'][$request_method] : $_schema[$controller]['modes'][$mode]['permissions'];
				if (isset($_schema[$controller]['modes'][$mode]['condition'])) {
					$condition = $_schema[$controller]['modes'][$mode]['condition'];
				}

			} elseif (!empty($request_variables['table']) && isset($_schema[$controller]['modes'][$mode]['param_permissions']['table_names'][$request_variables['table']])) {
				$permission = $_schema[$controller]['modes'][$mode]['param_permissions']['table_names'][$request_variables['table']];
			}
		}

		// Check common permissions
		if (empty($permission) && !empty($_schema[$controller]['permissions'])) {
			$permission = is_array($_schema[$controller]['permissions']) ? $_schema[$controller]['permissions'][$request_method] : $_schema[$controller]['permissions'];
			if (isset($_schema[$controller]['condition'])) {
				$condition = $_schema[$controller]['condition'];
			}
		}

		if (empty($permission)) { // This controller does not have permission checking
			return true;
		} else {
			if (empty($usergroup_privileges)) {
				$usergroup_privileges = db_get_fields("SELECT privilege FROM ?:usergroup_privileges WHERE usergroup_id IN(?n)", $_SESSION['auth']['usergroup_ids']);
				$usergroup_privileges = (!empty($usergroup_privileges))? array_unique($usergroup_privileges) : array('__EMPTY__');
			}

			$result = in_array($permission, $usergroup_privileges);
			
			if (isset($condition)) {
				if ($condition['operator'] == 'or') {
					return ($result || fn_execute_permission_condition($condition));
				} elseif ($condition['operator'] == 'and') {
					return ($result && fn_execute_permission_condition($condition));
				}
			}

			return $result;
		}
	}
	
	return true;
}

/**
 * Execute additional condition for permissions
 * Condition may be function or other conditions(will be implemented later)
 *
 * @param array $condition
 * 
 * @return boolean result of $condition
 */
function fn_execute_permission_condition($condition)
{
	if (isset($condition['function'])) {
		$func_name = array_shift($condition['function']);
		$params = $condition['function'];
		// here we can process parameters
		return call_user_func_array($func_name, $params);	
	}
	
	return false;
}

/**
 * Function checks do user want to manage his own profile
 *
 * @return boolean true, if user want to view/edit own profile, false otherwise.
 */
function fn_check_permission_manage_own_profile()
{
	if (CONTROLLER == 'profiles' && MODE == 'update') {
		return (empty($_REQUEST['user_id']) || $_REQUEST['user_id'] == $_SESSION['auth']['user_id']) ? true : false;
	} elseif (CONTROLLER == 'auth' && MODE == 'password_change') {
		return true;
	} else {
		return false;
	}
}

/**
 * Function checks do user want to manage admin usergroup
 *
 * @return boolean true, if admin can update current usergroup, false otherwise.
 */
function fn_check_permission_manage_usergroups()
{
	if ($_SESSION['auth']['is_root'] != 'Y') {
		$type = db_get_field('SELECT type FROM ?:usergroups WHERE usergroup_id = ?i', $_REQUEST['usergroup_id']);
		
		if ($type == 'A') {
			return false;
		}
	}
	
	return true;
}


function fn_check_view_permissions($data, $request_method = '', $extra = '')
{
	if ((!defined('RESTRICTED_ADMIN') && !defined('COMPANY_ID')) || !trim($data) || $data == 'submit') {
		return true;
	}

	if (!preg_match("/dispatch=(\w+)\.(\w+)/", $data, $m)) {
		$request_method = !empty($request_method) ? $request_method : 'POST';
		if (!preg_match("/dispatch(?:\[|%5B)(\w+)\.(\w+)/", $data, $m)) {
			preg_match("/(\w+)\.?(\w+)?/", $data, $m);
		}
	} else {
		$request_method = !empty($request_method) ? $request_method : 'GET';
	}

	return fn_check_permissions($m[1], $m[2], 'admin', $request_method, array(), $extra);
}
	
function fn_check_form_permissions($extra = '')
{
	//FIXME: baaad code?
	if ((PRODUCT_TYPE != 'MULTIVENDOR' && PRODUCT_TYPE != 'ULTIMATE') || (!defined('RESTRICTED_ADMIN') && !defined('COMPANY_ID'))) {
		return false;
	}
	return !fn_check_permissions(CONTROLLER, MODE, 'admin', 'POST', array(), $extra);
}
/**
 * This function searches placeholders in the text and converts the found data.
 *
 * @param string $text
 * @return changed text
 */

function fn_text_placeholders($text)
{
	static $placeholders = array(
		'price',
		'weight'
	);

	$pattern = '/%([,\.\w]+):(' . implode('|', $placeholders) . ')%/U';
	$text = preg_replace_callback($pattern, 'fn_apply_text_placeholders', $text);

	return $text;
}

function fn_apply_text_placeholders($matches)
{
	if (isset($matches[1]) && !empty($matches[2])) {
		if ($matches[2] == 'price') {
			$currencies = Registry::get('currencies');
			$currency = $currencies[CART_SECONDARY_CURRENCY];
			$value = fn_format_rate_value($matches[1], 'F', $currency['decimals'], $currency['decimals_separator'], $currency['thousands_separator'], $currency['coefficient']);

			return $currency['after'] == 'Y' ? $value . $currency['symbol'] : $currency['symbol'] . $value;
		} elseif ($matches[2] == 'weight') {

			return $matches[1] . '&nbsp;' . Registry::get('settings.General.weight_symbol');
		}
	}
}

function fn_generate_code($prefix = '', $length = 12)
{
	$postfix = '';
    $chars = implode('', range('0', '9')) . implode('', range('A', 'Z'));

    for ($i = 0; $i < $length; $i++) {
    	$ratio = (strlen(str_replace('-', '', $postfix)) + 1) / 4;
        $postfix .= $chars[rand(0, strlen($chars) - 1)];
   		$postfix .= ((ceil($ratio) == $ratio) && ($i < $length - 1)) ? '-' : '';
    }

	return (!empty($prefix)) ?  strtoupper($prefix) . '-' . $postfix : $postfix;
}

function fn_get_shipping_images()
{
	$data = db_get_array("SELECT ?:shippings.shipping_id, ?:shipping_descriptions.shipping FROM ?:shippings INNER JOIN ?:images_links ON ?:shippings.shipping_id = ?:images_links.object_id AND ?:images_links.object_type = 'shipping' LEFT JOIN ?:shipping_descriptions ON ?:shippings.shipping_id = ?:shipping_descriptions.shipping_id AND ?:shipping_descriptions.lang_code = ?s WHERE ?:shippings.status = 'A' ORDER BY ?:shippings.position, ?:shipping_descriptions.shipping", CART_LANGUAGE);

	if (empty($data)) {
		return array ();
	}

	$images = array ();

	foreach ($data as $key => $entry) {
		$image = fn_get_image_pairs($entry['shipping_id'], 'shipping', 'M');

		if (!empty($image['icon'])) {
			$image['icon']['alt'] = empty($image['icon']['alt']) ? $entry['shipping'] : $image['icon']['alt'];
			$images[] = $image['icon'];
		}
	}

	return $images;
}

function fn_get_payment_methods_images()
{
	$data = db_get_array("SELECT ?:payments.payment_id, ?:payment_descriptions.payment FROM ?:payments INNER JOIN ?:images_links ON ?:payments.payment_id = ?:images_links.object_id AND ?:images_links.object_type = 'payment' LEFT JOIN ?:payment_descriptions ON ?:payments.payment_id = ?:payment_descriptions.payment_id AND ?:payment_descriptions.lang_code = ?s WHERE ?:payments.status = 'A' ORDER BY ?:payments.position, ?:payment_descriptions.payment", CART_LANGUAGE);

	if (empty($data)) {
		return array ();
	}

	$images = array ();

	foreach ($data as $key => $entry) {
		$image = fn_get_image_pairs($entry['payment_id'], 'payment', 'M');

		if (!empty($image['icon'])) {
			$image['icon']['alt'] = empty($image['icon']['alt']) ? $entry['payment'] : $image['icon']['alt'];
			$images[] = $image['icon'];
		}
	}

	return $images;
}

function fn_get_credit_cards_images()
{
	$data = db_get_array("SELECT ?:static_data.param_id, ?:static_data_descriptions.descr  FROM ?:static_data INNER JOIN ?:images_links ON ?:static_data.param_id = ?:images_links.object_id AND ?:images_links.object_type = 'credit_card' LEFT JOIN ?:static_data_descriptions ON ?:static_data.param_id = ?:static_data_descriptions.param_id WHERE ?:static_data.status = 'A' AND ?:static_data.section = 'C' ORDER BY ?:static_data.position, ?:static_data_descriptions.descr ");

	if (empty($data)) {
		return array ();
	}

	$images = array ();

	foreach ($data as $key => $entry) {
		$image = fn_get_image_pairs($entry['param_id'], 'credit_card', 'M');

		if (!empty($image['icon'])) {
			$image['icon']['alt'] = empty($image['icon']['alt']) ? $entry['descr'] : $image['icon']['alt'];
			$images[] = $image['icon'];
		}
	}

	return $images;
}

function fn_html_to_pdf($html, $name)
{
	if (!fn_init_pdf()) {
		fn_redirect((!empty($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : INDEX_SCRIPT);
	}

	$pipeline = PipelineFactory::create_default_pipeline('', '');

	if (!is_array($html)) {
		$html = array($html);
	}

    $pipeline->fetchers = array (
		new Pdf_FetcherMemory($html, Registry::get('config.current_location') . '/'),
		new FetcherURL(),
	);

	$pipeline->destination = new Pdf_DestinationDownload($name);

    $pipeline->data_filters = array (
		new DataFilterDoctype(),
		new DataFilterHTML2XHTML(),
	);

	$media = & Media::predefined('A4');
	$media->set_landscape(false);
	$media->set_margins(array('left' => 20, 'right' => 20, 'top' => 20, 'bottom' => 0));
	$media->set_pixels(600);

	$_config = array (
		'cssmedia' => 'print',
		'scalepoints' => '1',
		'renderimages' => true,
		'renderlinks' => true,
		'renderfields' => true,
		'renderforms' => false,
		'mode' => 'html',
		'encoding' => 'utf8',
		'debugbox' => false,
		'pdfversion' => '1.4',
		'draw_page_border' => false,
		'smartpagebreak' => true,
	);

	$pipeline->configure($_config);
	$pipeline->process_batch(array_keys($html), $media);
}

//
// Helper function: trims trailing and leading spaces
//
function fn_trim_helper(&$value)
{
	$value = is_string($value) ? trim($value) : $value;
}

/**
 * Sort array by key
 * @param array $array Array to be sorted
 * @param string $key Array key to sort by
 * @param int $order Sort order (SORT_ASC/SORT_DESC)
 * @return array Sorted array
 */
function fn_sort_array_by_key($array, $key, $order = SORT_ASC)
{
	$need_sorting = false;
	// check if array is already sorted 
	// to avoid extra array mixing with uasort
	$prev_k = null;
	foreach ($array as $k => $v) {
		if (!is_null($prev_k)) {
			$r = strnatcasecmp($array[$prev_k][$key], $v[$key]);
			if (($order == SORT_ASC && $r > 0) || ($order != SORT_ASC && $r < 0)) {
				$need_sorting = true;
				break;
			}
		}

		$prev_k = $k;
	}

	if ($need_sorting) {
		uasort($array, create_function('$a, $b', "\$r = strnatcasecmp(\$a['$key'], \$b['$key']); return ($order == SORT_ASC) ? \$r : 0 - \$r ;"));
	}
	return $array;
}

/**
* Explode string by delimiter and trim values
*
* @param string $delim - delimiter to explode by
* @param string $string - string to explode
* @return array
*/
function fn_explode($delim, $string)
{
	$a = explode($delim, $string);
	array_walk($a, 'fn_trim_helper');

	return $a;
}

/**
* Formats date using current language
*
* @param int $timestamp - timestamp of the date to format
* @param string $format - format string (see strftim)
* @return string formatted date
*/
function fn_date_format($timestamp, $format = '%b %e, %Y')
{
	if (substr(PHP_OS,0,3) == 'WIN') {
        $hours = strftime('%I', $timestamp);
        $short_hours = ($hours < 10) ? substr($hours, -1) : $hours;
        $_win_from = array ('%e', '%T', '%D', '%l');
        $_win_to = array ('%d', '%H:%M:%S', '%m/%d/%y', $short_hours);
        $format = str_replace($_win_from, $_win_to, $format);
    }

	$date = getdate($timestamp);
	$m = $date['mon'];
	$d = $date['mday'];
	$y = $date['year'];
	$w = $date['wday'];
	$hr = $date['hours'];
	$pm = ($hr >= 12);
	$ir = ($pm) ? ($hr - 12) : $hr;
	$dy = $date['yday'];
	$fd = getdate(mktime(0, 0, 0, 1, 1, $y)); // first day of year
	$wn = (int) (($dy + $fd['wday']) / 7);
	if ($ir == 0) {
		$ir = 12;
	}
	$min = $date['minutes'];
	$sec = $date['seconds'];

	// Preload language variables if needed
	$preload = array();
	if (strpos($format, '%a') !== false) {
		$preload[] = 'weekday_abr_' . $w;
	}
	if (strpos($format, '%A') !== false) {
		$preload[] = 'weekday_' . $w;
	}

	if (strpos($format, '%b') !== false) {
		$preload[] = 'month_name_abr_' . $m;
	}

	if (strpos($format, '%B') !== false) {
		$preload[] = 'month_name_' . $m;
	}

	fn_preload_lang_vars($preload);

	$s['%a'] = fn_get_lang_var('weekday_abr_'. $w); // abbreviated weekday name
	$s['%A'] = fn_get_lang_var('weekday_'. $w); // full weekday name
	$s['%b'] = fn_get_lang_var('month_name_abr_' . $m); // abbreviated month name
	$s['%B'] = fn_get_lang_var('month_name_' . $m); // full month name
	$s['%c'] = ''; // !!!FIXME: preferred date and time representation for the current locale
	$s['%C'] = 1 + floor($y / 100); // the century number
	$s['%d'] = ($d < 10) ? ('0' . $d) : $d; // the day of the month (range 01 to 31)
	$s['%e'] = $d; // the day of the month (range 1 to 31)
	$s['%ð'] = $s['%b'];
	$s['%H'] = ($hr < 10) ? ('0' . $hr) : $hr; // hour, range 00 to 23 (24h format)
	$s['%I'] = ($ir < 10) ? ('0' . $ir) : $ir; // hour, range 01 to 12 (12h format)
	$s['%j'] = ($dy < 100) ? (($dy < 10) ? ('00' . $dy) : ('0' . $dy)) : $dy; // day of the year (range 001 to 366)
	$s['%k'] = $hr;		// hour, range 0 to 23 (24h format)
	$s['%l'] = $ir;		// hour, range 1 to 12 (12h format)
	$s['%m'] = ($m < 10) ? ('0' . $m) : $m; // month, range 01 to 12
	$s['%M'] = ($min < 10) ? ('0' . $min) : $min; // minute, range 00 to 59
	$s['%n'] = "\n";		// a newline character
	$s['%p'] = $pm ? 'PM' : 'AM';
	$s['%P'] = $pm ? 'pm' : 'am';
	$s['%s'] = floor($timestamp / 1000);
	$s['%S'] = ($sec < 10) ? ('0' . $sec) : $sec; // seconds, range 00 to 59
	$s['%t'] = "\t";		// a tab character
	$s['%T'] = $s['%H'] .':'. $s['%M'] .':'. $s['%S'];
	$s['%U'] = $s['%W'] = $s['%V'] = ($wn < 10) ? ('0' . $wn) : $wn;
	$s['%u'] = $w + 1;	// the day of the week (range 1 to 7, 1 = MON)
	$s['%w'] = $w;		// the day of the week (range 0 to 6, 0 = SUN)
	$s['%y'] = substr($y, 2, 2); // year without the century (range 00 to 99)
	$s['%Y'] = $y;		// year with the century
	$s['%%'] = '%';		// a literal '%' character
	$s['%D'] = $s['%m'] .'/'. $s['%d'] .'/'. $s['%y'];// american date style: %m/%d/%y
	// FIXME: %x : preferred date representation for the current locale without the time
	// FIXME: %X : preferred time representation for the current locale without the date
	// FIXME: %G, %g (man strftime)
	// FIXME: %r : the time in am/pm notation %I:%M:%S %p
	// FIXME: %R : the time in 24-hour notation %H:%M
	return preg_replace("/(%.)/e", "\$s['\\1']", $format);
}

function fn_text_diff($source, $dest, $side_by_side = false)
{
	fn_init_diff();

	$diff = new Text_Diff('auto', array(explode("\n", $source), explode("\n", $dest)));
	$renderer = new Text_Diff_Renderer_inline();

	if ($side_by_side == false) {
		$renderer->_split_level = 'words';
	}

	$res = $renderer->render($diff);

	if ($side_by_side == true) {
		$res = $renderer->sideBySide($res);
	}

	return $res;
}

/**
 * Set store mode
 *
 * @param string $store_mode store operation mode: opened/closed
 * @return boolean always true
 */
function fn_set_store_mode($store_mode, $company_id = null)
{
	if (PRODUCT_TYPE != 'ULTIMATE' && defined('COMPANY_ID')) {
		return false;
	}
	
	if ($store_mode == 'opened' || $store_mode == 'closed') {
		if (CSettings::instance()->get_value('store_mode', '', $company_id) != $store_mode) {
			CSettings::instance()->update_value('store_mode', $store_mode, '', true, $company_id);
			fn_set_notification('W', fn_get_lang_var('information'), fn_get_lang_var('text_store_mode_' . $store_mode));

			Registry::set('settings.store_mode', $store_mode);
			Registry::get('view')->assign('settings', Registry::get('settings'));
		}

	} elseif ($store_mode == 'live' || $store_mode == 'dev') {

		if (Registry::get('settings.store_optimization') != $store_mode) {
			CSettings::instance()->update_value('store_optimization', $store_mode);
			fn_set_notification('W', fn_get_lang_var('information'), fn_get_lang_var('text_store_optimization_' . $store_mode));

			Registry::set('settings.store_optimization', $store_mode);
			Registry::get('view')->assign('settings', Registry::get('settings'));
		}

	}
	
	return true;
}

/**
 * Create array using $keys for keys and $value for values
 *
 * @param array $keys array keys
 * @param mixed $values if string/boolean, values array will be recreated with this value (e.g. $keys = array(1,2,3), $values = true => $values = array(0=>true,1=>true,2=>true)) 
 * @return array combined array
 */
function fn_array_combine($keys, $values)
{
	if (empty($keys)) {
		return array();
	}
	
	if (!is_array($values)) {
		$values = array_fill(0, sizeof($keys), $values);
	}

	return array_combine($keys, $values);
}

/**
 * Return cleaned text string (for meta description use)
 *
 * @param string $html - html code to generate description from
 * @param int $max_letters - maximum letters in description
 * @return string - cleaned text
 */
function fn_generate_meta_description($html, $max_letters = 250) 
{
	$meta = array();
	if (!empty($html)) {
		$html = str_replace('&nbsp;', ' ', $html);
		$html = str_replace(array("\r\n", "\n", "\r"), ' ', html_entity_decode(trim($html), ENT_QUOTES, 'UTF-8'));
		$html = preg_replace('/\<br(\s*)?\/?\>/i', " ", $html);
		$html = preg_replace('|<style[^>]*>.*?</style>|i', '', $html);
		$html = strip_tags($html);
		$html = str_replace(array('.', ',', ':', ';', '`', '"', '~', '\'', '(', ')'), ' ', $html);
		$html = preg_replace('/\s+/', ' ', $html);
		$html = explode(' ', $html);
		$letters_count = 0;
		foreach ($html as $k => $v) {
			$letters_count += fn_strlen($v);
			if ($letters_count <= $max_letters) {
				$meta[] = $v;
			} else {
				break;
			}
		}
	}

	return implode(' ', $meta);
}

/**
 * Calculate unsigned crc32 sum
 *
 * @param string $key - key to calculate sum for
 * @return int - crc32 sum
 */
function fn_crc32($key)
{
	return sprintf('%u', crc32($key));
}

/**
 * Check whether string is UTF-8 encoded
 *
 * @param string $str 
 * @return boolean
 */
function fn_is_utf8($str)
{
    $c = 0; $b = 0;
    $bits = 0;
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $c = ord($str[$i]);
        if ($c > 128) {
            if (($c >= 254)) {
            	return false;
            } elseif ($c >= 252) {
            	$bits = 6;
            } elseif ($c >= 248) {
            	$bits = 5;
            } elseif ($c >= 240) {
            	$bits = 4;
            } elseif ($c >= 224) {
            	$bits = 3;
            } elseif ($c >= 192) {
            	$bits = 2;
            } else {
            	return false;
            }
            
            if (($i + $bits) > $len) {
            	return false;
            }
            
            while ($bits > 1) {
                $i++;
                $b = ord($str[$i]);
                if ($b < 128 || $b > 191) {
                	return false;
                }
                $bits--;
            }
        }
    }
    return true;
}

/**
 * Detect the cyrillic encoding of string
 *
 * @param string $str 
 * @return string cyrillic encoding
 */
function fn_detect_cyrillic_charset($str)
{
	fn_define('LOWERCASE', 3);
	fn_define('UPPERCASE', 1);
	
    $charsets = array(
		'KOI8-R' => 0,
		'CP1251' => 0,
		'CP866' => 0,
		'ISO-8859-5' => 0,
		'MAC-CYRILLIC' => 0
	);
                      
	for ($i = 0, $length = strlen($str); $i < $length; $i++) {
		$char = ord($str[$i]);
		//non-russian characters
		if ($char < 128 || $char > 256) {
			continue;
		}

		//CP866
		if (($char > 159 && $char < 176) || ($char > 223 && $char < 242)) {
			$charsets['CP866'] += LOWERCASE;
		}

		if (($char > 127 && $char < 160)) {
			$charsets['CP866'] += UPPERCASE;
		}

		//KOI8-R
		if (($char > 191 && $char < 223)) {
			$charsets['KOI8-R'] += LOWERCASE;
		}
		if (($char > 222 && $char < 256)) {
			$charsets['KOI8-R'] += UPPERCASE;
		}

		//CP1251
		if ($char > 223 && $char < 256) {
			$charsets['CP1251'] += LOWERCASE;
		}
		if ($char > 191 && $char < 224) {
			$charsets['CP1251'] += UPPERCASE;
		}

		//MAC-CYRILLIC
		if ($char > 221 && $char < 255) {
			$charsets['MAC-CYRILLIC'] += LOWERCASE;
		}
		if ($char > 127 && $char < 160) {
			$charsets['MAC-CYRILLIC'] += UPPERCASE;
		}

		//ISO-8859-5
		if ($char > 207 && $char < 240) {
			$charsets['ISO-8859-5'] += LOWERCASE;
		}
		if ($char > 175 && $char < 208) {
			$charsets['ISO-8859-5'] += UPPERCASE;
		}
	}

	arsort($charsets);
	return current($charsets) > 0 ? key($charsets) : '';
}

/**
 * Detect encoding by language
 *
 * @param string $resource string or file path
 * @param string $resource_type 'S' (string) or 'F' (file)
 * @param string $lang_code language of the file characters
 * @return string  detected encoding
 */

function fn_detect_encoding($resource, $resource_type = 'S', $lang_code = CART_LANGUAGE)
{
	$enc = '';
	$str = $resource;
	
	if ($resource_type == 'F') {
		$str = file_get_contents($resource);
		if ($str == false) {
			return $enc;
		}
	}
	
	if (!fn_is_utf8($str)) {
		$lang_code = fn_strtolower($lang_code);
		
		if (in_array($lang_code, array('en', 'fr', 'es', 'it', 'nl', 'da', 'fi', 'sv', 'pt', 'nn', 'no'))) {
			$enc = 'ISO-8859-1';
		} elseif (in_array($lang_code, array('hu', 'cs', 'pl', 'bg', 'ro'))) {
			$enc = 'ISO-8859-2';					
		} elseif (in_array($lang_code, array('et', 'lv', 'lt'))) {
			$enc = 'ISO-8859-4';					
		} elseif ($lang_code == 'ru') {
			$enc = fn_detect_cyrillic_charset($str);
		} elseif ($lang_code == 'ar') {
			$enc = 'ISO-8859-6';					
		} elseif ($lang_code == 'el') {
			$enc = 'ISO-8859-7';					
		} elseif ($lang_code == 'he') {
			$enc = 'ISO-8859-8';					
		} elseif ($lang_code == 'tr') {
			$enc = 'ISO-8859-9';					
		}
	} else {
		$enc = 'UTF-8';
	}
	
	return $enc;
}

/**
 * Convert encoding of string or file
 *
 * @param string $from_enc  the encoding of the initial string/file
 * @param string $to_enc  the encoding of the result string/file 
 * @param string $resource string or file path 
 * @param string $resource_type 'S' (string) or 'F' (file)
 * @return string  string or file path
 */

function fn_convert_encoding($from_enc, $to_enc, $resource, $resource_type = 'S')
{
	if (empty($from_enc) || empty($to_enc) || ($resource_type == 'F' && empty($resource))) {
		return false;
	}
	
	if (strtoupper($from_enc) == strtoupper($to_enc)) {
		return $resource;
	}
	
	$str = $resource;
	if ($resource_type == 'F') {
		$str = file_get_contents($resource);
		if ($str == false) {
			return false;
		}
	}
	
	$_str = false;
	if (function_exists('iconv')) {
		if (strtoupper($to_enc) == 'UCS-2') {
			$to_enc = 'UCS-2BE';
		}
		$_str = iconv($from_enc, $to_enc, $str);
	} elseif (function_exists('mb_convert_encoding')) {
		$_str = mb_convert_encoding($str, $to_enc, $from_enc);
	}
	
	if ($resource_type == 'F') {
		if ($_str != false) {
			$f = fopen($resource, 'wb');
			if ($f) {
				fwrite($f, $_str);
				fclose($f);
				@chmod($resource, DEFAULT_FILE_PERMISSIONS);
			} else {
				$resource = false;
			}
		}
		
		return $resource;
	} else {
		return $_str;
	}
}

function fn_check_meta_redirect($url)
{
	if (empty($url)) {
		return false;
	}

	if (strpos($url, '://') && !(strpos($url, Registry::get('config.http_location')) === 0 || strpos($url, Registry::get('config.https_location')) === 0)) {
		return false;
	} else {
		return $url;
	}
}

function fn_get_notification_rules($params, $disable_notification = false)
{
	$force_notification = array();
	if ($disable_notification) {
		$force_notification = array('C' => false, 'A' => false, 'S' => false);
	} else {
		if (!empty($params['notify_user']) || $params === true) {
			$force_notification['C'] = true;
		} else {
			if (AREA == 'A') {
				$force_notification['C'] = false;
			}
		}
		if (!empty($params['notify_department']) || $params === true) {
			$force_notification['A'] = true;
		} else {
			if (AREA == 'A') {
				$force_notification['A'] = false;
			}
		}
		if (!empty($params['notify_supplier']) || $params === true) {
			$force_notification['S'] = true;
		} else {
			if (AREA == 'A') {
				$force_notification['S'] = false;
			}
		}
	}

	return $force_notification;
}

/**
* Generate security hash to protect forms from CRSF attacks
*
* @return string salted hash
*/
function fn_generate_security_hash()
{
	if (empty($_SESSION['security_hash'])) {
		$_SESSION['security_hash'] = md5(Registry::get('config.crypt_key') . Session::get_id());
	}

	return $_SESSION['security_hash'];
}

/**
 * substr() with full UTF-8 support
 *
 * @param string $string The input string.
 * @param integer $start If start  is non-negative, the returned string will start at the start 'th position in string , counting from zero. If start is negative, the returned string will start at the start 'th character from the end of string.
 * @param integer $length  If length  is given and is positive, the string returned will contain at most length  characters beginning from start  (depending on the length of string ). If length is given and is negative, then that many characters will be omitted from the end of string (after the start position has been calculated when a start is negative). If start denotes a position beyond this truncation, an empty string will be returned. 
 * @param integer $encoding The encoding parameter is the character encoding. If it is omitted, UTF-8 character encoding value will be used.
 * @return mixed Returns the extracted part of string or false if string is less than or equal to start characters long  
 */
function fn_substr($string, $start, $length = null, $encoding = 'UTF-8')
{
	if (empty($encoding)) {
		$encoding = 'UTF-8';	
	}
	
	if ($length === null) {
		return fn_substr($string, $start, fn_strlen($string, $encoding), $encoding);
	}
	
	if (function_exists('iconv_substr')) {
		// there was strange bug in iconv_substr when use negative length parameter
		// so we recalculate start and length here
		if ($length < 0) {
			$length = ceil($length);
			$len = iconv_strlen($string, $encoding);
			if ($start < 0) {
				$start += $len;	
			}
			$length += $len - $start;
		}
		
		return iconv_substr($string, $start, $length, $encoding);
	} elseif (function_exists('mb_substr')) {
		return mb_substr($string, $start, $length, $encoding);
	} else {
		preg_match_all('/./su', $string, $ar);
		return join('', array_slice($ar[0], $start, $length));
	}
}

/**
 * strlen() with full UTF-8 support
 *
 * @param string $string The string being measured for length.
 * @param string $encoding The encoding parameter is the character encoding. If it is omitted, UTF-8 character encoding value will be used.
 * @return integer The length of the string on success, and 0 if the string is empty.
 */
function fn_strlen($string, $encoding = 'UTF-8')
{
	if (empty($encoding)) {
		$encoding = 'UTF-8';	
	}

	if (function_exists('iconv_strlen')) {
		return @iconv_strlen($string, $encoding);
	} elseif (function_exists('mb_strlen')) {
		return mb_strlen($string, $encoding);
	} else {
		preg_match_all('/./su', $string, $ar);
		return count($ar[0]);
	}
}

/**
 * Converts URN to URI
 * 
 * @param string $url URN (Uniform Resource Name or Query String)
 * @param string $area Area
 * @param string $protocol Output URL protocol (protocol://). If equals 'rel', no protocol will be included 
 * @param string $delimeter URN delimeter (&|&amp;)
 * @param string $lang_code 2 letters language code
 * @param bool $override_area 
 * @return bool Always true
 */
function fn_url($url = '', $area = AREA, $protocol = 'rel', $delimeter = '&amp;', $lang_code = CART_LANGUAGE, $override_area = false)
{
	static $init_vars = false;
	static $admin_index, $_admin_index, $vendor_index, $customer_index, $http_location, $https_location, $current_location;

	/**
	 * Prepares parameters before building URL
	 * 
	 * @param string $url URN (Uniform Resource Name or Query String)
	 * @param string $area Area
	 * @param string $protocol Output URL protocol (protocol://). If equals 'rel', no protocol will be included 
	 * @param string $delimeter URN delimeter (&|&amp;)
	 * @param string $lang_code 2 letters language code
	 * @param bool $override_area 
	 * @return bool Always true
	 */
	fn_set_hook('url_pre', $url, $area, $protocol, $delimeter, $lang_code, $override_area);

	if (!$init_vars) {
		$vendor_index = Registry::get('config.vendor_index');
		$_admin_index = Registry::get('config.admin_index');
		$customer_index = Registry::get('config.customer_index');
		$http_location = Registry::get('config.http_location');
		$https_location = Registry::get('config.https_location');
		$current_location = Registry::get('config.current_location');
		
		$init_vars = true;
	}
	$admin_index_area = $override_area ? 'A' : '';
	$admin_index = fn_get_index_script($admin_index_area);

	if ($area != 'A' && $area != 'C') {
		$prev_admin_index = $admin_index;
		$admin_index = fn_get_index_script($area);
		$area = 'A';
	}

	$url = str_replace('&amp;', '&', $url);
	$parced_url = parse_url($url);
	$no_shorted = false;

	if (!empty($parced_url['scheme']) || !empty($parced_url['host'])) {
		$no_shorted = true;
	} else {
		if (!empty($parced_url['path'])) {
			if (stripos($parced_url['path'], $_admin_index) !== false) {
				$area = 'A';
				$no_shorted = true;
			} elseif (stripos($parced_url['path'], $customer_index) !== false) {
				$area = 'C';
				$no_shorted = true;
			} elseif (!empty($vendor_index) && stripos($parced_url['path'], $vendor_index) !== false) {
				$area = 'A';
				$no_shorted = true;
			}
		} else {
			$url = $_url = ($area == 'C') ? $customer_index : $admin_index;
			$no_shorted = true;
		}
	}

	$index_script = ($area == 'C') ? $customer_index : $admin_index;

	$_url = ($no_shorted) ? $url : $index_script . '?dispatch=' . str_replace('?', $delimeter, $url);

	if (!empty($parced_url['query'])) {
		$split_query = explode('&', $parced_url['query']);
		$_url = str_replace($parced_url['query'], join($delimeter, $split_query), $_url);
	}

	if ($protocol != 'rel' || defined('DISPLAY_FULL_PATHS')) {
		if ($protocol == 'http') {
			$_url = $http_location . '/' . $_url;
		} elseif ($protocol == 'https') {
			$_url = $https_location . '/' . $_url;
		}  elseif ($protocol == 'current' || defined('DISPLAY_FULL_PATHS')) {
			$_url = $current_location . '/' . $_url;
		}  elseif ($protocol == 'checkout') {
			$_url = (((Registry::get('settings.General.secure_checkout') == 'Y'))? $https_location : $http_location) . '/' . $_url;
		}

	}

	$company_id_in_url = fn_get_company_id_from_uri($url);

	/**
	 * Prepares parameters before building URL
	 * 
	 * @param string $_url Output URL
	 * @param string $area Area
	 * @param string $delimeter URL delimeter (&|&amp;)
	 * @param string $url Input URL
	 * @param string $lang_code 2 letters language code
 	 * @param string $protocol Output URL protocol (protocol://). If equals 'rel', no protocol will be included 
 	 * @param int $company_id_in_url Equals company_id if it is present in $url, otherwise false
	 */
	fn_set_hook('url_post', $_url, $area, $delimeter, $url, $protocol, $company_id_in_url, $lang_code);

	if (!empty($prev_admin_index)) {
		$admin_index = $prev_admin_index;
	}

	return $_url;
}

/**
 * Returns company_id if it is present in $uri, otherwise false
 *
 * @param string $uri URI | URN
 * @return int|bool company_id if it is present in $uri, otherwise false
 */
function fn_get_company_id_from_uri($uri)
{
	$company_id = false;

	if (preg_match("%(\?|&|&amp;)company_id=(\d+)%", $uri, $match)) {
		if (!empty($match[2])) {
			$company_id = $match[2];
		}
	}

	return $company_id;
}

function fn_check_user_type_access_rules($user_data)
{
	$result = (
			!empty($user_data['user_type'])
			&&
			(
				$user_data['user_type'] == 'A' && (ACCOUNT_TYPE == 'admin' || ACCOUNT_TYPE == 'customer')
				||
				$user_data['user_type'] == 'V' && (ACCOUNT_TYPE == 'vendor'  || ACCOUNT_TYPE == 'customer')
				||
				$user_data['user_type'] == 'C' && ACCOUNT_TYPE == 'customer'
			)
	);
	
	fn_set_hook('check_user_type_access_rules', $user_data, $result);
	
	return $result;
}

function fn_get_manifest_definition()
{
	$areas = array(
		'C' => array (
			'skin' => 'customer',
			'path' => 'customer',
			'name' => 'Customer_logo',
			'text' => 'text_customer_area_logo'
		),
		'M' => array (
			'skin' => 'customer',
			'path' => 'mail',
			'name' => 'Mail_logo',
			'text' => 'text_mail_area_logo'
		)
	);

	fn_set_hook('get_manifest_definition', $areas);
	
	return $areas;
}

function fn_get_manifest($area, $lang_code = CART_LANGUAGE, $company_id = null)
{
	$skin_path = fn_get_skin_path('[skins]/[skin]', $area, $company_id);
	
	if (!file_exists($skin_path . '/' . SKIN_MANIFEST)) {
		if (defined('COMPANY_ID') && AREA == 'A' && !defined('AJAX_REQUEST')) {
			fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[link]', '<a href="' . fn_url('skin_selector.manage') . '">' . fn_url('skin_selector.manage') . '</a>', fn_get_lang_var('warning_selected_skin_not_found')), 'K', 'skin_not_found');
		}
		
		return array();
	}
	
	$manifest = parse_ini_file($skin_path . '/' . SKIN_MANIFEST, true);

	$exclude_key = array (
		'description',
		'admin',
		'customer'
	);

	if (defined('COMPANY_ID') && $company_id == null) {
		$company_id = COMPANY_ID;
	}

	if ($company_id) {
		$company_data = fn_get_company_data($company_id, $lang_code);
		$logos = !empty($company_data['logos']) ? unserialize($company_data['logos']) : array();
		$manifest = array_merge($manifest, $logos);
	} else {
		$company_data['company'] = Registry::get('settings.Company.company_name');
	}
	
	$alts = db_get_hash_single_array("SELECT object_holder, description FROM ?:common_descriptions WHERE object_id = ?i AND lang_code = ?s", array('object_holder', 'description'), $company_id, $lang_code);

	foreach ($manifest as $key => $val) {
		if (!in_array($key, $exclude_key) && isset($alts[$key])) {
			$manifest[$key]['alt'] = !empty($alts[$key]) ? $alts[$key] : $company_data['company'];
		}
	}

	return $manifest;
}

/**
 * Check for non empty string
 *
 * @param string $str string
 * @return boolean string is not empty?
 */
function fn_string_not_empty($str)
{
	return (strlen((trim($str)))>0) ? true : false;
}

/**
 * Check for number
 *
 * @param string $num number
 * @return boolean string is number?
 */
function fn_is_numeric($num)
{
	return is_numeric(trim($num));
}

/**
 * @Fancy recursive function to search for substring in an array 
 * @param string $neele
 * @param mixed $haystack
 * @return bool
 * @author andyye
 */
function fn_substr_in_array($what_str, $where_arr)
{
	foreach ($where_arr as $v) {
		if (is_array($v)) {
			$sub_arr = fn_substr_in_array($what_str, $v);
			if ($sub_arr) {
			    return true;
			}
		} else {
			if (strpos($v, $what_str) !== false) {
				return true;
			}
		}
	}
	return false;
}

function fn_return_bytes($val)
{
	$last = fn_strtolower($val{strlen($val)-1});
	switch($last) {
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}

	return $val;
}

/**
 * Funtion formats user-entered price into float.
 *
 * @param string $price
 * @param string $currency
 * @return float Well-formatted price.
 */
function fn_parse_price($price, $currency = CART_PRIMARY_CURRENCY)
{
	$decimals = Registry::get('currencies.' . $currency . '.decimals');
	$dec_sep = Registry::get('currencies.' . $currency . '.decimals_separator');
	$thous_sep = Registry::get('currencies.' . $currency . '.thousands_separator');

	if ($dec_sep == $thous_sep) {
		if (($last = strrpos($price, $dec_sep)) !== false) {
			if ($thous_sep == '.') {
				$price = str_replace('.', ',', $price);
			}
			$price = substr_replace($price, '.', $last, 1);
		}
	} else {
		if ($thous_sep == '.') {
			// is it really thousands separator?
			// if there is decimals separator, than we can replace ths_sep
			if (strpos($price, $dec_sep) !== false) {
				$price = str_replace($thous_sep, '', $price);
			} else {
				//if there are 3 digits rigth of the separator - it is ths_sep too.
				if (($last = strrpos($price, '.')) !== false) {
					$last_part = substr($price, $last);
					$last_part = preg_replace('/[^\d]/', '', $last_part);
					if (strlen($last_part) == 3 && $decimals != 3) {
						$price = str_replace($thous_sep, '', $price);
					}
				}
			}
		}

		if ($dec_sep != '.') {
			$price = str_replace($dec_sep, '.', $price);
		}
	}

	$price = preg_replace('/[^\d\.]/', '', $price);

	return round(floatval($price), $decimals);
}

/**
 * Function saves alternative text for logos
 *
 * @param mixed $areas List of manifest areas
 * @param integer $company_id Company ID for vendors, left 0 for main store.
 */
function fn_save_logo_alt($areas, $company_id = 0)
{
	if (!empty($_REQUEST['logo_alt'])) {
		foreach ($_REQUEST['logo_alt'] as $type => $alt) {
			$_data = array (
				'object_id' => $company_id,
				'description' => empty($alt) ? '' : trim($alt),
				'lang_code' => CART_LANGUAGE,
				'object_holder' => $areas[$type]['name']
			);
			db_query("REPLACE INTO ?:common_descriptions ?e", $_data);
		}
	}
}

/**
 * Function replaces default table prefix to user's prefix.
 *
 * @param string $query Query
 * @return string Updated query
 */
function fn_check_db_prefix($query, $table_prerfix = TABLE_PREFIX, $default_table_prefix = DEFAULT_TABLE_PREFIX)
{
	if ($table_prerfix != $default_table_prefix) {
		$pos = strpos($query, $default_table_prefix);
		if ($pos !== false) {
			$query = substr_replace($query, $table_prerfix, $pos, strlen($default_table_prefix));
		}
	}
	return $query;
}

/**
 * Function returns the index script for requested data.
 * 
 * @param mixed $for. If array is given, then index script will be returned for $for['user_type'].
 * If $for is empty, index script will be returned for defined ACCOUNT_TYPE
 * The following string are allowed: 'A', 'admin', 'V', 'vendor', 'C', 'customer'
 * @return string Path to index script
 */
function fn_get_index_script($for = '')
{
	if (is_array($for)) {
		$for = !empty($for['user_type']) ? $for['user_type'] : '';
	}
	
	if (empty($for) || !in_array($for, array('A', 'admin', 'V', 'vendor', 'C', 'customer'))) {
		$for = ACCOUNT_TYPE;
	} elseif ($for == 'A') {
		$for = 'admin';
	} elseif ($for == 'V') {
		$for = 'vendor';
	} elseif ($for == 'C') {
		$for = 'customer';
	}
	
	return Registry::get("config.{$for}_index");
}

/**
 * ***DEPRECATED*** Function will be deleted in version 3.0.2
 * 
 * @param mixed $user_data Array with user_info
 * @return string Account type
 */
function fn_get_account_type($user_data)
{
	if (isset($user_data['company_id']) && empty($user_data['company_id']) && !empty($user_data['user_type']) && $user_data['user_type'] == 'A') {
		return 'admin';
	} else {
		return 'vendor';
	}
}

function fn_update_status($status, $status_data, $type, $lang_code = DESCR_SL)
{
	if (empty($status_data['status'])) {
		// Generate new status code
		$existing_codes = db_get_fields('SELECT status FROM ?:statuses WHERE type = ?s GROUP BY status', $type);
		$existing_codes[] = 'N'; // STATUS_INCOMPLETED_ORDER
		$existing_codes[] = 'T'; // STATUS_PARENT_ORDER
		$codes = array_diff(range('A', 'Z'), $existing_codes);
		$status_data['status'] = reset($codes);
	}
	
	if (empty($status)) {
		$status_data['type'] = $type;
		db_query("INSERT INTO ?:statuses ?e", $status_data);
		$status = $status_data['status'];

		foreach ((array)Registry::get('languages') as $status_data['lang_code'] => $_v) {
			db_query('REPLACE INTO ?:status_descriptions ?e', $status_data);
		}
	} else {
		db_query("UPDATE ?:statuses SET ?u WHERE status = ?s AND type = ?s", $status_data, $status, $type);
		db_query('UPDATE ?:status_descriptions SET ?u WHERE status = ?s AND type = ?s AND lang_code = ?s', $status_data, $status, $type, $lang_code);
	}

	if (!empty($status_data['params'])) {
		foreach ((array)$status_data['params'] as $k => $v) {
			$_data = array(
				'status' => $status,
				'type' => $type,
				'param' => $k,
				'value' => $v
			);
			db_query("REPLACE INTO ?:status_data ?e", $_data);
		}
	}
	
	return $status_data['status'];
}

function fn_delete_status($status, $type)
{
	db_query('DELETE FROM ?:statuses WHERE status = ?s AND type = ?s', $status, $type);
	db_query('DELETE FROM ?:status_descriptions WHERE status = ?s AND type = ?s', $status, $type);
	db_query('DELETE FROM ?:status_data WHERE status = ?s AND type = ?s', $status, $type);
}

function fn_array_to_xml($data)
{
	if (!is_array($data)) {
		return $data;
	}
	
	$return = '';
	foreach ($data as $key => $value) {
		$attr = '';
		if (strpos($key, '@') !== false) {
			$data = explode('@', $key);
			$key = $data[0];
			unset($data[0]);
			
			if (count($data) > 0) {
				foreach ($data as $prop) {
					if (strpos($prop, '=') !== false) {
						$prop = explode('=', $prop);
						$attr .= ' ' . $prop[0] . '="' . $prop[1] . '"';
					} else {
						$attr .= ' ' . $prop . '=""';
					}
				}
			}
		}
		$return .= '<' . $key . $attr . '>' . fn_array_to_xml($value) . '</' . $key . '>';
	}
	
	return $return;
}

function fn_set_storage_data($key, $data)
{
	$data_id = 0;
	if (!empty($data)) {
		$data_id = db_query('REPLACE ?:storage_data (`data_key`, `data`) VALUES(?s, ?s)', $key, $data);
	} else {
		db_query('DELETE FROM ?:storage_data WHERE `data_key` = ?s', $key);
	}

	return $data_id;
}

function fn_get_storage_data($key)
{
	$data = db_get_field('SELECT `data` FROM ?:storage_data WHERE `data_key` = ?s', $key);
	
	return $data;
}

/**
 * Checks is some key is expired (value of given key should be timestamp).
 * 
 * @param string $key Key name
 * @param int $time_period Time period (in seconds), that should be added to the current timestamp for the future check.
 * @return boolean True, if saved timestamp is less than current timestamp, false otherwise.
 */
function fn_is_expired_storage_data($key, $time_period = null)
{
	$time = fn_get_storage_data($key);
	if ($time < TIME && $time_period) {
		fn_set_storage_data($key, TIME + $time_period);
	}
	
	return $time < TIME;
}

/**
 * Function print notice that function $old_function is deprecated and must be replaced by $new_function
 * @param string $old_function Name of the old function
 * @param string $new_function Name of the new function
 */
function fn_generate_deprecated_function_notice($old_function, $new_function)
{
	$message = str_replace('[old_function]', $old_function, fn_get_lang_var('function_deprecated'));
	$message = str_replace('[new_function]', $new_function, $message);

	if (defined('DEFELOPMENT')) {
		fn_set_notification('E', fn_get_lang_var('error'), $message);
	}

	fn_log_event('general', 'deprecated', array(
		'function' => $old_function,
		'message' => $message,
		'backtrace' => debug_backtrace()
	));
}

/**
 * Function clears all cache for selected company or for all companies (under the root)
 */
function fn_clear_cache()
{
	fn_rm(DIR_CACHE_TEMPLATES, false);
	fn_rm(DIR_CACHE_MISC, false);

	Registry::cleanup();
}

function fn_disable_translation_mode()
{
	Registry::set('settings.translation_mode', 'N');
	Registry::get('view')->assign('settings', Registry::get('settings'));
	Registry::get('view_mail')->assign('settings', Registry::get('settings'));
}

/**
 * Builds hierarchic tree from array width id and parent_id
 * @param array $array array of data, must be sorted ASC by  parent_id
 * @param string $object_key  name of id key in array
 * @param string $parent_key name of parent key in array
 * @param string $cildren_key name of key whee sub elements will be located in tree
 * @return array
 */
function fn_build_hierarchic_tree($array, $object_key, $parent_key = 'parent_id', $child_key = 'children')
{
	$rev_arr = array_reverse($array);
	foreach($rev_arr as $brunch) {
		if( $brunch[$parent_key] == 0) {
			continue;
		} else {
			$array[$brunch[$parent_key]][$child_key][$brunch[$object_key]] = $array[$brunch[$object_key]];
			unset($array[$brunch[$object_key]]);
		}
	}

	return $array;
}

/**
 * Converts array to string with PHP code of this array
 * @param array $object
 * @param int $indent
 * @param string $type
 * @return string
 */
function fn_array2code_string($object, $indent = 0, $type = '')
{
	$scheme = '';

	if ($type == '') {
		if(is_array($object)){
			$type = 'array';
		} else if(is_numeric($object)) {
			$type = 'integer';
		}
	}

	if ($type == 'array') {
		$scheme .= "array(";
		if (is_array($object)) {
			if (!empty($object)) {
				$scheme .= " \n";
			}
			foreach($object as $k => $v) {
				$scheme .= str_repeat("\t", $indent + 1) . "'$k' => " . fn_array2code_string($v, $indent + 1). ", \n";
			}
		}
		$scheme .= str_repeat("\t", $indent) . ")";
	} elseif($type == 'int' || $type == 'integer') {
		if ($object == '') {
			$scheme .= 0;
		} else {
			$scheme .= $object;
		}
	} else {
		$scheme = "'$object'";
	}

	return $scheme;
}

function fn_update_lang_var($lang_data, $lang_code = DESCR_SL, $params = array())
{
	$error_flag = false;

	fn_set_hook('update_lang_values', $lang_data, $lang_code, $error_flag, $params);

	foreach ($lang_data as $k => $v) {
		if (!empty($v['name'])) {
			preg_match("/(^[a-zA-z0-9][a-zA-Z0-9_]*)/", $v['name'], $matches);
			if (fn_strlen($matches[0]) == fn_strlen($v['name'])) {
				$v['lang_code'] = $lang_code;
				db_query("REPLACE INTO ?:language_values ?e", $v);
			} elseif (!$error_flag) {
				fn_set_notification('E', fn_get_lang_var('warning'), fn_get_lang_var('warning_lanvar_incorrect_name'));
				$error_flag = true;
			}
		}
	}

	return $error_flag;
}

function fn_tools_update_status($params)
{
	if (!preg_match("/^[a-z_]+$/", $params['table'])) {
		return false;
	}

	$old_status = db_get_field("SELECT status FROM ?:$params[table] WHERE ?w", array($params['id_name'] => $params['id']));

	$permission = true;
	if (defined('COMPANY_ID')) {
		$cols = db_get_fields("SHOW COLUMNS FROM ?:$params[table]");
		if (in_array('company_id', $cols)) {


			$condition = fn_get_company_condition('?:' . $params['table'] . '.company_id');
			$permission = db_get_field("SELECT company_id FROM ?:$params[table] WHERE ?w $condition", array($params['id_name'] => $params['id']));


		}
	}
	if (empty($permission)) {
		fn_set_notification('W',  fn_get_lang_var('warning'), fn_get_lang_var('access_denied'));
		Registry::get('ajax')->assign('return_status', $old_status);
		return false;
	}

	$result = db_query("UPDATE ?:$params[table] SET status = ?s WHERE ?w", $params['status'], array($params['id_name'] => $params['id']));

	fn_set_hook('tools_change_status', $params, $result);

	if ($result) {
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('status_changed'));
	} else {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_status_not_changed'));
		Registry::get('ajax')->assign('return_status', $old_status);
	}

	return true;

}

/**
 * Make a string lowercase
 *
 * @param string $string - the string being lowercased
 * @param string $charset - charset being used 
 * @return string
 */
function fn_strtolower($string, $charset = CHARSET)
{

	if (function_exists('mb_strtolower')) {
		return mb_strtolower($string, $charset);
	} else {
		return strtolower($string);
	}
}

/**
 * Removes traling slash in a path if it present
 * 
 * @param string $path 
 * @return string
 */
function fn_remove_trailing_slash($path) 
{
	return preg_replace('/\/$/', '', $path);
}

/**
 * Removes languages
 * 
 * @param array $lang_codes List of 2-letters language codes
 * @return bool Always true
 */
function fn_delete_languages($lang_codes)
{
	/**
	 * Adds additional actions before languages deleting
	 *
	 * @param array $lang_codes List of 2-letters language codes
	 */
	fn_set_hook('fn_delete_languages_pre', $lang_codes);

	$db_descr_tables = fn_get_description_tables();

	foreach ((array)$lang_codes as $v) {
		db_query("DELETE FROM ?:languages WHERE lang_code = ?s", $v);
		
		db_query("DELETE FROM ?:localization_elements WHERE element_type = 'L' AND element = ?s", $v);
		
		foreach ($db_descr_tables as $table) {
			db_query("DELETE FROM ?:$table WHERE lang_code = ?s", $v);
		}
	}

	fn_save_languages_integrity();

	/**
	 * Adds additional actions after languages deleting
	 *
	 * @param array $lang_codes List of 2-letters language codes
	 */
	fn_set_hook('fn_delete_languages_post', $lang_codes);

	return true;
}

/**
 * Checks and save languages integrity by enable
 * $default_lang language if all languages in cart disabled
 * and checks and changes appeareance settings if it are using hidden or disabled languages
 *
 * @param string $default_lang Two-letters language code, that will be set active, if there are no active languages.
 * @return bool Always true
 */

/**
 *
 * @param type $default_lang
 * @return boolean
 */
function fn_save_languages_integrity($default_lang = CART_LANGUAGE)
{
	$avail = db_get_field("SELECT COUNT(*) FROM ?:languages WHERE status = 'A'");
	if (!$avail) {
		$default_lang_exists = db_get_field("SELECT COUNT(*) FROM ?:languages WHERE lang_code = ?s", $default_lang);
		if (!$default_lang_exists) {
			$default_lang = db_get_field("SELECT lang_code FROM ?:languages WHERE status = 'H' LIMIT 1");
			if (!$default_lang) {
				$default_lang = db_get_field("SELECT lang_code FROM ?:languages LIMIT 1");
			}
		}
		db_query("UPDATE ?:languages SET status = 'A' WHERE lang_code = ?s", $default_lang);
	}

	$settings_checks = array(
		'customer' => 'A',
		'admin' => array('A', 'H')
	);

	$settings_changed = false;
	foreach ($settings_checks as $zone => $statuses) {
		$available = db_get_field("SELECT COUNT(*) FROM ?:languages WHERE lang_code = ?s AND status IN (?a)", Registry::get('settings.Appearance.' . $zone . '_default_language'), $statuses);
		if (!$available) {
			$first_avail_code = db_get_field("SELECT lang_code FROM ?:languages WHERE status IN (?a) LIMIT 1", $statuses);
			CSettings::instance()->update_value($zone . '_default_language', $first_avail_code, 'Appearance');
			$settings_changed = true;
		}
	}

	if ($settings_changed) {
		fn_set_notification('W', fn_get_lang_var('warning'), str_replace('[link]', fn_url('settings.manage?section_id=Appearance'), fn_get_lang_var('warning_default_language_disabled')));
	}

	return true;
}

/**
 * Returns list of tables that has language depended data
 * 
 * @return array Array of table names without prefix
 */
function fn_get_description_tables() 
{
	$description_tables = db_get_fields("SHOW TABLES LIKE '?:%_descriptions'");
	$description_tables[] = 'language_values';
	$description_tables[] = 'product_features_values';
	$description_tables[] = 'bm_blocks_content';

	
	foreach ($description_tables as $key => $table) {
		$description_tables[$key] = str_replace(TABLE_PREFIX, '', $table);
	}

	/**
	 * Process list of tables that has language depended data before return
	 * 
	 * @param array $description_tables Array of table names without prefix
	 */
	fn_set_hook('description_tables_post', $description_tables);

	return $description_tables;
}

/**
 * Clones language depended data from one language to other for all tables in cart
 * 
 * @param string $to_lang 2 letters destenation language code
 * @param string $from_lang 2 letters source language code
 * @return bool Always true
 */
function fn_clone_language($to_lang, $from_lang = CART_LANGUAGE)
{
	$description_tables = fn_get_description_tables();

	foreach ($description_tables as $table) {
		fn_clone_language_values($table, $to_lang, $from_lang);
	}
}

/**
 * Clones language depended data from one language to other for $table
 * 
 * @param string $table table name to clone values
 * @param string $to_lang 2 letters destenation language code
 * @param string $from_lang 2 letters source language code
 * @return bool Always true
 */
function fn_clone_language_values($table, $to_lang, $from_lang = CART_LANGUAGE)
{
	$fields_select = fn_get_table_fields($table, array(), true);
	$fields_insert = fn_get_table_fields($table, array(), true);
	$k = array_search('`lang_code`', $fields_select);
	$fields_select[$k] = db_quote("?s as lang_code", $to_lang);

	db_query(
		"INSERT IGNORE INTO ?:$table (" . implode(', ', $fields_insert) . ") "
		. "SELECT " . implode(', ', $fields_select) . " FROM ?:$table WHERE lang_code = ?s", 
		$from_lang
	);
}

/**
 * Cleans storefront URL removing scheme, trailing slash and etc.
 *
 * @param string $url URL for cleaning
 * @return string cleaned URL
 */
function fn_clean_url($url)
{
	$url = preg_replace('#^http.?://#', '', $url);
	$url = fn_remove_trailing_slash($url);

	return $url;
}

function fn_preg_replacement_quote($str)
{
	return preg_replace('/(\$|\\\\)(?=\d)/', '\\\\\1', $str);
}

/**
 * Checks if page is opened in a preview mode
 *
 * @param array $auth Array of user authentication data (e.g. uid, usergroup_ids, etc.)
 * @param array $params Request parameters
 * @return bool True if page is in a preview mode, false otherwise
 */
function fn_is_preview_action($auth, $params)
{
	$result = $auth['area'] == 'A' && !empty($params['action']) && $params['action'] == 'preview';

	return $result;
}

/**
 * Delete installed payment
 *
 * @param int $payment_id Payment id to be deleted
 * @return bool True if payment was sucessfully deleted, false otherwise
 */
function fn_delete_payment($payment_id)
{
	$result = true;
	$payment_id = (int) $payment_id;

	if (empty($payment_id) || !fn_check_company_id('payments', 'payment_id', $payment_id)) {
		return false;
	}

	fn_set_hook('delete_payment_pre', $payment_id, $result);

	db_query("DELETE FROM ?:payments WHERE payment_id = ?i", $payment_id);
	db_query("DELETE FROM ?:payment_descriptions WHERE payment_id = ?i", $payment_id);

	fn_delete_image_pairs($payment_id, 'payment');

	fn_set_hook('delete_payment_post', $payment_id, $result);

	return $result;
}

function fn_floor_to_step($value, $step)
{
	$floor = false;

	if (empty($step) && !empty($value)) {
		$floor = $value;

	} elseif (!empty($value) && !empty($step)) {
		if ($value % $step) {
			$floor = floor($value / $step) * $step;
		} else {
			$floor = $value;
		}
	}
	return $floor;
}

function fn_ceil_to_step($value, $step)
{
	$floor = false;
	if (empty($step) && !empty($value)) {
		$floor = $value;

	} elseif (!empty($value) && !empty($step)) {
		if ($value % $step) {
			$floor = ceil($value / $step) * $step;
		} else {
			$floor = $value;
		}
	}
	return $floor;
}

?>