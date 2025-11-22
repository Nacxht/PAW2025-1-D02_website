<?php
require_once __DIR__ . "/base_validator.php";

function validateUsername(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username Wajib diisi";
    }

    if (!cekAlpha($field)) {
        $errors["username"][] = "Username hanya Huruf";
    }

    if (strlen($field) < 3) {
        $errors["username"][] = "Panjang Username minimal 3";
    }
}

function validateEmail(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["email"][] = "Email wajib diisi!";
    }

    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $errors["email"][] = "Email tidak valid!";
    }
}

function validatePassword(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Password Wajib diisi";
    }

    if (strlen($field) < 8) {
        $errors["password"][] = "Password minimal 8";
    }
}

function validateKonfirmasiPassword(string $field, string $passwordField, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["konfirmasi-password"][] = "Konfirmasi Password Wajib diisi";
    }

    if ($passwordField !== $field) {
        $errors["konfirmasi-password"][] = "Konfirmasi Password tidak sama";
    }
}
