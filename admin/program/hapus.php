<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";
require_once __DIR__ . "/../../components/layouts/popup.php";

// Menentukan popup
$popupError = false;

/**
 * Pengaman jika tidak terdapat request GET yang membawa
 * ID dari program yang akan dihapus
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

$id = $_GET["id"];

// Mengambil data program berdasarkan ID nya
$program = detailProgramService($id);

/**
 * Jika program tidak ditemukan, kembalikan user ke halaman daftar program
 */
if (!$program) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

// Melakukan proses hapus
if (isset($_POST["konfirmasi-hapus"])) {
    try {
        hapusProgramService($id);
        header("Location: " . BASE_URL . "admin/program");
        exit();
    } catch (Exception $error) {
        $popupError = true;
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
            <?php popupHapus("admin/program") ?>
        <?php else: ?>
            <?php popupPemberitahuan("admin/program", "Tidak dapat menghapus program, terdapat form pendaftaran yang memiliki relasi dengan data ini") ?>
        <?php endif ?>
    </div>
</body>

</html>