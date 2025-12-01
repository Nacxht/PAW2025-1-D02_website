<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

if (isset($_POST["tambah-program"])) {
    $namaProgram = $_POST["nama-program"];
    $deskripsiProgram = $_POST["deskripsi-program"];

    $errors = [];

    validateNamaProgram($namaProgram, $errors);
    validateDeskripsiProgram($deskripsiProgram, $errors);

    if (!$errors) {
        tambahProgramService($_POST);
        header("Location: " . BASE_URL . "admin/program");
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

    <div class="container" id="tambah-program">
        <h1>
            Tambah Program
        </h1>

        <hr class="divider">

        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-program">Nama Program</label>
                <input type="text" name="nama-program" id="nama-program" value="<?= htmlspecialchars($namaProgram ?? "") ?>">

                <?php if (isset($errors["nama-program"])): ?>
                    <ul>
                        <?php foreach ($errors["nama-program"] as $error): ?>
                            <li class="error-message"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container">
                <label for="deskripsi-program">Deskripsi Program</label>
                <textarea name="deskripsi-program" id="deskripsi-program"><?= htmlspecialchars($deskripsiProgram ?? "") ?></textarea>

                <?php if (isset($errors["deskripsi-program"])): ?>
                    <ul>
                        <?php foreach ($errors["deskripsi-program"] as $error): ?>
                            <li class="error-message"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <button type="submit" class="btn btn-success" name="tambah-program">
                Submit
            </button>
        </form>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>