<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: 1-login.php");
    exit();
}
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
if ($f_jenis) $parts[] = "Jenis='"    . mysqli_real_escape_string($conn, $f_jenis) . "'";
if ($f_kat)   $parts[] = "Kategori='" . mysqli_real_escape_string($conn, $f_kat)   . "'";
if ($f_bulan) $parts[] = "DATE_FORMAT(Tanggal,'%Y-%m')='" . mysqli_real_escape_string($conn, $f_bulan) . "'";

$where = $parts ? "WHERE " . implode(" AND ", $parts) : "";

// Query utama
$q_all = mysqli_query($conn, "SELECT * FROM transaksi $where ORDER BY No DESC");

// Total untuk summary mini
$p_i = array_merge($parts, ["Jenis='Masuk'"]);
$p_e = array_merge($parts, ["Jenis='Keluar'"]);
$total_i = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi WHERE " . implode(" AND ", $p_i)
))['t'] ?? 0;
$total_e = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi WHERE " . implode(" AND ", $p_e)
))['t'] ?? 0;

function formatRp($a)
{
    return "Rp " . number_format($a, 0, ',', '.');
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Laporan Keuangan Toko Sembako Makmur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="5-riwayat-transaksi-css.css">
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

        <div class="nav-kanan">
            <div class="nav-menu">
                <div class="nav-list hidden" id="nav_list">
                    <ul>
                        <li><a href="2-dashboard.php">Dashboard</a></li>
                        <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                        <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                        <li><a href="5-riwayat-transaksi.php" class="nav-active">Riwayat Transaksi</a></li>
                        <li <?= ($_SESSION["role"] == "Kasir") ? "hidden" : "" ?>><a href="6-pengguna.php">Pengguna</a></li>
                        <li class="nav-profil-hidden">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg><?= $_SESSION["role"] . "|" . $_SESSION["username"] ?>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="icon-list" id="icon_list">
                    <span>Riwayat Transaksi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708" />
                    </svg>
                </div>
            </div>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <?= $_SESSION["role"] . "|" . $_SESSION["username"] ?>
            </span>
        </div>
    </nav>

    <div class="wrap">
        <!-- FORM FILTER -->
        <div class="card">
            <h5 style="margin-bottom: 10px;">Riwayat Transaksi</h5>

            <form method="GET" class="row 9-3" action="">
                <div class="filter-wrap">
                    <div class="col-md-3">
                        <label class="form-label">Jenis</label>
                        <select name="jenis">
                            <option value="">Semua Jenis</option>
                            <option value="Masuk" <?= $f_jenis === 'Masuk'  ? 'selected' : '' ?>>Pemasukan</option>
                            <option value="Keluar" <?= $f_jenis === 'Keluar' ? 'selected' : '' ?>>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="kat">
                            <option value="">Semua Kategori</option>
                            <?php foreach (['Penjualan Pagi', 'Penjualan Siang', 'Penjualan Malam', 'Belanja Stok', 'Operasional', 'Gaji', 'Lain-lain'] as $k): ?>
                                <option value="<?= $k ?>" <?= $f_kat === $k ? 'selected' : '' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Bulan</label>
                        <input type="month" name="bulan" value="<?= htmlspecialchars($f_bulan) ?>">
                    </div>
                    <div class="col-md-1"><button type="submit" class="btn btn-sm filter">Filter</button></div>
                    <div class="col-md-1"><a href="5-riwayat-transaksi.php" class="btn btn-outline-secondary btn-sm">Reset</a></div>
                </div>
            </form>
        </div>

        <!-- TABEL SEMUA TRANSAKSI -->
        <div class="table-wrap card">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="text-align: left; min-width: 120px;">Tanggal</th>
                        <th style="text-align: left;">Keterangan</th>
                        <th style=" min-width: 130px;">Kategori</th>
                        <th>Jenis</th>
                        <th style="text-align: right; min-width: 120px;">Jumlah</th>
                        <th style="text-align: left;">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($q_all) === 0): ?>
                        <tr>
                            <td colspan="6" style="text-align:center;padding:32px;color:#94a3b8;">
                                Tidak ada transaksi yang sesuai filter.
                            </td>
                        </tr>
                        <?php else: $no = 1;
                        while ($row = mysqli_fetch_assoc($q_all)): ?>
                            <tr>
                                <td><?= date('d M Y', strtotime($row['Tanggal'])) ?></td>
                                <td style="text-transform:capitalize"><?= htmlspecialchars($row['Keterangan']) ?></td>
                                <td style="color:#64748b;">
                                    <div class="kategori
                                    <?= match ($row['Kategori']) {
                                        "Penjualan Pagi"  => "PenjualanPagi",
                                        "Penjualan Siang" => "PenjualanSiang",
                                        "Penjualan Malam" => "PenjualanMalam",
                                        "Belanja Stok" => "BelanjaStok",
                                        "Operasional" => "Operasional",
                                        "Gaji" => "Gaji",
                                        "Lain-lain" => "lainlain"
                                    } ?>"><?= htmlspecialchars($row['Kategori']) ?></div>
                                </td>
                                <td>
                                    <?php if ($row['Jenis'] == "Masuk") { ?>
                                        <p style="text-align: center;" class="jenis-masuk"><?= $row['Jenis'] ?></p>

                                    <?php } else { ?>
                                        <p style="text-align: center;" class="jenis-keluar"><?= $row['Jenis'] ?></p>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($row['Jenis'] == "Masuk") { ?>
                                        <p class="jumlah-masuk"><?= "+" . formatRp($row['Jumlah']) ?></p>

                                    <?php } else { ?>
                                        <p class="jumlah-keluar"><?= "-" . formatRp($row['Jumlah']) ?></p><?php } ?>
                                </td>
                                <td style="color:#94a3b8;font-size:12px;"><?= htmlspecialchars($row['Catatan']) ?></td>
                            </tr>
                    <?php endwhile;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>