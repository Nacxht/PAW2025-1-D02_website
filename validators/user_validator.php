<?php
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

// validator untuk username (digunakan saat proses create/update)
function validateUsername(string $field, array &$errors)
{
    $regex = "/^[A-Za-z1-9_]+$/";

    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }

    if (!preg_match($regex, $field)) {
        $errors["username"][] = "Username hanya boleh mengandung huruf, angka (0-9), dan karakter garis bawah (_)";
    }

    if (strlen($field) < 3) {
        $errors["username"][] = "Panjang minimal username adalah 3 (tiga) karakter";
    }

    if (strlen($field) > 20) {
        $errors["username"][] = "Panjang maksimal username adalah 20 (dua puluh) karakter";
    }

    // mengecek apakah terdapat duplikasi username di database
    $stmt = DBH->prepare(
        "SELECT username FROM admin WHERE username=:username"
    );

    $stmt->execute([":username" => $field]);
    $usernameCount = $stmt->rowCount();

    $stmt = DBH->prepare(
        "SELECT username FROM calon_siswa WHERE username=:username"
    );

    $stmt->execute([":username" => $field]);
    $usernameCount += $stmt->rowCount();

    if ($usernameCount) {
        $errors["username"][] = "Username yang anda masukkan telah terdaftar";
    }
}


// validator untuk email (digunakan saat proses create/update)
function validateEmail(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["email"][] = "Email tidak boleh kosong";
    }

    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $errors["email"][] = "Email yang dimasukkan tidak valid";
    }

    // mengecek apakah terdapat duplikasi email di database
    $stmt = DBH->prepare(
        "SELECT email FROM admin WHERE email=:email"
    );

    $stmt->execute([":email" => $field]);
    $emailCount = $stmt->rowCount();

    $stmt = DBH->prepare(
        "SELECT email FROM calon_siswa WHERE email=:email"
    );

    $stmt->execute([":email" => $field]);
    $emailCount += $stmt->rowCount();

    if ($emailCount) {
        $errors["email"][] = "Email yang anda masukkan telah terdaftar";
    }
}

// validator password (digunakan untuk proses bisnis create/update)
function validatePassword(string $field, array &$errors)
{
    $reUpperLetter = "/[A-Z]+/";
    $reLowerLetter = "/[a-z]+/";
    $reNumberChar = "/[0-9]+/";
    $reSpecialChar = "/[_\-@ ]+/";

    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }

    if (strlen($field) < 8) {
        $errors["password"][] = "Panjang minimal password adalah 8 karakter";
    }

    if (!preg_match_all($reUpperLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kapital (A-Z)";
    }

    if (!preg_match_all($reLowerLetter, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) huruf kecil (a-z)";
    }

    if (!preg_match_all($reNumberChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya 1 (satu) karakter angka (0-9)";
    }

    if (!preg_match_all($reSpecialChar, $field)) {
        $errors["password"][] = "Password wajib mengandung setidaknya salah satu karakter ini: ('_', '-', '@', ' ')";
    }
}


// validator konfirmasi password (digunakan ketika registrasi akun)
function validateKonfirmasiPassword(string $field, string $password, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["konfirmasi_password"][] = "Konfirmasi password tidak boleh kosong";
    }

    if ($field != $password) {
        $errors["konfirmasi_password"][] = "Password konfirmasi tidak sama dengan password utama";
    }
}

function validateRole(string $field, &$errors)
{
    $roleValue = ["admin", "calon_siswa"];

    if (cekFieldKosong($field)) {
        $errors["role"][] = "Role tidak boleh kosong";
    }
}

// validator username untuk login
function validateLoginUsername(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }
}

// validator password untuk login
function validateLoginPassword(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password tidak boleh kosong";
    }
}
