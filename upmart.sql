-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2018 at 04:49 PM
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
-- Database: `upmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url_gambar` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `harga` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `kategori` int(1) NOT NULL,
  `terjual` int(10) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `id_toko` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `url_gambar`, `deskripsi`, `harga`, `stok`, `kategori`, `terjual`, `tanggal`, `waktu`, `id_toko`) VALUES
(5, 'barnag barudateng', '../../assets/product/wYIhUeLBJr.jpeg', 'dimana pun ada barang pasti laris ', 190903, 24, 1, 0, '18-05-2018', '16:46:23', 45);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(1) NOT NULL,
  `hp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fax` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `google` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `hp`, `email`, `fax`, `fb`, `google`, `twitter`) VALUES
(0, '085822333459', 'up-mart@gmail.com', '022213144', 'facebook.com', 'plus.google.com', 'twitter.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `email` varchar(100) NOT NULL,
  `profil_url` varchar(100) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_handphone` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jumlah_saldo` int(10) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`email`, `profil_url`, `nama_lengkap`, `no_handphone`, `password`, `alamat`, `jumlah_saldo`, `status`) VALUES
('hhizari@gmail.com', '../../assets/user/UzmsjdPGwd.jpeg', 'Hudio Hizari', '085822333459', '1619d7adc23f4f633f11014d2f22b7d8', 'alamat baru dengan tambahan', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `percakapan`
--

CREATE TABLE `percakapan` (
  `id_percakapan` int(10) NOT NULL,
  `isi` varchar(100) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `email_pengirim` varchar(100) NOT NULL,
  `email_penerima` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `percakapan`
--

INSERT INTO `percakapan` (`id_percakapan`, `isi`, `tanggal`, `waktu`, `email_pengirim`, `email_penerima`) VALUES
(9, 'sd', '18-05-2018', '15:35:05', 'hhizari@gmail.com', 'hhizari@gmail.com'),
(10, 'p', '18-05-2018', '15:35:23', 'hhizari@gmail.com', 'hhizari@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(10) NOT NULL,
  `tanggal` varchar(100) NOT NULL,
  `waktu` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jumlah` int(4) NOT NULL,
  `catatan` varchar(100) DEFAULT NULL,
  `email_pembeli` varchar(100) NOT NULL,
  `id_barang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesan_saldo`
--

CREATE TABLE `pesan_saldo` (
  `id_pesan_saldo` int(10) NOT NULL,
  `nominal` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `url_bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status_pesanan` int(1) NOT NULL,
  `email_pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan_saldo`
--

INSERT INTO `pesan_saldo` (`id_pesan_saldo`, `nominal`, `harga`, `url_bukti_pembayaran`, `status_pesanan`, `email_pemilik`) VALUES
(1, 50000, 52000, '../../assets/PoP/VSpWVDsGja.jpeg', 1, 'hhizari@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `profil_url` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `email_pemilik` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama`, `profil_url`, `alamat`, `status`, `email_pemilik`) VALUES
(45, 'toko baru', '../../assets/store/LZvUipXksH.jpeg', 'lamat baru ygn langka', 'janda', 'hhizari@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_toko_fk` (`id_toko`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `percakapan`
--
ALTER TABLE `percakapan`
  ADD PRIMARY KEY (`id_percakapan`),
  ADD KEY `fk_email_pengirim` (`email_pengirim`),
  ADD KEY `fk_email_penerima` (`email_penerima`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_email_pembeli` (`email_pembeli`),
  ADD KEY `fk_id_barang` (`id_barang`);

--
-- Indexes for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  ADD PRIMARY KEY (`id_pesan_saldo`),
  ADD KEY `fk_email_pemilik` (`email_pemilik`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`),
  ADD KEY `email_pemilik_fk` (`email_pemilik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `percakapan`
--
ALTER TABLE `percakapan`
  MODIFY `id_percakapan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  MODIFY `id_pesan_saldo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `id_toko_fk` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `percakapan`
--
ALTER TABLE `percakapan`
  ADD CONSTRAINT `fk_email_penerima` FOREIGN KEY (`email_penerima`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_email_pengirim` FOREIGN KEY (`email_pengirim`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `fk_email_pembeli` FOREIGN KEY (`email_pembeli`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_barang` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesan_saldo`
--
ALTER TABLE `pesan_saldo`
  ADD CONSTRAINT `fk_email_pemilik` FOREIGN KEY (`email_pemilik`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `email_pemilik_fk` FOREIGN KEY (`email_pemilik`) REFERENCES `pengguna` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
