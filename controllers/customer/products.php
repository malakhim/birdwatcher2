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

//
// Search products
//
if ($mode == 'search') {

	$params = $_REQUEST;

	if (!empty($params['search_performed']) || !empty($params['features_hash'])) {

		fn_add_breadcrumb(fn_get_lang_var('advanced_search'), "products.search" . (!empty($_REQUEST['advanced_filter']) ? '?advanced_filter=Y' : ''));
		fn_add_breadcrumb(fn_get_lang_var('search_results'));
		$params = $_REQUEST;
		$params['extend'] = array('description');
		list($products, $search, $products_count) = fn_get_products($params, Registry::get('settings.Appearance.products_per_page'));

		fn_gather_additional_products_data($products, array('get_icon' => true, 'get_detailed' => true, 'get_options'=> true));

		if (!empty($products)) {
			$_SESSION['continue_url'] = Registry::get('config.current_url');
		}

		$selected_layout = fn_get_products_layout($params);

		$view->assign('products', $products);
		$view->assign('search', $search);
		$view->assign('product_count', $products_count);
		$view->assign('selected_layout', $selected_layout);
	} else {
		fn_add_breadcrumb(fn_get_lang_var('advanced_search'));
	}
	
	if (!empty($params['advanced_filter'])) {

		$params['get_all'] = 'Y';
		$params['get_custom'] = 'Y';

		list($filters, $view_all_filter) = fn_get_filters_products_count($params);
		$view->assign('filter_features', $filters);
		$view->assign('view_all_filter', $view_all_filter);
	}
	
//
// View product details
//
} elseif ($mode == 'view' || $mode == 'quick_view') {

	$_REQUEST['product_id'] = empty($_REQUEST['product_id']) ? 0 : $_REQUEST['product_id'];

	if (!empty($_REQUEST['product_id']) && empty($auth['user_id'])) {

		$uids = explode(',', db_get_field("SElECT usergroup_ids FROM ?:products WHERE product_id = ?i", $_REQUEST['product_id']));

		if (!in_array(USERGROUP_ALL, $uids) && !in_array(USERGROUP_GUEST, $uids)) {
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
		}
	}

	$product = fn_get_product_data($_REQUEST['product_id'], $auth, CART_LANGUAGE, '', true, true, true, true, fn_is_preview_action($auth, $_REQUEST));

	if (empty($product)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	if ((empty($_SESSION['current_category_id']) || empty($product['category_ids'][$_SESSION['current_category_id']])) && !empty($product['main_category'])) {
		if (!empty($_SESSION['breadcrumb_category_id']) && !empty($product['category_ids'][$_SESSION['breadcrumb_category_id']])) {
			$_SESSION['current_category_id'] = $_SESSION['breadcrumb_category_id'];
		} else {
			$_SESSION['current_category_id'] = $product['main_category'];
		}
	}

	if (!empty($product['meta_description']) || !empty($product['meta_keywords'])) {
		$view->assign('meta_description', $product['meta_description']);
		$view->assign('meta_keywords', $product['meta_keywords']);

	} else {
		$meta_tags = db_get_row("SELECT meta_description, meta_keywords FROM ?:category_descriptions WHERE category_id = ?i AND lang_code = ?s", $_SESSION['current_category_id'], CART_LANGUAGE);
		if (!empty($meta_tags)) {
			$view->assign('meta_description', $meta_tags['meta_description']);
			$view->assign('meta_keywords', $meta_tags['meta_keywords']);
		}
	}
	if (!empty($_SESSION['current_category_id'])){
		$_SESSION['continue_url'] = "categories.view?category_id=$_SESSION[current_category_id]";

		$parent_ids = fn_explode('/', db_get_field("SELECT id_path FROM ?:categories WHERE category_id = ?i", $_SESSION['current_category_id']));

		if (!empty($parent_ids)) {
			$cats = fn_get_category_name($parent_ids);
			foreach($parent_ids as $c_id) {
				fn_add_breadcrumb($cats[$c_id], "categories.view?category_id=$c_id");
			}
		}
	}
	fn_add_breadcrumb($product['product']);

	if (!empty($_REQUEST['combination'])) {
		$product['combination'] = $_REQUEST['combination'];
	}

	fn_gather_additional_product_data($product, true, true);
	$view->assign('product', $product);

	// If page title for this product is exist than assign it to template
	if (!empty($product['page_title'])) {
		$view->assign('page_title', $product['page_title']);
	}

	$files = fn_get_product_files($_REQUEST['product_id'], true);

	if (!empty($files)) {
		$view->assign('files', $files);
	}

	/* [Product tabs] */
	$tabs = Bm_ProductTabs::instance()->get_list(
		'',
		$product['product_id'],
		DESCR_SL
	);
	foreach ($tabs as $tab_id => $tab) {
		if ($tab['status'] == 'D') {
			continue;
		}
		if (!empty($tab['template'])) {
			$tabs[$tab_id]['html_id'] = fn_basename($tab['template'], ".tpl");
		} else {
			$tabs[$tab_id]['html_id'] = 'product_tab_' . $tab_id;
		}

		if ($tab['show_in_popup'] != "Y") {
			Registry::set('navigation.tabs.' . $tabs[$tab_id]['html_id'], array (
				'title' => $tab['name'],
				'js' => true
			));
		}
	}
	$view->assign('tabs', $tabs);
	/* [/Product tabs] */

	// Set recently viewed products history
	if (!empty($_SESSION['recently_viewed_products'])) {
		$recently_viewed_product_id = array_search($_REQUEST['product_id'], $_SESSION['recently_viewed_products']);
		// Existing product will be moved on the top of the list
		if ($recently_viewed_product_id !== FALSE) {
			// Remove the existing product to put it on the top later
			unset($_SESSION['recently_viewed_products'][$recently_viewed_product_id]);
			// Re-sort the array
			$_SESSION['recently_viewed_products'] = array_values($_SESSION['recently_viewed_products']);
		}
		array_unshift($_SESSION['recently_viewed_products'], $_REQUEST['product_id']);
	} elseif (empty($_SESSION['recently_viewed_products'])) {
		$_SESSION['recently_viewed_products'] = array($_REQUEST['product_id']);
	}

	if (count($_SESSION['recently_viewed_products']) > MAX_RECENTLY_VIEWED) {
		array_pop($_SESSION['recently_viewed_products']);
	}

	// Increase product popularity
	if (empty($_SESSION['products_popularity']['viewed'][$_REQUEST['product_id']])) {
		$_data = array (
			'product_id' => $_REQUEST['product_id'],
			'viewed' => 1,
			'total' => POPULARITY_VIEW
		);
		
		db_query("INSERT INTO ?:product_popularity ?e ON DUPLICATE KEY UPDATE viewed = viewed + 1, total = total + ?i", $_data, POPULARITY_VIEW);
		
		$_SESSION['products_popularity']['viewed'][$_REQUEST['product_id']] = true;
	}

	$product_notification_enabled = (isset($_SESSION['product_notifications']) ? (isset($_SESSION['product_notifications']['product_ids']) && in_array($_REQUEST['product_id'], $_SESSION['product_notifications']['product_ids']) ? 'Y' : 'N') : 'N');
	if ($product_notification_enabled) {
		if (($_SESSION['auth']['user_id'] == 0) && !empty($_SESSION['product_notifications']['email'])) {
			if (!db_get_field("SELECT subscription_id FROM ?:product_subscriptions WHERE product_id = ?i AND email = ?s", $_REQUEST['product_id'], $_SESSION['product_notifications']['email'])) {
				$product_notification_enabled = 'N';
			}
		} elseif (!db_get_field("SELECT subscription_id FROM ?:product_subscriptions WHERE product_id = ?i AND user_id = ?i", $_REQUEST['product_id'], $_SESSION['auth']['user_id'])) {
			$product_notification_enabled = 'N';
		}
	}

	$view->assign('show_qty', true);
	$view->assign('product_notification_enabled', $product_notification_enabled);
	$view->assign('product_notification_email', (isset($_SESSION['product_notifications']) ? $_SESSION['product_notifications']['email'] : ''));

	if ($mode == 'quick_view') {
		if (defined('AJAX_REQUEST')) {
			fn_prepare_product_quick_view($_REQUEST);

			$view->display('views/products/quick_view.tpl');
			exit;
		}

		return array(CONTROLLER_STATUS_REDIRECT, 'products.view&product_id=' . $_REQUEST['product_id']);
	}

} elseif ($mode == 'product_notifications') {

	$data = array (
		'product_id' => $_REQUEST['product_id'],
		'user_id' => $_SESSION['auth']['user_id'],
		'email' => (!empty($_SESSION['cart']['user_data']['email']) ? $_SESSION['cart']['user_data']['email'] : (!empty($_REQUEST['email']) ? $_REQUEST['email'] : ''))
	);

	if (!empty($data['email']) && fn_validate_email($data['email'])) {
		$_SESSION['product_notifications']['email'] = $data['email'];
		if ($_REQUEST['enable'] == 'Y') {
			db_query("REPLACE INTO ?:product_subscriptions ?e", $data);
			if (!isset($_SESSION['product_notifications']['product_ids']) || (is_array($_SESSION['product_notifications']['product_ids']) && !in_array($data['product_id'], $_SESSION['product_notifications']['product_ids']))) {
				$_SESSION['product_notifications']['product_ids'][] = $data['product_id'];
			}
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('product_notification_subscribed'));
		} else {
			db_query("DELETE FROM ?:product_subscriptions WHERE product_id = ?i AND user_id = ?i AND email = ?s", $data['product_id'], $data['user_id'], $data['email']);
			if (isset($_SESSION['product_notifications']) && isset($_SESSION['product_notifications']['product_ids']) && in_array($data['product_id'], $_SESSION['product_notifications']['product_ids'])) {
				$_SESSION['product_notifications']['product_ids'] = array_diff($_SESSION['product_notifications']['product_ids'], array($data['product_id']));
			}
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('product_notification_unsubscribed'));
		}
	}
	
	if (defined('AJAX_REQUEST')) {
		die(empty($data['product_id']) ? 'Access denied' : 'OK');
	} else {
		return array(CONTROLLER_STATUS_REDIRECT, 'products.view&product_id=' . $data['product_id']);
	}
} elseif ($mode == 'options') {

	if (!defined('AJAX_REQUEST') && !empty($_REQUEST['product_data'])) {
		list($product_id, $_data) = each($_REQUEST['product_data']);
		$product_id = isset($_data['product_id']) ? $_data['product_id'] : $product_id;
		return array(CONTROLLER_STATUS_REDIRECT, 'products.view&product_id=' . $product_id);
	}
}

?>
