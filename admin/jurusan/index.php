<?php
require_once __DIR__ . "/../../auth_middleware/before_login_middleware.php";
require_once __DIR__ . "/../../services/jurusan_service.php";
require_once __DIR__ . "/../../config.php";

$majors = daftarJurusanService();

if (isset($_POST["nama-jurusan"])) {
    $majorName = htmlspecialchars($_POST["nama-jurusan"]);
    $majors = daftarJurusanService($majorName);
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
    <?php include __DIR__ . "/../../components/layouts/navbar.php" ?>

    <div class="container" id="daftar-jurusan">
        <h1>
            Daftar Jurusan
        </h1>

        <hr class="divider">

        <div class="search-add">
            <a href="<?= BASE_URL . "/admin/jurusan/tambah.php" ?>" class="btn btn-info">
                Tambah Data
            </a>

            <form action="" method="post" class="filter">
                <div class="input-container">
                    <label for="nama-jurusan">Nama Jurusan</label>
                    <input type="text" name="nama-jurusan" id="nama-jurusan" value="<?= $majorName ?? '' ?>">
                </div>

                <button type="submit" class="btn btn-neutral">
                    Cari Jurusan
                </button>
            </form>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama Jurusan</th>
                    <th>Deskripsi Jurusan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!$majors): ?>
                    <tr>
                        <td class="data-empty" colspan="3">
                            Data Kosong
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($majors as $major): ?>
                        <tr>
                            <td><?= $major["nama_jurusan"] ?></td>
                            <td><?= $major["deskripsi_jurusan"] ?></td>

                            <td class="table-action-column">
                                <a href="<?= BASE_URL . "admin/jurusan/sunting.php?id=" . urlencode($major["id_jurusan"]) ?>" class="btn btn-info">
                                    Sunting
                                </a>

                                <a href="<?= BASE_URL . "admin/jurusan/hapus.php?id=" . urlencode($major["id_jurusan"]) ?>" class="btn btn-error">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>

    <?php include __DIR__ . "/../../components/layouts/footer.php" ?>
</body>

</html>