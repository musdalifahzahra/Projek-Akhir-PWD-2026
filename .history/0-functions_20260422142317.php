<?php
//ambil data 
$result = mysqli_query($conn, "SELECT * FROM transaksi");
if (!$result) {
    echo mysqli_error($conn);
}

// FUNGSI UNTUK MENAMPILKAN DATA TRANSAKSI TERBARU
function transaksi_terbaru(){
    
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
?>