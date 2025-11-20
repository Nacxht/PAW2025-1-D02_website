<?php
require_once __DIR__ . "/base_validator.php";

function validateNamaLengkap(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["nama_lengkap"][] = "Nama Lengkap Tidak Boleh Kosong";
    }
}

function validateNik(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["nik"][] = "Nik Lengkap Tidak Boleh Kosong";
    }

    if (!cekNumeric($field)) {
        $errors["nik"][] = "Nik hanya angka";
    }

    if (strlen($field) != 16){
        $errors['nik'][] = "Nik Harus 16 Digit";
    }
}

function validateJenisKelamin(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["jenis_kelamin"][] = "jenis kelamin Lengkap Tidak Boleh Kosong";
    }
}

function validateTempatLahir(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["tempat_lahir"][] = "Tempat lahir Lengkap Tidak Boleh Kosong";
    }
}

function validateTanggalLahir(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["tanggal_lahir"][] = "Tanggal lahir Lengkap Tidak Boleh Kosong";
    }
}

function validateAsalSekolah(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["asal_sekolah"][] = "Asal Sekolah Lengkap Tidak Boleh Kosong";
    }
}

function validateAktaKelahiran( $field, array &$errors)
{
    //
}

function validateKartuKeluarga( $field, array &$errors)
{
    //
}

function validateRapor( $field, array &$errors)
{
    //
}

function validateSuratKeteranganLulus( $field, array &$errors)
{
    //
}

function validateSuratKesehatan( $field, array &$errors)
{
    //
}

function validatePasfoto( $field, array &$errors)
{
    //
}

function validatePersetujuanAsrama(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["persetujuan_asrama"][] = "Harus Di Checklist";
    }
}

function validatePersetujuanTidakMembawaHp(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["persetujuan_tidak_membawa_hp"][] = "Harus Di Checklist";
    }
}
