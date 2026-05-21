<?php
session_start();
require_once "3-functions.php";
require_once "6-ubah.php";

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: 1-login.php");
    exit();
}

if (isset($_POST["submit-pengguna"])) {
    $data = read("SELECT * FROM users");
    foreach ($data as $row):
        if ((($_POST["username"]) == $row["username"])) {
            $_SESSION["error_username"] = " Username Telah Digunakan";
        }
    endforeach;
    if (!isset($_SESSION["error_username"])) {
        tambah_data_pengguna($_POST);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catat Transaksi - Laporan Keuangan Toko Sembako Makmur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="template-css.css">
    <link rel="stylesheet" href="3-catat-transaksi-css.css">
    <link rel="stylesheet" href="4-laba-rugi-css.css">
    <style>
        .table-header {
            background-color: var(--color-nav);
            color: var(--color-card);
            padding: 10px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        table {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        td {
            padding: 10px;
            font-size: var(--font-text);
            border-bottom: 1px solid var(--color-bag-web);
        }
    </style>
</head>

<body>
    <nav>
        <div class="profile">
            <svg style="color: var(--color-card);" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wallet-minimal-icon lucide-wallet-minimal">
                <path d="M17 14h.01" />
                <path d="M7 7h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14" />
            </svg>
            <span><?= $_SESSION["nama_toko"] ?></span>
        </div>
        <div class="nav-kanan">
            <div class="nav-menu">
                <div class="nav-list hidden" id="nav_list">
                    <ul>
                        <li><a href="2-dashboard.php">Dashboard</a></li>
                        <li><a href="3-catat-transaksi.php">Catat Transaksi</a></li>
                        <li><a href="4-laba-rugi.php">Laba Rugi</a></li>
                        <li><a href="5-riwayat-transaksi.php">Riwayat Transaksi</a></li>
                        <li <?= ($_SESSION["role"] == "Kasir") ? "hidden" : "" ?> class="nav-active"><a href="6-pengguna.php">Pengguna</a></li>
                        <li class="nav-profil-hidden">
                            <span><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                                <?= $_SESSION["role"] . "|" . $_SESSION["username"] ?> </span>
                        </li>
                    </ul>
                </div>
                <div class="icon-list" id="icon_list">
                    <span>Laba Rugi</span>
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
                <?= $_SESSION["role"] . "|" . $_SESSION["username"] ?> </span>
            </span>
        </div>
    </nav>

    <div class="wrap">
        <!-- form tambah kasir -->
        <div class="laporan-laba-rugi card">
            <h5 style="margin-bottom: 10px;">Tambah Akun Kasir</h5>
            <form class="row g-3 align-items-end" method="POST">
                <div class="col-12 col-md-3">
                    <label for="username" class="form-label">username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="col-12 col-md-3">
                    <label for="password" class="form-label">password</label>
                    <input type="text" class="form-control" id="password" name="password" required>
                </div>
                <div class="col-12 col-md-4">
                    <label for="role" class="form-label">role</label>
                    <input type="text" class="form-control" id="role" name="role" value="Kasir" readonly>
                </div>
                <div class="col-12 col-md-auto d-flex align-items-end justify-content-end">
                    <button type="submit" class="catat btn btn-primary" id="catat" name="submit-pengguna" required> Tambah</button>
                </div>
                <span>
                    <?php
                    if (isset($_SESSION["error_username"])) echo $_SESSION["error_username"];
                    ?>
                </span>
                <?php unset($_SESSION["error_username"]); ?>
            </form>
        </div>

        <div class="laporan-laba-rugi card">
            <h5 style="margin-bottom: 20px;">Data Pengguna</h5>
            <div class="data-pengguna" style="width: 100%;">
                <table style="width: 100%;">
                    <tr class="table-header">
                        <td style="text-align: center;">No.</td>
                        <td>Username</td>
                        <td>Password</td>
                        <td style="text-align: center;">Role</td>
                        <td></td>
                    </tr>
                    <?php
                    $data = read("SELECT * FROM users");
                    $i = 1;
                    foreach ($data as $row):
                    ?>
                        <?php
                        $admin = false;
                        if ($_SESSION["role"] == "Admin" && $row["role"] == "Kasir") {
                            $admin = true;
                        } elseif ($_SESSION["role"] == "Owner") {
                            $admin = true;
                        }
                        if ($admin) :
                        ?>
                            <tr class="satu-pengguna">
                                <td style="text-align: center;"><?= $i . "." ?></td>
                                <td><?= $row["username"] ?></td>
                                <td><?= $row["password"] ?></td>
                                <td style="text-align: center;"><span class="<?= ($row["role"] == "Owner") ? "Owner" : (($row["role"]) == "Admin" ? "Admin" : "Kasir") ?> "><?= $row["role"] ?></span></td>
                                <td style="max-width: 40px;">
                                    <!-- ubah -->
                                    <button type="button" class="edit" data-bs-toggle="modal" data-bs-target="#modal-ubah-pengguna<?= $row['id'] ?>">
                                        Edit
                                    </button>

                                    <!-- panggil fungsi u/ mengubah data dengan membawa satu data transaksi, modal akan muncul apabila user Pilih ubah -->
                                    <?php
                                    modal_ubah_data_pengguna($row);
                                    ?>

                                    <!-- hapus -->
                                    <a class="hapus" href="6-hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Apakah anda ingin mengapus data tersebut');" <?= ($row["role"] != "Kasir") ? "hidden" : "" ?> style="margin-left: 2px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                    <?php $i++;
                        endif;
                    endforeach;
                    ?>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Nav responsif-->
    <script src="0-nav-list.js"></script>
</body>

</html>