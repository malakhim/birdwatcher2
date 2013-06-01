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
		'name' => 'po_number',
		'description' => fn_get_lang_var('po_number'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 10,
	),
	array (
		'option_id' => 2,
		'name' => 'company_name',
		'description' => fn_get_lang_var('company_name'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 20,
	),
	array (
		'option_id' => 3,
		'name' => 'buyer_name',
		'description' => fn_get_lang_var('buyer_name'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 30,
	),
	array (
		'option_id' => 4,
		'name' => 'position',
		'description' => fn_get_lang_var('position'),
		'value' => '',
		'option_type' =>  'I',
		'position' => 40,
	),
);

?>