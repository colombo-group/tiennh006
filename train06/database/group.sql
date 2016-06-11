-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2016 at 06:46 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `group`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `count` int(10) NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`id` int(10) unsigned NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` int(10) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `introducer` varchar(30) DEFAULT NULL,
  `joindate` date NOT NULL,
  `level` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `fullname`, `username`, `email`, `phone`, `avatar`, `description`, `birthday`, `sex`, `password`, `introducer`, `joindate`, `level`) VALUES
(1, 'USER', 'user', 'user@gmail.com', '0123456789', '/public/images/user.png', 'i am is user', '1993-07-26', 1, 'ee11cbb19052e40b07aac0ca060c23ee', NULL, '2016-05-24', 0),
(2, 'ADMOD', 'admod', 'admod@gmail.com', '0987654321', '/public/images/admod.png', 'i am is admod', '0000-00-00', 0, 'cc145c8d6da1239816744e2634ada963', NULL, '2016-05-24', 1),
(3, 'ADMINISTRATOR', 'administrator', 'administrator@gmail.com', '0968242682', '/public/images/administrator.png', 'i am is administrator', '0000-00-00', 0, '200ceb26807d6bf99fd6f4f0d1ca54d4', NULL, '2016-05-24', 2),
(7, 'user2', 'user2', 'user2@gmail.com', '01111', '/public/images/user2.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 1),
(14, 'user9', 'user9', 'user9@yahoo.com', '0986757', '/public/images/user9.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 0),
(15, 'user10', 'user10', 'user10@gmail.com', '10010101', '/public/images/user10.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 0),
(16, 'user11', 'user11', 'user11@gmail.com', '9393993', '/public/images/user11.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 0),
(17, 'user12', 'user12', 'user12@gmail.com', '0192929', '/public/images/all.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 0),
(18, 'user13', 'user13', 'user13@gmail.com', '339939393', '/public/images/user13.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-26', 0),
(19, 'user14', 'user14', 'user14@yaho.com', '93937474', '/public/images/all.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-27', 0),
(20, 'user15', 'user15', 'user15@gmail.com', '1223424', '/public/images/user15.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-05-27', 0),
(25, 'user3', 'user3', 'user3@gmail.com', '354668789789', '/public/images/user3.png', 'fffff', '1993-07-26', 1, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-06-10', 0),
(26, 'user4', 'user4', 'user4@gmail.com', '344645766778', '/public/images/all.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', NULL, '2016-06-10', 0),
(27, 'user5', 'user5', 'user5@gmail.com', '54647576866', '/public/images/user5.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', 'user', '2016-06-10', 0),
(28, 'user6', 'user6', 'user6@gmail.com', '4546687990', '/public/images/all.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', 'user', '2016-06-11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
