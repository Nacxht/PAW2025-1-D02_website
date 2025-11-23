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
		<div id="form-section">
			<h1>
				Register
			</h1>

			<p>
				Silahkan melakukan <span class="text-accent">registrasi</span>
				jika belum memiliki akun untuk melakukan proses login.
			</p>

			<hr class="divider">

			<div class="form-container">
				<?php include "components/forms/register_form.php" ?>
			</div>

			<p>
				Sudah Memiliki Akun? <a href="login.php">Login</a>
			</p>

			<hr class="divider">

			<p>
				Atau Kembali ke
				<a href="<?= BASE_URL ?>">
					beranda
				</a>
			</p>
		</div>

		<div id="illustration-section">
			<div id="illustration-section">
				<img src="<?= BASE_URL . "assets/images/9358486.jpg" ?>" alt="">
			</div>
		</div>
	</div>
</body>

</html>