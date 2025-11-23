<?php
require_once __DIR__ . "/base_validator.php";
require_once __DIR__ . "/../db_conn.php";

function validateUsername(string $field, array &$errors)
{
    $reAlnumSpace = "/^[A-Za-z1-9_]+$/";

    if (cekFieldKosong($field)) {
        $errors["username"][] = "Username tidak boleh kosong";
    }

    if (!preg_match($reAlnumSpace, $field)) {
        $errors["username"][] = "Karakter dalam username bertipe alfanumerik dan dapat mengandung underscore";
    }

    if (strlen($field) < 3) {
        $errors["username"][] = "Panjang minimal username adalah 3 (tiga) karakter";
    }

    $stmt = DBH->prepare(
        "SELECT username
        FROM users
        WHERE username=:username"
    );

    $stmt->execute([
        ":username" => $field
    ]);

    if ($stmt->rowCount()) {
        $errors["username"][] = "Username yang anda masukkan telah terdaftar";
    }
}


function validateEmail(string $field, array &$errors)
{
    if (cekFieldKosong($field)) {
        $errors["email"][] = "Email tidak boleh kosong";
    }

    if (!filter_var($field, FILTER_VALIDATE_EMAIL)) {
        $errors["email"][] = "Email yang dimasukkan tidak valid";
    }

    $stmt = DBH->prepare(
        "SELECT email
        FROM users
        WHERE email=:email"
    );

    $stmt->execute([
        ":email" => $field
    ]);

    if ($stmt->rowCount()) {
        $errors["email"][] = "Email yang anda masukkan telah terdaftar";
    }
}

function validatePassword(string $field, array &$errors)
{
    // 
}
