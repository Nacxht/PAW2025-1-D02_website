<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/form_pendaftaran_service.php";
require_once __DIR__ . "/../../config.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID Form Pendaftaran
 * yang akan diverifikasi
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/form_pendaftaran");
    exit();
}

$id = $_GET["id"];

// Mengambil data form pendaftaran berdasarkan ID yang diberikan
$formPendaftaran = detailFormPendaftaranService($id);

/**
 * Pengaman jika Form Pendaftaran tidak ditemukan
 */
if (!$formPendaftaran) {
    header("Location: " . BASE_URL . "admin/form_pendaftaran");
    exit();
}

$dokumenUpload = daftarRiwayatUploadDokumen($formPendaftaran["id_form_pendaftaran"]);

/**
 * Penanganan ketika form pendaftaran diterima.
 * 
 * Setelah proses verifikasi dilakukan, admin diarahkan ke halaman
 * daftar form pendaftaran
 */
if (isset($_POST["terima-form-pendaftaran"])) {
    verifikasiFormPendaftaran("diterima", $id);

    header("Location: " . BASE_URL . "admin/form_pendaftaran");
    exit();
}

/**
 * Penanganan ketika form pendaftaran ditolak.
 * 
 * Setelah proses verifikasi dilakukan, admin diarahkan ke halaman
 * daftar form pendaftaran
 */
if (isset($_POST["tolak-form-pendaftaran"])) {
    verifikasiFormPendaftaran("ditolak", $id);

    header("Location: " . BASE_URL . "admin/form_pendaftaran");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan beberapa konfigurasi head -->
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang dibutuhkan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="admin-verifikasi-form-pendaftaran">
        <h1>
            Verifikasi Form Pendaftaran
        </h1>

        <hr class="divider">

        <!-- Tabel untuk menampilkan data-data yang akan direview -->
        <table>
            <tr>
                <th class="judul-tabel" colspan="2">
                    Review Data Sebelum Memverifikasi!
                </th>
            </tr>

            <!-- Menampilkan setiap detail menggunakan foreach -->
            <?php foreach ($formPendaftaran as $namaKey => $nilai): ?>
                <?php
                // Variabel untuk menyimpan nama yang dapat dibaca oleh user
                $namaBaris = ucwords(str_replace("_", " ", $namaKey));

                // Variable untuk memberikan nilai class pada status form pendaftaran
                $namaKelasStatus = "";

                // Kondisi untuk menentukan nilai class pada status form pendaftaran
                if ($namaKey == "status") {
                    $namaKelasStatus = $nilai;
                }

                /**
                 * Jika pada iterasi didapati nama key nya adalah
                 * "id_form_pendaftaran", maka loop akan dilewati
                 */
                if ($namaKey == "id_form_pendaftaran") {
                    continue;
                }
                ?>

                <tr>
                    <th><?= $namaBaris ?></th>

                    <td class="<?= $namaKelasStatus ?? "" ?>">
                        <?php
                        // Penggunaan switch untuk menentukan nilai sel
                        switch ($namaKey) {
                            // Untuk jenis kelamin
                            case "jenis_kelamin":
                                echo $nilai == "P" ? "Perempuan" : "Laki-Laki";
                                break;

                            // Untuk persetujuan tidak membawa HP
                            case "persetujuan_tidak_membawa_hp":
                                echo $nilai == "true" ? "Setuju" : "Tidak Setuju";
                                break;

                            // Untuk persetujuan asrama
                            case "persetujuan_asrama":
                                echo $nilai == "true" ? "Setuju" : "Tidak Setuju";
                                break;

                            // Selain kondisi diatas
                            default:
                                echo ucwords($nilai);
                                break;
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach ?>

            <!-- Bagian untuk menampilkan dokumen-dokumen yang diupload -->
            <?php foreach ($dokumenUpload as $dokumen): ?>
                <!-- Variabel untuk menyimpan nama yang dapat dibaca oleh user -->
                <?php $namaBaris = ucwords(str_replace("_", " ", $dokumen["jenis_dokumen"])) ?>

                <tr>
                    <th>
                        <?= $namaBaris ?>
                    </th>

                    <td>
                        <!-- Hyperlink yang mengarahkan pengguna untuk menampilkan gambar -->
                        <a href="<?= BASE_URL . "assets/uploads/" . $dokumen["path_dokumen"] ?>" target="__blank">
                            Klik disini untuk melihat gambar
                        </a>
                    </td>
                </tr>
            <?php endforeach ?>

            <tr>
                <td colspan="3">
                    <!-- Form untuk menangani apakah form pendaftaran diterima/ditolak (Verifikasi) -->
                    <form action="" method="post" class="button-container">
                        <button type="submit" class="btn btn-success" name="terima-form-pendaftaran">
                            Terima Form Pendaftaran
                        </button>

                        <button type="submit" class="btn btn-error" name="tolak-form-pendaftaran">
                            Tolak Form Pendaftaran
                        </button>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>