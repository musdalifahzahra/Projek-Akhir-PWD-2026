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
                    <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                    <li><a href="4-laba-rugi.php" class="nav-active">Laba Rugi</a></li>
                    <li><a href="5-riwayat-transaksi.php">Riwayat Transaksi</a></li>
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
                <span><?= "Rp" . number_format($total_pendapatan, 0, ',', '.') ?></span>
            </div>
            <div class="rincian total-biaya">
                <h5>Total Biaya</h5>
                <span><?= "Rp" . number_format($total_biaya, 0, ',', '.') ?></span>
            </div>
            <div class="rincian laba-bersih">
                <h5>Laba Bersih</h5>
                <span><?= "Rp" . number_format($total_laba_bersih, 0, ',', '.') ?></span>
            </div>
        </div>

        <!-- bawah -->
        <div class="laporan-laba-rugi card">
            <h5 style="margin-bottom: 20px;">Laporan Laba Rugi</h5>
            <div class="laporan-pendapatan">
                <!-- PENDAPATAN -->
                <div class="baris-laporan-header">
                    <span>PEMASUKAN</span>
                </div>

                <?php if ($pendapatan_penjualan > 0) { ?>
                    <div class="baris-laporan">
                        <span>Penjualan</span>
                        <span><?= "Rp" . number_format($pendapatan_penjualan, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_belanja_stok > 0) { ?>
                    <div class="baris-laporan">
                        <span>Belanja Stok</span>
                        <span><?= "Rp" . number_format($pendapatan_belanja_stok, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_operasional > 0) { ?>
                    <div class="baris-laporan">
                        <span>Operasional</span>
                        <span><?= "Rp" . number_format($pendapatan_operasional, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_gaji > 0) { ?>
                    <div class="baris-laporan">
                        <span>Gaji</span>
                        <span><?= "Rp" . number_format($pendapatan_gaji, 0, ',', '.'); ?></span>
                    </div>
                <?php } ?>

                <?php if ($pendapatan_lain_lain > 0) { ?>
                    <div class="baris-laporan">
                        <span>Lain_lain</span>
                        <span><?= "Rp" . number_format($pendapatan_lain_lain, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <div class="baris-laporan-footer">
                    <span>Total Pemasukan</span>
                    <span><?= "Rp" . number_format($total_pendapatan, 0, ',', '.') ?></span>
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
                        <span><?= "Rp" . number_format($biaya_penjualan, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_belanja_stok > 0) { ?>
                    <div class="baris-laporan">
                        <span>Belanja Stok</span>
                        <span><?= "Rp" . number_format($biaya_belanja_stok, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_operasional > 0) { ?>
                    <div class="baris-laporan">
                        <span>Operasional</span>
                        <span><?= "Rp" . number_format($biaya_operasional, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_gaji > 0) { ?>
                    <div class="baris-laporan">
                        <span>Gaji</span>
                        <span><?= "Rp" . number_format($biaya_gaji, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <?php if ($biaya_lain_lain > 0) { ?>
                    <div class="baris-laporan">
                        <span>Lain_lain</span>
                        <span><?= "Rp" . number_format($biaya_lain_lain, 0, ',', '.') ?></span>
                    </div>
                <?php } ?>

                <div class="baris-laporan-footer">
                    <span>Total Pengeluaran</span>
                    <span><?= "Rp" . number_format($total_biaya, 0, ',', '.') ?></span>
                </div>


            </div>

            <!-- LABA BERSIH -->
            <br>
            <div class="laporan-laba-bersih">
                <div class="baris-laporan-header">
                    <span>LABA BERSIH</span>
                    <span><?= "Rp" . number_format($total_laba_bersih, 0, ',', '.') ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>