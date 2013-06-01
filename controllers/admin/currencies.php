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


if ( !defined('AREA') )	{ die('Access denied');	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//
	// Update currency
	//
	if ($mode == 'update') {
		$currency_code = fn_update_currency($_REQUEST['currency_data'], $_REQUEST['currency_code'], DESCR_SL);
		if (empty($currency_code)) {
			fn_delete_notification('changes_saved');
		}
	}

	return array(CONTROLLER_STATUS_OK, "currencies.manage");
}

// ---------------------- GET routines ---------------------------------------

if ($mode == 'manage') {

	$currencies = db_get_array("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s ORDER BY position", DESCR_SL);

	$view->assign('currencies_data', $currencies);

} elseif ($mode == 'delete') {

	if (!empty($_REQUEST['currency_code'])) {
		if ($_REQUEST['currency_code'] != CART_PRIMARY_CURRENCY) {
			db_query("DELETE FROM ?:currencies WHERE currency_code = ?s", $_REQUEST['currency_code']);
			db_query("DELETE FROM ?:currency_descriptions WHERE currency_code = ?s", $_REQUEST['currency_code']);
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('currency_deleted'));
		} else {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('base_currency_not_deleted'));
		}
	}

	return array(CONTROLLER_STATUS_REDIRECT, "currencies.manage");

} elseif ($mode == 'update') {

	if (!empty($_REQUEST['currency_code'])) {
		$currency = db_get_row("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s WHERE a.currency_code = ?s", DESCR_SL, $_REQUEST['currency_code']);

		$view->assign('currency', $currency);
	}
}

function fn_update_currency($currency_data, $currency_code, $lang_code = DESCR_SL)
{
	$currency_data['currency_code'] = strtoupper($currency_data['currency_code']);
	$currency_data['coefficient'] = !empty($currency_data['is_primary']) || !isset($currency_data['coefficient']) ? 1 : $currency_data['coefficient'];

	if (empty($currency_data['coefficient']) || floatval($currency_data['coefficient']) <= 0) {
		fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('currency_rate_greater_than_null'));

		return false;
	}

	if (empty($currency_code) || $currency_code != $currency_data['currency_code']) {
		$is_exists = db_get_field("SELECT COUNT(*) FROM ?:currencies WHERE currency_code = ?s", $currency_data['currency_code']);
	}

	if (!empty($is_exists)) {
		$msg = fn_get_lang_var('error_currency_exists');
		$msg = str_replace('[code]', $currency_data['currency_code'], $msg);
		fn_set_notification('E', fn_get_lang_var('error'), $msg);
		
		return false;
	}

	if (isset($currency_data['decimals']) && $currency_data['decimals'] > 2) {
		$msg = fn_get_lang_var('notice_too_many_decimals');
		$msg = str_replace('[DECIMALS]', $currency_data['decimals'], $msg);
		$msg = str_replace('[CURRENCY]', $currency_data['currency_code'], $msg);
		fn_set_notification('W', fn_get_lang_var('warning'), $msg);
	}

	if (!empty($currency_data['is_primary'])) {
		db_query("UPDATE ?:currencies SET is_primary = 'N' WHERE is_primary = 'Y'");
	}

	if (empty($currency_code)) {
		db_query("INSERT INTO ?:currencies ?e", $currency_data);
		fn_create_description('currency_descriptions', 'currency_code', $currency_data['currency_code'], $currency_data);

		$currency_code = $currency_data['currency_code'];
	} else {
		db_query("UPDATE ?:currencies SET ?u WHERE currency_code = ?s", $currency_data, $currency_code);
		db_query('UPDATE ?:currency_descriptions SET ?u WHERE currency_code = ?s AND lang_code = ?s', $currency_data, $currency_code, $lang_code);
	}

	return $currency_code;
}

?>