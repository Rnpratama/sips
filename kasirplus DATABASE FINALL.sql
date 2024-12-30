-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 06:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasirplus`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `gender`, `phone`, `address`, `created`, `updated`) VALUES
(1, 'Jhosua', 'L', '0852364125', 'Selokan Mataram', '2024-11-11 16:07:06', '0000-00-00 00:00:00'),
(2, 'Elis Tikasni', 'P', '082563256', 'Maguwoharjo', '2024-11-13 23:33:21', '0000-00-00 00:00:00'),
(4, 'Umum', '', '', '', '2024-12-22 01:06:19', '2024-12-21 19:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `p_category`
--

CREATE TABLE `p_category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_category`
--

INSERT INTO `p_category` (`category_id`, `name`, `created`, `updated`, `user_id`) VALUES
(1, 'Makanan', '2024-12-11 21:03:18', NULL, 1),
(8, 'Minuman', '2024-12-12 08:51:26', NULL, 1),
(9, 'Snack', '2024-12-12 08:53:20', NULL, 3),
(10, 'Kecap', '2024-12-13 21:26:57', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `p_item`
--

CREATE TABLE `p_item` (
  `item_id` int(11) NOT NULL,
  `barcode` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `image` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_item`
--

INSERT INTO `p_item` (`item_id`, `barcode`, `name`, `category_id`, `unit_id`, `price`, `stock`, `image`, `created`, `updated`, `user_id`) VALUES
(1, 'A001', 'Chitato', 1, 7, 5000, 5, 'item-241211-77f88e13fb.jpg', '2024-12-11 21:05:00', '2024-12-16 10:56:05', 1),
(19, 'A002', 'Coca Cola', 8, 8, 5000, 30, 'item-241212-723044d4ba.png', '2024-12-12 08:52:41', '2024-12-16 10:56:05', 1),
(20, 'B001', 'Pizza', 9, 7, 7500, 5, 'item-241212-202ea06534.png', '2024-12-12 08:54:22', '2024-12-16 10:56:05', 3),
(21, 'A003', 'Kecap Bango', 10, 8, 15000, 17, 'item-241213-0cebea51ee.png', '2024-12-13 21:27:34', '2024-12-16 10:56:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `p_unit`
--

CREATE TABLE `p_unit` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `p_unit`
--

INSERT INTO `p_unit` (`unit_id`, `name`, `created`, `updated`) VALUES
(2, 'Kilogram', '2024-11-15 23:53:20', '2024-11-16 13:52:09'),
(4, 'Lusin', '2024-11-16 00:15:21', '2024-11-16 13:52:14'),
(6, 'Buah', '2024-11-17 21:38:37', NULL),
(7, 'Gram', '2024-11-18 22:37:00', NULL),
(8, 'Ml', '2024-12-12 08:52:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `phone`, `address`, `description`, `created`, `updated`) VALUES
(1, 'Toko A', '025869365', 'Semarang', NULL, '2024-11-10 00:25:35', NULL),
(2, 'Toko B', '032541785', 'Solo', 'Toko Minuman ', '2024-11-10 00:25:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_cart`
--

CREATE TABLE `t_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_sale`
--

CREATE TABLE `t_sale` (
  `sale_id` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `dinal_price` decimal(10,2) NOT NULL,
  `cash` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `note` text DEFAULT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `cashier` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sale`
--

INSERT INTO `t_sale` (`sale_id`, `invoice`, `customer_id`, `total_price`, `discount`, `dinal_price`, `cash`, `remaining`, `note`, `date`, `user_id`, `created`, `cashier`) VALUES
(66, 'MP2412220030', 0, 5000.00, 0.00, 5.00, 10000.00, 5.00, '', '2024-12-22 00:00:00', 0, '2024-12-22 06:09:59', ''),
(67, 'MP2412220031', 0, 5000.00, 0.00, 5.00, 10000.00, 5.00, 'ty', '2024-12-22 00:00:00', 0, '2024-12-22 06:13:20', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_sale_detail`
--

CREATE TABLE `t_sale_detail` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_stock`
--

CREATE TABLE `t_stock` (
  `stock_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `type` enum('in','out') NOT NULL,
  `detail` varchar(200) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_stock`
--

INSERT INTO `t_stock` (`stock_id`, `item_id`, `type`, `detail`, `supplier_id`, `qty`, `date`, `created`, `user_id`) VALUES
(6, 20, 'in', 'Warung', 1, 5, '2024-12-12', '2024-12-12 08:54:54', 3),
(7, 19, 'in', 'Kulakan', 2, 35, '2024-12-13', '2024-12-13 21:27:59', 1),
(10, 1, 'out', 'rusak', NULL, 2, '2024-12-16', '2024-12-16 16:31:56', 1),
(11, 21, 'out', 'rusak', NULL, 1, '2024-12-16', '2024-12-16 16:35:33', 1),
(12, 21, 'out', 'rusak', NULL, 1, '2024-12-16', '2024-12-16 16:41:14', 1),
(13, 19, 'out', 'hilang', NULL, 5, '2024-12-16', '2024-12-16 16:49:01', 1),
(14, 19, 'out', 'hilang', NULL, 5, '2024-12-16', '2024-12-16 16:50:50', 1),
(15, 19, 'out', 'hilang', NULL, 5, '2024-12-16', '2024-12-16 16:51:07', 1),
(16, 21, 'out', 'kadaluarsa', NULL, 1, '2024-12-16', '2024-12-16 16:52:54', 1),
(17, 21, 'out', 'kadaluarsa', NULL, 1, '2024-12-16', '2024-12-16 16:53:21', 1),
(18, 1, 'out', 'kadaluarsa', NULL, 2, '2024-12-16', '2024-12-16 16:55:09', 1),
(19, 1, 'out', 'rusak', NULL, 1, '2024-12-16', '2024-12-16 16:56:05', 1),
(20, 21, 'in', 'Kulakan', 1, 20, '2024-12-17', '2024-12-17 22:46:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `level` int(1) NOT NULL COMMENT '1:admin, 2:kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `address`, `level`) VALUES
(1, 'visteo', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', 'Jogja', 1),
(3, 'nanda', '16e8b7d240c81a0cbc6c0d5dcf00ef946b771823', 'nanda', 'sch', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `p_category`
--
ALTER TABLE `p_category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `p_category_ibfk_1` (`user_id`);

--
-- Indexes for table `p_item`
--
ALTER TABLE `p_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `barcode` (`barcode`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `p_item_ibfk_3` (`user_id`);

--
-- Indexes for table `p_unit`
--
ALTER TABLE `p_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `t_cart`
--
ALTER TABLE `t_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `t_sale`
--
ALTER TABLE `t_sale`
  ADD PRIMARY KEY (`sale_id`),
  ADD UNIQUE KEY `invoice` (`invoice`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `p_category`
--
ALTER TABLE `p_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `p_item`
--
ALTER TABLE `p_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `p_unit`
--
ALTER TABLE `p_unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_cart`
--
ALTER TABLE `t_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `t_sale`
--
ALTER TABLE `t_sale`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_stock`
--
ALTER TABLE `t_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `p_category`
--
ALTER TABLE `p_category`
  ADD CONSTRAINT `p_category_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `p_item`
--
ALTER TABLE `p_item`
  ADD CONSTRAINT `p_item_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `p_category` (`category_id`),
  ADD CONSTRAINT `p_item_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `p_unit` (`unit_id`),
  ADD CONSTRAINT `p_item_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_cart`
--
ALTER TABLE `t_cart`
  ADD CONSTRAINT `t_cart_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `t_sale_detail`
--
ALTER TABLE `t_sale_detail`
  ADD CONSTRAINT `t_sale_detail_ibfk_1` FOREIGN KEY (`sale_id`) REFERENCES `t_sale` (`sale_id`),
  ADD CONSTRAINT `t_sale_detail_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`);

--
-- Constraints for table `t_stock`
--
ALTER TABLE `t_stock`
  ADD CONSTRAINT `t_stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `p_item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_stock_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stock_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
