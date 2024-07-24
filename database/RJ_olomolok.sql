-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 03:17 AM
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
-- Database: `olomolok`
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
(1, 'A-01', 'Ground Floor', '3,060.00', 52, 'Occupied'),
(2, 'A-02', 'Ground Floor', '5,400.00', 54, 'Occupied'),
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

--
-- Dumping data for table `building_b`
--

INSERT INTO `building_b` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'B-01', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(2, 'B-02', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(3, 'B-03', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(4, 'B-04', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(5, 'B-05', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(6, 'B-06', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(7, 'B-07', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(8, 'B-08', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(9, 'B-09', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(10, 'B-10', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(11, 'B-11', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(12, 'B-12', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(13, 'B-13', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(14, 'B-14', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(15, 'B-15', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(16, 'B-16', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(17, 'B-17', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(18, 'B-18', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(19, 'B-19', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(20, 'B-20', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(21, 'B-21', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(22, 'B-22', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(23, 'B-23', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(24, 'B-24', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(25, 'B-25', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(26, 'B-26', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(27, 'B-27', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(28, 'B-28', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(29, 'B-29', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(30, 'B-30', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(31, 'B-31', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(32, 'B-32', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(33, 'B-33', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(34, 'B-34', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(35, 'B-35', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(36, 'B-36', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(37, 'B-37', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(38, 'B-38', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(39, 'B-39', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(40, 'B-40', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(41, 'B-41', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(42, 'B-42', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(43, 'B-43', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(44, 'B-44', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(45, 'B-45', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(46, 'B-46', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(47, 'B-47', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(48, 'B-48', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(49, 'B-49', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(50, 'B-50', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(51, 'B-51', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(52, 'B-52', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(53, 'B-53', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(54, 'B-54', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(55, 'B-55', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(56, 'B-56', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(57, 'B-57', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(58, 'B-58', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(59, 'B-59', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(60, 'B-60', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(61, 'B-61', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(62, 'B-62', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(63, 'B-63', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(64, 'B-64', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(65, 'B-65', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(66, 'B-66', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(67, 'B-67', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(68, 'B-68', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(69, 'B-69', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(70, 'B-70', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(71, 'B-71', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(72, 'B-72', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(73, 'B-73', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(74, 'B-74', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(75, 'B-75', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(76, 'B-76', 'Ground Floor', '1,465.00', NULL, 'Vacant'),
(77, 'B-77', 'Ground Floor', '1,465.00', NULL, 'Vacant'),
(78, 'B-78', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(79, 'B-79', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(80, 'B-80', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(81, 'B-81', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(82, 'B-82', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(83, 'B-83', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(84, 'B-84', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(85, 'B-85', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(86, 'B-86', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(87, 'B-87', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(88, 'B-88', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(89, 'B-89', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(90, 'B-90', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(91, 'B-91', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(92, 'B-92', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(93, 'B-93', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(94, 'B-94', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(95, 'B-95', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(96, 'B-96', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(97, 'B-97', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(98, 'B-98', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(99, 'B-99', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(100, 'B-100', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(101, 'B-101', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(102, 'B-102', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(103, 'B-103', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(104, 'B-104', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(105, 'B-105', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(106, 'B-106', 'Ground Floor', '1,755.00', NULL, 'Vacant'),
(107, 'B-107', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(108, 'B-108', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(109, 'B-109', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(110, 'B-110', 'Ground Floor', '2,700.00', NULL, 'Vacant'),
(111, 'B-111', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(112, 'B-112', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(113, 'B-113', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(114, 'B-114', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(115, 'B-115', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(116, 'B-116', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(117, 'B-117', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(118, 'B-118', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(119, 'B-119', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(120, 'B-120', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(121, 'B-121', 'Ground Floor', '2,025.00', NULL, 'Vacant'),
(122, 'B-122', 'Ground Floor', '506.00', NULL, 'Vacant'),
(123, 'B-123', 'Ground Floor', '506.00', NULL, 'Vacant'),
(124, 'B-124', 'Ground Floor', '506.00', NULL, 'Vacant'),
(125, 'B-125', 'Ground Floor', '506.00', NULL, 'Vacant'),
(126, 'B-126', 'Ground Floor', '506.00', NULL, 'Vacant'),
(127, 'B-127', 'Ground Floor', '506.00', NULL, 'Vacant'),
(128, 'B-128', 'Ground Floor', '506.00', NULL, 'Vacant'),
(129, 'B-129', 'Ground Floor', '506.00', NULL, 'Vacant'),
(130, 'B-130', 'Ground Floor', '506.00', NULL, 'Vacant'),
(131, 'B-131', 'Ground Floor', '506.00', NULL, 'Vacant'),
(132, 'B-132', 'Ground Floor', '506.00', NULL, 'Vacant'),
(133, 'B-133', 'Ground Floor', '506.00', NULL, 'Vacant'),
(134, 'B-134', 'Ground Floor', '506.00', NULL, 'Vacant'),
(135, 'B-135', 'Ground Floor', '506.00', NULL, 'Vacant'),
(136, 'B-136', 'Ground Floor', '506.00', NULL, 'Vacant'),
(137, 'B-137', 'Ground Floor', '506.00', NULL, 'Vacant'),
(138, 'B-138', 'Ground Floor', '506.00', NULL, 'Vacant'),
(139, 'B-139', 'Ground Floor', '506.00', NULL, 'Vacant'),
(140, 'B-140', 'Ground Floor', '506.00', NULL, 'Vacant');

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

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `vendor_id`, `lease_agreements`, `business_permits`, `business_license`, `other_supporting`) VALUES
(3, 52, 0x64617461732f61796f6f6f2f323032342d30372d31342f3320496e7374616c6c6d656e74732e706e67, 0x64617461732f61796f6f6f2f323032342d30372d31342f3320496e7374616c6c6d656e74732e706e67, 0x64617461732f61796f6f6f2f323032342d30372d31342f327031306e657433302e706e67, ''),
(4, 54, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inq_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email_add` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` longtext NOT NULL,
  `sent_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`inq_id`, `name`, `email_add`, `subject`, `message`, `sent_date`) VALUES
(13, 'MEIL SHEIDA PANAGUITON', 'meilsheidapn@gmail.com', 'Inquiries', 'may availbale stall po ba sa isdaan.', '2024-07-22 07:59:53');

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

--
-- Dumping data for table `pagebuilder_table`
--

INSERT INTO `pagebuilder_table` (`stats_id`, `buildings`, `overall_stalls`, `vendors`, `workers`) VALUES
(1, 10, 1039, 765, 50);

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
(3, 52, 0x64617461732f61796f6f6f2f323032342d30372d31342f327031306e657433302e706e67, '2024-07-15'),
(4, 54, 0x64617461732f52657472794c616e674e616d616e2f323032342d30372d31362f3433343432383034315f3734343031323537313035333639365f323334323739343430333837383535313035315f6e2e6a7067, '2024-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `relocation_req`
--

CREATE TABLE `relocation_req` (
  `relocation_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `relocation_status` enum('Processing','Accepted','Declined') DEFAULT 'Processing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `relocation_req`
--

INSERT INTO `relocation_req` (`relocation_id`, `vendor_id`, `message`, `date_sent`, `relocation_status`) VALUES
(8, 54, 'i would like to relocate', '2024-07-22 07:01:48', 'Processing'),
(9, 54, 'hkjhkjhjkgdgfxdgf', '2024-07-22 07:54:40', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `rent_application`
--

CREATE TABLE `rent_application` (
  `Approval` enum('APPROVED','DECLINED','PROCESSING','') NOT NULL DEFAULT 'PROCESSING',
  `applicant_id` int(11) NOT NULL,
  `first_name` varchar(250) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `building_type` text DEFAULT NULL,
  `stall_no` bigint(20) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `rentapp_file` text NOT NULL,
  `applied_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_application`
--

INSERT INTO `rent_application` (`Approval`, `applicant_id`, `first_name`, `middle_name`, `last_name`, `contact_no`, `building_type`, `stall_no`, `age`, `email`, `address`, `rentapp_file`, `applied_date`) VALUES
('APPROVED', 2021, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 9510462062, NULL, 20, 34, 'reyanjansamontanes@gmail.com', 'Polotana Subdivision, West Drive.', 'rent_applications_file_dir/5975398383219481032-Polomolok-Public-Market-Rent-Application-Form.pdf', '2024-07-23 22:53:24');

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
(11, 'rj', '21rj', 'reyan', 'jan', 'samontanes', 43, 'polomolok', 'gmail.com', 3233252, 'ADMIN'),
(28, 'June', 'june123', 'June', 'vene', 'veneracion', 38, 'Polotana Subdivision, West Drive.', 'ggmeil@gmail.com', 9510462062, 'STAFF');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `Vendor Status` enum('ACTIVE','INACTIVE','ON PROCESS','ON HOLD','DEACTIVATED','ON TRANSFER') NOT NULL DEFAULT 'INACTIVE',
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

INSERT INTO `vendors` (`Vendor Status`, `vendor_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `started_date`, `end_date`) VALUES
('INACTIVE', 52, 'polomolokvendor1', 'polsocot', 'Polomolok', 'Soouth', 'Cotsbsto', NULL, NULL, NULL, NULL, '2023-12-14', '2024-11-14'),
('INACTIVE', 54, 'pj', 'jp123', 'Prince', 'Jay', 'Sayre', 21, 'Bawing', 'weqf32532d', 9510462062, '2024-07-25', '2024-07-04');

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
  ADD PRIMARY KEY (`inq_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `vendor_id` (`vendor_id`,`id`);

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
-- Indexes for table `relocation_req`
--
ALTER TABLE `relocation_req`
  ADD PRIMARY KEY (`relocation_id`);

--
-- Indexes for table `rent_application`
--
ALTER TABLE `rent_application`
  ADD PRIMARY KEY (`applicant_id`);

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
-- AUTO_INCREMENT for table `building_a`
--
ALTER TABLE `building_a`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `building_b`
--
ALTER TABLE `building_b`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

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
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pagebuilder_table`
--
ALTER TABLE `pagebuilder_table`
  MODIFY `stats_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `receipts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `relocation_req`
--
ALTER TABLE `relocation_req`
  MODIFY `relocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rent_application`
--
ALTER TABLE `rent_application`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2024;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
