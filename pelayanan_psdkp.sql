-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2026 at 02:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelayanan_psdkp`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT Maju Bahari Abadi', '081234567890', 'contact@majubahari.com', 'Jl. Pelabuhan Perikanan No. 1, Jakarta Utara', '2026-09-07 19:55:01', '2026-09-07 19:55:01'),
(2, 'CV Nelayan Nusantara', '081295744707', 'info@nelayannusantara.co.id', 'Kawasan Pelabuhan Bitung, Sulawesi Utara', '2026-09-07 19:55:01', '2026-09-09 21:38:05'),
(3, 'anjay', NULL, 'anjay_6a9fafc618534@example.com', NULL, '2026-09-07 22:48:38', '2026-09-07 22:48:38'),
(4, 'Jeremy Mawuntu', '082316275525', 'jeremymawuntu8@gmail.com', NULL, '2026-09-08 18:20:29', '2026-09-08 18:47:27'),
(5, 'Labs Create', NULL, 'createlabs8@gmail.com', NULL, '2026-09-08 18:48:12', '2026-09-08 18:48:12'),
(6, 'secondaccbot02', NULL, 'secondaccbot02@gmail.com', NULL, '2026-09-08 18:57:37', '2026-09-08 18:57:37'),
(7, 'Henny Mamangkey', '082346795521', 'hennymamangkey_6aa0cfa598a0f@example.com', NULL, '2026-09-08 19:16:54', '2026-09-08 19:16:54'),
(8, 'pak rebo', '081527991981', 'pakrebo@test.com', NULL, '2026-09-08 20:50:43', '2026-09-08 20:50:43'),
(9, 'Pak teddy', '082310967599', 'pakteddy_6aa1f80795386@example.com', NULL, '2026-09-09 16:21:28', '2026-09-09 16:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_00_000000_create_companies_table', 1),
(2, '0001_01_01_000000_create_users_table', 1),
(3, '0001_01_02_000000_create_ships_table', 1),
(4, '0001_01_03_000000_create_service_requests_table', 1),
(5, '0001_01_04_000000_create_service_documents_table', 1),
(6, '2026_09_08_020734_create_cache_table', 1),
(7, '2026_09_08_023918_create_sessions_table', 1),
(8, '2026_09_08_055950_add_lensa_fields_to_service_requests_table', 2),
(9, '2026_09_09_004324_add_arrival_fields_to_service_requests_table', 3),
(10, '2026_09_09_023243_add_unique_code_to_service_requests_table', 4),
(11, '2026_09_09_033549_add_attendance_fields_to_service_requests_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `service_documents`
--

CREATE TABLE `service_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_request_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `nomor_surat` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) NOT NULL,
  `unique_code` varchar(255) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ship_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `analysis` text DEFAULT NULL,
  `indikasi` varchar(255) DEFAULT NULL,
  `indikasi_pelanggaran` varchar(255) DEFAULT NULL,
  `duga_langgar` varchar(255) DEFAULT NULL,
  `period_violation_start` date DEFAULT NULL,
  `period_violation_end` date DEFAULT NULL,
  `pelabuhan_keluar_terakhir` varchar(255) DEFAULT NULL,
  `mulai_melanggar` date DEFAULT NULL,
  `frekuensi_pelanggaran` int(11) DEFAULT NULL,
  `upt_terdekat` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'draft',
  `arrival_date` date DEFAULT NULL,
  `arrival_day` varchar(255) DEFAULT NULL,
  `arrival_time` varchar(255) DEFAULT NULL,
  `attendance_type` varchar(255) DEFAULT NULL,
  `attendance_notes` text DEFAULT NULL,
  `observation_date` date DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `company_response` text DEFAULT NULL,
  `officer_response` text DEFAULT NULL,
  `submitted_at` timestamp NULL DEFAULT NULL,
  `responded_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `analyst` varchar(255) DEFAULT NULL,
  `verificator` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `lembar_indikasi` varchar(255) DEFAULT NULL,
  `surat_analisis_nomor` varchar(255) DEFAULT NULL,
  `surat_analisis_dokumen` varchar(255) DEFAULT NULL,
  `skat_nomor` varchar(255) DEFAULT NULL,
  `masa_berlaku` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_requests`
--

INSERT INTO `service_requests` (`id`, `token`, `unique_code`, `company_id`, `ship_id`, `created_by`, `category`, `subject`, `description`, `analysis`, `indikasi`, `indikasi_pelanggaran`, `duga_langgar`, `period_violation_start`, `period_violation_end`, `pelabuhan_keluar_terakhir`, `mulai_melanggar`, `frekuensi_pelanggaran`, `upt_terdekat`, `status`, `arrival_date`, `arrival_day`, `arrival_time`, `attendance_type`, `attendance_notes`, `observation_date`, `latitude`, `longitude`, `company_response`, `officer_response`, `submitted_at`, `responded_at`, `created_at`, `updated_at`, `analyst`, `verificator`, `unit_kerja`, `lembar_indikasi`, `surat_analisis_nomor`, `surat_analisis_dokumen`, `skat_nomor`, `masa_berlaku`) VALUES
(1, 'Oz3FDrzFyuOWhgKiJ78b8RMDOfVxB0fOu1f31WeW', NULL, 3, NULL, 1, 'Pelayanan', 'Layanan Pelayanan - 08092026-0648', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-07 22:48:38', '2026-09-07 22:48:38', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '8WW9xfwOdrDZdihzIVEozrNDOhTLjlSFVoaWCU4a', NULL, 2, 4, 1, 'Pelayanan', 'Layanan Pelayanan - 09092026-0030', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 16:30:49', '2026-09-08 16:30:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'zYfrxgXMuSlt6QwL7fYIBT5h5p9rqetWdvZ3JNCX', '1234', 5, 5, 1, 'Pelayanan', 'Layanan Pelayanan - 09092026-0247', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 18:47:27', '2026-09-08 18:48:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'kB0aiVZJ0EDRkJHh6KHtwOv5Repx5OdtQ9qoRHQ7', '1207', 7, 6, 1, 'Pelayanan', 'Layanan Pelayanan - 09092026-0316', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'submitted', '2026-09-09', 'Rabu', '09:00', 'diwakilkan', 'Capt kapal', NULL, NULL, NULL, 'njay', NULL, NULL, '2026-09-08 19:43:42', '2026-09-08 19:16:54', '2026-09-08 19:43:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'fe51aa69-7c87-4f80-9fc8-f2b4e5b912fb', '692929', 8, NULL, 1, 'Pelayanan', 'Layanan Pelayanan - Test Pak Rebo', NULL, NULL, 'Indikasi Pelanggaran Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 20:50:43', '2026-09-08 20:50:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'a2eaa889-71c9-4695-9a7b-238d17d24d40', '882372', 8, 7, 1, 'Pelayanan', 'Pemberitahuan Pelanggaran Administrasi Kapal', 'Terdapat indikasi pelanggaran wilayah tangkap berdasarkan pantauan VMS.', 'Berdasarkan hasil analisis tracking VMS, kapal terdeteksi keluar dari WPP-NRI 711.', 'Keluar Jalur Penangkapan', 'Melanggar pasal 27 UU Perikanan', 'Penangkapan ikan di luar jalur yang diizinkan pada SIPI', '2026-09-04', '2026-09-07', 'Pelabuhan Nizam Zachman', '2026-09-05', 3, 'PSDKP Jakarta', 'submitted', '2026-09-24', 'Kamis', '11:00', 'sendiri', NULL, '2026-09-08', NULL, NULL, NULL, NULL, NULL, '2026-09-09 16:28:52', '2026-09-08 20:57:36', '2026-09-09 16:28:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '8qOfp4jq4waG0BwnwpT33IktlNWJI2C85rSokxOJ', '855808', 9, 8, 1, 'Pelayanan', 'Layanan Pelayanan - 10092026-0021', NULL, 'ljjsndflfldbg', 'lkejlksdjf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'submitted', '2026-10-20', 'Selasa', '09:00', 'nahkoda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-09 19:55:20', '2026-09-09 16:21:28', '2026-09-09 19:55:20', 'sdfs', 'sdf', 'dsf', 'fjfj', NULL, NULL, NULL, NULL),
(8, 'WcgmSZlZ8H9YVegE79r9uXpATCoDKyYYLqbtctCQ', '847587', 2, 9, 1, 'Pelayanan', 'Layanan Pelayanan - 10092026-0538', NULL, NULL, 'lkejlksdjf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'draft', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-09 21:38:05', '2026-09-09 21:38:05', 'sdfs', 'sdf', 'dsf', 'fjfj', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CJ23FIrg6n5i8iKNq1hE9pkr8aoqlF8OCrSgw09g', NULL, '2001:448a:7080:485b:4043:81b1:5aeb:6916', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM25saXlDQ291Z2xsSFlqQWhNMmxITURueDZteEswTFk2RG1McE5ETCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL3RpYXJhLXVuc2VhdGVkLWJvYmJpbmcubmdyb2stZnJlZS5kZXYvcGVsYXlhbmFuL2Zvcm0vOHFPZnA0anE0d2FHMEJ3bndwVDMzSWt0bE5XSkkyQzg1clNva3hPSiI7czo1OiJyb3V0ZSI7czoxMToicHVibGljLmZvcm0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789012521),
('FVDi67Foh5a1Bt0z8w0pG5oIyKQrXAeqaK7jOfGS', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVjc0NFF3YUUyTG1KQVF1RDNTNDVMZzZid1o2aDhqaHpTSGJxNGVkcCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1789028860),
('GiM02HNsSlR3ii9I8wTm9xaGM4Gl0MnrSJUWmXHv', 1, '2001:448a:7080:485b:a156:a643:24dd:e098', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieURTVmRxNTZyZjNBczNOSUVRb05CZTN0M1FEOFNRS0dQdWgyWHRucSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjY1OiJodHRwczovL3RpYXJhLXVuc2VhdGVkLWJvYmJpbmcubmdyb2stZnJlZS5kZXYvamFkd2FsP2ZpbHRlcj10b2RheSI7czo1OiJyb3V0ZSI7czoxMjoiamFkd2FsLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1789019405),
('quXsdMAm2eweEXKQgiImSMTpbtQfNbb3b3rHMpQR', NULL, '114.125.173.131', 'Mozilla/5.0 (Android 11; Mobile; rv:155.0) Gecko/155.0 Firefox/155.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTGVhTmx4Wk16Rm9iYVp0bDBzVlVuWHFSMlI5cjVLRDViMVNielJQZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL3RpYXJhLXVuc2VhdGVkLWJvYmJpbmcubmdyb2stZnJlZS5kZXYvcGVsYXlhbmFuL2Zvcm0vV2NnbVNabFo4SDlZVmVnRTc5cjl1WHBBVENvREt5WVlMcWJ0Y3RDUSI7czo1OiJyb3V0ZSI7czoxMToicHVibGljLmZvcm0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789019275),
('yX0AyWmGqipLbsnWNnft2sDrrj9kmjeDXNlvVSwQ', NULL, '103.52.212.50', 'node', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjNBUFBpanlNUW9HQWNLdmpudlA1ZzhZZGxpa3o0SXRCN1ROaDQxZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vdGlhcmEtdW5zZWF0ZWQtYm9iYmluZy5uZ3Jvay1mcmVlLmRldi9rbGFpbSI7czo1OiJyb3V0ZSI7czoxMToia2xhaW0uaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789018689),
('zEBpyJ7Id1E8eM5vxHhMoJQIPA2wscWduxBJC7Zc', NULL, '2001:448a:7080:485b:7840:ea72:7170:26b5', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.6.1 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUnQ2M2VmeUpvcUFMY1RqUzA3akdhNTVYTXFZSTFTYm1oR0gybDZ6bSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAxOiJodHRwczovL3RpYXJhLXVuc2VhdGVkLWJvYmJpbmcubmdyb2stZnJlZS5kZXYvcGVsYXlhbmFuL2Zvcm0vV2NnbVNabFo4SDlZVmVnRTc5cjl1WHBBVENvREt5WVlMcWJ0Y3RDUSI7czo1OiJyb3V0ZSI7czoxMToicHVibGljLmZvcm0iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1789018740),
('zIGRBIbPkcoetJN4NTeqDFrYl4S0sIjaI91SxpKR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidmJFWnVtd1FqTXBxYWZOeXlYVzdqWk5abFczUm1pZGVVaU5QQUJaWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jb21wYW5pZXMiO3M6NToicm91dGUiO3M6MTU6ImNvbXBhbmllcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1789085082);

-- --------------------------------------------------------

--
-- Table structure for table `ships`
--

CREATE TABLE `ships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `transmitter_no` varchar(255) DEFAULT NULL,
  `book_no` varchar(255) DEFAULT NULL,
  `fishing_gear` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `sipi_no` varchar(255) DEFAULT NULL,
  `sipi_start` date DEFAULT NULL,
  `sipi_end` date DEFAULT NULL,
  `dpi` varchar(255) DEFAULT NULL,
  `home_port` varchar(255) DEFAULT NULL,
  `pelabuhan_keluar_terakhir` varchar(255) DEFAULT NULL,
  `slo_issuer` varchar(255) DEFAULT NULL,
  `license_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ships`
--

INSERT INTO `ships` (`id`, `company_id`, `name`, `transmitter_no`, `book_no`, `fishing_gear`, `size`, `sipi_no`, `sipi_start`, `sipi_end`, `dpi`, `home_port`, `pelabuhan_keluar_terakhir`, `slo_issuer`, `license_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'KM Bintang Samudera 01', 'TRX-998811', NULL, 'Purse Seine', NULL, 'SIP/992/DKP/2026', NULL, NULL, NULL, 'Muara Baru', NULL, NULL, NULL, '2026-09-07 19:55:02', '2026-09-07 19:55:02'),
(2, 1, 'KM Bintang Samudera 02', 'TRX-998812', NULL, 'Purse Seine', NULL, 'SIP/993/DKP/2026', NULL, NULL, NULL, 'Muara Baru', NULL, NULL, NULL, '2026-09-07 19:55:02', '2026-09-07 19:55:02'),
(3, 2, 'KM Nusantara Jaya', 'TRX-776655', NULL, 'Longline', NULL, 'SIP/881/DKP/2026', NULL, NULL, NULL, 'Bitung', NULL, NULL, NULL, '2026-09-07 19:55:02', '2026-09-07 19:55:02'),
(4, 2, 'KM Bintang Samudera 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 16:30:49', '2026-09-08 16:30:49'),
(5, 4, 'KM Nusantara Jaya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 18:47:27', '2026-09-08 18:47:27'),
(6, 7, 'KM Bintang Samudera 02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 19:16:54', '2026-09-08 19:16:54'),
(7, 8, 'KM Nelayan Maju', NULL, NULL, 'Purse Seine', '30 GT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-08 20:55:19', '2026-09-08 20:55:19'),
(8, 9, 'KM FIRDAUS', '089899', '8348734', 'Pukat', '50', '324435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-09 16:21:28', '2026-09-09 16:21:28'),
(9, 2, 'KM FIRDAUS', '089899', '8348734', 'Pukat', '50', '324435', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-09-09 21:38:05', '2026-09-09 21:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','petugas','company') NOT NULL DEFAULT 'company',
  `google_id` varchar(255) DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `google_id`, `company_id`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@psdkp.go.id', '$2y$12$yhgA9NrfSGk0XeRb9aVUmO48bzocc6/fZim/GioDu47qybxidhLTO', 'admin', NULL, NULL, NULL, NULL, '2026-09-07 19:55:01', '2026-09-10 00:26:17'),
(2, 'Petugas PSDKP', 'petugas@psdkp.go.id', '$2y$12$3bEhpWunRnu5rKs.1E3Ik.mfN46MIqWQNMvSDs6nTdHDYSp5mb1tu', 'petugas', NULL, NULL, NULL, NULL, '2026-09-07 19:55:01', '2026-09-07 19:55:01'),
(3, 'Budi Santoso', 'company@example.com', '$2y$12$JHYLibp8l7fVvVGotuCAfubRtfJboLvgQDp8WKQ34JubmV9mIpCrW', 'company', NULL, 1, NULL, NULL, '2026-09-07 19:55:02', '2026-09-07 19:55:02'),
(4, 'Jeremy Mawuntu', 'jeremymawuntu8@gmail.com', '$2y$12$olay9LL9hwL2eVrC07L.PuBejXXfi25j9ZHzBs3qcuITp69tRU9VO', 'company', '107349712180268599141', 4, NULL, 'dWFwEDmDY2nraI16FOkazyMrgqA26yumnEr8g7tYwW9qaRA9CHgvTOIvi1zJ', '2026-09-08 18:20:29', '2026-09-08 18:20:29'),
(5, 'Labs Create', 'createlabs8@gmail.com', '$2y$12$HhWfLv.wVdehx92zM8D/c.Hxo/sX1ec.RxNdajtWFy24p0M5YukPO', 'company', '115365903950616399658', 5, NULL, 'IusksFBoY6MS6xGjjXofjwgyZheNkN3uMM59Jcm79UQJf6QJVKrZbsLYsavM', '2026-09-08 18:48:12', '2026-09-08 18:48:12'),
(6, 'secondaccbot02', 'secondaccbot02@gmail.com', '$2y$12$zHc3pBCbHNUFRYblsYbeS.yIoKXIA2sWP/BQKHNZlCvUcLhd//8ei', 'company', '106049344924875752837', 6, NULL, 'W1ZmFhk0sWWCIGw97hLGdX6HV1gGSWBeg9GzcPd7Dw10sQnogUvamD4J0Xpb', '2026-09-08 18:57:38', '2026-09-08 18:57:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_documents`
--
ALTER TABLE `service_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_documents_service_request_id_foreign` (`service_request_id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_requests_token_unique` (`token`),
  ADD KEY `service_requests_company_id_foreign` (`company_id`),
  ADD KEY `service_requests_ship_id_foreign` (`ship_id`),
  ADD KEY `service_requests_created_by_foreign` (`created_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `ships`
--
ALTER TABLE `ships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ships_company_id_foreign` (`company_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_documents`
--
ALTER TABLE `service_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ships`
--
ALTER TABLE `ships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `service_documents`
--
ALTER TABLE `service_documents`
  ADD CONSTRAINT `service_documents_service_request_id_foreign` FOREIGN KEY (`service_request_id`) REFERENCES `service_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD CONSTRAINT `service_requests_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `service_requests_ship_id_foreign` FOREIGN KEY (`ship_id`) REFERENCES `ships` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ships`
--
ALTER TABLE `ships`
  ADD CONSTRAINT `ships_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
