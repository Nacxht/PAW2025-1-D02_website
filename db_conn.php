<?php
// variabel konfigurasi db
$hostname = "localhost";
$dbname = "ppdb";
$username = "root";
$password = "";

// menetapkan DSN (Database Source Name)
$dsn = "mysql:host=$hostname;dbname=$dbname";

try {
    // membuat koneksi database
    define("DBH", new PDO($dsn, $username, $password));
} catch (PDOException $err) {
    echo "Terdapat masalah saat menghubungkan ke database<br>";
    echo "Error: " . $err->getMessage();
    die();
}
