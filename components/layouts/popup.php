<?php

/**
 * Fungsi untuk menampilkan popup penghapusan data
 * 
 * @param string $urlKembali - URL untuk tombol kembali
 * @param string $pesan - Pesan kustom untuk ditampilkan
 */
function popupHapus(string $urlKembali, string $pesan = "")
{
    $pesan = $pesan ? $pesan : "Apakah anda yakin ingin menghapus data ini?";

    echo '<form action="" method="post" class="pop-up-container">
            <p class="popup-message">
                ' . $pesan . '
            </p>

            <hr class="divider">
            
            <div class="btn-container">
                <button type="submit" class="btn btn-error" name="konfirmasi-hapus">
                    Ya, hapus data ini!
                </button>

                <a href="' . BASE_URL . $urlKembali . '" class="btn btn-info">
                    Tidak, jangan hapus file ini!
                </a>
            </div>
        </form>';
}


/**
 * Fungsi untuk menampilkan popup pemberitahuan
 * 
 * @param string $urlKembali - URL untuk tombol kembali
 * @param string $pesan - Pesan kustom untuk ditampilkan
 */
function popupPemberitahuan(string $urlKembali, string $pesan)
{
    echo '<div class="pop-up-container">
            <p class="popup-message">' . $pesan . '</p>

            <hr class="divider">
            
            <div class="btn-container">
                <a href="' . BASE_URL . $urlKembali . '" class="btn btn-info">
                    Kembali ke halaman sebelumnya
                </a>
            </div>
        </div>';
}
