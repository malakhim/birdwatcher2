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

/** Body **/

if (!empty($_REQUEST['page_id'])) {
	$page_id = $_REQUEST['page_id'];
} else {
	$page_id = 0;
	$view->assign('show_all', true);
}

if (!empty($_REQUEST['page_data']['page_id']) && $page_id == 0) {
	$page_id = intval($_REQUEST['page_data']['page_id']);
}

/* POST data processing */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$suffix = '';

	// Define trusted variables that shouldn't be stripped
	fn_trusted_vars('page_data');

	//
	// Create/update page
	//
	if ($mode == 'update') {

		// Updating page record
		$page_id = fn_update_page($_REQUEST['page_data'], $_REQUEST['page_id'], DESCR_SL);

		if (isset($_REQUEST['redirect_url'])) {
			$_REQUEST['redirect_url'] .= (!empty($_REQUEST['come_from']) ? '&page_type=' . $_REQUEST['come_from'] :  '&get_tree=multi_level');
		}

		if (empty($page_id)) {
			$suffix = '.manage';
		} else {
			$suffix = ".update?page_id=$page_id" . (!empty($_REQUEST['page_data']['block_id']) ? "&selected_block_id=" . $_REQUEST['page_data']['block_id'] : "") . '&come_from=' . (!empty($_REQUEST['come_from']) ? $_REQUEST['come_from'] : '');
		}
	}

	//
	// Processing multiple updating of page elements
	//
	if ($mode == 'm_update') {
		// Update multiple pages data
		foreach ($_REQUEST['pages_data'] as $page_id => $page_data) {
			fn_update_page($page_data, $page_id, DESCR_SL);
		}

		$suffix = ".manage";
	}

	//
	// Processing deleting of multiple page elements
	//
	if ($mode == 'm_delete') {
		if (isset($_REQUEST['page_ids'])) {
			foreach ($_REQUEST['page_ids'] as $v) {
				fn_delete_page($v);
			}
		}
		unset($_SESSION['page_ids']);
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_pages_have_been_deleted'));

		$suffix = ".manage?" . (empty($_REQUEST['page_type']) ? "" : ("page_type=" . $_REQUEST['page_type']));
	}

	//
	// Processing clonning of multiple page elements
	//
	if ($mode == 'm_clone') {
		$p_ids = array();
		if (!empty($_REQUEST['page_ids'])) {
			foreach ($_REQUEST['page_ids'] as $v) {
				$pdata = fn_clone_page($v);
				if (!empty($pdata)) {
					$p_ids[] = $pdata['page_id'];
				}
			}
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_pages_cloned'));
		}
		$suffix = ".manage?item_ids=" . implode(',', $p_ids);
		unset($_REQUEST['redirect_url'], $_REQUEST['page']); // force redirection
	}

	//
	// Storing selected fields for using in m_update mode
	//
	if ($mode == 'store_selection') {
		$_SESSION['page_ids'] = $_REQUEST['page_ids'];
		$_SESSION['selected_fields'] = $_REQUEST['selected_fields'];

		if (isset($_SESSION['page_ids'])) {
			$suffix = ".m_update";
		} else {
			$suffix = ".manage";
		}
	}

	//
	// This mode is using to send search data via POST method
	//
	if ($mode == 'search_pages') {
		$suffix = ".manage";
	}

	if (empty($suffix)) {
		$suffix = '.manage';
	}

	return array(CONTROLLER_STATUS_OK, "pages$suffix");
}
/* /POST data processing */

//

if ($mode == 'update' || $mode == 'add') {	
	$page_type = isset($_REQUEST['page_type']) ? $_REQUEST['page_type'] : PAGE_TYPE_TEXT;

	$tabs = array (
		'basic' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		),
	);

	Registry::set('navigation.tabs', $tabs);

	if ($mode == "update") {
		fn_add_breadcrumb(fn_get_lang_var('pages'), 'pages.manage&' . (!empty($_REQUEST['come_from']) ? 'page_type=' . $_REQUEST['come_from'] :  'get_tree=multi_level'));
		fn_add_breadcrumb(fn_get_lang_var('search_results'), 'pages.manage.last_view');

		// Get current page data
		$page_data = fn_get_page_data($page_id, DESCR_SL);

		if (empty($page_data)) {
			$page_data = !empty($_REQUEST['page_data']) ? $_REQUEST['page_data'] : array();

			if (empty($page_data)) {
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
		}

		$page_type = isset($page_data['page_type']) ? $page_data['page_type'] : PAGE_TYPE_TEXT;
	} else {
		$breadcrumb_link = !empty($_REQUEST['come_from']) ? '&page_type=' . $_REQUEST['come_from'] : '&get_tree=multi_level';
		fn_add_breadcrumb(fn_get_lang_var('pages'), 'pages.manage' . $breadcrumb_link);

		$page_data = array();

		$page_data['page_type'] = $page_type;
		
		if (!empty($_REQUEST['parent_id'])) {
			$page_data['parent_id'] = $_REQUEST['parent_id'];
		}
	}

	if (!empty($_REQUEST['page_data']['company_id']) && PRODUCT_TYPE == 'ULTIMATE' || isset($_REQUEST['page_data']['company_id']) && PRODUCT_TYPE == 'MULTIVENDOR' ) {
		$page_data['company_id'] = $_REQUEST['page_data']['company_id'];
	} elseif (empty($page_data['company_id']) && defined('COMPANY_ID')) {
		$page_data['company_id'] = COMPANY_ID;
	} elseif (!isset($page_data['company_id']) && PRODUCT_TYPE == 'ULTIMATE') {
		$company_ids = fn_get_all_companies_ids();
		if (count($company_ids) > 1) {
			$page_data['company_id'] = reset($company_ids);
		}
	}

	if ($page_data['page_type'] == PAGE_TYPE_LINK) {
		Registry::set('navigation.selected_tab', 'content');
		Registry::set('navigation.subsection', 'links');
	}

	list($pages_tree, $params) = fn_get_pages(array('get_tree' => 'plain'));

	if (defined('COMPANY_ID') && isset($page_data['company_id']) && $page_data['company_id'] != COMPANY_ID) {
		$var = Registry::get('navigation.dynamic.actions');
		$vars = array('delete_this_page', 'add_page', 'add_link');
		foreach ($vars as $val) {
			if (isset($var[$val])) {
				unset($var[$val]);
			}
		}
		Registry::set('navigation.dynamic.actions', $var);
	}

	$params = array();
	if (!empty($page_data['company_id'])) {
		$params['company_id'] = $page_data['company_id'];
	} elseif (defined('COMPANY_ID')) {
		$params['company_id'] = COMPANY_ID;
	}

	$view->assign('come_from', !empty($_REQUEST['come_from']) ? $_REQUEST['come_from'] : '');
	$view->assign('all_pages_list', $pages_tree);
	$view->assign('page_type', $page_data['page_type']);
	$view->assign('page_data', $page_data);
	$view->assign('page_type_data', fn_get_page_object_by_type($page_data['page_type']));

	$parent_pages = fn_get_pages_plain_list($params);

	if (count($parent_pages) < PAGE_THRESHOLD) {
		$view->assign('parent_pages', $parent_pages);
	}
//
// Delete page
//
} elseif ($mode == 'delete') {
	$suffix = '';

	if (!empty($page_id)) {
		if (!empty($_REQUEST['come_from'])) {
			$suffix = '?page_type=' . $_REQUEST['come_from'];
		} else {
			$suffix = '?get_tree=multi_level';
		}
		fn_delete_page($page_id);
		fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_page_has_been_deleted'));
	}

	return array(CONTROLLER_STATUS_REDIRECT, "pages.manage$suffix");

//
// Clone page
//
} elseif ($mode == 'clone') {
	if (!empty($_REQUEST['page_id'])) {
		$pdata = fn_clone_page($_REQUEST['page_id']);
		$msg = fn_get_lang_var('page_cloned');
		$msg = str_replace('[page]', $pdata['orig_name'], $msg);
		fn_set_notification('N', fn_get_lang_var('notice'), $msg);

		return array(CONTROLLER_STATUS_REDIRECT, "pages.update?page_id=$pdata[page_id]");
	}
//
// 'Management' page
//
} elseif ($mode == 'manage' || $mode == 'picker') {

	$params = $_REQUEST;
	if ($mode == 'picker') {
		$params['skip_view'] = 'Y';
		$params['get_parent_pages'] = true;
	}
	
	if (!empty($params['get_tree'])) { // manage page, show tree
		$condition = db_quote(" AND ?:pages.page_type IN (?a)", array_keys(fn_get_page_object_by_type()));
		$total = db_get_field("SELECT COUNT(*) FROM ?:pages WHERE 1 ?p", $condition);
		if ($total > PAGE_THRESHOLD) {
			$params['get_children_count'] = true;
			$params['get_tree'] = '';
			$params['parent_id'] = !empty($params['parent_id']) ? $params['parent_id'] : 0;

			if (defined('AJAX_REQUEST')) {
				$view->assign('parent_id', $params['parent_id']);
				$view->assign('hide_header', true);
			}

			$view->assign('hide_show_all', true);
		}
		if ($total < PAGE_SHOW_ALL) {
			$view->assign('expand_all', true);
		}
	} else { // search page
		$params['paginate'] = true;
	}
	$params['add_root'] = !empty($_REQUEST['root']) ? $_REQUEST['root'] : '';

	list($pages, $params) = fn_get_pages($params, Registry::get('settings.Appearance.admin_pages_per_page'));

	$view->assign('pages_tree', $pages);
	$view->assign('search', $params);
	$view->assign('page_types', fn_get_page_object_by_type());

	if (!empty($_REQUEST['except_id'])) {
		$view->assign('except_id', $_REQUEST['except_id']);
	}

	if ($mode == 'picker') {
		if (!empty($_REQUEST['combination_suffix'])) {
			$view->assign('combination_suffix', $_REQUEST['combination_suffix']);
		}
		$view->display('pickers/pages_picker_contents.tpl');
		exit;
	}
} elseif ($mode == 'get_parent_pages') {
	$page_data = array();
	if (isset($_REQUEST['page_id'])) {
		$view->assign('page_id', $_REQUEST['page_id']);
		$page_data = fn_get_page_data($_REQUEST['page_id'], DESCR_SL);
	} else {
		$view->assign('show_all', true);
	}

	if (!empty($_REQUEST['parent_id'])) {
		$page_data['parent_id'] = $_REQUEST['parent_id'];
	}

	$view->assign('page_data', $page_data);
	$view->assign('parent_pages', fn_get_pages_plain_list());
	$view->display('views/pages/components/parent_page_selector.tpl');
	exit;
}

$view->assign('usergroups', fn_get_usergroups('C', DESCR_SL));
/* /Preparing page data for templates and performing simple actions*/


/** /Body **/
?>