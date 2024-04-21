-- Adminer 4.8.1 MySQL 8.0.28-0ubuntu4 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `seo`;
CREATE TABLE `seo` (
  `seo_id` bigint NOT NULL AUTO_INCREMENT,
  `seo_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `seo_origin` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`seo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `seo` (`seo_id`, `seo_url`, `seo_origin`, `status`) VALUES
(1,	'contact-us',	'welcome/contact',	1),
(2,	'about-us',	'welcome/about',	1),
(3,	'why-us',	'welcome/why',	1),
(4,	'testimonial',	'welcome/testimonial',	1),
(5,	'welcome',	'welcome/index',	1),
(6,	'sign-in',	'Auth/Login/index',	1),
(7,	'sign-up',	'Auth/Register/index',	1),
(8,	'contact',	'contact/index',	1);

-- 2023-11-04 09:28:27
