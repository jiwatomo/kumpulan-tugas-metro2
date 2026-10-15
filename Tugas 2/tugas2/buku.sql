-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: MyDatabaseGua:3306
-- Generation Time: Oct 15, 2026 at 06:05 AM
-- Server version: 12.3.3-MariaDB
-- PHP Version: 8.3.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Tugas2mentee`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `kategori` enum('Sejarah','Teknologi','MIPA','Ekonomi','Hukum') NOT NULL DEFAULT 'Sejarah',
  `isbn_doi` varchar(100) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `penerbit` varchar(250) DEFAULT NULL,
  `pengarang` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul`, `tahun_terbit`, `kategori`, `isbn_doi`, `lokasi`, `created_at`, `updated_at`, `penerbit`, `pengarang`) VALUES
(2, 'Fisika Quantum', '2020', 'MIPA', 'jfnj3jhu4n3ih3imn435', 'kanan mu', '2026-10-14 22:08:41', '2026-10-15 05:57:16', 'PT BEST', 'Si Anton'),
(4, 'Kalkulus untuk sekolah dasar', '1999', 'MIPA', 'HidupJokowi', 'Rak 4, baris 3', '2026-10-14 23:50:36', '2026-10-15 04:32:56', 'PT. BEST', 'Ibubakdi'),
(5, 'Teori Relativitas untuk Taman Kanak kanak', '2006', 'MIPA', 'AntechAntechAseng', 'Rak 4, Baris 2', '2026-10-14 23:53:53', '2026-10-15 04:32:56', 'PT. BEST', 'Jokowi'),
(6, 'Bilangan Imaginer Kelas 2', '2000', 'MIPA', 'OrangSolo21', 'Rak 1, Baris 1', '2026-10-14 23:57:08', '2026-10-15 04:32:56', 'PT. BEST', 'Aristoteles'),
(7, 'Persiapan Ujian Masuk Sekolah Dasar', '2021', 'MIPA', '####', 'Lobby', '2026-10-14 23:59:06', '2026-10-15 04:32:56', 'PT. BEST', 'Socrates');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_buku_isbn_doi` (`isbn_doi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
