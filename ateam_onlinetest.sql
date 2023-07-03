-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2023 at 07:07 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ateam_onlinetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `eventname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `org_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventname`, `start_date`, `end_date`, `venue`, `status`, `created_at`, `updated_at`, `deleted_at`, `org_id`) VALUES
(6, 'Event 1', '2023-07-06', '2023-07-07', 'Place 1', 'active', '2023-07-01 04:53:19', '2023-07-01 04:53:19', NULL, 1),
(7, 'Event 2', '2023-07-08', '2023-07-08', 'Place 2', 'active', '2023-07-01 04:53:44', '2023-07-01 04:53:44', NULL, 1),
(8, 'Event 3', '2023-07-15', '2023-07-18', 'Place 1', 'active', '2023-07-01 04:54:15', '2023-07-01 04:54:15', NULL, 1),
(9, 'Event Test', '2023-07-27', '2023-07-29', 'Delhi', 'active', '2023-07-02 07:21:25', '2023-07-02 07:21:25', NULL, 2),
(10, 'New Event', '2023-07-24', '2023-07-25', 'wert yuik', 'active', '2023-07-02 10:45:15', '2023-07-02 10:45:15', NULL, 3),
(11, 'coming Event', '2023-07-26', '2023-07-29', 'vfrt asde', 'active', '2023-07-02 10:45:44', '2023-07-02 10:45:44', NULL, 3),
(12, 'Farewell', '2023-07-13', '2023-07-13', 'Marriot', 'active', '2023-07-02 22:19:22', '2023-07-02 22:19:22', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `event_invites`
--

CREATE TABLE `event_invites` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED DEFAULT NULL,
  `org_id` bigint UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('invite','reject') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_invites`
--

INSERT INTO `event_invites` (`id`, `event_id`, `org_id`, `email`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, 'sandra@gmail.com', 'reject', '2023-07-02 05:16:48', '2023-07-02 08:58:51', NULL),
(2, 7, 1, 'nick@gmail.com', 'invite', '2023-07-02 09:07:52', '2023-07-02 09:07:52', NULL),
(3, 12, 2, 'sandy@gmail.com', 'invite', '2023-07-02 22:21:58', '2023-07-02 22:21:58', NULL),
(4, 12, 2, 'gaya@demo.com', 'reject', '2023-07-02 22:57:52', '2023-07-02 22:58:42', NULL);

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
(5, '2023_06_30_171617_create_events_table', 1),
(6, '2023_06_30_172351_add_org_id_to_events_table', 1),
(7, '2023_06_30_172617_create_event_invites_table', 1);

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
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `email_verified_at`, `password`, `gender`, `date_of_birth`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Athira', 'Surendran', 'athira1193@gmail.com', NULL, '$2y$10$T8SbJRCFrskoHEuBnm7IW.TshxjwDDZTTzGcBfsTwHdE9/.CA2xZG', 'female', '2003-12-30', NULL, '2023-06-30 14:46:47', '2023-06-30 14:46:47', NULL),
(2, 'John', 'Doe', 'john@gmail.com', NULL, '$2y$10$UilD6fkAQxuM1GlgQLoRf.b7S68OdYzL53f5FvGISYT.oEKfDv0rW', 'male', '1995-07-12', NULL, '2023-07-02 07:20:35', '2023-07-02 07:20:35', NULL),
(3, 'Alin', 'Tom', 'alin@demo.com', NULL, '$2y$10$W0e1eZYiYa8yytU7bt.JDufwwc2kZbktVPLr0L6Vk0ZgSmYzhWJUO', 'male', '1993-07-05', NULL, '2023-07-02 10:36:41', '2023-07-02 10:36:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_org_id_foreign` (`org_id`);

--
-- Indexes for table `event_invites`
--
ALTER TABLE `event_invites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_invites_event_id_foreign` (`event_id`),
  ADD KEY `event_invites_org_id_foreign` (`org_id`);

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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event_invites`
--
ALTER TABLE `event_invites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `event_invites`
--
ALTER TABLE `event_invites`
  ADD CONSTRAINT `event_invites_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_invites_org_id_foreign` FOREIGN KEY (`org_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
