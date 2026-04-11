<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
mysqli_query($conn, "SELECT  * FROM transaksi");

?>