<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../components/layouts/popup.php";

// Menentukan popup
$popupError = false;

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID
 * dari jurusan yang akan dihapus
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

$id = $_GET["id"];

// Mengambil data jurusan berdasarkan ID nya
$jurusan = detailJurusanService($id);

/**
 * Pengaman jika jurusan tidak ditemukan
 */
if (!$jurusan) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

// Melakukan proses penghapusan jurusan
if (isset($_POST["konfirmasi-hapus"])) {
    try {
        hapusJurusanService($id);
        header("Location: " . BASE_URL . "admin/jurusan");
        exit();
    } catch (Exception $error) {
        $popup = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <div class="container">
        <?php if (!$popupError): ?>
            <?php popupHapus("admin/jurusan") ?>
        <?php else: ?>
            <?php popupPemberitahuan("admin/jurusan", "Tidak dapat menghapus jurusan, terdapat form pendaftaran yang memiliki relasi dengan data ini") ?>
        <?php endif ?>
    </div>
</body>

</html>