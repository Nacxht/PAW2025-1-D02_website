<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../db_conn.php";

/**
 * Fungsi untuk menambah data ke tabel program
 * 
 * @param array $data - Data yang telah tervalidasi
 */
function tambahProgramService(array $data)
{
    // Query untuk menambah program
    $stmt = DBH->prepare(
        "INSERT INTO
            program (nama_program, deskripsi_program)
        VALUES
            (:nama_program, :deskripsi_program)"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":nama_program" => htmlspecialchars($data["nama-program"]),
        ":deskripsi_program" => htmlspecialchars($data["deskripsi-program"])
    ]);
}

/**
 * Fungsi untuk mendapatkan semua data di dalam tabel program
 * 
 * Fungsi ini dilengkapi dengan filter untuk melakukan pencarian
 * bedasarkan nama program
 * 
 * @param string $namaProgram - Nama program yang akan dicari
 */
function daftarProgramService(string $namaProgram = "")
{
    // Query untuk mendapatkan semua data dari tabel program
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            program
        WHERE
            nama_program LIKE :nama_program"
    );

    // Mengeksekusi query
    $stmt->execute([":nama_program" => "%$namaProgram%"]);

    // Mengembalikan semua row
    return $stmt->fetchAll();
}

/**
 * Fungsi untuk mendapatkan data spesifik di dalam tabel program
 * bedasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 */
function detailProgramService(int $id)
{
    // Query untuk mendapatkan data spesifik dari tabel program
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            program
        WHERE
            id_program = :id_program"
    );

    // Mengeksekusi query
    $stmt->execute([":id_program" => $id]);

    // Mengembalikan row pertama (jika ada)
    return $stmt->fetch();
}

/**
 * Fungsi untuk menyunting data spesifik di dalam tabel program
 * berdasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 * @param array $data - Data yang telah tervalidasi
 */
function suntingProgramService(int $id, array $data)
{
    // Query untuk mengupdate data spesifik di tabel program
    $stmt = DBH->prepare(
        "UPDATE
            program
        SET
            nama_program = :nama_program,
            deskripsi_program = :deskripsi_program
        WHERE
            id_program = :id_program"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":nama_program" => htmlspecialchars($data["nama-program"]),
        ":deskripsi_program" => htmlspecialchars($data["deskripsi-program"]),
        ":id_program" => $id
    ]);
}

/**
 * Fungsi untuk menyunting data spesifik di dalam tabel program
 * berdasarkan ID-nya
 * 
 * @param int $id - ID dari data di tabel program
 */
function hapusProgramService(int $id)
{
    // Query untuk menghapus data di tabel program berdasarkan ID program
    $stmt = DBH->prepare(
        "DELETE FROM program WHERE id_program = :id_program"
    );

    // Mengeksekusi query
    $stmt->execute([":id_program" => $id]);
}

/**
 * Fungsi untuk mendapatkan jumlah data yang terdapat pada tabel program
 */
function jumlahProgramService()
{
    // Query untuk menampilkan semua data di tabel program
    $stmt = DBH->prepare(
        "SELECT * FROM program"
    );

    // Mengeksekusi query
    $stmt->execute();

    // Mengembalikan jumlah row
    return $stmt->rowCount();
}
