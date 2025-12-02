<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

// Menangani proses tambah program
if (isset($_POST["tambah-program"])) {
    // htmlspecialchars untuk menghindari serangan XSS
    $namaProgram = htmlspecialchars($_POST["nama-program"]);
    $deskripsiProgram = htmlspecialchars($_POST["deskripsi-program"]);

    // Array yang menyimpan pesan-pesan error
    $errors = [];

    // Melakukan validasi dari input yang dimasukkan
    validateNamaProgram($namaProgram, $errors);
    validateDeskripsiProgram($deskripsiProgram, $errors);

    // Jika tidak terdapat error, maka lakukan proses tambah program
    if (!$errors) {
        tambahProgramService($_POST);
        header("Location: " . BASE_URL . "admin/program");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

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

    <div class="container" id="tambah-program">
        <div class="title">
            Tambah Program
        </div>

        <hr class="divider">

        <!-- Form yang berisi input-input untuk melakukan proses tambah program -->
        <form method="post" class="create-update">
            <div class="input-container">
                <label for="nama-program">Nama Program</label>
                <input type="text" name="nama-program" id="nama-program" value="<?= $namaProgram ?? "" ?>">

                <!-- Menampilkan pesan-pesan error -->
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
                <textarea name="deskripsi-program" id="deskripsi-program"><?= $deskripsiProgram ?? "" ?></textarea>

                <!-- Menampilkan pesan-pesan error -->
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

    <!-- Menampilkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>