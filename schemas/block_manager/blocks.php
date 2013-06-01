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
	'menu' => array (
		'templates' => 'blocks/menu',
		'content' => array (
			'items' => array (
				'type' => 'function',
				'function' => array('fn_get_menu_items')
			),
			'menu' => array(
				'type' => 'template',
				'template' => 'views/menus/components/block_settings.tpl',
				'hide_label' => true,
				'data_function' => array('fn_get_menus'),
			),			
		),
		'wrappers' => 'blocks/wrappers',
	),	
	'my_account' => array (
		'templates' => array(
			'blocks/my_account.tpl' => array(),
		),
		'wrappers' => 'blocks/wrappers',
		'content' => array (
			'header_class' => array (
				'type' => 'function',
				'function' => array('fn_get_my_account_title_class'),
			)
		)
	),
	'cart_content' => array (
		'templates' => array(
			'blocks/cart_content.tpl' => array(),
		),
		'settings' => array(
			'display_bottom_buttons' => array (
				'type' => 'checkbox',
				'default_value' => 'Y'
			),
			'display_delete_icons' => array (
				'type' => 'checkbox',
				'default_value' => 'Y'
			),
			'products_links_type' => array (
				'type' => 'selectbox',
				'values' => array (
					'thumb' => 'thumb',
					'text' => 'text',
				),
				'default_value' => 'thumb'
			),
		),
		'wrappers' => 'blocks/wrappers',
	),	
	'breadcrumbs' => array (
		'templates' => array(
			'common_templates/breadcrumbs.tpl' => array(),
		),
		'wrappers' => 'blocks/wrappers',
	),		
	'template' => array (
		'templates' => 'blocks/static_templates',
		'wrappers' => 'blocks/wrappers',
	),
	'main' => array (
		'hide_on_locations' => array(
			'product_tabs'
		),
		'single_for_location' => 1,
		'wrappers' => 'blocks/wrappers',
	),
	'html_block' => array (
		'content' => array (
			'content' => array (
				'type' => 'text',
				'required' => true,
			)
		),
		'templates' => 'blocks/html_block.tpl',
		'wrappers' => 'blocks/wrappers',
		'cache' => array(
			'update_handlers' => array ('bm_blocks_content'),
		)
	),
	'checkout' => array (
		'templates' => 'blocks/checkout',
		'wrappers' => 'blocks/wrappers',
	),
	'products' => array (
		'content' => array (
			'items' => array (
				'type' => 'enum',
				'object' => 'products',
				'items_function' => 'fn_get_products',
				'remove_indent' => true,
				'hide_label' => true,
				'fillings' => array (
					'manually' => array (
						'picker' => 'pickers/products_picker.tpl',
						'picker_params' => array (
							'type' => 'links',
						),
					),
					'newest' => array (
						'params' => array (
							'sort_by' => 'timestamp',
							'sort_order' => 'desc',
							'request' => array (
								'cid' => '%CATEGORY_ID%'
							)
						)
					),
					'recent_products' => array (
						'params' => array (
							'apply_limit' => true,
							'session' => array (
								'pid' => '%RECENTLY_VIEWED_PRODUCTS%'
							),
							'request' => array (
								'exclude_pid' => '%PRODUCT_ID%'
							),
							'force_get_by_ids' => true,
						),
						'disable_cache' => true,
					),				
					'most_popular' => array (
						'params' => array (
							'popularity_from' => 1,
							'sort_by' => 'popularity',
							'sort_order' => 'desc',
							'request' => array (
								'cid' => '%CATEGORY_ID'
							)
						),
					),
				),
			),
		),
		'templates' => 'blocks/products',
		'settings' => array(
			'hide_add_to_cart_button' => array (
				'type' => 'checkbox',
				'default_value' => 'Y'
			)
		),
		'wrappers' => 'blocks/wrappers',
		'cache' => array(
			'update_handlers' => array ('products', 'product_descriptions', 'product_prices', 'products_categories', 'product_popularity'),
			'request_handlers' => array ('current_category_id' => '%CATEGORY_ID%'),
			'session_handlers' => array ('settings' => '%SETTINGS%')
		)
	),
	'categories' => array (
		'content' => array (
			'items' => array (
				'type' => 'enum',
				'object' => 'categories',
				'items_function' => 'fn_get_categories',
				'remove_indent' => true,
				'hide_label' => true,
				'fillings' => array (
					'manually' => array (
						'params' => array (
							'plain' => true,
							'simple' => false,
							'group_by_level' => false,
						),
						'picker' => 'pickers/categories_picker.tpl',
						'picker_params' => array (
							'multiple' => true,
							'use_keys' => 'N',
							'status' => 'A',
						),
					),		
					'newest' => array (
						'params' => array (
							'sort_by' => 'timestamp',
							'plain' => true,
							'visible' => true
						),
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
					'dynamic_tree_cat' => array (
						'params' => array (
							'visible' => true,
							'plain' => true,
							'request' => array (
								'current_category_id' => '%CATEGORY_ID%',
							),
							'session' => array(
								'product_category_id' => '%CURRENT_CATEGORY_ID%'
							)
						),
						'settings' => array (
							'parent_category_id' => array (
								'type' => 'picker',
								'default_value' => '0',
								'picker' => 'pickers/categories_picker.tpl',
								'picker_params' => array (
									'multiple' => false,
									'use_keys' => 'N',
									'default_name' => fn_get_lang_var('root_level'),
								),
							),
						),
					),
					'full_tree_cat' => array (
						'params' => array (
							'plain' => true
						),
						'update_params' => array (
							'request' => array ('%CATEGORY_ID'),
						),
						'settings' => array (
							'parent_category_id' => array (
								'type' => 'picker',
								'default_value' => '0',
								'picker' => 'pickers/categories_picker.tpl',
								'picker_params' => array (
									'multiple' => false,
									'use_keys' => 'N',
									'default_name' => fn_get_lang_var('root_level'),
								),
							),
						),
					),
				),
			)
		),
		'templates' => 	'blocks/categories',
		'wrappers' => 'blocks/wrappers',
		'cache' => array (
			'update_handlers' => array ('categories', 'category_descriptions'),
			'session_handlers' => array ('%CURRENT_CATEGORY_ID%'),
			'request_handlers' => array ('%CATEGORY_ID%')
		),
	),
	
	'product_filters' => array (
		'content' => array (
			'items' => array (
				'type' => 'enum',
				'object' => 'filters',
				'items_function' => 'fn_get_filters_products_count',
				'remove_indent' => true,
				'hide_label' => true,
				'fillings' => array (
					'dynamic' => array (
						'params' => array (
							'check_location' => true,
							'request' => array (
								'dispatch' => '%DISPATCH%',
								'category_id' => '%CATEGORY_ID%',
								'features_hash' => '%FEATURES_HASH%',
								'variant_id' => '%VARIANT_ID%',
								'advanced_filter' => '%advanced_filter%',
								'company_id' => '%COMPANY_ID%'
							),
							'skip_if_advanced' => true,
						)
					),
					'filters' => array (
						'params' => array (
							'get_all' => true,
							'request' => array(
								'features_hash' => '%FEATURES_HASH%',
								'variant_id' => '%VARIANT_ID%',
							),
							'get_custom' => true,
							'skip_other_variants' => true
						),
					)
				)
			),
		),
		'templates' => array (
			'blocks/product_filters/original.tpl' => array (
				'fillings' => array ('dynamic')				
			),
			'blocks/product_filters/custom.tpl' => array (
				'fillings' => array ('filters')
			),
		),
		'wrappers' => 'blocks/wrappers',
	),
	
	'pages' => array (
		'content' => array (
			'items' => array (
				'type' => 'enum',
				'object' => 'pages',
				'items_function' => 'fn_get_pages',
				'remove_indent' => true,
				'hide_label' => true,
				'fillings' => array (
					'manually' => array(
						'picker' => 'pickers/pages_picker.tpl',
						'picker_params' => array (
							'multiple' => true,					
							'status' => 'A',
						)
					),
					'newest' => array (
						'params' => array (
							'sort_by' => 'timestamp',
							'visible' => true,
							'status' => 'A',
						)
					),
					'dynamic_tree_pages' => array (
						'params' => array (
							'visible' => true,
							'get_tree' => 'plain',
							'status' => 'A',
							'request' => array (
								'current_page_id' => '%PAGE_ID%'
							),
							'get_children_count' => true
						),
						'settings' => array (
							'parent_page_id' => array (
								'type' => 'picker',
								'default_value' => '0',
								'picker' => 'pickers/pages_picker.tpl',
								'picker_params' => array (
									'multiple' => false,
									'status' => 'A',
									'default_name' => fn_get_lang_var('all_pages'),
								),
							),
						),
					),
					'full_tree_pages' => array (
						'params' => array (
							'get_tree' => 'plain',
							'status' => 'A',
							'get_children_count' => true,
						),
						'settings' => array (
							'parent_page_id' => array (
								'type' => 'picker',
								'default_value' => '0',
								'picker' => 'pickers/pages_picker.tpl',
								'picker_params' => array (
									'multiple' => false,
									'status' => 'A',
									'default_name' => fn_get_lang_var('all_pages'),
								),
							),
						),
					),
					'neighbours' => array (
						'params' => array (
							'get_tree' => 'plain',
							'status' => 'A',
							'get_children_count' => true,
							'neighbours' => true,
							'request' => array (
								'neighbours_page_id' => '%PAGE_ID%',
							)
						),
					),
					
					'vendor_pages' => array (
						'params' => array (
							'status' => 'A',
							'vendor_pages' => true,
							'request' => array (
								'company_id' => '%COMPANY_ID%',
							)
						),
					)
					
				),
			),
		),
		'templates' => 'blocks/pages',
		'wrappers' => 'blocks/wrappers',		
		'cache' => array (
			'update_handlers' => array ('pages', 'page_descriptions'),
			'session_handlers' => array ('%CURRENT_CATEGORY_ID%'),
			'request_handlers' => array ('%PAGE_ID%', '%COMPANY_ID%')
		),
	),	
	
	'vendors' => array (
		'content' => array (
			'items' => array (
				'type' => 'enum',
				'object' => 'vendors',
				'remove_indent' => true,
				'hide_label' => true,
				'items_function' => 'fn_get_short_companies',
				'fillings' => array (
					'all' => array(),
					'manually' => array (
						'picker' => 'pickers/companies_picker.tpl',
						'picker_params' => array (
							'multiple' => true,
						),
					)
				),
			),
		),	
		'settings' => array (
			'displayed_vendors' => array (
				'type' => 'input',
				'default_value' => '10'
			)
		),
		'templates' => 'blocks/companies_list.tpl',
		'wrappers' => 'blocks/wrappers',
		'cache' => array (
			'update_handlers' => array ('companies', 'company_descriptions'),
		),
	),
	
	'payment_methods' => array (
		'content' => array (
			'items' => array (
				'type' => 'function',
				'function' => array('fn_get_payment_methods_images'),
			),
		),
		'templates' => 'blocks/payments.tpl',
		'wrappers' => 'blocks/wrappers',
		'cache' => array (
			'update_handlers' => array ('payments', 'payment_descriptions'),
		),
	),

	'shipping_methods' => array (
		'content' => array (
			'items' => array (
				'type' => 'function',
				'function' => array('fn_get_shipping_images'),
			),
		),
		'templates' => 'blocks/shippings.tpl',
		'wrappers' => 'blocks/wrappers',
		'cache' => array (
			'update_handlers' => array ('shippings', 'shipping_descriptions'),
		),
	),
	'currencies' => array(
		'content' => array (
			'currencies' => array (
				'type' => 'function',
				'function' => array('fn_get_currencies'),
			),
		),
		'settings' => array (
			'text' => array (
				'type' => 'input',
				'default_value' => ''
			),
			'format' => array (
				'type' => 'selectbox',
				'values' => array (
					'name' => 'opt_currency_name',
					'symbol' => 'opt_currency_symbol',
				),
				'default_value' => 'name'
			),
			'dropdown_limit' => array (
				'type' => 'input',
				'default_value' => '0'
			)
		),
		'templates' => 'blocks/currencies.tpl',
		'wrappers' => 'blocks/wrappers',
	),

	'languages' => array(
		'content' => array (
			'languages' => array (
				'type' => 'function',
				'function' => array('fn_get_languages'),
			),
		),
		'settings' => array (
			'text' => array (
				'type' => 'input',
				'default_value' => ''
			),
			'format' => array (
				'type' => 'selectbox',
				'values' => array (
					'name' => 'opt_language_name',
					'icon' => 'opt_language_icon',
				),
				'default_value' => 'name'
			),
			'dropdown_limit' => array (
				'type' => 'input',
				'default_value' => '0'
			)
		),
		'templates' => 'blocks/languages.tpl',
		'wrappers' => 'blocks/wrappers',
	),
);

if (Registry::get('config.tweaks.disable_localizations') != true) {
	$schema['localizations'] = array(
		'templates' => 'blocks/localizations.tpl',
		'wrappers' => 'blocks/wrappers',
	);
}

?>
