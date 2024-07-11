-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Jul 09, 2024 at 03:13 AM
=======
-- Generation Time: Jul 11, 2024 at 01:59 PM
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799
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
-- Database: `polomolokpublicmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
<<<<<<< HEAD
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `building_id` int(11) NOT NULL,
  `building_floor` varchar(255) NOT NULL,
  `building_type` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `building_floor`, `building_type`, `user_id`, `vendor_id`) VALUES
(37, 'Building J', 'Ground Floor', 137, NULL),
(38, 'Building J', 'Ground Floor', 137, NULL);
=======
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `user_id`) VALUES
(1, 'MADDIE PADELECI', 1),
(2, 'JAN SAMONTANES', 237);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `documents`
--

=======
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `building_id` int(11) NOT NULL,
  `building_floor` varchar(255) NOT NULL,
  `building_type` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `building_floor`, `building_type`, `user_id`, `vendor_id`) VALUES
(110, 'Second Floor', 'Building J', 210, 38),
(111, 'Ground Floor', 'Building J', 212, 40),
(112, 'Ground Floor', 'Building J', 212, 40),
(113, 'Ground Floor', 'Building J', 214, 42),
(114, 'Ground Floor', 'Building J', 214, 42),
(115, 'Ground Floor', 'Building J', 216, 44),
(116, 'Ground Floor', 'Building J', 216, 44),
(119, 'Ground Floor', 'Building J', 220, 48),
(120, 'Ground Floor', 'Building J', 220, 48),
(121, 'Ground Floor', 'Building J', 222, 50),
(122, 'Ground Floor', 'Building J', 222, 50),
(123, 'Ground Floor', 'Building J', 224, 52),
(124, 'Ground Floor', 'Building J', 224, 52),
(133, 'Ground Floor', 'Building J', 234, 62),
(134, 'Ground Floor', 'Building J', 234, 62),
(135, 'Ground Floor', 'Building J', 236, 64),
(136, 'Ground Floor', 'Building J', 236, 64);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799
CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `receipts` longblob DEFAULT NULL,
  `lease_agreements` longblob DEFAULT NULL,
  `business_permits` longblob DEFAULT NULL,
  `business_licenses` longblob DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `receipts`, `lease_agreements`, `business_permits`, `business_licenses`, `user_id`) VALUES
<<<<<<< HEAD
(18, 0x64617461732f6d6565646f2f323032342d30372d30382f327031306e657433302e706e67, 0x64617461732f6d6565646f2f323032342d30372d30382f327031306e657433302e706e67, 0x64617461732f6d6565646f2f323032342d30372d30382f3320496e7374616c6c6d656e74732e706e67, 0x64617461732f6d6565646f2f323032342d30372d30382f3320496e7374616c6c6d656e74732e706e67, NULL);
=======
(50, 0x64617461732f4d61726b4d6565646f2f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f4d61726b4d6565646f2f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f4d61726b4d6565646f2f323032342d30372d31302f4442414e53574552312e706e67, 0x64617461732f4d61726b4d6565646f2f323032342d30372d31302f4442414e53574552332e706e67, NULL),
(51, 0x64617461732f4d45494c50414e413233332f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f4d45494c50414e413233332f323032342d30372d31302f4442415345322e706e67, 0x64617461732f4d45494c50414e413233332f323032342d30372d31302f4442414e53574552312e706e67, 0x64617461732f4d45494c50414e413233332f323032342d30372d31302f4442414e53574552332e706e67, NULL),
(52, 0x64617461732f5052494e434553415952452f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f5052494e434553415952452f323032342d30372d31302f4442414e53574552322e706e67, 0x64617461732f5052494e434553415952452f323032342d30372d31302f4442415345312e706e67, 0x64617461732f5052494e434553415952452f323032342d30372d31302f4442414e53574552332e706e67, NULL),
(53, 0x64617461732f42524941522020434855412f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f42524941522020434855412f323032342d30372d31302f4442415345342e706e67, 0x64617461732f42524941522020434855412f323032342d30372d31302f4442414e53574552332e706e67, 0x64617461732f42524941522020434855412f323032342d30372d31302f4442414e53574552322e706e67, 216),
(54, 0x64617461732f52522042415252414e434f2053414d4f4e54414e45532f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, 0x64617461732f52522042415252414e434f2053414d4f4e54414e45532f323032342d30372d31302f6c6173746e616d652e706e67, 0x64617461732f52522042415252414e434f2053414d4f4e54414e45532f323032342d30372d31302f4442414e53574552312e706e67, 0x64617461732f52522042415252414e434f2053414d4f4e54414e45532f323032342d30372d31302f73616d6f6e74616e657346312e706e67, 220),
(55, 0x64617461732f5449424f5920204241424f592f323032342d30372d31302f73616d6f6e74436f6465322e706e67, 0x64617461732f5449424f5920204241424f592f323032342d30372d31302f73616d6f6e74436f6465312e706e67, 0x64617461732f5449424f5920204241424f592f323032342d30372d31302f73616d6f6e74616e657346312e706e67, 0x64617461732f5449424f5920204241424f592f323032342d30372d31302f73616d6f6e74436f6465332e706e67, 222),
(56, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74616e657346312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465332e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465322e706e67, 224),
(57, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74616e657346312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465332e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465322e706e67, 234),
(58, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74616e657346312e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465332e706e67, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465322e706e67, 236);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `monthly_payments`
--

CREATE TABLE `monthly_payments` (
=======
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799
  `payment_id` int(11) NOT NULL,
  `SOA` longblob DEFAULT NULL,
  `receipts` longblob DEFAULT NULL,
  `started_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `document_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
<<<<<<< HEAD
-- Dumping data for table `monthly_payments`
--

INSERT INTO `monthly_payments` (`payment_id`, `SOA`, `receipts`, `started_date`, `end_date`, `document_id`, `user_id`) VALUES
(6, NULL, NULL, '2024-07-25', '2024-08-22', NULL, NULL);
=======
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `SOA`, `receipts`, `started_date`, `end_date`, `document_id`, `user_id`) VALUES
(1, NULL, 0x64617461732f4d61726b4d6565646f2f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, '2024-07-10', '2024-08-07', 50, 210),
(2, NULL, 0x64617461732f4d45494c50414e413233332f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, '2024-10-17', '2025-02-14', 51, 212),
(3, NULL, 0x64617461732f5052494e434553415952452f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, '2024-07-10', '2025-01-24', 52, 214),
(4, NULL, 0x64617461732f42524941522020434855412f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, '2024-07-10', '2024-08-08', 53, 216),
(5, NULL, 0x64617461732f52522042415252414e434f2053414d4f4e54414e45532f323032342d30372d31302f73616d6f6e74616e65735450496e666f2e706466, '2024-07-10', '2024-11-15', 54, 220),
(6, NULL, 0x64617461732f5449424f5920204241424f592f323032342d30372d31302f73616d6f6e74436f6465322e706e67, '2024-07-10', '2025-01-10', 55, 222),
(7, NULL, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, '2024-07-10', '2024-08-14', 56, 224),
(8, NULL, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, '2024-07-10', '2024-08-14', 57, 234),
(9, NULL, 0x64617461732f524559205341432053414d4f2f323032342d30372d31302f73616d6f6e74436f6465312e706e67, '2024-07-10', '2024-08-14', 58, 236);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
-- Table structure for table `personal_profile`
--

CREATE TABLE `personal_profile` (
  `personal_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `contact_number` bigint(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personal_profile`
--

INSERT INTO `personal_profile` (`personal_id`, `first_name`, `middle_name`, `last_name`, `age`, `contact_number`, `address`) VALUES
<<<<<<< HEAD
(137, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, 9510462062, '9504\r\nWEST DRIVE');
=======
(210, 'MARK', 'MARCO', 'MARCOPOLO', 20, 9510462062, 'Polotana Subdivision, West Drive.'),
(212, 'MEIL', '', 'PANAGUITON', 21, 9129875432, 'GENSAN'),
(214, 'PRINCE JAY', 'MOHAMMAD OMAR', 'ABDULJABHAR SAYRE', 22, 99523416524, 'Prk,DARUSSALAM, BAWING, SARANGGANI PROVINCE'),
(216, 'BRIAR', '', 'CHUA', 12, 93409383, 'GLAMANG, GENSAN'),
(220, 'RR', 'BARRANCO', 'SAMONTANES', 89, 9510462062, '9504\r\nWEST DRIVE'),
(222, 'TIBOY', '', 'BABOY', 22, 93657545632, 'Polotana Subdivision, West Drive.'),
(224, 'REY', 'SAC', 'SAMO', 43, 9510462062, 'Polotana Subdivision, West Drive.'),
(234, 'REY', 'SAC', 'SAMO', 43, 9510462062, 'Polotana Subdivision, West Drive.'),
(236, 'REY', 'SAC', 'SAMO', 43, 9510462062, 'Polotana Subdivision, West Drive.');
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staffs_id` int(11) NOT NULL,
  `staffs_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

<<<<<<< HEAD
=======
--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staffs_id`, `staffs_name`, `user_id`) VALUES
(1, 'MEEDO STAFFS', 238),
(2, 'MEEDO STAFFS', 238);

>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799
-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_code` varchar(255) NOT NULL,
  `monthly_rentals` varchar(255) NOT NULL,
  `stall_number` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_code`, `monthly_rentals`, `stall_number`, `user_id`, `building_id`) VALUES
<<<<<<< HEAD
('BJ12', '12312', '12', 137, 38);
=======
('BJ02', '1233', '02', 216, 116),
('BJ07', '1200', '07', 214, 114),
('BJ09', '1200', '09', 212, 112),
('BJ20', '800', '20', 224, 124),
('BJ21', '1200', '21', 220, 120),
('BJ22', '800', '22', 222, 122),
('BJ6', '1200', '6', 210, 110);

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `statsID` int(11) NOT NULL,
  `buildings` int(11) NOT NULL,
  `overall_stalls` int(11) NOT NULL,
  `vendors` int(11) NOT NULL,
  `workers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`statsID`, `buildings`, `overall_stalls`, `vendors`, `workers`) VALUES
(1, 13, 121, 23, 23);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('ADMIN','VENDOR','STAFF') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_type`) VALUES
<<<<<<< HEAD
(101, 'meedo', 'meedo123', 'ADMIN'),
(137, 'meedo', 'meedo123', 'VENDOR');
=======
(1, 'mads', 'mads123', 'ADMIN'),
(210, 'MarkMeedo', 'mark123', 'VENDOR'),
(211, 'MEILPANA233', 'meil123', 'VENDOR'),
(212, 'MEILPANA233', 'meil123', 'VENDOR'),
(213, 'PRINCESAYRE', 'PRINCE123', 'VENDOR'),
(214, 'PRINCESAYRE', 'PRINCE123', 'VENDOR'),
(215, 'BRIAR23', 'briar123', 'VENDOR'),
(216, 'BRIAR23', 'briar123', 'VENDOR'),
(219, 'rr21', 'rr123', 'VENDOR'),
(220, 'rr21', 'rr123', 'VENDOR'),
(221, 'TIBOY', 'tiboybaboy123', 'VENDOR'),
(222, 'TIBOY', 'tiboybaboy123', 'VENDOR'),
(223, 'reysamo', 'REY123', 'VENDOR'),
(224, 'reysamo', 'REY123', 'VENDOR'),
(233, 'reysamo', 'rey123', 'VENDOR'),
(234, 'reysamo', 'rey123', 'VENDOR'),
(235, 'reysamo', 'rey123', 'VENDOR'),
(236, 'reysamo', 'rey123', 'VENDOR'),
(237, 'janjan', 'janjan123', 'ADMIN'),
(238, 'staffsMEEDO', 'staff123', 'STAFF');
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `user_id`) VALUES
<<<<<<< HEAD
(0, 'REYAN JAN BARRANCO SAMONTANES', NULL);
=======
(38, 'MARK MARCO MARCOPOLO', 210),
(39, 'MEIL  PANAGUITON', 212),
(40, 'MEIL  PANAGUITON', 212),
(41, 'PRINCE JAY MOHAMMAD OMAR ABDULJABHAR SAYRE', 214),
(42, 'PRINCE JAY MOHAMMAD OMAR ABDULJABHAR SAYRE', 214),
(43, 'BRIAR  CHUA', 216),
(44, 'BRIAR  CHUA', 216),
(47, 'RR BARRANCO SAMONTANES', 220),
(48, 'RR BARRANCO SAMONTANES', 220),
(49, 'TIBOY  BABOY', 222),
(50, 'TIBOY  BABOY', 222),
(51, 'REY SAC SAMO', 224),
(52, 'REY SAC SAMO', 224),
(61, 'REY SAC SAMO', 234),
(62, 'REY SAC SAMO', 234),
(63, 'REY SAC SAMO', 236),
(64, 'REY SAC SAMO', 236);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `user_id` (`user_id`);

--
<<<<<<< HEAD
-- Indexes for table `monthly_payments`
--
ALTER TABLE `monthly_payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_document_id` (`document_id`);
=======
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `document_id` (`document_id`);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

--
-- Indexes for table `personal_profile`
--
ALTER TABLE `personal_profile`
  ADD KEY `personal_id` (`personal_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staffs_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_code`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `building_id` (`building_id`);

--
<<<<<<< HEAD
=======
-- Indexes for table `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`statsID`);

--
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
<<<<<<< HEAD
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `monthly_payments`
--
ALTER TABLE `monthly_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staffs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stats`
--
ALTER TABLE `stats`
  MODIFY `statsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
=======
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `buildings_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
<<<<<<< HEAD
-- Constraints for table `monthly_payments`
--
ALTER TABLE `monthly_payments`
  ADD CONSTRAINT `fk_document_id` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`),
  ADD CONSTRAINT `monthly_payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `monthly_payments_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `users` (`user_id`);
=======
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`document_id`) REFERENCES `documents` (`document_id`);
>>>>>>> dc70d9c5bde7d9de9a17607a7d91c19b12325799

--
-- Constraints for table `personal_profile`
--
ALTER TABLE `personal_profile`
  ADD CONSTRAINT `personal_profile_ibfk_1` FOREIGN KEY (`personal_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `staffs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `stalls_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `stalls_ibfk_2` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`);

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `vendors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
