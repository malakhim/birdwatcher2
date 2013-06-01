DROP TABLE IF EXISTS cscart_addon_descriptions;
CREATE TABLE `cscart_addon_descriptions` (
  `addon` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` varchar(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`addon`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_addons;
CREATE TABLE `cscart_addons` (
  `addon` varchar(32) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `version` varchar(16) NOT NULL DEFAULT '',
  `priority` int(11) unsigned NOT NULL DEFAULT '0',
  `dependencies` varchar(255) NOT NULL DEFAULT '',
  `conflicts` varchar(255) NOT NULL DEFAULT '',
  `separate` tinyint(1) NOT NULL,
  PRIMARY KEY (`addon`),
  KEY `priority` (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_attachment_descriptions;
CREATE TABLE `cscart_attachment_descriptions` (
  `attachment_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`attachment_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_attachments;
CREATE TABLE `cscart_attachments` (
  `attachment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `object_type` varchar(30) NOT NULL DEFAULT '',
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '0',
  `filename` varchar(100) NOT NULL DEFAULT '',
  `filesize` int(11) unsigned NOT NULL DEFAULT '0',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`attachment_id`),
  KEY `object_type` (`object_type`,`object_id`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_block_statuses;
CREATE TABLE `cscart_bm_block_statuses` (
  `snapping_id` int(11) NOT NULL,
  `object_ids` text NOT NULL,
  `object_type` varchar(32) NOT NULL,
  UNIQUE KEY `snapping_id` (`snapping_id`,`object_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_blocks;
CREATE TABLE `cscart_bm_blocks` (
  `block_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(64) NOT NULL DEFAULT '',
  `properties` text NOT NULL,
  `company_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_blocks_content;
CREATE TABLE `cscart_bm_blocks_content` (
  `snapping_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_type` varchar(64) NOT NULL DEFAULT '',
  `block_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `content` text NOT NULL,
  PRIMARY KEY (`block_id`,`snapping_id`,`lang_code`,`object_id`,`object_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_blocks_descriptions;
CREATE TABLE `cscart_bm_blocks_descriptions` (
  `block_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`block_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_containers;
CREATE TABLE `cscart_bm_containers` (
  `container_id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` mediumint(9) unsigned NOT NULL,
  `position` enum('TOP','CENTRAL','BOTTOM') NOT NULL,
  `width` tinyint(4) NOT NULL,
  `user_class` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`container_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_grids;
CREATE TABLE `cscart_bm_grids` (
  `grid_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `container_id` mediumint(9) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `order` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `width` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `suffix` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `prefix` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `user_class` varchar(128) NOT NULL DEFAULT '',
  `omega` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `alpha` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `wrapper` varchar(128) NOT NULL DEFAULT '',
  `content_align` enum('LEFT','RIGHT','FULL_WIDTH') NOT NULL DEFAULT 'FULL_WIDTH',
  `html_element` varchar(8) NOT NULL DEFAULT 'div',
  `clear` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`grid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_grids_descriptions;
CREATE TABLE `cscart_bm_grids_descriptions` (
  `grid_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`grid_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_locations;
CREATE TABLE `cscart_bm_locations` (
  `location_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `dispatch` varchar(64) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `company_id` int(11) unsigned DEFAULT NULL,
  `object_ids` text NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_locations_descriptions;
CREATE TABLE `cscart_bm_locations_descriptions` (
  `location_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(64) NOT NULL,
  `title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  PRIMARY KEY (`location_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_bm_snapping;
CREATE TABLE `cscart_bm_snapping` (
  `snapping_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `block_id` int(11) unsigned NOT NULL,
  `grid_id` int(11) unsigned NOT NULL,
  `wrapper` varchar(128) NOT NULL DEFAULT '',
  `user_class` varchar(128) NOT NULL DEFAULT '',
  `order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`snapping_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_categories;
CREATE TABLE `cscart_categories` (
  `category_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `id_path` varchar(255) NOT NULL DEFAULT '',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `product_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `is_op` char(1) NOT NULL DEFAULT 'N',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `age_verification` char(1) NOT NULL DEFAULT 'N',
  `age_limit` tinyint(4) NOT NULL DEFAULT '0',
  `parent_age_verification` char(1) NOT NULL DEFAULT 'N',
  `parent_age_limit` tinyint(4) NOT NULL DEFAULT '0',
  `selected_layouts` text NOT NULL,
  `default_layout` varchar(50) NOT NULL DEFAULT '',
  `product_details_layout` varchar(50) NOT NULL DEFAULT '',
  `product_columns` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`),
  KEY `c_status` (`usergroup_ids`,`status`,`parent_id`),
  KEY `position` (`position`),
  KEY `parent` (`parent_id`),
  KEY `id_path` (`id_path`),
  KEY `localization` (`localization`),
  KEY `age_verification` (`age_verification`,`age_limit`),
  KEY `parent_age_verification` (`parent_age_verification`,`parent_age_limit`),
  KEY `p_category_id` (`category_id`,`usergroup_ids`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_category_descriptions;
CREATE TABLE `cscart_category_descriptions` (
  `category_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `category` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `age_warning_message` text NOT NULL,
  PRIMARY KEY (`category_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_common_descriptions;
CREATE TABLE `cscart_common_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `object_type` varchar(32) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `object` varchar(128) NOT NULL DEFAULT '',
  `object_holder` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`object_id`,`lang_code`,`object_holder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_companies;
CREATE TABLE `cscart_companies` (
  `company_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT 'A',
  `company` varchar(255) NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `address` varchar(255) NOT NULL,
  `city` varchar(64) NOT NULL,
  `state` varchar(32) NOT NULL,
  `country` char(2) NOT NULL,
  `zipcode` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `url` varchar(128) NOT NULL,
  `storefront` varchar(255) NOT NULL DEFAULT '',
  `secure_storefront` varchar(255) NOT NULL DEFAULT '',
  `entry_page` varchar(50) NOT NULL DEFAULT 'none',
  `redirect_customer` char(1) NOT NULL DEFAULT 'Y',
  `countries_list` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  `categories` text NOT NULL,
  `shippings` text NOT NULL,
  `logos` text NOT NULL,
  `commission` decimal(12,2) NOT NULL DEFAULT '0.00',
  `commission_type` char(1) NOT NULL DEFAULT 'A',
  `request_user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `request_account_name` varchar(255) NOT NULL DEFAULT '',
  `request_account_data` text NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_company_descriptions;
CREATE TABLE `cscart_company_descriptions` (
  `company_id` int(11) unsigned NOT NULL,
  `lang_code` char(2) NOT NULL,
  `company_description` text NOT NULL,
  PRIMARY KEY (`company_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_countries;
CREATE TABLE `cscart_countries` (
  `code` char(2) NOT NULL DEFAULT '',
  `code_A3` char(3) NOT NULL DEFAULT '',
  `code_N3` char(3) NOT NULL DEFAULT '',
  `region` char(2) NOT NULL DEFAULT '',
  `lat` float NOT NULL DEFAULT '0',
  `lon` float NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`code`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_country_descriptions;
CREATE TABLE `cscart_country_descriptions` (
  `code` char(2) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `country` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`code`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_currencies;
CREATE TABLE `cscart_currencies` (
  `currency_code` varchar(10) NOT NULL DEFAULT '',
  `after` char(1) NOT NULL DEFAULT 'N',
  `symbol` varchar(30) NOT NULL DEFAULT '',
  `coefficient` double(12,5) NOT NULL DEFAULT '1.00000',
  `is_primary` char(1) NOT NULL DEFAULT 'N',
  `position` smallint(5) NOT NULL,
  `decimals_separator` char(1) NOT NULL DEFAULT '.',
  `thousands_separator` char(1) NOT NULL DEFAULT ',',
  `decimals` smallint(5) NOT NULL DEFAULT '2',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`currency_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_currency_descriptions;
CREATE TABLE `cscart_currency_descriptions` (
  `currency_code` varchar(10) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`currency_code`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destination_descriptions;
CREATE TABLE `cscart_destination_descriptions` (
  `destination_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `destination` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`destination_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destination_elements;
CREATE TABLE `cscart_destination_elements` (
  `element_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `element` varchar(36) NOT NULL DEFAULT '',
  `element_type` char(1) NOT NULL DEFAULT 'S',
  PRIMARY KEY (`element_id`),
  KEY `c_status` (`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_destinations;
CREATE TABLE `cscart_destinations` (
  `destination_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `localization` varchar(255) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`destination_id`),
  KEY `localization` (`localization`),
  KEY `c_status` (`destination_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_ekeys;
CREATE TABLE `cscart_ekeys` (
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `object_string` varchar(128) NOT NULL DEFAULT '',
  `object_type` char(1) NOT NULL DEFAULT 'R',
  `ekey` varchar(32) NOT NULL DEFAULT '',
  `ttl` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`object_type`,`ekey`),
  UNIQUE KEY `object_string` (`object_string`,`object_type`,`ekey`),
  KEY `c_status` (`ekey`,`object_type`,`ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_exim_layouts;
CREATE TABLE `cscart_exim_layouts` (
  `layout_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `cols` text NOT NULL,
  `pattern_id` varchar(128) NOT NULL DEFAULT '',
  `active` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`layout_id`),
  KEY `pattern_id` (`pattern_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_images;
CREATE TABLE `cscart_images` (
  `image_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL DEFAULT '',
  `image_x` int(5) NOT NULL DEFAULT '0',
  `image_y` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_images_links;
CREATE TABLE `cscart_images_links` (
  `pair_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_type` varchar(24) NOT NULL DEFAULT '',
  `image_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `detailed_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'M',
  `position` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pair_id`),
  KEY `object_id` (`object_id`,`object_type`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_language_values;
CREATE TABLE `cscart_language_values` (
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`lang_code`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_languages;
CREATE TABLE `cscart_languages` (
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `name` varchar(64) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localization_descriptions;
CREATE TABLE `cscart_localization_descriptions` (
  `localization_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  KEY `localisation_id` (`localization_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localization_elements;
CREATE TABLE `cscart_localization_elements` (
  `element_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `localization_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `element` varchar(36) NOT NULL DEFAULT '',
  `element_type` char(1) NOT NULL DEFAULT 'S',
  `position` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`element_id`),
  KEY `c_avail` (`localization_id`),
  KEY `element` (`element`,`element_type`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_localizations;
CREATE TABLE `cscart_localizations` (
  `localization_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `custom_weight_settings` char(1) NOT NULL DEFAULT 'Y',
  `weight_symbol` varchar(255) NOT NULL DEFAULT '',
  `weight_unit` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_default` char(1) NOT NULL DEFAULT 'N',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`localization_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_logs;
CREATE TABLE `cscart_logs` (
  `log_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `type` varchar(16) NOT NULL DEFAULT '',
  `event_type` char(1) NOT NULL DEFAULT 'N',
  `action` varchar(16) NOT NULL DEFAULT '',
  `object` char(1) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `backtrace` text NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `object` (`object`),
  KEY `type` (`type`,`action`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_menus;
CREATE TABLE `cscart_menus` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT 'A',
  `company_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_menus_descriptions;
CREATE TABLE `cscart_menus_descriptions` (
  `menu_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`menu_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_new_orders;
CREATE TABLE `cscart_new_orders` (
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_data;
CREATE TABLE `cscart_order_data` (
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`order_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_details;
CREATE TABLE `cscart_order_details` (
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_code` varchar(32) NOT NULL DEFAULT '',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount` smallint(5) unsigned NOT NULL DEFAULT '0',
  `extra` text NOT NULL,
  PRIMARY KEY (`item_id`,`order_id`),
  KEY `o_k` (`order_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_docs;
CREATE TABLE `cscart_order_docs` (
  `doc_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` char(1) NOT NULL DEFAULT 'I',
  `order_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`doc_id`,`type`),
  KEY `type` (`order_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_order_transactions;
CREATE TABLE `cscart_order_transactions` (
  `payment_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT '',
  `extra` text NOT NULL,
  PRIMARY KEY (`payment_id`,`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_orders;
CREATE TABLE `cscart_orders` (
  `order_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `is_parent_order` char(1) NOT NULL DEFAULT 'N',
  `parent_order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `total` decimal(12,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(12,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `subtotal_discount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payment_surcharge` decimal(12,2) NOT NULL DEFAULT '0.00',
  `shipping_ids` varchar(255) NOT NULL DEFAULT '',
  `shipping_cost` decimal(12,2) NOT NULL DEFAULT '0.00',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'O',
  `notes` text NOT NULL,
  `details` text NOT NULL,
  `promotions` text NOT NULL,
  `promotion_ids` varchar(255) NOT NULL DEFAULT '',
  `title` varchar(32) NOT NULL DEFAULT '',
  `firstname` varchar(32) NOT NULL DEFAULT '',
  `lastname` varchar(32) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `b_title` varchar(32) NOT NULL DEFAULT '',
  `b_firstname` varchar(128) NOT NULL DEFAULT '',
  `b_lastname` varchar(128) NOT NULL DEFAULT '',
  `b_address` varchar(255) NOT NULL DEFAULT '',
  `b_address_2` varchar(255) NOT NULL DEFAULT '',
  `b_city` varchar(64) NOT NULL DEFAULT '',
  `b_county` varchar(32) NOT NULL DEFAULT '',
  `b_state` varchar(32) NOT NULL DEFAULT '',
  `b_country` char(2) NOT NULL DEFAULT '',
  `b_zipcode` varchar(32) NOT NULL DEFAULT '',
  `b_phone` varchar(32) NOT NULL DEFAULT '',
  `s_title` varchar(32) NOT NULL DEFAULT '',
  `s_firstname` varchar(128) NOT NULL DEFAULT '',
  `s_lastname` varchar(128) NOT NULL DEFAULT '',
  `s_address` varchar(255) NOT NULL DEFAULT '',
  `s_address_2` varchar(255) NOT NULL DEFAULT '',
  `s_city` varchar(64) NOT NULL DEFAULT '',
  `s_county` varchar(32) NOT NULL DEFAULT '',
  `s_state` varchar(32) NOT NULL DEFAULT '',
  `s_country` char(2) NOT NULL DEFAULT '',
  `s_zipcode` varchar(32) NOT NULL DEFAULT '',
  `s_phone` varchar(32) NOT NULL DEFAULT '',
  `s_address_type` varchar(32) NOT NULL DEFAULT '',
  `phone` varchar(32) NOT NULL DEFAULT '',
  `fax` varchar(32) NOT NULL DEFAULT '',
  `url` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `payment_id` mediumint(8) NOT NULL DEFAULT '0',
  `tax_exempt` char(1) NOT NULL DEFAULT 'N',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `repaid` int(11) NOT NULL DEFAULT '0',
  `validation_code` varchar(20) NOT NULL DEFAULT '',
  `localization_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `timestamp` (`timestamp`),
  KEY `user_id` (`user_id`),
  KEY `promotion_ids` (`promotion_ids`),
  KEY `status` (`status`),
  KEY `shipping_ids` (`shipping_ids`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_page_descriptions;
CREATE TABLE `cscart_page_descriptions` (
  `page_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `page` varchar(255) DEFAULT '0',
  `description` mediumtext,
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`page_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_pages;
CREATE TABLE `cscart_pages` (
  `page_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `id_path` varchar(255) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `show_in_popup` char(1) NOT NULL DEFAULT 'N',
  `page_type` char(1) NOT NULL DEFAULT 'T',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) NOT NULL DEFAULT '0',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `new_window` tinyint(3) NOT NULL DEFAULT '0',
  `related_ids` text,
  `use_avail_period` char(1) NOT NULL DEFAULT 'N',
  `avail_from_timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `avail_till_timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`),
  KEY `localization` (`localization`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payment_descriptions;
CREATE TABLE `cscart_payment_descriptions` (
  `payment_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `payment` varchar(128) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `instructions` mediumtext NOT NULL,
  `surcharge_title` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`payment_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payment_processors;
CREATE TABLE `cscart_payment_processors` (
  `processor_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `processor` varchar(255) NOT NULL DEFAULT '',
  `processor_script` varchar(255) NOT NULL DEFAULT '',
  `processor_template` varchar(255) NOT NULL DEFAULT '',
  `admin_template` varchar(255) NOT NULL DEFAULT '',
  `callback` char(1) NOT NULL DEFAULT 'N',
  `type` char(1) NOT NULL DEFAULT 'P',
  PRIMARY KEY (`processor_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_payments;
CREATE TABLE `cscart_payments` (
  `payment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `template` varchar(128) NOT NULL DEFAULT '',
  `processor_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `a_surcharge` decimal(13,3) NOT NULL DEFAULT '0.000',
  `p_surcharge` decimal(13,3) NOT NULL DEFAULT '0.000',
  `tax_ids` varchar(255) NOT NULL DEFAULT '',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `payment_category` varchar(20) NOT NULL DEFAULT 'tab1',
  PRIMARY KEY (`payment_id`),
  KEY `c_status` (`usergroup_ids`,`status`),
  KEY `position` (`position`),
  KEY `localization` (`localization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_privilege_descriptions;
CREATE TABLE `cscart_privilege_descriptions` (
  `privilege` varchar(32) NOT NULL DEFAULT '',
  `description` varchar(128) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `section_id` mediumint(8) NOT NULL,
  PRIMARY KEY (`privilege`,`lang_code`),
  KEY `section_id` (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_privilege_section_descriptions;
CREATE TABLE `cscart_privilege_section_descriptions` (
  `section_id` mediumint(8) NOT NULL,
  `description` varchar(64) NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`section_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_privileges;
CREATE TABLE `cscart_privileges` (
  `privilege` varchar(32) NOT NULL DEFAULT '',
  `is_default` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_descriptions;
CREATE TABLE `cscart_product_descriptions` (
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `product` varchar(255) NOT NULL DEFAULT '',
  `shortname` varchar(255) NOT NULL DEFAULT '',
  `short_description` mediumtext NOT NULL,
  `full_description` mediumtext NOT NULL,
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `search_words` text NOT NULL,
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `age_warning_message` text NOT NULL,
  PRIMARY KEY (`product_id`,`lang_code`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_feature_variant_descriptions;
CREATE TABLE `cscart_product_feature_variant_descriptions` (
  `variant_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `variant` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `meta_keywords` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`variant_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_feature_variants;
CREATE TABLE `cscart_product_feature_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `feature_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) NOT NULL DEFAULT '',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`variant_id`),
  KEY `feature_id` (`feature_id`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features;
CREATE TABLE `cscart_product_features` (
  `feature_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `feature_type` char(1) NOT NULL DEFAULT 'T',
  `categories_path` text NOT NULL,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_product` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display_on_catalog` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `status` char(1) NOT NULL DEFAULT 'A',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `comparison` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`feature_id`),
  KEY `status` (`status`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features_descriptions;
CREATE TABLE `cscart_product_features_descriptions` (
  `feature_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `full_description` mediumtext NOT NULL,
  `prefix` varchar(128) NOT NULL DEFAULT '',
  `suffix` varchar(128) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`feature_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_features_values;
CREATE TABLE `cscart_product_features_values` (
  `feature_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `variant_id` mediumint(8) unsigned DEFAULT NULL,
  `value` varchar(255) NOT NULL DEFAULT '',
  `value_int` double(12,2) DEFAULT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  KEY `fl` (`feature_id`,`lang_code`,`variant_id`,`value`,`value_int`),
  KEY `variant_id` (`variant_id`),
  KEY `lang_code` (`lang_code`),
  KEY `product_id` (`product_id`),
  KEY `fpl` (`feature_id`,`product_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_file_descriptions;
CREATE TABLE `cscart_product_file_descriptions` (
  `file_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `file_name` varchar(255) NOT NULL DEFAULT '',
  `license` text NOT NULL,
  `readme` text NOT NULL,
  PRIMARY KEY (`file_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_file_ekeys;
CREATE TABLE `cscart_product_file_ekeys` (
  `ekey` varchar(32) NOT NULL DEFAULT '',
  `file_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `downloads` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT 'N',
  `ttl` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`,`order_id`),
  UNIQUE KEY `ekey` (`ekey`),
  KEY `ttl` (`ttl`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_files;
CREATE TABLE `cscart_product_files` (
  `file_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `file_path` varchar(255) NOT NULL DEFAULT '',
  `preview_path` varchar(255) NOT NULL DEFAULT '',
  `file_size` int(11) unsigned NOT NULL DEFAULT '0',
  `preview_size` int(11) unsigned NOT NULL DEFAULT '0',
  `agreement` char(1) NOT NULL DEFAULT 'N',
  `max_downloads` smallint(5) unsigned NOT NULL DEFAULT '0',
  `total_downloads` smallint(5) unsigned NOT NULL DEFAULT '0',
  `activation_type` char(1) NOT NULL DEFAULT 'M',
  `position` smallint(5) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`file_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_descriptions;
CREATE TABLE `cscart_product_filter_descriptions` (
  `filter_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `filter` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`filter_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_ranges;
CREATE TABLE `cscart_product_filter_ranges` (
  `range_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `feature_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `filter_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `from` decimal(12,2) NOT NULL DEFAULT '0.00',
  `to` decimal(12,2) NOT NULL DEFAULT '0.00',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`range_id`),
  KEY `from` (`from`,`to`),
  KEY `filter_id` (`filter_id`),
  KEY `feature_id` (`feature_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filter_ranges_descriptions;
CREATE TABLE `cscart_product_filter_ranges_descriptions` (
  `range_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `range_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`range_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_filters;
CREATE TABLE `cscart_product_filters` (
  `filter_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `categories_path` text NOT NULL,
  `company_id` int(11) unsigned DEFAULT '0',
  `feature_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `field_type` char(1) NOT NULL DEFAULT '',
  `show_on_home_page` char(1) NOT NULL DEFAULT 'N',
  `status` char(1) NOT NULL DEFAULT 'A',
  `round_to` smallint(5) unsigned NOT NULL DEFAULT '1',
  `display` char(1) NOT NULL DEFAULT 'Y',
  `display_count` smallint(5) unsigned NOT NULL DEFAULT '10',
  `display_more_count` smallint(5) unsigned NOT NULL DEFAULT '20',
  PRIMARY KEY (`filter_id`),
  KEY `feature_id` (`feature_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_global_option_links;
CREATE TABLE `cscart_product_global_option_links` (
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`option_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_option_variants;
CREATE TABLE `cscart_product_option_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `modifier` decimal(13,3) NOT NULL DEFAULT '0.000',
  `modifier_type` char(1) NOT NULL DEFAULT 'A',
  `weight_modifier` decimal(12,3) NOT NULL DEFAULT '0.000',
  `weight_modifier_type` char(1) NOT NULL DEFAULT 'A',
  `point_modifier` decimal(12,3) NOT NULL DEFAULT '0.000',
  `point_modifier_type` char(1) NOT NULL DEFAULT 'A',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`variant_id`),
  KEY `position` (`position`),
  KEY `status` (`status`),
  KEY `option_id` (`option_id`,`status`),
  KEY `option_id_2` (`option_id`,`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_option_variants_descriptions;
CREATE TABLE `cscart_product_option_variants_descriptions` (
  `variant_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `variant_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`variant_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options;
CREATE TABLE `cscart_product_options` (
  `option_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `option_type` char(1) NOT NULL DEFAULT 'S',
  `inventory` char(1) NOT NULL DEFAULT 'Y',
  `regexp` varchar(255) NOT NULL DEFAULT '',
  `required` char(1) NOT NULL DEFAULT 'N',
  `multiupload` char(1) NOT NULL DEFAULT 'N',
  `allowed_extensions` varchar(255) NOT NULL DEFAULT '',
  `max_file_size` int(11) NOT NULL DEFAULT '0',
  `missing_variants_handling` char(1) NOT NULL DEFAULT 'M',
  `status` char(1) NOT NULL DEFAULT 'A',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`option_id`),
  KEY `c_status` (`product_id`,`status`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_descriptions;
CREATE TABLE `cscart_product_options_descriptions` (
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_text` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `comment` varchar(255) NOT NULL DEFAULT '',
  `inner_hint` varchar(255) NOT NULL DEFAULT '',
  `incorrect_message` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`option_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_exceptions;
CREATE TABLE `cscart_product_options_exceptions` (
  `exception_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `combination` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`exception_id`),
  KEY `product` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_options_inventory;
CREATE TABLE `cscart_product_options_inventory` (
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_code` varchar(32) NOT NULL DEFAULT '',
  `combination_hash` int(11) unsigned NOT NULL DEFAULT '0',
  `combination` varchar(255) NOT NULL DEFAULT '',
  `amount` mediumint(8) NOT NULL DEFAULT '0',
  `temp` char(1) NOT NULL DEFAULT 'N',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`combination_hash`),
  KEY `pc` (`product_id`,`combination`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_popularity;
CREATE TABLE `cscart_product_popularity` (
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `viewed` int(11) NOT NULL DEFAULT '0',
  `added` int(11) NOT NULL DEFAULT '0',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `bought` int(11) NOT NULL DEFAULT '0',
  `total` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`product_id`),
  KEY `total` (`product_id`,`total`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_prices;
CREATE TABLE `cscart_product_prices` (
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `percentage_discount` int(2) unsigned NOT NULL DEFAULT '0',
  `lower_limit` smallint(5) unsigned NOT NULL DEFAULT '0',
  `usergroup_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `usergroup` (`product_id`,`usergroup_id`,`lower_limit`),
  KEY `product_id` (`product_id`),
  KEY `lower_limit` (`lower_limit`),
  KEY `usergroup_id` (`usergroup_id`,`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_subscriptions;
CREATE TABLE `cscart_product_subscriptions` (
  `subscription_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `email` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`subscription_id`),
  UNIQUE KEY `pe` (`product_id`,`email`),
  KEY `pd` (`product_id`,`user_id`,`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_tabs;
CREATE TABLE `cscart_product_tabs` (
  `tab_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tab_type` char(1) NOT NULL DEFAULT 'B',
  `block_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `template` varchar(255) NOT NULL DEFAULT '',
  `addon` varchar(32) NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `is_primary` char(1) NOT NULL DEFAULT 'N',
  `product_ids` text NOT NULL,
  `company_id` int(11) unsigned DEFAULT NULL,
  `show_in_popup` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`tab_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_product_tabs_descriptions;
CREATE TABLE `cscart_product_tabs_descriptions` (
  `tab_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`tab_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_products;
CREATE TABLE `cscart_products` (
  `product_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `product_code` varchar(32) NOT NULL DEFAULT '',
  `product_type` char(1) NOT NULL DEFAULT 'P',
  `status` char(1) NOT NULL DEFAULT 'A',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `list_price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `amount` mediumint(8) NOT NULL DEFAULT '0',
  `weight` decimal(12,2) NOT NULL DEFAULT '0.00',
  `length` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `width` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `height` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `shipping_freight` decimal(12,2) NOT NULL DEFAULT '0.00',
  `low_avail_limit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `updated_timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `is_edp` char(1) NOT NULL DEFAULT 'N',
  `edp_shipping` char(1) NOT NULL DEFAULT 'N',
  `unlimited_download` char(1) NOT NULL DEFAULT 'N',
  `tracking` char(1) NOT NULL DEFAULT 'B',
  `free_shipping` char(1) NOT NULL DEFAULT 'N',
  `feature_comparison` char(1) NOT NULL DEFAULT 'N',
  `zero_price_action` char(1) NOT NULL DEFAULT 'R',
  `is_pbp` char(1) NOT NULL DEFAULT 'N',
  `is_op` char(1) NOT NULL DEFAULT 'N',
  `is_oper` char(1) NOT NULL DEFAULT 'N',
  `is_returnable` char(1) NOT NULL DEFAULT 'Y',
  `return_period` int(11) unsigned NOT NULL DEFAULT '10',
  `avail_since` int(11) unsigned NOT NULL DEFAULT '0',
  `out_of_stock_actions` char(1) NOT NULL DEFAULT 'N',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `min_qty` smallint(5) NOT NULL DEFAULT '0',
  `max_qty` smallint(5) NOT NULL DEFAULT '0',
  `qty_step` smallint(5) NOT NULL DEFAULT '0',
  `list_qty_count` smallint(5) NOT NULL DEFAULT '0',
  `tax_ids` varchar(255) NOT NULL DEFAULT '',
  `age_verification` char(1) NOT NULL DEFAULT 'N',
  `age_limit` tinyint(4) NOT NULL DEFAULT '0',
  `options_type` char(1) NOT NULL DEFAULT 'P',
  `exceptions_type` char(1) NOT NULL DEFAULT 'F',
  `details_layout` varchar(50) NOT NULL DEFAULT '',
  `shipping_params` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`product_id`),
  KEY `age_verification` (`age_verification`,`age_limit`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_products_categories;
CREATE TABLE `cscart_products_categories` (
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `category_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `link_type` char(1) NOT NULL DEFAULT 'M',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`,`product_id`),
  KEY `link_type` (`link_type`),
  KEY `pt` (`product_id`,`link_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_field_descriptions;
CREATE TABLE `cscart_profile_field_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `object_type` char(1) NOT NULL DEFAULT 'F',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`object_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_field_values;
CREATE TABLE `cscart_profile_field_values` (
  `value_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`value_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_fields;
CREATE TABLE `cscart_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_name` varchar(32) NOT NULL DEFAULT '',
  `profile_show` char(1) DEFAULT 'N',
  `profile_required` char(1) DEFAULT 'N',
  `checkout_show` char(1) DEFAULT 'N',
  `checkout_required` char(1) DEFAULT 'N',
  `partner_show` char(1) DEFAULT 'N',
  `partner_required` char(1) DEFAULT 'N',
  `field_type` char(1) NOT NULL DEFAULT 'I',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_default` char(1) DEFAULT 'N',
  `section` char(1) DEFAULT 'C',
  `matching_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `class` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`),
  KEY `field_name` (`field_name`),
  KEY `checkout_show` (`checkout_show`,`field_type`),
  KEY `profile_show` (`profile_show`,`field_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_profile_fields_data;
CREATE TABLE `cscart_profile_fields_data` (
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `object_type` char(1) NOT NULL DEFAULT 'U',
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`object_type`,`field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_promotion_descriptions;
CREATE TABLE `cscart_promotion_descriptions` (
  `promotion_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `short_description` text NOT NULL,
  `detailed_description` mediumtext NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`promotion_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_promotions;
CREATE TABLE `cscart_promotions` (
  `promotion_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `conditions` text NOT NULL,
  `bonuses` text NOT NULL,
  `to_date` int(11) unsigned NOT NULL DEFAULT '0',
  `from_date` int(11) unsigned NOT NULL DEFAULT '0',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `stop` char(1) NOT NULL DEFAULT 'N',
  `zone` enum('cart','catalog') NOT NULL DEFAULT 'catalog',
  `conditions_hash` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A',
  `number_of_usages` mediumint(8) NOT NULL DEFAULT '0',
  `users_conditions_hash` text NOT NULL,
  PRIMARY KEY (`promotion_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_quick_menu;
CREATE TABLE `cscart_quick_menu` (
  `menu_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `parent_id` mediumint(8) unsigned NOT NULL,
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports;
CREATE TABLE `cscart_sales_reports` (
  `report_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `type` char(1) NOT NULL DEFAULT '',
  `period` char(2) NOT NULL DEFAULT 'A',
  `time_from` int(11) NOT NULL DEFAULT '0',
  `time_to` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`report_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_descriptions;
CREATE TABLE `cscart_sales_reports_descriptions` (
  `report_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`report_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_elements;
CREATE TABLE `cscart_sales_reports_elements` (
  `element_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(66) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'O',
  `depend_on_it` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_intervals;
CREATE TABLE `cscart_sales_reports_intervals` (
  `interval_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `value` int(11) unsigned NOT NULL DEFAULT '0',
  `interval_code` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`interval_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_conditions;
CREATE TABLE `cscart_sales_reports_table_conditions` (
  `table_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `code` varchar(64) NOT NULL DEFAULT '0',
  `sub_element_id` varchar(16) NOT NULL DEFAULT '0',
  PRIMARY KEY (`table_id`,`code`,`sub_element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_descriptions;
CREATE TABLE `cscart_sales_reports_table_descriptions` (
  `table_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`table_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_element_conditions;
CREATE TABLE `cscart_sales_reports_table_element_conditions` (
  `table_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `element_hash` varchar(32) NOT NULL DEFAULT '',
  `element_code` varchar(64) NOT NULL DEFAULT '',
  `ids` varchar(16) NOT NULL DEFAULT '',
  PRIMARY KEY (`table_id`,`element_hash`,`ids`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_table_elements;
CREATE TABLE `cscart_sales_reports_table_elements` (
  `report_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `table_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `element_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `element_hash` int(11) NOT NULL DEFAULT '0',
  `color` varchar(64) NOT NULL DEFAULT 'blueviolet',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `dependence` varchar(64) NOT NULL DEFAULT 'max_p',
  `limit_auto` mediumint(8) unsigned NOT NULL DEFAULT '5',
  PRIMARY KEY (`report_id`,`table_id`,`element_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sales_reports_tables;
CREATE TABLE `cscart_sales_reports_tables` (
  `table_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'T',
  `display` varchar(64) NOT NULL DEFAULT 'order_amount',
  `interval_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auto` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`table_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sessions;
CREATE TABLE `cscart_sessions` (
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `expiry` int(11) unsigned NOT NULL DEFAULT '0',
  `data` mediumtext,
  `area` char(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`session_id`,`area`),
  KEY `src` (`session_id`,`expiry`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_descriptions;
CREATE TABLE `cscart_settings_descriptions` (
  `object_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `object_type` varchar(1) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `value` text NOT NULL,
  `tooltip` text NOT NULL,
  PRIMARY KEY (`object_id`,`object_type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_objects;
CREATE TABLE `cscart_settings_objects` (
  `object_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `edition_type` set('NONE','ROOT','VENDOR','PRO:NONE','PRO:ROOT','MVE:NONE','MVE:ROOT','ULT:NONE','ULT:ROOT','ULT:VENDOR','ULT:VENDORONLY') NOT NULL DEFAULT 'ROOT',
  `name` varchar(128) NOT NULL DEFAULT '',
  `section_id` smallint(4) unsigned NOT NULL,
  `section_tab_id` smallint(4) unsigned NOT NULL,
  `type` char(1) NOT NULL DEFAULT 'I',
  `value` text NOT NULL,
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `is_global` char(1) NOT NULL DEFAULT 'Y',
  `handler` varchar(128) NOT NULL,
  PRIMARY KEY (`object_id`),
  KEY `is_global` (`is_global`),
  KEY `position` (`position`),
  KEY `section_id` (`section_id`,`section_tab_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_sections;
CREATE TABLE `cscart_settings_sections` (
  `section_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(4) unsigned NOT NULL,
  `edition_type` set('NONE','ROOT','VENDOR','PRO:NONE','PRO:ROOT','MVE:NONE','MVE:ROOT','ULT:NONE','ULT:ROOT','ULT:VENDOR','ULT:VENDORONLY') NOT NULL DEFAULT 'ROOT',
  `name` varchar(128) NOT NULL DEFAULT '',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `type` enum('CORE','ADDON','TAB','SEPARATE_TAB') NOT NULL DEFAULT 'CORE',
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_settings_variants;
CREATE TABLE `cscart_settings_variants` (
  `variant_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`variant_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipment_items;
CREATE TABLE `cscart_shipment_items` (
  `item_id` int(11) unsigned NOT NULL,
  `shipment_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `amount` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`item_id`,`shipment_id`),
  KEY `shipment_id` (`shipment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipments;
CREATE TABLE `cscart_shipments` (
  `shipment_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `tracking_number` varchar(255) NOT NULL DEFAULT '',
  `carrier` varchar(255) NOT NULL DEFAULT '',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `comments` mediumtext NOT NULL,
  PRIMARY KEY (`shipment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_descriptions;
CREATE TABLE `cscart_shipping_descriptions` (
  `shipping_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `shipping` varchar(255) NOT NULL DEFAULT '',
  `delivery_time` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`shipping_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_rates;
CREATE TABLE `cscart_shipping_rates` (
  `rate_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `shipping_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `destination_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rate_value` text NOT NULL,
  PRIMARY KEY (`rate_id`),
  UNIQUE KEY `shipping_rate` (`shipping_id`,`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_service_descriptions;
CREATE TABLE `cscart_shipping_service_descriptions` (
  `service_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`service_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shipping_services;
CREATE TABLE `cscart_shipping_services` (
  `service_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT 'A',
  `carrier` varchar(10) NOT NULL DEFAULT '',
  `module` varchar(32) NOT NULL DEFAULT '',
  `code` varchar(64) NOT NULL DEFAULT '',
  `sp_file` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`service_id`),
  KEY `sa` (`service_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_shippings;
CREATE TABLE `cscart_shippings` (
  `shipping_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `destination` char(1) NOT NULL DEFAULT 'I',
  `min_weight` decimal(12,2) NOT NULL DEFAULT '0.00',
  `max_weight` decimal(12,2) NOT NULL DEFAULT '0.00',
  `usergroup_ids` varchar(255) NOT NULL DEFAULT '0',
  `rate_calculation` char(1) NOT NULL DEFAULT 'M',
  `service_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `tax_ids` varchar(255) NOT NULL DEFAULT '',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'D',
  `params` text NOT NULL,
  UNIQUE KEY `shipping_id` (`shipping_id`),
  KEY `position` (`position`),
  KEY `localization` (`localization`),
  KEY `c_status` (`usergroup_ids`,`min_weight`,`max_weight`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sitemap_links;
CREATE TABLE `cscart_sitemap_links` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `link_href` varchar(255) NOT NULL DEFAULT '',
  `section_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `link_type` varchar(255) NOT NULL DEFAULT '',
  `company_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_sitemap_sections;
CREATE TABLE `cscart_sitemap_sections` (
  `section_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT 'A',
  `section_type` varchar(255) NOT NULL DEFAULT '1',
  `position` smallint(5) unsigned NOT NULL DEFAULT '0',
  `company_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_state_descriptions;
CREATE TABLE `cscart_state_descriptions` (
  `state_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `state` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`state_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_states;
CREATE TABLE `cscart_states` (
  `state_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `code` varchar(32) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `cs` (`country_code`,`code`),
  KEY `code` (`code`),
  KEY `country_code` (`country_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_static_data;
CREATE TABLE `cscart_static_data` (
  `param_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `param` varchar(255) NOT NULL DEFAULT '',
  `param_2` varchar(255) NOT NULL DEFAULT '',
  `param_3` varchar(255) NOT NULL DEFAULT '',
  `param_4` varchar(255) NOT NULL DEFAULT '',
  `param_5` varchar(255) NOT NULL DEFAULT '',
  `section` char(1) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT 'A',
  `position` smallint(5) NOT NULL DEFAULT '0',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `id_path` varchar(255) NOT NULL DEFAULT '',
  `localization` varchar(255) NOT NULL DEFAULT '',
  `company_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`param_id`),
  KEY `section` (`section`,`status`,`localization`),
  KEY `position` (`position`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_static_data_descriptions;
CREATE TABLE `cscart_static_data_descriptions` (
  `param_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `descr` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`param_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_status_data;
CREATE TABLE `cscart_status_data` (
  `status` char(1) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'O',
  `param` char(255) NOT NULL DEFAULT '',
  `value` char(255) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`status`,`type`,`param`),
  KEY `inventory` (`value`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_status_descriptions;
CREATE TABLE `cscart_status_descriptions` (
  `status` char(1) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'O',
  `description` varchar(255) NOT NULL DEFAULT '',
  `email_subj` varchar(255) NOT NULL DEFAULT '',
  `email_header` text NOT NULL,
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  PRIMARY KEY (`status`,`type`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_statuses;
CREATE TABLE `cscart_statuses` (
  `status` char(1) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'O',
  `is_default` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_storage_data;
CREATE TABLE `cscart_storage_data` (
  `data_key` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`data_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_stored_sessions;
CREATE TABLE `cscart_stored_sessions` (
  `session_id` varchar(32) NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `data` text NOT NULL,
  `area` char(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`session_id`,`area`),
  KEY `expiry` (`expiry`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tax_descriptions;
CREATE TABLE `cscart_tax_descriptions` (
  `tax_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `tax` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`tax_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_tax_rates;
CREATE TABLE `cscart_tax_rates` (
  `rate_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `tax_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `destination_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `apply_to` varchar(64) NOT NULL DEFAULT '',
  `rate_value` decimal(13,3) NOT NULL DEFAULT '0.000',
  `rate_type` char(1) NOT NULL DEFAULT '',
  PRIMARY KEY (`rate_id`),
  UNIQUE KEY `tax_rate` (`tax_id`,`destination_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_taxes;
CREATE TABLE `cscart_taxes` (
  `tax_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `address_type` char(1) NOT NULL DEFAULT 'S',
  `status` char(1) NOT NULL DEFAULT 'D',
  `price_includes_tax` char(1) NOT NULL DEFAULT 'N',
  `display_including_tax` char(1) NOT NULL DEFAULT 'N',
  `display_info` char(1) NOT NULL DEFAULT '',
  `regnumber` varchar(255) NOT NULL DEFAULT '',
  `priority` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`tax_id`),
  KEY `c_status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_data;
CREATE TABLE `cscart_user_data` (
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  PRIMARY KEY (`user_id`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_profiles;
CREATE TABLE `cscart_user_profiles` (
  `profile_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `profile_type` char(1) NOT NULL DEFAULT 'P',
  `b_title` varchar(32) NOT NULL DEFAULT '',
  `b_firstname` varchar(128) NOT NULL DEFAULT '',
  `b_lastname` varchar(128) NOT NULL DEFAULT '',
  `b_address` varchar(255) NOT NULL DEFAULT '',
  `b_address_2` varchar(255) NOT NULL DEFAULT '',
  `b_city` varchar(64) NOT NULL DEFAULT '',
  `b_county` varchar(32) NOT NULL DEFAULT '',
  `b_state` varchar(32) NOT NULL DEFAULT '',
  `b_country` char(2) NOT NULL DEFAULT '',
  `b_zipcode` varchar(16) NOT NULL DEFAULT '',
  `b_phone` varchar(32) NOT NULL DEFAULT '',
  `s_title` varchar(32) NOT NULL DEFAULT '',
  `s_firstname` varchar(128) NOT NULL DEFAULT '',
  `s_lastname` varchar(128) NOT NULL DEFAULT '',
  `s_address` varchar(255) NOT NULL DEFAULT '',
  `s_address_2` varchar(255) NOT NULL DEFAULT '',
  `s_city` varchar(255) NOT NULL DEFAULT '',
  `s_county` varchar(32) NOT NULL DEFAULT '',
  `s_state` varchar(32) NOT NULL DEFAULT '',
  `s_country` char(2) NOT NULL DEFAULT '',
  `s_zipcode` varchar(16) NOT NULL DEFAULT '',
  `s_phone` varchar(32) NOT NULL DEFAULT '',
  `s_address_type` varchar(255) NOT NULL DEFAULT '',
  `profile_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`profile_id`),
  KEY `uid_p` (`user_id`,`profile_type`),
  KEY `profile_type` (`profile_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_user_session_products;
CREATE TABLE `cscart_user_session_products` (
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `type` char(1) NOT NULL DEFAULT 'C',
  `user_type` char(1) NOT NULL DEFAULT 'R',
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `item_type` char(1) NOT NULL DEFAULT 'P',
  `product_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `amount` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `price` decimal(12,2) NOT NULL DEFAULT '0.00',
  `extra` text NOT NULL,
  `session_id` varchar(32) NOT NULL DEFAULT '',
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`type`,`item_id`,`user_type`),
  KEY `timestamp` (`timestamp`,`user_type`),
  KEY `session_id` (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_usergroup_descriptions;
CREATE TABLE `cscart_usergroup_descriptions` (
  `usergroup_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `usergroup` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`usergroup_id`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_usergroup_links;
CREATE TABLE `cscart_usergroup_links` (
  `link_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `usergroup_id` mediumint(8) unsigned NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'D',
  PRIMARY KEY (`link_id`),
  UNIQUE KEY `user_id` (`user_id`,`usergroup_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_usergroup_privileges;
CREATE TABLE `cscart_usergroup_privileges` (
  `usergroup_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `privilege` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`usergroup_id`,`privilege`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_usergroups;
CREATE TABLE `cscart_usergroups` (
  `usergroup_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT 'C',
  PRIMARY KEY (`usergroup_id`),
  KEY `c_status` (`usergroup_id`,`status`),
  KEY `status` (`status`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_users;
CREATE TABLE `cscart_users` (
  `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `status` char(1) NOT NULL DEFAULT 'A',
  `user_type` char(1) NOT NULL DEFAULT 'C',
  `user_login` varchar(255) NOT NULL DEFAULT '',
  `referer` varchar(255) NOT NULL DEFAULT '',
  `is_root` char(1) NOT NULL DEFAULT 'N',
  `company_id` int(11) unsigned NOT NULL DEFAULT '0',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0',
  `timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '',
  `salt` varchar(10) NOT NULL DEFAULT '',
  `title` varchar(24) NOT NULL DEFAULT '',
  `firstname` varchar(128) NOT NULL DEFAULT '',
  `lastname` varchar(128) NOT NULL DEFAULT '',
  `company` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `phone` varchar(32) NOT NULL DEFAULT '',
  `fax` varchar(32) NOT NULL DEFAULT '',
  `url` varchar(128) NOT NULL DEFAULT '',
  `tax_exempt` char(1) NOT NULL DEFAULT 'N',
  `lang_code` char(2) NOT NULL DEFAULT 'EN',
  `birthday` int(11) NOT NULL,
  `purchase_timestamp_from` int(11) NOT NULL DEFAULT '0',
  `purchase_timestamp_to` int(11) NOT NULL DEFAULT '0',
  `responsible_email` varchar(80) NOT NULL DEFAULT '',
  `last_passwords` varchar(255) NOT NULL DEFAULT '',
  `password_change_timestamp` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  KEY `user_login` (`user_login`),
  KEY `uname` (`title`,`firstname`,`lastname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_vendor_payouts;
CREATE TABLE `cscart_vendor_payouts` (
  `payout_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) unsigned NOT NULL,
  `order_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `payout_date` int(11) unsigned NOT NULL DEFAULT '0',
  `start_date` int(11) unsigned NOT NULL DEFAULT '0',
  `end_date` int(11) unsigned NOT NULL DEFAULT '0',
  `payout_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `order_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `commission_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `payment_method` varchar(255) NOT NULL DEFAULT '',
  `comments` text NOT NULL,
  `commission` decimal(12,2) NOT NULL DEFAULT '0.00',
  `commission_type` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`payout_id`),
  KEY `company_id` (`company_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS cscart_views;
CREATE TABLE `cscart_views` (
  `view_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `object` varchar(24) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `view_results` text NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`view_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

