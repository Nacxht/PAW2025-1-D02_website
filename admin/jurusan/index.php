<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../config.php";

// Mengambil data-data jurusan
$daftarJurusan = daftarJurusanService();

/**
 * Menangani jika terdapat filter dengan nama jurusan
 */
if (isset($_POST["nama-jurusan"])) {
    // htmlspecialchars untuk menghindari XSS
    $namaJurusan = htmlspecialchars($_POST["nama-jurusan"]);

    // Memperbarui data yang diambil ketika terdapat filter
    $daftarJurusan = daftarJurusanService($namaJurusan);
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
    <?php include __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="daftar-jurusan">
        <div class="title">
            Daftar Jurusan
        </div>

        <hr class="divider">

        <div class="search-add">
            <!-- Tombol untuk mengarahkan user ke halaman tambah -->
            <a href="<?= BASE_URL . "/admin/jurusan/tambah.php" ?>" class="btn btn-info">
                Tambah Data
            </a>

            <!-- Form untuk melakukan filter jurusan -->
            <form method="post" class="filter">
                <div class="input-container">
                    <label for="nama-jurusan">Nama Jurusan</label>
                    <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $namaJurusan ?? '' ?>">
                </div>

                <button type="submit" class="btn btn-neutral">
                    Cari Jurusan
                </button>
            </form>
        </div>

        <!-- Tabel untuk menampilkan data-data jurusan -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Jurusan</th>
                    <th>Deskripsi Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!$daftarJurusan): ?>
                    <!-- Jika data kosong -->
                    <tr>
                        <td class="data-empty" colspan="3">
                            Data Kosong
                        </td>
                    </tr>
                <?php else: ?>
                    <!-- Jika data ada -->
                    <?php foreach ($daftarJurusan as $data): ?>
                        <tr>
                            <td><?= $data["nama_jurusan"] ?></td>
                            <td><?= $data["deskripsi_jurusan"] ?></td>

                            <td class="table-action-column">
                                <a href="<?= BASE_URL . "admin/jurusan/sunting.php?id=" . urlencode($data["id_jurusan"]) ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <a href="<?= BASE_URL . "admin/jurusan/hapus.php?id=" . urlencode($data["id_jurusan"]) ?>" class="btn btn-error">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <!-- Memasukkan footer -->
    <?php include __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>