-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 06, 2016 at 06:12 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beli_tiket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` char(20) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(30) NOT NULL,
  `telpn` varchar(30) NOT NULL,
  `photo_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `alamat`, `telpn`, `photo_id`) VALUES
('pemb11', 'Arie', 'Alamat', '081615770004', ''),
('pemb15', 'Arie', 'Alamat', '081615770004', 'upload/pemb15.png'),
('pemb16', 'Arie', 'Alamat', '081615770004', 'upload/pemb16.png'),
('pemb17', 'Arie', 'Alamat', '081615770004', 'upload/pemb17.png'),
('pemb18', 'Arie', 'Alamat', '081615770004', 'upload/pemb18.png'),
('pemb19', 'Patrick', 'jalan mawar 1', '0815289888', ''),
('pemb20', 'patrick', 'jalan mawar', '081', 'upload/pemb20.png'),
('pemb21', 'Ronald', 'Jalan Sukarno', '04846813', ''),
('pemb22', 'Yosia', 'Jalan depok', '08234', ''),
('pemb23', 'Yosia', 'Jalan depok', '08234', ''),
('pemb24', 'Yosia', 'Jalan depok', '08234', ''),
('pemb25', 'Ronald', 'Jalan Sukarno', '04846813', 'upload/pemb25.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` char(10) NOT NULL,
  `id_pembeli` char(10) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `total_harga` int(10) NOT NULL,
  `id_tiket` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pembeli`, `tanggal_beli`, `total_harga`, `id_tiket`) VALUES
('beli12', 'pemb11', '2016-10-18', 200000, 'tiket11'),
('beli13', 'pemb11', '2016-10-23', 5000000, 'tiket11'),
('beli15', 'pemb11', '2016-10-23', 500000, 'tiket11'),
('beli16', 'pemb11', '2016-10-27', 500000, 'tiket11');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` char(10) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `nama_kereta` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `tujuan`, `tanggal_berangkat`, `nama_kereta`) VALUES
('tiket11', 'jakarta', '2016-10-19', 'majapahit');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
