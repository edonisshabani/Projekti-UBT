-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 01:41 AM
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
(10, 'Ajsa', 'dajsd@gmail.com', 'dasuhdakjd', '2025-02-01 16:58:57'),
(11, 'Hello', 'akdjajk@gmail.com', 'djkad', '2025-02-01 17:22:47'),
(12, 'Edo', 'dnsajkdn@gmail.com', 'dajksdna@gmail.com', '2025-02-01 17:42:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'test', 'test@hotmail.com', '$2y$10$1IGJnQzqr8TES8P0HeqHa.ITE0OJ45awbvfQiqFloKuAwrRPcw7ka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
