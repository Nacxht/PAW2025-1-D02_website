<?php
function cekFieldKosong(string $field)
{
    $field = trim($field);

    return !$field ? true : false;
}

function cekAlphaNumeric(string $field)
{
    $regex = "/^[A-Za-z0-9 ]+$/";

    return preg_match($regex, $field);
}

function cekNumeric(string $field)
{
    $regex = "/^\d+$/";

    return preg_match($regex, $field);
}
