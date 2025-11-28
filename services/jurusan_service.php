<?php
require_once __DIR__ . "/../db_conn.php";

// menambah jurusan
function tambahJurusanService(array $data)
{
    $stmt = DBH->prepare(
        "INSERT INTO jurusan (nama_jurusan, deskripsi_jurusan)
        VALUES (:nama_jurusan, :deskripsi_jurusan)"
    );

    $stmt->execute([
        ":nama_jurusan" => htmlspecialchars($data["nama-jurusan"]),
        ":deskripsi_jurusan" => htmlspecialchars($data["deskripsi-jurusan"])
    ]);
}

// mendapatkan keseluruhan data jurusan
function daftarJurusanService($jurusanName = "")
{
    $stmt = DBH->prepare(
        "SELECT
            *
        FROM
            jurusan
        WHERE
            nama_jurusan LIKE :nama_jurusan"
    );

    $stmt->execute([":nama_jurusan" => "%$jurusanName%"]);
    return $stmt->fetchAll();
}

// mendapatkan detail jurusan berdasarkan ID jurusan
function detailJurusanService(int $idJurusan)
{
    $stmt = DBH->prepare(
        "SELECT *
        FROM jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    $stmt->execute([
        ":id_jurusan" => $idJurusan
    ]);

    return $stmt->fetch();
}

// memperbarui data jurusan berdasarkan ID jurusan
function suntingJurusanService(array $data, int $idJurusan)
{
    $stmt = DBH->prepare(
        "UPDATE jurusan
        SET nama_jurusan=:nama_jurusan, deskripsi_jurusan=:deskripsi_jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    $stmt->execute([
        ":nama_jurusan" => htmlspecialchars($data["nama-jurusan"]),
        ":deskripsi_jurusan" => htmlspecialchars($data["deskripsi-jurusan"]),
        ":id_jurusan" => $idJurusan
    ]);
}

// menghapus data jurusan berdasarkan ID jurusan
function hapusJurusanService(int $jurusanId)
{
    $stmt = DBH->prepare(
        "DELETE FROM jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    $stmt->execute([
        ":id_jurusan" => $jurusanId
    ]);
}

// mendapatkan jumlah data yang terdapat di tabel jurusan
function jumlahJurusanService()
{
    $stmt = DBH->prepare(
        "SELECT count(id_jurusan) jumlah_jurusan
            FROM jurusan"
    );

    $stmt->execute();
    return $stmt->fetch()["jumlah_jurusan"];
}
