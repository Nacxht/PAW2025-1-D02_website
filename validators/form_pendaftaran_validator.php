<?php
require_once __DIR__ . "/base_validator.php";

function validateNamaLengkap(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["nama_lengkap"][] = "Nama Lengkap Tidak Boleh Kosong";
    }
    if (!cekAlpha($field) || cekFieldKosong($field)){
        $errors["nama_lengkap"][] = "Nama Lengkap Hanya huruf";
    }
}

function validateNik(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["nik"][] = "Nik Tidak Boleh Kosong";
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
        $errors["jenis_kelamin"][] = "jenis kelamin Tidak Boleh Kosong";
    }
}

function validateTempatLahir(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["tempat_lahir"][] = "Tempat lahir Tidak Boleh Kosong";
    }
}

function validateTanggalLahir(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["tanggal_lahir"][] = "Tanggal lahir Tidak Boleh Kosong";
    }
}

function validateAsalSekolah(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["asal_sekolah"][] = "Asal Sekolah Tidak Boleh Kosong";
    }
}

function validateJurusan(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["jurusan"][] = "Jurusan Tidak Boleh Kosong";
    }
}


function validateAktaKelahiran( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['akta_kelahiran'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['akta_kelahiran'][] = "File Ukuran MAX 1MB";
    }
}

function validateKartuKeluarga( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['kartu_keluarga'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['kartu_keluarga'][] = "File Ukuran MAX 1MB";
    }
}

function validateRapor( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['rapor'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['rapor'][] = "File Ukuran MAX 1MB";
    }
}

function validateSuratKeteranganLulus( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['surat_keterangan_lulus'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['surat_keterangan_lulus'][] = "File Ukuran MAX 1MB";
    }
}

function validateSuratKesehatan( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['surat_kesehatan'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['surat_kesehatan'][] = "File Ukuran MAX 1MB";
    }
}

function validatePasfoto( $field, array &$errors)
{
    if($field['name'] == ''){
        $errors['pasfoto'][] = "Tidak Boleh Kosong";
    }

    if($field['size'] > 1000000 || $field['size'] == 0){
        $errors['pasfoto'][] = "File Ukuran MAX 1MB";
    }
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
