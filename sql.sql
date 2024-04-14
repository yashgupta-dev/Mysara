-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2024 at 06:14 PM
-- Server version: 8.0.28-0ubuntu4
-- PHP Version: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

CREATE TABLE `seo` (
  `seo_id` bigint NOT NULL,
  `seo_url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `seo_origin` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`seo_id`, `seo_url`, `seo_origin`, `status`) VALUES
(1, 'contact-us', 'welcome/contact', 1),
(5, 'welcome', 'welcome', 1),
(8, 'contact', 'contact/index', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `setting_id` int NOT NULL,
  `store_id` int NOT NULL DEFAULT '0',
  `code` varchar(128) NOT NULL,
  `key` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(208, 0, 'config', 'config_seo_url', 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
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
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `user_type`, `username`, `password`, `email`, `phone`, `recovery_key`, `active`, `last_updated_password_at`, `custom_fields`, `created_at`, `updated_at`) VALUES
(1, 'Yash', 'Gupta', 'C', 'customer@example.com', '$2y$10$OdvYQfiZ.fLE1PqVUIwKXuqx0t1Mo2L/p1KpEpj8SjSywZISLk7Va', 'customer@example.com', '8447441246', '', 'A', '2024-04-14 06:05:10', NULL, '2024-04-14 14:43:04', '2024-04-14 18:05:10'),
(2, 'Yash', 'gupta', 'C', 'yash121999@gmail.com', '$2y$10$MIW7YolQVdrGQndxu6muDufXUdPFzxzExLek9Ae8vUoyNRshcq/yy', 'yash121999@gmail.com', '8447441247', NULL, 'A', NULL, NULL, '2024-04-14 14:53:05', '2024-04-14 14:53:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `seo`
--
ALTER TABLE `seo`
  ADD PRIMARY KEY (`seo_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `seo`
--
ALTER TABLE `seo`
  MODIFY `seo_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `setting_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
