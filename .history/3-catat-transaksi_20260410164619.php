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
        <div class="input-transaksi template">
            <form class="row g-3">
                <!-- tanggal -->
                <div class="col-md-3">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="date" class="form-control" id="inputCity">
                </div>
                <!-- keterangan -->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>
                <!-- jenis -->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Jenis</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Jenis</option>
                        <option value="Pemasukan">Pemasukan</option>
                        <option value="Pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <!-- catatan -->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                </div>


                <!-- kategotri-->
                <div class="col-md-3">
                    <label for="inputZip" class="form-label">Jenis</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Jenis</option>
                        <option value="Penjualan">Penjualan/option>
                        <option value="Belanja stok">Belanja Stok</option>
                        <option value="Operasional">Operasional</option>
                        <option value="Gaji">Gaji</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <!-- jumlah -->
                <div class="col-md-7">
                    <label for="inputZip" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="inputZip">
                </div>
                <!-- submit -->
                <!-- <div class="col-md-3">
                    <label for="inputZip" class="form-label">submit</label>
                    <input type="submit" class="form-control" id="inputZip">
                </div> -->



                <!-- <div class="col-2">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div> -->
            </form>
        </div>

        <!-- transaksi terbaru -->
        <div class="transaksi-terbaru template">
            <input type="text">
        </div>
    </div>
</body>

</html>