-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Jun 2020 pada 07.40
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci3_manajemenkeuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `image` varchar(128) NOT NULL,
  `level` varchar(5) NOT NULL,
  `active_email` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `image`, `level`, `active_email`) VALUES
(3, 'andy arismianto', 'andyarismian@gmail.com', '$2y$10$Hnk0SSJW3c0ajDdoXvUwreUeNnCgBsFlFMHyEqfJVIGLdhbewfZUu', 'dafault.jpg', '1', 0),
(4, 'andyarismianto', 'andyarismianto@gmail.com', '$2y$10$S85P5ev.OEy5Q7hk2m/mRuH/NL6Eg0U45QFiKjb03wI.pozGY9PG6', 'dafault.jpg', '1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_list_item`
--

CREATE TABLE `user_list_item` (
  `id_uli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_item` int(64) NOT NULL,
  `keterangan_item` varchar(128) NOT NULL,
  `status_item` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_list_item`
--

INSERT INTO `user_list_item` (`id_uli`, `id_user`, `total_item`, `keterangan_item`, `status_item`) VALUES
(1, 1, 50000, 'beli kartu', 'wajib'),
(2, 1, 100000, 'beli makanan', 'normal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status_list_in`
--

CREATE TABLE `user_status_list_in` (
  `id_usli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_in` date NOT NULL,
  `total_in` int(64) NOT NULL,
  `keterangan_in` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_status_list_in`
--

INSERT INTO `user_status_list_in` (`id_usli`, `id_user`, `tanggal_in`, `total_in`, `keterangan_in`) VALUES
(6, 1, '2020-02-20', 2000, 'amal'),
(7, 1, '2020-02-28', 500000, 'gaji');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_status_list_out`
--

CREATE TABLE `user_status_list_out` (
  `id_uslo` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_out` date NOT NULL,
  `total_out` int(64) NOT NULL,
  `keterangan_out` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_status_list_out`
--

INSERT INTO `user_status_list_out` (`id_uslo`, `id_user`, `tanggal_out`, `total_out`, `keterangan_out`) VALUES
(3, 1, '2020-02-20', 60000, 'sabun'),
(4, 2, '2020-02-20', 40000, 'sampo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(256) NOT NULL,
  `create_token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `create_token`) VALUES
(24, 'andyarismian@gmail.com', 'nocIOhZaXlMESXw7+QmRmqFHLQsgCUwIGXk/BgAIF08=', 1592283286);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `user_list_item`
--
ALTER TABLE `user_list_item`
  ADD PRIMARY KEY (`id_uli`);

--
-- Indeks untuk tabel `user_status_list_in`
--
ALTER TABLE `user_status_list_in`
  ADD PRIMARY KEY (`id_usli`);

--
-- Indeks untuk tabel `user_status_list_out`
--
ALTER TABLE `user_status_list_out`
  ADD PRIMARY KEY (`id_uslo`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_list_item`
--
ALTER TABLE `user_list_item`
  MODIFY `id_uli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user_status_list_in`
--
ALTER TABLE `user_status_list_in`
  MODIFY `id_usli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_status_list_out`
--
ALTER TABLE `user_status_list_out`
  MODIFY `id_uslo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
