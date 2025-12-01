<?php
// Memasukkan file-file yang diperlukan
require_once __DIR__ . "/auth_middleware/after_login_middleware.php";
require_once __DIR__ . "/services/autentikasi_service.php";
require_once __DIR__ . "/validators/user_validator.php";

// Menangani proses registrasi
if (isset($_POST["submit"])) {
	// htmlspecialchars untuk menghindari XSS
	$username = htmlspecialchars($_POST["username"]);
	$email = htmlspecialchars($_POST["email"]);
	$password = htmlspecialchars($_POST["password"]);
	$konfirmasiPassword = htmlspecialchars($_POST["konfirmasi-password"]);

	// Array untuk menyimpan pesan-pesan error
	$errors = [];

	// Memvalidasi input
	validateUsername($username, $errors);
	validateEmail($email, $errors);
	validatePassword($password, $errors);
	validateKonfirmasiPassword($konfirmasiPassword, $password, $errors);

	// Jika tidak ada error, lakukan proses registrasi
	if (!$errors) {
		registerService($_POST, $errors);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Memasukkan konfigurasi head -->
	<?php include_once __DIR__ . "/components/layouts/meta_title.php" ?>

	<!-- Memasukkan konfigurasi CSS -->
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

			<!-- Memasukkan form register -->
			<div class="form-container">
				<?php include "components/forms/register_form.php" ?>
			</div>

			<!-- Hyperlink yang mengarahkan ke halaman login -->
			<p>
				Sudah Memiliki Akun? <a href="login.php">Login</a>
			</p>

			<hr class="divider">

			<!-- Hyperlink yang mengarahkan ke halaman beranda -->
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