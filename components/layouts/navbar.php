<?php
require_once __DIR__ . "/../../config.php";
?>

<nav>
    <div class="navbar-menu">
        <ul>
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Program</a></li>
            <li><a href="#">Jurusan</a></li>
            <li><a href="#">Galeri</a></li>
            <li><a href="#">Pendaftaran</a></li>
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