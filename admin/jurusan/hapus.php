<?php
require_once __DIR__ . "/../../auth_middleware/after_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

$id = $_GET["id"];
$jurusan = detailJurusanService($id);

if (!$jurusan) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

hapusJurusanService($id);
header("Location: " . BASE_URL . "admin/jurusan");
exit();
