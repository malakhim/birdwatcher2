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

fn_trusted_vars("processor_params", "payment_data");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//
	// Update payment method
	//
	if ($mode == 'update') {

		fn_update_payment($_REQUEST['payment_data'], $_REQUEST['payment_id']);
	}

	return array(CONTROLLER_STATUS_OK, "payments.manage");
}

// If any method is selected - show it's settings
if ($mode == 'processor') {
	$processor_data = fn_get_processor_data($_REQUEST['payment_id']);

	// We're selecting new processor
	if (!empty($_REQUEST['processor_id']) && (empty($processor_data['processor_id']) || $processor_data['processor_id'] != $_REQUEST['processor_id'])) {
		$processor_data = db_get_row("SELECT * FROM ?:payment_processors WHERE processor_id = ?i", $_REQUEST['processor_id']);
		$processor_data['params'] = array();
		$processor_data['currencies'] = (!empty($processor_data['currencies'])) ? explode(',', $processor_data['currencies']) : array();
	}

	$view->assign('processor_template', $processor_data['admin_template']);
	$view->assign('processor_params', $processor_data['params']);
	$view->assign('processor_name', $processor_data['processor']);
	$view->assign('callback', $processor_data['callback']);
	$view->assign('payment_id', $_REQUEST['payment_id']);

// Show methods list
} elseif ($mode == 'manage') {

	$payments = db_get_array("SELECT ?:payments.*, ?:payment_descriptions.* FROM ?:payments LEFT JOIN ?:payment_descriptions ON ?:payment_descriptions.payment_id = ?:payments.payment_id AND ?:payment_descriptions.lang_code = ?s ORDER BY ?:payments.position", DESCR_SL);

	$view->assign('usergroups', fn_get_usergroups('C', DESCR_SL));
	$view->assign('payments', $payments);
	$view->assign('templates', fn_get_payment_templates());
	$view->assign('payment_processors', fn_get_payment_processors());

} elseif ($mode == 'update') {
	$payment = fn_get_payment_method_data($_REQUEST['payment_id'], DESCR_SL);
	$payment['icon'] = fn_get_image_pairs($payment['payment_id'], 'payment', 'M', true, true, DESCR_SL);

	$view->assign('usergroups', fn_get_usergroups('C', DESCR_SL));
	$view->assign('payment', $payment);
	$view->assign('templates', fn_get_payment_templates($payment));
	$view->assign('payment_processors', fn_get_payment_processors());
	$view->assign('taxes', fn_get_taxes());

	if (defined('COMPANY_ID') && intval(COMPANY_ID) && COMPANY_ID != $payment['company_id']) {
		$view->assign('hide_for_vendor', true);
	}

} elseif ($mode == 'delete') {
	if (!empty($_REQUEST['payment_id'])) {
		$result = fn_delete_payment($_REQUEST['payment_id']);

		if ($result) {
			fn_set_notification('N', fn_get_lang_var('notice'), fn_get_lang_var('text_payment_have_been_deleted'));
		} else {
			fn_set_notification('W', fn_get_lang_var('warning'), fn_get_lang_var('text_payment_have_not_been_deleted'));
		}

		$count = db_get_field("SELECT COUNT(*) FROM ?:payments");
		if (empty($count)) {
			$view->display('views/payments/manage.tpl');
		}
	}
	exit;
}

function fn_get_payment_templates($payment = array())
{
	if (PRODUCT_TYPE == 'ULTIMATE') {
		if (!empty($payment['company_id'])) {
			$company_id = $payment['company_id'];
		} elseif (defined('COMPANY_ID')) {
			$company_id = COMPANY_ID;
		} else {
			$company_id = fn_get_default_company_id();
		}
		
		$skin_name = CSettings::instance()->get_value('skin_name_customer', '', $company_id);
		$vendor_path = fn_get_vendor_path($company_id);
		
		$skin_path = DIR_ROOT . $vendor_path . '/skins/' . $skin_name;
	} else {
		$skin_path = DIR_SKINS . Registry::get('settings.skin_name_customer');
	}
			
	$templates = fn_get_dir_contents($skin_path . '/customer/views/orders/components/payments/', false, true, '.tpl');

	if (is_array($templates)) {
		foreach ($templates as $k => $v) {
			$templates[$k] = $v;
		}
	}

	return $templates;
}

function fn_update_payment($payment_data, $payment_id, $lang_code = DESCR_SL)
{
	if (!empty($payment_data['processor_id'])) {
		$payment_data['template'] = db_get_field("SELECT processor_template FROM ?:payment_processors WHERE processor_id = ?i", $payment_data['processor_id']);
	}

	$payment_data['localization'] = !empty($payment_data['localization']) ? fn_implode_localizations($payment_data['localization']) : '';
	$payment_data['usergroup_ids'] = !empty($payment_data['usergroup_ids']) ? implode(',', $payment_data['usergroup_ids']) : '0';
	$payment_data['tax_ids'] = !empty($payment_data['tax_ids']) ? fn_create_set($payment_data['tax_ids']) : '';

	if (!empty($payment_id)) {
		db_query("UPDATE ?:payments SET ?u WHERE payment_id = ?i", $payment_data, $payment_id);
		db_query("UPDATE ?:payment_descriptions SET ?u WHERE payment_id = ?i AND lang_code = ?s", $payment_data, $payment_id, $lang_code);
	} else {
		$payment_data['payment_id'] = $payment_id = db_query("INSERT INTO ?:payments ?e", $payment_data);
		foreach ((array)Registry::get('languages') as $payment_data['lang_code'] => $_v) {
			db_query("INSERT INTO ?:payment_descriptions ?e", $payment_data);
		}
	}

	fn_attach_image_pairs('payment_image', 'payment', $payment_id, $lang_code);

	// Update payment processor settings
	if (!empty($payment_data['processor_params'])) {
		db_query("UPDATE ?:payments SET params = ?s WHERE payment_id = ?i", serialize($payment_data['processor_params']), $payment_id);
	}

	return $payment_id;
}

function fn_get_payment_processors($lang_code = CART_LANGUAGE)
{
	return db_get_hash_array("SELECT a.processor_id, a.processor, a.type, b.value as description FROM ?:payment_processors as a LEFT JOIN ?:language_values as b ON b.name = CONCAT('processor_description_', REPLACE(a.processor_script, '.php', '')) AND lang_code = ?s ORDER BY processor", 'processor_id', $lang_code);
}

?>