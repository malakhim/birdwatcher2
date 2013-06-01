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

$schema = array (
	'section' => 'subscribers',
	'pattern_id' => 'subscribers',
	'name' => fn_get_lang_var('subscribers'),
	'key' => array('subscriber_id'),
	'table' => 'subscribers',
	'references' => array (
		'user_mailing_lists' => array (
			'reference_fields' => array('subscriber_id' => '#key'),
			'join_type' => 'LEFT',
			'alt_key' => array('#key', 'list_id')
		),
	),
	'range_options' => array (
		'selector_url' => 'subscribers.manage',
		'object_name' => fn_get_lang_var('subscribers'),
	),
	'options' => array (
		'lang_code' => array (
			'title' => 'language',
			'type' => 'languages',
		)
	),
	'export_fields' => array (
		'E-mail' => array (
			'db_field' => 'email',
			'required' => true,
			'alt_key' => true
		),
		'Mailing list' => array (
			'db_field' => 'list_id',
			'required' => true,
			'table' => 'user_mailing_lists',
			'process_get' => array ('fn_export_convert_mailing_list', '#this', '@lang_code'),
			'convert_put' => array ('fn_import_convert_mailing_list', '#this'),
		),
		'Activation key' => array (
			'db_field' => 'activation_key',
			'table' => 'user_mailing_lists'
		),
		'Unsubscribe key' => array (
			'db_field' => 'unsubscribe_key',
			'table' => 'user_mailing_lists'
		),
		'Confirmed' => array (
			'db_field' => 'confirmed',
			'table' => 'user_mailing_lists'
		),
		'Language' => array (
			'db_field' => 'lang_code',
			'required' => true,
			'table' => 'user_mailing_lists'
		),
		'Format' => array (
			'db_field' => 'format',
			'required' => true,
			'table' => 'user_mailing_lists',
			'process_get' => array ('fn_export_convert_format', '#this'),
			'convert_put' => array ('fn_import_convert_format', '#this'),
		),
		'Subscribers date' => array (
			'db_field' => 'timestamp',
			'import_only' => true,
			'convert_put' => array ('fn_import_date_to_timestamp'),
			'default' => array ('fn_import_date_to_timestamp'),
		),
		'Mailing list date' => array (
			'db_field' => 'timestamp',
			'table' => 'user_mailing_lists',
			'import_only' => true,
			'convert_put' => array ('fn_import_date_to_timestamp'),
			'default' => array ('fn_import_date_to_timestamp'),
		)
	),
);

function fn_import_date_to_timestamp($date)
{
	$date = !empty($date) ? $date : date("H:i:s");
	return strtotime($date);
}

function fn_export_convert_mailing_list($list_id, $lang_code)
{
	$lang_code = !empty($lang_code) ? $lang_code : DEFAULT_LANGUAGE;
	if (!empty($list_id)) {
		return db_get_field("SELECT object FROM ?:common_descriptions WHERE object_holder = 'mailing_lists' AND object_id = ?i AND lang_code = ?s", $list_id, $lang_code);
	} else {
		return '';
	}
}

function fn_import_convert_mailing_list($list_name)
{
	return db_get_field("SELECT object_id FROM ?:common_descriptions WHERE object_holder = 'mailing_lists' AND object = ?s", $list_name);
}

function fn_export_convert_format($format_id)
{
	$format_id = !empty($format_id) ? $format_id : 1;

	$formats = fn_mailing_lists_formats();

	return $formats[$format_id];
}

function fn_import_convert_format($format)
{
	if (empty($format)) {
		return '';
	}
	$formats = fn_mailing_lists_formats();

	return array_search($format, $formats);
}

function fn_mailing_lists_formats()
{
	return array (
		'1' => 'Plain text',
		'2' => 'HTML'
	);
}
?>