-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 11:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wramosmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updationDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `username`, `password`, `updationDate`) VALUES
(1, 'John Doe', 'admin', 'Test@12345', '28-12-2016 11:42:05 AM');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `services_id` varchar(10) DEFAULT NULL,
  `service_recommendation` text NOT NULL,
  `appointmentDate` date DEFAULT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_gateway` varchar(50) NOT NULL,
  `payment_ref` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'pending',
  `payment_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `isReScheduleAvailable` varchar(10) NOT NULL DEFAULT 'yes',
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `userId`, `services_id`, `service_recommendation`, `appointmentDate`, `payment_method`, `payment_gateway`, `payment_ref`, `payment_status`, `payment_id`, `amount`, `isReScheduleAvailable`, `updationDate`, `creationDate`) VALUES
(31, 2, '3,11,12', '[\n    {\n        \"path\": \"elU84PKE.recommendation.png\",\n        \"service_id\": \"3\"\n    },\n    {\n        \"path\": \"5xR6CMJx.recommendation.png\",\n        \"service_id\": \"12\"\n    }\n]', '2024-01-01', 'gcash', 'paymongo', 'src_WyBbkwcAG6WfkWhoMwpQ3X9k', 'success', 'nNIOQcNMwv', 4500.00, 'yes', '2024-02-04 11:56:45', '2024-01-02 22:18:24'),
(32, 2, '3', '[\n    {\n        \"path\": \"IjngPF9I.recommendation.png\",\n        \"service_id\": \"3\"\n    }\n]', '2024-01-02', 'gcash', 'paymongo', 'src_Ww9vdXUDBptjRfszM51z6CVi', 'success', 'v95TxepBHQ', 3000.00, 'yes', '2024-02-04 12:13:21', '2024-02-03 17:22:27'),
(33, 2, '3', '[\n    {\n        \"path\": \"FGMIobVb.recommendation.png\",\n        \"service_id\": \"3\"\n    }\n]', '2024-03-05', 'grab_pay', 'paymongo', 'src_eu68MhVQoasSwKNmm8rEq4vH', 'success', 'WKwNjAwgbr', 5000.00, 'yes', '2024-02-04 12:13:32', '2024-03-03 17:22:27'),
(34, 2, '11', '[]', '2024-04-05', 'gcash', 'paymongo', 'src_brvr5ZRgTYwyKJSKZ2t6ridU', 'success', 'S6avoHmz7o', 2500.00, 'yes', '2024-02-04 12:13:37', '2024-04-03 17:22:27'),
(35, 2, '11', '[]', '2024-05-05', 'gcash', 'paymongo', 'src_wrxk72ZSVizXjiYppzo2FNY5', 'success', 'k8EuOBcy3C', 500.00, 'yes', '2024-02-04 12:13:40', '2024-05-03 17:22:27'),
(36, 2, '11', '[]', '2024-06-05', 'gcash', 'paymongo', 'src_nVbzYJheyvD7YSCrayQGKHxP', 'success', 'njCMNyph8t', 1700.00, 'yes', '2024-02-04 12:13:46', '2024-06-03 17:22:27'),
(37, 2, '11', '[]', '2024-07-05', 'gcash', 'paymongo', 'src_YXiZdv7TJ4mMDwwjs6ceaJqv', 'success', 'XB0bFgFt0M', 3000.00, 'yes', '2024-02-04 12:13:52', '2024-07-03 17:22:27'),
(38, 2, '11', '[]', '2024-08-05', 'gcash', 'paymongo', 'src_5PrTqGnq6zYq4ppHWPBic1Me', 'success', '3bSwEL707b', 2000.00, 'yes', '2024-02-04 12:13:56', '2024-02-07 17:22:27'),
(39, 2, '11', '[]', '2024-09-05', 'gcash', 'paymongo', 'src_FjigKKSWBZm26Q1K9nFRBikj', 'success', 'WVNGkWcJ8r', 3000.00, 'yes', '2024-02-04 12:14:04', '2024-09-03 17:22:27'),
(40, 2, '11', '[]', '2024-10-05', 'gcash', 'paymongo', 'src_UZzWp2H5sfWbUnHnTkFCLi6k', 'success', '1sOCZeXGhl', 2500.00, 'yes', '2024-02-04 12:14:11', '2024-10-03 17:22:27'),
(41, 2, '11', '[]', '2024-11-05', 'gcash', 'paymongo', 'src_EQJ3gq5UfLD8UAuwwpqM3tFi', 'success', 'Xs8gBiFtJh', 1500.00, 'yes', '2024-02-04 11:56:45', '2024-11-03 17:22:27'),
(42, 2, '11', '[]', '2024-12-06', 'gcash', 'paymongo', 'src_aTFSPubNMcX16bdn9zeFRDKC', 'success', 'utw8EOCg9u', 1500.00, 'yes', '2024-02-04 11:43:52', '2024-12-03 17:22:27'),
(43, 2, '3,11,12', '[\r\n    {\r\n        \"path\": \"elU84PKE.recommendation.png\",\r\n        \"service_id\": \"3\"\r\n    },\r\n    {\r\n        \"path\": \"5xR6CMJx.recommendation.png\",\r\n        \"service_id\": \"12\"\r\n    }\r\n]', '2024-01-01', 'gcash', 'paymongo', 'src_WyBbkwcAG6WfkWhoMwpQ3X9k', 'success', 'nNIOQcNMwv', 4500.00, 'yes', '2024-02-04 12:08:03', '2023-01-02 22:18:24'),
(44, 2, '3', '[\r\n    {\r\n        \"path\": \"IjngPF9I.recommendation.png\",\r\n        \"service_id\": \"3\"\r\n    }\r\n]', '2024-01-02', 'gcash', 'paymongo', 'src_Ww9vdXUDBptjRfszM51z6CVi', 'success', 'v95TxepBHQ', 4500.00, 'yes', '2024-02-04 12:14:22', '2023-02-03 17:22:27'),
(45, 2, '3', '[\r\n    {\r\n        \"path\": \"FGMIobVb.recommendation.png\",\r\n        \"service_id\": \"3\"\r\n    }\r\n]', '2024-03-05', 'grab_pay', 'paymongo', 'src_eu68MhVQoasSwKNmm8rEq4vH', 'success', 'WKwNjAwgbr', 3500.00, 'yes', '2024-02-04 12:14:25', '2023-03-03 17:22:27'),
(46, 2, '11', '[]', '2024-04-05', 'gcash', 'paymongo', 'src_brvr5ZRgTYwyKJSKZ2t6ridU', 'success', 'S6avoHmz7o', 500.00, 'yes', '2024-02-04 12:14:29', '2023-04-04 17:22:27'),
(47, 2, '11', '[]', '2024-05-05', 'gcash', 'paymongo', 'src_wrxk72ZSVizXjiYppzo2FNY5', 'success', 'k8EuOBcy3C', 700.00, 'yes', '2024-02-04 12:14:33', '2023-05-03 17:22:27'),
(48, 2, '11', '[]', '2024-06-05', 'gcash', 'paymongo', 'src_nVbzYJheyvD7YSCrayQGKHxP', 'success', 'njCMNyph8t', 1500.00, 'yes', '2024-02-04 12:08:48', '2023-06-03 17:22:27'),
(49, 2, '11', '[]', '2024-07-05', 'gcash', 'paymongo', 'src_YXiZdv7TJ4mMDwwjs6ceaJqv', 'success', 'XB0bFgFt0M', 2500.00, 'yes', '2024-02-04 12:14:38', '2023-07-03 17:22:27'),
(50, 2, '11', '[]', '2024-08-05', 'gcash', 'paymongo', 'src_5PrTqGnq6zYq4ppHWPBic1Me', 'success', '3bSwEL707b', 2200.00, 'yes', '2024-02-04 12:14:41', '2023-08-03 17:22:27'),
(51, 2, '11', '[]', '2024-09-05', 'gcash', 'paymongo', 'src_FjigKKSWBZm26Q1K9nFRBikj', 'success', 'WVNGkWcJ8r', 1700.00, 'yes', '2024-02-04 12:14:45', '2023-09-03 17:22:27'),
(52, 2, '11', '[]', '2024-10-05', 'gcash', 'paymongo', 'src_UZzWp2H5sfWbUnHnTkFCLi6k', 'success', '1sOCZeXGhl', 2000.00, 'yes', '2024-02-04 12:14:55', '2023-10-03 17:22:27'),
(53, 2, '11', '[]', '2024-11-05', 'gcash', 'paymongo', 'src_EQJ3gq5UfLD8UAuwwpqM3tFi', 'success', 'Xs8gBiFtJh', 5000.00, 'yes', '2024-02-04 12:15:00', '2023-11-03 17:22:27'),
(54, 2, '11', '[]', '2024-12-06', 'gcash', 'paymongo', 'src_aTFSPubNMcX16bdn9zeFRDKC', 'success', 'utw8EOCg9u', 3000.00, 'yes', '2024-02-04 12:15:04', '2023-12-03 17:22:27'),
(55, 2, '11', '[]', '2024-05-05', 'gcash', 'paymongo', 'src_weQc7yL6u5REBnED1nZK6SkB', 'success', 'KyG6zYoSwm', 1500.00, 'yes', '2024-04-22 01:20:19', '2024-04-22 01:20:14');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

CREATE TABLE `cashier` (
  `id` int(10) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`id`, `FullName`, `username`, `password`, `updationDate`) VALUES
(1, 'cashier', 'cashier', 'cashier123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `doctorName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `docFees` varchar(255) DEFAULT NULL,
  `contactno` bigint(11) DEFAULT NULL,
  `docEmail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specilization`, `doctorName`, `address`, `docFees`, `contactno`, `docEmail`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'Dentist', 'Lyndon Bermoy', 'New Delhi', '500', 8285703354, 'anuj.lpu1@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2016-12-29 06:25:37', '2020-07-05 01:53:19'),
(2, 'Homeopath', 'Sarita Pandey', 'Varanasi', '600', 2147483647, 'sarita@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2016-12-29 06:51:51', '0000-00-00 00:00:00'),
(3, 'General Physician', 'Nitesh Kumar', 'Ghaziabad', '1200', 8523699999, 'nitesh@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 07:43:35', '0000-00-00 00:00:00'),
(4, 'Homeopath', 'Vijay Verma', 'New Delhi', '700', 25668888, 'vijay@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 07:45:09', '0000-00-00 00:00:00'),
(5, 'Ayurveda', 'Sanjeev', 'Gurugram', '8050', 442166644646, 'sanjeev@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 07:47:07', '0000-00-00 00:00:00'),
(6, 'General Physician', 'Amrita', 'New Delhi India', '2500', 45497964, 'amrita@test.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 07:52:50', '0000-00-00 00:00:00'),
(7, 'Demo test', 'abc ', 'New Delhi India', '200', 852888888, 'test@demo.com', 'f925916e2754e5e03f75dd58a5733251', '2017-01-07 08:08:58', '2019-06-23 18:17:25'),
(8, 'Ayurveda', 'Test Doctor', 'Xyz Abc New Delhi', '600', 1234567890, 'test@test.com', '202cb962ac59075b964b07152d234b70', '2019-06-23 17:57:43', '2019-06-23 18:06:06'),
(11, 'Physician', 'Jonah Juarez', 'Surigao Philippines', '2000', 123456789, 'jjuarez@gmail.com', '25f9e794323b453885f5181f1b624d0b', '2020-07-05 02:06:00', '2020-07-05 02:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `doctorslog`
--

CREATE TABLE `doctorslog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorslog`
--

INSERT INTO `doctorslog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(20, 7, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2020-07-05 01:50:01', NULL, 1),
(21, NULL, 'juarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:02:51', NULL, 0),
(22, NULL, 'juarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:03:03', NULL, 0),
(23, NULL, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:04:02', NULL, 0),
(24, NULL, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:04:38', NULL, 0),
(25, 11, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:06:19', NULL, 1),
(26, 11, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:06:38', NULL, 1),
(27, 11, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:08:18', NULL, 1),
(28, 11, 'jjuarez@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:15:25', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecilization`
--

CREATE TABLE `doctorspecilization` (
  `id` int(11) NOT NULL,
  `specilization` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctorspecilization`
--

INSERT INTO `doctorspecilization` (`id`, `specilization`, `creationDate`, `updationDate`) VALUES
(1, 'Gynecologist/Obstetrician', '2016-12-28 06:37:25', NULL),
(2, 'General Physician', '2016-12-28 06:38:12', NULL),
(3, 'Dermatologist', '2016-12-28 06:38:48', NULL),
(4, 'Homeopath', '2016-12-28 06:39:26', NULL),
(5, 'Ayurveda', '2016-12-28 06:39:51', NULL),
(6, 'Dentist', '2016-12-28 06:40:08', NULL),
(7, 'Ear-Nose-Throat (Ent) Specialist', '2016-12-28 06:41:18', NULL),
(9, 'Demo test', '2016-12-28 07:37:39', NULL),
(10, 'Bones Specialist demo', '2017-01-07 08:07:53', NULL),
(11, 'Dermatologist', '2019-06-23 17:51:06', NULL),
(12, 'Physician', '2019-11-10 18:36:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(225) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `button_more_details_url` varchar(100) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `description`, `button_more_details_url`, `creationDate`) VALUES
(1, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=XB0bFgFt0M', '2024-02-03 17:43:52'),
(2, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=3bSwEL707b', '2024-02-03 17:52:57'),
(3, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=WVNGkWcJ8r', '2024-02-03 17:58:45'),
(4, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=1sOCZeXGhl', '2024-02-03 17:59:16'),
(5, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=Xs8gBiFtJh', '2024-02-03 18:00:01'),
(6, '', '', '', '2024-02-03 18:15:54'),
(7, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=utw8EOCg9u', '2024-02-03 18:16:55'),
(8, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=utw8EOCg9u', '2024-02-03 18:17:03'),
(9, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=utw8EOCg9u', '2024-02-03 18:24:53'),
(10, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=utw8EOCg9u', '2024-02-03 18:27:02'),
(11, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=utw8EOCg9u', '2024-02-03 18:28:11'),
(12, 'Appointment', 'New appointment created', 'appointment-details.php?track_id=KyG6zYoSwm', '2024-04-22 01:20:19');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(225) NOT NULL,
  `name` varchar(100) NOT NULL,
  `services` text NOT NULL,
  `services_id` varchar(50) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `services`, `services_id`, `fee`, `description`, `creationDate`, `updationDate`) VALUES
(1, 'Routine 1', 'X-Ray, Ultra Sound', '3, 11', 1500.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2024-01-28 21:57:54', '2024-01-29 00:26:23'),
(2, 'Routine 3', 'X-Ray, Ultra Sound', '3, 11', 1500.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2024-01-28 22:10:16', '2024-01-29 00:26:32'),
(3, 'Apple 2', 'X-Ray, Ultra Sound', '3, 11', 1500.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', '2024-01-29 00:20:12', '2024-01-29 00:25:06'),
(5, 'Routine 4', 'X-Ray, Ultra Sound', '3, 11', 1500.00, 'ajdklasdklasjdklas', '2024-01-29 13:13:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(225) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `availableReservationsPerDay` int(10) NOT NULL,
  `availableDay` varchar(100) NOT NULL,
  `requireRecommendation` varchar(10) NOT NULL DEFAULT 'no',
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updateDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `description`, `fee`, `availableReservationsPerDay`, `availableDay`, `requireRecommendation`, `creationDate`, `updateDate`) VALUES
(3, 'X-Ray', 'wKHsXi7a.services.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1500.00, 20, 'Sunday,Monday,Friday,Saturday', 'yes', '2024-01-28 17:41:14', '2024-01-30 12:23:46'),
(11, 'Ultra Sound', 'ZJD7IeBy.services.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1500.00, 20, 'Sunday,Monday', 'no', '2024-01-28 18:51:56', '2024-01-28 19:06:16'),
(12, 'Thyroid Function Test', 'ZJD7IeBy.services.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 1500.00, 20, 'Sunday,Monday', 'yes', '2024-01-28 18:51:56', '2024-01-28 19:06:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactus`
--

CREATE TABLE `tblcontactus` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactno` bigint(12) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsRead` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactus`
--

INSERT INTO `tblcontactus` (`id`, `fullname`, `email`, `contactno`, `message`, `PostingDate`, `AdminRemark`, `LastupdationDate`, `IsRead`) VALUES
(1, 'test user', 'test@gmail.com', 2523523522523523, ' This is sample text for the test.', '2019-06-29 19:03:08', 'Test Admin Remark', '2019-06-30 12:55:23', 1),
(2, 'Lyndon Bermoy', 'serbermz2020@gmail.com', 1111111111111111, ' This is sample text for testing.  This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing. This is sample text for testing.', '2019-06-30 13:06:50', 'Answered', '2020-07-05 02:13:25', 1),
(3, 'fdsfsdf', 'fsdfsd@ghashhgs.com', 3264826346, 'sample text   sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  sample text  ', '2019-11-10 18:53:48', 'vfdsfgfd', '2019-11-10 18:54:04', 1),
(4, 'demo', 'demo@gmail.com', 123456789, ' hi, this is a demo', '2020-07-05 01:57:20', 'answered', '2020-07-05 01:57:46', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmedicalhistory`
--

CREATE TABLE `tblmedicalhistory` (
  `ID` int(10) NOT NULL,
  `PatientID` int(10) DEFAULT NULL,
  `BloodPressure` varchar(200) DEFAULT NULL,
  `BloodSugar` varchar(200) NOT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `Temperature` varchar(200) DEFAULT NULL,
  `MedicalPres` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmedicalhistory`
--

INSERT INTO `tblmedicalhistory` (`ID`, `PatientID`, `BloodPressure`, `BloodSugar`, `Weight`, `Temperature`, `MedicalPres`, `CreationDate`) VALUES
(2, 3, '120/185', '80/120', '85 Kg', '101 degree', '#Fever, #BP high\r\n1.Paracetamol\r\n2.jocib tab\r\n', '2019-11-06 04:20:07'),
(3, 2, '90/120', '92/190', '86 kg', '99 deg', '#Sugar High\r\n1.Petz 30', '2019-11-06 04:31:24'),
(4, 1, '125/200', '86/120', '56 kg', '98 deg', '# blood pressure is high\r\n1.koil cipla', '2019-11-06 04:52:42'),
(5, 1, '96/120', '98/120', '57 kg', '102 deg', '#Viral\r\n1.gjgjh-1Ml\r\n2.kjhuiy-2M', '2019-11-06 04:56:55'),
(6, 4, '90/120', '120', '56', '98 F', '#blood sugar high\r\n#Asthma problem', '2019-11-06 14:38:33'),
(7, 5, '80/120', '120', '85', '98.6', 'Rx\r\n\r\nAbc tab\r\nxyz Syrup', '2019-11-10 18:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblpatient`
--

CREATE TABLE `tblpatient` (
  `ID` int(10) NOT NULL,
  `pat_fname` varchar(100) DEFAULT NULL,
  `pat_lname` varchar(255) DEFAULT NULL,
  `pat_bod` varchar(100) DEFAULT NULL,
  `pat_contactnum` bigint(11) DEFAULT NULL,
  `pat_email` varchar(200) DEFAULT NULL,
  `pat_gender` varchar(50) DEFAULT NULL,
  `pat_status` varchar(255) DEFAULT NULL,
  `pat_add` varchar(255) DEFAULT NULL,
  `pat_city` varchar(255) DEFAULT NULL,
  `pat_age` int(10) DEFAULT NULL,
  `pat_type` varchar(100) DEFAULT NULL,
  `pat_services` varchar(100) DEFAULT NULL,
  `pat_refnum` int(50) DEFAULT NULL,
  `pat_paymentstatus` varchar(255) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpatient`
--

INSERT INTO `tblpatient` (`ID`, `pat_fname`, `pat_lname`, `pat_bod`, `pat_contactnum`, `pat_email`, `pat_gender`, `pat_status`, `pat_add`, `pat_city`, `pat_age`, `pat_type`, `pat_services`, `pat_refnum`, `pat_paymentstatus`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Demo', 'User', 'June 2 2000', 4558968789, 'test@gmail.com', 'Male', NULL, 'Japan', 'Tokyo', 26, 'Online', 'Laboratory', NULL, NULL, '2019-11-04 21:38:06', '2024-04-16 07:29:48'),
(4, 'Kel', 'Dan', 'afwafawfawf', 9888988989, 'sharma@gmail.com', 'Male', NULL, 'L-56,Ashok Nagar New Delhi-110096', 'awfawfawf', 45, 'afwawfawf', 'awfawfawf', NULL, NULL, '2019-11-06 14:33:54', '2024-04-16 07:30:03'),
(5, 'Tim', 'Chu', 'awfawfawfaw', 1234567890, 'john@test.com', 'male', NULL, 'Test ', 'fwawwagawg', 25, 'gawgafawf', 'awdawfawg', NULL, NULL, '2019-11-10 18:49:24', NULL),
(6, 'wfawga', 'awawf', 'dawfaw', 123456789, 'serbermz2020@gmail.com', 'male', NULL, 'Surigao Philippines', 'dawfawg', 35, 'awdawg', 'awdaw', NULL, NULL, '2020-07-05 02:08:09', NULL),
(7, '', '', '', 0, '', '', NULL, '', '', 0, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(8, '', '', '', 0, '', '', NULL, '', '', 0, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(9, 'awdawdf', 'awfawf', '', 0, '', 'Male', '', '', '', 12, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(10, 'timoteo', 'Paez', '', 0, '', 'Male', '', '', '', 54, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(11, 'michael', 'dano', '', 0, '', 'Male', '', '', '', 20, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(12, 'awfawf', 'awfaw', '', 9335626518, 'awaffwe2fd@gmail.com', 'Female', '', '', '', 24, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(13, 'Timothy', 'Tubol', '', 9836732786, 'timothytubol@gmail.com', 'Female', '', 'awfadadaw', '', 43, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(14, '', '', '2024-04-10', 0, '', '', '', '', '', 0, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(15, 'awfagawg', 'awdawfawf', '2024-04-16', 9273862789, 'awfawfa@gmail.com', 'Male', '', 'awfawdawf', '', 0, '', '', NULL, NULL, '2024-04-21 23:00:00', NULL),
(16, '', '', '2017-07-28', 0, '', '', '', '', '', 6, '', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(17, 'harold', 'villegas', '2000-11-24', 9131531351, 'fawfaaws@gmail.com', 'Male', 'Male', '2kq2lkelqk2qellk2e', '', 0, '', '', NULL, NULL, '2024-04-16 05:55:00', NULL),
(18, 'awfawfawf', 'adwawdfawf', '2012-06-21', 9131515321, 'awfawdaw@gmail.com', 'Male', 'Male', 'awfawfsadwa', '', 12, 'Walkin', '', NULL, NULL, '0000-00-00 00:00:00', NULL),
(19, 'awawfawf', 'awdawfawf', '2016-07-23', 9346554323, 'fafawfaw@gmail.com', 'Male', 'Male', 'awfafawdawdf', '', 9, '', '', NULL, NULL, '2024-04-09 22:07:00', NULL),
(20, 'awfafaf', 'awfawf', '2000-06-28', 0, '750', 'Male', 'Male', 'awfawdaw', '', 23, '', '', NULL, NULL, '2024-04-21 23:53:00', NULL),
(21, 'awfawf', 'awdawdf', '20000-02-06', 0, '750', 'Male', 'Male', 'awfadawd', '', 23, 'Walkin', '', NULL, NULL, '2024-04-22 03:54:00', NULL),
(22, 'ed', 'flo', '2024-04-10', 0, '12312', 'Male', 'Female', 'asdas', NULL, 21, 'Walkin', '', NULL, NULL, '2024-04-22 09:18:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`id`, `uid`, `username`, `userip`, `loginTime`, `logout`, `status`) VALUES
(24, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 01:50:24', NULL, 1),
(25, NULL, 'serbermz2020@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:09:18', NULL, 0),
(26, NULL, 'serbermz2020@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:11:05', NULL, 0),
(27, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:11:24', NULL, 0),
(28, NULL, 'serbermz2020@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:11:46', NULL, 0),
(29, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2020-07-05 02:12:00', NULL, 1),
(30, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-27 16:11:47', '27-01-2024 09:44:08 PM', 1),
(31, NULL, 'admin', 0x3a3a3100000000000000000000000000, '2024-01-30 01:26:28', NULL, 0),
(32, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 01:28:39', NULL, 0),
(33, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 01:39:01', NULL, 0),
(34, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 01:39:04', NULL, 0),
(35, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 01:59:48', NULL, 0),
(36, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 01:59:52', NULL, 0),
(37, NULL, 'johnlenardjuanitas223@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 02:28:33', NULL, 0),
(38, NULL, ' test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 02:31:07', NULL, 0),
(39, NULL, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 02:31:15', NULL, 0),
(40, NULL, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-01-30 02:31:23', NULL, 0),
(41, 2, 'test@gmail.com', 0x3139322e3136382e312e380000000000, '2024-01-30 15:02:31', NULL, 1),
(42, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-11 09:04:19', NULL, 0),
(43, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-11 09:04:27', NULL, 0),
(44, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-11 09:04:40', NULL, 0),
(45, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-11 09:05:59', NULL, 1),
(46, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:37:57', NULL, 0),
(47, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:38:06', NULL, 0),
(48, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:38:19', NULL, 0),
(49, NULL, 'systemsample@gamil.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:40:36', NULL, 0),
(50, NULL, 'systemsample@gamil.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:40:46', NULL, 0),
(51, NULL, 'systemsample@gamil.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:40:57', NULL, 0),
(52, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 05:41:12', '12-04-2024 12:10:05 PM', 1),
(53, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 06:45:35', NULL, 0),
(54, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 06:45:48', NULL, 0),
(55, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-12 06:46:05', NULL, 1),
(56, NULL, 'sample1@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-15 01:09:30', NULL, 0),
(57, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-15 01:10:09', '15-04-2024 07:03:08 AM', 1),
(58, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2024-04-16 02:57:36', NULL, 0),
(59, NULL, 'test@demo.com', 0x3a3a3100000000000000000000000000, '2024-04-16 02:57:47', NULL, 0),
(60, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-16 02:58:29', NULL, 1),
(61, NULL, 'admin', 0x3a3a3100000000000000000000000000, '2024-04-17 01:18:52', NULL, 0),
(62, NULL, 'admin', 0x3a3a3100000000000000000000000000, '2024-04-17 01:19:03', NULL, 0),
(63, 2, 'test@gmail.com', 0x3a3a3100000000000000000000000000, '2024-04-22 01:19:39', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `regDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `address`, `city`, `gender`, `email`, `password`, `regDate`, `updationDate`) VALUES
(2, 'user', 'sample', 'Manila, Philippines', 'Manila', 'male', 'test@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2016-12-30 05:34:39', '2024-04-16 06:53:56'),
(8, 'System', 'Sample', 'tondo', 'manila', 'Male', 'systemsample@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-04-12 05:40:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashier`
--
ALTER TABLE `cashier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorslog`
--
ALTER TABLE `doctorslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpatient`
--
ALTER TABLE `tblpatient`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `cashier`
--
ALTER TABLE `cashier`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctorslog`
--
ALTER TABLE `doctorslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `doctorspecilization`
--
ALTER TABLE `doctorspecilization`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblcontactus`
--
ALTER TABLE `tblcontactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblmedicalhistory`
--
ALTER TABLE `tblmedicalhistory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpatient`
--
ALTER TABLE `tblpatient`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
