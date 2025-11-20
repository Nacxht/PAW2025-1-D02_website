<?php
require_once dirname(__FILE__) . "/auth_middleware/login_register_middleware.php";
require_once "services/autentikasi_service.php";
require_once "validators/login_validator.php";

if (isset($_POST["login-submit"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];

	$errors = [];

	validateUsername($username, $errors);
	validatePassword($password, $errors);

	if (!$errors) {
		loginService($username, $password, $errors);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/login_register.css">
</head>

<body>
	<div class="container">
		<h1 class="judul">
			Login
		</h1>

		<?php include "components/forms/login_form.php" ?>
	</div>
</body>

</html>