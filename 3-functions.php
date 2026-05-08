<?php
require_once "0-koneksi.php";

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
function read($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($data)) {
        $rows[] = $row;
    }
    return $rows;
}

// C. menghapus data transaksi  (DELETE)
function hapus($query)
{
    global $conn;
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// D. mengubah data transaksi (UPDATE)
function ubah($data)
{
    global $conn;
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

// panggil fungsi ubah dan cek data berhasil diubah atau tidak
if (isset($_POST["submit-ubah"])) {
    if (ubah($_POST) > 0) {
        header("location: 3-catat-transaksi.php");
        exit();
    } else {
        echo "
        <script>
        alert('Data gagal di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";
    }
}
// E. DATA PENGGUNA
// menambah data oengguna (CREATE)
function tambah_data_pengguna($data_insert)
{
    global $conn;
    $username  = $data_insert["username"];
    $password = $data_insert["password"];
    $role = $data_insert["role"];

    $insert = "INSERT INTO users
              VALUES (null, '$username', '$password', '$role')
              ";

    mysqli_query($conn, $insert);

    //mengembalikan nilai, cek berhasil apa ngga. kalo (1) = berhasil, (-1)= tidak berhasil;
    return mysqli_affected_rows($conn);
}


// mengubah data pengguna(UPDATE)
function ubah_pengguna($data)
{
    global $conn;
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

// panggil fungsi ubah dan cek data berhasil diubah atau tidak
if (isset($_POST["submit-ubah"])) {
    if (ubah_pengguna($_POST) > 0) {
        header("location: 3-catat-transaksi.php");
        exit();
    } else {
        echo "
        <script>
        alert('Data gagal di ubah');
        document.location.href = '3-catat-transaksi.php';
        </script>
        ";
    }
}
