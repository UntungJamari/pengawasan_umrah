-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 07:12 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengawasan_umrah_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `akreditasis`
--

CREATE TABLE `akreditasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_akreditasi` date NOT NULL,
  `bukti` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `akreditasis`
--

INSERT INTO `akreditasis` (`id`, `tanggal_akreditasi`, `bukti`, `created_at`, `updated_at`) VALUES
(99, '2022-12-31', 'file-akreditasi/p4IgLcRm6VLKwbuWi5WMIRyRGBLwwdyb3fcAMz3b.pdf', NULL, '2022-11-28 10:42:58'),
(103, '2018-11-30', 'file-akreditasi/GHpLpLLYGC35rCI5hlV7TyOSDClPmM05QjKnF0K1.pdf', '2022-11-28 10:31:23', '2022-12-01 07:22:31');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `file_pengawasans`
--

CREATE TABLE `file_pengawasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pengawasan` bigint(20) UNSIGNED NOT NULL,
  `nama_jemaah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_jemaah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_pengawasans`
--

INSERT INTO `file_pengawasans` (`id`, `id_pengawasan`, `nama_jemaah`, `file_jemaah`, `created_at`, `updated_at`) VALUES
(6, 9, 'TOGAF+Standard+9.2[183-191].en.id - Copy', 'file-pengawasan/f3xfk2PsVKmjFj9cgKj13YMqFkpL06SAzP6lUykA.pdf', '2022-11-30 10:18:47', '2022-11-30 10:18:47'),
(7, 9, 'TOGAF+Standard+9.2[183-191].en.id', 'file-pengawasan/a2jTBX8pxaPkAXHVSkRW3TC3gLDEmQgoHoy07Tc5.pdf', '2022-11-30 10:18:47', '2022-11-30 10:18:47'),
(13, 12, 'TOGAF+Standard+9.2[183-191].en.id - Copy', 'file-pengawasan/73uYpHkPxM5pipv378DRjwkdjxco1m5MODn2ovFk.pdf', '2022-12-10 09:52:14', '2022-12-10 09:52:14'),
(14, 12, 'TOGAF+Standard+9.2[183-191].en.id', 'file-pengawasan/7QnW1f5GfI4AXn1L9twMc4is9U9QVMHEJqhZqDQs.pdf', '2022-12-10 09:52:14', '2022-12-10 09:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `kab_kotas`
--

CREATE TABLE `kab_kotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kab_kotas`
--

INSERT INTO `kab_kotas` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Kabupaten Agam', '2022-11-26 07:32:53', '2022-11-26 07:32:53'),
(2, 'Kabupaten Dharmasraya', '2022-11-26 07:32:55', '2022-11-26 07:32:55');

-- --------------------------------------------------------

--
-- Table structure for table `kanwils`
--

CREATE TABLE `kanwils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_pimpinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kanwils`
--

INSERT INTO `kanwils` (`id`, `id_user`, `nama_pimpinan`, `alamat`, `logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ari', 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114', 'image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png', '2022-11-26 07:32:40', '2022-11-30 15:13:03');

-- --------------------------------------------------------

--
-- Table structure for table `kemenag_kab_kotas`
--

CREATE TABLE `kemenag_kab_kotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kab_kota` bigint(20) UNSIGNED NOT NULL,
  `nama_pimpinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kemenag_kab_kotas`
--

INSERT INTO `kemenag_kab_kotas` (`id`, `nama`, `id_user`, `id_kab_kota`, `nama_pimpinan`, `alamat`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Kementerian Agama Kabupaten Agam', 2, 1, 'Abdulllah', 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114', 'image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png', '2022-11-26 07:32:54', '2022-11-30 15:20:59'),
(2, 'Kementerian Agama Kabupaten Dharmasraya', 4, 2, NULL, 'Jl. Kuini No.79B, Ujung Gurun, Kec. Padang Bar., Kota Padang, Sumatera Barat 25114', 'image-profile/sT0aKjhi1RY4jQHYfkjHgGfDNNGrr4i3wQTb5pr0.png', '2022-11-26 07:32:56', '2022-11-26 07:32:56');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_11_06_060316_create_kanwils_table', 1),
(6, '2022_11_08_140549_create_kab_kotas_table', 1),
(7, '2022_11_08_140708_create_kemenag_kab_kotas_table', 1),
(8, '2022_11_08_140835_create_pengawasans_table', 1),
(9, '2022_11_08_140910_create_ppius_table', 1),
(10, '2022_11_26_140629_create_akreditasis_table', 1),
(11, '2022_11_29_140501_create_file_pengawasans_table', 2);

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
-- Table structure for table `pengawasans`
--

CREATE TABLE `pengawasans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `id_ppiu` bigint(20) UNSIGNED NOT NULL,
  `izin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_jemaah_laki_laki` int(11) NOT NULL,
  `jumlah_jemaah_wanita` int(11) NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `tanggal_kepulangan` date NOT NULL,
  `temuan_lapangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `petugas_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengawasans`
--

INSERT INTO `pengawasans` (`id`, `hari`, `tanggal`, `jam`, `id_ppiu`, `izin`, `jumlah_jemaah_laki_laki`, `jumlah_jemaah_wanita`, `tanggal_keberangkatan`, `tanggal_kepulangan`, `temuan_lapangan`, `petugas_1`, `petugas_2`, `created_at`, `updated_at`) VALUES
(9, 'Rabu', '2022-11-30', '17:18:47', 1, 'nna', 1, 1, '2022-12-31', '2023-01-01', 'a', 'a', 'a', '2022-11-30 10:18:47', '2022-11-30 15:29:49'),
(12, 'Sabtu', '2022-12-10', '16:52:13', 1, 'w', 1, 1, '2022-12-30', '2022-12-31', 'w', 'w', 'w', '2022-12-10 09:52:13', '2022-12-10 09:52:13');

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ppius`
--

CREATE TABLE `ppius` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_kab_kota` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_sk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_sk` date NOT NULL,
  `nama_pimpinan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_akreditasi` bigint(20) UNSIGNED DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image-profile/btuP6rIVQw1r89VG4C5pSPwZyONSORAclojTQU9N.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ppius`
--

INSERT INTO `ppius` (`id`, `nama`, `id_user`, `id_kab_kota`, `status`, `nomor_sk`, `tanggal_sk`, `nama_pimpinan`, `alamat`, `id_akreditasi`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'PT. Mahabbah Family Tour dan Travel', 3, 1, 'Pusat', 'No. 9120005970756 Tahun 2022', '2022-01-27', NULL, 'Jalan Lintas Lubuk Basung Bukittinggi Jorong Lubuk Anyir RT/RW 00/00 Kel. Bayua Kec. Tanjung Raya Kab. Agam', 103, 'image-profile/7e7665e7f97ba26b126812b8a7e2909d.jpg', '2022-11-26 07:32:55', '2022-12-08 15:37:23'),
(2, 'aaaaaaa', 5, 2, 'Pusat', 's', '2022-10-31', NULL, 'ss', 99, 'image-profile/bBeh9w0CwU6kmxOUR2nPhpac9PIQa8EVTdKdRjRx.png', '2022-11-26 09:09:09', '2022-11-26 09:09:09'),
(3, 'PT. Mahabbah Family Tour dan Travel', 6, 2, 'Cabang', 'x', '2022-12-31', 'x', 'x', NULL, 'image-profile/7e7665e7f97ba26b126812b8a7e2909d.jpg', '2022-11-26 15:59:57', '2022-12-01 08:20:19'),
(4, 'aaaaaaa', 7, 1, 'Cabang', 'a', '2022-12-31', 'a', 'a', NULL, 'image-profile/btuP6rIVQw1r89VG4C5pSPwZyONSORAclojTQU9N.png', '2022-11-28 08:51:22', '2022-11-28 08:51:22'),
(16, 'wdssddsdss', 19, 1, 'Pusat', 'a', '2022-12-31', 'a', 'w', NULL, 'image-profile/72ffcb859c3f09fdfab02e8e3ec36d2c.jpg', '2022-12-10 10:08:17', '2022-12-10 10:10:42'),
(17, 'kkkkkkk', 20, 1, 'Pusat', 'k', '2022-12-31', 'k', 'k', NULL, 'image-profile/btuP6rIVQw1r89VG4C5pSPwZyONSORAclojTQU9N.png', '2022-12-10 10:13:00', '2022-12-10 10:13:00'),
(18, 'ggggggg', 21, 1, 'Pusat', 'g', '2022-12-31', 'g', 'g', NULL, 'image-profile/f28c635bc486702168f5beb40984f83b.jpg', '2022-12-10 10:23:01', '2022-12-10 10:23:01'),
(19, 'ppppppp', 22, 1, 'Pusat', 'p', '2022-12-31', 'p', 'p', NULL, 'image-profile/dd292c2b7d89ffdd7a7b79af4c0cadc5.jpg', '2022-12-10 10:24:19', '2022-12-10 10:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kanwil_kemenag', '$2y$10$USedJhFbfK050fUxARNLrO4BBqIsq4dBAjEknHmbF3/8.h40VcmjS', 'kanwil', NULL, '2022-11-26 07:32:37', '2022-11-30 15:14:18'),
(2, 'kemenag_agam', '$2y$10$4EvXp09SyG/jYPuqZw/.E.k6YWEAQo9BGRVFBMev35h8y0clHg08i', 'kab/kota', NULL, '2022-11-26 07:32:53', '2022-11-30 15:20:59'),
(3, 'mftt_agm', '$2y$10$yclAXEGeewyKqbTHo/Orhuq./z.JteADdtyNoYvH2t3zLSYzoR68i', 'ppiu', NULL, '2022-11-26 07:32:54', '2022-11-26 07:32:54'),
(4, 'kemenag_dharmasraya', '$2y$10$AGlzK5hGvbHU1SGgzH3D6ueRGAWy6cArQJlTIp8wvYQ1FytL4wnZa', 'kab/kota', NULL, '2022-11-26 07:32:55', '2022-11-26 07:32:55'),
(5, 'aaaaaaa', '$2y$10$YkKL2cSZn1IiPiJsTfP5dOxPFIZUHOHz0CEDvwAnwETeeQR0ObYBa', 'ppiu', NULL, '2022-11-26 09:09:09', '2022-11-26 09:09:09'),
(6, 'xxxxxxx', '$2y$10$vjXUvMymU4ztnjMZy3LDD.9zk62EepmgJnWg1xk.k7br5JNqqBVHq', 'ppiu', NULL, '2022-11-26 15:59:56', '2022-11-26 15:59:56'),
(7, 'zzzzzzz', '$2y$10$g.a0bdGMy2TfFVk3Wb6j5u0ATzyu2zZf/ETeWQVur24Vhv8duse2q', 'ppiu', NULL, '2022-11-28 08:51:22', '2022-11-28 08:51:22'),
(19, 'ddddddd', '$2y$10$NhNh.7yxsI3ScREYG3syCexklIGsWkzfPRroRo6/EOAjJENavYuyO', 'ppiu', NULL, '2022-12-10 10:08:17', '2022-12-10 10:08:17'),
(20, 'kkkkkkk', '$2y$10$p0JM9qRUhvTkqHyv4N/ZbOz10GPyHIrY1d4MAgsSAHxfgkmUN9dk6', 'ppiu', NULL, '2022-12-10 10:13:00', '2022-12-10 10:13:00'),
(21, 'ggggggg', '$2y$10$LlvMMpnFRyTfVlXjWERHjuumMULDArN6QyQFjO43CxYkgWIZHVC2O', 'ppiu', NULL, '2022-12-10 10:23:01', '2022-12-10 10:23:01'),
(22, 'ppppppp', '$2y$10$Q.CtslGD6i61YhIO3xKtdO1FvlfMkC9aWrLEbjPibS1wCZRcGIO02', 'ppiu', NULL, '2022-12-10 10:24:18', '2022-12-10 10:24:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akreditasis`
--
ALTER TABLE `akreditasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `file_pengawasans`
--
ALTER TABLE `file_pengawasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kab_kotas`
--
ALTER TABLE `kab_kotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kanwils`
--
ALTER TABLE `kanwils`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kanwils_id_user_unique` (`id_user`);

--
-- Indexes for table `kemenag_kab_kotas`
--
ALTER TABLE `kemenag_kab_kotas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kemenag_kab_kotas_id_user_unique` (`id_user`),
  ADD UNIQUE KEY `kemenag_kab_kotas_id_kab_kota_unique` (`id_kab_kota`);

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
-- Indexes for table `pengawasans`
--
ALTER TABLE `pengawasans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `ppius`
--
ALTER TABLE `ppius`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ppius_id_user_unique` (`id_user`),
  ADD UNIQUE KEY `ppius_id_akreditasi_unique` (`id_akreditasi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akreditasis`
--
ALTER TABLE `akreditasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_pengawasans`
--
ALTER TABLE `file_pengawasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kab_kotas`
--
ALTER TABLE `kab_kotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kanwils`
--
ALTER TABLE `kanwils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kemenag_kab_kotas`
--
ALTER TABLE `kemenag_kab_kotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengawasans`
--
ALTER TABLE `pengawasans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ppius`
--
ALTER TABLE `ppius`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
