<?php
// memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__  . "/../../services/user_service.php";
require_once __DIR__ . "/../../components/layouts/popup.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID
 * dan Role user yang akan dihapus
 */
if (!isset($_GET["id"]) || !isset($_GET["role"])) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}


$id = $_GET["id"];
$role = $_GET["role"];

/**
 * Jika role yang dihapus adalah admin, maka kembalikan user
 * ke halaman daftar akun
 */
if ($role == "admin") {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

/**
 * Pengaman agar user tidak dapat menghapus dirinya sendiri.
 * 
 * Hal ini ditambahkan barangkali user menuliskan request GET
 * melalui URL
 */
if ($id == $_SESSION["id_user"]) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

// Memberikan data pengguna berdasarkan ID yang diberikan
$user = getUserByID($id, $role);

/**
 * Pengaman jika user yang akan dihapus tidak ditemukan
 * 
 * Hal ini dilakukan untuk menghindari error ketika melakukan proses penghapusan
 */
if (!$user) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

/**
 * Proses penghapusan
 */
if (isset($_POST["konfirmasi-hapus"])) {
    deleteUserService($id, $role);
    header("Location: " . BASE_URL . "admin/akun");
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
        <?php popupHapus("admin/akun") ?>
    </div>
</body>

</html>