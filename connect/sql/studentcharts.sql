-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 10, 2012 at 06:01 AM
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
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `creator_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `object1` int(11) DEFAULT NULL,
  `object2` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `creator_id`, `type`, `receiver_id`, `object1`, `object2`, `school_id`, `activity_date`) VALUES
(4, 1022, 1, 1022, 0, 0, 1, '2012-05-21 01:30:30'),
(5, 1023, 2, 1023, 0, 0, 2, '2012-05-21 01:31:40'),
(6, 1024, 3, 1024, 0, 0, 1, '2012-05-21 02:04:26'),
(7, 1025, 4, 1026, 0, 0, 1, '2012-05-21 02:06:21'),
(8, 1026, 8, 1027, 0, 0, 2, '2012-05-21 02:08:55'),
(9, 1027, 1, 2, 0, 0, 2, '2012-05-21 02:15:09'),
(10, 1028, 9, 1, 0, 0, 1, '2012-05-21 02:31:30'),
(11, 1028, 25, 1022, 2, NULL, 4, '2012-06-03 23:28:26'),
(12, 1028, 21, 1022, 2, NULL, 4, '2012-06-03 23:28:43'),
(13, 1028, 12, 1024, 6, NULL, 4, '2012-06-03 23:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `activitytype`
--

CREATE TABLE IF NOT EXISTS `activitytype` (
  `type_id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `statement` text NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `activitytype`
--

INSERT INTO `activitytype` (`type_id`, `name`, `statement`) VALUES
(1, 'registered', 'student1 has registered and requires n sponsors for approval.'),
(2, 'membership', 'student1 has been approved for membership.'),
(3, 'approval', 'student1''s statement, "statements" has been approved for National Totem.'),
(4, 'like membership', 'student1 liked student2''s membership'),
(5, 'like comment', 'student1 liked student2''s comment:"contents".\r\n'),
(6, 'like statement', 'student1 liked student2''s statement:"contents"'),
(7, 'like profile picture', 'student1 liked student2''s profile picture. profile_image'),
(8, 'like statement image', 'student1 liked the image in "topic": topic_image'),
(9, 'like lecture notes', 'student1 liked student2''s lecture note, titled: "contents" lecture_image'),
(10, 'like study aid', 'student1 liked student2''s study aid, titled: "contents" studyaid_image'),
(11, 'like event', 'student1 liked student2''s event, titled: "contents" '),
(12, 'sponsor statement refinement', 'student1 refined statement,"contents" and requires n sponsors for approval.'),
(13, 'sponsor new topic', 'student1 proposes "new_topic" in "subject" and requires n sponsors for approval.'),
(14, 'sponsor new subject', 'student1 proposes "new_subject" and requires n sponsors for approval.'),
(15, 'upload profile image', 'student1 uploaded a new profile picture '),
(16, 'upload statement image', 'student1 uploaded a new image in "topic".'),
(17, 'upload lecture notes', 'student1 uploaded lecture notes titled: "lecture_note_title".'),
(18, 'upload study aid (national)', 'student1 uploaded a study aid, "study_aid_title", to the National Stockpile.'),
(19, 'upload study aid (local)', 'student1 uploaded a study aid, "study_aid_title", to the School_Name Stockpile.'),
(20, 'update', 'student1 updated profile'),
(21, 'comment profile', 'student1 said "comments" to student2 '),
(22, 'comment lecture notes', 'student1 said "comments" on "lecture_note_title" '),
(23, 'comment study aid', 'student1 said "comments" on "study_aid_title" '),
(24, 'comment totem', 'student1 said "comments" for "topic" in "subject" '),
(25, 'comment profile picture', 'student1 commented on student2s profile picture '),
(26, 'comment statement image', 'student1 commented on the image for "topic" in "subject" '),
(27, 'event', 'student1 posited an event, "event_title" for date ');

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `school_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `state` varchar(45) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  PRIMARY KEY (`school_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `name`, `city`, `state_id`, `state`, `zip`) VALUES
(1, 'University of California Los Angeles (UCLA)', 'Los Angeles', 2, 'California', 90036),
(2, 'University of California Irvine (UCI)', 'Orange County', 2, 'California', 90232),
(3, 'University of California Berkely', 'San Francisco', 2, 'California', 90008),
(4, 'Standford University', 'San Francisco', 2, 'California', 90008),
(5, 'Harword', 'San Francisco', 2, 'California', 90008),
(6, 'California Institute', 'San Francisco', 2, 'California', 90008),
(7, 'University of southern california (USC)', 'San Francisco', 2, 'California', 90008),
(8, 'University of southern Forniad ', 'San Francisco', 2, 'California', 90008),
(9, 'Princeton University', 'Princeton, NJ', 33, 'New Jersey', 90008),
(11, 'Yale University', 'Princeton, New Haven, CT', 21, 'CT', 90008),
(12, 'Massachusetts Institute of Technology', 'Princeton, New Haven, CT', 1, 'nj', 90008);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `userID`) VALUES
(1, 'frankrao.usc@gmail.com', '12345678', 1028);

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE IF NOT EXISTS `users_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `school_id` int(11) NOT NULL,
  `school_year` int(11) NOT NULL,
  `class_year` int(11) NOT NULL,
  `phone_num` int(11) DEFAULT NULL,
  `pager_num` int(11) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `linkedin` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `google` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `roommates` varchar(45) DEFAULT NULL,
  `hospital` varchar(45) DEFAULT NULL,
  `usertype` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login_date` timestamp NULL DEFAULT NULL,
  `last_visit_date` timestamp NULL DEFAULT NULL,
  `sponsor_num` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1029 ;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `first_name`, `last_name`, `school_id`, `school_year`, `class_year`, `phone_num`, `pager_num`, `facebook`, `linkedin`, `twitter`, `google`, `location`, `ip_address`, `roommates`, `hospital`, `usertype`, `date_created`, `last_login_date`, `last_visit_date`, `sponsor_num`, `status`) VALUES
(1022, 'Maulik', 'Dholaria', 1, 2008, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 01:30:30', NULL, NULL, 0, 1),
(1023, 'Ed', 'Wang', 2, 2014, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 01:31:40', NULL, NULL, 0, 1),
(1024, 'Jay', 'Li', 1, 2013, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 02:04:26', NULL, NULL, 0, 1),
(1025, 'David', 'Chen', 1, 2012, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 02:06:21', NULL, NULL, 0, 1),
(1026, 'Bill', 'Chen', 2, 2014, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 02:08:55', NULL, NULL, 0, 1),
(1027, 'Maulik', 'Dholaria', 2, 2010, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 02:15:09', NULL, NULL, 0, 1),
(1028, 'Feng', 'Rao', 1, 2005, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2012-05-21 02:31:30', NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_has_activity`
--

CREATE TABLE IF NOT EXISTS `user_has_activity` (
  `user_user_id` int(11) NOT NULL,
  `activity_activity_id` int(11) NOT NULL,
  PRIMARY KEY (`user_user_id`,`activity_activity_id`),
  KEY `fk_user_has_activity_activity1` (`activity_activity_id`),
  KEY `fk_user_has_activity_user1` (`user_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_has_activity`
--
ALTER TABLE `user_has_activity`
  ADD CONSTRAINT `fk_user_has_activity_activity1` FOREIGN KEY (`activity_activity_id`) REFERENCES `activities` (`activity_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_activity_user1` FOREIGN KEY (`user_user_id`) REFERENCES `users_info` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
