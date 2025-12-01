<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";

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
hapusJenisDokumenService($id);
header("Location: " . BASE_URL . "admin/jenis_dokumen");
exit();
