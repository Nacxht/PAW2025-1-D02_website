<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/base_validator.php";

/**
 * Fungsi untuk memvalidasi nama dari jenis dokumen
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan error tiap field
 */
function validateNamaJenisDokumen(string $field, array &$errors)
{
    // Jika kosong
    if (cekFieldKosong($field)) {
        $errors["nama-jenis-dokumen"][] = "Nama jenis dokumen tidak boleh kosong";
    }

    // Jika bukan alphabet
    if (!cekAlpha($field)) {
        $errors["nama-jenis-dokumen"][] = "Semua karakter dalam nama jenis dokumen harus bertipe alfabet";
    }

    // Jika panjang dibawah 3 karakter
    if (strlen($field) < 3) {
        $errors["nama-jenis-dokumen"][] = "Panjang minimal dari nama jenis dokumen adalah 3 karakter";
    }

    // Jika panjang diatas 20 karakter
    if (strlen($field) > 20) {
        $errors["nama-jenis-dokumen"][] = "Panjang maksimal dari nama jenis dokumen adalah 20 karakter";
    }

    /**
     * Query untuk mendapatkan jenis dokumen berdasarkan namanya
     * 
     * Ini dilakukan untuk mengecek apakah data yang dimasukkan sudah ada atau belum
     */
    $stmt = DBH->prepare(
        "SELECT * FROM jenis_dokumen WHERE jenis_dokumen = :jenis_dokumen"
    );

    // Mengeksekusi query
    $stmt->execute([":jenis_dokumen" => $field]);

    // Jika jumlah baris diatas 0 (sudah ada)
    if ($stmt->rowCount()) {
        $errors["nama-jenis-dokumen"][] = "Nama jenis dokumen yang anda masukkan sudah ada";
    }
}
