<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/config.php";

// Memulai session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan konfigurasi head -->
    <?php include_once __DIR__ . "/components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/homepage.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php require_once __DIR__ . "/components/layouts/navbar.php" ?>

    <div class="container">
        <div id="intro-section">
            <div class="left-section">
                <div class="slogan">
                    <span class="text-accent">Unggul</span> dalam Teknologi,<br>
                    <span class="text-accent">Kokoh</span> dalam Iman.
                </div>

                <div class="school-description">
                    <p>
                        <?= SCHOOL_NAME ?> adalah sekolah kejuruan berbasis
                        pesantren modern yang mengintegrasikan kurikulum
                        teknologi terkini dengan pendidikan karakter Islami. Kami
                        berkomitmen melahirkan generasi digital yang kompeten,
                        mandiri, dan berakhlak mulia siap menghadapi tantangan
                        Revolusi Industri 4.0
                    </p>
                </div>

                <div class="buttons-container">
                    <!-- Tombol yang mengarahkan user ke halaman pendaftaran (jika belum login otomatis diarahkan ke login) -->
                    <a href="<?= BASE_URL . "calon_siswa/form_pendaftaran.php" ?>" class="btn btn-primary">
                        Pendaftaran Siswa
                    </a>
                </div>
            </div>

            <div class="right-section">
                <img src="<?= BASE_URL . "assets/images/9358486.jpg" ?>" alt="gambar-siswi-muslim">
            </div>
        </div>

        <hr class="divider">

        <div id="vision-mission">
            <div class="school-vision">
                <h1>Visi</h1>

                <hr class="divider">

                <p>
                    &quot;
                    Menjadi pusat pendidikan vokasi unggulan yang mengintegrasikan
                    teknologi mutakhir dan nilai-nilai kepesantrenan untuk mencetak
                    generasi yang kompeten, berkarakter, Qur'ani, dan berdaya saing
                    global.
                    &quot;
                </p>
            </div>

            <div class="school-mission">
                <h1>Misi</h1>

                <hr class="divider">

                <ul>
                    <li>
                        Mendirikan pendidikan yang berkualitas.
                    </li>

                    <li>
                        Mengembangkan intelektual, spiritual, dan
                        karakter.
                    </li>

                    <li>
                        Menghasilkan peserta didik yang berprestasi dan siap
                        bersaing secara global.
                    </li>

                    <li>
                        Mengintegrasikan kurikulum nasional dengan kurikulum
                        pesantren.
                    </li>

                    <li>
                        Meningkatkan kompetensi siswa melalui praktik berbasis
                        proyek.
                    </li>

                    <li>
                        Menanamkan adab dan kemandirian dalam kehidupan
                        sehari-hari.
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Memasukkan footer -->
    <?php require_once __DIR__ . "/components/layouts/footer.php" ?>
</body>

</html>