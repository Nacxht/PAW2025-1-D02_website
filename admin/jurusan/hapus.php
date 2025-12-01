<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/after_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";

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
hapusJurusanService($id);
header("Location: " . BASE_URL . "admin/jurusan");
exit();
