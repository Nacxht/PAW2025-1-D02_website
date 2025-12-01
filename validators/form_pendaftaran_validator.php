<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/base_validator.php";
require_once __DIR__ . "/../utils/ukuran_file_konverter.php";

/**
 * Fungsi untuk memvalidasi nama lengkap dari pendaftar
 * 
 * Validasi ini tidak menetapkan panjang minimal dari nama lengkap,
 * tetapi validator ini menetapkan panjang maksimal dari nama lengkap
 * adalah 50 karakter
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateNamaLengkap(string $field, array &$errors)
{
    // Jika nilainya kosong
    if (cekFieldKosong($field)) {
        $errors["nama-lengkap"][] = "Nama lengkap tidak boleh kosong";
    }

    // Jika bukan alphabet
    if (!cekAlpha($field)) {
        $errors["nama-lengkap"][] = "Nama lengkap harus berisi alphabet (A-Z/a-z)";
    }

    // Jika panjang melebihi 50 karakter
    if (strlen($field) > 50) {
        $errors["nama-lengkap"][] = "Panjang maksimal dari nama lengkap adalah 50 karakter";
    }
}

/**
 * Fungsi untuk memvalidasi NIK dari pendaftar
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateNik(string $field, array &$errors)
{
    // Jika nilai kosong
    if (cekFieldKosong($field)) {
        $errors["nik"][] = "NIK tidak boleh kosong";
    }

    // Jika bukan numerik
    if (!cekNumeric($field)) {
        $errors["nik"][] = "NIK hanya boleh bernilai numerik";
    }

    // Jika panjang tidak sama persis 16 digit
    if (strlen($field) != 16) {
        $errors['nik'][] = "Panjang NIK harus sebanyak 16 digit";
    }
}

/**
 * Fungsi untuk memvalidasi Jenis kelamin dari pendaftar
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateJenisKelamin(string $field, array &$errors)
{
    // Mengkonversi semua nilai ke huruf kecil
    $field = strtolower($field);

    // Jika nilai kosong
    if (cekFieldKosong($field)) {
        $errors["jenis-kelamin"][] = "Jenis kelamin tidak boleh kosong";
    }

    // Jika nilai selain "l" atau "p"
    if (!in_array($field, ["l", 'p'])) {
        $errors["jenis-kelamin"][] = "Jenis kelamin tidak valid";
    }
}

/**
 * Fungsi untuk memvalidasi tempat lahir pendaftar
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateTempatLahir(string $field, array &$errors)
{
    // Jika field kosong
    if (cekFieldKosong($field)) {
        $errors["tempat-lahir"][] = "Tempat lahir Tidak Boleh Kosong";
    }

    // Jika bukan alphabet
    if (!cekAlpha($field)) {
        $errors["tempat-lahir"][] = "Tempat lahir harus berisi alphabet (A-Z/a-z)";
    }

    // Jika panjang dibawah 3 karakter
    if (strlen($field) < 3) {
        $errors["tempat-lahir"][] = "Panjang minimal dari tempat lahir adalah 3 karakter";
    }

    // Jika panjang melebihi 20 karakter
    if (strlen($field) > 20) {
        $errors["tempat-lahir"][] = "Panjang maksimal dari tempat lahir adalah 20 karakter";
    }
}

/**
 * Fungsi untuk memvalidasi tanggal lahir pendaftar
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateTanggalLahir(string $field, array &$errors)
{
    // Mendapatkan waktu saat ini & tahun saat ini
    $waktuSaatIni = new DateTime();
    $tahunSaatIni = (int) $waktuSaatIni->format("Y");

    // Batas minimal & maksimal tahun lahir dari pendaftar
    $batasTahunMinimal = $tahunSaatIni - 21;
    $batasTahunMaksimal = $tahunSaatIni - 15;

    // Jika field kosong
    if (cekFieldKosong($field)) {
        $errors["tanggal-lahir"][] = "Tanggal lahir tidak boleh kosong";
    }

    try {
        // mengubah hasil field date ke objek DateTime
        $field = new DateTime($field);
        $tahunLahir = (int) $field->format("Y");
    } catch (Exception $error) {
        $errors["tanggal-lahir"][] = "Tanggal lahir tidak valid";
        return;
    }

    // Jika input tahun lahir lebih besar batas maksimal
    if ($tahunLahir > $batasTahunMaksimal) {
        $errors["tanggal-lahir"][] = "Usia anda terlalu muda untuk mendaftar";
    }

    // Jika input tahun lahir lebih kecil dari batas minimal
    if ($tahunLahir < $batasTahunMinimal) {
        $errors["tanggal-lahir"][] = "Usia anda terlalu tua untuk mendaftar";
    }

    // Jika tahun lahir melebihi dari tahun saat ini (masa depan)
    if ($tahunLahir > $tahunSaatIni) {
        $errors["tanggal-lahir"][] = "Tahun yang anda masukkan lebih besar dari tahun saat ini";
    }
}

/**
 * Fungsi untuk memvalidasi asal sekolah pendaftar
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateAsalSekolah(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["asal_sekolah"][] = "Asal sekolah tidak boleh kosong";
    }

    // Jika bukan alphabet
    if (!cekAlpha($field)) {
        $errors["asal-sekolah"][] = "Asal sekolah harus berisi karakter alphabet (A-Z/a-z)";
    }

    // Jika panjang dibawah 3 karakter
    if (strlen($field) < 3) {
        $errors["asal-sekolah"][] = "Panjang minimal dari asal sekolah adalah 3 karakter";
    }

    // Jika panjang diatas 50 karakter
    if (strlen($field) > 50) {
        $errors["asal-sekolah"][] = "Panjang maksimal dari asal sekolah adalah 50 karakter";
    }
}

/**
 * Fungsi untuk memvalidasi pilihan jurusan yang terdapat pada form pendaftaran
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error
 */
function validateJurusan(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["jurusan"][] = "Jurusan tidak boleh kosong";
    }
}

/**
 * Fungsi untuk memvalidasi pilihan program yang terdapat pada form pendaftaran
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error
 */
function validateProgram(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["program"][] = "Program tidak boleh kosong";
    }
}

/**
 * Fungsi untuk memvalidasi file yang diupload
 * 
 * @param mixed $field - Data yang akan divalidasi
 * @param string $namaField - Nama dari field yang divalidasi
 * @param int $ukuranMaks - Ukuran maksimal dari file yang diupload
 * @param string $ekstensiValidasi - Ekstensi file yang benar (digunakan untuk validasi)
 * @param array &$errors - Array yang menyimpan pesan-pesan error
 */
function validateFileUpload(mixed $field, string $namaField, int $ukuranMaks, string $ekstensiValidasi, array &$errors)
{
    // Ekstensi file yang diupload
    $ekstensiFile = pathinfo($field["name"], PATHINFO_EXTENSION);

    // Jika file yang diupload kosong
    if ($field["name"] == "") {
        $errors[$namaField][] = "Tidak boleh kosong, upload file sesuai yang diminta";
    }

    // Jika ukuran file melebihi batas maksimal
    if ($field["size"] > $ukuranMaks) {
        $ukuranMb = bitKeMegabit($ukuranMaks);
        $errors[$namaField][] = "Maksimal ukuran file adalah $ukuranMb Mb";
    }

    // Jika ekstensi file tidak valid
    if ($ekstensiFile != $ekstensiValidasi) {
        $errors[$namaField][] = "Ekstensi file hanya boleh berupa .$ekstensiValidasi";
    }
}

/**
 * Fungsi untuk memvalidasi pilihan persetujuan asrama
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error
 */
function validatePersetujuanAsrama(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["persetujuan-asrama"][] = "Anda wajib menyetujui ketentuan kami";
    }

    // Jika calon siswa tidak menyetujui
    if ($field != "true") {
        $errors["persetujuan-asrama"][] = "Anda wajib menyetujui ketentuan kami";
    }
}

/**
 * Fungsi untuk memvalidasi pilihan persetujuan tidak membawa Handphone
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error
 */
function validatePersetujuanHp(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["persetujuan-hp"][] = "Anda wajib menyetujui ketentuan kami";
    }

    // Jika calon siswa tidak menyetujui
    if ($field != "true") {
        $errors["persetujuan-hp"][] = "Anda wajib menyetujui ketentuan kami";
    }
}
