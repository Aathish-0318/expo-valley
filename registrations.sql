-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2025 at 10:08 AM
-- Server version: 5.7.29
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tnhappyki_expo`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(11) NOT NULL,
  `studentName` varchar(100) DEFAULT NULL,
  `studentAge` int(11) DEFAULT NULL,
  `studentParticipation` varchar(50) DEFAULT NULL,
  `parentName` varchar(100) DEFAULT NULL,
  `hasSibling` tinyint(1) DEFAULT NULL,
  `siblingName` varchar(100) DEFAULT NULL,
  `siblingAge` int(11) DEFAULT NULL,
  `siblingParticipation` varchar(50) DEFAULT NULL,
  `parentPhone` varchar(15) DEFAULT NULL,
  `parentEmail` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `studentName`, `studentAge`, `studentParticipation`, `parentName`, `hasSibling`, `siblingName`, `siblingAge`, `siblingParticipation`, `parentPhone`, `parentEmail`, `created_at`) VALUES
(38, 'Abhilash ', 1, 'Drawing', 'Abhi', 0, '', 0, '', '9361634189', 'abikavirahul1234@gmail.com', '2025-08-14 06:35:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
