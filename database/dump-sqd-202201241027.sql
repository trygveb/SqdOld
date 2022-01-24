-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 192.168.10.10    Database: sqd
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_02_160613_add_column_authority_to_users_table',1),(6,'2022_01_03_155331_create_training_table',1),(7,'2022_01_03_180829_create_training_date_table',1),(8,'2022_01_03_181850_create_member_training_table',1),(9,'2022_01_03_183519_create_member_training_date_table',1),(10,'2022_01_16_062751_rename_member_column_on_member_training_table',1),(11,'2022_01_16_070252_add_foreign_key_member_training_member',1),(12,'2022_01_16_085131_add_foreign_key_member_training_date_member',1),(13,'2022_01_16_140535_create_groupsize_table',1),(14,'2022_01_16_175857_create_view_member_training',1),(15,'2022_01_16_182550_create_view_member_training_date',1),(16,'2022_01_17_102356_add_unique_index_to_table_groupsize',1),(17,'2022_01_19_075724_add_column_admin_to_member_training_table',1),(18,'2022_01_21_075517_add_admin_to_view_member_training',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adam',1,'Adam.First@gmail.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','e4BEW4HzRB','2022-01-22 10:50:05','2022-01-22 10:50:05'),(2,'Eve',0,'Eve.Second@gmail.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','b2IpqGrD5Z','2022-01-22 10:50:05','2022-01-22 10:50:05'),(3,'Kain',0,'Kain.Third@gmail.com',NULL,'$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','xSwgEEVJx1','2022-01-22 10:50:05','2022-01-22 10:50:05'),(4,'Carolina',0,'Carolina.Renner@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','Y1KzIv2PWG','2022-01-22 10:50:05','2022-01-22 10:50:05'),(5,'Nikki',0,'Nikki.Satterfield@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','Zvh0T1Algk','2022-01-22 10:50:05','2022-01-22 10:50:05'),(6,'Eleonore',0,'Eleonore.PhD@example.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','q22zgS1R31','2022-01-22 10:50:05','2022-01-22 10:50:05'),(7,'Joseph',0,'Joseph.Renner@example.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','wMGNQTGowj','2022-01-22 10:50:05','2022-01-22 10:50:05'),(8,'Hilda',0,'Hilda.Rath@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','2MGE31eVQY','2022-01-22 10:50:05','2022-01-22 10:50:05'),(9,'Nya',0,'Nya.DDS@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','a2EJJ3c9Sd','2022-01-22 10:50:05','2022-01-22 10:50:05'),(10,'Dino',0,'Dino.Jenkins@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','K2zXzT4UUA','2022-01-22 10:50:05','2022-01-22 10:50:05'),(11,'Tamia',0,'Tamia.Bechtelar@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','2kvUvhLeOn','2022-01-22 10:50:05','2022-01-22 10:50:05'),(12,'Alvah',0,'Alvah.II@example.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','PyyCuf2OmN','2022-01-22 10:50:05','2022-01-22 10:50:05'),(13,'Gail',0,'Gail.Weissnat@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','twBDRrn2sN','2022-01-22 10:50:05','2022-01-22 10:50:05'),(14,'Ara',0,'Ara.Pfeffer@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','h8s2Dg99pm','2022-01-22 10:50:05','2022-01-22 10:50:05'),(15,'Richie',0,'Richie.II@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','DJsH3sFRym','2022-01-22 10:50:05','2022-01-22 10:50:05'),(16,'Roxanne',0,'Roxanne.III@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','hqaFJuWKRM','2022-01-22 10:50:05','2022-01-22 10:50:05'),(17,'Ervin',0,'Ervin.V@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','QnpNMbUx9a','2022-01-22 10:50:05','2022-01-22 10:50:05'),(18,'Arvid',0,'Arvid.Wiegand@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','N9oxhfMq1Q','2022-01-22 10:50:05','2022-01-22 10:50:05'),(19,'Bobby',0,'Bobby.Heidenreich@example.org','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','hpa5WikU6t','2022-01-22 10:50:05','2022-01-22 10:50:05'),(20,'Joesph',0,'Joesph.O\'Conner@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','qZO7F7ZB4w','2022-01-22 10:50:05','2022-01-22 10:50:05'),(21,'Mavis',0,'Mavis.Kulas@example.net','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','ZHgTTjDhQg','2022-01-22 10:50:05','2022-01-22 10:50:05'),(22,'Mortimer',0,'Mortimer.Kiehn@example.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','lxXSWVhpoZ','2022-01-22 10:50:05','2022-01-22 10:50:05'),(23,'Zoie',0,'Zoie.Runolfsson@example.com','2022-01-22 10:50:05','$2y$10$cBYpMVrCuF.ZC5sbY6tJiOyl9zgqwCSHBOIwtormoc8GhuA7rXyKi','QuqEeVY3mW','2022-01-22 10:50:05','2022-01-22 10:50:05');
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

-- Dump completed on 2022-01-24 10:27:07
