<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

/**
 * Fungsi untuk memvalidasi nama program
 * 
 * Validator ini juga mengecek ke dalam database apakah nama program
 * sudah ada atau belum
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateNamaProgram(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["nama-program"][] = "Nama Program tidak boleh kosong";
    }

    // Jika panjang dibawah 3 karakter
    if (strlen($field) < 3) {
        $errors["nama-program"][] = "Panjang minimal dari nama program adalah 3 karakter";
    }

    // Jika panjang melebihi 20 karakter
    if (strlen($field) > 20) {
        $errors["nama-program"][] = "Panjang maksimal dari nama program adalah 20 karater";
    }

    // Jika bukan alfabet
    if (!cekAlpha($field)) {
        $errors["nama-program"][] = "Nama program hanya dapat berisi alphabet (A-Z / a-z) dan spasi (' ')";
    }

    // Query untuk mengecek apakah nama program sudah ada/belum
    $stmt = DBH->prepare(
        "SELECT * FROM program WHERE nama_program = :nama_program"
    );

    // Eksekusi query
    $stmt->execute(["nama_program" => $field]);

    // Jika jumlah baris lebih dari 0 (sudah ada)
    if ($stmt->rowCount()) {
        $errors["nama-program"][] = "Nama program sudah ada";
    }
}

/**
 * Fungsi untuk memvalidasi deskripsi nama program
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan-pesan error tiap field
 */
function validateDeskripsiProgram(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["deskripsi-program"][] = "Deksripsi program tidak boleh kosong";
    }

    if (strlen($field) < 3) {
        $errors["deskripsi-program"][] = "Panjang minimal dair deskripsi program adalah 3 karakter";
    }
}
