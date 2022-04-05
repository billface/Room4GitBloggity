-- MySQL dump 10.13  Distrib 8.0.20, for macos10.15 (x86_64)
--
-- Host: 192.168.10.10    Database: room4Two
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `permissions` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Philip Davies','philipdorknessdavies@gmail.com',NULL,0),(2,'David Philips','bill_face@hotmail.com',NULL,0),(3,'Sausage Man','sausageman@gmail.com','asdf',0),(4,'dvcwrf','sadwsqf','wrrwfr',0),(5,'The Boss','theboss@gmail.com','$2y$10$UxegyLrg8WJAkZipQ7i3ae/PCTOWuM5PDeCNi.TmM.vAb091onofG',0),(6,'Testy Tester','testytester@gmail.com','$2y$10$iwZiDpbirJZj3qzukrRAE.hYJJlSb7./1N0s603FbkMYB86/wI63q',127),(7,'Checky Checker','checkychecker@gmail.com','$2y$10$bfNnWQCkN7FD0gc8uw8uXO7WQV2PdjgyP8yXQSt5/fcvy24DW/Jku',1),(8,'Spammy','spammyspammer@gmail.com','$2y$10$TMD1j6Urtja4GeaxqD1aWOU0wMLlmgz8LwXr8RQbr774FbaLg6Qhu',0),(10,'Sausage','sausageman2@gmail.com','$2y$10$iXOwlOSSPkP0G/Rx6U2SQubELMfzMneDtKgJqjkClSae.8ZqYFnTm',0),(12,'Super User','superuser@gmail.com','$2y$10$7uxv2x.95fX.MFEr0lKw1e/0zUsphElWFFOd4o8.U0U.BAO0sFPBu',3);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `blogHeading` text,
  `blogText` text,
  `blogDate` datetime DEFAULT NULL,
  `authorId` int DEFAULT NULL,
  `blogModDate` datetime DEFAULT NULL,
  `metaDescription` text,
  `blogVideo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'heading 1 ','First post very informative. No more typos. Awesome it reverts to the blog page. Where I can edit it further. How about a date???How aboout header??\r\n\r\n','2021-12-16 12:18:09',6,'2022-03-04 10:27:49','metametameta','fYKqAC4n6Ug'),(2,'heading 2 ','Second post less informative. How about now??','2021-10-19 00:00:00',2,'2021-12-23 13:13:17','metametameta',NULL),(85,'A blog with a date EDITED BY TESTY','jdsmjmidsc','2022-01-26 20:00:00',6,'2022-02-22 12:42:08','metametameta',NULL),(98,'Adding a new bloggy','rerfver','2022-01-27 12:32:02',6,'2022-02-17 11:56:08','svsnijksae',NULL),(104,'adding a blog with slight entitiy change','re','2022-01-28 13:05:43',6,'2022-02-10 12:19:30','metametameta',NULL),(110,'Adding a new blogy meta','with a meta decription ooh','2022-02-03 12:28:38',6,'2022-02-10 09:27:27','metaVirginbbb',NULL),(112,'Adding a new blog to test','soirfniosnhrf','2022-02-04 10:09:25',6,'2022-02-08 08:59:42','metasausage',NULL),(113,'Adding a blog','dfvokjn','2022-02-04 10:57:17',9,NULL,'sdfvnok',NULL),(122,'Sausage man','ewrfHAs written a blog and editted it','2022-02-08 10:30:17',10,'2022-02-08 10:31:03','ewrewr',NULL),(138,'Category?','edcjni','2022-02-16 10:45:22',6,NULL,'efcefc',NULL),(149,'adding a new blogging ','ftyftyfyt','2022-02-16 12:14:22',6,NULL,'yftyfuyf',NULL),(150,'Lunch time','is now','2022-02-16 12:36:35',6,'2022-02-17 11:45:00','cdcdc',NULL),(151,'Adding a new blog','srvfvde','2022-02-16 12:39:01',6,'2022-02-17 11:43:35','ergvdevgeg',NULL),(152,'tybtyntnhy5','h5yuyn5hy65','2022-02-17 11:44:16',6,'2022-02-17 11:45:29','t65yht5hyhyt6',NULL),(153,'Adding a blog to check categories','Its no longer spam','2022-02-17 11:55:03',6,'2022-02-17 11:55:57','erfihucedw',NULL),(160,'Adding a superuser blog','Words','2022-03-02 11:48:49',12,'2022-03-02 11:49:05','metaWords',NULL),(161,'Adding a _stylized_ blog','erfgertg','2022-03-03 11:15:18',6,NULL,'ergrertg',NULL),(162,'*BLOG*','Adding a _stylized_ blog is **fun** and rewarding\r\n \r\n It makes me feel like I can write code...\r\n\r\nI can even put in a [link](www.bbc.co.uk)\r\n','2022-03-03 11:44:22',12,'2022-03-03 12:08:29','vrtvbrtvb',NULL),(163,'Blogging','blogging','2022-03-08 10:59:20',6,NULL,'efjnibwerf',NULL),(164,'Blogging 2 ','sawdiovhiuowhvn','2022-03-08 10:59:34',6,NULL,'dsfjvneaiorv',NULL),(165,'Adding another new blog','eoriuvneiuorvfniuoerqvngfvb','2022-03-08 10:59:51',6,NULL,'dsgfbdfsgbsfgbf',NULL),(166,'A further blog','sdcokjnearf','2022-03-08 11:00:13',6,NULL,'rwtbrwtbg',NULL),(167,'A image test blog','sdcnkonkonkocd','2022-03-10 10:48:30',6,NULL,'ecoinefcoink',NULL),(168,'Encytpe...','dfcedfc','2022-03-10 10:49:42',6,NULL,'efcefv',NULL),(171,'A video blog','This is a video with link','2022-03-14 11:50:40',6,NULL,'video','fYKqAC4n6Ug'),(172,'Testy Tester\'s Testable Test Test','This Testable Test Test by Testy Tester cannot be tested by the anti-testing group, (Anti Testing of Testable Test Tests)','2022-03-17 15:55:39',6,NULL,'This meta description should be called teta description, but it\'s called meta description anyways.','WQp0Q1OxDCw');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_category`
--

DROP TABLE IF EXISTS `blog_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_category` (
  `blogId` int NOT NULL,
  `categoryId` int NOT NULL,
  PRIMARY KEY (`blogId`,`categoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_category`
--

LOCK TABLES `blog_category` WRITE;
/*!40000 ALTER TABLE `blog_category` DISABLE KEYS */;
INSERT INTO `blog_category` VALUES (1,1),(98,1),(147,1),(147,2),(148,1),(148,2),(149,1),(149,2),(150,1),(151,1),(152,1),(152,2),(153,1),(154,1),(155,2),(157,2),(158,2),(159,2),(160,5),(161,5),(162,5),(163,1),(164,1),(165,1),(166,1),(167,5),(168,5),(169,2),(170,2),(171,5),(172,2);
/*!40000 ALTER TABLE `blog_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'News'),(2,'Spam'),(5,'Check');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `commText` text,
  `commDate` date DEFAULT NULL,
  `authorId` int DEFAULT NULL,
  `commBlogId` int DEFAULT NULL,
  `commModDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (30,'Another Comment. edited','2021-12-10',2,2,'2021-12-13 14:21:51'),(79,'adding a comment on 3','2021-12-23',2,49,NULL),(80,'adding another comment on 3 to edit','2021-12-23',2,49,'2021-12-23 13:14:19'),(83,'adding another comment on 2???','2021-12-23',2,2,'2021-12-23 13:19:47'),(85,'adding a comment','2021-12-31',2,52,NULL),(89,'Adding a comment to edit','2022-01-03',2,55,'2022-01-03 15:56:24'),(91,'This is a great post','2022-01-04',2,57,NULL),(98,'adding a logged in comment','2022-01-06',2,61,NULL),(99,'adding a comment','2022-01-06',2,61,NULL),(101,'editing a comment as testy','2022-01-06',6,66,'2022-01-06 12:45:29'),(102,'wefwqef','2022-01-06',6,71,NULL),(103,'Adding a comment as Testy','2022-01-07',6,72,NULL),(104,'Adding a comment as testy on 1\r\n','2022-01-07',6,1,'2022-01-07 10:46:53'),(105,'Adding a comment as testy','2022-01-07',6,74,NULL),(107,'Adding a comment on 5 as checky checker','2022-01-07',7,72,'2022-01-07 12:41:49'),(108,'Adding a comment as Checky','2022-01-07',7,2,NULL),(109,'Adding a comment as Checky','2022-01-07',7,1,NULL),(111,'Adding a comment\r\n','2022-01-10',2,76,NULL),(114,'Adding a comment as testy','2022-01-18',6,79,NULL),(115,'adding a comment as checky','2022-01-18',7,79,NULL),(116,'Adding a comment editing it','2022-02-04',6,112,'2022-02-04 10:10:02'),(120,'adding another comment','2022-02-04',6,85,NULL),(121,'yet another comment to see if everything needs to see everything in getRoutes()','2022-02-04',6,85,NULL),(122,'adding a comment','2022-02-04',9,113,NULL),(127,'how about noiw','2022-02-08',6,121,NULL),(128,'added a comment and edited it','2022-02-08',10,122,'2022-02-08 10:31:16'),(129,'added a comment here and edited it','2022-02-08',10,2,'2022-02-08 10:31:32'),(130,'Adding a comment','2022-02-09',6,125,NULL),(131,'Adding a comment to edit','2022-02-10',6,95,'2022-02-10 09:36:44'),(134,'A comment','2022-02-10',11,112,NULL),(135,'Adding a comment','2022-02-16',6,151,NULL),(136,'Adding a comment','2022-03-02',12,153,NULL),(137,'adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment adding a really long comment ','2022-03-03',7,1,NULL),(138,'Testy Test test  is so testy awesome that I want to test test. (Not Written By Testy Tester)','2022-03-17',6,172,NULL),(139,'Testy test! (Not Written By Testy Teser)','2022-03-17',6,172,NULL);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `eventHeading` varchar(255) DEFAULT NULL,
  `eventText` varchar(255) DEFAULT NULL,
  `eventDate` datetime DEFAULT NULL,
  `authorId` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'Release','This is the release date','2022-03-01 14:00:00',2),(4,'Todays date','    Is today','2022-01-18 13:06:56',2),(11,'Elliott\'s Birthday','    wsr','2022-05-20 08:00:00',6),(12,'Heidyn\'s Birthday','evdsv    ','2022-03-13 20:00:00',6),(13,'Christmas','Event content    ','2022-12-25 12:00:00',7),(14,'24th January','Is today','2022-01-24 11:00:00',7),(15,'Adding an event some way into the future','Edited again','2022-02-04 20:00:00',6),(16,'adding another event','with edit OOP','2022-02-05 20:00:00',6),(18,'Adding an OOP event','For real    ','2022-02-05 20:00:00',6),(20,'Adding a new event','    today is the greatest day','2022-02-03 20:00:00',6),(28,'q','exdq    ','2022-01-20 20:00:00',6),(29,'Is it REAL','I do hope so. It does now','2022-02-14 20:00:00',6),(30,'adding a sausage fest','words ','2022-03-02 20:00:00',10),(31,'event','event    ','2022-03-02 20:20:00',6),(34,'dgbdtg','    **estg*hes*thestg**','2022-03-10 10:00:00',6),(36,'Test Event','    dfvwfv','2022-03-16 20:00:00',6);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `itemHeading` varchar(255) DEFAULT NULL,
  `itemText` varchar(255) DEFAULT NULL,
  `itemPicture` varchar(255) DEFAULT NULL,
  `itemPrice` int DEFAULT '0',
  `itemShipping` int DEFAULT '0',
  `itemStock` int DEFAULT '0',
  `authorId` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'Virtual Studio','Very clever','1IwbMwGraq4zEnyfZxU8fYnMKJpwHcqTj',12,5,6,6),(2,'Virtual Song','Very tuneful    ','10YD7sJI_HHDXmQM4h96alvyGIU53nGYZ',20,10,20,6),(3,'Sausages','very tasty    ','1sD9EsxjdZXPtpUWZTmt9k3ews1WEz8Fm',5,1,5,6);
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `page` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pageHeading` varchar(255) DEFAULT NULL,
  `pageText` varchar(255) DEFAULT NULL,
  `authorId` int DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'The Home Page','this is the homey page',6,'meta real home page'),(2,'The About Page','This is information about the about page',6,'meta about page'),(3,'The Blog Page','This is the Blog Page',6,'meta blog list');
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-04 11:14:04
