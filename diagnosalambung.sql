-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Mar 2024 pada 10.45
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
(2, 'user', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(1, 1);

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
(7, '::1', 'admin@gmail.com', 1, '2024-03-22 08:02:57', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `url`, `icon`) VALUES
(1, 'Manajemen Pengguna', 'daftar_users', 'fas fa-users'),
(2, 'Manajemen Pasien', 'daftar_pasien', 'fas fa-hospital-user'),
(3, 'Manajemen Gejala', 'daftar_gejala', 'fas fa-table'),
(4, 'Manajemen Penyakit', 'daftar_penyakit', 'fas fa-viruses'),
(5, 'Manajemen Menu', 'daftar_menu', 'fas fa-bars'),
(7, 'Manajemen Relasi', 'daftar_relasi', 'fas fa-link');

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
-- Struktur dari tabel `data_gejala`
--

CREATE TABLE `data_gejala` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_gejala`
--

INSERT INTO `data_gejala` (`id`, `kode`, `nama`, `deskripsi`) VALUES
(1, 'G01', 'Mual pada perut', 'Sensasi tidak nyaman di perut yang sering kali mendahului keinginan untuk muntah.'),
(2, 'G02', 'Nyeri di ulu hati', 'Rasa nyeri atau tidak nyaman yang terlokalisasi di area ulu hati, tepat di bawah tulang dada.'),
(3, 'G03', 'Perut kembung', 'Keadaan di mana perut terasa penuh dan membesar, sering kali karena gas atau makan berlebih.'),
(7, 'G04', 'Sendawa berlebih', 'Frekuensi sendawa yang meningkat, sering kali karena menelan udara atau gangguan pencernaan.'),
(8, 'G05', 'Sulit tidur', 'Kesulitan untuk memulai atau mempertahankan tidur, sering kali karena ketidaknyamanan perut'),
(9, 'G06', 'Anemia', 'Kondisi di mana jumlah sel darah merah atau hemoglobin di dalam darah berada di bawah normal.'),
(10, 'G07', 'BAB berwarna hitam', 'Feses berwarna hitam, sering kali merupakan indikasi perdarahan di saluran pencernaan atas.'),
(11, 'G08', 'Sering Cegukan', 'Frekuensi cegukan yang meningkat, yang bisa disebabkan oleh distensi perut atau iritasi.'),
(12, 'G09', 'Sakit tenggorokan', 'Sensasi nyeri atau iritasi di tenggorokan, bisa disebabkan oleh asam lambung naik.'),
(13, 'G10', 'Mudah merasa kenyang', 'Perasaan kenyang yang cepat selama atau setelah makan, dengan asupan makanan yang sedikit.'),
(14, 'G11', 'Kadar gula darah tidak terkontrol', 'Fluktuasi dalam kadar gula darah, bisa disebabkan oleh stres atau diet yang tidak teratur.'),
(15, 'G12', 'Asam dan pahit pada mulut', 'Rasa asam atau pahit di mulut, sering kali karena refluks asam dari lambung.'),
(16, 'G13', 'Muntah darah', 'Muntah yang mengandung darah, merupakan tanda perdarahan di saluran pencernaan.'),
(17, 'G14', 'BAB Berdarah', 'Feses dengan darah, yang bisa berupa garis darah merah cerah atau feses berwarna gelap.'),
(18, 'G15', 'Penurunan berat badan', 'Kehilangan berat badan yang tidak diinginkan atau tidak dapat dijelaskan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_pasien`
--

CREATE TABLE `data_pasien` (
  `id` int(11) NOT NULL,
  `no_rm` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` varchar(50) NOT NULL,
  `umur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_pasien`
--

INSERT INTO `data_pasien` (`id`, `no_rm`, `nama`, `jk`, `umur`) VALUES
(3, '001', 'Marfel Crisly', 'Laki-Laki', '24');

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

--
-- Dumping data untuk tabel `data_penyakit`
--

INSERT INTO `data_penyakit` (`id`, `kode`, `nama`, `deskripsi`, `perawatan`, `img`) VALUES
(1, 'P01', 'Tukak Lambung', 'Tukak lambung merupakan suatu kondisi medis di mana terjadi pembentukan luka terbuka pada lapisan dalam lambung atau bagian atas usus halus, yang dikenal sebagai duodenum. Kondisi ini umumnya terjadi akibat kerusakan pada lapisan pelindung lambung atau duodenum, yang seharusnya melindungi dari asam lambung. Penyebab umum dari tukak lambung adalah infeksi bakteri Helicobacter pylori (H. pylori), yang bisa merusak lapisan pelindung, dan penggunaan jangka panjang obat anti-inflamasi nonsteroid (NSAID), seperti ibuprofen atau aspirin, yang dapat mengiritasi lapisan lambung.\r\nSelain H. pylori dan NSAID, faktor lain yang dapat meningkatkan risiko terjadinya tukak lambung termasuk merokok, konsumsi alkohol berlebihan, stres berat, dan penggunaan kortikosteroid. Merokok tidak hanya meningkatkan risiko terjadinya tukak lambung tetapi juga memperlambat proses penyembuhan luka dan meningkatkan kemungkinan tukak lambung kambuh.', 'Pengobatan tukak lambung melibatkan pendekatan komprehensif yang bertujuan mengatasi penyebab langsung dan mengurangi gejala. Ini biasanya mencakup penggunaan antibiotik seperti amoksisilin atau klaritromisin untuk mengeliminasi infeksi Helicobacter pylori, yang sering kali menjadi penyebab utama kondisi ini. Selain itu, penggunaan inhibitor pompa proton (PPI) seperti omeprazol atau lansoprazol diresepkan untuk mengurangi produksi asam lambung, membantu menyembuhkan luka, dan mencegahnya kembali terjadi. Penting juga bagi pasien untuk menghindari penggunaan obat anti-inflamasi nonsteroid (NSAID), seperti ibuprofen atau aspirin, yang dapat memperburuk luka. Gaya hidup dan perubahan diet, seperti mengurangi konsumsi makanan pedas, berlemak, dan asam, juga dapat membantu dalam proses penyembuhan. Dalam kasus yang lebih serius, prosedur medis atau operasi mungkin diperlukan untuk mengatasi komplikasi seperti perdarahan.', 'TukakLambung.jpg'),
(2, 'P02', 'Gastroparesis', 'Kondisi yang mengakibatkan lambatnya pengosongan lambung, menyebabkan makanan tertahan terlalu lama di lambung. Hal ini sering berkaitan dengan diabetes.', 'Perubahan diet, obat-obatan yang mempromosikan motilitas lambung, dan dalam kasus berat, mungkin memerlukan pembedahan.', 'default.jpg'),
(4, 'P03', 'GERD', 'Gastroesophageal Reflux Disease adalah kondisi kronis di mana isi lambung kembali ke esofagus, menyebabkan iritasi.', 'Perubahan gaya hidup, antasida, inhibitor pompa proton, dan intervensi bedah dalam kasus yang parah.', 'default.jpg'),
(5, 'P04', 'Gastritis', 'Peradangan pada lapisan lambung yang bisa disebabkan oleh berbagai faktor, termasuk infeksi, stres, atau konsumsi alkohol dan obat-obatan tertentu.', 'Pengobatan tergantung pada penyebab, termasuk antibiotik, pengurangan asam lambung, dan menghindari pemicu iritasi.', 'default.jpg'),
(6, 'P05', 'Kanker Lambung', 'Sebuah kondisi di mana sel kanker tumbuh di lapisan lambung. Risikonya meningkat karena infeksi H. pylori, merokok, dan diet tinggi garam.', 'Pengobatan bisa termasuk kemoterapi, radioterapi, dan pembedahan untuk mengangkat jaringan kanker.', 'default.jpg');

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
  `pyk_id` int(11) NOT NULL,
  `gjl_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `relasi_gp`
--

INSERT INTO `relasi_gp` (`id`, `pyk_id`, `gjl_id`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 7),
(4, 1, 10),
(5, 1, 14),
(6, 2, 1),
(7, 2, 3),
(9, 2, 7),
(10, 2, 8),
(11, 2, 11),
(12, 2, 13),
(13, 2, 15),
(14, 2, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
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

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', 'admin', '$2y$10$QhY1jJ/5KDzwNdd/lFXwGO1SrNuyEjOjych1aXKU4nj76JwK80ldK', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2024-03-21 01:53:14', '2024-03-21 01:53:14', NULL);

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
-- Indeks untuk tabel `data_gejala`
--
ALTER TABLE `data_gejala`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_penyakit`
--
ALTER TABLE `data_penyakit`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT untuk tabel `data_gejala`
--
ALTER TABLE `data_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_penyakit`
--
ALTER TABLE `data_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `relasi_gp`
--
ALTER TABLE `relasi_gp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
