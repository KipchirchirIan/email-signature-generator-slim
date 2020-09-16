-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20200822010909, 'User', '2020-08-23 21:07:21', '2020-08-23 21:07:21', 0),
(20200822022222, 'Templates', '2020-08-23 21:07:21', '2020-08-23 21:07:22', 0),
(20200823132724, 'Socials', '2020-08-23 21:07:22', '2020-08-23 21:07:22', 0),
(20200823153021, 'UserTemplates', '2020-08-23 21:07:22', '2020-08-23 21:07:24', 0),
(20200823195937, 'UserImage', '2020-08-23 21:07:24', '2020-08-23 21:07:25', 0),
(20200824010345, 'UserSocial', '2020-08-24 02:09:36', '2020-08-24 02:09:38', 0),
(20200825112628, 'AddTemplateFilenameFieldToTemplates', '2020-08-25 05:54:34', '2020-08-25 05:54:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_socials`
--

CREATE TABLE `tbl_socials` (
  `social_id` int(11) NOT NULL,
  `social_name` varchar(50) NOT NULL,
  `social_link` varchar(100) NOT NULL,
  `social_profile_link` varchar(100) NOT NULL,
  `social_desc` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_superusers`
--

CREATE TABLE `tbl_superusers` (
  `suid` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_superusers`
--

INSERT INTO `tbl_superusers` (`suid`, `first_name`, `last_name`, `nickname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'test', 'test@cmshosting.xyz', '$2y$10$.oQ9sjS/8wiRe7TqJ4OC7eJWzxQg61TkT/nQ1Q/vR0CsWH3QPOXuO', '2020-08-10 06:33:06', '2020-08-10 06:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_templates`
--

CREATE TABLE `tbl_templates` (
  `template_id` int(11) NOT NULL,
  `template_name` varchar(100) NOT NULL,
  `template_desc` text DEFAULT NULL,
  `template_filename` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_images`
--

CREATE TABLE `tbl_user_images` (
  `uimg_id` int(11) NOT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `banner` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_socials`
--

CREATE TABLE `tbl_user_socials` (
  `usocial_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `profile_username` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_templates`
--

CREATE TABLE `tbl_user_templates` (
  `utpl_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `phinxlog`
--
ALTER TABLE `phinxlog`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tbl_socials`
--
ALTER TABLE `tbl_socials`
  ADD PRIMARY KEY (`social_id`);

--
-- Indexes for table `tbl_superusers`
--
ALTER TABLE `tbl_superusers`
  ADD PRIMARY KEY (`suid`),
  ADD UNIQUE KEY `UQ_EMAIL` (`email`);

--
-- Indexes for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `idx_users_email` (`email`);

--
-- Indexes for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  ADD PRIMARY KEY (`uimg_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  ADD PRIMARY KEY (`usocial_id`),
  ADD KEY `user_id` (`user_id`,`social_id`,`profile_username`),
  ADD KEY `social_id` (`social_id`);

--
-- Indexes for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  ADD PRIMARY KEY (`utpl_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_template_id` (`template_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_socials`
--
ALTER TABLE `tbl_socials`
  MODIFY `social_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_superusers`
--
ALTER TABLE `tbl_superusers`
  MODIFY `suid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_templates`
--
ALTER TABLE `tbl_templates`
  MODIFY `template_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  MODIFY `uimg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  MODIFY `usocial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  MODIFY `utpl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_user_images`
--
ALTER TABLE `tbl_user_images`
  ADD CONSTRAINT `tbl_user_images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user_socials`
--
ALTER TABLE `tbl_user_socials`
  ADD CONSTRAINT `tbl_user_socials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_user_socials_ibfk_2` FOREIGN KEY (`social_id`) REFERENCES `tbl_socials` (`social_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_user_templates`
--
ALTER TABLE `tbl_user_templates`
  ADD CONSTRAINT `tbl_user_templates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tbl_user_templates_ibfk_2` FOREIGN KEY (`template_id`) REFERENCES `tbl_templates` (`template_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
