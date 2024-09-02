-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 03:03 PM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `building` varchar(255) DEFAULT NULL,
  `stall` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `image_path`, `building`, `stall`, `created_at`) VALUES
(7, 'Notice Of Stall Vacancy', 'Stall Vacant in progress of meedo.', 'announcements/notice.jpg', 'Building A', 'A-07', '2024-08-31 08:53:48'),
(8, 'Notice of Vacancy', 'Vacant', 'announcements/notice.jpg', 'Building J', 'J-76', '2024-09-01 10:40:19'),
(9, 'Notice Of Vacancy', 'vacant corner', 'announcements/notice.jpg', 'Building c', 'C-45', '2024-09-01 11:05:38'),
(11, 'Notice Of Missing Person', 'Tall Dark Short Hair', 'announcements/IMG_20220226_195004.jpg', 'Name:', 'REYAN JAN SAMONTANES', '2024-09-01 11:25:14'),
(12, 'Polomolok Fest', 'Small fest', 'announcements/download.jfif', '', '', '2024-09-02 08:05:20');

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
(1, 'A-01', 'Ground Floor', '3,060.00', 55, 'Occupied'),
(2, 'A-02', 'Ground Floor', '5,400.00', 56, 'Occupied'),
(3, 'A-03', 'Ground Floor', '5,400.00', 57, 'Occupied'),
(4, 'A-04', 'Ground Floor', '5,400.00', 58, 'Occupied'),
(5, 'A-05', 'Ground Floor', '5,400.00', 59, 'Occupied'),
(6, 'A-06', 'Ground Floor', '3,060.00', 60, 'Occupied'),
(7, 'A-07', 'Ground Floor', '2,345.00', 61, 'Occupied'),
(8, 'A-08', 'Ground Floor', '2,345.00', 62, 'Occupied'),
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
(1, 'B-01', 'Ground Floor', '2,025.00', 64, 'Occupied'),
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

--
-- Dumping data for table `building_c`
--

INSERT INTO `building_c` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'C-01', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(2, 'C-02', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(3, 'C-03', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(4, 'C-04', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(5, 'C-05', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(6, 'C-06', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(7, 'C-07', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(8, 'C-08', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(9, 'C-09', 'Ground Floor', '4.725.00', NULL, 'Vacant'),
(10, 'C-10', 'Ground Floor', '5,580.00', NULL, 'Vacant'),
(11, 'C-11', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(12, 'C-12', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(13, 'C-13', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(14, 'C-14', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(15, 'C-15', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(16, 'C-16', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(17, 'C-17', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(18, 'C-18', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(19, 'C-19', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(20, 'C-20', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(21, 'C-21', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(22, 'C-22', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(23, 'C-23', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(24, 'C-24', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(25, 'C-25', 'Ground Floor', '5,580.00', NULL, 'Vacant'),
(26, 'C-26', 'Ground Floor', '4,725.00', NULL, 'Vacant'),
(27, 'C-27', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(28, 'C-28', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(29, 'C-29', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(30, 'C-30', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(31, 'C-31', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(32, 'C-32', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(33, 'C-33', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(34, 'C-34', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(35, 'C-34A', 'Ground Floor', '1,1512.00', NULL, 'Vacant'),
(36, 'C-35', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(37, 'C-36', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(38, 'C-37', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(39, 'C-38', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(40, 'C-39', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(41, 'C-40', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(42, 'C-41', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(43, 'C-42', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(44, 'C-43', 'Ground Floor', '4,838.00', NULL, 'Vacant'),
(45, 'C-44', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(46, 'C-45', 'Ground Floor', '6,075.00', NULL, 'Vacant'),
(47, 'C-46', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(48, 'C-47', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(49, 'C-48', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(50, 'C-49', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(51, 'C-50', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(52, 'C-51', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(53, 'C-52', 'Ground Floor', '8,100.00', NULL, 'Vacant'),
(54, 'C-53', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(55, 'C-54', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(56, 'C-55', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(57, 'C-56', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(58, 'C-57', 'Ground Floor', '6,075.00', NULL, 'Vacant'),
(59, 'C-58', 'Ground Floor', '4,725.00', NULL, 'Vacant'),
(60, 'C-59', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(61, 'C-60', 'Ground Floor', '4,730.00', NULL, 'Vacant'),
(62, 'C-61', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(63, 'C-62', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(64, 'C-63', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(65, 'C-64', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(66, 'C-65', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(67, 'C-66', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(68, 'C-67', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(69, 'C-68', 'Ground Floor', '6,750.00', NULL, 'Vacant'),
(70, 'C-69', 'Second Floor', '2,400.00', NULL, 'Vacant'),
(71, 'C-70', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(72, 'C-71', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(73, 'C-72', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(74, 'C-73', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(75, 'C-74', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(76, 'C-75', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(77, 'C-76', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(78, 'C-77', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(79, 'C-78', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(80, 'C-79', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(81, 'C-79A', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(82, 'C-80', 'Second Floor', '4,320.00', NULL, 'Vacant'),
(83, 'C-81', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(84, 'C-82', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(85, 'C-83', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(86, 'C-84', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(87, 'C-85', 'Second Floor', '4,680.00', NULL, 'Vacant'),
(88, 'C-86', 'Second Floor', '4,680.00', NULL, 'Vacant'),
(89, 'C-87', 'Second Floor', '3,600.00', NULL, ''),
(90, 'C-88', 'Second Floor', '4,320.00', NULL, 'Vacant'),
(91, 'C-89', 'Second Floor', '4,320.00', NULL, 'Vacant'),
(92, 'C-90', 'Second Floor', '4,320.00', NULL, 'Vacant'),
(93, 'C-91', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(94, 'C-92', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(95, 'C-93', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(96, 'C-94', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(97, 'C-95', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(98, 'C-96', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(99, 'C-97', 'Second Floor', NULL, NULL, 'Vacant'),
(100, 'C-98', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(101, 'C-99', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(102, 'C-100', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(103, 'C-101', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(104, 'C-102', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(105, 'C-103', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(106, 'C-104', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(107, 'C-105', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(108, 'C-106', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(109, 'C-107', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(110, 'C-108', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(111, 'C-109', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(112, 'C-110', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(113, 'C-111', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(114, 'C-112', 'Second Floor', '4,600.00', NULL, 'Vacant'),
(115, 'C-113', 'Second Floor', '4,600.00', NULL, 'Vacant'),
(116, 'C-114', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(117, 'C-115', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(118, 'C-116', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(119, 'C-117', 'Second Floor', '3,600.00', NULL, 'Vacant'),
(120, 'C-118A', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(121, 'C-118B', 'Second Floor', '1,920.00', NULL, 'Vacant'),
(122, 'C-119', 'Second Floor', '1,920.00', NULL, 'Vacant');

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

--
-- Dumping data for table `building_d`
--

INSERT INTO `building_d` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'D-01', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(2, 'D-02', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(3, 'D-03', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(4, 'D-04', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(5, 'D-05', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(6, 'D-06', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(7, 'D-07', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(8, 'D-08', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(9, 'D-09', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(10, 'D-10', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(11, 'D-11', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(12, 'D-12', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(13, 'D-13', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(14, 'D-14', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(15, 'D-15', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(16, 'D-16', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(17, 'D-17', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(18, 'D-18', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(19, 'D-19', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(20, 'D-20', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(21, 'D-21', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(22, 'D-22', 'Ground Floor', '2,475.00', NULL, 'Vacant'),
(23, 'D-23', 'Ground Floor', '2,565.00', NULL, 'Vacant'),
(24, 'D-24', 'Ground Floor', '2,565.00', NULL, 'Vacant'),
(25, 'D-25', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(26, 'D-26', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(27, 'D-27', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(28, 'D-28', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(29, 'D-29', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(30, 'D-30', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(31, 'D-31', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(32, 'D-32', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(33, 'D-33', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(34, 'D-34', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(35, 'D-35', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(36, 'D-36', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(37, 'D-37', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(38, 'D-38', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(39, 'D-39', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(40, 'D-40', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(41, 'D-41', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(42, 'D-42', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(43, 'D-43', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(44, 'D-44', 'Ground Floor', '4,200.00', NULL, 'Vacant'),
(45, 'D-45', 'Ground Floor', NULL, NULL, 'Vacant'),
(46, 'D-46', 'Ground Floor', NULL, NULL, 'Vacant');

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

--
-- Dumping data for table `building_e`
--

INSERT INTO `building_e` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'E-01', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(2, 'E-02', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(3, 'E-03', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(4, 'E-04', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(5, 'E-05', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(6, 'E-06', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(7, 'E-07', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(8, 'E-08', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(9, 'E-09', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(10, 'E-10', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(11, 'E-11', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(12, 'E-12', 'Ground Floor', '8,000.00', NULL, 'Vacant'),
(13, 'E-13', 'Ground Floor', '7,700.00', NULL, 'Vacant'),
(14, 'E-14', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(15, 'E-15', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(16, 'E-16', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(17, 'E-17', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(18, 'E-18', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(19, 'E-19', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(20, 'E-20', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(21, 'E-21', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(22, 'E-22', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(23, 'E-23', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(24, 'E-24', 'Ground Floor', '3,900.00', NULL, 'Vacant'),
(25, 'E-25', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(26, 'E-26', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(27, 'E-27', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(28, 'E-28', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(29, 'E-29', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(30, 'E-30', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(31, 'E-31', 'Ground Floor', '5,200.00', NULL, 'Vacant'),
(32, 'E-32', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(33, 'E-33', 'Ground Floor', '5,200.00', NULL, 'Vacant'),
(34, 'E-34', 'Ground Floor', '4,500.00', NULL, 'Vacant'),
(35, 'E-35', 'Ground Floor', '5,300.00', NULL, 'Vacant'),
(36, 'E-36', 'Ground Floor', '5,300.00', NULL, 'Vacant'),
(37, 'E-37', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(38, 'E-38', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(39, 'E-39', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(40, 'E-40', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(41, 'E-41', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(42, 'E-42', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(43, 'E-43', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(44, 'E-44', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(45, 'E-45', 'Second Floor', '800.00', NULL, 'Vacant'),
(46, 'E-46', 'Second Floor', '800.00', NULL, 'Vacant'),
(47, 'E-47', 'Second Floor', '800.00', NULL, 'Vacant'),
(48, 'E-48', 'Second Floor', '800.00', NULL, 'Vacant'),
(49, 'E-49', 'Second Floor', '800.00', NULL, 'Vacant'),
(50, 'E-50', 'Second Floor', '800.00', NULL, 'Vacant'),
(51, 'E-51', 'Second Floor', '800.00', NULL, 'Vacant'),
(52, 'E-52', 'Second Floor', '800.00', NULL, 'Vacant'),
(53, 'E-53', 'Second Floor', '800.00', NULL, 'Vacant'),
(54, 'E-54', 'Second Floor', '800.00', NULL, 'Vacant'),
(55, 'E-55', 'Second Floor', '800.00', NULL, 'Vacant'),
(56, 'E-56', 'Second Floor', '800.00', NULL, 'Vacant'),
(57, 'E-57', 'Second Floor', '800.00', NULL, 'Vacant'),
(58, 'E-58', 'Second Floor', '800.00', NULL, 'Vacant'),
(59, 'E-59', 'Second Floor', '800.00', NULL, 'Vacant'),
(60, 'E-60', 'Second Floor', '800.00', NULL, 'Vacant'),
(61, 'E-61', 'Second Floor', '800.00', NULL, 'Vacant'),
(62, 'E-62', 'Second Floor', '800.00', NULL, 'Vacant'),
(63, 'E-63', 'Second Floor', '800.00', NULL, 'Vacant'),
(64, 'E-64', 'Second Floor', '800.00', NULL, 'Vacant'),
(65, 'E-65', 'Second Floor', '800.00', NULL, 'Vacant'),
(66, 'E-66', 'Second Floor', '800.00', NULL, 'Vacant'),
(67, 'E-67', 'Second Floor', '800.00', NULL, 'Vacant'),
(68, 'E-68', 'Second Floor', '800.00', NULL, 'Vacant'),
(69, 'E-69', 'Second Floor', '800.00', NULL, 'Vacant'),
(70, 'E-70', 'Second Floor', '800.00', NULL, 'Vacant'),
(71, 'E-71', 'Second Floor', '800.00', NULL, 'Vacant'),
(72, 'E-72', 'Second Floor', '800.00', NULL, 'Vacant'),
(73, 'E-73', 'Second Floor', '800.00', NULL, 'Vacant'),
(74, 'E-74', 'Second Floor', '800.00', NULL, 'Vacant'),
(75, 'E-75', 'Second Floor', '800.00', NULL, 'Vacant'),
(76, 'E-76', 'Second Floor', '800.00', NULL, 'Vacant'),
(77, 'E-77', 'Second Floor', '800.00', NULL, 'Vacant'),
(78, 'E-78', 'Second Floor', '800.00', NULL, 'Vacant'),
(79, 'E-79', 'Second Floor', '800.00', NULL, 'Vacant'),
(80, 'E-80', 'Second Floor', '800.00', NULL, 'Vacant'),
(81, 'E-81', 'Second Floor', '800.00', NULL, 'Vacant'),
(82, 'E-82', 'Second Floor', '800.00', NULL, 'Vacant'),
(83, 'E-83', 'Second Floor', '800.00', NULL, 'Vacant'),
(84, 'E-84', 'Second Floor', '800.00', NULL, 'Vacant'),
(85, 'E-85', 'Second Floor', '800.00', NULL, 'Vacant'),
(86, 'E-86', 'Second Floor', '800.00', NULL, 'Vacant'),
(87, 'E-87', 'Second Floor', '800.00', NULL, 'Vacant'),
(88, 'E-88', 'Second Floor', '800.00', NULL, 'Vacant'),
(89, 'E-89', 'Second Floor', '800.00', NULL, 'Vacant'),
(90, 'E-90', 'Second Floor', '800.00', NULL, 'Vacant'),
(91, 'E-91', 'Second Floor', '800.00', NULL, 'Vacant'),
(92, 'E-92', 'Second Floor', '800.00', NULL, 'Vacant'),
(93, 'E-93', 'Second Floor', '800.00', NULL, 'Vacant'),
(94, 'E-94', 'Second Floor', '800.00', NULL, 'Vacant'),
(95, 'E-95', 'Second Floor', '800.00', NULL, 'Vacant'),
(96, 'E-96', 'Second Floor', '800.00', NULL, 'Vacant'),
(97, 'E-97', 'Second Floor', '800.00', NULL, 'Vacant'),
(98, 'E-98', 'Second Floor', '800.00', NULL, 'Vacant'),
(99, 'E-99', 'Second Floor', '800.00', NULL, 'Vacant'),
(100, 'E-100', 'Second Floor', '800.00', NULL, 'Vacant'),
(101, 'E-101', 'Second Floor', '800.00', NULL, 'Vacant'),
(102, 'E-102', 'Second Floor', '800.00', NULL, 'Vacant'),
(103, 'E-103', 'Second Floor', '800.00', NULL, 'Vacant'),
(104, 'E-104', 'Second Floor', '800.00', NULL, 'Vacant'),
(105, 'E-105', 'Second Floor', '800.00', NULL, 'Vacant'),
(106, 'E-106', 'Second Floor', '800.00', NULL, 'Vacant'),
(107, 'E-107', 'Second Floor', '800.00', NULL, 'Vacant'),
(108, 'E-108', 'Second Floor', '800.00', NULL, 'Vacant'),
(109, 'E-109', 'Second Floor', '800.00', NULL, 'Vacant'),
(110, 'E-110', 'Second Floor', '800.00', NULL, 'Vacant'),
(111, 'E-111', 'Second Floor', '800.00', NULL, 'Vacant'),
(112, 'E-112', 'Second Floor', '800.00', NULL, 'Vacant'),
(113, 'E-113', 'Second Floor', '800.00', NULL, 'Vacant'),
(114, 'E-114', 'Second Floor', '800.00', NULL, 'Vacant'),
(115, 'E-115', 'Second Floor', '800.00', NULL, 'Vacant'),
(116, 'E-116', 'Second Floor', '800.00', NULL, 'Vacant'),
(117, 'E-117', 'Second Floor', '800.00', NULL, 'Vacant'),
(118, 'E-118', 'Second Floor', '800.00', NULL, 'Vacant'),
(119, 'E-119', 'Second Floor', '800.00', NULL, 'Vacant'),
(120, 'E-120', 'Second Floor', '800.00', NULL, 'Vacant'),
(121, 'E-121', 'Second Floor', '800.00', NULL, 'Vacant'),
(122, 'E-122', 'Second Floor', '800.00', NULL, 'Vacant'),
(123, 'E-123', 'Second Floor', '800.00', NULL, 'Vacant'),
(124, 'E-124', 'Second Floor', '800.00', NULL, 'Vacant'),
(125, 'E-125', 'Second Floor', '800.00', NULL, 'Vacant'),
(126, 'E-126', 'Second Floor', '800.00', NULL, 'Vacant'),
(127, 'E-127', 'Second Floor', '800.00', NULL, 'Vacant'),
(128, 'E-128', 'Second Floor', '800.00', NULL, 'Vacant'),
(129, 'E-129', 'Second Floor', '800.00', NULL, 'Vacant'),
(130, 'E-130', 'Second Floor', '800.00', NULL, 'Vacant'),
(131, 'E-131', 'Second Floor', '800.00', NULL, 'Vacant'),
(132, 'E-132', 'Second Floor', '800.00', NULL, 'Vacant'),
(133, 'E-133', 'Second Floor', '800.00', NULL, 'Vacant'),
(134, 'E-134', 'Second Floor', '800.00', NULL, 'Vacant'),
(135, 'E-135', 'Second Floor', '800.00', NULL, 'Vacant'),
(136, 'E-136', 'Second Floor', '800.00', NULL, 'Vacant'),
(137, 'E-137', 'Second Floor', '800.00', NULL, 'Vacant'),
(138, 'E-138', 'Second Floor', '800.00', NULL, 'Vacant'),
(139, 'E-139', 'Second Floor', '800.00', NULL, 'Vacant'),
(140, 'E-140', 'Second Floor', '800.00', NULL, 'Vacant'),
(141, 'E-141', 'Second Floor', '800.00', NULL, 'Vacant'),
(142, 'E-142', 'Second Floor', '800.00', NULL, 'Vacant'),
(143, 'E-143', 'Second Floor', '800.00', NULL, 'Vacant'),
(144, 'E-144', 'Second Floor', '800.00', NULL, 'Vacant'),
(145, 'E-145', 'Second Floor', '800.00', NULL, 'Vacant'),
(146, 'E-146', 'Second Floor', '800.00', NULL, 'Vacant'),
(147, 'E-147', 'Second Floor', '800.00', NULL, 'Vacant'),
(148, 'E-148', 'Second Floor', '800.00', NULL, 'Vacant'),
(149, 'E-149', 'Second Floor', '800.00', NULL, 'Vacant'),
(150, 'E-150', 'Second Floor', '800.00', NULL, 'Vacant'),
(151, 'E-151', 'Second Floor', '800.00', NULL, 'Vacant'),
(152, 'E-152', 'Second Floor', '800.00', NULL, 'Vacant'),
(153, 'E-153', 'Second Floor', '800.00', NULL, 'Vacant'),
(154, 'E-154', 'Second Floor', '800.00', NULL, 'Vacant'),
(155, 'E-155', 'Second Floor', '800.00', NULL, 'Vacant'),
(156, 'E-156', 'Second Floor', '800.00', NULL, 'Vacant'),
(157, 'E-157', 'Second Floor', '800.00', NULL, 'Vacant'),
(158, 'E-158', 'Second Floor', '800.00', NULL, 'Vacant'),
(159, 'E-159', 'Second Floor', '800.00', NULL, 'Vacant'),
(160, 'E-160', 'Second Floor', '800.00', NULL, 'Vacant'),
(161, 'E-161', 'Second Floor', '800.00', NULL, 'Vacant'),
(162, 'E-162', 'Second Floor', '800.00', NULL, 'Vacant'),
(163, 'E-163', 'Second Floor', '800.00', NULL, 'Vacant'),
(164, 'E-164', 'Second Floor', '800.00', NULL, 'Vacant'),
(165, 'E-165', 'Second Floor', '800.00', NULL, 'Vacant'),
(166, 'E-166', 'Second Floor', '800.00', NULL, 'Vacant'),
(167, 'E-167', 'Second Floor', '800.00', NULL, 'Vacant'),
(168, 'E-168', 'Second Floor', '800.00', NULL, 'Vacant'),
(169, 'E-169', 'Second Floor', '800.00', NULL, 'Vacant');

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

--
-- Dumping data for table `building_f`
--

INSERT INTO `building_f` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'F-1', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(2, 'F-2', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(3, 'F-3', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(4, 'F-4', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(5, 'F-5', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(6, 'F-6', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(7, 'F-7', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(8, 'F-8', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(9, 'F-9', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(10, 'F-10', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(11, 'F-11', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(12, 'F-12', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(13, 'F-13', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(14, 'F-14', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(15, 'F-15', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(16, 'F-16', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(17, 'F-17', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(18, 'F-18', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(19, 'F-19', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(20, 'F-20', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(21, 'F-21', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(22, 'F-22', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(23, 'F-23', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(24, 'F-24', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(25, 'F-25', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(26, 'F-26', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(27, 'F-27', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(28, 'F-28', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(29, 'F-29', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(30, 'F-30', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(31, 'F-31', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(32, 'F-32', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(33, 'F-33', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(34, 'F-34', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(35, 'F-35', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(36, 'F-36', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(37, 'F-37', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(38, 'F-38', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(39, 'F-39', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(40, 'F-40', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(41, 'F-41', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(42, 'F-42', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(43, 'F-43', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(44, 'F-44', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(45, 'F-45', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(46, 'F-46', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(47, 'F-47', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(48, 'F-48', 'Ground Floor', '2,200.00', NULL, 'Vacant'),
(49, 'F-49', 'Ground Floor', '2,250.00', NULL, 'Vacant'),
(50, 'F-50', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(51, 'F-51', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(52, 'F-52', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(53, 'F-53', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(54, 'F-54', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(55, 'F-55', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(56, 'F-56', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(57, 'F-57', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(58, 'F-58', 'Ground Floor', '2,250.00', NULL, 'Vacant');

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

--
-- Dumping data for table `building_g`
--

INSERT INTO `building_g` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'G-01', 'Ground Floor', '950.00', NULL, 'Vacant'),
(2, 'G-02', 'Ground Floor', '950.00', NULL, 'Vacant'),
(3, 'G-03', 'Ground Floor', '950.00', NULL, 'Vacant'),
(4, 'G-04', 'Ground Floor', '950.00', NULL, 'Vacant'),
(5, 'G-05', 'Ground Floor', '950.00', NULL, 'Vacant'),
(6, 'G-06', 'Ground Floor', '950.00', NULL, 'Vacant'),
(7, 'G-07', 'Ground Floor', '950.00', NULL, 'Vacant'),
(8, 'G-08', 'Ground Floor', '950.00', NULL, 'Vacant'),
(9, 'G-09', 'Ground Floor', '950.00', NULL, 'Vacant'),
(10, 'G-10', 'Ground Floor', '950.00', NULL, 'Vacant'),
(11, 'G-11', 'Ground Floor', '950.00', NULL, 'Vacant'),
(12, 'G-12', 'Ground Floor', '950.00', NULL, 'Vacant'),
(13, 'G-13', 'Ground Floor', '950.00', NULL, 'Vacant'),
(14, 'G-14', 'Ground Floor', '950.00', NULL, 'Vacant'),
(15, 'G-15', 'Ground Floor', '950.00', NULL, 'Vacant'),
(16, 'G-16', 'Ground Floor', '950.00', NULL, 'Vacant'),
(17, 'G-17', 'Ground Floor', '950.00', NULL, 'Vacant'),
(18, 'G-18', 'Ground Floor', '950.00', NULL, 'Vacant'),
(19, 'G-19', 'Ground Floor', '950.00', NULL, 'Vacant'),
(20, 'G-20', 'Ground Floor', '950.00', NULL, 'Vacant'),
(21, 'G-21', 'Ground Floor', '950.00', NULL, 'Vacant'),
(22, 'G-22', 'Ground Floor', '950.00', NULL, 'Vacant'),
(23, 'G-23', 'Ground Floor', '950.00', NULL, 'Vacant'),
(24, 'G-24', 'Ground Floor', '950.00', NULL, 'Vacant'),
(25, 'G-25', 'Ground Floor', '950.00', NULL, 'Vacant'),
(26, 'G-26', 'Ground Floor', '950.00', NULL, 'Vacant'),
(27, 'G-27', 'Ground Floor', '950.00', NULL, 'Vacant'),
(28, 'G-28', 'Ground Floor', '950.00', NULL, 'Vacant'),
(29, 'G-29', 'Ground Floor', '950.00', NULL, 'Vacant'),
(30, 'G-30', 'Ground Floor', '950.00', NULL, 'Vacant'),
(31, 'G-31', 'Ground Floor', '950.00', NULL, 'Vacant'),
(32, 'G-32', 'Ground Floor', '950.00', NULL, 'Vacant'),
(33, 'G-33', 'Ground Floor', '950.00', NULL, 'Vacant'),
(34, 'G-34', 'Ground Floor', '950.00', NULL, 'Vacant'),
(35, 'G-35', 'Ground Floor', '950.00', NULL, 'Vacant'),
(36, 'G-36', 'Ground Floor', '950.00', NULL, 'Vacant'),
(37, 'G-37', 'Ground Floor', '950.00', NULL, 'Vacant'),
(38, 'G-38', 'Ground Floor', '950.00', NULL, 'Vacant'),
(39, 'G-39', 'Ground Floor', '950.00', NULL, 'Vacant'),
(40, 'G-41', 'Ground Floor', '950.00', NULL, 'Vacant'),
(41, 'G-42', 'Ground Floor', '950.00', NULL, 'Vacant'),
(42, 'G-43', 'Ground Floor', '950.00', NULL, 'Vacant'),
(43, 'G-44', 'Ground Floor', '950.00', NULL, 'Vacant'),
(44, 'G-45', 'Ground Floor', '950.00', NULL, 'Vacant'),
(45, 'G-46', 'Ground Floor', '950.00', NULL, 'Vacant'),
(46, 'G-47', 'Ground Floor', '950.00', NULL, 'Vacant'),
(47, 'G-48', 'Ground Floor', '950.00', NULL, 'Vacant'),
(48, 'G-49', 'Ground Floor', '950.00', NULL, 'Vacant'),
(49, 'G-50', 'Ground Floor', '950.00', NULL, 'Vacant'),
(50, 'G-51', 'Ground Floor', '950.00', NULL, 'Vacant'),
(51, 'G-52', 'Ground Floor', '950.00', NULL, 'Vacant'),
(52, 'G-53', 'Ground Floor', '950.00', NULL, 'Vacant'),
(53, 'G-54', 'Ground Floor', '950.00', NULL, 'Vacant'),
(54, 'G-55', 'Ground Floor', '950.00', NULL, 'Vacant'),
(55, 'G-56', 'Ground Floor', '950.00', NULL, 'Vacant'),
(56, 'G-57', 'Ground Floor', '950.00', NULL, 'Vacant'),
(57, 'G-58', 'Ground Floor', '950.00', NULL, 'Vacant'),
(58, 'G-59', 'Ground Floor', '950.00', NULL, 'Vacant'),
(59, 'G-60', 'Ground Floor', '950.00', NULL, 'Vacant'),
(60, 'G-61', 'Ground Floor', '950.00', NULL, 'Vacant'),
(61, 'G-62', 'Ground Floor', '950.00', NULL, 'Vacant'),
(62, 'G-63', 'Ground Floor', '950.00', NULL, 'Vacant'),
(63, 'G-64', 'Ground Floor', '950.00', NULL, 'Vacant'),
(64, 'G-65', 'Ground Floor', '950.00', NULL, 'Vacant'),
(65, 'G-66', 'Ground Floor', '950.00', NULL, 'Vacant'),
(66, 'G-67', 'Ground Floor', '950.00', NULL, 'Vacant'),
(67, 'G-68', 'Ground Floor', '950.00', NULL, 'Vacant'),
(68, 'G-69', 'Ground Floor', '950.00', NULL, 'Vacant'),
(69, 'G-70', 'Ground Floor', '950.00', NULL, 'Vacant'),
(70, 'G-72', 'Ground Floor', '950.00', NULL, 'Vacant'),
(71, 'G-73', 'Ground Floor', '950.00', NULL, 'Vacant'),
(72, 'G-74', 'Ground Floor', '950.00', NULL, 'Vacant'),
(73, 'G-75', 'Ground Floor', '950.00', NULL, 'Vacant'),
(74, 'G-76', 'Ground Floor', '950.00', NULL, 'Vacant'),
(75, 'G-77', 'Ground Floor', '950.00', NULL, 'Vacant'),
(76, 'G-78', 'Ground Floor', '950.00', NULL, 'Vacant'),
(77, 'G-79', 'Ground Floor', '950.00', NULL, 'Vacant'),
(78, 'G-80', 'Ground Floor', '950.00', NULL, 'Vacant'),
(79, 'G-81', 'Ground Floor', '950.00', NULL, 'Vacant'),
(80, 'G-82', 'Ground Floor', '950.00', NULL, 'Vacant'),
(81, 'G-83', 'Ground Floor', '950.00', NULL, 'Vacant'),
(82, 'G-84', 'Ground Floor', '950.00', NULL, 'Vacant'),
(83, 'G-85', 'Ground Floor', '950.00', NULL, 'Vacant'),
(84, 'G-86', 'Ground Floor', '950.00', NULL, 'Vacant'),
(85, 'G-87', 'Ground Floor', '950.00', NULL, 'Vacant'),
(86, 'G-89', 'Ground Floor', '950.00', NULL, 'Vacant'),
(87, 'G-90', 'Ground Floor', '950.00', NULL, 'Vacant'),
(88, 'G-91', 'Ground Floor', '950.00', NULL, 'Vacant'),
(89, 'G-92', 'Ground Floor', '950.00', NULL, 'Vacant'),
(90, 'G-93', 'Ground Floor', '950.00', NULL, 'Vacant'),
(91, 'G-94', 'Ground Floor', '950.00', NULL, 'Vacant'),
(92, 'G-95', 'Ground Floor', '950.00', NULL, 'Vacant'),
(93, 'G-96', 'Ground Floor', '950.00', NULL, 'Vacant'),
(94, 'G-97', 'Ground Floor', '950.00', NULL, 'Vacant'),
(95, 'G-98', 'Ground Floor', '950.00', NULL, 'Vacant'),
(96, 'G-99', 'Ground Floor', '950.00', NULL, 'Vacant'),
(97, 'G-100', 'Ground Floor', '950.00', NULL, 'Vacant'),
(98, 'G-101', 'Ground Floor', '950.00', NULL, 'Vacant'),
(99, 'G-102', 'Ground Floor', '950.00', NULL, 'Vacant'),
(100, 'G-103', 'Ground Floor', '950.00', NULL, 'Vacant'),
(101, 'G-104', 'Ground Floor', '950.00', NULL, 'Vacant'),
(102, 'G-105', 'Ground Floor', '950.00', NULL, 'Vacant'),
(103, 'G-106', 'Ground Floor', '950.00', NULL, 'Vacant'),
(104, 'G-107', 'Ground Floor', '950.00', NULL, 'Vacant'),
(105, 'G-108', 'Ground Floor', '950.00', NULL, 'Vacant'),
(106, 'G-109', 'Ground Floor', '950.00', NULL, 'Vacant'),
(107, 'G-110', 'Ground Floor', '950.00', NULL, 'Vacant'),
(108, 'G-111', 'Ground Floor', '950.00', NULL, 'Vacant'),
(109, 'G-112', 'Ground Floor', '950.00', NULL, 'Vacant'),
(110, 'G-113', 'Ground Floor', '950.00', NULL, 'Vacant'),
(111, 'G-114', 'Ground Floor', '950.00', NULL, 'Vacant'),
(112, 'G-115', 'Ground Floor', '950.00', NULL, 'Vacant'),
(113, 'G-116', 'Ground Floor', '950.00', NULL, 'Vacant'),
(114, 'G-117', 'Ground Floor', '950.00', NULL, 'Vacant'),
(115, 'G-118', 'Ground Floor', '950.00', NULL, 'Vacant'),
(116, 'G-119', 'Ground Floor', '2,000.00', NULL, 'Vacant'),
(117, 'G-120', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(118, 'G-121', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(119, 'G-122', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(120, 'G-123', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(121, 'G-124', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(122, 'G-125', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(123, 'G-126', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(124, 'G-127', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(125, 'G-128', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(126, 'G-129', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(127, 'G-130', 'Ground Floor', '2,000.00', NULL, 'Vacant'),
(128, 'G-131', 'Ground Floor', '2,000.00', NULL, 'Vacant'),
(129, 'G-132', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(130, 'G-133', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(131, 'G-134', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(132, 'G-135', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(133, 'G-136', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(134, 'G-137', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(135, 'G-138', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(136, 'G-139', 'Ground Floor', '1,750.00', NULL, 'Vacant'),
(137, 'G-140', 'Ground Floor', '2,000.00', NULL, 'Vacant'),
(138, 'G-141', 'Ground Floor', '2,000.00', NULL, 'Vacant');

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

--
-- Dumping data for table `building_h`
--

INSERT INTO `building_h` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'H-1', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(2, 'H-2', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(3, 'H-3', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(4, 'H-4', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(5, 'H-5', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(6, 'H-6', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(7, 'H-7', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(8, 'H-8', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(9, 'H-9', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(10, 'H-10', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(11, 'H-11', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(12, 'H-12', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(13, 'H-13', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(14, 'H-14', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(15, 'H-15', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(16, 'H-16', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(17, 'H-17', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(18, 'H-18', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(19, 'H-19', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(20, 'H-20', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(21, 'H-21', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(22, 'H-22', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(23, 'H-23', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(24, 'H-24', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(25, 'H-25', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(26, 'H-26', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(27, 'H-27', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(28, 'H-28', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(29, 'H-29', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(30, 'H-30', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(31, 'H-31', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(32, 'H-32', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(33, 'H-33', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(34, 'H-34', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(35, 'H-35', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(36, 'H-36', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(37, 'H-37', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(38, 'H-38', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(39, 'H-39', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(40, 'H-40', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(41, 'H-41', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(42, 'H-42', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(43, 'H-43', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(44, 'H-44', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(45, 'H-45', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(46, 'H-46', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(47, 'H-47', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(48, 'H-48', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(49, 'H-49', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(50, 'H-50', 'Ground Floor', '1,200.00', NULL, 'Vacant'),
(51, 'H-51', 'Ground Floor', '2,180.00', NULL, 'Vacant'),
(52, 'H-52', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(53, 'H-53', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(54, 'H-54', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(55, 'H-55', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(56, 'H-56', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(57, 'H-57', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(58, 'H-58', 'Ground Floor', '2,180.00', NULL, 'Vacant'),
(59, 'H-59', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(60, 'H-60', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(61, 'H-61', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(62, 'H-62', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(63, 'H-63', 'Ground Floor', '1,950.00', NULL, 'Vacant'),
(64, 'H-64', 'Ground Floor', '2,180.00', NULL, 'Vacant'),
(65, 'H-65', 'Ground Floor', '2,220.00', NULL, 'Vacant'),
(66, 'H-66', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(67, 'H-67', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(68, 'H-68', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(69, 'H-69', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(70, 'H-70', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(71, 'H-71', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(72, 'H-72', 'Ground Floor', '2,340.00', NULL, 'Vacant'),
(73, 'H-73', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(74, 'H-74', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(75, 'H-75', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(76, 'H-76', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(77, 'H-77', 'Ground Floor', '2,060.00', NULL, 'Vacant'),
(78, 'H-78', 'Ground Floor', '2,220.00', NULL, 'Vacant');

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

--
-- Dumping data for table `building_i`
--

INSERT INTO `building_i` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'I-01', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(2, 'I-02', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(3, 'I-03', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(4, 'I-04', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(5, 'I-05', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(6, 'I-06', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(7, 'I-07', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(8, 'I-08', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(9, 'I-09', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(10, 'I-10', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(11, 'I-11', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(12, 'I-12', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(13, 'I-13', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(14, 'I-14', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(15, 'I-15', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(16, 'I-16', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(17, 'I-17', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(18, 'I-18', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(19, 'I-19', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(20, 'I-20', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(21, 'I-21', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(22, 'I-22', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(23, 'I-23', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(24, 'I-24', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(25, 'I-25', 'Ground Floor', '1,660.00', NULL, 'Vacant'),
(26, 'I-26', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(27, 'I-27', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(28, 'I-28', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(29, 'I-29', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(30, 'I-30', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(31, 'I-31', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(32, 'I-32', 'Ground Floor', '1,630.00', NULL, 'Vacant'),
(33, 'I-33', 'Ground Floor', '1,670.00', NULL, 'Vacant'),
(34, 'I-34', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(35, 'I-35', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(36, 'I-36', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(37, 'I-37', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(38, 'I-38', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(39, 'I-39', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(40, 'I-40', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(41, 'I-41', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(42, 'I-42', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(43, 'I-43', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(44, 'I-44', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(45, 'I-45', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(46, 'I-46', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(47, 'I-47', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(48, 'I-48', 'Ground Floor', '1,670.00', NULL, 'Vacant'),
(49, 'I-49', 'Ground Floor', '1,670.00', NULL, 'Vacant'),
(50, 'I-50', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(51, 'I-51', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(52, 'I-52', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(53, 'I-53', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(54, 'I-54', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(55, 'I-55', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(56, 'I-56', 'Ground Floor', '1,650.00', NULL, 'Vacant'),
(57, 'I-57', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(58, 'I-58', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(59, 'I-59', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(60, 'I-60', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(61, 'I-61', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(62, 'I-62', 'Ground Floor', '1,665.00', NULL, 'Vacant'),
(63, 'I-63', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(64, 'I-64', 'Ground Floor', '1,730.00', NULL, 'Vacant'),
(65, 'I-65', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(66, 'I-66', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(67, 'I-67', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(68, 'I-68', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(69, 'I-69', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(70, 'I-70', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(71, 'I-71', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(72, 'I-72', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(73, 'I-73', 'Ground Floor', '1,600.00', NULL, 'Vacant'),
(74, 'I-74', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(75, 'I-75', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(76, 'I-76', 'Ground Floor', '1,580.00', NULL, 'Vacant'),
(77, 'I-77', 'Ground Floor', '1,580.00', NULL, 'Vacant'),
(78, 'I-78', 'Ground Floor', '1,640.00', NULL, 'Vacant'),
(79, 'I-79', 'Ground Floor', '1,700.00', NULL, 'Vacant'),
(80, 'I-80', 'Ground Floor', '1,640.00', NULL, 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `building_j`
--

CREATE TABLE `building_j` (
  `building_id` int(11) NOT NULL,
  `stall_no` varchar(50) DEFAULT NULL,
  `building_floor` enum('Ground Floor','Second Floor','Third Floor','') DEFAULT NULL,
  `monthly_rentals` varchar(100) DEFAULT NULL,
  `vendor_id` bigint(20) DEFAULT NULL,
  `stall_status` enum('Occupied','Vacant') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `building_j`
--

INSERT INTO `building_j` (`building_id`, `stall_no`, `building_floor`, `monthly_rentals`, `vendor_id`, `stall_status`) VALUES
(1, 'J-01', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(2, 'J-02', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(3, 'J-03', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(4, 'J-04', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(5, 'J-05', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(6, 'J-06', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(7, 'J-07', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(8, 'J-08', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(9, 'J-09', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(10, 'J-10', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(11, 'J-11', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(12, 'J-12', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(13, 'J-13', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(14, 'J-14', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(15, 'J-15', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(16, 'J-16', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(17, 'J-17', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(18, 'J-18', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(19, 'J-19', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(20, 'J-20', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(21, 'J-21', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(22, 'J-22', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(23, 'J-23', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(24, 'J-24', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(25, 'J-25', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(26, 'J-26', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(27, 'J-27', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(28, 'J-28', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(29, 'J-29', 'Ground Floor', NULL, NULL, 'Vacant'),
(30, 'J-30', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(31, 'J-31', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(32, 'J-32', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(33, 'J-33', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(34, 'J-34', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(35, 'J-35', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(36, 'J-36', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(37, 'J-37', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(38, 'J-38', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(39, 'J-39', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(40, 'J-40', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(41, 'J-41', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(42, 'J-42', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(43, 'J-43', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(44, 'J-44', 'Ground Floor', '5,400.00', NULL, 'Vacant'),
(45, 'J-45', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(46, 'J-46', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(47, 'J-47', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(48, 'J-48', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(49, 'J-49', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(50, 'J-50', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(51, 'J-51', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(52, 'J-52', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(53, 'J-53', 'Second Floor', '2,000.00', NULL, 'Vacant'),
(54, 'J-54', 'Second Floor', '2,000.00', NULL, 'Vacant'),
(55, 'J-55', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(56, 'J-56', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(57, 'J-57', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(58, 'J-58', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(59, 'J-59', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(60, 'J-60', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(61, 'J-61', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(62, 'J-62', 'Second Floor', '1,600.00', NULL, 'Vacant'),
(63, 'J-63', 'Second Floor', '700.00', NULL, 'Vacant'),
(64, 'J-64', 'Second Floor', '700.00', NULL, 'Vacant'),
(65, 'J-65', 'Third Floor', '700.00', NULL, 'Vacant'),
(66, 'J-66', 'Second Floor', '700.00', NULL, 'Vacant'),
(67, 'J-67', 'Second Floor', '700.00', NULL, 'Vacant'),
(68, 'J-68', 'Second Floor', '700.00', NULL, 'Vacant'),
(69, 'J-69', 'Second Floor', '700.00', NULL, 'Vacant'),
(70, 'J-70', 'Second Floor', '700.00', NULL, 'Vacant'),
(71, 'J-71', 'Second Floor', '700.00', NULL, 'Vacant'),
(72, 'J-72', 'Second Floor', '700.00', NULL, 'Vacant'),
(73, 'J-73', 'Second Floor', '700.00', NULL, 'Vacant'),
(74, 'J-74', 'Second Floor', '700.00', NULL, 'Vacant'),
(75, 'J-75', 'Second Floor', '700.00', NULL, 'Vacant'),
(76, 'J-76', 'Second Floor', '700.00', NULL, 'Vacant'),
(77, 'J-77', 'Second Floor', '700.00', NULL, 'Vacant'),
(78, 'J-78', 'Second Floor', '700.00', NULL, 'Vacant'),
(79, 'J-79', 'Second Floor', '700.00', NULL, 'Vacant'),
(80, 'J-80', 'Second Floor', '700.00', NULL, 'Vacant'),
(81, 'J-81', 'Second Floor', '700.00', NULL, 'Vacant'),
(82, 'J-82', 'Second Floor', '700.00', NULL, 'Vacant'),
(83, 'J-83', 'Second Floor', '700.00', NULL, 'Vacant'),
(84, 'J-84', 'Second Floor', '700.00', NULL, 'Vacant'),
(85, 'J-85', 'Second Floor', '700.00', NULL, 'Vacant'),
(86, 'J-86', 'Second Floor', '700.00', NULL, 'Vacant'),
(87, 'J-87', 'Second Floor', '700.00', NULL, 'Vacant'),
(88, 'J-88', 'Second Floor', '700.00', NULL, 'Vacant'),
(89, 'J-89', 'Second Floor', '700.00', NULL, 'Vacant'),
(90, 'J-90', 'Second Floor', '700.00', NULL, 'Vacant'),
(91, 'J-91', 'Second Floor', '700.00', NULL, 'Vacant'),
(92, 'J-92', 'Second Floor', '700.00', NULL, 'Vacant'),
(93, 'J-93', 'Second Floor', '700.00', NULL, 'Vacant'),
(94, 'J-94', 'Second Floor', '700.00', NULL, 'Vacant'),
(95, 'J-95', 'Second Floor', '700.00', NULL, 'Vacant'),
(96, 'J-96', 'Second Floor', '700.00', NULL, 'Vacant'),
(97, 'J-97', 'Second Floor', '700.00', NULL, 'Vacant'),
(98, 'J-98', 'Second Floor', '700.00', NULL, 'Vacant'),
(99, 'J-99', 'Second Floor', '700.00', NULL, 'Vacant'),
(100, 'J-100', 'Second Floor', '700.00', NULL, 'Vacant'),
(101, 'J-101', 'Second Floor', '700.00', NULL, 'Vacant'),
(102, 'J-102', 'Second Floor', '700.00', NULL, 'Vacant'),
(103, 'J-103', 'Second Floor', '700.00', NULL, 'Vacant'),
(104, 'J-104', 'Second Floor', '700.00', NULL, 'Vacant'),
(105, 'J-105', 'Second Floor', '700.00', NULL, 'Vacant'),
(106, 'J-106', 'Second Floor', '700.00', NULL, 'Vacant'),
(107, 'J-107', 'Third Floor', '700.00', NULL, 'Vacant'),
(108, 'J-108', 'Second Floor', '700.00', NULL, 'Vacant'),
(109, 'J-109', 'Second Floor', '700.00', NULL, 'Vacant'),
(110, 'J-110', 'Second Floor', '700.00', NULL, 'Vacant'),
(111, 'J-111', 'Second Floor', '700.00', NULL, 'Vacant'),
(112, 'J-112', 'Second Floor', '700.00', NULL, 'Vacant'),
(113, 'J-113', 'Second Floor', '700.00', NULL, 'Vacant'),
(114, 'J-114', 'Second Floor', '700.00', NULL, 'Vacant'),
(115, 'J-115', 'Second Floor', '700.00', NULL, 'Vacant'),
(116, 'J-116', 'Second Floor', '700.00', NULL, 'Vacant');

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
(18, 'pj', 'pj@gmail.com', 'Stall inquiry', 'available pa stalls?', '2024-07-28 22:30:44'),
(20, 'cray', 'cray@gmail.com', 'Inquiries', 'available pa stalls?', '2024-07-28 22:31:51'),
(22, 'Jaime Kabulan', 'jaime@gmail.com', 'cooperator', 'rental Occupations', '2024-07-29 03:46:42'),
(23, 'John Kranzinsky', 'john@gmail.com', 'Owning Stalls', 'I want to own stalls can you contact me?', '2024-07-29 03:47:36'),
(24, 'kimberly Ayugyugon', 'kim@gmail.com', 'Vendors Approval', 'Sending Approvals', '2024-07-29 03:48:29'),
(25, 'Teresa Saragosa', 'teresa@gmail.com', 'Transfer', 'Pwede mag transfer stalls?', '2024-07-29 03:49:29'),
(26, 'Saybil Pudadera', 'saybil@gmail.com', 'List of Permits', 'Unsay mga permits kaylangan ani?', '2024-07-29 03:50:39'),
(27, 'Jhay Mark Tubig', 'Jhay@gmail.com', 'Cost of relocation', 'Naka bayad nako sa relocation.', '2024-07-29 03:52:07'),
(29, 'Cryzzy Uy', 'Uy@gmail.com', 'Karnehan', 'Available pa pwesto sa karnehan?', '2024-07-29 03:54:23');

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
  `receipt_id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `receipt` blob DEFAULT NULL,
  `issued_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 57, 'pwede change stalls?', '2024-08-31 09:11:55', 'Declined'),
(11, 57, 'naa pay pwesto?', '2024-07-29 00:41:23', 'Processing'),
(12, 61, 'request relocation', '2024-07-29 08:27:32', 'Processing'),
(13, 55, 'pa transfer po.', '2024-08-18 13:29:34', 'Processing');

-- --------------------------------------------------------

--
-- Table structure for table `rentapp_payment`
--

CREATE TABLE `rentapp_payment` (
  `rentpayment_id` int(11) NOT NULL,
  `OR_no` varchar(50) NOT NULL,
  `proof_of_payment` text DEFAULT NULL,
  `applicant_id` int(11) NOT NULL,
  `payment_status` enum('Unpaid','Paid') DEFAULT 'Unpaid',
  `verify_status` enum('Unconfirmed','Verified') DEFAULT 'Unconfirmed',
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentapp_payment`
--

INSERT INTO `rentapp_payment` (`rentpayment_id`, `OR_no`, `proof_of_payment`, `applicant_id`, `payment_status`, `verify_status`, `payment_date`) VALUES
(17, '786556t', 'payment_proofs/rent_application/434407561_318504671251414_8738135139194585822_n.jpg', 2028, 'Paid', 'Verified', '2024-07-27 23:25:49'),
(19, '203084858', 'payment_proofs/rent_application/gcash.jpeg', 2030, 'Paid', 'Unconfirmed', '2024-07-29 00:32:13'),
(20, '3252236546', 'payment_proofs/rent_application/gcash.jpeg', 2031, 'Paid', 'Verified', '2024-07-29 00:34:44'),
(21, '9y7534hyf5378', 'payment_proofs/rent_application/gcash.jpeg', 2032, 'Paid', 'Unconfirmed', '2024-07-29 05:20:02'),
(23, '2343e23rwe32wedw', 'payment_proofs/rent_application/gcash.jpeg', 2033, 'Paid', 'Verified', '2024-07-29 08:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `rent_application`
--

CREATE TABLE `rent_application` (
  `Approval` enum('APPROVED','DECLINED','PROCESSING','PENDING') NOT NULL DEFAULT 'PROCESSING',
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
('APPROVED', 2028, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 9510462062, 'Building A', 20, 56, 'reyanjansamontanes@gmail.com', 'Polotana Subdivision, West Drive.', 'rent_applications_file_dir/samontanes.pdf', '2024-09-01 01:41:32'),
('PENDING', 2030, 'May', 'Bel', 'Beleigne', 94536723456, 'Building A', 78, 56, 'may@gmail.com', 'Gensan', 'rent_applications_file_dir/samontanes.pdf', '2024-09-01 10:44:59'),
('PENDING', 2031, 'Duke', 'B', 'Shelby', 934793849, 'Building E', 87, 45, 'duke@gmail.com', 'Bermingham', 'rent_applications_file_dir/Building-A-2nd-Floor.pdf', '2024-07-29 00:39:22'),
('PROCESSING', 2032, 'Ivy ', 'Grace ', 'Laurente', 9510462062, 'Building A', 89, 45, 'ivy@gmail.com', 'Cannery Site', 'rent_applications_file_dir/rentAppMeedo.pdf', '2024-07-29 05:18:46'),
('APPROVED', 2033, 'REYAN JAN', 'BARRANCO', 'SAMONTANES', 9510462062, 'Building A', 20, 54, 'reyanjansamontanes@gmail.com', 'Polotana Subdivision, West Drive.', 'rent_applications_file_dir/5974879027155300046-Polomolok-Public-Market-Rent-Application-Form.pdf', '2024-07-29 08:13:10');

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
  `user_type` enum('ADMIN','STAFF') NOT NULL,
  `picture_profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `user_type`, `picture_profile`) VALUES
(11, 'rj', 'rj', 'reyan', 'jan', 'samontanes', 43, 'polomolok', 'gmail.com', 3233252, 'ADMIN', 'adminProfile/IMG20220417102318.jpg'),
(28, 'June', 'june123', 'June', 'vene', 'veneracion', 38, 'Polotana Subdivision, West Drive.', 'ggmeil@gmail.com', 9510462062, 'STAFF', NULL),
(30, 'adminMeedo', '123', 'MEEDO', 'MEEDO', 'MEEDO', 43, 'Polotana Subdivision, West Drive.', '@gmail.com', NULL, 'ADMIN', 'adminProfile/download.jfif');

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
  `contact_no` varchar(20) DEFAULT NULL,
  `started_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`Vendor Status`, `vendor_id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `age`, `address`, `email_add`, `contact_no`, `started_date`, `end_date`) VALUES
('INACTIVE', 55, 'jp', '21jp', 'John', 'P', 'Paras', 38, 'Poblacion, Polomolok', 'jp@gmail.com', '+639510462062', '2024-07-28', '2024-08-08'),
('INACTIVE', 56, 'james', 'james321', 'James', 'T', 'Kauray', 54, 'Cannery Site', NULL, '+639945817565', '2024-07-28', '2025-01-08'),
('INACTIVE', 57, 'meedo', '21meedo', 'John', 'De', 'Baptist', NULL, NULL, NULL, NULL, '2024-07-28', '2024-10-15'),
('INACTIVE', 58, 'cre', '21cre', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-28', '2024-11-07'),
('INACTIVE', 59, 'King', 'pj123', '', NULL, NULL, NULL, NULL, NULL, NULL, '2023-12-21', '2024-11-07'),
('INACTIVE', 60, 'mads', 'mads123', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29', '2024-07-29'),
('INACTIVE', 61, 'vendors', 'vendor123', '', NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-24', '2023-10-13'),
('INACTIVE', 62, 'June', 'june123', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-29', '2024-08-29'),
('INACTIVE', 64, 'polcapts', '9504', '', NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-10', '2024-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `vendorsoa`
--

CREATE TABLE `vendorsoa` (
  `id` int(11) NOT NULL,
  `vendor_id` bigint(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `remaining_balance` varchar(255) NOT NULL,
  `monthly_rentals` varchar(255) NOT NULL,
  `miscellaneous_fees` varchar(255) NOT NULL,
  `other_fees` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendorsoa`
--

INSERT INTO `vendorsoa` (`id`, `vendor_id`, `username`, `remaining_balance`, `monthly_rentals`, `miscellaneous_fees`, `other_fees`, `total_amount`, `date`, `file_path`) VALUES
(5, 55, 'jp', '1566', '3060', '700', '666', '5992', '2024-09-01', 'invoice/invoice_jp.pdf'),
(6, 56, 'james', '4500', '5400', '0', '0', '9900', '2024-09-01', 'invoice/invoice_james_2024-09-01.pdf'),
(7, 57, 'meedo', '5400', '5400', '0', '0', '10800', '2024-09-01', 'invoice/invoice_meedo_2024-09-01.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `relocation_req`
--
ALTER TABLE `relocation_req`
  ADD PRIMARY KEY (`relocation_id`);

--
-- Indexes for table `rentapp_payment`
--
ALTER TABLE `rentapp_payment`
  ADD PRIMARY KEY (`rentpayment_id`),
  ADD KEY `fk_applicant_id` (`applicant_id`);

--
-- Indexes for table `rent_application`
--
ALTER TABLE `rent_application`
  ADD PRIMARY KEY (`applicant_id`),
  ADD KEY `applicant_id` (`applicant_id`);

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
-- Indexes for table `vendorsoa`
--
ALTER TABLE `vendorsoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `building_d`
--
ALTER TABLE `building_d`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `building_e`
--
ALTER TABLE `building_e`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `building_f`
--
ALTER TABLE `building_f`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `building_g`
--
ALTER TABLE `building_g`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `building_h`
--
ALTER TABLE `building_h`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `building_i`
--
ALTER TABLE `building_i`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `building_j`
--
ALTER TABLE `building_j`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
-- AUTO_INCREMENT for table `relocation_req`
--
ALTER TABLE `relocation_req`
  MODIFY `relocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rentapp_payment`
--
ALTER TABLE `rentapp_payment`
  MODIFY `rentpayment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rent_application`
--
ALTER TABLE `rent_application`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2034;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `vendorsoa`
--
ALTER TABLE `vendorsoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `building_a`
--
ALTER TABLE `building_a`
  ADD CONSTRAINT `fk_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `receipts`
--
ALTER TABLE `receipts`
  ADD CONSTRAINT `receipts_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`);

--
-- Constraints for table `rentapp_payment`
--
ALTER TABLE `rentapp_payment`
  ADD CONSTRAINT `fk_applicant_id` FOREIGN KEY (`applicant_id`) REFERENCES `rent_application` (`applicant_id`);

--
-- Constraints for table `vendorsoa`
--
ALTER TABLE `vendorsoa`
  ADD CONSTRAINT `vendorsoa_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`vendor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
