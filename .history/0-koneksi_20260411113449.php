<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $row[]= $row;
    }
    return $rows;
}
?>

<?
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data dari database
mysqli_query($conn, "SELECT * FROM ")
?>