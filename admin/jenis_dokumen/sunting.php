<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../validators/jenis_dokumen_validator.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID dari
 * jenis dokumen yang akan disunting
 */
if (!isset($_GET["id"])) {
    header("Location: " . "admin/jurusan/jenis_dokumen");
    exit();
}

$id = $_GET["id"];

// Mendapatkan data dari jenis dokumen berdasarkan ID nya
$jenisDokumen = detailJenisDokumenService($id);

/**
 * Pengaman jika jenis dokumen yang akan disunting tidak ditemukan
 */
if (!$jenisDokumen) {
    header("Location: " . BASE_URL . "admin/jurusan/jenis_dokumen");
    exit();
}

/**
 * Menangani jika proses penyuntingan dilakukan
 */
if (isset($_POST["sunting-jenis-dokumen"])) {
    // htmlspecialchars untuk menghindari XSS
    $namaJenisDokumen = htmlspecialchars($_POST["nama-jenis-dokumen"]);

    // Array yang menyimpan pesan-pesan kesalahan
    $errors = [];

    // Memvalidasi nama jenis dokumen jika nama yang dimasukkan berbeda dengan nama sebelumnya
    if ($namaJenisDokumen !== $jenisDokumen["jenis_dokumen"]) {
        validateNamaJenisDokumen($namaJenisDokumen, $errors);
    }

    // Jika tidak ada error, maka lakukan proses sunting
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
    <!-- Memasukkan konfigurasi head -->
    <?php include_once __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container">
        <h1>
            Sunting Jenis Dokumen
        </h1>

        <hr class="divider">

        <!-- Form yang berisi input-input untuk menyunting jenis dokumen -->
        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-jenis-dokumen">Nama Jenis Dokumen</label>
                <input type="text" name="nama-jenis-dokumen" id="nama-jenis-dokumen" value="<?= $jenisDokumen["jenis_dokumen"] ?>">

                <!-- menampilkan pesan error -->
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

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>