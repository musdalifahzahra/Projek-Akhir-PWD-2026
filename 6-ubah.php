<?php
require_once "0-koneksi.php";
require_once "3-functions.php";
// $data, parameter yang menerima 1 baris data pengguna yg akan diubah
function modal_ubah_data_pengguna($data)
{
?>
    <!-- menampilkan pop up ubah data (template modal bootstrap) -->
    <div class="modal fade " id="modal-ubah-pengguna<?= $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog card">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Ubah Data <?= $data["role"] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- input transaksi -->
                    <div class="input-transaksi template">

                        <!-- kirim data -->
                        <form class="row g-3 align-items-end" action="3-functions.php" method="POST">
                                <input type="hidden" name="id" value="<?= $data["id"] ?>">
                                <!-- keterangan -->
                                <div class="col-12 col-md-3">
                                    <label for="username" class="form-label">username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $data["username"] ?>" required>
                                </div>
                                <!-- keterangan -->
                                <div class="col-12 col-md-3">
                                    <label for="password" class="form-label">password</label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?= $data["password"] ?>" required>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="role" class="form-label" style="margin-top: 17px;">role</label>
                                    <input type="text" class="form-control" id="role" name="role" value="<?= $data["role"] ?>" readonly style="text-transform:capitalize;">
                                </div>

                                <!-- submit (+catat) -->
                                <div class="col-12 col-md-auto d-flex align-items-end justify-content-end">
                                    <button type="submit" class="catat btn btn-primary" id="catat" name="submit-ubah-pengguna" required> Ubah </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>