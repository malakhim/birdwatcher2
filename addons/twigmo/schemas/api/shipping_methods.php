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
	'object_name' => 'shipping_method',
	'key' => array('shipping_id'),
	'fields' => array (
		'shipping_id' => array (
			'name' => 'shipping_id'
		),
		'name' => array (
			'name' => 'name'
		),
		'rates' => array (
			'process_get' => array (
				'func' => 'array_sum',
				'params' => array (
					'rates' => array (
						'db_field' => 'rates'
					),
				)
			)
		),
		'rate' => array (
			'process_get' => array (
				'func' => 'floatval',
				'params' => array (
					'val' => array (
						'db_field' => 'rate'
					),
				)
			)
		),
		'delivery_time' => array (
			'name' => 'delivery_time'
		),
		'taxed_price' => array (
			'name' => 'taxed_price'
		),
		'total_price' => array (
			'name' => 'total_price'
		),
	)
);

?>