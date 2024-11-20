-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Nov 2024 pada 04.49
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wedding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_katalog`
--

CREATE TABLE `tb_katalog` (
  `id_katalog` int(11) NOT NULL,
  `gambar` varchar(90) NOT NULL,
  `nama_paket` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `status_publish` varchar(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_katalog`
--

INSERT INTO `tb_katalog` (`id_katalog`, `gambar`, `nama_paket`, `deskripsi`, `harga`, `status_publish`, `id_user`, `created_at`, `updated_at`) VALUES
(7, 'ramah_264998141.jpg', 'Paket Ramah Kantong', '<p>Ini Paket Ramah Banget loh</p>\"\"', 100000000, 'publish', 1, '2024-06-16 06:04:00', '2024-06-16 06:12:46'),
(9, 'mewah_2014730303.jpeg', 'Paket Berbahagi', '<p>Paket murah dan meriah membuat semua orang bahagia dan dapat tertawa tanpa beban hidup</p>', 40000000, 'publish', 1, '2024-06-16 16:56:39', NULL),
(10, 'sederhana_283469024.jpeg', 'Paket Rawr', '<p>Paket yang sangat rawr</p>', 90000000, 'publish', 1, '2024-06-16 16:57:32', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_katalog` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `email` varchar(35) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_wedding` date NOT NULL,
  `status_pesanan` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_katalog`, `nama`, `email`, `telepon`, `alamat`, `tgl_wedding`, `status_pesanan`, `created_at`, `updated_at`) VALUES
(4, 7, 'supyan nur muhammad', 'nurmuhammadsupyan209@gmail.com', '0895346433871', 'Jl. Taman Induk, Kelurahan Cipayung, Kecamatan Cipayung', '2024-06-25', 'accepted', '2024-06-16 12:48:55', NULL),
(5, 9, 'supyan nur muhammad', 'nurmuhammadsupyan209@gmail.com', '0895346433871', 'Jl. Taman Induk, Kelurahan Cipayung, Kecamatan Cipayung', '2024-06-27', 'batalkan', '2024-06-16 17:00:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_settings`
--

CREATE TABLE `tb_settings` (
  `id` int(11) NOT NULL,
  `judul` varchar(70) NOT NULL,
  `subjudul` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` text NOT NULL,
  `instagram` varchar(15) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_settings`
--

INSERT INTO `tb_settings` (`id`, `judul`, `subjudul`, `deskripsi`, `alamat`, `instagram`, `telepon`, `email`, `created_at`, `updated_at`) VALUES
(3, 'Kami Siap Membantu Anda Kapanpun dan Dimanapun', 'Kami menawarkan berbagai paket pernikahan yang dapat disesuaikan dengan kebutuhan dan anggaran Anda.', 'Kami adalah tim profesional yang berdedikasi untuk membuat pernikahan Anda menjadi momen yang tak terlupakan. Dengan pengalaman bertahun-tahun di industri ini, kami menawarkan layanan terbaik yang akan memenuhi semua kebutuhan pernikahan Anda.', 'Taman Induk RT 08/11 No.C5, Kel. Cipayung, Kec. Cipayung, Kota Depok', 'nmsupyan_20', '0895346433871', 'nmsupyan@gmail.com', '2024-06-16 15:59:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(15) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `status_user` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `email`, `username`, `nama`, `pass`, `status_user`, `created_at`, `updated_at`) VALUES
(1, 'nmsupyan@gmail.com', 'supyanAdmin', 'Nur Muhammad Supyan', '$2y$10$Y7xWCZ1ajJvw7XzrHK/Z6OxKNKlf5O0.oN9aXEwO30Mr6BWHzzAhu', 'admin', '2024-06-13 06:56:21', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD PRIMARY KEY (`id_katalog`),
  ADD KEY `user_id` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_katalog` (`id_katalog`);

--
-- Indeks untuk tabel `tb_settings`
--
ALTER TABLE `tb_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_katalog`
--
ALTER TABLE `tb_katalog`
  MODIFY `id_katalog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_settings`
--
ALTER TABLE `tb_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_katalog`
--
ALTER TABLE `tb_katalog`
  ADD CONSTRAINT `tb_katalog_constraint` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_constraint` FOREIGN KEY (`id_katalog`) REFERENCES `tb_katalog` (`id_katalog`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
