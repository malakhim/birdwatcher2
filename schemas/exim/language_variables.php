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
	'section' => 'translations',
	'pattern_id' => 'language_variables',
	'name' => fn_get_lang_var('language_variables'),
	'key' => array('name', 'lang_code'),
	'order' => 1,
	'table' => 'language_values',
	'condition' => array('lang_code' => '@lang_code'),
	'options' => array (
		'lang_code' => array (
			'title' => 'language',
			'type' => 'languages'
		),
	),
	'export_fields' => array (
		'Name' => array (
			'db_field' => 'name',
			'alt_key' => true,
			'required' => true,
		),
		'Value' => array (
			'db_field' => 'value',
			'required' => true,
		),
		'Language' => array (
			'db_field' => 'lang_code',
			'alt_key' => true,
			'required' => true,
		),
	),
);

?>