<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__  . "/../../services/user_service.php";

if (!isset($_GET["id"]) || !isset($_GET["role"])) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

$id = $_GET["id"];
$role = $_GET["role"];

if ($id == $_SESSION["id_user"]) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

$user = getUserByID($id, $role);

if (!$user) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

deleteUserService($id, $role);
header("Location: " . BASE_URL . "admin/akun");
exit();
