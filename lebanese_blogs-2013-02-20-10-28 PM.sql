# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.25)
# Database: lebanese_blogs
# Generation Time: 2013-02-20 22:28:00 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table blogs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blogs`;

CREATE TABLE `blogs` (
  `blog_id` varchar(50) NOT NULL DEFAULT '',
  `blog_name` varchar(150) DEFAULT NULL,
  `blog_description` text,
  `blog_url` varchar(2083) DEFAULT NULL,
  `blog_author` varchar(150) NOT NULL DEFAULT '',
  `blog_author_twitter_username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`blog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;

INSERT INTO `blogs` (`blog_id`, `blog_name`, `blog_description`, `blog_url`, `blog_author`, `blog_author_twitter_username`)
VALUES
	('beirutntsc','Never Twice the Same City','Beirut, Never Twice the Same City','http://beirutntsc.blogspot.com','Tarek Chemaly',NULL),
	('beirutreport','The Beirut Report','An inside look at Lebanon, the Middle East and its media','http://beirutreport.com','Habib Battah','habib_b'),
	('beirutspring','Beirut Spring','Blogging Lebanese politics, business and society since 2005','http://beirutspring.com','Mustapha Hamoui','beirutspring'),
	('blogbaladi','Blog Baladi',NULL,'http://blogbaladi.com','Najib Mitri','LeNajib'),
	('joesbox','Joe\'s Box','Have a look inside my box','http://joesbox.com','Youssef Alam','JoesBox'),
	('lbcblogs','Lebanese Blogging Community','News is Monologue, Contribute & Create the Dialogue.','http://lbcblogs.com','','LBCBlogs'),
	('plus961','Blog +961',NULL,'http://plus961.com','Rami Fayoumi','Rami Fayoumi'),
	('qifanabki','Qifa Nabki','News and commentary from the Levant','http://qifanabki.com','Elias Muhanna','qifanabki'),
	('saharghazale','Un Peu de Kil Shi',NULL,'http://saharghazale.com','Sahar Ghazale','saharghazale'),
	('stateofmind13','A Separate State of Mind',NULL,'http://stateofmind13.com','Elie Fares','eliefares'),
	('tasteofbeirut','Taste Of Beirut','Lebanese Food Recipes for Home cooking','http://tasteofbeirut.com','Joumana Accad','tasteofbeirut'),
	('thedscoop','The D. Scoop','Lebanese fashion addict who?s been constantly following up and looking for answers','http://thedscoop.com','Dalia Saad','daliasaad89');

/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table posts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_url` varchar(2083) DEFAULT NULL,
  `post_title` varchar(1024) DEFAULT NULL,
  `post_image` varchar(2083) DEFAULT NULL,
  `post_excerpt` text,
  `blog_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
