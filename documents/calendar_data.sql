-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2016 at 05:38 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `calendar`
--

--
-- Dumping data for table `event_types`
--

INSERT INTO `event_types` (`id`, `types`) VALUES
(1, 'Employee Birthday'),
(2, 'Employee Anniversary'),
(3, 'Company Events'),
(4, 'Company Holidays'),
(5, 'Out Of Office'),
(6, 'Vacation'),
(7, 'Training'),
(8, 'Visitor'),
(9, 'Sick Days');

--
-- Dumping data for table `out_of_office_time`
--

INSERT INTO `out_of_office_time` (`id`, `users`, `vacation_hours`, `sick_days`) VALUES
(1, 1, 80, 0),
(2, 2, 80, 0);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `role`, `date_of_birth`, `start_date`) VALUES
(1, 'Durrell', 'Lyons', 'dlyons_admin', '0a59b32b50ad1ed26f9ded829b2b0187', 1, '1985-09-17', '2015-08-10'),
(2, 'Durrell', 'Lyons', 'dlyons_user', '0a59b32b50ad1ed26f9ded829b2b0187', 2, '1985-09-17', '2012-06-02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
