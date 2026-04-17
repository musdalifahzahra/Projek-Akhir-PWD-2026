<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "laporan_keuangan");

//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

//FUNGSI UNTUK MENAMBAHKAN DATA (INSERT)
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

// FUNGSI UNTUK BACA DATA DARI DATABASE, dipake bwt nampilin transaksi terbaru
function nampilin_data($query)
{
    global $conn;

    $result = mysqli_query($conn, $query);
    //$rows = wadah untuk menyimpan baris-baris yg akan di ambil 
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    // mengmebalikan semua baris-baris($row) yg uda kesimpan di $rows
    return $rows;
}

//FUNGSI UNTUK HAPUS
function hapus($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM transaksi WHERE No = $id");

    return mysqli_affected_rows($conn);
}

//UNTUK KONDISI KETIKA MENG UBAH DATA
// cek tombol ubah uda d pencet blm
if (isset($_POST["submit-ubah"])) {
global $conn;
    //pross ubah data
    mysqli_query($conn, 'UPDATE transaksi SET 
                            $tanggal = $_POST["tanggal"],
                            $keterangan = $_POST["keterangan"],
                            $kategori = $_POST["kategori"],
                            $jenis = $_POST["jenis"],
                            $jumlah = $_POST["jumlah"],
                            $catatan = $_POST["catatan"]
                            WHERE $
                            ' );



    // cek data nerhasil di ubah apa ngga
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