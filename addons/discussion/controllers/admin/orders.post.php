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

	if ($mode == 'update_details') {
		if (!empty($_REQUEST['posts']) && is_array($_REQUEST['posts'])) {

			foreach ($_REQUEST['posts'] as $p_id => $data) {
				db_query("UPDATE ?:discussion_posts SET ?u WHERE post_id = ?i", $data, $p_id);
				db_query("UPDATE ?:discussion_messages SET ?u WHERE post_id = ?i", $data, $p_id);
				db_query("UPDATE ?:discussion_rating SET ?u WHERE post_id = ?i", $data, $p_id);
			}
		}

		if (!empty($_REQUEST['discussion'])) {
			$discussion = fn_get_discussion($_REQUEST['discussion']['object_id'], $_REQUEST['discussion']['object_type']);

			if (!empty($discussion['thread_id']) && $discussion['type'] != $_REQUEST['discussion']['type']) {
				db_query('UPDATE ?:discussion SET ?u WHERE thread_id = ?i', $_REQUEST['discussion'], $discussion['thread_id']);
				if ($_REQUEST['discussion']['type'] != 'D') {
					$_REQUEST['selected_section'] = 'discussion';
				}
			} elseif (empty($discussion['thread_id'])) {
				$data = $_REQUEST['discussion'];
				if (PRODUCT_TYPE == 'ULTIMATE' && defined('COMPANY_ID')) {
					$data['company_id'] = COMPANY_ID;
				}   
				db_query("REPLACE INTO ?:discussion ?e", $data);
				if ($_REQUEST['discussion']['type'] != 'D') {
					$_REQUEST['selected_section'] = 'discussion';
				}
			}
		}
	}
}

if ($mode == 'details') {

	$discussion = fn_get_discussion($_REQUEST['order_id'], 'O');
	if (!empty($discussion) && $discussion['type'] != 'D') {
		if (PRODUCT_TYPE != 'ULTIMATE' || PRODUCT_TYPE == 'ULTIMATE' && defined("COMPANY_ID")) {
			Registry::set('navigation.tabs.discussion', array (
				'title' => fn_get_lang_var('communication'),
				'js' => true
			));

			$view->assign('discussion', $discussion);
		}
	}
}

?>
