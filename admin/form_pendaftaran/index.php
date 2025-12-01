<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/form_pendaftaran_service.php";
require_once __DIR__ . "/../../config.php";

// Mengambil data-data form pendaftaran
$daftarFormPendaftaran = daftarFormPendaftaranService();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan beberapa konfigurasi head -->
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan css yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="admin-daftar-form-pendaftaran">
        <h1>
            Daftar Form Pendaftaran
        </h1>

        <hr class="divider">

        <!-- Menampilkan data-data dari form pendaftaran -->
        <div class="daftar-form-pendaftaran-container">
            <?php foreach ($daftarFormPendaftaran as $data): ?>
                <table class="data-form-pendaftaran">
                    <?php foreach ($data as $namaKey => $nilai): ?>
                        <?php
                        // Variabel untuk menyimpan nama yang dapat dibaca oleh user
                        $namaBaris = ucwords(str_replace("_", " ", $namaKey));

                        // Variable untuk memberikan nilai class pada status form pendaftaran
                        $namaKelasStatus = "";

                        // Kondisi untuk menentukan nilai class pada status form pendaftaran
                        if ($namaKey == "status") {
                            $namaKelasStatus = $nilai;
                        }
                        ?>

                        <tr>
                            <th><?= $namaBaris ?></th>
                            <td>:</td>

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
                    <?php endforeach; ?>

                    <tr>
                        <td colspan="3">
                            <hr class="divider">
                        </td>
                    </tr>

                    <!-- Baris & Kolom untuk meletakkan verifikasi status -->
                    <tr>
                        <td colspan="3">
                            <div class="btn-column">
                                <a href="<?= BASE_URL . "admin/form_pendaftaran/verifikasi.php?id=" . $data["id_form_pendaftaran"] ?>" class="btn btn-info">
                                    Verifikasi Status
                                </a>
                            </div>
                        </td>
                    </tr>
                </table>
            <?php endforeach ?>
        </div>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>