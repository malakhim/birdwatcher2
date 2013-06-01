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

//
// Schema definition
//

$schema = array(
	'shippings' => array(
		'tables' => array(
			array(
				'name' => 'shippings',
				'key' => 'shipping_id',
				'use_objects_sharing' => true,
				'post_process' => 'processShippings',
				'children' => array(
					array(
						'name' => 'shipping_rates',
						'key' => 'shipping_id',
						'exclude' => array('rate_id'),
						'post_process' => 'processShippingRates',
					),
					array(
						'name' => 'shipping_descriptions',
						'key' => 'shipping_id',
					),
				),
			),
		),
	),
	'destinations' => array(
		'tables' => array(
			array(
				'name' => 'destinations',
				'key' => 'destination_id',
				'condition' => array(
					'destination_id <> 1', // Exclude default destination
				),
				'children' => array(
					array(
						'name' => 'destination_descriptions',
						'key' => 'destination_id',
					),
					array(
						'name' => 'destination_elements',
						'key' => 'destination_id',
						'exclude' => array('element_id'),
					),
				),
			),
		),
		'function' => 'processDestinations',
	),

	'payments' => array(
		'tables' => array(
			array(
				'name' => 'payments',
				'key' => 'payment_id',
				'use_objects_sharing' => true,
				'post_process' => 'processPayments',
				'children' => array(
					array(
						'name' => 'payment_descriptions',
						'key' => 'payment_id',
					),
					array(
						'name' => 'order_transactions',
						'key' => 'payment_id',
					),
				),
			),
		),
		'use_objects_sharing' => true,
	),

	'product_features' => array(
		'tables' => array(
			array(
				'name' => 'product_features',
				'key' => 'feature_id',
				'dependence_tree' => true,
				'post_process' => 'processFeatures',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'product_features_descriptions',
						'key' => 'feature_id',
					),
				),
			),
			array(
				'name' => 'product_feature_variants',
				'key' => 'variant_id',
				'post_process' => 'processFeatureVariants',
				'check_fields' => array(
					array('feature_id', 'product_features'),
				),
				'children' => array(
					array(
						'name' => 'product_feature_variant_descriptions',
						'key' => 'variant_id',
					),
				),
			),
		),
		'function' => 'copyFeatureValues',
	),

	'product_filters' => array(
		'tables' => array(
			array(
				'name' => 'product_filters',
				'key' => 'filter_id',
				'post_process' => 'processFilters',
				'use_objects_sharing' => true,
				'check_fields' => array(
					array('feature_id', 'product_features'),
				),
				'children' => array(
					array(
						'name' => 'product_filter_descriptions',
						'key' => 'filter_id',
					),
				),
			),
			array(
				'name' => 'product_filter_ranges',
				'key' => 'range_id',
				'post_process' => 'processFilterRanges',
				'check_fields' => array(
					array('feature_id', 'product_features'),
				),
				'children' => array(
					array(
						'name' => 'product_filter_ranges_descriptions',
						'key' => 'range_id',
					),
				),
			),
		),
	),

	'sitemap' => array(
		'tables' => array(
			array(
				'name' => 'sitemap_sections',
				'key' => 'section_id',
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "sitemap_sections"'
						),
					),
				),
			),
			array(
				'name' => 'sitemap_links',
				'key' => 'link_id',
				'post_process' => 'processSitemapLinks',
				'check_fields' => array(
					array('section_id', 'sitemap_sections'),
				),
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "sitemap_links"'
						),
					)
				)
			),
		),
	),

	'products' => array(
		'tables' => array(
			array(
				'name' => 'products',
				'key' => 'product_id',
				'children' => array(
					array(
						'name' => 'product_descriptions',
						'key' => 'product_id',
					),
					array(
						'name' => 'product_prices',
						'key' => 'product_id',
						'post_process' => 'processProductPrices'
					),
				),
			),
			array(
				'name' => 'product_options',
				'key' => 'option_id',
				'post_process' => 'processProductOptions',
				'check_fields' => array(
					array('product_id', 'products'),
				),
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'product_options_descriptions',
						'key' => 'option_id',
					),
				),
			),
			array(
				'name' => 'product_option_variants',
				'key' => 'variant_id',
				'post_process' => 'processProductOptionVariants',
				'check_fields' => array(
					array('option_id', 'product_options'),
				),
				'children' => array(
					array(
						'name' => 'product_option_variants_descriptions',
						'key' => 'variant_id',
					),
				),
			),
			array(
				'name' => 'product_options_exceptions',
				'key' => 'exception_id',
				'check_fields' => array(
					array('product_id', 'products'),
				),
				'post_process' => 'processProductOptionsExceptions',
			),
			array(
				'name' => 'product_files',
				'key' => 'file_id',
				'check_fields' => array(
					array('product_id', 'products'),
				),
				'post_process' => 'processProductFiles',
				'children' => array(
					array(
						'name' => 'product_file_descriptions',
						'key' => 'file_id',
					),
				),
			),
		),
		'function' => 'copyProducts',
	),
	'categories' => array(
		'tables' => array(
			array(
				'name' => 'categories',
				'key' => 'category_id',
				'post_process' => 'processCategories',
				'dependence_tree' => true,
				'children' => array(
					array(
						'name' => 'category_descriptions',
						'key' => 'category_id',
					),
				),
			),
		),
	),
	'languages' => array(
		'function' => 'copyLanguages',
	),
	'currencies' => array(
		'function' => 'copyCurrencies',
	),
	'taxes' => array(
		'tables' => array(
			array(
				'name' => 'taxes',
				'key' => 'tax_id',
				'children' => array(
					array(
						'name' => 'tax_descriptions',
						'key' => 'tax_id',
					),
					array(
						'name' => 'tax_rates',
						'key' => 'tax_id',
						'exclude' => array('rate_id'),
						'post_process' => 'processTaxRates',
					),
				),
			),
		),
	),

	'countries' => array(
		'tables' => array(
			array(
				'name' => 'countries',
				'key' => 'code',
				'permanent_key' => true,
				'children' => array(
					array(
						'name' => 'country_descriptions',
						'key' => 'code',
						'permanent_key' => true,
					),
				),
			),
		),
	),

	'states' => array(
		'function' => 'copyStates'
	),

	'statuses' => array(
		'function' => 'copyStatuses'
	),

	'pages' => array(
		'tables' => array(
			array(
				'name' => 'pages',
				'key' => 'page_id',
				'dependence_tree' => true,
				'post_process' => 'processPages',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'page_descriptions',
						'key' => 'page_id',
					),
				),
			),
		),
	),

	'static_data' => array(
		'tables' => array(
			array(
				'name' => 'static_data',
				'key' => 'param_id',
				'condition' => array(
					'section IN (\'C\', \'T\')', // copy only shared data
				),
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'static_data_descriptions',
						'key' => 'param_id',
					),
				),
			),
		),
		'function' => 'copyStaticData',
	),

	'users' => array(
		'tables' => array(
			array(
				'name' => 'users',
				'key' => 'user_id',
				'condition' => array(
					'is_root <> "Y"',
				),
				'children' => array(
					array(
						'name' => 'user_data',
						'key' => 'user_id',
					),
				),
			),
			array(
				'name' => 'user_profiles',
				'key' => 'profile_id',
				'check_fields' => array(
					array('user_id', 'users'),
				),
				'post_process' => 'processUserProfiles',
			),
			array(
				'name' => 'usergroups',
				'key' => 'usergroup_id',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'usergroup_descriptions',
						'key' => 'usergroup_id',
					),
					array(
						'name' => 'usergroup_privileges',
						'key' => 'usergroup_id',
					),
				),
			),
			array(
				'name' => 'usergroup_links',
				'key' => 'link_id',
				'check_fields' => array(
					array('user_id', 'users'),
				),
				'post_process' => 'processUsergroupLinks',
			),
			array(
				'name' => 'product_subscriptions',
				'key' => 'subscription_id',
				'check_fields' => array(
					array('product_id', 'products'),
					array('user_id', 'users'),
				),
				'post_process' => 'processProductSubscriptions',
			),
		),
		'function' => 'processUsergroups',
	),

	'profile_fields' => array(
		'tables' => array(
			array(
				'name' => 'profile_fields',
				'key' => 'field_id',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'profile_field_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_type = "F"',
						),
					),
				),
			),
			array(
				'name' => 'profile_field_values',
				'key' => 'value_id',
				'post_process' => 'processProfileFieldValues',
				'check_fields' => array(
					array('field_id', 'profile_fields'),
				),
				'children' => array(
					array(
						'name' => 'profile_field_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_type = "V"',
						),
					),
				),
			),
		),
		'function' => 'processProfileFields',
	),

	'images' => array(
		'tables' => array(
			array(
				'name' => 'images',
				'key' => 'image_id',
				'post_process' => 'processImages',
			),
		),
		'function' => 'copyImagesLinks',
	),

	'orders' => array(
		'tables' => array(
			array(
				'name' => 'orders',
				'key' => 'order_id',
				'post_process' => 'processOrders',
				'children' => array(
					array(
						'name' => 'order_data',
						'key' => 'order_id',
						'post_process' => 'processOrderData',
					),
					array(
						'name' => 'order_details',
						'key' => 'order_id',
						'post_process' => 'processOrderDetails',
					),
					array(
						'name' => 'order_docs',
						'key' => 'order_id',
						'exclude' => 'doc_id',
					),
				),
			),
			array(
				'name' => 'shipments',
				'key' => 'shipment_id',
				'post_process' => 'processShipments',
				'children' => array(
					array(
						'name' => 'shipment_items',
						'key' => 'shipment_id',
						'post_process' => 'processShipmentItems',
					),
				),
			),
		),
	),

	'promotions' => array(
		'tables' => array(
			array(
				'name' => 'promotions',
				'key' => 'promotion_id',
				'use_objects_sharing' => true,
				'post_process' => 'processPromotions',
				'children' => array(
					array(
						'name' => 'promotion_descriptions',
						'key' => 'promotion_id',
					),
				),
			),
		),
	),

	/* Addons section */
	'addon_access_restrictions' => array(
		'tables' => array(
			array(
				'name' => 'access_restriction',
				'key' => 'item_id',
				'children' => array(
					array(
						'name' => 'access_restriction_reason_descriptions',
						'key' => 'item_id',
					),
				),
			),
			array(
				'name' => 'access_restriction_block',
				'key' => 'ip',
			),
		),
	),

	'addon_attachments' => array(
		'tables' => array(
			array(
				'name' => 'attachments',
				'key' => 'attachment_id',
				'post_process' => 'processAttachments',
				'children' => array(
					array(
						'name' => 'attachment_descriptions',
						'key' => 'attachment_id',
					),
				),
			),
		),
	),

	'addon_banners' => array(
		'tables' => array(
			array(
				'name' => 'banners',
				'key' => 'banner_id',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'banner_descriptions',
						'key' => 'banner_id',
					),
				),
			),
		),
	),

	'addon_bestsellers' => array(
		'function' => 'copyBestsellers',
	),

	'addon_customers_also_bought' => array(
		'function' => 'copyCustomersAlsoBought',
	),

	'addon_gift_registry' => array(
		'tables' => array(
			array(
				'name' => 'giftreg_events',
				'key' => 'event_id',
				'post_process' => 'processGiftregEvents',
				'check_fields' => array(
					array('user_id', 'users'),
				),
				'children' => array(
					array(
						'name' => 'giftreg_event_products',
						'key' => 'event_id',
						'post_process' => 'processGiftregEventProducts',
						'check_fields' => array(
							array('product_id', 'products'),
						),
					),
					array(
						'name' => 'giftreg_event_subscribers',
						'key' => 'event_id',
					),
					array(
						'name' => 'ekeys',
						'key' => 'object_id',
						'condition' => array(
							'object_type IN (\'O\', \'G\')',
						),
					),
				),
			),
			array(
				'name' => 'giftreg_fields',
				'key' => 'field_id',
				'children' => array(
					array(
						'name' => 'giftreg_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_type = \'F\'',
						),
					),
					array(
						'name' => 'giftreg_field_variants',
						'key' => 'field_id',
						'exclude' => array('variant_id'),
						'return_clone_data' => array(
							'variant_id'
						),
						'children' => array(
							array(
								'name' => 'giftreg_descriptions',
								'key' => 'object_id',
								'condition' => array(
									'object_type = \'V\'',
								),
							),
						),
					),
					array(
						'name' => 'giftreg_event_fields',
						'key' => 'field_id',
						'post_process' => 'processGiftregEventFields',
					),
				),
			),
		),
	),

	'addon_news_and_emails' => array(
		'tables' => array(
			array(
				'name' => 'newsletter_campaigns',
				'key' => 'campaign_id',
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "newsletter_campaigns"'
						),
					),
				),
			),
			array(
				'name' => 'news',
				'key' => 'news_id',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'news_descriptions',
						'key' => 'news_id',
					),
				),
			),
			array(
				'name' => 'newsletters',
				'key' => 'newsletter_id',
				'post_process' => 'processNewsletters',
				'check_fields' => array(
					array('campaign_id', 'newsletter_campaigns'),
				),
				'children' => array(
					array(
						'name' => 'newsletter_descriptions',
						'key' => 'newsletter_id',
					),
					array(
						'name' => 'newsletter_links',
						'key' => 'newsletter_id',
						'exclude' => array('link_id'),
						'check_fields' => array(
							array('campaign_id', 'newsletter_campaigns'),
						),
						'post_process' => 'processNewsletterLinks',
					),
				),
			),
			array(
				'name' => 'subscribers',
				'key' => 'subscriber_id',
			),
			array(
				'name' => 'mailing_lists',
				'key' => 'list_id',
				'post_process' => 'processMailingLists',
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "mailing_lists"'
						),
					),
					array(
						'name' => 'user_mailing_lists',
						'key' => 'list_id',
					),
				),
			),
		),
	),

	'addon_product_configurator' => array(
		'tables' => array(
			array(
				'name' => 'conf_steps',
				'key' => 'step_id',
				'children' => array(
					array(
						'name' => 'conf_step_descriptions',
						'key' => 'step_id',
					),
				),
			),
			array(
				'name' => 'conf_groups',
				'key' => 'group_id',
				'post_process' => 'processConfGroups',
				'children' => array(
					array(
						'name' => 'conf_group_descriptions',
						'key' => 'group_id',
					),
				),
			),
			array(
				'name' => 'conf_classes',
				'key' => 'class_id',
				'post_process' => 'processConfClasses',
				'children' => array(
					array(
						'name' => 'conf_class_descriptions',
						'key' => 'class_id',
					),
				),
			),

		),
	),

	'addon_recurring_billing' => array(
		'tables' => array(
			array(
				'name' => 'recurring_plans',
				'key' => 'plan_id',
				'post_process' => 'processRecurringPlans',
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "recurring_plans"'
						),
					),
				),
			),
			array(
				'name' => 'recurring_subscriptions',
				'key' => 'subscription_id',
				'post_process' => 'processRecurringSubscriptions',
			),
			array(
				'name' => 'recurring_events',
				'key' => 'event_id',
				'post_process' => 'processRecurringEvents',
			),
		),
	),

	'addon_reward_points' => array(
		'tables' => array(
			array(
				'name' => 'reward_point_changes',
				'key' => 'change_id',
				'post_process' => 'processRewardPointChanges',
				'check_fields' => array(
					array('user_id', 'users'),
				),
			),
			array(
				'name' => 'reward_points',
				'key' => 'reward_point_id',
				'post_process' => 'processRewardPoints',
				'check_fields' => array(
					array('user_id', 'users'),
				),
			),
			array(
				'name' => 'product_point_prices',
				'key' => 'point_price_id',
				'post_process' => 'processProductPointPrices',
				'check_fields' => array(
					array('product_id', 'products'),
				),
			),
		),
	),

	'addon_rma' => array(
		'tables' => array(
			array(
				'name' => 'rma_properties',
				'key' => 'property_id',
				'children' => array(
					array(
						'name' => 'rma_property_descriptions',
						'key' => 'property_id',
					),
				),
			),
			array(
				'name' => 'rma_returns',
				'key' => 'return_id',
				'post_process' => 'processRmaReturns',
				'check_fields' => array(
					array('order_id', 'orders'),
				),
			),
		),
		'function' => 'processRmaReturnProducts',
	),

	'addon_tags' => array(
		'tables' => array(
			array(
				'name' => 'tags',
				'key' => 'tag_id',
				'children' => array(
					array(
						'name' => 'tag_links',
						'key' => 'tag_id',
						'post_process' => 'processTagLinks',
						'check_fields' => array(
							array('user_id', 'users'),
						),
					),
				),
			),
		),
	),

	'addon_buy_together' => array(
		'tables' => array(
			array(
				'name' => 'buy_together',
				'key' => 'chain_id',
				'post_process' => 'processBuyTogether',
				'children' => array(
					array(
						'name' => 'buy_together_descriptions',
						'key' => 'chain_id',
					),
				),
			),
		),
	),

	'addon_gift_certificates' => array(
		'tables' => array(
			array(
				'name' => 'gift_certificates',
				'key' => 'gift_cert_id',
				'post_process' => 'processGiftCertificates',
				'children' => array(
					array(
						'name' => 'gift_certificates_log',
						'key' => 'gift_cert_id',
						'exclude' => array('log_id'),
						'post_process' => 'processGiftCertificatesLog',
					),
				),
			),
		),
	),

	'addon_required_products' => array(
		'function' => 'processRequiredProducts',
	),

	'addon_data_feeds' => array(
		'tables' => array(
			array(
				'name' => 'data_feeds',
				'key' => 'datafeed_id',
				'post_process' => 'processDataFeeds',
				'children' => array(
					array(
						'name' => 'data_feed_descriptions',
						'key' => 'datafeed_id',
					),
				),
			),
		),
	),

	'addon_affiliate' => array(
		'function' => 'processAffPartnerProfiles',
		'tables' => array(
			array(
				'name' => 'aff_groups',
				'key' => 'group_id',
				'children' => array(
					array(
						'name' => 'aff_group_descriptions',
						'key' => 'group_id',
					),
				),
			),
			array(
				'name' => 'affiliate_payouts',
				'key' => 'payout_id',
				'post_process' => 'processAffiliatePayouts',
				'check_fields' => array(
					array('partner_id', 'users'),
				),
			),
			array(
				'name' => 'affiliate_plans',
				'key' => 'plan_id',
				'post_process' => 'processAffiliatePlans',
				'use_objects_sharing' => true,
				'children' => array(
					array(
						'name' => 'common_descriptions',
						'key' => 'object_id',
						'condition' => array(
							'object_holder = "affiliate_plans"'
						),
					),
				),
			),
			array(
				'name' => 'aff_banners',
				'key' => 'banner_id',
				'children' => array(
					array(
						'name' => 'aff_banner_descriptions',
						'key' => 'banner_id',
					),
				),
			),
			array(
				'name' => 'aff_partner_actions',
				'key' => 'action_id',
				'post_process' => 'processAffPartnerActions',
				'children' => array(
					array(
						'name' => 'aff_action_links',
						'key' => 'action_id',
					),
				),
			),
		),
	),

	'addon_form_builder' => array(
		'tables' => array(
			array(
				'name' => 'form_options',
				'key' => 'element_id',
				'post_process' => 'processFormOptions',
				'dependence_tree' => true,
				'children' => array(
					array(
						'name' => 'form_descriptions',
						'key' => 'object_id',
					),
				),
			),
		),
	),

	'addon_polls' => array(
		'function' => 'copyPollsData',
		'tables' => array(
			array(
				'name' => 'poll_items',
				'key' => 'item_id',
				'post_process' => 'processPollItems',
				'check_fields' => array(
					array('page_id', 'pages'),
				),
				'children' => array(
					array(
						'name' => 'poll_descriptions',
						'post_process' => 'processPollDescriptions',
						'check_fields' => array(
							array('page_id', 'pages'),
						),
						'key' => 'object_id',
						'condition' => array(
							'type = "I"'
						),
					),
				),
			),
			array(
				'name' => 'polls_votes',
				'key' => 'vote_id',
				'post_process' => 'processPollsVotes',
				'check_fields' => array(
					array('page_id', 'pages'),
					array('user_id', 'users'),
				),
			),
		),
	),

	'addon_seo' => array(
		'function' => 'copySeoData',
	),

	'addon_store_locator' => array(
		'tables' => array(
			array(
				'name' => 'store_locations',
				'key' => 'store_location_id',
				'children' => array(
					array(
						'name' => 'store_location_descriptions',
						'key' => 'store_location_id',
					),
				),
			),
		),
	),

	'addon_discussion' => array(
		'tables' => array(
			array(
				'name' => 'discussion',
				'key' => 'thread_id',
				'post_process' => 'processDiscussion',
			),
			array(
				'name' => 'discussion_posts',
				'key' => 'post_id',
				'post_process' => 'processDiscussionPosts',
				'check_fields' => array(
					array('thread_id', 'discussion'),
					array('user_id', 'users'),
				),
				'children' => array(
					array(
						'name' => 'discussion_messages',
						'key' => 'post_id',
						'post_process' => 'processDiscussionMessages',
						'check_fields' => array(
							array('thread_id', 'discussion'),
						),
					),
					array(
						'name' => 'discussion_rating',
						'key' => 'post_id',
						'post_process' => 'processDiscussionRating',
						'check_fields' => array(
							array('thread_id', 'discussion'),
						),
					),
				),
			),
		),
	),
);