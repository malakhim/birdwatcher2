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
		fn_update_subscriber($_REQUEST['subscriber_data'], $_REQUEST['subscriber_id']);
	} 
	
	if ($mode == 'add_users') {

		if (!empty($_REQUEST['add_users'])) {
			$checked_users = array();

			$users = db_get_array("SELECT user_id, email, lang_code FROM ?:users WHERE user_id IN (?n)", $_REQUEST['add_users']);

			$list_data = array();
			if (!empty($_REQUEST['picker_mailing_list_ids'])) {
				$list_data = array(
					'list_ids' => $_REQUEST['picker_mailing_list_ids'],
					'format' => $_REQUEST['picker_mailing_lists']['format'],
					'confirmed' => $_REQUEST['picker_mailing_lists']['confirmed']
				);
			}

			foreach ($users as $user) {
				$subscriber_data = array(
					'email' => $user['email'],
					'lang_code' => $user['lang_code']
				);

				fn_update_subscriber(fn_array_merge($subscriber_data, $list_data));

			}
		}
	}

	if ($mode == 'm_update') {
		if (!empty($_REQUEST['subscribers'])) {
			foreach ($_REQUEST['subscribers'] as $subscriber_id => $v) {
				fn_update_subscriber($v, $subscriber_id);
			}
		}
	}

	if ($mode == 'delete') {
		fn_delete_subscribers($_REQUEST['subscriber_ids']);
	}

	return array(CONTROLLER_STATUS_OK, "subscribers.manage");
}

if ($mode == 'manage') {

	list($subscribers, $search) = fn_get_subscribers($_REQUEST);

	foreach ($subscribers as &$subscriber) {
		if (!empty($subscriber['list_ids'])) {
			$subscriber['mailing_lists'] = array();
			foreach (explode(',', $subscriber['list_ids']) as $list_id) {
				$subscriber['mailing_lists'][$list_id] = fn_get_mailing_list_data($list_id, DESCR_SL);
				// get additional user-specific data for each mailing list (like format and lang_code)
				$_where = array(
					'list_id' => $list_id,
					'subscriber_id' => $subscriber['subscriber_id']
				);
				$subscriber_list_data = db_get_row("SELECT * FROM ?:user_mailing_lists WHERE ?w", $_where);
				$subscriber['mailing_lists'][$list_id] = array_merge($subscriber['mailing_lists'][$list_id], $subscriber_list_data);

				$subscriber['format'] = $subscriber['mailing_lists'][$list_id]['format'];
				$subscriber['lang_code'] = $subscriber['mailing_lists'][$list_id]['lang_code'];
			}

			unset($subscriber['list_ids']);
		}
	}

	$mailing_lists = db_get_hash_single_array("SELECT m.list_id, d.object FROM ?:mailing_lists m INNER JOIN ?:common_descriptions d ON m.list_id=d.object_id WHERE d.object_holder='mailing_lists' AND d.lang_code = ?s", array('list_id', 'object'), DESCR_SL);

	$view->assign('mailing_lists', $mailing_lists);
	$view->assign('subscribers', $subscribers);
	$view->assign('search', $search);

	fn_newsletters_generate_sections('subscribers');

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['subscriber_id'])) {
		fn_delete_subscribers((array)$_REQUEST['subscriber_id']);
	}

	return array(CONTROLLER_STATUS_REDIRECT, "subscribers.manage");
}

function fn_get_subscribers($params, $lang_code = CART_LANGUAGE)
{
	// Init filter
	$params = fn_init_view('subscribers', $params);

	// Set default values to input params
	$default_params = array (
		'page' => 1,
	);

	$params = array_merge($default_params, $params);

	// Define fields that should be retrieved
	$fields = array (
		'?:subscribers.subscriber_id',
		'?:subscribers.email',
		'?:subscribers.timestamp',
		'?:subscribers.subscriber_id',
		"GROUP_CONCAT(?:user_mailing_lists.list_id) as list_ids",
	);

	// Define sort fields
	$sortings = array (
		'email' => '?:subscribers.email',
		'timestamp' => '?:subscribers.timestamp'
	);

	$directions = array (
		'asc' => 'asc',
		'desc' => 'desc'
	);

	$condition = '';

	$group_by = "?:subscribers.subscriber_id";

	$join = db_quote(" LEFT JOIN ?:user_mailing_lists ON ?:user_mailing_lists.subscriber_id = ?:subscribers.subscriber_id");

	if (isset($params['email']) && fn_string_not_empty($params['email'])) {
		$condition .= db_quote(" AND ?:subscribers.email LIKE ?l", "%".trim($params['email'])."%");
 	}

	if (!empty($params['list_id'])) {
		$condition .= db_quote(" AND ?:user_mailing_lists.list_id = ?i", $params['list_id']);
	}

	if (!empty($params['confirmed'])) {
		$condition .= db_quote(" AND ?:user_mailing_lists.confirmed = ?i", ($params['confirmed'] == 'Y'));
	}

	if (!empty($params['format'])) {
		$condition .= db_quote(" AND ?:user_mailing_lists.format = ?i", $params['format']);
	}

	if (!empty($params['language'])) {
		$condition .= db_quote(" AND ?:user_mailing_lists.lang_code = ?s", $params['language']);
	}

	if (!empty($params['period']) && $params['period'] != 'A') {
		list($params['time_from'], $params['time_to']) = fn_create_periods($params);

		$condition .= db_quote(" AND (?:subscribers.timestamp >= ?i AND ?:subscribers.timestamp <= ?i)", $params['time_from'], $params['time_to']);
	}

	if (empty($params['sort_order']) || empty($directions[$params['sort_order']])) {
		$params['sort_order'] = 'desc';
	}

	if (empty($params['sort_by']) || empty($sortings[$params['sort_by']])) {
		$params['sort_by'] = 'timestamp';
	}

	$sorting = $sortings[$params['sort_by']] . ' ' . $directions[$params['sort_order']];

	// Reverse sorting (for usage in view)
	$params['sort_order'] = $params['sort_order'] == 'asc' ? 'desc' : 'asc';

	$total = db_get_field("SELECT COUNT(DISTINCT(?:subscribers.subscriber_id)) FROM ?:subscribers $join WHERE 1 $condition");
	$limit = fn_paginate($params['page'], $total, Registry::get('settings.Appearance.admin_elements_per_page'));

	$subscribers = db_get_array('SELECT ' . implode(', ', $fields) . " FROM ?:subscribers $join WHERE 1 $condition GROUP BY $group_by ORDER BY $sorting $limit");

	return array($subscribers, $params);
}

function fn_update_subscriber($subscriber_data, $subscriber_id = 0)
{
	$invalid_emails = array();
	if (empty($subscriber_data['list_ids'])) {
		$subscriber_data['list_ids'] = array();
	}
	if (empty($subscriber_data['format'])) {
		$subscriber_data['format'] = NEWSLETTER_FORMAT_HTML;
	}
	if (empty($subscriber_data['mailing_lists'])) {
		$subscriber_data['mailing_lists'] = array();
	}

	if (empty($subscriber_id)) {
		if (!empty($subscriber_data['email'])) {
			if (db_get_field("SELECT email FROM ?:subscribers WHERE email = ?s", $subscriber_data['email']) == '') {
				if (fn_validate_email($subscriber_data['email']) == false) {
					$invalid_emails[] = $subscriber_data['email'];
				} else {
					$subscriber_data['timestamp'] = TIME;
					$subscriber_id = db_query("INSERT INTO ?:subscribers ?e", $subscriber_data);
				}
			} else {
				$msg = fn_get_lang_var('warning_subscr_email_exists');
				$msg = str_replace('[email]', $subscriber_data['email'], $msg);
				fn_set_notification('W', fn_get_lang_var('warning'), $msg);
			}
		}
	} else {
		db_query("UPDATE ?:subscribers SET ?u WHERE subscriber_id = ?i", $subscriber_data, $subscriber_id);
	}

	fn_update_subscriptions($subscriber_id, $subscriber_data['list_ids'], $subscriber_data['format'], isset($subscriber_data['confirmed']) ? $subscriber_data['confirmed'] : $subscriber_data['mailing_lists'], fn_get_notification_rules($subscriber_data), $subscriber_data['lang_code']);

	if (!empty($invalid_emails)) {
		$msg = fn_get_lang_var('error_invalid_emails');
		$msg = str_replace('[emails]', implode(", ", $invalid_emails), $msg);
		fn_set_notification('E', fn_get_lang_var('error'), $msg);
	}


	return $subscriber_id;
}

/** /Body **/
?>