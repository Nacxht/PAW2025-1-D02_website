<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/validators/user_validator.php";
require_once __DIR__ . "/services/user_service.php";
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db_conn.php";

// Menangani proses edit
if (isset($_POST["profile-edit-submit"])) {
    // Mendapatkan data user berdasarkan ID dan Role user
    $user = getUserByID($_SESSION["id_user"], $_SESSION["role"]);

    // htmlspecialchars untuk menghindari XSS
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);

    // Array yang menyimpan pesan-pesan error
    $errors = [];

    // Lakukan validasi jika input username berbeda dengan sebelumnya
    if ($username != $user["username"]) {
        validateUsername($username, $errors);
    }

    // Lakukan validasi jika input email berbeda dengan sebelumnya
    if ($email != $user["email"]) {
        validateEmail($email, $errors);
    }

    // Jika tidak ada error, maka perbarui data user
    if (!$errors) {
        updateUserService($_POST, $_SESSION["role"], $_SESSION["id_user"]);
    }
}

// Toogle untuk megubah mode (mode edit/lihat)
$isEdit = false;
if (isset($_POST["profile-edit"]) || isset($_POST["profile-cancel-edit"])) {
    if (isset($_POST["profile-edit"])) {
        $isEdit = true;
    } else {
        $isEdit = false;
    }
}

// Mendapatkan data user berdasarkan ID dan Role user
$user = getUserByID($_SESSION["id_user"], $_SESSION["role"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan konfigurasi head -->
    <?php include_once __DIR__ . "/components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/profil.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/components/layouts/navbar.php" ?>

    <div class="container">
        <div id="profile-section">
            <h1>
                Profil Pengguna
            </h1>

            <div class="buttons-container">
                <!-- Form yang berisi tombol untuk mengubah mode edit/lihat -->
                <form action="" method="post" id="edit">
                    <?php if (!$isEdit): ?>
                        <button type="submit" class="btn btn-info" name="profile-edit">
                            Sunting Profil
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-accent" name="profile-cancel-edit">
                            Batal Sunting
                        </button>
                    <?php endif; ?>
                </form>

                <!-- Form yang berisi tombol untuk logout -->
                <form id="logout" method="post" action="<?= BASE_URL . "logout.php" ?>">
                    <button type="submit" class="btn btn-error" name="logout">
                        Logout
                    </button>
                </form>
            </div>

            <hr class="divider">

            <!-- Memasukkan form untuk menyunting/mengedit profil  -->
            <?php include_once __DIR__ . "/components/forms/profil_form.php" ?>
        </div>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/components/layouts/footer.php" ?>
</body>

</html>