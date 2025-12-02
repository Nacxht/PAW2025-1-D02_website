<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../validators/jurusan_validator.php";
require_once __DIR__ . "/../../services/jurusan_service.php";

/**
 * Pengaman jika tidak terdapat request GET yang membawa ID
 * dari jurusan yang akan disunting
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

$id = $_GET["id"];

// Mengambil data jurusan berdasarkan ID nya
$jurusan = detailJurusanService($id);

// Jika jurusan tidak ada
if (!$jurusan) {
    header("Location: " . BASE_URL . "admin/jurusan");
    exit();
}

/**
 * Menangani proses sunting jurusan
 */
if (isset($_POST["sunting-jurusan"])) {
    // htmlspecialchars untuk menghindari XSS
    $namaJurusan = htmlspecialchars($_POST["nama-jurusan"]);
    $deskripsiJurusan = htmlspecialchars($_POST["deskripsi-jurusan"]);

    // Array untuk menyimpan pesan-pesan error
    $errors = [];

    // Validasi nama jurusan jika nilai input berbeda dengan sebelumnya
    if ($namaJurusan != $jurusan["nama_jurusan"]) {
        validateNamaJurusan($namaJurusan, $errors);
    }

    // Validasi deskripsi jurusan jika nilai input berbbeda dengan sebelumnya
    if ($deskripsiJurusan != $jurusan["deskripsi_jurusan"]) {
        validateDeskripsiJurusan($deskripsiJurusan, $errors);
    }

    // Jika tidak ada error, jalankan proses sunting jurusan
    if (!$errors) {
        suntingJurusanService($_POST, $jurusan["id_jurusan"]);
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

    <!-- Memasukkan CSS yang dibutuhkan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="sunting-jurusan">
        <div class="title">
            Sunting Jurusan
        </div>

        <hr class="divider">

        <!-- Form yang berisi input-input untuk melakukan sunting -->
        <form method="post">
            <div class="input-container">
                <label for="nama-jurusan">Nama Jurusan</label>
                <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $jurusan["nama_jurusan"] ?>">

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
                <textarea name="deskripsi-jurusan" id="deskripsi-jurusan"><?= $jurusan["deskripsi_jurusan"] ?></textarea>

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

            <button type="submit" name="sunting-jurusan" class="btn btn-success">
                Submit
            </button>
        </form>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>