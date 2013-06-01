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
	'manual' => array (
		'type' => 'picker',
	),
	'newest' => array (
		'period' => array (
			'type' => 'selectbox',
			'values' => array (
				'A' => 'any_date',
				'D' => 'today',
				'HC' => 'last_days',
			),
			'default_value' => 'any_date'
		),
		'last_days' => array (
			'type' => 'input',
			'default_value' => 1
		),
		'limit' => array (
			'type' => 'input',
			'default_value' => 3
		)
	),
	
	'filters' => array(
		'filter_id' => array (
			'type' => 'selectbox',
			'option_name' => 'show',
			'no_lang' => true,
			'data_function' => array('fn_get_simple_product_filters'),
		),
	),
	
	'recent_products' => array (
		'limit' => array (
			'type' => 'input',
			'default_value' => 3
		)
	),
	'most_popular' => array (
		'limit' => array (
			'type' => 'input',
			'default_value' => 3
		)
	),
);

?>
