<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../config.php";
require_once __DIR__ . "/../../validators/program_validator.php";
require_once __DIR__ . "/../../services/program_service.php";

// Mengambil semua data dari tabel program
$daftarProgram = daftarProgramService();

// Menangani jika terdapat request filter
if (isset($_GET["nama-program"])) {
    // htmlspecialchars untuk menghindari serangan XSS
    $namaProgram = htmlspecialchars($_GET["nama-program"]);

    // Memperbarui daftar program untuk melakukan proses filter
    $daftarProgram = daftarProgramService($namaProgram);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan konfigurasi head -->
    <?php include_once  __DIR__ . "/../../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/admin.css" ?>">
</head>

<body>
    <!-- Memasukkan navbawwr -->
    <?php include_once __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="daftar-program">
        <h1>
            Daftar Program
        </h1>

        <hr class="divider">

        <div class="filter-section">
            <!-- Tombol untuk mengarahkan user ke halaman tambah program -->
            <a href="<?= BASE_URL . "admin/program/tambah.php" ?>" class="btn btn-info">
                Tambah Program
            </a>

            <!-- Form untuk melakukan filter program berdasarkan namanya -->
            <form action="" method="get">
                <div class="input-container">
                    <label for="nama-program">Nama program</label>
                    <input type="text" name="nama-program" id="nama-program" value="<?= htmlspecialchars($_GET["nama-program"] ?? '') ?>">
                </div>

                <button type="submit" class="btn btn-neutral">
                    Cari program
                </button>
            </form>
        </div>

        <!-- Tabel yang menampilkan data dari tabel program -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Program</th>
                    <th>Deskripsi Program</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($daftarProgram): ?>
                    <!-- Jika data ada -->
                    <?php foreach ($daftarProgram as $program): ?>
                        <tr>
                            <td><?= $program["nama_program"] ?></td>
                            <td><?= $program["deskripsi_program"] ?></td>
                            <td class="table-action-column">
                                <a href="<?= BASE_URL . "admin/program/sunting.php?id=" . $program["id_program"] ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <a href="<?= BASE_URL . "admin/program/hapus.php?id=" . $program["id_program"] ?>" class="btn btn-error">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <!-- Jika data tidak ada -->
                    <tr>
                        <td class="data-empty" colspan="3">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>