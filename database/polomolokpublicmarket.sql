-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 05:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `polomolokpublicmarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

DROP TABLE IF EXISTS `users_account`;
CREATE TABLE `users_account` (
  `account_id` int(11) NOT NULL,
  `user_type` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `age` int(50) NOT NULL,
  `contact_number` bigint(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `store_number` bigint(150) NOT NULL,
  `building_type` varchar(200) NOT NULL,
  `started_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `monthly_payment` bigint(250) NOT NULL,
  `lease_agreements` varchar(60) DEFAULT NULL,
  `business_permits` varchar(60) DEFAULT NULL,
  `supporting_docu` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `users_account`:
--

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`account_id`, `user_type`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `contact_number`, `address`, `store_number`, `building_type`, `started_date`, `end_date`, `monthly_payment`, `lease_agreements`, `business_permits`, `supporting_docu`) VALUES
(1, 'Admin', 'meedo', 'meedo123', '', '', '', 0, 0, '', 0, '', '2024-06-26', '2024-06-26', 0, '', '', ''),
(2, 'Vendor', 'vendors', 'vendor123', '', '', '', 0, 0, '', 0, '', '2024-06-26', '2024-06-26', 0, '', '', ''),
(3, 'Vendor', 'MarkMeedo', 'mark123', 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 22, 9510462062, 'Polotana Subdivision, West Drive.', 2424, 'residential', '2024-06-27', '2024-07-31', 12333, 'table.txt', 'table.txt', 'table.txt'),
(4, 'Staff', 'Prynce', 'prince1234', 'Prynce Jay', 'Omar', 'Sayre', 23, 9510462062, 'bawing', 2010, 'commercial', '2024-06-27', '2024-07-31', 1200, 'table.txt', 'PlantsVsZombies.exe', 'PlantsVsZombies.exe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table users_account
--

--
-- Metadata for database polomolokpublicmarket
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
