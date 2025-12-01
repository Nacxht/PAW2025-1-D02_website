<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../config.php";

// Memulai session
session_start();

/**
 * Middleware (penghalang) bagi user yang sudah melakukan proses login.
 * 
 * Hal ini dilakukan untuk membatasi beberapa halaman yang tidak dapat
 * diakses oleh user yang sudah melakukan proses login.
 * 
 * Middleware ini juga membatasi agar user tidak memasuki halaman yang
 * hanya dapat dilihat oleh role tertentu.
 * 
 * Indikatornya adalah, user sudah memiliki session username dan role.
 * 
 * - Jika role user adalah admin, maka user akan diarahkan ke halaman admin
 * - Jika selain itu, user akan diarahkan ke halaman beranda
 */
if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin") {
        header("location: " . BASE_URL . "admin/");
    } else {
        header("location: " . BASE_URL);
    }
}
