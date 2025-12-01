<?php

/**
 * Fungsi untuk mengecek apakah field kosong atau tidak
 * 
 * @param string $field - Data yang akan divalidasi
 * @return bool - Mengembalikan true jika nilai kosong
 */
function cekFieldKosong(string $field): bool
{
    // Menghapus spasi kosong
    $field = trim($field);
    return !$field ? true : false;
}

/**
 * Fungsi untuk mengecek apakah field bertipe numerik atau tidak
 * 
 * @param string $field - Data yang akan divalidasi
 * @return bool $field - Mengembalikan true jika nilainya numerik
 */
function cekNumeric(string $field): bool
{
    $regex = "/^\d+$/";
    return preg_match($regex, $field);
}

/**
 * Fungsi untuk mengecek apakah field bertipe alphabet atau tidak
 * 
 * @param string $field - data yang akan divalidasi
 * @return bool - Mengembalikan true jika nilainya alphabet
 */
function cekAlpha(string $field): bool
{
    $regex = '/^[a-zA-Z ]+$/';
    return preg_match($regex, $field);
}
