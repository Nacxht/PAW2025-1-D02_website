-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 12:33 PM
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
-- Database: `ppdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calon_siswa`
--

CREATE TABLE `calon_siswa` (
  `id_calon_siswa` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id_orang_tua` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_pekerjaan` varchar(30) DEFAULT NULL,
  `pekerjaan` varchar(30) DEFAULT NULL,
  `pendapatan` int(11) NOT NULL,
  `jenis_orang_tua` enum('ayah','ibu','wali') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id_pendaftaran` int(11) NOT NULL,
  `id_calon_siswa` int(11) NOT NULL,
  `id_orang_tua` int(11) NOT NULL,
  `nik` char(16) NOT NULL,
  `jenis_kelamin` enum('l','p') NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `akta_kelahiran` varchar(100) NOT NULL,
  `kartu_keluarga` varchar(100) NOT NULL,
  `rapor` varchar(100) NOT NULL,
  `surat_keterangan_lulus` varchar(100) NOT NULL,
  `surat_kesehatan` varchar(100) NOT NULL,
  `pasfoto` varchar(100) NOT NULL,
  `persetujuan_tidak_membawa_hp` enum('true','false') NOT NULL,
  `persetujuan_asrama` enum('true','false') NOT NULL,
  `status` enum('tertunda','diterima','ditolak') NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  ADD PRIMARY KEY (`id_calon_siswa`);

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id_orang_tua`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`),
  ADD KEY `pendaftaran_ibfk_1` (`id_calon_siswa`),
  ADD KEY `id_orang_tua` (`id_orang_tua`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calon_siswa`
--
ALTER TABLE `calon_siswa`
  MODIFY `id_calon_siswa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id_orang_tua` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_calon_siswa`) REFERENCES `calon_siswa` (`id_calon_siswa`),
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_orang_tua`) REFERENCES `orang_tua` (`id_orang_tua`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
