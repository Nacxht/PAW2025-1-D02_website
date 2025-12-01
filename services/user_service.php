<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . '/../db_conn.php';

/**
 * Fungsi untuk menambahkan user baru
 * 
 * Fungsi ini tidak memiliki pengecekan duplikasi username dan email,
 * karena hal tersebut sudah dilakukan di validasi yang terpisah
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param string $role - Data yang telah tervalidasi
 */
function addUserService(array $data, string $role = "calon_siswa")
{
    // Menentukan tabel apa yang akan ditambah datanya
    $table = $role == "admin" ? "admin" : "calon_siswa";

    // Query untuk menambah data ke tabel yang ditentukan
    $stmt = DBH->prepare(
        "INSERT INTO
            $table (username, email, password)
        VALUES
            (:username, :email, :password)"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":password" => htmlspecialchars($data["password"]),
    ]);
}

/**
 * Fungsi untuk mendapatkan semua data pengguna
 * 
 * Fungsi ini dilengkapi dengan fitur filter berdasarkan username
 * dan rolenya.
 * 
 * @param string $role - Role dari pengguna (Admin/Calon Siswa)
 * @param string $username - Username dari pengguna
 */
function getUsersService(string $role = "", string $username = "")
{
    /**
     * Query untuk mendapatkan semua data pengguna.
     * 
     * Query ini memiliki sub-query untuk menggabungkan dua query.
     * Hal ini dilakukan dikarenakan user dipisah menjadi dua tabel.
     */
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

    // Mengeksekusi query
    $stmt->execute([
        ":role" => $role ? $role : "%%",
        ":username" => "%$username%"
    ]);

    // Mengembalikan semua row
    return $stmt->fetchAll();
}

/**
 * Fungsi untuk mendapatkan data pengguna secara spesifik
 * berdasarkan ID-nya
 * 
 * @param int $userId - ID dari pengguna
 * @param string $role - Role dari pengguna (Admin/Calon Siswa)
 */
function getUserByID(int $userId, string $role)
{
    // Menentukan tabel apa yang akan digunakan
    $table = $role == "admin" ? "admin" : "calon_siswa";

    // Query untuk mendapatkan data pengguna berdasarkan ID user
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

    // Mengeksekusi query
    $stmt->execute([":id_user" => $userId]);

    // Mengembalikan row pertama (jika ada)
    return $stmt->fetch();
}

/**
 * Fungsi yang digunakan untuk memperbarui data pengguna
 * berdasarkan ID pengguna
 * 
 * @param array $data - Data yang telah tervalidasi
 * @param string $role - Role dari data yang akan disunting (Admin/Calon Siswa)
 * @param int $userId - ID pengguna yang akan disunting
 */
function updateUserService(array $data, string $role, int $userId)
{
    // menentukan tabel apa yang akan digunakan
    $table = $role == "admin" ? "admin" : "calon_siswa";

    // Query untuk memperbarui data pengguna berdasarkan ID pengguna
    $stmt = DBH->prepare(
        "UPDATE
            $table
        SET
            username = :username,
            email = :email
        WHERE
            id_$table = :id_user"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":username" => htmlspecialchars($data["username"]),
        ":email" => htmlspecialchars($data["email"]),
        ":id_user" => $userId
    ]);
}

/**
 * Fungsi untuk menghapus data pengguna berdasarkan ID pengguna
 * 
 * @param int $userId - ID dari data pengguna yang akan dihapus
 * @param string $role - Role dari data pengguna yang akan dihapus
 */
function deleteUserService(int $userId, string $role)
{
    // Menentukan tabel apa yang akan digunakan
    $table = $role == "admin" ? "admin" : "calon_siswa";

    // Query untuk menghapus data pengguna berdasarkan ID pengguna
    $stmt = DBH->prepare(
        "DELETE FROM
            $table
        WHERE
            id_$table = :id_user"
    );

    // Mengeksekusi query
    $stmt->execute([
        ":id_user" => $userId
    ]);
}

/**
 * Fungsi untuk mendapatkan jumlah data pengguna
 */
function getUserCountService()
{
    /**
     * Query untuk mendapatkan jumlah data pengguna.
     * Query ini juga menampilkan jumlah admin dan total calon siswa.
     * 
     * Query ini menggabung dua sub-query menggunakan klausa JOIN.
     * Setiap sub-query digunakan untuk mendapatkan jumlah baris di
     * masing-masing tabel (admin & calon siswa).
     */
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

    // Mengeksekusi query
    $stmt->execute();

    // Mengembalikan row pertama
    return $stmt->fetch();
}
