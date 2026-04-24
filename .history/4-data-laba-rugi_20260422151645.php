<?php
require "0-koneksi.php";

global $conn;
// 1. mengambil semua data dari tabel transaksi
$data_transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$rows = [];
while ($row = mysqli_fetch_assoc($data_transaksi)) {
    $rows[] = $row;
}

// 2. mencari data sesuai jenis nya
// pemasukan/pendapatan
$pendapatan = [];
$total_pendapatan = 0;
$pendapatan_penjualan = 0;
$pendapatan_belanja_stok = 0;
$pendapatan_operasional = 0;
$pendapatan_gaji = 0;
$pendapatan_lain_lain = 0;

// pengeluaran/biaya
$biaya = [];
$total_biaya = 0;
$biaya_penjualan = 0;
$biaya_belanja_stok = 0;
$biaya_operasional = 0;
$biaya_gaji = 0;
$biaya_lain_lain = 0;
// laba bersih
$total_laba_bersih = 0;

foreach ($rows as $data) {
    if ($data["Jenis"] == "Masuk") {
        $pendapatan[] = $data;
        $total_pendapatan += $data["Jumlah"];
        if ($data["Kategori"] == "Belanja Stok") {
            $pendapatan_belanja_stok += $data["Jumlah"];
        } else if ($data["Kategori"] == "Operasional") {
            $pendapatan_operasional += $data["Jumlah"];
        } else if ($data["Kategori"] == "Penjualan") {
            $pendapatan_penjualan += $data["Jumlah"];
        } else if ($data["Kategori"] == "Gaji") {
            $pendapatan_gaji += $data["Jumlah"];
        } else if ($data["Kategori"] == "Lain-lain") {
            $pendapatan_lain_lain += $data["Jumlah"];
        }
    } else {
        $biaya[] = $data;
        $total_biaya += $data["Jumlah"];
        if ($data["Kategori"] == "Belanja Stok") {
            $biaya_belanja_stok += $data["Jumlah"];
        } else if ($data["Kategori"] == "Operasional") {
            $biaya_operasional += $data["Jumlah"];
        } else if ($data["Kategori"] == "Penjualan") {
            $biaya_penjualan += $data["Jumlah"];
        } else if ($data["Kategori"] == "Gaji") {
            $biaya_gaji += $data["Jumlah"];
        } else if ($data["Kategori"] == "Lain-lain") {
            $biaya_lain_lain += $data["Jumlah"];
        }
    }
}

$total_laba_bersih = $total_pendapatan - $total_biaya;

// 2.1 pisahin pendapatan per kategorinya
// 3. cari mana yang pengeluaran
// 3.1 pisahin pengeluaran per kategorinya
// 4. hitung laba bersih
