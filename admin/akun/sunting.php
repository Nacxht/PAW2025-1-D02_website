<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/user_service.php";
require_once __DIR__ . "/../../validators/user_validator.php";

if (!isset($_GET["id"]) || !isset($_GET["role"])) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

$id = $_GET["id"];
$role = $_GET["role"];
$user = getUserByID($id, $role);

if (!$user) {
    header("Location: " . BASE_URL . "admin/akun");
    exit();
}

if (isset($_POST["user-edit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    $errors = [];

    if ($username != $user["username"]) {
        validateUsername($username, $errors);
    }

    if ($email != $user["email"]) {
        validateEmail($email, $errors);
    }

    if ($role !== $user["role"]) {
        validateRole($role, $errors);
    }

    if ($password) {
        validatePassword($password, $errors);
        updateUserPasswordService($password, $id, $role);
    }

    if (!$errors) {
        updateUserService($_POST, $_POST["role"], $id);
        header("Location: " . BASE_URL . "admin/akun");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="sunting-akun">
        <h1>Sunting Akun</h1>

        <hr class="divider">

        <form action="" method="post" class="user-account-form">
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $user["username"] ?>">

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

            <div class="input-container">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $user["email"] ?>">

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

            <div class="input-container">
                <label for="password">Password (kosongi jika tidak ingin mengubah password)</label>
                <input type="password" name="password" id="password">

                <?php if (isset($errors["password"])): ?>
                    <ul>
                        <?php foreach ($errors["password"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container">
                <label for="role">Role</label>

                <select name="role" id="role">
                    <option value="admin" <?= $user["role"] == "admin" ?>>Admin</option>
                    <option value="calon_siswa">Calon Siswa</option>
                </select>

                <?php if (isset($errors["role"])): ?>
                    <ul>
                        <?php foreach ($errors["role"] as $error): ?>
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

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>