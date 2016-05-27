-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2016 at 11:51 AM
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
  `joindate` date NOT NULL,
  `level` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `fullname`, `username`, `email`, `phone`, `avatar`, `description`, `birthday`, `sex`, `password`, `joindate`, `level`) VALUES
(1, 'USER', 'user', 'user@gmail.com', '0123456789', '../train06/images/avatar/user.png', 'i am is user', '1993-07-26', 1, 'ee11cbb19052e40b07aac0ca060c23ee', '2016-05-24', 0),
(2, 'ADMOD', 'admod', 'admod@gmail.com', '0987654321', '../train06/images/avatar/admod.png', 'i am is admod', '0000-00-00', 0, 'cc145c8d6da1239816744e2634ada963', '2016-05-24', 1),
(3, 'ADMINISTRATOR', 'administrator', 'administrator@gmail.com', '0968242682', '../train06/images/avatar/administrator.png', 'i am is administrator', '0000-00-00', 0, '200ceb26807d6bf99fd6f4f0d1ca54d4', '2016-05-24', 2),
(7, 'user2', 'user2', 'user2@gmail.com', '01111', '../train06/images/avatar/user2.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 1),
(14, 'user9', 'user9', 'user9@yahoo.com', '0986757', '../train06/images/avatar/user9.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 0),
(15, 'user10', 'user10', 'user10@gmail.com', '10010101', '../train06/images/avatar/user10.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 0),
(16, 'user11', 'user11', 'user11@gmail.com', '9393993', '../train06/images/avatar/user11.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 0),
(17, 'user12', 'user12', 'user12@gmail.com', '0192929', '../train06/images/avatar/all.png', NULL, '0000-00-00', 0, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 0),
(18, 'user13', 'user13', 'user13@gmail.com', '339939393', '../train06/images/avatar/user13.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-26', 0),
(19, 'user14', 'user14', 'user14@yaho.com', '93937474', '../train06/images/avatar/all.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-27', 0),
(20, 'user15', 'user15', 'user15@gmail.com', '1223424', '../train06/images/avatar/user15.png', NULL, NULL, NULL, 'c4ca4238a0b923820dcc509a6f75849b', '2016-05-27', 0);

--
-- Indexes for dumped tables
--

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
