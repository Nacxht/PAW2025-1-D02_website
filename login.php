<?php
require_once __DIR__ . "/auth_middleware/login_register_middleware.php";
require_once __DIR__ . "/services/autentikasi_service.php";
require_once __DIR__ . "/validators/login_validator.php";

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

	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/login_register.css" ?>">
</head>

<body>
	<div class="container">
		<div id="form-section">
			<h1>
				Login
			</h1>

			<p>
				Silahkan <span class="text-accent">login</span>
				untuk membuka akses lebih banyak ke halaman web,
				dan agar dapat melakukan proses pendaftaran calon
				siswa.
			</p>

			<hr class="divider">

			<div id="form-container">
				<?php include __DIR__ . "/components/forms/login_form.php" ?>
			</div>

			<p>
				Belum Memiliki Akun? <a href="register.php">Register</a>
			</p>

			<hr class="divider">

			<p>
				Atau Kembali ke
				<a href="<?= BASE_URL ?>">
					Beranda
				</a>
			</p>
		</div>

		<div id="illustration-section">
			<img src="<?= BASE_URL . "assets/images/9358486.jpg" ?>" alt="">
		</div>
	</div>
</body>

</html>