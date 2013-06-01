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
	
	$selected_fields = $view->get_var('selected_fields');

	$selected_fields[] = array(
		'name' => '[data][is_returnable]',	
		'text' => fn_get_lang_var('returnable')
	);

	$selected_fields[] = array(
		'name' => '[data][return_period]',	
		'text' => fn_get_lang_var('return_period')
	);

	$view->assign('selected_fields', $selected_fields);

} elseif ($mode == 'm_update') {

	$selected_fields = $_SESSION['selected_fields'];

	$field_groups = $view->get_var('field_groups');
	$filled_groups = $view->get_var('filled_groups');
	$field_names = $view->get_var('field_names');

	if (!empty($selected_fields['data']['return_period'])) {
		$field_groups['B']['return_period'] = 'products_data';
		$filled_groups['B']['return_period'] = fn_get_lang_var('return_period');		
	}

	if (!empty($selected_fields['data']['is_returnable'])) {	
		$field_groups['C']['is_returnable'] = 'products_data';
		$filled_groups['C']['is_returnable'] = fn_get_lang_var('returnable_product');	
	}

	if (isset($field_names['is_returnable'])) {
		unset($field_names['is_returnable']);
	}
	if (isset($field_names['return_period'])) {
		unset($field_names['return_period']);
	}

	$view->assign('field_groups', $field_groups);
	$view->assign('filled_groups', $filled_groups);
	$view->assign('field_names', $field_names);
}

?>