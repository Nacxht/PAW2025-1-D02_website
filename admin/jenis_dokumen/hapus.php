<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";
require_once __DIR__ . "/../../components/layouts/popup.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID
 * dari jenis dokumen
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jenis_dokumen");
    exit();
}

$id = $_GET["id"];

// Mengambil data jenis dokumen berdasarkan ID nya
$jenisDokumen = detailJenisDokumenService($id);

// Jika jenis dokumen yang dihapus tidak ditemukan
if (!$jenisDokumen) {
    header("Location: " . BASE_URL . "admin/jenis_dokumen");
    exit();
}

// Proses penghapusan jenis dokumen
if (isset($_POST["konfirmasi-hapus"])) {
    hapusJenisDokumenService($id);
    header("Location: " . BASE_URL . "admin/jenis_dokumen");
    exit();
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
        <?php popupHapus("admin/jenis_dokumen") ?>
    </div>
</body>

</html>