<?php
require_once "0-koneksi.php";
require "3-functions.php";
// $data, parameter yang menerima 1 baris data transaksi yg akan diubah
function modal_ubah_data_pengguna($data)
{
?>
    <!-- menampilkan pop up ubah data (template modal bootstrap) -->
    <div class="modal fade " id="modal-ubah-pengguna<?= $data['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog card">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5" id="staticBackdropLabel">Ubah data transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- input transaksi -->
                    <div class="input-transaksi template">

                        <!-- kirim data -->
                        <form class="row g-3" action="3-functions.php" method="POST">
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>