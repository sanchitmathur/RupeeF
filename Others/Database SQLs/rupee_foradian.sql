-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2016 at 12:26 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `rupee_foradian`
--

-- --------------------------------------------------------

--
-- Table structure for table `rf_main_services`
--

DROP TABLE IF EXISTS `rf_main_services`;
CREATE TABLE IF NOT EXISTS `rf_main_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_main_services`
--
ALTER TABLE `rf_main_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_main_services`
--
ALTER TABLE `rf_main_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
-- --------------------------------------------------------

--
-- Table structure for table `rf_sub_services`
--

DROP TABLE IF EXISTS `rf_sub_services`;
CREATE TABLE IF NOT EXISTS `rf_sub_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `main_service_id` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_sub_services`
--
ALTER TABLE `rf_sub_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_sub_services`
--
ALTER TABLE `rf_sub_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_services`
--

DROP TABLE IF EXISTS `rf_services`;
CREATE TABLE IF NOT EXISTS `rf_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sub_service_id` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_services`
--
ALTER TABLE `rf_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_services`
--
ALTER TABLE `rf_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_service_advantages`
--

DROP TABLE IF EXISTS `rf_service_advantages`;
CREATE TABLE IF NOT EXISTS `rf_service_advantages` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `advantage_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advantage_heading` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `advantage_description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_service_advantages`
--
ALTER TABLE `rf_service_advantages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_service_advantages`
--
ALTER TABLE `rf_service_advantages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_service_faqs`
--

DROP TABLE IF EXISTS `rf_service_faqs`;
CREATE TABLE IF NOT EXISTS `rf_service_faqs` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_service_faqs`
--
ALTER TABLE `rf_service_faqs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_service_faqs`
--
ALTER TABLE `rf_service_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_service_packages`
--

DROP TABLE IF EXISTS `rf_service_packages`;
CREATE TABLE IF NOT EXISTS `rf_service_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `service_id` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_service_packages`
--
ALTER TABLE `rf_service_packages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_service_packages`
--
ALTER TABLE `rf_service_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_users`
--

DROP TABLE IF EXISTS `rf_users`;
CREATE TABLE IF NOT EXISTS `rf_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_users`
--
ALTER TABLE `rf_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_users`
--
ALTER TABLE `rf_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_user_services`
--

DROP TABLE IF EXISTS `rf_user_services`;
CREATE TABLE IF NOT EXISTS `rf_user_services` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `purchase_datetime` datetime NOT NULL,
  `is_blocked` int(11) NOT NULL COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_user_services`
--
ALTER TABLE `rf_user_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_user_services`
--
ALTER TABLE `rf_user_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_user_service_packages`
--

DROP TABLE IF EXISTS `rf_user_service_packages`;
CREATE TABLE IF NOT EXISTS `rf_user_service_packages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_package_id` int(11) NOT NULL,
  `package_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_datetime` datetime NOT NULL,
  `is_blocked` int(11) NOT NULL COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_user_service_packages`
--
ALTER TABLE `rf_user_service_packages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_user_service_packages`
--
ALTER TABLE `rf_user_service_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_cities`
--

DROP TABLE IF EXISTS `rf_cities`;
CREATE TABLE IF NOT EXISTS `rf_cities` (
  `id` int(11) NOT NULL,
  `city_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_cities`
--
ALTER TABLE `rf_cities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_cities`
--
ALTER TABLE `rf_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_languages`
--

DROP TABLE IF EXISTS `rf_languages`;
CREATE TABLE IF NOT EXISTS `rf_languages` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `is_blocked` int(11) NOT NULL DEFAULT '0' COMMENT '1=Blocked',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_languages`
--
ALTER TABLE `rf_languages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_languages`
--
ALTER TABLE `rf_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_service_taxes`
--

DROP TABLE IF EXISTS `rf_service_taxes`;
CREATE TABLE IF NOT EXISTS `rf_service_taxes` (
  `id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=Percentage, 2=Amount',
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_service_taxes`
--
ALTER TABLE `rf_service_taxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_service_taxes`
--
ALTER TABLE `rf_service_taxes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

--
-- Table structure for table `rf_user_carts`
--

DROP TABLE IF EXISTS `rf_user_carts`;
CREATE TABLE IF NOT EXISTS `rf_user_carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_package_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1' COMMENT '1=Active',
  `is_deleted` int(11) NOT NULL DEFAULT '0' COMMENT '1=Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for table `rf_user_carts`
--
ALTER TABLE `rf_user_carts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `rf_user_carts`
--
ALTER TABLE `rf_user_carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
-- --------------------------------------------------------

