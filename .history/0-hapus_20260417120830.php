<?php
$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!');
document.location.href = '3-catat-transaksi.php';
    </script>";
}
