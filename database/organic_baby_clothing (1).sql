-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2024 at 10:20 AM
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
-- Database: `organic_baby_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity_available` int(11) NOT NULL,
  `quantity_sold` int(11) DEFAULT NULL,
  `reorder_threshold` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `product_id`, `quantity_available`, `quantity_sold`, `reorder_threshold`, `created_at`) VALUES
(1, 1, 50, 10, 20, '2024-05-07 17:38:04'),
(3, 3, 40, 8, 18, '2024-05-07 17:38:04'),
(4, 4, 60, 15, 25, '2024-05-07 17:38:04'),
(5, NULL, 50, 45, 600, '2024-05-12 16:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','shipped') NOT NULL,
  `shipping_address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `order_date`, `total_price`, `status`, `shipping_address`, `created_at`) VALUES
(2, 2, '2024-05-02', 2999.00, 'shipped', 'musanze city, Town, Country', '2024-05-07 17:32:22'),
(3, 3, '2024-05-03', 999.00, 'pending', 'huye city, Village, Country', '2024-05-07 17:32:22'),
(4, 4, '2024-05-04', 7999.00, 'shipped', 'nairobi, Hamlet, Country', '2024-05-07 17:32:22'),
(5, 1, '2024-05-07', 597.00, 'pending', 'kigali ', '2024-05-07 19:58:50'),
(6, 1, '2024-05-08', 4500.00, 'pending', 'kigali ', '2024-05-08 12:52:22'),
(7, 1, '2024-05-16', 2000.00, 'shipped', 'huye', '2024-05-16 07:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `material` varchar(100) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category`, `price`, `material`, `image_url`, `created_at`) VALUES
(1, 'Organic Cotton Onesie', 'Soft and comfortable onesie for babies', 'Clothing', 199.9, 'Organic Cotton', 'https://example.com/onesie.jpg', '2024-05-07 17:16:57'),
(2, 'Natural Wooden Rattle', 'Handcrafted wooden rattle toy for infants', 'Toys', 149.9, 'Wood', 'https://example.com/rattle.jpg', '2024-05-07 17:16:57'),
(3, 'Bamboo Swaddle Blanket', 'Breathable and eco-friendly blanket for newborns', 'Bedding', 299, 'Bamboo', 'https://example.com/blanket.jpg', '2024-05-07 17:16:57'),
(4, 'Organic Baby Hat', 'Adorable hat made from organic materials', 'Accessories', 999, 'Organic Cotton', 'https://example.com/hat.jpg', '2024-05-07 17:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `review_date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `customer_id`, `rating`, `review_text`, `review_date`) VALUES
(1, 1, 1, 5, 'Great quality onesie! Very soft and well-made.', '2024-05-05'),
(2, 2, 2, 4, 'Lovely rattle, my baby enjoys playing with it.', '2024-05-06'),
(3, 3, 3, 5, 'Absolutely love this blanket! So cozy and eco-friendly.', '2024-05-07'),
(4, 4, 4, 5, 'Cute and comfortable hat. Fits perfectly on my baby.', '2024-05-08'),
(5, 1, 1, 9, 'cut trauser', '2024-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `name`, `contact_person`, `email`, `phone_number`, `address`, `created_at`) VALUES
(1, 'Organic Textiles Inc.', 'emile', 'info@organic-textiles.com', '0727665433', 'musanze', '2024-05-07 17:37:17'),
(2, 'Wooden Wonders Co.', 'Bob Carpenter', 'bob@wooden-wonders.com', '0725334211', 'kigali city', '2024-05-07 17:37:17'),
(3, 'EcoFabrics Ltd.', 'Emmy', 'emma@ecofabrics.com', '0791291546', 'huye city', '2024-05-07 17:37:17'),
(4, 'SoftTouch Materials', 'Sam Brown', 'sam@softtouchmaterials.com', '0794567890', 'rubavu', '2024-05-07 17:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin','supplier') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'emile', 'emile@gmail.com', '123', 'customer', '2024-05-07 17:11:35'),
(2, 'daniel', 'daniel@gmail.com', '123456', 'admin', '2024-05-07 17:11:35'),
(3, 'solange', 'solange@gmail.com', '123456', 'supplier', '2024-05-07 17:11:35'),
(4, 'paul', 'paul@gmail.com', '123456', 'customer', '2024-05-07 17:11:35'),
(5, 'daniel', 'habiyaremyedaniel2021@gmail.com', '1234', '', '2024-05-07 18:38:29'),
(6, 'emile', 'emile@gmail.com', '1234', '', '2024-05-07 18:45:05'),
(7, 'photide', 'fodite@gmail.com', '123456', '', '2024-05-07 21:03:25'),
(8, 'eric', 'eric@gmail.com', '1234', '', '2024-05-07 21:16:10'),
(9, 'eric', 'daniel2021@gmail.com', '1234', '', '2024-05-08 09:02:56'),
(10, 'eric', 'habiyaremyedaniel2021@gmail.com', '1234', '', '2024-05-09 05:20:35'),
(11, 'eric', 'habiyaremyedaniel2021@gmail.com', '1234', '', '2024-05-11 16:22:00'),
(12, 'emmanuel', 'habiyaremyedaniel2021@gmail.com', '1234', 'admin', '2024-05-11 16:26:32'),
(13, 'faniel', 'habiyaremyedaniel2021@gmail.com', '12345', '', '2024-05-12 14:54:53'),
(14, 'emy', 'chris@gmail.com', '1234', '', '2024-05-12 16:18:08'),
(15, 'paul', 'fodite@gmail.com', '1234', '', '2024-05-12 16:25:14'),
(16, 'daniel', 'habiyaremyedaniel2021@gmail.com', '1234', '', '2024-05-13 11:07:59'),
(17, 'Solange', 'umwizerwa@gmail.com', '1234', 'customer', '2024-05-13 11:08:48'),
(18, 'Emile niyitanga ', 'niyitanga222003205@gmail.com', '1234', '', '2024-05-16 07:21:37'),
(19, 'emile', 'niyitanga222003205@gmail.com', '2525', '', '2024-05-22 09:28:17'),
(20, 'Emmy', 'niyitanga222003205@gmail.com', '1111', '', '2024-05-23 06:43:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
