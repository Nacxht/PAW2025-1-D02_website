<?php
require_once __DIR__ . "/config.php";

// menetapkan DSN (Database Source Name)
$dsn = "mysql:host=" . HOSTNAME . ";dbname=" . DBNAME;

$options = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    // membuat koneksi database
    define("DBH", new PDO($dsn, USERNAME, PASSWORD, $options));
} catch (PDOException $err) {
    echo "Terdapat masalah saat menghubungkan ke database<br>";
    echo "Error: " . $err->getMessage();

    die();
}
