<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../validators/jurusan_validator.php";

if (isset($_POST["add-major"])) {
    $majorName = htmlspecialchars($_POST["nama-jurusan"]);
    $majorDescription = htmlspecialchars($_POST["deskripsi-jurusan"]);

    $errors = [];

    validateNamaJurusan($majorName, $errors);
    validateDeskripsiJurusan($majorDescription, $errors);

    if (!$errors) {
        tambahJurusanService($_POST);
        header("Location: " . BASE_URL . "admin/jurusan");
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

    <div class="container" id="tambah-jurusan">
        <h1>
            Tambah Jurusan
        </h1>

        <hr class="divider">

        <form action="" method="post">
            <div class="input-container">
                <label for="nama-jurusan">Nama Jurusan</label>
                <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $majorName ?? "" ?>">

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
                <textarea name="deskripsi-jurusan" id="deskripsi-jurusan"><?= $majorDescription ?? "" ?></textarea>

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

            <button type="submit" name="add-major" class="btn btn-success">
                Submit
            </button>
        </form>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>