-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Mar 2024 pada 11.34
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
(7, '::1', 'admin@gmail.com', 1, '2024-03-22 08:02:57', 1),
(8, '::1', 'admin@gmail.com', 1, '2024-03-23 16:36:03', 1),
(9, '::1', 'admin@gmail.com', 1, '2024-03-23 17:23:45', 1),
(10, '::1', 'admin@gmail.com', 1, '2024-03-23 17:25:11', 1),
(11, '::1', 'admin@gmail.com', 1, '2024-03-25 01:57:49', 1);

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
(1, 'Manajemen Pengguna', 'daftar_users', 'fas fa-users', 1),
(2, 'Manajemen Pasien', 'daftar_pasien', 'fas fa-hospital-user', 1),
(3, 'Manajemen Gejala', 'daftar_gejala', 'fas fa-table', 1),
(4, 'Manajemen Penyakit', 'daftar_penyakit', 'fas fa-viruses', 1),
(5, 'Manajemen Menu', 'daftar_menu', 'fas fa-bars', 1),
(7, 'Manajemen Relasi', 'daftar_relasi', 'fas fa-link', 1),
(8, 'Manajemen Bobot', 'daftar_bobot', 'fas fa-weight', 1),
(9, 'Manajemen Diagnosa', 'daftar_diagnosa', 'fas fa-stethoscope', 1);

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

--
-- Dumping data untuk tabel `bobot`
--

INSERT INTO `bobot` (`id`, `parameter`, `nilai`) VALUES
(1, 'Gejala Penting', 5),
(2, 'Gejala Sedang', 3),
(3, 'Gejala Biasa', 1);

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
(1, 'G01', 'Nyeri Perut', 'Nyeri perut adalah sensasi ketidaknyamanan atau nyeri yang terlokalisasi di daerah perut, yang dapat disebabkan oleh berbagai kondisi medis seperti gangguan pencernaan, infeksi, atau masalah pada organ-organ di sekitar perut.'),
(2, 'G02', 'Mual', ' Mual adalah sensasi tidak nyaman yang membuat ingin muntah, sering terjadi sebagai respons terhadap gangguan pencernaan, infeksi, atau efek samping dari obat-obatan.'),
(3, 'G03', 'Muntah', 'Muntah adalah proses pengosongan isi lambung melalui mulut, yang merupakan respons tubuh terhadap berbagai kondisi seperti infeksi, gangguan pencernaan, atau efek samping dari obat-obatan.'),
(4, 'G04', 'Sakit Tenggorokan', 'Sakit tenggorokan adalah kondisi di mana terjadi rasa nyeri, iritasi, atau ketidaknyamanan di tenggorokan, yang dapat disebabkan oleh infeksi virus, radang tenggorokan, alergi, atau iritasi akibat polusi udara atau asap rokok.'),
(5, 'G05', 'Demam', ' Demam adalah kondisi tubuh yang mengalami peningkatan suhu di atas normalnya, biasanya sebagai respon terhadap infeksi, peradangan, atau penyakit lainnya, di mana sistem kekebalan tubuh berusaha melawan agen penyebabnya.');

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
(3, '1', 'Marfel Crisly', 'Laki-Laki', '24');

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
(1, 'P01', 'GERD', 'Gastroesophageal Reflux Disease (GERD) adalah kondisi medis di mana asam lambung secara berulang naik ke dalam kerongkongan, menyebabkan gejala seperti mulas, sensasi terbakar di dada, dan dapat menyebabkan kerusakan pada kerongkongan akibat iritasi kronis.', 'Perawatan GERD sering kali melibatkan kombinasi dari perubahan gaya hidup, seperti menghindari makanan pedas dan berlemak, menyesuaikan pola makan, serta menggunakan obat-obatan seperti antasida, inhibitor pompa proton (PPI), atau obat antiasam untuk mengurangi produksi asam lambung dan meredakan gejala. Dalam kasus yang lebih parah, prosedur medis seperti pemasangan alat penghambat asam lambung (LINX) atau operasi juga dapat direkomendasikan oleh dokter untuk mengatasi kondisi ini secara efektif.', 'default.jpg'),
(2, 'P02', 'Gastritis ', '\r\nGastritis adalah kondisi medis yang ditandai oleh peradangan pada dinding lambung. Ini dapat terjadi ketika lapisan pelindung lambung rusak atau terganggu, yang memungkinkan asam lambung merusak dinding lambung. Beberapa faktor yang dapat menyebabkan gastritis meliputi infeksi bakteri Helicobacter pylori, konsumsi alkohol secara berlebihan, penggunaan obat-obatan nonsteroid antiinflamasi (NSAID), stres kronis, atau gangguan autoimun di mana sistem kekebalan tubuh menyerang sel-sel sehat dalam lambung. Gejalanya bervariasi dari ringan hingga parah, termasuk nyeri atau perih pada bagian atas perut, mual, muntah, gangguan pencernaan, atau pendarahan di saluran pencernaan. Pengobatan biasanya melibatkan perubahan gaya hidup seperti menghindari makanan atau minuman yang dapat memperburuk gejala, penggunaan obat-obatan untuk mengurangi produksi asam lambung, atau antibiotik untuk mengobati infeksi bakteri H. pylori. Penting untuk berkonsultasi dengan dokter untuk diagnosis dan penanganan y', '\r\nPerawatan gastritis tergantung pada penyebabnya dan tingkat keparahan gejalanya. Untuk kasus ringan, perawatan biasanya melibatkan perubahan gaya hidup seperti menghindari makanan pedas, asam, atau berlemak yang dapat memicu gejala, serta menghindari alkohol dan merokok. Penggunaan obat-obatan seperti antasida, penghambat reseptor H2, atau penghambat pompa proton dapat membantu mengurangi produksi asam lambung dan meredakan gejala. Jika gastritis disebabkan oleh infeksi bakteri H. pylori, terapi antibiotik mungkin diperlukan untuk menghilangkan infeksi. Penting juga untuk mengelola stres dan menjaga pola makan yang teratur. Dalam kasus gastritis yang lebih serius atau kronis, pemeriksaan lanjutan dan perawatan lebih lanjut oleh dokter atau spesialis pencernaan mungkin diperlukan. Adanya perawatan yang tepat dapat membantu mengendalikan gejala gastritis dan mencegah komplikasi yang lebih serius.', 'default.jpg'),
(3, 'P03', 'Tukak Lambung', 'Tukak lambung, juga dikenal sebagai ulkus peptikum, adalah luka atau kerusakan pada lapisan dalam dinding lambung atau bagian atas usus halus yang disebabkan oleh adanya kelebihan asam lambung dan infeksi bakteri Helicobacter pylori. Tukak lambung dapat menyebabkan nyeri abdomen, perut terasa kembung, mual, muntah, serta perdarahan yang dapat mengakibatkan tinja berwarna hitam atau terdapat darah pada muntahan.', 'Perawatan untuk tukak lambung bertujuan untuk mengurangi produksi asam lambung, melindungi lapisan lambung yang rusak, serta mempercepat penyembuhan luka. Ini sering melibatkan kombinasi dari obat-obatan dan perubahan gaya hidup. Dokter mungkin meresepkan obat antasid, inhibitor pompa proton (PPI), atau obat H2 blocker untuk mengurangi produksi asam lambung. Penggunaan antibiotik juga dapat direkomendasikan jika infeksi H. pylori hadir. Selain itu, perubahan gaya hidup seperti menghindari makanan pedas, berlemak, dan berbumbu, menghindari merokok dan konsumsi alkohol, serta mengurangi stres juga dapat membantu mempercepat penyembuhan tukak lambung. Dalam kasus yang parah atau jika terjadi komplikasi seperti perdarahan berat, intervensi medis seperti endoskopi untuk menghentikan perdarahan atau operasi mungkin diperlukan. Penting untuk berkonsultasi dengan dokter untuk diagnosis dan rencana perawatan yang tepat sesuai dengan kondisi individu.', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `id` int(11) NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `penyakit_id` int(11) NOT NULL,
  `kesamaan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `hasil_diagnosa`
--

INSERT INTO `hasil_diagnosa` (`id`, `pasien_id`, `penyakit_id`, `kesamaan`, `tanggal`) VALUES
(1, 3, 1, '0.8', '2024-03-25'),
(2, 3, 3, '0.42857142857143', '2024-03-25'),
(3, 3, 1, '1', '2024-03-25');

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
  `gjl_id` int(11) NOT NULL,
  `bobot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `relasi_gp`
--

INSERT INTO `relasi_gp` (`id`, `pyk_id`, `gjl_id`, `bobot_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 2),
(3, 2, 1, 2),
(4, 2, 3, 2),
(5, 3, 1, 2),
(6, 3, 4, 2),
(7, 3, 5, 3);

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
-- Indeks untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `pyk_id` (`pyk_id`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `data_gejala`
--
ALTER TABLE `data_gejala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_pasien`
--
ALTER TABLE `data_pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `data_penyakit`
--
ALTER TABLE `data_penyakit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `relasi_gp`
--
ALTER TABLE `relasi_gp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

--
-- Ketidakleluasaan untuk tabel `relasi_gp`
--
ALTER TABLE `relasi_gp`
  ADD CONSTRAINT `relasi_gp_ibfk_1` FOREIGN KEY (`pyk_id`) REFERENCES `data_penyakit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
