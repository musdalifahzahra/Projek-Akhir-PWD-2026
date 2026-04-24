<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//FUNGSI UNTUK HAPUS
function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM transaksi WHERE No = $id");

    return mysqli_affected_rows($conn);
}

//UNTUK KONDISI KETIKA MENGUBAH DATA
// cek tombol ubah uda d pencet blm
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

