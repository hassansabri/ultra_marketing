-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 11:32 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultra_marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` bigint(20) NOT NULL,
  `brand_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Apple', 1, '2025-06-08 23:38:17', '2025-07-04 01:06:25'),
(2, 'Samsung', 1, '2025-06-08 23:38:17', '2025-06-08 23:38:17'),
(3, 'abcd', 1, '2025-06-20 06:32:44', '2025-07-04 02:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `parent_id` bigint(20) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `parent_id`, `category_status`, `created_date`, `modified_date`) VALUES
(1, 'cat1', 0, 1, '2025-06-04 14:07:02', '2025-06-04 15:38:01'),
(2, 'cat2', 1, 1, '2025-06-04 14:09:48', '2025-06-08 23:15:46'),
(3, 'cat3', 2, 1, '2025-06-04 16:30:11', '2025-06-08 23:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` bigint(20) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `city_status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `country_fk` bigint(20) NOT NULL,
  `state_fk` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `city_status`, `created_date`, `modified_date`, `country_fk`, `state_fk`) VALUES
(1, 'Lahore', 1, '2025-05-14 16:10:43', '2025-05-14 16:10:43', 1, 2),
(2, 'Islamabad', 1, '2025-05-14 16:10:43', '2025-05-14 16:10:43', 1, 2),
(3, 'Faisalabad', 1, '2025-05-14 16:10:43', '2025-05-14 16:10:43', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE `colours` (
  `colour_id` bigint(20) NOT NULL,
  `colour_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`colour_id`, `colour_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Blue', 1, '2025-06-08 23:13:21', '2025-06-21 04:02:58'),
(2, 'Red', 1, '2025-06-08 23:13:21', '2025-06-08 23:13:21'),
(3, 'Black', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` bigint(20) NOT NULL,
  `country_name` varchar(255) NOT NULL COMMENT 'INT',
  `country_code` varchar(255) NOT NULL COMMENT 'INT',
  `country_status` int(11) NOT NULL DEFAULT 0 COMMENT 'INT'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_code`, `country_status`) VALUES
(1, 'Pakistan', '+92', 1);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'aijjijj', 'fvfv', '2025-07-11 20:36:05', '2025-07-11 20:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `gender_id` bigint(20) NOT NULL,
  `gender_title` varchar(255) NOT NULL,
  `gender_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`gender_id`, `gender_title`, `gender_status`, `created_date`, `modified_date`) VALUES
(1, 'Male', 1, '2025-05-11 16:14:50', '2025-05-11 16:14:50'),
(2, 'Female', 1, '2025-05-11 16:14:50', '2025-05-11 16:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grade_id` bigint(20) NOT NULL,
  `grade_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grade_id`, `grade_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'A', 1, '2025-06-08 23:34:50', '2025-06-20 19:08:05'),
(2, 'B', 1, '2025-06-08 23:34:50', '2025-06-08 23:34:50'),
(3, 'C', 1, '2025-06-08 23:35:05', '2025-06-08 23:35:05');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float DEFAULT NULL,
  `item_cat_fk` bigint(20) NOT NULL,
  `item_code` varchar(255) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_unit` enum('pcs','box','meter','dozen','pair') DEFAULT NULL,
  `item_colour_fk` bigint(20) NOT NULL,
  `item_weight` varchar(255) NOT NULL,
  `item_grade` enum('a','b','c') DEFAULT NULL,
  `item_size` enum('small','medium','large','xl','xxl','xxxl') DEFAULT NULL,
  `item_type` enum('local','imported') DEFAULT NULL,
  `item_brand_fk` bigint(20) DEFAULT NULL,
  `item_images_fk` bigint(20) NOT NULL,
  `item_expire_date` date NOT NULL,
  `item_status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_cat_fk`, `item_code`, `item_description`, `item_unit`, `item_colour_fk`, `item_weight`, `item_grade`, `item_size`, `item_type`, `item_brand_fk`, `item_images_fk`, `item_expire_date`, `item_status`, `created_date`, `modified_date`) VALUES
(10, 'Test', NULL, 2, '02', 'as', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '2025-06-13', 1, '2025-06-09 00:23:21', '2025-06-08 23:15:14'),
(11, 'test1', NULL, 1, '02', 'test1', NULL, 0, '10 gram', NULL, NULL, NULL, 2, 0, '2025-07-02', 1, '2025-07-02 19:31:08', '2025-07-02 16:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `items_attributes`
--

CREATE TABLE `items_attributes` (
  `item_attribute_id` bigint(20) NOT NULL,
  `attribute_fk` bigint(20) NOT NULL,
  `item_fk` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `item_type` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `items_attributes`
--

INSERT INTO `items_attributes` (`item_attribute_id`, `attribute_fk`, `item_fk`, `status`, `item_type`, `created_date`, `modified_date`) VALUES
(152, 1, 10, 1, 'brand', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(153, 2, 10, 1, 'brand', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(154, 1, 10, 1, 'model', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(155, 2, 10, 1, 'model', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(156, 1, 10, 1, 'grade', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(157, 2, 10, 1, 'grade', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(158, 3, 10, 1, 'grade', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(159, 5, 10, 1, 'size', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(160, 1, 10, 1, 'type', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(161, 2, 10, 1, 'type', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(162, 1, 10, 1, 'colour', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(163, 2, 10, 1, 'colour', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(164, 3, 10, 1, 'colour', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(165, 1, 10, 1, 'unit', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(166, 3, 10, 1, 'unit', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(167, 5, 10, 1, 'unit', '2025-07-01 23:11:27', '2025-07-01 23:11:27'),
(175, 1, 11, 1, 'brand', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(176, 1, 11, 1, 'model', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(177, 1, 11, 1, 'grade', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(178, 2, 11, 1, 'grade', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(179, 3, 11, 1, 'grade', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(180, 1, 11, 1, 'size', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(181, 1, 11, 1, 'type', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(182, 1, 11, 1, 'colour', '2025-07-11 19:39:03', '2025-07-11 19:39:03'),
(183, 1, 11, 1, 'unit', '2025-07-11 19:39:03', '2025-07-11 19:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `model_id` bigint(20) NOT NULL,
  `model_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`model_id`, `model_title`, `status`, `created_date`, `modified_date`) VALUES
(1, '2021', 1, '2025-06-09 22:43:28', '2025-06-09 22:43:28'),
(2, '2022', 1, '2025-06-09 22:43:28', '2025-06-09 22:43:28'),
(3, '2023', 1, '2025-06-09 22:45:10', '2025-06-09 22:45:10'),
(4, '2024', 1, '2025-06-09 22:45:10', '2025-06-09 22:45:10'),
(5, '2025', 1, '2025-06-09 22:46:01', '2025-06-20 18:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `order_number` bigint(20) NOT NULL,
  `item_fk` bigint(20) NOT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `order_price` int(11) DEFAULT NULL,
  `order_status` enum('draft','confirm') NOT NULL DEFAULT 'draft',
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `item_fk`, `order_quantity`, `order_price`, `order_status`, `created_date`, `modified_date`) VALUES
(52, 8341, 10, 1, NULL, 'draft', '2025-07-10 02:30:28', '2025-07-10 02:30:28'),
(53, 8341, 11, 1, NULL, 'draft', '2025-07-10 02:30:28', '2025-07-10 02:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` bigint(20) NOT NULL,
  `order_number_fk` bigint(20) NOT NULL,
  `attribute_fk` bigint(20) NOT NULL,
  `attribute_quantity` int(11) NOT NULL,
  `item_fk` bigint(20) NOT NULL,
  `attribute_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_number_fk`, `attribute_fk`, `attribute_quantity`, `item_fk`, `attribute_type`) VALUES
(143, 8341, 1, 10, 10, 'grade'),
(144, 8341, 2, 20, 10, 'grade'),
(145, 8341, 3, 30, 10, 'grade'),
(146, 8341, 1, 10, 10, 'model'),
(147, 8341, 2, 20, 10, 'model'),
(148, 8341, 1, 80, 11, 'grade'),
(149, 8341, 1, 90, 11, 'model');

-- --------------------------------------------------------

--
-- Table structure for table `payment_options`
--

CREATE TABLE `payment_options` (
  `payment_option_id` bigint(20) NOT NULL,
  `payment_options_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_options`
--

INSERT INTO `payment_options` (`payment_option_id`, `payment_options_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Check', 1, '2025-06-27 23:17:38', '2025-06-27 23:17:38'),
(2, 'Cash', 1, '2025-06-27 23:17:38', '2025-06-27 23:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` bigint(20) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `shop_name`, `name`, `email`, `phone`, `adress`, `created_date`, `modified_date`) VALUES
(1, 'asdfghjkl', 'Nadeem', 'nadeem.sabri.life@gmail.com', '021-3333333', 'abc xyz', '2025-06-27 23:32:13', '2025-06-27 23:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` bigint(20) NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_owner` varchar(255) NOT NULL,
  `shop_number` varchar(255) NOT NULL,
  `shop_email` varchar(255) NOT NULL,
  `shop_country` int(11) NOT NULL,
  `shop_state` int(11) NOT NULL,
  `shop_city` int(11) NOT NULL,
  `shop_address` text NOT NULL,
  `shop_latitude` float NOT NULL,
  `shop_longitude` float NOT NULL,
  `shop_status` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `shop_name`, `shop_owner`, `shop_number`, `shop_email`, `shop_country`, `shop_state`, `shop_city`, `shop_address`, `shop_latitude`, `shop_longitude`, `shop_status`, `created_date`, `modified_date`) VALUES
(1, 'test12', 'test12', '00000000', 'test12', 1, 2, 1, 'Plot 110, Block G Tariq Garden, Lahore, Pakistan', 31.4199, 74.2535, 1, '2025-05-18 17:46:34', '2025-06-08 23:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` bigint(20) NOT NULL,
  `size_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'S', 1, '2025-06-08 23:15:47', '2025-06-20 20:40:47'),
(2, 'M', 1, '2025-06-08 23:15:47', '2025-06-08 23:15:47'),
(3, 'L', 1, '2025-06-08 23:17:34', '2025-06-08 23:17:34'),
(4, 'XL', 1, '2025-06-08 23:17:34', '2025-06-20 22:04:17'),
(5, 'Standard', 1, '2025-06-23 16:48:15', '2025-06-23 16:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` bigint(20) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_status` int(11) NOT NULL DEFAULT 1,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp(),
  `country_fk` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `state_status`, `created_date`, `modified_date`, `country_fk`) VALUES
(1, 'Blochistan', 1, '2025-05-14 15:52:05', '2025-05-14 15:52:05', 1),
(2, 'Punjab', 1, '2025-05-14 15:53:23', '2025-05-14 15:53:23', 1),
(3, 'Kpk', 1, '2025-05-14 15:53:23', '2025-05-14 15:53:23', 1),
(4, 'Sindh', 1, '2025-05-14 15:54:14', '2025-05-14 15:54:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stocks_id` bigint(20) NOT NULL,
  `brand_fk` bigint(20) DEFAULT NULL,
  `grade_fk` bigint(20) DEFAULT NULL,
  `model_fk` bigint(20) DEFAULT NULL,
  `size_fk` bigint(20) DEFAULT NULL,
  `type_fk` bigint(20) DEFAULT NULL,
  `colour_fk` bigint(20) DEFAULT NULL,
  `unit_fk` bigint(20) DEFAULT NULL,
  `item_fk` bigint(20) NOT NULL,
  `stock_type` enum('opening_balance','stock_addition') NOT NULL,
  `entry_date` date NOT NULL,
  `balance` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stocks_id`, `brand_fk`, `grade_fk`, `model_fk`, `size_fk`, `type_fk`, `colour_fk`, `unit_fk`, `item_fk`, `stock_type`, `entry_date`, `balance`, `created_date`, `modified_date`) VALUES
(26, 0, 0, 0, 0, 0, 0, 0, 10, 'opening_balance', '2025-06-30', 100, '2025-06-30 05:30:00', '2025-06-30 05:30:00'),
(27, 0, 0, 0, 0, 0, 1, 0, 10, 'opening_balance', '2025-07-07', 100, '2025-07-07 20:23:33', '2025-07-07 20:23:33'),
(28, 1, 0, 0, 0, 0, 1, 0, 11, '', '2025-07-08', 100, '2025-07-07 20:27:09', '2025-07-07 20:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `stocks_logs`
--

CREATE TABLE `stocks_logs` (
  `stocks_logs_id` bigint(20) NOT NULL,
  `brand_fk` bigint(20) DEFAULT NULL,
  `grade_fk` bigint(20) DEFAULT NULL,
  `model_fk` bigint(20) DEFAULT NULL,
  `size_fk` bigint(20) DEFAULT NULL,
  `type_fk` bigint(20) DEFAULT NULL,
  `colour_fk` bigint(20) DEFAULT NULL,
  `unit_fk` bigint(20) DEFAULT NULL,
  `item_fk` bigint(20) NOT NULL,
  `stock_type` enum('opening_balance','stock_addition') DEFAULT NULL,
  `entry_date` date NOT NULL,
  `balance` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stocks_logs`
--

INSERT INTO `stocks_logs` (`stocks_logs_id`, `brand_fk`, `grade_fk`, `model_fk`, `size_fk`, `type_fk`, `colour_fk`, `unit_fk`, `item_fk`, `stock_type`, `entry_date`, `balance`, `created_date`, `modified_date`) VALUES
(25, 0, 0, 0, 0, 0, 0, 0, 10, 'opening_balance', '2025-06-30', 100, '2025-06-30 05:30:00', '2025-06-30 05:30:00'),
(26, 0, 0, 0, 0, 0, 1, 0, 10, 'opening_balance', '2025-07-07', 100, '2025-07-07 20:23:33', '2025-07-07 20:23:33'),
(27, 1, 0, 0, 0, 0, 1, 0, 11, '', '2025-07-08', 100, '2025-07-07 20:27:09', '2025-07-07 20:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` bigint(20) NOT NULL,
  `type_title` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_title`, `status`, `created_date`, `modified_date`) VALUES
(1, 'Local', 1, '2025-06-08 23:25:46', '2025-06-08 23:25:46'),
(2, 'Imported', 1, '2025-06-08 23:25:46', '2025-06-08 23:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` bigint(20) NOT NULL,
  `unit_title` varchar(255) NOT NULL,
  `unit_value` enum('1','2','12','*') NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `unit_title`, `unit_value`, `status`, `created_date`, `modified_date`) VALUES
(1, 'PCS', '1', 1, '2025-06-08 23:10:06', '2025-06-08 23:10:06'),
(2, 'BOX', '*', 1, '2025-06-08 23:10:06', '2025-06-08 23:10:06'),
(3, 'DOZEN', '12', 1, '2025-06-08 23:11:12', '2025-06-08 23:11:12'),
(4, 'METER', '*', 1, '2025-06-08 23:11:12', '2025-06-08 23:11:12'),
(5, 'PAIR', '2', 1, '2025-06-08 23:11:41', '2025-06-08 23:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` enum('admin','normal','super_admin') NOT NULL DEFAULT 'normal',
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `gender` int(1) NOT NULL DEFAULT 1,
  `phone` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `passport_no` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `emergency_number` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_date` bigint(20) NOT NULL,
  `modified_date` bigint(20) NOT NULL,
  `random_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `user_name`, `name`, `user_type`, `email`, `password`, `gender`, `phone`, `user_image`, `passport_no`, `blood_group`, `emergency_number`, `designation`, `is_active`, `is_delete`, `created_date`, `modified_date`, `random_id`) VALUES
(1, 'hassansabri', 'Muhammad Hassan Ansari', 'admin', 'hassan@kafaat.me', '21232f297a57a5a743894a0e4a801fc3', 1, '+971528419988', '93811035.jpg', 'd13d24t2123', 'B+', '00971528419988', 'Web Application Developer', 1, 0, 1471718201, 1747578806, '12323341436345'),
(3, 'ReviewerMj', 'Majdi Farhat', 'admin', 'ed@kafaat-inter.com', 'fe60a87d30daa576f94402195f741761', 1, '+971528419988', '', '', '', '', '', 1, 0, 1471718201, 1475559764, 'f3323r2t34t13'),
(4, 'qaisar', 'qaisar', 'admin', 'qaisar@kafaat.me', 'e0afeb835e66d6e6b9548cce6c547ed7', 1, '+971528419988', '73071289.jpg', 'd13d24t2123', 'B+', '00971528419988', 'Web Application Developer', 1, 0, 1471718201, 1485864329, 'f3323r2t34t13'),
(5, 'sadasd', 'ultra_marketing', 'admin', 'hassan.life@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '0323 4391439', '62452867.jpg', '111', 's', '111', 'asdf', 1, 0, 0, 1746458903, ''),
(6, 'cccc', 'hassansabri', 'admin', 'hassan.life@gmail.comm', 'd41d8cd98f00b204e9800998ecf8427e', 1, '0323 4391439', '', '111', 's', '111', 'asdf', 1, 0, 0, 1747124189, '');

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `users_data_id` bigint(20) UNSIGNED NOT NULL,
  `users_type_id` bigint(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`users_data_id`, `users_type_id`, `user_id`, `created_date`) VALUES
(16, 1, 1, 1488627058),
(17, 2, 1, 1488627059),
(18, 3, 1, 1488627060),
(19, 4, 1, 1488627062),
(21, 1, 2, 1497506718),
(22, 2, 2, 1497506718),
(23, 3, 2, 1497506718),
(24, 4, 2, 1497506719),
(25, 2, 3, 1497506837),
(26, 3, 3, 1497506837),
(31, 2, 4, 1498117001),
(35, 2, 6, 1499851598),
(36, 2, 5, 1499851612),
(37, 3, 5, 1499862444),
(38, 3, 6, 1499863444),
(39, 4, 3, 1499936278),
(40, 5, 1, 1500368728),
(41, 1, 7, 1500443291),
(42, 2, 7, 1500443292),
(43, 3, 7, 1500443293),
(44, 4, 7, 1500443295),
(46, 5, 7, 1500650933),
(47, 6, 1, 1500968304),
(48, 7, 1, 1500968305),
(50, 6, 7, 1500968327),
(51, 7, 7, 1500968329),
(52, 6, 3, 1501425667),
(53, 7, 3, 1501425670),
(54, 5, 3, 1501425671),
(56, 9, 7, 1502085438),
(57, 8, 1, 1502085449),
(58, 9, 1, 1502085450),
(59, 9, 8, 1502099155),
(60, 10, 8, 1502099157),
(61, 8, 7, 1502826119),
(62, 10, 9, 1502882084),
(63, 9, 9, 1502882085),
(64, 8, 3, 1505129324),
(65, 9, 3, 1505129325),
(66, 1, 3, 1505129327),
(67, 2, 10, 1507545826),
(69, 2, 11, 1507624467),
(70, 2, 12, 1507799369),
(71, 2, 16, 1507799380),
(72, 2, 15, 1507799388),
(73, 2, 14, 1507799396),
(74, 2, 13, 1507799417),
(75, 8, 10, 1509609754),
(76, 9, 10, 1509609755),
(77, 1, 10, 1509621379);

-- --------------------------------------------------------

--
-- Table structure for table `users_types`
--

CREATE TABLE `users_types` (
  `users_types_id` bigint(20) UNSIGNED NOT NULL,
  `type_title` varchar(255) NOT NULL,
  `created_date` bigint(20) NOT NULL,
  `modified_date` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_types`
--

INSERT INTO `users_types` (`users_types_id`, `type_title`, `created_date`, `modified_date`) VALUES
(1, 'Admin', 1475559764, 1475559764);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`colour_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `items_attributes`
--
ALTER TABLE `items_attributes`
  ADD PRIMARY KEY (`item_attribute_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`payment_option_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`) USING BTREE;

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stocks_id`);

--
-- Indexes for table `stocks_logs`
--
ALTER TABLE `stocks_logs`
  ADD PRIMARY KEY (`stocks_logs_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`users_data_id`);

--
-- Indexes for table `users_types`
--
ALTER TABLE `users_types`
  ADD PRIMARY KEY (`users_types_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `colours`
--
ALTER TABLE `colours`
  MODIFY `colour_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `gender_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grade_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `items_attributes`
--
ALTER TABLE `items_attributes`
  MODIFY `item_attribute_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `model_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `payment_option_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stocks_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stocks_logs`
--
ALTER TABLE `stocks_logs`
  MODIFY `stocks_logs_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `users_data_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `users_types_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
