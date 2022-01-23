-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 21 Nov 2021 pada 14.24
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `batualam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id_produk` int(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
`id_cart` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id_produk`, `Nama`, `nama_kategori`, `jumlah`, `qty`, `harga`, `gambar`, `id_cart`, `id_pembeli`) VALUES
(9, 'Relief Batu Alam', 'Relief', 3, 5, 20000, 'relief5.jpg', 1, 9),
(7, 'Relief Batu Alam', 'Relief', 4, 5, 20000, 'relief3.jpg', 3, 9),
(4, 'Tempel Batu Alam', 'Tempel', 5, 5, 20000, 'tempel3.jpg', 4, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
`id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Relief'),
(2, 'Tempel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE IF NOT EXISTS `pembeli` (
`id_pembeli` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `email`, `no_hp`, `alamat`, `password`) VALUES
(9, 'Irkham Taufik Abimanyu', 'irkhamtaufik01@gmail.com', '087865008887', ' ', 'ff8c2ca85de0f329b55f4131d7930302'),
(26, 'Aditya Wiratama', 'abimonsterjakers@yahoo.co.id', '02410491702402', ' ', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE IF NOT EXISTS `produk` (
`id_produk` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `Nama`, `gambar`, `nama_kategori`, `harga`, `qty`) VALUES
(1, 'Realif Batu Alam', 'realif1.jpg', 'Relief', 10000, 5),
(2, 'Tempel Batu Alam', 'tempel1.jpg', 'Tempel', 20000, 5),
(3, 'Tempel Batu Alam', 'tempel2.jpg', 'Tempel', 20000, 5),
(4, 'Tempel Batu Alam', 'tempel3.jpg', 'Tempel', 20000, 5),
(5, 'Tempel Batu Alam', 'tempel4.jpg', 'Tempel', 20000, 5),
(6, 'Relief Batu Alam', 'relief2.jpg', 'Relief', 20000, 5),
(7, 'Relief Batu Alam', 'relief3.jpg', 'Relief', 20000, 5),
(8, 'Relief Batu Alam', 'relief4.jpg', 'Relief', 20000, 5),
(9, 'Relief Batu Alam', 'relief5.jpg', 'Relief', 20000, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
 ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
 ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
