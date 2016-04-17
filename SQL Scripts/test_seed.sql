-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2016 at 10:48 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CompanyCalendar`
--

DROP TABLE IF EXISTS `event`;
DROP TABLE IF EXISTS `category`;
DROP TABLE IF EXISTS `user`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `color` text NOT NULL,
  `work_time` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `category` int(11) DEFAULT NULL,
  `employee` varchar(32) DEFAULT NULL,
  `work_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(32) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `role` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `event_employee` (`employee`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_user` FOREIGN KEY (`employee`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `event_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `first_name`, `last_name`, `role`, `active`) VALUES
('johnsmith', 'John', 'Smith', 0, 1),
('bobparr', 'Bob', 'Parr', 0, 1),
('ronpaul', 'Ron', 'Paul', 0, 1);

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `color`, `work_time`, `active`) VALUES
(1, 'Birthday', 'FF9999', 0, 1),
(2, 'Sick Day', '99FF99', 1, 1),
(3, 'Meeting', '9999FF', 0, 1);

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `description`, `start_date`, `end_date`, `category`, `employee`, `work_time`) VALUES
(1, 'Safety Meeting', 'Go out to a bar after work.', '2016-04-07 17:00:00', '2016-04-07 20:00:00', 3, NULL, NULL),
(2, 'John Out of Office', 'John Smith has a cold.', '2016-04-12 00:00:00', '2016-04-14 00:00:00', 2, 'johnsmith', '16:30:00'),
(3, 'Bob\'s Birthday', 'Happy birthday, Bobby!', '2016-04-13 00:00:00', '2016-04-13 23:59:59', 1, 'bobparr', NULL),
(4, 'Training Seminar', 'John Smith has a cold.', '2016-04-10 00:00:00', '2016-04-13 00:00:00', 3, NULL, NULL);

