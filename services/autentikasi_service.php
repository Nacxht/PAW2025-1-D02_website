<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/user_service.php";

/**
 * Fungsi ini digunakan untuk menangani logika bisnis login.
 * 
 * Fungsi ini tidak memberitahu kesalahan user secara spesifik.
 * Hal ini dilakukan agar tidak di-abuse oleh user lain.
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param array $errors - Array yang menyimpan pesan-pesan error tiap field
 */
function loginService(array $data, array &$errors)
{
    try {
        /**
         * Menggabung dua query menggunakan UNION ALL.
         * 
         * Hal ini dilakukan, karena pada aplikasi ini user dipisah
         * menjadi 2 tabel, yaitu 'admin' dan 'calon siswa'.
         */
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

        // Jika tidak ada akun yang ditemukan
        if (!$user) {
            $errors["login"] = "Username atau password anda salah";
            return;
        }

        // Jika password yang dimasukkan salah
        if (!password_verify($data["password"], $user["password"])) {
            $errors["login"] = "Username atau password anda salah";
            return;
        }

        // Memasang session jika user berhasil melakukan login
        $_SESSION["id_user"] = $user["id_user"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        // Setelah berhasil login, user akan diarahkan sesuai rolenya
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
        // Hash password menggunakan algoritma bcrypt
        $hashed = password_hash($data["password"], PASSWORD_BCRYPT);

        // Menimpa nilai password dalam array $data
        $data["password"] = $hashed;

        // Menambahkan user
        addUserService($data);

        // Setelah proses register berhasil, user diarahkan ke halaman login
        header("Location: " . BASE_URL . "login.php");
        exit();
    } catch (Exception $error) {
        $errors["register"] = "Proses registrasi gagal, terdapat masalah pada server";
        var_dump($error->getMessage());
    }
}
