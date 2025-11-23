<?php
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
</head>

<body>
    <div class="container">
        <div class="stat" id="total-user">
            <h1>
                Jumlah Pengguna
            </h1>

            <p>
                <!--  -->
            </p>
        </div>

        <div class="stat" id="total-admin">
            <h1>
                Jumlah Admin
            </h1>

            <p>
                <!--  -->
            </p>
        </div>

        <div class="stat" id="total-calon-siswa">
            <h1>
                Jumlah Calon Siswa
            </h1>

            <p>
                <!--  -->
            </p>
        </div>

        <div class="stat" id="total-form-pendaftaran">
            <h1>
                Jumlah Form Pendaftaran
            </h1>

            <p>
                <!--  -->
            </p>
        </div>

        <div class="stat" id="total-jurusan">
            <h1>
                Jumlah Jurusan
            </h1>

            <p>
                <!--  -->
            </p>
        </div>
    </div>
</body>

</html>