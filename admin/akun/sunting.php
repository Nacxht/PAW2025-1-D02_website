<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/user_service.php";
require_once __DIR__ . "/../../validators/user_validator.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID
 * dan Role user yang akan dihapus
 */
if (!isset($_GET["id"]) || !isset($_GET["role"])) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

$id = $_GET["id"];
$role = $_GET["role"];

// Mendapatkan data pengguna berdasarkan ID yang diberikan
$user = getUserByID($id, $role);

/**
 * IF statement untuk mengecek apakah akun pengguna yang akan diedit
 * ada atau tidak.
 * 
 * Jika tidak ada akan diarahkan ke halaman daftar akun
 */
if (!$user) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

/**
 * IF statement untuk mengecek apakah request POST untuk menyunting
 * pengguna dikirim atau belum
 */
if (isset($_POST["user-edit"])) {
    // htmlspecialchars untuk menghindari serangan XSS
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);

    // Array untuk menyimpan pesan-pesan error
    $errors = [];

    // Lakukan validasi ketika username berbeda dengan data sebelumnya
    if ($username != $user["username"]) {
        validateUsername($username, $errors);
    }

    // Lakukan validasi ketika email berbada dengan data sebelumnya
    if ($email != $user["email"]) {
        validateEmail($email, $errors);
    }

    // Jika tidak ada error, perbarui data pengguna
    if (!$errors) {
        updateUserService($_POST, $role, $id);
        header("Location: " . BASE_URL . "admin/akun");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan beberapa konfigurasi default dari head -->
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan css yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="sunting-akun">
        <h1>Sunting Akun</h1>

        <hr class="divider">

        <!-- Form untuk melakukan penyuntingan akun -->
        <form action="" method="post" class="user-account-form">
            <!-- Input username -->
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $user["username"] ?>">

                <!-- Menampilkan pesan error -->
                <?php if (isset($errors["username"])): ?>
                    <ul>
                        <?php foreach ($errors["username"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <!-- Input email -->
            <div class="input-container">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $user["email"] ?>">

                <!-- Menampilkan pesan error -->
                <?php if (isset($errors["email"])): ?>
                    <ul>
                        <?php foreach ($errors["email"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <button type="submit" class="btn btn-success" name="user-edit">
                Submit
            </button>
        </form>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>