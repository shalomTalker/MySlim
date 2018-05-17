-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2018 at 05:23 PM
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
  `image` mediumblob NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'php-MYSQL', 'Have you ever wonder why their are so many PHP Mysql Courses but they offer very little practical skills. Even though if you search on Udemy the longest course will only offer 1 big projects. Sometimes its difficult for beginners to understand the long project right after learning basics due to lack of practice.', '', '2018-05-05 11:46:41', '2018-05-05 11:46:41'),
(2, 'nodeJS', 'Have you tried to learn Node before? You start a new course, and the instructor has you installing a bunch of libraries before you even know what Node is or how it works. You eventually get stuck and reach out to the instructor, but you get no reply. You then close the course and never open it again.', '', '2018-05-07 17:35:01', '2018-05-07 17:35:01');

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
(5, 3, 1, 1, '2018-05-16 22:24:42', '2018-05-16 22:24:42'),
(6, 3, 2, 1, '2018-05-16 22:24:43', '2018-05-16 22:24:43'),
(7, 5, 1, 1, '2018-05-16 22:53:36', '2018-05-16 22:53:36'),
(8, 5, 2, 1, '2018-05-16 22:53:36', '2018-05-16 22:53:36'),
(9, 4, 1, 1, '2018-05-16 22:55:20', '2018-05-16 22:55:20'),
(10, 4, 2, 1, '2018-05-16 22:55:20', '2018-05-16 22:55:20'),
(11, 3, 1, 1, '2018-05-16 22:55:50', '2018-05-16 22:55:50'),
(12, 3, 2, 1, '2018-05-16 22:55:50', '2018-05-16 22:55:50'),
(13, 3, 1, 1, '2018-05-17 13:37:07', '2018-05-17 13:37:07'),
(14, 3, 2, 1, '2018-05-17 13:37:07', '2018-05-17 13:37:07'),
(15, 4, 1, 1, '2018-05-17 13:37:14', '2018-05-17 13:37:14'),
(16, 5, 1, 1, '2018-05-17 13:37:22', '2018-05-17 13:37:22'),
(17, 5, 2, 1, '2018-05-17 13:37:30', '2018-05-17 13:37:30');

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
(3, 'oz', '0544447788', 'oz604@gmail.com', NULL, '2018-05-17 00:35:46', '2018-05-17 16:37:07'),
(4, 'ella', '0598874152', 'ella604@gmail.com', NULL, '2018-05-17 00:36:16', '2018-05-17 16:37:14'),
(5, 'tal', '0541233352', 'tal604@gmail.com', NULL, '2018-05-17 00:36:44', '2018-05-17 16:37:30');

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
  `role_id` char(11) NOT NULL,
  `role` char(20) NOT NULL,
  `image` longblob NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role_id`, `role`, `image`, `created_at`, `updated_at`) VALUES
(1, 'shalom', 'shalom604@gmail.com', '052221009', '$2y$10$Ef0uhCx0XgOh5XQfY3Ume.Fpwq9vBVSNY4JHxBtjx.1YJNvMDzQRG', '3', 'Owner', '', '2018-04-28 14:33:46', '2018-04-29 07:19:19');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
