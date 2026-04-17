<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
var_dump($result);
if (!$result) {
    echo mysqli_error($conn);
}

//FUNGSI UNTUK MENAMBAHKAN DATA (INSERT)
function tambah_data($data){
     $tanggal = $["tanggal"];
    $keterangan = $["keterangan"];
    $kategori = $["kategori"];
    $jenis = $["jenis"];
    $jumlah = $["jumlah"];
    $catatan = $["catatan"];
}



?>