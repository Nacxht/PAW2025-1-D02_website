<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../config.php";

// Memulai session
session_start();

/**
 * Middleware (penghalang) untuk user yang belum melakukan login.
 * 
 * Hal ini diperlukan untuk membatasi agar user tidak mengakses
 * halaman yang tidak dapat diakses jika user belum melakukan proses
 * login.
 * 
 * Jika user belum melakukan proses login, maka user akan secara
 * otomatis diarahkan ke halaman login
 * 
 * Indikatornya adalah, user belum mememiliki session username
 * dan role.
 */
if (!isset($_SESSION['username']) && !isset($_SESSION['role'])) {
	header("location: " . BASE_URL . "login.php");
}
