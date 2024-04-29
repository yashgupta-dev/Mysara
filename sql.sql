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
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb3;

TRUNCATE `category`;
INSERT INTO `category` (`category_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES
(25,	'',	0,	1,	1,	3,	1,	'2009-01-31 01:04:25',	'2011-05-30 12:14:55'),
(27,	'',	20,	0,	0,	2,	1,	'2009-01-31 01:55:34',	'2010-08-22 06:32:15'),
(20,	'catalog/demo/compaq_presario.jpg',	0,	1,	1,	1,	1,	'2009-01-05 21:49:43',	'2011-07-16 02:14:42'),
(24,	'',	0,	1,	1,	5,	1,	'2009-01-20 02:36:26',	'2011-05-30 12:15:18'),
(18,	'catalog/demo/hp_2.jpg',	0,	1,	0,	2,	1,	'2009-01-05 21:49:15',	'2011-05-30 12:13:55'),
(17,	'',	0,	1,	1,	4,	1,	'2009-01-03 21:08:57',	'2011-05-30 12:15:11'),
(28,	'',	25,	0,	0,	1,	1,	'2009-02-02 13:11:12',	'2010-08-22 06:32:46'),
(26,	'',	20,	0,	0,	1,	1,	'2009-01-31 01:55:14',	'2010-08-22 06:31:45'),
(29,	'',	25,	0,	0,	1,	1,	'2009-02-02 13:11:37',	'2010-08-22 06:32:39'),
(30,	'',	25,	0,	0,	1,	1,	'2009-02-02 13:11:59',	'2010-08-22 06:33:00'),
(31,	'',	25,	0,	0,	1,	1,	'2009-02-03 14:17:24',	'2010-08-22 06:33:06'),
(32,	'',	25,	0,	0,	1,	1,	'2009-02-03 14:17:34',	'2010-08-22 06:33:12'),
(33,	'',	0,	1,	1,	6,	1,	'2009-02-03 14:17:55',	'2011-05-30 12:15:25'),
(34,	'catalog/demo/ipod_touch_4.jpg',	0,	1,	4,	7,	1,	'2009-02-03 14:18:11',	'2011-05-30 12:15:31'),
(35,	'',	28,	0,	0,	0,	1,	'2010-09-17 10:06:48',	'2010-09-18 14:02:42'),
(36,	'',	28,	0,	0,	0,	1,	'2010-09-17 10:07:13',	'2010-09-18 14:02:55'),
(37,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:03:39',	'2011-04-22 01:55:08'),
(38,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:03:51',	'2010-09-18 14:03:51'),
(39,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:04:17',	'2011-04-22 01:55:20'),
(40,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:05:36',	'2010-09-18 14:05:36'),
(41,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:05:49',	'2011-04-22 01:55:30'),
(42,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:06:34',	'2010-11-07 20:31:04'),
(43,	'',	34,	0,	0,	0,	1,	'2010-09-18 14:06:49',	'2011-04-22 01:55:40'),
(44,	'',	34,	0,	0,	0,	1,	'2010-09-21 15:39:21',	'2010-11-07 20:30:55'),
(45,	'',	18,	0,	0,	0,	1,	'2010-09-24 18:29:16',	'2011-04-26 08:52:11'),
(46,	'',	18,	0,	0,	0,	1,	'2010-09-24 18:29:31',	'2011-04-26 08:52:23'),
(47,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:13:16',	'2010-11-07 11:13:16'),
(48,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:13:33',	'2010-11-07 11:13:33'),
(49,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:14:04',	'2010-11-07 11:14:04'),
(50,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:14:23',	'2011-04-22 01:16:01'),
(51,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:14:38',	'2011-04-22 01:16:13'),
(52,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:16:09',	'2011-04-22 01:54:57'),
(53,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:28:53',	'2011-04-22 01:14:36'),
(54,	'',	34,	0,	0,	0,	1,	'2010-11-07 11:29:16',	'2011-04-22 01:16:50'),
(55,	'',	34,	0,	0,	0,	1,	'2010-11-08 10:31:32',	'2010-11-08 10:31:32'),
(56,	'',	34,	0,	0,	0,	1,	'2010-11-08 10:31:50',	'2011-04-22 01:16:37'),
(57,	'',	0,	1,	1,	3,	1,	'2011-04-26 08:53:16',	'2011-05-30 12:15:05'),
(58,	'',	52,	0,	0,	0,	1,	'2011-05-08 13:44:16',	'2011-05-08 13:44:16');

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

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `role_user`;
INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(2,	4,	3,	'2024-04-21 07:42:20',	'2024-04-21 07:42:20');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `roles`;
INSERT INTO `roles` (`id`, `name`, `description`, `permission`, `created_at`, `updated_at`) VALUES
(4,	'Adminstrator',	'',	'',	'2024-04-19 16:39:10',	'2024-04-19 16:39:10');

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
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=565 DEFAULT CHARSET=utf8mb3;

TRUNCATE `settings`;
INSERT INTO `settings` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
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
(560,	0,	'config',	'config_other_devices',	'1',	0);

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
  `last_updated_password_at` datetime DEFAULT NULL,
  `custom_fields` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_type`, `username`, `password`, `email`, `phone`, `recovery_key`, `active`, `last_updated_password_at`, `custom_fields`, `created_at`, `updated_at`) VALUES
(1,	'Yash',	'Gupta',	'C',	'customer@example.com',	'$2y$10$OdvYQfiZ.fLE1PqVUIwKXuqx0t1Mo2L/p1KpEpj8SjSywZISLk7Va',	'customer@example.com',	'8447441246',	'',	'A',	'2024-04-14 06:05:10',	NULL,	'2024-04-14 14:43:04',	'2024-04-14 18:05:10'),
(2,	'Yash',	'gupta',	'C',	'yash121999@gmail.com',	'$2y$10$MIW7YolQVdrGQndxu6muDufXUdPFzxzExLek9Ae8vUoyNRshcq/yy',	'yash121999@gmail.com',	'8447441247',	NULL,	'A',	NULL,	NULL,	'2024-04-14 14:53:05',	'2024-04-14 14:53:05'),
(3,	'Yash',	'gupta',	'A',	'admin@gmail.com',	'$2y$10$MIW7YolQVdrGQndxu6muDufXUdPFzxzExLek9Ae8vUoyNRshcq/yy',	'admin@gmail.com',	'8447441243',	NULL,	'A',	NULL,	NULL,	'2024-04-14 14:53:05',	'2024-04-14 14:53:05'),
(4,	'Muskan',	'Jaiswal',	'C',	'mjaiswal@gmail.com',	'$2y$10$OqIkV3nkaRwOTxr0fJFVcOb3O2OyLAjdyQwAqx8Q4qHqtAc9lDY1q',	'mjaiswal@gmail.com',	'9090909000',	NULL,	'A',	NULL,	NULL,	'2024-04-20 12:47:05',	'2024-04-20 12:47:05');

-- 2024-04-29 16:39:26
