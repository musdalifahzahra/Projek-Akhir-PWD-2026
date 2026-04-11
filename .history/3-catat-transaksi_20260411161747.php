<?php
//koneksi ke database
require "0-koneksi.php";

//INPUT FORM TRANSAKSI (INSERT)
//cek submit uda di pencet blm
$berhasil = false;
$tanda_jenis = "+";
if (isset($_POST["submit"])) {
    //ambil data dari elemen form
    $tanggal = $_POST["tanggal"];
    $keterangan = $_POST["keterangan"];
    $kategori = $_POST["kategori"];
    $jenis = $_POST["jenis"];
    $jumlah = $_POST["jumlah"];
    $catatan = $_POST["catatan"];



    //query isert data
    $insert = "INSERT INTO transaksi
              VALUES (null, '$tanggal', '$keterangan', '$kategori', '$jenis', '$jumlah', '$catatan')
              ";
    mysqli_query($conn, $insert);

    //cek data berhasil di tambahkan apa ngga
    if (mysqli_affected_rows($conn) > 0) {
        $berhasil = true;
        header("Location: 3-catat-transaksi.php");
    }
}

//BACA DATA TRANSAKSI DRI DATABASE
$select = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY No DESC LIMIT 6")

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="3-catat-transaksi-css.css">
</head>

<body>
    <nav>
        <div class="profile">
            <span>sembako</span>
        </div>
        <div class="nav_list">
            <ul>
                <li><a href="2-dashboard.php">Dashboard</a></li>
                <li><a href="3-catat-transaksi.php" class="nav-active">Catat Transaksi</a></li>
                <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                <li><a href="5-laporan.php">Riwayat Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="wrap">
        <!-- input transaksi -->
        <div class="input-transaksi template">
            <form class="row g-3" method="POST">
                <h5>Catat Transaksi Baru</h5><br>
                <!-- tanggal -->
                <div class="col-md-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" require>
                </div>
                <!-- keterangan -->
                <div class="col-md-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" require>
                </div>
                <!-- kategori -->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" aria-label="Default select example" name="kategori" require>
                        <option value="Penjualan">Penjualan</option>
                        <option value="Belanja Stok">Belanja Stok</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Gaji">Gaji</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <!-- jenis -->
                <div class="col-md-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis" aria-label="Default select example" name="jenis" require>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <!-- jumlah-->
                <div class="col-md-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" require>
                </div>
                <!-- catatan -->
                <div class="col-md-7">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" class="form-control" id="catatan" name="catatan">
                </div>
                <!-- submit +catat -->
                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <button type="submit" class="btn btn-primary" id="catat" name="submit" require> +Catat </button>
                </div>
                <br>
                <?php if ($berhasil === true) { ?>
                    <span>Data transaksi berhasil ditambahkan</span>
                <?php } ?>
            </form>
        </div>

        <!-- transaksi terbaru -->
        <div class="tampil-transaksi-terbaru template">
            <h5>Transaksi Terbaru</h5><br>
            <div class="wrap-transaksi">
                <?php while ($data = mysqli_fetch_array($select)) { ?>
                    <div class="satu-transaksi">
                        <div class="a">
                            <p class="keterangan"><?= $data['Keterangan'] ?></p>
                            <p class="tanggal-catatan"><?= $data['Tanggal'] . " | " . $data['Catatan'] ?></p>
                        </div>
                         <?php
                                if ($jenis === "Pengeluaran") {
                                    $tanda_jenis = "-";
                                } else if ($jenis === "Pemasukan") {
                                    $tanda_jenis = "+";
                                } ?>
                        <div class="b">

                            <p class="jenis"><?= $data['Jenis'] ?></p>
                            <p><?= $tanda_jenis . $data['Jumlah'] ?></p>
                            <button class="edit">Edit</button>
                            <button class="hapus"> x </button>
                        </div>
                    </div>
                <?php }; ?>
            </div>
        </div>
        <!-- <table border="1">
                <tr>
                    <td>keterangan</td>
                    <td rowspan="2">jenis</td>
                    <td rowspan="2">jumlah</td>
                    <td rowspan="2">edit</td>
                    <td rowspan="2">hapus</td>
                </tr>
                <tr>
                    <td>tanggal | catatan</td>
                </tr>
            </table> -->


    </div>
</body>

</html>