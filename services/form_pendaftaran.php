<?php
require_once __DIR__ . '/../db_conn.php';

function formPendaftaran(string $nama_lengkap, string $nik, string $jenis_kelamin, string $tempat_lahir, string $tanggal_lahir, string $asal_sekolah,string $jurusan, array $akta_kelahiran, array $kartu_keluarga, array $rapor, array $surat_keterangan_lulus, array $surat_kesehatan, array $pasfoto, string $persetujuan_tidak_membawa_hp, string $persetujuan_asrama)
{
    try {
        $folder = __DIR__ . "/../assets/uploads/";
        $path_akta_kelahiran = pathinfo($akta_kelahiran['name'], PATHINFO_EXTENSION);
        $path_kartu_keluarga = pathinfo($kartu_keluarga['name'], PATHINFO_EXTENSION);
        $path_rapor = pathinfo($rapor['name'], PATHINFO_EXTENSION);
        $path_surat_keterangan_lulus = pathinfo($surat_keterangan_lulus['name'], PATHINFO_EXTENSION);
        $path_surat_kesehatan = pathinfo($surat_kesehatan['name'], PATHINFO_EXTENSION);
        $path_pasfoto = pathinfo($pasfoto['name'], PATHINFO_EXTENSION);

        $name_akta_kelahiran = 'akta_kelahiran' . '_' . time() . '_.' . $path_akta_kelahiran;
        $name_kartu_keluarga = 'kartu_keluarga' . '_' . time() . '_.' . $path_kartu_keluarga;
        $name_rapor = 'rapor' . '_' . time() . '_.' . $path_rapor;
        $name_surat_keterangan_lulus = 'surat_keterangan_lulus' . '_' . time() . '_.' . $path_surat_keterangan_lulus;
        $name_surat_kesehatan = 'surat_kesehatan' . '_' . time() . '_.' . $path_surat_kesehatan;
        $name_pasfoto = 'pasfoto' . '_' . time() . '_.' . $path_pasfoto;

        move_uploaded_file($akta_kelahiran['tmp_name'], $folder . $name_akta_kelahiran);
        move_uploaded_file($kartu_keluarga['tmp_name'], $folder . $name_kartu_keluarga);
        move_uploaded_file($rapor['tmp_name'], $folder . $name_rapor);
        move_uploaded_file($surat_keterangan_lulus['tmp_name'], $folder . $name_surat_keterangan_lulus);
        move_uploaded_file($surat_kesehatan['tmp_name'], $folder . $name_surat_kesehatan);
        move_uploaded_file($pasfoto['tmp_name'], $folder . $name_pasfoto);


        $sql = "INSERT INTO form_pendaftaran(id_user,nama_lengkap, nik, jenis_kelamin, tempat_lahir, tanggal_lahir, asal_sekolah,jurusan, akta_kelahiran, kartu_keluarga, rapor,surat_keterangan_lulus, surat_kesehatan, pasfoto, persetujuan_tidak_membawa_hp, persetujuan_asrama)
        VALUES (:id_user,:nama_lengkap,:nik,:jenis_kelamin,:tempat_lahir,:tanggal_lahir,:asal_sekolah,:jurusan,:akta_kelahiran,:kartu_keluarga,:rapor,:surat_keterangan_lulus,:surat_kesehatan,:pasfoto,:persetujuan_tidak_membawa_hp,:persetujuan_asrama)";

        $stmt = DBH->prepare($sql);
        // ubah ini jadi $_SESSION['id_user']
        $stmt->execute([
            ':id_user' => $_SESSION['id_user'],
            ':nama_lengkap' => $nama_lengkap,
            ':nik' => $nik,
            ':jenis_kelamin' => $jenis_kelamin,
            ':tempat_lahir' => $tempat_lahir,
            ':tanggal_lahir' => $tanggal_lahir,
            ':asal_sekolah' => $asal_sekolah,
            ':jurusan' => $jurusan,
            ':akta_kelahiran' => $name_akta_kelahiran,
            ':kartu_keluarga' => $name_kartu_keluarga,
            ':rapor' => $name_rapor,
            ':surat_keterangan_lulus' => $name_surat_keterangan_lulus,
            ':surat_kesehatan' => $name_surat_kesehatan,
            ':pasfoto' => $name_pasfoto,
            ':persetujuan_tidak_membawa_hp' => $persetujuan_tidak_membawa_hp,
            ':persetujuan_asrama' => $persetujuan_asrama,

        ]);

        header("location: " . BASE_URL . "login.php");
    } catch (PDOexception $e) {
        echo 'Error' . $e->getMessage();
    }
}
