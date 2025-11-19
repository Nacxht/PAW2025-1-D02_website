<?php
require_once "config.php";

session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["role"])) {
    header("location: " . BASE_URL . "login.php");
}

if ($_SESSION["role"] == "admin") {
    header("location: " . BASE_URL . "admin/index.php");
} else {
    header("location: " . BASE_URL . "calon_siswa/index.php");
}
