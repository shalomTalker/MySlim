-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2018 at 07:04 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` mediumblob NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'javascript', 'frghdgd', '', '2018-04-29 15:54:40', '2018-04-29 15:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` char(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` mediumblob,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`, `created_at`, `updated_at`) VALUES
(1, 'shalom', '0522210099', 'SHALOM604@GMAIL.COM', NULL, '2018-04-29 15:33:18', '2018-04-29 15:33:18'),
(2, 'javascript', '', '', NULL, '2018-04-29 15:52:16', '2018-04-29 15:52:16'),
(3, 'yehuda', '0522210098', 'shalom@gmail.com', NULL, '2018-04-29 17:19:17', '2018-04-29 17:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` char(9) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` char(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `created_at`, `updated_at`) VALUES
(34, 'shalom', 'shalom604@gmail.com', '052221009', '$2y$10$Ef0uhCx0XgOh5XQfY3Ume.Fpwq9vBVSNY4JHxBtjx.1YJNvMDzQRG', '1', '2018-04-28 17:33:46', '2018-04-29 10:19:19'),
(35, 'shalom talker', 'shalom1604@gmail.com', '052221009', '$2y$10$a1vBY5y7cqoZ8NJJe/G7g.MgokiKz0Tz1rajpmvyjqk1xPkpwg93W', '1', '2018-04-28 17:38:19', '2018-04-28 17:38:19'),
(36, 'shalomtalker', 'shalom60422@gmail.com', '052221009', '$2y$10$of.VqPQJGEHSDWkiuW5/0.xwVEh5zDMQkSvabtQWrZvdZ7.y.W2J.', '1', '2018-04-28 18:33:02', '2018-04-28 18:33:02'),
(37, 'shalomtalker', 'shalom605@gmail.com', '052221009', '$2y$10$wa0SzgcY2F5fePqYMrjGkOZxPqQSOfPdacxTeoQGF5M/TJx2azRQ.', '1', '2018-04-28 18:34:01', '2018-04-28 18:34:01'),
(38, 'shalom', 'shalom@gmail.com', '052221009', '$2y$10$glorjhmDcwqEfDKfhYVz5ec/s0qDvMXR8i8.8s4vT1F/BkO9tGZci', '1', '2018-04-28 19:17:46', '2018-04-28 19:17:46'),
(39, 'sha', 'shalom606@gmail.com', '052221009', '$2y$10$/6fu2h.pBycxZzN3sPXD1.iNPRBNynyagj9PEojY/lCpj.7tap8Su', '1', '2018-04-28 19:34:58', '2018-04-28 19:34:58'),
(40, 'shalom', 'shalom607@gmail.com', '052221009', '$2y$10$QQSaKx.GzHf4.ZYVt7Mk8u4nki7apaJownF6RPI.cBVLQ1Ibsxz56', '1', '2018-04-28 19:36:01', '2018-04-28 19:36:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
