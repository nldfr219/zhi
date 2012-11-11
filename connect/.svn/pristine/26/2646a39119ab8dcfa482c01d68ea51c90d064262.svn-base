-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2012 at 09:07 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `studentcharts`
--

-- --------------------------------------------------------

--
-- Table structure for table `popularity`
--

CREATE TABLE IF NOT EXISTS `popularity` (
  `object_type` int(11) NOT NULL COMMENT '1 for chat page, 2 for profile page, 3 for totem',
  `object_id` int(11) NOT NULL COMMENT 'shcool id or user id or totem id',
  `class_year` int(11) NOT NULL COMMENT 'class year',
  `school_id` int(11) NOT NULL COMMENT 'user''s school id ',
  `num` int(11) NOT NULL DEFAULT '1' COMMENT 'number of click times',
  PRIMARY KEY (`object_type`,`object_id`,`class_year`,`school_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popularity`
--

INSERT INTO `popularity` (`object_type`, `object_id`, `class_year`, `school_id`, `num`) VALUES
(1, 0, 3, 1, 2),
(1, 1, 3, 1, 4),
(1, 2, 3, 1, 3),
(1, 3, 3, 1, 2),
(1, 4, 3, 1, 5),
(1, 5, 3, 1, 7),
(1, 6, 3, 1, 8),
(1, 7, 3, 1, 1),
(1, 8, 3, 1, 1),
(1, 12, 3, 1, 341);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
