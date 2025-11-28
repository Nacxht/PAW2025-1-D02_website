<?php

/**
 * Fungsi untuk mengecek apakah field kosong atau tidak
 * 
 * @param string $field - Data yang akan divalidasi
 */
function cekFieldKosong(string $field): bool
{
    $field = trim($field);

    return !$field ? true : false;
}

/**
 * Fungsi untuk mengecek apakah field bertipe alfanumerik atau tidak
 * 
 * @param string $field - Data yang akan divalidasi
 */
function cekAlphaNumeric(string $field): bool
{
    $regex = "/^[A-Za-z0-9 ]+$/";

    return preg_match($regex, $field);
}

/**
 * Fungsi untuk mengecek apakah field bertipe numerik atau tidak
 * 
 * @param string $field - Data yang akan divalidasi
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
 */
function cekAlpha(string $field)
{
    $regex = '/^[a-zA-Z ]+$/';

    return preg_match($regex, $field);
}
