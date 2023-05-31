-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 09:40 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rdpos`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `acc_created` date NOT NULL,
  `acc_username` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL,
  `acc_fname` varchar(255) NOT NULL,
  `acc_lname` varchar(255) NOT NULL,
  `acc_type` varchar(255) NOT NULL,
  `acc_status` int(11) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_contact` varchar(255) NOT NULL,
  `emp_image` varchar(255) NOT NULL,
  `emp_address` varchar(255) NOT NULL,
  `acc_lastEdit` datetime DEFAULT NULL,
  `Otp` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `acc_created`, `acc_username`, `acc_password`, `acc_fname`, `acc_lname`, `acc_type`, `acc_status`, `acc_email`, `acc_contact`, `emp_image`, `emp_address`, `acc_lastEdit`, `Otp`) VALUES
(16, '2023-06-01', 'admin', 'admin', 'joshua', 'padilla', 'administrator', 1, 'andersonandy895@gmail.com', '09770987020', '2by2.png', 'sta.rosa 2 marilao bulacan', '2023-06-26 07:08:44', ''),
(19, '2023-06-03', 'masterparj', 'masterparj', 'Joshua Anderson', 'Padilla', 'customer', 0, 'masterparj@gmail.com', '09493336125', '336897245_760394325703570_2135528582037243127_n.jpg', 'awd', '2023-06-13 06:06:09', '669741'),
(31, '2023-06-08', 'angela denise', 'angela denise', 'Angela Denise', 'Flores', 'cashier', 0, 'andersonandy046@gmail.com', '09454454744', '95429221_1644556029016308_5940044004929306624_n.jpg', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-11 08:41:45', '833406'),
(33, '2023-06-08', 'padilla', 'padilla', 'joshua', 'padilla', 'delivery person', 0, 'andersonandy123@gmail.com', '09770987020', '', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-26 07:09:52', '0'),
(34, '2023-06-09', 'pnzn.30', 'pnzn.30', 'Julian', 'Pinzon', 'customer', 0, 'julianpinzon@gmail.com', '09205433152', '', 'ysmael sta.rosa 2 marilao bulacan', '2023-06-26 06:22:18', '293724'),
(35, '2023-06-16', 'joan panimbangon', 'joan panimbangon', 'joan', 'panimbangon', 'cashier', 0, 'joanpanimbangon@gmail.com', '09205433152', '', 'Sm city marilao', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cart_prod_id` int(11) NOT NULL,
  `cart_user_id` int(11) NOT NULL,
  `cart_prodQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_prod_id`, `cart_user_id`, `cart_prodQty`) VALUES
(547, 98, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `critical_level` int(11) NOT NULL,
  `category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `critical_level`, `category_status`) VALUES
(1, 'Accessories', 5, 1),
(2, 'Food', 4, 1),
(3, 'Medicines', 4, 1),
(5, 'test', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `discount_name` varchar(255) NOT NULL,
  `discount_rate` float NOT NULL,
  `discount_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `discount_name`, `discount_rate`, `discount_status`) VALUES
(1, 'SUKI CARD', 2, 0),
(2, 'Senior Citizen Card', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `maintinance`
--

CREATE TABLE `maintinance` (
  `system_id` int(11) NOT NULL,
  `system_name` varchar(255) NOT NULL,
  `system_banner` varchar(255) NOT NULL,
  `system_logo` varchar(255) NOT NULL,
  `system_content` varchar(255) NOT NULL,
  `system_address` varchar(255) NOT NULL,
  `system_contact` varchar(255) NOT NULL,
  `system_tax` float NOT NULL,
  `system_shipfee` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintinance`
--

INSERT INTO `maintinance` (`system_id`, `system_name`, `system_banner`, `system_logo`, `system_content`, `system_address`, `system_contact`, `system_tax`, `system_shipfee`) VALUES
(1, 'RDPOS', 'cover.jpg', 'logo.png', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat, error esse, eos necessitatibus saepe temporibus aliquam aperiam quas reiciendis possimus laborum voluptates magni ad. Quam tempore officiis eligendi sed aut!', 'Paso bagbaguin Sta.Maria Bulacan', '0912345678', 0.03, 100);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orders_id` int(11) NOT NULL,
  `order_transaction_code` varchar(8) NOT NULL,
  `orders_prod_id` int(11) NOT NULL,
  `orders_customer_id` int(11) NOT NULL,
  `orders_nickname` varchar(255) NOT NULL,
  `orders_email` varchar(255) NOT NULL,
  `orders_contact` varchar(255) NOT NULL,
  `orders_paymethod` varchar(255) NOT NULL,
  `orders_qty` int(11) NOT NULL,
  `orders_prod_price` double NOT NULL,
  `orders_subtotal` double NOT NULL,
  `orders_ship_fee` double NOT NULL,
  `orders_tax` float NOT NULL,
  `orders_voucher_name` varchar(255) DEFAULT NULL,
  `orders_voucher_rate` varchar(255) DEFAULT NULL,
  `orders_address` varchar(255) NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_dates_delivered` datetime DEFAULT NULL,
  `orders_status` varchar(255) NOT NULL,
  `display_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orders_id`, `order_transaction_code`, `orders_prod_id`, `orders_customer_id`, `orders_nickname`, `orders_email`, `orders_contact`, `orders_paymethod`, `orders_qty`, `orders_prod_price`, `orders_subtotal`, `orders_ship_fee`, `orders_tax`, `orders_voucher_name`, `orders_voucher_rate`, `orders_address`, `orders_date`, `orders_dates_delivered`, `orders_status`, `display_status`) VALUES
(426, 'RD18782', 96, 34, 'julian', 'andyanderson895@yahoo.com', '09205433152', 'Cash on Delivery', 2, 80, 160, 30, 0.03, '', '%', 'ysmael sta.rosa 2 marilao bulacan', '2023-05-24 10:21:00', '2023-05-24 12:03:00', 'Not Delivered', 1),
(427, 'RD18782', 99, 34, 'julian', 'andyanderson895@yahoo.com', '09205433152', 'Cash on Delivery', 1, 46, 46, 30, 0.03, '', '%', 'ysmael sta.rosa 2 marilao bulacan', '2023-05-24 10:21:00', '2023-05-24 12:03:00', 'Not Delivered', 1),
(428, 'RD23439', 98, 34, 'julian', 'andyanderson895@yahoo.com', '09205433152', 'Cash on Delivery', 5, 360, 1800, 30, 0.03, '', '%', 'ysmael sta.rosa 2 marilao bulacan', '2023-06-24 10:22:00', '2023-06-25 02:42:00', 'Complete', 1),
(429, 'RD23439', 99, 34, 'julian', 'andyanderson895@yahoo.com', '09205433152', 'Cash on Delivery', 3, 46, 138, 30, 0.03, '', '%', 'ysmael sta.rosa 2 marilao bulacan', '2023-06-24 10:22:00', '2023-06-25 02:42:00', 'Complete', 1),
(430, 'RD23439', 100, 34, 'julian', 'andyanderson895@yahoo.com', '09205433152', 'Cash on Delivery', 1, 13, 13, 30, 0.03, '', '%', 'ysmael sta.rosa 2 marilao bulacan', '2023-06-24 10:22:00', '2023-06-25 02:42:00', 'Complete', 1),
(437, 'RD84163', 98, 19, 'joshua', 'andyanderson895@yahoo.com', '09493336125', 'Cash on Delivery', 5, 360, 1800, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'sta.rosa 2 marilao bulacan', '2023-06-24 11:34:00', '2023-06-25 02:42:00', 'Complete', 1),
(438, 'RD84163', 99, 19, 'joshua', 'andyanderson895@yahoo.com', '09493336125', 'Cash on Delivery', 3, 46, 138, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'sta.rosa 2 marilao bulacan', '2023-06-24 11:34:00', '2023-06-25 02:42:00', 'Complete', 1),
(439, 'RD35223', 98, 19, 'joshua', 'andyanderson895@yahoo.com', '09493336125', 'Cash on Delivery', 1, 360, 360, 30, 0.03, '75% off', '75%', 'sta.rosa 2 marilao bulacan', '2023-06-24 11:35:00', '2023-06-25 02:42:00', 'Complete', 1),
(440, 'RD97573', 98, 19, 'joshua', 'andersonandy046@gmail.com', '09493336125', 'Cash on Delivery', 5, 360, 1800, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-24 09:02:00', '2023-06-25 02:42:00', 'Complete', 1),
(441, 'RD97573', 100, 19, 'joshua', 'andersonandy046@gmail.com', '09493336125', 'Cash on Delivery', 3, 13, 39, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-24 09:02:00', '2023-06-25 02:42:00', 'Complete', 1),
(442, 'RD97573', 99, 19, 'joshua', 'andersonandy046@gmail.com', '09493336125', 'Cash on Delivery', 1, 46, 46, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-24 09:02:00', '2023-06-25 02:42:00', 'Complete', 1),
(443, 'RD97573', 99, 19, 'joshua', 'andersonandy046@gmail.com', '09493336125', 'Cash on Delivery', 1, 46, 46, 30, 0.03, '5% Voucher Discount untl june 24 2023', '5%', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-24 09:02:00', '2023-06-25 02:42:00', 'Complete', 1),
(444, 'RD11963', 96, 19, 'Sta.Rosa 2 Marilao Bulacan', 'admin@admin', '09493336125', 'Cash on Delivery', 5, 80, 400, 30, 0.03, '', '%', 'Sta.Rosa 2 Marilao Bulacan', '2023-06-24 11:11:00', '2023-06-25 02:32:00', 'Not Delivered', 1),
(457, 'RD57613', 96, 19, 'Joshua Anderson', ' masterparj@gmail.com', '09493336125', 'Cash on Delivery', 1, 80, 80, 100, 0.03, '30% Voucher Discount until july 24 2023', '30%', 'Sta.Rosa 2 Marilao', '2023-06-27 02:04:00', NULL, 'In-Transit', 0),
(458, 'RD57613', 99, 19, 'Joshua Anderson', ' masterparj@gmail.com', '09493336125', 'Cash on Delivery', 1, 46, 46, 100, 0.03, '30% Voucher Discount until july 24 2023', '30%', 'Sta.Rosa 2 Marilao', '2023-06-27 02:04:00', NULL, 'In-Transit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pos_cart`
--

CREATE TABLE `pos_cart` (
  `pos_cart_id` int(11) NOT NULL,
  `pos_cart_prod_id` int(11) NOT NULL,
  `pos_cart_user_id` int(11) NOT NULL,
  `cart_prodQty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_cart`
--

INSERT INTO `pos_cart` (`pos_cart_id`, `pos_cart_prod_id`, `pos_cart_user_id`, `cart_prodQty`) VALUES
(222, 99, 35, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pos_orders`
--

CREATE TABLE `pos_orders` (
  `orders_orders_id` int(11) NOT NULL,
  `orders_tcode` varchar(8) NOT NULL,
  `orders_prod_id` int(11) NOT NULL,
  `orders_cart_id` int(11) NOT NULL,
  `orders_prodQty` int(11) NOT NULL,
  `orders_discount` int(11) DEFAULT NULL,
  `orders_discount_name` varchar(255) DEFAULT NULL,
  `orders_tax` double NOT NULL,
  `orders_date` datetime NOT NULL,
  `orders_final` double NOT NULL,
  `orders_payment` double NOT NULL,
  `orders_change` double NOT NULL,
  `orders_user_id` int(11) NOT NULL,
  `orders_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pos_orders`
--

INSERT INTO `pos_orders` (`orders_orders_id`, `orders_tcode`, `orders_prod_id`, `orders_cart_id`, `orders_prodQty`, `orders_discount`, `orders_discount_name`, `orders_tax`, `orders_date`, `orders_final`, `orders_payment`, `orders_change`, `orders_user_id`, `orders_status`) VALUES
(390, 'RD46875', 99, 239, 5, 0, '', 0.03, '2023-06-24 07:20:00', 236.9, 300, 63.1, 31, 0),
(391, 'RD95746', 96, 240, 3, 0, '', 0.03, '2023-06-26 09:08:00', 341.96, 500, 158.04, 31, 0),
(392, 'RD95746', 99, 241, 2, 0, '', 0.03, '2023-06-26 09:08:00', 341.96, 500, 158.04, 31, 0),
(397, 'RD34199', 99, 244, 3, 0, '', 0.03, '2023-06-26 09:20:00', 1625.34, 2000, 374.66, 31, 0),
(398, 'RD34199', 98, 245, 4, 0, '', 0.03, '2023-06-26 09:20:00', 1625.34, 2000, 374.66, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_code` varchar(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_orgprice` varchar(255) NOT NULL,
  `prod_currprice` varchar(255) NOT NULL,
  `prod_unit_id` int(11) NOT NULL,
  `prod_category_id` int(11) NOT NULL,
  `prod_description` varchar(255) DEFAULT NULL,
  `prod_image` varchar(255) DEFAULT NULL,
  `prod_added` varchar(255) NOT NULL,
  `prod_edit` varchar(255) DEFAULT NULL,
  `prod_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_code`, `prod_name`, `prod_orgprice`, `prod_currprice`, `prod_unit_id`, `prod_category_id`, `prod_description`, `prod_image`, `prod_added`, `prod_edit`, `prod_status`) VALUES
(96, 'PROD20211', 'Bayong-big', '72.00', '80.00', 31, 1, 'Bayong is a Filipino/tagalog term which refers to bags made of woven leaves. Depending on the province, these organic materials include buri, pandan, and abaca, the plant-source of which are native to the Philippines.', 'bayong.jpg', '2023-06-17 5:22:15 PM', '2023-06-27 11:26:06 AM', 0),
(97, 'PROD21395', 'Chewing toy bone -small', '31.50', '35.00', 2, 1, ' Chewing stimulates the chewing muscles and cleans your dog\'s teeth thanks to the structure of a chewing bone.', 'chewing bone.jpg', '2023-06-17 5:36:00 PM', NULL, 1),
(98, 'PROD21387', 'Chicken cage-small', '324.00', '366.00', 31, 1, 'a cage or small enclosure (as for poultry) also : a small building for housing poultry.s', 'chicken cage.jpeg', '2023-06-17 5:40:12 PM', '2023-06-27 11:26:31 AM', 0),
(99, 'PROD66826', 'B-MEG Enertone', '40.00', '46.00', 30, 2, 'Bmeg feeds for hogs & Bmeg integra for free range fowls1', 'bmeg enertone.jpg', '2023-06-17 10:08:52 PM', '2023-06-27 11:26:45 AM', 0),
(100, 'PROD20730', 'AMTYL 500', '11.50', '13', 25, 3, '', '', '2023-06-17 10:13:23 PM', '2023-06-27 11:26:17 AM', 0),
(101, 'PROD12400', 'Ambroxitils', '21.60', '25.00', 24, 3, 'Components: Amoxicillin + Bromhexine + Tylosin Ambroxitil is a water-soluble preparation that contains broad spectrum antibiotics Ambroxicillin and Tylosin. It is fortified with Bromhexine, a mucolytic agent that melts sticky mucus and phlegm adhering on ', '', '2023-06-17 10:14:13 PM', '2023-06-26 11:35:14 AM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `returns_pos`
--

CREATE TABLE `returns_pos` (
  `ret_id` int(11) NOT NULL,
  `ret_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ret_datepurchase` datetime NOT NULL,
  `ret_transaction_code` varchar(8) NOT NULL,
  `ret_product_code` varchar(11) NOT NULL,
  `ret_qty` int(11) NOT NULL,
  `ret_request` varchar(255) NOT NULL,
  `ret_reason` varchar(255) NOT NULL,
  `ret_customer_name` varchar(255) NOT NULL,
  `ret_contact_number` varchar(255) NOT NULL,
  `ret_address` varchar(255) NOT NULL,
  `ret_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `returns_pos`
--

INSERT INTO `returns_pos` (`ret_id`, `ret_date`, `ret_datepurchase`, `ret_transaction_code`, `ret_product_code`, `ret_qty`, `ret_request`, `ret_reason`, `ret_customer_name`, `ret_contact_number`, `ret_address`, `ret_status`) VALUES
(24, '2023-06-20 09:28:59', '2023-06-19 00:00:00', 'RD14244', 'PROD20730', 1, 'Return', 'wrong item', 'Joshua Anderson Padilla', '09454454744', 'Sta.Rosa 2 Marilao Bulacan', 0),
(25, '2023-06-24 11:22:33', '2023-06-24 07:20:00', 'RD46875', 'PROD66826', 5, 'Refund', 'wrong item', 'joshua anderson padilla', '09454454744', 'sta.rosa 2 marilao bulacan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `return_ordering`
--

CREATE TABLE `return_ordering` (
  `ret_ol_id` int(11) NOT NULL,
  `ret_ol_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ret_ol_transaction_code` varchar(8) NOT NULL,
  `ret_ol_product_code` varchar(11) NOT NULL,
  `ret_ol_qty` int(11) NOT NULL,
  `ret_ol_request` varchar(255) NOT NULL,
  `ret_ol_paymethod` varchar(255) NOT NULL,
  `ret_ol_reason` varchar(255) NOT NULL,
  `ret_ol_customer_name` varchar(255) NOT NULL,
  `ret_ol_contact_number` varchar(255) NOT NULL,
  `ret_ol_address` varchar(255) NOT NULL,
  `ret_ol_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `return_ordering`
--

INSERT INTO `return_ordering` (`ret_ol_id`, `ret_ol_date`, `ret_ol_transaction_code`, `ret_ol_product_code`, `ret_ol_qty`, `ret_ol_request`, `ret_ol_paymethod`, `ret_ol_reason`, `ret_ol_customer_name`, `ret_ol_contact_number`, `ret_ol_address`, `ret_ol_status`) VALUES
(3, '2023-06-24 05:51:15', 'RD23439', 'PROD66826', 3, 'Return', '', 'wrong item', 'joshua anderson padilla', '09454454744', 'sta.rosa 2 marilao bulacan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `s_id` int(11) NOT NULL,
  `s_created` date NOT NULL DEFAULT current_timestamp(),
  `s_expiration` date NOT NULL,
  `s_prod_id` int(11) NOT NULL,
  `s_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `s_created`, `s_expiration`, `s_prod_id`, `s_amount`) VALUES
(60, '2023-06-24', '2023-06-24', 101, 50),
(61, '2023-06-24', '0000-00-00', 96, 27),
(62, '2023-06-24', '0000-00-00', 96, 50),
(63, '2023-06-24', '2023-06-24', 100, 2),
(64, '2023-06-24', '0000-00-00', 98, 10),
(65, '2023-06-24', '2023-06-24', 99, 16),
(66, '2023-06-26', '2023-06-26', 100, 2),
(67, '2023-06-26', '2023-06-26', 100, 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `sys_id` int(11) NOT NULL,
  `sys_user_id` int(11) NOT NULL,
  `sys_login` datetime NOT NULL,
  `sys_logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`sys_id`, `sys_user_id`, `sys_login`, `sys_logout`) VALUES
(98, 31, '2023-06-13 04:57:00', '2023-06-26 10:09:00'),
(100, 16, '2023-06-14 08:54:00', NULL),
(101, 31, '2023-06-14 08:55:00', '2023-06-26 10:09:00'),
(102, 16, '2023-06-14 08:56:00', NULL),
(103, 16, '2023-06-15 01:27:00', NULL),
(104, 16, '2023-06-15 02:33:00', NULL),
(105, 16, '2023-06-15 03:37:00', NULL),
(106, 31, '2023-06-15 07:33:00', '2023-06-26 10:09:00'),
(107, 16, '2023-06-15 09:41:00', NULL),
(108, 31, '2023-06-15 09:42:00', '2023-06-26 10:09:00'),
(109, 16, '2023-06-15 09:45:00', NULL),
(110, 16, '2023-06-16 09:33:00', NULL),
(111, 31, '2023-06-16 09:33:00', '2023-06-26 10:09:00'),
(112, 16, '2023-06-16 12:46:00', NULL),
(113, 16, '2023-06-16 07:27:00', NULL),
(114, 16, '2023-06-17 12:15:00', NULL),
(115, 35, '2023-06-17 12:17:00', '2023-06-27 02:18:00'),
(116, 31, '2023-06-17 09:19:00', '2023-06-26 10:09:00'),
(117, 33, '2023-06-17 10:21:00', '2023-06-27 02:41:00'),
(118, 16, '2023-06-17 12:08:00', NULL),
(119, 35, '2023-06-17 04:05:00', '2023-06-27 02:18:00'),
(120, 16, '2023-06-17 05:05:00', NULL),
(121, 16, '2023-06-17 09:10:00', NULL),
(122, 19, '2023-06-17 09:11:00', NULL),
(123, 16, '2023-06-17 10:06:00', NULL),
(124, 31, '2023-06-17 10:10:00', '2023-06-26 10:09:00'),
(125, 16, '2023-06-17 10:40:00', NULL),
(126, 33, '2023-06-18 12:41:00', '2023-06-27 02:41:00'),
(127, 19, '2023-06-18 12:42:00', NULL),
(128, 16, '2023-06-18 03:16:00', NULL),
(129, 16, '2023-06-18 09:25:00', NULL),
(130, 19, '2023-06-18 09:25:00', NULL),
(131, 33, '2023-06-18 01:19:00', '2023-06-27 02:41:00'),
(132, 31, '2023-06-18 06:54:00', '2023-06-26 10:09:00'),
(133, 16, '2023-06-18 06:55:00', NULL),
(134, 35, '2023-06-19 07:54:00', '2023-06-27 02:18:00'),
(135, 16, '2023-06-19 08:58:00', NULL),
(136, 35, '2023-06-19 12:40:00', '2023-06-27 02:18:00'),
(137, 16, '2023-06-19 08:34:00', NULL),
(138, 35, '2023-06-20 01:36:00', '2023-06-27 02:18:00'),
(139, 35, '2023-06-20 01:36:00', '2023-06-27 02:18:00'),
(140, 19, '2023-06-20 06:24:00', NULL),
(141, 16, '2023-06-20 06:25:00', NULL),
(142, 16, '2023-06-20 11:34:00', NULL),
(143, 19, '2023-06-20 11:35:00', NULL),
(144, 16, '2023-06-20 11:35:00', NULL),
(145, 33, '2023-06-20 11:36:00', '2023-06-27 02:41:00'),
(146, 19, '2023-06-21 05:54:00', NULL),
(147, 31, '2023-06-21 05:54:00', '2023-06-26 10:09:00'),
(148, 35, '2023-06-21 06:02:00', '2023-06-27 02:18:00'),
(149, 35, '2023-06-21 06:41:00', '2023-06-27 02:18:00'),
(150, 16, '2023-06-21 08:58:00', NULL),
(151, 35, '2023-06-21 10:09:00', '2023-06-27 02:18:00'),
(152, 19, '2023-06-21 10:09:00', NULL),
(153, 33, '2023-06-21 10:19:00', '2023-06-27 02:41:00'),
(154, 16, '2023-06-21 10:37:00', NULL),
(155, 19, '2023-06-22 06:52:00', NULL),
(156, 19, '2023-06-22 11:25:00', NULL),
(157, 16, '2023-06-23 08:15:00', NULL),
(158, 19, '2023-06-23 08:15:00', NULL),
(159, 33, '2023-06-23 11:56:00', '2023-06-27 02:41:00'),
(160, 34, '2023-06-23 04:53:00', NULL),
(161, 16, '2023-06-24 08:34:00', NULL),
(162, 31, '2023-06-24 08:52:00', '2023-06-26 10:09:00'),
(163, 19, '2023-06-24 08:56:00', NULL),
(164, 31, '2023-06-24 09:09:00', '2023-06-26 10:09:00'),
(165, 31, '2023-06-24 09:09:00', '2023-06-26 10:09:00'),
(166, 33, '2023-06-24 09:32:00', '2023-06-27 02:41:00'),
(167, 19, '2023-06-24 09:33:00', NULL),
(168, 19, '2023-06-24 09:33:00', NULL),
(169, 33, '2023-06-24 09:34:00', '2023-06-27 02:41:00'),
(170, 34, '2023-06-24 09:49:00', NULL),
(171, 16, '2023-06-24 09:54:00', NULL),
(172, 33, '2023-06-24 10:06:00', '2023-06-27 02:41:00'),
(173, 19, '2023-06-24 10:52:00', NULL),
(174, 19, '2023-06-24 11:33:00', NULL),
(175, 16, '2023-06-24 12:04:00', NULL),
(176, 35, '2023-06-24 12:05:00', '2023-06-27 02:18:00'),
(177, 33, '2023-06-24 12:11:00', '2023-06-27 02:41:00'),
(178, 31, '2023-06-24 12:44:00', '2023-06-26 10:09:00'),
(179, 33, '2023-06-24 12:57:00', '2023-06-27 02:41:00'),
(180, 19, '2023-06-24 03:20:00', NULL),
(181, 35, '2023-06-24 03:21:00', '2023-06-27 02:18:00'),
(182, 16, '2023-06-24 03:21:00', NULL),
(183, 16, '2023-06-24 07:14:00', NULL),
(184, 31, '2023-06-24 07:19:00', '2023-06-26 10:09:00'),
(185, 19, '2023-06-24 09:00:00', NULL),
(186, 33, '2023-06-24 09:02:00', '2023-06-27 02:41:00'),
(187, 19, '2023-06-25 08:52:00', NULL),
(188, 19, '2023-06-25 10:14:00', NULL),
(189, 19, '2023-06-25 11:39:00', NULL),
(190, 16, '2023-06-25 11:43:00', NULL),
(191, 33, '2023-06-25 02:32:00', '2023-06-27 02:41:00'),
(192, 19, '2023-06-25 03:09:00', NULL),
(193, 16, '2023-06-25 04:24:00', NULL),
(194, 16, '2023-06-25 09:10:00', NULL),
(195, 16, '2023-06-26 08:13:00', NULL),
(196, 31, '2023-06-26 09:08:00', '2023-06-26 10:09:00'),
(197, 33, '2023-06-26 10:10:00', '2023-06-27 02:41:00'),
(198, 19, '2023-06-26 10:10:00', NULL),
(199, 34, '2023-06-26 10:19:00', NULL),
(200, 16, '2023-06-26 10:49:00', NULL),
(201, 16, '2023-06-26 10:51:00', NULL),
(202, 16, '2023-06-26 10:51:00', NULL),
(203, 16, '2023-06-26 01:13:00', NULL),
(204, 16, '2023-06-27 08:15:00', NULL),
(205, 16, '2023-06-27 08:15:00', NULL),
(206, 16, '2023-06-27 08:16:00', NULL),
(207, 16, '2023-06-27 08:16:00', NULL),
(208, 19, '2023-06-27 01:59:00', NULL),
(209, 33, '2023-06-27 02:05:00', '2023-06-27 02:41:00'),
(210, 19, '2023-06-27 02:17:00', NULL),
(211, 35, '2023-06-27 02:17:00', '2023-06-27 02:18:00'),
(212, 16, '2023-06-27 02:18:00', NULL),
(213, 16, '2023-06-27 02:41:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `unit_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_status`) VALUES
(17, 'Sacks', 1),
(24, 'sach', 1),
(25, 'tab', 1),
(26, 'CAPS', 1),
(27, 'vial', 1),
(30, 'kg', 1),
(31, 'pcs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_log`
--

CREATE TABLE `users_log` (
  `act_id` int(11) NOT NULL,
  `act_account_id` int(11) NOT NULL,
  `act_activity` varchar(255) DEFAULT NULL,
  `act_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_log`
--

INSERT INTO `users_log` (`act_id`, `act_account_id`, `act_activity`, `act_date`) VALUES
(491, 33, 'DELIVER TRANSACTION ID:RD57613 ', '2023-06-27 02:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_discount` float NOT NULL,
  `voucher_created` datetime NOT NULL,
  `voucher_expiration` datetime NOT NULL,
  `voucher_maximumLimit` int(11) NOT NULL,
  `voucher_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`voucher_id`, `voucher_name`, `voucher_discount`, `voucher_created`, `voucher_expiration`, `voucher_maximumLimit`, `voucher_status`) VALUES
(2, '30% Voucher Discount until july 24 2023', 30, '2023-06-22 17:27:17', '2023-07-24 00:00:00', 9, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `maintinance`
--
ALTER TABLE `maintinance`
  ADD PRIMARY KEY (`system_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `pos_cart`
--
ALTER TABLE `pos_cart`
  ADD PRIMARY KEY (`pos_cart_id`);

--
-- Indexes for table `pos_orders`
--
ALTER TABLE `pos_orders`
  ADD PRIMARY KEY (`orders_orders_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `returns_pos`
--
ALTER TABLE `returns_pos`
  ADD PRIMARY KEY (`ret_id`);

--
-- Indexes for table `return_ordering`
--
ALTER TABLE `return_ordering`
  ADD PRIMARY KEY (`ret_ol_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users_log`
--
ALTER TABLE `users_log`
  ADD PRIMARY KEY (`act_id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=548;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `maintinance`
--
ALTER TABLE `maintinance`
  MODIFY `system_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=459;

--
-- AUTO_INCREMENT for table `pos_cart`
--
ALTER TABLE `pos_cart`
  MODIFY `pos_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `pos_orders`
--
ALTER TABLE `pos_orders`
  MODIFY `orders_orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=399;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `returns_pos`
--
ALTER TABLE `returns_pos`
  MODIFY `ret_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `return_ordering`
--
ALTER TABLE `return_ordering`
  MODIFY `ret_ol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `sys_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users_log`
--
ALTER TABLE `users_log`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
