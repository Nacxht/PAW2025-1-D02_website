<?php
// Memasukkan file yang dibutuhkan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jenis_dokumen_service.php";
require_once __DIR__ . "/../../config.php";

// Mendapatkan data-data jenis dokumen
$daftarJenisDokumen = daftarJenisDokumenService();

// Menangani jika filter diisi oleh user
if (isset($_GET["jenis-dokumen-filter"])) {
    $jenisDokumen = htmlspecialchars($_GET["jenis-dokumen"]);
    $daftarJenisDokumen = daftarJenisDokumenService($jenisDokumen);
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

    <div class="container" id="daftar-jenis-dokumen">
        <h1>
            Daftar Jenis Dokumen
        </h1>

        <hr class="divider">

        <div class="filter-section">
            <a href="<?= BASE_URL . "admin/jenis_dokumen/tambah.php" ?>" class="btn btn-info">
                Tambah Jenis Dokumen
            </a>

            <!-- Form untuk melakukan filter berdasarkan nama jenis dokumen -->
            <form action="" method="get">
                <div class="input-container">
                    <label for="jenis-dokumen">Nama Jenis Dokumen</label>
                    <input type="text" name="jenis-dokumen" id="jenis-dokumen" value="<?= $jenisDokumen ?? '' ?>">
                </div>

                <button type="submit" class="btn btn-neutral" name="jenis-dokumen-filter">
                    Cari Jenis Jurusan
                </button>
            </form>
        </div>

        <!-- Tabel untuk menampilkan data-data dari jenis dokumen -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Jenis Dokumen</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($daftarJenisDokumen): ?>
                    <!-- Jika data ada -->
                    <?php foreach ($daftarJenisDokumen as $jenisDokumens): ?>
                        <tr>
                            <td><?= $jenisDokumens["jenis_dokumen"] ?></td>
                            <td class="table-action-column">
                                <a href="<?= BASE_URL . "admin/jenis_dokumen/sunting.php?id=" . $jenisDokumens["id_jenis_dokumen"] ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <a href="<?= BASE_URL . "admin/jenis_dokumen/hapus.php?id=" . $jenisDokumens["id_jenis_dokumen"] ?>" class="btn btn-error">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <!-- Jika data tidak ada -->
                    <tr>
                        <td class="data-empty" colspan="2">
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