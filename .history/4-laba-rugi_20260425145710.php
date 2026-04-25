<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: 1-login.php");
    exit();
}
require "4-data-laba-rugi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="4-laba-rugi-css.css">
</head>

<body>
    <nav>
        <div class="profile">
            <span>sembako</span>
        </div>

        <div class="nav-menu">
            <div class="nav-list hidden" id="nav_list">
                <ul>
                    <li><a href="2-dashboard.php">Dashboard</a></li>
                    <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                    <li><a href="4-laba-rugi.php" class="nav-active">Laba Rugi</a></li>
                    <li><a href="5-laporan.php">Riwayat Transaksi</a></li>
                </ul>
            </div>
            <div class="icon-list" id="icon_list">
                <span>Laba Rugi</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </nav>


    <div class="wrap">
        <!-- atas -->
        <div class=" wrap-rincian">
            <div class="rincian total-pendapatan">
                <h5>Total Pemasukan</h5>
                <span><?= "Rp." . $total_pendapatan; ?></span>
            </div>
            <div class="rincian total-biaya">
                <h5>Total Biaya</h5>
                <span><?= "Rp." . $total_biaya; ?></span>
            </div>
            <div class="rincian laba-bersih">
                <h5>Laba Bersih</h5>
                <span><?= "Rp." . $total_laba_bersih; ?></span>
            </div>
        </div>

        <!-- bawah -->
        <div class="laporan-laba-rugi card">
            <h5>Laporan Laba Rugi</h5>
            <div class="laporan-pendapatan">
                <!-- PENDAPATAN -->
                <div class="baris-laporan-header">
                    <span>PEMASUKAN</span>
                </div>

                <?php if ($pendapatan_penjualan > 0) { ?>
                    <div class="baris-laporan">
                        <span>Penjualan</span>
                        <span><?= "Rp. " . $pendapatan_penjualan; ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_belanja_stok > 0) { ?>
                    <div class="baris-laporan">
                        <span>Belanja Stok</span>
                        <span><?= "Rp. " . $pendapatan_belanja_stok; ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_operasional > 0) { ?>
                    <div class="baris-laporan">
                        <span>Operasional</span>
                        <span><?= "Rp. " . $pendapatan_operasional; ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_gaji > 0) { ?>
                    <div class="baris-laporan">
                        <span>Gaji</span>
                        <span><?= "Rp. " . $pendapatan_gaji; ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_lain_lain > 0) { ?>
                    <div class="baris-laporan">
                        <span>Lain_lain</span>
                        <span><?= "Rp. " . $pendapatan_lain_lain; ?></span>
                    </div>
                <?php } ?>

                <div class="baris-laporan-footer">
                    <span>Total Pemasukan</span>
                    <span><?= "Rp. " . $total_pendapatan ?></span>
                </div>
            </div>
            <br>

            <!-- PENGELUARAN -->
            <div class="laporan-biaya">
                <div class="baris-laporan-header">
                    <span>PENGELUARAN</span>
                </div>

                <?php if ($biaya_penjualan > 0) { ?>
                    <div class="baris-laporan">
                        <span>Penjualan</span>
                        <span><?= "Rp. " . $biaya_penjualan; ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_belanja_stok > 0) { ?>
                    <div class="baris-laporan">
                        <span>Belanja Stok</span>
                        <span><?= "Rp. " . $biaya_belanja_stok; ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_operasional > 0) { ?>
                    <div class="baris-laporan">
                        <span>Operasional</span>
                        <span><?= "Rp. " . $biaya_operasional; ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_gaji > 0) { ?>
                    <div class="baris-laporan">
                        <span>Gaji</span>
                        <span><?= "Rp. " . $biaya_gaji; ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_lain_lain > 0) { ?>
                    <div class="baris-laporan">
                        <span>Lain_lain</span>
                        <span><?= "Rp. " . $biaya_lain_lain; ?></span>
                    </div>
                <?php } ?>

                <div class="baris-laporan-footer">
                    <span>Total biaya</span>
                    <span><?= "Rp. " . $total_biaya ?></span>
                </div>


            </div>

            <!-- LABA BERSIH -->
            <br>
            <div class="laporan-laba-bersih">
                <div class="baris-laporan-header">
                    <span>LABA BERSIH</span>
                    <span><?= "Rp. " . $total_laba_bersih; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>