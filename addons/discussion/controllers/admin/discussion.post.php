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

	return array(CONTROLLER_STATUS_OK);
}

if ($mode == 'update') {
	$discussion = array();
	if (!empty($_REQUEST['discussion_type'])) {
		$discussion = fn_get_discussion(0, $_REQUEST['discussion_type']);
	}
	if (!empty($discussion) && $discussion['type'] != 'D' && Registry::if_get('addons.discussion.home_page_testimonials', 'N') != 'D') {
		if (PRODUCT_TYPE != 'ULTIMATE' || PRODUCT_TYPE == 'ULTIMATE' && defined("COMPANY_ID")) {
			Registry::set('navigation.tabs.discussion', array (
				'title' => fn_get_lang_var('discussion_title_home_page'),
				'js' => true,
			));
		}
	} else {
		$discussion['is_empty'] = true;

	}

	$view->assign('discussion', $discussion);
}

?>