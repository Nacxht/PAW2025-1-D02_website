<?php
// memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/user_service.php";
require_once __DIR__ . "/../../config.php";

/**
 * Menggunakan htmlspecialchars() untuk menghindari
 * serangan XSS oleh penyerang
 */
$username = htmlspecialchars($_GET["username"] ?? "");
$role = htmlspecialchars($_GET["role"] ?? "");
$users = getUsersService($role, $username);
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

    <div class="container" id="daftar-akun">
        <h1>
            Daftar Akun Pengguna
        </h1>

        <hr class="divider">

        <!-- Form untuk melakukan filter/pencarian -->
        <form action="" method="get" class="filter">
            <!-- Input filter username -->
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= $username ?>">
            </div>

            <!-- Input filter role -->
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

        <!-- Tabel yang menampilkan data-data akun yang ada -->
        <table class="data-table">
            <!-- Bagian head dari tabel -->
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="table-action-column">Aksi</th>
                </tr>
            </thead>

            <!-- Bagian data dari tabel -->
            <tbody>
                <?php if (!$users): ?>
                    <!-- Jika data kosong -->
                    <tr>
                        <td class="data-empty" colspan="4">
                            Data Kosong
                        </td>
                    </tr>
                <?php else: ?>
                    <!-- Jika data tidak kosong -->
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
                                <!-- Tombol yang mengarahkan ke halaman sunting menggunakan method GET -->
                                <a href="<?= BASE_URL . "admin/akun/sunting.php?id=" . urlencode($user["id_user"]) . "&role=" . urlencode($user["role"]) ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <!-- 
                                    Kondisi untuk menyembunyikan tombol hapus ketika data tersebut adalah
                                    miliknya sendiri, atau ketika data tersebut memiliki role "admin"
                                 -->
                                <?php if (($user["id_user"] != $_SESSION["id_user"]) || $user["role"] == "admin"): ?>
                                    <!-- Tombol yang mengarahkan ke halaman hapus -->
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

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>