<?php
require_once "0-koneksi.php";
// require "0-ubah.php";

// A Menambahkan data transaksi (CREATE)
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

// B. menampilkan data transaksi terbaru (READ)
function transaksi_terbaru()
{
    global $conn;
    $transaksi_terbaru = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY No DESC LIMIT 6");
    $rows = [];
    while ($row = mysqli_fetch_assoc($transaksi_terbaru)) {
        $rows[] = $row;
    }
    return $rows;
}

// C. menghapus data transaksi  (DELETE)
function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM transaksi WHERE No = $id");

    return mysqli_affected_rows($conn);
}
// D. mengubah data transaksi (UPDATE)
function ubah($data)
{
    global $conn;
    //persiapan ubah data
    // ambil data 
    $id = $data["id"];
    $tanggal = $data["tanggal"];
    $keterangan = $data["keterangan"];
    $kategori = $data["kategori"];
    $jenis = $data["jenis"];
    $jumlah = $data["jumlah"];
    $catatan = $data["catatan"];

    $ubah = "UPDATE transaksi SET 
                    Tanggal = '$tanggal',
                    Keterangan = '$keterangan',
                    Kategori = '$kategori',
                    Jenis = '$jenis',
                    Jumlah = '$jumlah',
                    Catatan = '$catatan'
                    WHERE No = $id";

    mysqli_query($conn, $ubah);
    return mysqli_affected_rows($conn);
}

// cek data nerhasil di ubah apa ngga
if (isset($_POST["submit-ubah"])) {
    if (ubah($_POST) > 0) {
        echo "
        <script>
        alert('Data berhasil di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Data gagal di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";
    }
}
