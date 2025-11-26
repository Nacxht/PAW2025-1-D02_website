<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

function validateJurusanName(string $field, array &$errors)
{
    $regex = "/^[A-Za-z]+$/";

    if (cekFieldKosong($field)) {
        $errors["nama-jurusan"][] = "Nama jurusan tidak boleh kosong";
    }

    if (strlen($field) < 3) {
        $errors["nama-jurusan"][] = "Panjang minimal dari nama jurusan adalah 3 karakter";
    }

    if (strlen($field) > 50) {
        $errors["nama-jurusan"][] = "Panjang maksimal dari nama jurusan adalah 50 karakter";
    }

    if (!preg_match($regex, $field)) {
        $errors["nama-jurusan"][] = "Nama jurusan hanya dapat bertipe alphabet (A-Z)";
    }
}

function validateJurusanDescription(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["deskripsi-jurusan"][] = "Deskripsi jurusan tidak boleh kosong";
    }

    if (strlen($field) < 3) {
        $errors["deskripsi-jurusan"][] = "Panjang minimal dari deskripsi jurusan adalah 3 karakter";
    }
}
