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
	array (
		'option_id' => 1,
		'name' => 'card',
		'description' => fn_get_lang_var('select_card'),
		'value' => '',
		'option_type' =>  'S',
		'position' => 10,
		'option_variants' => fn_api_get_credit_cards()
	),
	array (
		'option_id' => 2,
		'name' => 'card_number',
		'description' => fn_get_lang_var('card_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 20,
	),
	array (
		'option_id' => 3,
		'name' => 'cardholder_name',
		'description' => fn_get_lang_var('cardholder_name'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 30,
	),
	array (
		'option_id' => 4,
		'name' => 'start_date',
		'description' => fn_get_lang_var('start_date'),
		'value' => '',
		'option_type' =>  'D',
		'position' => 40,
	),
	array (
		'option_id' => 5,
		'name' => 'expiry_date',
		'description' => fn_get_lang_var('expiry_date'),
		'value' => '',
		'option_type' =>  'D',
		'position' => 50,
	),
	array (
		'option_id' => 6,
		'name' => 'cvv2',
		'description' => fn_get_lang_var('cvv2'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 60,
	),
	array (
		'option_id' => 7,
		'name' => 'issue_number',
		'description' => fn_get_lang_var('issue_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 70,
	),
);

?>