<?php
require_once "base_validator.php";

function validateUsername(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["username"][] = "Field username tidak boleh kosong";
    }
}

function validatePassword(string $field, array &$errors): void
{
    if (cekFieldKosong($field)) {
        $errors["password"][] = "Field password tidak boleh kosong";
    }
}
