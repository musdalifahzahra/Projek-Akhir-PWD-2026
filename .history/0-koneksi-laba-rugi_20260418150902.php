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
// total pendapatan
$pendapatan = [];
$total_pendapatan;
$pendapatan_penjualan;
$pendapatan_belanja_stok;
$pendapatan_operasional;
$pendapatan_gaji;
// total biaya
$biaya = [];
$total_biaya;
$biaya_penjualan;
$biaya_belanja_stok;
$biaya_operasional;
$biaya_gaji;
// total  laba
$total_laba_bersih;

foreach ($rows as $data) {
    if ($data["Jenis"] == "Pemasukan") {
        $pendapatan[] = $data;
        $total_pendapatan += $data["Jumlah"];
        if($data["Kategori"] == "Belanja Stok"){$pendapatan_belanja_stok += $data["Jumlah"];}
        else if))["Kategori"] == "Belanja Stok"){$pendapatan_belanja_stok += $data["Jumlah"];}
    } else {
        $biaya[] = $data;
        $total_biaya += $data["Jumlah"];
    }
}

// 2.1 pisahin pendapatan per kategorinya
// 3. cari mana yang pengeluaran
// 3.1 pisahin pengeluaran per kategorinya
// 4. hitung laba bersih
