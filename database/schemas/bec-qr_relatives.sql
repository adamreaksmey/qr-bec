-- MySQL dump 10.13  Distrib 8.0.34, for macos13 (x86_64)
--
-- Host: 127.0.0.1    Database: bec-qr
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `relatives`
--

DROP TABLE IF EXISTS `relatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relatives` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parentId` bigint(20) unsigned NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('arrived','left') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `relatives_parentid_foreign` (`parentId`),
  CONSTRAINT `relatives_parentid_foreign` FOREIGN KEY (`parentId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatives`
--

LOCK TABLES `relatives` WRITE;
/*!40000 ALTER TABLE `relatives` DISABLE KEYS */;
INSERT INTO `relatives` VALUES (1,'Kork Chantrea',26,NULL,'2023-12-26 09:22:50','2023-12-28 10:51:12','left'),(3,'ធឿន ធីតា',27,NULL,'2023-12-26 09:35:04','2023-12-26 09:35:04','arrived'),(4,'Bro sokha',36,NULL,'2023-12-26 09:38:52','2023-12-26 09:38:52','arrived'),(5,'Sreyneat',37,NULL,'2023-12-26 09:39:53','2023-12-26 09:39:53','arrived'),(6,'អ៊ួង ខេង',39,NULL,'2023-12-27 09:07:59','2023-12-28 09:35:57','arrived'),(7,'យាយ សុន',39,NULL,'2023-12-27 09:08:55','2023-12-28 09:35:56','arrived'),(8,'សានសេរី ទេពី (២ឆ្នាំ)',39,NULL,'2023-12-27 09:09:04','2023-12-28 09:35:53','arrived'),(9,'ហៃ យ៉ូហាន',40,NULL,'2023-12-27 09:10:31','2023-12-27 09:10:31','arrived'),(10,'ស៊ុន វាសនា',51,NULL,'2023-12-27 09:13:57','2023-12-27 09:13:57','arrived'),(11,'សួន លីជូ',51,NULL,'2023-12-27 09:14:04','2023-12-27 09:14:04','arrived'),(12,'វាសនា សេរីឧត្តម ២ឆ្នាំ',51,NULL,'2023-12-27 09:14:09','2023-12-27 09:14:09','arrived'),(13,'ខេនដាវ លីសា ៩',52,NULL,'2023-12-27 09:14:42','2023-12-27 09:14:42','arrived'),(14,'ខេន សារា ស័ក្គណា ៧',52,NULL,'2023-12-27 09:14:47','2023-12-27 09:14:47','arrived'),(15,'ខេន ពេជ្រសិទ្ធិកា ៣',52,NULL,'2023-12-27 09:14:52','2023-12-27 09:14:52','arrived'),(16,'មុត ចិន្តា',53,NULL,'2023-12-27 09:15:26','2023-12-27 09:15:26','arrived'),(17,'ម៉ាលីន សុវណ្ណ',53,NULL,'2023-12-27 09:15:31','2023-12-27 09:15:31','arrived'),(18,'នេន តី',58,NULL,'2023-12-27 09:28:33','2023-12-27 09:28:33','arrived'),(19,'ម៉ានី មរកត',58,NULL,'2023-12-27 09:28:39','2023-12-27 09:28:39','arrived'),(20,'ម៉ានី មង្គល',58,NULL,'2023-12-27 09:28:44','2023-12-27 09:28:44','arrived'),(21,'សឹន សុឃី ប្ដី',61,NULL,'2023-12-27 09:29:47','2023-12-27 09:29:47','arrived'),(22,'ខន ម៉េងទ្រី កូន',61,NULL,'2023-12-27 09:29:55','2023-12-27 09:29:55','arrived'),(23,'រ៉ូ ម៉េងជីង',63,NULL,'2023-12-27 09:30:59','2023-12-27 09:30:59','arrived'),(24,'រ៉ូ សិរីបុត្រ',63,NULL,'2023-12-27 09:31:05','2023-12-27 09:31:05','arrived'),(25,'រ៉ូ ខេមរិន្ទ (Under two years old)',63,NULL,'2023-12-27 09:31:11','2023-12-27 09:31:11','arrived'),(26,'Rith heng',74,NULL,'2023-12-27 09:35:02','2023-12-28 10:49:47','left'),(27,'Jessica',76,NULL,'2023-12-27 09:35:35','2023-12-27 09:35:35','arrived'),(28,'Joshua',76,NULL,'2023-12-27 09:35:49','2023-12-27 09:35:49','arrived'),(29,'ឈិន រស្មី',81,NULL,'2023-12-27 09:37:02','2023-12-27 09:37:02','arrived'),(30,'ឈិន សុនិតា ( ក្មួយ អាយុ 5 ឆ្នាំ )',81,NULL,'2023-12-27 09:37:07','2023-12-27 09:37:07','arrived'),(31,'ឈិន មុនិកា ( ក្មួយអាយុ ឆ្នាំ )',81,NULL,'2023-12-27 09:37:11','2023-12-27 09:37:11','arrived'),(32,'Mary',97,NULL,'2023-12-27 09:40:40','2023-12-27 09:40:40','arrived'),(33,'Ayaan',97,NULL,'2023-12-27 09:40:45','2023-12-27 09:40:45','arrived'),(34,'Shayaan',97,NULL,'2023-12-27 09:40:49','2023-12-27 09:40:49','arrived'),(35,'Amir Hossein shaban',102,NULL,'2023-12-27 09:42:24','2023-12-27 09:42:24','arrived'),(36,'Ren In',106,NULL,'2023-12-27 09:43:28','2023-12-27 09:43:28','arrived'),(37,'Abi Nutter',106,NULL,'2023-12-27 09:43:33','2023-12-27 09:43:33','arrived'),(38,'Noah Nutter',106,NULL,'2023-12-27 09:43:38','2023-12-27 09:43:38','arrived'),(39,'Jimmy Nutter',106,NULL,'2023-12-27 09:43:43','2023-12-28 09:35:58','arrived'),(40,'Sandra Dodson',140,NULL,'2023-12-27 09:50:01','2023-12-27 09:50:01','arrived');
/*!40000 ALTER TABLE `relatives` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-29  6:37:56
