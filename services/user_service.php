<?php
require_once __DIR__ . '/../db_conn.php';

// fungsi untuk menambahkan pengguna
function addUserService(array $data, string $role = "calon_siswa")
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "INSERT INTO
            $table (username, email, password)
        VALUES
            (:username, :email, :password)"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":password" => htmlspecialchars($data["password"]),
    ]);
}

// fungsi untuk mendapatkan semua data pengguna (dilengkapi dengan filter nama & role)
function getUsersService(string $role = "", string $username = "")
{
    $stmt = DBH->prepare(
        "SELECT user.* FROM
        (
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
        ) user
        WHERE
            user.role LIKE :role
        AND
            user.username LIKE :username"
    );

    $stmt->execute([
        ":role" => $role ? $role : "%%",
        ":username" => "%$username%"
    ]);

    return $stmt->fetchAll();
}

// fungsi untuk mendapatkan detail data pengguna berdasarkan ID-nya
function getUserByID(int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "SELECT
            id_$role id_user,
            username,
            email,
            password,
            '$role' role
        FROM
            $table
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([":id_user" => $userId]);
    return $stmt->fetch();
}

// fungsi untuk memperbarui data pengguna berdasarkan ID-nya
function updateUserService(array $data, string $role, int $userId)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "UPDATE
            $table
        SET
            username = :username,
            email = :email
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":id_user" => $userId
    ]);
}

// fungsi untuk memperbarui password
function updateUserPasswordService(string $password, int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";
    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = DBH->prepare(
        "UPDATE
            $table
        SET
            password = :password
        WHERE id_$table = :id_user"
    );

    $stmt->execute([
        ":password" => htmlspecialchars($hashed),
        ":user_id" => $userId
    ]);
}

// fungsi untuk menghapus data pengguna berdasarkan ID-nya
function deleteUserService(int $userId, string $role)
{
    $table = $role == "admin" ? "admin" : "calon_siswa";

    $stmt = DBH->prepare(
        "DELETE FROM
            $table
        WHERE
            id_$table = :id_user"
    );

    $stmt->execute([
        ":id_user" => $userId
    ]);
}

// mendapatkan jumlah user
function getUserCountService()
{
    $stmt = DBH->prepare(
        "SELECT
            *,
            a.total_admin + c.total_calon_siswa total_user
        FROM
        (
            SELECT count(id_admin) total_admin FROM admin
        ) a
        JOIN
        (
            SELECT count(id_calon_siswa) total_calon_siswa FROM calon_siswa
        ) c"
    );

    $stmt->execute();
    return $stmt->fetch();
}
