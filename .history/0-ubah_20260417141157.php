<?php
require "0-koneksi.php";

// cek tombol edit uda d pencet blm
if (isset($_POST["submit"])) {
    // cek data nerhasil di ubah apa ngga
    if (ubah($_POST) > 0) {
        echo"
        <script>
        alert('Data berhasol di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";
    } else{echo"
        <script>
        alert('Data gagal di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";}
}
