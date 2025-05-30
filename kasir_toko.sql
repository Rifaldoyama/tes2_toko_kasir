-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2025 at 02:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `kategori_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `foto` varchar(255) DEFAULT NULL,
  `harga_modal` decimal(15,2) NOT NULL,
  `harga_jual` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `user_id`, `kode_barang`, `kategori_barang`, `nama_barang`, `stok`, `foto`, `harga_modal`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 'BRG202505300001', 'Elektronik', 'Headset', 9, 'barang-images/belD2X5cbZTME0ch7fftqGJeYNPC8Jk9zHEhzj5Y.jpg', '15000.00', '20000.00', '2025-05-30 11:22:07', '2025-05-30 14:39:01'),
(3, 2, 'BRG202505300003', 'Elektronik', 'Headset', 7, 'barang-images/ILSPZ5tnV6n6sSCPTGD8fGHqLOuQj7bemDjRDABB.jpg', '20000.00', '25000.00', '2025-05-30 14:23:17', '2025-05-30 14:24:14'),
(4, 1, 'BRG202505300004', 'Elektronik', 'PC', 6, 'barang-images/zDITfdRkckqR06ktc7TEYZpGG2CZYHBJsWls9Vn3.jpg', '1500000.00', '2000000.00', '2025-05-30 14:36:54', '2025-05-30 14:39:01'),
(5, 3, 'BRG202505300005', 'Elektronik', 'Headset', 1, 'barang-images/7cADuAOddAhL5C2QUegV5ca2yUf8Dd0FmpE4PJzc.jpg', '15000.00', '20000.00', '2025-05-30 14:43:52', '2025-05-30 14:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_penjualan`
--

CREATE TABLE `item_penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `jumlah` int NOT NULL,
  `harga_satuan` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `item_penjualan`
--

INSERT INTO `item_penjualan` (`id`, `penjualan_id`, `barang_id`, `jumlah`, `harga_satuan`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '20000.00', '80000.00', '2025-05-30 11:22:23', '2025-05-30 11:22:23'),
(2, 2, 1, 3, '20000.00', '60000.00', '2025-05-30 11:25:51', '2025-05-30 11:25:51'),
(3, 3, 1, 2, '20000.00', '40000.00', '2025-05-30 14:17:59', '2025-05-30 14:17:59'),
(5, 4, 3, 3, '25000.00', '75000.00', '2025-05-30 14:24:14', '2025-05-30 14:24:14'),
(6, 5, 4, 2, '2000000.00', '4000000.00', '2025-05-30 14:39:01', '2025-05-30 14:39:01'),
(7, 5, 1, 2, '20000.00', '40000.00', '2025-05-30 14:39:01', '2025-05-30 14:39:01'),
(8, 6, 5, 9, '20000.00', '180000.00', '2025-05-30 14:44:32', '2025-05-30 14:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(81, '0001_01_01_000000_create_users_table', 1),
(82, '0001_01_01_000001_create_cache_table', 1),
(83, '2025_05_28_102500_create_barangs_table', 1),
(84, '2025_05_28_102528_create_penjualans_table', 1),
(85, '2025_05_28_102604_create_item_penjualans_table', 1),
(86, '2025_05_29_043227_pembelian', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelians`
--

CREATE TABLE `pembelians` (
  `id` bigint UNSIGNED NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `total_diskon` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_bayar` decimal(15,2) NOT NULL,
  `status` enum('lunas','hutang') NOT NULL DEFAULT 'lunas',
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_harga` decimal(15,2) NOT NULL,
  `uang_diterima` decimal(15,2) NOT NULL,
  `kembalian` decimal(15,2) NOT NULL,
  `jenis_pembayaran` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `user_id`, `total_harga`, `uang_diterima`, `kembalian`, `jenis_pembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, '80000.00', '80000.00', '0.00', 'qr', '2025-05-30 11:22:23', '2025-05-30 11:22:23'),
(2, 1, '60000.00', '100000.00', '40000.00', 'tunai', '2025-05-30 11:25:51', '2025-05-30 11:25:51'),
(3, 1, '2040000.00', '2040000.00', '0.00', 'qr', '2025-05-30 14:17:59', '2025-05-30 14:17:59'),
(4, 2, '75000.00', '100000.00', '25000.00', 'tunai', '2025-05-30 14:24:14', '2025-05-30 14:24:14'),
(5, 1, '4040000.00', '4040000.00', '0.00', 'qr', '2025-05-30 14:39:01', '2025-05-30 14:39:01'),
(6, 3, '180000.00', '200000.00', '20000.00', 'tunai', '2025-05-30 14:44:32', '2025-05-30 14:44:32');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('PFUFqlqn8lZtTmU2kkh0sCTC7rLe8pMBfCw7Z957', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 13; SM-G981B) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibkVhdFduaXl2ZEZRaWFNcGFwMTBUU1p1ek9DeHRiSThkTUFhcGtldyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1748616365);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) DEFAULT NULL,
  `alamat` text,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `nama_toko`, `email`, `email_verified_at`, `password`, `no_hp`, `alamat`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rifaldo Aditya Pratama', 'Kasir Jaya', 'r@gmail.com', NULL, '$2y$12$Ul109NoVEElHJf0kCYESWuaGuT0oxEQvVUUbxyhjRl6GwSzA2TXFq', '0384348343', 'Jawa barat', NULL, '2025-05-30 11:17:49', '2025-05-30 14:40:19'),
(2, 'faldo', 'jama', 'c@gmail.com', NULL, '$2y$12$miw.trBFcH.0Pt7zJbJK6O.RpEL1jDA.3u4hC66oBobwp2eUkpxLm', '093838483', 'jalan kertawangi', NULL, '2025-05-30 14:21:29', '2025-05-30 14:22:39'),
(3, 'Faldo', 'toko pc', 'f@gmail.com', NULL, '$2y$12$Niw9pYu.U5u/h3d8qAsJRuu7nmVADJv93FXe3t1IFVcw46ecZVY/G', '082323231441', 'jalan keramat', NULL, '2025-05-30 14:42:32', '2025-05-30 14:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_kode_barang_unique` (`kode_barang`),
  ADD KEY `barang_user_id_foreign` (`user_id`);

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
-- Indexes for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_penjualan_penjualan_id_foreign` (`penjualan_id`),
  ADD KEY `item_penjualan_barang_id_foreign` (`barang_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pembelians_no_faktur_unique` (`no_faktur`),
  ADD KEY `pembelians_user_id_foreign` (`user_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `pembelians`
--
ALTER TABLE `pembelians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_penjualan`
--
ALTER TABLE `item_penjualan`
  ADD CONSTRAINT `item_penjualan_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_penjualan_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembelians`
--
ALTER TABLE `pembelians`
  ADD CONSTRAINT `pembelians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
