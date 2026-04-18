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
$total_pendapatand = 0;
$pendapatan_penjualand = 0;
$pendapatan_belanja_stokd = 0;
$pendapatan_operasionald = 0;
$pendapatan_gajid = 0;
$pendapatan_lain_laind = 0;
// total biaya
$biaya = [];
$total_biayad = 0;
$biaya_penjualand = 0;
$biaya_belanja_stokd = 0;
$biaya_operasionald = 0;
$biaya_gajid = 0;
$biaya_lain_laind = 0;


// total  laba
$total_laba_bersihd = 0;

foreach ($rows as $data) {
    if ($data["Jenis"] == "Pemasukan") {
        $pendapatan[] = $data;
        $total_pendapatan += $data["Jumlah"];
        if($data["Kategori"] == "Belanja Stok"){$pendapatan_belanja_stok += $data["Jumlah"];}
        else if($data["Kategori"] == "Operasional"){$pendapatan_operasional += $data["Jumlah"];}
        else if($data["Kategori"] == "Penjualan"){$pendapatan_penjualan += $data["Jumlah"];}
        else if($data["Kategori"] == "Gaji"){$pendapatan_gaji += $data["Jumlah"];}
        else if($data["Kategori"] == "Lain-lain"){$pendapatan_lain_lain += $data["Jumlah"];}
    } else {
        $biaya[] = $data;
        $total_biaya += $data["Jumlah"];
        if($data["Kategori"] == "Belanja Stok"){$biaya_belanja_stok += $data["Jumlah"];}
        else if($data["Kategori"] == "Operasional"){$biaya_operasional += $data["Jumlah"];}
        else if($data["Kategori"] == "Penjualan"){$biaya_penjualan += $data["Jumlah"];}
        else if($data["Kategori"] == "Gaji"){$biaya_gaji += $data["Jumlah"];}
        else if($data["Kategori"] == "Lain-lain"){$biaya_lain_lain += $data["Jumlah"];}
    }
}

$total_laba_bersih = $total_pendapatan - $total_biaya;

// 2.1 pisahin pendapatan per kategorinya
// 3. cari mana yang pengeluaran
// 3.1 pisahin pengeluaran per kategorinya
// 4. hitung laba bersih
