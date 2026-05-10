-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2026 pada 10.29
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
-- Database: `laporan_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `No` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `Keterangan` varchar(50) NOT NULL,
  `Kategori` varchar(20) NOT NULL,
  `Jenis` varchar(15) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`No`, `Tanggal`, `Keterangan`, `Kategori`, `Jenis`, `Jumlah`, `Catatan`) VALUES
(80, '2026-03-01', 'Penjualan beras', 'Penjualan Pagi', 'Masuk', 420000, 'ramai'),
(81, '2026-03-01', 'Beli stok minyak', 'Belanja Stok', 'Keluar', 180000, 'restok awal bulan'),
(82, '2026-03-03', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 410000, 'banyak pembeli'),
(83, '2026-03-04', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 450000, 'awal minggu'),
(84, '2026-03-04', 'Biaya transport', 'Lain-lain', 'Keluar', 35000, 'antar barang'),
(85, '2026-03-05', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 390000, 'stok lancar'),
(86, '2026-03-05', 'Beli stok sabun', 'Belanja Stok', 'Keluar', 175000, 'sabun habis'),
(87, '2026-03-06', 'Penjualan mie instan', 'Penjualan Malam', 'Masuk', 405000, ''),
(88, '2026-03-06', 'Bayar internet', 'Operasional', 'Keluar', 80000, 'wifi toko'),
(89, '2026-03-07', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(90, '2026-03-08', 'Penjualan telur', 'Penjualan Siang', 'Masuk', 395000, 'siang ramai'),
(91, '2026-03-08', 'Beli stok gula', 'Belanja Stok', 'Keluar', 165000, ''),
(92, '2026-03-09', 'Penjualan sembako', 'Penjualan Malam', 'Masuk', 440000, 'laris'),
(93, '2026-03-09', 'Biaya kebersihan', 'Lain-lain', 'Keluar', 25000, 'alat kebersihan'),
(94, '2026-03-10', 'Penjualan minyak', 'Penjualan Pagi', 'Masuk', 400000, ''),
(95, '2026-03-10', 'Bayar air', 'Operasional', 'Keluar', 45000, 'PDAM'),
(96, '2026-03-12', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 430000, 'malam ramai'),
(97, '2026-03-12', 'Bayar keamanan', 'Operasional', 'Keluar', 50000, ''),
(98, '2026-03-13', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 455000, 'cuaca cerah'),
(99, '2026-03-13', 'Beli stok campuran', 'Belanja Stok', 'Keluar', 190000, 'restok'),
(100, '2026-03-14', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 405000, ''),
(101, '2026-03-14', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(102, '2026-03-15', 'Penjualan beras', 'Penjualan Malam', 'Masuk', 445000, 'ramai malam'),
(103, '2026-03-15', 'Biaya perbaikan', 'Lain-lain', 'Keluar', 40000, 'rak toko'),
(104, '2026-03-16', 'Penjualan gula', 'Penjualan Pagi', 'Masuk', 425000, 'stok bagus'),
(105, '2026-03-16', 'Beli stok minyak', 'Belanja Stok', 'Keluar', 175000, 'restok'),
(106, '2026-03-17', 'Penjualan telur', 'Penjualan Siang', 'Masuk', 410000, 'pelanggan tetap'),
(107, '2026-03-17', 'Bayar listrik', 'Operasional', 'Keluar', 60000, ''),
(108, '2026-03-18', 'Penjualan sembako', 'Penjualan Malam', 'Masuk', 460000, 'laris manis'),
(109, '2026-03-18', 'Beli stok sabun', 'Belanja Stok', 'Keluar', 170000, 'stok menipis'),
(110, '2026-03-19', 'Penjualan minyak', 'Penjualan Pagi', 'Masuk', 395000, ''),
(111, '2026-03-19', 'Biaya lain', 'Lain-lain', 'Keluar', 30000, 'keperluan kecil'),
(112, '2026-03-20', 'Penjualan gula', 'Penjualan Siang', 'Masuk', 435000, 'penjualan naik'),
(113, '2026-03-20', 'Beli stok telur', 'Belanja Stok', 'Keluar', 180000, 'restok cepat'),
(114, '2026-03-01', 'Penjualan beras', 'Penjualan Pagi', 'Masuk', 420000, 'ramai'),
(115, '2026-03-02', 'Beli stok minyak', 'Belanja Stok', 'Keluar', 180000, 'restok awal bulan'),
(116, '2026-03-03', 'Penjualan gula', 'Penjualan Siang', 'Masuk', 385000, 'lancar'),
(117, '2026-03-04', 'Bayar listrik', 'Operasional', 'Keluar', 60000, 'tagihan bulanan'),
(118, '2026-03-05', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 410000, 'banyak pembeli'),
(119, '2026-03-06', 'Beli stok telur', 'Belanja Stok', 'Keluar', 170000, 'supplier lama'),
(120, '2026-03-07', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 450000, 'awal minggu'),
(121, '2026-03-08', 'Biaya transport', 'Lain-lain', 'Keluar', 35000, 'antar barang'),
(122, '2026-03-09', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 390000, 'stok lancar'),
(123, '2026-03-10', 'Beli stok sabun', 'Belanja Stok', 'Keluar', 175000, 'sabun habis'),
(124, '2026-03-11', 'Penjualan mie instan', 'Penjualan Malam', 'Masuk', 405000, ''),
(125, '2026-03-12', 'Bayar internet', 'Operasional', 'Keluar', 80000, 'wifi toko'),
(126, '2026-03-13', 'Penjualan beras', 'Penjualan Pagi', 'Masuk', 470000, 'akhir pekan'),
(127, '2026-03-14', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(128, '2026-03-15', 'Penjualan telur', 'Penjualan Siang', 'Masuk', 395000, 'siang ramai'),
(129, '2026-03-16', 'Beli stok gula', 'Belanja Stok', 'Keluar', 165000, ''),
(130, '2026-03-17', 'Penjualan sembako', 'Penjualan Malam', 'Masuk', 440000, 'laris'),
(131, '2026-03-18', 'Biaya kebersihan', 'Lain-lain', 'Keluar', 25000, 'alat kebersihan'),
(132, '2026-03-19', 'Penjualan minyak', 'Penjualan Pagi', 'Masuk', 400000, ''),
(133, '2026-03-20', 'Bayar air', 'Operasional', 'Keluar', 45000, 'PDAM'),
(134, '2026-03-21', 'Penjualan gula', 'Penjualan Siang', 'Masuk', 415000, 'penjualan stabil'),
(135, '2026-03-22', 'Beli stok beras', 'Belanja Stok', 'Keluar', 185000, 'karung baru'),
(136, '2026-03-23', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 430000, 'malam ramai'),
(137, '2026-03-24', 'Bayar keamanan', 'Operasional', 'Keluar', 50000, ''),
(138, '2026-03-25', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 455000, 'cuaca cerah'),
(139, '2026-03-26', 'Beli stok campuran', 'Belanja Stok', 'Keluar', 190000, 'restok'),
(140, '2026-03-27', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 405000, ''),
(141, '2026-03-28', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(142, '2026-03-29', 'Penjualan beras', 'Penjualan Malam', 'Masuk', 445000, 'ramai malam'),
(143, '2026-03-31', 'Biaya perbaikan', 'Lain-lain', 'Keluar', 40000, 'rak toko'),
(144, '2026-04-01', 'Penjualan beras', 'Penjualan Pagi', 'Masuk', 430000, 'awal bulan ramai'),
(145, '2026-04-02', 'Beli stok minyak', 'Belanja Stok', 'Keluar', 185000, 'restok minyak'),
(146, '2026-04-03', 'Penjualan gula', 'Penjualan Siang', 'Masuk', 395000, 'lancar'),
(147, '2026-04-04', 'Bayar listrik', 'Operasional', 'Keluar', 60000, 'tagihan bulanan'),
(148, '2026-04-05', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 420000, 'banyak pembeli'),
(149, '2026-04-06', 'Beli stok telur', 'Belanja Stok', 'Keluar', 175000, 'supplier tetap'),
(150, '2026-04-07', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 460000, 'awal minggu'),
(151, '2026-04-08', 'Biaya transport', 'Lain-lain', 'Keluar', 30000, 'antar barang'),
(152, '2026-04-09', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 405000, 'stok lancar'),
(153, '2026-04-10', 'Beli stok sabun', 'Belanja Stok', 'Keluar', 180000, 'sabun habis'),
(154, '2026-04-11', 'Penjualan mie instan', 'Penjualan Malam', 'Masuk', 415000, ''),
(155, '2026-04-12', 'Bayar internet', 'Operasional', 'Keluar', 80000, 'wifi toko'),
(156, '2026-04-13', 'Penjualan beras', 'Penjualan Pagi', 'Masuk', 475000, 'akhir pekan'),
(157, '2026-04-14', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(158, '2026-04-15', 'Penjualan telur', 'Penjualan Siang', 'Masuk', 405000, 'siang ramai'),
(159, '2026-04-16', 'Beli stok gula', 'Belanja Stok', 'Keluar', 170000, ''),
(160, '2026-04-17', 'Penjualan sembako', 'Penjualan Malam', 'Masuk', 445000, 'laris'),
(161, '2026-04-18', 'Biaya kebersihan', 'Lain-lain', 'Keluar', 25000, 'alat kebersihan'),
(162, '2026-04-19', 'Penjualan minyak', 'Penjualan Pagi', 'Masuk', 410000, ''),
(163, '2026-04-20', 'Bayar air', 'Operasional', 'Keluar', 45000, 'PDAM'),
(164, '2026-04-21', 'Penjualan gula', 'Penjualan Siang', 'Masuk', 425000, 'penjualan stabil'),
(165, '2026-04-22', 'Beli stok beras', 'Belanja Stok', 'Keluar', 190000, 'karung baru'),
(166, '2026-04-23', 'Penjualan telur', 'Penjualan Malam', 'Masuk', 435000, 'malam ramai'),
(167, '2026-04-24', 'Bayar keamanan', 'Operasional', 'Keluar', 50000, ''),
(168, '2026-04-25', 'Penjualan sembako', 'Penjualan Pagi', 'Masuk', 465000, 'cuaca cerah'),
(169, '2026-04-26', 'Beli stok campuran', 'Belanja Stok', 'Keluar', 195000, 'restok'),
(170, '2026-04-27', 'Penjualan minyak', 'Penjualan Siang', 'Masuk', 415000, ''),
(171, '2026-04-28', 'Gaji karyawan', 'Gaji', 'Keluar', 220000, 'mingguan'),
(172, '2026-04-29', 'Penjualan beras', 'Penjualan Malam', 'Masuk', 455000, 'ramai malam'),
(173, '2026-04-30', 'Biaya perbaikan', 'Lain-lain', 'Keluar', 40000, 'rak toko'),
(174, '2026-05-01', 'Biaya kebersihan', 'Lain-lain', 'Keluar', 50000, ''),
(175, '2026-05-01', 'penjualan telur', 'Penjualan Malam', 'Masuk', 47000, ''),
(176, '2026-05-02', 'penjualan beras', 'Penjualan Pagi', 'Masuk', 200000, '13 kg'),
(177, '2026-05-02', 'Beli stok mie ', 'Belanja Stok', 'Keluar', 100000, '2 dus'),
(178, '2026-05-03', 'gaji karyawan', 'Gaji', 'Keluar', 100000, ''),
(179, '2026-05-03', 'penjualan telur', 'Penjualan Siang', 'Masuk', 250000, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('Owner','Admin','Kasir') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'musdalifah', 'musdalifah135', 'Owner'),
(2, 'salsa', 'salsa123', 'Admin'),
(7, 'zannaafi', 'zannaafi111', 'Kasir'),
(9, 'aini', 'aini222', 'Kasir'),
(27, 'nur', 'nur333', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`No`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
