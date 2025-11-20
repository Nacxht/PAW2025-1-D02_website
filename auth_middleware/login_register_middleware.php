<?php
require_once dirname(__FILE__) . "/../config.php";

session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["role"])) {
    if ($_SESSION["role"] == "admin") {
        header("location: " . BASE_URL . "admin/");
    } else {
        header("location: " . BASE_URL . "calon_siswa/");
    }
}
