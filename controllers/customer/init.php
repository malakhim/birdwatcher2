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



$view->assign('index_script', $index_script);
$view_mail->assign('index_script', $index_script);

// Level for block cache: different for locallizations-user-language-currency-promotion
$promotion_condition =  (!empty($_SESSION['auth']['user_id']) && db_get_field("SELECT count(*) FROM ?:promotions WHERE status = 'A' AND zone = 'catalog' AND users_conditions_hash LIKE ?l", "%," . $_SESSION['auth']['user_id'] . ",%") > 0)? $_SESSION['auth']['user_id'] : '';
define('CACHE_LEVEL_HTML_BLOCKS', (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '__') : '') . CART_LANGUAGE . '__' . CACHE_LEVEL_DAY . '__' . (!empty($_SESSION['auth']['usergroup_ids']) ? implode('_', $_SESSION['auth']['usergroup_ids']) : '') . '__' . $promotion_condition);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	return;
}

//
// Check if store is closed
//
if (Registry::get('settings.store_mode') == 'closed') {
	if (!empty($_REQUEST['store_access_key'])) {
		$_SESSION['store_access_key'] = $_GET['store_access_key'];
	}

	if (empty($_SESSION['store_access_key']) || $_SESSION['store_access_key'] != Registry::get('settings.General.store_access_key')) {
		return array(CONTROLLER_STATUS_REDIRECT, Registry::get('config.current_location') . '/store_closed.html');
	}
}

if (empty($_REQUEST['product_id']) && empty($_REQUEST['category_id'])) {
	unset($_SESSION['current_category_id']);
}

fn_add_breadcrumb(fn_get_lang_var('home'), $index_script);

$request_params = $_REQUEST;
$dynamic_object = array();
if (!empty($_REQUEST['dynamic_object'])) {
	$dynamic_object = $_REQUEST['dynamic_object'];
}
$view->assign('location_data', Bm_Location::instance()->get($_REQUEST['dispatch'], $dynamic_object, DESCR_SL));

// Init cart if not set
if (empty($_SESSION['cart'])) {
	fn_clear_cart($_SESSION['cart']);
}

// Init cart products to prevent access without initialization
if (!isset($_SESSION['cart']['products'])) {
	$_SESSION['cart']['products'] = array();
}

if (!empty($_SESSION['continue_url'])) {
	$_SESSION['continue_url'] = fn_query_remove($_SESSION['continue_url'], 'is_ajax', 'result_ids', 'full_render');
}

/**
 * Form top menu
 *
 * @param array $top_menu top menu data from the database
 * @return array formed top menu
 */
function fn_top_menu_form($top_menu, $level = 0, &$active = NULL, &$active_level = NULL)
{
	$_active = false;
	foreach ($top_menu as $k => $v) {
		if (!empty($v['param_3'])) { // get extra items
			list($type, $id, $use_name) = fn_explode(':', $v['param_3']);
			if ($type == 'C') { // categories
				$cats = fn_get_categories_tree($id, true);
				$v['subitems'] = fn_array_merge(fn_top_menu_standardize($cats, 'category_id', 'category', 'subcategories', 'categories.view?category_id=', $v['param_4']), !empty($v['subitems']) ? $v['subitems'] : array(), false);

				if ($use_name == 'Y' && !empty($id)) {
					$v['descr'] = fn_get_category_name($id);
					$v['param'] = 'categories.view?category_id=' . $id;
				}
			} elseif ($type == 'A') { // pages
				$params = array(
					'from_page_id' => $id,
					'get_tree' => 'multi_level',
					'status' => 'A'
				);
				list($pages) = fn_get_pages($params);

				$v['subitems'] = fn_array_merge(fn_top_menu_standardize($pages, 'page_id', 'page', 'subpages', 'pages.view?page_id=', $v['param_4']), !empty($v['subitems']) ? $v['subitems'] : array(), false);

				if ($use_name == 'Y' && !empty($id)) {
					$page_data = fn_get_page_data($id);
					$v['descr'] = $page_data['page'];
					$v['param'] = !empty($page_data['link']) ? $page_data['link'] : ('pages.view?page_id=' . $id);
				}
			} else { // for addons
				fn_set_hook('top_menu_form', $v, $type, $id, $use_name);
			}
		}
		
		if (!empty($v['param']) && fn_is_current_url($v['param'], $v['param_2'])) {
			$top_menu[$k]['active'] = true;
			// Store active value
			$_active = true;
		}

		if (!empty($v['subitems'])) {
			$top_menu[$k]['subitems'] = fn_top_menu_form($v['subitems'], $level + 1, $active, $active_level);

			// If active status was returned fron children
			if ($active) {
				$top_menu[$k]['active'] = $active;
				// Strore fo return and reset activity status for athother elements on this level
				// Because in one level may be only one active item
				$_active = true;
				$active = false;
			}
		}

		$top_menu[$k]['item'] = $v['descr'];
		$top_menu[$k]['href'] = $v['param'];
		$top_menu[$k]['level'] = $level;

		unset($top_menu[$k]['descr'], $top_menu[$k]['param']);
	}
	
	$active = $_active;

	return $top_menu;
}

/**
 * This function is deprecated and no longer used.
 * Its reference is kept to avoid fatal error occurances.
 * 
 * @deprecated deprecated since version 3.0
 */
function fn_top_menu_select($top_menu, $controller, $mode, $current_url, &$child_key = NULL)
{
	fn_generate_deprecated_function_notice('fn_top_menu_select()', '');
	return array();
}

/**
 * Standardize data for usage in top menu
 *
 * @param array $items data to standartize
 * @param string $id_name key with item ID
 * @param string $name key with item name
 * @param string $children_name key with subitems
 * @param string $href_prefix URL prefix
 * @return array standardized data
 */
function fn_top_menu_standardize($items, $id_name, $name, $children_name, $href_prefix, $dir)
{
	$result = array();
	foreach ($items as $v) {
		$result[$v[$id_name]] = array(
			'descr' => $v[$name],
			'param' => empty($v['link']) ? $href_prefix . $v[$id_name] : $v['link'],
			'param_4' => $dir,
			'new_window' => isset($v['new_window']) ? $v['new_window'] : 0
		);

		if (!empty($v[$children_name])) {
			$result[$v[$id_name]]['subitems'] = fn_top_menu_standardize($v[$children_name], $id_name, $name, $children_name, $href_prefix, $dir);
		}
	}
	return $result;
}

?>