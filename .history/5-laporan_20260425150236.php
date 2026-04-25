<?php

session_start();
if (!isset($_SESSION["username"])) { header("location: 1-login.php"); exit(); }
require "0-koneksi.php";

$nama_toko = $_SESSION["nama_toko"] ?? "Toko Sembako";

if (isset($_GET["hapus"])) {
    $no = intval($_GET["hapus"]);
    mysqli_query($conn, "DELETE FROM transaksi WHERE No=$no");
    header("Location: 5-laporan.php?hapus_ok=1");
    exit();
}

$f_jenis = $_GET["jenis"] ?? "";
$f_kat   = $_GET["kat"]   ?? "";
$f_bulan = $_GET["bulan"] ?? "";

$parts = [];
if ($f_jenis) $parts[] = "Jenis='"    . mysqli_real_escape_string($conn,$f_jenis) . "'";
if ($f_kat)   $parts[] = "Kategori='" . mysqli_real_escape_string($conn,$f_kat)   . "'";
if ($f_bulan) $parts[] = "DATE_FORMAT(Tanggal,'%Y-%m')='" . mysqli_real_escape_string($conn,$f_bulan) . "'";

$where = $parts ? "WHERE ".implode(" AND ",$parts) : "";

// Query utama
$q_all = mysqli_query($conn, "SELECT * FROM transaksi $where ORDER BY No DESC");

// Total untuk summary mini
$p_i = array_merge($parts, ["Jenis='Pemasukan'"]);
$p_e = array_merge($parts, ["Jenis='Pengeluaran'"]);
$total_i = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi WHERE ".implode(" AND ",$p_i)))['t'] ?? 0;
$total_e = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi WHERE ".implode(" AND ",$p_e)))['t'] ?? 0;

function formatRp($a) { return "Rp " . number_format($a,0,',','.'); }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="5-laporan-css.css">
</head>
<body>

<nav>
        <div class="profile">
            <span>Toko Sembako Makmur</span>
        </div>

        <div class="nav-menu">
            <div class="nav-list hidden" id="nav_list">
                <ul>
                    <li><a href="2-dashboard.php">Dashboard</a></li>
                    <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                    <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                    <li><a href="5-laporan.php" class="nav-active">Riwayat Transaksi</a></li>
                </ul>
            </div>
            <div class="icon-list" id="icon_list">
                <span>Riwayat Transaksi</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                </svg>
            </div>
        </div>

    </nav>
<!-- <nav>
    <div class="profile"><?//= htmlspecialchars(substr($nama_toko,0,16)) ?></div>
    <div class="nav_list"><ul>
        <li><a href="2-dashboard.php">Dashboard</a></li>
        <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
        <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
        <li><a href="5-laporan.php" class="nav-active">Riwayat Transaksi</a></li>
        <li><a href="6-logout.php">Logout</a></li>
    </ul></div>
</nav> -->

<div class="wrap">
    <h4 style="font-weight:900;color:#1e3a8a;margin-bottom:20px;">📜 Semua Transaksi</h4>

    <!-- ALERT -->
    <?php if (isset($_GET['hapus_ok'])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            🗑️ Transaksi berhasil dihapus!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- FORM FILTER -->
    <form method="GET" action="">
        <div class="filter-wrap">
            <div>
                <label>Jenis</label>
                <select name="jenis">
                    <option value="">Semua Jenis</option>
                    <option value="Pemasukan"   <?= $f_jenis==='Pemasukan'  ?'selected':''?>>Pemasukan</option>
                    <option value="Pengeluaran" <?= $f_jenis==='Pengeluaran'?'selected':''?>>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label>Kategori</label>
                <select name="kat">
                    <option value="">Semua Kategori</option>
                    <?php foreach(['Penjualan','Belanja Stok','Operasional','Gaji','Modal','Lain-lain'] as $k): ?>
                        <option value="<?=$k?>" <?=$f_kat===$k?'selected':''?>><?=$k?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label>Bulan</label>
                <input type="month" name="bulan" value="<?= htmlspecialchars($f_bulan) ?>">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">🔍 Filter</button>
            <a href="5-laporan.php" class="btn btn-outline-secondary btn-sm">Reset</a>
        </div>
    </form>

    <!-- SUMMARY MINI -->
    <div class="summary-row">
        <div class="summary-mini" style="background:#f0fdf4;color:#15803d;border-color:#bbf7d0;">
            💰 Total Pemasukan &nbsp;
            <span style="font-size:15px;"><?= formatRp($total_i) ?></span>
        </div>
        <div class="summary-mini" style="background:#fff5f5;color:#b91c1c;border-color:#fecaca;">
            📉 Total Pengeluaran &nbsp;
            <span style="font-size:15px;"><?= formatRp($total_e) ?></span>
        </div>
        <div class="summary-mini"
             style="background:#eff6ff;border-color:#bfdbfe;
                    color:<?= ($total_i-$total_e)>=0?'#1d4ed8':'#dc2626'?>;">
            💵 Laba Bersih &nbsp;
            <span style="font-size:15px;"><?= formatRp($total_i - $total_e) ?></span>
        </div>
    </div>

    <!-- TABEL SEMUA TRANSAKSI -->
    <div class="table-wrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($q_all) === 0): ?>
                    <tr>
                        <td colspan="8" style="text-align:center;padding:32px;color:#94a3b8;">
                            Tidak ada transaksi yang sesuai filter.
                        </td>
                    </tr>
                <?php else: $no = 1; while ($row = mysqli_fetch_assoc($q_all)): ?>
                    <tr>
                        <td class="row-no"><?= $no++ ?></td>
                        <td><?= date('d M Y', strtotime($row['Tanggal'])) ?></td>
                        <td><b><?= htmlspecialchars($row['Keterangan']) ?></b></td>
                        <td style="color:#64748b;"><?= htmlspecialchars($row['Kategori']) ?></td>
                        <td>
                            <span class="badge-<?= $row['Jenis']==='Pemasukan'?'masuk':'keluar' ?>">
                                <?= $row['Jenis'] ?>
                            </span>
                        </td>
                        <td style="font-weight:800;color:<?= $row['Jenis']==='Pemasukan'?'#16a34a':'#dc2626'?>;">
                            <?= $row['Jenis']==='Pemasukan'?'+':'−' ?><?= formatRp($row['Jumlah']) ?>
                        </td>
                        <td style="color:#94a3b8;font-size:12px;"><?= htmlspecialchars($row['Catatan']) ?></td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="3-edit-transaksi.php?id=<?= $row['No'] ?>"
                                   class="btn btn-warning btn-sm">✏️</a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Hapus transaksi ini?')) window.location='5-laporan.php?hapus=<?= $row['No'] ?>'">
                                    🗑️
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>
</html>
