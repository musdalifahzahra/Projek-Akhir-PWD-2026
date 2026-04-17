<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

//FUNGSI UNTUK MENAMBAHKAN DATA (INSERT)
function tambah_data($data)
{

    global $conn;
    $tanggal = $data["tanggal"];
    $keterangan = $data["keterangan"];
    $kategori = $data["kategori"];
    $jenis = $data["jenis"];
    $jumlah = $data["jumlah"];
    $catatan = $data["catatan"];

    $insert = "INSERT INTO transaksi
              VALUES (null, '$tanggal', '$keterangan', '$kategori', '$jenis', '$jumlah', '$catatan')
              ";

    mysqli_query($conn, $insert);

?>