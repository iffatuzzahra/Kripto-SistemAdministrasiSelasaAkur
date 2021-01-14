-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jan 2021 pada 03.28
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `titip-barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `kodeadm` varchar(64) NOT NULL,
  `passwordadm` varchar(64) NOT NULL,
  `namaadm` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`kodeadm`, `passwordadm`, `namaadm`) VALUES
('dc5c7986daef50c1e02ab09b442ee34f', 'e10adc3949ba59abbe56e057f20f883e', '17f0cf279143f75d20811dff9ba53b64'),
('93dd4de5cddba2c733c65f233097f05a', 'e10adc3949ba59abbe56e057f20f883e', 'ba165b869229fb32e7fb7599715a1166'),
('e88a49bccde359f0cabb40db83ba6080', '81dc9bdb52d04dc20036dbd8313ed055', '417d43ac1d74bfeeada17fab40c3e4a6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penitipan`
--

CREATE TABLE `penitipan` (
  `kodetitip` int(11) NOT NULL,
  `idpenitip` varchar(75) NOT NULL,
  `namapenitip` varchar(75) NOT NULL,
  `notelp` varchar(64) NOT NULL,
  `namabarang` varchar(64) NOT NULL,
  `jlhbarang` int(11) NOT NULL,
  `tgltitip` varchar(64) NOT NULL,
  `tglambil` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penitipan`
--

INSERT INTO `penitipan` (`kodetitip`, `idpenitip`, `namapenitip`, `notelp`, `namabarang`, `jlhbarang`, `tgltitip`, `tglambil`) VALUES
(1, '1592261137054811', 'Mxdejye`jdl`e~v`', '021`982`882`213`', 'Tey`erw`o/``mh``', 4, '2-1`003`21``1-``', '0-0`000`00``0-``'),
(2, '9512840073136200', 'Mh~edhEodmdcyrd`', '024`838`682`241`', 'Whs`iex`t~s`iQv`', 1, '2-1`003`21``1-``', '2-1`003`21``1-``'),
(3, '8641733273246418', 'MxLcdyeedprle~m`', '018`827`622`442`', 'Vh`hg`sd`', 2, '2-1`003`21``1-``', '0-0`000`00``0-``'),
(4, '7621`4492`138``238``230``', 'Wmpemem`r~j`xEm`', '098`843`441`252`', 'Dmww', 3, '2-1`003`21``1-``', '2-1`003`21``1-``'),
(5, '9032416141915239', 'CrErehpsrej`e~m`', '024`890`712`343`', 'Dmww', 4, '2-1`003`21``1-``', '2-1`003`21``1-``'),
(6, '9280815369623471', 'Emsmqew`i~e`pVh`', '018`827`622`442`', 'Tey`erw`o/``mh``', 21, '2-1`003`21``1-``', '0-0`000`00``0-``'),
(7, '1240831289132409', 'Wcyeiep`x~m`mQc`', '089`823`511`592`', 'Vh`hg`sd`', 1, '2-1`004`21``1-``', '0-0`000`00``0-``');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `penitipan`
--
ALTER TABLE `penitipan`
  ADD PRIMARY KEY (`kodetitip`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `penitipan`
--
ALTER TABLE `penitipan`
  MODIFY `kodetitip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
