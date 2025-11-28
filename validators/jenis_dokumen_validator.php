<?php
require __DIR__ . "/../db_conn.php";
require __DIR__ . "/base_validator.php";

/**
 * Fungsi untuk memvalidasi nama dari jenis dokumen
 * 
 * @param string $field - Data yang akan divalidasi
 * @param array &$errors - Array yang menyimpan pesan error tiap field
 */
function validateNamaJenisDokumen(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["nama-jenis-dokumen"][] = "Nama jenis dokumen tidak boleh kosong";
    }

    if (!cekAlpha($field)) {
        $errors["nama-jenis-dokumen"][] = "Semua karakter dalam nama jenis dokumen harus bertipe alfabet";
    }

    if (strlen($field) < 3) {
        $errors["nama-jenis-dokumen"][] = "Panjang minimal dari nama jenis dokumen adalah 3 karakter";
    }

    if (strlen($field) > 20) {
        $errors["nama-jenis-dokumen"][] = "Panjang maksimal dari nama jenis dokumen adalah 20 karakter";
    }

    $stmt = DBH->prepare(
        "SELECT * FROM jenis_dokumen WHERE jenis_dokumen = :jenis_dokumen"
    );

    $stmt->execute([":jenis_dokumen" => $field]);

    if ($stmt->rowCount()) {
        $errors["nama-jenis-dokumen"][] = "Nama jenis dokumen yang anda masukkan sudah ada";
    }
}
