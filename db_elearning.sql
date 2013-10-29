-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2013 at 11:39 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(1, 'trainer', 'admin', 'hi', '2013-07-17 03:00:39', 1),
(2, 'admin', 'trainer', 'How can I help', '2013-07-17 03:02:55', 1),
(3, 'trainer', 'admin', 'jusy', '2013-07-17 03:03:25', 1),
(4, 'trainer', 'admin', 'wondekgagdf', '2013-07-17 03:03:37', 1),
(5, 'admin', 'trainer', 'His', '2013-07-17 03:03:43', 1),
(6, 'admin', 'trainer', 'hi', '2013-07-19 17:38:05', 1),
(7, 'admin', 'trainer', 'Can you please go to teach a test class in Canary wharf at 4 PM', '2013-07-19 17:38:54', 1),
(8, 'trainer', 'admin', 'hi...', '2013-07-21 14:55:22', 1),
(9, 'admin', 'test12', 'hi', '2013-08-30 20:57:04', 0),
(10, 'admin', 'test12', 'hi', '2013-08-31 21:18:30', 0),
(11, 'admin', 'test12', 'hi', '2013-09-01 23:27:11', 0),
(12, 'admin', 'test12', 'hi', '2013-09-08 02:36:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_with`
--

CREATE TABLE IF NOT EXISTS `chat_with` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85 ;

--
-- Dumping data for table `chat_with`
--

INSERT INTO `chat_with` (`id`, `session`, `level`, `status`) VALUES
(19, 'test12', 'user', 1),
(34, 'superadmin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(4) NOT NULL DEFAULT '1',
  `admin_fullname` varchar(110) NOT NULL,
  `admin_username` varchar(255) NOT NULL DEFAULT '',
  `admin_password` varchar(255) NOT NULL DEFAULT '',
  `admin_email1` varchar(255) NOT NULL DEFAULT '',
  `admin_email2` varchar(255) NOT NULL DEFAULT '',
  `admin_contact` varchar(110) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `user_type`, `admin_fullname`, `admin_username`, `admin_password`, `admin_email1`, `admin_email2`, `admin_contact`, `branch_id`, `status`) VALUES
(1, 0, 'SuperAdmin', 'superadmin', 'super', 'superadmin@gmail.com', '', '', 0, 1),
(2, 1, 'Admin', 'Admin', 'admin', 'admin@admin.com', '', '9894437473984', 1, 1),
(3, 1, 'Das', 'admin', 'admin', 'asdf@hotmail.com', '', '07429520437', 2, 1),
(5, 1, 'dkk', 'superadmin', 'super', 'sd@gfamsd.com', '', '074234234324', 4, 1),
(6, 1, 'Manjul', 'manutd', 'manutd', '07.manutdilam@gmail.com', '', '980125125125', 6, 1),
(7, 1, 'Manish', 'arsenal', 'arsenal', 'manjul@manjul.com', '', '095092385512', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE IF NOT EXISTS `tbl_announcement` (
  `ann_id` int(11) NOT NULL AUTO_INCREMENT,
  `ann_to` int(11) NOT NULL,
  `ann_admin_from` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_date` datetime NOT NULL,
  PRIMARY KEY (`ann_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE IF NOT EXISTS `tbl_appointments` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(110) NOT NULL,
  `lastname` varchar(110) NOT NULL,
  `phoneno` bigint(20) NOT NULL,
  `email` varchar(110) NOT NULL,
  `appointment_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `timeslot_id` int(11) NOT NULL,
  `requirements` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`appointment_id`, `user_id`, `firstname`, `lastname`, `phoneno`, `email`, `appointment_date`, `branch_id`, `admin_id`, `timeslot_id`, `requirements`, `course_id`, `status`) VALUES
(3, 3, 'Manjul', 'Bhattarai', 759712390515, '07.manutdilam@gail.com', '2013-09-27', 6, 6, 1, 'Test', 5, 0),
(4, 0, 'Ram', 'Ram', 3857129837503, '07.manutdilam@gmail.com', '2013-09-27', 6, 6, 2, 'Tst', 0, 0),
(5, 3, 'Manjul', 'Bhattarai', 759712390515, '07.manutdilam@gail.com', '2013-09-30', 6, 6, 1, 'Test', 5, 0),
(6, 3, 'Manjul', 'Bhattarai', 759712390515, '07.manutdilam@gail.com', '2013-09-27', 6, 6, 1, 'Test', 5, 0),
(7, 3, 'Manjul', 'Bhattarai', 759712390515, '07.manutdilam@gail.com', '2013-09-30', 1, 2, 4, 'Tera Baje', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assignment_users`
--

CREATE TABLE IF NOT EXISTS `tbl_assignment_users` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `doc_file` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE IF NOT EXISTS `tbl_batch` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_name` varchar(100) NOT NULL,
  `batch_description` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE IF NOT EXISTS `tbl_branch` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(200) NOT NULL,
  `branch_desc` text NOT NULL,
  `trainer_details` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `branch_desc`, `trainer_details`, `status`) VALUES
(1, 'Branch A', 'Branch A', 'Branch A details', 1),
(2, 'sdfsa', 'sdfasd', 'sdfsad', 1),
(6, 'Kathmandu', 'Kathmandu', 'Kathmandu Branch Detaills', 1),
(4, 'as', 'asdfasd', 'asdfasd', 1),
(5, 'Branch B', 'sdfas', 'asdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_configuration`
--

CREATE TABLE IF NOT EXISTS `tbl_configuration` (
  `cofiguration_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_name` varchar(250) NOT NULL DEFAULT '',
  `site_email` varchar(250) NOT NULL DEFAULT '',
  `site_logo` varchar(250) NOT NULL DEFAULT '',
  `site_contact` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`cofiguration_id`),
  KEY `id` (`cofiguration_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_configuration`
--

INSERT INTO `tbl_configuration` (`cofiguration_id`, `site_name`, `site_email`, `site_logo`, `site_contact`) VALUES
(1, 'Work Experience Training Management System', 'sterling@tdanda.co.uk', '1378057236_288794.png', 'Nothing Much');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country`
--

CREATE TABLE IF NOT EXISTS `tbl_country` (
  `country_id` int(11) NOT NULL DEFAULT '0',
  `countryName` varchar(100) NOT NULL DEFAULT '',
  `twoLetterISOCode` varchar(2) NOT NULL DEFAULT '',
  `threeLetterISOCode` varchar(3) NOT NULL DEFAULT '',
  `numericISOCode` varchar(3) NOT NULL DEFAULT '',
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE IF NOT EXISTS `tbl_course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `course_type_title` varchar(255) NOT NULL DEFAULT '0',
  `course_name` varchar(255) NOT NULL DEFAULT '',
  `course_description` text NOT NULL,
  `course_fee` bigint(20) NOT NULL,
  `course_length` varchar(255) NOT NULL DEFAULT '',
  `doc_size` varchar(255) NOT NULL DEFAULT '',
  `source` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `credit_hour` varchar(255) NOT NULL DEFAULT '',
  `download` tinyint(4) NOT NULL DEFAULT '0',
  `isAvailable` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `cat_id`, `course_type_title`, `course_name`, `course_description`, `course_fee`, `course_length`, `doc_size`, `source`, `author`, `credit_hour`, `download`, `isAvailable`, `status`, `branch_id`) VALUES
(1, 0, '0', 'Course A', 'Course A', 200, '', '', '', '', '', 0, 0, 1, 1),
(2, 0, '0', 'Course B', 'Course B', 200, '', '', '', '', '', 0, 0, 1, 1),
(3, 0, '0', 'Course C', 'Course C', 200, '', '', '', '', '', 0, 0, 1, 1),
(4, 0, '0', 'adas', 'sxcxzcv', 334, '', '', '', '', '', 0, 0, 1, 1),
(5, 0, '0', 'English Premier League', 'A league of 20 teams', 500, '', '', '', '', '', 0, 0, 1, 6),
(6, 0, '0', 'Carling Cup', 'A cup competition ', 200, '', '', '', '', '', 0, 0, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_log`
--

CREATE TABLE IF NOT EXISTS `tbl_course_log` (
  `course_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `enrollment_status` int(11) NOT NULL,
  `course_status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`course_log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_course_log`
--

INSERT INTO `tbl_course_log` (`course_log_id`, `course_id`, `user_id`, `enrollment_status`, `course_status`, `payment_status`) VALUES
(1, 1, 1, 1, 0, 0),
(4, 5, 3, 1, 2, 0),
(6, 1, 3, 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_session`
--

CREATE TABLE IF NOT EXISTS `tbl_course_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_name` varchar(110) NOT NULL,
  `session_desc` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course_trainer`
--

CREATE TABLE IF NOT EXISTS `tbl_course_trainer` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_course_trainer`
--

INSERT INTO `tbl_course_trainer` (`assign_id`, `course_id`, `trainer_id`) VALUES
(1, 1, 2),
(2, 5, 1),
(3, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doc`
--

CREATE TABLE IF NOT EXISTS `tbl_doc` (
  `doc_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `doc_title` varchar(255) NOT NULL DEFAULT '',
  `doc_desc` text NOT NULL,
  `doc_file` varchar(255) NOT NULL DEFAULT '',
  `doc_type` int(11) NOT NULL COMMENT '1=>Resource, 2=>Assignment',
  `isDownloadable` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE IF NOT EXISTS `tbl_enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(110) NOT NULL,
  `last_name` varchar(110) NOT NULL,
  `gender` varchar(110) NOT NULL,
  `address` varchar(110) NOT NULL,
  `post_code` int(11) NOT NULL,
  `dob` varchar(110) NOT NULL,
  `ni_number` bigint(20) NOT NULL,
  `contact_number` bigint(20) NOT NULL,
  `alt_number` bigint(20) NOT NULL,
  `emergency_contact_name` varchar(110) NOT NULL,
  `emergency_contact_no` bigint(20) NOT NULL,
  `pref_start_date` date NOT NULL,
  `course_id` int(11) NOT NULL,
  `q1_ideal_accnt` text NOT NULL,
  `q2_industry` text NOT NULL,
  `q3_salary` text NOT NULL,
  `q4_jobs_applied` text NOT NULL,
  `q5_doing_what` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`enrollment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_enrollment`
--

INSERT INTO `tbl_enrollment` (`enrollment_id`, `user_id`, `first_name`, `last_name`, `gender`, `address`, `post_code`, `dob`, `ni_number`, `contact_number`, `alt_number`, `emergency_contact_name`, `emergency_contact_no`, `pref_start_date`, `course_id`, `q1_ideal_accnt`, `q2_industry`, `q3_salary`, `q4_jobs_applied`, `q5_doing_what`, `status`) VALUES
(1, 1, 'Pradeep', 'Karki ', '0', 'Dhapasi, Kathmandu', 977, '1987-12-04', 149910, 9841765177, 0, 'Umesh Kumar Khada', 9841464953, '2014-08-31', 1, 'test', 'IT', '5000', '0', 'IT', 0),
(2, 3, 'suryaram', 'tamang ', 'male', '', 0, '', 0, 74234234234, 0, '', 0, '0000-00-00', 1, 'fsadf', '', '', '', '', 2),
(4, 3, 'Manjul', 'Bhattarai ', '0', 'Kathmandu', 977, '2054-01-05', 927472984, 759712390515, 0, 'Ram', 0, '2013-09-10', 5, '', '', '', '', '', 1),
(5, 3, 'Manjul', 'Bhattarai ', '0', 'kathmandu', 977, '2054-01-05', 927472984, 759712390515, 0, 'Test', 0, '2013-09-30', 1, '', '', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_feedback` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holidays`
--

CREATE TABLE IF NOT EXISTS `tbl_holidays` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_remarks` text NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_holidays`
--

INSERT INTO `tbl_holidays` (`holiday_id`, `branch_id`, `holiday_date`, `holiday_remarks`) VALUES
(1, 6, '2013-09-27', 'aaga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holidays_appointment`
--

CREATE TABLE IF NOT EXISTS `tbl_holidays_appointment` (
  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_date` date NOT NULL,
  `holiday_remarks` text NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_holidays_appointment`
--

INSERT INTO `tbl_holidays_appointment` (`holiday_id`, `holiday_date`, `holiday_remarks`, `branch_id`) VALUES
(1, '2013-09-29', 'Ho', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson`
--

CREATE TABLE IF NOT EXISTS `tbl_lesson` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_name` varchar(110) NOT NULL,
  `lesson_description` text NOT NULL,
  `course_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`lesson_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_lesson`
--

INSERT INTO `tbl_lesson` (`lesson_id`, `lesson_name`, `lesson_description`, `course_id`, `status`) VALUES
(1, 'Test COurse C Lesson 1', 'Lesson 1', 3, 0),
(2, 'Defence', 'Defence', 5, 0),
(3, 'Attacking', 'Attacking', 5, 0),
(4, 'Lesson A', 'Lesson A', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log_manager`
--

CREATE TABLE IF NOT EXISTS `tbl_log_manager` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `user_login_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_logout_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `branch_id` int(11) NOT NULL,
  `log_status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_log_manager`
--

INSERT INTO `tbl_log_manager` (`log_id`, `user_id`, `user_login_date`, `user_logout_date`, `ip`, `branch_id`, `log_status`) VALUES
(1, 1, '2013-08-28 21:15:54', '2013-08-29 01:06:19', '113.199.185.61', 1, 0),
(2, 1, '2013-08-29 09:19:27', '2013-08-29 09:47:44', '27.111.17.2', 1, 0),
(3, 2, '2013-08-30 11:44:12', '0000-00-00 00:00:00', '27.111.17.2', 1, 1),
(4, 2, '2013-08-30 20:17:48', '0000-00-00 00:00:00', '27.34.15.109', 1, 1),
(5, 1, '2013-09-08 08:22:22', '2013-09-08 08:22:35', '27.34.13.129', 1, 0),
(6, 1, '2013-09-24 21:11:09', '2013-09-24 21:11:17', '127.0.0.1', 1, 0),
(7, 3, '2013-09-25 20:42:00', '0000-00-00 00:00:00', '127.0.0.1', 6, 1),
(8, 3, '2013-09-25 20:42:45', '2013-09-25 21:13:21', '127.0.0.1', 6, 0),
(9, 3, '2013-09-25 21:13:29', '0000-00-00 00:00:00', '127.0.0.1', 6, 1),
(10, 3, '2013-09-26 19:28:01', '2013-09-26 20:08:51', '127.0.0.1', 6, 0),
(11, 3, '2013-09-26 20:09:01', '2013-09-26 20:09:04', '127.0.0.1', 6, 0),
(12, 3, '2013-09-26 20:10:43', '2013-09-26 20:14:22', '127.0.0.1', 6, 0),
(13, 3, '2013-09-26 21:10:43', '2013-09-26 21:11:16', '127.0.0.1', 6, 0),
(14, 3, '2013-09-27 07:13:38', '2013-09-27 07:15:41', '127.0.0.1', 6, 0),
(15, 3, '2013-09-27 07:15:48', '2013-09-27 07:15:51', '127.0.0.1', 6, 0),
(16, 3, '2013-09-27 07:17:18', '2013-09-27 07:19:45', '127.0.0.1', 6, 0),
(17, 3, '2013-09-27 07:19:53', '2013-09-27 07:19:57', '127.0.0.1', 6, 0),
(18, 3, '2013-09-27 07:29:02', '2013-09-27 07:35:37', '127.0.0.1', 6, 0),
(19, 3, '2013-09-27 07:37:12', '2013-09-27 07:39:02', '127.0.0.1', 6, 0),
(20, 3, '2013-09-27 07:41:12', '0000-00-00 00:00:00', '127.0.0.1', 6, 1),
(21, 3, '2013-09-27 07:42:08', '2013-09-27 07:46:15', '127.0.0.1', 6, 0),
(22, 3, '2013-09-29 11:11:16', '0000-00-00 00:00:00', '127.0.0.1', 6, 1),
(23, 3, '2013-09-29 16:17:25', '2013-09-29 22:39:26', '127.0.0.1', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messaging`
--

CREATE TABLE IF NOT EXISTS `tbl_messaging` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL COMMENT '1=>Admin, 2=>Trainer, 3=>user',
  `reciever_id` int(11) NOT NULL COMMENT '1=>Admin, 2=>Trainer, 3=>user',
  `trainer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `sent_date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_footer`
--

CREATE TABLE IF NOT EXISTS `tbl_page_footer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `footer_title` varchar(210) NOT NULL,
  `footer_copyright` varchar(210) NOT NULL,
  `footer_link` varchar(210) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_page_footer`
--

INSERT INTO `tbl_page_footer` (`id`, `footer_title`, `footer_copyright`, `footer_link`) VALUES
(1, 'Training Management', 'LittleMore Training UK', 'www.google.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_title`
--

CREATE TABLE IF NOT EXISTS `tbl_page_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(220) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_page_title`
--

INSERT INTO `tbl_page_title` (`id`, `page_title`) VALUES
(1, 'Elearning');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paypal_log`
--

CREATE TABLE IF NOT EXISTS `tbl_paypal_log` (
  `paypal_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `payment_fee` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  `payment_method` varchar(110) NOT NULL,
  PRIMARY KEY (`paypal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_paypal_log`
--

INSERT INTO `tbl_paypal_log` (`paypal_id`, `user_id`, `course_id`, `payment_fee`, `status`, `payment_method`) VALUES
(6, 3, 1, 200, 1, 'Paypal and appointment'),
(5, 3, 5, 500, 1, 'Paypal and appointment');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session_number`
--

CREATE TABLE IF NOT EXISTS `tbl_session_number` (
  `id` int(11) NOT NULL,
  `number_session` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_session_number`
--

INSERT INTO `tbl_session_number` (`id`, `number_session`) VALUES
(1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider_images`
--

CREATE TABLE IF NOT EXISTS `tbl_slider_images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(220) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tbl_slider_images`
--

INSERT INTO `tbl_slider_images` (`image_id`, `image_name`, `status`) VALUES
(3, '1373733841_131393.jpg', 1),
(4, '1373733848_895053.jpg', 1),
(5, '1373733855_180392.jpg', 1),
(6, '1373733862_884286.jpg', 1),
(8, '1373734744_817379.jpg', 1),
(9, '1373734750_744320.jpg', 1),
(10, '1373734756_205441.jpg', 1),
(11, '1373734769_297616.jpg', 1),
(12, '1373734791_491305.jpg', 1),
(13, '1373734797_376058.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staticpages`
--

CREATE TABLE IF NOT EXISTS `tbl_staticpages` (
  `staticpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `staticpage_link` varchar(255) DEFAULT NULL,
  `staticpage_title` varchar(255) DEFAULT NULL,
  `staticpage_subtitle` varchar(255) NOT NULL DEFAULT '',
  `staticpage_content` text,
  `staticpage_metakey` text NOT NULL,
  `staticpage_metadesc` text NOT NULL,
  `staticpage_show_nav` enum('0','1') DEFAULT NULL,
  `staticpage_parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`staticpage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `tbl_staticpages`
--

INSERT INTO `tbl_staticpages` (`staticpage_id`, `staticpage_link`, `staticpage_title`, `staticpage_subtitle`, `staticpage_content`, `staticpage_metakey`, `staticpage_metadesc`, `staticpage_show_nav`, `staticpage_parent_id`) VALUES
(1, 'Home', 'Welcome to Training Management System', '', '<p>\r\n	 </p>\r\n<p>\r\n	<p>\r\n		Training provides online and face-to-face training and certification for people wanting to build a customised mobile application for businesses, non profit organisations, schools, those working or studying in the IT industry, actually any organisation that needs<i> help to communicate mobile</i></p>\r\n</p>\r\n<p>\r\n	 </p>\r\n<div>\r\n	<p>\r\n		Training and the Metropolitan South <wbr />Institute of TAFE, Mt Gravatt are partnering together to deliver accredited training in all states and territories of Australia, beginning with Queensland. We are offering the training both on campus  and off site</p>\r\n</p>\r\n<p>\r\n	 </p>\r\n<p>\r\n	<p>\r\n		Training is a division of Vital One Technologies which was established in 2004. We are an Australian company who offers smart technology solutions for organisations.</div>\r\n	<div>\r\n		 </div>\r\n	<div>\r\n		Learning with us is all about flexibility:</div>\r\n	<ul>\r\n		<li>\r\n			The training is only 6 hours ( 3 hours face to face and 3 hours online)</li>\r\n		<li>\r\n			Join us at TAFE or off site in your local area</li>\r\n		<li>\r\n			Fully supported by the Training team</li>\r\n		<li>\r\n			 No expertise in IT required at all</li>\r\n		<li>\r\n			 Got a question? Then send an e-mail or call us.</li>\r\n	</ul>\r\n	<p>\r\n		 </p>\r\n	<p>\r\n		If you are interested in one of our courses, or simply have an enquiry about any of the courses we provide, please contact us today. 1300 728 794</div>\r\n</p>\r\n', '', '', NULL, NULL),
(10, 'privacy-policy', 'Privacy Policy', 'What is EasycardDesign?', '<p>\n	Privacy Policy</p>\n', 'Privacy Policy', 'Privacy Policy', '1', NULL),
(22, 'how-does-it-work', 'Trainer''s Dashboard', 'features', 'This is trainer''s dashboard.', '', '', '1', NULL),
(12, 'about-us', 'About Us', 'company', '<p>\r\n	&nbsp;</p>\r\n<div style="font-family: arial, sans-serif; font-size: 13px; background-color: rgba(255, 255, 255, 0.917969); ">\r\n	Training provides online and face-to-face training and certification for people wanting to build a customised mobile application for businesses, non profit organisations, schools, those working or studying in the IT industry, actually any organisation that needs<i>&nbsp;help to communicate mobile</i></div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px; background-color: rgba(255, 255, 255, 0.917969); ">\r\n	&nbsp;</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px; background-color: rgba(255, 255, 255, 0.917969); ">\r\n	Training and the&nbsp;Metropolitan&nbsp;South&nbsp;<wbr />Institute&nbsp;of TAFE, Mt Gravatt are partnering together to deliver accredited training in all states and territories of Australia, beginning with Queensland. We are offering&nbsp;the training both on campus &nbsp;and off site</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px; background-color: rgba(255, 255, 255, 0.917969); ">\r\n	&nbsp;</div>\r\n<div style="font-family: arial, sans-serif; font-size: 13px; background-color: rgba(255, 255, 255, 0.917969); ">\r\n	<div>\r\n		Training is a division of Vital One Technologies which was established in 2004. We are an Australian company who offers smart technology solutions for organisations.</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		Learning with us is all about flexibility:</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		? The training is only 6 hours ( 3 hours face to face and 3 hours online)</div>\r\n	<div>\r\n		? Join us at TAFE or off site in your local area</div>\r\n	<div>\r\n		? Fully supported by the Training team</div>\r\n	<div>\r\n		? No expertise in IT required at all</div>\r\n	<div>\r\n		?&nbsp;Got a question? Then send an e-mail or call us.</div>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		If you are interested in one of our courses, or simply have an enquiry about any of the courses we provide, please contact us today.<a href="tel:1300%20728%20794" style="color: rgb(17, 85, 204); " target="_blank" value="+611300728794"><span class="skype_pnh_container" dir="ltr" style="background-attachment: scroll !important; background-color: transparent !important; background-image: none !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-align: left !important; text-decoration: none !important; top: auto !important; white-space: nowrap !important; word-spacing: normal !important; z-index: 0 !important; color: rgb(73, 83, 90) !important; font-family: Tahoma, Arial, Helvetica, sans-serif !important; font-size: 11px !important; font-weight: bold !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: auto !important; background-position: 0px 0px !important; background-repeat: no-repeat no-repeat !important; " tabindex="-1">&nbsp;<span class="skype_pnh_highlighting_inactive_common" dir="ltr" skypeaction="skype_dropdown" style="background-attachment: scroll !important; background-color: transparent !important; background-image: none !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: auto !important; background-position: 0px 0px !important; background-repeat: no-repeat no-repeat !important; " title="Call this phone number in Australia with Skype: +611300728794"><span class="skype_pnh_left_span" skypeaction="skype_dropdown" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/numbers_common_inactive_icon_set.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: 6px !important; background-position: 0px 0px !important; background-repeat: no-repeat no-repeat !important; " title="Skype actions">&nbsp;&nbsp;</span><span class="skype_pnh_dropart_span" skypeaction="skype_dropdown" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/numbers_common_inactive_icon_set.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: 27px !important; background-position: -11px 0px !important; background-repeat: no-repeat no-repeat !important; " title="Skype actions"><span class="skype_pnh_dropart_flag_span" skypeaction="skype_dropdown" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/flags.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: 18px !important; background-position: 1px 1px !important; background-repeat: no-repeat no-repeat !important; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;</span><span class="skype_pnh_textarea_span" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/numbers_common_inactive_icon_set.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: auto !important; background-position: -125px 0px !important; background-repeat: no-repeat no-repeat !important; "><span class="skype_pnh_text_span" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/numbers_common_inactive_icon_set.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 5px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: auto !important; background-position: -125px 0px !important; background-repeat: no-repeat no-repeat !important; ">1300 728 794</span></span><span class="skype_pnh_right_span" style="background-attachment: scroll !important; background-color: transparent !important; background-image: url(chrome-extension://lifbcibllhkdhoafpjfnlhfpfgnpldfl/numbers_common_inactive_icon_set.gif) !important; border-color: initial !important; border-image: initial !important; border-left-color: rgb(0, 0, 0) !important; border-left-style: none !important; border-left-width: 0px !important; border-top-color: rgb(0, 0, 0) !important; border-top-style: none !important; border-top-width: 0px !important; border-right-color: rgb(0, 0, 0) !important; border-right-style: none !important; border-right-width: 0px !important; border-bottom-color: rgb(0, 0, 0) !important; border-bottom-style: none !important; border-bottom-width: 0px !important; border-collapse: separate !important; bottom: auto !important; clear: none !important; clip: auto !important; cursor: pointer !important; direction: ltr !important; display: inline !important; float: none !important; left: auto !important; letter-spacing: 0px !important; list-style-image: none !important; list-style-position: outside !important; list-style-type: disc !important; overflow-x: hidden !important; overflow-y: hidden !important; padding-left: 0px !important; padding-top: 0px !important; padding-right: 0px !important; padding-bottom: 0px !important; page-break-after: auto !important; page-break-before: auto !important; page-break-inside: auto !important; position: static !important; right: auto !important; table-layout: auto !important; text-decoration: none !important; top: auto !important; word-spacing: normal !important; z-index: 0 !important; height: 14px !important; line-height: 14px !important; margin-left: 0px !important; margin-top: 0px !important; margin-right: 0px !important; margin-bottom: 0px !important; vertical-align: baseline !important; width: 15px !important; background-position: -62px 0px !important; background-repeat: no-repeat no-repeat !important; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>&nbsp;</span></a></div>\r\n</div>\r\n<p>\r\n	&nbsp;</p>\r\n', 'About us', 'About us', '1', NULL),
(20, '', 'Admin Dashboard', '', '<p>\n	Welcome Admin</p>\n<p>\n	Select one of the tabs on the left to make changes, remove or update</p>\n', '', '', NULL, NULL),
(21, '', 'User Dashboard', '', '<p>\r\n	Welcome to Training, congratulations on making a smart choice.Smart mobile technology have dramatically changed our behaviour.</p>\r\n<div>\r\n	Mobile phones are being adopted 8 x faster than any other technological development in history.&nbsp;There is almost one mobile phone for every person on the planet.&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Mobile Apps can be used for ANYTHING ranging from mobile wedding invitations to marketing campaigns, product promotions, conference agendas and more.But why would I want to be trained in Mobile applications ? Why not ? Considering the speed that mobile technology is moving, it make sense to keep pace. For whatever reason you are here, this training will take you, your skills and your future into a whole new realm .</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	The Training Learn to Build Mobile Apps is an accredited course with the Metropolitian South Institute of TAFE. It is 6 hours in total ( 1.5 pre - 3.0 Face2Face - 1.5 post)</div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<strong><span style="color:#339900;">How this Learning Portal Works</span></strong></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	Simply click on the Course - Learning to Build Mobile Apps and <b>START</b></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<b>Read each lesson by moving the <span style="color:#008000;">SLIDER</span> down and then click <span style="color:#008000;">NEXT</span> at the bottom to answer the questions.</b></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="font-weight: bold;">You will not be able to move forward until each lesson is read and answered</span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	<span style="color:#008000;"><span style="font-weight: bold;">PRE Workshop Training</span></span></div>\r\n<div>\r\n	&nbsp;</div>\r\n<ol>\r\n	<li>\r\n		<b>Watch AppMakerStore Video and answer the quiz&nbsp;</b></li>\r\n	<li>\r\n		<b>Read ACS Code of Ethics &amp; answer short quiz</b></li>\r\n	<li>\r\n		<b>Read OHS for the IT Industry &amp; answer short quiz</b></li>\r\n	<li>\r\n		<b>Read QR Scanner &amp; do activity</b></li>\r\n	<li>\r\n		<b>Read &amp; Create a Profile </b></li>\r\n	<li>\r\n		<b>Read All in the Graphics &amp; source your images&nbsp;</b></li>\r\n	<li>\r\n		<b>Read Create a BluePrint &amp; create your mobile model</b>&nbsp;&nbsp;</li>\r\n</ol>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<span style="color: rgb(51, 153, 0);"><strong>Attend your 3 hour workshop Ready Set Build</strong></span></p>\r\n<p>\r\n	<span style="color:#008000;"><strong>POST Workshop Training</strong></span></p>\r\n<ol>\r\n	<li>\r\n		<strong>Read and complete the Feedback Questionaire&nbsp;</strong></li>\r\n	<li>\r\n		<strong>Then you will have a further 1.5 hours to finalise your mobile</strong><strong>&nbsp;application&nbsp;</strong></li>\r\n</ol>\r\n<p>\r\n	We look forward to training and being of service to you.&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<div>\r\n	&nbsp;</div>\r\n<div>\r\n	&nbsp;</div>\r\n', '', '', NULL, NULL),
(101, '', 'SuperAdmin Dashboard', '', '<p>\r\n	Welcome SuperAdmin</p>\r\n<p>\r\n	Select one of the tabs on the left to make changes, remove or update</p>\r\n', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terms`
--

CREATE TABLE IF NOT EXISTS `tbl_terms` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `terms` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_terms`
--

INSERT INTO `tbl_terms` (`term_id`, `terms`, `status`) VALUES
(1, '<h3>\r\n	TERMS AND CONDITIONS</h3>\r\n<ul>\r\n	<li>\r\n		<strong>1. Definitions</strong></li>\r\n	<li type="square">\r\n		1.1 TD&amp;A &amp; TD&amp;A Accountancy &amp; Financial Services is a trading name of TD&amp;A Ltd, registered office Level 33, 25 Canada Square, London, E14 5LQ</li>\r\n	<li type="square">\r\n		1.2 The trainee (s) means the person (s) attending the work experience.</li>\r\n	<li type="square">\r\n		1.3 The work experience means one or a specific series of training courses as defined in the training brochure or proposal.</li>\r\n	<br />\r\n	<li>\r\n		<strong>2. Bookings</strong></li>\r\n	<li type="square">\r\n		2.1 No booking will be confirmed as accepted until such time as TD&amp;A is in receipt of a fully completed booking form.</li>\r\n	<li type="square">\r\n		2.2 Except where the TD&amp;A exercises its discretion to do otherwise no trainee will be accepted onto any work experience until TD&amp;A is in receipt of payment, in full, of the work experience fee.</li>\r\n	<br />\r\n	<li>\r\n		<strong>3.Payment: Only Card &amp; Cash payment accepted.</strong></li>\r\n	<br />\r\n	<li>\r\n		<strong>4. Cancellation</strong></li>\r\n	<li type="square">\r\n		4.1 By the TD&amp;A TD&amp;A may cancel any training at any time but will endeavour to provide the trainee with at least 7 days notice of cancellation. Any fees paid will be refunded in full to the trainee. The extent of liability for cancellation of work experience is specifically limited to any training fee paid.</li>\r\n	<li type="square">\r\n		4.2 By the Trainee</li>\r\n</ul>\r\n<p>\r\n	4.2.1 All cancellations must be notified to TD&amp;A in writing.</p>\r\n<p>\r\n	4.2.2 Where the trainee cancels a booking TD&amp;A reserves the right to impose cancellation fees as follows: 20% of the training fee for cancellations made (1) one calendar week prior to the training start date. For cancellations less than one (1) calendar week the full course fee (notified on time of booking) will be charged unless otherwise agreed. There is an administration charge of &pound;100 should the trainee cancel at any time after the enrolment has been confirmed to the trainee by TD&amp;A either by phone, post or email. 5. Non completion of training &amp; Long absence If a trainee decides not to complete any wok experience booked and a session attended, the full fee must be paid within (1) one calendar week if the installment option of fee payment was agreed at the time of booking. TD&amp;A will assume that a decision by the trainee has been made not to complete the training if a trainee does not show up for training for (4) four consecutive sessions with no prior notice to TD&amp;A in writing either by email or post. If a trainee does not attend the work experience for a month (30 Calendar days) from date of latest attendance, then your work experience will be automatically cancelled and there will be no refund of any fees paid.</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>5. Non completion of training &amp; Long absence</strong></li>\r\n</ul>\r\n<p>\r\n	If a trainee decides not to complete any wok experience booked and a session attended, the full fee must be paid within (1) one calendar week if the installment option of fee payment was agreed at the time of booking. TD&amp;A will assume that a decision by the trainee has been made not to complete the training if a trainee does not show up for training for (4) four consecutive sessions with no prior notice to TD&amp;A in writing either by email or post. If a trainee does not attend the work experience for a month (30 Calendar days) from date of latest attendance, then your work experience will be automatically cancelled and there will be no refund of any fees paid.</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>6. Quality</strong></li>\r\n</ul>\r\n<p>\r\n	TD&amp;A will provide suitably qualified and experienced personnel with regard to the work experience training and will take all reasonable care to ensure that the presentation and content of the work experience training is made in a professional and competent manner and to a standard appropriate to the course.</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>7. Materials and Equipment</strong></li>\r\n</ul>\r\n<p>\r\n	All facilities, training materials and equipment will be provided for use by trainees for the duration of the work experience unless otherwise specified. TD&amp;A will not be liable for any materials or equipment brought onto the premises by a trainee.</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>8. Copyright of work experience material</strong></li>\r\n</ul>\r\n<p>\r\n	Ownership of and copyright in all training material and documents shall remain with TD&amp;A. Trainees may use such material and documents only for their personal use and such material and documents shall not be copied, given, sold assigned or otherwise transferred in whole or in part to any third party without the express written consent of the TD&amp;A</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>9. Trainee&rsquo;s Liability</strong></li>\r\n</ul>\r\n<p>\r\n	The trainee accepts responsibility in full for their conduct whilst on TD&amp;A premises and undertakes to indemnify TD&amp;A against material damage and/or personal injury to TD&amp;A, its servants, agents or property as a result of actions or defaults whilst attending the work experience.</p>\r\n<br />\r\n<ul>\r\n	<li>\r\n		<strong>10. Limit of Liability</strong></li>\r\n</ul>\r\n<p>\r\n	Other than liability in respect of death or personal injury , the extent of TD&amp;A&rsquo;s liability for any failure to meet its obligation shall be limited to the costs of the work experience fee only.</p>\r\n<ul>\r\n	<li>\r\n		<strong>11. Interpretation</strong></li>\r\n	<li type="square">\r\n		11.1 This agreement shall be governed by and construed in accordance with the laws of England and the parties hereby submit to the exclusive jurisdiction of the English Courts.</li>\r\n	<li type="square">\r\n		11.2 This agreement is subject to the special conditions (if any) contained in the schedule hereto. In the event of any inconsistency between such special conditions and the other terms of agreement such special conditions shall prevail.</li>\r\n	<br />\r\n	<li>\r\n		<strong>12. Force Majeure</strong></li>\r\n</ul>\r\n<p>\r\n	TD&amp;A shall not be liable to refund of fees or for any other penalty should work experience training be cancelled due to war, fire, strike, lock-out, industrial action, tempest, accident, civil disturbance or any other cause whatsoever beyond their control.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeslot_appointments`
--

CREATE TABLE IF NOT EXISTS `tbl_timeslot_appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(110) NOT NULL,
  `end_time` varchar(110) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_timeslot_appointments`
--

INSERT INTO `tbl_timeslot_appointments` (`id`, `start_time`, `end_time`, `branch_id`) VALUES
(1, '10:00 AM', '11:00 AM', 6),
(2, '11:00 AM', '12:00 PM', 6),
(4, '10:00 AM', '10:30 AM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeslot_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_timeslot_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start_time` varchar(110) NOT NULL,
  `end_time` varchar(110) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_timeslot_schedule`
--

INSERT INTO `tbl_timeslot_schedule` (`id`, `start_time`, `end_time`, `branch_id`) VALUES
(1, '10:00 AM', '', 6),
(2, '10:00 AM', '11:00 AM', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_timeslot_status`
--

CREATE TABLE IF NOT EXISTS `tbl_timeslot_status` (
  `date` date NOT NULL,
  `timeslot_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_trainer`
--

CREATE TABLE IF NOT EXISTS `tbl_trainer` (
  `trainer_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL DEFAULT '',
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `branch_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trainer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_trainer`
--

INSERT INTO `tbl_trainer` (`trainer_id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `branch_id`, `status`) VALUES
(1, 'Alex', 'Ferguson', 'siralex', 'siralex', 'siralex@manutd.com', '759712390515', 6, 1),
(2, 'Trainer A', 'Trainer A', 'trainerA', 'trainerA', 'trainer@trainer.com', '832590835124', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE IF NOT EXISTS `tbl_training` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_date` date NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `timeslot` int(11) NOT NULL,
  `training_status` int(11) NOT NULL,
  PRIMARY KEY (`training_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_training`
--

INSERT INTO `tbl_training` (`training_id`, `training_date`, `lesson_id`, `course_id`, `timeslot`, `training_status`) VALUES
(1, '2013-09-30', 2, 5, 2, 1),
(2, '2013-09-30', 3, 5, 2, 1),
(3, '2013-09-30', 4, 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_bookings`
--

CREATE TABLE IF NOT EXISTS `tbl_training_bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `training_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_training_bookings`
--

INSERT INTO `tbl_training_bookings` (`booking_id`, `training_id`, `course_id`, `user_id`) VALUES
(1, 1, 5, 3),
(2, 2, 5, 3),
(3, 3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_feedback`
--

CREATE TABLE IF NOT EXISTS `tbl_training_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `assignment_marks` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_training_feedback`
--

INSERT INTO `tbl_training_feedback` (`feedback_id`, `user_id`, `training_id`, `assignment_marks`, `attendance`, `remarks`) VALUES
(1, 3, 1, 9, 0, 'Great One'),
(2, 3, 2, 9, 0, 'Good'),
(3, 3, 3, 10, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_feedback_sessions`
--

CREATE TABLE IF NOT EXISTS `tbl_training_feedback_sessions` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_schedule`
--

CREATE TABLE IF NOT EXISTS `tbl_training_schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `session_name` varchar(110) NOT NULL,
  `training_start_date` date NOT NULL,
  `timeslot` varchar(220) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_users`
--

CREATE TABLE IF NOT EXISTS `tbl_training_users` (
  `assign_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `enrollment_status` int(11) NOT NULL,
  `lesson_status` int(11) NOT NULL COMMENT '0=>Inactive, 1=>Avtive 2=>Complete, 3=>Archive',
  `payment_status` int(11) NOT NULL,
  PRIMARY KEY (`assign_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(4) NOT NULL DEFAULT '2',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `middle_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(200) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `branch_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `contact_number` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `gender` varchar(255) NOT NULL DEFAULT '',
  `dob_year` year(4) NOT NULL DEFAULT '0000',
  `dob_month` int(5) NOT NULL DEFAULT '0',
  `dob_day` int(5) NOT NULL DEFAULT '0',
  `country_id` varchar(255) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `province_id` tinyint(4) NOT NULL DEFAULT '0',
  `postal_code` varchar(255) NOT NULL DEFAULT '',
  `isPaid` tinyint(4) NOT NULL DEFAULT '0',
  `registered_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verification_code` varchar(255) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_type`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `branch_id`, `course_id`, `contact_number`, `image`, `email`, `gender`, `dob_year`, `dob_month`, `dob_day`, `country_id`, `city`, `province_id`, `postal_code`, `isPaid`, `registered_date`, `verification_code`, `status`) VALUES
(1, 2, 'Pradeep', '', 'Karki', 'lapten', 'lapten', 1, 1, '9841765177', '', 'lapten@lapten.com', 'male', 1930, 0, 1, '0', '', 0, '', 0, '2013-08-29 01:05:40', '', 1),
(2, 2, 'Test12', '', 'test12', 'test12', 'test12', 1, 1, '9841765177', '', '07.manutdilam@gmail.com', '', 0000, 0, 0, '', '', 0, '', 0, '2013-08-29 09:48:19', '', 1),
(3, 2, 'Manjul', '', 'Bhattarai', 'manjul', 'manjul', 6, 5, '759712390515', '', '07.manutdilam@gail.com', '', 0000, 0, 0, '', '', 0, '', 0, '2013-09-25 20:38:16', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_working_days`
--

CREATE TABLE IF NOT EXISTS `tbl_working_days` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_sun` int(11) NOT NULL,
  `day_mon` int(11) NOT NULL,
  `day_tue` int(11) NOT NULL,
  `day_wed` int(11) NOT NULL,
  `day_thu` int(11) NOT NULL,
  `day_fri` int(11) NOT NULL,
  `day_sat` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_working_days`
--

INSERT INTO `tbl_working_days` (`day_id`, `day_sun`, `day_mon`, `day_tue`, `day_wed`, `day_thu`, `day_fri`, `day_sat`, `branch_id`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 0, 1, 1, 1, 1, 1, 1, 2),
(3, 0, 1, 1, 1, 1, 1, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_working_days_appointment`
--

CREATE TABLE IF NOT EXISTS `tbl_working_days_appointment` (
  `day_id` int(11) NOT NULL AUTO_INCREMENT,
  `day_sun` int(11) NOT NULL,
  `day_mon` int(11) NOT NULL,
  `day_tue` int(11) NOT NULL,
  `day_wed` int(11) NOT NULL,
  `day_thu` int(11) NOT NULL,
  `day_fri` int(11) NOT NULL,
  `day_sat` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_working_days_appointment`
--

INSERT INTO `tbl_working_days_appointment` (`day_id`, `day_sun`, `day_mon`, `day_tue`, `day_wed`, `day_thu`, `day_fri`, `day_sat`, `branch_id`) VALUES
(1, 0, 1, 1, 1, 1, 1, 0, 1),
(2, 0, 1, 1, 1, 1, 1, 1, 2),
(3, 0, 1, 1, 1, 1, 1, 0, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
