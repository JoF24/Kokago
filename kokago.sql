-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Jun 2024 pada 16.13
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kokago`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_customer`
--

CREATE TABLE `data_customer` (
  `id_data_customer` int(11) NOT NULL,
  `nama_customer` varchar(255) DEFAULT NULL,
  `alamat_customer` varchar(255) DEFAULT NULL,
  `no_telepon_customer` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_customer`
--

INSERT INTO `data_customer` (`id_data_customer`, `nama_customer`, `alamat_customer`, `no_telepon_customer`, `password`) VALUES
(1, 'joe', 'Lupa Dimana', '0888888888888', 'a'),
(2, 'Joe Ferdinan', 'Pokok Di Bumi', '082211334455', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_menu`
--

CREATE TABLE `data_menu` (
  `id_data_menu` int(11) NOT NULL,
  `nama_menu` varchar(255) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga_menu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_menu`
--

INSERT INTO `data_menu` (`id_data_menu`, `nama_menu`, `gambar`, `harga_menu`) VALUES
(1, 'Nasi Goreng', 'Makanan Berat.png', '10000'),
(2, 'Mix Platter', 'Snack.png', '15000'),
(3, 'Cofffe ', 'Minuman.png', '7000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_reservasi`
--

CREATE TABLE `data_reservasi` (
  `id_data_reservasi` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jam` varchar(255) NOT NULL,
  `jumlah_orang` varchar(255) NOT NULL,
  `id_data_tempat` int(11) NOT NULL,
  `id_data_customer` int(11) NOT NULL,
  `id_data_staff_pelayan` int(11) NOT NULL DEFAULT 1,
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_reservasi` varchar(255) NOT NULL DEFAULT 'Ditinjau'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_reservasi`
--

INSERT INTO `data_reservasi` (`id_data_reservasi`, `tanggal`, `jam`, `jumlah_orang`, `id_data_tempat`, `id_data_customer`, `id_data_staff_pelayan`, `bukti_pembayaran`, `status_reservasi`) VALUES
(2, '2024-06-12', '15:00 - 18:00', '10', 2, 2, 1, 'Array', 'Ditinjau'),
(3, '2024-06-12', '09:00 - 12:00', '50', 2, 2, 1, 'C:/xampp/htdocs/Kokago/public/gambar/Aqua.webp', 'Ditinjau'),
(4, '2024-06-12', '18:00 - 21:00', '19', 2, 2, 1, 'Produk-removebg-preview.png', 'Ditolak'),
(5, '2024-06-12', '12:00 - 15:00', '20', 2, 2, 1, 'Produk-removebg-preview.png', 'Diterima'),
(6, '2024-06-13', '18:00 - 21:00', '10', 3, 2, 1, 'Produk-removebg-preview.png', 'Ditinjau'),
(7, '2024-06-13', '12:00 - 15:00', '20', 2, 2, 1, 'Produk-removebg-preview.png', 'Diterima'),
(8, '2024-06-13', '09:00 - 12:00', '18', 2, 2, 1, 'Produk-removebg-preview.png', 'Ditinjau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_staff_pelayan`
--

CREATE TABLE `data_staff_pelayan` (
  `id_data_staff_pelayan` int(11) NOT NULL,
  `nama_staff_pelayan` varchar(255) DEFAULT NULL,
  `alamat_staff_pelayan` varchar(255) DEFAULT NULL,
  `no_telepon_staff_pelayan` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_staff_pelayan`
--

INSERT INTO `data_staff_pelayan` (`id_data_staff_pelayan`, `nama_staff_pelayan`, `alamat_staff_pelayan`, `no_telepon_staff_pelayan`, `password`) VALUES
(1, 'abc', 'Pokok Di Bumi', '012345465757', 'a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_tempat`
--

CREATE TABLE `data_tempat` (
  `id_data_tempat` int(11) NOT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `kapasitas` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_tempat`
--

INSERT INTO `data_tempat` (`id_data_tempat`, `lokasi`, `kapasitas`) VALUES
(2, 'A : Gazebo', '100'),
(3, 'B : Kursi Kayu', '50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_reservasi`
--

CREATE TABLE `detail_reservasi` (
  `id_detail_reservasi` int(11) NOT NULL,
  `id_data_menu` varchar(11) DEFAULT NULL,
  `jumlah` varchar(11) DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `id_pelanggan` varchar(11) DEFAULT NULL,
  `id_reservasi` varchar(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_reservasi`
--

INSERT INTO `detail_reservasi` (`id_detail_reservasi`, `id_data_menu`, `jumlah`, `total_harga`, `id_pelanggan`, `id_reservasi`) VALUES
(1, '1', '1', '10000', '2', '8'),
(3, '3', '2', '14000', '2', '8');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_denah`
--

CREATE TABLE `gambar_denah` (
  `id_denah` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gambar_denah`
--

INSERT INTO `gambar_denah` (`id_denah`, `gambar`) VALUES
(1, 'denah.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_customer`
--
ALTER TABLE `data_customer`
  ADD PRIMARY KEY (`id_data_customer`);

--
-- Indeks untuk tabel `data_menu`
--
ALTER TABLE `data_menu`
  ADD PRIMARY KEY (`id_data_menu`);

--
-- Indeks untuk tabel `data_reservasi`
--
ALTER TABLE `data_reservasi`
  ADD PRIMARY KEY (`id_data_reservasi`);

--
-- Indeks untuk tabel `data_staff_pelayan`
--
ALTER TABLE `data_staff_pelayan`
  ADD PRIMARY KEY (`id_data_staff_pelayan`);

--
-- Indeks untuk tabel `data_tempat`
--
ALTER TABLE `data_tempat`
  ADD PRIMARY KEY (`id_data_tempat`);

--
-- Indeks untuk tabel `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  ADD PRIMARY KEY (`id_detail_reservasi`);

--
-- Indeks untuk tabel `gambar_denah`
--
ALTER TABLE `gambar_denah`
  ADD PRIMARY KEY (`id_denah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_customer`
--
ALTER TABLE `data_customer`
  MODIFY `id_data_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_menu`
--
ALTER TABLE `data_menu`
  MODIFY `id_data_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_reservasi`
--
ALTER TABLE `data_reservasi`
  MODIFY `id_data_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `data_staff_pelayan`
--
ALTER TABLE `data_staff_pelayan`
  MODIFY `id_data_staff_pelayan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_tempat`
--
ALTER TABLE `data_tempat`
  MODIFY `id_data_tempat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_reservasi`
--
ALTER TABLE `detail_reservasi`
  MODIFY `id_detail_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `gambar_denah`
--
ALTER TABLE `gambar_denah`
  MODIFY `id_denah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
