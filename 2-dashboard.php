<?php
session_start();
// var_dump($_POST);
// die();
require "0-koneksi.php";
require_once "3-functions.php";
require_once "3-ubah.php";
$transaksi_terbaru = read("SELECT * FROM transaksi ORDER BY No DESC LIMIT 5");

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

$nama_toko      = $_SESSION["nama_toko"]      ?? "Toko Sembako Makmur";
$deskripsi_toko = $_SESSION["deskripsi_toko"] ?? "Pusat kendali operasional Toko Sembako Makmur. Kelola transaksi pendapatan, pengeluaran, dan laporan laba rugi secara terpusat dan otomatis.";

$bulan_ini = date("Y-m");

$total_income = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi
     WHERE Jenis='Masuk' AND DATE_FORMAT(Tanggal,'%Y-%m')='$bulan_ini'"
))['t'] ?? 0;

$total_expense = mysqli_fetch_assoc(mysqli_query(
    $conn,
    "SELECT SUM(Jumlah) AS t FROM transaksi
     WHERE Jenis='Keluar' AND DATE_FORMAT(Tanggal,'%Y-%m')='$bulan_ini'"
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
    <title>Dashboard - Laporan Keuangan Toko Sembako Makmur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="2-dashboard-css.css">
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
                        <li><a href="2-dashboard.php" class="nav-active">Dashboard</a></li>
                        <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                        <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                        <li><a href="5-riwayat-transaksi.php">Riwayat Transaksi</a></li>
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
                    <span>Dashboard</span>
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
        <div class="card-profile">
            <div class="card-profile-header">
                <div class="header-atas">
                    <div>
                        <p class="tema-web">Laporan Keuangan</p>
                        <p class="nama-toko"><?= htmlspecialchars($nama_toko) ?></p>
                    </div>
                </div>
                <div class="logo-toko">
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" width="34" height="34">
                        <path d="M3 9l1.5-5h15L21 9" stroke="#1e293b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3 9h18v11a1 1 0 01-1 1H4a1 1 0 01-1-1V9z" stroke="#1e293b" stroke-width="1.5" stroke-linejoin="round" />
                        <path d="M9 21v-6h6v6" stroke="#1e293b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M3 9c0 1.657 1.343 3 3 3s3-1.343 3-3" stroke="#1e293b" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M9 9c0 1.657 1.343 3 3 3s3-1.343 3-3" stroke="#1e293b" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M15 9c0 1.657 1.343 3 3 3s3-1.343 3-3" stroke="#1e293b" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <div class="card-body">
                <div class="informasi-toko">
                    <div class="satu-info"><span class="meta-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin">
                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                <circle cx="12" cy="10" r="3" />
                            </svg></span> Jl. Merdeka No. 12</div>
                    <div class="satu-info"><span class="meta-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar-days-icon lucide-calendar-days">
                                <path d="M8 2v4" />
                                <path d="M16 2v4" />
                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                <path d="M3 10h18" />
                                <path d="M8 14h.01" />
                                <path d="M12 14h.01" />
                                <path d="M16 14h.01" />
                                <path d="M8 18h.01" />
                                <path d="M12 18h.01" />
                                <path d="M16 18h.01" />
                            </svg></span> Berdiri sejak 2026
                    </div>
                    <div class="satu-info">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round">
                                <circle cx="12" cy="8" r="5" />
                                <path d="M20 21a8 8 0 0 0-16 0" />
                            </svg>
                        </span><?= $_SESSION["username"] ?>
                    </div>
                </div>

                <p class="desc"><?= htmlspecialchars($deskripsi_toko) ?></p>
                <div class="actions" <?= ($_SESSION["role"] == "Kasir") ? "hidden" : "" ?>>
                    <a href="#" class=" edit-profile"
                        data-bs-toggle="modal" data-bs-target="#modalProfil">
                        Edit Profil
                    </a>
                    <a href="1-logout.php" class=" edit-profile">
                        Logout
                    </a>
                </div>
                <div class="actions" <?= ($_SESSION["role"] != "Kasir") ? "hidden" : "" ?> style="display: flex;">
                    <a href="1-logout.php" class=" edit-profile">
                        Logout
                    </a>
                </div>
            </div>
        </div>

        <!-- 4 SUMMARY CARDS -->
        <div class="wrap-rincian">
            <div class="rincian">
                <h5>Pemasukan Bulan Ini</h5>
                <span>
                    <div class="summary-value" style="color:#15803d;"><?= formatRp($total_income) ?></div>
                </span>
            </div>
            <div class="rincian">
                <h5>Pengeluaran Bulan Ini</h5>
                <span>
                    <div class="summary-value" style="color:#b91c1c;"><?= formatRp($total_expense) ?></div>
                </span>
            </div>
            <div class="rincian">
                <h5>Laba Bersih Bulan Ini</h5>
                <span>
                    <div class="summary-value"
                        style="color:<?= $laba_bersih >= 0 ? '#1d4ed8' : '#dc2626' ?>;">
                        <?= formatRp($laba_bersih) ?>
                    </div>
                </span>
            </div>
            <div class="rincian">
                <h5>Total Transaksi</h5>
                <span>
                    <div class="summary-value" style="color:#92400e;">
                        <?= $total_tx ?></div>
                </span>
            </div>
        </div>

        <div class="card card-custom">
            <h5>Transaksi Terbaru</h5>
            <div class="wrap-transaksi">
                <?php foreach ($transaksi_terbaru as $data) : ?>
                    <div class="satu-transaksi">

                        <div class="a">
                            <p class="keterangan"><?= $data['Keterangan'] ?></p>
                            <p class="tanggal-catatan"><?= $data['Tanggal'] ?>
                                <?php if ($data['Catatan'] != NULL) {
                                    echo " | " . $data['Catatan'] ?></p>
                        <?php } ?>
                        </div>

                        <div class="b">
                            <!-- jumlah --> <!-- jenis -->
                            <?php if ($data['Jenis'] == "Masuk") { ?>
                                <p class="jumlah-masuk"><?= "+Rp" . number_format($data['Jumlah'], 0, ',', '.') ?></p>
                                <p class="jenis-masuk"><?= $data['Jenis'] ?></p> <?php } else { ?>
                                <p class="jumlah-keluar"><?= "-Rp" . number_format($data['Jumlah'], 0, ',', '.') ?></p>
                                <p class="jenis-keluar"><?= $data['Jenis'] ?></p><?php } ?>

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
            <div class="mt-3 text-end">
                <a href="5-riwayat-transaksi.php" class="lihat-semua btn btn-primary btn-sm">Lihat Semua →</a>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT PROFIL -->
    <div class="modal fade" id="modalProfil" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header" style="background-color: var(--color-nav);">
                        <h5 class="modal-title" style="color: var(--color-card);">Edit Profil Perusahaan</h5>
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
                        <button type="submit" name="simpan_profil" class="btn btn-primary">Simpan</button>
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