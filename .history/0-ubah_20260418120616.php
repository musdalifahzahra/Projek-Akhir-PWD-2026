<?php
require_once "0-koneksi.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="3-">
</head>

<body>
    <?php
    function modal_ubah_data($data)
    {
    ?>
        <!-- menampilkan pop up ubah data (template modal bootstrap) -->
        <div class="modal fade " id="modal-ubah<?= $data['No'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog template">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="staticBackdropLabel">Ubah data transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- input transaksi -->
                        <div class="input-transaksi template">

                            <!-- kalo biasnya kirim datanya lewat a href GET, kalo ini pake form POST -->
                            <form class="row g-3" action="0-koneksi.php" method="POST">
                                <!-- membawa id, id  yang sesuai dengan data yg mau di edit -->
                                <input type="hidden" name="id" value="<?= $data['No'] ?>">

                                <!-- tanggal -->
                                <div class="col-md-3">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $data['Tanggal'] ?>" required>
                                </div>
                                <!-- keterangan -->
                                <div class="col-md-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $data['Keterangan'] ?>" required>
                                </div>
                                <!-- kategori -->
                                <div class="col-md-3">
                                    <label for="inputZip" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" aria-label="Default select example" name="kategori" value="<?= $data['Kategori'] ?>" required>
                                        <option value="Penjualan">Penjualan</option>
                                        <option value="Belanja Stok">Belanja Stok</option>
                                        <option value="Operasional">Operasional</option>
                                        <option value="Gaji">Gaji</option>
                                        <option value="Lain-lain">Lain-lain</option>
                                    </select>
                                </div>
                                <!-- jenis -->
                                <div class="col-md-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <select class="form-select" id="jenis" aria-label="Default select example" name="jenis" value="<?= $data['Jenis'] ?>" required>
                                        <option value="Masuk">Pemasukan</option>
                                        <option value="Keluar">Pengeluaran</option>
                                    </select>
                                </div>
                                <!-- jumlah-->
                                <div class="col-md-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?= $data['Jumlah'] ?>" required>
                                </div>
                                <!-- catatan -->
                                <div class="col-md-7">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan" value="<?= $data['Catatan'] ?>">
                                </div>
                                <!-- submit (ubah) -->
                                <div class="col-md-2 d-flex align-items-end justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="catat" name="submit-ubah" required> Ubah </button>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Understood</button>
                                        </div> -->
                </div>
            </div>
        </div>


    <?php } ?>
</body>

</html>