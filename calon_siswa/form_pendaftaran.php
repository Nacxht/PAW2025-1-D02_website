<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
require_once __DIR__ . '/../validators/form_pendaftaran_validator.php';
require_once __DIR__ . '/../services/form_pendaftaran_service.php';
require_once __DIR__ . "/../services/jurusan_service.php";
require_once __DIR__ . "/../services/program_service.php";
require_once __DIR__ . "/../services/jenis_dokumen_service.php";
require_once __DIR__ . "/../config.php";

/**
 * Mengambil data-data dari tabel jurusan, program, dan jenis dokumen
 * untuk keperluan pemilihan input (select).
 */
$daftarJurusan = daftarJurusanService();
$daftarProgram = daftarProgramService();
$daftarJenisDokumen = daftarJenisDokumenService();

// Menangani proses pengiriman form pendaftaran
if (isset($_POST['submit-form-pendaftaran'])) {
    // htmlspecialchars untuk menghindari serangan XSS
    $namaLengkap = htmlspecialchars($_POST["nama-lengkap"]);
    $nik = htmlspecialchars($_POST["nik"]);
    $jenisKelamin = htmlspecialchars($_POST["jenis-kelamin"]);
    $tempatLahir = htmlspecialchars($_POST["tempat-lahir"]);
    $tanggalLahir = htmlspecialchars($_POST["tanggal-lahir"]);
    $asalSekolah = htmlspecialchars($_POST["asal-sekolah"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);
    $program = htmlspecialchars($_POST["program"]);
    $persetujuanAsrama = htmlspecialchars($_POST["persetujuan-asrama"]);
    $persetujuanHp = htmlspecialchars($_POST["persetujuan-hp"]);

    // Array untuk menyimpan file-file yang diupload
    $files = [];

    // Array untuk menyimpan pesan-pesan-pesan error
    $errors = [];

    /**
     * Foreach loop untuk menangani iform upload yang jumlahnya dinamis.
     * Dikatakan jumlahnya dinamis dikarenakan jumlah form mengikuti jumlah
     * jenis dokumen yang ada.
     */
    foreach ($daftarJenisDokumen as $jenisDokumen) {
        // Membuat kata kunci menyamai seperti yang terdapat pada form HTML
        $kataKunci = strtolower(str_replace(" ", "-", $jenisDokumen["jenis_dokumen"]));

        // Variabel untuk menangkap file yang diupload
        $file = $_FILES[$kataKunci] ?? null;

        /**
         * Memasukkan data-data mengenai file ke dalam array
         * 
         * - "ukuran-maks" -> ukuran maksimal dari file yang diupload
         * - "id-jenis-dokumen" -> ID jenis dokumen dari file yang diupload
         * - "file" -> array asosiatif yang ditangkap menggunakan $_FILES
         */
        $files[$kataKunci] = [
            "ukuran-maks" => 1048576,
            "id-jenis-dokumen" => $jenisDokumen["id_jenis_dokumen"],
            "file" => $file
        ];

        // Memvalidasi file yang diupload
        validateFileUpload(
            $files[$kataKunci]["file"],
            $kataKunci,
            $files[$kataKunci]["ukuran-maks"],
            "jpg",
            $errors
        );
    }

    // Proses validasi untuk input selain file
    validateNamaLengkap($namaLengkap, $errors);
    validateNik($nik, $errors);
    validateJenisKelamin($jenisKelamin, $errors);
    validateTempatLahir($tempatLahir, $errors);
    validateTanggalLahir($tanggalLahir, $errors);
    validateAsalSekolah($asalSekolah, $errors);
    validateJurusan($jurusan, $errors);
    validateProgram($program, $errors);
    validatePersetujuanAsrama($persetujuanAsrama, $errors);
    validatePersetujuanHp($persetujuanHp, $errors);

    // Jika tidak ada error, maka lakukan proses submission form pendaftaran
    if (!$errors) {
        tambahFormPendaftaranService(
            $_SESSION["id_user"],
            $jurusan,
            $program,
            $namaLengkap,
            $nik,
            $jenisKelamin,
            $tempatLahir,
            $tanggalLahir,
            $asalSekolah,
            $persetujuanAsrama,
            $persetujuanHp,
            $files
        );
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Memasukkan konfigurasi head -->
    <?php include_once __DIR__ . "/../components/layouts/meta_title.php" ?>

    <!-- Memasukkan CSS yang diperlukan -->
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/calon_siswa.css" ?>">
</head>

<body>
    <!-- Memasukkan navbar -->
    <?php include_once __DIR__ . "/../components/layouts/navbar.php" ?>

    <div class="container" id="calon-siswa-form-pendaftaran">
        <h1>
            Form Pendaftaran
        </h1>

        <hr class="divider">

        <!-- Form yang berisi input-input untuk formulir pendaftaran -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input-container nama-lengkap">
                <label for="nama-lengkap">Nama Lengkap</label>
                <input type="text" name="nama-lengkap" id="nama-lengkap" value="<?= $namaLengkap ?? "" ?>">

                <!-- Menampilkan error -->
                <?php if (isset($errors["nama-lengkap"])): ?>
                    <ul>
                        <?php foreach ($errors["nama-lengkap"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container nik">
                <label for="nik">NIK</label>
                <input type="text" name="nik" id="nik" value="<?= $nik ?? "" ?>">

                <!-- Menampilkan error -->
                <?php if (isset($errors["nik"])): ?>
                    <ul>
                        <?php foreach ($errors["nik"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container">
                <label for="jenis-kelamin">Jenis Kelamin</label>

                <select name="jenis-kelamin" id="jenis-kelamin">
                    <option value="">-- Pilih Jenis Kelamin --</option>

                    <!-- Variabel untuk menangani jika variabel input jenis kelamin masih kosong -->
                    <?php $jenisKelamin = $jenisKelamin ?? "" ?>

                    <!-- Option akan otomatis dipilih sesuai input yang terakhir dimasukkan -->
                    <option value="l" <?= $jenisKelamin == "l" ? "selected" : "" ?>>Laki-Laki</option>
                    <option value="p" <?= $jenisKelamin == "p" ? "selected" : "" ?>>Perempuan</option>
                </select>

                <!-- Menampilkan error -->
                <?php if (isset($errors["jenis-kelamin"])): ?>
                    <ul>
                        <?php foreach ($errors["jenis-kelamin"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container tempat-lahir">
                <label for="tempat-lahir">Tempat Lahir</label>
                <input type="text" name="tempat-lahir" id="tempat-lahir" value="<?= $tempatLahir ?? "" ?>">

                <!-- Menampilkan error -->
                <?php if (isset($errors["tempat-lahir"])): ?>
                    <ul>
                        <?php foreach ($errors["tempat-lahir"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container tanggal-lahir">
                <label for="tanggal-lahir">Tanggal Lahir</label>
                <input type="date" name="tanggal-lahir" id="tanggal-lahir" value="<?= $tanggalLahir ?? "" ?>">

                <!-- Menampilkan error -->
                <?php if (isset($errors["tanggal-lahir"])): ?>
                    <ul>
                        <?php foreach ($errors["tanggal-lahir"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container asal-sekolah">
                <label for="asal-sekolah">Asal Sekolah</label>
                <input type="text" name="asal-sekolah" id="asal-sekolah" value="<?= $asalSekolah ?? "" ?>">

                <!-- Menampilkan error -->
                <?php if (isset($errors["asal-sekolah"])): ?>
                    <ul>
                        <?php foreach ($errors["asal-sekolah"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container jurusan">
                <label for="jurusan">Jurusan</label>

                <select name="jurusan" id="jurusan">
                    <option value="">-- Pilih Jurusan --</option>

                    <!-- Variabel untuk menangani jika variabel input jurusan masih kosong -->
                    <?php $jurusan = $jurusan ?? "" ?>

                    <!-- Meng-iterasi opsi berdasarkan data yang terdapat pada tabel jurusan -->
                    <?php foreach ($daftarJurusan as $dataJurusan): ?>
                        <option value="<?= $dataJurusan["id_jurusan"] ?>" <?= $jurusan == $dataJurusan["id_jurusan"] ? "selected" : "" ?>>
                            <?= $dataJurusan["nama_jurusan"] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <!-- Menampilkan error -->
                <?php if (isset($errors["jurusan"])): ?>
                    <ul>
                        <?php foreach ($errors["jurusan"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container program">
                <label for="program">Program</label>

                <select name="program" id="program">
                    <option value="">-- Pilih Program --</option>

                    <!-- Variabel untuk menangani jika variabel input program masih kosong -->
                    <?php $program = $program ?? "" ?>

                    <!-- Meng-iterasi opsi berdasarkan dat ayang terdapat pada tabel program -->
                    <?php foreach ($daftarProgram as $dataProgram): ?>
                        <option value="<?= $dataProgram["id_program"] ?>" <?= $program == $dataProgram["id_program"] ? "selected" : "" ?>>
                            <?= $dataProgram["nama_program"] ?>
                        </option>
                    <?php endforeach ?>
                </select>

                <!-- Menampilkan error -->
                <?php if (isset($errors["program"])): ?>
                    <ul>
                        <?php foreach ($errors["program"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <hr class="divider">

            <!-- Meng-iterasi form input file sesuai dengan jumlah jenis dokumen -->
            <?php foreach ($daftarJenisDokumen as $jenisDokumen): ?>
                <!-- Mengkonversi nilai menjadi konvensi penulisan kebab-case -->
                <?php $konvKebabCase = strtolower(str_replace(" ", "-", $jenisDokumen["jenis_dokumen"])) ?>

                <div class="input-container <?= $konvKebabCase ?>">
                    <label for="<?= $konvKebabCase ?>"><?= $jenisDokumen["jenis_dokumen"] ?></label>
                    <input type="file" name="<?= $konvKebabCase ?>" id="<?= $konvKebabCase ?>">

                    <!-- Menampilkan error -->
                    <?php if (isset($errors[$konvKebabCase])): ?>
                        <ul>
                            <?php foreach ($errors[$konvKebabCase] as $error): ?>
                                <li class="error-message">
                                    <?= $error ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                </div>
            <?php endforeach ?>

            <hr class="divider">

            <div class="input-container persetujuan-asrama">
                <label for="persetujuan-asrama">Persetujuan Asrama</label>

                <select name="persetujuan-asrama" id="persetujuan-asrama">
                    <option value="false">Tidak Setuju</option>

                    <!-- Variabel untuk menangani jika variabel input persetujuan asrama masih kosong -->
                    <?php $persetujuanAsrama = $persetujuanAsrama ?? "" ?>
                    <option value="true" <?= $persetujuanAsrama == "true" ? "selected" : "" ?>>Setuju</option>
                </select>

                <!-- Menampilkan error -->
                <?php if (isset($errors["persetujuan-asrama"])): ?>
                    <ul>
                        <?php foreach ($errors["persetujuan-asrama"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <div class="input-container persetujuan-hp">
                <label for="persetujuan-hp">Persetujuan Tidak Membawa HP</label>

                <select name="persetujuan-hp" id="persetujuan-hp">
                    <option value="false">Tidak Setuju</option>

                    <!-- Variabel untuk menangani jika variabel input persetujuan tidak membawa HP masih kosong -->
                    <?php $persetujuanHp = $persetujuanHp ?? "" ?>
                    <option value="true" <?= $persetujuanHp == "true" ? "selected" : "" ?>>Setuju</option>
                </select>

                <!-- Menampilkan error -->
                <?php if (isset($errors["persetujuan-hp"])): ?>
                    <ul>
                        <?php foreach ($errors["persetujuan-hp"] as $error): ?>
                            <li class="error-message">
                                <?= $error ?>
                            </li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </div>

            <hr class="divider">

            <button type="submit" class="btn btn-success" name="submit-form-pendaftaran">
                Daftar
            </button>
        </form>
    </div>

    <!-- Memasukkan footer -->
    <?php include_once __DIR__ . "/../components/layouts/footer.php" ?>
</body>

</html>