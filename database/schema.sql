-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 18, 2020 at 07:41 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emailsignaturegen_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_socials`
--

CREATE TABLE `tbl_socials` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_desc` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='List of social media platforms';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templates`
--

CREATE TABLE `tbl_templates` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `template_filename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_templates`
--

INSERT INTO `tbl_templates` (`template_id`, `template_name`, `template_desc`, `template_filename`, `created_at`, `updated_at`) VALUES
(1, 'template 1', 'This is template 1', 'template1.html', '2020-05-16 02:05:19', '2020-05-16 02:05:19'),
(2, 'template 2', 'This is template 2', 'template_2.html', '2020-05-16 02:07:31', '2020-05-16 02:07:31'),
(3, 'template 3', 'This is template 3', 'template_3.html', '2020-05-21 01:45:40', '2020-05-21 01:45:40'),
(5, 'test', 'This is a test template update', 'template_test.html', '2020-05-29 14:32:54', '2020-05-29 14:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skype` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `company`, `position`, `department`, `phone`, `mobile`, `website`, `skype`, `email`, `password`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Karen Jenken', 'Jenken & Company', 'CEO & Founder', 'Executive', '0700 000001', '0700 000001', 'www.karenjenken.com', 'karen.jenken', 'kjenken0@bloomberg.com', '', 'Jenken Avenue', '2020-04-29 08:18:08', '2020-04-30 13:24:06'),
(2, 'Hal Landsman', 'Hal Landsman Ltd', 'COO', 'Director', '0700 000002', '0700 000002', 'www.halandsman.com', 'halandsman', 'hlandsman1@squidoo.com', '', 'Landsman Street', '2020-04-29 12:04:32', '2020-04-29 12:04:32'),
(3, 'Karlie Eim', 'Eim Inc.', 'Software Engineer', 'Web Services', '0700 000003', '0700 000003', 'www.eimkarlie.com', 'karlieim', 'keim2@mysql.com', '', 'Eim\'s Avenue', '2020-05-06 15:15:42', '2020-05-06 15:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_images`
--

CREATE TABLE `tbl_user_images` (
  `uimg_id` int(11) NOT NULL,
  `logo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Images from users';

--
-- Dumping data for table `tbl_user_images`
--

INSERT INTO `tbl_user_images` (`uimg_id`, `logo`, `banner`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'user1_logo.png', 'banner1.jpg', 1, '2020-07-08 01:39:27', '2020-07-18 04:21:15'),
(3, 'user2-logo.png', NULL, 2, '2020-07-09 23:32:18', '2020-07-18 04:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_socials`
--

CREATE TABLE `tbl_user_socials` (
  `usocial_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `profile_username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Social media profiles of user';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_templates`
--

CREATE TABLE `tbl_user_templates` (
  `utpl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Users and the templates they are using';

--
-- Dumping data for table `tbl_user_templates`
--

INSERT INTO `tbl_user_templates` (`utpl_id`, `user_id`, `template_id`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '2020-06-12 00:26:24', '2020-06-12 00:26:24'),
(3, 1, 2, '2020-06-12 01:17:04', '2020-06-12 01:17:04'),
(6, 2, 2, '2020-07-07 01:06:11', '2020-07-07 01:06:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_socials`
--
ALTER TABLE `tbl_socials`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  ADD PRIMARY KEY (`uimg_id`),
  ADD UNIQUE KEY `tbl_user_images_user_id_uindex` (`user_id`);

--
-- Indexes for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  ADD PRIMARY KEY (`usocial_id`),
  ADD KEY `tbl_user_socials_tbl_socials_social_id_fk` (`social_id`),
  ADD KEY `tbl_user_socials_tbl_users_user_id_fk` (`user_id`);

--
-- Indexes for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  ADD PRIMARY KEY (`utpl_id`),
  ADD KEY `tbl_user_templates_tbl_templates_template_id_fk` (`template_id`),
  ADD KEY `tbl_user_templates_tbl_users_user_id_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_socials`
--
ALTER TABLE `tbl_socials`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  MODIFY `uimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  MODIFY `usocial_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  MODIFY `utpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  ADD CONSTRAINT `tbl_user_images_tbl_users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  ADD CONSTRAINT `tbl_user_socials_tbl_socials_social_id_fk` FOREIGN KEY (`social_id`) REFERENCES `tbl_socials` (`social_id`),
  ADD CONSTRAINT `tbl_user_socials_tbl_users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  ADD CONSTRAINT `tbl_user_templates_tbl_templates_template_id_fk` FOREIGN KEY (`template_id`) REFERENCES `tbl_templates` (`template_id`),
  ADD CONSTRAINT `tbl_user_templates_tbl_users_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
