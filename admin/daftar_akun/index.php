<?php
require_once __DIR__ . "/../../auth_middleware/after_login_middleware.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
</head>

<body>
    <div class="container">
        <table id="account-table">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <td>
                    <!--  -->
                </td>

                <td>
                    <!--  -->
                </td>

                <td>
                    <!--  -->
                </td>

                <td>
                    <!--  -->
                </td>

                <td>
                    <button type="submit" name="account-edit" value="account-edit">Edit</button>
                    <button type="submit" name="account-delete" value="account-delete">Delete</button>
                </td>
            </tbody>
        </table>
    </div>
</body>

</html>