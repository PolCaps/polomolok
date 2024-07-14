-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2024 at 09:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `lease_agreements` longblob NOT NULL,
  `business_permits` longblob NOT NULL,
  `business_license` longblob NOT NULL,
  `other_supporting` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `vendor_id`, `lease_agreements`, `business_permits`, `business_license`, `other_supporting`) VALUES
(1, 23, '', '', '', ''),
(2, 24, '', '', '', ''),
(3, 25, 0x64617461732f61796f6f6f2f323032342d30372d31342f3320496e7374616c6c6d656e74732e706e67, 0x64617461732f61796f6f6f2f323032342d30372d31342f3320496e7374616c6c6d656e74732e706e67, 0x64617461732f61796f6f6f2f323032342d30372d31342f327031306e657433302e706e67, '');

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
  `receipts_id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `receipts` longblob DEFAULT NULL,
  `issued_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`receipts_id`, `vendor_id`, `receipts`, `issued_date`) VALUES
(1, 23, '', '2024-07-15'),
(2, 24, '', '2024-07-15'),
(3, 25, 0x64617461732f61796f6f6f2f323032342d30372d31342f327031306e657433302e706e67, '2024-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_id` int(11) NOT NULL,
  `stall_no` bigint(20) NOT NULL,
  `building_type` varchar(255) NOT NULL,
  `building_floor` varchar(255) NOT NULL,
  `monthly_rental` bigint(20) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_id`, `stall_no`, `building_type`, `building_floor`, `monthly_rental`, `vendor_id`, `stall_status`) VALUES
(75, 9, 'Building A', 'Ground Floor', 897678, 17, 'Occupied'),
(76, 21, 'Building A', 'Ground Floor', 3423, 18, 'Occupied'),
(77, 22, 'Building A', 'Ground Floor', 32525, 19, 'Occupied'),
(78, 24, 'Building A', 'Ground Floor', 324567, 20, 'Occupied'),
(79, 25, 'Building A', 'Ground Floor', 23456, 21, 'Occupied'),
(80, 30, 'Building A', 'Ground Floor', 345, 22, 'Occupied'),
(81, 32, 'Building A', 'Ground Floor', 3455, 23, 'Occupied'),
(82, 6, 'Building A', 'Ground Floor', 324567543, 24, 'Occupied'),
(83, 21, 'Building A', 'Ground Floor', 98765, 25, 'Occupied');

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
(26, 'popol', '$2y$10$Y0EHGAUOWKY7ctsXe..Ba.uzrc/zS67QFCllEcMs.Bw', 'ijkensf', 'jnsf', 'nsef ', 231, 'ikebnfsefbkse', 'qwd', NULL, 'ADMIN'),
(27, 'shete', 'hahaha', 'polokol', 'a', 'adsw', 21, 'awdawd', 'awdawd', NULL, 'STAFF');

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
  `started_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `started_date`, `end_date`) VALUES
(16, 'rj21', 'mine', 'mine', 'mine', '0', 17, 'Polotana Subdivision, West Drive.', 'ev34rfwed', 9510462062, '2024-07-15', '2024-08-29'),
(17, 'janjan', 'janjan13', 'jan', 'jan', '0', 20, 'Polotana Subdivision, West Drive.', '7etyhjd65htyh', 95103620893, '2024-07-15', '2024-10-10'),
(18, 'cry', 'cry123', 'cry', 'cry', '0', 45, 'Polotana Subdivision, West Drive.', '3242rqwfe24', 9510462062, '2024-07-18', '2024-09-19'),
(19, 'ahay', 'kapoyna123', 'kapoy', 'H', '0', 20, 'Polotana Subdivision, West Drive.', '32rfwe34refwqq3', 1234234, '2024-07-15', '2024-07-15'),
(20, 'atay', 'yawaaauy', 'mine', 'mine', 'mine', 121, 'Polotana Subdivision, West Drive.', '78ed76dcv', 9510462062, '2024-07-15', '2024-08-22'),
(21, 'prince', 'p123', 'prince', 'omar', 'sayre', 21, 'Polotana Subdivision, West Drive.', '324tergfdbvf', 9510462062, '2024-07-15', '2024-11-15'),
(22, 'tdtetrdrtr', '78rffytedt', 'zxxf', 'xcuyfhv', 'ytxgchydcg', 33, 'Polotana Subdivision, West Drive.', '76ytxch', 98765456, '2024-07-15', '2024-08-16'),
(23, '0987rfghn', '0987thn', 'atay', 'ahay', 'hahha', 33, 'Polotana Subdivision, West Drive.', 'q2erefdcegr', 98765456, '2024-07-15', '2024-07-15'),
(24, '984yr8ewfiuweo', '-079y32h4iwef', '32rfwe', '235r24fwecds', 'f324t35grewf', 53, 'Polotana Subdivision, West Drive.', '3234trf32ew', 98765456, '2024-07-15', '2024-08-16'),
(25, 'ayooo', 'ayoyoyooy', 'ayaywa', 'hahahaha', 'hehehehe', 190, 'Polotana Subdivision, West Drive.', '2345675644rgegvth', 314785643, '2024-07-15', '2024-07-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `pagebuilder_table`
--
ALTER TABLE `pagebuilder_table`
  ADD PRIMARY KEY (`stats_id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`receipts_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_id`),
  ADD KEY `vendor_id` (`vendor_id`);

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
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pagebuilder_table`
--
ALTER TABLE `pagebuilder_table`
  MODIFY `stats_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receipts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `fk_vendor` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
