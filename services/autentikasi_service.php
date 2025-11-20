<?php
require_once "./db_conn.php";
require_once "./config.php";

function loginService(string $username, string $password, &$errors)
{
    $stmt = DBH->prepare("
        SELECT username, password, role
        FROM users
        WHERE username=:username
    ");

    $stmt->execute([":username" => $username]);
    $user = $stmt->fetch();

    if (!$user) {
        $errors["username"][] = "Username tidak ditemukan";
        return;
    }

    $userPassword = $user["password"];

    if (!password_verify($password, $userPassword)) {
        $errors["password"][] = "Password anda salah!";
        return;
    }

    $_SESSION["username"] = $user["username"];
    $_SESSION["role"] = $user["role"];

    if ($user["role"] == "admin") {
        header("location: " . BASE_URL . "admin/index.php");
    } else {
        header("location: " . BASE_URL . "calon_siswa/index.php");
    }
}

function registerService(string $username, string $email, string $password, array &$errors)
{
    try {
        $sqlCheckUsername = "SELECT * FROM users WHERE username = :username";
        $stmtCheckUsername = DBH->prepare($sqlCheckUsername);

        $stmtCheckUsername->execute([
            ':username' => $username
        ]);

        $user = $stmtCheckUsername->fetch();

        if (!$user) {
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(username,email,password,role) VALUES(:username,:email,:password,:calon_siswa)";
            $stmt = DBH->prepare($sql);

            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hashPassword,
                ':calon_siswa' => 'calon_siswa'
            ]);

            header("location: " . BASE_URL . "login.php");
        } else {
            $errors["username"][] = "Username sudah ada!";
        }
    } catch (PDOException $e) {
        echo 'Error : ' . $e->getmessage();
    }
}
