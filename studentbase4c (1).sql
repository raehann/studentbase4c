-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2024 at 06:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentbase4c`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_admin`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$fNWKABUve/WQZs2LbDd64eUEOrfjtxHdquyGAzkwZLZHXOk/LkT0G', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_log_aktivitas` int(11) NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `aktivitas` text NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal` date NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktivitas`
--

INSERT INTO `log_aktivitas` (`id_log_aktivitas`, `id_mahasiswa`, `id_admin`, `aktivitas`, `waktu`, `tanggal`, `ip`) VALUES
(12, NULL, 1, 'Login', '2024-05-26 01:02:42', '2024-05-26', '::1'),
(14, NULL, 1, 'Logout', '2024-05-26 01:08:12', '2024-05-26', '::1'),
(15, NULL, 1, 'Login', '2024-05-26 01:10:11', '2024-05-26', '::1'),
(16, NULL, 1, 'Login', '2024-05-26 01:45:11', '2024-05-26', '::1'),
(17, NULL, 1, 'Login', '2024-05-26 01:50:05', '2024-05-26', '::1'),
(18, NULL, 1, 'Logout', '2024-05-26 02:13:32', '2024-05-26', '::1'),
(19, NULL, 1, 'Login', '2024-05-26 02:13:36', '2024-05-26', '::1'),
(20, NULL, 1, 'Logout', '2024-05-26 02:18:40', '2024-05-26', '::1'),
(21, NULL, 1, 'Login', '2024-05-26 03:23:29', '2024-05-26', '::1'),
(22, NULL, 1, 'Logout', '2024-05-26 04:18:13', '2024-05-26', '::1'),
(25, NULL, 1, 'Login', '2024-05-26 04:18:32', '2024-05-26', '::1'),
(26, NULL, 1, 'Logout', '2024-05-26 04:18:47', '2024-05-26', '::1'),
(27, NULL, 1, 'Login', '2024-05-26 04:18:57', '2024-05-26', '::1'),
(28, NULL, 1, 'Logout', '2024-05-26 04:32:20', '2024-05-26', '::1'),
(29, NULL, 1, 'Login', '2024-05-26 04:32:26', '2024-05-26', '::1'),
(30, NULL, 1, 'Logout', '2024-05-26 05:21:08', '2024-05-26', '::1'),
(31, NULL, 1, 'Login', '2024-05-26 08:43:59', '2024-05-26', '::1'),
(32, NULL, 1, 'Logout', '2024-05-26 09:38:12', '2024-05-26', '::1'),
(33, NULL, 1, 'Login', '2024-05-26 10:37:09', '2024-05-26', '::1'),
(34, NULL, 1, 'Logout', '2024-05-26 11:45:46', '2024-05-26', '::1'),
(37, NULL, 1, 'Login', '2024-05-26 11:48:33', '2024-05-26', '::1'),
(38, NULL, 1, 'Logout', '2024-05-26 12:09:21', '2024-05-26', '::1'),
(41, NULL, 1, 'Login', '2024-05-26 12:16:34', '2024-05-26', '::1'),
(42, NULL, 1, 'Logout', '2024-05-26 12:36:59', '2024-05-26', '::1'),
(43, NULL, 1, 'Login', '2024-05-26 12:38:04', '2024-05-26', '::1'),
(44, NULL, 1, 'Logout', '2024-05-26 13:21:42', '2024-05-26', '::1'),
(47, NULL, 1, 'Login', '2024-05-26 13:22:34', '2024-05-26', '::1'),
(48, NULL, 1, 'Logout', '2024-05-26 13:23:11', '2024-05-26', '::1'),
(49, NULL, 1, 'Login', '2024-05-26 13:24:13', '2024-05-26', '::1'),
(50, NULL, 1, 'Logout', '2024-05-26 13:24:45', '2024-05-26', '::1'),
(51, NULL, 1, 'Login', '2024-05-26 13:25:37', '2024-05-26', '::1'),
(52, NULL, 1, 'Logout', '2024-05-26 13:45:32', '2024-05-26', '::1'),
(55, NULL, 1, 'Login', '2024-05-26 14:32:12', '2024-05-26', '::1'),
(56, NULL, 1, 'Logout', '2024-05-26 14:35:53', '2024-05-26', '::1'),
(61, NULL, 1, 'Login', '2024-05-26 14:42:51', '2024-05-26', '::1'),
(62, NULL, 1, 'Logout', '2024-05-26 14:45:51', '2024-05-26', '::1'),
(63, NULL, 1, 'Login', '2024-05-26 14:57:44', '2024-05-26', '::1'),
(64, NULL, 1, 'Logout', '2024-05-26 15:03:11', '2024-05-26', '::1'),
(67, NULL, 1, 'Login', '2024-05-27 00:38:24', '2024-05-27', '::1'),
(68, NULL, 1, 'Login', '2024-05-27 01:57:02', '2024-05-27', '::1'),
(69, NULL, 1, 'Logout', '2024-05-27 03:44:44', '2024-05-27', '::1'),
(70, NULL, 1, 'Login', '2024-05-27 03:45:26', '2024-05-27', '::1'),
(71, NULL, 1, 'Logout', '2024-05-27 04:09:12', '2024-05-27', '::1'),
(72, 28, NULL, 'Login', '2024-05-27 04:17:49', '2024-05-27', '::1'),
(73, 28, NULL, 'Logout', '2024-05-27 04:18:15', '2024-05-27', '::1'),
(74, NULL, 1, 'Login', '2024-05-27 04:22:27', '2024-05-27', '::1'),
(75, NULL, 1, 'Logout', '2024-05-27 04:23:06', '2024-05-27', '::1'),
(76, NULL, 1, 'Login', '2024-05-27 04:48:20', '2024-05-27', '::1'),
(77, NULL, 1, 'Logout', '2024-05-27 04:48:34', '2024-05-27', '::1'),
(78, NULL, 1, 'Login', '2024-05-27 04:54:34', '2024-05-27', '::1'),
(79, NULL, 1, 'Logout', '2024-05-27 04:54:51', '2024-05-27', '::1'),
(80, 42, NULL, 'Login', '2024-05-27 04:55:00', '2024-05-27', '::1'),
(81, 42, NULL, 'Logout', '2024-05-27 04:55:13', '2024-05-27', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(16) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `kesukaan` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mahasiswa`, `nama`, `nim`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `telepon`, `kesukaan`, `password`, `latitude`, `longitude`) VALUES
(24, 'Muhammad Azka Muzaki', '11220910000020', '2004-05-29', 'Laki-laki', 'Jalan Semanggi II', '081278236723', 'Motor Klasik', '$2y$10$ohRazGAaiRjAQqfvDNqez.o8hYdbUl58YBF2KBd5QeGf50WtGDzMi', '-6.309083679510154', '106.75358246757943'),
(25, 'Muhammad Farrel Reyes', '11220910000012', '2004-07-29', 'Laki-laki', 'Pondok Labu', '081282346812', 'Mobil Sport', '$2y$10$VUwxEAnVuknwauuv6ZV9Y.qv8YMVj0OeVIQMZPu1wafUxlJ9gQNKe', '-6.3046385', '106.7928998'),
(26, 'Rehan Eka Pradipta', '11220910000010', '2004-04-08', 'Laki-laki', 'Cilandak', '085723849245', 'Pegunungan', '$2y$10$lbq8SY8exGnuoDskhwDp8OLLo/OL4crrL09zEEkL2A0hJ4Oe9o5LC', '-6.2897982', '106.79692637055228'),
(27, 'Andika Pratama', '11220910000018', '2004-04-27', 'Laki-laki', 'Tanah Abang', '082167238734', 'Kucing', '$2y$10$31kCYnxl25gq5OuG4lUElusOAHfQkBSsyWFZJysbpKDf6lBln0Cl2', '-6.2041213', '106.8216106'),
(28, 'Raihan Ade Purnomo', '11220910000003', '2004-01-30', 'Laki-laki', 'Kota Depok', '081385321390', 'Mancing', '$2y$10$ThlcmQduoML1wrCHdC7rleCM1aXWGbOgbGe6lXr2qvWnNq8.ou.HW', '-6.40719', '106.8158371'),
(29, 'Kayla Nazelika', '11220910000109', '2004-06-11', 'perempuan', 'Cibinong', '081278236256', 'Menyanyi', '$2y$10$BivhoNAiP8/1I2c2uGMA/eDJ1TUViahte1BMnv.Nr/rtQxVrNoiqq', '-6.4803942', '106.8247344'),
(30, 'Fakhriyah Nabilah', '11220910000015', '2004-05-12', 'perempuan', 'Kemang', '081282346271', 'Piano', '$2y$10$eU3megSGKP.HOzf8QxPDoeC2zbKVlG0ytqT9GCnn7qr4Ys2OPDt6e', '-6.26721755', '106.81560586352285'),
(31, 'Renjiro Maheswara Pujo', '11220910000083', '2004-08-18', 'Laki-laki', 'Pasar Kemis', '085723849248', 'Touring', '$2y$10$aDDgtzC7Z4fMiwZeggkzY.rvWxqGdCGpcHGDC/SfBC2fCoS10w7Pm', '-6.1610033', '106.55981002853574'),
(32, 'Zalfa Syawlia', '11220910000073', '2004-06-27', 'perempuan', 'Ancol', '085723849221', 'Kucing', '$2y$10$0uihEV6zcVTVK17RNfl6geflbIfsZKi7pMBgvh1rQwHJiDKm8KBXK', '-6.12526195324374', '106.83621957621914'),
(33, 'Amin Kurniawan Akbar', '11220910000057', '2004-07-27', 'Laki-laki', 'Pondok Ranji', '081278236539', 'Fashion', '$2y$10$Pq6l/mgMCOib78qlaD/UHOMWkN6olHECxCRa73PFOA/GVqYACPm7O', '-6.2766831', '106.7446926'),
(34, 'Arif Darmawan', '11220910000072', '2004-07-27', 'Laki-laki', 'Palmerah', '081385321172', 'Berkuda', '$2y$10$eXo2z2LDmTWwjd/KPSaDPOIfNecTiZ3EBibiAbiDmIlAty0K3GJnO', '-6.201772902247786', '106.79044243665133'),
(35, 'Febrio Basili Syahman', '11220910000051', '2004-08-13', 'Laki-laki', 'Gang Melati', '085723841034', 'Berselancar', '$2y$10$kRDAnCRSE7zlxLRZOTI6OeQ.X0w.9jaUUtz46RuPS0kFORqvJ/xpy', '-6.312873600812925', '106.76407175313605'),
(36, 'Rajesh Avisena', '11220910000103', '2004-03-19', 'Laki-laki', 'Pulo Gadung', '081282346153', 'Bermain Bola', '$2y$10$FKtf3oYJzPDPkRNu6dBtv.2PmJVyl1a8oqHkv/.RwIgKpK7MG01o.', '-6.183358716501726', '106.90079919759704'),
(37, 'Bagus Rizki', '11220910000038', '2004-08-10', 'Laki-laki', 'Cipondoh', '081282346823', 'Pantai', '$2y$10$3BOpJSdgjUASvE1JG9bfWeleM4BRQNOjN4ryn76ieWBXTHCy6S9uC', '-6.191686988612317', '106.67552866835277'),
(38, 'Dede Latifa ', '11220910000029', '2004-05-11', 'perempuan', 'Bekasi', '081282342812', 'Menyanyi', '$2y$10$Xznt4rv5UFHE61S1Ecyorus5i.QaxHUbgBhm0hpmdOEHBpNPrlPD.', '-6.2349858', '106.9945444'),
(39, 'Choirul', '11220910000035', '2004-06-24', 'Laki-laki', 'Sudimara Barat', '085723848129', 'Kapal Laut', '$2y$10$23t4IsPx9hRIQCA6aJuwuewao2OkbvU28.Y1ezYhfDcw0uemXHSHW', '-6.231961212298285', '106.70305632250654'),
(40, 'Sulaiman Fikri', '11220910000118', '2004-02-27', 'Laki-laki', 'Mangga Dua', '081278236812', 'Sepatu', '$2y$10$PGntjCnm.xcmMZm21i9bpery32x5moyUMnxpKGVi5OrX32biw.Ha.', '-6.142159140379646', '106.82873905089286'),
(41, 'Muhammad Luthfi Hanif', '11220910000063', '2004-12-08', 'Laki-laki', 'Cakung Timur', '082167238253', 'Bersepeda', '$2y$10$iQwk7msmMLa9hlQZz6M2cugKvKFd8gksTzeNRouScCuhQIBkkTdD6', '-6.1730164547192485', '106.95565146390372'),
(42, 'Fathir Ridho', '11220910000027', '2004-05-12', 'Laki-laki', 'Grogol Utara', '081282347281', 'Topi', '$2y$10$vn7k6dvScLJp0e9mgiZbse0xEZOrMI8wx7NUrr1OmD9Kxa/vjACUi', '-6.217319501508315', '106.78701171723219'),
(43, 'Ahmad Rafiadly', '11220910000085', '2004-06-16', 'Laki-laki', 'Pluit', '085723849845', 'Risol', '$2y$10$.qeoSaRzzQYHiRr7BTw70e9dtpvVKpS1V9F7IyjOhKWfEBGRmpXSq', '-6.115669567319508', '106.78742456887684'),
(44, 'Rofi Fairuz', '11220910000077', '2004-02-27', 'Laki-laki', 'Cengkareng Barat', '085723845842', 'Mancing', '$2y$10$i0ZmlSIyPGIEd447UoVCvumjeHyYK0RVXG5RS3f6EqUg.mkTFFLtS', '-6.139872083960336', '106.72430174486276'),
(45, 'Naufaldi', '11220910000050', '2004-05-11', 'Laki-laki', 'Tanjung Duren', '081278236555', 'Menyanyi', '$2y$10$z0PPI7yjgt0XR5pdZCxbIusqmmm0vdsBNeMwyYTdXuQ/DNbbfCOWi', '-6.172470321040578', '106.78211722284692');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_log_aktivitas`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `fk_id_mahasiswa` (`id_mahasiswa`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_log_aktivitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD CONSTRAINT `fk_id_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE,
  ADD CONSTRAINT `log_aktivitas_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `mahasiswa` (`id_mahasiswa`),
  ADD CONSTRAINT `log_aktivitas_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `akun` (`id_admin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
