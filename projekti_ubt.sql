-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 05:05 PM
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
-- Database: `projekti_ubt`
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message_name` varchar(255) NOT NULL,
  `message_email` varchar(255) NOT NULL,
  `message_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `message_name`, `message_email`, `message_description`, `created_at`) VALUES
(1, 'Edonis', 'edonisshabani@hotmail.com', 'sajdad', '2025-02-01 01:44:19'),
(2, 'Test', 'testtest123123@hotmail.com', 'iudshaj', '2025-02-01 02:01:29'),
(3, 'Edonis', 'Tets@hotmail.com', 'test', '2025-02-01 02:18:15'),
(4, 'Test', 'testtest123123@hotmail.com', 'dasbdahsd', '2025-02-01 02:18:48'),
(5, 'Holly', 'HollyHarding@hotmail.com', 'djkd', '2025-02-01 16:25:29'),
(6, 'Edonis', '123@gmail.com', 'ewawjda', '2025-02-01 16:29:42'),
(7, 'Sadih', 'ja@hotmail.com', 'ahsdb\r\n', '2025-02-01 16:45:43'),
(8, 'HollyHard', 'HollyHarding@gmail.com', 'dkajsdnajkd', '2025-02-01 16:46:34'),
(9, 'HS', 'dajsn@hotmail.com', 'JASDK', '2025-02-01 16:53:50'),
(11, 'Hello', 'akdjajk@gmail.com', 'djkad', '2025-02-01 17:22:47'),
(12, 'Edo', 'dnsajkdn@gmail.com', 'dajksdna@gmail.com', '2025-02-01 17:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('pending','shipped','delivered','canceled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `discount`, `image`, `quantity`) VALUES
(1, 'Laptop 1', 'Laptops', 1000.00, 20.00, 'img/fea1.jpg', 7),
(2, 'Gaming Mouse', 'Mouses', 150.00, 15.00, 'img/fea2.jpg', 10),
(3, 'DSLR Camera', 'Cameras', 700.00, 20.00, 'img/fea3.jpg', 5),
(4, 'Desktop PC', 'Computers', 1200.00, 17.00, 'img/fea4.jpg', 10),
(5, 'New Laptop', 'Laptops', 1200.00, 10.00, 'img/new1.jpg', 5),
(6, 'Wireless Mouse', 'Mouses', 150.00, 5.00, 'img/new2.jpg', 8),
(7, 'Mirrorless Camera', 'Cameras', 350.00, 15.00, 'img/new3.jpg', 3),
(8, 'Gaming PC', 'Computers', 900.00, 10.00, 'img/new4.jpg', 6),
(9, 'Ultrabook', 'Laptops', 100.00, 20.00, 'img/new5.jpg', 12);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(2, 'uidashd', 'jhdkja@hotmail.com', '$2y$10$2YSpJB7Z2IGBo340YZGo4OVlHsEurSCHB3eVgtzTCGF/SPzmFWT0W', 'user'),
(5, 'admin', 'admin@hotmail.com', '$2y$10$nqoV3LQKSELJDOjHntk2JufTHWZWPJLKgQ/roJtl7oWMXxGZsiNEW', 'admin'),
(6, 'ttest', 'test@gmail.com', '$2y$10$Mza1ByiVMnK4TM0uLbJd8e2vQ9z6oawm3VVwfa33u6C.uFPc1sg8K', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
