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

	return;
}

if ($mode == 'manage') {

	if ($_REQUEST['type'] == STATUSES_RETURN) {

		$view->assign('title', fn_get_lang_var('rma_request_statuses'));

		fn_rma_generate_sections('statuses');

		// I think this should be removed, not good, must be done on xml menu level
		Registry::set('navigation.selected_tab', 'orders');
		Registry::set('navigation.subsection', 'return_requests');
	}
}


?>