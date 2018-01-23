-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2018 at 06:06 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(8, 123, 'ATA', 'qwewqweqwe', 123),
(11, 234234, 'AUS', 'wfwewe', 32432),
(12, 123123, 'AZE', 'sdfsdfsd', 124124124),
(15, 765, 'AND', 'uyt', 23);

-- --------------------------------------------------------

--
-- Table structure for table `custom_products`
--

CREATE TABLE `custom_products` (
  `custom_product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_products`
--

INSERT INTO `custom_products` (`custom_product_id`, `quantity`, `order_id`) VALUES
(1, 1, 4),
(2, 2, 5),
(3, 2, 6),
(4, 3, 7),
(5, 1, 8),
(6, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `custom_products_components`
--

CREATE TABLE `custom_products_components` (
  `custom_product_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_products_components`
--

INSERT INTO `custom_products_components` (`custom_product_id`, `component_id`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(1, 35),
(1, 41),
(2, 1),
(2, 2),
(2, 4),
(2, 6),
(2, 7),
(2, 8),
(2, 35),
(2, 41),
(3, 1),
(3, 2),
(3, 4),
(3, 6),
(3, 7),
(3, 8),
(3, 35),
(3, 41),
(4, 1),
(4, 2),
(4, 4),
(4, 6),
(4, 7),
(4, 8),
(4, 35),
(4, 41),
(5, 1),
(5, 2),
(5, 4),
(5, 6),
(5, 7),
(5, 8),
(5, 35),
(5, 41),
(6, 1),
(6, 2),
(6, 4),
(6, 6),
(6, 7),
(6, 8),
(6, 35),
(6, 41);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method_id` varchar(256) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `total`, `date`, `delivery_date`, `user_id`, `payment_method_id`, `address_id`) VALUES
(4, 970, '2018-01-22', '2018-01-29', 1, '4716 1089 9971 6531', 11),
(5, 1940, '2018-01-22', '2018-01-29', 1, '4716 1089 9971 6531', 11),
(6, 1940, '2018-01-22', '2018-01-29', 1, '4716 1089 9971 6531', 11),
(7, 2910, '2018-01-22', '2018-01-29', 1, '4716 1089 9971 6531', 11),
(8, 970, '2018-01-23', '2018-01-30', 1, '4716 1089 9971 6531', 11),
(9, 970, '2018-01-23', '2018-01-30', 1, '4716 1089 9971 6531', 11);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `number` varchar(256) NOT NULL,
  `expiry_date` date NOT NULL,
  `security_code` varchar(256) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `type` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`number`, `expiry_date`, `security_code`, `type`, `user_id`) VALUES
('4716 1089 9971 6531', '2018-01-31', '$2y$10$oagP1bteuB7wDc9LXTjHEe9pdxa6eh7ihedw8Hh7nNH5eF37XYUpS', 'Credit', 1);

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
(1, 'CP_PC_HD250GB', 8, 50),
(2, 'CP_PC_RAMDDR2GB', 1, 30),
(4, 'CP_PC_MBASUS', 0, 100),
(6, 'CP_PC_CPUi7', 0, 500),
(7, 'CP_PC_GPUNVIDIAGTX800', 5, 230),
(8, 'CP_PC_CSCOOLERMASTER', 8, 40),
(9, 'PB_PC_KBMECHANICAL', 8, 80),
(10, 'PB_PC_MNACER14HD', 3, 90),
(11, 'PB_PC_MSLOGITECH', 2, 10),
(12, 'CP_PC_OSWIN10', 20, 100),
(13, 'CP_PC_OSWIN7', 20, 60),
(15, 'CP_PC_OSLINUXMINT', 20, 5),
(16, 'CP_PH_SCIPS6', 10, 50),
(17, 'CP_PH_SCFULLHD5', 6, 40),
(18, 'CP_PH_CPUSNAPDRAGON800', 20, 40),
(19, 'CP_PH_RAM3GB', 20, 15),
(20, 'CP_PH_HD16GB', 10, 10),
(21, 'CP_PH_GPUNVIDIATEGRAK1', 20, 25),
(22, 'CP_PH_BDIPHONE6', 10, 5),
(23, 'CP_PH_OSANDROID7.0', 20, 5),
(24, 'CP_PH_OSANDROID8.0', 20, 5),
(25, 'CP_PH_FASTCHARGING', 20, 5),
(26, 'CP_PH_NFC', 20, 5),
(27, 'CP_PH_JACK', 20, 5),
(28, 'CP_PH_CM8MPX', 10, 10),
(30, 'CP_PH_USB3.0', 20, 10),
(31, 'CP_PH_USBMICRO', 10, 5),
(32, 'CP_PH_WIRELESS', 20, 10),
(33, 'CP_PH_FINGER', 20, 20),
(34, 'CP_PH_BT6000mH', 20, 18),
(35, 'CP_PC_DSHDMI', 18, 10),
(36, 'CP_PC_DSVGA', 30, 5),
(37, 'CP_PC_DSSDVI', 5, 7),
(38, 'CP_PH_USBC', 30, 15),
(39, 'CP_PC_USB3.0', 30, 10),
(40, 'CP_PC_USBC', 20, 20),
(41, 'CP_PC_DDDVD', 18, 10),
(42, 'CP_PC_DDCD', 20, 5),
(46, 'CP_PC_CPUi5', 1, 150),
(48, 'CP_PC_CPUAMDRYSEN', 1, 200);

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
(1, 'admin', 'Mike', '$2y$10$33T7801.WlhAzLbMViJ4LedCHuXrcVe6pbN5o3a9IYSzYlFTRat5u', 'Hunt', 1, 'mikehunt@gmail.com'),
(17, 'user', 'manuel', '$2y$10$LrpjhxMNIYVg4TYKPRSxr.bV2dx9dvWWqSjf.u7owJsOVsXDM/yP.', 'qweqweqwe', 0, 'qweqweqeqe@asdasd.com'),
(20, 'user', 'mridpin@alu.upo.es', '$2y$10$kMAin/G.sAZHrtHtN44ZqeiA8tQouyVUZlJRQQf5Xg66Xw7FH1NOu', 'qweqweqwe', 0, 'mridpin@alu.upo.eeees'),
(21, 'user', 'dsfsdf', '$2y$10$vPYgP9SZnigKRk0j03hwS.C7vqaOvY4KK9em9bhMwx8.2Kuy6ja2.', 'dsffsdf', 0, 'suqmadiq@gmail.com'),
(23, 'user', 'Manuel', '$2y$10$EkaJccf8xO0IgmlbzDGGTOZiluAHF1M2ODbr19qV7nSjQtTpzum4K', 'Ridao Pineda', 0, 'mridpin@alu.upo.es');

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
(1, 11),
(20, 8),
(21, 12),
(23, 15);

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
  ADD PRIMARY KEY (`custom_product_id`),
  ADD KEY `Constrain` (`order_id`);

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
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method_id` (`payment_method_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`number`,`user_id`),
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
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `custom_products`
--
ALTER TABLE `custom_products`
  MODIFY `custom_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_products`
--
ALTER TABLE `custom_products`
  ADD CONSTRAINT `Constrain` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_method` (`number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
