<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../components/layouts/popup.php";

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
    hapusJurusanService($id);
    header("Location: " . BASE_URL . "admin/jurusan");
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
        <?php popupHapus("admin/jurusan") ?>
    </div>
</body>

</html>