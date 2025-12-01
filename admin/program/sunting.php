<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

$id = $_GET["id"];
$program = detailProgramService($id);

if (!$program) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

if (isset($_POST["sunting-program"])) {
    $namaProgram = $_POST["nama-program"];
    $deskripsiProgram = $_POST["deskripsi-program"];

    $errors = [];

    if ($namaProgram != $program["nama_program"]) {
        validateNamaProgram($namaProgram, $errors);
    }

    if ($deskripsiProgram != $program["deskripsi_program"]) {
        validateDeskripsiProgram($deskripsiProgram, $errors);
    }

    if (!$errors) {
        suntingProgramService($id, $_POST);
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
            Sunting Program
        </h1>

        <hr class="divider">

        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-program">Nama Program</label>
                <input type="text" name="nama-program" id="nama-program" value="<?= $program["nama_program"] ?>">

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
                <textarea name="deskripsi-program" id="deskripsi-program"><?= $program["deskripsi_program"] ?></textarea>

                <?php if (isset($errors["deskripsi-program"])): ?>
                    <ul>
                        <?php foreach ($errors["deskripsi-program"] as $error): ?>
                            <li class="error-message"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <button type="submit" class="btn btn-success" name="sunting-program">
                Submit
            </button>
        </form>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>