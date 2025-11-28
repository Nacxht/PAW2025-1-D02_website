<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

$id = $_GET["id"];
$jurusan = detailJurusanService($id);

if (!$jurusan) {
    header("Location: " . BASE_URL . "admin/jurusan");
}

if (isset($_POST["sunting-jurusan"])) {
    $namaJurusan = $_POST["nama-jurusan"];
    $deskripsiJurusan = $_POST["deskripsi-jurusan"];

    $errors = [];

    validateNamaJurusan($namaJurusan, $errors);
    validateDeskripsiJurusan($deskripsiJurusan, $errors);

    if (!$errors) {
        suntingJurusanService($_POST, $jurusan["id_jurusan"]);
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

    <div class="container" id="sunting-jurusan">
        <h1>
            Sunting Jurusan
        </h1>

        <hr class="divider">

        <form action="" method="post">
            <div class="input-container">
                <label for="nama-jurusan">Nama Jurusan</label>
                <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $jurusan["nama_jurusan"] ?>">

                <?php if (isset($errors["nama-jurusan"])): ?>
                    <ul>
                        <?php foreach ($errors["nama-jurusan"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="input-container">
                <label for="deskripsi-jurusan">Deskripsi Jurusan</label>
                <textarea name="deskripsi-jurusan" id="deskripsi-jurusan"><?= $jurusan["deskripsi_jurusan"] ?></textarea>

                <?php if (isset($errors["deskripsi-jurusan"])): ?>
                    <ul>
                        <?php foreach ($errors["deskripsi-jurusan"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif; ?>
            </div>

            <button type="submit" name="sunting-jurusan" class="btn btn-success">
                Submit
            </button>
        </form>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>