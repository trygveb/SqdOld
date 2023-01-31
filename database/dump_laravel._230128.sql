-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.32-0buntu0.20.04.1

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_03_155331_create_schedule_table',1),(6,'2022_01_03_180829_create_schedule_date_table',1),(7,'2022_01_03_181850_create_member_schedule_table',1),(8,'2022_01_03_183519_create_member_schedule_date_table',1),(9,'2022_01_16_140535_create_groupsize_table',2),(10,'2022_01_16_175857_create_view_member_schedule',2),(11,'2022_01_16_182550_create_view_member_schedule_date',2),(12,'2022_01_27_082709_modify_view_member_schedule_date',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `authority` tinyint unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'ArneBirgit',0,'arne.gusta@gmail.com','2020-12-19 19:50:31','$2y$10$998toc.IF/w6WGvqN/KdNugjdekUcmeJSCm/2YZjOpWcFlwqCOrvC','Heu58ayCeT33tp8sUJn0Bprf9L94ubstWPuuyit8wbxRqMX4wie1HPJIe7bq','2020-12-20 10:29:13','2020-12-20 10:29:13'),(5,'Hodosis',0,'georg_hodosi@hotmail.com','2020-12-19 19:50:31','$2y$10$eW4IHm49u/Q/tcA/MS7IKuard6qooDkEb6K3eBH1whWJN0yeljzY.','akh2DpPpKTDyaMAGD2DZJqlqaQPPMey4LIAgw2PaDMFsynOzVyZm0B1xDcHH','2020-12-20 10:30:10','2022-03-05 18:49:25'),(6,'Trygve',1,'trygve.botnen@gmail.com','2020-12-19 19:50:31','$2y$10$FV7sgwKwISGgF1R3cNhII.xax4/mXcTjWNeqO5UulcE6s65XasFFW','NktDcj0zcu8URaBrVDu9I0sBgdTk3Kdllq8zyM0CzxQICXOZwI3BBpUfKTN6','2020-12-20 10:30:10','2022-11-28 08:12:13'),(9,'Hakanssons',0,'leif.annica@gmail.com','2020-12-19 19:50:31','$2y$10$HZH3bySG2flHoVi9yj9aUO4/.yJw1.HcI44M9YK5xrE3p3NkCsyQ2','0nuQSl8dqViP9Tws9UtBP0UGN5QINj99sDGjM2DrlFfQ20l46cLqP45uDtYN','2020-12-20 10:30:10','2021-08-11 06:27:13'),(13,'Goran',0,'goran_olsbro@hotmail.com','2021-11-04 19:07:00','$2y$10$MRptj0ZuewzEwVN7aEdHLu0OTa08AQCdi9bhHlc4za5wDT61yNb0O','kCiz0JCSIqGlcV8P5rvLWpEwi0OMlbQmTQ47WjjfdysFJZcTkgjkDGiDqQ1E','2021-11-04 19:48:07','2021-11-04 19:48:07'),(14,'Vigdis',0,'vigdis.tengelsen@gmail.com','2021-11-04 19:07:00','$2y$10$2Jr1AZsVw0rrTGL.Gp25BuuxIUPIl5AQbnE0BQXJ/p5fLRUU276em','8IekQveEUgFqgH9B564n4bupKLdpq5FsOudzHfL1b9oCSZvM6dbSvvcDZj4b','2021-11-04 19:49:18','2023-01-04 15:12:15'),(15,'Eva',0,'eva@vagnkilde.dk','2021-11-04 19:07:00','$2y$10$YDfIiuEokdDVFMfjzbqT7utlpt29v/OxRs5CyKoSGmLOSQsP0Pwn6',NULL,'2021-11-04 19:50:37','2021-11-04 19:50:37'),(16,'Annika',0,'annika.myhrberg@telia.com','2021-11-04 19:07:00','$2y$10$F3.i3ZUFiJkDGN6H/h4MyuGDWfpyjvyctpNGmmB.c6rOrOHlRY1Ni','0FqO6x4S6mPHw32St1SoXrd7dYljLPvJR0gdlY9jnF8mwH0EpbtHgMiQfSOm','2021-11-04 19:51:05','2021-11-04 19:51:05'),(17,'Lasse',0,'lars.rawet@gmail.com','2021-11-04 19:07:00','$2y$10$wVU5Uz/aIXzDTNqruu3DzuWjP78RwwWsaHs1l3/amZy8b/lOWb7kC','uupTzFGY9UHZIY3pvn7uyrVpkmpnbn2BK4sK8kBw7HGXoKcxC6A6XiLZsPtP','2021-11-08 15:39:37','2021-11-08 15:39:37'),(18,'Monica',0,'monica.taleryd46@gmail.com','2021-11-24 19:07:00','$2y$10$p0l.Z/0S59hzwHlc9ggkROB2SggFtNh4iAhJbiTmSc3n5q9ECN5aO','kfeR6HsKlSTzHBq6NWIJwlqwLINLZ8ILlPO9iYIuTGso60qO6IQzWShCioA1','2021-11-24 09:22:06','2021-11-24 10:00:51'),(19,'Inge',0,'inge.pettersson53@gmail.com','2021-11-24 19:07:00','$2y$10$dCxtXPP4uw5TpwQTF.qt/uO2w3LTvTcsMY5NjbHmb7DeUbunBUE7e','BRvtrCLxG3hiyZT4k9f6U3hyhRiyMOLyJYCvOjJn0haKvSDSRfQ5nC30vgkr','2021-11-24 09:23:01','2021-12-11 14:21:18'),(25,'Quetels',0,'michel@quetel.se','2022-04-28 08:18:53','$2y$10$Ix1RmF3NY1Z3oUTSyqqpj.1QsZ0BFeJXOiklBYMQFsd6nKal/bTQ2','2anN1ujNsKRXGv19jnqFdSNAeRdwLBBECqEYVoRSW4GOjXs0plpaMSnnwSDh',NULL,'2022-10-05 06:47:20'),(26,'Monika L',0,'monika.lykvist@hotmail.com','2022-11-28 08:42:04','$2y$10$c85X/NrUJp8000HCrs7uYe6uPK32jzOq8GqlGgItyHEYvcKP2iurK','zzDnl9mAsYMBWLKUm4m1VhkJVBK4bXKh1lPyMZjwpKIAGkxd2Zx7OjWDvXRc','2022-11-27 08:42:49','2022-11-27 08:42:49'),(27,'Helene',0,'helenebotnen@gmail.com','2022-11-28 08:56:43','$2y$10$wmZVkOs5WZnRatN/1.ji5u0oHeYuLUy2dR7X7/c7uLsyPyVsmnidi','DZEbEQpbXVHz3FWNI09AKDfqi8LuK1mwhqrpop8qpG8jOtRdw4pPxXrUmGXm',NULL,NULL),(28,'LAsse J',0,'lasse@crazyflutters.com','2023-01-22 19:03:19','$2y$10$ENTJl..gbOhj7aSQ4ExZR.da11D9sYSSMP.VuU10Z/WXeHL.NRcai','ZJ3OOO0btNwlULb0lXhHTWA44GD76AUGmfxCltshhojna6OaXEJxvXuKsjP5','2023-01-22 19:03:19','2023-01-22 18:48:21'),(30,'Thomas',0,'thomas@sqd.se','2023-01-22 20:08:06','$2y$10$9bx5AQYxae3u0XMEvsOhher45PYDuNIW01vk.3fmfmYqhsrn1spiq','Hnky2AvhrWHFI5uiiwvJk1zYUT2UGgZ0LFhLvXfoLbUq79cJVhW5YqP8H1fX','2023-01-22 20:08:06','2023-01-23 06:49:38'),(32,'Jesper',0,'jesper@sqd.se','2023-01-22 20:08:06','$2y$10$C/7FRRXQ.w1ZJp84Vk.u/ed0psDCegVZRI4rZSJlCuicKlhNPSOoy','j4x1oLq9fP7xxeLRDHGV3GMLtFiqgo4Kv5YbPTQfpUryfpa3kPlpWhne3CjJ','2023-01-22 20:08:06','2023-01-23 06:53:44'),(33,'Lena',0,'lena@sqd.se','2023-01-22 20:08:06','$2y$10$nIl00jApV.JlgSkVJwTq7uWf.D4iFioYhT9eXCKAvwjw47rLRviv.','nSCElzQ05rhRmmVljup56N2IhCAGjuTevsvJR0NPd6o0VBEgoIuWVtuk6LH7','2023-01-22 20:08:06','2023-01-23 06:56:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-28  6:57:53
