<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/user_service.php";

// fungsi untuk menangani logika bisnis dari login
function loginService(array $data, array &$errors)
{
    try {
        // menggabung dua query menggunakan UNION ALL
        $stmt = DBH->prepare(
            "SELECT user.* FROM (
                SELECT
                    id_admin id_user,
                    username,
                    email,
                    password,
                    'admin' role
                FROM
                    admin
                UNION ALL
                SELECT
                    id_calon_siswa id_user,
                    username,
                    email,
                    password,
                    'calon_siswa' role
                FROM
                    calon_siswa
            ) user WHERE username = :username"
        );

        $stmt->execute([":username" => $data["username"]]);
        $user = $stmt->fetch();

        // jika tidak ada akun yang ditemukan
        if (!$user) {
            $errors["login"] = "Username atau password anda salah";
            return;
        }

        // jika password yang dimasukkan salah
        if (!password_verify($data["password"], $user["password"])) {
            $errors["login"] = "Username atau password anda salah";
            return;
        }

        // memasang session
        $_SESSION["id_user"] = $user["id_user"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // setelah berhasil login, user akan diarahkan sesuai rolenya
        if ($user["role"] == "admin") {
            header("location: " . BASE_URL . "admin/index.php");
        } else {
            header("location: " . BASE_URL);
        }

        exit();
    } catch (Exception $error) {
        $errors["login"] = "Login gagal, terdapat masalah pada server";
    }
}

// fungsi untuk menangani logika bisnis dari register
function registerService(array $data, array &$errors)
{
    try {
        // hash password menggunakan algoritma bcrypt
        $hashed = password_hash($data["password"], PASSWORD_BCRYPT);
        $data["password"] = $hashed;

        addUserService($data);

        header("Location: " . BASE_URL . "login.php");
        exit();
    } catch (Exception $error) {
        $errors["register"] = "Proses registrasi gagal, terdapat masalah pada server";
        var_dump($error->getMessage());
    }
}
