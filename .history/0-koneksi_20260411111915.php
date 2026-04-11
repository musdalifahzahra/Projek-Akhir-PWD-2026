<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

while($data= mysqli_)

?>