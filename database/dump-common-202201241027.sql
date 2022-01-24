-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: 192.168.10.10    Database: common
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
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_01_03_155331_create_schedule_table',1),(6,'2022_01_03_180829_create_schedule_date_table',1),(7,'2022_01_03_181850_create_member_schedule_table',1),(8,'2022_01_03_183519_create_member_schedule_date_table',1),(9,'2022_01_16_140535_create_groupsize_table',1),(10,'2022_01_16_175857_create_view_member_schedule',1),(11,'2022_01_16_182550_create_view_member_schedule_date',1);
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
INSERT INTO `users` VALUES (1,'Adam',1,'adam@gmail.com','2022-01-23 07:31:04','$2y$10$JZFhdjR2VQD5Yx6se93KpuYtKfrnR7wK1u.JqBQnEQL2lmili.hUK','AZczy9UWBB5zrquDO4abAN3xaolIwERLFamCPjuSbpN0CWezUZ8QziQgInA1','2022-01-23 07:31:04','2022-01-23 07:31:04'),(2,'Eve',0,'eve@gmail.com','2022-01-23 07:31:04','$2y$10$JZFhdjR2VQD5Yx6se93KpuYtKfrnR7wK1u.JqBQnEQL2lmili.hUK','uPfXCKKCsH','2022-01-23 07:31:04','2022-01-23 07:31:04'),(3,'Kain',0,'kain@gmail.com',NULL,'$2y$10$JZFhdjR2VQD5Yx6se93KpuYtKfrnR7wK1u.JqBQnEQL2lmili.hUK','J4fJizjHCh','2022-01-23 07:31:04','2022-01-23 07:31:04'),(4,'Abel',0,'abel@gmail.com',NULL,'$2y$10$JZFhdjR2VQD5Yx6se93KpuYtKfrnR7wK1u.JqBQnEQL2lmili.hUK','worhrkSsZg','2022-01-23 07:31:04','2022-01-23 07:31:04'),(5,'Amie',0,'amie.kuphal@example.com','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','VVlO8Zau69','2022-01-23 07:31:04','2022-01-23 07:31:04'),(6,'Shana',0,'shana.torphy@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','dHRXngjMfO8cd4iyhIlzAc0T0a3rP6SEeoePRaqGDtXlCJZuFVRgzUJOEJdi','2022-01-23 07:31:04','2022-01-23 07:31:04'),(7,'Grayce',0,'grayce.herzog@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','hsGZ9eosih','2022-01-23 07:31:04','2022-01-23 07:31:04'),(8,'Isaias',0,'isaias.dvm@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','kAnGrWHvi0','2022-01-23 07:31:04','2022-01-23 07:31:04'),(9,'Willa',0,'willa.kertzmann@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','DlR6UUntn6','2022-01-23 07:31:04','2022-01-23 07:31:04'),(10,'Kaya',0,'kaya.v@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','Xr4kTavVp5','2022-01-23 07:31:04','2022-01-23 07:31:04'),(11,'Immanuel',0,'immanuel.rempel@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','ZTA9VlWrad','2022-01-23 07:31:04','2022-01-23 07:31:04'),(12,'Rodger',0,'rodger.brown@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','gYHMqDDExk','2022-01-23 07:31:04','2022-01-23 07:31:04'),(13,'Josie',0,'josie.macejkovic@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','qGCS4GThWz','2022-01-23 07:31:04','2022-01-23 07:31:04'),(14,'Desmond',0,'desmond.o\'hara@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','o8ibWgOvCE','2022-01-23 07:31:04','2022-01-23 07:31:04'),(15,'Rosalee',0,'rosalee.i@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','7c5gaIVmZu','2022-01-23 07:31:04','2022-01-23 07:31:05'),(16,'Hayden',0,'hayden.crist@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','CoXxVHTHqo','2022-01-23 07:31:04','2022-01-23 07:31:05'),(17,'Juanita',0,'juanita.cartwright@example.com','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','JSUf3JwIdT','2022-01-23 07:31:04','2022-01-23 07:31:05'),(18,'Schuyler',0,'schuyler.ii@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','z220uiSg46','2022-01-23 07:31:04','2022-01-23 07:31:05'),(19,'Mariane',0,'mariane.i@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','2HzdpOYtCP','2022-01-23 07:31:04','2022-01-23 07:31:05'),(20,'Milan',0,'milan.kirlin@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','XdYqpE6xKB','2022-01-23 07:31:04','2022-01-23 07:31:05'),(21,'Cory',0,'cory.dds@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','my176GS16Q','2022-01-23 07:31:04','2022-01-23 07:31:05'),(22,'Shanon',0,'shanon.ratke@example.net','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','1dJbDlbXi7','2022-01-23 07:31:04','2022-01-23 07:31:05'),(23,'Cristian',0,'cristian.welch@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','KIikQmmJlV','2022-01-23 07:31:04','2022-01-23 07:31:05'),(24,'Deja',0,'deja.waters@example.org','2022-01-23 07:31:04','$2y$10$A0hoN.v6.21e/70Vw/ByzOiZUBfJKxmybL8EFA1ihXeufRxzfTG06','NpdVDFOFQq','2022-01-23 07:31:04','2022-01-23 07:31:05');
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

-- Dump completed on 2022-01-24 10:27:06
