<?php

session_start();

if (!isset($_SESSION["username"])) {
    header("location: 1-login.php");
    exit();
}

if (isset($_POST['simpan_profil'])) {
    $_SESSION["nama_toko"]      = trim($_POST["nama_toko"]);
    $_SESSION["deskripsi_toko"] = trim($_POST["deskripsi_toko"]);
    header("location: 2-dashboard.php");
    exit();
}

require "0-koneksi.php";

$nama_toko      = $_SESSION["nama_toko"]      ?? "Toko Sembako Makmur";
$deskripsi_toko = $_SESSION["deskripsi_toko"] ?? "Menyediakan kebutuhan sembako sehari-hari dengan harga terjangkau.";

$bulan_ini = date("Y-m");

$total_income = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi
     WHERE Jenis='Pemasukan' AND DATE_FORMAT(Tanggal,'%Y-%m')='$bulan_ini'"
))['t'] ?? 0;

$total_expense = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi
     WHERE Jenis='Pengeluaran' AND DATE_FORMAT(Tanggal,'%Y-%m')='$bulan_ini'"
))['t'] ?? 0;

$laba_bersih = $total_income - $total_expense;

$total_tx = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT COUNT(*) AS t FROM transaksi"
))['t'] ?? 0;

$q_recent = mysqli_query(
    $conn,
    "SELECT * FROM transaksi ORDER BY No DESC LIMIT 5"
);

function formatRp($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Laporan Keuangan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="2-dashboard-css.css">
</head>

<body>

    <nav>
        <div class="profile">
            <span><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-building-fill" viewBox="0 0 16 16">
                    <path d="M3 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h3v-3.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V16h3a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1zm1 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                </svg> Toko Sembako Makmur</span>
        </div>

        <div class="nav-menu">
            <div class="nav-list hidden" id="nav_list">
                <ul>
                    <li><a href="2-dashboard.php" class="nav-active">Dashboard</a></li>
                    <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                    <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                    <li><a href="5-laporan.php">Riwayat Transaksi</a></li>
                </ul>
            </div>
            <div class="icon-list" id="icon_list">
                <span>Dashboard</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>
    </nav>

    <div class="wrap">

        <!-- BANNER PROFIL -->
        <div class="profile-section">
            <div class="profile-logo">🏪</div>
            <div class="profile-info">
                <h2><?= htmlspecialchars($nama_toko) ?></h2>
                <p><?= htmlspecialchars($deskripsi_toko) ?></p>
            </div>
            <a href="#" class="edit-profile-btn"
                data-bs-toggle="modal" data-bs-target="#modalProfil">
                ✏️ Edit Profil
            </a>
        </div>

        <!-- 4 SUMMARY CARDS -->
        <div class="summary-grid">

            <div class="summary-card card-income">
                <div class="summary-label" style="color:#15803d;">Pemasukan Bulan Ini</div>
                <div class="summary-value" style="color:#15803d;"><?= formatRp($total_income) ?></div>
            </div>

            <div class="summary-card card-expense">
                <div class="summary-label" style="color:#b91c1c;">Pengeluaran</div>
                <div class="summary-value" style="color:#b91c1c;"><?= formatRp($total_expense) ?></div>
            </div>

            <div class="summary-card card-profit">
                <div class="summary-label" style="color:#1e3a8a;">Laba Bersih</div>
                <div class="summary-value"
                    style="color:<?= $laba_bersih >= 0 ? '#1d4ed8' : '#dc2626' ?>;">
                    <?= formatRp($laba_bersih) ?>
                </div>
            </div>

            <div class="summary-card card-count">
                <div class="summary-label" style="color:#92400e;">Total Transaksi</div>
                <div class="summary-value" style="color:#92400e;"><?= $total_tx ?></div>
            </div>

        </div>

        <!-- TRANSAKSI TERBARU -->
        <div class="card-custom">
            <div class="section-title">📋 Transaksi Terbaru</div>

            <?php if (mysqli_num_rows($q_recent) === 0): ?>
                <p style="color:#64748b;font-size:14px;text-align:center;padding:24px 0;">
                    Belum ada transaksi.
                    <a href="3-catat-transaksi.php" style="color:#1d4ed8;font-weight:700;">Catat sekarang →</a>
                </p>
            <?php else: ?>
                <?php while ($row = mysqli_fetch_assoc($q_recent)): ?>
                    <div class="tx-row">
                        <div>
                            <div class="tx-desc"><?= htmlspecialchars($row['Keterangan']) ?></div>
                            <div class="tx-cat"><?= htmlspecialchars($row['Kategori']) ?></div>
                        </div>
                        <span class="badge-<?= $row['Jenis'] === 'Pemasukan' ? 'masuk' : 'keluar' ?>">
                            <?= $row['Jenis'] ?>
                        </span>
                        <div class="tx-date"><?= date('d M Y', strtotime($row['Tanggal'])) ?></div>
                        <div class="<?= $row['Jenis'] === 'Pemasukan' ? 'amount-masuk' : 'amount-keluar' ?>">
                            <?= $row['Jenis'] === 'Pemasukan' ? '+' : '−' ?><?= formatRp($row['Jumlah']) ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>

            <div class="mt-3 text-end">
                <a href="5-laporan.php" class="btn btn-primary btn-sm">Lihat Semua →</a>
            </div>
        </div>

    </div>

    <!-- MODAL EDIT PROFIL -->
    <div class="modal fade" id="modalProfil" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header" style="background:#1e3a8a;color:white;">
                        <h5 class="modal-title">✏️ Edit Profil Perusahaan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input type="text" class="form-control" name="nama_toko"
                                value="<?= htmlspecialchars($nama_toko) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi_toko"
                                rows="3"><?= htmlspecialchars($deskripsi_toko) ?></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan_profil" class="btn btn-primary">💾 Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>