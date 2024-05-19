-- Adminer 4.8.1 MySQL 8.0.28-0ubuntu4 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

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
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb3;

TRUNCATE `extension`;
INSERT INTO `extension` (`extension_id`, `type`, `code`) VALUES
(76,	'Payments',	'Cod'),
(69,	'Shippings',	'Offline'),
(70,	'Themes',	'Mysara');

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` bigint DEFAULT NULL,
  `updated_at` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `role_user`;
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2,	9,	3,	1716101560,	1716101560),
(11,	11,	18,	1716101560,	1716101560);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` bigint NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `roles`;
INSERT INTO `roles` (`id`, `name`, `description`, `permission`, `created_at`, `updated_at`) VALUES
(9,	'Adminstrator',	'',	'{\"access\":[\"customers\",\"dashboard\",\"profile.account\",\"catalog.category\",\"extension.extension\",\"extension.extension.install\",\"extension.extension.uninstall\",\"extension.modules.banners\",\"extension.payments.bank\",\"extension.payments.cod\",\"extension.payments.cod.save\",\"extension.shippings.offline\",\"extension.themes.mysara\",\"system.extensions\",\"system.groups\",\"system.groups.update\",\"system.groups.add\",\"system.groups.delete\",\"system.setting\",\"system.users\",\"system.users.add\",\"system.users.update\",\"system.users.delete\"],\"modify\":[\"customers\",\"dashboard\",\"profile.account\",\"catalog.category\",\"extension.extension\",\"extension.extension.install\",\"extension.extension.uninstall\",\"extension.modules.banners\",\"extension.payments.bank\",\"extension.payments.cod\",\"extension.payments.cod.save\",\"extension.shippings.offline\",\"extension.themes.mysara\",\"system.extensions\",\"system.groups\",\"system.groups.update\",\"system.groups.add\",\"system.groups.delete\",\"system.setting\",\"system.users\",\"system.users.add\",\"system.users.update\",\"system.users.delete\"]}',	1716101560,	1716076208),
(11,	'Team',	'',	'{\"access\":[\"dashboard\",\"profile.account\",\"system.users\"]}',	1716101560,	1716101560);

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `seo_id` bigint NOT NULL AUTO_INCREMENT,
  `seo_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `seo_origin` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
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
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `admin_user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_admin_user_id_index` (`admin_user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `admin_user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qaa5n16pmfvvf5qna9h7mbj2qv',	NULL,	NULL,	NULL,	NULL,	'',	1713599796);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `store_id` int NOT NULL DEFAULT '0',
  `code` varchar(128) NOT NULL,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=585 DEFAULT CHARSET=utf8mb3;

TRUNCATE `settings`;
INSERT INTO `settings` (`setting_id`, `store_id`, `code`, `name`, `value`, `serialized`) VALUES
(538,	0,	'config',	'config_site_url',	' http://manage.northernindiatour.org ',	0),
(539,	0,	'config',	'config_store_name',	'Northern India Tourism',	0),
(540,	0,	'config',	'config_loder_type',	'text',	0),
(541,	0,	'config',	'config_loder_name',	'N_I_T',	0),
(542,	0,	'config',	'config_pagination',	'20',	0),
(543,	0,	'config',	'config_store_address',	'Office No. 102 , building, No. 3/102, Lalita Park, \r\nLaxmi Nagar\r\nIndia, Delhi, Delhi - 110092\r\nLandmark: Behind Gurudwara,',	0),
(544,	0,	'config',	'config_store_contact',	'+91 892-959-0666',	0),
(545,	0,	'config',	'config_store_email',	'info@northernindiatour.org',	0),
(546,	0,	'config',	'config_store_website',	'www.northernindiatour.org',	0),
(553,	0,	'config',	'config_default_group',	'1',	0),
(554,	0,	'config',	'config_default_redirect',	'1',	0),
(555,	0,	'config',	'config_mime_type',	'[\"jpg\",\"jpeg\",\"png\",\"xml\",\"sql\"]',	0),
(556,	0,	'config',	'config_max_upload_size',	'30000',	0),
(560,	0,	'config',	'config_other_devices',	'1',	0),
(584,	0,	'payments_cod',	'payments_cod_total',	'',	0),
(583,	0,	'payments_cod',	'payments_cod_status',	'A',	0);

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
  `created_at` bigint NOT NULL,
  `updated_at` bigint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_type`, `username`, `password`, `email`, `phone`, `recovery_key`, `active`, `last_updated_password_at`, `custom_fields`, `created_at`, `updated_at`) VALUES
(1,	'Yash',	'Gupta',	'C',	'customer@example.com',	'$2y$10$OdvYQfiZ.fLE1PqVUIwKXuqx0t1Mo2L/p1KpEpj8SjSywZISLk7Va',	'customer@example.com',	'8447441246',	'',	'A',	1716101560,	NULL,	1716101560,	1716101560),
(2,	'Yash',	'gupta',	'C',	'yash121999@gmail.com',	'$2y$10$MIW7YolQVdrGQndxu6muDufXUdPFzxzExLek9Ae8vUoyNRshcq/yy',	'yash121999@gmail.com',	'8447441247',	'',	'A',	NULL,	NULL,	1716101560,	1716101560),
(3,	'Yash',	'gupta',	'A',	'admin@gmail.com',	'$2y$10$Qy/ntyOYKz5Txbzem0UBouRtf3SL/nH28yk/Bh.QHunr8j/vVrJF2',	'admin@gmail.com',	'8447441243',	'',	'A',	1716101560,	NULL,	1716101560,	1716101560),
(4,	'Muskan',	'Jaiswal',	'C',	'mjaiswal@gmail.com',	'$2y$10$OqIkV3nkaRwOTxr0fJFVcOb3O2OyLAjdyQwAqx8Q4qHqtAc9lDY1q',	'mjaiswal@gmail.com',	'9090909000',	'',	'A',	NULL,	NULL,	1716101560,	1716101560),
(18,	'Test',	'tEts',	'A',	'asdaadmin@gmail.com',	'$2y$10$0FIx24H7VSrECKzdQmkizOruubCQPIR1EECZz0rvV92N4zmDBCT2q',	'asdaadmin@gmail.com',	'7878787878',	'',	'A',	NULL,	NULL,	1716101560,	1716101560);

-- 2024-05-19 12:08:54