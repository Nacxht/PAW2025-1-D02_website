<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../db_conn.php";

/**
 * Fungsi untuk menambah jurusan
 * 
 * @param array $data - Data yang telah divalidasi
 */
function tambahJurusanService(array $data)
{
    // Query untuk menambah jurusan
    $stmt = DBH->prepare(
        "INSERT INTO jurusan (nama_jurusan, deskripsi_jurusan)
        VALUES (:nama_jurusan, :deskripsi_jurusan)"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":nama_jurusan" => htmlspecialchars($data["nama-jurusan"]),
        ":deskripsi_jurusan" => htmlspecialchars($data["deskripsi-jurusan"])
    ]);
}

/**
 * Mendapatkan semua data dari tabel jurusan
 * 
 * @param string $jurusanName - Nama dari jurusan yang akan dicari
 */
function daftarJurusanService(string $jurusanName = "")
{
    // Query untuk menambah jurusan
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            jurusan
        WHERE
            nama_jurusan LIKE :nama_jurusan"
    );

    // Mengeksekusi query
    $stmt->execute([":nama_jurusan" => "%$jurusanName%"]);

    // Mengembalikan semua row
    return $stmt->fetchAll();
}

/**
 * Mendapatkan data spesifik dari tabel jurusan berdasarkan 
 * ID jurusan
 * 
 * @param int $idJurusan - ID dari data yang akan dicari
 */
function detailJurusanService(int $idJurusan)
{
    // Query untuk mendapatkan data spesifik berdasarkan ID nya
    $stmt = DBH->prepare(
        "SELECT *
        FROM jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":id_jurusan" => $idJurusan
    ]);

    // Mengembalikan row pertama (jika ada)
    return $stmt->fetch();
}

/**
 * Fungsi untuk menyunting (update) data dari tabel jurusan
 * berdasarkan ID jurusan
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param int $idJurusan - ID dari data jurusan yang akan disunting
 */
function suntingJurusanService(array $data, int $idJurusan)
{
    // Query untuk memperbarui data di tabel jurusan
    $stmt = DBH->prepare(
        "UPDATE jurusan
        SET nama_jurusan=:nama_jurusan, deskripsi_jurusan=:deskripsi_jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":nama_jurusan" => htmlspecialchars($data["nama-jurusan"]),
        ":deskripsi_jurusan" => htmlspecialchars($data["deskripsi-jurusan"]),
        ":id_jurusan" => $idJurusan
    ]);
}

/**
 * Fungsi untuk menghapus data di tabel jurusan berdasarkan
 * ID jurusan.
 * 
 * @param int $jurusanId - ID dari data jurusan yang akan dihapus
 */
function hapusJurusanService(int $jurusanId)
{
    // Query untuk menghapus data di tabel jurusan
    $stmt = DBH->prepare(
        "DELETE FROM jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":id_jurusan" => $jurusanId
    ]);
}

/**
 * Fungsi untuk mendapatkan jumlah jurusan.
 */
function jumlahJurusanService()
{
    // Query untuk mendapatkan semua data jurusan
    $stmt = DBH->prepare(
        "SELECT * FROM jurusan"
    );

    // Mengeksekusi query
    $stmt->execute();

    // Mengembalikan jumlah row
    return $stmt->rowCount();
}
