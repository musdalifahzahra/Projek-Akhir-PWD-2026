<?php
//koneksi ke database
require "0-koneksi.php";

//INPUT FORM TRANSAKSI (INSERT)
//cek submit uda di pencet blm
if (isset($_POST["submit"])) {
    if (tambah_data($_POST) < 0) {
        echo "Data gagal ditambahkan";
    }
}
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
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>
                <!-- keterangan -->
                <div class="col-md-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                </div>
                <!-- kategori -->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" aria-label="Default select example" name="kategori" required>
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
                    <select class="form-select" id="jenis" aria-label="Default select example" name="jenis" required>
                        <option value="Masuk">Pemasukan</option>
                        <option value="Keluar">Pengeluaran</option>
                    </select>
                </div>
                <!-- jumlah-->
                <div class="col-md-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" required>
                </div>
                <!-- catatan -->
                <div class="col-md-7">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" class="form-control" id="catatan" name="catatan">
                </div>
                <!-- submit (+catat) -->
                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <button type="submit" class="btn btn-primary" id="catat" name="submit" required> +Catat </button>
                </div>
                <br>
            </form>
        </div>


        <!-- MENAMPILKAN DAFTRA TRANSAKSI TERBARU -->
        <?php
        //  $transaksi_terbaru = nyimpan data yg diambil dari fungsi transaksi()
        // manggil fungsi transaksi sambil emmbawa parameter yg berfungsi u/ ngambil nya cuma 6
        $transaksi_terbaru = nampilin_data("SELECT * FROM transaksi ORDER BY No DESC LIMIT 6");
        ?>

        <div class="tampil-transaksi-terbaru template">
            <h5>Transaksi Terbaru</h5><br>
            <div class="wrap-transaksi">
                <?php foreach ($transaksi_terbaru as $data) : ?>
                    <div class="satu-transaksi">

                        <div class="a">
                            <p class="keterangan"><?= $data['Keterangan'] ?></p>
                            <p class="tanggal-catatan"><?= $data['Tanggal'] . " | " . $data['Catatan'] ?></p>
                        </div>

                        <div class="b">
                            <p><?= $data['Jumlah'] ?></p>
                            <!-- MODAL POP UP UBAH -->
                            <!-- Button modal ubah -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-ubah<?= $data['No'] ?>">
                                Ubah
                            </button>
                            <!-- tampilan pop up ubah -->
                            <div class="modal fade" id="modal-ubah<?= $data['No'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog template">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="staticBackdropLabel">Ubah data transaksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- input transaksi -->
                                            <div class="input-transaksi template">

                                                <!-- kalo biasnya kirim datanya lewat a href GET, kalo ini pake form POST -->
                                                <form class="row g-3" action="0-ubah.php" method="POST">
                                                    <!-- membawa id, id  yang sesuai dengan data yg mau di edit -->
                                                     <input type="hidden" name="id" value="<?= $data['No'] ?>">

                                                    <!-- tanggal -->
                                                    <div class="col-md-3">
                                                        <label for="tanggal" class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=  ?>$data['Tanggal']" required>
                                                    </div>
                                                    <!-- keterangan -->
                                                    <div class="col-md-3">
                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?=  ?>$data['Keterangan']" required>
                                                    </div>
                                                    <!-- kategori -->
                                                    <div class="col-md-3">
                                                        <label for="inputZip" class="form-label">Kategori</label>
                                                        <select class="form-select" id="kategori" aria-label="Default select example" name="kategori" value="<?=  ?>$data['Kategori']" required>
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
                                                        <select class="form-select" id="jenis" aria-label="Default select example" name="jenis" value="<?=  ?>$data['Jenis']" required>
                                                            <option value="Masuk">Pemasukan</option>
                                                            <option value="Keluar">Pengeluaran</option>
                                                        </select>
                                                    </div>
                                                    <!-- jumlah-->
                                                    <div class="col-md-3">
                                                        <label for="jumlah" class="form-label">Jumlah</label>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?=  ?>$data['Jumlah']" required>
                                                    </div>
                                                    <!-- catatan -->
                                                    <div class="col-md-7">
                                                        <label for="catatan" class="form-label">Catatan</label>
                                                        <input type="text" class="form-control" id="catatan" name="catatan" value="<?=  $data['Catatan']?>">
                                                    </div>
                                                    <!-- submit (ubah) -->
                                                    <div class="col-md-2 d-flex align-items-end justify-content-end">
                                                        <button type="submit" class="btn btn-primary" id="catat" name="submit-ubah" required> Ubah </button>
                                                    </div>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Understood</button>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <!-- <a href="0-ubah.php?id=<?= $data["No"] ?>"> Edit </a> -->
                            <a href="0-hapus.php?id=<?= $data["No"] ?>" onclick="return confirm('Apakah anda ingin mengapus data tersebut');"> Hapus </a>
                            <!-- <button class="edit">Edit</button>
                            <button class="hapus"> x </button> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- masukin bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
</body>

</html>