<?php
$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!')
    alert('Data berhasil dihapus!')
    </script>";
}
