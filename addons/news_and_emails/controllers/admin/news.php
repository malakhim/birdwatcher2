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

	fn_trusted_vars('news', 'news_data');

	//
	// Delete news
	//
	if ($mode == 'delete') {
		foreach ($_REQUEST['news_ids'] as $v) {
			fn_delete_news($v);
		}

		$suffix = ".manage";
	}

	//
	// Manage news
	//
	if ($mode == 'm_update') {

		if (!empty($_REQUEST['news'])) {
			foreach ($_REQUEST['news'] as $k => $v) {
				fn_update_news($k, $v, DESCR_SL);
			}
		}

		$suffix = ".manage";
	}

	//
	// Add/update news
	//
	if ($mode == 'update') {
		$news_id = fn_update_news($_REQUEST['news_id'], $_REQUEST['news_data'], DESCR_SL);

		if (empty($news_id)) {
			$suffix = ".manage";
		} else {
			$suffix = ".update?news_id=$news_id" . (!empty($_REQUEST['news_data']['block_id']) ? "&selected_block_id=" . $_REQUEST['news_data']['block_id'] : "");
		}
	}

	return array(CONTROLLER_STATUS_OK, "news$suffix");
}

if ($mode == 'add') {
	fn_add_breadcrumb(fn_get_lang_var('news'), "news.manage");

	// [Page sections]
	Registry::set('navigation.tabs', array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		)
	));
	// [/Page sections]


} elseif ($mode == 'update') {

	fn_add_breadcrumb(fn_get_lang_var('news'), "news.manage");

	$news_data = fn_get_news_data($_REQUEST['news_id'], DESCR_SL);
	
	if (empty($news_data)) {
		return array(CONTROLLER_STATUS_NO_PAGE);
	}

	// [Page sections]
	$tabs = array (
		'detailed' => array (
			'title' => fn_get_lang_var('general'),
			'js' => true
		),
		'addons' => array (
			'title' => fn_get_lang_var('addons'),
			'js' => true
		)
	);

	Registry::set('navigation.tabs', $tabs);
	// [/Page sections]

	$view->assign('news_data', $news_data);

} elseif ($mode == 'manage' || $mode == 'picker') {

	$params = $_REQUEST;
	$params['paginate'] = true;

	list($news, ) = fn_get_news($params, DESCR_SL);
	$view->assign('news', $news);

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['news_id'])) {
		fn_delete_news($_REQUEST['news_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "news.manage");
}

//
// News picker
//
if ($mode == 'picker') {
	$view->display('addons/news_and_emails/pickers/news_picker_contents.tpl');
	exit;
}

function fn_delete_news($news_id)
{
	if (!empty($news_id) && fn_check_company_id('news', 'news_id', $news_id)) {
		// Log news deletion
		fn_log_event('news', 'delete', array(
			'news_id' => $news_id
		));

		Bm_Block::instance()->remove_dynamic_object_data('news', $news_id);

		db_query("DELETE FROM ?:news WHERE news_id = ?i", $news_id);
		db_query("DELETE FROM ?:news_descriptions WHERE news_id = ?i", $news_id);

		fn_set_hook('delete_news', $news_id);
	}
}

?>