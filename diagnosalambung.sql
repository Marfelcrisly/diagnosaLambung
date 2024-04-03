-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2024 pada 06.11
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diagnosalambung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Admin'),
(2, 'pasien', 'Pasien');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`id`, `group_id`, `permission_id`) VALUES
(20, 1, 1),
(21, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 7),
(7, 1, 8),
(8, 1, 9),
(9, 1, 11),
(11, 1, 12),
(22, 1, 13),
(16, 2, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'admin@gmail.com', 1, '2024-03-21 01:53:24', 1),
(2, '::1', 'admin@gmail.com', 1, '2024-03-21 02:10:23', 1),
(3, '::1', 'admin@gmail.com', 1, '2024-03-21 02:24:04', 1),
(4, '::1', 'admin@gmail.com', 1, '2024-03-21 02:26:58', 1),
(5, '::1', 'admin@gmail.com', 1, '2024-03-21 03:04:17', 1),
(6, '::1', 'admin@gmail.com', 1, '2024-03-22 03:48:00', 1),
(7, '::1', 'admin@gmail.com', 1, '2024-03-22 08:02:57', 1),
(8, '::1', 'admin@gmail.com', 1, '2024-03-23 16:36:03', 1),
(9, '::1', 'admin@gmail.com', 1, '2024-03-23 17:23:45', 1),
(10, '::1', 'admin@gmail.com', 1, '2024-03-23 17:25:11', 1),
(11, '::1', 'admin@gmail.com', 1, '2024-03-25 01:57:49', 1),
(12, '::1', 'admin@gmail.com', 1, '2024-03-26 01:38:13', 1),
(13, '::1', 'admin@gmail.com', 1, '2024-03-26 02:04:56', 1),
(14, '::1', 'pasien2@gmail.com', 3, '2024-03-26 02:50:22', 1),
(15, '::1', 'admin@gmail.com', 1, '2024-03-26 02:50:36', 1),
(16, '::1', 'admin@gmail.com', 1, '2024-03-27 01:21:37', 1),
(17, '::1', 'admin@gmail.com', 1, '2024-03-27 01:22:51', 1),
(18, '::1', 'admin@gmail.com', 1, '2024-03-27 01:44:30', 1),
(19, '::1', 'admin@gmail.com', 1, '2024-03-27 03:50:45', 1),
(20, '::1', 'admin@gmail.com', 1, '2024-03-27 03:51:55', 1),
(21, '::1', 'admin@gmail.com', 1, '2024-03-27 04:14:25', 1),
(22, '::1', 'admin@gmail.com', 1, '2024-03-27 04:14:35', 1),
(23, '::1', 'admin@gmail.com', 1, '2024-03-27 04:20:27', 1),
(24, '::1', 'admin@gmail.com', 1, '2024-03-27 04:20:35', 1),
(25, '::1', 'admin@gmail.com', 1, '2024-03-27 04:20:58', 1),
(26, '::1', 'admin', NULL, '2024-03-27 04:32:53', 0),
(27, '::1', 'admin', NULL, '2024-03-27 04:33:23', 0),
(28, '::1', 'admin', NULL, '2024-03-27 04:33:36', 0),
(29, '::1', 'admin', NULL, '2024-03-27 04:33:45', 0),
(30, '::1', 'admin', NULL, '2024-03-27 04:34:10', 0),
(31, '::1', 'admin', NULL, '2024-03-27 04:34:13', 0),
(32, '::1', 'admin@gmail.com', 1, '2024-03-27 04:34:20', 1),
(33, '::1', 'pasien1@gmail.com', 4, '2024-03-27 04:40:59', 1),
(34, '::1', 'pasien1', NULL, '2024-03-27 04:42:29', 0),
(35, '::1', 'pasien1', NULL, '2024-03-27 04:42:53', 0),
(36, '::1', 'pasien1', NULL, '2024-03-27 04:43:32', 0),
(37, '::1', 'pasien1', NULL, '2024-03-27 04:47:14', 0),
(38, '::1', 'pasien1', NULL, '2024-03-27 04:56:11', 0),
(39, '::1', 'pasien1', NULL, '2024-03-27 04:56:28', 0),
(40, '::1', 'pasien1', NULL, '2024-03-27 04:57:01', 0),
(41, '::1', 'pasien1', NULL, '2024-03-27 05:00:58', 0),
(42, '::1', 'pasien1', NULL, '2024-03-27 05:02:53', 0),
(43, '::1', 'pasien1', NULL, '2024-03-27 05:48:19', 0),
(44, '::1', 'pasien1', NULL, '2024-03-27 05:48:47', 0),
(45, '::1', 'pasien1', NULL, '2024-03-27 05:51:07', 0),
(46, '::1', 'pasien1', NULL, '2024-03-27 05:51:43', 0),
(47, '::1', 'pasien1', NULL, '2024-03-27 05:53:21', 0),
(48, '::1', 'pasien1', NULL, '2024-03-27 05:54:05', 0),
(49, '::1', 'pasien1@gmail.com', 4, '2024-03-27 05:54:38', 1),
(50, '::1', 'pasien1', NULL, '2024-03-27 05:57:28', 0),
(51, '::1', 'pasien1@gmail.com', 4, '2024-03-27 06:00:37', 1),
(52, '::1', 'pasien1@gmail.com', 4, '2024-03-27 06:03:07', 1),
(53, '::1', 'admin', NULL, '2024-03-27 06:04:16', 0),
(54, '::1', 'admin@gmail.com', 1, '2024-03-27 06:04:23', 1),
(55, '::1', 'admin@gmail.com', 1, '2024-03-27 06:04:38', 1),
(56, '::1', 'admin@gmail.com', 1, '2024-03-27 06:04:50', 1),
(57, '::1', 'admin@gmail.com', 1, '2024-03-27 06:04:57', 1),
(58, '::1', 'admin@gmail.com', 1, '2024-03-27 06:05:21', 1),
(59, '::1', 'admin@gmail.com', 1, '2024-03-27 06:09:58', 1),
(60, '::1', 'admin@gmail.com', 1, '2024-03-27 06:15:35', 1),
(61, '::1', 'pasien1', NULL, '2024-03-27 06:19:38', 0),
(62, '::1', 'pasien1@gmail.com', 4, '2024-03-27 06:19:45', 1),
(63, '::1', 'admin@gmail.com', 1, '2024-03-27 06:24:34', 1),
(64, '::1', 'admin@gmail.com', 1, '2024-03-28 02:19:20', 1),
(65, '::1', 'pasien1@gmail.com', 4, '2024-03-28 02:23:12', 1),
(66, '::1', 'admin@gmail.com', 1, '2024-04-01 05:46:49', 1),
(67, '::1', 'admin@gmail.com', 1, '2024-04-01 14:59:46', 1),
(68, '::1', 'admin@gmail.com', 1, '2024-04-01 15:09:07', 1),
(69, '::1', 'admin@gmail.com', 1, '2024-04-02 01:45:55', 1),
(70, '::1', 'admin@gmail.com', 1, '2024-04-03 03:03:48', 1),
(71, '::1', 'admin@gmail.com', 1, '2024-04-03 03:18:10', 1),
(72, '::1', 'admin@gmail.com', 1, '2024-04-03 03:45:23', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `url`, `icon`, `status`) VALUES
(1, 'Data Pengguna', 'daftar_pengguna', 'fas fa-users', 1),
(2, 'Data Pasien', 'daftar_pasien', 'fas fa-hospital-user', 1),
(3, 'Data Gejala', 'daftar_gejala', 'fas fa-table', 1),
(4, 'Data Penyakit', 'daftar_penyakit', 'fas fa-viruses', 1),
(5, 'Data Menu', 'daftar_menu', 'fas fa-bars', 1),
(7, 'Data Aturan', 'daftar_relasi', 'fas fa-link', 1),
(8, 'Data Bobot', 'daftar_bobot', 'fas fa-weight', 1),
(9, 'Data Kasus Baru', 'daftar_diagnosa', 'fas fa-stethoscope', 1),
(11, 'Dashboard', '/', 'fa-solid fa-gauge', 1),
(12, 'Data Akses Menu', 'akses_menu', 'fas fa-link', 1),
(13, 'Data Kasus Lama', 'daftar_kasusLama', 'fa-solid fa-archive', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobot`
--

CREATE TABLE `bobot` (
  `id` int(11) NOT NULL,
  `parameter` varchar(20) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_gejala`
--

CREATE TABLE `data_gejala` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_kasuslama`
--

CREATE TABLE `data_kasuslama` (
  `id` int(11) NOT NULL,
  `penyakit_id` int(11) NOT NULL,
  `gejala` varchar(200) NOT NULL,
  `bobot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_kasuslama`
--

INSERT INTO `data_kasuslama` (`id`, `penyakit_id`, `gejala`, `bobot`) VALUES
(2, 5, '[\"12\",\"1\",\"7\",\"16\",\"5\"]', '[\"2\",\"1\",\"1\",\"1\",\"1\"]'),
(3, 2, '[\"12\",\"8\",\"14\",\"2\",\"3\",\"7\",\"17\",\"11\",\"5\"]', '[\"2\",\"1\",\"1\",\"1\",\"2\",\"1\",\"2\",\"3\",\"1\"]'),
(4, 3, '[\"1\",\"14\",\"11\",\"5\"]', '[\"1\",\"1\",\"3\",\"1\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penyakit`
--

CREATE TABLE `data_penyakit` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `perawatan` varchar(1000) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) UNSIGNED NOT NULL,
  `gejala` varchar(200) NOT NULL,
  `penyakit_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `persenan` varchar(20) NOT NULL,
  `kriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1710985075, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi_gp`
--

CREATE TABLE `relasi_gp` (
  `id` int(11) NOT NULL,
  `pyk_id` int(11) DEFAULT NULL,
  `gjl_id` int(11) NOT NULL,
  `bobot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `no_rm` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `umur` varchar(20) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `no_rm`, `name`, `jk`, `umur`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$5X9L.BVgzLT.m.7YDDXpzuCSsGIKuiVEGr/DI0.trSyNuDz7ssDqu', '', 'Admin', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-21 01:53:14', '2024-03-21 01:53:14', NULL),
(3, 'pasien2@gmail.com', 'pasien2', '$2y$10$l6TnNA80saGQ29CkApJZ4ejV6XvsvVjxCG3B8huX04VPNdS9R9tOu', 'PA02', 'Pasien 2', 'Perempuan', '25', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-26 03:22:13', '2024-03-26 03:22:13', NULL),
(4, 'pasien1@gmail.com', 'pasien1', '$2y$10$ANf6V0BwtwSDwHky21cnVOxlLKXml3gfjQc7wddx7mvqrUbTUAJkK', 'PA03', 'Pasien 1', 'Laki-Laki', '25', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-26 03:39:31', '2024-03-26 03:39:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_gejala`
--
ALTER TABLE `data_gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_kasuslama`
--
ALTER TABLE `data_kasuslama`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_penyakit`
--
ALTER TABLE `data_penyakit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `relasi_gp`
--
ALTER TABLE `relasi_gp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_gejala`
--
ALTER TABLE `data_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_kasuslama`
--
ALTER TABLE `data_kasuslama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `data_penyakit`
--
ALTER TABLE `data_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `relasi_gp`
--
ALTER TABLE `relasi_gp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD CONSTRAINT `hasil_diagnosa_ibfk_1` FOREIGN KEY (`pasien_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
