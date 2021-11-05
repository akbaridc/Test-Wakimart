-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Nov 2021 pada 10.46
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wakimart3`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `harga_promo`
--

CREATE TABLE `harga_promo` (
  `id` int(11) NOT NULL,
  `promo_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `harga_promo`
--

INSERT INTO `harga_promo` (`id`, `promo_id`, `price`) VALUES
(1, 1, '2300000.00'),
(2, 2, '1071000.00'),
(3, 3, '2890000.00'),
(4, 4, '890000.00'),
(5, 5, '5599000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `code`, `name`) VALUES
(1, 'UIU77', 'WAKI SHOULDER SUPPORT'),
(2, 'AFAF1', 'FACIAL MASSAGER'),
(3, 'G24G', 'WAKI WAIST BELT'),
(4, 'SAD23', 'TEST'),
(5, 'WKB8004', 'WAKI ECO DISINFECTANT GENERATOR'),
(6, 'WKE6002', 'SALAD MAKER'),
(7, 'WKM017', 'WAKI KNEE SUPPORT'),
(8, 'WKM015', 'WAKI BACK BRACES');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id` int(11) NOT NULL,
  `product1_id` int(11) NOT NULL,
  `product2_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id`, `product1_id`, `product2_id`) VALUES
(1, 2, 1),
(2, 7, 8),
(3, 3, 5),
(4, 1, 4),
(5, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `harga_promo`
--
ALTER TABLE `harga_promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_id` (`promo_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product1_id` (`product1_id`),
  ADD KEY `product2_id` (`product2_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `harga_promo`
--
ALTER TABLE `harga_promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `harga_promo`
--
ALTER TABLE `harga_promo`
  ADD CONSTRAINT `harga_promo_ibfk_1` FOREIGN KEY (`promo_id`) REFERENCES `promo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`product1_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promo_ibfk_2` FOREIGN KEY (`product2_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
