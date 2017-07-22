CREATE TABLE IF NOT EXISTS `oc_affiliate_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `affiliate_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_api` (
  `api_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`api_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `oc_customer_activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `key` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `oc_custom_field_customer_group` (
  `custom_field_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`custom_field_id`,`customer_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `oc_event` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL,
  `trigger` text NOT NULL,
  `action` text NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

CREATE TABLE IF NOT EXISTS `oc_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `geocode` varchar(32) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `open` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_marketing` (
  `marketing_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(64) NOT NULL,
  `clicks` int(5) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`marketing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_modification` (
  `modification_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `author` varchar(64) NOT NULL,
  `version` varchar(32) NOT NULL,
  `link` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`modification_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_order_custom_field` (
  `order_custom_field_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `custom_field_id` int(11) NOT NULL,
  `custom_field_value_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(32) NOT NULL,
  `location` varchar(16) NOT NULL,
  PRIMARY KEY (`order_custom_field_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_recurring` (
  `recurring_id` int(11) NOT NULL AUTO_INCREMENT,
  `price` decimal(10,4) NOT NULL,
  `frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `duration` int(10) unsigned NOT NULL,
  `cycle` int(10) unsigned NOT NULL,
  `trial_status` tinyint(4) NOT NULL,
  `trial_price` decimal(10,4) NOT NULL,
  `trial_frequency` enum('day','week','semi_month','month','year') NOT NULL,
  `trial_duration` int(10) unsigned NOT NULL,
  `trial_cycle` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`recurring_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `oc_recurring_description` (
  `recurring_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`recurring_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `oc_upload` (
  `upload_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`upload_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;





ALTER TABLE `oc_address` ADD `custom_field` text NOT NULL;
ALTER TABLE `oc_banner_image` ADD sort_order int(3) NOT NULL DEFAULT '0';
ALTER TABLE `oc_category` ADD KEY `parent_id` (`parent_id`);
ALTER TABLE `oc_category_description` ADD meta_title varchar(255) NOT NULL;
ALTER TABLE `oc_customer` ADD `custom_field` text NOT NULL;
ALTER TABLE `oc_customer` ADD `safe` tinyint(1) NOT NULL;
ALTER TABLE `oc_custom_field` ADD `status` tinyint(1) NOT NULL;

ALTER TABLE `oc_order` ADD `custom_field` text NOT NULL;
ALTER TABLE `oc_order` ADD `payment_custom_field` text NOT NULL;
ALTER TABLE `oc_order` ADD `shipping_custom_field` text NOT NULL;
ALTER TABLE `oc_order` ADD `marketing_id` int(11) NOT NULL;
ALTER TABLE `oc_order` ADD `tracking` varchar(64) NOT NULL;

ALTER TABLE `oc_order_recurring` ADD `reference` varchar(255) NOT NULL;
ALTER TABLE `oc_order_recurring` ADD `recurring_id` int(11) NOT NULL;
ALTER TABLE `oc_order_recurring` ADD `recurring_name` varchar(255) NOT NULL;
ALTER TABLE `oc_order_recurring` ADD `recurring_description` varchar(255) NOT NULL;
ALTER TABLE `oc_order_recurring` ADD `date_added` datetime NOT NULL;

ALTER TABLE `oc_order_recurring_transaction` ADD `reference` varchar(255) NOT NULL;
ALTER TABLE `oc_order_recurring_transaction` ADD `date_added` datetime NOT NULL;
ALTER TABLE `oc_product_description` ADD meta_title varchar(255) NOT NULL;
ALTER TABLE `oc_product_option` ADD `value` text NOT NULL;

ALTER TABLE `oc_product_recurring` ADD `recurring_id` int(11) NOT NULL;
ALTER TABLE `oc_product_recurring` ADD `customer_group_id` int(11) NOT NULL;


ALTER TABLE oc_information_description ADD `meta_title` varchar(255) NOT NULL;
ALTER TABLE oc_information_description ADD `meta_description` varchar(255) NOT NULL;
ALTER TABLE oc_information_description ADD `meta_keyword` varchar(255) NOT NULL;
ALTER TABLE `oc_user` ADD image varchar(255) NOT NULL;

UPDATE oc_product_description SET `meta_title` =  'Product';
UPDATE oc_category_description SET `meta_title` = 'Category';

INSERT INTO `oc_setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES
(null, 0, 'config', 'config_product_limit', '15', 0),
(null, 0, 'config', 'config_product_description_length', '100', 0),
(null, 0, 'config', 'config_limit_admin', '20', 0),
(null, 0, 'config', 'config_processing_status', 'a:1:{i:0;s:1:"2";}', 1),
(null, 0, 'config', 'config_complete_status', 'a:1:{i:0;s:1:"5";}', 1),
(null, 0, 'config', 'config_image_location_height', '50', 0),
(null, 0, 'config', 'config_image_location_width', '268', 0),

(null, 0, 'config', 'config_meta_title', 'Your Store', 0);

