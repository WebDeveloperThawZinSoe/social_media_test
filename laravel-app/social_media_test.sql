-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 23, 2025 at 01:38 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `parent_id`, `comment`, `created_at`, `updated_at`) VALUES
(2, 5, 12, NULL, 'very good to go', '2025-09-23 05:09:01', '2025-09-23 05:09:01'),
(3, 1, 12, NULL, 'Nice To Mee You All', '2025-09-23 05:09:32', '2025-09-23 05:09:32'),
(5, 2, 11, NULL, 'tst', '2025-09-23 05:17:34', '2025-09-23 05:17:34'),
(6, 6, 10, NULL, 'Hi', '2025-09-23 05:27:08', '2025-09-23 05:27:08');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_23_060747_add_two_factor_columns_to_users_table', 1),
(5, '2025_09_23_060839_create_personal_access_tokens_table', 1),
(6, '2025_09_23_061144_create_permission_tables', 2),
(7, '2025_09_23_064140_create_posts_table', 3),
(8, '2025_09_23_064424_create_reacts_table', 3),
(9, '2025_09_23_064548_create_comments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2025-09-22 23:43:16', '2025-09-22 23:43:16'),
(2, 'view reports', 'web', '2025-09-22 23:43:16', '2025-09-22 23:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 8, 'api_token', '72e3c04cbc1fac9101ea910f71179f815da9dc83f10a2358a409b0be8a5a4022', '[\"*\"]', NULL, NULL, '2025-09-23 05:46:31', '2025-09-23 05:46:31'),
(2, 'App\\Models\\User', 8, 'api_token', '45bca9a2408c43bc6ee87afe8465340dd5892276948f40c694929f46fb135e03', '[\"*\"]', NULL, NULL, '2025-09-23 05:49:32', '2025-09-23 05:49:32'),
(4, 'App\\Models\\User', 8, 'api_token', 'a23b245fb8fe3bba845a287e8f294ff0060a6cd74780c76706c6cf3eb91365ac', '[\"*\"]', NULL, NULL, '2025-09-23 05:55:56', '2025-09-23 05:55:56'),
(5, 'App\\Models\\User', 9, 'api_token', '0b5cc2ef2407849bae63fadf85ebbedb2b7199f89af6d45ecefe648c0a4aa389', '[\"*\"]', NULL, NULL, '2025-09-23 05:56:25', '2025-09-23 05:56:25'),
(6, 'App\\Models\\User', 10, 'api_token', 'f372c9564ec7c0680535445132b6b0eb7828ec0d37f8618309db6a6221b6ed73', '[\"*\"]', NULL, NULL, '2025-09-23 06:02:13', '2025-09-23 06:02:13'),
(9, 'App\\Models\\User', 11, 'api_token', '21ccb9eb63810edcaf84be15aa4960840d3b1e306829d153260b1ceb0abf0e4d', '[\"*\"]', NULL, NULL, '2025-09-23 06:18:33', '2025-09-23 06:18:33'),
(11, 'App\\Models\\User', 11, 'api_token', 'caedf7c5c062ae9a8a9a05e026f4dfced188d9e198acadba25941b7bba4aa90e', '[\"*\"]', '2025-09-23 06:33:56', NULL, '2025-09-23 06:20:39', '2025-09-23 06:33:56'),
(12, 'App\\Models\\User', 1, 'api_token', 'c5181da6e6a6c2955e0dd1404ab319c89e29f4e0ecac6730c41d88029e8097c3', '[\"*\"]', '2025-09-23 06:46:50', NULL, '2025-09-23 06:22:38', '2025-09-23 06:46:50'),
(13, 'App\\Models\\User', 1, 'api_token', '1fa5a2d0c91de76be350ecc80c36c59062dc29ac22afc6d9813e809b7c6d2685', '[\"*\"]', '2025-09-23 06:51:19', NULL, '2025-09-23 06:45:57', '2025-09-23 06:51:19');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `media_type` enum('image','video') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `text`, `media_type`, `media_url`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'Hi , New World', NULL, NULL, 1, '2025-09-23 01:59:54', '2025-09-23 01:59:54'),
(6, 5, 'My Current Mode', 'image', '/storage/posts/UWONcsNRGd2wuqpBJnIM0I8Mj08AKLKCSPNDT37f.jpg', 1, '2025-09-23 02:09:47', '2025-09-23 02:09:47'),
(7, 5, 'test', 'video', '/storage/posts/sbU8eShUcO6DZgYyVzFGkBBN52ujAmve6QP2OMGr.mp4', 1, '2025-09-23 02:11:53', '2025-09-23 02:11:53'),
(8, 5, 'Perpare for war', 'image', '/storage/posts/aozkT02YEgTbqheOVHDKVVhpNs0GABr0xK5HHAey.jpg', 1, '2025-09-23 02:14:11', '2025-09-23 02:14:11'),
(9, 1, 'Hi I am demo user', NULL, NULL, 1, '2025-09-23 02:54:20', '2025-09-23 02:54:20'),
(10, 4, 'nice to mee you all', NULL, NULL, 1, '2025-09-23 02:54:47', '2025-09-23 02:54:47'),
(11, 2, 'Remix神曲 RAP版 合唱Mang Chung《芒种》中国新说唱—中国最火的老外_嘿人李逵 Vs 音阙诗听—趙方婧 Remix by- ANDY LOW', 'video', '/storage/posts/GqxhytVj7C4MpK88NVUlR5g48PJQWTUjQhrd9tLt.mp4', 1, '2025-09-23 03:04:50', '2025-09-23 03:04:50'),
(12, 5, 'Welcome , From Golden Land', 'image', '/storage/posts/nhaluzm86fay8yV4W8NLcZ3rrJQnCXAVr0hstdfq.jpg', 1, '2025-09-23 04:15:03', '2025-09-23 04:15:03'),
(15, 7, 'I am ton cat', 'image', '/storage/posts/xzKVIAS30N5Gm2xO8OaNgRlLY0f97oG65CNYPow1.jpg', 1, '2025-09-23 05:41:14', '2025-09-23 05:41:14'),
(16, 1, 'Hi Test', NULL, NULL, 1, '2025-09-23 06:42:45', '2025-09-23 06:42:45'),
(17, 1, 'Create From The API', 'image', '/storage/posts/kS7OYPdOhCUvLQMnaJJQwjPCZw3yuekJBKAnBt0Y.png', 1, '2025-09-23 06:43:46', '2025-09-23 06:43:46'),
(19, 1, 'Create From The API ( Delete THis )', 'image', '/storage/posts/nWUNXSHRyFyKTtZ2nCUBv7xYiML01gFVwy4Y59Fv.png', 1, '2025-09-23 06:46:50', '2025-09-23 06:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `reacts`
--

CREATE TABLE `reacts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `reaction_type` enum('like','love','haha','wow','sad','angry') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'love',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reacts`
--

INSERT INTO `reacts` (`id`, `user_id`, `post_id`, `reaction_type`, `created_at`, `updated_at`) VALUES
(3, 2, 10, 'love', '2025-09-23 03:18:12', '2025-09-23 03:18:12'),
(6, 2, 8, 'love', '2025-09-23 03:19:07', '2025-09-23 03:19:07'),
(8, 5, 11, 'love', '2025-09-23 03:31:17', '2025-09-23 03:31:17'),
(9, 5, 10, 'love', '2025-09-23 03:31:18', '2025-09-23 03:31:18'),
(10, 5, 9, 'love', '2025-09-23 03:31:21', '2025-09-23 03:31:21'),
(11, 5, 8, 'love', '2025-09-23 03:31:24', '2025-09-23 03:31:24'),
(13, 5, 7, 'love', '2025-09-23 03:31:27', '2025-09-23 03:31:27'),
(14, 5, 6, 'love', '2025-09-23 03:31:28', '2025-09-23 03:31:28'),
(15, 5, 1, 'love', '2025-09-23 03:31:29', '2025-09-23 03:31:29'),
(25, 1, 19, 'love', '2025-09-23 06:49:59', '2025-09-23 06:49:59'),
(27, 7, 19, 'love', '2025-09-23 06:50:21', '2025-09-23 06:50:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-09-22 23:43:16', '2025-09-22 23:43:16'),
(2, 'user', 'web', '2025-09-22 23:43:16', '2025-09-22 23:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PzUghxiH8SPqKU5A7DQpDvUwdji9vzGShLGmeoup', NULL, '127.0.0.1', 'PostmanRuntime/7.47.1', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTEpPdHlHTDFBZG5ScG9UZGpJeGZScGdJeDlnUkpWTmlhU21RWldDYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovL2xvY2FsaG9zdDo4MDAwIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1758633348),
('QDAH3HfszwJeDRCXABN6cL7W70ZqOpAXJShXRS9f', 7, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic2F1QTh6SjBGaFYxcEhBejFGaW5HZmk3R1hFdkRtYkZKUmc0N3FySyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9wcm9maWxlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1758634704);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_url` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `user_url`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'demo@example.com', NULL, '$2y$12$RGIUnzXUzItwEkdkykm.xOOANs1zYY0xAVJX1Te1MAy6xIFeom2Na', NULL, NULL, NULL, NULL, NULL, 'https://laser360clinic.com/wp-content/uploads/2020/08/user-image.jpg', 'demouser', '2025-09-23 00:25:58', '2025-09-23 00:25:58'),
(2, 'thaw', 'thawzinsoe.dev@outlook.com', NULL, '$2y$12$klcFJnRUVTsXBu9jNaNLnuKxqVWaz9cFvQEmip.Kb9mwJNzdC1UGe', NULL, NULL, NULL, NULL, NULL, 'https://static.vecteezy.com/system/resources/previews/052/350/290/non_2x/cartoon-lucky-cat-with-a-raised-paw-holding-a-dollar-coin-featuring-a-red-collar-and-sakura-flower-details-japanese-and-chinese-style-for-fortune-prosperity-good-luck-and-wealth-symbol-vector.jpg', 'thawzinsoe', '2025-09-23 00:25:58', '2025-09-23 00:25:58'),
(4, 'thawzinsoe', 'thawzinsoe.dev@gmail.com', NULL, '$2y$12$Of62UYYof8EDKhbez6NLe.R1mqdl3gXUGf0bJP03FyEVXCpXJdvpu', NULL, NULL, NULL, NULL, NULL, NULL, 'thawzinsoe-Pf9t9fubjQ', '2025-09-23 01:05:38', '2025-09-23 01:05:38'),
(5, 'thawzinsoe.business', 'thawzinsoe.business.mm@gmail.com', NULL, '$2y$12$RGIUnzXUzItwEkdkykm.xOOANs1zYY0xAVJX1Te1MAy6xIFeom2Na', NULL, NULL, NULL, NULL, NULL, NULL, 'thawzinsoebusiness-ZjpxArN7q1', '2025-09-23 01:30:17', '2025-09-23 01:30:17'),
(6, 'BeBe', 'bebe@gmail.com', NULL, '$2y$12$8CeO/CqkzQ2M0h3Kct6Ll.7dZRC/03zrUpCdq6eO342nmUDaESGXK', NULL, NULL, NULL, NULL, NULL, 'https://img.freepik.com/free-vector/cute-bee-flying-cartoon-vector-icon-illustration-animal-nature-icon-concept-isolated-premium-vector_138676-6016.jpg', 'bebe-ua8DecbNPf', '2025-09-23 05:19:39', '2025-09-23 05:19:39'),
(7, 'ToM', 'tomthaw@gmail.com', NULL, '$2y$12$3.NwaqXRtgr8xfLlSlZm4eL7iPET2znO8tDOVOqmvIpbllzMqq4qa', NULL, NULL, NULL, NULL, NULL, 'https://cdn.hanna-barberawiki.com/thumb/8/85/Tom_Cat.png/800px-Tom_Cat.png', 'tom-zdWzEn7mSU', '2025-09-23 05:40:41', '2025-09-23 05:40:41'),
(8, 'zee', 'zee@gmail.com', NULL, '$2y$12$gOYZR8pElB36pjqfnSLzHevSjeLoqB78bZ/hkzWDPDyhSZu9n9z9G', NULL, NULL, NULL, NULL, NULL, NULL, 'zee-pjFj5dJ01u', '2025-09-23 05:46:31', '2025-09-23 05:46:31'),
(9, 'zee2', 'zee2@gmail.com', NULL, '$2y$12$CSPVP8gFAnC.j9tOTArQCuc9cUQlJfBY7GQnIriqa069CRPYahIGy', NULL, NULL, NULL, NULL, NULL, NULL, 'zee2-6R6WJM6Jy4', '2025-09-23 05:56:25', '2025-09-23 05:56:25'),
(10, 'zee3', 'zee3@gmail.com', NULL, '$2y$12$4VnG8jIFrA59.kRD16HjAetT6GmxCj7efnqiHUhK5ZRS.FfI6flve', NULL, NULL, NULL, NULL, NULL, NULL, 'zee3-IFopE8D8bE', '2025-09-23 06:02:13', '2025-09-23 06:02:13'),
(11, 'abc', 'a@gmail.com', NULL, '$2y$12$P2aSQCuEkSbNTvqtgrC83em484Nua5VN587xl9kUl.redM66xfkX6', NULL, NULL, NULL, NULL, NULL, NULL, 'abc-VPaFQ8XQyV', '2025-09-23 06:18:33', '2025-09-23 06:18:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `reacts`
--
ALTER TABLE `reacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reacts_user_id_post_id_unique` (`user_id`,`post_id`),
  ADD KEY `reacts_post_id_foreign` (`post_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reacts`
--
ALTER TABLE `reacts`
  ADD CONSTRAINT `reacts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
