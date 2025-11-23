<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db_conn.php";
require_once __DIR__ . "/validators/user_validator.php";
require_once __DIR__ . "/services/user_service.php";
require_once __DIR__ . "/auth_middleware/before_login_middleware.php";

// logout handler
if (isset($_POST["profile-logout"])) {
    session_unset();
    session_destroy();

    header("location: " . BASE_URL . "index.php");
}

// edit handler
if (isset($_POST["profile-edit-submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    $errors = [];

    // validateUsername($username, $errors);
    // validateEmail($email, $errors);

    if (!$errors) {
        updateUserService($_POST, $_SESSION["id_user"]);
    }
}

// toogle untuk edit
$isEdit = false;
if (isset($_POST["profile-edit"]) || isset($_POST["profile-cancel-edit"])) {
    if (isset($_POST["profile-edit"])) {
        $isEdit = true;
    } else {
        $isEdit = false;
    }
}

// user data
$user_stmt = DBH->prepare(
    "SELECT username, email, role
    FROM users
    WHERE id_user=:id_user"
);

$user_stmt->execute([":id_user" => $_SESSION["id_user"]]);
$user = $user_stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/profil.css" ?>">
</head>

<body>
    <?php if ($_SESSION["role"] == "user") ?>
    <?php include_once __DIR__ . "/components/layouts/navbar.php" ?>

    <div class="container">
        <form id="profile-section" method="post" action="profil.php">
            <h1>
                Profil Pengguna
            </h1>

            <div class="buttons-container">
                <?php if (!$isEdit): ?>
                    <button type="submit" class="btn btn-info" name="profile-edit" value="profile-edit">
                        Sunting Profil
                    </button>
                <?php else: ?>
                    <button type="submit" class="btn btn-accent" name="profile-cancel-edit" value="profile-cancel-edit">
                        Batal Sunting
                    </button>
                <?php endif; ?>

                <button type="submit" class="btn btn-error" name="profile-logout" value="profile-logout">
                    Logout
                </button>
            </div>

            <hr class="divider">

            <?php include_once __DIR__ . "/components/forms/profil_form.php" ?>
        </form>
    </div>

    <?php include_once __DIR__ . "/components/layouts/footer.php" ?>
</body>

</html>