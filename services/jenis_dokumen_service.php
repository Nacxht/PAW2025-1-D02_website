<?php
require_once __DIR__ . "/../db_conn.php";

/**
 * Fungsi untuk menambahkan data baru ke tabel jenis dokumen
 * 
 * @param array $data - Data yang telah tervalidasi
 */
function tambahJenisDokumenService(array $data)
{
    $stmt = DBH->prepare(
        "INSERT INTO
            jenis_dokumen (jenis_dokumen)
        VALUES
            (:jenis_dokumen)"
    );

    $stmt->execute(["jenis_dokumen" => $data["nama-jenis-dokumen"]]);
}

/**
 * Fungsi untuk menampilkan data-data tabel jenis dokumen
 * 
 * @param string $jenisDokumen - Nama dari jenis dokumen
 */
function daftarJenisDokumenService(string $jenisDokumen = "")
{
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            jenis_dokumen
        WHERE
            jenis_dokumen LIKE :jenis_dokumen"
    );

    $stmt->execute([":jenis_dokumen" => "%$jenisDokumen%"]);

    return $stmt->fetchAll();
}

/**
 * Fungsi untuk menampilkan data spesifik dari tabel jenis dokumen
 * berdasarkan ID-nya
 * 
 * @param int $id - ID data dari tabel jenis dokumen
 */
function detailJenisDokumenService(int $id)
{
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            jenis_dokumen
        WHERE id_jenis_dokumen = :id_jenis_dokumen"
    );

    $stmt->execute([":id_jenis_dokumen" => $id]);

    return $stmt->fetch();
}

/**
 * Fungsi untuk menyunting (edit) data spesifik dari tabel jenis dokumen
 * berdasarkan ID-nya
 * 
 * @param array $data - Data yang telah divalidasi
 * @param int $id - ID data dari tabel jenis dokumen
 */
function suntingJenisDokumenService(array $data, int $id)
{
    $stmt = DBH->prepare(
        "UPDATE
            jenis_dokumen
        SET
            jenis_dokumen = :jenis_dokumen
        WHERE
            id_jenis_dokumen = :id_jenis_dokumen"
    );

    $stmt->execute([
        ":jenis_dokumen" => $data["nama-jenis-dokumen"],
        ":id_jenis_dokumen" => $id
    ]);
}

/**
 * Fungsi untuk menghapus data spesifik dati tabel jenis dokumen
 * bedasarkan ID-nya
 * 
 * @param int $id - ID data dari tabel jenis dokumen
 */
function hapusJenisDokumenService(int $id)
{
    $stmt = DBH->prepare(
        "DELETE FROM    
            jenis_dokumen
        WHERE
            id_jenis_dokumen = :id_jenis_dokumen"
    );

    $stmt->execute([":id_jenis_dokumen" => $id]);
}
