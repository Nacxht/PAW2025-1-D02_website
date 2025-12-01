<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

/**
 * Menangani jika tidak terdapat request GET yang membawa ID
 * dari program yang akan disunting
 */
if (!isset($_GET["id"])) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

$id = $_GET["id"];

// Mengambil data program berdasarkan ID nya
$program = detailProgramService($id);

/**
 * Jika program tidak ditemukan, maka arahkan user ke halaman
 * daftar program
 */
if (!$program) {
    header("Location: " . BASE_URL . "admin/program");
    exit();
}

// Menangani proses sunting program
if (isset($_POST["sunting-program"])) {
    // htmlspecialchars untuk menghindari serangan XSS
    $namaProgram = htmlspecialchars($_POST["nama-program"]);
    $deskripsiProgram = htmlspecialchars($_POST["deskripsi-program"]);

    // Array yang menyimpan pesan-pesan error
    $errors = [];

    // Validasi nama program jika input saat ini berbeda dengan nilai sebelumnya
    if ($namaProgram != $program["nama_program"]) {
        validateNamaProgram($namaProgram, $errors);
    }

    // Validasi deskripsi program jika input saat ini berbeda dengan nilai sebelumnya
    if ($deskripsiProgram != $program["deskripsi_program"]) {
        validateDeskripsiProgram($deskripsiProgram, $errors);
    }

    // Lakukan proses sunting jika tidak terdapat error
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
        <h1>
            Sunting Program
        </h1>

        <hr class="divider">

        <!-- Form yang berisi input-input untuk melakkukan proses sunting -->
        <form action="" method="post" class="create-update">
            <div class="input-container">
                <label for="nama-program">Nama Program</label>
                <input type="text" name="nama-program" id="nama-program" value="<?= $program["nama_program"] ?>">

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
                <textarea name="deskripsi-program" id="deskripsi-program"><?= $program["deskripsi_program"] ?></textarea>

                <!-- Menampilkan pesan-pesan error -->
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

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>