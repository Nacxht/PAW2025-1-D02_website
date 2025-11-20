<?php
require_once __DIR__ . "/config.php";

// menetapkan DSN (Database Source Name)
$dsn = "mysql:host=" . HOSTNAME . ";dbname=" . DBNAME;

try {
    // membuat koneksi database
    define("DBH", new PDO($dsn, USERNAME, PASSWORD));
} catch (PDOException $err) {
    echo "Terdapat masalah saat menghubungkan ke database<br>";
    echo "Error: " . $err->getMessage();

    die();
}
