<?php
// Memasukkan file yang diperlukan
require_once __DIR__ . "/auth_middleware/after_login_middleware.php";
require_once __DIR__ . "/services/autentikasi_service.php";
require_once __DIR__ . "/validators/user_validator.php";

// Menangani proses login
if (isset($_POST["login-submit"])) {
	// htmlspecialchars untuk menhindari XSS
	$username = htmlspecialchars($_POST["username"]);
	$password = htmlspecialchars($_POST["password"]);

	// Array yang menyimpan pesan-pesan error
	$errors = [];

	// Memvalidasi input
	validateLoginUsername($username, $errors);
	validateLoginPassword($password, $errors);

	// Jika tidak error, lakukan proses login
	if (!$errors) {
		loginService($_POST, $errors);
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Memasukkan konfigurasi head -->
	<?php include_once __DIR__ . "/components/layouts/meta_title.php" ?>

	<!-- Memasukkan CSS yang diperlukan -->
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
				<!-- Memasukkan form login -->
				<?php include __DIR__ . "/components/forms/login_form.php" ?>
			</div>

			<p>
				Belum Memiliki Akun? <a href="register.php">Register</a>
			</p>

			<hr class="divider">

			<!-- Tombol untuk kembali ke beranda -->
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