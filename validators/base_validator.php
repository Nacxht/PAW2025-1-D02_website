<?php
function cekFieldKosong(string $field): bool
{
    $field = trim($field);

    return !$field ? true : false;
}

function cekAlphaNumeric(string $field): bool
{
    $regex = "/^[A-Za-z0-9 ]+$/";

    return preg_match($regex, $field);
}

function cekNumeric(string $field): bool
{
    $regex = "/^\d+$/";

    return preg_match($regex, $field);
}

function cekAlpha(string $field)
{
    $regex = '/^[a-zA-Z ]+$/';

    return preg_match($regex, $field);
}
