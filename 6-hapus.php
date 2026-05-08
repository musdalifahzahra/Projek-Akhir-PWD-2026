<?php
require "0-koneksi.php";
require "3-functions.php";

if (!isset($_GET["id"])) {
    header("Location: 6-pengguna.php");
    exit;
}

$id = $_GET["id"];
$query = "DELETE FROM users WHERE id = $id";


if (hapus($query) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!');
    document.location.href = '6-pengguna.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus!');
    document.location.href = '6-pengguna.php';
    </script>";
}
