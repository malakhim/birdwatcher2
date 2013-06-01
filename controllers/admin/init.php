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

$view->assign('descr_sl', DESCR_SL);

$view->assign('index_script', $index_script);
$view_mail->assign('index_script', $index_script);

if (!empty($auth['user_id']) && $auth['area'] != AREA) {
	$auth = array();
	return array(CONTROLLER_STATUS_REDIRECT, $index_script);
}

if (empty($auth['user_id']) && !fn_check_permissions(CONTROLLER, MODE, 'trusted_controllers')) {
	if (CONTROLLER != 'index') {
		fn_set_notification('E', fn_get_lang_var('access_denied'), fn_get_lang_var('error_not_logged'));
		
		if (defined('AJAX_REQUEST')) {
			$ajax->assign('force_redirection', "auth.login_form?return_url=" . !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : urlencode(Registry::get('config.current_url')));
			exit;
		}
	}
	return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
} elseif (!empty($auth['user_id']) && !fn_check_user_type_access_rules($auth)) {
	fn_set_notification('E', fn_get_lang_var('error'), fn_get_lang_var('error_area_access_denied'));

	return array(CONTROLLER_STATUS_DENIED);
} elseif (!empty($auth['user_id']) && !fn_check_permissions(CONTROLLER, MODE, 'trusted_controllers') && $_SERVER['REQUEST_METHOD'] != 'POST') {
	// PCI DSS Compliance
	$auth['password_change_timestamp'] = !empty($auth['password_change_timestamp']) ? $auth['password_change_timestamp'] : 0;
	$time_diff = TIME - $auth['password_change_timestamp'];
	$expire = Registry::get('settings.Security.admin_password_expiration_period') * SECONDS_IN_DAY;

	if (!isset($auth['first_expire_check'])) {
		$auth['first_expire_check'] = true;
	}

	// We do not need to change the timestamp if this is an Ajax requests
	if (!defined('AJAX_REQUEST')) {
		$_SESSION['auth_timestamp'] = !isset($_SESSION['auth_timestamp']) ? 0 : ++$_SESSION['auth_timestamp'];
	}
	
	// Make user change the password if:
	// - password has expired
	// - this is the first admin's login and change_admin_password_on_first_login is enabled 
	// - this is the first vendor admin's login
	if (($auth['password_change_timestamp'] <= 1 && ((Registry::get('settings.Security.change_admin_password_on_first_login') == 'Y') || (!empty($auth['company_id']) && empty($auth['password_change_timestamp'])))) || ($expire && $time_diff >= $expire)) {

		$_SESSION['auth']['forced_password_change'] = true;
		
		if ($auth['first_expire_check']) {
			// we can redirect only on first check, else we can corrupt some admin's working processes ( such as ajax requests
			fn_delete_notification('insecure_password');
			$return_url = !empty($_REQUEST['return_url']) ? $_REQUEST['return_url'] : Registry::get('config.current_url');
			return array(CONTROLLER_STATUS_REDIRECT, "auth.password_change?return_url=" . urlencode($return_url));
		} else {
			if (!fn_notification_exists('E', 'password_expire')) {
				fn_set_notification('E', fn_get_lang_var('warning'), str_replace('[link]', fn_url('profiles.update', 'A'), fn_get_lang_var('error_password_expired_change')), "S", 'password_expire');
			}
		}
	} else {
		$auth['first_expire_check'] = false;
	}
}
	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (strpos(MODE, 'update') !== false && !fn_notification_exists('W', 'demo_mode')) {
		if (isset($_REQUEST['translation_mode'])) {
			Registry::set('settings.translation_mode', 'N');
		}
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_changes_saved'), 'I', 'changes_saved');
	}
	

	
	return;
}


$schema = fn_get_schema('last_edited_items', 'schema_general', 'php', false);
if (isset($schema['edit_action']) && $schema['edit_action']) {
	Registry::get('view')->assign('data', $schema['data']);
}


// Get base menu
$menues = fn_get_schema('menu', 'menu', 'xml');

if (fn_check_suppliers_functionality() || PRODUCT_TYPE == 'ULTIMATE') {
	if (PRODUCT_TYPE == 'MULTIVENDOR') {
		$menues .= fn_get_schema('menu', 'menu_mve', 'xml');
	} elseif (PRODUCT_TYPE == 'ULTIMATE') {
		$menues .= fn_get_schema('menu', 'menu_ult', 'xml');

		if (Registry::get('config.tweaks.disable_localizations') == true) {
			$menues = preg_replace("/<item\s(group|title)=\"localizations.*?>/s", '', $menues);
		}
	} elseif (PRODUCT_TYPE == 'PROFESSIONAL' || PRODUCT_TYPE == 'COMMUNITY') {
		$menues .= fn_get_schema('menu', 'menu_standard', 'xml');
	}
}

fn_set_hook('load_xml_menues', $menues);

$xml = simplexml_load_string('<menu>' . $menues . '</menu>');

Registry::set('navigation', array(
	'static' => array(),
	'dynamic' => array(),
	'selected_tab' => NULL,
	'subsection' => NULL
));

// generate top tabbed menu from .xml files
// we get active tab in four ways:
// 1) we search xml item with attr 'dispatch' = current_controller . current_mode
// if no success:
// 2) we search xml item with attr 'dispatch' = current_controller . * (any_mode)
// if no success:
// 3) we search sidebox xml item with attr 'href' = current_url, and its parents are used as active tabs
// if no success:
// 4) we remove last parameter from current_url and we try 3rd way again with shortened url

$navigation = Registry::get('navigation');

$_cache = array();
$_dispatch = CONTROLLER . '.' . MODE;

$tab_selected = false;
$groups = array();
$is = array();
define('MAX_POSITION', 1000000);

// Get static section
foreach ($xml as $root => $item) {
	if (!empty($item['edition_type']) && !fn_check_edition_permissions((string)$item['edition_type'])) {
		continue;
	}

	if (!isset($navigation['static'][$root])) {
		$navigation['static'][$root] = array();
	}
	$_cache[] = $root;
	
	if (!isset($is[$root])) {
		$is[$root] = 0;
	}
	foreach ($item->item as $it) {
		$_cache[] = (string)$it['title'];
		$_cache[] = (string)$it['title'] . '_menu_description';
		
		if ((string)$it['title'] == 'products') {
			// Get the settings_id value
			$setting_id = substr(fn_crc32((string)$it['dispatch']), 5);
			Registry::set('config.links_menu', CSettings::instance()->get_description($setting_id, CSettings::SETTING_DESCRIPTION));
		}

		if (!empty($it['edition_type'])) {
			if (!fn_check_edition_permissions((string)$it['edition_type'])) {
				continue;
			}
		}
		

		if (fn_check_view_permissions($it['dispatch'], 'GET', (!empty($it['extra']) ? (string) $it['extra'] : '')) == false) {
			continue;
		}

		if (isset($it['active_option'])) {
			$_op = Registry::get((string)$it['active_option']);
			if (empty($_op) || $_op === 'N') {
				continue;
			}
		}

		$is[$root] = ($is[$root] >= MAX_POSITION)? $is[$root] + 100 : MAX_POSITION;

		$navigation['static'][$root][(string)$it['title']] = array(
			'href' =>  (string)$it['dispatch'] . (!empty($it['extra']) ? '?' . (string)$it['extra'] : ''),
			'position' => isset($it['position']) ? (int)$it['position'] : $is[$root],
			'description' => (string)$it['title'] . '_menu_description',
		);

		// 0 way
		if (isset($it['children_dispatch']) && $_dispatch == (string)$it['children_dispatch']) {
			if (empty($it['children_extra']) || (strpos(Registry::get('config.current_url'), (string)$it['children_extra']) !== false)) {
				$navigation['selected_tab'] = $root;
				$navigation['subsection'] = (string)$it['title'];
				$tab_selected = true;
			}
		}

		// 1st way
		if ($_dispatch == (string)$it['dispatch']) {
			if (empty($it['extra']) || (strpos(Registry::get('config.current_url'), (string)$it['extra']) !== false)) {
				$navigation['selected_tab'] = $root;
				$navigation['subsection'] = (string)$it['title'];
				$tab_selected = true;
			}
		}

		// 1st A way
		if (!empty($it['alt'])) {
			$alt = fn_explode(',', (string)$it['alt']);
			foreach ($alt as $v) {
				@list($_d, $_m) = fn_explode('.', $v);
				if (((!empty($_m) && MODE == $_m) || empty($_m)) && CONTROLLER == $_d) {
					$navigation['selected_tab'] = $root;
					$navigation['subsection'] = (string)$it['title'];
					$tab_selected = true;
					break;
				}
			}
		}

		// 2nd way
		if (empty($tab_selected) && strpos((string)$it['dispatch'], CONTROLLER . (strpos((string)$it['dispatch'], '.') ? '.' : '')) === 0) {
			$navigation['selected_tab'] = $root;
			$navigation['subsection'] = (string)$it['title'];
			$tab_selected = true;
		}
	}
}
//Get subitems for static items
foreach ($xml as $root => $item) {
	if (count($item->subitem) == 0) {
		continue;
	}

	foreach ($item->subitem as $subit) {
		$_href = str_replace('%INDEX_SCRIPT', $index_script, (string)$subit['href']);
		if (fn_check_view_permissions($_href, 'GET')) {
			if (isset($navigation['static'][$root][(string)$subit['item']])) {
				$navigation['static'][$root][(string)$subit['item']]['subitems'][(string)$subit['title']] = array(
					'href' => $_href,
				);
			}

			if (strpos(Registry::get('config.current_url'), $_href) !== false) {
				$navigation['subitem'] = (string)$subit['title'];
			}
		}
	}
}

$navigation['static'] = fn_sort_menu($navigation['static']);

if (fn_check_view_permissions('settings.manage', 'GET')) {
	//Get navigation for Settings section
	$navigation['static']['settings'] = CSettings::instance()->get_core_sections();

	// 5nd way for Settings section
	if (CONTROLLER == 'settings' && !empty($_REQUEST['section_id'])) {
		foreach ($navigation['static']['settings'] as &$item) {
			if ($item['section_id'] == $_REQUEST['section_id']) {
				$navigation['selected_tab'] = 'settings';
				$navigation['subsection'] = $item['section_id'];
			}
		}
	}
}
// Unset empty sections
foreach ($navigation['static'] as $root => $data) {
	if (empty($navigation['static'][$root])) {
		unset($navigation['static'][$root]);
	}
}

// 3rd way
if (empty($tab_selected)) {
	// search current link by href
	$_data = $xml->xpath('//item[@href=\'' . Registry::get('config.current_url') . '\']');
	$active = !empty($_data) ? array_shift($_data) : false;

	// 4th way
	if (!$active) {
		if ($p = strpos(Registry::get('config.current_url'), '&')) {
			$shortened_href = substr(Registry::get('config.current_url'), 0, $p);
			$_data = $xml->xpath('//item[@href=\'' . $shortened_href . '\']');
			$active = !empty($_data) ? array_shift($_data) : false;
		}
	}

	if ($active) {
		$_data = $xml->xpath("//item[@dispatch='{$active['@attributes']['group']}']/..");
		$node = !empty($_data) ? array_shift($_data) : false;

		if ($node) {
			$active_root = $node->getName();
			$navigation['selected_tab'] = $active_root;
			$tab_selected = true;
		}

		$node = (array)array_shift($xml->xpath("//item[@dispatch='{$active['@attributes']['group']}']"));
		if ($node) {
			$navigation['subsection'] = $node['@attributes']['title'];
		}
	}
}

// Get dynamic section
$actions = (array)$xml->xpath("//item[@group='$_dispatch']");
$actions = fn_array_merge($actions, (array)$xml->xpath('//item[@group=\'' . CONTROLLER . '\']'), false);


// prepare context variables for replacement (we replace %USER_ID in xml to current user id, etc)
$context_vars = array();
foreach ($_REQUEST as $var_name => $var_value) {
	$context_vars['%' . strtoupper($var_name)] = $var_value;
}

$context_vars['%CONTROLLER'] = CONTROLLER;
$context_vars['%MODE'] = MODE;
$context_vars['%INDEX_SCRIPT'] = $index_script;

foreach ($actions as $item) {
	if (!empty($item)) {
		if (!empty($item['edition_type'])) {
			if (!fn_check_edition_permissions((string)$item['edition_type'])) {
				continue;
			}
		}
	}

	if (empty($item) || !empty($item['extra']) && strpos(Registry::get('config.current_url'), (string)$item['extra']) === false) {
		continue;
	}

	$_cache[] = (string)$item['title'];
	$navigation['dynamic']['actions'][(string)$item['title']]  = array (
		'href' => strtr((string)$item['href'], $context_vars),
		'meta' => (!empty($item['meta']) ? (string)$item['meta'] : ''),
		'target' => (!empty($item['target']) ? (string)$item['target'] : '')
	);
}

fn_set_hook('process_navigation', $navigation);
Registry::set('navigation', $navigation);

fn_preload_lang_vars($_cache);

// Navigation is passed in view->display method to allow its modification in controllers

$view->assign('quick_menu', fn_get_quick_menu_data());

$schema = fn_get_schema('last_edited_items', 'schema');
$last_items_cnt = LAST_EDITED_ITEMS_COUNT;

if (empty($_SESSION['last_edited_items'])) {
	$stored_items = fn_get_user_additional_data('L');
	$last_edited_items = empty($stored_items) ? array() : $stored_items;
	$_SESSION['last_edited_items'] = $last_edited_items;
} else {
	$last_edited_items = $_SESSION['last_edited_items'];
}

$last_items = array();
foreach ($last_edited_items as $_k => $v) {
	if (!empty($v['func'])) {
		$func = array_shift($v['func']);
		if (function_exists($func)) {
			$content = call_user_func_array($func, $v['func']);
			if (!empty($content)) {
				$name = (empty($v['text']) ? '' : fn_get_lang_var($v['text']) . ': ') . $content;
				array_unshift($last_items, array('name' => $name, 'url' => $v['url'], 'icon' => $v['icon']));
			} else {
				unset($last_edited_items[$_k]);
			}
		} else {
			unset($last_edited_items[$_k]);
		}
	} else {
		array_unshift($last_items, array('name' => fn_get_lang_var($v['text']), 'url' => $v['url'], 'icon' => $v['icon']));
	}
}

$view->assign('last_edited_items', $last_items);
Registry::set('config.links_menu', (array) $actions);

if (!empty($schema[CONTROLLER . '.' . MODE])) {
	$items_schema = $schema[CONTROLLER . '.' . MODE];
	if (empty($items_schema['func'])) {
		$c_elm = '';
	} else {
		$c_elm = $items_schema['func'];
		foreach ($c_elm as $k => $v) {
			if (strpos($v, '@') !== false) {
				$ind = str_replace('@', '', $v);
				if (!empty($auth[$ind]) || !empty($_REQUEST[$ind])) {
					$c_elm[$k] = ($ind == 'user_id' && empty($_REQUEST[$ind])) ? $auth[$ind] : $_REQUEST[$ind];
				}
			}
		}
	}

	$url = Registry::get('config.current_url');



	$last_item = array('func' => $c_elm, 'url' => $url, 'icon' => (empty($items_schema['icon']) ? '' : $items_schema['icon']), 'text' => (empty($items_schema['text']) ? '' : $items_schema['text']));
	$hash = fn_crc32(!empty($c_elm) ? implode('', $c_elm) : $items_schema['text']);

	if (!isset($last_edited_items[$hash])) {
		$last_edited_items[$hash] = $last_item;
	}

	if (count($last_edited_items) > $last_items_cnt) {
		foreach ($last_edited_items as $k => $v) {
			unset($last_edited_items[$k]);
			break;
		}
	}

	$_SESSION['last_edited_items'] = $last_edited_items;
	fn_save_user_additional_data('L', $last_edited_items);
}

if (empty($auth['company_id']) && !empty($auth['user_id']) && $auth['area'] == AREA && $auth['is_root']) {
	$messages = fn_get_storage_data('hd_messages');
	if (!empty($messages)) {
		$messages = unserialize($messages);
		foreach ($messages as $message) {
			fn_set_notification($message['type'], $message['title'], $message['text']);
		}
		
		fn_set_storage_data('hd_messages', '');
	}
}

function fn_sort_menu($menu)
{
	foreach ($menu as $root => $data) {

		$menu[$root] = fn_sort_array_by_key($menu[$root], 'position', SORT_ASC);

	}

	return $menu;
}

?>