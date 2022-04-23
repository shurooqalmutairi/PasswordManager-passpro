-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 11, 2022 at 04:46 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projects2022_passwordmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `account_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `notes` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `account_name`, `email`, `password`, `notes`) VALUES
(4, 1, 'JjG7iG6O5cXEYFCisV2Fbg==', 'HgW0hgbuFeFjBGYUqlZ/JFWjew5Ifcx2pkBa4zJQBRE=', 'w/ly3PUofx6HSV9g7LSshK///bmEa2p7i9t/eOZI8rw=', 'WFQAWBFUAIrzA1zsD9E7kRkh0T66tA9FPDI7xI6EFSrHg/JH5uAmV3C2NMS349aM');

-- --------------------------------------------------------

--
-- Table structure for table `login_request`
--

DROP TABLE IF EXISTS `login_request`;
CREATE TABLE IF NOT EXISTS `login_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `req_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_request`
--

INSERT INTO `login_request` (`id`, `user_id`, `req_time`, `code`) VALUES
(1, 1, '2022-02-24 21:29:27', 286749),
(2, 1, '2022-02-24 21:36:01', 769123),
(3, 1, '2022-02-25 19:00:07', 947052),
(4, 1, '2022-02-26 17:54:12', 328165),
(5, 1, '2022-02-26 17:57:56', 162342),
(6, 1, '2022-03-08 17:51:51', 112082);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Ahmed', 'wahmalik85@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e'),
(2, 'Farah', 'ah@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'Ahmed', 'ahmed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'admin', 'admin@admin.com', 'bea364dbadced95a1b048c9b5218cea2');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `info` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `addDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `title`, `info`, `addDate`) VALUES
(2, 1, 'iuAEpHpjkC1C7mh7/OXeeiT/FIoIXsZqVeFlkhdNoDU=', 'DHGZMJxySCg8fJJPeIXehxQE0FwkEYqXQ0ekbLF//rc=', '2022-03-08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
