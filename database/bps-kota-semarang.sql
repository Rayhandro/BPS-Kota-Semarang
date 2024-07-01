-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 05:05 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bps-kota-semarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipe_form` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kegiatan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `jam_pelaksanaan` time DEFAULT NULL,
  `jam_kembali` time DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latlong` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `id_user`, `tipe_form`, `id_kegiatan`, `tanggal`, `jam_keluar`, `jam_pelaksanaan`, `jam_kembali`, `foto`, `latlong`, `created_at`) VALUES
(48, 2, 'keluar', 1, '2024-06-05', '07:00:00', '09:00:00', '11:00:00', NULL, NULL, '2024-07-01 02:53:30'),
(49, 2, 'pelaksanaan', 1, '2024-06-05', '07:00:00', NULL, NULL, NULL, NULL, '2024-06-27 06:34:40'),
(50, 3, 'keluar', 2, '2024-06-06', '12:00:00', NULL, NULL, NULL, NULL, '2024-06-27 06:44:01'),
(52, 4, 'keluar', 7, '2024-07-01', NULL, NULL, NULL, '', '-6.9858926,110.4150487', '2024-07-01 03:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kegiatan`
--

CREATE TABLE `tbl_kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `keluar` tinyint(4) NOT NULL DEFAULT '0',
  `pelaksanaan` tinyint(4) NOT NULL DEFAULT '0',
  `kembali` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kegiatan`
--

INSERT INTO `tbl_kegiatan` (`id_kegiatan`, `nama_kegiatan`, `id_user`, `keluar`, `pelaksanaan`, `kembali`) VALUES
(1, 'ngopi', 2, 1, 1, 1),
(2, 'jalan', 3, 1, 0, 0),
(3, '12', 0, 0, 0, 0),
(4, 'belajar', 4, 1, 0, 0),
(5, 'mgocok', 3, 1, 0, 0),
(6, 'mgocok', 3, 1, 0, 0),
(7, 'belajar', 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama_pegawai`, `password`, `role`) VALUES
(2, 'Hendra', 'Hendra s', '$2y$10$ViZu0iUP8BthBk7JzLpFnuTxh21npmFRIIEnu00IxwbTgwmJ2mnCW', 'staff'),
(3, 'Admin', 'Administrator', '$2y$10$eHId2q5xOpQpULczbCRekeMDHQmtJnEwtskAxTUh4W9gg5OE6h89G', 'admin'),
(4, 'Rizky', 'Rizky Gumelar', '$2y$10$snrmio/HqjxuXJOyFbl43er04/57JGw4/.ILfQZQnfP81fO00SxfC', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Activity_id_user_fkey` (`id_user`);

--
-- Indexes for table `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `Activity_id_user_fkey` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
