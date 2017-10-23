-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 23, 2017 at 12:58 PM
-- Server version: 5.7.17
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `account_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE IF NOT EXISTS `accounts_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `place` varchar(20) NOT NULL DEFAULT 'confirmed',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `account_type_id` (`account_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`id`, `first_name`, `last_name`, `email`, `account_type_id`, `place`, `active`) VALUES
(9, 'Mieraf', 'Aboye', 'mieraf.m.aboye@gmail.com', 2, 'deactivated', 0),
(10, 'Mafi', 'Aboye', 'mafimaboye@gmail.com', 3, 'confirmed', 0),
(11, 'Lati', 'Fufa', 'lati.fufa@gmail.com', 2, 'activated', 1),
(12, 'Brhane', 'Abrham', 'brhane@gmail.com', 2, 'confirmed', 0),
(13, 'Yaphet ', 'Kebede', 'gobi@gmail.com', 3, 'confirmed', 0),
(14, 'Hermela', 'Aboye', 'hermi@gmail.com', 2, 'deactivated', 0),
(15, 'Eyerusalem', 'Aboye', 'eyeru@gmail.com', 3, 'confirmed', 0),
(16, 'Abebe ', 'Kebede', 'abe.kebe@gmail.com', 3, 'confirmed', 0),
(17, 'Meketa', 'Bokan', 'meketa@gmail.com', 3, 'setup', 0),
(18, 'Nigatwa', 'Alemu', 'nigat@gmail.com', 2, 'confirmed', 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_types_tbl`
--

CREATE TABLE IF NOT EXISTS `account_types_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_type` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL,
  `cost` decimal(4,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `account_types_tbl`
--

INSERT INTO `account_types_tbl` (`id`, `account_type`, `description`, `cost`) VALUES
(2, 'Business', 'Checking Account', '100'),
(3, 'Savings', 'Savings Account', '500');

-- --------------------------------------------------------

--
-- Table structure for table `transitions_tbl`
--

CREATE TABLE IF NOT EXISTS `transitions_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `from` varchar(20) NOT NULL,
  `to` varchar(20) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `transitions_tbl`
--

INSERT INTO `transitions_tbl` (`id`, `account_id`, `from`, `to`, `timestamp`, `message`) VALUES
(27, 9, 'confirmed', 'setup', '2017-09-17 22:59:58', 'setting up my account'),
(28, 9, 'setup', 'activated', '2017-09-22 23:06:05', 'activating my account'),
(29, 9, 'activated', 'deactivated', '2017-10-19 23:07:50', NULL),
(30, 11, 'confirmed', 'setup', '2017-10-21 07:32:57', 'Lati is logging'),
(32, 11, 'setup', 'activated', '2017-10-21 07:39:39', 'activating..'),
(33, 14, 'confirmed', 'setup', '2017-10-23 07:41:22', 'Hermi is setting up'),
(34, 17, 'confirmed', 'setup', '2017-10-23 07:41:43', 'Meketa is setting up'),
(35, 14, 'setup', 'deactivated', '2017-10-23 07:41:56', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD CONSTRAINT `accounts_tbl_ibfk_1` FOREIGN KEY (`account_type_id`) REFERENCES `account_types_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transitions_tbl`
--
ALTER TABLE `transitions_tbl`
  ADD CONSTRAINT `transitions_tbl_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts_tbl` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
