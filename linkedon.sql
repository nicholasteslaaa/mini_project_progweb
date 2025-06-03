-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2025 at 09:37 AM
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
('k@gmail.com', '123', 'nicsap', '.', '0123-03-12', '1231', 'images//1740260298.jpg', 'client'),
('k@gmail.com', '123', 'nicsap', '.', '0123-03-12', '1231', 'images//1740260298.jpg', 'client'),
('O@gmail.com', '123', 'ANJAY', 'mabar', '2025-06-09', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images//1748878436.jpeg', 'client'),
('m@gmail.com', '123', 'ANJAY', 'mabar', '2025-06-09', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images//1748878531.', 'client'),
('nm@gmail.com', '123', 'ANJAY', 'mabar', '2025-06-09', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', '', 'client'),
('k1@gmail.com', '123', 'ANJAY', 'mabar', '2025-06-09', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images/1748878754.jpeg', 'client');

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

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`_email`, `_password`, `_namaPerusahaan`, `_tanggalBerdiri`, `_alamat`, `_pictpath`, `_user_type`) VALUES
('p@gmail.com', '123', 'pp', '0222-02-22', '123', 'images//1740161229.png', 'Company'),
('GusFring@gmail.com', '123', 'Los Polos Hermanos', '2009-01-20', '4275 Isleta Boulevard SW in Albuquerque, New Mexic', 'images//1746043967.png', 'Company');

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

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`_nama`, `_alamat`, `_noTelp`, `_tanggalLahir`, `_email`, `_gender`, `_cv`, `_namaPerusahaan`, `_job`) VALUES
('Christian nicholas saputra', 'jl sultan agun 10c', '088226843164', '2005-09-22', 'christian.nicholas@ti.ukdw.ac.id', 'Laki-laki', '', 'PT.  Pencari Cinta Sejati', 'Software Engineer'),
('nicsap .', '123', '123', '0312-03-12', 'k@gmail.com', 'Laki-laki', 'pdf/1740313104.pdf', 'pp', 'Network Engineer'),
('nicsap .', 'jln mawar', '123', '0222-02-22', 'k@gmail.com', 'Laki-laki', 'pdf/1746049242.pdf', 'Los Polos Hermanos', ''),
('nicsap .', 'jln mawar', '123', '0222-02-22', 'k@gmail.com', 'Laki-laki', 'pdf/1746049294.pdf', 'Los Polos Hermanos', 'Chemist');

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

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`_deskripsi`, `_kualifikasi`, `_namaPerusahaan`, `_gaji`, `_gajiPer`, `_pictpath`, `_deadline`, `_alamat`, `_tipe`, `_job`, `_jobKategori`, `_keuntungan`) VALUES
('Mengembangkan dan memelihara aplikasi web. Bekerja sama dengan tim untuk merancang solusi teknologi. Menganalisis dan memperbaiki bug dalam sistem.', 'Pendidikan minimal S1 Teknik Informatika atau setara. Pengalaman minimal 2 tahun dalam pengembangan perangkat lunak. Menguasai HTML, CSS, JavaScript, dan framework terkait.', 'PT.  Pencari Cinta Sejati', 8000000, 'bulan', '../Images/2842680.jpg', '28 Februari 2025', 'Jakarta, Indonesia', 'Full Time', 'Software Engineer', NULL, 'Asuransi kesehatan, tunjangan makan, dan bonus tahunan.'),
('a', 'a', 'pp', 1, 'Hari', '../Images/1746043689.png', '2222-02-22', 'jln pati', 'Full Time', 'a', NULL, 'a'),
('Perusahaan kami membutuhkan Chemist untuk membuatkan kita garam cina atau methamphatemine', 'minimal S2 teknik kimia, kimia, atau sejalur', 'Los Polos Hermanos', 100000000, 'Hari', '../Images/1746047730.jpg', '2222-02-22', 'new mexico', 'Full Time', 'Chemist', 'Science', 'Bonus 3 kali lipat per 3 bulan'),
('Kami membutuhkan asisten lab yang siap untuk di perintah', 'tamatan SMA,S1, atau sederajat', 'Los Polos Hermanos', 100000000, 'Hari', '../Images/1746048018.jpg', '2222-02-22', 'new mexico', 'Full Time', 'Lab Assistant', 'Science', '50/50 dengan partner'),
('Dicari karyawan yang dapat membunuh target dengan rapi dan bersih, siap di perintah dan mampu untuk mencari informasi tanpa ketahuan.', 'Pernah menjadi polisi, tentara, agen negara, atau sejalur.', 'Los Polos Hermanos', 100000000, 'Hari', '../Images/1746048111.jpeg', '2222-02-22', 'new mexico', 'Full Time', 'Hitman', 'Security', 'Mendapatkan bonus setiap penjualan, relasi yang sangat amat luas.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
