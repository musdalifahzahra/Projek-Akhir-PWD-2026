<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

// 1. baca data/ambil data
$data_transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
// 1.1 simpan data perbaris dari tabel transaksi
$rows = [];
while ($row = mysqli_fetch_assoc($data_transaksi)) {
    $rows[] = $row;
}
// $rows[] (array assoc yg berisi baris-baris data transaksi)
// $row (1 baris data transaksi)


// 2. cari mana yang pendapatan mana yg biaya
$pendapatan = [];
$biaya = [];
foreach ($rows as $data) {
    if ($data["Jenis"] == "Pemasukan") {
        $pendapatan[] = $data;
    } else {
        $biaya[] = $data;
    }
}

// 2.1 pisahin pendapatan per kategorinya
// 3. cari mana yang pengeluaran
// 3.1 pisahin pengeluaran per kategorinya
// 4. hitung laba bersih
