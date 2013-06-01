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

function fn_twigmo_before_dispatch()
{
	if (!fn_twigmo_is_updated() or $_SERVER['REQUEST_METHOD'] == 'POST') {
		return;
	}

	// custom css
	$path_to_css = implode('/', array_diff(explode('/', Registry::get('config.skin_path')), explode('/', Registry::get('config.current_path')))); // skin path minus leading current path
	$skin_real_path = DIR_ROOT.'/'.$path_to_css;
	$selected_skin = !empty($_REQUEST['selected_skin']) ? $_REQUEST['selected_skin'] : 'default' ;
	$custom_css_file_path = $skin_real_path.'/addons/twigmo/custom_'.($selected_skin == 'default' ? 'basic' : $selected_skin).'.css';
	if (!file_exists($custom_css_file_path)) {
		if (!@touch($custom_css_file_path) && !empty($_REQUEST['selected_skin'])){
			header('FILE-NOT-CREATED: ' . $custom_css_file_path);
		}
	}
	Registry::get('view')->assign('custom_css_file_path', $custom_css_file_path);
	// /custom css

	// ua device type
	$device = !empty($_SESSION['device']) ? $_SESSION['device'] : '';
	$ua = !empty($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
	if (!empty($ua)) {
		if( stristr($ua, 'ipad')) {
						$device = 'ipad';
		} elseif (stristr($ua, 'iphone') || strstr($ua,'iphone')) {
						$device = 'iphone';
		} elseif (stristr($ua, 'blackberry')) {
						$device = 'blackberry';
		} elseif (stristr($ua, 'android')) {
						$device = 'android';
		} elseif (stristr($ua, 'windows phone os 7')) {
			$device = 'winphone';
		}
	}
	$_SESSION['device'] = $device;
	// /ua device type

	$exclude_dispatch = array ('image.captcha');
	$agent_types = array ('unknown', 'phone', 'tablet');
	$tw_settings = Registry::get('addons.twigmo');

	$current_agent = empty($_SERVER['HTTP_USER_AGENT']) ? '' : $_SERVER['HTTP_USER_AGENT'];
	$use_mobile_template = true;

	if (!empty($_REQUEST['use_mobile_frontend'])) {
		$_SESSION['use_mobile_frontend'] = $_REQUEST['use_mobile_frontend'];
	}

	if (AREA != 'C' || empty($_SERVER['HTTP_USER_AGENT']) || (!$access_id = Registry::get('addons.twigmo.access_id')) || defined('AJAX_REQUEST') || in_array($_REQUEST['dispatch'], $exclude_dispatch)) {
		return;
	}

	$mobile_ua = 'Mozilla/5.0 (iPhone; CPU iPhone OS 5_0 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9A334 Safari/7534.48.3';
	$force_frontend_views = array('mobile', 'desktop', 'auto');
	$force_frontend_view = '';
	foreach ($force_frontend_views as $type) {
		if (isset($_REQUEST[$type]) and $_REQUEST[$type] == '') {
			$force_frontend_view = $type;
			break;
		}
	}
	if ($force_frontend_view) {
		if ($force_frontend_view == 'mobile'){
			$_SESSION['use_mobile_frontend'] = 'Y';
			$current_agent = $mobile_ua;
		} elseif ($force_frontend_view == 'desktop'){
			$_SESSION['use_mobile_frontend'] = 'N';
			$use_mobile_template = false;
		} elseif ($force_frontend_view == 'auto'){
			$_SESSION['use_mobile_frontend'] = '';
		}
		$_SESSION['cache_mobile_frontend'] = '';
	}

	if ((!empty($_SESSION['use_mobile_frontend']) && $_SESSION['use_mobile_frontend'] == 'N') || (!empty($tw_settings['use_mobile_frontend']) && $tw_settings['use_mobile_frontend'] == 'never')) {
		Registry::get('view')->assign('mobile_user_agent', true);
		Registry::get('view')->assign('tw_settings', $tw_settings);
		return;
	}

	if ($use_mobile_template && !empty($_SESSION['cache_mobile_frontend'])) {
		$use_mobile_template = ($_SESSION['cache_mobile_frontend'] == 'Y');
	}

	if ($use_mobile_template && empty($_SESSION['cache_mobile_frontend'])) {
		if (($force_frontend_view != 'mobile' && empty($_SESSION['use_mobile_frontend'])) || $force_frontend_view == 'auto'){
            if (empty($_SESSION['twg_user_agent']) || (!isset($_SESSION['twg_ua']) || $_SESSION['twg_ua'] != $_SERVER['HTTP_USER_AGENT'])) {
								$__user_agent = fn_http_request('GET', 'http://twigmo.com/svc2/check_ua.php?ua=' . urlencode($current_agent) . '&access_id=' . Registry::get('addons.twigmo.access_id'));
								$_user_agent = $__user_agent[1];
								$user_agent = in_array($_user_agent, $agent_types) ? $_user_agent : 'unknown';
                $_SESSION['twg_user_agent'] = $user_agent;
                $_SESSION['twg_ua'] = $_SERVER['HTTP_USER_AGENT'];
            } else {
                $user_agent = $_SESSION['twg_user_agent'];
            }
			$use_mobile_template = ($user_agent != 'unknown' && ($user_agent == $tw_settings['use_mobile_frontend'] || (($user_agent == 'phone' || $user_agent == 'tablet' ) && $tw_settings['use_mobile_frontend'] == 'both_tablet_and_phone'))) ? true : false;
		}
		$_SESSION['cache_mobile_frontend'] = ($use_mobile_template == true ? 'Y' : 'N');
	} elseif (!$use_mobile_template) {
		$_SESSION['cache_mobile_frontend'] = 'N';
	}


	if ($use_mobile_template) {
		if (fn_twigmo_use_https_for_customer() && !defined('HTTPS')) {
			fn_redirect(Registry::get('config.https_location') . '/' . Registry::get('config.current_url'));
		}
		Registry::set('root_template', 'addons/twigmo/mobile_index.tpl');
		list($scripts_url, $mobile_skin_path) = fn_twigmo_get_mobile_scripts_url($tw_settings['selected_skin']);
		$view = Registry::get('view');
		$view->assign('tw_settings', $tw_settings);
		$view->assign('currency', CART_PRIMARY_CURRENCY);
		$view->assign('currency_settings', Registry::get('currencies.' . CART_PRIMARY_CURRENCY));
		$view->assign('mobile_scripts_url', $scripts_url);
		$view->assign('mobile_skin_path', $mobile_skin_path);
		$view->assign('favicon_url', fn_twigmo_get_favicon_url());
	} else {
		return;
	}
}


function fn_twigmo_dispatch_before_display()
{
	if (Registry::get('root_template') == 'addons/twigmo/mobile_index.tpl') {
		Registry::get('view')->assign('twg_settings', fn_twigmo_get_all_settings());
	}
}


function fn_twigmo_get_mobile_scripts_url($selected_skin = 'default', $url = '')
{
	$scripts_url = Registry::get('addons.twigmo.storefront_scripts_url') . Registry::get('addons.twigmo.access_id');

	return empty($url)
					? array($scripts_url, $scripts_url.'/skins/'.$selected_skin)
					: array($url, $url.'/skins/'.$selected_skin);
}

// Check if twigmo front end should uses https
function fn_twigmo_use_https_for_customer()
{
	if (Registry::get('settings.General.keep_https') != 'Y') {
		return false;
	}

	if (TWIGMO_USE_HTTPS == 'Y') {
		return true;
	}
	if (TWIGMO_USE_HTTPS == 'N') {
		return false;
	}
	// Auto
	return Registry::get('settings.General.secure_auth') == 'Y' || Registry::get('settings.General.secure_checkout') == 'Y';
}


// Check if twigmo addon was reinstalled after uploading new files
function fn_twigmo_is_updated()
{
	$settings = Registry::get('addons.twigmo');
	return $settings['settings'] == 'settings.tpl' and (empty($settings['version']) or $settings['version'] == TWIGMO_VERSION);
}


function fn_twigmo_get_admin_lang_vars($lang_code = CART_LANGUAGE)
{
	return fn_get_lang_vars_by_prefix('twgadmin', $lang_code);
}


function fn_twigmo_get_all_lang_vars($lang_code = CART_LANGUAGE)
{
	return fn_get_lang_vars_by_prefix('twg', $lang_code);
}


function fn_twigmo_get_customer_lang_vars($lang_code = CART_LANGUAGE)
{
	return array_diff(fn_twigmo_get_all_lang_vars($lang_code), fn_twigmo_get_admin_lang_vars($lang_code));
}


function fn_twigmo_place_order($order_id, $action = '', $__order_status = '', $cart = null)
{
	if (!$access_id = Registry::get('addons.twigmo.access_id')) {
		return;
	}

	if ($action == 'save') {
		return;
	}

	$fields = array(
		'order_id',
		'total',
		'products'
	);

	$order_info = fn_get_order_info($order_id);

	if (!empty($order_info['items'])) {
		$order_info['products'] = array();

		foreach ($order_info['items'] as $product) {
			$order_info['products'][] = $product;
		}
		unset($order_info['items']);
	}

	$api_data = fn_get_as_api_list('orders', array($order_info));

	return fn_post_request($api_data, 'orders', 'add');
}


/**
 * Create new file and put serialized data here
 * @param string $file
 * @param array $data
 * @param boolean $serialize
 */
function fn_twigmo_write_to_file($file, $data, $serialize = true)
{
	$dir = dirname($file);
	if (!file_exists($dir)) {
		fn_mkdir($dir);
	}
	$file = fopen($file, 'w');
	fwrite($file, $serialize ? serialize($data) : $data);
	fclose($file);
}


function fn_twigmo_save_version_info($version_info)
{
	fn_twigmo_write_to_file(TWIGMO_UPGRADE_DIR . TWIGMO_UPGRADE_VERSION_FILE, $version_info);
}


function fn_twigmo_check_for_upgrade()
{
	if ($_SESSION['auth']['area'] == 'A' && !empty($_SESSION['auth']['user_id']) && fn_check_user_access($_SESSION['auth']['user_id'], 'upgrade_store')) {
		list(, $version_info_json) = fn_http_request('GET', TWG_CHECK_UPDATES_SCRIPT . '?store_version=' . PRODUCT_VERSION . '&twigmo_version=' . TWIGMO_VERSION);
		$version_info = fn_from_json($version_info_json, true);
		if ($version_info['next_version'] and $version_info['next_version'] != TWIGMO_VERSION) {
			$msg = str_replace('[link]', fn_url('addons.update&addon=twigmo&selected_section=twigmo_addon'), fn_get_lang_var('twgadmin_text_updates_available'));
			fn_set_notification('W', fn_get_lang_var('notice'), $msg, 'S', 'twigmo_upgrade');
			// Save version info to file
			fn_twigmo_save_version_info($version_info);
		}
	}
}


function fn_twigmo_get_shipments($params, $fields_list, $joins, &$condition, $group)
{
	if (!empty($params['shipping_id'])) {
		$condition .= db_quote(' AND ?:shipments.shipping_id = ?i', $params['shipping_id']);
	}

	if (!empty($params['carrier'])) {
		$condition .= db_quote(' AND ?:shipments.carrier = ?s', $params['carrier']);
	}

	if (!empty($params['email'])) {
		$condition .= db_quote(' AND ?:orders.email LIKE ?l', '%'.trim($params['email']).'%');
	}

	return true;
}

function fn_twigmo_get_users($params, $fields, $sortings, $condition, $join)
{
	// Search string condition for SQL query
	if (isset($params['q']) && fn_string_not_empty($params['q'])) {

		$params['q'] = trim($params['q']);
		if (empty($params['match'])) {
			$params['match'] = '';
		}

		if ($params['match'] == 'any') {
			$pieces = fn_explode(' ', $params['q']);
			$search_type = ' OR ';
		} elseif ($params['match'] == 'all') {
			$pieces = fn_explode(' ', $params['q']);
			$search_type = ' AND ';
		} else {
			$pieces = array($params['q']);
			$search_type = '';
		}

		$_condition = array();
		foreach ($pieces as $piece) {
			if (strlen($piece) == 0) {
				continue;
			}

			$tmp = db_quote("?:users.email LIKE ?l", "%$piece%");
			$tmp .= db_quote(" OR ?:users.user_login LIKE ?l", "%$piece%");
			$tmp .= db_quote(" OR (?:users.firstname LIKE ?l OR ?:users.lastname LIKE ?l)", "%$piece%", "%$piece%");

			$_condition[] = '(' . $tmp . ')';
		}

		$_cond = implode($search_type, $_condition);

		if (!empty($_condition)) {
			$condition .= ' AND (' . $_cond . ') ';
		}
	}
}

function fn_twigmo_additional_fields_in_search($params, $fields, $sortings, $condition, &$join, $sorting, $group_by, &$tmp, $piece)
{
	if (!empty($params['ppcode']) && $params['ppcode'] == 'Y') {
		$tmp .= db_quote(" OR (twg_pcinventory.product_code LIKE ?l OR products.product_code LIKE ?l)", "%$piece%", "%$piece%");
	}
}

function fn_twigmo_get_products($params, $fields, $sortings, $condition, &$join, $sorting, $group_by, $lang_code)
{
	if (isset($params['q']) && fn_string_not_empty($params['q']) && !empty($params['ppcode']) && $params['ppcode'] == 'Y') {
		$join .= " LEFT JOIN ?:product_options_inventory as twg_pcinventory ON twg_pcinventory.product_id = products.product_id";
	}
}

function fn_post_request($api_data, $object_type, $action)
{
	$twigmo = fn_init_twigmo();

	if ($object_type != 'orders') {
		return true;
	}

	$result = $twigmo->postData($api_data, $object_type, $action, array('dispatch' => 'api.post'));

	if ($result) {
		return true;
	}

	if (empty($twigmo->response_data['error'])) {
		if (AREA == 'A') {
			fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('twg_post_request_fail'), true);
		}
		return false;
	}

	$errors = array();
	foreach ($twigmo->getObjects($twigmo->response_data['error']) as $error) {
		$errors[] = $error['message'];
	}

	if (AREA == 'A') {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('twg_post_request_fail') . ' "' . implode('", "', $errors) . '"', true);
	}

	return false;
}

function fn_get_user_search_params()
{
	$twigmo_params = array (
		'page',
		'company',
		'user_name',
		'user_login',
		'tax_exempt',
		'status',
		'email',
		'address',
		'zipcode',
		'country',
		'state',
		'city',
		'user_type',
		'user_id',
		'exclude_user_types',
		'sort_order',
		'sort_by'
	);

	$result = array();
	foreach ($twigmo_params as $param) {
		if (!empty($_REQUEST[$param])) {
			$result[$param] = $_REQUEST[$param];
		}
	}

	return $result;
}

function fn_init_twigmo()
{
	$twigmo = new Twigmo(TWIGMO_SERVICE_URL, Registry::get('addons.twigmo.access_id'), Registry::get('addons.twigmo.secret_access_key'), Registry::get('addons.twigmo.service_username'), Registry::get('addons.twigmo.service_password'));

	return $twigmo;
}

function fn_allow_request()
{
	switch ($_REQUEST['action']) {
		case 'login':
			$allow = true;
			break;
		case 'logout':
			$allow = true;
			break;
		case 'update':
			$allow = ($_REQUEST['object'] == 'cart');
			break;
		case 'get':
			$allow = (($_REQUEST['object'] == 'shipping_methods') || ($_REQUEST['object'] == 'payment_methods'));
			break;
		case 'details':
			$allow = (($_REQUEST['object'] == 'orders') || ($_REQUEST['object'] == 'users'));
			break;
		case 'place_order':
			$allow = true;
			break;
		case 'edit_css':
			$allow = true;
			break;
		default:
			$allow = false;
	}
	return $allow;
}

function fn_validate_auth()
{
	return (Twigmo::validateAuth(Registry::get('addons.twigmo.secret_access_key')) || fn_allow_request());
}

// section functions
function fn_get_order_conditions($params)
{
	$condition = $join = $group = '';

	if (!empty($params['cname'])) {
		$arr = explode(' ', $params['cname']);
		if (sizeof($arr) == 2) {
			$condition .= db_quote(" AND ?:orders.firstname LIKE ?l AND ?:orders.lastname LIKE ?l", "%$arr[0]%", "%$arr[1]%");
		} else {
			$condition .= db_quote(" AND (?:orders.firstname LIKE ?l OR ?:orders.lastname LIKE ?l)", "%$params[cname]%", "%$params[cname]%");
		}
	}

	if (!empty($params['tax_exempt'])) {
		$condition .= db_quote(" AND ?:orders.tax_exempt = ?s", $params['tax_exempt']);
	}

	if (!empty($params['email'])) {
		$condition .= db_quote(" AND ?:orders.email LIKE ?l", "%$params[email]%");
	}

	if (!empty($params['user_id'])){
		$condition .= db_quote(' AND ?:orders.user_id IN (?n)', $params['user_id']);
	}

	if (!empty($params['total_from'])) {
		$condition .= db_quote(" AND ?:orders.total >= ?d", fn_convert_price($params['total_from']));
	}

	if (!empty($params['total_to'])) {
		$condition .= db_quote(" AND ?:orders.total <= ?d", fn_convert_price($params['total_to']));
	}

	if (!empty($params['status'])) {
		$condition .= db_quote(' AND ?:orders.status IN (?a)', $params['status']);
	}

	if (!empty($params['order_id'])) {
		$condition .= db_quote(' AND ?:orders.order_id IN (?n)', (!is_array($params['order_id']) && (strpos($params['order_id'], ',') !== false) ? explode(',', $params['order_id']) : $params['order_id']));
	}

	if (!empty($params['p_ids']) || !empty($params['product_view_id'])) {
		$arr = (strpos($params['p_ids'], ',') !== false || !is_array($params['p_ids'])) ? explode(',', $params['p_ids']) : $params['p_ids'];

		if (empty($params['product_view_id'])) {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?n)", $arr);
		} else {
			$condition .= db_quote(" AND ?:order_details.product_id IN (?n)", db_get_fields(fn_get_products(array('view_id' => $params['product_view_id'], 'get_query' => true))));
		}

		$join .= " LEFT JOIN ?:order_details ON ?:order_details.order_id = ?:orders.order_id";
	}

	if (!empty($params['admin_user_id'])) {
		$condition .= db_quote(" AND ?:new_orders.user_id = ?i", $params['admin_user_id']);
		$join .= " LEFT JOIN ?:new_orders ON ?:new_orders.order_id = ?:orders.order_id";
	}

	if (!empty($params['shippings'])) {
		$set_conditions = array();
		foreach ($params['shippings'] as $v) {
			$set_conditions[] = db_quote("FIND_IN_SET(?s, ?:orders.shipping_ids)", $v);
		}
		$condition .= " AND (" . implode(' OR ', $set_conditions) . ")";
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);

		$condition .= db_quote(" AND (?:orders.timestamp >= ?i AND ?:orders.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	if (!empty($params['custom_files']) && $params['custom_files'] == 'Y') {
		$condition .= db_quote(" AND ?:order_details.extra LIKE ?l", "%custom_files%");

		if (empty($params['p_ids']) && empty($params['product_view_id'])) {
			$join .= " LEFT JOIN ?:order_details ON ?:order_details.order_id = ?:orders.order_id";
		}
	}

	fn_set_hook('get_orders', $params, $fields, $sortings, $condition, $join);

	return array($condition, $join);
}

function fn_get_order_sections($orders, $params)
{
	// the order periods
	// name points to start period time

	$params['get_conditions'] = 'Y';

	list($condition, $join) = fn_get_order_conditions($params);


	$today = getdate(TIME);
	$wday = empty($today['wday']) ? "6" : (($today['wday'] == 1) ? "0" : $today['wday'] - 1);
	$wstart = getdate(strtotime("-$wday day"));

	$date_periods = array(
		'today' => mktime(0, 0, 0, $today['mon'], $today['mday'], $today['year']),
		'week' => mktime(0, 0, 0, $wstart['mon'], $wstart['mday'], $wstart['year']),
		'month' => mktime(0, 0, 0, $today['mon'], 1, $today['year']),
		'year' => mktime(0, 0, 0, 1, 1, $today['year'])
	);

	$total_periods = array(10000, 1000, 100, 10);
	$order_totals = array();

	$sort_order = $params['sort_order'] == 'asc' ? 'asc' : 'desc';
	$sort_by = $params['sort_by'];
	list($order_sections, $section_names, $order_totals, $show_empty_sections) =
		fn_get_order_sections_info($date_periods, $total_periods, $orders, $sort_by, $sort_order);

	// remove empty sections from the begin and the end of the page

	$pagination = Registry::get('view')->get_template_vars('pagination');

	$first_section = false;
	$last_section = false;
	$recalculate_sections = array();

	if ($pagination['current_page'] == 1) {
		$first_section = true;
	}

	$total_items = 0;
	$first_calculated = false;
	$last_calculated = false;

	foreach($section_names as $section_id => $section) {
		if (!$show_empty_sections) {
			if (!isset($order_sections[$section_id]) || empty($order_sections[$section_id])) {
				unset($section_names[$section_id]);
			}
			continue;
		}
		if ($pagination['total_pages'] == 1) {
			continue;
		}
		if (isset($order_sections[$section_id]) && !empty($order_sections[$section_id])) {
			$total_items += count($order_sections[$section_id]);
			if (($total_items == $pagination['items_per_page']) &&
				($pagination['current_page'] != $pagination['total_pages'])) {

				$last_section = true;
				$section_condition = fn_get_order_section_condition($section_id, $params['sort_by'], $date_periods, $total_periods);

				$new_totals = db_get_field("SELECT sum(total) FROM ?:orders $join WHERE 1 $condition $section_condition");

				if ($new_totals != $order_totals[$section_id]) {
					$order_totals[$section_id] = $new_totals;
					$last_calculated = true;

				}

			}
			if (!$first_calculated) {
				$first_calculated = true;
				if ($pagination['current_page'] > 1) {
					$section_condition = fn_get_order_section_condition($section_id, $params['sort_by'], $date_periods, $total_periods);

					$order_totals[$section_id] = db_get_field("SELECT sum(total) FROM ?:orders $join WHERE 1 $condition $section_condition");
				}
			}
			$first_section = true;
		} else if ($last_section || !$first_section) {
			if (!$first_section) {
				unset($section_names[$section_id]);
			}
			if ($last_section) {
				if ($last_calculated) {
					unset($section_names[$section_id]);
				} else {
					$section_condition = fn_get_order_section_condition($section_id, $params['sort_by'], $date_periods, $total_periods);

					$section_total = db_get_field("SELECT sum(total) FROM ?:orders $join WHERE 1 $condition $section_condition");

					if ($section_total > 0) {
						unset($section_names[$section_id]);
						$last_calculated = true;
					}
				}
			}
		}
	}

	$sections = array();

	foreach ($section_names as $section_id => $section_name) {
		$sections[] = array (
			'name' => $section_name,
			'total' => !empty($order_totals[$section_id]) ? $order_totals[$section_id] : 0,
			'orders' => !empty($order_sections[$section_id]) ? $order_sections[$section_id] : array()
		);

	}

	return $sections;
}

function fn_get_order_sections_info($date_periods, $total_periods, $orders, $sort_by, $sort_order)
{
	$order_sections = array();
	$section_names = array();
	$order_totals = array();

	$show_empty_sections = false;
	if ($sort_by == 'date') {
		$last_date = min($date_periods);

		foreach(array_keys($date_periods) as $period_id) {
			$section_names[$period_id] = fn_get_order_period_name($period_id);
		}

		foreach ($orders as $order) {
			$selected_period_id = '';
			if ($order['timestamp'] > TIME) {
				$selected_period_id = 'future';
			} elseif ($order['timestamp'] < $last_date) {
				$selected_period_id = 'past';

			} else {
				foreach	($date_periods as $period_id => $start_date) {
					if ($order['timestamp'] > $start_date) {
						$selected_period_id = $period_id;
						break;
					}
				}
			}
			if ($selected_period_id != '') {
				$order_sections[$selected_period_id][] = $order;
				$order_totals[$selected_period_id] = isset($order_totals[$selected_period_id])?
					$order_totals[$selected_period_id] + $order['total'] : $order['total'];
			}
		}

		if (isset($order_sections['future'])) {
			$section_names = array(
				'future' => fn_get_order_period_name('future')
			) + $section_names;
		}
		if (isset($order_sections['past'])) {
			$section_names['past'] = fn_get_order_period_name('more_than_year');
		}

		if ($sort_order == 'asc') {
			$section_names = array_reverse($section_names, true);
		}

		$show_empty_sections = true;

	} elseif ($sort_by == 'status') {
		$section_names = fn_get_statuses(STATUSES_ORDER, true);

		ksort($section_names);
		if ($sort_order == 'desc') {
			$section_names = array_reverse($section_names);
		}

		foreach ($orders as $order) {
			$selected_period_id = $order['status'];
			$order_sections[$selected_period_id][] = $order;
			$order_totals[$selected_period_id] = isset($order_totals[$selected_period_id])?
				$order_totals[$selected_period_id] + $order['total'] : $order['total'];
		}

		$show_empty_sections = true;

	} elseif ($sort_by == 'total') {
		$min_total = min($total_periods);

		$section_names = array();
		foreach($total_periods as $subtotal) {
			$section_names['more_' . $subtotal] = fn_get_lang_var('more_than') . ' ' . fn_format_price($subtotal);
		}
		$section_names['less'] = fn_get_lang_var('less_than') . ' ' . fn_format_price($min_total);

		reset($total_periods);

		foreach ($orders as $order) {
			if ($order['total'] < $min_total) {
				$selected_period_id = 'less';
			} else {
				foreach	($total_periods as $subtotal) {
					if ($order['total'] > $subtotal) {
						$selected_period_id = 'more_' . $subtotal;
						break;
					}
				}
			}
			if ($selected_period_id) {
				$order_sections[$selected_period_id][] = $order;
				$order_totals[$selected_period_id] = isset($order_totals[$selected_period_id])?
					$order_totals[$selected_period_id] + $order['total'] : $order['total'];
			}
		}

		if ($sort_order == 'asc') {
			$section_names = array_reverse($section_names);
		}
	}

	return array($order_sections, $section_names, $order_totals, $show_empty_sections);
}

function fn_get_order_period_name($period_id)
{
	return fn_get_lang_var($period_id);
}

function fn_get_order_section_condition($section_id, $sort_by, $date_periods, $total_periods)
{
	$section_condition = ' AND ';

	if ($sort_by == 'date') {

		if ($section_id == 'future') {
			$max_date = max($date_periods);
			$section_condition .= db_quote("?:orders.timestamp > ?i", TIME);

		} elseif ($section_id == 'past') {
			$min_date = min($date_periods);
			$section_condition .= db_quote("?:orders.timestamp <= ?i", $min_date);

		} else {
			$end_date = TIME;
			foreach	($date_periods as $period_id => $start_date) {
				if ($section_id == $period_id) {
					$section_condition .= db_quote("?:orders.timestamp > ?i AND ?:orders.timestamp <= ?i", $start_date, $end_date);
					break;
				}
				$end_date = $start_date;
			}
		}

	} elseif ($sort_by == 'status') {
		$section_condition .= db_quote("?:orders.status = ?s", $section_id);

	} elseif ($sort_by == 'total') {

		if ($section_id == 'less') {
			$min_total = min($total_periods);
			$section_condition .= db_quote("?:orders.total <= ?i", $min_total);

		} else {

			$prev_total = 0;
			foreach($total_periods as $subtotal) {
				if ($section_id == 'more_' . $subtotal) {
					$section_condition .= db_quote("?:orders.total >= ?i", $subtotal);
					if ($prev_total) {
						$section_condition .= db_quote(" AND ?:orders.total < ?i", $prev_tort);
					}
					break;
				}
				$prev_total = $subtotal;
			}
		}
	}

	return $section_condition;
}

function fn_twigmo_api_update_product($product_data, $product_id = 0, $lang_code = CART_LANGUAGE)
{
	$_data = $product_data;

	if (!empty($product_data['timestamp'])) {
		$_data['timestamp'] = fn_parse_date($product_data['timestamp']); // Minimal data for product record
	}

	if (!empty($product_data['avail_since'])) {
		$_data['avail_since'] = fn_parse_date($product_data['avail_since']);
	}

	if (Registry::get('settings.General.allow_negative_amount') == 'N' && isset($_data['amount'])) {
		$_data['amount'] = abs($_data['amount']);
	}

	// add new product
	if (empty($product_id)) {
		$create = true;
		// product title can't be empty
		if(empty($product_data['product'])) {
			return false;
		}

		$product_id = db_query("INSERT INTO ?:products ?e", $_data);

		if (empty($product_id)) {
			return false;
		}

		//
		// Adding same product descriptions for all cart languages
		//
		$_data = $product_data;
		$_data['product_id'] =	$product_id;
		$_data['product'] = trim($_data['product'], " -");

		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $_v) {
			db_query("INSERT INTO ?:product_descriptions ?e", $_data);
		}

	// update product
	} else {
		if (isset($product_data['product']) && empty($product_data['product'])) {
			unset($product_data['product']);
		}

		db_query("UPDATE ?:products SET ?u WHERE product_id = ?i", $_data, $product_id);

		$_data = $product_data;
		if (!empty($_data['product'])){
			$_data['product'] = trim($_data['product'], " -");
		}
		db_query("UPDATE ?:product_descriptions SET ?u WHERE product_id = ?i AND lang_code = ?s", $_data, $product_id, $lang_code);
	}

	// Log product add/update
	fn_log_event('products', !empty($create) ? 'create' : 'update', array(
		'product_id' => $product_id
	));

	// Update product prices
	if (isset($product_data['price'])) {
		if (!isset($product_data['prices'])) {
			$product_data['prices'] = array();
			$skip_price_delete = true;
		}
		$_price = array (
			'price' => abs($product_data['price']),
			'lower_limit' => 1,
		);

		array_unshift($product_data['prices'], $_price);
	}

	if (!empty($product_data['prices'])) {
		if (empty($skip_price_delete)) {
			db_query("DELETE FROM ?:product_prices WHERE product_id = ?i", $product_id);
		}

		foreach ($product_data['prices'] as $v) {
			if (!empty($v['lower_limit'])) {
				$v['product_id'] = $product_id;
				db_query("REPLACE INTO ?:product_prices ?e", $v);
			}
		}
	}

	// Update main icon
	if (!empty($product_data['icon'])) {
		fn_update_icons_by_api_data($product_data['icon'], $product_id);
	}

	// Update additional images
	if (!empty($product_data['images'])) {
		fn_update_images_by_api_data($product_data['images'], $product_id);
	}


	return $product_id;
}

/*
 * Extract image from api data
 */
function fn_get_image_by_api_data($api_image)
{
	if (empty($api_image['data']) || (empty($api_image['file_name']) && empty($api_image['type']))) {
		return false;
	}


	if (empty($api_image['file_name'])) {
		$api_image['file_name'] = 'image_' . strtolower(fn_generate_code('', 4)) . '.' . $api_image['type'];
	}

	$_data = base64_decode($api_image['data']);

	$image = array (
		'name' => $api_image['file_name'],
		'path' => fn_create_temp_file(),
		'size' => strlen($_data)
	);

	$fd = fopen($image['path'], 'wb');

	if (!$fd) {
		return false;
	}

	fwrite($fd, $_data, $image['size']);
	fclose($fd);
	@chmod($image['path'], DEFAULT_FILE_PERMISSIONS);

	return $image;
}

/*
 * Update additional images
 */
function fn_update_images_by_api_data($images, $object_id = 0, $object_type = 'product', $lang_code = CART_LANGUAGE)
{
	$icons = array();
	$detailed = array();
	$pair_data = array();

	foreach ($images as $image) {
		$p_data = array (
			'pair_id' => 0,
			'type' => 'A',
			'image_alt' => '',
			'detailed_alt' => !empty($image['alt']) ? $image['alt'] : '',
		);


		if (!empty($image['image_id'])) {
			$image_info = db_get_row("SELECT type, pair_id FROM ?:images_links WHERE object_id = ?i AND object_type=?s AND detailed_id = ?i", $object_id, $object_type, $image['image_id']);

			if (empty($image_info) || $image_info['type'] == 'M') {
				// ignore errors in image_id
				// deny update/delete main detailed image
				continue;
			}

			if (!empty($image['deleted']) && $image['deleted'] == 'Y') {
				fn_delete_image($image['image_id'], $image_info['pair_id'], 'detailed');
				continue;
			}

			$p_data['pair_id'] = $image_info['pair_id'];
			$p_data['image_alt'] = db_get_field("SELECT a.description FROM ?:common_descriptions as a, ?:images_links as b WHERE a.object_holder = ?s AND a.lang_code = ?s AND a.object_id = b.image_id AND b.pair_id = ?i", 'images', $lang_code, $image_info['pair_id']);
		}

		$detailed_image = fn_get_image_by_api_data($image);
		if (empty($image['image_id']) && empty($detailed_image)) {
			continue;
		}
		$detailed[] = $detailed_image;
		$pair_data[] = $p_data;
	}

	return fn_update_image_pairs($icons, $detailed, $pair_data, $object_id, $object_type, array(), '', 0, true, $lang_code);
}

function fn_update_icons_by_api_data($image, $object_id = 0, $object_type = 'product', $lang_code = CART_LANGUAGE)
{
	if (!empty($image['deleted']) && $image['deleted'] == 'Y') {
		// delete image
		$image_info = db_get_row("SELECT image_id, pair_id FROM ?:images_links WHERE object_id = ?i AND object_type=?s AND type = 'M'", $object_id, $object_type);

		if (!empty($image_info)) {
			fn_delete_image($image_info['image_id'], $image_info['pair_id'], $object_type);
		}

		return true;
	}

	$icon_list = array();

	if ($icon = fn_get_image_by_api_data($image)) {
		$icon_list[] = $icon;
	}

	$detailed_alt = db_get_field("SELECT a.description FROM ?:common_descriptions as a, ?:images_links as b WHERE a.object_holder = ?s AND a.lang_code = ?s AND a.object_id = b.detailed_id AND b.object_id = ?i AND b.object_type = ?s AND b.type = ?s", 'images', $lang_code, $object_id, $object_type, 'M');

	$icon_data = array (
		'type' => 'M',
		'image_alt' => !empty($image['alt']) ? $image['alt'] : '',
		'detailed_alt' => $detailed_alt
	);

	return fn_update_image_pairs($icon_list, array(), array($icon_data), $object_id, $object_type, array(), '', 0, true, $lang_code);
}

function fn_get_carriers()
{
	return array (
		'USP'=> fn_get_lang_var('usps'),
		'UPS'=> fn_get_lang_var('ups'),
		'FDX'=> fn_get_lang_var('fedex'),
		'AUP'=> fn_get_lang_var('australia_post'),
		'DHL'=> fn_get_lang_var('dhl'),
		'CHP'=> fn_get_lang_var('chp')
	);
}

function fn_get_orders_as_api_list($orders, $lang_code)
{
	$order_ids = array();
	foreach ($orders as $order) {
		$order_ids[] = $order['order_id'];
	}

	$payment_names = db_get_hash_array("SELECT order_id, payment FROM ?:orders, ?:payment_descriptions WHERE ?:payment_descriptions.payment_id = ?:orders.payment_id AND ?:payment_descriptions.lang_code = ?s AND ?:orders.order_id IN (?a)", 'order_id', $lang_code, $order_ids);

	$shippings  = db_get_hash_array("SELECT order_id, data FROM ?:order_data WHERE type = ?s AND order_id IN (?a)", 'order_id', 'L', $order_ids);

	foreach ($orders as $k => $v) {
		$orders[$k]['payment'] = !empty($payment_names[$v['order_id']]) ? $payment_names[$v['order_id']]['payment'] : '';
		$orders[$k]['shippings'] = array();
		if (!empty($shippings[$v['order_id']])) {
			$shippings = @unserialize($shippings[$v['order_id']]['data']);

			if (empty($shippings)) {
				continue;
			}

			foreach ($shippings as $shipping) {
				$orders[$k]['shippings'][] = array (
					'carrier' => !empty($shipping['carrier']) ? $shipping['carrier'] : '',
					'shipping' => !empty($shipping['shipping']) ? $shipping['shipping'] : '',
				);
			}
		}
	}

	$fields = array (
		'order_id',
		'user_id',
		'total',
		'timestamp',
		'status',
		'firstname',
		'lastname',
		'email',
		'payment_name',
		'shippings'
	);

	return fn_get_as_api_list('orders', $orders, $fields);
}

function fn_get_api_image_bin_data($icon, $params, $type = 'product')
{
	if (!empty($icon['absolute_path'])) {
		$image_file = $icon['absolute_path'];
	} else {
		$_image_file = db_get_field("SELECT image_path FROM ?:images WHERE image_id = ?i", $image_id);
		$image_file = DIR_IMAGES. $type . '/' . $_image_file;
	}

	if (extension_loaded('gd') && (!empty($params['image_x']) || !empty($params['image_y']))) {
		$new_image_x = !empty($params['image_x']) ? $params['image_x'] : $params['image_y'] / $icon['image_y'] * $icon['image_x'];
		$new_image_y = !empty($params['image_y']) ? $params['image_y'] : $params['image_x'] / $icon['image_x'] * $icon['image_y'];

		//$image_gd = imagecreatefromstring($image_data);
		$new_image_gd = imagecreatetruecolor($new_image_x, $new_image_y);
		list($width, $height, $mime_type) = fn_get_image_size($image_file);
		$ext = fn_get_image_extension($mime_type);

		if ($ext == 'gif' && function_exists('imagegif')) {
			$image_gd = imagecreatefromgif($image_file);
		} elseif ($ext == 'jpg' && function_exists('imagejpeg')) {
			$image_gd = imagecreatefromjpeg($image_file);
		} elseif ($ext == 'png' && function_exists('imagepng')) {
			$image_gd = imagecreatefrompng($image_file);
		} else {
			return false;
		}

		imagecopyresized($new_image_gd, $image_gd, 0, 0, 0, 0, $new_image_x, $new_image_y, $icon['image_x'], $icon['image_y']);

		$tmp_file = fn_create_temp_file();
		if ($ext == 'gif') {
			imagegif($new_image_gd, $tmp_file);
		} elseif ($ext == 'jpg') {
			imagejpeg($new_image_gd, $tmp_file, 50);
		} elseif ($ext == 'png') {
			imagepng($new_image_gd, $tmp_file, 0);
		}

		if (!($image_data = fn_get_contents($tmp_file))) {
			return false;
		}

		$icon['data'] = base64_encode($image_data);
		$icon['image_x'] = $new_image_x;
		$icon['image_y'] = $new_image_y;

	} elseif ($image_data = fn_get_contents($image_file)) {
		$icon['data'] = base64_encode($image_data);
	}

	return $icon;
}

function fn_get_api_image_data($image_pair, $type='product', $image_type = 'icon', $params = array())
{
	if ($image_type == 'detailed' and !empty($image_pair['detailed_id']) or empty($image_pair['image_id']) or !empty($image_pair['image_id']) and empty($image_pair['icon'])) {
		$icon = isset($image_pair['detailed']) ? $image_pair['detailed'] : array();
		$icon['image_id'] = $image_pair['detailed_id'];
	} elseif (!empty($image_pair['image_id'])) {
		$icon = $image_pair['icon'];
		$icon['image_id'] = $image_pair['image_id'];
	}

	if (isset($params['width']) and isset($params['height']) and
		(!isset($params['keep_small_images']) or $icon['image_x'] > $params['width'] or $icon['image_y'] > $params['height'])) {
		$icon['url'] = fn_generate_thumbnail($icon['image_path'], $params['width'], $params['height'], !isset($params['keep_small_images']));
		$_path = str_replace(Registry::get('config.http_path') . '/', '', $icon['url']);
		$real_path = htmlspecialchars_decode(DIR_ROOT . '/' . $_path, ENT_QUOTES);
		$size = fn_get_image_size($real_path);
		$icon['image_y'] = $size ? $size[0] : $params['height'];
		$icon['image_x'] = $size ? $size[1] : $params['width'];
	} else {
		$icon['url'] = $icon['image_path'];
	}

	if (!empty($params['use_bin_data'])) {
		$icon = fn_get_api_image_bin_data($icon, $params, $type);
	}

	if (AREA == 'A' or TWIGMO_IS_NATIVE_APP) {
		$icon['url'] = (defined('HTTPS') ? 'https://' . Registry::get('config.http_host') : 'http://' . Registry::get('config.https_host')) . $icon['url'];
	}

	// Delete unnecessary fields
	if (isset($icon['absolute_path'])) {
		unset($icon['absolute_path']);
	}

	return $icon;
}

function fn_tw_get_domain_name($host)
{
	$parts = explode('.', $host);
	array_pop($parts); // remove 1st-level domain
	$domain = array_pop($parts); // get 2nd-level domain

	return $domain;
}

function fn_api_get_products($params, $items_per_page, $lang_code = CART_LANGUAGE)
{

	if (empty($params['extend'])) {
		$params['extend'] = array (
			'description'
		);
	}

	if (!empty($params['pid']) && !is_array($params['pid'])) {
		$params['pid'] = explode(',', $params['pid']);
	}

	if (!empty($params['q'])) {
		// search by product code
		$params['ppcode'] = 'Y';
		$params['subcats'] = 'Y';
		$params['status'] = 'A';
		$params['pshort'] = 'Y';
		$params['pfull'] = 'Y';
		$params['pname'] = 'Y';
		$params['pkeywords'] = 'Y';
		$params['search_performed'] = 'Y';
	}

	if (isset($params['company_id']) and $params['company_id'] == 0) {
		unset($params['company_id']);
	}

	list($products, $search, $totals) = fn_get_products($params, $items_per_page, $lang_code);

	fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true, 'get_features' => false));

	if (empty($products)) {
		return false;
	}

	$product_ids = array();
	$image_params = Registry::get('addons.twigmo.catalog_image_size');
	foreach ($products  as $k => $v) {

		if (!empty($products[$k]['short_description']) || !empty($products[$k]['full_description'])) {
			$products[$k]['short_description'] = !empty($products[$k]['short_description']) ? strip_tags($products[$k]['short_description']) : fn_substr(strip_tags($products[$k]['full_description']), 0, TWG_MAX_DESCRIPTION_LEN);
			unset($products[$k]['full_description']);
		} else {
			$products[$k]['short_description'] = '';
		}

		$product_ids[] = $v['product_id'];

		// Get product image data
		if (!empty($v['main_pair'])) {
			$products[$k]['icon'] = fn_get_api_image_data($v['main_pair'], 'product', 'icon', $image_params);
		}

	}

	$category_descriptions = db_get_hash_array("SELECT p.product_id, p.category_id, c.category FROM ?:products_categories AS p, ?:category_descriptions AS c WHERE c.category_id = p.category_id AND c.lang_code = ?s AND p.product_id IN (?a) AND p.link_type = 'M'", 'product_id', $lang_code, $product_ids);

	foreach ($products as $k => $v) {
		if (!empty($v['product_id']) && !empty($category_descriptions[$v['product_id']])) {
			$products[$k]['category'] = $category_descriptions[$v['product_id']]['category'];
			$products[$k]['category_id'] = $category_descriptions[$v['product_id']]['category_id'];
		}
		if (!empty($v['inventory_amount']) && $v['inventory_amount'] > $v['amount']) {
			$products[$k]['amount'] = $v['inventory_amount'];
		}
	}

	$result = fn_get_as_api_list('products', $products);

	return $result;
}

function fn_api_get_categories($params, $lang_code = CART_LANGUAGE)
{
	$params['get_images'] = 'Y';
	$category_id = !empty($params['id']) ? $params['id'] : 0;
	$type = !empty($params['type']) ? $params['type'] : '';

	if ($type == 'one_level') {
		$type_params = array (
			'category_id' => $category_id,
			'current_category_id' => $category_id,
			'simple' => false,
			'visible' => true
		);

	} elseif ($type == 'plain_tree') {
		$type_params = array (
			'category_id' => $category_id,
			'current_category_id' => $category_id,
			'simple' => false,
			'visible' => false,
			'plain' => true
		);

	} else {
		$type_params = array (
			'simple' => false,
			'category_id' => $category_id,
			'current_category_id' => $category_id
		);
	}
	$params =  array_merge($type_params, $params);

	list($categories, ) = fn_get_categories($params, $lang_code);

	$image_params = Registry::get('addons.twigmo.catalog_image_size');
	foreach ($categories as $k => $v) {
		if (!empty($v['has_children'])) {
			$categories[$k]['subcategory_count'] = db_get_field("SELECT COUNT(*) FROM ?:categories WHERE parent_id = ?i", $v['category_id']);
		}
		if (!empty($params['get_images']) && !empty($v['main_pair'])) {
			$categories[$k]['icon'] = fn_get_api_image_data($v['main_pair'], 'category', 'icon', $image_params);
		}
	}

	$result = fn_get_as_api_list('categories', $categories);

	return $result;
}

function fn_twigmo_get_categories(&$params, &$join, &$condition, &$fields, &$group_by, &$sortings)
{
	if (!empty($params['depth'])) {

		if (!empty($params['category_id'])) {
			$from_id_path = db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $params['category_id']) . '/';

		} else {
			$from_id_path = '';
		}

		$from_id_path .= str_repeat('%/', $params['depth']) . '%';
		$condition .= db_quote(" AND NOT ?:categories.id_path LIKE ?l", "$from_id_path");
	}

	if (!empty($params['cid'])) {
		$cids = is_array($params['cid']) ? $params['cid'] : array($params['cid']);
		$condition .= db_quote(" AND ?:categories.category_id IN (?n)", $cids);
	}
}

function fn_api_get_product_options($product, $lang_code = CART_LANGUAGE){

	$condition = $_status = $join = '';
	$extra_variant_fields = '';
	$option_ids = $variants_ids = $options = array();
    $_status .= " AND status = 'A'";
    $product_ids = $product['product_id'];

	$join = db_quote(" LEFT JOIN ?:product_options_descriptions as b ON a.option_id = b.option_id AND b.lang_code = ?s ", $lang_code);
	$fields = "a.*, b.option_name, b.option_text, b.description, b.inner_hint, b.incorrect_message, b.comment";

	if (!empty($product_ids)) {
		$_options = db_get_hash_multi_array(
			"SELECT " . $fields
			. " FROM ?:product_options as a "
			. $join
			. " WHERE a.product_id IN (?n)" . $condition . $_status
			. " ORDER BY a.position",
			array('product_id', 'option_id'), $product_ids
		);

		$global_options = db_get_hash_multi_array(
			"SELECT c.product_id AS cur_product_id, a.*, b.option_name, b.option_text, b.description, b.inner_hint, b.incorrect_message, b.comment"
			. " FROM ?:product_options as a"
			. " LEFT JOIN ?:product_options_descriptions as b ON a.option_id = b.option_id AND b.lang_code = ?s"
			. " LEFT JOIN ?:product_global_option_links as c ON c.option_id = a.option_id"
			. " WHERE c.product_id IN (?n) AND a.product_id = 0" . $condition . $_status
			. " ORDER BY a.position",
				array('cur_product_id', 'option_id'), $lang_code, $product_ids
		);

	foreach ((array)$product_ids as $product_id) {
			$_opts = (empty($_options[$product_id]) ? array() : $_options[$product_id]) + (empty($global_options[$product_id]) ? array() : $global_options[$product_id]);
			$options[$product_id] = fn_sort_array_by_key($_opts, 'position');
		}
	} else {
		//we need a separate query for global options
		$options = db_get_hash_multi_array(
			"SELECT a.*, b.option_name, b.option_text, b.description, b.inner_hint, b.incorrect_message, b.comment"
			. " FROM ?:product_options as a"
			. $join
			. " WHERE a.product_id = 0" . $condition . $_status
			. " ORDER BY a.position",
			array('product_id', 'option_id')
		);
	}

	foreach ($options as $product_id => $_options) {
		$option_ids = array_merge($option_ids, array_keys($_options));
	}

	if (empty($option_ids)) {
		if (is_array($product_ids)) {
			return $options;
		} else {
			return !empty($options[$product_ids]) ? $options[$product_ids] : array();
		}
	}

	$_status = " AND a.status='A'";

	$v_fields = "a.variant_id, a.option_id, a.position, a.modifier, a.modifier_type, a.weight_modifier, a.weight_modifier_type, $extra_variant_fields b.variant_name";
	$v_join = db_quote("LEFT JOIN ?:product_option_variants_descriptions as b ON a.variant_id = b.variant_id AND b.lang_code = ?s", $lang_code);
	$v_condition = db_quote("a.option_id IN (?n) $_status", array_unique($option_ids));
	$v_sorting = "a.position, a.variant_id";
	$variants = db_get_hash_multi_array("SELECT $v_fields FROM ?:product_option_variants as a $v_join WHERE $v_condition ORDER BY $v_sorting", array('option_id', 'variant_id'));

	foreach ($variants as $option_id => $_variants) {
		$variants_ids = array_merge($variants_ids, array_keys($_variants));
	}

	if (isset($variants_ids) && empty($variants_ids)) {
		return is_array($product_ids)? $options: $options[$product_ids];
	}

	$image_pairs = fn_get_image_pairs(array_unique($variants_ids), 'variant_image', 'V', true, true, $lang_code);

	foreach ($variants as $option_id => &$_variants) {
		foreach ($_variants as $variant_id => &$_variant) {
			$_variant['image_pair'] = !empty($image_pairs[$variant_id])? reset($image_pairs[$variant_id]) : array();
		}
	}

	foreach ($options as $product_id => &$_options) {
		foreach ($_options as $option_id => &$_option) {
			// Add variant names manually, if this option is "checkbox"
			if ($_option['option_type'] == 'C' && !empty($variants[$option_id])) {
				foreach ($variants[$option_id] as $variant_id => $variant) {
					$variants[$option_id][$variant_id]['variant_name'] = $variant['position'] == 0 ? fn_get_lang_var('no') : fn_get_lang_var('yes');
				}
			}

			$_option['variants'] = !empty($variants[$option_id])? $variants[$option_id] : array();
		}
	}

	return is_array($product_ids)? $options: $options[$product_ids];
}

function fn_get_api_product_data($product_id, $lang_code = CART_LANGUAGE)
{
	$auth = & $_SESSION['auth'];

	$product = fn_get_product_data($product_id, $auth, $lang_code, '', true, true, true, true);

	if (empty($product)) {
		return array();
	}

	fn_gather_additional_product_data($product, true, true);

	// Delete empty product feature groups
	foreach ($product['product_features'] as $feature_id => $feature) {
		if ($feature['feature_type'] == 'G' and empty($feature['subfeatures'])) {
			unset($product['product_features'][$feature_id]);
		}
	}

    $product['product_options'] = array();
    if (!empty($product['combination'])) {
        $selected_options = fn_get_product_options_by_combination($product['combination']);
        $product['product_options'] = (!empty($selected_options)) ? fn_get_selected_product_options($product['product_id'], $selected_options, $lang_code) : $product_options[$product_id];
    }
    $product['product_options'] = fn_api_get_product_options($product);
    foreach ($product['product_options'] as $k1 => $v1){
        $option_descriptions = db_get_row("SELECT option_name, option_text, description, comment FROM ?:product_options_descriptions WHERE option_id = ?i AND lang_code = ?s", $v1['option_id'], $lang_code);
        foreach ($option_descriptions as $k2 => $v2) {
            $product['product_options'][$k1][$k2] = $v2;
        }
		$v1['variants'] = isset($v1['variants']) ? $v1['variants'] : array();
        foreach ($v1['variants'] as $vid=>$variant){
            if ($v1['option_type'] == 'C') {
                $product['product_options'][$k1]['variants'][$vid]['variant_name'] = (empty($v1['position'])) ? fn_get_lang_var('no', $lang_code) : fn_get_lang_var('yes', $lang_code);
            } elseif ($v1['option_type'] == 'S' || $v1['option_type'] == 'R') {
                $variant_description = db_get_field("SELECT variant_name FROM ?:product_option_variants_descriptions WHERE variant_id = ?i AND lang_code = ?s", $vid, $lang_code);
                $product['product_options'][$k1]['variants'][$vid]['variant_name'] = $variant_description;
            }
        }
    }


	if (Registry::get('addons.discussion.status') == 'A') {
		$discussion = fn_get_discussion($product_id, 'P');

		if (!empty($discussion['thread_id'])) {
			$discussion_page = !empty($_REQUEST['discussion_page']) ? $_REQUEST['discussion_page'] : 0;
			$product['product_reviews'] = fn_get_discussion_posts($discussion['thread_id'], $discussion_page);
		}
	}

	$product['category_id'] = $product['main_category'];
	$product['images'] = array();

	$image_params = Registry::get('addons.twigmo.big_image_size');
	$image_params['keep_small_images'] = true;
	if (!empty($product['main_pair'])) {
		$product['icon'] = fn_get_api_image_data($product['main_pair'], 'product', 'icon', Registry::get('addons.twigmo.prewiew_image_size'));
		$product['images'][] = fn_get_api_image_data($product['main_pair'], 'product', 'detailed', $image_params);
	}

	foreach ($product['image_pairs'] as $v) {
		$product['images'][] = fn_get_api_image_data($v, 'product', 'detailed', $image_params);
	}

	$product['category'] = db_get_field("SELECT category FROM ?:category_descriptions WHERE category_id = ?i AND lang_code = ?s", $product['main_category'], $lang_code);

	$product['product_options_exceptions'] = fn_get_api_product_options_exceptions($product_id);
	$product['product_options_inventory'] = fn_get_api_product_options_inventory($product_id, $lang_code);

	$_product = fn_get_as_api_object('products', $product);

	$_product['avail_since_formated'] = strftime(Registry::get('settings.Appearance.date_format'), $_product['avail_since']);
	$_product['TIME'] = TIME;
	$params = array('product_id' => $product_id,
									'descr_sl' => DESCR_SL
	);
	$_product['tabs'] = fn_twigmo_get_product_tabs($params);
  return $_product;
}

function fn_twigmo_get_product_tabs($params)
{
	$allowed_page_types = array('T', 'L', 'F');
	$not_allowed_block_types = array('cart_content', 'template');
	$tabs = Bm_ProductTabs::instance()->get_list(
		'',
		$params['product_id'],
		$params['descr_sl']
	);
	foreach ($tabs as $k => $tab) {
		$block_data = array();
		if ((empty($params['all_tabs']) && $tab['status'] != 'A') || $tab['tab_type'] != 'B') {
			unset($tabs[$k]);
			continue;
		}

		if ($tab['tab_type'] == 'B') {
			$_params = array('block_id' => $tab['block_id'],
											 'area' => 'C'
			);
			$block = fn_twigmo_get_block($_params);
			$block_scheme = Bm_SchemesManager::get_block_scheme($block['type'], array());
			if (in_array($block['type'], $not_allowed_block_types)) {
				unset($tabs[$k]);
				continue;
			}
			if ($block['type'] == 'html_block') {
				$tabs[$k]['html'] = $block['content']['content'];
			} elseif (!empty($block_scheme['content']) && !empty($block_scheme['content']['items'])) {
				// Products and categories: get items
				$template_variable = 'items';
				$field = $block_scheme['content']['items'];
				$items = Bm_RenderManager::get_value($template_variable, $field, $block_scheme, $block);
				// Filter pages - only texts, links and forms posible
				if ($block['type'] == 'pages') {
					foreach ($items as $item_id => $item) {
						if (!in_array($item['page_type'], $allowed_page_types)) {
							unset($items[$item_id]);
						}
					}
				}
				if (fn_is_empty($items)) {
					unset($tabs[$k]);
					continue;
				}
				$block_data['total_items'] = count($items);
				// Images
				$image_params = Registry::get('addons.twigmo.cart_image_size');
				if ($block['type'] == 'products' or $block['type'] == 'categories') {
					$object_type = $block['type'] == 'products' ? 'product' : 'category';
					foreach ($items as $items_id => $item) {
						$main_pair = fn_get_image_pairs($item[$object_type . '_id'], $object_type, 'M', true, true);
						if (!empty($main_pair)) {
							$items[$items_id]['icon'] = fn_get_api_image_data($main_pair, $object_type, 'icon', $image_params);
						}
					}
				}
				// Banners properties
				if ($block['type'] == 'banners') {
					$rotation = $block['properties']['template'] == 'addons/banners/blocks/carousel.tpl' ? 'Y' : 'N';
					$block_data['delay'] = $rotation == 'Y' ? $block['properties']['delay'] : 0;
					$object_type = 'banner';
				}
				$block_data[$block['type']] = fn_get_as_api_list($block['type'], $items);
				$tabs[$k] = array_merge($tab, $block_data);
			}
		}
	}
	return array_values($tabs); // reindex
}

function fn_get_api_category_data($category_id, $lang_code)
{
	$category = fn_get_category_data($category_id, $lang_code);

	if (!empty($category['parent_id'])) {
		$category['parent_category'] = db_get_field("SELECT category FROM ?:category_descriptions WHERE ?:category_descriptions.category_id = ?i AND ?:category_descriptions.lang_code = ?s", $category['parent_id'], $lang_code);
	}
	if (!empty($category['main_pair'])) {
		$category['icon'] = fn_get_api_image_data($category['main_pair'], 'category', 'detailed', $_REQUEST);
	}

	return fn_get_as_api_object('categories', $category);
}

function fn_get_api_product_options_exceptions($product_id)
{
	if (PRODUCT_TYPE == 'COMMUNITY') {
		return array();
	}

	$exceptions = db_get_array("SELECT * FROM ?:product_options_exceptions WHERE product_id = ?i ORDER BY exception_id", $product_id);

	if (empty($exceptions)) {
		return array();
	}

	foreach ($exceptions as $k => $v) {
		$_comb = unserialize($v['combination']);
		$exceptions[$k]['combination'] = array();

		foreach ($_comb as $option_id => $variant_id) {
			$exceptions[$k]['combination'][] = array (
				'option_id' => $option_id,
				'variant_id' => $variant_id
			);
		}
	}

	return $exceptions;
	//return fn_get_as_api_list('product_options_exceptions', $exceptions);
}

function fn_get_api_product_options_inventory($product_id, $lang_code = CART_LANGUAGE)
{
	$inventory = db_get_array("SELECT * FROM ?:product_options_inventory WHERE product_id = ?i ORDER BY position", $product_id);

	if (empty($inventory)) {
		return array();
	}

	$inventory_ids = array();
	foreach ($inventory as $k => $v) {
		$inventory_ids[] = $v['combination_hash'];
	}

	$image_pairs = fn_get_image_pairs($inventory_ids, 'product_option', 'M', false, true, $lang_code);

	foreach ($inventory as $k => $v) {
		$inventory[$k]['combination'] = array();
		$_comb = fn_get_product_options_by_combination($v['combination']);

		if (!empty($image_pairs[$v['combination_hash']])) {
			$inventory[$k]['image'] = fn_get_api_image_data(current($image_pairs[$v['combination_hash']]), 'product_option', 'detailed', $_REQUEST);
		}

		foreach ($_comb as $option_id => $variant_id) {
			$inventory[$k]['combination'][] = array (
				'option_id' => $option_id,
				'variant_id' => $variant_id
			);
		}
	}

	return $inventory;
}

function fn_api_update_order($order, $response)
{
	if (!defined('ORDER_MANAGEMENT')) {
		define('ORDER_MANAGEMENT', true);
	}

	if (!empty($order['status'])) {

		$statuses = fn_get_statuses(STATUSES_ORDER, false, true);

		if (!isset($statuses[$order['status']])) {
			$msg = str_replace('[object_id]', $order['order_id'], fn_get_lang_var('twgadmin_wrong_api_object_data'));
			$response->addError('ERROR_OBJECT_UPDATE', str_replace('[object]', 'orders', fn_get_lang_var('twgadmin_wrong_api_object_data')));
		} else {
			fn_change_order_status($order['order_id'], $order['status']);
		}
	}

	$cart = array();
	fn_clear_cart($cart, true);
	$customer_auth = fn_fill_auth(array(), array(), false, 'C');

	fn_form_cart($order['order_id'], $cart, $customer_auth);
	$cart['order_id'] = $order['order_id'];

	// update only profile data
	$profile_data = fn_check_table_fields($order, 'user_profiles');

	$cart['user_data'] = fn_array_merge($cart['user_data'], $profile_data);
	fn_calculate_cart_content($cart, $customer_auth, 'A', true, 'I');

	if (!empty($order['details'])) {
		db_query('UPDATE ?:orders SET details = ?s WHERE order_id = ?i', $order['details'], $order['order_id']);
	}

	if (!empty($order['notes'])) {
		$cart['notes'] = $order['notes'];
	}

	list($order_id, $process_payment) = fn_place_order($cart, $customer_auth, 'save');

	// place order routines with the disabled notifications
	//fn_order_placement_routines($order_id, fn_get_notification_rules(array(), true), true, 'save');

	return true;
}

function fn_api_customer_login($user_login, $password)
{
	list($status, $user_data, $user_login, $password, $salt) = fn_api_auth_routines($user_login, $password);

	if ($status === false) {
		return false;
	}

	if (empty($user_data) || (fn_generate_salted_password($password, $salt) != $user_data['password']) || empty($password)) {

		fn_log_event('users', 'failed_login', array (
			'user' => $user_login
		));

		return false;
	}

	$_SESSION['auth'] = fn_fill_auth($user_data);

	// Set last login time
	db_query("UPDATE ?:users SET ?u WHERE user_id = ?i", array('last_login' => TIME), $user_data['user_id']);

	$_SESSION['auth']['this_login'] = TIME;
	$_SESSION['auth']['ip'] = $_SERVER['REMOTE_ADDR'];

	// Log user successful login
	fn_log_event('users', 'session', array(
		'user_id' => $user_data['user_id']
	));

	if ($cu_id = fn_get_session_data('cu_id')) {
		$cart = array();
		fn_clear_cart($cart);
		fn_save_cart_content($cart, $cu_id, 'C', 'U');
		fn_delete_session_data('cu_id');
	}

	fn_init_user_session_data($_SESSION, $user_data['user_id']);

	return $user_data;
}

function fn_api_customer_logout()
{
	// copied from common/auth.php - logout mode
	$auth = $_SESSION['auth'];

	fn_save_cart_content($_SESSION['cart'], $auth['user_id']);

	if (!empty($auth['user_id'])) {
		// Log user logout
		fn_log_event('users', 'session', array(
			'user_id' => $auth['user_id'],
			'time' => TIME - $auth['this_login'],
			'timeout' => false
		));
	}

	unset($_SESSION['auth']);
	fn_clear_cart($_SESSION['cart'], false, true);

	fn_delete_session_data(AREA_NAME . '_user_id', AREA_NAME . '_password');

	return true;
}

/*
 * Copy of fn_auth_routines
 * from auth.php
 */
function fn_api_auth_routines($user_login, $password)
{
	$status = true;

	$field = (Registry::get('settings.General.use_email_as_login') == 'Y') ? 'email' : 'user_login';

	$condition = '';


	if (PRODUCT_TYPE == 'ULTIMATE') {
		if (Registry::get('settings.Stores.share_users') == 'N' && AREA != 'A') {
			$condition = fn_get_company_condition('?:users.company_id');
		}
	}


	$user_data = db_get_row("SELECT * FROM ?:users WHERE $field = ?s" . $condition, $user_login);

	if (empty($user_data)) {
		$user_data = db_get_row("SELECT * FROM ?:users WHERE $field = ?s AND user_type IN ('A', 'V', 'P')", $user_login);
	}

	if (!empty($user_data)) {
		$user_data['usergroups'] = fn_get_user_usergroups($user_data['user_id']);
	}

	if (!empty($user_data) && (!fn_check_user_type_admin_area($user_data) && AREA == 'A' || !fn_check_user_type_access_rules($user_data))) {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_area_access_denied'));
		$status = false;
	}

	if (!empty($user_data['status']) && $user_data['status'] == 'D') {
		fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_account_disabled'));
		$status = false;
	}

	$salt = isset($user_data['salt']) ? $user_data['salt'] : '';

	return array($status, $user_data, $user_login, $password, $salt);
}

/**
 * Copy of the fn_start_payment - to change MODE to place_order
 *
 * @param array $payment payment data
 * @param int $order_id order ID
 * @param bool $force_notification force user notification (true - notify, false - do not notify, order status properties will be skipped)
 */
function fn_twg_start_payment($order_id, $force_notification = array(), $payment_info)
{
	$order_info = fn_get_order_info($order_id);

	if (!empty($order_info['payment_info']) && !empty($payment_info)) {
		$order_info['payment_info'] = $payment_info;
	}

	list($is_processor_script, $processor_data) = fn_check_processor_script($order_info['payment_id'], '');
	if ($is_processor_script) {
		set_time_limit(300);
		$idata = array (
			'order_id' => $order_id,
			'type' => 'S',
			'data' => TIME,
		);
		db_query("REPLACE INTO ?:order_data ?e", $idata);


		$index_script = INDEX_SCRIPT;
		$mode = 'place_order'; // Change mode from 'post' to 'place_order'

		include(DIR_PAYMENT_FILES . $processor_data['processor_script']);

		return fn_finish_payment($order_id, $pp_response, $force_notification);
	}

	return false;
}


function fn_init_api_session_data()
{
	Session::set_params();
	Session::set_handlers();
	@Session::start();
	register_shutdown_function('session_write_close');

	// init session data
	fn_init_user();
}

function twg_cmp_products($products1, $products2) {
    if ($products1[0]['product'] == $products2[0]['product']) {
        return 0;
    }
    return ($products1[0]['product'] < $products2[0]['product']) ? -1 : 1;
}

function twg_cmp_products2($product1, $product2) {
    if ($product1['cart_id'] == $product2['cart_id']) {
        return 0;
    }
    return ($product1['cart_id'] < $product2['cart_id']) ? -1 : 1;
}

function fn_twigmo_filter_payment_buttons($payment_buttons)
{
	if (!$payment_buttons) {
		return $payment_buttons;
	}
	$checkout_processors = Registry::get('addons.twigmo.checkout_processors');
	$payment_buttons_processors = db_get_hash_single_array('SELECT p.payment_id, pp.processor FROM ?:payments as p INNER JOIN ?:payment_processors as pp ON pp.processor_id=p.processor_id WHERE p.payment_id IN (?n)', array('payment_id', 'processor'), array_keys($payment_buttons));
	foreach ($payment_buttons as $payment_id => $button) {
		if (!isset($payment_buttons_processors[$payment_id]) or !in_array($payment_buttons_processors[$payment_id], $checkout_processors)) {
			unset($payment_buttons[$payment_id]);
			continue;
		}
		$button = str_replace('<form ', '<form data-ajax="false" ', $button);
		// Delete bad tags for button
		$payment_buttons[$payment_id] = trim(str_replace(array('<html>', '<body>', '</body>', '</html>', '<br/>'), '', $button));
	}
	return array_values($payment_buttons);
}

function fn_api_get_cart_promotion_input_field()
{
	$input_field = 'N';
	if (fn_display_promotion_input_field($_SESSION['cart'])) {
		$input_field = Registry::get('addons.gift_certificates.status') == 'A' ? 'G' : 'P';
	}
	return $input_field;
}


function fn_twg_get_payment_methods() {
	$payment_groups = fn_prepare_checkout_payment_methods($_SESSION['cart'], $_SESSION['auth']);
	if (!$payment_groups) {
		$payment_groups = array();
	}
	$payment_methods = array();
	foreach ($payment_groups as $payment_group) {
		$payment_methods = array_merge_recursive($payment_methods, $payment_group);
	}
	// unset FRIbetaling payment
	foreach ($payment_methods as $key => $payment_method) {
		if (isset($payment_method['processor']) and $payment_method['processor'] == 'FRIbetaling') {
			unset($payment_methods[$key]);
		}
	}
	return fn_get_as_api_list('payments', $payment_methods);
}


function fn_api_get_session_cart($lang_code = CART_LANGUAGE)
{
	$cart_data = array('amount' => 0, 'subtotal' => 0);
	if (empty($_SESSION['cart'])) {
		return $cart_data;
	}

	// fetch cart data
	$cart_data = array_merge($cart_data, fn_get_as_api_object('cart', $_SESSION['cart'], array(), array('lang_code' => $lang_code)));
	if (!empty($cart_data['taxes'])) {
		$cart_data['taxes'] = fn_get_as_api_list('taxes', $cart_data['taxes']);
	}
	if (!empty($cart_data['products'])) {
		$cart_data['products'] = array_reverse($cart_data['products']);
	}

	if (!empty($cart_data['payment_surcharge'])) {
		$cart_data['total'] += $cart_data['payment_surcharge'];
	} else {
		$cart_data['payment_surcharge'] = 0;
	}

	// ================ Payment buttons ========================================
	$payment_buttons = array();
	$checkout_processors = array('amazon_checkout.php', 'paypal_express.php', 'google_checkout.php');
	$included_files = get_included_files();
	$is_payments_included = false;
	foreach ($checkout_processors as $checkout_processor) {
		if (in_array(DIR_PAYMENT_FILES . $checkout_processor, $included_files)) {
			$is_payments_included = true;
			break;
		}
	}
	if ($is_payments_included) {
		// Get from templater
		$view = Registry::get('view');
		$smarty_vars = array('checkout_add_buttons', 'checkout_buttons');
		foreach ($smarty_vars as $smarty_var) {
			$buttons = $view->get_template_vars($smarty_var);
			if ($buttons !== null) {
				$payment_buttons = $buttons;
				break;
			}
		}
	} else {
		// Get payments fiels
		if (!empty($_SESSION['cart']['products'])) {
			foreach ($_SESSION['cart']['products'] as $product_key => $product) {
				if (!isset($_SESSION['cart']['products'][$product_key]['product'])) {
					$product_data = fn_get_product_data($product['product_id'], $_SESSION['auth']);
					$_SESSION['cart']['products'][$product_key]['product'] = $product_data['product'];
					$_SESSION['cart']['products'][$product_key]['short_description'] = $product_data['short_description'];
				}

			}
			$payment_buttons = fn_twigmo_get_checkout_payment_buttons($_SESSION['cart'], $_SESSION['cart']['products'], $_SESSION['auth']);
		}
	}
	$cart_data['payment_buttons'] = fn_twigmo_filter_payment_buttons($payment_buttons);
	// ================ /Payment buttons =======================================

	$payment_methods = fn_twg_get_payment_methods();
	$cart_data['empty_payments'] = empty($payment_methods) ? 'Y' : 'N';
	$cart_data['coupons'] = empty($_SESSION['cart']['coupons']) ? array() : array_keys($_SESSION['cart']['coupons']);
	$cart_data['use_gift_certificates'] = array();
	$cart_data['gift_certificates_total'] = 0;
	if (isset($_SESSION['cart']['use_gift_certificates'])) {
		foreach ($_SESSION['cart']['use_gift_certificates'] as $code => $cert) {
			$cart_data['use_gift_certificates'][] = array('code' => $code, 'cost' => $cert['cost']);
			$cart_data['gift_certificates_total'] += $cert['cost'];
		}
	}
	return $cart_data;
}

function fn_api_get_cart_products($cart_items, $lang_code = CART_LANGUAGE)
{
	if (empty($cart_items)) {
		return array();
	}

	$api_products = array();
	$image_params = Registry::get('addons.twigmo.cart_image_size');
	foreach ($cart_items as $k => $item) {
		$product = array (
			'product' => db_get_field("SELECT product FROM ?:product_descriptions WHERE product_id = ?i AND lang_code = ?s", $item['product_id'], $lang_code),
			'product_id' => $item['product_id'],
			'cart_id' => $k,
			'price' => $item['price'],
			'amount' => $item['amount'],
			'company_id' => $item['company_id'],
			'company_name' => fn_get_company_name($item['company_id'])
		);

		$main_pair = fn_get_image_pairs($item['product_id'], 'product', 'M', true, true, $lang_code);
		if (!empty($main_pair)) {
			$product['icon'] = fn_get_as_api_object('images' ,fn_get_api_image_data($main_pair, 'product', 'icon', $image_params));
		}

		if (!empty($item['product_options'])) {
			$advanced_options = fn_get_selected_product_options_info($item['product_options']);
			$api_options = fn_get_as_api_list('cart_product_options', $advanced_options);

			if (!empty($api_options['option'])) {
				$product['product_options'] = $api_options['option'];
			}
		}

		$api_products[] = $product;
	}

	return $api_products;
}

function fn_api_add_product_to_cart($products, &$cart)
{
	$products_data = array();

	foreach ($products as $product) {

		$cid = fn_generate_cart_id($product['product_id'], $product);

		if (!empty($products_data[$cid])) {
			$products_data[$cid]['amount'] += $product['amount'];
		}

		$products_data[$cid] = $product;
	}

	$auth = & $_SESSION['auth'];

	// actions copied from the checkout.php 'add' action
	fn_add_product_to_cart($products_data, $cart, $auth);

	fn_save_cart_content($cart, $auth['user_id']);
	fn_calculate_cart_content($cart, $auth, 'S', true, 'F', true);
}

function fn_get_random_ids($qty, $field, $table, $condition = '')
{
	// max quantity of rows in tables to use the mysql rand()
	// to prevent server load for large tables
	$max_rand_items = 1000;

	if (!empty($condition)) {
		$condition = 'WHERE ' . $condition;
	}

	$total = db_get_field("SELECT COUNT(*) as total FROM $table $condition");

	if ($total <= $qty) {
		return db_get_fields("SELECT $field FROM $table $condition");
	}

	if ($total < $max_rand_items) {
		return db_get_fields("SELECT $field FROM $table $condition ORDER BY RAND() LIMIT $qty");
	}

	$ids = array();
	$rands = array();
	$min_rand = 0;
	$max_rand = (int) $total - 1;

	for ($i = 0; $i < $qty; $i++) {
		$rand_num = rand($min_rand, $max_rand);

		while (in_array($rand_num, $rands)) {
			$rand_num++;
			if ($rand_num > $max_rand) {
				$rand_num = $min_rand;
			}
			echo $rand_num . ' <br/> ';
		}

		$rands[] = $rand_num;
		$ids[] = db_get_field("SELECT $field FROM $table $condition LIMIT $rand_num, 1");
	}

	return $ids;
}

/*
 * Get all product id from category (with/not subcategories)
 */
function fn_get_category_product_ids($category_id, $get_sub  = false)
{
	if (empty($category_id)) {
		return false;
	}

	$_categories[] = $category_id;

	if ($get_sub) {

		$category_params = array (
			'id' => !empty($category_id) ? $category_id : 0,
			'type' => 'plain_tree'
		);

		$categories = fn_api_get_categories($category_params, $lang_code);

		if (!empty($categories)) {
			foreach ($categories['category'] as $category) {
				$_categories[] = $category['category_id'];
			}
		}
	}

	$a = db_get_fields("SELECT l.product_id FROM ?:products_categories AS l LEFT JOIN ?:products AS p ON p.product_id = l.product_id WHERE l.category_id IN(?a) AND l.link_type = 'M' AND p.status = 'A' ORDER BY l.position", $_categories);

	return $a;
}

/*
 * API functions adding data to response
 */
function fn_set_response_pagination(&$response, $set_empty = false)
{
	$pagination = Registry::get('view')->get_template_vars('pagination');
	if (!empty($pagination)) {
		$response->setMeta($pagination['total_pages'], 'total_pages');
		$response->setMeta($pagination['total_items'], 'total_items');
		$response->setMeta($pagination['items_per_page'], 'items_per_page');
		$response->setMeta($pagination['current_page'], 'current_page');
	} elseif ($set_empty) {
		$response->setMeta(0, 'total_pages');
		$response->setMeta(0, 'total_items');
		$response->setMeta(0, 'items_per_page');
		$response->setMeta(1, 'current_page');
	}
}

function fn_set_response_products(&$response, $params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
	$products = fn_api_get_products($_REQUEST, $items_per_page, $lang_code);

	if (!empty($products)) {
		$response->setResponseList($products);
		if (!empty($_REQUEST['cid'])) {
			$response->setMeta($_REQUEST['cid'], 'category_id');
			$category = !empty($category_descriptions[$_REQUEST['cid']]) ? $category_descriptions[$_REQUEST['cid']] : '';
			$response->setMeta($category, 'category');
		}
	}

	fn_set_response_pagination($response);
}

function fn_set_response_categories(&$response, $params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
	if (empty($items_per_page)) {
		$result = fn_api_get_categories($params, $lang_code);
		$response->setMeta(db_get_field("SELECT COUNT(*) FROM ?:categories"), 'total_items');
		$response->setResponseList($result);

	} else {
		$default_params = array (
			'depth' => 0,
			'page' => 1
		);

		$params = array_merge($default_params, $params);
		$params['type'] = 'plain_tree';

		$categories = fn_api_get_categories($params, $lang_code);

		if (!empty($categories)) {
			$total = count($categories['category']);
			$params['page'] = !empty($params['page']) ? $params['page'] : 1;
			fn_paginate($params['page'], $total, $items_per_page);

			$pagination = Registry::get('view')->get_template_vars('pagination');

			$start = $pagination['prev_page'] * $pagination['items_per_page'];
			$end = $start + $items_per_page;
			$result = array();

			for ($i = $start; $i < $end; $i++) {
				if (!isset($categories['category'][$i])) {
					break;
				}

				$result[] = $categories['category'][$i];
			}

			$response->setResponseList(array('category' => $result));
			fn_set_response_pagination($response);
		}

	}

	$category_id =  !empty($params['id']) ? $params['id'] : 0;

	if (!empty($category_id)) {
		$parent_data = db_get_row("SELECT a.parent_id, b.category FROM ?:categories AS a LEFT JOIN ?:category_descriptions AS b ON a.parent_id = b.category_id WHERE a.category_id = ?i AND b.lang_code = ?s", $category_id, $lang_code);

		if (!empty($parent_data)) {
			$response->setMeta($parent_data['parent_id'], 'grand_id');
			$response->setMeta($parent_data['category'], 'grand_category');
		}

		$response->setMeta($category_id, 'category_id');
		$category_data = array_pop(db_get_array("SELECT category, description FROM ?:category_descriptions WHERE category_id = ?i AND lang_code = ?s", $params['category_id'], $lang_code));
		$response->setMeta($category_data['category'], 'category_name');
		$response->setMeta($category_data['description'], 'description');
	}

}

function fn_set_response_catalog(&$response, $params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
	// supported params:
	// id - category id
	// sort_by - products sort
	// sort_order - products sort order
	// page - products page number
	// items_per_page
	$params['category_id'] = !empty($params['category_id']) ? $params['category_id'] : 0;

	$response->setData($params['category_id'], 'category_id');
	if (!empty($params['category_id'])) {
		$category_data = array_pop(db_get_array("SELECT category, description FROM ?:category_descriptions WHERE category_id = ?i AND lang_code = ?s", $params['category_id'], $lang_code));
		$response->setData($category_data['category'], 'category_name');
		$response->setData($category_data['description'], 'description');
	}

	if (empty($params['page']) || $params['page'] == 1) {
		$category_params = array (
			'id' => !empty($params['category_id']) ? $params['category_id'] : 0,
			'type' => 'one_level'
		);

		$categories = fn_api_get_categories($category_params, $lang_code);

		if (!empty($categories['category'])) {
			$response->setData($categories['category'], 'subcategories');
		}
	}

	if (!empty($params['category_id'])) {
		// set products
		$params['cid'] = $params['category_id'];
		$products = fn_api_get_products($params, $items_per_page, $lang_code);

		if (!empty($products['product'])) {
			$response->setData($products['product'], 'products');
		}
	}

	fn_set_response_pagination($response, true);
}

function fn_api_get_base_statuses($add_hidden = true, $lang_code = CART_LANGUAGE)
{
	$base_statuses = array (
		array('A', fn_get_lang_var('active', $lang_code), '#97CF4D'),
		array('D', fn_get_lang_var('disabled', $lang_code), '#D2D2D2'),
	);

	if ($add_hidden) {
		$base_statuses[] = array('H', fn_get_lang_var('hidden', $lang_code), '#8D8D8D');
	}

	$api_statuses = array();
	foreach ($base_statuses as $k => $v) {
		$api_statuses[] = array (
			'code' => $v[0],
			'description' => $v[1],
			'color' => $v[2]
		);
	}

	return $api_statuses;
}

function fn_api_get_object($response, $object_type, $params)
{
	$pattern = fn_get_schema('api', $object_type, 'php', false);
	$condition = array();

	if (!empty($pattern['key'])) {
		$api_key_id = current($pattern['key']);
		if ($key_id = $pattern['fields'][$api_key_id]['db_field']) {
			$condition = array($key_id => $params['id']);
		}
	}

	if (empty($condition)) {
		$response->addError('ERROR_WRONG_OBJECT_DATA', str_replace('[object]', $object_type, fn_get_lang_var('twgadmin_wrong_api_object_data')));
		$response->returnResponse();
	}

	$objects = fn_get_api_schema_data($object_type, $condition);

	if (empty($objects)) {
		$response->addError('ERROR_OBJECT_WAS_NOT_FOUND', str_replace('[object]', $object_type, fn_get_lang_var('twgadmin_object_was_not_found')));
		$response->returnResponse();
	}

	$api_data = current($objects[$pattern['object_name']]);
	$response->setData($api_data);
	$response->returnResponse($pattern['object_name']);
}

function fn_get_payment_options($payment_id)
{
	$template =  db_get_field("SELECT template FROM ?:payments WHERE payment_id = ?i", $payment_id);

	if ($template && preg_match('/(.+)\.tpl/', $template, $matches)) {
		$schema = fn_get_schema('api/payments', $matches[1], 'php', false);
		// Change date fields name
		if (is_array($schema)) {
			foreach ($schema as $key => $option) {
				if ($option['name'] == 'start_date') {
					$schema[$key]['name'] = 'start';
				}
				if ($option['name'] == 'expiry_date') {
					$schema[$key]['name'] = 'expiry';
				}
			}
		}
		return $schema;
	}

	return false;
}

function fn_api_get_credit_cards()
{
	$values = fn_get_static_data_section('C', true, 'credit_card');
	$variants = array();

	foreach ($values as $k => $v) {
		$variants[] = array (
			'variant_id' => $v['param_id'],
			'variant_name' => $v['param'],
			'description' => $v['descr'],
			'position' => $v['position'],
			'display_cvv2' => $v['param_2'],
			'display_start_date' => $v['param_3'],
			'display_issue_number' => $v['param_4'],
		);
	}

	return $variants;
}

function fn_api_process_user_data($user, $response, $lang_code = CART_LANGUAGE)
{
	$user = fn_parse_api_object($user, 'users');

	$_auth = & $_SESSION['auth'];

	if (!empty($user['user_id']) && $user['user_id'] != $_auth['user_id']) {
		$response->addError('ERROR_ACCESS_DENIED', fn_get_lang_var('access_denied', $lang_code));
		$response->returnResponse();
	}

	if (empty($user['user_id'])) {
		$user['user_id'] = !empty($_auth['user_id']) ? $_auth['user_id'] : 0;
	}

	if (empty($user['user_id']) && !empty($user['password_hash'])) {
		$user['password1'] = 'tmp';
		$user['password2'] = 'tmp';
	}

	$result = fn_api_update_user($user, $_auth);

	if (!$result) {
		if (!fn_set_internal_errors($response, 'ERROR_FAIL_CREATE_USER')) {
			$response->addError('ERROR_FAIL_CREATE_USER', fn_get_lang_var('fail_create_user', $lang_code));
		}
		$response->returnResponse();
	}

	$_SESSION['cart']['user_data'] = fn_get_user_info($_auth['user_id']);

	if (!empty($user['password_hash'])) {
		db_query("UPDATE ?:users SET password = ?s WHERE user_id = ?i", $user['password_hash'], $_auth['user_id']);
	}
}

function fn_check_api_user_data($user, $location = 'C', $lang_code = CART_LANGUAGE)
{
	if (empty($user['user_id']) && empty($user['is_complete_data'])) {
		return false;
	}

	if (!empty($user['profiles'])) {
		$user = array_merge($user, current($user['profiles']));
		unset($user['profiles']);
	}

	$profile_fields = fn_get_profile_fields($location);

	$is_complete_fields =  true;

	foreach ($profile_fields as $section_fields) {
		foreach($section_fields as $k => $v) {
			if ($v['required'] == 'Y' && empty($user[$v['field_name']])) {
				$is_complete_fields =  false;
				fn_set_notification('E', fn_get_lang_var('error'), str_replace('[field]', $v['description'], fn_get_lang_var('error_twg_validator_required', $lang_code)));
			}
		}
	}

	if (!$is_complete_fields) {
		return false;
	}

	return $user;
}

function fn_api_update_user($user, &$auth, $notify_user = false)
{
	if (!$user = fn_check_api_user_data($user)) {
		return false;
	}

	if (!empty($user['user_id'])) {
		$user_data = db_get_row("SELECT * FROM ?:users WHERE user_id = ?i", $user['user_id']);
		$user_data = array_merge($user_data, $user);
	} else {
		$user['user_id'] = 0;
		$user_data = $user;
	}

	$user_data['password1'] = !empty($user_data['password1']) ? $user_data['password1'] : '';
	$result = fn_update_user($user['user_id'], $user_data, $auth, true, $notify_user);

	return $result;
}

function fn_set_internal_errors(&$response, $error_code)
{
	$notifications = fn_get_notifications();

	if (empty($notifications)) {
		return false;
	}

	$i = 1;
	foreach ($notifications as $n) {
		if ($n['type'] != 'N') {
			$response->addError($error_code . $i, $n['message']);
			$i++;
		}
	}

	if ($i > 1) {
		return true;
	}

	return false;
}

function fn_api_set_cart_user_data($user_data, $response, $lang_code = CART_LANGUAGE)
{
	$cart = & $_SESSION['cart'];
	$auth = & $_SESSION['auth'];

	// User update or registration
	$user = fn_parse_api_object($user_data, 'users');
	$user = fn_check_api_user_data($user, 'C', $lang_code);
	if (empty($user)) {
		if (!fn_set_internal_errors($response, 'ERROR_FAIL_UPDATE_USER')) {
			$response->addError('ERROR_WRONG_OBJECT_DATA', str_replace('[object]', 'user', fn_get_lang_var('wrong_api_object_data', $lang_code)));
		}
		$response->returnResponse();
	}
	$cart['user_data'] = $user;

	return true;
}

function fn_api_place_order($data, $response, $lang_code = CART_LANGUAGE)
{
	$cart = & $_SESSION['cart'];
	$auth = & $_SESSION['auth'];

	if (empty($cart)) {
		$response->addError('ERROR_ACCESS_DENIED', fn_get_lang_var('access_denied', $lang_code));
		$response->returnResponse();
	}

	if (!empty($data['user'])) {
		fn_api_set_cart_user_data($data['user'], $response, $lang_code);
	}

	if (empty($auth['user_id']) && empty($cart['user_data'])) {
		$response->addError('ERROR_ACCESS_DENIED', fn_get_lang_var('access_denied', $lang_code));
		$response->returnResponse();
	}

	if (empty($data['payment_info']) && !empty($cart['extra_payment_info'])) {
		$data['payment_info'] = $cart['extra_payment_info'];
	}

	if (!empty($data['payment_info'])) {
		$cart['payment_id'] = (int) $data['payment_info']['payment_id'];
		unset($data['payment_info']['payment_id']);

		if (!empty($data['payment_info'])) {
			$cart['payment_info'] = $data['payment_info'];
		}

		unset($cart['payment_updated']);
		fn_update_payment_surcharge($cart, $auth);

		fn_save_cart_content($cart, $auth['user_id']);
	}

	unset($cart['payment_info']['secure_card_number']);

	if (!empty($data['shippings'])) {
			if (!fn_checkout_update_shipping($cart, $data['shippings'])) {
				unset($cart['shipping']);
			}
	}

	list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($cart, $auth, 'E');

	if (empty($cart['shipping']) && $cart['shipping_failed']) {
		$response->addError('ERROR_WRONG_CHECKOUT_DATA', fn_get_lang_var('wrong_shipping_info', $lang_code));
		$response->returnResponse();
	}
	if (empty($cart['payment_info']) && empty($cart['payment_id'])) {
		$response->addError('ERROR_WRONG_CHECKOUT_DATA', fn_get_lang_var('wrong_payment_info', $lang_code));
		$response->returnResponse();
	}

	if (!empty($data['notes'])) {
		$cart['notes'] = $data['notes'];
	}

	$cart['details'] = fn_get_lang_var('twgadmin_order_via_twigmo');

	list($order_id, $process_payment) = fn_place_order($cart, $auth);

	if (empty($order_id)) {
		return false;
	}

	if ($process_payment == true) {
		$payment_info = !empty($cart['payment_info']) ? $cart['payment_info'] : array();
		fn_twg_start_payment($order_id, array(), $payment_info);
	}

/*
	if (empty($skip_payment) && $process_payment == true || (!empty($skip_payment) && empty($auth['act_as_user']))) {
	// administrator, logged in as customer can skip payment
		fn_start_payment($order_id);
	}
*/

	fn_twg_order_placement_routines($order_id);

	return $order_id;
}

function fn_api_get_order_details($order_id)
{
	$order_info = fn_get_order_info($order_id);
	if (empty($order_info) || empty($order_info['order_id'])) {
		return false;
	}

	if (!empty($order_info['items'])) {
		$order_info['products'] = array();

		foreach ($order_info['items'] as $product) {
			$order_info['products'][] = $product;
		}
		unset($order_info['items']);
	}

	$status_info = fn_get_status_data($order_info['status'], STATUSES_ORDER, $order_info['order_id'], CART_LANGUAGE);
	if (!empty($status_info['description'])) {
		$order_info['status'] = $status_info['description'];
	}

    if (isset($order_info['products']) && !empty($order_info['products'])){
        $edp_order_data = fn_get_user_edp($order_info['user_id'], $order_info['order_id']);
        foreach ($order_info['products'] as $k => $product){
            $order_info['products'][$k]['extra'] = isset($product['extra']) ? $product['extra'] : array();
            if (isset($product['extra']['is_edp']) && $product['extra']['is_edp'] == 'Y'){
                foreach ($edp_order_data as $_key => $_product){
                   if ($_product['product_id'] == $product['product_id']){
                     $order_info['products'][$k]['extra']['files'] = $_product['files'];
					 $order_info['products'][$k]['files'] = $_product['files'];
                   }
                }
            }
        }
    }
	return fn_get_as_api_object('orders', $order_info);
}

/**
 * Func copies
 */

function fn_twigmo_get_checkout_payment_buttons(&$cart, &$cart_products, &$auth)
{
	$checkout_buttons = array();

	$ug_condition = 'AND (' . fn_find_array_in_set($auth['usergroup_ids'], 'b.usergroup_ids', true) . ')';
	$checkout_payments = db_get_fields("SELECT b.payment_id FROM ?:payment_processors as a LEFT JOIN ?:payments as b ON a.processor_id = b.processor_id WHERE a.type != 'P' AND b.status = 'A' ?p", $ug_condition);

	if (!empty($checkout_payments)) {
		foreach ($checkout_payments as $_payment_id) {
			$processor_data = fn_get_processor_data($_payment_id);
			if (!empty($processor_data['processor_script']) && file_exists(DIR_PAYMENT_FILES . $processor_data['processor_script'])) {
				include(DIR_PAYMENT_FILES . $processor_data['processor_script']);
			}
		}
	}

	return $checkout_buttons;
}


function fn_twg_order_placement_routines($order_id, $force_notification = array(), $clear_cart = true, $action = '')
{
	// don't show notifications
	// only clear cart
	$order_info = fn_get_order_info($order_id, true);
	$display_notification = true;

	fn_set_hook('placement_routines', $order_id, $order_info, $force_notification, $clear_cart, $action, $display_notification);

	if (!empty($_SESSION['cart']['placement_action'])) {
		if (empty($action)) {
			$action = $_SESSION['cart']['placement_action'];
		}
		unset($_SESSION['cart']['placement_action']);
	}

	if (AREA == 'C' && !empty($order_info['user_id'])) {
		$__fake = '';
		fn_save_cart_content($__fake, $order_info['user_id']);
	}

	$edp_data = fn_generate_ekeys_for_edp(array(), $order_info);
	fn_order_notification($order_info, $edp_data, $force_notification);

	// Empty cart
	if ($clear_cart == true && (substr_count('OPT', $order_info['status']) > 0)) {
		$_SESSION['cart'] = array(
			'user_data' => !empty($_SESSION['cart']['user_data']) ? $_SESSION['cart']['user_data'] : array(),
			'profile_id' => !empty($_SESSION['cart']['profile_id']) ? $_SESSION['cart']['profile_id'] : 0,
			'user_id' => !empty($_SESSION['cart']['user_id']) ? $_SESSION['cart']['user_id'] : 0,
		);

		db_query('DELETE FROM ?:user_session_products WHERE session_id = ?s AND type = ?s', Session::get_id(), 'C');
	}

	$is_twg_hook = true;
	$_error = false;
	fn_set_hook('order_placement_routines', $order_id, $force_notification, $order_info, $_error, $is_twg_hook);

}


function fn_api_get_shippings()
{
	$_SESSION['cart']['calculate_shipping'] = true;
	list ($cart_products, $_SESSION['shipping_rates']) = fn_calculate_cart_content($_SESSION['cart'], $_SESSION['auth'], 'A', true);
	$shippings = array();

	foreach ($_SESSION['shipping_rates'] as $shipping_id => $shipping_info) {
		$shipping_info['shipping_id'] = $shipping_id;
		$shippings[] = $shipping_info;
	}

	return array($shippings, isset($_SESSION['companies_rates']) ? $_SESSION['companies_rates'] : false);
}

/**
 * Add vendors list to products search result
 * @param array $response
 * @param array $params
 * @param string $lang_code
 */
function fn_add_response_vendors(&$response, $params)
{
	if (empty($params['q'])) {
		return;
	}

	$params['q'] = trim(preg_replace('/\s+/', ' ', $params['q']));

	$all_comapnies = fn_get_companies(array('status' => 'A'), $_SESSION['auth']);

	$all_comapnies = $all_comapnies[0];
	if (empty($all_comapnies)) {
		return;
	}

	$companies = array();
	foreach ($all_comapnies as $company) {
		if (preg_match('/\b' . $company['company'] . '\b/iU', $params['q'])) {
			$logo = unserialize($company['logos']);
			if (empty($logo['Customer_logo'])) {
				$url = '';
			} else {
				$url = (defined('HTTPS') ? 'https://' . Registry::get('config.http_host') : 'http://' . Registry::get('config.https_host')) . Registry::get('config.images_path') . $logo['Customer_logo']['filename'];
			}
			$companies[] = array('company_id' => $company['company_id'], 'title' => $company['company'], 'q' => trim(preg_replace('/\b' . $company['company'] . '\b/iU', '', $params['q'])), 'icon' => array('url' => $url));
		}
	}
	$response->setMeta($companies, 'companies');
	if (empty($response->data) and $companies) {
		$response->setMeta(1, 'current_page');
	}
}


/**
 * Save vendor's rates to session
 */
function fn_twigmo_calculate_cart($cart, $cart_products, $auth, $calculate_shipping, $calculate_taxes, $apply_cart_promotions)
{
	if ((PRODUCT_TYPE == 'MULTIVENDOR' || (Registry::get('settings.Suppliers.enable_suppliers') == 'Y' && Registry::get('settings.Suppliers.display_shipping_methods_separately') === 'Y')) and ($cart['shipping_required'] == true)) {
		$companies_rates = Registry::get('view')->get_template_vars('suppliers');
		if ($companies_rates !== null) {
			$companies_rates = empty($companies_rates) ? array() : $companies_rates;
			foreach ($companies_rates as $company_id => $rate) {
				$companies_rates[$company_id]['company_id'] = $company_id;
				foreach ($rate['rates'] as $shipping_id => $shipping) {
					$companies_rates[$company_id]['rates'][$shipping_id]['shipping_id'] = $shipping_id;
					$companies_rates[$company_id]['rates'][$shipping_id]['rates'] = array();
				}
			}
			$_SESSION['companies_rates'] = $companies_rates;
		}
	}
}


/**
 * Delete vendor's rates when placing order
 */
function fn_twigmo_order_placement_routines($order_id, $force_notification, $order_info, $_error, $is_twg_hook = false)
{
	if (!empty($_SESSION['companies_rates']) and empty($_SESSION['shipping_rates']) and !isset($_SESSION['shipping_hash'])) {
		$_SESSION['companies_rates'] = array();
	}
}


/**
 * Delete vendor's rates when init user
 */
function fn_twigmo_user_init($auth, $user_info, $first_init) {
	if ($first_init and !empty($_SESSION['companies_rates'])) {
		$_SESSION['companies_rates'] = array();
	}
}


/**
 * Get order data
 */
function fn_twg_get_order_info($order_id)
{
	$object = fn_get_order_info($order_id, false, true, true);
	$object['date'] = strftime(Registry::get('settings.Appearance.date_format') . ', ' . Registry::get('settings.Appearance.time_format'), $object['timestamp']);
	$status_data = fn_get_status_data($object['status']);
	$object['status'] = empty($status_data['description']) ? '' : $status_data['description'];
	$object['items'] = array_values($object['items']);
	$object['shipping'] = array_values(isset($object['shipping']) ? $object['shipping'] : array());
	$object['taxes'] = array_values($object['taxes']);
	return $object;
}


/**
 * Return order/orders info after the order placing
 * @param int $order_id
 * @param array $response
 */
function fn_twg_return_placed_orders($order_id, &$response, $items_per_page, $lang_code)
{
	$order = fn_twg_get_order_info($order_id);

	$_error = false;

	$status = db_get_field('SELECT status FROM ?:orders WHERE order_id=?i', $order_id);

	if ($status == STATUS_PARENT_ORDER) {
		$child_orders = db_get_hash_single_array("SELECT order_id, status FROM ?:orders WHERE parent_order_id = ?i", array('order_id', 'status'), $order_id);
		$status = reset($child_orders);
		$child_orders = array_keys($child_orders);
		$order['child_orders'] = $child_orders;
	}

	if (!substr_count('OP', $status) > 0) {
		$_error = true;
		if ($status != 'B') {
			if (!empty($child_orders)) {
				array_unshift($child_orders, $order_id);
			} else {
				$child_orders = array();
				$child_orders[] = $order_id;
			}
			$_SESSION['cart'][($status == 'N' ? 'processed_order_id' : 'failed_order_id')] = $child_orders;

			$cart = &$_SESSION['cart'];
			if (!empty($cart['failed_order_id'])) {
				$_ids = !empty($cart['failed_order_id']) ? $cart['failed_order_id'] : $cart['processed_order_id'];
				$_order_id = reset($_ids);
				$_payment_info = db_get_field("SELECT data FROM ?:order_data WHERE order_id = ?i AND type = 'P'", $_order_id);
				if (!empty($_payment_info)) {
					$_payment_info = unserialize(fn_decrypt_text($_payment_info));
				}
				$_msg = !empty($_payment_info['reason_text']) ? $_payment_info['reason_text'] : '';
				$_msg .= empty($_msg) ? fn_get_lang_var('text_order_placed_error') : '';
				$response->addError('ERROR_FAIL_POST_ORDER', $_msg);
				$cart['processed_order_id'] = $cart['failed_order_id'];
				unset($cart['failed_order_id']);
			} elseif (!fn_set_internal_errors($response, 'ERROR_FAIL_POST_ORDER')) {
				$response->addError('ERROR_FAIL_POST_ORDER', fn_get_lang_var('fail_post_order', $lang_code));
			}
		} else {
			if (!fn_set_internal_errors($response, 'ERROR_ORDER_BACKORDERED')) {
				$response->addError('ERROR_ORDER_BACKORDERED', fn_get_lang_var('text_order_backordered', $lang_code));
			}
		}
		$response->returnResponse();
	}
	if (empty($order['child_orders'])) {
		$response->setData($order);
	} else {
		$params = array();
		if (empty($_SESSION['auth']['user_id'])) {
			$params['order_id'] = $_SESSION['auth']['order_ids'];
		} else {
			$params['user_id'] = $_SESSION['auth']['user_id'];
		}
		list($orders, $search, $totals) = fn_get_orders($params, $items_per_page, true);
		$response->setMeta(!empty($totals['gross_total']) ? $totals['gross_total'] : 0, 'gross_total');
		$response->setMeta(!empty($totals['totally_paid']) ? $totals['totally_paid'] : 0, 'totally_paid');
		$response->setMeta($order, 'order');
		$response->setResponseList(fn_get_orders_as_api_list($orders, $lang_code));
		fn_set_response_pagination($response);
	}
}


/**
 * Check if a user have an access to an order
 * @param array $response
 * @param array $auth
 */
function fn_twg_check_if_order_allowed($order_id, &$_auth, &$response)
{
	$allow = true;
	// If user is not logged in and trying to see the order, redirect him to login form
	if (empty($_auth['user_id']) && empty($_auth['order_ids'])) {
		$response->addError('ERROR_ACCESS_DENIED', fn_get_lang_var('access_denied'));
		$response->returnResponse();
		$allow = false;
	}

	$allowed_id = 0;

	if (!empty($_auth['user_id'])) {
		$allowed_id = db_get_field("SELECT user_id FROM ?:orders WHERE user_id = ?i AND order_id = ?i", $_auth['user_id'], $order_id);
	} elseif (!empty($_auth['order_ids'])) {
		$allowed_id = in_array($order_id, $_auth['order_ids']);
	}

	// Check order status (incompleted order)
	if (!empty($allowed_id)) {
		$status = db_get_field('SELECT status FROM ?:orders WHERE order_id = ?i', $order_id);
		if ($status == STATUS_INCOMPLETED_ORDER) {
			$allowed_id = 0;
		}
	}
	fn_set_hook('is_order_allowed', $order_id, $allowed_id);

	if (empty($allowed_id)) { // Access denied
		$response->addError('ERROR_ACCESS_DENIED', fn_get_lang_var('access_denied'));
		$response->returnResponse();
		$allow = false;
	}
	return $allow;
}


/**
 * Get blocks for the twigmo homepage
 * @param string $dispatch Dispatch of needed location
 * @param array $allowed_objects - array of blocks types
 * @return array blocks
 */
function fn_twigmo_get_blocks_for_location($dispatch, $allowed_objects)
{
	$allowed_page_types = array('T', 'L', 'F');
	$blocks = array();
	$location = Bm_Location::instance()->get($dispatch);

	if (!$location) {
		return $blocks;
	}

	$container = Bm_Container::instance()->get_list($location['location_id']);
	if (!$container or !$container['CENTRAL']) {
		return $blocks;
	}

	$grids = Bm_Grid::get_list(array($container['CENTRAL']['container_id']), array('g.*'));

	if (!$grids) {
		return $blocks;
	}

	$block_grids = Bm_Block::instance()->get_list(
		array('?:bm_snapping.*','?:bm_blocks.*', '?:bm_blocks_descriptions.*'),
		Bm_Grid::get_ids($grids)
	);

	$image_params = Registry::get('addons.twigmo.catalog_image_size');
	foreach ($block_grids as $block_grid) {
		foreach ($block_grid as $block) {
			if ($block['status'] != 'A' or !in_array($block['type'], $allowed_objects)) {
				continue;
			}

			$block_data = array('block_id' => $block['block_id'], 'title' => $block['name'], 'hide_header' => isset($block['properties']['hide_header']) ? $block['properties']['hide_header'] : 'N');
			$block_scheme = Bm_SchemesManager::get_block_scheme($block['type'], array());

			if ($block['type'] == 'html_block') {
				// Html block
				if (isset($block['content']['content']) and fn_string_not_empty($block['content']['content'])) {
					$block_data['html'] = $block['content']['content'];
				}
			} elseif (!empty($block_scheme['content']) and !empty($block_scheme['content']['items'])) {
				// Products and categories: get items
				$template_variable = 'items';
				$field = $block_scheme['content']['items'];
				fn_set_hook('render_block_content_pre', $template_variable, $field, $block_scheme, $block);
				$items = Bm_RenderManager::get_value($template_variable, $field, $block_scheme, $block);
				// Filter pages - only texts, links and forms posible
				if ($block['type'] == 'pages') {
					foreach ($items as $item_id => $item) {
						if (!in_array($item['page_type'], $allowed_page_types)) {
							unset($items[$item_id]);
						}
					}
				}
				if (empty($items)) {
					continue;
				}
				$block_data['total_items'] = count($items);
				// Images
				if ($block['type'] == 'products' or $block['type'] == 'categories') {
					$object_type = $block['type'] == 'products' ? 'product' : 'category';
					foreach ($items as $items_id => $item) {
						$main_pair = fn_get_image_pairs($item[$object_type . '_id'], $object_type, 'M', true, true);
						if (!empty($main_pair)) {
							$items[$items_id]['icon'] = fn_get_api_image_data($main_pair, $object_type, 'icon', $image_params);
						}
					}
				}
				// Banners properties
				if ($block['type'] == 'banners') {
					$rotation = $block['properties']['template'] == 'addons/banners/blocks/carousel.tpl' ? 'Y' : 'N';
					$block_data['delay'] = $rotation == 'Y' ? $block['properties']['delay'] : 0;
				}
				$block_data[$block['type']] = fn_get_as_api_list($block['type'], $items);
			}
			$blocks[$block['block_id']] = $block_data;
		}
	}
	return $blocks;
}


/**
 * Returns info for homepage
 * @param object $response
 */
function fn_twigmo_set_response_homepage($response)
{
	$home_page_content = Registry::get('addons.twigmo.home_page_content');

	if (empty($home_page_content)) {
		$home_page_content = 'random_products';
	}

	if ($home_page_content == 'home_page_blocks' or $home_page_content == 'tw_home_page_blocks') {
		// Use block manager: get blocks


		if ($home_page_content == 'home_page_blocks') {
			$location = 'index.index';
		} else {
			$location = 'twigmo.post';
		}
		$blocks = fn_twigmo_get_blocks_for_location($location, Registry::get('addons.twigmo.block_types'));
		// Return blocks
		$response->setData($blocks);
	} else {
		$block = array();
		// Random products or category products
		if ($home_page_content == 'random_products') {
			$product_ids = fn_get_random_ids(TWG_RESPONSE_ITEMS_LIMIT, 'product_id', '?:products', db_quote("status = ?s", 'A'));
			$block['title'] = 'random_products';
		} else {
			$product_ids = fn_get_category_product_ids($home_page_content, false) or array();
			$block['title'] = fn_get_category_name($home_page_content);
		}
		$block['products'] = fn_api_get_products(array('pid' => $product_ids), count($product_ids));
		$block['total_items'] = count($block['products']);
		$response->setData(array($block));
	}

}


/**
 * Hook - multi type filter - for twigmo should be text page or link
 */
function fn_twigmo_get_pages($params, $join, $condition, $fields, $group_by, $sortings, $lang_code)
{
	if (!empty($params['page_types'])) {
		$condition .= db_quote(" AND ?:pages.page_type IN (?a)", $params['page_types']);
	}
}


/**
 * Hook - as far as we use ajax requests we cant send 302 responce - will use meta redirect
 */
function fn_twigmo_redirect_complete()
{
	if (isset($_REQUEST['dispatch']) and $_REQUEST['dispatch'] == 'twigmo.post' and $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_SESSION['cache_mobile_frontend']) and $_SESSION['cache_mobile_frontend'] == 'Y') {
		fn_define('META_REDIRECT', true);
	}
}


/**
 * Prepare profile fields - delete unnecessary fields and also make arrays instead of objects to have an ability use foreach in closure templates
 */
function fn_twigmo_prepare_profile_fields($fields, $only_reguired_profile_fields)
{
	$allowed_keys = array('C', 'B', 'S');

	foreach ($fields as $key => $value) {
		if (!in_array($key, $allowed_keys)) {
			unset($fields[$key]);
			continue;
		}

		foreach ($fields[$key] as $field_key => $field) {
			if ($only_reguired_profile_fields == 'Y' and $field['required'] == 'N') {
				unset($fields[$key][$field_key]);
				continue;
			}
			if (!empty($field['values'])) {
				$values = array();
				foreach ($field['values'] as $value_id => $option_value) {
					$values[] = array('id' => $value_id, 'value' => $option_value);
				}
				$fields[$key][$field_key]['values'] = $values;
			}
		}
		$fields[$key] = array_values($fields[$key]);
		if (empty($fields[$key])) {
			unset($fields[$key]);
			continue;
		}
	}

	return $fields;
}


/**
 * If stat addon is activated - we should keep current url and description
 */
function fn_twigmo_get_banner_url($banner_id, $url)
{
	if (Registry::get('addons.statistics.status') == 'A') {
		$url = db_get_field('SELECT url FROM ?:banners WHERE banner_id=?i', $banner_id);
	}
	return $url;
}


/**
 * We should form twigmo links for internal pages
 * @param string $url
 * @param string $target
 * @param string $type
 * @param int $banner_id
 */
function fn_twigmo_get_banner_onclick($url, $target, $type, $banner_id)
{
	$onclick = '';
	if ($target == 'T' and !empty($url) and $type == 'G') {
		if (Registry::get('addons.statistics.status') == 'A') {
			$url = db_get_field('SELECT url FROM ?:banners WHERE banner_id=?i', $banner_id);
		}
		// Process SEO links
		if (Registry::get('addons.seo.status') == 'A') {
			$_SERVER['REQUEST_URI'] = $url;
			$request = array('sef_rewrite' => 1);
			fn_seo_get_route($request);
			if ($_SERVER['REQUEST_URI'] != $url) {
				$url = $_SERVER['REQUEST_URI'];
			}
		}
		// Only for internal links
		$twigmo_links = array(
									array('pattern' => '/product_id=([0-9]+)/', 'onclick' => 'addToStack(product, {id: [key]});'),
									array('pattern' => '/page_id=([0-9]+)/', 'onclick' => 'addToStack(cmsPage, {page_id: [key]});'),
									array('pattern' => '/category_id=([0-9]+)/', 'onclick' => 'addToStack(catalog, {category_id: [key]});'),
								);
		$matches = array();
		foreach ($twigmo_links as $link) {
			if (preg_match($link['pattern'], $url, $matches)) {
				$onclick = str_replace('[key]', $matches[1], $link['onclick']);
				break;
			}
		}
	}
	return $onclick;
}

/**
 * Get user info
 */
function fn_twigmo_get_user_info($user_id)
{
	$profile = array();
	if (!$user_id) {
		$profile['user_id'] = 0;
	} else {
		$profile = fn_get_user_info($user_id);
	}
	if (MODE == 'checkout') {
		$profile = array_merge($profile, $_SESSION['cart']['user_data']);
	}
	// Clear empty profile fields
	if (!empty($profile['fields'])) {
		$profile['fields'] = array_filter($profile['fields']);
	}
	$profile['ship_to_another']['profile'] = fn_check_shipping_billing($profile, fn_get_profile_fields());
	$checkout_profile_fields = fn_get_profile_fields('O');
	$profile['ship_to_another']['cart'] = (fn_check_shipping_billing($profile, $checkout_profile_fields) || !fn_compare_shipping_billing($checkout_profile_fields));
	if ($user_id){
		$profile['b_email'] = !empty($profile['b_email']) ? $profile['b_email'] : $profile['email'];
		$profile['s_email'] = !empty($profile['s_email']) ? $profile['s_email'] : $profile['email'];
	}
	return $profile;
}


/**
 * Get user info
 * @param int $page_id
 */
function fn_api_get_page($page_id)
{
	if (!$page_id) {
		return false;
	}
	$page = fn_get_page_data($page_id);
	if (!$page) {
		return false;
	}
	return fn_get_as_api_object('page', $page);
}


/**
 * Get form elements
 * @param array $elements
 */
function fn_api_get_form_elements($elements)
{
	$result = array();
	if ($elements) {
		foreach ($elements as $element) {
			$element = fn_get_as_api_object('form_element', $element);
			if (empty($element['variants'])) {
				unset($element['variants']);
			}
			$result[] = $element;
		}
	}
	return $result;
}


/**
 * Get form info
 * @param array $page_id
 */
function fn_api_get_form_info($form)
{
	if (!$form) {
		return false;
	}
	return array('sent_message' => $form['general']['L'], 'elements' => fn_api_get_form_elements($form['elements']));
}


/**
 * Get customer images path
 */
function fn_twigmo_get_images_path()
{
	$skin_path = fn_get_skin_path('[relative]', 'customer');
	return $skin_path . '/' . Registry::get('settings.skin_name_customer') . '/customer/images/';
}


/**
 * Get default logo's url for twigmo
 */
function fn_twigmo_get_defauld_logo_url()
{
	$manifest = fn_get_manifest('customer');
	return Registry::get('config.current_path') . '/' . fn_twigmo_get_images_path() . $manifest['Customer_logo']['filename'];
}


/**
 * Get favicon's url for twigmo
 */
function fn_twigmo_get_favicon_url()
{
	list($mobile_script_url,) = fn_twigmo_get_mobile_scripts_url('default');
	return Registry::get('addons.twigmo.faviconURL') ? Registry::get('addons.twigmo.faviconURL') : $mobile_script_url . '/images/apple-touch-icon.png';
}


/**
 * Check if grid belongs to twigmo location
 * @param int $grid_id
 */
function fn_is_twigmo_grid($grid_id) {
	$grid = Bm_Grid::get_by_id($grid_id);
	if (!$grid) {
		return false;
	}
	$container = Bm_Container::get_by_id($grid['container_id']);
	// Compare with twigmo location
	$twigmo_location = Bm_Location::instance()->get('twigmo.post');
	return fn_is_twigmo_location($container['location_id']);
}


/**
 * Check if it's a twigmo location
 * @param int $grid_id
 */
function fn_is_twigmo_location($location_id) {
	// Compare with twigmo location
	$twigmo_location = Bm_Location::instance()->get('twigmo.post');
	if ($twigmo_location['location_id'] and $twigmo_location['location_id'] != $location_id) {
		return false;
	}
	return true;
}


/**
 * Get external info url
 * @param string $url
 * @return string
 */
function fn_twigmo_get_external_info_url($url)
{
	$url = trim($url);
	if (!$url) {
		return '';
	}
	return (strpos($url, 'http') === 0 ? '' : 'http://') . $url;
}


/**
 * Get available product sortings
 * @return array - [sort_label, sort_order, sort_by]
 */
function fn_twigmo_get_sortings()
{
	$sortings = fn_get_products_sorting(false);
	$sorting_orders = fn_get_products_sorting_orders();
	$avail_sorting = Registry::get('settings.Appearance.available_product_list_sortings');
	$default_products_sorting = fn_get_default_products_sorting();

	$result = array($default_products_sorting);
	$result[0]['sort_label'] = fn_get_lang_var('sort_by_' . $default_products_sorting['sort_by'] . '_' . $default_products_sorting['sort_order']);

	// Reverse sorting (for usage in view)
	$default_products_sorting['sort_order'] = ($default_products_sorting['sort_order'] == 'asc') ? 'desc' : 'asc';
	foreach ($sortings as $option => $value) {
		if ($default_products_sorting['sort_by'] == $option) {
			$sort_order = $default_products_sorting['sort_order'];
		} else {
			if ($value['default_order']) {
				$sort_order = $value['default_order'];
			} else {
				$sort_order = 'asc';
			}
		}
		foreach ($sorting_orders as $sort_order) {
			if ($default_products_sorting['sort_by'] != $option or $default_products_sorting['sort_order'] == $sort_order) {
				if (!$avail_sorting or !empty($avail_sorting[$option . '-' . $sort_order]) and $avail_sorting[$option . '-' . $sort_order] == 'Y') {
					$result[] = array('sort_by' => $option, 'sort_order' => $sort_order, 'sort_label' => fn_get_lang_var('sort_by_' . $option . '_' . $sort_order));
				}
			}
		}
	}
	return $result;
}


function fn_twg_get_feature_value($value, $feature_type, $value_int, $variant_id, $variants)
{
	if ($feature_type == "D") {
		$value = fn_date_format($value_int, REGISTRY::get('settings.Appearance.date_format'));
	} elseif ($feature_type == "M") {
		$value = array();
		foreach ($variants as $variant) {
			if ($variant['selected']) {
				$value[] = $variant['variant'];
			}
		}
	} elseif ($value_int) {
		$value = $value_int;
	} elseif ($variant_id) {
		$value = $variants[$variant_id]['variant'];
	}
	return $value;
}


/**
 * Prepare all settings, wich should be passed to js
 */
function fn_twigmo_get_all_settings()
{
	$settings = array();

	$settings['currency'] = Registry::get('currencies.' . CART_SECONDARY_CURRENCY);

	$addon_settings = Registry::get('addons.twigmo');

	$settings['logoURL'] = empty($addon_settings['logoURL']) ? fn_twigmo_get_defauld_logo_url() : $addon_settings['logoURL'];
	if (defined('HTTPS')) {
		$settings['logoURL'] = str_replace('http://', 'https://', $settings['logoURL']);
	}
	$settings['selected_skin'] = empty($addon_settings['selected_skin']) ?  'default' : $addon_settings['selected_skin'];
	$settings['url_for_facebook'] = isset($addon_settings['url_for_facebook']) ? fn_twigmo_get_external_info_url($addon_settings['url_for_facebook']) : '';
	$settings['url_for_twitter'] = isset($addon_settings['url_for_twitter']) ? fn_twigmo_get_external_info_url($addon_settings['url_for_twitter']) : '';
	$settings['httpLocation'] = 'http://' . Registry::get('config.http_host') . Registry::get('config.http_path') . '/';
	$settings['httpsLocation'] = 'https://' . Registry::get('config.https_host') . Registry::get('config.https_path') . '/';

	$settings['requestUrl'] = '';
	$settings['customerIndex'] = INDEX_SCRIPT;
	$settings['request'] = $_REQUEST;

	$settings['cacheLifeTime'] = 0;

	$settings['theme'] = array("header_theme" => "b", "footer_theme" => "a", "data_theme" => "c", "background_theme" => "b", "button_theme" => "c", "header_button_theme" => "a", "navigation_button_theme" => "a", "data_count_theme" => "e", "data_divider_theme" => "d");

	$needed_langvars = array('view_cart', 'select_country', 'text_cart_min_qty', 'checkout_terms_n_conditions_alert', 'checkout_terms_n_conditions', 'text_min_order_amount_required', 'text_min_products_amount_required', 'or_use', 'gift_certificate', 'account_name', 'contact_information', 'apply_for_vendor_account', 'language', 'coupon', 'promo_code_or_certificate', 'promo_code', 'error_validator_message', 'features', 'submit', 'select_state', 'product_coming_soon', 'product_coming_soon_add', 'text_qty_discounts', 'order', 'text_no_matching_results_found', 'order_info', 'is_logged_in', 'text_fill_the_mandatory_fields', 'product_added_to_cart', 'cart_contents', 'billing_shipping_address', 'shipping_method', 'payment_method', 'error_passwords_dont_match', 'text_no_shipping_methods', 'cannot_proccess_checkout_without_payment_methods', 'text_no_orders', 'contact_us_for_price', 'text_email_sent', 'free', 'no', 'tax_exempt', 'shipping', 'order_discount', 'included', 'including_discount', 'summary', 'text_login_to_add_to_cart', 'payment_surcharge', 'review_and_place_order', 'place_order', 'text_profile_is_created', 'yes', 'user_account_info', 'payment_options', 'text_out_of_stock', 'add_to_cart', 'back', 'checkout', 'checkout_as_guest', 'continue', 'sign_in', 'sign_out', 'register', 'update_profile', 'text_order_backordered', 'address', 'address_2', 'billing_address', 'billing_address', 'date_of_birth', 'credit_card', 'card_name', 'card_number', 'cardholder_name', 'discount', 'cart_is_empty', 'subtotal', 'tax', 'total', 'city', 'company', 'confirm_password', 'contact_info', 'country', 'country', 'date', 'details', 'discount', 'email', 'fax', 'first_name', 'free_shipping', 'in_stock', 'address', 'last_name', 'notes', 'order_id', 'orders', 'vendor', 'password', 'payment_method', 'payment_information', 'payment_method', 'phone', 'price', 'product', 'quantity', 'sku', 'description', 'options', 'products', 'search', 'shipping_address', 'shipping_address', 'shipping_cost', 'shipping_method', 'shipping_methods', 'status', 'subtotal', 'tax', 'taxes', 'title', 'total', 'url', 'username', 'zip_postal_code', 'cart', 'catalog', 'home', 'profile', 'search', 'loading', 'update_profile_notification', 'files');

	$settings['lang'] = fn_twigmo_get_customer_lang_vars();

	foreach($needed_langvars as $needed_langvar) {
		$settings['lang'][$needed_langvar] = fn_get_lang_var($needed_langvar);
	}

	// Countries/states
	$settings = array_merge($settings, fn_get_as_api_list('countries', fn_get_countries(CART_LANGUAGE, true)));
	$states = fn_get_all_states();
	// Unset country_code field
	foreach ($states as $country_id => $country) {
		foreach ($country as $state_id => $state) {
			unset($states[$country_id][$state_id]['country_code']);
		}
	}
	$settings['states'] = $states;

	// Info pages
	$pages = fn_twigmo_get_blocks_for_location('twigmo.post', array('pages'));
	$settings['info_pages'] = array();
	foreach ($pages as $page) {
		$settings['info_pages'] = array_merge($settings['info_pages'], $page['pages']['page']);
	}
	// If page link begin with # then interpret this link as twigmo page
	foreach ($settings['info_pages'] as $k => $page) {
		if (preg_match('/^\#.*$/', $page['link'])) {
			$settings['info_pages'][$k]['twigmo_page'] = substr($page['link'], 1);
		}
	}

	$only_req_profile_fields = isset($addon_settings['only_req_profile_fields']) ? $addon_settings['only_req_profile_fields']  : 'N';
	$settings['profileFields'] = fn_twigmo_prepare_profile_fields(fn_get_profile_fields(), $only_req_profile_fields);
	$settings['profileFieldsCheckout'] = fn_twigmo_prepare_profile_fields(fn_get_profile_fields('O'), $only_req_profile_fields);

	$settings['titles'] = array_values(fn_get_static_data_section('T'));

	$settings['profile'] = fn_twigmo_get_user_info($_SESSION['auth']['user_id']);

	$settings['use_email_as_login'] = Registry::get('settings.General.use_email_as_login');

	$settings['cart'] = fn_api_get_session_cart();

	$settings['sortings'] = fn_twigmo_get_sortings();

	$settings['allow_negative_amount'] = Registry::get('settings.General.allow_negative_amount');
	$settings['inventory_tracking'] = Registry::get('settings.General.inventory_tracking');
	$settings['default_location'] = array('country' => Registry::get('settings.General.default_country'), 'state' => Registry::get('settings.General.default_state'));
	$settings['allow_anonymous_shopping'] = Registry::get('settings.General.allow_anonymous_shopping');
	$settings['disable_anonymous_checkout'] = Registry::get('settings.General.disable_anonymous_checkout');
	$settings['cart_prices_w_taxes'] = Registry::get('settings.Appearance.cart_prices_w_taxes');
	$settings['tax_calculation'] = Registry::get('settings.General.tax_calculation');
	$settings['display_supplier'] = Registry::get('settings.Suppliers.display_supplier');
	$settings['security_hash'] = fn_generate_security_hash();
	$controller = $addon_settings['home_page_content'] == 'home_page_blocks' ? 'index.index' : 'twigmo.post';
	$settings['home_page_title'] = fn_twigmo_get_location_page_title($controller);
	$settings['companyName'] = Registry::get('settings.Company.company_name');
	$settings['no_image_path'] = Registry::get('config.no_image_path');
	$settings['geolocation'] = isset($addon_settings['geolocation']) ? $addon_settings['geolocation'] : 'Y';
	$settings['productType'] = PRODUCT_TYPE;
	$settings['vendorProfileFields'] = $settings['profileFields'];
	$settings['suppliers_vendor'] = Registry::get('settings.Suppliers.apply_for_vendor');
	$settings['languages'] = array_values(fn_get_languages());
	$settings['cart_language'] = CART_LANGUAGE;
	$settings['min_order_amount'] = Registry::get('settings.General.min_order_amount');
	$settings['min_order_amount_type'] = Registry::get('settings.General.min_order_amount_type');
	$settings['address_position'] = Registry::get('settings.General.address_position');
	$settings['agree_terms_conditions'] = Registry::get('settings.General.agree_terms_conditions');
	return $settings;
}

/**
 * Get blocks from central container
 * @param string $controller - controller.method
 * @return array ([block_id] => block_name)
 */
function fn_twigmo_get_location_page_title($controller = 'twigmo.post'){
	$location = Bm_Location::instance()->get($controller);
	return $location['title'];
}

/**
 * Get text from skins.js config file
 * @param array $params 'skins_data_url', 'version' e.g. '2.3'
 * @return string
 */
function fn_twigmo_get_skins_data($params)
{
	$skins_data_url = (!empty($params['skins_data_url']) ? $params['skins_data_url'] : TWIGMO_SKINS_CONFIG_URL). $params['version'] .'/skins.js';
	$text =  @file_get_contents ($skins_data_url);
	return $text;
}

/**
 * Parse skins config file text
 * @param string $text
 * @return array
 */
function fn_twigmo_parse_skins_data($text)
{
	if (empty($text)){
		return array();
	}
	$css_file_name_mapping = array('default' => 'basic');
	$css_file_prefix = 'custom_';
	$_text = explode("=", $text);
	$css_files = $__text = array();
	foreach ($_text as $row) {
		$__text[] = str_replace(array(' ', "\n", "\t", ";", "{", "}"), '', $row);
	}
	foreach ($__text as $index => $row) { // Get number of row, which contained skins data
		if (preg_match('/^default:/', $row)){
			break;
		}
	}
	$__skins = explode(',', $__text[$index]);
	foreach ($__skins as $_skin) {
		$skin = explode(':', $_skin);
		if (in_array($skin[0], array_keys($css_file_name_mapping))) {
		   $skin_code = $css_file_name_mapping[$skin[0]];
		} else {
		   $skin_code = $skin[0];
		}
		$css_files[] = $css_file_prefix.$skin_code.'.css';
	}
	return $css_files;
}

function fn_twigmo_get_block($params)
{
	if (!empty($params['block_id'])) {
		$key_map = array('products' => 'product_id',
										 'categories' => 'category_id');
		$key = $key_map[$_REQUEST['object']];
		$block_id =  $params['block_id'];
		$snapping_id = !empty($params['snapping_id']) ? $params['snapping_id'] : 0;

		$dispatch = isset($_REQUEST['object']) ? $_REQUEST['object'] . '.view' : 'index.index';

		$area = !empty($params['area']) ?  $params['area'] : AREA;

		if (!empty($params['dynamic_object'])) {
			$dynamic_object = $params['dynamic_object'];
		} elseif (!empty($_REQUEST['dynamic_object']) && $area != 'C') {
			$dynamic_object = $_REQUEST['dynamic_object'];
		} else {
				$dynamic_object_scheme = Bm_SchemesManager::get_dynamic_object($dispatch, $area);
				$twg_request = array('dispatch' => $dispatch,
												      $dynamic_object_scheme['key'] => $_REQUEST['id']);
			if (!empty($dynamic_object_scheme) && !empty($twg_request[$dynamic_object_scheme['key']])) {

				$dynamic_object['object_type'] = $dynamic_object_scheme['object_type'];
				$dynamic_object['object_id'] = $twg_request[$dynamic_object_scheme['key']];
			} else {
				$dynamic_object = array();
			}
		}
		$block = Bm_Block::instance()->get_by_id($block_id, $snapping_id, $dynamic_object, DESCR_SL);
		return $block;
	}
}
?>
