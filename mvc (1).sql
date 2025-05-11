-- Adminer 4.8.1 MySQL 8.0.39-0ubuntu0.24.04.2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `attribute`;
CREATE TABLE `attribute` (
  `attribute_id` int NOT NULL AUTO_INCREMENT,
  `attribute_group_id` int NOT NULL,
  `sort_order` int NOT NULL,
  PRIMARY KEY (`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

TRUNCATE `attribute`;

DROP TABLE IF EXISTS `attribute_description`;
CREATE TABLE `attribute_description` (
  `attribute_id` int NOT NULL,
  `lang_id` varchar(3) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_id`,`lang_id`),
  CONSTRAINT `attribute_description_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

TRUNCATE `attribute_description`;

DROP TABLE IF EXISTS `attribute_group`;
CREATE TABLE `attribute_group` (
  `attribute_group_id` int NOT NULL AUTO_INCREMENT,
  `sort_order` int NOT NULL,
  PRIMARY KEY (`attribute_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8mb3;

TRUNCATE `attribute_group`;
INSERT INTO `attribute_group` (`attribute_group_id`, `sort_order`) VALUES
(3,	1),
(4,	1),
(5,	1),
(6,	1),
(7,	1),
(8,	0),
(9,	0),
(10,	0),
(11,	0),
(12,	0),
(13,	0);

DROP TABLE IF EXISTS `attribute_group_description`;
CREATE TABLE `attribute_group_description` (
  `attribute_group_id` int NOT NULL,
  `lang_id` varchar(3) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`attribute_group_id`,`lang_id`),
  CONSTRAINT `attribute_group_description_ibfk_2` FOREIGN KEY (`attribute_group_id`) REFERENCES `attribute_group` (`attribute_group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

TRUNCATE `attribute_group_description`;
INSERT INTO `attribute_group_description` (`attribute_group_id`, `lang_id`, `name`) VALUES
(3,	'en',	'Yash Gupta'),
(4,	'en',	'asdas'),
(5,	'en',	'asdas'),
(6,	'en',	'sadas'),
(7,	'en',	'asdasd'),
(8,	'en',	'edasdas'),
(9,	'en',	'asdjhasjd'),
(10,	'en',	'bhvjhgjh'),
(11,	'en',	'hbgjhghj'),
(12,	'en',	'ghjghj'),
(13,	'en',	'vgfcghfh');

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` int NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL,
  `column` int NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` bigint NOT NULL,
  `date_modified` bigint NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;

TRUNCATE `category`;
INSERT INTO `category` (`category_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(25,	'',	0,	1,	1,	3,	1,	20090131010425,	20110530121455),
(27,	'',	20,	0,	0,	2,	1,	20090131015534,	20100822063215),
(20,	'catalog/demo/compaq_presario.jpg',	0,	1,	1,	1,	1,	20090105214943,	20110716021442),
(24,	'',	0,	1,	1,	5,	0,	20090120023626,	20110530121518),
(18,	'catalog/demo/hp_2.jpg',	0,	1,	0,	2,	1,	20090105214915,	20110530121355),
(17,	'',	0,	1,	1,	4,	1,	20090103210857,	20110530121511),
(28,	'',	25,	0,	0,	1,	1,	20090202131112,	20100822063246),
(26,	'',	20,	0,	0,	1,	1,	20090131015514,	20100822063145),
(29,	'',	25,	0,	0,	1,	1,	20090202131137,	20100822063239),
(30,	'',	25,	0,	0,	1,	1,	20090202131159,	20100822063300),
(31,	'',	25,	0,	0,	1,	1,	20090203141724,	20100822063306),
(32,	'',	25,	0,	0,	1,	1,	20090203141734,	20100822063312),
(33,	'',	0,	1,	1,	6,	1,	20090203141755,	20110530121525),
(34,	'catalog/demo/ipod_touch_4.jpg',	0,	1,	4,	7,	1,	20090203141811,	20110530121531),
(35,	'',	28,	0,	0,	0,	1,	20100917100648,	20100918140242),
(36,	'',	28,	0,	0,	0,	1,	20100917100713,	20100918140255),
(37,	'',	34,	0,	0,	0,	1,	20100918140339,	20110422015508),
(38,	'',	34,	0,	0,	0,	1,	20100918140351,	20100918140351),
(39,	'',	34,	0,	0,	0,	1,	20100918140417,	20110422015520),
(40,	'',	34,	0,	0,	0,	1,	20100918140536,	20100918140536),
(41,	'',	34,	0,	0,	0,	1,	20100918140549,	20110422015530),
(42,	'',	34,	0,	0,	0,	1,	20100918140634,	20101107203104),
(43,	'',	34,	0,	0,	0,	0,	20100918140649,	20110422015540),
(44,	'',	34,	0,	0,	0,	1,	20100921153921,	20101107203055),
(45,	'',	18,	0,	0,	0,	1,	20100924182916,	20110426085211),
(46,	'',	18,	0,	0,	0,	1,	20100924182931,	20110426085223),
(47,	'',	34,	0,	0,	0,	1,	20101107111316,	20101107111316),
(48,	'',	34,	0,	0,	0,	0,	20101107111333,	20101107111333),
(49,	'',	34,	0,	0,	0,	1,	20101107111404,	20101107111404),
(50,	'',	34,	0,	0,	0,	1,	20101107111423,	20110422011601),
(51,	'',	34,	0,	0,	0,	1,	20101107111438,	20110422011613),
(52,	'',	34,	0,	0,	0,	1,	20101107111609,	20110422015457),
(53,	'',	34,	0,	0,	0,	1,	20101107112853,	20110422011436),
(54,	'',	34,	0,	0,	0,	0,	20101107112916,	20110422011650),
(55,	'',	34,	0,	0,	0,	1,	20101108103132,	20101108103132),
(56,	'',	34,	0,	0,	0,	1,	20101108103150,	20110422011637),
(57,	'',	0,	1,	1,	3,	1,	20110426085316,	20110530121505),
(58,	'',	52,	0,	0,	0,	1,	20110508134416,	20110508134416);

DROP TABLE IF EXISTS `category_description`;
CREATE TABLE `category_description` (
  `category_id` int NOT NULL,
  `language_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

TRUNCATE `category_description`;
INSERT INTO `category_description` (`category_id`, `language_id`, `name`, `description`, `meta_title`, `meta_description`, `meta_keyword`) VALUES
(28,	1,	'Monitors',	'',	'Monitors',	'',	''),
(33,	1,	'Cameras',	'',	'Cameras',	'',	''),
(32,	1,	'Web Cameras',	'',	'Web Cameras',	'',	''),
(31,	1,	'Scanners',	'',	'Scanners',	'',	''),
(30,	1,	'Printers',	'',	'Printers',	'',	''),
(29,	1,	'Mice and Trackballs',	'',	'Mice and Trackballs',	'',	''),
(27,	1,	'Mac',	'',	'Mac',	'',	''),
(26,	1,	'PC',	'',	'PC',	'',	''),
(17,	1,	'Software',	'',	'Software',	'',	''),
(25,	1,	'Components',	'',	'Components',	'',	''),
(24,	1,	'Phones &amp; PDAs',	'',	'Phones &amp; PDAs',	'',	''),
(20,	1,	'Desktops',	'&lt;p&gt;\r\n	Example of category description text&lt;/p&gt;\r\n',	'Desktops',	'Example of category description',	''),
(35,	1,	'test 1',	'',	'test 1',	'',	''),
(36,	1,	'test 2',	'',	'test 2',	'',	''),
(37,	1,	'test 5',	'',	'test 5',	'',	''),
(38,	1,	'test 4',	'',	'test 4',	'',	''),
(39,	1,	'test 6',	'',	'test 6',	'',	''),
(40,	1,	'test 7',	'',	'test 7',	'',	''),
(41,	1,	'test 8',	'',	'test 8',	'',	''),
(42,	1,	'test 9',	'',	'test 9',	'',	''),
(43,	1,	'test 11',	'',	'test 11',	'',	''),
(34,	1,	'MP3 Players',	'&lt;p&gt;\r\n	Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.&lt;/p&gt;\r\n',	'MP3 Players',	'',	''),
(18,	1,	'Laptops &amp; Notebooks',	'&lt;p&gt;\r\n	Shop Laptop feature only the best laptop deals on the market. By comparing laptop deals from the likes of PC World, Comet, Dixons, The Link and Carphone Warehouse, Shop Laptop has the most comprehensive selection of laptops on the internet. At Shop Laptop, we pride ourselves on offering customers the very best laptop deals. From refurbished laptops to netbooks, Shop Laptop ensures that every laptop - in every colour, style, size and technical spec - is featured on the site at the lowest possible price.&lt;/p&gt;\r\n',	'Laptops &amp; Notebooks',	'',	''),
(44,	1,	'test 12',	'',	'test 12',	'',	''),
(45,	1,	'Windows',	'',	'Windows',	'',	''),
(46,	1,	'Macs',	'',	'Macs',	'',	''),
(47,	1,	'test 15',	'',	'test 15',	'',	''),
(48,	1,	'test 16',	'',	'test 16',	'',	''),
(49,	1,	'test 17',	'',	'test 17',	'',	''),
(50,	1,	'test 18',	'',	'test 18',	'',	''),
(51,	1,	'test 19',	'',	'test 19',	'',	''),
(52,	1,	'test 20',	'',	'test 20',	'',	''),
(53,	1,	'test 21',	'',	'test 21',	'',	''),
(54,	1,	'test 22',	'',	'test 22',	'',	''),
(55,	1,	'test 23',	'',	'test 23',	'',	''),
(56,	1,	'test 24',	'',	'test 24',	'',	''),
(57,	1,	'Tablets',	'',	'Tablets',	'',	''),
(58,	1,	'test 25',	'',	'test 25',	'',	'');

DROP TABLE IF EXISTS `category_path`;
CREATE TABLE `category_path` (
  `category_id` int NOT NULL,
  `path_id` int NOT NULL,
  `level` int NOT NULL,
  PRIMARY KEY (`category_id`,`path_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

TRUNCATE `category_path`;
INSERT INTO `category_path` (`category_id`, `path_id`, `level`) VALUES
(25,	25,	0),
(28,	25,	0),
(28,	28,	1),
(35,	25,	0),
(35,	28,	1),
(35,	35,	2),
(36,	25,	0),
(36,	28,	1),
(36,	36,	2),
(29,	25,	0),
(29,	29,	1),
(30,	25,	0),
(30,	30,	1),
(31,	25,	0),
(31,	31,	1),
(32,	25,	0),
(32,	32,	1),
(20,	20,	0),
(27,	20,	0),
(27,	27,	1),
(26,	20,	0),
(26,	26,	1),
(24,	24,	0),
(18,	18,	0),
(45,	18,	0),
(45,	45,	1),
(46,	18,	0),
(46,	46,	1),
(17,	17,	0),
(33,	33,	0),
(34,	34,	0),
(37,	34,	0),
(37,	37,	1),
(38,	34,	0),
(38,	38,	1),
(39,	34,	0),
(39,	39,	1),
(40,	34,	0),
(40,	40,	1),
(41,	34,	0),
(41,	41,	1),
(42,	34,	0),
(42,	42,	1),
(43,	34,	0),
(43,	43,	1),
(44,	34,	0),
(44,	44,	1),
(47,	34,	0),
(47,	47,	1),
(48,	34,	0),
(48,	48,	1),
(49,	34,	0),
(49,	49,	1),
(50,	34,	0),
(50,	50,	1),
(51,	34,	0),
(51,	51,	1),
(52,	34,	0),
(52,	52,	1),
(58,	34,	0),
(58,	52,	1),
(58,	58,	2),
(53,	34,	0),
(53,	53,	1),
(54,	34,	0),
(54,	54,	1),
(55,	34,	0),
(55,	55,	1),
(56,	34,	0),
(56,	56,	1),
(57,	57,	0);

DROP TABLE IF EXISTS `extension`;
CREATE TABLE `extension` (
  `extension_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb3;

TRUNCATE `extension`;
INSERT INTO `extension` (`extension_id`, `type`, `code`) VALUES
(76,	'Payments',	'Cod'),
(83,	'Modules',	'Gdpr'),
(69,	'Shippings',	'Offline'),
(70,	'Themes',	'Mysara'),
(84,	'Modules',	'Banners');

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `notification_id` bigint NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` bigint NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `notifications`;

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` bigint NOT NULL,
  `notification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` bigint DEFAULT NULL,
  `updated_at` bigint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `role_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `role_user`;
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `notification`, `created_at`, `updated_at`) VALUES
(2,	9,	3,	'{\"account_update\":\"Y\",\"login\":\"Y\",\"password_update\":\"N\",\"new_customer_add\":\"Y\",\"permission_update\":\"N\",\"permission_created\":\"Y\",\"permission_deleted\":\"N\"}',	1716101560,	1716101560),
(13,	11,	19,	'',	NULL,	NULL);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `created_at` bigint NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `roles`;
INSERT INTO `roles` (`id`, `name`, `description`, `permission`, `type`, `created_at`, `updated_at`) VALUES
(9,	'Adminstrator',	'',	'{\"access\":[\"customers\",\"dashboard\",\"profile.account\",\"profile.setting\",\"catalog.attribute\",\"catalog.attribute.add\",\"catalog.category\",\"catalog.category.add\",\"catalog.category.edit\",\"catalog.group\",\"catalog.group.add\",\"catalog.option\",\"catalog.product\",\"common.filemanager.upload\",\"common.filemanager.list\",\"extension.extension\",\"extension.extension.install\",\"extension.extension.uninstall\",\"extension.modules.banners\",\"extension.modules.gdpr\",\"extension.modules.gdpr.save\",\"extension.payments.bank\",\"extension.payments.cod\",\"extension.payments.cod.save\",\"extension.shippings.offline\",\"extension.themes.mysara\",\"sale.order\",\"system.extensions\",\"system.groups\",\"system.groups.update\",\"system.groups.add\",\"system.groups.delete\",\"system.setting\",\"system.users\",\"system.users.add\",\"system.users.update\",\"system.users.delete\"],\"modify\":[\"customers\",\"dashboard\",\"profile.account\",\"profile.setting\",\"catalog.attribute\",\"catalog.attribute.add\",\"catalog.category\",\"catalog.category.add\",\"catalog.category.edit\",\"catalog.group\",\"catalog.group.add\",\"catalog.option\",\"catalog.product\",\"common.filemanager.upload\",\"common.filemanager.list\",\"extension.extension\",\"extension.extension.install\",\"extension.extension.uninstall\",\"extension.modules.banners\",\"extension.modules.gdpr\",\"extension.modules.gdpr.save\",\"extension.payments.bank\",\"extension.payments.cod\",\"extension.payments.cod.save\",\"extension.shippings.offline\",\"extension.themes.mysara\",\"sale.order\",\"system.extensions\",\"system.groups\",\"system.groups.update\",\"system.groups.add\",\"system.groups.delete\",\"system.setting\",\"system.users\",\"system.users.add\",\"system.users.update\",\"system.users.delete\"]}',	'A',	1716101560,	1723894311),
(11,	'Team',	'',	'{\"access\":[\"dashboard\",\"profile.account\",\"profile.logout_all_device\",\"system.users\",\"system.users.update\"],\"modify\":[\"profile.account\",\"profile.logout_all_device\",\"system.users\",\"system.users.update\"]}',	'A',	1716101560,	1716675951),
(13,	'Default',	NULL,	'[]',	'C',	1716686508,	1716691075);

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `seo_id` bigint NOT NULL AUTO_INCREMENT,
  `seo_url` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `seo_origin` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`seo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `seo`;
INSERT INTO `seo` (`seo_id`, `seo_url`, `seo_origin`, `status`) VALUES
(1,	'contact-us',	'welcome/contact',	1),
(5,	'welcome',	'welcome',	1),
(8,	'contact',	'contact/index',	1);

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1og1ebl0onj2mphv2arm5kln81',	3,	'127.0.0.1',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'YXV0aHxhOjE0OntzOjI6ImlkIjtzOjE6IjMiO3M6OToiZmlyc3RuYW1lIjtzOjQ6Illhc2giO3M6ODoibGFzdG5hbWUiO3M6NToiZ3VwdGEiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czo1OiJwaG9uZSI7czoxMDoiODQ0NzQ0MTI0NiI7czo2OiJhY3RpdmUiO3M6MToiQSI7czo5OiJ1c2VyX3R5cGUiO3M6MToiQSI7czoxMDoiY3JlYXRlZF9hdCI7czoxMDoiMTcxNjEwMTU2MCI7czoxMDoidXBkYXRlZF9hdCI7czoxMDoiMTcxNjY5MTcxMCI7czo0OiJyb2xlIjtzOjEyOiJBZG1pbnN0cmF0b3IiO3M6Nzoicm9sZV9pZCI7czoxOiI5IjtzOjQ6InR5cGUiO3M6MToiQSI7czoxMjoibm90aWZpY2F0aW9uIjthOjc6e3M6MTQ6ImFjY291bnRfdXBkYXRlIjtzOjE6IlkiO3M6NToibG9naW4iO3M6MToiWSI7czoxNToicGFzc3dvcmRfdXBkYXRlIjtzOjE6Ik4iO3M6MTY6Im5ld19jdXN0b21lcl9hZGQiO3M6MToiWSI7czoxNzoicGVybWlzc2lvbl91cGRhdGUiO3M6MToiTiI7czoxODoicGVybWlzc2lvbl9jcmVhdGVkIjtzOjE6IlkiO3M6MTg6InBlcm1pc3Npb25fZGVsZXRlZCI7czoxOiJOIjt9czo3OiJwcm9maWxlIjtzOjY0OiJwdWJsaWMvc3RvcmFnZS91cGxvYWRzLzEyNEEzQTc1LTZBQ0QtNDZCNy1BN0ZBLTUxMzQyMjZEN0Y4Qy5KUEVHIjt9aXNBdXRofGI6MTtub3RpZmljYXRpb25zfGE6MTp7aTowO2E6NDp7czo0OiJ0eXBlIjtzOjE6Ik8iO3M6NToidGl0bGUiO3M6NzoiU3VjY2VzcyI7czo3OiJtZXNzYWdlIjtzOjI3OiJDaGFuZ2VzIHN1Y2Nlc3NmdWxseSBzYXZlZC4iO3M6NToic3RhdGUiO3M6MToiSyI7fX0=',	1723913466),
('7gioptik2e62bh293qaiel4c2k',	0,	'127.0.0.1',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/125.0.0.0 Safari/537.36',	'',	1717258061),
('iddcj86kosbf5i72tkf71bqmf6',	3,	'127.0.0.1',	'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36',	'YXV0aHxhOjEzOntzOjI6ImlkIjtzOjE6IjMiO3M6OToiZmlyc3RuYW1lIjtzOjQ6Illhc2giO3M6ODoibGFzdG5hbWUiO3M6NToiZ3VwdGEiO3M6NToiZW1haWwiO3M6MTU6ImFkbWluQGdtYWlsLmNvbSI7czo1OiJwaG9uZSI7czoxMDoiODQ0NzQ0MTI0NiI7czo2OiJhY3RpdmUiO3M6MToiQSI7czoxMDoiY3JlYXRlZF9hdCI7czoxMDoiMTcxNjEwMTU2MCI7czoxMDoidXBkYXRlZF9hdCI7czoxMDoiMTcxNjY5MTcxMCI7czo0OiJyb2xlIjtzOjEyOiJBZG1pbnN0cmF0b3IiO3M6Nzoicm9sZV9pZCI7czoxOiI5IjtzOjQ6InR5cGUiO3M6MToiQSI7czoxMjoibm90aWZpY2F0aW9uIjthOjc6e3M6MTQ6ImFjY291bnRfdXBkYXRlIjtzOjE6IlkiO3M6NToibG9naW4iO3M6MToiWSI7czoxNToicGFzc3dvcmRfdXBkYXRlIjtzOjE6Ik4iO3M6MTY6Im5ld19jdXN0b21lcl9hZGQiO3M6MToiWSI7czoxNzoicGVybWlzc2lvbl91cGRhdGUiO3M6MToiTiI7czoxODoicGVybWlzc2lvbl9jcmVhdGVkIjtzOjE6IlkiO3M6MTg6InBlcm1pc3Npb25fZGVsZXRlZCI7czoxOiJOIjt9czo3OiJwcm9maWxlIjtzOjM2OiJwdWJsaWMvc3RvcmFnZS91cGxvYWRzL0lNR18zOTIxLkpQRUciO31pc0F1dGh8YjoxOw==',	1723903203);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `store_id` int NOT NULL DEFAULT '0',
  `code` varchar(128) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=602 DEFAULT CHARSET=utf8mb3;

TRUNCATE `settings`;
INSERT INTO `settings` (`setting_id`, `store_id`, `code`, `name`, `value`, `serialized`) VALUES
(538,	0,	'config',	'config_site_url',	'http://localhost:8000/',	0),
(539,	0,	'config',	'config_store_name',	'Northern India Tourism',	0),
(540,	0,	'config',	'config_loder_type',	'text',	0),
(541,	0,	'config',	'config_loder_name',	'N_I_T',	0),
(542,	0,	'config',	'config_pagination',	'10',	0),
(543,	0,	'config',	'config_store_address',	'Office No. 102 , building, No. 3/102, Lalita Park, \r\nLaxmi Nagar\r\nIndia, Delhi, Delhi - 110092\r\nLandmark: Behind Gurudwara,',	0),
(544,	0,	'config',	'config_store_contact',	'+91 892-959-0666',	0),
(545,	0,	'config',	'config_store_email',	'info@northernindiatour.org',	0),
(546,	0,	'config',	'config_store_website',	'www.northernindiatour.org',	0),
(553,	0,	'config',	'config_default_group',	'1',	0),
(554,	0,	'config',	'config_default_redirect',	'1',	0),
(555,	0,	'config',	'config_mime_type',	'[\"jpg\",\"jpeg\",\"png\",\"xml\",\"sql\"]',	0),
(556,	0,	'config',	'config_max_upload_size',	'30000',	0),
(560,	0,	'config',	'config_other_devices',	'1',	0),
(601,	0,	'modules_gdpr',	'modules_gdpr_status',	'D',	0),
(594,	0,	'payments_cod',	'payments_cod_total',	'100',	0),
(593,	0,	'payments_cod',	'payments_cod_status',	'A',	0);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `user_type` varchar(1) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `recovery_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `active` varchar(1) NOT NULL,
  `last_updated_password_at` bigint DEFAULT NULL,
  `custom_fields` json DEFAULT NULL,
  `profile` text,
  `created_at` bigint NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_type`, `username`, `password`, `email`, `phone`, `recovery_key`, `active`, `last_updated_password_at`, `custom_fields`, `profile`, `created_at`, `updated_at`) VALUES
(1,	'Yash',	'Gupta',	'C',	'customer@example.com',	'$2y$10$OdvYQfiZ.fLE1PqVUIwKXuqx0t1Mo2L/p1KpEpj8SjSywZISLk7Va',	'customer@example.com',	'8447441249',	'',	'A',	1716101560,	NULL,	NULL,	1716101560,	1716101560),
(2,	'Yash',	'gupta',	'C',	'yash121999@gmail.com',	'$2y$10$MIW7YolQVdrGQndxu6muDufXUdPFzxzExLek9Ae8vUoyNRshcq/yy',	'yash121999@gmail.com',	'8447441247',	'',	'A',	NULL,	NULL,	NULL,	1716101560,	1716101560),
(3,	'Yash',	'gupta',	'A',	'admin@gmail.com',	'$2y$10$Qy/ntyOYKz5Txbzem0UBouRtf3SL/nH28yk/Bh.QHunr8j/vVrJF2',	'admin@gmail.com',	'8447441246',	'',	'A',	1716101560,	NULL,	'public/storage/uploads/124A3A75-6ACD-46B7-A7FA-5134226D7F8C.JPEG',	1716101560,	1716691710),
(4,	'Muskan',	'Jaiswal',	'C',	'mjaiswal@gmail.com',	'$2y$10$OqIkV3nkaRwOTxr0fJFVcOb3O2OyLAjdyQwAqx8Q4qHqtAc9lDY1q',	'mjaiswal@gmail.com',	'9090909000',	'',	'A',	NULL,	NULL,	NULL,	1716101560,	1716101560),
(19,	'test',	'test',	'A',	'asadasadmin@gmail.com',	'$2y$10$NZCRzkE/JcLMb993fpF.Nes0TglV.Ccl/kMl9iXOX8IB5v6DykJgy',	'asadasadmin@gmail.com',	'7889678989',	NULL,	'A',	NULL,	NULL,	NULL,	1716668389,	1716676211),
(20,	'manu',	'jaiswal',	'C',	'manu@example.com',	'$2y$10$//5eXxDnOMnJZO8Mqn9y4.nVawyrbpQXIf3o57UMGmYdJMVUlypW.',	'manu@example.com',	'9089786756',	NULL,	'D',	NULL,	NULL,	NULL,	1717214420,	1717214420),
(21,	'Chiku',	'jaiswal',	'C',	'chiku@example.com',	'$2y$10$tQ768mOYBE4chSLrDuFJuOLS6Xl32BVrLRoOXuZsddEKaCTUKush6',	'chiku@example.com',	'9089786790',	NULL,	'D',	NULL,	NULL,	NULL,	1717214626,	1717214626),
(22,	'Nakshu',	'jaiswal',	'C',	'nakshu@example.com',	'$2y$10$CCVrftujKfRmviNpCuXcAOPhvEMSWlJfeZnH8enLv89ZHq4LqnUV2',	'nakshu@example.com',	'9089780989',	NULL,	'D',	NULL,	NULL,	NULL,	1717214861,	1717214861),
(23,	'shivam',	'jaiswal',	'C',	'shivam@gmail.com',	'$2y$10$1FWlb1wOpVyddW7.9uIlfu02Mqw/PLkse1BElh8SlqwVdP9P4RwhK',	'shivam@gmail.com',	'7890677808',	NULL,	'D',	NULL,	NULL,	NULL,	1717275321,	1717275321),
(24,	'rakesh',	'gupta',	'C',	'rakesh@example.com',	'$2y$10$EswqLnyNF5Tv/EG6gbsb5.tyCKW0enLxjXzfDfiwNoXzxKGV6nHya',	'rakesh@example.com',	'6789567889',	NULL,	'D',	NULL,	NULL,	NULL,	1717275376,	1717275376),
(25,	'shivam',	'rathi',	'C',	'rathi@hotmail.com',	'$2y$10$YhvP8lwUhno1HsOoZ6S.2ecBNMkU/6bGNPGsCjj6Rgw1sxtQrQikK',	'rathi@hotmail.com',	'8978564434',	NULL,	'D',	NULL,	NULL,	NULL,	1717275406,	1717275406),
(26,	'irra',	'ketan',	'C',	'irra@robotics.in',	'$2y$10$7T23xb/k9W.9QKVXVawi0e/WfViaJCcMeqI756ixcCri2ifKpJQ.a',	'irra@robotics.in',	'8967281289',	NULL,	'D',	NULL,	NULL,	NULL,	1717275437,	1717275437),
(27,	'meera',	'jaiswal',	'C',	'meera@apallo.com',	'$2y$10$1diqSMuWKr2dG2OMs9YGoeoD0fn47tjss7Jthj1dp/AjR8ucHQla6',	'meera@apallo.com',	'8978560867',	NULL,	'D',	NULL,	NULL,	NULL,	1717275469,	1717275469);

-- 2024-10-02 11:07:52
