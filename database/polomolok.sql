-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 03:33 PM
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
-- Database: `polomolok`
--

-- --------------------------------------------------------

--
-- Table structure for table `building_a`
--

CREATE TABLE `building_a` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_a`
--

INSERT INTO `building_a` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'A-01', 'Ground Floor', '3,060.00', 1, 'Occupied'),
(2, 'A-02', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(3, 'A-03', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(4, 'A-04', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(5, 'A-05', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(6, 'A-06', 'Ground Floor', '3,060.00', NULL, 'Vacant'),
(7, 'A-07', 'Ground Floor', '2,345.00', NULL, 'Vacant'),
(8, 'A-08', 'Ground Floor', '2,345.00', NULL, 'Vacant'),
(9, 'A-09', 'Ground Floor', '5,265.00', NULL, 'Vacant'),
(10, 'A-10', 'Ground Floor', '3,968.00', NULL, 'Vacant'),
(11, 'A-11', 'Ground Floor', '2,345.00', NULL, 'Vacant'),
(12, 'A-12', 'Ground Floor', '2,746.00', NULL, 'Vacant'),
(13, 'A-13', 'Ground Floor', '2,165.00', NULL, 'Vacant'),
(14, 'A-14', 'Ground Floor', '2,345.00', NULL, 'Vacant'),
(15, 'A-15', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(16, 'A-16', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(17, 'A-17', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(18, 'A-18', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(19, 'A-19', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(20, 'A-20', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(21, 'A-21', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(22, 'A-22', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(23, 'A-23', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(24, 'A-24', 'Ground Floor', '3,335.00', NULL, 'Vacant'),
(25, 'A-25', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(26, 'A-26', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(27, 'A-27', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(28, 'A-28', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(29, 'A-29', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(30, 'A-30', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(31, 'A-31', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(32, 'A-32', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(33, 'A-33', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(34, 'A-34', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(35, 'A-35', 'Ground Floor', '6,179.00', NULL, 'Vacant'),
(36, 'A-36', 'Ground Floor', '6,615.00', NULL, 'Vacant'),
(37, 'A-37', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(38, 'A-38', 'Ground Floor', '5,670.00', NULL, 'Vacant'),
(39, 'A-39', 'Ground Floor', '5,076.00', NULL, 'Vacant'),
(40, 'A-40', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(41, 'A-41', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(42, 'A-42', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(43, 'A-43', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(44, 'A-44', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(45, 'A-45', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(46, 'A-46', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(47, 'A-47', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(48, 'A-48', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(49, 'A-49', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(50, 'A-50', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(51, 'A-51', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(52, 'A-52', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(53, 'A-53', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(54, 'A-54', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(55, 'A-55', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(56, 'A-56', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(57, 'A-57', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(58, 'A-58', 'Ground Floor', '4,680.00', NULL, 'Vacant'),
(59, 'A-59', 'Ground Floor', '3,335.00', NULL, 'Vacant'),
(60, 'A-60', 'Ground Floor', '1,190.00', NULL, 'Vacant'),
(61, 'A-61', 'Ground Floor', '3,315.00', NULL, 'Vacant'),
(62, 'A-62', 'Ground Floor', '3,315.00', NULL, 'Vacant'),
(63, 'A-62A', 'Ground Floor', '3,700.00', NULL, 'Vacant'),
(64, 'A-63', 'Ground Floor', '6,146.00', NULL, 'Vacant'),
(65, 'A-64', 'Ground Floor', '6,254.00', NULL, 'Vacant'),
(66, 'A-65', 'Ground Floor', '5,175.00', NULL, 'Vacant'),
(67, 'A-66', 'Ground Floor', '3,175.00', NULL, 'Vacant'),
(69, 'A-67', 'Ground Floor', '3,159.00', NULL, 'Vacant'),
(70, 'A-68', 'Ground Floor', '1,706.00', NULL, 'Vacant'),
(71, 'A-69', 'Second Floor', '4,464.00', NULL, 'Vacant'),
(72, 'A-70', 'Second Floor', '4,464.00', NULL, 'Vacant'),
(73, 'A-71', 'Second Floor', '4,464.00', NULL, 'Vacant'),
(74, 'A-72', 'Second Floor', '4,464.00', NULL, 'Vacant'),
(75, 'A-73', 'Second Floor', '3,729.00', NULL, 'Vacant'),
(76, 'A-74', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(77, 'A-75', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(78, 'A-76', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(79, 'A-77', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(80, 'A-78', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(81, 'A-79', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(82, 'A-80', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(83, 'A-81', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(84, 'A-82', 'Second Floor', '5,266.00', NULL, 'Vacant'),
(85, 'A-83', 'Second Floor', '4,032.00', NULL, 'Vacant'),
(86, 'A-84', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(87, 'A-85', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(88, 'A-86', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(89, 'A-87', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(90, 'A-88', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(91, 'A-89', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(92, 'A-90', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(93, 'A-91', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(94, 'A-92', 'Second Floor', '3,730.00', NULL, 'Vacant'),
(95, 'A-93', 'Second Floor', '5,266.00', NULL, 'Vacant'),
(96, 'A-94', 'Second Floor', '3,730.00', NULL, 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `building_b`
--

CREATE TABLE `building_b` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_c`
--

CREATE TABLE `building_c` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_d`
--

CREATE TABLE `building_d` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_e`
--

CREATE TABLE `building_e` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_f`
--

CREATE TABLE `building_f` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_g`
--

CREATE TABLE `building_g` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_h`
--

CREATE TABLE `building_h` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_i`
--

CREATE TABLE `building_i` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_j`
--

CREATE TABLE `building_j` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `other_supporting` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email_add` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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

-- --------------------------------------------------------

--
-- Table structure for table `rent_application`
--

CREATE TABLE `rent_application` (
  `rent_app_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_application`
--

INSERT INTO `rent_application` (`rent_app_id`, `first_name`, `middle_name`, `last_name`, `contact_no`, `age`, `email`, `address`, `sent_date`) VALUES
(0, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 9510462062, 22, 'reyanjansamontanes@gmail.com', 'Polotana Subdivision, West Drive.', '2024-07-19 12:45:31');

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
(1, 'admin', 'admin123', 'ADMIN1', 'admin1', 'ADMIN1', 43, 'dddddd', 'dededddeede', NULL, 'ADMIN');

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
(1, 'ven1', 'ven123', 'Vendor1', 'vendow1', 'vendor1', 43, '4343434', '43fer4refw', 3233252362, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_a`
--
ALTER TABLE `building_a`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_b`
--
ALTER TABLE `building_b`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_c`
--
ALTER TABLE `building_c`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_d`
--
ALTER TABLE `building_d`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_e`
--
ALTER TABLE `building_e`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_f`
--
ALTER TABLE `building_f`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_g`
--
ALTER TABLE `building_g`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_h`
--
ALTER TABLE `building_h`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_i`
--
ALTER TABLE `building_i`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `building_j`
--
ALTER TABLE `building_j`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `building_a`
--
ALTER TABLE `building_a`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `building_b`
--
ALTER TABLE `building_b`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_c`
--
ALTER TABLE `building_c`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_d`
--
ALTER TABLE `building_d`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_e`
--
ALTER TABLE `building_e`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_f`
--
ALTER TABLE `building_f`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_g`
--
ALTER TABLE `building_g`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_h`
--
ALTER TABLE `building_h`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_i`
--
ALTER TABLE `building_i`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_j`
--
ALTER TABLE `building_j`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `building_a`
--
ALTER TABLE `building_a`
  ADD CONSTRAINT `building_a_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_b`
--
ALTER TABLE `building_b`
  ADD CONSTRAINT `building_b_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_c`
--
ALTER TABLE `building_c`
  ADD CONSTRAINT `building_c_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_d`
--
ALTER TABLE `building_d`
  ADD CONSTRAINT `building_d_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_e`
--
ALTER TABLE `building_e`
  ADD CONSTRAINT `building_e_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_f`
--
ALTER TABLE `building_f`
  ADD CONSTRAINT `building_f_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_g`
--
ALTER TABLE `building_g`
  ADD CONSTRAINT `building_g_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_h`
--
ALTER TABLE `building_h`
  ADD CONSTRAINT `building_h_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_i`
--
ALTER TABLE `building_i`
  ADD CONSTRAINT `building_i_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `building_j`
--
ALTER TABLE `building_j`
  ADD CONSTRAINT `building_j_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
