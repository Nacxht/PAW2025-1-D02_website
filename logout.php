<?php
// Memasukkan file yang diperlukan
require_once __DIR__ .  "/auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/config.php";

// jika session belum aktif
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Menangani proses logout
if (isset($_POST["logout"])) {
    // Menghapus data-data yang tersimpan di array
    session_unset();
    session_destroy();

    // Mengarahkan user ke halaman beranda
    header("Location: " . BASE_URL);
    exit();
}
