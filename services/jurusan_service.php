<?php
require_once __DIR__ . "/../db_conn.php";

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

function getJurusanService()
{
    $stmt = DBH->prepare(
        "SELECT *
        FROM jurusan"
    );

    $stmt->execute();

    return $stmt->fetchAll();
}

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
