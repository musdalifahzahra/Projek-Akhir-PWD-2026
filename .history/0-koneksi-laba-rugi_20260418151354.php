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
$pendapatan_lain_lain;
// total biaya
$biaya = [];
$total_biaya;
$biaya_penjualan;
$biaya_belanja_stok;
$biaya_operasional;
$biaya_gaji;
$biaya_lain_lain;


// total  laba
$total_laba_bersih;

foreach ($rows as $data) {
    if ($data["Jenis"] == "Pemasukan") {
        $pendapatan[] = $data;
        $total_pendapatan += $data["Jumlah"];
        if($data["Kategori"] == "Belanja Stok"){$pendapatan_belanja_stok += $data["Jumlah"];}
        else if(["Kategori"] == "Operasional"){$pendapatan_operasional += $data["Jumlah"];}
        else if(["Kategori"] == "Penjualan"){$pendapatan_penjualan += $data["Jumlah"];}
        else if(["Kategori"] == "Gaji"){$pendapatan_gaji += $data["Jumlah"];}
        else if(["Kategori"] == "Gaji"){$pendapatan_gaji += $data["Jumlah"];}
        else if(["Kategori"] == "Lain-lain"){$pendapatan_lain_lain += $data["Jumlah"];}
    } else {
        $biaya[] = $data;
        $total_biaya += $data["Jumlah"];
        if($data["Kategori"] == "Belanja Stok"){$biaya_belanja_stok += $data["Jumlah"];}
        else if(["Kategori"] == "Operasional"){$biaya_operasional += $data["Jumlah"];}
        else if(["Kategori"] == "Penjualan"){$biaya_penjualan += $data["Jumlah"];}
        else if(["Kategori"] == "Gaji"){$biaya_gaji += $data["Jumlah"];}
        else if(["Kategori"] == "Gaji"){$biaya_gaji += $data["Jumlah"];}
        else if(["Kategori"] == "Lain-lain"){$biaya_lain_lain += $data["Jumlah"];}
    }
}

$total_laba_bersih = $total_pendapatan - 

// 2.1 pisahin pendapatan per kategorinya
// 3. cari mana yang pengeluaran
// 3.1 pisahin pengeluaran per kategorinya
// 4. hitung laba bersih
