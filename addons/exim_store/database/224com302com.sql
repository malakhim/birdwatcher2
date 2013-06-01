DROP TABLE IF EXISTS `?:addons`;
CREATE TABLE `?:addons` (
  `addon` varchar(32) NOT NULL default '',
  `status` char(1) NOT NULL default 'A',
  `version` varchar(16) NOT NULL default '',
  `priority` int(11) unsigned NOT NULL default '0',
  `dependencies` varchar(255) NOT NULL default '',
  `conflicts` varchar(255) NOT NULL default '',
  `separate` tinyint(1) NOT NULL,
  PRIMARY KEY  (`addon`),
  KEY (`priority`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `?:addon_descriptions`;
CREATE TABLE IF NOT EXISTS `?:addon_descriptions` (
  `addon` varchar(32) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `lang_code` varchar(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`addon`,`lang_code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `?:bm_block_statuses` (
  `snapping_id` int(11) NOT NULL,
  `object_ids` text NOT NULL,
  `object_type` varchar(32) NOT NULL,
  UNIQUE KEY `snapping_id`(`snapping_id`,`object_type`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_blocks` (
  `block_id` int(11) unsigned NOT NULL auto_increment,
  `type` varchar(64) NOT NULL DEFAULT '',
  `properties` text NOT NULL,
  `company_id` int(11) unsigned NULL,
  PRIMARY KEY (`block_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_blocks_content` (
  `snapping_id` int(11) unsigned NOT NULL,
  `object_id` int(11) unsigned NOT NULL DEFAULT '0',
  `object_type` varchar(64) NOT NULL DEFAULT '',
  `block_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `content` text NOT NULL,
  PRIMARY KEY (`block_id`,`snapping_id`,`lang_code`,`object_id`,`object_type`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_blocks_descriptions` (
  `block_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`block_id`,`lang_code`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_containers` (
  `container_id` mediumint(9) unsigned NOT NULL auto_increment,
  `location_id` mediumint(9) unsigned NOT NULL,
  `position` enum('TOP','CENTRAL','BOTTOM') NOT NULL,
  `width` tinyint(4) NOT NULL,
  `user_class` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`container_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_grids` (
  `grid_id` int(11) unsigned NOT NULL auto_increment,
  `container_id` mediumint(9) unsigned NOT NULL,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `order` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `width` tinyint(4) unsigned NOT NULL DEFAULT 1,
  `suffix` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `prefix` tinyint(4) unsigned NOT NULL DEFAULT 0,
  `user_class` varchar(128) NOT NULL DEFAULT '',
  `omega` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `alpha` tinyint(1) unsigned NOT NULL DEFAULT 0,
  `wrapper` varchar(128) NOT NULL DEFAULT '',
  `content_align` enum('LEFT','RIGHT','FULL_WIDTH') NOT NULL DEFAULT 'FULL_WIDTH',
  `html_element` varchar(8) NOT NULL DEFAULT 'div',
  `clear` tinyint(1) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`grid_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_grids_descriptions` (
  `grid_id` int(11) unsigned NOT NULL,
  `lang_code` varchar(2) NOT NULL DEFAULT 'EN',
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`grid_id`,`lang_code`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_locations` (
  `location_id` mediumint(8) unsigned NOT NULL auto_increment,
  `dispatch` varchar(64) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `company_id` int(11) unsigned NULL,
  `object_ids` text NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_locations_descriptions` (
  `location_id` int(10) unsigned NOT NULL auto_increment,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(64) NOT NULL,
  `title` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  PRIMARY KEY (`location_id`,`lang_code`)
) ENGINE=MyISAM;

CREATE TABLE `?:bm_snapping` (
  `snapping_id` int(11) unsigned NOT NULL auto_increment,
  `block_id` int(11) unsigned NOT NULL,
  `grid_id` int(11) unsigned NOT NULL,
  `wrapper` varchar(128) NOT NULL DEFAULT '',
  `user_class` varchar(128) NOT NULL DEFAULT '',
  `order` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`snapping_id`)
) ENGINE=MyISAM;

ALTER TABLE `?:categories`
  ADD COLUMN `company_id` int(11) unsigned NULL DEFAULT '0';

ALTER TABLE `?:companies`
  ADD COLUMN `storefront` varchar(255) NULL DEFAULT ''
  , ADD COLUMN `secure_storefront` varchar(255) NULL DEFAULT ''
  , ADD COLUMN `entry_page` varchar(50) NULL DEFAULT 'none'
  , ADD COLUMN `redirect_customer` char(1) NULL DEFAULT 'Y'
  , ADD COLUMN `countries_list` text NULL;

ALTER TABLE `?:images_links`
  ADD COLUMN `position` int(11) NULL DEFAULT '0';

CREATE TABLE `?:menus` (
  `menu_id` mediumint(8) unsigned NOT NULL auto_increment,
  `status` char(1) NOT NULL DEFAULT 'A',
  `company_id` int(11) unsigned NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:menus_descriptions` (
  `menu_id` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `lang_code` char(2) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`menu_id`,`lang_code`)
) ENGINE=MyISAM;

ALTER TABLE `?:orders`
  ADD COLUMN `s_address_type` varchar(32) NULL DEFAULT '';

ALTER TABLE `?:pages`
  ADD COLUMN `show_in_popup` char(1) NULL DEFAULT 'N';

ALTER TABLE `?:payment_descriptions`
  ADD COLUMN `surcharge_title` varchar(255) NULL DEFAULT '';

ALTER TABLE `?:payments`
  ADD COLUMN `tax_ids` varchar(255) NULL DEFAULT ''
  , ADD COLUMN `payment_category` varchar(20) NULL DEFAULT 'tab1';

ALTER TABLE `?:product_features`
  ADD COLUMN `company_id` int(11) unsigned NULL;

CREATE INDEX `company_id` ON `?:product_features`(`company_id`);

ALTER TABLE `?:product_prices`
  ADD COLUMN `percentage_discount` int(2) unsigned NULL DEFAULT '0';

CREATE TABLE `?:product_tabs` (
  `tab_id` mediumint(8) unsigned NOT NULL auto_increment,
  `tab_type` char(1) NOT NULL DEFAULT 'B',
  `block_id` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `template` varchar(255) NOT NULL DEFAULT '',
  `addon` varchar(32) NOT NULL DEFAULT '',
  `position` int(11) NOT NULL DEFAULT '0',
  `status` char(1) NOT NULL DEFAULT 'A',
  `is_primary` char(1) NOT NULL DEFAULT 'N',
  `product_ids` text NOT NULL,
  `company_id` int(11) unsigned NULL,
  `show_in_popup` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`tab_id`)
) ENGINE=MyISAM;

CREATE TABLE `?:product_tabs_descriptions` (
  `tab_id` mediumint(8) unsigned NOT NULL DEFAULT 0,
  `lang_code` char(2) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`tab_id`,`lang_code`)
) ENGINE=MyISAM;

ALTER TABLE `?:products`
  ADD COLUMN `updated_timestamp` int(11) unsigned NULL DEFAULT '0';

ALTER TABLE `?:profile_fields`
  ADD COLUMN `class` varchar(100) NULL DEFAULT '';

ALTER TABLE `?:shipping_services`
  DROP COLUMN `intershipper_code`;

ALTER TABLE `?:user_profiles`
  DROP COLUMN `credit_cards`;

ALTER TABLE `?:users`
  DROP COLUMN `card_name`
  , DROP COLUMN `card_type`
  , DROP COLUMN `card_number`
  , DROP COLUMN `card_expire`
  , DROP COLUMN `card_cvv2`
  , DROP COLUMN `credit_value`
  , DROP COLUMN `credit_used`
  , ADD COLUMN `salt` varchar(10) NULL DEFAULT '';

DROP TABLE IF EXISTS `?:block_descriptions`;

DROP TABLE IF EXISTS `?:block_links`;

DROP TABLE IF EXISTS `?:block_location_descriptions`;

DROP TABLE IF EXISTS `?:block_location_properties`;

DROP TABLE IF EXISTS `?:block_positions`;

DROP TABLE IF EXISTS `?:blocks`;

DROP TABLE IF EXISTS `?:quick_search`;

DROP TABLE IF EXISTS `?:se_queue`;

DROP TABLE IF EXISTS `?:settings`;

DROP TABLE IF EXISTS `?:settings_elements`;

DROP TABLE IF EXISTS `?:settings_subsections`;

REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('B', 'O', 'color', '28abf6');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('C', 'O', 'color', '97cf4d');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('D', 'O', 'color', 'ff5215');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('F', 'O', 'color', 'ff5215');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('I', 'O', 'color', 'c2c2c2');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('O', 'O', 'color', 'ff9522');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('P', 'O', 'color', '97cf4d');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('A', 'G', 'color', '97cf4d');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('C', 'G', 'color', 'c2c2c2');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('P', 'G', 'color', 'ff9522');
REPLACE INTO `?:status_data` (`status`, `type`, `param`, `value`) VALUES ('U', 'G', 'color', '28abf6');