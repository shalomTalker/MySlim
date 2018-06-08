-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2018 at 10:27 PM
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
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'nodeJS', 'Have you tried to learn Node before? You start a new course, and the instructor has you installing a bunch of libraries before you even know what Node is or how it works. You eventually get stuck and reach out to the instructor, but you get no reply. You then close the course and never open it again.', 'nodejs.jpeg.jpeg', '2018-05-21 22:13:35', '2018-05-21 21:47:23'),
(2, 'PHP MYSQL', 'Have you ever wonder why their are so many PHP Mysql Courses but they offer very little practical skills. Even though if you search on Udemy the longest course will only offer 1 big projects. Sometimes its difficult for beginners to understand the long project right after learning basics due to lack of practice.', 'php_mysql.jpeg.jpeg', '2018-05-21 22:13:35', '2018-05-21 21:47:36'),
(3, 'javascript', 'You will learn how to organize and structure your code using modules and functions. Because coding is not just writing code, it\'s also thinking about your code!', 'javascript.jpeg.jpeg', '2018-05-21 22:13:35', '2018-05-21 21:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) UNSIGNED NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `admin_id` int(11) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_id`, `course_id`, `admin_id`, `created_at`, `updated_at`) VALUES
(12, 6, 1, 1, '2018-05-21 18:40:41', '2018-05-21 18:40:41'),
(13, 6, 2, 1, '2018-05-21 18:40:41', '2018-05-21 18:40:41'),
(22, 7, 1, 1, '2018-05-27 21:18:35', '2018-05-27 21:18:35'),
(23, 7, 2, 1, '2018-05-27 21:18:35', '2018-05-27 21:18:35'),
(30, 2, 1, 1, '2018-05-27 23:40:24', '2018-05-27 23:40:24'),
(31, 2, 2, 1, '2018-05-27 23:40:24', '2018-05-27 23:40:24'),
(32, 3, 2, 1, '2018-05-27 23:42:11', '2018-05-27 23:42:11'),
(33, 3, 3, 1, '2018-05-27 23:42:11', '2018-05-27 23:42:11'),
(36, 5, 1, 1, '2018-05-28 09:17:06', '2018-05-28 09:17:06'),
(37, 5, 2, 1, '2018-05-28 09:17:07', '2018-05-28 09:17:07'),
(38, 4, 1, 1, '2018-05-28 09:17:52', '2018-05-28 09:17:52'),
(39, 4, 2, 1, '2018-05-28 09:17:52', '2018-05-28 09:17:52'),
(40, 8, 2, 1, '2018-05-28 09:19:53', '2018-05-28 09:19:53'),
(41, 8, 3, 1, '2018-05-28 09:19:53', '2018-05-28 09:19:53'),
(42, 10, 1, 1, '2018-05-28 09:28:01', '2018-05-28 09:28:01'),
(43, 10, 2, 1, '2018-05-28 09:28:02', '2018-05-28 09:28:02'),
(64, 1, 1, 1, '2018-05-28 10:03:04', '2018-05-28 10:03:04'),
(65, 1, 3, 1, '2018-05-28 10:03:05', '2018-05-28 10:03:05'),
(74, 9, 1, 1, '2018-05-28 11:09:49', '2018-05-28 11:09:49'),
(75, 9, 3, 1, '2018-05-28 11:09:50', '2018-05-28 11:09:50');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phone` char(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `phone`, `email`, `image`, `created_at`, `updated_at`) VALUES
(1, 'ori', '0542368785', 'ori604@gmail.com', 'ori.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 13:03:04'),
(2, 'adam', '0569874523', 'adam604@gmail.com', 'adam.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 02:40:24'),
(3, 'alex', '0548789635', 'alex604@gmail.com', 'alex.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 02:42:10'),
(4, 'karin', '0582145875', 'karin604@gmail.com', 'karin.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 12:17:51'),
(5, 'nicole', '0562368796', 'nicole604@gmail.com', 'nicole.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 12:17:06'),
(6, 'dana', '0522545412', 'dana604@gmail.com', 'dana.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-21 21:40:41'),
(7, 'shon', '0528745444', 'shon604@gmail.com', 'shon.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 00:18:35'),
(8, 'mark', '0548887969', 'mark604@gmail.com', 'mark.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 12:19:53'),
(9, 'john', '0523636989', 'john604@gmail.com', 'john.jpeg.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 14:09:49'),
(10, 'roy', '0502365545', 'roy604@gmail.com', 'roy.jpeg.jpeg', '2018-05-21 22:16:59', '2018-05-28 12:28:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` char(10) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` char(11) NOT NULL,
  `role` char(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `role`, `image`, `created_at`, `updated_at`) VALUES
(1, 'shalom', 'shalom604@gmail.com', '0522210099', '$2y$10$n.nm.tlAEKIRy0fD4atfd.8AAt5UD499VwZ9SaiPFNnpz/BOZA0/G', '3', 'owner', 'shalom.jpeg.jpeg', '2018-04-28 11:33:46', '2018-05-24 12:22:24'),
(2, 'daniel', 'daniel604@gmail.com', '0524454789', '$2y$10$Ycz4s6hN4mmEdKmo1lXEtujzz8msjNcRREEXTfkEi5J6kJr3LTyh.', '2', 'Administrator', 'daniel.jpeg.jpeg', '2018-05-21 18:53:59', '2018-05-21 18:53:59'),
(3, 'hodaya', 'hodaya604@gmail.com', '0588785695', '$2y$10$qEybxeHQPUeCRbspNV/8KOYgIGN8CArjS5eykGraXFluYVQ57lhMm', '2', 'Administrator', 'hodaya.jpeg.jpeg', '2018-05-21 18:55:16', '2018-05-21 18:55:16'),
(4, 'kobi', 'kobi604@gmail.com', '0522221455', '$2y$10$vMdYUKnaAPadJLTEAMWZNOSM8O1.K3c0EvFEj2HVZBOw.96yBbQ2m', '2', 'Administrator', 'kobi.jpeg.jpeg', '2018-05-21 18:56:11', '2018-05-21 18:56:11'),
(5, 'ofir', 'ofir604@gmail.com', '0544789635', '$2y$10$hKZkx2f2UIpl9y76maM0q.l5/4MMiA2NKhl8gOucnC/CcQT4f7kqe', '1', 'Sales', 'ofir.jpeg.jpeg', '2018-05-21 19:32:39', '2018-05-21 19:32:39'),
(6, 'shlomi', 'shlomi604@gmail.com', '0544875896', '$2y$10$CsMyAv0gjvApkVnbEJ1zfujrDIdHhrVsyZHEormwMJ85Fab2Tr4ay', '1', 'Sales', 'shlomi.jpeg.jpeg', '2018-05-21 19:33:25', '2018-05-21 19:33:25'),
(7, 'yehuda', 'yehuda@gmail.com', '0523456988', '$2y$10$30jFMnzd8P/KHkuKdHnx/O1kkbfN2FwsTQMCkc/ordBVoqBNGXrKm', '2', 'Administrator', 'yehuda.jpeg.jpeg', '2018-05-30 13:09:15', '2018-05-30 13:09:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
