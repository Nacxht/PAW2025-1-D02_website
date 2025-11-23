<?php
require_once __DIR__ . '/../db_conn.php';

function updateUserService(array $data, int $userId)
{

    $stmt = DBH->prepare(
        "UPDATE users
        SET username=:username, email=:email, role=:role
        WHERE id_user=:id_user"
    );

    $stmt->execute([
        ":username" => $data["username"],
        ":email" => $data["email"],
        ":role" => $data["role"],
        ":id_user" => $userId
    ]);
}
