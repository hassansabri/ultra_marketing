-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2025 at 11:12 AM
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
(1, 'Sprinter', 1, '2025-06-08 23:38:17', '2025-07-04 01:06:25');

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
(1, 'Auto Parts', 0, 1, '2025-06-04 14:07:02', '2025-06-04 15:38:01');

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
(3, 'Black', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30'),
(4, 'White', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30'),
(5, 'Yellow', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30'),
(6, 'Brown', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30'),
(7, 'Green', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30'),
(8, 'Orange', 1, '2025-06-21 07:03:40', '2025-06-21 04:04:30');

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
(10, 'Sprocket panels', NULL, 1, '0', 'asdf', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '2025-07-23', 1, '2025-06-09 00:23:21', '2025-06-08 23:15:14'),
(11, 'Clutch Outer', NULL, 1, '0', 'asdf', NULL, 0, '10 gram', NULL, NULL, NULL, 1, 0, '2025-07-02', 1, '2025-07-02 19:31:08', '2025-07-02 16:31:14'),
(12, 'Plug Cap', NULL, 1, '0', 'asdf', NULL, 0, '10 gram', NULL, NULL, NULL, 1, 0, '2025-07-16', 1, '2025-07-16 04:45:35', '2025-07-16 01:45:40'),
(13, 'Kick', NULL, 1, '0', 'asdf', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '1970-01-01', 1, '2025-07-23 23:08:37', '2025-07-23 20:08:41'),
(14, 'Clutch Wire', NULL, 1, '0', 'asdf', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '2025-07-23', 1, '2025-07-23 23:10:05', '2025-07-23 20:12:02'),
(15, 'Footrests', NULL, 1, '0', 'asdf', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '2025-07-23', 1, '2025-07-23 23:11:56', '2025-07-23 20:12:04'),
(16, 'Back Wheel Drum', NULL, 1, '0', 'asdf', NULL, 0, '10 grams', NULL, NULL, NULL, 1, 0, '2025-07-23', 1, '2025-07-23 23:13:41', '2025-07-23 20:13:45');

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
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `module_id` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `module_display_name` varchar(100) NOT NULL,
  `module_description` text DEFAULT NULL,
  `module_icon` varchar(50) DEFAULT 'fa-cube',
  `module_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`module_id`, `module_name`, `module_display_name`, `module_description`, `module_icon`, `module_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'dashboard', 'Dashboard', 'Main dashboard and overview', 'fa-tachometer-alt', 1, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(2, 'users', 'User Management', 'Manage system users and accounts', 'fa-users', 2, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(3, 'orders', 'Order Management', 'Manage orders and invoices', 'fa-shopping-cart', 3, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(4, 'items', 'Item Management', 'Manage products and items', 'fa-box', 4, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(5, 'categories', 'Category Management', 'Manage product categories', 'fa-tags', 5, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(6, 'brands', 'Brand Management', 'Manage product brands', 'fa-trademark', 6, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(7, 'shops', 'Shop Management', 'Manage shops and locations', 'fa-store', 7, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(8, 'stocks', 'Stock Management', 'Manage inventory and stock levels', 'fa-warehouse', 8, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(9, 'reports', 'Reports & Analytics', 'View reports and analytics', 'fa-chart-bar', 9, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(10, 'ledger', 'Ledger Management', 'Manage financial ledgers', 'fa-book', 10, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(11, 'settings', 'System Settings', 'System configuration and settings', 'fa-cog', 11, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28'),
(12, 'profile', 'Profile Management', 'User profile and preferences', 'fa-user', 12, 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) NOT NULL,
  `order_number` bigint(20) NOT NULL,
  `item_fk` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `order_quantity` int(11) DEFAULT NULL,
  `order_price` int(11) DEFAULT NULL,
  `order_status` enum('draft','confirm') NOT NULL DEFAULT 'draft',
  `created_by` bigint(20) NOT NULL,
  `confirm_by` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `item_fk`, `shop_id`, `order_quantity`, `order_price`, `order_status`, `created_by`, `confirm_by`, `created_date`, `modified_date`) VALUES
(108, 4157, 10, 1, 1, 1, 'confirm', 5, 5, '2025-07-23 18:28:03', '2025-07-23 18:28:03'),
(109, 2644, 10, 1, 2, 0, 'confirm', 5, 5, '2025-07-24 04:10:22', '2025-07-24 03:42:43'),
(110, 227, 10, 1, 1, 0, 'confirm', 5, 5, '2025-07-24 04:43:09', '2025-07-24 02:07:06'),
(111, 2644, 11, 1, 1, 0, 'confirm', 5, 5, '2025-07-24 06:42:43', '2025-07-24 03:42:43');

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

-- --------------------------------------------------------

--
-- Table structure for table `order_ledger`
--

CREATE TABLE `order_ledger` (
  `ledger_id` bigint(20) NOT NULL,
  `order_number` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `type` enum('debit','credit') NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_ledger`
--

INSERT INTO `order_ledger` (`ledger_id`, `order_number`, `date`, `amount`, `payment_method`, `type`, `shop_id`, `remarks`) VALUES
(5, 4157, '2025-07-20 11:11:00', 1.00, 'Cash', 'debit', 1, 'aaaaaaaaaa'),
(6, 4157, '2025-07-23 00:00:00', 1.00, 'Cash', 'credit', 1, 'aaaa');

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
(2, 'Cash', 1, '2025-06-27 23:17:38', '2025-06-27 23:17:38'),
(3, 'Bank Transfer', 1, '2025-06-27 23:17:38', '2025-06-27 23:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL,
  `permission_display_name` varchar(100) NOT NULL,
  `permission_description` text DEFAULT NULL,
  `permission_type` enum('view','create','edit','delete','export','import','approve','reject','print') DEFAULT 'view',
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `module_id`, `permission_name`, `permission_display_name`, `permission_description`, `permission_type`, `is_active`, `created_at`, `updated_at`, `created_by`) VALUES
(60, 1, 'dashboard_view', 'View Dashboard', 'Access to view dashboard and overview', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(61, 1, 'dashboard_export', 'Export Dashboard Data', 'Export dashboard reports and data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(62, 2, 'users_view', 'View Users', 'View list of all users', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(63, 2, 'users_create', 'Create Users', 'Create new user accounts', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(64, 2, 'users_edit', 'Edit Users', 'Edit existing user accounts', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(65, 2, 'users_delete', 'Delete Users', 'Delete user accounts', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(66, 2, 'users_export', 'Export Users', 'Export user data to file', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(67, 2, 'users_import', 'Import Users', 'Import users from file', 'import', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(68, 3, 'orders_view', 'View Orders', 'View all orders', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(69, 3, 'orders_create', 'Create Orders', 'Create new orders', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(70, 3, 'orders_edit', 'Edit Orders', 'Edit existing orders', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(71, 3, 'orders_delete', 'Delete Orders', 'Delete orders', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(72, 3, 'orders_approve', 'Approve Orders', 'Approve pending orders', 'approve', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(73, 3, 'orders_reject', 'Reject Orders', 'Reject orders', 'reject', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(74, 3, 'orders_export', 'Export Orders', 'Export order data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(75, 3, 'orders_print', 'Print Orders', 'Print order invoices', 'print', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(76, 4, 'items_view', 'View Items', 'View all items/products', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(77, 4, 'items_create', 'Create Items', 'Create new items/products', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(78, 4, 'items_edit', 'Edit Items', 'Edit existing items/products', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(79, 4, 'items_delete', 'Delete Items', 'Delete items/products', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(80, 4, 'items_export', 'Export Items', 'Export item data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(81, 4, 'items_import', 'Import Items', 'Import items from file', 'import', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(82, 5, 'categories_view', 'View Categories', 'View all categories', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(83, 5, 'categories_create', 'Create Categories', 'Create new categories', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(84, 5, 'categories_edit', 'Edit Categories', 'Edit existing categories', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(85, 5, 'categories_delete', 'Delete Categories', 'Delete categories', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(86, 5, 'categories_export', 'Export Categories', 'Export category data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(87, 6, 'brands_view', 'View Brands', 'View all brands', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(88, 6, 'brands_create', 'Create Brands', 'Create new brands', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(89, 6, 'brands_edit', 'Edit Brands', 'Edit existing brands', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(90, 6, 'brands_delete', 'Delete Brands', 'Delete brands', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(91, 6, 'brands_export', 'Export Brands', 'Export brand data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(92, 7, 'shops_view', 'View Shops', 'View all shops', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(93, 7, 'shops_create', 'Create Shops', 'Create new shops', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(94, 7, 'shops_edit', 'Edit Shops', 'Edit existing shops', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(95, 7, 'shops_delete', 'Delete Shops', 'Delete shops', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(96, 7, 'shops_export', 'Export Shops', 'Export shop data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(97, 8, 'stocks_view', 'View Stocks', 'View stock levels', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(98, 8, 'stocks_create', 'Create Stock Entries', 'Create new stock entries', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(99, 8, 'stocks_edit', 'Edit Stocks', 'Edit stock levels', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(100, 8, 'stocks_delete', 'Delete Stock Entries', 'Delete stock entries', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(101, 8, 'stocks_export', 'Export Stocks', 'Export stock data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(102, 8, 'stocks_import', 'Import Stocks', 'Import stock data', 'import', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(103, 9, 'reports_view', 'View Reports', 'Access to view reports', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(104, 9, 'reports_export', 'Export Reports', 'Export report data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(105, 9, 'reports_print', 'Print Reports', 'Print reports', 'print', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(106, 10, 'ledger_view', 'View Ledger', 'View ledger entries', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(107, 10, 'ledger_create', 'Create Ledger Entries', 'Create new ledger entries', 'create', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(108, 10, 'ledger_edit', 'Edit Ledger', 'Edit ledger entries', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(109, 10, 'ledger_delete', 'Delete Ledger Entries', 'Delete ledger entries', 'delete', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(110, 10, 'ledger_export', 'Export Ledger', 'Export ledger data', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(111, 10, 'ledger_print', 'Print Ledger', 'Print ledger reports', 'print', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(112, 11, 'settings_view', 'View Settings', 'View system settings', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(113, 11, 'settings_edit', 'Edit Settings', 'Edit system settings', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(114, 11, 'settings_export', 'Export Settings', 'Export system configuration', 'export', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(115, 12, 'profile_view', 'View Profile', 'View own profile', 'view', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(116, 12, 'profile_edit', 'Edit Profile', 'Edit own profile', 'edit', 1, '2025-07-20 02:23:28', '2025-07-20 02:23:28', 0),
(148, 2, 'user', 'user', 'user', 'view', 1, '2025-07-21 14:16:51', '2025-07-21 17:16:51', 5),
(149, 2, 'user_view', 'user', 'user', 'view', 1, '2025-07-22 11:26:06', '2025-07-22 14:26:06', 5);

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
  `logo` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  `adress` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `shop_name`, `name`, `email`, `phone`, `logo`, `status`, `adress`, `created_date`, `modified_date`) VALUES
(1, 'Ajman Traders', 'Muhammad Nadeem', 'tipulahore@gmail.com', '03114774666', '66881847.jpg', 1, 'Eros complex marston road karachi', '2025-06-27 23:32:13', '2025-07-25 19:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `role_description` text DEFAULT NULL,
  `role_color` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_by` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `role_description`, `role_color`, `is_active`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Full system access with all permissions', NULL, 1, 0, '2025-07-20 02:18:40', '2025-07-20 02:18:40'),
(2, 'Admin', 'Administrative access with most permissions', NULL, 0, 0, '2025-07-20 02:18:40', '2025-07-20 11:33:09'),
(3, 'Manager', 'Management level access with limited administrative permissions', NULL, 0, 0, '2025-07-20 02:18:40', '2025-07-20 12:01:19'),
(4, 'User', 'Standard user access with basic permissions', NULL, 1, 0, '2025-07-20 02:18:40', '2025-07-20 02:18:40'),
(5, 'Viewer', 'Read-only access to view data only', NULL, 1, 0, '2025-07-20 02:18:40', '2025-07-20 02:18:40'),
(7, 'cus', 'custom asdasdasd', NULL, 1, 5, '2025-07-22 15:58:22', '2025-07-22 18:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `granted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `granted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`role_permission_id`, `role_id`, `permission_id`, `granted_at`, `granted_by`) VALUES
(1, 1, 61, '2025-07-20 02:23:28', NULL),
(2, 1, 60, '2025-07-20 02:23:28', NULL),
(3, 1, 63, '2025-07-20 02:23:28', NULL),
(4, 1, 65, '2025-07-20 02:23:28', NULL),
(5, 1, 64, '2025-07-20 02:23:28', NULL),
(6, 1, 66, '2025-07-20 02:23:28', NULL),
(7, 1, 67, '2025-07-20 02:23:28', NULL),
(8, 1, 62, '2025-07-20 02:23:28', NULL),
(9, 1, 72, '2025-07-20 02:23:28', NULL),
(10, 1, 69, '2025-07-20 02:23:28', NULL),
(11, 1, 71, '2025-07-20 02:23:28', NULL),
(12, 1, 70, '2025-07-20 02:23:28', NULL),
(13, 1, 74, '2025-07-20 02:23:28', NULL),
(14, 1, 75, '2025-07-20 02:23:28', NULL),
(15, 1, 73, '2025-07-20 02:23:28', NULL),
(16, 1, 68, '2025-07-20 02:23:28', NULL),
(17, 1, 77, '2025-07-20 02:23:28', NULL),
(18, 1, 79, '2025-07-20 02:23:28', NULL),
(19, 1, 78, '2025-07-20 02:23:28', NULL),
(20, 1, 80, '2025-07-20 02:23:28', NULL),
(21, 1, 81, '2025-07-20 02:23:28', NULL),
(22, 1, 76, '2025-07-20 02:23:28', NULL),
(23, 1, 83, '2025-07-20 02:23:28', NULL),
(24, 1, 85, '2025-07-20 02:23:28', NULL),
(25, 1, 84, '2025-07-20 02:23:28', NULL),
(26, 1, 86, '2025-07-20 02:23:28', NULL),
(27, 1, 82, '2025-07-20 02:23:28', NULL),
(28, 1, 88, '2025-07-20 02:23:28', NULL),
(29, 1, 90, '2025-07-20 02:23:28', NULL),
(30, 1, 89, '2025-07-20 02:23:28', NULL),
(31, 1, 91, '2025-07-20 02:23:28', NULL),
(32, 1, 87, '2025-07-20 02:23:28', NULL),
(33, 1, 93, '2025-07-20 02:23:28', NULL),
(34, 1, 95, '2025-07-20 02:23:28', NULL),
(35, 1, 94, '2025-07-20 02:23:28', NULL),
(36, 1, 96, '2025-07-20 02:23:28', NULL),
(37, 1, 92, '2025-07-20 02:23:28', NULL),
(38, 1, 98, '2025-07-20 02:23:28', NULL),
(39, 1, 100, '2025-07-20 02:23:28', NULL),
(40, 1, 99, '2025-07-20 02:23:28', NULL),
(41, 1, 101, '2025-07-20 02:23:28', NULL),
(42, 1, 102, '2025-07-20 02:23:28', NULL),
(43, 1, 97, '2025-07-20 02:23:28', NULL),
(44, 1, 104, '2025-07-20 02:23:28', NULL),
(45, 1, 105, '2025-07-20 02:23:28', NULL),
(46, 1, 103, '2025-07-20 02:23:28', NULL),
(47, 1, 107, '2025-07-20 02:23:28', NULL),
(48, 1, 109, '2025-07-20 02:23:28', NULL),
(49, 1, 108, '2025-07-20 02:23:28', NULL),
(50, 1, 110, '2025-07-20 02:23:28', NULL),
(51, 1, 111, '2025-07-20 02:23:28', NULL),
(52, 1, 106, '2025-07-20 02:23:28', NULL),
(53, 1, 113, '2025-07-20 02:23:28', NULL),
(54, 1, 114, '2025-07-20 02:23:28', NULL),
(55, 1, 112, '2025-07-20 02:23:28', NULL),
(56, 1, 116, '2025-07-20 02:23:28', NULL),
(57, 1, 115, '2025-07-20 02:23:28', NULL),
(64, 2, 61, '2025-07-20 02:23:28', NULL),
(65, 2, 60, '2025-07-20 02:23:28', NULL),
(66, 2, 63, '2025-07-20 02:23:28', NULL),
(67, 2, 64, '2025-07-20 02:23:28', NULL),
(68, 2, 66, '2025-07-20 02:23:28', NULL),
(69, 2, 67, '2025-07-20 02:23:28', NULL),
(70, 2, 62, '2025-07-20 02:23:28', NULL),
(71, 2, 72, '2025-07-20 02:23:28', NULL),
(72, 2, 69, '2025-07-20 02:23:28', NULL),
(73, 2, 71, '2025-07-20 02:23:28', NULL),
(74, 2, 70, '2025-07-20 02:23:28', NULL),
(75, 2, 74, '2025-07-20 02:23:28', NULL),
(76, 2, 75, '2025-07-20 02:23:28', NULL),
(77, 2, 73, '2025-07-20 02:23:28', NULL),
(78, 2, 68, '2025-07-20 02:23:28', NULL),
(79, 2, 77, '2025-07-20 02:23:28', NULL),
(80, 2, 79, '2025-07-20 02:23:28', NULL),
(81, 2, 78, '2025-07-20 02:23:28', NULL),
(82, 2, 80, '2025-07-20 02:23:28', NULL),
(83, 2, 81, '2025-07-20 02:23:28', NULL),
(84, 2, 76, '2025-07-20 02:23:28', NULL),
(85, 2, 83, '2025-07-20 02:23:28', NULL),
(86, 2, 85, '2025-07-20 02:23:28', NULL),
(87, 2, 84, '2025-07-20 02:23:28', NULL),
(88, 2, 86, '2025-07-20 02:23:28', NULL),
(89, 2, 82, '2025-07-20 02:23:28', NULL),
(90, 2, 88, '2025-07-20 02:23:28', NULL),
(91, 2, 90, '2025-07-20 02:23:28', NULL),
(92, 2, 89, '2025-07-20 02:23:28', NULL),
(93, 2, 91, '2025-07-20 02:23:28', NULL),
(94, 2, 87, '2025-07-20 02:23:28', NULL),
(95, 2, 93, '2025-07-20 02:23:28', NULL),
(96, 2, 95, '2025-07-20 02:23:28', NULL),
(97, 2, 94, '2025-07-20 02:23:28', NULL),
(98, 2, 96, '2025-07-20 02:23:28', NULL),
(99, 2, 92, '2025-07-20 02:23:28', NULL),
(100, 2, 98, '2025-07-20 02:23:28', NULL),
(101, 2, 100, '2025-07-20 02:23:28', NULL),
(102, 2, 99, '2025-07-20 02:23:28', NULL),
(103, 2, 101, '2025-07-20 02:23:28', NULL),
(104, 2, 102, '2025-07-20 02:23:28', NULL),
(105, 2, 97, '2025-07-20 02:23:28', NULL),
(106, 2, 104, '2025-07-20 02:23:28', NULL),
(107, 2, 105, '2025-07-20 02:23:28', NULL),
(108, 2, 103, '2025-07-20 02:23:28', NULL),
(109, 2, 107, '2025-07-20 02:23:28', NULL),
(110, 2, 109, '2025-07-20 02:23:28', NULL),
(111, 2, 108, '2025-07-20 02:23:28', NULL),
(112, 2, 110, '2025-07-20 02:23:28', NULL),
(113, 2, 111, '2025-07-20 02:23:28', NULL),
(114, 2, 106, '2025-07-20 02:23:28', NULL),
(115, 2, 114, '2025-07-20 02:23:28', NULL),
(116, 2, 112, '2025-07-20 02:23:28', NULL),
(117, 2, 116, '2025-07-20 02:23:28', NULL),
(118, 2, 115, '2025-07-20 02:23:28', NULL),
(127, 3, 60, '2025-07-20 02:23:28', NULL),
(128, 3, 61, '2025-07-20 02:23:28', NULL),
(129, 3, 62, '2025-07-20 02:23:28', NULL),
(130, 3, 64, '2025-07-20 02:23:28', NULL),
(131, 3, 66, '2025-07-20 02:23:28', NULL),
(132, 3, 68, '2025-07-20 02:23:28', NULL),
(133, 3, 69, '2025-07-20 02:23:28', NULL),
(134, 3, 70, '2025-07-20 02:23:28', NULL),
(135, 3, 74, '2025-07-20 02:23:28', NULL),
(136, 3, 75, '2025-07-20 02:23:28', NULL),
(137, 3, 76, '2025-07-20 02:23:28', NULL),
(138, 3, 77, '2025-07-20 02:23:28', NULL),
(139, 3, 78, '2025-07-20 02:23:28', NULL),
(140, 3, 80, '2025-07-20 02:23:28', NULL),
(141, 3, 82, '2025-07-20 02:23:28', NULL),
(142, 3, 83, '2025-07-20 02:23:28', NULL),
(143, 3, 84, '2025-07-20 02:23:28', NULL),
(144, 3, 86, '2025-07-20 02:23:28', NULL),
(145, 3, 87, '2025-07-20 02:23:28', NULL),
(146, 3, 88, '2025-07-20 02:23:28', NULL),
(147, 3, 89, '2025-07-20 02:23:28', NULL),
(148, 3, 91, '2025-07-20 02:23:28', NULL),
(149, 3, 92, '2025-07-20 02:23:28', NULL),
(150, 3, 93, '2025-07-20 02:23:28', NULL),
(151, 3, 94, '2025-07-20 02:23:28', NULL),
(152, 3, 96, '2025-07-20 02:23:28', NULL),
(153, 3, 97, '2025-07-20 02:23:28', NULL),
(154, 3, 98, '2025-07-20 02:23:28', NULL),
(155, 3, 99, '2025-07-20 02:23:28', NULL),
(156, 3, 101, '2025-07-20 02:23:28', NULL),
(157, 3, 103, '2025-07-20 02:23:28', NULL),
(158, 3, 104, '2025-07-20 02:23:28', NULL),
(159, 3, 105, '2025-07-20 02:23:28', NULL),
(160, 3, 106, '2025-07-20 02:23:28', NULL),
(161, 3, 107, '2025-07-20 02:23:28', NULL),
(162, 3, 108, '2025-07-20 02:23:28', NULL),
(163, 3, 110, '2025-07-20 02:23:28', NULL),
(164, 3, 111, '2025-07-20 02:23:28', NULL),
(165, 3, 112, '2025-07-20 02:23:28', NULL),
(166, 3, 114, '2025-07-20 02:23:28', NULL),
(167, 3, 115, '2025-07-20 02:23:28', NULL),
(168, 3, 116, '2025-07-20 02:23:28', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `role_permissions_summary`
-- (See below for the actual view)
--
CREATE TABLE `role_permissions_summary` (
`role_name` varchar(100)
,`module_display_name` varchar(100)
,`permission_count` bigint(21)
,`permission_types` mediumtext
);

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
(35, 0, 0, 0, 0, 0, 0, 0, 11, 'opening_balance', '2025-07-30', 200, '2025-07-30 00:05:51', '2025-07-30 00:05:51');

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
(57, 0, 0, 0, 0, 0, 0, 0, 11, 'opening_balance', '2025-07-30', 100, '2025-07-30 00:05:51', '2025-07-30 00:05:51'),
(58, 0, 0, 0, 0, 0, 0, 0, 11, 'stock_addition', '2025-07-30', 100, '2025-07-30 00:06:39', '2025-07-30 00:06:39');

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
(5, 'Hassan', 'Ultra Marketing', 'admin', 'hassan.life@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '03234391439', '65882836.jpg', '111', 's', '111', 'asdf', 1, 0, 0, 1753788188, ''),
(7, 'Muhammad Nadeem', 'Ultra Marketing', 'admin', 'tipulahore@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 1, '03114774666', '62452867.jpg', '111', 's', '111', 'asdf', 1, 0, 0, 1746458903, '');

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
(77, 1, 10, 1509621379),
(78, 1, 5, 1752980169);

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

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_permissions_view`
-- (See below for the actual view)
--
CREATE TABLE `user_permissions_view` (
`users_id` bigint(20) unsigned
,`user_name` varchar(255)
,`role_name` varchar(100)
,`module_name` varchar(100)
,`module_display_name` varchar(100)
,`permission_name` varchar(100)
,`permission_display_name` varchar(100)
,`permission_type` enum('view','create','edit','delete','export','import','approve','reject','print')
,`is_active` tinyint(1)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `assigned_by` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `users_id`, `role_id`, `assigned_at`, `assigned_by`, `is_active`) VALUES
(1, 5, 1, '2025-07-22 14:52:11', 5, 1),
(6, 7, 1, '2025-07-29 12:37:34', 5, 1);

-- --------------------------------------------------------

--
-- Structure for view `role_permissions_summary`
--
DROP TABLE IF EXISTS `role_permissions_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `role_permissions_summary`  AS SELECT `r`.`role_name` AS `role_name`, `m`.`module_display_name` AS `module_display_name`, count(`p`.`permission_id`) AS `permission_count`, group_concat(`p`.`permission_type` separator ',') AS `permission_types` FROM (((`roles` `r` join `role_permissions` `rp` on(`r`.`role_id` = `rp`.`role_id`)) join `permissions` `p` on(`rp`.`permission_id` = `p`.`permission_id`)) join `modules` `m` on(`p`.`module_id` = `m`.`module_id`)) WHERE `r`.`is_active` = 1 AND `p`.`is_active` = 1 AND `m`.`is_active` = 1 GROUP BY `r`.`role_id`, `m`.`module_id` ORDER BY `r`.`role_name` ASC, `m`.`module_order` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `user_permissions_view`
--
DROP TABLE IF EXISTS `user_permissions_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_permissions_view`  AS SELECT DISTINCT `u`.`users_id` AS `users_id`, `u`.`user_name` AS `user_name`, `r`.`role_name` AS `role_name`, `m`.`module_name` AS `module_name`, `m`.`module_display_name` AS `module_display_name`, `p`.`permission_name` AS `permission_name`, `p`.`permission_display_name` AS `permission_display_name`, `p`.`permission_type` AS `permission_type`, `p`.`is_active` AS `is_active` FROM (((((`users` `u` join `user_roles` `ur` on(`u`.`users_id` = `ur`.`users_id`)) join `roles` `r` on(`ur`.`role_id` = `r`.`role_id`)) join `role_permissions` `rp` on(`r`.`role_id` = `rp`.`role_id`)) join `permissions` `p` on(`rp`.`permission_id` = `p`.`permission_id`)) join `modules` `m` on(`p`.`module_id` = `m`.`module_id`)) WHERE `ur`.`is_active` = 1 AND `r`.`is_active` = 1 AND `p`.`is_active` = 1 AND `m`.`is_active` = 1 ;

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
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `module_name` (`module_name`),
  ADD KEY `idx_modules_active` (`is_active`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`) USING BTREE;

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `order_ledger`
--
ALTER TABLE `order_ledger`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `payment_options`
--
ALTER TABLE `payment_options`
  ADD PRIMARY KEY (`payment_option_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`),
  ADD UNIQUE KEY `module_permission` (`module_id`,`permission_name`),
  ADD KEY `idx_permissions_module` (`module_id`),
  ADD KEY `idx_permissions_type` (`permission_type`),
  ADD KEY `idx_permissions_active` (`is_active`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`),
  ADD KEY `idx_roles_active` (`is_active`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_permission_id`),
  ADD UNIQUE KEY `role_permission_unique` (`role_id`,`permission_id`),
  ADD KEY `idx_role_permissions_role` (`role_id`),
  ADD KEY `idx_role_permissions_permission` (`permission_id`);

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
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`),
  ADD UNIQUE KEY `user_role_unique` (`users_id`,`role_id`),
  ADD KEY `idx_user_roles_user` (`users_id`),
  ADD KEY `idx_user_roles_role` (`role_id`);

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
  MODIFY `colour_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `item_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `items_attributes`
--
ALTER TABLE `items_attributes`
  MODIFY `item_attribute_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `order_ledger`
--
ALTER TABLE `order_ledger`
  MODIFY `ledger_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_options`
--
ALTER TABLE `payment_options`
  MODIFY `payment_option_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `role_permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

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
  MODIFY `stocks_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stocks_logs`
--
ALTER TABLE `stocks_logs`
  MODIFY `stocks_logs_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  MODIFY `users_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `users_data_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users_types`
--
ALTER TABLE `users_types`
  MODIFY `users_types_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`module_id`) ON DELETE CASCADE;

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`permission_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
