-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2018 at 07:10 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `release_date` date NOT NULL,
  `rating` varchar(50) NOT NULL,
  `ticket_price` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `genre` varchar(50) NOT NULL,
  `photo` text NOT NULL,
  `slug` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `description`, `release_date`, `rating`, `ticket_price`, `country`, `genre`, `photo`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Hello World', 'Test Description', '2018-10-03', '5', '120', 'India', 'Test', 'https://www.w3schools.com/w3images/lights.jpg', 'Movies_Hello_World', '2018-10-02 18:30:00', '2018-10-02 18:30:00'),
(5, 'Marathi Video Status', 'zxczxc', '0000-00-00', '', 'zxc', 'zxc', 'zxc', 'images/1538590235.png', '', '2018-10-03 13:40:35', '2018-10-03 13:40:35'),
(6, 'Marathi Video Status', 'Marathi Video Status', '0000-00-00', '', 'Marathi Video Status', 'Marathi Video Status', 'Marathi Video Status', 'images/1538590330.jpg', 'Movies_1538590330', '2018-10-03 13:42:10', '2018-10-03 13:42:10'),
(7, 'Marathi Video Status', 'Marathi Video Status', '0000-00-00', '', 'Marathi Video Status', 'Marathi Video Status', 'Marathi Video Status', 'images/1538590407.jpg', 'Movies_1538590407', '2018-10-03 13:43:27', '2018-10-03 13:43:27'),
(8, 'Marathi Video Status', 'Marathi Video Status', '0000-00-00', '', 'Marathi Video Status', 'Marathi Video Status', 'Marathi Video Status', 'images/1538590453.jpg', 'Movies_1538590453', '2018-10-03 13:44:13', '2018-10-03 13:44:13'),
(9, 'Marathi Video Status', 'zxczxc', '0000-00-00', '', 'zxczx', 'czxc', 'zxc', 'images/1538590467.jpg', 'Movies_1538590467', '2018-10-03 13:44:27', '2018-10-03 13:44:27'),
(10, 'Marathi Video Status', 'zxczxc', '0000-00-00', '', 'zxczx', 'czxc', 'zxc', 'images/1538590480.jpg', 'Movies_1538590480', '2018-10-03 13:44:40', '2018-10-03 13:44:40'),
(11, 'Marathi Video Status', 'zxcz', '0000-00-00', '', 'zxczx', 'czxcz', 'xczxc', 'images/1538590506.jpg', 'Movies_1538590506', '2018-10-03 13:45:06', '2018-10-03 13:45:06'),
(12, 'cv', 'xcv', '0000-00-00', '', 'xcv', 'xcv', 'xcv', 'images/1538592030.png', 'Movies_1538592030', '2018-10-03 14:10:30', '2018-10-03 14:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `remember_token` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$780G0.1myvMtP/3Mdeto4O4OOO5NlYyyUffpe/BTaEWKeiggpBz2e', '8CMw4gdGMJeaIu3WSYBoh5Pp3FN1gadcDeVkAXk0Bez3uDJIKiO7JkEKpNqF', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
