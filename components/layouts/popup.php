<?php

/**
 * Fungsi untuk menampilkan popup penghapusan data
 * 
 * @param string $urlKembali - URL untuk tombol kembali
 */
function popupHapus(string $urlKembali)
{
    echo '<form action="" method="post" class="pop-up-container">
            <p class="popup-message">
                Apakah anda yakin ingin menghapus data ini?
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
 */
function popupPemberitahuan(string $urlKembali, string $pemberitahuan)
{
    echo '<div class="popup-container">
            <p>' . $pemberitahuan . '</p>

            <hr class="divider">
            
            <a href="' . BASE_URL . $urlKembali . '">
                Kembali ke halaman sebelumnya
            </a>
        </div>';
}
