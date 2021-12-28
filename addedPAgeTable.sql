# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.34)
# Database: room4Two
# Generation Time: 2021-12-28 16:17:12 +0000
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
  `blogHeading` text,
  `blogText` text,
  `blogDate` datetime DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `blogModDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`id`, `blogHeading`, `blogText`, `blogDate`, `authorId`, `blogModDate`)
VALUES
	(1,'heading 1 ','First post very informative. No more typos. Awesome it reverts to the blog page. Where I can edit it further. How about a date???How aboout header??\r\n\r\n','2021-12-16 12:18:09',2,'2021-12-28 16:13:12'),
	(2,'heading 2 ','Second post less informative. How about now??','2021-10-19 00:00:00',2,'2021-12-23 13:13:17'),
	(50,'Adding a new blog EDIT','dfcvkjdfcs','2021-12-24 11:16:35',2,'2021-12-24 11:16:46');

/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commText` text,
  `commDate` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commBlogId` int(11) DEFAULT NULL,
  `commModDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`id`, `commText`, `commDate`, `authorId`, `commBlogId`, `commModDate`)
VALUES
	(30,'Another Comment. edited','2021-12-10',2,2,'2021-12-13 14:21:51'),
	(79,'adding a comment on 3','2021-12-23',2,49,NULL),
	(80,'adding another comment on 3 to edit','2021-12-23',2,49,'2021-12-23 13:14:19'),
	(83,'adding another comment on 2???','2021-12-23',2,2,'2021-12-23 13:19:47'),
	(84,'Addding a comment, that I can edit','2021-12-24',2,50,'2021-12-24 11:18:24');

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table page
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `heading` text,
  `text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;

INSERT INTO `page` (`id`, `heading`, `text`)
VALUES
	(1,'Home Page','This is the home page'),
	(2,'About Page','once there was a rapper...'),
	(3,'Events Page','Coming soon to an ear near you'),
	(4,'Shop Page','Verses, verses, get them while they\'re hot'),
	(5,'Blogs Page',NULL);

/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
