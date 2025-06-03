-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 04:40 PM
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
-- Database: `linkedon`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `_email` varchar(50) DEFAULT NULL,
  `_password` varchar(50) DEFAULT NULL,
  `_namadepan` varchar(50) DEFAULT NULL,
  `_namabelakang` varchar(50) DEFAULT NULL,
  `_tanggallahir` varchar(50) DEFAULT NULL,
  `_alamat` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_user_type` enum('company','client') CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`_email`, `_password`, `_namadepan`, `_namabelakang`, `_tanggallahir`, `_alamat`, `_pictpath`, `_user_type`) VALUES
('k@gmail.com', '123', 'ANJAY', 'mabar', '2025-06-09', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images/1748961305.png', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `_email` varchar(50) DEFAULT NULL,
  `_password` varchar(50) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_tanggalBerdiri` varchar(50) DEFAULT NULL,
  `_alamat` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_user_type` enum('Company','Employee') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `_nama` varchar(50) DEFAULT NULL,
  `_alamat` varchar(100) DEFAULT NULL,
  `_noTelp` varchar(15) DEFAULT NULL,
  `_tanggalLahir` varchar(15) DEFAULT NULL,
  `_email` varchar(50) DEFAULT NULL,
  `_gender` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `_cv` varchar(100) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_job` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `_deskripsi` varchar(500) DEFAULT NULL,
  `_kualifikasi` varchar(500) DEFAULT NULL,
  `_namaPerusahaan` varchar(50) DEFAULT NULL,
  `_gaji` int(11) DEFAULT NULL,
  `_gajiPer` varchar(50) DEFAULT NULL,
  `_pictpath` varchar(50) DEFAULT NULL,
  `_deadline` varchar(50) DEFAULT NULL,
  `_alamat` varchar(100) DEFAULT NULL,
  `_tipe` enum('Full Time','Part Time') DEFAULT NULL,
  `_job` varchar(100) DEFAULT NULL,
  `_jobKategori` varchar(50) DEFAULT NULL,
  `_keuntungan` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
