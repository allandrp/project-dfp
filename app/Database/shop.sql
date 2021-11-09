-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2021 at 10:14 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_Login` (IN `userName` VARCHAR(32), IN `passWord` VARCHAR(35))  BEGIN
  SELECT * FROM user u
  WHERE u.username = userName AND u.password = passWord;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(5) UNSIGNED NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` int(100) DEFAULT NULL,
  `kategori` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga`, `kategori`, `lokasi`, `foto`) VALUES
(1, 'Komik Naruto', 75000, 'buku', 'Surabaya', 'buku_naruto.jpg'),
(2, 'Seragam Lengan Panjang', 150000, 'pakaian', 'Malang', 'baju_seragam.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kart`
--

CREATE TABLE `kart` (
  `id_kart` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_barang` int(5) UNSIGNED NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kart`
--

INSERT INTO `kart` (`id_kart`, `email`, `id_barang`, `jumlah_barang`, `total_harga`) VALUES
(11, 'alland@gmail.com', 1, 1, 75000),
(24, 'admin@gmail.com', 1, 1, 75000),
(25, 'alland@gmail.com', 2, 1, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2021-11-05-150958', 'App\\Database\\Migrations\\Barang', 'default', 'App', 1636125279, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `nama`, `password`, `alamat`) VALUES
('admin@gmail.com', 'admin', '$2y$10$4Zxzc25o1fo688MsD0rk.OgbjQuL44Q2lY/f9FyYDuJjV1/c.h2Zm', 'malang'),
('alland@gmail.com', 'alland', '$2y$10$vBuIbDdVLwl2LKoK5LtPoOuvpBexKmHLBmk.XFIZde89p6vr0oBsa', 'surabaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kart`
--
ALTER TABLE `kart`
  ADD PRIMARY KEY (`id_kart`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kart`
--
ALTER TABLE `kart`
  MODIFY `id_kart` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
