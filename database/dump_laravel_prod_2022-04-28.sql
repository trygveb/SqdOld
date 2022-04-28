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
-- Database: `laravel`
--
CREATE DATABASE IF NOT EXISTS `laravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `laravel`;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_01_03_155331_create_schedule_table', 1),
(6, '2022_01_03_180829_create_schedule_date_table', 1),
(7, '2022_01_03_181850_create_member_schedule_table', 1),
(8, '2022_01_03_183519_create_member_schedule_date_table', 1),
(9, '2022_01_16_140535_create_groupsize_table', 2),
(10, '2022_01_16_175857_create_view_member_schedule', 2),
(11, '2022_01_16_182550_create_view_member_schedule_date', 2),
(12, '2022_01_27_082709_modify_view_member_schedule_date', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authority` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `authority`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'ArneBirgit', 0, 'arne.gusta@gmail.com', '2020-12-19 19:50:31', '$2y$10$998toc.IF/w6WGvqN/KdNugjdekUcmeJSCm/2YZjOpWcFlwqCOrvC', '6J9BvmbidRtG483XdwqgRbCiH8u0oHiRMT0uHgu60ndPFNlGti9DuCPfp9AQ', '2020-12-20 10:29:13', '2020-12-20 10:29:13'),
(5, 'Hodosis', 0, 'georg_hodosi@hotmail.com', '2020-12-19 19:50:31', '$2y$10$eW4IHm49u/Q/tcA/MS7IKuard6qooDkEb6K3eBH1whWJN0yeljzY.', 'PACM92ykbtTGsR1kxf8xIeArhn8NQHYX6c0C4kmUzXKMf0pHp71Yus1rtcMH', '2020-12-20 10:30:10', '2022-03-05 18:49:25'),
(6, 'Trygve', 1, 'trygve.botnen@gmail.com', '2020-12-19 19:50:31', '$2y$10$hnzvn6wPc0ho0fSqNoYkcuiiIi.FzPcTYo4pL74K88Q3srnqg0C7C', 'crZq0K5h9yAcZrg4RQBJL3OJpOD5gLdz5fX5ffOnOs0wR2lnH8GCqZ3IRLOL', '2020-12-20 10:30:10', '2021-02-15 08:11:01'),
(9, 'Hakanssons', 0, 'leif.annica@gmail.com', '2020-12-19 19:50:31', '$2y$10$HZH3bySG2flHoVi9yj9aUO4/.yJw1.HcI44M9YK5xrE3p3NkCsyQ2', 'ARWSTPiDKcVyfQWrkNGtCzuqEFTxI2YqgsTtXYRzs6dSXf9SmQ9jE6Iw73I3', '2020-12-20 10:30:10', '2021-08-11 06:27:13'),
(13, 'Goran', 0, 'goran_olsbro@hotmail.com', '2021-11-04 19:07:00', '$2y$10$MRptj0ZuewzEwVN7aEdHLu0OTa08AQCdi9bhHlc4za5wDT61yNb0O', 'kCiz0JCSIqGlcV8P5rvLWpEwi0OMlbQmTQ47WjjfdysFJZcTkgjkDGiDqQ1E', '2021-11-04 19:48:07', '2021-11-04 19:48:07'),
(14, 'Vigdis', 0, 'vigdis.tengelsen@gmail.com', '2021-11-04 19:07:00', '$2y$10$dAKGBWJriUShktAvphqCDe7qnAggHW7e0dLvoX0jwFwgjcxU.B2W2', 'EAJF0N16Z21C2cK6VipxNy7GAjRzdWmMELLIdXCf0fkBNFWhuMLep1jlz3H2', '2021-11-04 19:49:18', '2022-01-24 11:09:38'),
(15, 'Eva', 0, 'eva@vagnkilde.dk', '2021-11-04 19:07:00', '$2y$10$YDfIiuEokdDVFMfjzbqT7utlpt29v/OxRs5CyKoSGmLOSQsP0Pwn6', NULL, '2021-11-04 19:50:37', '2021-11-04 19:50:37'),
(16, 'Annika', 0, 'annika.myhrberg@telia.com', '2021-11-04 19:07:00', '$2y$10$F3.i3ZUFiJkDGN6H/h4MyuGDWfpyjvyctpNGmmB.c6rOrOHlRY1Ni', 'gEZzgEyvVMn4Ix3LtiffE41QY5Q7rxTytejerPOUnCwPm5iA7iwq7vCfgyS8', '2021-11-04 19:51:05', '2021-11-04 19:51:05'),
(17, 'Lasse', 0, 'lars.rawet@gmail.com', '2021-11-04 19:07:00', '$2y$10$wVU5Uz/aIXzDTNqruu3DzuWjP78RwwWsaHs1l3/amZy8b/lOWb7kC', 'hEyFCTrY15vmhP5N8XGzfO0nRCdLRbdfh0qjzceJzf5Gy8YCRaeOTJnu33y9', '2021-11-08 15:39:37', '2021-11-08 15:39:37'),
(18, 'Monika', 0, 'monica.taleryd46@gmail.com', '2021-11-24 19:07:00', '$2y$10$p0l.Z/0S59hzwHlc9ggkROB2SggFtNh4iAhJbiTmSc3n5q9ECN5aO', 'ec5l4ILul8qEzP0mSDEXj3SWkcYgvxUutBJZlxtPIBurgh8vk0wIlfoGC9Pb', '2021-11-24 09:22:06', '2021-11-24 10:00:51'),
(19, 'Inge', 0, 'inge.pettersson53@gmail.com', '2021-11-24 19:07:00', '$2y$10$dCxtXPP4uw5TpwQTF.qt/uO2w3LTvTcsMY5NjbHmb7DeUbunBUE7e', 'IKCC5uSuXvlD8rPRfn3sAUtAcQ8266YnilcycWycckMJZgSNo0lqpginf05S', '2021-11-24 09:23:01', '2021-12-11 14:21:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
