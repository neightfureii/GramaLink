-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 03:07 AM
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
-- Database: `gramalink_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action_type` varchar(255) DEFAULT NULL,
  `action_des` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `action_type`, `action_des`, `timestamp`) VALUES
(5, 14, 'Complaint Resolved ', 'Complaint ID: 27submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-01 07:51:00'),
(6, 14, 'Complaint Rejected', 'Complaint ID: 32submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-01 08:40:16'),
(7, 14, 'Complaint Resolved ', 'Complaint ID: 26submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-25 10:43:16'),
(8, 14, 'Complaint Resolved ', 'Complaint ID: 34submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-25 15:11:24'),
(9, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 28related to : Street Light Issue', '2025-04-25 15:11:43'),
(10, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: related to : ', '2025-04-25 16:32:46'),
(11, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 29related to : Street Light Issue', '2025-04-25 18:48:43'),
(12, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 30related to : Street Light Issue', '2025-04-25 19:29:43'),
(13, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 31related to : Street Light Issue', '2025-04-25 19:40:49'),
(14, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:05:57'),
(15, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:05:58'),
(16, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:14:42'),
(17, 14, 'Complaint Rejected', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:15:19'),
(18, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:18:42'),
(19, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:21:44'),
(20, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:24:22'),
(21, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:24:24'),
(22, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:24:25'),
(24, 14, 'Complaint Rejected', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:29:34'),
(25, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 16:40:38'),
(26, 14, 'Complaint Rejected', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:41:59'),
(27, 14, 'Complaint Resolved ', 'Complaint ID: 40submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-26 16:45:00'),
(28, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 40related to : Street Light Issue', '2025-04-26 16:54:12'),
(29, 14, 'Complaint Resolved ', 'Complaint ID: 41submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-27 04:28:01'),
(30, 14, 'Complaint Resolved ', 'Complaint ID: 41submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-27 11:20:55'),
(31, 14, 'Complaint Rejected', 'Complaint ID: 41submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-27 11:21:14'),
(32, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 41related to : Drainage Problem', '2025-04-27 13:29:55'),
(33, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 41related to : Drainage Problem', '2025-04-27 13:32:59'),
(34, 14, 'Complete visit', 'Completed Visit Array', '2025-04-27 13:33:48'),
(35, 14, 'Complete visit', 'Completed Visit Array', '2025-04-27 13:33:57'),
(36, 14, 'Complete visit', 'Completed Visit ', '2025-04-27 13:35:48'),
(37, 14, 'Complete visit', 'Completed Visit ', '2025-04-27 13:39:34'),
(38, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 41related to : Drainage Problem', '2025-04-27 13:47:25'),
(39, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 42related to : Street Light Issue', '2025-04-27 17:01:35'),
(40, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 42related to : Street Light Issue', '2025-04-27 17:06:41'),
(41, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 46related to : Street Light Issue', '2025-04-27 17:28:21'),
(42, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 47related to : Street Light Issue', '2025-04-27 19:42:47'),
(43, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 48related to : Land Dispute', '2025-04-27 23:27:08'),
(44, 14, 'Complaint Resolved ', 'Complaint ID: 48submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-27 23:30:53'),
(45, 14, 'Complaint Resolved ', 'Complaint ID :- 48submitted by :- Dilshani Nadeesha Kodithuwakku', '2025-04-27 23:33:13'),
(46, 14, 'Complaint Rejected', 'Complaint ID :- 48submitted by :- Dilshani Nadeesha Kodithuwakku', '2025-04-27 23:37:31'),
(47, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 47related to : Street Light Issue', '2025-04-27 23:42:02'),
(48, 14, 'Complete visit', 'Completed Visit ', '2025-04-27 23:42:25'),
(49, 14, 'Complaint Rejected', 'Complaint ID: 48submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-27 23:54:20'),
(50, 14, 'Complaint Rejected', 'Complaint ID: 48submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 00:31:51'),
(51, 14, 'Complaint Resolved ', 'Complaint ID: 48submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 00:32:11'),
(52, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 48related to : Land Dispute', '2025-04-28 00:32:39'),
(53, 14, 'Complaint Resolved ', 'Complaint ID: 49submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 01:32:20'),
(54, 14, 'Complaint Rejected', 'Complaint ID: 49submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 01:35:27'),
(55, 14, 'Complaint Resolved ', 'Complaint ID: 49submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 01:36:16'),
(56, 14, 'Field Visit Request', 'Field visit request submitted for complaint ID: 50related to : LandDispute', '2025-04-28 07:04:05'),
(57, 14, 'Complaint Resolved ', 'Complaint ID: 50submitted by : Dilshani Nadeesha Kodithuwakku', '2025-04-28 07:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `agn`
--

CREATE TABLE `agn` (
  `agn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `appointed_date` date NOT NULL,
  `jurisdiction_area` varchar(100) NOT NULL,
  `contact_office` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agn`
--

INSERT INTO `agn` (`agn_id`, `user_id`, `employee_id`, `full_name`, `nic`, `appointed_date`, `jurisdiction_area`, `contact_office`, `is_active`, `created_at`) VALUES
(1, 3, 'agn001', 'Sanudi Yapa', '200250505050', '2023-11-07', 'Maharagama', '0112189175', 1, '2024-11-18 07:05:50'),
(2, 15, 'gn0004', 'Suranga Sampath', '200156789876', '2025-04-08', 'Malimbada south', '0423456789', 1, '2025-04-24 15:29:23');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `gn_id` int(11) NOT NULL,
  `agn_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected','Forwarded') NOT NULL,
  `gnremarks` varchar(255) NOT NULL,
  `agnremarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `citizen_id`, `gn_id`, `agn_id`, `type`, `created_at`, `status`, `gnremarks`, `agnremarks`) VALUES
(1, 2, 1, 1, 'Land Ownership', '2025-04-06 09:45:48', 'Approved', '', ''),
(3, 2, 1, 1, 'publicAid', '2025-04-06 06:57:00', 'Approved', '', 'ffff'),
(4, 2, 1, 1, 'characterResidence', '2025-04-06 06:57:44', 'Rejected', '', ''),
(5, 2, 1, 1, 'characterResidence', '2025-04-06 07:00:38', 'Pending', '', ''),
(6, 2, 1, 1, 'electricityWater', '2025-04-07 01:40:15', 'Approved', '', ''),
(7, 2, 1, 1, 'electricityWater', '2025-04-07 01:41:46', 'Forwarded', '', ''),
(8, 2, 1, 1, 'electricityWater', '2025-04-07 01:41:50', 'Forwarded', '', ''),
(9, 2, 1, 1, 'electricityWater', '2025-04-07 01:45:37', 'Pending', '', ''),
(10, 2, 1, 1, 'deathCertificate', '2025-04-07 01:53:07', 'Pending', '', ''),
(11, 2, 1, 1, 'characterResidence', '2025-04-07 06:37:55', 'Forwarded', '', 'ffffffffffffffffff'),
(12, 2, 1, 1, 'characterResidence', '2025-04-08 02:19:59', 'Approved', '', ''),
(17, 2, 1, 1, 'residence', '2025-04-19 14:56:51', 'Pending', '', ''),
(19, 2, 1, 1, 'character', '2025-04-19 15:01:44', 'Pending', '', ''),
(21, 2, 1, 1, 'incomeCertificate', '2025-04-19 15:06:09', 'Pending', '', ''),
(23, 2, 1, 1, 'publicAid', '2025-04-19 15:09:40', 'Pending', '', ''),
(25, 2, 1, 1, 'electricityWater', '2025-04-19 15:12:03', 'Pending', '', ''),
(27, 2, 1, 1, 'criminalBgCheck', '2025-04-19 15:14:44', 'Pending', '', ''),
(29, 2, 1, 1, 'deathCertificate', '2025-04-19 15:18:17', 'Pending', '', ''),
(31, 2, 1, 1, 'valuationCertificate', '2025-04-19 15:20:55', 'Pending', '', ''),
(32, 2, 1, 1, 'idApplication', '2025-04-19 15:23:25', 'Pending', '', ''),
(33, 2, 1, 1, 'landOwnership', '2025-04-19 15:27:57', 'Pending', '', ''),
(34, 4, 7, 1, 'residence', '2025-04-25 09:29:54', 'Pending', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `application_cbc`
--

CREATE TABLE `application_cbc` (
  `application_id` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `purpose` enum('employment','visa','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_cbc`
--

INSERT INTO `application_cbc` (`application_id`, `occupation`, `institute`, `purpose`) VALUES
(27, 'Software Engineer', 'WSO2', 'employment');

-- --------------------------------------------------------

--
-- Table structure for table `application_character`
--

CREATE TABLE `application_character` (
  `application_id` int(11) NOT NULL,
  `yearsLived` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `reason` enum('employment','visa','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_character`
--

INSERT INTO `application_character` (`application_id`, `yearsLived`, `occupation`, `institute`, `reason`) VALUES
(19, 1, 'Software Engineer', 'WSO2', 'employment');

-- --------------------------------------------------------

--
-- Table structure for table `application_death`
--

CREATE TABLE `application_death` (
  `application_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `relationship` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_death`
--

INSERT INTO `application_death` (`application_id`, `name`, `nic`, `date`, `relationship`) VALUES
(29, 'jhgfddgjhgfds', '543234543223', '2025-04-15', 'grandfather');

-- --------------------------------------------------------

--
-- Table structure for table `application_ew`
--

CREATE TABLE `application_ew` (
  `application_id` int(11) NOT NULL,
  `type` enum('electricity','water','both') NOT NULL,
  `ownership` enum('yes','no') NOT NULL,
  `reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_ew`
--

INSERT INTO `application_ew` (`application_id`, `type`, `ownership`, `reason`) VALUES
(25, 'electricity', 'yes', 'sffsf');

-- --------------------------------------------------------

--
-- Table structure for table `application_income`
--

CREATE TABLE `application_income` (
  `application_id` int(11) NOT NULL,
  `income` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `reason` enum('university_application','welfare','other') NOT NULL,
  `sourceIncome` enum('job','business','agriculture','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_income`
--

INSERT INTO `application_income` (`application_id`, `income`, `occupation`, `reason`, `sourceIncome`) VALUES
(21, 300000, 'Software Engineer', 'other', 'job');

-- --------------------------------------------------------

--
-- Table structure for table `application_landownership`
--

CREATE TABLE `application_landownership` (
  `application_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `landsize` varchar(50) NOT NULL,
  `yearsLived` int(11) NOT NULL,
  `docType` enum('deed','permit','other','none') NOT NULL,
  `purpose` enum('legal','government_aid','boundary_conflict','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_landownership`
--

INSERT INTO `application_landownership` (`application_id`, `address`, `landsize`, `yearsLived`, `docType`, `purpose`) VALUES
(33, '59/23N,School lane,Rukmale,Pannipitiya', '7 perches', 4, 'permit', 'legal');

-- --------------------------------------------------------

--
-- Table structure for table `application_newid`
--

CREATE TABLE `application_newid` (
  `application_id` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `bcnumber` varchar(20) NOT NULL,
  `reason` enum('first','lost','damaged') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_newid`
--

INSERT INTO `application_newid` (`application_id`, `dob`, `gender`, `bcnumber`, `reason`) VALUES
(32, '2024-11-06', 'female', '12345', 'damaged');

-- --------------------------------------------------------

--
-- Table structure for table `application_publicaid`
--

CREATE TABLE `application_publicaid` (
  `application_id` int(11) NOT NULL,
  `householdincome` int(11) NOT NULL,
  `familysize` int(11) NOT NULL,
  `reason` enum('samurdhi','school_books','disability','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_publicaid`
--

INSERT INTO `application_publicaid` (`application_id`, `householdincome`, `familysize`, `reason`) VALUES
(23, 500000, 4, 'samurdhi');

-- --------------------------------------------------------

--
-- Table structure for table `application_residence`
--

CREATE TABLE `application_residence` (
  `application_id` int(11) NOT NULL,
  `yearsLived` int(11) NOT NULL,
  `reason` enum('job','schooladmission','travel','other') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_residence`
--

INSERT INTO `application_residence` (`application_id`, `yearsLived`, `reason`) VALUES
(17, 2, 'schooladmission'),
(34, 3, 'schooladmission');

-- --------------------------------------------------------

--
-- Table structure for table `application_valuation`
--

CREATE TABLE `application_valuation` (
  `application_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `purpose` enum('loan','sale','legal','other') NOT NULL,
  `ownership` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application_valuation`
--

INSERT INTO `application_valuation` (`application_id`, `address`, `purpose`, `ownership`) VALUES
(31, '59/23N,School lane,Rukmale,Pannipitiya', 'sale', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `gn_id` int(11) DEFAULT NULL,
  `preferred_date` date NOT NULL,
  `preferred_time` time NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `documents` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `citizen_id`, `gn_id`, `preferred_date`, `preferred_time`, `service_type`, `description`, `documents`, `status`, `created_at`, `remarks`) VALUES
(21, 2, 1, '2024-12-26', '11:00:00', 'character', '', '', 'Pending', '2024-11-28 03:36:30', NULL),
(23, 2, 1, '2024-12-19', '11:45:00', 'character', '', '', 'Rejected', '2024-11-28 04:17:46', ''),
(25, 2, 1, '2025-03-04', '11:15:00', 'Address Verification', '', '', '', '2025-02-25 17:54:44', NULL),
(26, 2, 1, '2025-03-04', '09:45:00', 'Death Certificate', '', '', 'pending', '2025-02-25 17:55:14', NULL),
(27, 2, 1, '2025-02-27', '10:45:00', 'Address Verification', '', '', 'pending', '2025-02-25 17:59:14', NULL),
(28, 2, 1, '2025-03-18', '09:00:00', 'Character Certificate', '', '', 'pending', '2025-02-25 18:02:38', NULL),
(29, 2, 1, '2025-03-18', '09:45:00', 'Address Verification', NULL, NULL, 'Pending', '2025-02-26 00:51:36', NULL),
(30, 2, 1, '2025-03-18', '09:45:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 00:54:01', NULL),
(31, 2, 1, '2025-03-04', '10:45:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 00:54:25', NULL),
(32, 2, 1, '2025-03-11', '09:00:00', 'Other', 'sldkjfl', NULL, 'Pending', '2025-02-26 00:55:01', NULL),
(33, 2, 1, '2025-03-13', '09:30:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 00:56:35', NULL),
(34, 2, 1, '2025-03-20', '11:00:00', 'Land Matters', '', NULL, 'Pending', '2025-02-26 00:57:17', NULL),
(35, 2, 1, '2025-03-13', '10:45:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 00:58:22', NULL),
(36, 2, 1, '2025-02-27', '09:15:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 00:59:28', NULL),
(37, 2, 1, '2025-02-27', '09:15:00', 'Address Verification', '', NULL, 'Pending', '2025-02-26 01:00:11', NULL),
(38, 2, 1, '2025-03-20', '11:15:00', 'Character Certificate', '', NULL, 'Pending', '2025-02-26 01:00:21', NULL),
(39, 2, 1, '2025-03-11', '09:30:00', 'Other', '', NULL, 'Pending', '2025-02-27 04:48:28', NULL),
(40, 2, 1, '2025-03-13', '10:30:00', 'Other', 'to renew my nic', NULL, 'Pending', '2025-02-27 04:50:51', NULL),
(41, 2, 1, '2025-04-10', '09:30:00', 'Address Verification', '', NULL, 'Pending', '2025-03-20 06:17:50', NULL),
(42, 2, 1, '2025-04-12', '09:15:00', 'Character Certificate', '', NULL, 'Pending', '2025-04-07 06:14:16', NULL),
(43, 2, 1, '2025-04-10', '09:15:00', 'Character Certificate', '', NULL, 'Pending', '2025-04-07 06:39:06', NULL),
(44, 2, 1, '2025-04-10', '09:45:00', 'Address Verification', '', NULL, 'Pending', '2025-04-08 02:24:49', NULL),
(45, 2, 1, '2025-04-17', '09:30:00', 'Address Verification', '', NULL, 'Pending', '2025-04-10 08:23:11', NULL),
(46, 2, 1, '2025-04-19', '09:45:00', 'Other', 'criminal background check report', NULL, 'Pending', '2025-04-11 23:25:28', NULL),
(47, 2, 1, '2025-04-29', '09:30:00', 'Character Certificate', '', NULL, 'Pending', '2025-04-12 12:46:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `citizen_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `bcnumber` varchar(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `civil_status` enum('single','married','divorced','widowed') NOT NULL,
  `gn_division_id` int(11) NOT NULL,
  `is_registered_user` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`citizen_id`, `user_id`, `nic`, `bcnumber`, `full_name`, `address`, `date_of_birth`, `gender`, `civil_status`, `gn_division_id`, `is_registered_user`, `created_at`) VALUES
(2, 1, '200224303240', '12345', 'lkls', '\"Samanala\", Thalgahagoda,Malimbada,Palatuwa', '2024-11-06', 'female', 'single', 2, 1, '2024-11-17 06:52:18'),
(3, 12, '123456789876', '23456', 'Amantha Tharusha', '59/23N,School lane,Rukmale,Pannipitiya', '2002-08-30', 'male', 'single', 2, 1, '2025-04-17 09:05:01'),
(4, 13, '200153901613', '12345', 'Dilshani Nadeesha Kodithuwakku', '\"Samanala\", Thalgahagoda,Malimbada,Palatuwa', '2001-02-08', 'female', 'single', 2, 1, '2025-04-21 16:26:01');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `complaint_category` varchar(100) DEFAULT NULL,
  `complaint_description` text DEFAULT NULL,
  `status` enum('Pending','Resolved','Rejected') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `priority` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `user_id`, `phone_number`, `time`, `date`, `complaint_category`, `complaint_description`, `status`, `created_at`, `image_path`, `priority`) VALUES
(50, 13, '0987890890', '10:33:00', '2025-04-28', 'LandDispute', 'djkbhabfiuhu', 'Resolved', '2025-04-28 05:03:18', NULL, ''),
(51, 13, '0714819714', '11:17:00', '2025-04-28', 'LandDispute', 'mwefhgew', 'Pending', '2025-04-28 05:47:19', NULL, ''),
(52, 13, '0714819714', '11:18:00', '2025-04-28', 'LandDispute', 'ewuigfuiew', 'Pending', '2025-04-28 05:48:31', NULL, 'high'),
(53, 13, '0714819714', '11:44:00', '2025-04-28', 'StreetLightIssue', 'jdkfvhegiur', 'Pending', '2025-04-28 06:14:36', NULL, 'high'),
(54, 13, '0714890876', '11:45:00', '2025-04-28', 'LandDispute', 'ucsc', 'Pending', '2025-04-28 06:15:52', NULL, 'low'),
(55, 13, '0714890876', '11:59:00', '2025-04-28', 'LandDispute', 'ucsc colombo', 'Pending', '2025-04-28 06:30:03', NULL, 'low'),
(56, 13, '0714890876', '12:01:00', '2025-04-28', 'NoiseComplaint', 'vdjkvhkje', 'Pending', '2025-04-28 06:31:23', NULL, 'high'),
(57, 13, '0714819198', '12:03:00', '2025-04-28', 'Sanitation', 'ucsc colombo', 'Pending', '2025-04-28 06:33:47', NULL, 'low'),
(58, 13, '0714819192', '12:03:00', '2025-04-28', 'Sanitation', 'low priority', 'Pending', '2025-04-28 06:35:12', NULL, 'low'),
(59, 13, '0714819192', '12:06:00', '2025-04-28', 'StreetLightIssue', 'bvbiufg', 'Pending', '2025-04-28 06:36:42', NULL, 'high');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_images`
--

CREATE TABLE `complaint_images` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Status` enum('Unacceptable Service','Below Expectations','Meets Expectations','Above Expectations','Exemplary Service') NOT NULL,
  `Mark_as_Read` tinyint(1) NOT NULL,
  `Text` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `Name`, `Email`, `Status`, `Mark_as_Read`, `Text`, `user_id`) VALUES
(72, 'Dilshani', 'dilshaninadeesha@gmail.com', 'Below Expectations', 1, 'Sorry not good', 1),
(80, 'kjbk', 'ug@jf.bom', 'Above Expectations', 1, 'nnnnnn', 1),
(81, 'Dilshani', 'dilnadeesha2001@gmail.com', 'Meets Expectations', 0, 'f beui buf ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `field_visits`
--

CREATE TABLE `field_visits` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` date DEFAULT curdate(),
  `gn_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field_visits`
--

INSERT INTO `field_visits` (`id`, `address`, `created_at`, `gn_id`) VALUES
(28, 'Kandy', '2025-04-26', 14);

-- --------------------------------------------------------

--
-- Table structure for table `field_visit_request`
--

CREATE TABLE `field_visit_request` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `citizen_id` int(11) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `visit_time` time DEFAULT NULL,
  `request_status` enum('pending','approved','rejected','accepted') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gn_id` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `field_visit_request`
--

INSERT INTO `field_visit_request` (`id`, `complaint_id`, `citizen_id`, `visit_date`, `visit_time`, `request_status`, `created_at`, `updated_at`, `gn_id`, `note`) VALUES
(11, 8, 4, '2025-04-27', '09:00:00', 'accepted', '2025-04-22 05:33:40', '2025-04-27 11:45:46', 4, 'dbwbfoiewbcwkn'),
(36, 0, NULL, '2025-04-25', '09:00:00', 'accepted', '2025-04-25 14:32:46', '2025-04-25 16:56:18', 14, 'bvyu'),
(44, 42, 13, '2025-04-27', '14:00:00', 'pending', '2025-04-27 15:01:35', '2025-04-27 15:01:35', 14, 'I will come see your complaint'),
(47, 47, 13, '2025-04-27', '14:00:00', 'rejected', '2025-04-27 17:42:47', '2025-04-27 17:43:21', 14, 'පබඉනවයම'),
(51, 50, 13, '2025-04-28', '14:00:00', 'pending', '2025-04-28 05:04:05', '2025-04-28 05:04:05', 14, 'dmsbuewf');

-- --------------------------------------------------------

--
-- Table structure for table `gn`
--

CREATE TABLE `gn` (
  `gn_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `appointed_date` date NOT NULL,
  `nic` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `agn_id` int(11) NOT NULL,
  `gn_division_id` int(11) NOT NULL,
  `contact_office` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gn`
--

INSERT INTO `gn` (`gn_id`, `user_id`, `employee_id`, `full_name`, `appointed_date`, `nic`, `address`, `agn_id`, `gn_division_id`, `contact_office`, `is_active`, `created_at`) VALUES
(1, 2, 'gn001', 'Dude Doodulus', '2024-08-05', '198530303031', 'School Lane, Rukmalgama', 1, 1, '0112345345', 1, '2024-11-18 07:08:12'),
(5, 9, 'gn003', 'ldjflh', '2025-04-15', '232323232323', '59/23N,School lane,Rukmale,Pannipitiya', 1, 3, '0112189175', 0, '2025-04-15 04:22:41'),
(7, 14, 'gn004', 'Nadeesha Kodithuwakku', '2025-04-16', '200153901613', 'jvbehwnkcnwdkvur', 1, 2, '0437689789', 1, '2025-04-21 16:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `gndivisions`
--

CREATE TABLE `gndivisions` (
  `gn_division_id` int(11) NOT NULL,
  `division_code` varchar(20) NOT NULL,
  `agn_id` int(11) NOT NULL,
  `division_name` varchar(100) NOT NULL,
  `ds_division` varchar(100) NOT NULL,
  `district` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gndivisions`
--

INSERT INTO `gndivisions` (`gn_division_id`, `division_code`, `agn_id`, `division_name`, `ds_division`, `district`, `province`, `created_at`) VALUES
(1, '1000', 1, 'a;ksf', 'klsa', 'lknlkn', 'lknlkn', '2024-11-17 06:52:08'),
(2, '1001', 1, 'Wattegedara', 'Maharagama', 'Colombo', 'Western', '2025-04-14 08:24:02'),
(3, '1002', 1, 'malimbada', 'hvy', 'Matara', 'southern ', '2025-04-23 01:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `user_id`, `title`, `message`, `is_read`, `created_at`) VALUES
(1, 1, 'bro', 'character certificate application forwarded to agn', 0, '2025-04-12 21:18:57'),
(2, 9, 'sometitle', 'this is the first notification for gn003', 0, '2025-04-15 22:18:11'),
(3, 2, 'details edit request', 'citizen 2234', 0, '2025-04-17 10:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(26, 'dilnadeesha1232001@gmail.com', 'e866107b7c6a60654395e0c64a187e2e7fbf0dc499cbf1c3d2a78a4d78a1ca39c30629fc1abb41d477e8d352c02d6df009df', '2025-04-26 16:39:09'),
(35, 'darshana2021sujan@gmail.com', 'd6de7b0ae06cd730d3b4543369b0c4971374a43a7cab09965461b82435478003193967341fb0a1539391e8d3f3108348d409', '2025-04-26 16:39:56'),
(40, 'surangasampath1919@gmail.com', 'f7958687b4dd3016f7884f7bf4dacdf4e3101daedd4feea240b62ebb29455a7906907fba59dfe2ce52e8600827063ea232ce', '2025-04-26 17:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `permits`
--

CREATE TABLE `permits` (
  `permit_id` int(11) NOT NULL,
  `citizen_id` int(11) NOT NULL,
  `gn_id` int(11) NOT NULL,
  `agn_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Approved','Rejected','Forwarded') NOT NULL,
  `gnremarks` varchar(255) NOT NULL,
  `agnremarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permits`
--

INSERT INTO `permits` (`permit_id`, `citizen_id`, `gn_id`, `agn_id`, `type`, `created_at`, `status`, `gnremarks`, `agnremarks`) VALUES
(12, 2, 1, 1, 'characterResidence', '2025-04-07 07:24:34', 'Approved', '', ''),
(13, 2, 1, 1, 'publicAid', '2025-04-11 23:24:09', 'Forwarded', '', ''),
(14, 2, 1, 1, 'criminalBgCheck', '2025-04-11 23:24:55', 'Pending', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rule_and_regulations`
--

CREATE TABLE `rule_and_regulations` (
  `id` int(11) NOT NULL,
  `Rule_title` varchar(255) NOT NULL,
  `last_Updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Description` text DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rule_and_regulations`
--

INSERT INTO `rule_and_regulations` (`id`, `Rule_title`, `last_Updated`, `Description`, `status`, `pdf`) VALUES
(10, 'sgsg', '2025-04-13 06:16:18', 'fsgfgfdgdfg', 'Active', '/uploads/6748492821829_22000925.pdf'),
(11, 'vn,', '2024-11-28 05:18:21', 'fsfgfhj', 'Active', ''),
(12, 'vmn,m.', '2024-11-28 05:33:40', 'ERT', 'Active', '/uploads/67484e0c70759_Labs2.pdf'),
(13, 'vmn,m.', '2024-11-28 05:35:14', 'eg', 'Active', '/uploads/67484e6abb795_Labs2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobileNumber` varchar(15) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `role` enum('citizen','gn','agn') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `mobileNumber`, `image`, `role`, `created_at`, `last_login`, `is_active`) VALUES
(1, 'amantha', '$2y$10$CnOg81C.TTGkNyI07nSZfOSJE9f6xl6pPAOc3qekZ9wkr9T0tvhyy', 'pmat@srikantha.com', '0787792301', '/assets/images/profileImages/profile_1_1744810852.jpg', 'citizen', '2024-11-17 13:36:14', '2025-04-28 10:34:28', 1),
(2, 'Dude', '$2y$10$hDmGsf7wfbhj9qNdK//fs.ov1RE6MUx/PQF5K0raqFrGxWEXFUAAW', 'dude@gmail.com', '0775529659', '/assets/images/profileImages/1.png', 'gn', '2024-11-17 16:17:25', '2025-04-27 23:38:19', 1),
(3, 'Sanudi', '$2y$10$xkAFGWyrW1aXBVwZZ/i15eUZlld2u9i/E6w1mxiwm6HtabKmVEgt.', 'sanudi@gmail.com', '0770514493', '/assets/images/profileImages/agn.jpeg', 'agn', '2024-11-18 06:59:31', '2025-04-25 02:34:42', 1),
(9, 'gn003', '$2y$10$aI5.GMHAxtgjWYM8EWK0h.PasGTMs8aqNO2LN/sN5wRBarjF4zVMK', 'ghhh@fdsf.com', '0787792301', '/assets/images/profileImages/profile_9_1744735374.jpg', 'gn', '2025-04-15 04:22:41', '2025-04-15 12:18:29', 1),
(12, 'pmatsrikantha@gmail.com', '$2y$10$AybtekChDJkRhQfPyY4lYOD8fkMijuGfpndnXal7wqdvIcmPZYed2', 'pmatsrikantha@gmail.com', '0787792301', '/assets/images/profileImages/profile_123456789876_1744880701.jpg', 'citizen', '2025-04-17 09:05:01', '2025-04-17 05:37:30', 1),
(13, 'Dilshani', '$2y$10$wNOxKf0S5Wna9uV5cdeL3ugEHUEO6dUgPwHqUNleXTWMdleFNlJj2', 'surangasampath1919@gmail.com', '0757741833', '', 'citizen', '2025-04-21 16:24:39', '2025-04-28 10:33:36', 1),
(14, 'Nadeesha', '$2y$10$bHN.E8jSg4wPW/qL6Cb/AO0g0DLeyE.WwU2SsiPbvea4s8IMkkdTO', 'dilnadeesha2001@gmail.com', '0789675678', '', 'agn', '2025-04-21 16:28:43', '2025-07-03 03:12:28', 1),
(15, 'Suranga', '$2y$10$6OAvNSE.J6b83OExLVB6t.XAXahrwPs1c5NdylO0BHpalYyDRuWEG', 'suranga@gmail.com', '0789675678', '', 'agn', '2025-04-24 15:26:32', '2025-04-28 10:35:18', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `agn`
--
ALTER TABLE `agn`
  ADD PRIMARY KEY (`agn_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `citizen_application` (`citizen_id`),
  ADD KEY `gn_application` (`gn_id`);

--
-- Indexes for table `application_cbc`
--
ALTER TABLE `application_cbc`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_character`
--
ALTER TABLE `application_character`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_death`
--
ALTER TABLE `application_death`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_ew`
--
ALTER TABLE `application_ew`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_income`
--
ALTER TABLE `application_income`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_landownership`
--
ALTER TABLE `application_landownership`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_newid`
--
ALTER TABLE `application_newid`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_publicaid`
--
ALTER TABLE `application_publicaid`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_residence`
--
ALTER TABLE `application_residence`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `application_valuation`
--
ALTER TABLE `application_valuation`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_citizen` (`citizen_id`),
  ADD KEY `appointment_gn` (`gn_id`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`citizen_id`),
  ADD UNIQUE KEY `nic_number` (`nic`),
  ADD KEY `gn_division_id` (`gn_division_id`),
  ADD KEY `citizen_user` (`user_id`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `complaint_images`
--
ALTER TABLE `complaint_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Test` (`user_id`);

--
-- Indexes for table `field_visits`
--
ALTER TABLE `field_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `field_visit_request`
--
ALTER TABLE `field_visit_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `complaint_id` (`complaint_id`),
  ADD KEY `citizen_id` (`citizen_id`),
  ADD KEY `fk_gn_id` (`gn_id`);

--
-- Indexes for table `gn`
--
ALTER TABLE `gn`
  ADD PRIMARY KEY (`gn_id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `agn_id` (`agn_id`),
  ADD KEY `gn_division_id` (`gn_division_id`);

--
-- Indexes for table `gndivisions`
--
ALTER TABLE `gndivisions`
  ADD PRIMARY KEY (`gn_division_id`),
  ADD UNIQUE KEY `division_code` (`division_code`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_notifications` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `permits`
--
ALTER TABLE `permits`
  ADD PRIMARY KEY (`permit_id`),
  ADD KEY `citizen_permit` (`citizen_id`),
  ADD KEY `gn_permit` (`gn_id`);

--
-- Indexes for table `rule_and_regulations`
--
ALTER TABLE `rule_and_regulations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `agn`
--
ALTER TABLE `agn`
  MODIFY `agn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `citizen`
--
ALTER TABLE `citizen`
  MODIFY `citizen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `complaint_images`
--
ALTER TABLE `complaint_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `field_visits`
--
ALTER TABLE `field_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `field_visit_request`
--
ALTER TABLE `field_visit_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `gn`
--
ALTER TABLE `gn`
  MODIFY `gn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gndivisions`
--
ALTER TABLE `gndivisions`
  MODIFY `gn_division_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `permits`
--
ALTER TABLE `permits`
  MODIFY `permit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rule_and_regulations`
--
ALTER TABLE `rule_and_regulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `agn`
--
ALTER TABLE `agn`
  ADD CONSTRAINT `agn_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `citizen_application` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizen_id`),
  ADD CONSTRAINT `gn_application` FOREIGN KEY (`gn_id`) REFERENCES `gn` (`gn_id`);

--
-- Constraints for table `application_cbc`
--
ALTER TABLE `application_cbc`
  ADD CONSTRAINT `application_cbc` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_character`
--
ALTER TABLE `application_character`
  ADD CONSTRAINT `application_character` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_death`
--
ALTER TABLE `application_death`
  ADD CONSTRAINT `application_death` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_ew`
--
ALTER TABLE `application_ew`
  ADD CONSTRAINT `application_ew` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_income`
--
ALTER TABLE `application_income`
  ADD CONSTRAINT `application_income` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_landownership`
--
ALTER TABLE `application_landownership`
  ADD CONSTRAINT `application_landownership` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_newid`
--
ALTER TABLE `application_newid`
  ADD CONSTRAINT `application_newid` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_publicaid`
--
ALTER TABLE `application_publicaid`
  ADD CONSTRAINT `application_publicaid` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_residence`
--
ALTER TABLE `application_residence`
  ADD CONSTRAINT `application_residence` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `application_valuation`
--
ALTER TABLE `application_valuation`
  ADD CONSTRAINT `application_validation` FOREIGN KEY (`application_id`) REFERENCES `applications` (`application_id`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointment_citizen` FOREIGN KEY (`citizen_id`) REFERENCES `citizen` (`citizen_id`),
  ADD CONSTRAINT `appointment_gn` FOREIGN KEY (`gn_id`) REFERENCES `gn` (`gn_id`);

--
-- Constraints for table `citizen`
--
ALTER TABLE `citizen`
  ADD CONSTRAINT `citizen_ibfk_1` FOREIGN KEY (`gn_division_id`) REFERENCES `gndivisions` (`gn_division_id`),
  ADD CONSTRAINT `citizen_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint_images`
--
ALTER TABLE `complaint_images`
  ADD CONSTRAINT `complaint_images_ibfk_1` FOREIGN KEY (`complaint_id`) REFERENCES `complaint` (`complaint_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
