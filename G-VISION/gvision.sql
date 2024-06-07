-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 02, 2024 at 11:28 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gvision`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_pack`
--

CREATE TABLE `client_pack` (
  `id` int NOT NULL,
  `card_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client_pack`
--

INSERT INTO `client_pack` (`id`, `card_id`, `name`, `phone`, `email`) VALUES
(1, 'GVISION', 'DAHA HMED', '0797197488', 'rhmohamed@gmail.dz'),
(5, 'GVISION', 'moh', '0255965', 'g@gmail.com'),
(6, 'STARTER', 'test', 'test', 'test@gmail.com'),
(7, 'GVISION', 'test', 'tesy', 'wassim@gmail.com'),
(8, 'GVISION', 'test', '0798947617', 'g.viision@gmail.com'),
(9, 'GVISION', 'hamdi', 'nabil', 'nbl@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_send` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `name`, `phone`, `email`, `message`, `date_send`) VALUES
(1, 'Guessoum Mohamed Wassim', '0798947617', 'g.viision@gmail.com', 'HELLO WORLD', '2024-05-27 20:55:48'),
(11, 'Guessoum Mohamed Wassim', '0798947617', 'g.viision@gmail.com', '', '2024-05-27 22:19:33'),
(12, 'Guessoum Mohamed Wassim', '0798947617', 'g.viision@gmail.com', '', '2024-05-27 22:21:28'),
(14, 'nabil hamdi', '0696336378', 'nbl@gmail.com', 'samhoni rani ghlet bah ndir pack ta3 zwawla dert gvision', '2024-06-01 22:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `quote` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `quote`, `author`, `image`) VALUES
(16, 'gsmm\r\nonly', 'gsm', 'uploads/A.png'),
(17, 'gsmm\r\nonly', 'gsm', 'uploads/A.png'),
(18, 'hello world im gsm how i ', 'test', 'uploads/360_F_267083342_Dw7NvtP2oy0JfO2qTjDlWePOaxoCJgxM.jpg'),
(21, 'HHHHHHHHHHHH\r\nHHHHHHHHHHHH\r\nHHHHHHHHH', 'GSM', 'uploads/ssd.png'),
(23, 'good job', 'midou', 'uploads/nbl.png');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(2, 'admin'),
(1, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role_id`) VALUES
(1, 'admin', '$2y$10$hsPGZSI37jope.9mNO0OS.Pjz1AhFpTtc3wM7Qr6c25nReS2EJcca', 2),
(2, 'user', '$2y$10$GDnrlGPHAOGDWHGho4L.Ae1nK9ZqjT0yBjNPirZpyzBJtqGsBYOKO', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_pack`
--
ALTER TABLE `client_pack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_pack`
--
ALTER TABLE `client_pack`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
