<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/user_service.php";
require_once __DIR__ . "/../../config.php";

$username = htmlspecialchars($_GET["username"] ?? "");
$role = $_GET["role"] ?? "";
$users = getUsersService($role, $username);
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

    <div class="container" id="daftar-akun">
        <h1>
            Daftar Akun Pengguna
        </h1>

        <hr class="divider">

        <form action="" method="get" class="filter">
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $username ?>">
            </div>

            <div class="input-container">
                <label for="role">Role</label>

                <select name="role" id="role">
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" <?= $role == "admin" ? "selected" : "" ?>>Admin</option>
                    <option value="calon_siswa" <?= $role == "calon_siswa" ? "selected" : "" ?>>Calon Siswa</option>
                </select>
            </div>

            <button type="submit" class="btn btn-neutral">
                Cari Pengguna
            </button>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="table-action-column">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!$users): ?>
                    <tr>
                        <td class="data-empty">
                            Data Kosong
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td>
                                <?= $user["username"] ?>
                            </td>

                            <td>
                                <?= $user["email"] ?>
                            </td>

                            <td>
                                <?= $user["role"] ?>
                            </td>

                            <td class="table-action-column">
                                <a href="<?= BASE_URL . "admin/akun/sunting.php?id=" . urlencode($user["id_user"]) . "&role=" . urlencode($user["role"]) ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <?php if ($user["id_user"] != $_SESSION["id_user"]): ?>
                                    <a href="<?= BASE_URL . "admin/akun/hapus.php?id=" . urlencode($user["id_user"]) . "&role=" . urlencode($user["role"]) ?>" class="btn btn-error">
                                        Hapus
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>