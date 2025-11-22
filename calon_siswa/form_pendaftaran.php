<?php
require_once __DIR__ . "/../auth_middleware/after_login_middleware.php";
require_once __DIR__ . '/../validators/form_pendaftaran_validator.php';
require_once __DIR__ . '/../services/form_pendaftaran.php';

if (isset($_POST['submit'])) {

    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $asal_sekolah = $_POST['asal_sekolah'];
    $jurusan = $_POST['jurusan'];

    $akta_kelahiran = $_FILES['akta_kelahiran'] ?? null;
    $kartu_keluarga = $_FILES['kartu_keluarga'] ?? null;
    $rapor = $_FILES['rapor'] ?? null;
    $surat_keterangan_lulus = $_FILES['surat_keterangan_lulus'] ?? null;
    $surat_kesehatan = $_FILES['surat_kesehatan'] ?? null;
    $pasfoto = $_FILES['pasfoto'] ?? null;

    $persetujuan_asrama = isset($_POST['persetujuan_asrama']) ? 1 : 0;
    $persetujuan_tidak_membawa_hp = isset($_POST['persetujuan_tidak_membawa_hp']) ? 1 : 0;

    $errors = [];

    validateNamaLengkap($nama_lengkap, $errors);
    validateNik($nik, $errors);
    validateJenisKelamin($jenis_kelamin, $errors);
    validateTempatLahir($tempat_lahir, $errors);
    validateTanggalLahir($tanggal_lahir, $errors);
    validateAsalSekolah($asal_sekolah, $errors);
    validateJurusan($jurusan, $errors);
    validateAktaKelahiran($akta_kelahiran, $errors);
    validateKartuKeluarga($kartu_keluarga, $errors);
    validateRapor($rapor, $errors);
    validateSuratKeteranganLulus($surat_keterangan_lulus, $errors);
    validateSuratKesehatan($surat_kesehatan, $errors);
    validatePasfoto($pasfoto, $errors);
    validatePersetujuanAsrama($persetujuan_asrama, $errors);
    validatePersetujuanTidakMembawaHp($persetujuan_tidak_membawa_hp, $errors);

    if (empty($errors)) {
        formPendaftaran($nama_lengkap, $nik, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $asal_sekolah,$jurusan, $akta_kelahiran, $kartu_keluarga, $rapor, $surat_keterangan_lulus, $surat_kesehatan, $pasfoto, $persetujuan_tidak_membawa_hp, $persetujuan_asrama);
    }
}

?>
<form method="POST" enctype="multipart/form-data">
    <div class="input-container"><label id="nama_lengkap">Nama lengkap : </label><input type="text" name="nama_lengkap" value="<?= $nama_lengkap ?? '' ?>"><?php if (isset($errors["nama_lengkap"])): ?>
            <ul>
                <?php foreach ($errors["nama_lengkap"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="nik">nik : </label><input type="text" name="nik" value="<?= $nik ?? '' ?>"><?php if (isset($errors["nik"])): ?>
            <ul>
                <?php foreach ($errors["nik"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="jenis_kelamin">jenis_kelamin : </label><select name="jenis_kelamin">
            <option value="">- Jenis Kelamin -</option>
            <option value="l" <?= (isset($jenis_kelamin) && $jenis_kelamin == 'l') ? 'selected' : '' ?>>Laki-Laki</option>
            <option value="p" <?= (isset($jenis_kelamin) && $jenis_kelamin == 'p') ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <?php if (isset($errors["jenis_kelamin"])): ?>
            <ul>
                <?php foreach ($errors["jenis_kelamin"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="tempat_lahir">tempat_lahir : </label><input type="text" name="tempat_lahir" value="<?= $tempat_lahir ?? '' ?>"><?php if (isset($errors["tempat_lahir"])): ?>
            <ul>
                <?php foreach ($errors["tempat_lahir"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="tanggal_lahir">tanggal_lahir : </label><input type="date" name="tanggal_lahir" value="<?= $tanggal_lahir ?>"><?php if (isset($errors["tanggal_lahir"])): ?>
            <ul>
                <?php foreach ($errors["tanggal_lahir"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="asal_sekolah">asal_sekolah : </label><input type="text" name="asal_sekolah" value="<?= $asal_sekolah ?? '' ?>"><?php if (isset($errors["asal_sekolah"])): ?>
            <ul>
                <?php foreach ($errors["asal_sekolah"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="jurusan">Jurusan : </label>
        <select name="jurusan">
            <option value="">- Jurusan -</option>
            <option value="Teknik Mesin" <?= (isset($jurusan) && $jurusan == 'Teknik Mesin') ? 'selected' : '' ?>>Teknik Mesin</option>
        </select>
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
    </div>
    <div class="input-container"><label id="akta_kelahiran">akta_kelahiran : </label><input type="file" name="akta_kelahiran" value="<?= $akta_kelahiran ?? '' ?>"><?php if (isset($errors["akta_kelahiran"])): ?>
            <ul>
                <?php foreach ($errors["akta_kelahiran"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="kartu_keluarga">kartu_keluarga : </label><input type="file" name="kartu_keluarga" value="<?= $kartu_keluarga ?? '' ?>"><?php if (isset($errors["kartu_keluarga"])): ?>
            <ul>
                <?php foreach ($errors["kartu_keluarga"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="rapor">rapor : </label><input type="file" name="rapor" value="<?= $rapor ?? '' ?>"><?php if (isset($errors["rapor"])): ?>
            <ul>
                <?php foreach ($errors["rapor"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="surat_keterangan_lulus">surat_keterangan_lulus : </label><input type="file" name="surat_keterangan_lulus" value="<?= $surat_keterangan_lulus ?? '' ?> "><?php if (isset($errors["surat_keterangan_lulus"])): ?>
            <ul>
                <?php foreach ($errors["surat_keterangan_lulus"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="surat_kesehatan">surat_kesehatan : </label><input type="file" name="surat_kesehatan" value="<?= $surat_kesehatan ?? '' ?>"><?php if (isset($errors["surat_kesehatan"])): ?>
            <ul>
                <?php foreach ($errors["surat_kesehatan"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="pasfoto">pasfoto : </label><input type="file" name="pasfoto" value="<?= $pasfoto ?? '' ?>"><?php if (isset($errors["pasfoto"])): ?>
            <ul>
                <?php foreach ($errors["pasfoto"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="persetujuan_asrama">persetujuan_asrama : </label><input type="checkbox" name="persetujuan_asrama" value="1" value="1"
            <?= (!empty($persetujuan_asrama)) ? 'checked' : '' ?>><?php if (isset($errors["persetujuan_asrama"])): ?>
            <ul>
                <?php foreach ($errors["persetujuan_asrama"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><label id="persetujuan_tidak_membawa_hp">persetujuan_tidak_membawa_hp : </label><input type="checkbox" name="persetujuan_tidak_membawa_hp" value="1"
            <?= (!empty($persetujuan_tidak_membawa_hp)) ? 'checked' : '' ?>><?php if (isset($errors["persetujuan_tidak_membawa_hp"])): ?>
            <ul>
                <?php foreach ($errors["persetujuan_tidak_membawa_hp"] as $error): ?>
                    <li class="error-message">
                        <?= $error ?>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </div>
    </div>
    <div class="input-container"><button type="submit" name="submit">Daftar</button></div>
</form>