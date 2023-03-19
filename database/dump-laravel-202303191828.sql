-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: 192.168.10.10    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_03_155331_create_schedule_table',1),(6,'2022_01_03_180829_create_schedule_date_table',1),(7,'2022_01_03_181850_create_member_schedule_table',1),(8,'2022_01_03_183519_create_member_schedule_date_table',1),(9,'2022_01_16_140535_create_groupsize_table',2),(10,'2022_01_16_175857_create_view_member_schedule',2),(11,'2022_01_16_182550_create_view_member_schedule_date',2),(12,'2022_01_27_082709_modify_view_member_schedule_date',2),(15,'2023_02_02_112703_add_column_schema_name_to_member_schedule_table',3),(16,'2023_02_02_150653_create_view_member_schedule_1',4),(23,'2023_02_05_064337_create_index_member_schedule_u_x2',5),(25,'2023_02_09_095002_refactor_user_names',6),(34,'2023_02_09_150144_add_column_complete_name',7),(38,'2023_02_09_162009_update_user_names',8),(40,'2023_02_09_184226_rename_user_columns',9),(41,'2023_02_20_104401_add_column_default_weekday_to_schedule',10),(43,'2023_02_26_092322_add_column_default_start_time_to_schedule',11),(47,'2023_03_16_072832_create_view_member_schedule_2',12);
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
-- Table structure for table `triangle`
--

DROP TABLE IF EXISTS `triangle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `triangle` (
  `sidea` double DEFAULT NULL,
  `sideb` double DEFAULT NULL,
  `sidec` double GENERATED ALWAYS AS (sqrt(((`sidea` * `sidea`) + (`sideb` * `sideb`)))) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `triangle`
--

LOCK TABLES `triangle` WRITE;
/*!40000 ALTER TABLE `triangle` DISABLE KEYS */;
INSERT INTO `triangle` (`sidea`, `sideb`) VALUES (1,1),(3,4),(6,8);
/*!40000 ALTER TABLE `triangle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `complete_name` varchar(72) COLLATE utf8mb4_unicode_ci GENERATED ALWAYS AS (concat(`first_name`,_utf8mb4' ',coalesce(`middle_name`,_utf8mb4''),_utf8mb4' ',`family_name`)) VIRTUAL,
  `first_name` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'first_name',
  `middle_name` varchar(24) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `family_name` varchar(24) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'family_name',
  `authority` tinyint unsigned NOT NULL DEFAULT '0',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `middle_name`, `family_name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (2,'Arne',NULL,'Gustavsson',0,'arne.gusta@gmail.com','2020-12-19 19:50:31','$2y$10$998toc.IF/w6WGvqN/KdNugjdekUcmeJSCm/2YZjOpWcFlwqCOrvC','Heu58ayCeT33tp8sUJn0Bprf9L94ubstWPuuyit8wbxRqMX4wie1HPJIe7bq','2020-12-20 10:29:13','2020-12-20 10:29:13'),(5,'Georg',NULL,'Hodosi',0,'georg_hodosi@hotmail.com','2020-12-19 19:50:31','$2y$10$eW4IHm49u/Q/tcA/MS7IKuard6qooDkEb6K3eBH1whWJN0yeljzY.','akh2DpPpKTDyaMAGD2DZJqlqaQPPMey4LIAgw2PaDMFsynOzVyZm0B1xDcHH','2020-12-20 10:30:10','2022-03-05 18:49:25'),(6,'Trygve','','Botnen',2,'trygve.botnen@gmail.com','2020-12-19 19:50:31','$2y$10$FV7sgwKwISGgF1R3cNhII.xax4/mXcTjWNeqO5UulcE6s65XasFFW','S4t7NC3p1hZ1waX8qIINl6L9rtfia1gQhPDzWiFezzJ5IbxIY4VkV0nVrWse','2020-12-20 10:30:10','2022-11-28 08:12:13'),(9,'Leif',NULL,'Håkansson',0,'leif.annica@gmail.com','2020-12-19 19:50:31','$2y$10$/fu69ys9LX2BPeIhjzrJBugOBM7afxvt07X5UaQOpOsq5iu8Y0PaS','3kW2sxYnUJx8MLG624kzNAmnALk38gcsqoAVhdfp11JhuUrJGrtJ7LXHWaEi','2020-12-20 10:30:10','2023-03-09 19:13:44'),(13,'Göran',NULL,'Olsbro',0,'goran_olsbro@hotmail.com','2021-11-04 19:07:00','$2y$10$MRptj0ZuewzEwVN7aEdHLu0OTa08AQCdi9bhHlc4za5wDT61yNb0O','kCiz0JCSIqGlcV8P5rvLWpEwi0OMlbQmTQ47WjjfdysFJZcTkgjkDGiDqQ1E','2021-11-04 19:48:07','2021-11-04 19:48:07'),(14,'Vigdis',NULL,'Tengelsen',0,'vigdis.tengelsen@gmail.com','2021-11-04 19:07:00','$2y$10$2Jr1AZsVw0rrTGL.Gp25BuuxIUPIl5AQbnE0BQXJ/p5fLRUU276em','8IekQveEUgFqgH9B564n4bupKLdpq5FsOudzHfL1b9oCSZvM6dbSvvcDZj4b','2021-11-04 19:49:18','2023-01-04 15:12:15'),(15,'Eva',NULL,'Vagnkilde',0,'eva@vagnkilde.dk','2021-11-04 19:07:00','$2y$10$YDfIiuEokdDVFMfjzbqT7utlpt29v/OxRs5CyKoSGmLOSQsP0Pwn6',NULL,'2021-11-04 19:50:37','2021-11-04 19:50:37'),(16,'Annika',NULL,'Myhrberg',0,'annika.myhrberg@telia.com','2021-11-04 19:07:00','$2y$10$F3.i3ZUFiJkDGN6H/h4MyuGDWfpyjvyctpNGmmB.c6rOrOHlRY1Ni','0FqO6x4S6mPHw32St1SoXrd7dYljLPvJR0gdlY9jnF8mwH0EpbtHgMiQfSOm','2021-11-04 19:51:05','2021-11-04 19:51:05'),(17,'Lars',NULL,'Rawet',0,'lars.rawet@gmail.com','2021-11-04 19:07:00','$2y$10$wVU5Uz/aIXzDTNqruu3DzuWjP78RwwWsaHs1l3/amZy8b/lOWb7kC','uupTzFGY9UHZIY3pvn7uyrVpkmpnbn2BK4sK8kBw7HGXoKcxC6A6XiLZsPtP','2021-11-08 15:39:37','2021-11-08 15:39:37'),(18,'Monica',NULL,'Taleryd',0,'monica.taleryd46@gmail.com','2021-11-24 19:07:00','$2y$10$p0l.Z/0S59hzwHlc9ggkROB2SggFtNh4iAhJbiTmSc3n5q9ECN5aO','kfeR6HsKlSTzHBq6NWIJwlqwLINLZ8ILlPO9iYIuTGso60qO6IQzWShCioA1','2021-11-24 09:22:06','2021-11-24 10:00:51'),(19,'Inge',NULL,'Pettersson',0,'inge.pettersson53@gmail.com','2021-11-24 19:07:00','$2y$10$dCxtXPP4uw5TpwQTF.qt/uO2w3LTvTcsMY5NjbHmb7DeUbunBUE7e','BRvtrCLxG3hiyZT4k9f6U3hyhRiyMOLyJYCvOjJn0haKvSDSRfQ5nC30vgkr','2021-11-24 09:23:01','2021-12-11 14:21:18'),(25,'Michel',NULL,'Quetel',0,'michel@quetel.se','2022-04-28 08:18:53','$2y$10$Ix1RmF3NY1Z3oUTSyqqpj.1QsZ0BFeJXOiklBYMQFsd6nKal/bTQ2','2anN1ujNsKRXGv19jnqFdSNAeRdwLBBECqEYVoRSW4GOjXs0plpaMSnnwSDh',NULL,'2022-10-05 06:47:20'),(26,'Monika',NULL,'Lykvist',0,'monika.lykvist@hotmail.com','2022-11-28 08:42:04','$2y$10$dg7ejCEyXxYAoNgT6PdX9ODpyGXTKPwGCR1RMgBE4OJO5HDatkAX6','NT8QCx7gURlFw2dUxcaKq639emK4PN5QpZCyirpMWvOV0WBy8VSSYexCTesc','2022-11-27 08:42:49','2023-02-18 05:56:18'),(27,'Helene',NULL,'Botnen',0,'helenebotnen@gmail.com','2022-11-28 08:56:43','$2y$10$wmZVkOs5WZnRatN/1.ji5u0oHeYuLUy2dR7X7/c7uLsyPyVsmnidi','DZEbEQpbXVHz3FWNI09AKDfqi8LuK1mwhqrpop8qpG8jOtRdw4pPxXrUmGXm',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'laravel'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-19 18:28:19
