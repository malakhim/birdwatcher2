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
		'name' => 'date_of_birth',
		'description' => fn_get_lang_var('date_of_birth'),
		'value' => '',
		'option_type' =>  'D',
		'position' => 10,
	),
	array (
		'option_id' => 2,
		'name' => 'last4ssn',
		'description' => fn_get_lang_var('last4ssn'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 20,
	),
	array (
		'option_id' => 3,
		'name' => 'phone',
		'description' => fn_get_lang_var('phone'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 30,
	),
	array (
		'option_id' => 4,
		'name' => 'passport_number',
		'description' => fn_get_lang_var('passport_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 40,
	),
	array (
		'option_id' => 5,
		'name' => 'drlicense_number',
		'description' => fn_get_lang_var('drlicense_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 50,
	),
	array (
		'option_id' => 6,
		'name' => 'routing_code',
		'description' => fn_get_lang_var('routing_code'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 60,
	),
	array (
		'option_id' => 7,
		'name' => 'account_number',
		'description' => fn_get_lang_var('account_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 70,
	),
	array (
		'option_id' => 8,
		'name' => 'check_number',
		'description' => fn_get_lang_var('check_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 80,
	),
);

?>