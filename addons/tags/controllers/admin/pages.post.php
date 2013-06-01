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

//
// View page details
//
if ($mode == 'add' && Registry::get('addons.tags.tags_for_pages') == 'Y') {
	if (defined("COMPANY_ID") && PRODUCT_TYPE == 'ULTIMATE' || PRODUCT_TYPE != 'ULTIMATE') {
		Registry::set('navigation.tabs.tags', array(
			'title' => fn_get_lang_var('tags'),
			'js' => true
		));
	}

} elseif ($mode == 'update' && Registry::get('addons.tags.tags_for_pages') == 'Y') {
	if (defined("COMPANY_ID") && PRODUCT_TYPE == 'ULTIMATE' || PRODUCT_TYPE != 'ULTIMATE') {
		Registry::set('navigation.tabs.tags', array(
			'title' => fn_get_lang_var('tags'),
			'js' => true
		));
	}	
}

?>