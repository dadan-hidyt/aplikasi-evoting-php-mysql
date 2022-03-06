-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2022 at 07:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(223) NOT NULL,
  `password` varchar(223) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'webadminicso1@icso.my.id', 'indonesiamerdeka1945');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calon`
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
-- Dumping data for table `tbl_calon`
--

INSERT INTO `tbl_calon` (`id`, `nama_calon`, `total_suara`, `description`, `foto_calon`, `no_calon`) VALUES
(15, 'abdurahman Jodi', '', '                                                                                                                                                                                                               <div class=\"visi\">\r\n            <h4>VISI</h4>\r\n            <p>Menjadikan rakyat sengsara dan rakyat menderita, Saya akan korupsi bansos! wwkwkkwkwwwwwww</p>\r\n          </div>\r\n          <ul class=\"misi mt-3\">\r\n            <h4>MISI</h4>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n          </ul>\r\n                                                                                                                                                                                ', 'content/image/f7f906cab1c15fae654cdbcdd4552af2-update.jpg', 1),
(16, 'Putin, S.kom', '', '                                                                   <div class=\"visi\">\r\n            <h4>VISI</h4>\r\n            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est eaque nesciunt dolore repellendus adipisci quod dignissimos beatae labore, quae, amet esse nemo expedita dolores itaque.</p>\r\n          </div>\r\n          <ul class=\"misi mt-3\">\r\n            <h4>MISI</h4>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n            <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Illum, perspiciatis inventore. Nostrum, iste nisi dolor aperiam temporibus officia praesentium! Explicabo?</li>\r\n          </ul>\r\n                                                        ', 'content/image/5fa3230dfbd27b343355d261407eb5e5-update.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kotak_suara`
--

CREATE TABLE `tbl_kotak_suara` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `pilihan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_peserta_pemilihan`
--

CREATE TABLE `tbl_peserta_pemilihan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `token` varchar(100) NOT NULL,
  `waktu_submit` varchar(122) NOT NULL,
  `sudah_memilih` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_peserta_pemilihan`
--

INSERT INTO `tbl_peserta_pemilihan` (`id`, `nama`, `token`, `waktu_submit`, `sudah_memilih`) VALUES
(28, 'Putra Karina', 'aTuNmV28', '', 0),
(30, 'Muhamad Hamdan saeful', 'GUEGXP30', '', 0),
(31, 'Ramadhan(MPK)', 'adimpd31', '', 0),
(32, 'andri firmansyah', 'iYyPYa32', '', 0),
(33, 'rangga sasana', 'riRJiA33', '', 0),
(34, 'kardun', '3EIKuS34', '', 0),
(37, 'muhamadRafly', 'Hs7amZ37', '', 0),
(38, 'Upin Dan IPIN', 'laBROP38', '', 0),
(39, 'dadan hidayat', 'JvdeWE39', '', 0),
(40, 'algiansyah', 'rhZQy040', '', 0),
(41, 'Muhamad hanif hidayat xi-10 can you send ka', 'sutdaR41', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_calon` (`no_calon`);

--
-- Indexes for table `tbl_kotak_suara`
--
ALTER TABLE `tbl_kotak_suara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_peserta_pemilihan`
--
ALTER TABLE `tbl_peserta_pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_calon`
--
ALTER TABLE `tbl_calon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_kotak_suara`
--
ALTER TABLE `tbl_kotak_suara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_peserta_pemilihan`
--
ALTER TABLE `tbl_peserta_pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
