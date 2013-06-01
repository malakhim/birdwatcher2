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

if (PRODUCT_TYPE != 'ULTIMATE' && fn_check_suppliers_functionality() && fn_se_get_import_status(fn_se_get_company_id(), CART_LANGUAGE) == 'done') {

	$se_active_companies = db_get_fields("SELECT company_id FROM ?:companies WHERE status = 'A'");

	$se_active_companies = join('|', $se_active_companies);

	$se_active_companies = '0'. (empty($se_active_companies)? '': '|') . $se_active_companies;

	Registry::set('se_active_companies', $se_active_companies);

	$view->assign('se_active_companies', $se_active_companies);
}

fn_se_check_import_is_done();

$view->assign('searchanise_api_key', fn_se_get_api_key(fn_se_get_company_id(), CART_LANGUAGE));
$view->assign('searchanise_import_status', fn_se_get_import_status(fn_se_get_company_id(), CART_LANGUAGE));

?>