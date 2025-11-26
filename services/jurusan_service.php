<?php
require_once __DIR__ . "/../db_conn.php";

// menambah jurusan
function addJurusanService(array $data)
{
    $stmt = DBH->prepare(
        "INSERT INTO jurusan (nama_jurusan, deskripsi_jurusan)
        VALUES (:nama_jurusan, :deskripsi_jurusan)"
    );

    $stmt->execute([
        ":nama_jurusan" => $data["nama_jurusan"],
        ":deskripsi_jurusan" => $data["deskripsi_jurusan"]
    ]);
}

// mendapatkan keseluruhan data jurusan
function getJurusanService($jurusanName = "")
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
function getJurusanByIdService(int $idJurusan)
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
function updateJurusanService(array $data, int $idJurusan)
{
    $stmt = DBH->prepare(
        "UPDATE jurusan
        SET nama_jurusan=:nama_jurusan, deskripsi_jurusan=:deskripsi_jurusan
        WHERE id_jurusan=:id_jurusan"
    );

    $stmt->execute([
        ":nama_jurusan" => $data["nama_jurusan"],
        ":deskripsi_jurusan" => $data["deskripsi_jurusan"],
        ":id_jurusan" => $idJurusan
    ]);
}

// menghapus data jurusan berdasarkan ID jurusan
function deleteJurusanService(int $jurusanId)
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
function getJurusanCountService()
{
    $stmt = DBH->prepare(
        "SELECT count(id_jurusan) jumlah_jurusan
            FROM jurusan"
    );

    $stmt->execute();

    return $stmt->fetch()["jumlah_jurusan"];
}
