-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2013 at 05:25 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `lebanese_blogs`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` varchar(50) NOT NULL DEFAULT '',
  `blog_name` varchar(150) DEFAULT NULL,
  `blog_description` text,
  `blog_url` varchar(255) DEFAULT NULL,
  `blog_author` varchar(150) NOT NULL DEFAULT '',
  `blog_author_twitter_username` varchar(50) DEFAULT NULL,
  `blog_rss_feed` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` VALUES('beirutntsc', 'Never Twice the Same City', 'Beirut, Never Twice the Same City', 'http://beirutntsc.blogspot.com', 'Tarek Chemaly', 'NA', 'http://beirutntsc.blogspot.com/feeds/posts/default');
INSERT INTO `blogs` VALUES('beirutreport', 'The Beirut Report', 'An inside look at Lebanon, the Middle East and its media', 'http://beirutreport.com', 'Habib Battah', 'habib_b', 'http://www.beirutreport.com/feeds/posts/default');
INSERT INTO `blogs` VALUES('beirutspring', 'Beirut Spring', 'Blogging Lebanese politics, business and society since 2005', 'http://beirutspring.com', 'Mustapha Hamoui', 'beirutspring', 'http://beirutspring.com/blog/feed');
INSERT INTO `blogs` VALUES('blogbaladi', 'Blog Baladi', NULL, 'http://blogbaladi.com', 'Najib Mitri', 'LeNajib', 'http://blogbaladi.com/feed/');
INSERT INTO `blogs` VALUES('joesbox', 'Joe''s Box', 'Have a look inside my box', 'http://joesbox.com', 'Youssef Alam', 'JoesBox', 'http://www.joesbox.com/feeds/posts/default');
INSERT INTO `blogs` VALUES('Karl reMarks', 'Karl Remarks', 'Middle East politics, culture and satire', 'http://www.karlremarks.com', 'Karl Sharro', 'KarlreMarks', 'http://www.karlremarks.com/feeds/posts/default');
INSERT INTO `blogs` VALUES('lbcblogs', 'Lebanese Blogging Community', 'News is Monologue, Contribute & Create the Dialogue.', 'http://lbcblogs.com', 'Nadine Mazloum', 'LBCBlogs', 'http://lbcblogs.com/feed/');
INSERT INTO `blogs` VALUES('octavianasr', 'Octavia Nasr''s Blog', NULL, 'http://blog.octavianasr.com', 'Octavia Nasr', 'octavianasr', 'http://blog.octavianasr.com/feeds/posts/default');
INSERT INTO `blogs` VALUES('plus961', 'Blog +961', NULL, 'http://plus961.com', 'Rami Fayoumi', 'Rami Fayoumi', 'http://plus961.com/feed/');
INSERT INTO `blogs` VALUES('qifanabki', 'Qifa Nabki', 'News and commentary from the Levant', 'http://qifanabki.com', 'Elias Muhanna', 'qifanabki', 'http://qifanabki.com/feed/');
INSERT INTO `blogs` VALUES('saharghazale', 'Un Peu de Kil Shi', 'A blog on design and life delicacies...', 'http://saharghazale.com', 'Sahar Ghazale', 'saharghazale', 'http://saharghazale.com/feed/');
INSERT INTO `blogs` VALUES('stateofmind13', 'A Separate State of Mind', NULL, 'http://stateofmind13.com', 'Elie Fares', 'eliefares', 'http://stateofmind13.com/feed/');
INSERT INTO `blogs` VALUES('tasteofbeirut', 'Taste Of Beirut', 'Lebanese Food Recipes for Home cooking', 'http://tasteofbeirut.com', 'Joumana Accad', 'tasteofbeirut', 'http://www.tasteofbeirut.com/feed/');
INSERT INTO `blogs` VALUES('thedscoop', 'The D. Scoop', 'Lebanese fashion addict who?s been constantly following up and looking for answers', 'http://thedscoop.com', 'Dalia Saad', 'daliasaad89', 'http://www.thedscoop.com/rss');
