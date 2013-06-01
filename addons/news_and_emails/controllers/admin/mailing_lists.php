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


if ($_SERVER['REQUEST_METHOD']	== 'POST') {

	
	if ($mode == 'update') {
		fn_update_mailing_list($_REQUEST['mailing_list_data'], $_REQUEST['list_id'], DESCR_SL);
	}

	return array(CONTROLLER_STATUS_OK, "mailing_lists.manage");
}

if ($mode == 'update') {
	fn_add_breadcrumb(fn_get_lang_var('newsletters'), "newsletters.manage");

	$view->assign('autoresponders', fn_get_newsletters(array('type' => NEWSLETTER_TYPE_AUTORESPONDER, 'only_available' => false), DESCR_SL));
	$view->assign('mailing_list', fn_get_mailing_list_data($_REQUEST['list_id'], DESCR_SL));

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['list_id'])) {
		db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder='mailing_lists'", $_REQUEST['list_id']);
		db_query("DELETE FROM ?:mailing_lists WHERE list_id = ?i", $_REQUEST['list_id']);
		db_query("DELETE FROM ?:user_mailing_lists WHERE list_id = ?i", $_REQUEST['list_id']);
		$_mailing_lists = fn_get_mailing_lists(array('only_available' => false, 'limit' => $limit), DESCR_SL);
		if (empty($_mailing_lists)) {
			$view->display('addons/news_and_emails/views/mailing_lists/manage.tpl');
		}
	}
	exit;

} elseif ($mode == 'manage') {
	$total_pages = db_get_field("SELECT COUNT(*) FROM ?:mailing_lists");
	$limit = fn_paginate(@$_REQUEST['page'], $total_pages, Registry::get('settings.Appearance.admin_elements_per_page'));

	$mailing_lists = fn_get_mailing_lists(array('only_available' => false, 'limit' => $limit), DESCR_SL);
	$subscribers = db_get_hash_array("SELECT * FROM ?:subscribers", 'subscriber_id');

	foreach ($mailing_lists as &$list) {
		$list['subscribers_num'] = db_get_field("SELECT COUNT(*) FROM ?:user_mailing_lists WHERE list_id=$list[list_id]");
	}

	$view->assign('mailing_lists', $mailing_lists);
	$view->assign('autoresponders', fn_get_newsletters(array('type' => NEWSLETTER_TYPE_AUTORESPONDER, 'only_available' => false), DESCR_SL));
	$view->assign('subscribers', $subscribers);

	fn_newsletters_generate_sections('mailing_lists');
}

function fn_update_mailing_list($mailing_list_data, $list_id, $lang_code = DESCR_SL)
{
	if (empty($list_id)) {
		$list_id = db_query("INSERT INTO ?:mailing_lists ?e", $mailing_list_data);

		$_data = $mailing_list_data;
		$_data['object_id'] = $list_id;
		$_data['object_holder'] = 'mailing_lists';
		$_data['object'] = $_data['name'];

		foreach ((array)Registry::get('languages') as $_data['lang_code'] => $v) {
			db_query("REPLACE INTO ?:common_descriptions ?e", $_data);
		}
	} else {
		db_query("UPDATE ?:mailing_lists SET ?u WHERE list_id = ?i", $mailing_list_data, $list_id);

		$_data = $mailing_list_data;
		$_data['object_id'] = $list_id;
		$_data['object_holder'] = 'mailing_lists';
		$_data['object'] = $_data['name'];

		$_where = array(
			'object_id' => $list_id,
			'object_holder' => 'mailing_lists',
			'lang_code' => $lang_code
		);

		db_query("UPDATE ?:common_descriptions SET ?u WHERE ?w", $_data, $_where);
	}

	if (!empty($mailing_list_data['add_subscribers'])) {
		foreach ($mailing_list_data['add_subscribers'] as $subscriber) {
			$exists = db_get_field("SELECT subscriber_id FROM ?:subscribers WHERE email=?s", $subscriber['email']);

			// check if subscriber exists already
			if (!$exists) {
				$_data = $subscriber;
				$_data['timestamp'] = TIME;
				$subscriber_id  = db_query("INSERT INTO ?:subscribers ?e", $_data);
			}

			// mark mailing list as active for this subscriber
			$_data = array(
				'subscriber_id' => $subscriber_id,
				'list_id' => $list_id,
				'lang_code' => $subscriber['lang_code'],
				'confirmed' => $subscriber['confirmed'],
				'timestamp' => TIME
			);

			db_query("REPLACE INTO ?:user_mailing_lists ?e", $_data);
		}
	}	

	return $list_id;
}

/** /Body **/
?>