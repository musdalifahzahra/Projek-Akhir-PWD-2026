<?php require "0-koneksi-laba-rugi.php"; ?>

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
        <div class="nav_list">
            <ul>
                <li><a href="2-dashboard.php">Dashboard</a></li>
                <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                <li><a href="4-laba-rugi.php" class="nav-active">Laba Rugi</a></li>
                <li><a href="5-laporan.php">Riwayat Transaksi</a></li>
            </ul>
        </div>
    </nav>

    <div class="wrap">
        <!-- atas -->
        <div class=" wrap-rincian">
            <div class="rincian total-pendapatan">
                <h5>Total Pendapatan</h5>
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
                    <span>PENDAPATAN</p>
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
                    <span>Total Pendapatan</span>
                    <span><?= "Rp. " . $total_pendapatan ?></span>
                </div>
            </div>
            <br>
            <!-- BIAYA -->
            <div class="laporan-biaya">
                <div class="baris-laporan-header">
                    <p>BIAYA OPERASIONAL</p>
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
                    <P>LABA BERSIH</P>
                </div>
            </div>
        </div>
    </div>
</body>

</html>