<?php
require_once __DIR__ . "/../auth_middleware/after_login_middleware.php";
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
        <div class="stat" id="total-student-candidate">
            <!--  -->
        </div>

        <div class="stat" id="total-admin">
            <!--  -->
        </div>

        <div class="stat" id="number-of-registrant">
            <!--  -->
        </div>
    </div>
</body>

</html>