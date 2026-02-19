-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2026 at 06:50 PM
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
-- Database: `kkliving_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_cmp_customers`
--

CREATE TABLE `wp_cmp_customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `cr_number` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_cmp_customers`
--

INSERT INTO `wp_cmp_customers` VALUES(2, 'John', 'nayana123@gmail.com', '9855862536', '2026-02-10', 'Male', 'gbvcfvhgfcgcbbb', 'ffgfftttt', 'mlr', 'india', 'active', '2026-02-19 21:43:53');
INSERT INTO `wp_cmp_customers` VALUES(3, 'varun', 'varun@gmail.com', '9855862536', '2014-02-18', 'male', 'gbvcfvhgfcgcbbb', 'ffgfftttt', 'mlr', 'india', 'inactive', '2026-02-19 21:45:04');
INSERT INTO `wp_cmp_customers` VALUES(4, 'priya', 'priya@gmail.com', '9114665235', '2009-06-16', 'Female', 'priya125', 'mangalore', 'mangalore', 'india', 'active', '2026-02-19 22:32:50');
INSERT INTO `wp_cmp_customers` VALUES(5, 'Mourya', 'Mourya@gmail.com', '9855862536', '2010-02-17', 'Male', 'Mourya565', 'mangalore', 'mysore', 'india', 'active', '2026-02-19 23:11:20');
INSERT INTO `wp_cmp_customers` VALUES(6, 'Siya', 'Siya@gmail.com', '5258795896', '2004-06-15', 'Female', 'Siya8596', 'Durgapura', 'bangalore', 'india', 'active', '2026-02-19 23:12:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wp_cmp_customers`
--
ALTER TABLE `wp_cmp_customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wp_cmp_customers`
--
ALTER TABLE `wp_cmp_customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
