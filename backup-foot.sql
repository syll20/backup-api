-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: foot
-- ------------------------------------------------------
-- Server version	8.0.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `calendars`
--

DROP TABLE IF EXISTS `calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kickoff` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendars`
--

LOCK TABLES `calendars` WRITE;
/*!40000 ALTER TABLE `calendars` DISABLE KEYS */;
INSERT INTO `calendars` VALUES (1,'Incidunt eaque quia ullam ut alias eaque corrupti.','1975-05-10 10:28:20','2022-03-10 15:20:46','2022-03-10 15:20:46'),(2,'Vel earum non accusantium non.','1991-06-10 20:57:49','2022-03-10 15:20:46','2022-03-10 15:20:46'),(3,'Eos non et deserunt nihil id aut eveniet voluptates.','1975-04-12 05:04:21','2022-03-10 15:20:46','2022-03-10 15:20:46'),(4,'Occaecati laborum quia atque quas.','2021-10-23 02:30:00','2022-03-10 15:20:46','2022-03-10 15:20:46'),(5,'Consequuntur officia rerum vitae at.','2018-11-16 22:00:36','2022-03-10 15:20:46','2022-03-10 15:20:46'),(6,'Consequatur modi placeat ut eum aperiam magni.','1990-06-10 06:34:14','2022-03-10 15:20:46','2022-03-10 15:20:46'),(7,'Illo voluptatem sit molestiae et voluptatem qui.','2012-07-10 22:09:54','2022-03-10 15:20:46','2022-03-10 15:20:46'),(8,'Fugiat maiores ex recusandae ex tempore est.','1987-05-30 15:25:03','2022-03-10 15:20:46','2022-03-10 15:20:46'),(9,'Qui qui vitae voluptatem.','1997-03-16 08:55:20','2022-03-10 15:20:46','2022-03-10 15:20:46'),(10,'Esse voluptas doloribus delectus mollitia aspernatur voluptates.','2018-07-08 19:07:03','2022-03-10 15:20:46','2022-03-10 15:20:46'),(11,'Facere ut tempora aut dolor consequatur nesciunt.','1994-04-02 23:33:04','2022-03-10 15:20:46','2022-03-10 15:20:46'),(12,'Sunt minus cumque doloribus sit.','2002-09-24 19:46:38','2022-03-10 15:20:46','2022-03-10 15:20:46'),(13,'Nisi et similique neque autem.','1990-08-24 20:13:06','2022-03-10 15:20:46','2022-03-10 15:20:46'),(14,'Error quia repellat nihil sit necessitatibus sed.','2006-02-24 03:18:27','2022-03-10 15:20:46','2022-03-10 15:20:46'),(15,'Sint excepturi incidunt aut libero illo vitae debitis error.','2013-05-25 20:23:26','2022-03-10 15:20:46','2022-03-10 15:20:46'),(16,'Eum quos et et ducimus.','1974-01-30 05:08:48','2022-03-10 15:20:46','2022-03-10 15:20:46'),(17,'Sunt et animi commodi rem sunt blanditiis veniam.','2012-01-23 21:40:35','2022-03-10 15:20:46','2022-03-10 15:20:46'),(18,'Quaerat non assumenda amet mollitia.','2013-01-05 03:52:34','2022-03-10 15:20:46','2022-03-10 15:20:46'),(19,'Rerum alias animi doloribus.','2018-07-03 08:37:34','2022-03-10 15:20:46','2022-03-10 15:20:46'),(20,'Sunt illo laudantium est.','2005-06-04 13:48:27','2022-03-10 15:20:46','2022-03-10 15:20:46'),(21,'Sunt eos et quasi et neque.','1978-11-20 04:29:03','2022-03-10 15:23:13','2022-03-10 15:23:13'),(22,'Quos sapiente voluptas deleniti accusamus eius non vel.','2006-09-20 22:53:39','2022-03-10 15:23:13','2022-03-10 15:23:13'),(23,'Cupiditate id dolorum velit ut rem qui.','1977-03-30 08:20:36','2022-03-10 15:23:13','2022-03-10 15:23:13'),(24,'Maxime eaque officia omnis commodi ut qui.','1981-10-23 15:08:33','2022-03-10 15:23:13','2022-03-10 15:23:13'),(25,'Pariatur qui fugit error.','1976-11-08 03:10:03','2022-03-10 15:23:13','2022-03-10 15:23:13'),(26,'Quo aut debitis voluptatem molestias unde possimus quia.','2010-02-11 05:31:25','2022-03-10 15:23:13','2022-03-10 15:23:13'),(27,'Hic reprehenderit repudiandae autem corporis libero et vero.','2013-03-19 07:20:43','2022-03-10 15:23:13','2022-03-10 15:23:13'),(28,'Delectus itaque voluptatibus qui sapiente omnis similique ea dolor.','1978-01-17 21:37:46','2022-03-10 15:23:13','2022-03-10 15:23:13'),(29,'Quo animi quisquam earum.','1976-04-23 10:38:06','2022-03-10 15:23:13','2022-03-10 15:23:13'),(30,'In sapiente est aut debitis.','1992-06-27 19:24:47','2022-03-10 15:23:13','2022-03-10 15:23:13'),(31,'Quis magni ipsam autem at non.','1988-11-25 16:24:34','2022-03-10 15:23:13','2022-03-10 15:23:13'),(32,'Itaque saepe aut aut a.','1974-07-23 03:03:39','2022-03-10 15:23:13','2022-03-10 15:23:13'),(33,'Ex neque ab molestias cum velit architecto.','1995-03-11 02:24:28','2022-03-10 15:23:13','2022-03-10 15:23:13'),(34,'Excepturi suscipit voluptate nihil quas.','1979-09-28 04:14:31','2022-03-10 15:23:13','2022-03-10 15:23:13'),(35,'Aliquid tempora maxime rerum quo.','1989-11-02 11:24:36','2022-03-10 15:23:13','2022-03-10 15:23:13'),(36,'Quasi nihil dolores quia consequuntur praesentium corrupti saepe.','2021-04-19 00:55:50','2022-03-10 15:23:13','2022-03-10 15:23:13'),(37,'Corrupti voluptas nulla et qui dignissimos pariatur voluptates.','2010-03-15 15:27:05','2022-03-10 15:23:13','2022-03-10 15:23:13'),(38,'Consequatur rerum occaecati maiores aliquid.','2014-03-01 13:29:05','2022-03-10 15:23:13','2022-03-10 15:23:13'),(39,'Aut accusantium hic sed et magnam.','2002-03-15 10:54:42','2022-03-10 15:23:13','2022-03-10 15:23:13'),(40,'Est omnis odio iste.','2010-05-17 13:20:26','2022-03-10 15:23:13','2022-03-10 15:23:13'),(41,'Nobis itaque voluptatem culpa odit sed et eius.','1972-05-13 19:14:45','2022-03-10 15:23:39','2022-03-10 15:23:39'),(42,'Tempora tempora ea dolores delectus voluptatibus dolores.','2006-11-05 19:48:58','2022-03-10 15:23:39','2022-03-10 15:23:39'),(43,'Aliquid deleniti perspiciatis et consequatur nemo et et.','2010-12-01 12:45:27','2022-03-10 15:23:39','2022-03-10 15:23:39'),(44,'Aperiam est tempore dignissimos sed.','1994-01-01 18:47:41','2022-03-10 15:23:39','2022-03-10 15:23:39'),(45,'Et aut reprehenderit ipsa enim omnis molestiae.','1991-04-29 12:39:27','2022-03-10 15:23:39','2022-03-10 15:23:39'),(46,'Expedita assumenda sed perspiciatis ut.','1988-12-05 00:52:18','2022-03-10 15:23:39','2022-03-10 15:23:39'),(47,'Rerum in ea similique porro est id.','1971-03-20 05:05:37','2022-03-10 15:23:39','2022-03-10 15:23:39'),(48,'Voluptas exercitationem necessitatibus consequatur laborum.','2006-05-14 22:01:36','2022-03-10 15:23:39','2022-03-10 15:23:39'),(49,'Est quo deleniti dolorem odio eum consequuntur voluptate.','2020-04-08 13:04:19','2022-03-10 15:23:39','2022-03-10 15:23:39'),(50,'Omnis soluta fuga earum.','2001-08-24 10:22:17','2022-03-10 15:23:39','2022-03-10 15:23:39'),(51,'Quo sequi sed qui minima et.','1978-03-21 16:01:02','2022-03-10 15:23:39','2022-03-10 15:23:39'),(52,'Modi provident necessitatibus qui eum sit hic impedit.','2014-09-21 00:01:22','2022-03-10 15:23:39','2022-03-10 15:23:39'),(53,'Consequatur cupiditate voluptas veritatis dolores.','2016-02-04 14:29:45','2022-03-10 15:23:39','2022-03-10 15:23:39'),(54,'Ut vel et cupiditate quod.','1982-03-27 03:30:28','2022-03-10 15:23:39','2022-03-10 15:23:39'),(55,'Rerum mollitia quibusdam non possimus molestiae.','1981-11-26 22:54:37','2022-03-10 15:23:39','2022-03-10 15:23:39'),(56,'Fuga ducimus dolorem nam nihil nemo.','1974-11-26 18:43:41','2022-03-10 15:23:39','2022-03-10 15:23:39'),(57,'Et quia quidem sapiente facilis.','2019-05-07 02:42:58','2022-03-10 15:23:39','2022-03-10 15:23:39'),(58,'Quia ab veritatis occaecati necessitatibus ex.','1985-11-05 05:04:45','2022-03-10 15:23:39','2022-03-10 15:23:39'),(59,'Quasi et voluptatum sint nihil quidem.','2014-06-11 01:55:01','2022-03-10 15:23:39','2022-03-10 15:23:39'),(60,'In aut natus minima nihil debitis assumenda animi.','2021-07-07 13:34:46','2022-03-10 15:23:39','2022-03-10 15:23:39'),(61,'Quia unde voluptas molestias quod et dolorum eveniet.','2020-03-08 05:00:12','2022-03-10 15:24:33','2022-03-10 15:24:33'),(62,'Enim commodi quidem quisquam esse quisquam consequatur et.','2008-07-21 19:02:08','2022-03-10 15:24:33','2022-03-10 15:24:33'),(63,'Corporis iusto consequatur alias enim deserunt natus.','2017-12-14 20:52:47','2022-03-10 15:24:33','2022-03-10 15:24:33'),(64,'Sit explicabo aut modi omnis omnis dolores rerum.','1977-01-11 10:29:06','2022-03-10 15:24:33','2022-03-10 15:24:33'),(65,'Recusandae totam dolor et.','1981-06-30 23:30:58','2022-03-10 15:24:33','2022-03-10 15:24:33'),(66,'Sed et dolores doloribus quis.','2017-05-28 04:25:42','2022-03-10 15:24:33','2022-03-10 15:24:33'),(67,'Unde quia molestiae nesciunt maiores.','1992-09-19 11:32:30','2022-03-10 15:24:33','2022-03-10 15:24:33'),(68,'Nesciunt enim possimus deserunt quibusdam.','2019-11-08 01:39:20','2022-03-10 15:24:33','2022-03-10 15:24:33'),(69,'Sed sunt mollitia nisi tenetur ad.','1999-05-12 10:42:42','2022-03-10 15:24:33','2022-03-10 15:24:33'),(70,'Ut quia qui asperiores neque aut et.','2010-01-07 18:43:06','2022-03-10 15:24:34','2022-03-10 15:24:34'),(71,'Aperiam non maxime esse tempora perspiciatis accusamus est.','1985-02-08 11:09:24','2022-03-10 15:24:34','2022-03-10 15:24:34'),(72,'Voluptatem exercitationem sunt in reiciendis velit veniam.','2011-06-17 22:48:04','2022-03-10 15:24:34','2022-03-10 15:24:34'),(73,'Libero aliquid nam debitis aut excepturi soluta enim.','1993-01-19 18:48:06','2022-03-10 15:24:34','2022-03-10 15:24:34'),(74,'Odit occaecati enim rem quaerat enim et.','1983-07-19 08:18:31','2022-03-10 15:24:34','2022-03-10 15:24:34'),(75,'Reprehenderit ut velit magnam quam deleniti.','1971-08-16 23:35:56','2022-03-10 15:24:34','2022-03-10 15:24:34'),(76,'Distinctio sunt voluptatem quasi.','1975-11-10 19:40:16','2022-03-10 15:24:34','2022-03-10 15:24:34'),(77,'Reprehenderit incidunt harum quos reiciendis nihil non qui.','2009-10-24 07:44:54','2022-03-10 15:24:34','2022-03-10 15:24:34'),(78,'Ad consequatur sint delectus nihil eaque amet perferendis repudiandae.','2004-11-16 06:40:41','2022-03-10 15:24:34','2022-03-10 15:24:34'),(79,'Rerum numquam maxime quam earum.','2001-03-20 21:30:31','2022-03-10 15:24:34','2022-03-10 15:24:34'),(80,'Quia quibusdam modi excepturi.','1977-02-08 09:22:18','2022-03-10 15:24:34','2022-03-10 15:24:34'),(81,'Fuga id nihil tempore sequi sunt aut.','2000-01-02 01:14:55','2022-03-10 15:25:23','2022-03-10 15:25:23'),(82,'Distinctio est eaque omnis nam amet corporis voluptatibus dolores.','2022-01-16 13:29:30','2022-03-10 15:25:23','2022-03-10 15:25:23'),(83,'Fugiat et voluptates sunt cupiditate nihil ex incidunt.','2017-12-13 10:30:01','2022-03-10 15:25:23','2022-03-10 15:25:23'),(84,'Exercitationem dolor ratione dolorem voluptate sed ad architecto.','2009-09-06 08:07:46','2022-03-10 15:25:23','2022-03-10 15:25:23'),(85,'Vitae doloribus nihil eos voluptate et molestiae voluptate.','1993-08-19 08:36:06','2022-03-10 15:25:23','2022-03-10 15:25:23'),(86,'Error voluptate ex suscipit veniam magni.','1979-01-01 22:13:49','2022-03-10 15:25:23','2022-03-10 15:25:23'),(87,'Temporibus libero quam est et alias.','1982-04-24 06:13:56','2022-03-10 15:25:23','2022-03-10 15:25:23'),(88,'Molestiae minus voluptas aut facilis at et.','1995-10-07 08:24:26','2022-03-10 15:25:23','2022-03-10 15:25:23'),(89,'Sequi officia numquam quia sint eum corporis.','1995-03-21 10:19:49','2022-03-10 15:25:23','2022-03-10 15:25:23'),(90,'Laudantium at similique consequatur nostrum quo libero.','1992-03-31 12:41:49','2022-03-10 15:25:23','2022-03-10 15:25:23'),(91,'Repellendus saepe velit suscipit facilis.','1980-07-18 15:54:46','2022-03-10 15:25:23','2022-03-10 15:25:23'),(92,'Atque deleniti at voluptatum ea quis earum.','1989-11-12 14:10:48','2022-03-10 15:25:23','2022-03-10 15:25:23'),(93,'Eum sequi sit sed quis.','1978-10-03 22:11:46','2022-03-10 15:25:23','2022-03-10 15:25:23'),(94,'Exercitationem perferendis accusamus incidunt aut sapiente perferendis.','1970-09-18 21:52:51','2022-03-10 15:25:23','2022-03-10 15:25:23'),(95,'Ut enim aut aut numquam quidem non.','2000-07-30 04:06:10','2022-03-10 15:25:23','2022-03-10 15:25:23'),(96,'In est et quos quasi.','1977-04-07 05:15:21','2022-03-10 15:25:23','2022-03-10 15:25:23'),(97,'Sit qui quos fugit eos esse reprehenderit.','1974-07-01 05:45:27','2022-03-10 15:25:23','2022-03-10 15:25:23'),(98,'Et eveniet delectus sit.','2010-01-19 05:58:25','2022-03-10 15:25:23','2022-03-10 15:25:23'),(99,'Quo quia perferendis necessitatibus ducimus.','1992-01-28 04:02:38','2022-03-10 15:25:23','2022-03-10 15:25:23'),(100,'Fuga aut consequatur at modi.','1991-02-04 05:00:28','2022-03-10 15:25:23','2022-03-10 15:25:23');
/*!40000 ALTER TABLE `calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtures`
--

DROP TABLE IF EXISTS `fixtures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fixtures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `calendar_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `template` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fixtures_calendar_id_foreign` (`calendar_id`),
  CONSTRAINT `fixtures_calendar_id_foreign` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtures`
--

LOCK TABLES `fixtures` WRITE;
/*!40000 ALTER TABLE `fixtures` DISABLE KEYS */;
/*!40000 ALTER TABLE `fixtures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_standings`
--

DROP TABLE IF EXISTS `general_standings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `general_standings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `league` int NOT NULL,
  `season` int NOT NULL,
  `club_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `where` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` tinyint NOT NULL,
  `points` smallint NOT NULL,
  `played` tinyint NOT NULL,
  `win` tinyint NOT NULL,
  `draw` tinyint NOT NULL,
  `lose` tinyint NOT NULL,
  `goals_for` tinyint unsigned NOT NULL,
  `goals_against` tinyint unsigned NOT NULL,
  `goals_diff` smallint NOT NULL,
  `last5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_standings`
--

LOCK TABLES `general_standings` WRITE;
/*!40000 ALTER TABLE `general_standings` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_standings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (12,'2014_10_12_000000_create_users_table',1),(13,'2014_10_12_100000_create_password_resets_table',1),(14,'2019_08_19_000000_create_failed_jobs_table',1),(15,'2019_12_14_000001_create_personal_access_tokens_table',1),(16,'2022_03_09_151143_create_calendars_table',1),(17,'2022_03_09_151329_create_fixtures_table',1),(18,'2022_03_16_085952_create_standings_table',2),(19,'2022_03_16_091536_create_general_standings_table',2),(20,'2022_03_16_092801_create_scorers_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scorers`
--

DROP TABLE IF EXISTS `scorers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scorers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `league` int NOT NULL,
  `season` int NOT NULL,
  `club_id` int NOT NULL,
  `player_id` int NOT NULL,
  `total` tinyint NOT NULL,
  `home` tinyint NOT NULL,
  `away` tinyint NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scorers`
--

LOCK TABLES `scorers` WRITE;
/*!40000 ALTER TABLE `scorers` DISABLE KEYS */;
INSERT INTO `scorers` VALUES (1,61,2021,94,21592,14,8,6,'https://media.api-sports.io/football/players/21592.png','Gaetan','Laborde','2022-03-16 21:07:21','2022-03-16 21:07:21'),(2,61,2021,94,663,14,6,8,'https://media.api-sports.io/football/players/663.png','Martin','Terrier','2022-03-16 21:07:21','2022-03-16 21:07:21'),(3,61,2021,94,2206,6,4,2,'https://media.api-sports.io/football/players/2206.png','Benjamin','Bourigeaud','2022-03-16 21:07:21','2022-03-16 21:07:21'),(4,61,2021,79,8489,13,7,6,'https://media.api-sports.io/football/players/8489.png','Jonathan','David','2022-03-16 21:07:21','2022-03-16 21:07:21'),(5,61,2021,83,21104,10,7,3,'https://media.api-sports.io/football/players/21104.png','Randal','Kolo Muani','2022-03-16 21:07:21','2022-03-16 21:07:21'),(6,61,2021,83,21497,8,5,3,'https://media.api-sports.io/football/players/21497.png','Ludovic','Blas','2022-03-16 21:07:21','2022-03-16 21:07:21'),(7,61,2021,1063,22102,9,6,3,'https://media.api-sports.io/football/players/22102.png','Wahbi','Khazri','2022-03-16 21:07:21','2022-03-16 21:07:21'),(8,61,2021,1063,21437,5,2,3,'https://media.api-sports.io/football/players/21437.png','Denis','Bouanga','2022-03-16 21:07:21','2022-03-16 21:07:21'),(9,61,2021,95,22264,10,5,5,'https://media.api-sports.io/football/players/22264.png','Ludovic','Ajorque','2022-03-16 21:15:34','2022-03-16 21:15:34'),(10,61,2021,95,20535,9,5,4,'https://media.api-sports.io/football/players/20535.png','Habib','Diallo','2022-03-16 21:15:34','2022-03-16 21:15:34'),(11,61,2021,95,22261,7,5,2,'https://media.api-sports.io/football/players/22261.png','Adrien','Thomasson','2022-03-16 21:15:34','2022-03-16 21:15:34'),(12,61,2021,95,933,9,3,6,'https://media.api-sports.io/football/players/933.png','Kevin','Gameiro','2022-03-16 21:15:34','2022-03-16 21:15:34'),(13,61,2021,84,21591,9,4,5,'https://media.api-sports.io/football/players/21591.png','Andy','Delort','2022-03-16 21:15:34','2022-03-16 21:15:34'),(14,61,2021,84,85041,10,3,7,'https://media.api-sports.io/football/players/85041.png','Amine','Gouiri','2022-03-16 21:15:34','2022-03-16 21:15:34'),(15,61,2021,81,1912,9,4,5,'https://media.api-sports.io/football/players/1912.png','Dimitri','Payet','2022-03-16 21:15:34','2022-03-16 21:15:34'),(16,61,2021,81,785,8,4,4,'https://media.api-sports.io/football/players/785.png','Cengiz','Under','2022-03-16 21:15:34','2022-03-16 21:15:34'),(17,61,2021,81,333,6,4,2,'https://media.api-sports.io/football/players/333.png','Arkadiusz','Milik','2022-03-16 21:15:34','2022-03-16 21:15:34'),(18,61,2021,81,284072,4,1,3,'https://media.api-sports.io/football/players/284072.png','Bamba','Dieng','2022-03-16 21:15:34','2022-03-16 21:15:34'),(19,61,2021,112,1275,4,2,2,'https://media.api-sports.io/football/players/1275.png','Nicolas','de Preville','2022-03-16 21:17:28','2022-03-16 21:17:28'),(20,61,2021,112,20654,4,2,2,'https://media.api-sports.io/football/players/20654.png','Fabien','Centonze','2022-03-16 21:17:28','2022-03-16 21:17:28'),(21,61,2021,112,20537,3,1,2,'https://media.api-sports.io/football/players/20537.png','Ibrahima','Niane','2022-03-16 21:17:28','2022-03-16 21:17:28'),(22,61,2021,97,69971,4,3,1,'https://media.api-sports.io/football/players/69971.png','Terem','Moffi','2022-03-16 21:19:42','2022-03-16 21:19:42'),(23,61,2021,97,2215,4,1,3,'https://media.api-sports.io/football/players/2215.png','Armand','Lauriente','2022-03-16 21:19:42','2022-03-16 21:19:42'),(24,61,2021,97,144319,3,1,2,'https://media.api-sports.io/football/players/144319.png','Sambou','Soumano','2022-03-16 21:19:42','2022-03-16 21:19:42'),(25,61,2021,91,2059,15,12,3,'https://media.api-sports.io/football/players/2059.png','Wissam','Ben Yedder','2022-03-16 21:24:05','2022-03-16 21:24:05'),(26,61,2021,91,107,6,2,4,'https://media.api-sports.io/football/players/107.png','Sofiane','Diop','2022-03-16 21:24:05','2022-03-16 21:24:05'),(27,61,2021,91,989,5,4,1,'https://media.api-sports.io/football/players/989.png','Kevin','Volland','2022-03-16 21:24:05','2022-03-16 21:24:05'),(28,61,2021,93,174565,9,4,5,'https://media.api-sports.io/football/players/174565.png','Hugo','Ekitike','2022-03-16 21:24:05','2022-03-16 21:24:05');
/*!40000 ALTER TABLE `scorers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `standings`
--

DROP TABLE IF EXISTS `standings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `standings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `league` int NOT NULL,
  `season` int NOT NULL,
  `club_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rank` tinyint NOT NULL,
  `points` smallint NOT NULL,
  `played` tinyint NOT NULL,
  `win` tinyint NOT NULL,
  `draw` tinyint NOT NULL,
  `lose` tinyint NOT NULL,
  `goals_for` tinyint unsigned NOT NULL,
  `goals_against` tinyint unsigned NOT NULL,
  `goals_diff` smallint NOT NULL,
  `last5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `standings`
--

LOCK TABLES `standings` WRITE;
/*!40000 ALTER TABLE `standings` DISABLE KEYS */;
INSERT INTO `standings` VALUES (1,61,2021,85,'Paris SG','home',1,40,14,13,1,0,34,7,27,'WWWWW','2022-03-16 12:38:37','2022-03-16 12:38:37'),(2,61,2021,94,'Stade Rennais','home',2,31,14,10,1,3,33,9,24,'WWWWD','2022-03-16 12:40:39','2022-03-16 12:40:39'),(3,61,2021,83,'Nantes','home',3,29,14,9,2,3,24,13,11,'WWWWD','2022-03-16 12:51:17','2022-03-16 12:51:17'),(4,61,2021,95,'Strasbourg','home',4,27,14,8,3,3,28,13,15,'WDWWL','2022-03-16 12:51:17','2022-03-16 12:51:17'),(5,61,2021,80,'Lyon','home',5,26,15,7,5,3,25,18,7,'LLWWW','2022-03-16 12:51:17','2022-03-16 12:51:17'),(6,61,2021,91,'Monaco','home',6,25,14,7,4,3,26,13,13,'LDWWW','2022-03-16 13:01:45','2022-03-16 13:01:45'),(7,61,2021,82,'Montpellier','home',7,24,15,7,3,5,24,18,6,'DLLWL','2022-03-16 13:01:45','2022-03-16 13:01:45'),(8,61,2021,84,'Nice','home',8,24,14,7,3,4,18,13,14,'WWLWW','2022-03-16 13:01:45','2022-03-16 13:01:45'),(9,61,2021,79,'Lille','home',9,24,14,6,6,2,19,16,3,'DWDLW','2022-03-16 13:01:47','2022-03-16 13:01:47'),(10,61,2021,116,'Lens','home',10,23,14,6,5,3,23,15,8,'LDWLW','2022-03-16 13:06:31','2022-03-16 13:06:31'),(11,61,2021,81,'Marseille','home',11,20,14,5,5,4,22,16,6,'LLWDD','2022-03-16 13:18:00','2022-03-16 13:18:00'),(12,61,2021,106,'Brest','home',12,18,14,5,3,6,21,22,-1,'LLWWL','2022-03-16 13:18:00','2022-03-16 13:18:00'),(13,61,2021,93,'Reims','home',13,17,13,4,5,4,18,13,5,'DDWLW','2022-03-16 13:18:00','2022-03-16 13:18:00'),(14,61,2021,77,'Angers','home',14,16,14,5,1,8,15,18,-3,'LLLLW','2022-03-16 13:18:01','2022-03-16 13:18:01'),(15,61,2021,97,'Lorient','home',15,16,13,4,4,5,11,14,-3,'LLWDD','2022-03-16 13:24:04','2022-03-16 13:24:04'),(16,61,2021,110,'Troyes','home',16,15,14,3,5,6,14,19,-5,'LLWWL','2022-03-16 13:24:04','2022-03-16 13:24:04'),(17,61,2021,99,'Clermont','home',17,14,14,3,5,6,14,19,-5,'DDWLW','2022-03-16 13:24:04','2022-03-16 13:24:04'),(18,61,2021,1063,'Saint-Etienne','home',18,14,14,3,5,6,17,26,-9,'LLLLW','2022-03-16 13:24:05','2022-03-16 13:24:05'),(19,61,2021,78,'Bordeaux','home',19,11,14,2,5,7,20,27,-7,'LDWLL','2022-03-16 13:27:17','2022-03-16 13:27:17'),(20,61,2021,112,'Metz','home',20,9,14,1,6,7,15,25,-10,'DDLLL','2022-03-16 13:27:18','2022-03-16 13:27:18'),(21,61,2021,81,'Marseille','away',1,30,14,9,3,2,21,10,11,'WDWLW','2022-03-16 13:45:59','2022-03-16 13:45:59'),(22,61,2021,84,'Nice','away',2,27,14,8,3,3,20,7,13,'DDLWW','2022-03-16 13:46:00','2022-03-16 13:46:00'),(23,61,2021,85,'Paris-SG','away',3,25,14,7,4,3,25,17,8,'LLWDD','2022-03-16 13:46:00','2022-03-16 13:46:00'),(24,61,2021,95,'Strasbourg','away',4,20,14,5,5,4,22,19,3,'DDWLW','2022-03-16 13:46:00','2022-03-16 13:46:00'),(25,61,2021,79,'Lille','away',5,19,14,5,4,5,18,19,-1,'WWLDW','2022-03-16 13:46:00','2022-03-16 13:46:00'),(26,61,2021,94,'Stade Rennais','away',6,18,14,5,3,6,24,18,6,'WWLLL','2022-03-16 13:46:01','2022-03-16 13:46:01'),(27,61,2021,116,'Lens','away',7,18,14,5,3,6,19,23,-4,'DWLWL','2022-03-16 14:08:09','2022-03-16 14:08:09'),(28,61,2021,93,'Reims','away',8,18,15,4,6,5,14,18,-4,'WWLLD','2022-03-16 14:08:09','2022-03-16 14:08:09'),(29,61,2021,106,'Brest','away',9,17,14,4,5,5,15,20,-5,'WDLLD','2022-03-16 14:08:09','2022-03-16 14:08:09'),(30,61,2021,91,'Monaco','away',10,16,14,4,4,6,14,17,-3,'LWDLD','2022-03-16 14:08:09','2022-03-16 14:08:09'),(31,61,2021,80,'Lyon','away',11,16,13,4,4,5,15,19,-4,'WDLWD','2022-03-16 14:08:09','2022-03-16 14:08:09'),(32,61,2021,82,'Montpellier','away',12,14,13,4,2,7,17,22,-5,'LWLLW','2022-03-16 14:08:09','2022-03-16 14:08:09'),(33,61,2021,112,'Metz','away',13,14,14,3,5,6,10,21,-11,'LDDWD','2022-03-16 14:08:09','2022-03-16 14:08:09'),(34,61,2021,99,'Clermont','away',14,14,14,4,2,8,13,29,-16,'LWWLW','2022-03-16 14:08:10','2022-03-16 14:08:10'),(35,61,2021,83,'Nantes','away',15,13,14,3,4,7,12,17,-5,'LDLLW','2022-03-16 14:13:03','2022-03-16 14:13:03'),(36,61,2021,77,'Angers','away',16,13,14,2,7,5,16,23,-7,'LLLDL','2022-03-16 14:13:03','2022-03-16 14:13:03'),(37,61,2021,110,'Troyes','away',17,13,14,4,1,9,13,27,-14,'WLLLW','2022-03-16 14:13:03','2022-03-16 14:13:03'),(38,61,2021,1063,'Saint-Etienne','away',18,12,14,3,3,8,11,24,-13,'DLWWL','2022-03-16 14:13:03','2022-03-16 14:13:03'),(39,61,2021,97,'Lorient','away',19,11,15,2,5,8,13,29,-16,'WWDLL','2022-03-16 14:13:03','2022-03-16 14:13:03'),(40,61,2021,78,'Bordeaux','away',20,11,14,2,5,7,18,41,-23,'LDLLL','2022-03-16 14:13:03','2022-03-16 14:13:03');
/*!40000 ALTER TABLE `standings` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-18 15:19:00



----

INSERT INTO calendars VALUES (29, 'Ligue 1 - Rennes-Metz', '2022-03-20 15:00:00', now(), now());
INSERT INTO calendars VALUES (30, 'Ligue 1 - Nice-Rennes', '2022-04-03 15:00:00', now(), now());
INSERT INTO calendars VALUES (31, 'Ligue 1 - Reims-Rennes', '2022-04-10 15:00:00', now(), now());
INSERT INTO calendars VALUES (32, 'Ligue 1 - Rennes-Monaco', '2022-04-17 15:00', now(), now());
INSERT INTO calendars VALUES (33, 'Ligue 1 - Strasbourg-Rennes', '2022-03-20 15:00', now(), now());

INSERT INTO calendars VALUES (34, 'Ligue 1 - Rennes-Lorient', '2022-04-24 15:00', now(), now());
INSERT INTO calendars VALUES (35, 'Ligue 1 - Rennes-Saint-Etienne', '2022-05-01 15:00', now(), now());
INSERT INTO calendars VALUES (36, 'Ligue 1 - Nantes-Rennes', '2022-05-11 15:00', now(), now());
INSERT INTO calendars VALUES (37, 'Ligue 1 - Rennes-Marseille', '2022-05-14 15:00', now(), now());
INSERT INTO calendars VALUES (38, 'Ligue 1 - Lille-Rennes', '2022-05-21 15:00', now(), now());