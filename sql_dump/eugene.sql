-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 02:39 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eugene`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_resets`
--

CREATE TABLE `tbl_password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `payment_type` varchar(25) NOT NULL,
  `order_hash` varchar(255) DEFAULT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(25) NOT NULL DEFAULT 'usd',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_status` varchar(25) NOT NULL,
  `notes` text,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`id`, `user_id`, `user_email`, `payment_type`, `order_hash`, `amount`, `currency`, `order_date`, `order_status`, `notes`, `name`) VALUES
(1, 6, 'test@app.com', 'stripe', 'Ck01QY3FWs37fSr3f', 50.00, 'usd', '2022-05-23 07:21:39', 'Pending', '', 'test'),
(2, 6, 'test@app.com', 'stripe', 'BWIgIRaTcoMAc59GF', 50.00, 'usd', '2022-05-23 07:30:44', 'Pending', '', 'test'),
(3, 6, 'test@app.com', 'stripe', '2j8Qb5wiDSl35smQf', 50.00, 'usd', '2022-05-23 07:43:32', 'Pending', '', 'test'),
(4, 6, 'test@app.com', 'stripe', 'jMc9s0hAp2A2Ku1yd', 50.00, 'usd', '2022-05-22 22:59:37', 'complete', '', 'test'),
(5, 6, 'test@app.com', 'stripe', 'bSaTS4jmegsNB2iGJ', 50.00, 'usd', '2022-05-22 23:09:07', 'complete', '', 'test'),
(6, 6, 'test@app.com', 'stripe', 'V1kWEDiOGv5f1x6nk', 20.00, 'usd', '2022-05-22 23:23:35', 'complete', '', 'test'),
(7, 6, 'test@app.com', 'stripe', 'tiatyGqXRvLseoQoo', 50.00, 'usd', '2022-05-22 23:27:14', 'complete', '', 'test'),
(8, 6, 'test@app.com', 'stripe', 'YSURCzdMTLas772YT', 50.00, 'usd', '2022-05-23 11:11:39', 'Pending', '', 'Test'),
(9, 6, 'test@app.com', 'stripe', 'dLB8yz2NtycHQ0ILd', 50.00, 'usd', '2022-05-23 02:12:26', 'complete', '', 'test'),
(22, 6, 'test@app.com', 'paypal', '4DUJZM3AVUMC6B0SePGRklG3fxiQJ0', 50.00, 'usd', '2022-05-23 11:45:14', 'complete', '', 'test@app.com'),
(23, 6, 'test@app.com', 'paypal', '4DUJZM3AVUMC6_ZVXRMHINzXOwmtK1z', 50.00, 'usd', '2022-05-23 11:47:20', 'complete', '', 'test@app.com'),
(24, 6, 'test@app.com', 'paypal', '', 50.00, 'usd', '2022-05-23 11:51:42', 'canceled', '', 'test@app.com'),
(25, 6, 'test@app.com', 'stripe', '9kXt8VAik7jIjK8hp', 50.00, 'usd', '2022-05-23 10:33:38', 'Completed', '', 'test'),
(26, 6, 'test@app.com', 'stripe', 'iOLkt86n5vOmyzqCZ', 50.00, 'usd', '2022-05-23 12:24:32', 'Completed', '', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_services`
--

CREATE TABLE `tbl_services` (
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` text NOT NULL,
  `service_excerpt` text NOT NULL,
  `service_image` text,
  `service_price` decimal(10,2) NOT NULL,
  `service_period` int(6) NOT NULL DEFAULT '30',
  `service_type` int(2) NOT NULL DEFAULT '1' COMMENT '1: Account Creation, 2: Account Management',
  `service_attachment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_services`
--

INSERT INTO `tbl_services` (`service_id`, `service_name`, `service_excerpt`, `service_image`, `service_price`, `service_period`, `service_type`, `service_attachment`) VALUES
(1, 'service 1', '', 'https://via.placeholder.com/150', '20.00', 30, 1, NULL),
(2, 'service 2', '', 'https://via.placeholder.com/150', '20.00', 30, 2, NULL),
(3, 'service 3', '', 'https://via.placeholder.com/150', '20.00', 30, 1, NULL),
(4, 'service 4', '', 'https://via.placeholder.com/150', '10.00', 30, 1, NULL),
(5, 'service 5', '', 'https://via.placeholder.com/150', '15.00', 30, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_threads`
--

CREATE TABLE `tbl_threads` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_threads`
--

INSERT INTO `tbl_threads` (`user_id`, `service_id`, `created_at`) VALUES
(1, 1, '2022-05-18 23:32:37'),
(1, 2, '2022-05-18 23:32:40'),
(1, 3, '2022-05-18 23:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_track`
--

CREATE TABLE `tbl_track` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `logo_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  `cost` decimal(16,2) NOT NULL DEFAULT '0.00',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_track`
--

INSERT INTO `tbl_track` (`id`, `user_id`, `logo_url`, `used`, `cost`, `name`) VALUES
(1, 6, '/assets/icons/companies/1.svg', 100, '3.00', 'Magnemo'),
(2, 6, '/assets/icons/companies/2.svg', 100, '1.00', 'Acruex'),
(3, 6, '/assets/icons/companies/1.svg', 100, '3.00', 'Magnemo'),
(4, 6, '/assets/icons/companies/2.svg', 100, '1.00', 'Acruex');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_credit` int(11) NOT NULL,
  `user_threads_limit` int(11) NOT NULL,
  `user_api_key` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_email`, `user_password`, `user_credit`, `user_threads_limit`, `user_api_key`) VALUES
(6, 'test@app.com', '202cb962ac59075b964b07152d234b70', 420, 0, '9B0B06EEAE2BD9C-03-268D'),
(7, 'test1@app.com', '202cb962ac59075b964b07152d234b70', 0, 0, 'C9948CA09E5C909-93-6551');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_password_resets`
--
ALTER TABLE `tbl_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_services`
--
ALTER TABLE `tbl_services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_track`
--
ALTER TABLE `tbl_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_password_resets`
--
ALTER TABLE `tbl_password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_services`
--
ALTER TABLE `tbl_services`
  MODIFY `service_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_track`
--
ALTER TABLE `tbl_track`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
