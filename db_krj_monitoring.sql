-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 08:15 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `db_krj_monitoring`
--
CREATE DATABASE IF NOT EXISTS `db_krj_monitoring` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_krj_monitoring`;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `id_pohon` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `jenis_tindakan` varchar(100) NOT NULL,
  `catatan` text DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `tanggal_lapor` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `id_pohon`, `id_petugas`, `jenis_tindakan`, `catatan`, `tanggal_lapor`) VALUES
(1, 1, 2, 'Penyiraman', 'Penyiraman rutin dilakukan karena cuaca panas.', '2025-10-13 02:00:00'),
(2, 3, 2, 'Pemeriksaan Rutin', 'Tidak ditemukan gejala serangan hama.', '2025-10-10 06:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `trees`
--

CREATE TABLE `trees` (
  `id` int(11) NOT NULL,
  `id_pohon_unik` varchar(20) NOT NULL,
  `nama_umum` varchar(100) NOT NULL,
  `nama_ilmiah` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `emoji` varchar(10) DEFAULT '🌳'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trees`
--

INSERT INTO `trees` (`id`, `id_pohon_unik`, `nama_umum`, `nama_ilmiah`, `deskripsi`, `emoji`) VALUES
(1, 'KRJ-001', 'Terminalia Catappa', 'Terminalia Catappa', 'Pohon tepi pantai yang rindang.', '🌳'),
(2, 'KRJ-002', 'Parkia Timoriana', 'Parkia Timoriana', 'Pohon kayu besar, bijinya untuk obat.', '🌲'),
(3, 'KRJ-003', 'Maniltoa Grandiflora', 'Maniltoa Grandiflora', 'Tumbuhan obat gangguan pencernaan.', '🌴');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `peran` enum('Admin','Petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `peran`) VALUES
(1, 'Admin Utama', 'admin', '123', 'Admin'),
(2, 'Petugas Lapangan A', 'petugas', '123', 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pohon` (`id_pohon`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pohon_unik` (`id_pohon_unik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trees`
--
ALTER TABLE `trees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`id_pohon`) REFERENCES `trees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;