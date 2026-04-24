<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

if($conn -> connect_error){
    die("Maaf koneksi gagal: " )
}