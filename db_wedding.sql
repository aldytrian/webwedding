-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 12:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_katalog`
--

CREATE TABLE `tb_katalog` (
  `id_katalog` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_katalog`
--

INSERT INTO `tb_katalog` (`id_katalog`, `nama`, `harga`, `foto`, `detail`) VALUES
(2, 'Dekorasi Akad Nikah', 1000000, 'RjZxMLfYPt6U8vII7lEx.jpg', '                        Dekorasi akad nikah menjadi momen penting dalam perjalanan cinta Anda. Biarkan kami mempercantik ruang akad dengan sentuhan dekorasi yang elegan dan menyentuh hati. Dari hiasan bunga segar yang indah hingga nuansa warna yang hangat, setiap detail diatur dengan teliti untuk menciptakan suasana yang intim dan berkesan. Kami menawarkan berbagai tema dekorasi yang dapat disesuaikan dengan gaya dan visi Anda, sehingga Anda dapat menghadirkan akad nikah impian dengan sempurna.                                                                                                                      '),
(3, 'Dekorasi Wedding', 4000000, 'VcIJmxYY0lcnBKJRJIlI.jpg', '                        Hiasi acara pernikahan Anda dengan dekorasi yang elegan dan memukau. Kami menyediakan berbagai tema dekorasi, mulai dari rustic hingga glamor, untuk menciptakan atmosfer yang sempurna.                                      '),
(4, 'Catering', 1000000, 'p6KoJFTUFQxqLadeyBYh.jpg', 'Nikmati hidangan istimewa dari menu katering kami yang dikurasi dengan hati-hati. Dari hidangan tradisional hingga masakan internasional, setiap hidangan disiapkan menggunakan bahan-bahan segar dan berkualitas tinggi. Kami tidak hanya menyediakan makanan yang lezat, tetapi juga memberikan pelayanan yang profesional dan ramah untuk memastikan bahwa setiap tamu merasakan kepuasan yang tiada tara.                             '),
(5, 'Fotografi dan Videografi', 2000000, '241oyxiAzAYNvOQfxzor.jpg', ' Abadikan momen-momen berharga dari hari pernikahan Anda dengan layanan fotografi dan videografi kami. Tim profesional kami tidak hanya mengambil foto-foto indah, tetapi juga menangkap emosi dan cerita di balik setiap momen. Dengan hasil akhir yang artistik dan berkualitas tinggi, album foto pernikahan Anda akan menjadi kenangan yang berharga sepanjang hidup.            '),
(6, 'Make Up Artist', 1000000, '1L7Kga0EQEzfpNfbXKBb.jpg', '                        Dapatkan layanan rias terbaik untuk memastikan Anda tampil memukau di hari spesial Anda. Kami bekerja sama dengan penata rias profesional. Dari riasan natural yang elegan, mewah dan modern, setiap detail riasan akan memastikan Anda tampil memukau di hari istimewa Anda.                   ');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nomor_telepon` double DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tanggal_acara` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `bukti_transfer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `nama`, `nomor_telepon`, `email`, `tanggal_acara`, `alamat`, `bukti_transfer`) VALUES
(1, 'aldy', 82213042720, 'prayogi840@gmail.com', '2024-06-14', 'lembah', 'pUw9xlZMNAkd3tSCEr3V.jpg'),
(2, 'coba aldy', 12334445, 'coba@gmail.com', '2024-06-29', 'Depok', 'xzIp3SuGPgeLYu09M2AI.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(4) NOT NULL,
  `username` varchar(8) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$RXh0cdexCSgSA7Fz7I1V9.xYFUubFyGjyrCJoxTV2RLm55i9RrLDu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD PRIMARY KEY (`id_katalog`),
  ADD KEY `nama` (`nama`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_katalog`
--
ALTER TABLE `tb_katalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
