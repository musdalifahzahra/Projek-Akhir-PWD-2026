<?php
session_start();
require_once "3-ubah.php";
require_once "3-functions.php";

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: 1-login.php");
    exit();
}
//cek apakah data berhasil ditambahkan atau tidak
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
            <svg style="color: var(--color-card);" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet-minimal-icon lucide-wallet-minimal">
                <path d="M17 14h.01" />
                <path d="M7 7h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14" />
            </svg>
            <span>Sembako Makmur</span>
        </div>

        <div class="nav-menu">
            <div class="nav-list hidden" id="nav_list">
                <ul>
                    <li><a href="2-dashboard.php">Dashboard</a></li>
                    <li><a href="3-catat-transaksi.php" class="nav-active">Catat Transaksi</a></li>
                    <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                    <li><a href="5-riwayat-transaksi.php">Riwayat Transaksi</a></li>
                </ul>
            </div>


            <div class="icon-list" id="icon_list">
                <span>catat transaksi</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </nav>

    <div class="wrap">
        <!-- PENGISIAN FORM TRANSAKSI -->
        <div class="input-transaksi card">
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
                        <option value="" selected disabled>Pilih Kategori</option>
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
                        <option value="" selected disabled>Pilih Jenis</option>
                        <option value="Masuk">Pemasukan</option>
                        <option value="Keluar">Pengeluaran</option>
                    </select>
                </div>
                <!-- jumlah-->
                <div class="col-md-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                </div>
                <!-- catatan -->
                <div class="col-md-7">
                    <label for="catatan" class="form-label">Catatan</label>
                    <input type="text" class="form-control" id="catatan" name="catatan">
                </div>
                <!-- submit (+catat) -->
                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <button type="submit" class="catat btn btn-primary" id="catat" name="submit" required> +Catat </button>
                </div>
                <br>
            </form>
        </div>


        <!-- MENAMPILKAN DAFTAR TRANSAKSI TERBARU -->
        <?php
        $transaksi_terbaru = transaksi_terbaru(50);
        ?>

        <div class="tampil-transaksi-terbaru card">
            <h5>Transaksi Terbaru</h5>
            <div class="wrap-transaksi">
                <?php foreach ($transaksi_terbaru as $data) : ?>
                    <div class="satu-transaksi">

                        <div class="a">
                            <p class="keterangan"><?= $data['Keterangan'] ?></p>
                            <p class="tanggal-catatan"><?= $data['Tanggal'] . " | " . $data['Catatan'] ?></p>
                        </div>

                        <div class="b">
                            <!-- jumlah --> <!-- jenis -->
                            <?php if ($data['Jenis'] == "Masuk") { ?>
                                <p class="jenis-masuk"><?= $data['Jenis'] ?></p>
                                <p class="jumlah-masuk"><?= "+" . number_format($data['Jumlah'], 0, ',', '.') ?></p>

                            <?php } else { ?>
                                <p class="jenis-keluar"><?= $data['Jenis'] ?></p>
                                <p class="jumlah-keluar"><?= "-" . number_format($data['Jumlah'], 0, ',', '.') ?></p><?php } ?>

                            <!-- ubah -->
                            <button type="button" class="edit btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-ubah<?= $data['No'] ?>">
                                Edit
                            </button>

                            <!-- panggil fungsi u/ mengubah data, modal akan muncul apabila user Pilih ubah -->
                            <?php
                            modal_ubah_data($data);
                            ?>

                            <!-- hapus -->
                            <a class="hapus" href="3-hapus.php?id=<?= $data["No"] ?>" onclick="return confirm('Apakah anda ingin mengapus data tersebut');"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                </svg> </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>
</body>

</html>