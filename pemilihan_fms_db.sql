-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2022 pada 13.25
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemilihan_fms_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(223) NOT NULL,
  `password` varchar(223) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `aktifkan_pemilihan` tinyint(1) NOT NULL DEFAULT 0,
  `maintenance` tinyint(1) NOT NULL DEFAULT 0,
  `site_name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_calon`
--

CREATE TABLE `tbl_calon` (
  `id` int(11) NOT NULL,
  `nama_calon` varchar(100) DEFAULT NULL,
  `total_suara` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `foto_calon` varchar(122) DEFAULT NULL,
  `no_calon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_calon`
--

INSERT INTO `tbl_calon` (`id`, `nama_calon`, `total_suara`, `description`, `foto_calon`, `no_calon`) VALUES
(19, 'Ahmad Kun', '', '           &lt;div class=&quot;visi&quot;&gt;\r\n            &lt;h4&gt;VISI&lt;/h4&gt;\r\n            &lt;p&gt;Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est eaque nesciunt dolore repellendus adipisci quod dignissimos beatae labore, quae, amet esse nemo expedita dolores itaque.&lt;/p&gt;\r\n          &lt;/div&gt;\r\n          &lt;ul class=&quot;misi mt-3&quot;&gt;\r\n            &lt;h4&gt;MISI&lt;/h4&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n          &lt;/ul&gt;\r\n        ', 'content/image/74941bc1258b6fd38a9e1a4a38da5d0e.jpg', 1),
(20, 'Dadan Hidayat', '', '           &lt;div class=&quot;visi&quot;&gt;\r\n            &lt;h4&gt;VISI&lt;/h4&gt;\r\n            &lt;p&gt;Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est eaque nesciunt dolore repellendus adipisci quod dignissimos beatae labore, quae, amet esse nemo expedita dolores itaque.&lt;/p&gt;\r\n          &lt;/div&gt;\r\n          &lt;ul class=&quot;misi mt-3&quot;&gt;\r\n            &lt;h4&gt;MISI&lt;/h4&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n          &lt;/ul&gt;\r\n        ', 'content/image/30a7229cb2a5f39274f3fb3a60635d23.jpg', 2),
(21, 'dadan', '', '           &lt;div class=&quot;visi&quot;&gt;\r\n            &lt;h4&gt;VISI&lt;/h4&gt;\r\n            &lt;p&gt;Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est eaque nesciunt dolore repellendus adipisci quod dignissimos beatae labore, quae, amet esse nemo expedita dolores itaque.&lt;/p&gt;\r\n          &lt;/div&gt;\r\n          &lt;ul class=&quot;misi mt-3&quot;&gt;\r\n            &lt;h4&gt;MISI&lt;/h4&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n            &lt;li&gt;Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?&lt;/li&gt;\r\n          &lt;/ul&gt;\r\n        ', 'content/image/01d0723f1d40de3501cf50d0ad8222a6.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kotak_suara`
--

CREATE TABLE `tbl_kotak_suara` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `pilihan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kotak_suara`
--

INSERT INTO `tbl_kotak_suara` (`id`, `user_id`, `pilihan`) VALUES
(51, '1', '1'),
(52, '3', '3'),
(53, '5', '2'),
(54, '10', '3'),
(55, '8', '2'),
(56, '6', '3'),
(57, '36', '3'),
(58, '11', '3'),
(59, '7', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peserta_pemilihan`
--

CREATE TABLE `tbl_peserta_pemilihan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `waktu_submit` varchar(122) NOT NULL,
  `sudah_memilih` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_peserta_pemilihan`
--

INSERT INTO `tbl_peserta_pemilihan` (`id`, `nama`, `token`, `waktu_submit`, `sudah_memilih`) VALUES
(1, 'Dadan Hidayat(XII-RPL-10)', 'qbrbGK1', '1668441165', 1),
(3, 'Gwen Rosy Vanigara(XII-RPL-10)', 'DIGtKL3', '1668511961', 1),
(5, 'indra hermawan(XII-RPL-4)', 'tYVLc55', '1668512133', 1),
(6, 'Yayan Ruhian(GURU)', 'nnvMOn6', '1668513731', 1),
(7, 'Rafly Firmansyah(XII-RPL-1)', 'uiSIna7', '1668595072', 1),
(8, 'Metha Ilyasa(xii-rpl-12)', 'Got8HP8', '1668512431', 1),
(9, 'erwan(XII-RPL-10)', 'WYEdnc9', '', 0),
(10, 'Asep Tatang Suryana(Wakasek)', 'kunyhy10', '1668512370', 1),
(11, 'Dadan Hidayat', 'apsJyn11', '1668595017', 1),
(12, 'Gwen Rosi Vanigara', 'cMCkmr12', '', 0),
(13, 'Elon Musk', 'n3mbEC13', '', 0),
(14, 'Asep Jebred', 'TsSxcT14', '', 0),
(15, 'Ujang Magrib', 'sSirPy15', '', 0),
(16, 'Agung Hapsah', 'tfPSBo16', '', 0),
(17, 'Dadan Hidayat', 'SaSDmK17', '', 0),
(18, 'Gwen Rosi Vanigara', 'yJKeZz18', '', 0),
(19, 'Elon Musk', 'uwrour19', '', 0),
(20, 'Asep Jebred', 'HJsRpe20', '', 0),
(21, 'Ujang Magrib', 'SsaiOs21', '', 0),
(22, 'Agung Hapsah', 'btMMmZ22', '', 0),
(23, 'Dadan Hidayat', 'SNmVDi23', '', 0),
(24, 'Gwen Rosi Vanigara', 'oWieaM24', '', 0),
(25, 'Elon Musk', 'fdxZOX25', '', 0),
(26, 'Asep Jebred', 'nljJAu26', '', 0),
(27, 'Ujang Magrib', 'srcyzg27', '', 0),
(28, 'Agung Hapsah', 'bHBHvh28', '', 0),
(29, 'Dadan Hidayat(X-RPL-1)', 'yCTZnn29', '', 0),
(30, 'Gwen Rosi Vanigara(XI-RPL-2)', 'uunoMw30', '', 0),
(31, 'Elon Musk(XII-RPL-3)', 'CPzqCC31', '', 0),
(32, 'Asep Jebred(X-MM-1)', 'OmKSba32', '', 0),
(33, 'Ujang Magrib(XI-MM-2)', 'XxzyEI33', '', 0),
(34, 'Agung Hapsah(XII-MM-3)', 'rVJGba34', '', 0),
(35, 'Budi Doremi Yahaha(X-RPL-1)', 'GQoBvs35', '', 0),
(36, 'Mega Chan(XI-RPL-2)', 'gQHzkC36', '1668594377', 1),
(37, 'Yayan Ruhiyan(X-RPL-1)', 'Hhlnge37', '', 0),
(38, 'Dian Maghrib(XII-MM-3)', 'XfJVJI38', '', 0),
(39, 'Dadan Hidayat,S.TI,M.KOM(GURU)', 'EMsTVo39', '', 0),
(40, 'Prof Gwen Rosi Vanigara, S.S,M.KOM(STAFF TU)', 'oSb0Uv40', '', 0),
(41, 'H. Rafly(WAKASEK)', 'ORcpEf41', '', 0),
(42, 'Deri Darajat(Kepala Sekolah)', 'CRuDpB42', '', 0),
(43, 'Dadang Yahya(GURU)', 'Jsarso43', '', 0),
(44, 'Upin(GURU)', 'mucRqd44', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_calon`
--
ALTER TABLE `tbl_calon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_calon` (`no_calon`);

--
-- Indeks untuk tabel `tbl_kotak_suara`
--
ALTER TABLE `tbl_kotak_suara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_peserta_pemilihan`
--
ALTER TABLE `tbl_peserta_pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_calon`
--
ALTER TABLE `tbl_calon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_kotak_suara`
--
ALTER TABLE `tbl_kotak_suara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `tbl_peserta_pemilihan`
--
ALTER TABLE `tbl_peserta_pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
