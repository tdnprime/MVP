-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 30, 2022 at 01:07 PM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `htdocs`
--
CREATE DATABASE IF NOT EXISTS `htdocs` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `htdocs`;

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE `boxes` (
  `vid` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pre_order` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `box_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_cost` int(11) NOT NULL DEFAULT '0',
  `ship_from` int(11) NOT NULL DEFAULT '1',
  `curation` int(11) DEFAULT NULL,
  `num_products` int(11) DEFAULT NULL,
  `box_supply` int(11) DEFAULT NULL,
  `in_stock` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `box_weight` int(11) DEFAULT NULL,
  `box_length` int(11) DEFAULT NULL,
  `box_width` int(11) DEFAULT NULL,
  `box_height` int(11) DEFAULT NULL,
  `prodname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proddesc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_area_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_area_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_count` int(11) DEFAULT NULL,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`vid`, `user_id`, `pre_order`, `special_offer`, `price`, `box_url`, `shipping_cost`, `ship_from`, `curation`, `num_products`, `box_supply`, `in_stock`, `box_weight`, `box_length`, `box_width`, `box_height`, `prodname`, `proddesc`, `product_id`, `address_line_1`, `address_line_2`, `admin_area_1`, `admin_area_2`, `country_code`, `postal_code`, `video`, `shipping_count`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 1, 40, 'fta', 0, 1, 0, 5, 56, '54', 4, 8, 8, 4, 'ACCESSORIES', 'Interesting finds from my travels in Africa', 'PROD-9DG49004CJ3422502', '589 Chester Street', '1R', 'NY', 'Brooklyn', 'US', '11212', 'R8RVywN_Gms', NULL, 1643053102, 1643053102);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_info` text COLLATE utf8mb4_unicode_ci,
  `reviewed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invited_by` int(11) DEFAULT NULL,
  `box_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE `invites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_usages` int(11) DEFAULT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uses` int(11) NOT NULL DEFAULT '0',
  `expires_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2014_10_28_175635_create_threads_table', 1),
(5, '2014_10_28_175710_create_messages_table', 1),
(6, '2014_10_28_180224_create_participants_table', 1),
(7, '2014_11_03_154831_add_soft_deletes_to_participants_table', 1),
(8, '2014_12_04_124531_add_softdeletes_to_threads_table', 1),
(9, '2017_03_30_152742_add_soft_deletes_to_messages_table', 1),
(10, '2018_01_01_000000_create_feedbacks_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2020_01_29_162459_create_invites_table', 1),
(14, '2021_11_17_094334_create_sessions_table', 1),
(15, '2021_11_17_101543_add_google_id_column', 1),
(16, '2021_11_29_154631_create_boxes_table', 1),
(17, '2021_12_18_184649_create_subscriptions_table', 1),
(18, '2022_01_22_182002_create_invitations_table', 1),
(19, '2022_01_23_163406_create_partners_table', 1),
(20, '2022_01_24_171200_add_deleted_at_to_users_table', 1),
(21, '2017_06_16_140051_create_nikolag_customers_table', 2),
(22, '2017_06_16_140942_create_nikolag_customer_user_table', 2),
(23, '2017_06_16_140943_create_nikolag_transactions_table', 2),
(24, '2018_02_07_140944_create_nikolag_taxes_table', 2),
(25, '2018_02_07_140945_create_nikolag_discounts_table', 2),
(26, '2018_02_07_140946_create_nikolag_deductible_table', 2),
(27, '2018_02_07_140947_create_nikolag_products_table', 2),
(28, '2018_02_07_140948_create_nikolag_orders_table', 2),
(29, '2018_02_07_140949_create_nikolag_product_order_table', 2),
(30, '2021_01_04_140949_add_scope_nikolag_deductible_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_customers`
--

CREATE TABLE `nikolag_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_service_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nikolag_customers`
--

INSERT INTO `nikolag_customers` (`id`, `payment_service_id`, `payment_service_type`, `first_name`, `last_name`, `company_name`, `nickname`, `email`, `phone`, `note`, `created_at`, `updated_at`) VALUES
(1, NULL, 'square', 'Trevor', 'Prime', 'TrevorPrime', 'Trevor', 'trevorprimenyc@gmail.com', '', '', '2022-01-28 01:12:31', '2022-01-28 01:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_customer_user`
--

CREATE TABLE `nikolag_customer_user` (
  `owner_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_deductibles`
--

CREATE TABLE `nikolag_deductibles` (
  `deductible_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deductible_id` bigint(20) UNSIGNED NOT NULL,
  `featurable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `featurable_id` bigint(20) UNSIGNED NOT NULL,
  `scope` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_discounts`
--

CREATE TABLE `nikolag_discounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` double(8,2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `reference_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_orders`
--

CREATE TABLE `nikolag_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_service_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_products`
--

CREATE TABLE `nikolag_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variation_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_product_order`
--

CREATE TABLE `nikolag_product_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_taxes`
--

CREATE TABLE `nikolag_taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` double(8,2) NOT NULL,
  `reference_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nikolag_transactions`
--

CREATE TABLE `nikolag_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_service_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_service_type` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nikolag_transactions`
--

INSERT INTO `nikolag_transactions` (`id`, `status`, `amount`, `currency`, `customer_id`, `payment_service_id`, `payment_service_type`, `merchant_id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 'FAILED', '500', 'USD', NULL, NULL, 'square', NULL, NULL, '2022-01-28 01:41:29', '2022-01-28 01:41:30'),
(2, 'FAILED', '500', 'USD', NULL, NULL, 'square', NULL, NULL, '2022-01-28 02:20:05', '2022-01-28 02:20:05'),
(3, 'FAILED', '500', 'USD', NULL, NULL, 'square', NULL, NULL, '2022-01-28 05:42:15', '2022-01-28 05:42:15'),
(4, 'FAILED', '500', 'USD', NULL, NULL, 'square', NULL, NULL, '2022-01-28 05:45:44', '2022-01-28 05:45:44'),
(5, 'FAILED', '500', 'USD', NULL, NULL, 'square', NULL, NULL, '2022-01-28 12:13:05', '2022-01-28 12:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lSxmhaWPR6v7bVC4zVx3hhRHG6XpljQIWNTqt2sN', 1, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiWEU1Sll1WXJZVzdzZ3dRaHZzcnFtOFRHZEwxY0FvOXZyT3AxNVdodSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hY2NvdW50L2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM4OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvaW52aXRhdGlvbnMvaG9tZSI7fXM6NToic3RhdGUiO3M6NDA6IlAwYUVEWU9CUFRPd0w5OEZVWDFOYVRkaW9kU0NmOTV1cXFDZ0tra1YiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6MjI4OiJleUpwZGlJNklta3JWSGRZWTNJclVuSkthRVZhYUhNMWFHOXBOVUU5UFNJc0luWmhiSFZsSWpvaUwzVkNaRTV3UjJsQlJWbFliamhtZDJSMmRWaEtTbGRzZVZvelZEUnFNa1ZOYVVkVk9VRlpaVlZqUlQwaUxDSnRZV01pT2lKaU5HTTFNVFEzTmpZelpXRXdNbVZpT0dZM01UUTRZall4TTJGbFltRTBNMlJpWkRCak1EZGpabVkxT1RFNU1qYzVOMlppTXpBMll6VTVOR1V3WkRFeUlpd2lkR0ZuSWpvaUluMD0iO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czoyMjg6ImV5SnBkaUk2SW1rclZIZFlZM0lyVW5KS2FFVmFhSE0xYUc5cE5VRTlQU0lzSW5aaGJIVmxJam9pTDNWQ1pFNXdSMmxCUlZsWWJqaG1kMlIyZFZoS1NsZHNlVm96VkRScU1rVk5hVWRWT1VGWlpWVmpSVDBpTENKdFlXTWlPaUppTkdNMU1UUTNOall6WldFd01tVmlPR1kzTVRRNFlqWXhNMkZsWW1FME0yUmlaREJqTURkalptWTFPVEU1TWpjNU4yWmlNekEyWXpVNU5HVXdaREV5SWl3aWRHRm5Jam9pSW4wPSI7fQ==', 1643461056),
('m6leQTtH5N1WjSXIIGrbjkBIlTUBMdu6klwaMs4m', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMGhGRVFnZnc3eXM1UkQ3a3YzZ2ZIOXZMdzB0OHJCa2o4WXJXa0hXRCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FjY291bnQvaG9tZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc2Nob29sL2hvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1643503455),
('UZ1ViqgOV6HhWOh24hEXZqN0xdqjtKw1xUlsUv3o', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGpjZDVuemd2Y0Rhd2U1VkxDNjgyUXJWRmloc29FUmlQMzQ3T2c0SSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1643400045);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `creator_id` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpf` int(11) DEFAULT NULL,
  `sub_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `frequency` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `tracking` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_area_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_area_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_shipping` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrier` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`creator_id`, `user_id`, `fullname`, `cpf`, `sub_id`, `version`, `price`, `frequency`, `status`, `tracking`, `address_line_1`, `address_line_2`, `admin_area_1`, `admin_area_2`, `postal_code`, `country_code`, `rate_id`, `rate`, `shipment`, `plan_id`, `order_id`, `last_shipping`, `label`, `carrier`, `created_at`, `updated_at`) VALUES
(1, 1, 'USA User', 0, 'I-URKCWXWPVSKN', 1, 40, 1, 1, NULL, '6100 Willis St', '', 'Texas', 'Groves', '77619', 'US', '7e0413f2be0c43a989e994427cac6eba', '10.96', 'd0aa932a68f14bffa352de6e4d7df1d5', 'P-6D979019WY454983NMHXQBDY', '4S760946BG117422S', NULL, NULL, 'USPS', '2022-01-24 19:39:59', '2022-01-24 19:39:59'),
(1, 2, 'USA User', 0, 'I-2BMADERDHC65', 1, 40, 1, 1, NULL, '6100 Willis St', '', 'Texas', 'Groves', '77619', 'US', '3476d47525394eeba98b53f83c2c4939', '10.96', 'e5449e0c966c4488803a2cc581befd36', 'P-81X74762M1855005PMHZLQAQ', '2GB486597V802544M', NULL, NULL, 'USPS', '2022-01-27 15:19:31', '2022-01-27 15:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `given_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `family_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `given_name`, `family_name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `google_id`, `deleted_at`) VALUES
(1, 'Trevor', 'Prime', 'trevorprimenyc@gmail.com', NULL, 'eyJpdiI6ImkrVHdYY3IrUnJKaEVaaHM1aG9pNUE9PSIsInZhbHVlIjoiL3VCZE5wR2lBRVlYbjhmd2R2dVhKSldseVozVDRqMkVNaUdVOUFZZVVjRT0iLCJtYWMiOiJiNGM1MTQ3NjYzZWEwMmViOGY3MTQ4YjYxM2FlYmE0M2RiZDBjMDdjZmY1OTE5Mjc5N2ZiMzA2YzU5NGUwZDEyIiwidGFnIjoiIn0=', NULL, NULL, 'M8SBhfY25Jj26G1kxZ0sROWV1qyeXnLS6kd6PBQSxoujpNqhiOOC4Lwrg0st', NULL, 'https://lh3.googleusercontent.com/a-/AOh14GjiHfRNj3AgVT2Ov4KgU-9zqzwV6pYt689jKH5_vg=s96-c', '2022-01-24 22:37:41', '2022-01-24 22:37:41', '101804489611422594327', NULL),
(2, 'Trevor', 'Prime', 'gingluevents@gmail.com', NULL, 'eyJpdiI6InVVdzZSalo3U083ODAzbzVYanpZYVE9PSIsInZhbHVlIjoiNGNrK2JxaHZjRWFhb1hYQWdPQmdsSWxoVDRZRXJycHMwTkVtZlMwU050ST0iLCJtYWMiOiI5OGJlMGU5NWUxZTg1MmQ3OWU4M2M2ZTkwMDcyOTBiZDcyMmIwYmM4ODQ0NjZiYWJjYmUzNWI4NTVmYzgxNDhiIiwidGFnIjoiIn0=', NULL, NULL, 'JxxHIlpS1qFro2utbmNktrqoKWRtyXTeIQ03f1in1vK1CfA5MdOGLOpAhsVi', NULL, 'https://lh3.googleusercontent.com/a/AATXAJw1SYIpMxYPEfVuQnueMDpN-oFdEj2kxucmFcmYrA=s96-c', '2022-01-27 17:25:58', '2022-01-27 17:25:58', '117026846790477479997', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boxes`
--
ALTER TABLE `boxes`
  ADD PRIMARY KEY (`vid`),
  ADD UNIQUE KEY `boxes_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `boxes_box_url_unique` (`box_url`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedbacks_type_index` (`type`);

--
-- Indexes for table `invites`
--
ALTER TABLE `invites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invites_code_unique` (`code`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nikolag_customers`
--
ALTER TABLE `nikolag_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nikolag_customers_email_unique` (`email`),
  ADD UNIQUE KEY `pstype_psid` (`payment_service_type`,`payment_service_id`),
  ADD KEY `nikolag_customers_email_index` (`email`);

--
-- Indexes for table `nikolag_customer_user`
--
ALTER TABLE `nikolag_customer_user`
  ADD UNIQUE KEY `oid_cid` (`owner_id`,`customer_id`);

--
-- Indexes for table `nikolag_deductibles`
--
ALTER TABLE `nikolag_deductibles`
  ADD KEY `nikolag_deductibles_index` (`deductible_type`,`deductible_id`),
  ADD KEY `nikolag_featurables_index` (`featurable_type`,`featurable_id`);

--
-- Indexes for table `nikolag_discounts`
--
ALTER TABLE `nikolag_discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nikolag_discounts_name_index` (`name`);

--
-- Indexes for table `nikolag_orders`
--
ALTER TABLE `nikolag_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nikolag_products`
--
ALTER TABLE `nikolag_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vname_name` (`name`,`variation_name`),
  ADD KEY `nikolag_products_name_index` (`name`),
  ADD KEY `nikolag_products_reference_id_index` (`reference_id`);

--
-- Indexes for table `nikolag_product_order`
--
ALTER TABLE `nikolag_product_order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `prodid_ordid` (`product_id`,`order_id`);

--
-- Indexes for table `nikolag_taxes`
--
ALTER TABLE `nikolag_taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_type` (`name`,`type`),
  ADD KEY `nikolag_taxes_name_index` (`name`),
  ADD KEY `nikolag_taxes_type_index` (`type`);

--
-- Indexes for table `nikolag_transactions`
--
ALTER TABLE `nikolag_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nikolag_transactions_status_index` (`status`),
  ADD KEY `nikolag_transactions_payment_service_type_index` (`payment_service_type`),
  ADD KEY `cus_id` (`customer_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `boxes`
--
ALTER TABLE `boxes`
  MODIFY `vid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invites`
--
ALTER TABLE `invites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `nikolag_customers`
--
ALTER TABLE `nikolag_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nikolag_discounts`
--
ALTER TABLE `nikolag_discounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nikolag_orders`
--
ALTER TABLE `nikolag_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nikolag_products`
--
ALTER TABLE `nikolag_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nikolag_product_order`
--
ALTER TABLE `nikolag_product_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nikolag_taxes`
--
ALTER TABLE `nikolag_taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nikolag_transactions`
--
ALTER TABLE `nikolag_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boxes`
--
ALTER TABLE `boxes`
  ADD CONSTRAINT `boxes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nikolag_product_order`
--
ALTER TABLE `nikolag_product_order`
  ADD CONSTRAINT `prod_id` FOREIGN KEY (`product_id`) REFERENCES `nikolag_products` (`id`);

--
-- Constraints for table `nikolag_transactions`
--
ALTER TABLE `nikolag_transactions`
  ADD CONSTRAINT `cus_id` FOREIGN KEY (`customer_id`) REFERENCES `nikolag_customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
