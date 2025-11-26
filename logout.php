<?php
require_once __DIR__ .  "/auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/config.php";

// jika session belum aktif
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();

    header("Location: " . BASE_URL);
    exit();
}
