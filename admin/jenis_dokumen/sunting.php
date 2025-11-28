<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../validators/jenis_dokumen_validator.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";

if (!isset($_GET["id"])) {
    header("Location: " . "admin/jurusan/jenis_dokumen");
    exit();
}

$id = $_GET["id"];
$jenisDokumen = detailJenisDokumenService($id);

if (!$jenisDokumen) {
    header("Location: " . BASE_URL . "admin/jurusan/jenis_dokumen");
    exit();
}

if (isset($_POST["sunting-jenis-dokumen"])) {
    $namaJenisDokumen = $_POST["nama-jenis-dokumen"];

    $errors = [];

    if ($namaJenisDokumen !== $jenisDokumen["jenis_dokumen"]) {
        validateNamaJenisDokumen($namaJenisDokumen, $errors);
    }

    if (!$errors) {
        suntingJenisDokumenService($_POST, $id);
        header("Location: " . BASE_URL . "admin/jenis_dokumen");
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

    <div class="container">
        <h1>
            Sunting Jenis Dokumen
        </h1>

        <hr class="divider">

        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-jenis-dokumen">Nama Jenis Dokumen</label>
                <input type="text" name="nama-jenis-dokumen" id="nama-jenis-dokumen" value="<?= $jenisDokumen["jenis_dokumen"] ?>">

                <?php if (isset($errors["nama-jenis-dokumen"])): ?>
                    <ul>
                        <?php foreach ($errors["nama-jenis-dokumen"] as $error): ?>
                            <li class="error-message"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <button type="submit" class="btn btn-success" name="sunting-jenis-dokumen">
                Submit
            </button>
        </form>
    </div>

    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>