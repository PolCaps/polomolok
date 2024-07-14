-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 01:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polomolokmarkets`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `lease_agreements` longblob DEFAULT NULL,
  `business_permits` longblob DEFAULT NULL,
  `business_license` longblob DEFAULT NULL,
  `other_support` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pagebuilder_table`
--

CREATE TABLE `pagebuilder_table` (
  `stats_id` bigint(20) NOT NULL,
  `buildings` bigint(20) NOT NULL,
  `overall_stalls` bigint(20) NOT NULL,
  `vendors` bigint(20) NOT NULL,
  `workers` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pagebuilder_table`
--

INSERT INTO `pagebuilder_table` (`stats_id`, `buildings`, `overall_stalls`, `vendors`, `workers`) VALUES
(1, 25, 12, 11, 10);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `receipt_id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `issued_date` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_id` int(11) NOT NULL,
  `stall_no` bigint(20) NOT NULL,
  `building_type` enum('Building A','Building B','Building C','Building D','Building E','Building F','Building G','Building H','Building I','Building J') NOT NULL,
  `building_floor` enum('Ground Floor','Second Floor','Third Floor') NOT NULL,
  `monthly_rental` bigint(20) DEFAULT NULL,
  `total_stalls` int(11) NOT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_id`, `stall_no`, `building_type`, `building_floor`, `monthly_rental`, `total_stalls`, `vendor_id`, `stall_status`) VALUES
(1, 1, 'Building A', 'Ground Floor', NULL, 66, 1, 'Vacant'),
(2, 2, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(3, 3, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(4, 4, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(5, 5, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(6, 6, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(7, 7, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(8, 8, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(9, 9, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(10, 10, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(11, 11, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(12, 12, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(13, 13, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(14, 14, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(15, 15, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(16, 16, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(17, 17, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(18, 18, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(19, 19, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(20, 20, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(21, 21, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(22, 22, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(23, 23, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(24, 24, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(25, 25, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(26, 26, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(27, 27, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(28, 28, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(29, 29, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(30, 30, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(31, 31, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(32, 32, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(33, 33, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(34, 34, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(35, 35, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(36, 36, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(37, 37, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(38, 38, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(39, 39, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(40, 40, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(41, 41, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(42, 42, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(43, 43, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(44, 44, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(45, 45, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(46, 46, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(47, 47, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(48, 48, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(49, 49, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(50, 50, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(51, 51, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(52, 52, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(53, 53, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(54, 54, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(55, 55, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(56, 56, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(57, 57, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(58, 58, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(59, 59, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(60, 60, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(61, 61, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(62, 62, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(63, 63, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(64, 64, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(65, 65, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant'),
(66, 66, 'Building A', 'Ground Floor', NULL, 66, NULL, 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_add` varchar(255) DEFAULT NULL,
  `contact_no` bigint(20) DEFAULT NULL,
  `user_type` enum('ADMIN','STAFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `user_type`) VALUES
(1, 'meedo', 'meedo123', 'Mekolok', 'M', 'Mayala', 21, 'Purok Dimakita', 'habadu@email.com', 9129312132, 'ADMIN'),
(2, 'staff', 'staff123', 'Meil', 'P', 'Panaguiton', NULL, NULL, NULL, NULL, 'STAFF'),
(4, 'mads', '$2y$10$F1mqXekaEt8qRm7DNb/ZN.2TP7PTOBNrqWORXJZUyZo', 'Boloknot', 'W', 'Wen', 14, 'sayre residence purok darussalam bawing', 'Boloknot@email.com', NULL, 'ADMIN'),
(6, 'madsoy', '$2y$10$Lrm0qtvUV5SzlYXxJ76jY.Naz4wS3bek8M8f9IJRieH', 'Boloknot', 'W', 'Wen', 14, 'sayre residence purok darussalam bawing', 'Boloknot@email.com', NULL, 'ADMIN'),
(7, 'Polokol', 'Polokol123', 'Prence', 'S', 'Sayre', 53, 'sayre residence purok darussalam bawing', 'prince@email.com', NULL, 'ADMIN'),
(8, 'proStaff', 'staff123', 'Staplon', 'L', 'Montefalco', 21, 'sayre residence purok darussalam bawing', 'staphanie@email.com', NULL, 'STAFF'),
(9, 'meil', '$2y$10$Jv3bD5U3icPY.FlFqrJ2luLt1gURg8Tx5XIPw30sl1B', 'Meil Sheida', 'P', 'Panaguiton', 25, 'sayre residence purok darussalam bawing', 'example@email.com', 9171600383, 'ADMIN'),
(10, 'Pirnce', '$2y$10$XljQKOiUKQP9WKJ0OgVjQeJsP7wIYuON/J0uy2huPRb', 'Prince', 'j', 'Syare', 6, 'sayre residence purok darussalam bawing', 'awdqwdqw', 9171600383, 'ADMIN'),
(11, 'awd', '$2y$10$DlWMHlV0NC0r0pA5yhF5/epfa18VXu4MiSWLFUy1Rtn', 'awdawd', 'qwdqwd', 'qwdqwd', 215, 'sayre residence purok darussalam bawing', 'awdawd', 12512125, 'ADMIN'),
(12, 'awdasd', '$2y$10$SzMD3fCX0B5Cnjem8yd2luID.ysl66hKVRdTXct4aj9', 'qwdqwd', 'qwd', 'qwd', 214, 'awdawda', '124awdawd', 21, 'ADMIN'),
(13, 'awdawdqwd', '$2y$10$pr71bBITCU2FrBm3qrsk1eZ2BGnjLUM4fUR.C3CZ1Ry', 'uiktyfj', 'tyj', 'rtyj', 325, 'vqrewrtvw', '324aercw', 5464363, 'STAFF'),
(14, 'vvv', '$2y$10$PUp4aVk7Rs7pPfF7.WwdtOTp9btu.7f3nBuuvSlU74D', 'vvv', 'vvv', 'vvv', 21, 'vvawd', 'wdad', 213214, 'STAFF'),
(15, 'awdawd', '$2y$10$MjWzHaA4XeGEvClkt.utu.Z/aoTt.p/aeNpnK3VK/IZ', 'awdq', 'wdqwdq', 'wd', 42, 'adawdad', '23awdaw', 32523, 'STAFF'),
(19, 'tetrtr', '$2y$10$sgyzpX04XmnHfYERS6sl/.NHngVyMZfCs2XUAOnnnAI', 'qwdqw', 'dqwd', 'qwdqwd', 123, 'asdawd', 'awdawd', NULL, 'ADMIN'),
(23, 'bagoni', '$2y$10$vqWlNzrXcIxRv95CZ8hdk.AevKMvWqaaG9Hgjy7ob.Q', 'olnaedln', 'nekl', 'lwefnkwn', 31, 'lkeafwelfnl', 'lnfesfwef', NULL, 'ADMIN'),
(26, 'popol', '$2y$10$Y0EHGAUOWKY7ctsXe..Ba.uzrc/zS67QFCllEcMs.Bw', 'ijkensf', 'jnsf', 'nsef ', 231, 'ikebnfsefbkse', 'qwd', NULL, 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_add` varchar(255) DEFAULT NULL,
  `contact_no` bigint(20) DEFAULT NULL,
  `stall_no` bigint(20) NOT NULL,
  `started_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `stall_no`, `started_date`, `end_date`) VALUES
(1, 'Chua', 'Chua123', 'Briar', 'Rose', 'Chua', 21, 'Purok Dimaikta', 'BriarRosemarie@email.com', 9129312132, 1, '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `fk_vendors_id` (`vendor_id`);

--
-- Indexes for table `pagebuilder_table`
--
ALTER TABLE `pagebuilder_table`
  ADD PRIMARY KEY (`stats_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `fk_vendor_id` (`vendor_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_id`),
  ADD UNIQUE KEY `stall_no` (`stall_no`,`building_type`,`building_floor`),
  ADD KEY `idx_vendor_id` (`vendor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `fk_stall_no` (`stall_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pagebuilder_table`
--
ALTER TABLE `pagebuilder_table`
  MODIFY `stats_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_vendors_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `fk_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `fk_stall_no` FOREIGN KEY (`stall_no`) REFERENCES `stalls` (`stall_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
