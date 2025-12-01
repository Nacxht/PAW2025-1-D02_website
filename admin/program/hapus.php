<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

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
hapusProgramService($id);
header("Location: " . BASE_URL . "admin/program");
exit();
