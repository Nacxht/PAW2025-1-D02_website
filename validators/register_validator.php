<?php

require_once 'base_validator.php';

function validateUsername(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors['username'][] = 'Username Wajib diisi';
    }

    if (!cekAlphaNumeric($field)) {
        $errors['username'][] = 'Username hanya bisa alpa numerik';
    }

    if (strlen($field) < 3) {
        $errors['username'][] = 'Panjang Username minimal 3';
    }
}

function validateEmail(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors['email'][] = 'Email Wajib diisi';
    }
}

function validatePassword(string $field, string $passwordField, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors['password'][] = 'Password Wajib diisi';
    }

    if (strlen($field) < 8) {
        $errors['password'][] = 'Password minimal 8';
    }

    if ($field !== $passwordField) {
        $errors['password'][] = 'Password tidak sama';
    }
}

function validateKonfirmasiPassword(string $field, string $passwordField, array &$errors): void
{
    if ($passwordField !== $field) {
        $errors['konfirmasi-password'][] = 'Password tidak sama';
    }
}
