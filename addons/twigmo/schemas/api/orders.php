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
	'table' => 'orders',
	'object_name' => 'order',
	'key' => array('order_id'),
	'references' => array (
		'payment_descriptions' => array (
			'join_type' => 'LEFT',
			'fields' => array (		
				'payment_id' => array (
					'db_field' => 'payment_id'
				),
				'lang_code' => array (
					'param' => 'lang_code'
				)
			)
		)
	),	
	'fields' => array (
		'order_id' => array (
			'db_field' => 'order_id'
		),
		'user_id' => array (
			'db_field' => 'user_id'
		),
		'total' => array (
			'db_field' => 'total'
		),
		'subtotal' => array (
			'db_field' => 'subtotal'
		),
		'discount' => array (
			'db_field' => 'discount'
		),
		'payment_surcharge' => array (
			'db_field' => 'payment_surcharge'
		),
		'payment_name' => array (
			'table' => 'payment_descriptions',
			'db_field' => 'payment'
		),
		'shipping_cost' => array (
			'db_field' => 'shipping_cost'
		),
		'timestamp' => array (
			'db_field' => 'timestamp'
		),
		'status' => array (
			'db_field' => 'status'
		),
		'notes' => array (
			'db_field' => 'notes'
		),
		'details' => array (
			'db_field' => 'details'
		),
		'title' => array (
			'db_field' => 'title'
		),
		'firstname' => array (
			'db_field' => 'firstname'
		),
		'lastname' => array (
			'db_field' => 'lastname'
		),
		'company' => array (
			'db_field' => 'company'
		),
		'bill_to' => array (
			'process_get' => array (
				'func' => 'fn_get_address_by_type',
				'params' => array (
					'profile_fields' => array (
						'db_field' => '*'
					),
					'type' => array (
						'value' => 'billing'
					),
					'lang_code' => array (
						'param' => 'lang_code'
					)
				)
			),
			'process_put' => array (
				'func' => 'fn_parse_api_order_address',
				'is_extract' => 'true',
				'params' => array (
					'address' => array (
						'api_field' => 'bill_to'
					),
					'type' => array (
						'value' => 'billing'
					),
				)
			),
			'schema' => array (
				'type' => 'addresses',
				'is_single' => true
			),
		),
		'ship_to' => array (
			'process_get' => array (
				'func' => 'fn_get_address_by_type',
				'params' => array (
					'profile_fields' => array (
						'db_field' => '*'
					),
					'type' => array (
						'value' => 'shipping'
					),
					'lang_code' => array (
						'param' => 'lang_code'
					)
				)
			),
			'process_put' => array (
				'func' => 'fn_parse_api_order_address',
				'is_extract' => 'true',
				'params' => array (
					'address' => array (
						'api_field' => 'ship_to'
					),
					'type' => array (
						'value' => 'shipping'
					),
				)
			),
			'schema' => array (
				'type' => 'addresses',
				'is_single' => true
			),
		),
		'phone' => array (
			'db_field' => 'phone'
		),
		'fax' => array (
			'db_field' => 'fax'
		),
		'url' => array (
			'db_field' => 'url'
		),
		'email' => array (
			'db_field' => 'email'
		),
		'tax_exempt' => array (
			'db_field' => 'tax_exempt'
		),
		'ip_address' => array (
			'db_field' => 'ip_address'
		),
		'repaid' => array (
			'db_field' => 'repaid'
		),
		'validation_code' => array (
			'db_field' => 'validation_code'
		),
		'payment_method' => array (
			'schema' => array (
				'is_single' => true,
				'type' => 'payments',
				'name' => 'payment_method',
				'filter' => array (
					'payment_id' => array (
						'db_field' => 'payment_id'
					)
				)			
			)
		),
		'payment_information' => array (
			'process_get' => array (
				'func' => 'fn_api_orders_get_data', 
				'params' => array (
					'order_id' => array (
						'db_field' => 'order_id', 
					),
					'type' => array (
						'value' => 'P'
					),
					'object_type' => array (
						'value' => 'payment_information'
					),
					'object' => array (
						'db_field' => 'payment_info'
					)
				)
			),
			'process_put' => array (
				'name' => 'payment_info',
				'func' => 'fn_api_orders_set_data', 
				'params' => array (
					'object_type' => array (
						'value' => 'payment_information'
					),
					'object' => array (
						'api_field' => 'payment_information'
					)
				)
			)
		),
		'taxes' => array (
			'process_get' => array (
				'func' => 'fn_api_orders_get_data', 
				'params' => array (
					'order_id' => array (
						'db_field' => 'order_id', 
					),
					'type' => array (
						'value' => 'T'
					),
					'object_type' => array (
						'value' => 'taxes'
					),
					'object' => array (
						'db_field' => 'taxes'
					),
					'single' => array (
						'value' => false
					)
				)
			),
			'process_put' => array (
				'name' => 'taxes',
				'func' => 'fn_api_orders_set_data', 
				'params' => array (
					'object_type' => array (
						'value' => 'taxes'
					),
					'object' => array (
						'api_field' => 'taxes'
					),
					'single' => array (
						'value' => false
					)
				)
			)
		),
		'shippings' => array (
			'process_get' => array (
				'func' => 'fn_api_orders_get_data', 
				'params' => array (
					'order_id' => array (
						'db_field' => 'order_id', 
					),
					'type' => array (
						'value' => 'L'
					),
					'object_type' => array (
						'value' => 'shippings'
					),
					'object' => array (
						'db_field' => 'shippings'
					),
					'single' => array (
						'value' => false
					)
				)
			),
			'process_put' => array (
				'name' => 'shippings',
				'func' => 'fn_api_orders_set_data', 
				'params' => array (
					'object_type' => array (
						'value' => 'shippings'
					),
					'object' => array (
						'api_field' => 'shippings'
					),
					'single' => array (
						'value' => false
					)
				)
			)
		),
		'products' => array (
			'schema' => array (
				'name' => 'products',
				'type' => 'order_products',
				'filter' => array (
					'order_id' => array (
						'db_field' => 'order_id'
					)
				)			
			)
		),
		'gift_certificates' => array (
			'schema' => array (
				'name' => 'gift_certificates',
				'type' => 'gift_certificates',
				'filter' => array (
					'order_id' => array (
						'db_field' => 'order_id'
					)
				)			
			)
		),
		'users' => array (
			'schema' => array (
				'single' => true,
				'type' => 'users',
				'filter' => array (
					'user_id' => array (
						'db_field' => 'user_id'
					)
				)			
			)
		)
	)
);

?>