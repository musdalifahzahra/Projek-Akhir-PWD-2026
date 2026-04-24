<?php
require "0-koneksi.php";
require "0-functions.php";

if (!isset($_GET["id"])) {
    header("Location: 3-catat-transaksi.php");
    exit;
}

$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!');
    document.location.href = '3-catat-transaksi.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus!');
    document.location.href = '3-catat-transaksi.php';
    </script>";
}
