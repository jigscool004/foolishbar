-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 07, 2017 at 09:14 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 5.6.29-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_sales`
--

-- --------------------------------------------------------

--
-- Table structure for table `adpost`
--

CREATE TABLE `adpost` (
  `id` int(11) NOT NULL,
  `adpost_id` int(11) NOT NULL COMMENT 'generate unqiue adpost id ',
  `adtitle` varchar(255) NOT NULL,
  `adpost_user_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `model` varchar(30) DEFAULT NULL,
  `ad_desc` text NOT NULL,
  `ad_tags` varchar(255) NOT NULL,
  `adpost_username` varchar(255) NOT NULL,
  `adpost_user_mobile` varchar(20) NOT NULL,
  `city` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = unsold, 0 = sole',
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) DEFAULT '0',
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `adpost_user`
--

CREATE TABLE `adpost_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `profile_pic` varchar(250) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd_token` varchar(255) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adpost_user`
--

INSERT INTO `adpost_user` (`id`, `name`, `profile_pic`, `mobile_no`, `username`, `password`, `email`, `pwd_token`, `created_on`, `last_login`, `status`) VALUES
(1, 'Jigar Kumar', 'IMG_20161027_130934711.jpg', '98643200011545', 'jigscool004', '9816d3bdd1b635525d7993356fff10f607625e7c', 'jigarprajapat@gmail.com', NULL, '2017-05-02 01:12:16', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL,
  `zipcode` int(7) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `city_id`, `area`, `zipcode`, `status`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, 17, 'Odhav', 382415, 1, '2017-04-30 11:07:51', 1, NULL, NULL),
(2, 24, 'Foo', 65451, 0, '2017-04-30 11:33:40', 1, NULL, NULL),
(3, 18, 'LD Collage', 624143, 1, '2017-04-30 11:34:02', 1, NULL, NULL),
(5, 28, 'Mukeshnagar', 654132, 1, '2017-04-30 11:37:04', 1, '2017-04-30 12:02:41', 1),
(6, 29, 'Saaputara', 24443, 0, '2017-04-30 11:38:24', 1, NULL, NULL),
(7, 17, 'Naroda', 365214, 1, '2017-05-06 00:38:25', 1, NULL, NULL),
(8, 17, 'Narol', 652514, 1, '2017-05-06 00:38:42', 1, NULL, NULL),
(9, 17, 'Soni ni Chal', 524152, 1, '2017-05-06 00:39:02', 1, NULL, NULL),
(10, 17, 'India Colony', 343243, 1, '2017-05-06 00:39:12', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(17, 'Ahmedabad (Karnavati)', 1, 1, '2017-04-27 19:44:07', 1, '2017-04-28 01:17:14'),
(18, 'Surat', 1, 1, '2017-04-27 19:44:45', NULL, NULL),
(19, 'Rajkot', 1, 1, '2017-04-27 19:45:09', NULL, NULL),
(22, 'Ankleswar', 1, 1, '2017-04-27 20:54:53', NULL, NULL),
(23, 'Bharuj', 1, 1, '2017-04-27 20:55:05', NULL, NULL),
(24, 'Baroda', 1, 1, '2017-04-27 20:55:16', NULL, NULL),
(28, 'Bhuj', 1, 1, '2017-04-27 21:22:33', NULL, NULL),
(29, 'Kadi', 1, 1, '2017-04-27 21:22:54', NULL, NULL),
(30, 'Rajkot', 1, 1, '2017-04-28 00:08:55', NULL, NULL),
(31, 'Surendra nagar', 1, 1, '2017-04-28 01:13:05', NULL, NULL),
(32, 'Navasari', 1, 1, '2017-04-28 01:16:38', NULL, NULL),
(33, 'Kandala', 1, 1, '2017-04-28 01:17:24', NULL, NULL),
(34, 'dasd', 0, 1, '2017-04-28 20:31:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `save_name` varchar(255) NOT NULL,
  `adpost_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1493043444),
('m130524_201442_init', 1493043448);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_category`
--

CREATE TABLE `mobile_category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mobile_category`
--

INSERT INTO `mobile_category` (`id`, `name`, `status`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(2, 'Nokia', 1, 1, '2017-04-30 18:24:00', NULL, NULL),
(3, 'Samsung', 1, 1, '2017-04-30 18:24:08', NULL, NULL),
(4, 'Iphone', 1, 1, '2017-04-30 18:24:17', NULL, NULL),
(5, 'Oppo', 1, 1, '2017-04-30 18:24:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'WhNu3nCNd1ANqtSukO5t52UQ2N7MsYxR', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', '4_-kOl47-nTpN4G_IgWJGK39Cs3epzBI_1493044988', 'jigarprajapati496@gmail.com', 10, 1493044781, 1493044988);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adpost`
--
ALTER TABLE `adpost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category`),
  ADD KEY `adpost_user_id` (`adpost_user_id`);

--
-- Indexes for table `adpost_user`
--
ALTER TABLE `adpost_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adpost_id` (`adpost_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mobile_category`
--
ALTER TABLE `mobile_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adpost`
--
ALTER TABLE `adpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `adpost_user`
--
ALTER TABLE `adpost_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mobile_category`
--
ALTER TABLE `mobile_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
