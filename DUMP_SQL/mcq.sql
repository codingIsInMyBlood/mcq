-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2019 at 06:19 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mcq`
--
CREATE DATABASE IF NOT EXISTS `mcq` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mcq`;


-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(10) UNSIGNED NOT NULL,
  `questionId` int(11) NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isCorrect` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `questionId`, `option`, `isCorrect`) VALUES
(1, 1, 'PHP 4', 0),
(2, 1, 'PHP 5', 1),
(3, 1, 'PHP 5.3', 0),
(4, 1, 'PHP 6', 0),
(5, 2, '_clone(targetObject);', 0),
(6, 2, 'destinationObject = clone targetObject;', 1),
(7, 2, 'destinationObject = _clone(targetObject);', 0),
(8, 2, 'destinationObject = clone(targetObject);', 0),
(9, 3, 'Normal class', 0),
(10, 3, 'Static class', 0),
(11, 3, 'Abstract class', 1),
(12, 3, 'Interface', 0),
(13, 4, '14', 0),
(14, 4, '15', 0),
(15, 4, '16', 1),
(16, 4, '17', 0),
(17, 5, 'Fatal run-time errorc', 1),
(18, 5, 'Near-fatal error', 0),
(19, 5, 'Compile-time error', 0),
(20, 5, 'Fatal Compile-time error', 0),
(21, 6, 'head', 0),
(22, 6, 'head and body', 1),
(23, 6, 'title and head', 0),
(24, 6, 'all of the mentioned above', 0),
(25, 7, 'will throw errors and exceptions', 0),
(26, 7, 'must be restricted to a Unix Machine only', 0),
(27, 7, 'will work perfectly well on a Windows Machine', 1),
(28, 7, 'will be displayed as a JavaScript text on the browser', 0),
(29, 8, 'make computations in HTML simpler', 0),
(30, 8, 'minimize storage requirements on the web server', 1),
(31, 8, 'increase the download time for the client', 0),
(32, 8, 'none of the mentioned', 0),
(33, 9, 'JavaScript can be written', 1),
(34, 9, 'directly on the server page', 0),
(35, 9, 'directly into HTML pages', 0),
(36, 9, 'all of the mentioned', 0),
(37, 10, 'Client-side programming', 0),
(38, 10, 'Server-side programming', 1),
(39, 10, 'Both Client-side & Server-side programming', 0),
(40, 10, 'None of the mentioned', 0),
(41, 11, 'When user manually calls the button', 0),
(42, 11, 'When user clicks a key', 1),
(43, 11, 'When the user calls the modifier', 0),
(44, 11, 'All of the mentioned', 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `marks`) VALUES
(1, 'Which version of PHP introduced the advanced concepts of OOP?', 5),
(2, 'Which one of the following is the right way to clone an object?', 19),
(3, 'If one intends to create a model that will be assumed by a number of closely related objects, which class must be used?', 2),
(4, 'How many error levels are available in PHP?', 2),
(5, 'What is the description of Error level E_ERROR?', 17),
(6, 'The script tag must be placed in', 18),
(7, 'A JavaScript program developed on a Unix Machine', 8),
(8, 'JavaScript is ideal to', 19),
(9, 'JavaScript can be written', 17),
(10, 'Cookies were originally designed for', 7),
(11, 'When are the keyboard events fired?', 10);

-- --------------------------------------------------------

--
-- Table structure for table `studentexamsecrets`
--

CREATE TABLE `studentexamsecrets` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentId` int(11) NOT NULL,
  `secret` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studentreports`
--

CREATE TABLE `studentreports` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentId` int(11) NOT NULL,
  `result` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0-Incomplete,1-Complete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentexamsecrets`
--
ALTER TABLE `studentexamsecrets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentexamsecrets_studentid_unique` (`studentId`),
  ADD UNIQUE KEY `studentexamsecrets_secret_unique` (`secret`);

--
-- Indexes for table `studentreports`
--
ALTER TABLE `studentreports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentreports_studentid_index` (`studentId`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_name_index` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `studentexamsecrets`
--
ALTER TABLE `studentexamsecrets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentreports`
--
ALTER TABLE `studentreports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
