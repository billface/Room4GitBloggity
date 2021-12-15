# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: localhost (MySQL 5.7.34)
# Database: room4Two
# Generation Time: 2021-12-15 14:30:09 +0000
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
  `blogDate` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `blogModDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;

INSERT INTO `blog` (`id`, `blogHeading`, `blogText`, `blogDate`, `authorId`, `blogModDate`)
VALUES
	(1,'heading 1 edited fice','First post very informative. No more typos. Awesome it reverts to the blog page. Where I can edit it further. How about a date?\r\n','2021-10-19',2,'2021-12-15 12:49:12'),
	(2,'heading 2 EDITED','Second post less informative. How about now?','2021-10-19',2,'2021-12-01 11:02:52'),
	(31,'Running out of blogs','vefbiujvfbi','2021-12-15',2,NULL);

/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commText` text,
  `commDate` date DEFAULT NULL,
  `authorId` int(11) DEFAULT NULL,
  `commBlogId` int(11) DEFAULT NULL,
  `commModDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;

INSERT INTO `comments` (`id`, `commText`, `commDate`, `authorId`, `commBlogId`, `commModDate`)
VALUES
	(1,'This is a comment is edited, is it?\r\n','2021-11-17',2,1,'2021-12-13 14:21:36'),
	(30,'Another Comment. edited','2021-12-10',2,2,'2021-12-13 14:21:51'),
	(31,'Adding a comment on 1 edited\r\n','2021-12-14',2,1,'2021-12-14 13:24:44'),
	(32,'Adding a comment on 2','2021-12-14',2,2,NULL),
	(33,'Adding a comment on 3','2021-12-14',2,18,NULL),
	(35,'Another comment on 2','2021-12-14',2,2,NULL),
	(36,'Another comment on 3','2021-12-14',2,18,NULL),
	(44,'Adding a comment which I won\'t edit','2021-12-15',2,27,NULL);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
