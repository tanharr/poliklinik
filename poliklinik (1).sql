-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2023 pada 16.28
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poliklinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_periksa`
--

CREATE TABLE `detail_periksa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_periksa` int(11) UNSIGNED NOT NULL,
  `id_obat` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE `dokter` (
  `id_dokter` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id_dokter`, `nama`, `alamat`, `no_hp`) VALUES
(4, 'Tanhar', 'Arjuna', '085322170915'),
(6, 'Rizal', 'Nakula', '0986865756512'),
(9, 'Dadang Sunandar', 'Bima', '085322170914');

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_obat` varbinary(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama_obat`, `kemasan`, `harga`) VALUES
(3, 0x426f64726578, '12 tablet', 25000),
(4, 0x50617261636574616d6f6c, '10 tablet', 15000),
(6, 0x50617261636574616d6f6c, '10 tablet', 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `nama`, `alamat`, `no_hp`) VALUES
(3, 'Fariz', 'Nakula', '085322170920'),
(5, 'Rizal Maulana', 'Cirebon', '085322170915'),
(7, 'Zulfan', 'Pemalang', '08865541231'),
(8, 'Rifki Alfiansyah', 'jl. Bima', '08667578865');

-- --------------------------------------------------------

--
-- Struktur dari tabel `periksa`
--

CREATE TABLE `periksa` (
  `id_periksa` int(10) UNSIGNED NOT NULL,
  `id_dokter` int(11) UNSIGNED NOT NULL,
  `id_pasien` int(11) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `catatan` text NOT NULL,
  `biaya_periksa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periksa`
--

INSERT INTO `periksa` (`id_periksa`, `id_dokter`, `id_pasien`, `tgl_periksa`, `catatan`, `biaya_periksa`) VALUES
(13, 4, 3, '2023-10-10 19:14:00', 'Rabies', 200000),
(15, 4, 5, '2023-11-04 18:47:00', 'Mengidap penyakit diare', 50000),
(16, 4, 8, '2023-12-12 20:30:00', 'flu dan batuk selama 1 minggu', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('dokter','pasien','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(8, 'Tanhar', '12345', 'dokter'),
(9, 'Fariz', 'fariz', 'pasien'),
(10, 'Rizal', '1234', 'pasien'),
(11, 'Rifki', 'rifki123', 'pasien'),
(12, 'Dadang', '1234', 'dokter');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_periksa` (`id_periksa`),
  ADD KEY `fk_id_obat` (`id_obat`);

--
-- Indeks untuk tabel `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id_dokter`);

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indeks untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id_periksa`),
  ADD KEY `id_dokter` (`id_dokter`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id_dokter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id_periksa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_periksa`
--
ALTER TABLE `detail_periksa`
  ADD CONSTRAINT `fk_id_obat` FOREIGN KEY (`id_obat`) REFERENCES `obat` (`id`),
  ADD CONSTRAINT `fk_id_periksa` FOREIGN KEY (`id_periksa`) REFERENCES `periksa` (`id_periksa`);

--
-- Ketidakleluasaan untuk tabel `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`id_dokter`) REFERENCES `dokter` (`id_dokter`),
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`id_pasien`) REFERENCES `pasien` (`id_pasien`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
