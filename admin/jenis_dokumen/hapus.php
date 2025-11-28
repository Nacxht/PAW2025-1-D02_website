<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jenis_dokumen");
    exit();
}

$id = $_GET["id"];
$jenisDokumen = detailJenisDokumenService($id);

if (!$jenisDokumen) {
    header("Location: " . BASE_URL . "admin/jenis_dokumen");
    exit();
}

hapusJenisDokumenService($id);
header("Location: " . BASE_URL . "admin/jenis_dokumen");
exit();
