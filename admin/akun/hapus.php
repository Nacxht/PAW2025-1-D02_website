<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__  . "/../../services/user_service.php";

if (!isset($_GET["id"]) || !isset($_GET["role"])) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

$id = $_GET["id"];
$role = $_GET["role"];

deleteUserService($id, $role);
