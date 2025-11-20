<?php
require_once 'base_validator.php';

function namaLengkap(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['namaLengkap'][] = 'Nama Lengkap Tidak Boleh Kosong';
    }
}

function nik(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['nik'][] = 'Nik Lengkap Tidak Boleh Kosong';
    }

    if(cekNumeric($field)){
        $errors['nik'][] = 'Nik hanya angka';
    }
}

function jenisKelamin(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['jenis_kelamin'][] = 'jenis kelamin Lengkap Tidak Boleh Kosong';
    }
}

function tempatLahir(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['tempat_lahir'][] = 'Tempat lahir Lengkap Tidak Boleh Kosong';
    }
}

function tanggalLahir(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['tanggal_lahir'][] = 'Tanggal lahir Lengkap Tidak Boleh Kosong';
    }
}

function asalSekolah(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['asal_sekolah'][] = 'Asal Sekolah Lengkap Tidak Boleh Kosong';
    }
}

function aktaKelahiran(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['akta_kelahiran'][] = 'Akta Kelahiran Lengkap Tidak Boleh Kosong';
    }
}

function kartuKeluarga(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['kartu_keluarga'][] = 'Kartu Keluarga Lengkap Tidak Boleh Kosong';
    }
}

function rapor(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['rapor'][] = 'Rapor Lengkap Tidak Boleh Kosong';
    }
}

function suratKeteranganLulus(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['surat_keterangan_lulus'][] = 'Surat surat keterangan lulus Lengkap Tidak Boleh Kosong';
    }
}

function suratKesehatan(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['surat_kesehatan'][] = 'Surat Kesehatan Lengkap Tidak Boleh Kosong';
    }
}

function pasfoto(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['pasfoto'][] = 'pasfoto Lengkap Tidak Boleh Kosong';
    }
}

function persetujuanAsrama(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['persetujuan_asrama'][] = 'Harus Di Checklist';
    }
}

function persetujuanTidakMembawaHp(string $field, array &$errors)
{
    if(cekFieldKosong($field)){
        $errors['persetujuan_tidak_membawa_hp'][] = 'Harus Di Checklist';
    }
}
