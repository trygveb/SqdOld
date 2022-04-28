-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2022 at 07:49 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schedule`
--
CREATE DATABASE IF NOT EXISTS `schedule` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `schedule`;

-- --------------------------------------------------------

--
-- Table structure for table `groupsize`
--

CREATE TABLE `groupsize` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `size` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member_schedule`
--

CREATE TABLE `member_schedule` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `group_size` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `admin` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This is a many-to-many relationship connecting members and schedules';

--
-- Dumping data for table `member_schedule`
--

INSERT INTO `member_schedule` (`id`, `user_id`, `schedule_id`, `group_size`, `admin`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(2, 5, 1, 2, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(3, 6, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(4, 9, 1, 2, 1, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(5, 13, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(6, 14, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(7, 15, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(8, 16, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(9, 17, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(10, 18, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07'),
(11, 19, 1, 1, 0, '2022-03-05 07:05:07', '2022-03-05 07:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `member_schedule_date`
--

CREATE TABLE `member_schedule_date` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `schedule_date_id` bigint UNSIGNED NOT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table contains the status for each member on each schedule date';

--
-- Dumping data for table `member_schedule_date`
--

INSERT INTO `member_schedule_date` (`id`, `user_id`, `schedule_date_id`, `status`, `created_at`, `updated_at`) VALUES
(381, 2, 22, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(383, 5, 22, 3, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(386, 9, 22, 0, '2021-06-18 18:54:33', '2021-06-18 18:54:33'),
(388, 6, 22, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(391, 2, 23, 4, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(393, 5, 23, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(396, 9, 23, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(398, 6, 23, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(401, 2, 24, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(403, 5, 24, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(406, 9, 24, 4, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(408, 6, 24, 4, '2021-06-18 18:54:33', '2021-08-16 05:23:01'),
(411, 2, 25, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(413, 5, 25, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(416, 9, 25, 4, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(418, 6, 25, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(421, 2, 26, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(423, 5, 26, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(426, 9, 26, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(428, 6, 26, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(431, 2, 27, 3, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(433, 5, 27, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(436, 9, 27, 4, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(438, 6, 27, 3, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(441, 2, 28, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(443, 5, 28, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(446, 9, 28, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(448, 6, 28, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(451, 2, 29, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(453, 5, 29, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(456, 9, 29, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(458, 6, 29, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(461, 2, 30, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(463, 5, 30, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(466, 9, 30, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(468, 6, 30, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(471, 2, 31, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(473, 5, 31, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(476, 9, 31, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(478, 6, 31, 1, '2021-06-18 18:54:33', '2021-06-22 16:37:10'),
(481, 2, 32, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(483, 5, 32, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(486, 9, 32, 2, '2021-06-18 18:54:33', '2021-08-11 06:30:49'),
(488, 6, 32, 3, '2021-06-18 18:54:33', '2021-11-08 16:38:22'),
(491, 2, 33, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(493, 5, 33, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(496, 9, 33, 2, '2021-06-18 18:54:33', '2021-10-20 06:52:40'),
(498, 6, 33, 3, '2021-06-18 18:54:33', '2021-11-15 08:24:54'),
(501, 2, 34, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(503, 5, 34, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(506, 9, 34, 2, '2021-06-18 18:54:33', '2021-10-20 06:52:40'),
(508, 6, 34, 4, '2021-06-18 18:54:33', '2021-11-08 16:38:22'),
(511, 2, 35, 2, '2021-06-18 18:54:33', '2021-08-09 14:29:34'),
(513, 5, 35, 2, '2021-06-18 18:54:33', '2021-08-01 19:01:10'),
(516, 9, 35, 2, '2021-06-18 18:54:33', '2021-10-20 06:52:40'),
(518, 6, 35, 3, '2021-06-18 18:54:33', '2021-11-29 19:00:17'),
(684, 13, 32, 1, '2021-11-04 19:54:15', '2021-11-04 19:05:38'),
(685, 14, 32, 1, '2021-11-04 19:54:15', '2021-11-04 19:06:36'),
(686, 15, 32, 1, '2021-11-04 19:54:15', '2021-11-04 19:07:27'),
(687, 16, 32, 3, '2021-11-04 19:54:15', '2021-11-04 19:08:39'),
(688, 13, 33, 1, '2021-11-04 19:54:15', '2021-11-09 05:38:12'),
(689, 14, 33, 1, '2021-11-04 19:54:15', '2021-11-04 19:06:36'),
(690, 15, 33, 1, '2021-11-04 19:54:15', '2021-11-04 19:07:27'),
(691, 16, 33, 4, '2021-11-04 19:54:15', '2021-11-12 16:49:41'),
(692, 13, 34, 3, '2021-11-04 19:54:15', '2021-11-09 05:38:12'),
(693, 14, 34, 1, '2021-11-04 19:54:15', '2021-11-09 06:04:38'),
(694, 15, 34, 1, '2021-11-04 19:54:15', '2021-11-09 12:19:03'),
(695, 16, 34, 1, '2021-11-04 19:54:15', '2021-11-12 16:49:41'),
(696, 13, 35, 1, '2021-11-04 19:54:15', '2021-11-09 05:38:12'),
(697, 14, 35, 1, '2021-11-04 19:54:15', '2021-11-09 06:04:38'),
(698, 15, 35, 3, '2021-11-04 19:54:15', '2021-11-19 09:56:55'),
(699, 16, 35, 3, '2021-11-04 19:54:15', '2021-11-29 10:52:42'),
(785, 17, 22, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(786, 17, 23, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(787, 17, 24, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(788, 17, 25, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(789, 17, 26, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(790, 17, 27, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(791, 17, 28, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(792, 17, 29, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(793, 17, 30, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(794, 17, 31, 0, '2021-11-08 15:42:05', '2021-11-08 15:42:05'),
(795, 17, 32, 3, '2021-11-08 15:42:05', '2021-11-08 14:49:49'),
(796, 17, 33, 3, '2021-11-08 15:42:05', '2021-11-08 18:48:54'),
(797, 17, 34, 3, '2021-11-08 15:42:05', '2021-11-08 18:48:54'),
(798, 17, 35, 3, '2021-11-08 15:42:05', '2021-11-08 18:48:54'),
(830, 16, 53, 3, '2021-11-17 20:35:17', '2022-01-09 15:18:53'),
(831, 2, 53, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(832, 15, 53, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(833, 5, 53, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(834, 13, 53, 1, '2021-11-17 20:35:17', '2022-01-03 19:12:05'),
(836, 17, 53, 3, '2021-11-17 20:35:17', '2022-01-10 10:32:55'),
(837, 9, 53, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(838, 6, 53, 3, '2021-11-17 20:35:17', '2022-01-06 14:00:35'),
(839, 14, 53, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(843, 16, 54, 3, '2021-11-17 20:35:17', '2022-01-09 15:18:53'),
(844, 2, 54, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(845, 15, 54, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(846, 5, 54, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(847, 13, 54, 1, '2021-11-17 20:35:17', '2022-01-03 19:12:05'),
(849, 17, 54, 3, '2021-11-17 20:35:17', '2022-01-17 08:06:53'),
(850, 9, 54, 1, '2021-11-17 20:35:17', '2022-01-24 08:04:47'),
(851, 6, 54, 3, '2021-11-17 20:35:17', '2022-01-06 14:00:35'),
(852, 14, 54, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(856, 16, 55, 3, '2021-11-17 20:35:17', '2022-01-19 14:04:24'),
(857, 2, 55, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(858, 15, 55, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(859, 5, 55, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(860, 13, 55, 1, '2021-11-17 20:35:17', '2022-01-03 19:12:05'),
(862, 17, 55, 3, '2021-11-17 20:35:17', '2022-01-29 18:19:08'),
(863, 9, 55, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(864, 6, 55, 3, '2021-11-17 20:35:17', '2022-01-17 08:48:17'),
(865, 14, 55, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(869, 16, 56, 3, '2021-11-17 20:35:17', '2022-01-24 10:39:59'),
(870, 2, 56, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(871, 15, 56, 1, '2021-11-17 20:35:17', '2022-01-10 08:32:49'),
(872, 5, 56, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(873, 13, 56, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(875, 17, 56, 3, '2021-11-17 20:35:17', '2022-01-29 18:19:08'),
(876, 9, 56, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(877, 6, 56, 3, '2021-11-17 20:35:17', '2022-02-07 09:48:46'),
(878, 14, 56, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(882, 16, 57, 3, '2021-11-17 20:35:17', '2022-01-24 10:39:59'),
(883, 2, 57, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(884, 15, 57, 3, '2021-11-17 20:35:17', '2022-01-10 08:32:49'),
(885, 5, 57, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(886, 13, 57, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(888, 17, 57, 3, '2021-11-17 20:35:17', '2022-01-29 18:19:08'),
(889, 9, 57, 2, '2021-11-17 20:35:17', '2022-01-24 08:04:47'),
(890, 6, 57, 3, '2021-11-17 20:35:17', '2022-02-16 08:53:55'),
(891, 14, 57, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(895, 16, 58, 3, '2021-11-17 20:35:17', '2022-01-19 14:04:47'),
(896, 2, 58, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(897, 15, 58, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(898, 5, 58, 2, '2021-11-17 20:35:17', '2022-02-08 21:46:00'),
(899, 13, 58, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(901, 17, 58, 3, '2021-11-17 20:35:17', '2022-01-29 18:19:18'),
(902, 9, 58, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(903, 6, 58, 3, '2021-11-17 20:35:17', '2022-02-22 19:52:01'),
(904, 14, 58, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(908, 16, 59, 4, '2021-11-17 20:35:17', '2021-11-29 10:55:20'),
(909, 2, 59, 3, '2021-11-17 20:35:17', '2022-03-02 10:00:16'),
(910, 15, 59, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(911, 5, 59, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(912, 13, 59, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(914, 17, 59, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(915, 9, 59, 3, '2021-11-17 20:35:17', '2022-01-24 08:04:47'),
(916, 6, 59, 3, '2021-11-17 20:35:17', '2022-03-02 08:26:33'),
(917, 14, 59, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(921, 16, 60, 1, '2021-11-17 20:35:17', '2022-03-07 12:48:29'),
(922, 2, 60, 3, '2021-11-17 20:35:17', '2022-03-09 10:52:51'),
(923, 15, 60, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(924, 5, 60, 2, '2021-11-17 20:35:17', '2021-11-20 21:36:31'),
(925, 13, 60, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(927, 17, 60, 4, '2021-11-17 20:35:17', '2022-03-07 12:52:15'),
(928, 9, 60, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(929, 6, 60, 1, '2021-11-17 20:35:17', '2022-03-05 07:07:17'),
(930, 14, 60, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(934, 16, 61, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(935, 2, 61, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(936, 15, 61, 3, '2021-11-17 20:35:17', '2022-03-16 16:38:30'),
(937, 5, 61, 2, '2021-11-17 20:35:17', '2022-02-08 21:46:00'),
(938, 13, 61, 3, '2021-11-17 20:35:17', '2022-03-15 17:45:26'),
(940, 17, 61, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(941, 9, 61, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(942, 6, 61, 1, '2021-11-17 20:35:17', '2022-03-15 13:54:55'),
(943, 14, 61, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(947, 16, 62, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(948, 2, 62, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(949, 15, 62, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(950, 5, 62, 2, '2021-11-17 20:35:17', '2022-02-08 21:46:00'),
(951, 13, 62, 4, '2021-11-17 20:35:17', '2022-03-15 17:46:03'),
(953, 17, 62, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(954, 9, 62, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(955, 6, 62, 3, '2021-11-17 20:35:17', '2022-03-17 09:22:57'),
(956, 14, 62, 1, '2021-11-17 20:35:17', '2022-03-09 13:44:44'),
(960, 16, 63, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(961, 2, 63, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(962, 15, 63, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(963, 5, 63, 2, '2021-11-17 20:35:17', '2022-02-08 21:46:00'),
(964, 13, 63, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(966, 17, 63, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(967, 9, 63, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(968, 6, 63, 1, '2021-11-17 20:35:17', '2022-03-17 09:22:57'),
(969, 14, 63, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(973, 16, 64, 3, '2021-11-17 20:35:17', '2022-03-07 12:51:33'),
(974, 2, 64, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(975, 15, 64, 3, '2021-11-17 20:35:17', '2022-04-06 12:03:22'),
(976, 5, 64, 1, '2021-11-17 20:35:17', '2022-03-31 20:50:59'),
(977, 13, 64, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(979, 17, 64, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(980, 9, 64, 3, '2021-11-17 20:35:17', '2022-04-06 11:22:58'),
(981, 6, 64, 1, '2021-11-17 20:35:17', '2022-04-05 06:45:53'),
(982, 14, 64, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(986, 16, 65, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(987, 2, 65, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(988, 15, 65, 3, '2021-11-17 20:35:17', '2022-02-28 12:27:49'),
(989, 5, 65, 3, '2021-11-17 20:35:17', '2022-04-13 08:21:46'),
(990, 13, 65, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(992, 17, 65, 3, '2021-11-17 20:35:17', '2022-04-13 11:07:01'),
(993, 9, 65, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(994, 6, 65, 1, '2021-11-17 20:35:17', '2022-04-09 12:26:22'),
(995, 14, 65, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(999, 16, 66, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(1000, 2, 66, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(1001, 15, 66, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(1002, 5, 66, 3, '2021-11-17 20:35:17', '2022-04-20 12:10:55'),
(1003, 13, 66, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(1005, 17, 66, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(1006, 9, 66, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(1007, 6, 66, 3, '2021-11-17 20:35:17', '2022-04-20 16:22:18'),
(1008, 14, 66, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(1012, 16, 67, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(1013, 2, 67, 2, '2021-11-17 20:35:17', '2021-11-18 15:15:47'),
(1014, 15, 67, 1, '2021-11-17 20:35:17', '2021-11-17 22:40:26'),
(1015, 5, 67, 1, '2021-11-17 20:35:17', '2022-03-31 08:12:26'),
(1016, 13, 67, 1, '2021-11-17 20:35:17', '2022-01-18 14:48:58'),
(1018, 17, 67, 0, '2021-11-17 20:35:17', '2021-11-17 20:35:17'),
(1019, 9, 67, 2, '2021-11-17 20:35:17', '2021-11-23 14:56:35'),
(1020, 6, 67, 1, '2021-11-17 20:35:17', '2022-04-21 06:10:29'),
(1021, 14, 67, 1, '2021-11-17 20:35:17', '2022-01-10 09:08:52'),
(1124, 18, 22, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1125, 19, 22, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1126, 18, 23, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1127, 19, 23, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1128, 18, 24, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1129, 19, 24, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1130, 18, 25, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1131, 19, 25, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1132, 18, 26, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1133, 19, 26, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1134, 18, 27, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1135, 19, 27, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1136, 18, 28, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1137, 19, 28, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1138, 18, 29, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1139, 19, 29, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1140, 18, 30, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1141, 19, 30, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1142, 18, 31, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1143, 19, 31, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1144, 18, 32, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1145, 19, 32, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1146, 18, 33, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1147, 19, 33, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1148, 18, 34, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1149, 19, 34, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1150, 18, 35, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1151, 19, 35, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1152, 18, 53, 3, '2021-11-24 11:12:31', '2022-01-09 12:03:09'),
(1153, 19, 53, 1, '2021-11-24 11:12:31', '2021-11-30 09:14:27'),
(1154, 18, 54, 1, '2021-11-24 11:12:31', '2022-01-25 06:48:42'),
(1155, 19, 54, 3, '2021-11-24 11:12:31', '2022-01-26 08:27:06'),
(1156, 18, 55, 1, '2021-11-24 11:12:31', '2022-01-31 21:26:52'),
(1157, 19, 55, 1, '2021-11-24 11:12:31', '2022-01-29 08:05:31'),
(1158, 18, 56, 3, '2021-11-24 11:12:31', '2022-01-31 21:26:52'),
(1159, 19, 56, 1, '2021-11-24 11:12:31', '2022-01-29 08:05:31'),
(1160, 18, 57, 1, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1161, 19, 57, 1, '2021-11-24 11:12:31', '2022-02-16 16:10:34'),
(1162, 18, 58, 1, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1163, 19, 58, 1, '2021-11-24 11:12:31', '2022-02-09 15:57:07'),
(1164, 18, 59, 1, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1165, 19, 59, 1, '2021-11-24 11:12:31', '2022-02-09 15:57:07'),
(1166, 18, 60, 3, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1167, 19, 60, 3, '2021-11-24 11:12:31', '2022-02-09 15:57:07'),
(1168, 18, 61, 1, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1169, 19, 61, 3, '2021-11-24 11:12:31', '2022-02-09 15:57:07'),
(1170, 18, 62, 3, '2021-11-24 11:12:31', '2022-03-23 12:39:59'),
(1171, 19, 62, 1, '2021-11-24 11:12:31', '2022-03-01 15:11:53'),
(1172, 18, 63, 1, '2021-11-24 11:12:31', '2022-02-09 12:35:05'),
(1173, 19, 63, 3, '2021-11-24 11:12:31', '2022-03-30 06:59:39'),
(1174, 18, 64, 0, '2021-11-24 11:12:31', '2021-11-24 11:12:31'),
(1175, 19, 64, 1, '2021-11-24 11:12:31', '2022-03-01 15:11:53'),
(1176, 18, 65, 1, '2021-11-24 11:12:31', '2022-04-13 06:28:13'),
(1177, 19, 65, 1, '2021-11-24 11:12:31', '2022-03-01 15:11:53'),
(1178, 18, 66, 3, '2021-11-24 11:12:31', '2022-04-13 06:28:13'),
(1179, 19, 66, 1, '2021-11-24 11:12:31', '2022-04-20 19:57:44'),
(1180, 18, 67, 1, '2021-11-24 11:12:31', '2022-04-13 06:28:13'),
(1181, 19, 67, 1, '2021-11-24 11:12:31', '2022-04-20 19:57:44'),
(1182, 13, 22, 0, NULL, NULL),
(1183, 13, 23, 0, NULL, NULL),
(1184, 13, 24, 0, NULL, NULL),
(1185, 13, 25, 0, NULL, NULL),
(1186, 13, 26, 0, NULL, NULL),
(1187, 13, 27, 0, NULL, NULL),
(1188, 13, 28, 0, NULL, NULL),
(1189, 13, 29, 0, NULL, NULL),
(1190, 13, 30, 0, NULL, NULL),
(1191, 13, 31, 0, NULL, NULL),
(1197, 14, 22, 0, NULL, NULL),
(1198, 14, 23, 0, NULL, NULL),
(1199, 14, 24, 0, NULL, NULL),
(1200, 14, 25, 0, NULL, NULL),
(1201, 14, 26, 0, NULL, NULL),
(1202, 14, 27, 0, NULL, NULL),
(1203, 14, 28, 0, NULL, NULL),
(1204, 14, 29, 0, NULL, NULL),
(1205, 14, 30, 0, NULL, NULL),
(1206, 14, 31, 0, NULL, NULL),
(1212, 15, 22, 0, NULL, NULL),
(1213, 15, 23, 0, NULL, NULL),
(1214, 15, 24, 0, NULL, NULL),
(1215, 15, 25, 0, NULL, NULL),
(1216, 15, 26, 0, NULL, NULL),
(1217, 15, 27, 0, NULL, NULL),
(1218, 15, 28, 0, NULL, NULL),
(1219, 15, 29, 0, NULL, NULL),
(1220, 15, 30, 0, NULL, NULL),
(1221, 15, 31, 0, NULL, NULL),
(1227, 16, 22, 0, NULL, NULL),
(1228, 16, 23, 0, NULL, NULL),
(1229, 16, 24, 0, NULL, NULL),
(1230, 16, 25, 0, NULL, NULL),
(1231, 16, 26, 0, NULL, NULL),
(1232, 16, 27, 0, NULL, NULL),
(1233, 16, 28, 0, NULL, NULL),
(1234, 16, 29, 0, NULL, NULL),
(1235, 16, 30, 0, NULL, NULL),
(1236, 16, 31, 0, NULL, NULL),
(1237, 2, 68, 2, '2022-03-30 18:08:36', '2022-03-31 10:12:35'),
(1238, 5, 68, 1, '2022-03-30 18:08:36', '2022-03-31 08:12:26'),
(1239, 6, 68, 1, '2022-03-30 18:08:36', '2022-04-21 06:10:29'),
(1240, 9, 68, 3, '2022-03-30 18:08:36', '2022-03-30 18:09:39'),
(1241, 13, 68, 1, '2022-03-30 18:08:36', '2022-04-19 11:05:32'),
(1242, 14, 68, 0, '2022-03-30 18:08:36', '2022-03-30 18:08:36'),
(1243, 15, 68, 1, '2022-03-30 18:08:36', '2022-04-06 11:54:58'),
(1244, 16, 68, 0, '2022-03-30 18:08:36', '2022-03-30 18:08:36'),
(1245, 17, 68, 0, '2022-03-30 18:08:36', '2022-03-30 18:08:36'),
(1246, 18, 68, 1, '2022-03-30 18:08:36', '2022-04-13 06:28:13'),
(1247, 19, 68, 1, '2022-03-30 18:08:36', '2022-04-20 19:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table should contain a (unique) name for each schedule/course';

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `name`, `description`, `password`, `created_at`, `updated_at`) VALUES
(1, 'C3 Onsdagar', NULL, '$2y$10$Vyj.n/AhuMGixXQq1TrkAe1VGd2ISTRJWPBMM4U3QDvsyjtvXslyK', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule_date`
--

CREATE TABLE `schedule_date` (
  `id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `schedule_date` date NOT NULL,
  `start_time` time NOT NULL DEFAULT '19:00:00',
  `comment` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='This table contains all dates for all schedules, with start-time and comment';

--
-- Dumping data for table `schedule_date`
--

INSERT INTO `schedule_date` (`id`, `schedule_id`, `schedule_date`, `start_time`, `comment`, `created_at`, `updated_at`) VALUES
(22, 1, '2021-08-30', '19:00:00', NULL, '2021-06-18 18:33:51', '2021-06-18 18:33:51'),
(23, 1, '2021-09-06', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(24, 1, '2021-09-13', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(25, 1, '2021-09-20', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(26, 1, '2021-09-27', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(27, 1, '2021-10-04', '19:00:00', 'Efter Oktoberfestivalen', '2021-06-18 18:40:33', '2021-06-22 16:37:10'),
(28, 1, '2021-10-11', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(29, 1, '2021-10-18', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(30, 1, '2021-10-25', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(31, 1, '2021-11-01', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(32, 1, '2021-11-08', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(33, 1, '2021-11-15', '19:00:00', 'Efter Jesperdansen', '2021-06-18 18:40:33', '2021-06-22 16:37:10'),
(34, 1, '2021-11-22', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(35, 1, '2021-11-29', '19:00:00', NULL, '2021-06-18 18:40:33', '2021-06-18 18:40:33'),
(53, 1, '2022-01-12', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-12-07 14:41:26'),
(54, 1, '2022-01-26', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(55, 1, '2022-02-02', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(56, 1, '2022-02-09', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(57, 1, '2022-02-16', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(58, 1, '2022-02-23', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(59, 1, '2022-03-02', '19:00:00', 'Inställt', '2021-11-17 20:34:01', '2022-03-02 10:53:29'),
(60, 1, '2022-03-09', '19:00:00', NULL, '2021-11-17 20:34:01', '2022-03-05 07:08:01'),
(61, 1, '2022-03-16', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(62, 1, '2022-03-23', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(63, 1, '2022-03-30', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(64, 1, '2022-04-06', '19:00:00', 'Inställt', '2021-11-17 20:34:01', '2022-04-06 14:10:37'),
(65, 1, '2022-04-13', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(66, 1, '2022-04-20', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-11-17 20:34:01'),
(67, 1, '2022-04-27', '19:00:00', NULL, '2021-11-17 20:34:01', '2021-12-09 06:33:36'),
(68, 1, '2022-05-04', '19:00:00', NULL, '2022-03-30 18:08:36', '2022-03-30 18:08:36');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_member_schedule`
-- (See below for the actual view)
--
CREATE TABLE `v_member_schedule` (
`user_id` bigint unsigned
,`user_name` varchar(255)
,`email` varchar(255)
,`schedule_id` bigint unsigned
,`schedule_name` varchar(30)
,`schedule_description` text
,`password` varchar(255)
,`group_size` tinyint unsigned
,`admin` tinyint unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_member_schedule_date`
-- (See below for the actual view)
--
CREATE TABLE `v_member_schedule_date` (
`user_id` bigint unsigned
,`schedule_date_id` bigint unsigned
,`status` tinyint unsigned
,`user_name` varchar(255)
,`schedule_id` bigint unsigned
,`group_size` tinyint unsigned
,`schedule_date` date
);

-- --------------------------------------------------------

--
-- Structure for view `v_member_schedule`
--
DROP TABLE IF EXISTS `v_member_schedule`;

CREATE ALGORITHM=UNDEFINED DEFINER=`trygve`@`localhost` SQL SECURITY DEFINER VIEW `v_member_schedule`  AS SELECT `u`.`id` AS `user_id`, `u`.`name` AS `user_name`, `u`.`email` AS `email`, `t`.`id` AS `schedule_id`, `t`.`name` AS `schedule_name`, `t`.`description` AS `schedule_description`, `t`.`password` AS `password`, `mt`.`group_size` AS `group_size`, `mt`.`admin` AS `admin` FROM ((`member_schedule` `mt` left join `schedule` `t` on((`t`.`id` = `mt`.`schedule_id`))) left join `laravel`.`users` `u` on((`u`.`id` = `mt`.`user_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_member_schedule_date`
--
DROP TABLE IF EXISTS `v_member_schedule_date`;

CREATE ALGORITHM=UNDEFINED DEFINER=`trygve`@`localhost` SQL SECURITY DEFINER VIEW `v_member_schedule_date`  AS SELECT `msd`.`user_id` AS `user_id`, `msd`.`schedule_date_id` AS `schedule_date_id`, `msd`.`status` AS `status`, `vms`.`user_name` AS `user_name`, `vms`.`schedule_id` AS `schedule_id`, `vms`.`group_size` AS `group_size`, `sd`.`schedule_date` AS `schedule_date` FROM (((`member_schedule_date` `msd` left join `v_member_schedule` `vms` on((`vms`.`user_id` = `msd`.`user_id`))) left join `schedule_date` `sd` on((`sd`.`id` = `msd`.`schedule_date_id`))) left join `laravel`.`users` `u` on((`u`.`id` = `msd`.`user_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupsize`
--
ALTER TABLE `groupsize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `groupsize_FK_2` (`schedule_id`),
  ADD KEY `groupsize_user_id_schedule_id_index` (`user_id`,`schedule_id`);

--
-- Indexes for table `member_schedule`
--
ALTER TABLE `member_schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_schedule_FK_1` (`user_id`),
  ADD KEY `member_schedule_FK_2` (`schedule_id`);

--
-- Indexes for table `member_schedule_date`
--
ALTER TABLE `member_schedule_date`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_schedule_date_FK_1` (`user_id`),
  ADD KEY `member_schedule_date_FK_2` (`schedule_date_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_name_unique` (`name`);

--
-- Indexes for table `schedule_date`
--
ALTER TABLE `schedule_date`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_date_FK` (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupsize`
--
ALTER TABLE `groupsize`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member_schedule`
--
ALTER TABLE `member_schedule`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `member_schedule_date`
--
ALTER TABLE `member_schedule_date`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1248;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule_date`
--
ALTER TABLE `schedule_date`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupsize`
--
ALTER TABLE `groupsize`
  ADD CONSTRAINT `groupsize_FK_1` FOREIGN KEY (`user_id`) REFERENCES `laravel`.`users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupsize_FK_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_schedule`
--
ALTER TABLE `member_schedule`
  ADD CONSTRAINT `member_schedule_FK_1` FOREIGN KEY (`user_id`) REFERENCES `laravel`.`users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_schedule_FK_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_schedule_date`
--
ALTER TABLE `member_schedule_date`
  ADD CONSTRAINT `member_schedule_date_FK_1` FOREIGN KEY (`user_id`) REFERENCES `laravel`.`users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_schedule_date_FK_2` FOREIGN KEY (`schedule_date_id`) REFERENCES `schedule_date` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_date`
--
ALTER TABLE `schedule_date`
  ADD CONSTRAINT `schedule_date_FK` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
