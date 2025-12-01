<?php
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

/**
 * Fungsi untuk memvalidasi username dari pengguna.
 * 
 * Fungsi ini juga melihat ke dalam database untuk mengecek apakah username
 * telah digunakan/terdaftar atau belum.
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateUsername(string $field, array &$errors)
{
    // Regex untuk username
    $regex = "/^[A-Za-z1-9_]+$/";

    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }

    // Jika tidak sesuai dengan regex
    if (!preg_match($regex, $field)) {
        $errors["username"][] = "Username hanya boleh mengandung huruf, angka (0-9), dan karakter garis bawah (_)";
    }

    // Jika panjang dibawah 3 karakter
    if (strlen($field) < 3) {
        $errors["username"][] = "Panjang minimal username adalah 3 (tiga) karakter";
    }

    // Jika panjang melebihi 20 karakter
    if (strlen($field) > 20) {
        $errors["username"][] = "Panjang maksimal username adalah 20 (dua puluh) karakter";
    }

    // Mengecek apakah terdapat duplikasi username di database
    $stmt = DBH->prepare(
        "SELECT
            a.jumlah_admin + cs.jumlah_calon_siswa jumlah_username
        FROM
        (
            SELECT
                count(username) jumlah_admin
            FROM
                admin
            WHERE
                username = :username
        ) a
        JOIN
        (
            SELECT
                count(username) jumlah_calon_siswa
            FROM
                calon_siswa
            WHERE
                username = :username
        ) cs"
    );

    // Eksekusi query
    $stmt->execute([":username" => $field]);
    $jumlahUsername = $stmt->fetch()["jumlah_username"];

    // Jika lebih dari 0 (sudah ada)
    if ($jumlahUsername) {
        $errors["username"][] = "Username yang anda masukkan telah terdaftar";
    }
}


/**
 * Fungsi untuk memvalidasi email dari pengguna.
 * 
 * Fungsi ini juga melihat ke dalam database untuk mengecek apakah
 * email sudah terdaftar atau belum.
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateEmail(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["email"][] = "Email tidak boleh kosong";
    }

    // Validasi email bawaan PHP
    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $errors["email"][] = "Email yang dimasukkan tidak valid";
    }

    // mengecek apakah terdapat duplikasi email di database
    // Mengecek apakah terdapat duplikasi username di database
    $stmt = DBH->prepare(
        "SELECT
            a.jumlah_admin + cs.jumlah_calon_siswa jumlah_email
        FROM
        (
            SELECT
                count(email) jumlah_admin
            FROM
                admin
            WHERE
                email = :email
        ) a
        JOIN
        (
            SELECT
                count(email) jumlah_calon_siswa
            FROM
                calon_siswa
            WHERE
                email = :email
        ) cs"
    );

    // Eksekusi query
    $stmt->execute([":email" => $field]);
    $emailCount = $stmt->fetch()["jumlah_email"];

    // Jika lebih dari 0 (sudah ada)
    if ($emailCount) {
        $errors["email"][] = "Email yang anda masukkan telah terdaftar";
    }
}

/**
 * Fungsi untuk memvalidasi password dari pengguna.
 * 
 * Agar diterima oleh sistem, validasi ini memiliki beberapa kriteria:
 * - Tidak boleh kosong
 * - Panjang minimal adalah 8 karakter
 * - Mengandung huruf besar (setidaknya satu karakter)
 * - Mengandung huruf kecil (setidaknya satu karakter)
 * - Mengandung angka (setidaknya satu karakter)
 * - Mengandung karakter spesial ['_', '\', '-', '@', ' '] (setidaknya satu karakter)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validatePassword(string $field, array &$errors)
{
    $reUpperLetter = "/[A-Z]+/";        // Regex - mengandung setidaknya 1 huruf besar
    $reLowerLetter = "/[a-z]+/";        // Regex - mengandung setidaknya 1 huruf kecil
    $reNumberChar = "/[0-9]+/";         // Regex - mengandung setidaknya 1 angka
    $reSpecialChar = "/[_\-@ ]+/";      // Regex - mengandung setidaknya 1 karakter spesial ("_", "\", "-", "@", " ")

    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }

    // Panjang dibawah 8 karakter
    if (strlen($field) < 8) {
        $errors["password"][] = "Panjang minimal password adalah 8 karakter";
    }

    // Jika tidak mengandung huruf besar
    if (!preg_match_all($reUpperLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kapital (A-Z)";
    }

    // Jika tidak mengandung huruf kecil
    if (!preg_match_all($reLowerLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kecil (a-z)";
    }

    // Jika tidak mengandung angka
    if (!preg_match_all($reNumberChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) karakter angka (0-9)";
    }

    // Jika tidak mengandung karakter spesial
    if (!preg_match_all($reSpecialChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya salah satu karakter ini: ('_', '-', '@', ' ')";
    }
}


/**
 * Fungsi untuk memvalidasi field konfirmasi password
 * 
 * @param string $field - Data yang akan divalidasi
 * @param string $password - Nilai dari field password
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateKonfirmasiPassword(string $field, string $password, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["konfirmasi-password"][] = "Konfirmasi password tidak boleh kosong";
    }

    // Jika input konfirmasi tidak sama dengan password
    if ($field != $password) {
        $errors["konfirmasi-password"][] = "Password konfirmasi tidak sama dengan password utama";
    }
}


/**
 * Fungsi untuk memvalidasi role pengguna
 * Pengguna disini hanya memiliki 2 tipe role, yaitu 'admin', dan 'calon_siswa'
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateRole(string $field, &$errors)
{
    // Array yang menyimpan role valid
    $roleValue = ["admin", "calon_siswa"];

    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["role"][] = "Role tidak boleh kosong";
    }

    // Jika role tidak valid (tidak terdapat dalam role)
    if (!in_array($field, $roleValue)) {
        $errors["role"][] = "Role yang anda masukkan tidaklah valid!";
    }
}

/**
 * Fungsi untuk memvalidasi username (digunakan di halaman login)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateLoginUsername(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }
}

/**
 * Fungsi untuk memvalidasi password (digunakan di halaman login)
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateLoginPassword(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }
}
