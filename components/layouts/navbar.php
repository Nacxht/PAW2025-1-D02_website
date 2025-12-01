<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../../config.php";
?>

<!-- Navbar yang ditampilkan di keseluruhan halaman web -->
<nav>
    <div class="navbar-menu">
        <ul>
            <!-- Menentukan menu apa yang akan ditampilkan (ini berdasarkan role user nya) -->
            <?php if (isset($_SESSION["role"])): ?>
                <?php if ($_SESSION["role"] == "admin"): ?>
                    <li><a href="<?= BASE_URL . "admin" ?>">Dashboard</a></li>
                    <li><a href="<?= BASE_URL . "admin/akun" ?>">Akun</a></li>
                    <li><a href="<?= BASE_URL . "admin/jurusan" ?>">Jurusan</a></li>
                    <li><a href="<?= BASE_URL . "admin/program" ?>">Program</a></li>
                    <li><a href="<?= BASE_URL . "admin/jenis_dokumen" ?>">Jenis Dokumen</a></li>
                    <li><a href="<?= BASE_URL . "admin/form_pendaftaran" ?>">Form Pendaftaran</a></li>
                <?php else: ?>
                    <li><a href="<?= BASE_URL ?>">Beranda</a></li>
                    <li><a href="<?= BASE_URL . "calon_siswa/form_pendaftaran.php" ?>">Form Pendaftaran</a></li>
                    <li><a href="<?= BASE_URL . "calon_siswa/riwayat_pendaftaran.php" ?>">Riwayat Pendaftaran</a></li>
                <?php endif ?>
            <?php endif ?>
        </ul>
    </div>

    <!-- Menampilkan nama sekolah -->
    <div class="branding">
        <h1>
            <?= SCHOOL_NAME ?>
        </h1>
    </div>

    <!--
        Menentukan tombol apa yang ditampilkan di bagian navbar.

        - Jika user belum melakukan proses login, maka akan ditampilkan tombol "login" & "register"
        - Jika user sudah melakukan proses login, maka akan ditampilkan tombol "buka akun" untuk mengakses profil
    -->
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