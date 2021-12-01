# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.34)
# Database: room4Two
# Generation Time: 2021-12-01 12:14:13 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table author
# ------------------------------------------------------------

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;

INSERT INTO `author` (`id`, `name`, `email`)
VALUES
	(1,'Philip Davies','philipdorknessdavies@gmail.com'),
	(2,'David Philips','bill_face@hotmail.com');

/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blogheading` text,
  `blogtext` text,
  `blogdate` date DEFAULT NULL,
  `authorid` int(11) DEFAULT NULL,
  `blogmoddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`id`, `blogheading`, `blogtext`, `blogdate`, `authorid`, `blogmoddate`)
VALUES
	(1,'heading 1 EDITED','First post very informative. Oops typos. More typos. \r\n','2021-10-19',2,'2021-12-01 11:02:22'),
	(2,'heading 2 EDITED','Second post less informative. How about now?','2021-10-19',2,'2021-12-01 11:02:52'),
	(18,'Dave Phillips EDITED','Adding a blog','2021-11-22',2,'2021-12-01 11:03:10'),
	(19,'Is this still Dave? EDITED','author ID 2?','2021-11-22',2,'2021-12-01 11:03:47'),
	(20,'Blog with mod date?','???','2021-11-23',2,'2021-11-23 00:00:00'),
	(21,'blog with datetime?','12.15','2021-11-23',2,'2021-11-23 12:15:10'),
	(22,'This is a new blog','That should have a 12.19 blogmoddate','2021-11-23',2,'2021-11-23 12:19:48');

/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commtext` text,
  `commdate` date DEFAULT NULL,
  `authorid` int(11) DEFAULT NULL,
  `commblogid` int(11) DEFAULT NULL,
  `commmoddate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `commtext`, `commdate`, `authorid`, `commblogid`, `commmoddate`)
VALUES
	(1,'This is a comment','2021-11-17',1,1,NULL),
	(2,'A comment on the macbook super pro super','2021-11-25',2,1,'2021-11-30 12:55:19'),
	(3,'this is a comment. It sure is','2021-11-30',2,2,'2021-11-30 12:51:48'),
	(4,'add a new comment','2021-11-30',2,1,NULL),
	(5,'This is a comment \r\n','2021-12-01',2,19,NULL),
	(6,'No comments?','2021-12-01',2,18,NULL),
	(7,'How about now. When I edit you? Again','2021-12-01',2,2,'2021-12-01 12:09:28'),
	(8,'This is a comment that I\'m going to edit. Where do I go?','2021-12-01',2,18,'2021-12-01 11:33:20');

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
