<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

//FUNGSI UNTUK MENAMBAHKAN DATA (INSERT)
function tambah_data($data_insert)
{

    global $conn;
    $tanggal = $data_insert["tanggal"];
    $keterangan = $data_insert["keterangan"];
    $kategori = $data_insert["kategori"];
    $jenis = $data_insert["jenis"];
    $jumlah = $data_insert["jumlah"];
    $catatan = $data_insert["catatan"];

    $insert = "INSERT INTO transaksi
              VALUES (null, '$tanggal', '$keterangan', '$kategori', '$jenis', '$jumlah', '$catatan')
              ";

    mysqli_query($conn, $insert);

    //mengembalikan nilai, cek berhasil apa ngga. kalo (1) = berhasil, (-1)= tidak berhasil;
    return mysqli_affected_rows($conn);
}

// FUNGSI UNTUK BACA DATA DARI DATABASE, dipake bwt nampilin transaksi terbaru
function nampilin_data($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    //$rows = wadah untuk menyimpan baris-baris yg akan di ambil 
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    // mengmebalikan semua baris-baris($row) yg uda kesimpan di $rows
    return $rows;
}

//FUNGSI UNTUK HAPUS
$id = $_GET["id"];
function (hapus($id) > )