-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 09, 2012 at 09:59 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ars`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(2) NOT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Administrator Data';

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` VALUES(0, 'Tirth Bodawala', 1, 'tirthbodawala', 'e10adc3949ba59abbe56e057f20f883e', '2012-01-08 00:00:00', '2012-01-08 00:00:00');

-- --------------------------------------------------------

--
-- Stand-in structure for view `attendances`
--
CREATE TABLE `attendances` (
`attendancedate` datetime
,`teacherattendance_id` int(11)
,`studentattendance_id` int(11)
);
-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Blocks for schools';

--
-- Dumping data for table `blocks`
--


-- --------------------------------------------------------

--
-- Table structure for table `castes`
--

CREATE TABLE `castes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='To Store the information of other castes' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `castes`
--

INSERT INTO `castes` VALUES(1, 'GEN');
INSERT INTO `castes` VALUES(2, 'OBC');
INSERT INTO `castes` VALUES(3, 'SC');
INSERT INTO `castes` VALUES(4, 'ST');

-- --------------------------------------------------------

--
-- Table structure for table `clusters`
--

CREATE TABLE `clusters` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `block_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Clusters for denoting sub-region inside blocks';

--
-- Dumping data for table `clusters`
--


-- --------------------------------------------------------

--
-- Table structure for table `disabilities`
--

CREATE TABLE `disabilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Disabilities List	' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `disabilities`
--

INSERT INTO `disabilities` VALUES(1, 'None');
INSERT INTO `disabilities` VALUES(2, 'Mental');
INSERT INTO `disabilities` VALUES(3, 'Orthopedic');
INSERT INTO `disabilities` VALUES(4, 'Visual');

-- --------------------------------------------------------

--
-- Table structure for table `jobtypes`
--

CREATE TABLE `jobtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='To store the job-type of the teacher' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jobtypes`
--

INSERT INTO `jobtypes` VALUES(1, 'Registered', '2011-12-18 00:00:00', '2011-12-18 00:00:00');
INSERT INTO `jobtypes` VALUES(2, 'Contract', '2011-12-18 00:00:00', '2011-12-18 00:00:00');
INSERT INTO `jobtypes` VALUES(3, 'Vidhya Sahayak', '2011-12-18 00:00:00', '2011-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id of location',
  `location` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of locations',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location_UNIQUE` (`location`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This table holds the data of location where the schools are ' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` VALUES(1, 'Vadodara', '2011-12-17 00:00:00', '2011-12-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE `reasons` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Reasons for being absent for teacher/Student';

--
-- Dumping data for table `reasons`
--


-- --------------------------------------------------------

--
-- Table structure for table `schoolcategories`
--

CREATE TABLE `schoolcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `schoolcategories`
--


-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'School''s Id',
  `schoolid` int(10) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of the School',
  `address` varchar(512) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Address of the school',
  `location_id` int(11) NOT NULL COMMENT 'Represents the location of the school',
  `loginid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `block_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `cluster_id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `disecode` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `regno_UNIQUE` (`schoolid`),
  UNIQUE KEY `loginid_UNIQUE` (`loginid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This table stores data of all the schools' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` VALUES(1, 1234567890, 'Bright School', 'Char Buja Complex Vadodara', 1, 'bright_school_granted', 'e10adc3949ba59abbe56e057f20f883e', '2011-12-17 00:00:00', '2011-12-17 00:00:00', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Sections for students & Class Teachers' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` VALUES(1, 'A');
INSERT INTO `sections` VALUES(2, 'B');
INSERT INTO `sections` VALUES(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name of Standard usually, 1,2,3...',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `standards`
--

INSERT INTO `standards` VALUES(1, '1');
INSERT INTO `standards` VALUES(2, '2');
INSERT INTO `standards` VALUES(3, '3');
INSERT INTO `standards` VALUES(4, '4');
INSERT INTO `standards` VALUES(5, '5');
INSERT INTO `standards` VALUES(6, '6');
INSERT INTO `standards` VALUES(7, '7');
INSERT INTO `standards` VALUES(8, '8');

-- --------------------------------------------------------

--
-- Table structure for table `studentattendances`
--

CREATE TABLE `studentattendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `present` int(1) NOT NULL,
  `attendancedate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `reason_id` int(11) NOT NULL,
  `reason` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Student''s Attendance' AUTO_INCREMENT=27 ;

--
-- Dumping data for table `studentattendances`
--

INSERT INTO `studentattendances` VALUES(1, 1, 1, '2011-12-01 00:00:00', '2012-01-03 16:10:05', '2012-01-03 16:19:52', 0, '');
INSERT INTO `studentattendances` VALUES(2, 3, 0, '2011-12-01 00:00:00', '2012-01-03 16:10:05', '2012-01-03 16:19:52', 0, '');
INSERT INTO `studentattendances` VALUES(3, 4, 1, '2011-12-01 00:00:00', '2012-01-03 16:10:05', '2012-01-03 16:19:52', 0, '');
INSERT INTO `studentattendances` VALUES(4, 2, 1, '2011-12-01 00:00:00', '2012-01-03 16:22:53', '2012-01-03 16:22:53', 0, '');
INSERT INTO `studentattendances` VALUES(5, 1, 0, '2011-12-02 00:00:00', '2011-12-02 00:00:00', '2012-01-03 18:52:49', 0, '');
INSERT INTO `studentattendances` VALUES(6, 3, 1, '2011-12-02 00:00:00', '2012-01-03 17:23:56', '2012-01-03 18:52:49', 0, '');
INSERT INTO `studentattendances` VALUES(7, 4, 1, '2011-12-02 00:00:00', '2012-01-03 17:23:56', '2012-01-03 18:52:49', 0, '');
INSERT INTO `studentattendances` VALUES(8, 2, 1, '2011-12-02 00:00:00', '2012-01-03 17:26:45', '2012-01-03 17:26:45', 0, '');
INSERT INTO `studentattendances` VALUES(9, 1, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:22', '2012-01-03 22:08:27', 0, '');
INSERT INTO `studentattendances` VALUES(10, 3, 0, '2012-01-03 00:00:00', '2012-01-03 20:48:22', '2012-01-03 22:08:27', 0, '');
INSERT INTO `studentattendances` VALUES(11, 4, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:22', '2012-01-03 22:08:27', 0, '');
INSERT INTO `studentattendances` VALUES(17, 4, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-08 12:22:43', 0, '');
INSERT INTO `studentattendances` VALUES(16, 3, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-08 12:22:43', 0, '');
INSERT INTO `studentattendances` VALUES(15, 1, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-08 12:22:43', 0, '');
INSERT INTO `studentattendances` VALUES(18, 1, 0, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-03 22:10:29', 0, '');
INSERT INTO `studentattendances` VALUES(19, 3, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-03 22:10:29', 0, '');
INSERT INTO `studentattendances` VALUES(20, 4, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:29', '2012-01-03 22:10:29', 0, '');
INSERT INTO `studentattendances` VALUES(21, 1, 1, '2012-01-11 00:00:00', '2012-01-03 22:13:04', '2012-01-08 12:21:53', 0, '');
INSERT INTO `studentattendances` VALUES(22, 3, 0, '2012-01-11 00:00:00', '2012-01-03 22:13:04', '2012-01-08 12:21:53', 0, '');
INSERT INTO `studentattendances` VALUES(23, 4, 1, '2012-01-11 00:00:00', '2012-01-03 22:13:04', '2012-01-08 12:21:53', 0, '');
INSERT INTO `studentattendances` VALUES(24, 1, 1, '2012-01-16 00:00:00', '2012-01-08 12:17:35', '2012-01-08 12:21:42', 0, '');
INSERT INTO `studentattendances` VALUES(25, 3, 1, '2012-01-16 00:00:00', '2012-01-08 12:17:35', '2012-01-08 12:21:42', 0, '');
INSERT INTO `studentattendances` VALUES(26, 4, 0, '2012-01-16 00:00:00', '2012-01-08 12:17:35', '2012-01-08 12:21:42', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `generalregister` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `standard_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `caste_id` int(11) NOT NULL,
  `disability_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table Holding Student''s Data' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `students`
--

INSERT INTO `students` VALUES(1, 'Tirth Bodawala', 1, '07ESHCS023', 8, 1, 'M', '1989-06-14 00:00:00', 1, 1, 1, '2012-01-03 11:53:52', '2012-01-03 11:59:14');
INSERT INTO `students` VALUES(2, 'Kirtan Bodawala', 1, '07ESHCS025', 6, 2, 'M', '1991-10-08 00:00:00', 1, 3, 1, '2012-01-03 11:59:57', '2012-01-03 17:27:20');
INSERT INTO `students` VALUES(3, 'Aashka Bodawala', 1, '07ESHCS040', 8, 1, 'F', '1987-12-03 00:00:00', 1, 1, 2, '2012-01-03 12:03:14', '2012-01-03 15:16:14');
INSERT INTO `students` VALUES(4, 'Hari Rao', 1, '07ESHCS034', 8, 1, 'M', '1990-05-01 00:00:00', 1, 1, 1, '2012-01-03 12:04:18', '2012-01-08 14:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `teacherattendances`
--

CREATE TABLE `teacherattendances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `present` int(1) NOT NULL,
  `attendancedate` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `reason_id` int(11) NOT NULL,
  `reason` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=335 ;

--
-- Dumping data for table `teacherattendances`
--

INSERT INTO `teacherattendances` VALUES(46, 67, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(45, 68, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(44, 10, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(43, 9, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(42, 8, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(41, 7, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(40, 6, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(39, 5, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(38, 4, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(37, 3, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(36, 2, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(35, 1, 0, '2011-12-02 00:00:00', '2012-01-03 19:05:43', '2012-01-08 12:32:37', 0, '');
INSERT INTO `teacherattendances` VALUES(23, 1, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(24, 2, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(25, 3, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(26, 4, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(27, 5, 0, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(28, 6, 0, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(29, 7, 0, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(30, 8, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(31, 9, 0, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(32, 10, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(33, 68, 1, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(34, 67, 0, '2011-12-01 00:00:00', '2012-01-03 18:26:30', '2012-01-08 12:32:35', 0, '');
INSERT INTO `teacherattendances` VALUES(47, 1, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(48, 2, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(49, 3, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(50, 4, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(51, 5, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(52, 6, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(53, 7, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(54, 8, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(55, 9, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(56, 10, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(57, 68, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(58, 67, 1, '2011-12-02 00:00:00', '2012-01-03 19:05:45', '2012-01-03 19:05:45', 0, '');
INSERT INTO `teacherattendances` VALUES(334, 67, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(333, 68, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(332, 10, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(331, 9, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(330, 8, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(329, 7, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(328, 6, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(327, 5, 0, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(326, 4, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(325, 3, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(324, 2, 1, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(323, 1, 0, '2012-01-11 00:00:00', '2012-01-08 12:22:08', '2012-01-08 12:22:30', 0, '');
INSERT INTO `teacherattendances` VALUES(322, 67, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(321, 68, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(320, 10, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(319, 9, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(318, 8, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(317, 7, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(316, 6, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(315, 5, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(314, 4, 1, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(313, 3, 0, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(312, 2, 0, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(311, 1, 0, '2012-01-16 00:00:00', '2012-01-03 22:13:23', '2012-01-08 12:32:31', 0, '');
INSERT INTO `teacherattendances` VALUES(310, 67, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(309, 68, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(308, 10, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(307, 9, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(306, 8, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(305, 7, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(304, 6, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(303, 5, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(302, 4, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(301, 3, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(300, 2, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(299, 1, 1, '2012-01-10 00:00:00', '2012-01-03 22:10:36', '2012-01-03 22:10:36', 0, '');
INSERT INTO `teacherattendances` VALUES(298, 67, 0, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:14', 0, '');
INSERT INTO `teacherattendances` VALUES(297, 68, 0, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:14', 0, '');
INSERT INTO `teacherattendances` VALUES(296, 10, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(295, 9, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(294, 8, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(293, 7, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(292, 6, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(291, 5, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(290, 4, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(289, 3, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(288, 2, 1, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(287, 1, 0, '2012-01-05 00:00:00', '2012-01-03 21:01:10', '2012-01-03 21:09:13', 0, '');
INSERT INTO `teacherattendances` VALUES(286, 67, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(285, 68, 0, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(284, 10, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(283, 9, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(282, 8, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(281, 7, 0, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(280, 6, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(279, 5, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(278, 4, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(277, 3, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(276, 2, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(275, 1, 1, '2012-01-04 00:00:00', '2012-01-03 20:50:01', '2012-01-03 21:09:33', 0, '');
INSERT INTO `teacherattendances` VALUES(274, 67, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(273, 68, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(272, 10, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(271, 9, 0, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(270, 8, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(269, 7, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(268, 6, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(267, 5, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(266, 4, 0, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(265, 3, 0, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(264, 2, 0, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');
INSERT INTO `teacherattendances` VALUES(263, 1, 1, '2012-01-03 00:00:00', '2012-01-03 20:48:07', '2012-01-08 15:31:19', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` datetime NOT NULL,
  `pcn` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `dojp` datetime NOT NULL,
  `dojs` datetime NOT NULL,
  `std` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `eq` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `jobtype_id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This table holds data for all the teachers' AUTO_INCREMENT=69 ;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` VALUES(1, 1, 'Tirth Bodawala', 'M', '1989-06-15 00:00:00', '1254788788', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 0, '2011-12-17 00:00:00', '2012-01-03 12:13:21');
INSERT INTO `teachers` VALUES(2, 1, 'Jay Shah', 'M', '1989-06-15 00:00:00', '1254758778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:13:00');
INSERT INTO `teachers` VALUES(3, 1, 'Jay Fuletra', 'M', '1989-06-15 00:00:00', '3254788778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:52');
INSERT INTO `teachers` VALUES(4, 1, 'Moiz Khan', 'M', '1989-06-15 00:00:00', '1254788578', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:35');
INSERT INTO `teachers` VALUES(5, 1, 'Krishna Gopal', 'M', '1989-06-15 00:00:00', '1254788770', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:28');
INSERT INTO `teachers` VALUES(6, 1, 'Komal Paliwal', 'M', '1989-06-15 00:00:00', '5254788778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:20');
INSERT INTO `teachers` VALUES(7, 1, 'Hari Rao', 'M', '1989-06-15 00:00:00', '1254788778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2011-12-24 20:33:21');
INSERT INTO `teachers` VALUES(8, 1, 'Ajani Nandish', 'M', '1989-06-15 00:00:00', '9254788778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:13:53');
INSERT INTO `teachers` VALUES(9, 1, 'Jayraj', 'M', '1989-06-15 00:00:00', '1254788777', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:08');
INSERT INTO `teachers` VALUES(10, 1, 'Bhargav Gor', 'M', '1989-06-15 00:00:00', '2254788778', '2007-01-01 00:00:00', '2011-12-17 00:00:00', '10', 'B.Tech - Computer Engineering', '1', 1, '2011-12-17 00:00:00', '2012-01-03 12:12:00');
INSERT INTO `teachers` VALUES(68, 1, 'Now Trying ', 'M', '2011-12-23 00:00:00', '131323232', '2011-12-14 00:00:00', '2011-12-07 00:00:00', '123456', 'B.Tech', '1', 0, '2011-12-24 18:48:49', '2012-01-03 12:13:47');
INSERT INTO `teachers` VALUES(67, 1, 'Try and Error Teacher - Now Edited', 'F', '2011-12-24 00:00:00', 'GERED5854R', '2011-12-08 00:00:00', '2011-12-24 00:00:00', '4', 'B.A', '2', 0, '2011-12-24 17:25:45', '2011-12-31 18:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `cluster_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Villages in details';

--
-- Dumping data for table `villages`
--


-- --------------------------------------------------------

--
-- Structure for view `attendances`
--
DROP TABLE IF EXISTS `attendances`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attendances` AS select `teacherattendances`.`attendancedate` AS `attendancedate`,`teacherattendances`.`id` AS `teacherattendance_id`,`studentattendances`.`id` AS `studentattendance_id` from (`teacherattendances` left join `studentattendances` on((`teacherattendances`.`attendancedate` = `studentattendances`.`attendancedate`))) group by `teacherattendances`.`attendancedate` union select `studentattendances`.`attendancedate` AS `attendancedate`,`teacherattendances`.`id` AS `teacherattendance_id`,`studentattendances`.`id` AS `studentattendance_id` from (`studentattendances` left join `teacherattendances` on((`studentattendances`.`attendancedate` = `teacherattendances`.`attendancedate`))) group by `studentattendances`.`attendancedate`;
