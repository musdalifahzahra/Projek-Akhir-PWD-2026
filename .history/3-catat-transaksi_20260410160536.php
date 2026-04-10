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
        <div class="input-transaksi">
            <div class="row g-3">
                <div class="col-sm-7">
                    <input type="text" class="form-control" placeholder="City" aria-label="City">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" placeholder="State" aria-label="State">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" placeholder="Zip" aria-label="Zip">
                </div>
            </div>
        </div>

        <!-- transaksi terbaru -->
        <div class="card transaksi-terbaru">

        </div>
    </div>
</body>

</html>