<?php
require_once __DIR__ . "/../../config.php";
?>

<nav>
    <div class="navbar-menu">
        <ul>
            <?php if (isset($_SESSION["role"])): ?>
                <?php if ($_SESSION["role"] == "admin"): ?>
                    <li><a href="<?= BASE_URL . "admin" ?>">Dashboard</a></li>
                    <li><a href="<?= BASE_URL . "admin/akun" ?>">Akun</a></li>
                    <li><a href="<?= BASE_URL . "admin/jurusan" ?>">Jurusan</a></li>
                    <li><a href="<?= BASE_URL . "admin/jenis_dokumen" ?>">Jenis Dokumen</a></li>
                    <li><a href="<?= BASE_URL . "admin/form_pendaftaran" ?>">Form Pendaftaran</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>">Beranda</a></li>
                    <li><a href="<?= BASE_URL . "calon_siswa/form_pendaftaran.php" ?>">Form Pendaftaran</a></li>
                    <li><a href="<?= BASE_URL . "calon_siswa/riwayat_pendaftaran" ?>">Riwayat Pendaftaran</a></li>
                <?php endif ?>
            <?php endif ?>
        </ul>
    </div>

    <div class="branding">
        <h1>
            <?= SCHOOL_NAME ?>
        </h1>
    </div>

    <?php if (!isset($_SESSION["username"])): ?>
        <div class="login-register">
            <a href="<?= BASE_URL . "login.php" ?>" class="btn btn-neutral">
                Login
            </a>

            <a href="<?= BASE_URL . "register.php" ?>" class="btn btn-accent">
                Register
            </a>
        </div>
    <?php else: ?>
        <div class="profile">
            <a href="<?= BASE_URL . "profil.php" ?>" class="btn btn-neutral">
                Buka Profil
            </a>
        </div>
    <?php endif; ?>
</nav>