-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 12, 2012 at 12:16 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `utang`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(5) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hutang` int(11) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nomor`, `nama`, `alamat`, `hutang`) VALUES
(1, '00142', 'Andi', 'Jl. Lengkong', 0),
(2, '31276', 'Budi', 'Jl. Laswi', 10000000),
(3, '27534', 'Erik', 'Jl. Jurang', 10000000),
(4, '19852', 'Chepy', 'Jl. Singkong', 7500000),
(5, '76153', 'Dedi', 'Jl. Cipaganti', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `tipe_pembayaran`
--

CREATE TABLE IF NOT EXISTS `tipe_pembayaran` (
  `id_tipe` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tipe` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tipe_pembayaran`
--

INSERT INTO `tipe_pembayaran` (`id_tipe`, `nama_tipe`) VALUES
(1, 'Tunai'),
(2, 'Cek'),
(3, 'Giro');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_tipe` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `nama_bank` varchar(50) DEFAULT NULL,
  `nomor_cek_giro` varchar(25) DEFAULT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `id_tipe`, `jumlah`, `tanggal_bayar`, `nama_bank`, `nomor_cek_giro`, `tanggal_jatuh_tempo`) VALUES
(1, 1, 1, 1000000, '2012-01-12', NULL, NULL, NULL),
(2, 2, 3, 2500000, '2011-12-02', 'PT. BANK CENTRAL ASIA', '0123456789012345678901234', '2012-01-02'),
(7, 5, 2, 5000000, '2012-01-02', 'PT. BANK CENTRAL ASIA', '0987654321098765432109876', '2012-02-18'),
(8, 4, 3, 10000000, '2012-01-08', 'PT. BANK CENTRAL ASIA', '0789456123078945612307894', '2012-01-17'),
(9, 1, 1, 1257500, '2012-01-11', NULL, NULL, NULL),
(10, 1, 2, 7500000, '2012-01-11', 'PT. BANK CENTRAL ASIA', '0456789123045612378901234', '2012-01-17'),
(11, 1, 2, 5000000, '2012-01-07', 'PT. BANK CENTRAL ASIA', '0123789456012378945601234', '2012-01-20'),
(12, 1, 1, 2500000, '2012-01-11', NULL, NULL, NULL),
(13, 1, 1, 1075000, '2012-01-11', NULL, NULL, NULL),
(14, 1, 1, 1075000, '2012-01-11', NULL, NULL, NULL),
(15, 5, 2, 1250000, '2011-12-19', 'PT. BANK CENTRAL ASIA', '0098712365498712365412345', '2012-01-11'),
(16, 4, 3, 2500000, '2012-01-01', 'PT. BANK CENTRAL ASIA', '01233211230123321123014', '2012-01-11'),
(17, 1, 1, 5350000, '2012-01-11', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
