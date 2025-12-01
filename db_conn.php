<?php
// Memasukkan file-file yang dibutuhkan
require_once __DIR__ . "/config.php";

// menetapkan DSN (Database Source Name)
$dsn = "mysql:host=" . HOSTNAME . ";dbname=" . DBNAME;

/**
 * Opsi konfigurasi untuk PDO
 * 
 * Fetch Assoc berarti setiap fetching data, semuanya bertipe array asosiatif
 */
$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    // Membuat koneksi database, dan dimasukkan ke dalam konstanta
    define("DBH", new PDO($dsn, USERNAME, PASSWORD, $options));
} catch (PDOException $err) {
    // Jika terdapat masalah koneksi
    echo "Terdapat masalah saat menghubungkan ke database<br>";
    echo "Error: " . $err->getMessage();
    die();
}
