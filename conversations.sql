-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2013 at 01:17 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lebanese_blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `conv_id` int(11) NOT NULL AUTO_INCREMENT,
  `conv_topic` text NOT NULL,
  `conv_start` int(11) NOT NULL,
  PRIMARY KEY (`conv_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`conv_id`, `conv_topic`, `conv_start`) VALUES
(1, 'Minister Marwan Charbel''s pronouncements on Gays in Lebanon', 1367583713);

-- --------------------------------------------------------

--
-- Table structure for table `posts_in_conversations`
--

DROP TABLE IF EXISTS `posts_in_conversations`;
CREATE TABLE IF NOT EXISTS `posts_in_conversations` (
  `post_url` varchar(255) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `contribution_kind` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts_in_conversations`
--

INSERT INTO `posts_in_conversations` (`post_url`, `conversation_id`, `contribution_kind`) VALUES
('http://stateofmind13.com/2013/05/02/homosexuals-not-allowed-to-enter-lebanon/', 1, 'This is Outrageous'),
('http://ginosblog.com/2013/05/02/marwan-charbel-asks-whether-gay-french-citizens-should-be-allowed-to-enter-lebanon/', 1, 'This is Outrageous'),
('http://abirghattas.com/in-lebanon-homosexuals-are-illegal-al-assir-is-not/', 1, 'This is Outrageous'),
('http://lbcblogs.com/why-the-hatred-marwan-charbel-was-right/', 1, 'What''s The Big Deal?');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
