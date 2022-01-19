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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Philip Davies','philipdorknessdavies@gmail.com',NULL),(2,'David Philips','bill_face@hotmail.com',NULL),(3,'Sausage Man','sausageman@gmail.com','asdf'),(4,'dvcwrf','sadwsqf','wrrwfr'),(5,'The Boss','theboss@gmail.com','$2y$10$UxegyLrg8WJAkZipQ7i3ae/PCTOWuM5PDeCNi.TmM.vAb091onofG'),(6,'Testy Tester','testytester@gmail.com','$2y$10$iwZiDpbirJZj3qzukrRAE.hYJJlSb7./1N0s603FbkMYB86/wI63q'),(7,'Checky Checker','checkychecker@gmail.com','$2y$10$bfNnWQCkN7FD0gc8uw8uXO7WQV2PdjgyP8yXQSt5/fcvy24DW/Jku'),(8,'Spammy','spammyspammer@gmail.com','$2y$10$TMD1j6Urtja4GeaxqD1aWOU0wMLlmgz8LwXr8RQbr774FbaLg6Qhu');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'heading 1 ','First post very informative. No more typos. Awesome it reverts to the blog page. Where I can edit it further. How about a date???How aboout header??\r\n\r\n','2021-12-16 12:18:09',2,'2021-12-28 16:13:12'),(2,'heading 2 ','Second post less informative. How about now??','2021-10-19 00:00:00',2,'2021-12-23 13:13:17'),(76,'Adding a new blog','words','2022-01-10 10:51:00',2,'2022-01-10 10:51:06');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (30,'Another Comment. edited','2021-12-10',2,2,'2021-12-13 14:21:51'),(79,'adding a comment on 3','2021-12-23',2,49,NULL),(80,'adding another comment on 3 to edit','2021-12-23',2,49,'2021-12-23 13:14:19'),(83,'adding another comment on 2???','2021-12-23',2,2,'2021-12-23 13:19:47'),(85,'adding a comment','2021-12-31',2,52,NULL),(89,'Adding a comment to edit','2022-01-03',2,55,'2022-01-03 15:56:24'),(91,'This is a great post','2022-01-04',2,57,NULL),(98,'adding a logged in comment','2022-01-06',2,61,NULL),(99,'adding a comment','2022-01-06',2,61,NULL),(101,'editing a comment as testy','2022-01-06',6,66,'2022-01-06 12:45:29'),(102,'wefwqef','2022-01-06',6,71,NULL),(103,'Adding a comment as Testy','2022-01-07',6,72,NULL),(104,'Adding a comment as testy on 1\r\n','2022-01-07',6,1,'2022-01-07 10:46:53'),(105,'Adding a comment as testy','2022-01-07',6,74,NULL),(107,'Adding a comment on 5 as checky checker','2022-01-07',7,72,'2022-01-07 12:41:49'),(108,'Adding a comment as Checky','2022-01-07',7,2,NULL),(109,'Adding a comment as Checky','2022-01-07',7,1,NULL),(111,'Adding a comment\r\n','2022-01-10',2,76,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'Release','This is the release date','2022-03-01 14:00:00',2);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-18 10:42:56
