<?php
require_once __DIR__ . "/config.php";
require_once __DIR__ . "/db_conn.php";
require_once __DIR__ . "/validators/user_validator.php";
require_once __DIR__ . "/services/user_service.php";
require_once __DIR__ . "/auth_middleware/before_login_middleware.php";

// edit handler
if (isset($_POST["profile-edit-submit"])) {
    $user = getUserByID($_SESSION["id_user"], $_SESSION["role"]);

    $username = $_POST["username"];
    $email = $_POST["email"];

    $errors = [];

    if ($username != $user["username"]) {
        validateUsername($username, $errors);
    }

    if ($email != $user["email"]) {
        validateEmail($email, $errors);
    }

    if (!$errors) {
        updateUserService($_POST, $_SESSION["role"], $_SESSION["id_user"]);
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

$user = getUserByID($_SESSION["id_user"], $_SESSION["role"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once __DIR__ . "/components/layouts/meta_title.php" ?>

    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
    <link rel="stylesheet" href="<?= BASE_URL . "assets/css/profil.css" ?>">
</head>

<body>
    <?php include_once __DIR__ . "/components/layouts/navbar.php" ?>

    <div class="container">
        <div id="profile-section">
            <h1>
                Profil Pengguna
            </h1>

            <div class="buttons-container">
                <form action="" method="post" id="edit">
                    <?php if (!$isEdit): ?>
                        <button type="submit" class="btn btn-info" name="profile-edit">
                            Sunting Profil
                        </button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-accent" name="profile-cancel-edit">
                            Batal Sunting
                        </button>
                    <?php endif; ?>
                </form>

                <form id="logout" method="post" action="<?= BASE_URL . "logout.php" ?>">
                    <button type="submit" class="btn btn-error" name="logout">
                        Logout
                    </button>
                </form>
            </div>

            <hr class="divider">

            <?php include_once __DIR__ . "/components/forms/profil_form.php" ?>
        </div>
    </div>

    <?php include_once __DIR__ . "/components/layouts/footer.php" ?>
</body>

</html>