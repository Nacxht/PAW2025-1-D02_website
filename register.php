<?php
require_once __DIR__ . "/auth_middleware/login_register_middleware.php";
require_once __DIR__ . "/services/autentikasi_service.php";
require_once __DIR__ . "/validators/register_validator.php";

if (isset($_POST["submit"])) {
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$konfirmasiPassword = $_POST["konfirmasi-password"];

	$errors = [];

	validateUsername($username, $errors);
	validateEmail($email, $errors);
	validatePassword($password, $errors);
	validateKonfirmasiPassword($konfirmasiPassword, $password, $errors);

	if (empty($errors)) {
		registerService($username, $email, $password, $errors);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/login_register.css" ?>">
</head>

<body>
	<div class="container">
		<h1 class="title">
			Register
		</h1>

		<?php include "components/forms/register_form.php" ?>
	</div>
</body>

</html>