-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 02, 2015 at 10:47 PM
-- Server version: 5.1.48
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

DROP TABLE IF EXISTS `forum_answer`;
CREATE TABLE IF NOT EXISTS `forum_answer` (
  `question_id` int(4) NOT NULL DEFAULT '0',
  `a_id` int(4) NOT NULL DEFAULT '0',
  `a_name` varchar(65) NOT NULL DEFAULT '''''',
  `a_email` varchar(65) NOT NULL DEFAULT '''''',
  `a_answer` longtext NOT NULL,
  `a_datetime` varchar(25) NOT NULL DEFAULT '''''',
  PRIMARY KEY (`a_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_answer`
--

INSERT INTO `forum_answer` (`question_id`, `a_id`, `a_name`, `a_email`, `a_answer`, `a_datetime`) VALUES
(1, 1, '', '', '', '24/07/15 00:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `forum_question`
--

DROP TABLE IF EXISTS `forum_question`;
CREATE TABLE IF NOT EXISTS `forum_question` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL DEFAULT '''''',
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '''''',
  `email` varchar(65) NOT NULL DEFAULT '''''',
  `datetime` varchar(25) NOT NULL DEFAULT '''''',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_4` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`),
  KEY `id_5` (`id`),
  KEY `id_6` (`id`),
  KEY `id_7` (`id`),
  KEY `id_8` (`id`),
  KEY `id_9` (`id`),
  KEY `id_10` (`id`),
  KEY `id_11` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_question`
--

INSERT INTO `forum_question` (`id`, `topic`, `detail`, `name`, `email`, `datetime`, `view`, `reply`) VALUES
(1, '', '', '', '', '24/07/15 12:07:21', 3, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
