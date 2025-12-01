<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../validators/jenis_dokumen_validator.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";

// Menangani proses menambah data jenis dokumen
if (isset($_POST["tambah-jenis-dokumen"])) {
    // htmlspecialchars untuk menghindari XSS
    $namaJenisDokumen = htmlspecialchars($_POST["nama-jenis-dokumen"]);

    // Array yang menyimpan pesan-pesan error
    $errors = [];

    // Memvalidasi nama jenis dokumen
    validateNamaJenisDokumen($namaJenisDokumen, $errors);

    // Tambahkan data jika tidak ada error
    if (!$errors) {
        tambahJenisDokumenService($_POST);

        header("Location: " . BASE_URL . "admin/jenis_dokumen");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan konfigurasi head -->
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang dibutuhkan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="tambah-jenis-dokumen">
        <h1>
            Tambah Jenis Dokumen
        </h1>

        <hr class="divider">

        <!-- Form yang berisi input untuk menambah jenis dokumen -->
        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-jenis-dokumen">Nama Jenis Dokumen</label>
                <input type="text" name="nama-jenis-dokumen" id="nama-jenis-dokumen" value="<?= $namaJenisDokumen ?? "" ?>">

                <!-- Menampilkan pesan error -->
                <?php if (isset($errors["nama-jenis-dokumen"])): ?>
                    <ul>
                        <?php foreach ($errors["nama-jenis-dokumen"] as $error): ?>
                            <li class="error-message"><?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <button type="submit" class="btn btn-success" name="tambah-jenis-dokumen">
                Submit
            </button>
        </form>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>