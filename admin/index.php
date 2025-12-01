<?php
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../services/jurusan_service.php";
require_once __DIR__ . "/../services/user_service.php";
// require_once __DIR__ . "/../services/form_pendaftaran.php";

$jurusanCount = jumlahJurusanService();
$userCount = getUserCountService();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/../components/layouts/meta_title.php" ?>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <?php include __DIR__ . "/../components/layouts/navbar.php" ?>

    <div class="container" id="dashboard">
        <h1>
            Dashboard
        </h1>

        <div class="stats-container">
            <div class="stat" id="total-user">
                <h1>
                    Jumlah Pengguna
                </h1>

                <hr class="divider">

                <p>
                    <?= $userCount["total_user"] ?>
                </p>
            </div>

            <div class="stat" id="total-admin">
                <h1>
                    Jumlah Admin
                </h1>

                <hr class="divider">

                <p>
                    <?= $userCount["total_admin"] ?>
                </p>
            </div>

            <div class="stat" id="total-calon-siswa">
                <h1>
                    Jumlah Calon Siswa
                </h1>

                <hr class="divider">

                <p>
                    <?= $userCount["total_calon_siswa"] ?>
                </p>
            </div>

            <div class="stat" id="total-form-pendaftaran">
                <h1>
                    Jumlah Form Pendaftaran
                </h1>

                <hr class="divider">

                <p>
                    0
                </p>
            </div>

            <div class="stat" id="total-jurusan">
                <h1>
                    Jumlah Jurusan
                </h1>

                <hr class="divider">

                <p>
                    <?= $jurusanCount ?>
                </p>
            </div>
        </div>
    </div>

    <?php include_once __DIR__ . "/../components/layouts/footer.php" ?>
</body>

</html>