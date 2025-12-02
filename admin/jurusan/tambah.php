<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../validators/jurusan_validator.php";

// Menangani proses penambahan jurusan
if (isset($_POST["add-major"])) {
    // htmlspecialchars untukmenghindar XSS
    $majorName = htmlspecialchars($_POST["nama-jurusan"]);
    $majorDescription = htmlspecialchars($_POST["deskripsi-jurusan"]);

    // Array untuk menyimpan pesan-pesan error
    $errors = [];

    // Melakukan validasi kepada input
    validateNamaJurusan($majorName, $errors);
    validateDeskripsiJurusan($majorDescription, $errors);

    // Jika tidak ada error, maka lakukan proses penambahan
    if (!$errors) {
        tambahJurusanService($_POST);
        header("Location: " . BASE_URL . "admin/jurusan");
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

    <div class="container" id="tambah-jurusan">
        <div class="title">
            Tambah Jurusan
        </div>

        <hr class="divider">

        <!-- Form yang berisi input untuk menambah data jurusan baru -->
        <form method="post">
            <div class="input-container">
                <label for="nama-jurusan">Nama Jurusan</label>
                <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $majorName ?? "" ?>">

                <!-- Menampilkan pesan error -->
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

                <!-- Menampilkan pesan error -->
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

    <!-- Memasukkan footer  -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>