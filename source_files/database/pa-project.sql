-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2018 at 06:36 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupopa0_db`
--
CREATE DATABASE IF NOT EXISTS `grupopa0_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `grupopa0_db`;

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `street` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `zip_code`, `country`, `street`, `number`) VALUES
(1, 99999, 'ESP', 'PENIS', 4),
(6, 123123, 'AFG', 'qweqwwe', 123),
(8, 123, 'ATA', 'qwewqweqwe', 123);

-- --------------------------------------------------------

--
-- Table structure for table `custom_products`
--

CREATE TABLE `custom_products` (
  `custom_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `custom_products_components`
--

CREATE TABLE `custom_products_components` (
  `custom_product_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `assembly_time` float NOT NULL,
  `delivery_date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_prebuilt`
--

CREATE TABLE `order_prebuilt` (
  `order_id` int(11) NOT NULL,
  `prebuilt_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `number` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `security_code` int(11) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) DEFAULT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `stock`, `price`) VALUES
(1, 'CP_PC_HD250GB', 5, 50),
(2, 'CP_PC_RAMDDR2GB', 3, 30),
(3, 'PB_PS4500GB', 5, 300),
(4, 'CP_PC_MBASUS', 2, 100),
(5, 'PB_XBOXONE500GB', 1, 300),
(6, 'CP_PC_CPUi7', 2, 500),
(7, 'CP_PC_GPUNVIDIAGTX800', 7, 230),
(8, 'CP_PC_CSCOOLERMASTER', 10, 40),
(9, 'PB_PC_KBMECHANICAL', 8, 80),
(10, 'PB_PC_MNACER14HD', 3, 90),
(11, 'PB_PC_MSLOGITECH', 2, 10),
(12, 'CP_PC_OSWIN10', NULL, 100),
(13, 'CP_PC_OSWIN7', NULL, 60),
(15, 'CP_PC_OSLINUXMINT', NULL, 5),
(16, 'CP_PH_SCIPS6', 10, 50),
(17, 'CP_PH_SCFULLHD5', 6, 40),
(18, 'CP_PH_CPUSNAPDRAGON800', 20, 40),
(19, 'CP_PH_RAM3GB', 20, 15),
(20, 'CP_PH_HD16GB', 10, 10),
(21, 'CP_PH_GPUNVIDIATEGRAK1', 20, 25),
(22, 'CP_PH_BDIPHONE6', 10, 5),
(23, 'CP_PH_OSANDROID7.0', NULL, 5),
(24, 'CP_PH_OSANDROID8.0', NULL, 5),
(25, 'CP_PH_FASTCHARGING', NULL, 5),
(26, 'CP_PH_NFC', NULL, 5),
(27, 'CP_PH_JACK', NULL, 5),
(28, 'CP_PH_CM8MPX', 10, 10),
(30, 'CP_PH_USB3.0', 20, 10),
(31, 'CP_PH_USBMICRO', 10, 5),
(32, 'CP_PH_WIRELESS', NULL, 10),
(33, 'CP_PH_FINGER', NULL, 20),
(34, 'CP_PH_BT6000mH', 20, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `address` int(11) NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `type`, `name`, `password`, `last_name`, `address`, `email`) VALUES
(1, 'user', 'Mike', '$2y$10$33T7801.WlhAzLbMViJ4LedCHuXrcVe6pbN5o3a9IYSzYlFTRat5u', 'Hunt', 1, 'mikehunt@gmail.com'),
(17, 'user', 'manuel', '$2y$10$LrpjhxMNIYVg4TYKPRSxr.bV2dx9dvWWqSjf.u7owJsOVsXDM/yP.', 'qweqweqwe', 0, 'qweqweqeqe@asdasd.com'),
(20, 'user', 'mridpin@alu.upo.es', '$2y$10$kMAin/G.sAZHrtHtN44ZqeiA8tQouyVUZlJRQQf5Xg66Xw7FH1NOu', 'qweqweqwe', 0, 'mridpin@alu.upo.eeees');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `address_id`) VALUES
(20, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `custom_products`
--
ALTER TABLE `custom_products`
  ADD PRIMARY KEY (`custom_product_id`);

--
-- Indexes for table `custom_products_components`
--
ALTER TABLE `custom_products_components`
  ADD PRIMARY KEY (`custom_product_id`,`component_id`),
  ADD KEY `component_id` (`component_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_prebuilt`
--
ALTER TABLE `order_prebuilt`
  ADD PRIMARY KEY (`order_id`,`prebuilt_id`),
  ADD KEY `prebuilt_id` (`prebuilt_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`user_id`,`address_id`),
  ADD KEY `address_id` (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `custom_products`
--
ALTER TABLE `custom_products`
  MODIFY `custom_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `number` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_products_components`
--
ALTER TABLE `custom_products_components`
  ADD CONSTRAINT `custom_products_components_ibfk_1` FOREIGN KEY (`custom_product_id`) REFERENCES `custom_products` (`custom_product_id`),
  ADD CONSTRAINT `custom_products_components_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_prebuilt`
--
ALTER TABLE `order_prebuilt`
  ADD CONSTRAINT `order_prebuilt_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_prebuilt_ibfk_2` FOREIGN KEY (`prebuilt_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `payment_method_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_address_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
