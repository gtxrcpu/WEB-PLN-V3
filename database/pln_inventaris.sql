-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2025 at 07:15 AM
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
-- Database: `pln_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `apabs`
--

CREATE TABLE `apabs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `isi_apab` varchar(255) DEFAULT NULL,
  `capacity` varchar(255) DEFAULT NULL,
  `masa_berlaku` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apabs`
--

INSERT INTO `apabs` (`id`, `user_id`, `name`, `serial_no`, `barcode`, `location_code`, `isi_apab`, `capacity`, `masa_berlaku`, `status`, `qr_svg_path`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'APAB A3.001', 'A3.001', 'APAB A3.001', NULL, NULL, NULL, NULL, 'baik', 'storage/qr/apab-1.svg', NULL, '2025-11-19 10:51:00', '2025-11-19 10:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `apars`
--

CREATE TABLE `apars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(120) NOT NULL,
  `barcode` varchar(64) NOT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `serial_no` varchar(64) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `capacity` varchar(32) DEFAULT NULL,
  `agent` varchar(32) DEFAULT NULL,
  `location_code` varchar(80) DEFAULT NULL,
  `last_inspection_at` timestamp NULL DEFAULT NULL,
  `next_inspection_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apars`
--

INSERT INTO `apars` (`id`, `user_id`, `name`, `barcode`, `qr_svg_path`, `serial_no`, `type`, `capacity`, `agent`, `location_code`, `last_inspection_at`, `next_inspection_at`, `status`, `photo_path`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'APAR A1.001', 'APAR A1.001', 'storage/qr/apar-1.svg', 'A1.001', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'baik', NULL, NULL, '2025-11-18 08:13:56', '2025-11-18 08:13:56', NULL),
(2, 1, 'APAR A1.002', 'APAR A1.002', 'storage/qr/apar-2.svg', 'A1.002', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'rusak', NULL, NULL, '2025-11-19 07:07:56', '2025-11-19 07:07:56', NULL),
(3, 1, 'APAR A1.003', 'APAR A1.003', 'storage/qr/apar-3.svg', 'A1.003', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'ISI ULANG', NULL, NULL, '2025-11-19 07:13:14', '2025-11-19 07:13:14', NULL),
(4, 1, 'APAR A1.004', 'APAR A1.004', 'storage/qr/apar-4.svg', 'A1.004', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'ISI ULANG', NULL, NULL, '2025-11-19 07:26:55', '2025-11-19 07:26:55', NULL),
(5, 1, 'APAR A1.005', 'APAR A1.005', 'storage/qr/apar-5.svg', 'A1.005', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'ISI ULANG', NULL, NULL, '2025-11-19 10:50:21', '2025-11-19 10:50:21', NULL),
(6, 1, 'APAR A1.006', 'APAR A1.006', 'storage/qr/apar-6.svg', 'A1.006', 'UUV', '5 Liter', '500', 'BDG', NULL, NULL, 'BAIK', NULL, NULL, '2025-11-19 21:43:33', '2025-11-19 21:43:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `apats`
--

CREATE TABLE `apats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `kapasitas` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'baik',
  `notes` text DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apats`
--

INSERT INTO `apats` (`id`, `user_id`, `name`, `barcode`, `serial_no`, `lokasi`, `jenis`, `kapasitas`, `status`, `notes`, `qr_svg_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'APAT A2.001', 'APAT A2.001', 'A2.001', NULL, NULL, NULL, 'baik', NULL, 'storage/qr/apat-1.svg', '2025-11-19 10:50:39', '2025-11-19 10:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `box_hydrants`
--

CREATE TABLE `box_hydrants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `box_hydrants`
--

INSERT INTO `box_hydrants` (`id`, `user_id`, `name`, `barcode`, `serial_no`, `location_code`, `type`, `status`, `notes`, `qr_svg_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Box Hydrant H6.001', 'H6.001', 'H6.001', NULL, NULL, 'BAIK', NULL, 'storage/qr/box-hydrant-1.svg', '2025-11-19 10:51:21', '2025-11-19 10:51:21');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fire_alarms`
--

CREATE TABLE `fire_alarms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(160) NOT NULL,
  `barcode` varchar(64) DEFAULT NULL,
  `location` varchar(120) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_apabs`
--

CREATE TABLE `kartu_apabs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apab_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pressure_gauge` varchar(255) NOT NULL,
  `pin_segel` varchar(255) NOT NULL,
  `selang` varchar(255) NOT NULL,
  `klem_selang` varchar(255) NOT NULL,
  `handle` varchar(255) NOT NULL,
  `kondisi_fisik` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_apars`
--

CREATE TABLE `kartu_apars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apar_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pressure_gauge` varchar(255) NOT NULL,
  `pin_segel` varchar(255) NOT NULL,
  `selang` varchar(255) NOT NULL,
  `tabung` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `kondisi_fisik` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_apars`
--

INSERT INTO `kartu_apars` (`id`, `apar_id`, `user_id`, `pressure_gauge`, `pin_segel`, `selang`, `tabung`, `label`, `kondisi_fisik`, `kesimpulan`, `tgl_periksa`, `petugas`, `created_at`, `updated_at`, `signature_id`, `approved_by`, `approved_at`) VALUES
(1, 1, 1, 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', '2025-11-19', 'ben', '2025-11-19 06:43:07', '2025-11-19 06:43:25', 1, 2, '2025-11-19 06:43:25'),
(2, 1, 1, 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', '2025-11-19', 'ben', '2025-11-19 06:50:51', '2025-11-19 06:51:00', 1, 2, '2025-11-19 06:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_apats`
--

CREATE TABLE `kartu_apats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apat_id` bigint(20) UNSIGNED NOT NULL,
  `kondisi_fisik` varchar(255) NOT NULL,
  `drum` varchar(255) NOT NULL,
  `aduk_pasir` varchar(255) NOT NULL,
  `sekop` varchar(255) NOT NULL,
  `fire_blanket` varchar(255) NOT NULL,
  `ember` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `tgl_surat` date DEFAULT NULL,
  `petugas` varchar(255) DEFAULT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_apats`
--

INSERT INTO `kartu_apats` (`id`, `apat_id`, `kondisi_fisik`, `drum`, `aduk_pasir`, `sekop`, `fire_blanket`, `ember`, `kesimpulan`, `tgl_periksa`, `tgl_surat`, `petugas`, `pengawas`, `created_at`, `updated_at`, `signature_id`, `approved_by`, `approved_at`) VALUES
(1, 1, 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', 'baik', '2025-11-20', NULL, 'BEN', 'BON', '2025-11-19 21:28:19', '2025-11-19 21:28:19', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kartu_box_hydrants`
--

CREATE TABLE `kartu_box_hydrants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `box_hydrant_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pilar_hydrant` varchar(255) NOT NULL,
  `box_hydrant` varchar(255) NOT NULL,
  `nozzle` varchar(255) NOT NULL,
  `selang` varchar(255) NOT NULL,
  `uji_fungsi` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_fire_alarms`
--

CREATE TABLE `kartu_fire_alarms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fire_alarm_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `panel_kontrol` varchar(255) NOT NULL,
  `detector` varchar(255) NOT NULL,
  `manual_call_point` varchar(255) NOT NULL,
  `alarm_bell` varchar(255) NOT NULL,
  `battery_backup` varchar(255) NOT NULL,
  `uji_fungsi` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_kendalis`
--

CREATE TABLE `kartu_kendalis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `apar_id` bigint(20) UNSIGNED NOT NULL,
  `pg` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `selang` varchar(255) DEFAULT NULL,
  `klem` varchar(255) DEFAULT NULL,
  `handle` varchar(255) DEFAULT NULL,
  `fisik` varchar(255) DEFAULT NULL,
  `kesimpulan` varchar(255) DEFAULT NULL,
  `tgl_periksa` date DEFAULT NULL,
  `tgl_surat` date DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_p3ks`
--

CREATE TABLE `kartu_p3ks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `p3k_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kotak_p3k` varchar(255) NOT NULL,
  `plester` varchar(255) NOT NULL,
  `perban` varchar(255) NOT NULL,
  `kasa_steril` varchar(255) NOT NULL,
  `antiseptik` varchar(255) NOT NULL,
  `gunting` varchar(255) NOT NULL,
  `sarung_tangan` varchar(255) NOT NULL,
  `masker` varchar(255) NOT NULL,
  `obat_luka` varchar(255) NOT NULL,
  `buku_panduan` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_rumah_pompas`
--

CREATE TABLE `kartu_rumah_pompas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rumah_pompa_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pompa_utama` varchar(255) NOT NULL,
  `pompa_cadangan` varchar(255) NOT NULL,
  `jockey_pump` varchar(255) NOT NULL,
  `panel_kontrol` varchar(255) NOT NULL,
  `uji_fungsi` varchar(255) NOT NULL,
  `kesimpulan` varchar(255) NOT NULL,
  `tgl_periksa` date NOT NULL,
  `petugas` varchar(255) NOT NULL,
  `pengawas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `signature_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kartu_settings`
--

CREATE TABLE `kartu_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `label` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_settings`
--

INSERT INTO `kartu_settings` (`id`, `key`, `value`, `type`, `label`, `description`, `created_at`, `updated_at`) VALUES
(1, 'no_dokumen', 'FR.04-PT.20.K3L', 'text', 'No. Dokumen', 'Nomor dokumen kartu kendali', '2025-11-19 21:24:35', '2025-11-19 21:24:35'),
(2, 'revisi', '05', 'text', 'Revisi', 'Nomor revisi dokumen', '2025-11-19 21:24:35', '2025-11-19 21:24:35'),
(3, 'tanggal_berlaku', '24 Januari 2025', 'text', 'Tanggal Berlaku', 'Tanggal mulai berlaku dokumen', '2025-11-19 21:24:35', '2025-11-19 21:24:35'),
(4, 'halaman', '1 dari 1 halaman', 'text', 'Halaman', 'Informasi halaman', '2025-11-19 21:24:35', '2025-11-19 21:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `kartu_templates`
--

CREATE TABLE `kartu_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `header_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`header_fields`)),
  `inspection_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`inspection_fields`)),
  `footer_fields` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`footer_fields`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kartu_templates`
--

INSERT INTO `kartu_templates` (`id`, `module`, `title`, `subtitle`, `header_fields`, `inspection_fields`, `footer_fields`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'apar', 'KARTU KENDALI', 'ALAT PEMADAM API RINGAN (APAR)', '[{\"label\":\"No. Dokumen\",\"value\":\"FR.04-PT.20.K3L\"},{\"label\":\"Revisi\",\"value\":\"05\"},{\"label\":\"Tanggal\",\"value\":\"24 Januari 2025\"},{\"label\":\"Halaman\",\"value\":\"1 dari 1 halaman\"}]', '[{\"label\":\"Kondisi Tabung\",\"type\":\"checkbox\"},{\"label\":\"Kondisi Selang\",\"type\":\"checkbox\"},{\"label\":\"Kondisi Pin Pengaman\",\"type\":\"checkbox\"},{\"label\":\"Tekanan\",\"type\":\"text\"},{\"label\":\"Berat\",\"type\":\"text\"},{\"label\":\"Catatan\",\"type\":\"textarea\"}]', '[{\"label\":\"Lokasi\",\"value\":\"Bandung\"},{\"label\":\"Label Petugas\",\"value\":\"Petugas Pemeriksa\"},{\"label\":\"Label Pimpinan\",\"value\":\"Mengetahui\"}]', 1, '2025-11-19 21:32:58', '2025-11-19 21:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `building` varchar(255) DEFAULT NULL,
  `floor` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_10_163240_create_permission_tables', 1),
(5, '2025_11_11_124150_create_items_table', 1),
(6, '2025_11_12_142303_create_apars_table', 1),
(7, '2025_11_12_160616_add_qr_svg_path_to_apars_table', 1),
(8, '2025_11_12_162805_fix_all_serial_no_and_add_unique_index', 1),
(9, '2025_11_15_084828_create_kartu_kendalis_table', 1),
(10, '2025_11_15_092327_create_apats_table', 1),
(11, '2025_11_15_094623_add_detail_columns_to_apats_table', 1),
(12, '2025_11_15_095420_create_kartu_apats_table', 1),
(13, '2025_11_15_171818_create_fire_alarms_table', 1),
(14, '2025_11_16_061958_create_box_hydrants_table', 1),
(15, '2025_11_16_072110_create_rumah_pompas_table', 1),
(16, '2025_11_16_125453_create_apabs_table', 1),
(17, '2025_11_16_160507_create_kartu_apabs_table', 1),
(18, '2025_11_16_161118_create_kartu_box_hydrants_table', 1),
(19, '2025_11_16_161118_create_kartu_fire_alarms_table', 1),
(20, '2025_11_16_161119_create_kartu_rumah_pompas_table', 1),
(21, '2025_11_16_173419_create_categories_table', 1),
(22, '2025_11_16_173449_create_locations_table', 1),
(23, '2025_11_16_173512_create_petugas_table', 1),
(24, '2025_11_17_025955_create_kartu_apars_table', 1),
(25, '2025_11_17_035711_make_tgl_surat_nullable_in_kartu_apats_table', 1),
(26, '2025_11_18_124040_create_p3ks_table', 1),
(27, '2025_11_18_124257_create_kartu_p3ks_table', 1),
(28, '2025_11_18_140959_add_username_to_users_table', 2),
(29, '2025_11_18_151928_create_signatures_table', 3),
(30, '2025_11_18_153433_add_signature_id_to_kartu_tables', 4),
(31, '2025_11_19_071025_add_approval_columns_to_kartu_tables', 5),
(32, '2025_11_19_141201_update_status_column_length_in_apars_table', 6),
(33, '2025_11_19_175851_add_avatar_to_users_table', 7),
(34, '2025_11_20_042344_create_kartu_settings_table', 8),
(35, '2025_11_20_043031_add_location_to_kartu_settings', 9),
(36, '2025_11_20_043207_create_kartu_templates_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Table structure for table `p3ks`
--

CREATE TABLE `p3ks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(255) NOT NULL,
  `serial_no` varchar(255) NOT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'lengkap',
  `notes` text DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p3ks`
--

INSERT INTO `p3ks` (`id`, `user_id`, `name`, `barcode`, `serial_no`, `location_code`, `type`, `status`, `notes`, `qr_svg_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'P3K P3K.001', 'P3K P3K.001', 'P3K.001', NULL, NULL, 'lengkap', NULL, 'storage/qr/p3k-1.svg', '2025-11-18 06:19:25', '2025-11-18 06:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(2, 'manage roles', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(3, 'view dashboard', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(4, 'manage equipment', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(5, 'manage inspections', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(6, 'manage reports', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(7, 'manage references', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34'),
(2, 'user', 'web', '2025-11-18 07:09:34', '2025-11-18 07:09:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rumah_pompas`
--

CREATE TABLE `rumah_pompas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Rumah Pompa 1',
  `serial_no` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `location_code` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `zone` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `qr_svg_path` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rumah_pompas`
--

INSERT INTO `rumah_pompas` (`id`, `user_id`, `name`, `serial_no`, `barcode`, `location_code`, `type`, `zone`, `status`, `qr_svg_path`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Rumah Pompa RP.001', 'RP.001', 'RUMAH POMPA RP.001', NULL, NULL, NULL, 'baik', 'storage/qr/rumah-pompa-1.svg', NULL, '2025-11-19 10:53:35', '2025-11-19 10:53:35');

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
('Qa2M7KmmY3CUk6h0n2l2HGSjNNiqcIacd7gP6xVR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUWgxUGF4QTZMM2Z5d2NLdGk4MmtEYjRKYW9Gbm5wMVo1dW5RWURqTSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAva2FydHUvY3JlYXRlP2FwYXJfaWQ9MiI7czo1OiJyb3V0ZSI7czoxMjoia2FydHUuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1763614522),
('rki5OXkDtzQs7PtE7kTpWNUq0A7QZYINIWk3GdK1', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZDRMOU5rU0ttN1BQdlYyRE9hTExhRmw4d01GUm1CR3gwYzBSZE1iNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGFyLzEva2FydHUvMiI7czo1OiJyb3V0ZSI7czoxNToiYXBhci52aWV3LWthcnR1Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1763614380);

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `signature_path` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `name`, `position`, `nip`, `signature_path`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'me', 'kepala divisi', NULL, 'signatures/signature_1763536119_691d6cf7419b3.png', 1, '2025-11-19 00:08:39', '2025-11-19 00:08:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'bentar', '', 'bentar@gmail.com', 'avatars/vrrdCfuEqceKAA7xW1EulQNFQGDCd0oUmE1BekaN.jpg', NULL, '$2y$12$3M20UNswtEEANkbrCBLw9.noahbW8Dz7KkVwBYpdkFHbXilweo82G', NULL, '2025-11-18 06:19:19', '2025-11-19 11:04:58'),
(2, 'Administrator', 'admin', 'admin@pln.co.id', NULL, NULL, '$2y$12$xAmzHD9gM1OL07PF2elNXOydAfaelUlSPyd4WoeBMblnvyEy0gSxu', NULL, '2025-11-18 07:10:56', '2025-11-18 07:10:56'),
(3, 'User PLN', 'user', 'user@pln.co.id', NULL, NULL, '$2y$12$.NmPcD0x5LGEDSkJ5uk6R.h0KTb9/qrfC8uCkstcl1ThVuHc6D5ae', NULL, '2025-11-18 07:10:57', '2025-11-18 07:10:57'),
(4, 'test', 'test@gmail.com', 'testuser@gmail.com', NULL, NULL, '$2y$12$TBe4h8V1gsbNEaN5kNAAEumwfNkhOnMgTV87hHAF4LnCeTgDGz0Ji', NULL, '2025-11-19 10:35:21', '2025-11-19 10:35:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apabs`
--
ALTER TABLE `apabs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apabs_serial_no_unique` (`serial_no`),
  ADD UNIQUE KEY `apabs_barcode_unique` (`barcode`),
  ADD KEY `apabs_user_id_foreign` (`user_id`);

--
-- Indexes for table `apars`
--
ALTER TABLE `apars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apars_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `apars_serial_no_unique` (`serial_no`),
  ADD KEY `apars_user_id_status_index` (`user_id`,`status`),
  ADD KEY `apars_location_code_index` (`location_code`);

--
-- Indexes for table `apats`
--
ALTER TABLE `apats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `apats_barcode_unique` (`barcode`),
  ADD KEY `apats_user_id_foreign` (`user_id`);

--
-- Indexes for table `box_hydrants`
--
ALTER TABLE `box_hydrants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `box_hydrants_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `box_hydrants_serial_no_unique` (`serial_no`),
  ADD KEY `box_hydrants_user_id_foreign` (`user_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fire_alarms`
--
ALTER TABLE `fire_alarms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fire_alarms_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `fire_alarms_serial_no_unique` (`serial_no`),
  ADD KEY `fire_alarms_user_id_foreign` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_user_id_foreign` (`user_id`),
  ADD KEY `items_name_location_index` (`name`,`location`),
  ADD KEY `items_barcode_index` (`barcode`);

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
-- Indexes for table `kartu_apabs`
--
ALTER TABLE `kartu_apabs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_apabs_apab_id_foreign` (`apab_id`),
  ADD KEY `kartu_apabs_user_id_foreign` (`user_id`),
  ADD KEY `kartu_apabs_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_apabs_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_apars`
--
ALTER TABLE `kartu_apars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_apars_apar_id_foreign` (`apar_id`),
  ADD KEY `kartu_apars_user_id_foreign` (`user_id`),
  ADD KEY `kartu_apars_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_apars_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_apats`
--
ALTER TABLE `kartu_apats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_apats_apat_id_foreign` (`apat_id`),
  ADD KEY `kartu_apats_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_apats_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_box_hydrants`
--
ALTER TABLE `kartu_box_hydrants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_box_hydrants_box_hydrant_id_foreign` (`box_hydrant_id`),
  ADD KEY `kartu_box_hydrants_user_id_foreign` (`user_id`),
  ADD KEY `kartu_box_hydrants_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_box_hydrants_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_fire_alarms`
--
ALTER TABLE `kartu_fire_alarms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_fire_alarms_fire_alarm_id_foreign` (`fire_alarm_id`),
  ADD KEY `kartu_fire_alarms_user_id_foreign` (`user_id`),
  ADD KEY `kartu_fire_alarms_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_fire_alarms_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_kendalis`
--
ALTER TABLE `kartu_kendalis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_kendalis_apar_id_foreign` (`apar_id`);

--
-- Indexes for table `kartu_p3ks`
--
ALTER TABLE `kartu_p3ks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_p3ks_p3k_id_foreign` (`p3k_id`),
  ADD KEY `kartu_p3ks_user_id_foreign` (`user_id`),
  ADD KEY `kartu_p3ks_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_p3ks_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_rumah_pompas`
--
ALTER TABLE `kartu_rumah_pompas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kartu_rumah_pompas_rumah_pompa_id_foreign` (`rumah_pompa_id`),
  ADD KEY `kartu_rumah_pompas_user_id_foreign` (`user_id`),
  ADD KEY `kartu_rumah_pompas_signature_id_foreign` (`signature_id`),
  ADD KEY `kartu_rumah_pompas_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `kartu_settings`
--
ALTER TABLE `kartu_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartu_settings_key_unique` (`key`);

--
-- Indexes for table `kartu_templates`
--
ALTER TABLE `kartu_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kartu_templates_module_unique` (`module`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locations_code_unique` (`code`);

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
-- Indexes for table `p3ks`
--
ALTER TABLE `p3ks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `p3ks_barcode_unique` (`barcode`),
  ADD UNIQUE KEY `p3ks_serial_no_unique` (`serial_no`),
  ADD KEY `p3ks_user_id_foreign` (`user_id`);

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
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `petugas_nip_unique` (`nip`);

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
-- Indexes for table `rumah_pompas`
--
ALTER TABLE `rumah_pompas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rumah_pompas_serial_no_unique` (`serial_no`),
  ADD UNIQUE KEY `rumah_pompas_barcode_unique` (`barcode`),
  ADD KEY `rumah_pompas_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apabs`
--
ALTER TABLE `apabs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apars`
--
ALTER TABLE `apars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `apats`
--
ALTER TABLE `apats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `box_hydrants`
--
ALTER TABLE `box_hydrants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fire_alarms`
--
ALTER TABLE `fire_alarms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_apabs`
--
ALTER TABLE `kartu_apabs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_apars`
--
ALTER TABLE `kartu_apars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kartu_apats`
--
ALTER TABLE `kartu_apats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kartu_box_hydrants`
--
ALTER TABLE `kartu_box_hydrants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_fire_alarms`
--
ALTER TABLE `kartu_fire_alarms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_kendalis`
--
ALTER TABLE `kartu_kendalis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_p3ks`
--
ALTER TABLE `kartu_p3ks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_rumah_pompas`
--
ALTER TABLE `kartu_rumah_pompas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kartu_settings`
--
ALTER TABLE `kartu_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kartu_templates`
--
ALTER TABLE `kartu_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `p3ks`
--
ALTER TABLE `p3ks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rumah_pompas`
--
ALTER TABLE `rumah_pompas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apabs`
--
ALTER TABLE `apabs`
  ADD CONSTRAINT `apabs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `apars`
--
ALTER TABLE `apars`
  ADD CONSTRAINT `apars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `apats`
--
ALTER TABLE `apats`
  ADD CONSTRAINT `apats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `box_hydrants`
--
ALTER TABLE `box_hydrants`
  ADD CONSTRAINT `box_hydrants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `fire_alarms`
--
ALTER TABLE `fire_alarms`
  ADD CONSTRAINT `fire_alarms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_apabs`
--
ALTER TABLE `kartu_apabs`
  ADD CONSTRAINT `kartu_apabs_apab_id_foreign` FOREIGN KEY (`apab_id`) REFERENCES `apabs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_apabs_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_apabs_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_apabs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_apars`
--
ALTER TABLE `kartu_apars`
  ADD CONSTRAINT `kartu_apars_apar_id_foreign` FOREIGN KEY (`apar_id`) REFERENCES `apars` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_apars_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_apars_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_apars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_apats`
--
ALTER TABLE `kartu_apats`
  ADD CONSTRAINT `kartu_apats_apat_id_foreign` FOREIGN KEY (`apat_id`) REFERENCES `apats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_apats_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_apats_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_box_hydrants`
--
ALTER TABLE `kartu_box_hydrants`
  ADD CONSTRAINT `kartu_box_hydrants_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_box_hydrants_box_hydrant_id_foreign` FOREIGN KEY (`box_hydrant_id`) REFERENCES `box_hydrants` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_box_hydrants_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_box_hydrants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_fire_alarms`
--
ALTER TABLE `kartu_fire_alarms`
  ADD CONSTRAINT `kartu_fire_alarms_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_fire_alarms_fire_alarm_id_foreign` FOREIGN KEY (`fire_alarm_id`) REFERENCES `fire_alarms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_fire_alarms_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_fire_alarms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_kendalis`
--
ALTER TABLE `kartu_kendalis`
  ADD CONSTRAINT `kartu_kendalis_apar_id_foreign` FOREIGN KEY (`apar_id`) REFERENCES `apars` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kartu_p3ks`
--
ALTER TABLE `kartu_p3ks`
  ADD CONSTRAINT `kartu_p3ks_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_p3ks_p3k_id_foreign` FOREIGN KEY (`p3k_id`) REFERENCES `p3ks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_p3ks_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_p3ks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `kartu_rumah_pompas`
--
ALTER TABLE `kartu_rumah_pompas`
  ADD CONSTRAINT `kartu_rumah_pompas_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_rumah_pompas_rumah_pompa_id_foreign` FOREIGN KEY (`rumah_pompa_id`) REFERENCES `rumah_pompas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kartu_rumah_pompas_signature_id_foreign` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `kartu_rumah_pompas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
-- Constraints for table `p3ks`
--
ALTER TABLE `p3ks`
  ADD CONSTRAINT `p3ks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rumah_pompas`
--
ALTER TABLE `rumah_pompas`
  ADD CONSTRAINT `rumah_pompas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
