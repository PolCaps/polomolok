-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2024 at 09:34 AM
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
-- Database: `polomolokmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `user_id`) VALUES
(1, 'meedo', 1),
(2, 'REYAN JAN BARRANCO SAMONTANES', 14);

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `building_id` int(11) NOT NULL,
  `stall_number` int(11) NOT NULL,
  `building_code` varchar(255) NOT NULL,
  `building_floor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `stall_number`, `building_code`, `building_floor`) VALUES
(18, 18, 'Building I', 'Ground Floor'),
(19, 19, 'Building J', 'Ground Floor'),
(20, 20, 'Building J', 'Ground Floor'),
(21, 21, 'Building J', 'Ground Floor'),
(22, 22, 'Building J', 'Ground Floor'),
(23, 23, 'Building J', 'Ground Floor'),
(24, 24, 'Building J', 'Ground Floor');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `receipts` longblob NOT NULL,
  `lease_agreements` longblob NOT NULL,
  `business_permits` longblob NOT NULL,
  `business_licenses` longblob NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `receipts`, `lease_agreements`, `business_permits`, `business_licenses`, `payment_id`, `vendor_id`) VALUES
(1, 0x64617461732f53616d6f6e74616e65735f30365f4c4142455845522e706466, 0x64617461732f366c61623153616d6f6e74616e65732e504e47, 0x64617461732f366c61623253616d6f6e74616e65732e504e47, 0x64617461732f366c61623353616d6f6e74616e65732e504e47, NULL, NULL),
(2, 0x64617461732f53616d6f6e74616e65735f30365f4c4142455845522e706466, 0x64617461732f366c61623153616d6f6e74616e65732e504e47, 0x64617461732f366c61623353616d6f6e74616e65732e504e47, 0x64617461732f53616d6f6e74616e65735f30365f4c4142455845522e706466, NULL, NULL),
(3, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637970686572312e706466, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637962657273656375726974795f636970686572546578742e706466, NULL, NULL),
(4, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637970686572312e706466, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637962657273656375726974795f636970686572546578742e706466, NULL, NULL),
(5, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637970686572312e706466, 0x64617461732f51393532644e3078316439372e706466, 0x64617461732f637962657273656375726974795f636970686572546578742e706466, NULL, NULL),
(6, 0x64617461732f53616d6f6e74616e65735f30365f4c4142455845522e706466, 0x64617461732f53616d6f6e74616e65732e504e47, 0x64617461732f366c61623153616d6f6e74616e65732e504e47, 0x64617461732f366c61623353616d6f6e74616e65732e504e47, NULL, NULL),
(7, 0x64617461732f76656e646f72732f323032342d30372d30352f53616d6f6e74616e65735f30365f4c4142455845522e706466, 0x64617461732f76656e646f72732f323032342d30372d30352f53616d6f6e74616e65732e504e47, 0x64617461732f76656e646f72732f323032342d30372d30352f366c61623153616d6f6e74616e65732e504e47, 0x64617461732f76656e646f72732f323032342d30372d30352f366c61623253616d6f6e74616e65732e504e47, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `fbk_id` int(11) NOT NULL,
  `fbk_name` varchar(255) NOT NULL,
  `fbk_email` varchar(255) NOT NULL,
  `fbk_subject` varchar(255) NOT NULL,
  `fbk_messages` text NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquire_id` int(11) NOT NULL,
  `inquire_name` varchar(255) NOT NULL,
  `inquire_email` varchar(255) NOT NULL,
  `inquire_subject` varchar(255) NOT NULL,
  `inquire_messages` text NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `monthly_payments` varchar(255) NOT NULL,
  `receipts` longblob NOT NULL,
  `started_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `monthly_payments`, `receipts`, `started_date`, `end_date`, `vendor_id`) VALUES
(10, '5343', '', '2024-07-04', '2025-05-08', NULL),
(11, '1200', '', '2024-07-05', '2024-11-08', NULL),
(12, '1200', '', '2024-07-05', '2024-11-08', NULL),
(13, '1200', '', '2024-07-05', '2024-11-08', NULL),
(14, '1200', '', '2024-07-05', '2024-11-08', NULL),
(15, '2566', '', '2024-07-05', '2024-10-18', NULL),
(16, '21121', '', '2024-07-05', '2024-07-31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_profile`
--

CREATE TABLE `personal_profile` (
  `personal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `building_id` int(11) DEFAULT NULL,
  `stall_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_profile`
--

INSERT INTO `personal_profile` (`personal_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `age`, `contact_number`, `address`, `building_id`, `stall_id`, `payment_id`) VALUES
(12, 13, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(13, 14, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(14, 15, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 23, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(15, 16, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 23, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(16, 17, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 23, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(17, 18, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, '09510462062', 'Polotana Subdivision, West Drive.', NULL, NULL, NULL),
(18, 19, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, '09510462062', '9504\r\nWEST DRIVE', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `user_id`) VALUES
(1, 'REYAN JAN BARRANCO SAMONTANES', 15),
(2, 'REYAN JAN BARRANCO SAMONTANES', 16),
(3, 'REYAN JAN BARRANCO SAMONTANES', 17);

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_id` int(11) NOT NULL,
  `stall_number` int(11) NOT NULL,
  `stall_code` varchar(255) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_id`, `stall_number`, `stall_code`, `vendor_id`, `admin_id`) VALUES
(18, 12, '12', NULL, NULL),
(19, 1, '1', NULL, NULL),
(20, 3, '3', NULL, NULL),
(21, 3, '3', NULL, NULL),
(22, 3, '3', NULL, NULL),
(23, 6, '6', NULL, NULL),
(24, 5, '5', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('ADMIN','VENDOR','STAFF') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
(1, 'meedo', 'meedo123', 'ADMIN'),
(13, 'King', 'king123', 'VENDOR'),
(14, 'John', '123456789', 'ADMIN'),
(15, 'John', 'vendor123', 'STAFF'),
(16, 'John', '123456789', 'STAFF'),
(17, 'John', '123456789', 'STAFF'),
(18, 'MarkMeedo', 'mark123', 'VENDOR'),
(19, 'vendors', 'vendor123', 'VENDOR');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL,
  `stall_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `user_id`, `building_id`, `stall_id`, `payment_id`) VALUES
(3, 'REYAN JAN BARRANCO SAMONTANES', 13, NULL, NULL, NULL),
(4, 'REYAN JAN BARRANCO SAMONTANES', 18, NULL, NULL, NULL),
(5, 'REYAN JAN BARRANCO SAMONTANES', 19, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `stall_number` (`stall_number`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`fbk_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquire_id`),
  ADD KEY `inquiry` (`admin_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `personal_profile`
--
ALTER TABLE `personal_profile`
  ADD PRIMARY KEY (`personal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `fk_building_id` (`building_id`),
  ADD KEY `fk_stall_id` (`stall_id`),
  ADD KEY `fk_payment_id` (`payment_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_id`),
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `stall_id` (`stall_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `building_id` (`building_id`),
  ADD KEY `stall_id` (`stall_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `fbk_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquire_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_profile`
--
ALTER TABLE `personal_profile`
  MODIFY `personal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`stall_number`) REFERENCES `stalls` (`stall_id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL;

--
-- Constraints for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD CONSTRAINT `inquiry` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE CASCADE;

--
-- Constraints for table `personal_profile`
--
ALTER TABLE `personal_profile`
  ADD CONSTRAINT `fk_building_id` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`),
  ADD CONSTRAINT `fk_payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `fk_stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`),
  ADD CONSTRAINT `personal_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `stalls_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `stalls_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`) ON DELETE SET NULL;

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `building_id` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`),
  ADD CONSTRAINT `payment_id` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`),
  ADD CONSTRAINT `vendor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
