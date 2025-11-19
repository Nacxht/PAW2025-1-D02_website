<?php
require_once 'services/user_autentikasi.php';
require_once 'validators/register_validator.php';
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$konfirmasiPassword = $_POST['konfirmasi-password'];
	$errors = [];
	validateUsername($username, $errors);
	validateEmail($email, $errors);
	validatePassword($password, $konfirmasiPassword, $errors);
	validateKonfirmasiPassword($konfirmasiPassword, $password, $errors);
	if (empty($errors)) {
		connUser($username, $email, $password);
	}
}

?>
<h1 class="title">
	Register
</h1>

<form action="register.php" method="post">
	<div class="input-container">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="<?php if (isset($_POST['submit'])) {
																	echo $password;
																} ?>">

		<ul>
			<?php if (!empty($errors['username'])): ?>
				<?php foreach ($errors['username'] as $error): ?>
					<li>
						<?= $error; ?>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

	<div class="input-container">
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="<?php if (isset($_POST['submit'])) {
																echo $email;
															} ?>">
		<ul>
			<?php if (!empty($errors['email'])): ?>
				<?php foreach ($errors['email'] as $error): ?>
					<li>
						<?= $error; ?>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

	<div class="input-container">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="<?php if (isset($_POST['submit'])) {
																		echo $password;
																	} ?>">
		<ul>
			<?php if (!empty($errors['password'])): ?>
				<?php foreach ($errors['password'] as $error): ?>
					<li>
						<?= $error; ?>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

	<div class="input-container">
		<label for="konfirmasi-password">Konfirmasi Password</label>
		<input type="password" name="konfirmasi-password" id="konfirmasi-password" value="<?php if (isset($_POST['submit'])) {
																								echo $konfirmasiPassword;
																							} ?>""> 
		<ul>
			<?php if (!empty($errors['konfirmasi-password'])): ?>
				<?php foreach ($errors['konfirmasi-password'] as $error): ?>
					<li>
						<?= $error; ?>
					</li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
	</div>

	<button type=" submit" name="submit">Register</button>

		<div class="input-container">
			<label for="password">Password</label>
			<input type="password" name="password" id="password">
		</div>

		<div class="input-container">
			<label for="konfirmasi-password">Konfirmasi Password</label>
			<input type="password" name="konfirmasi-password" id="konfirmasi-password">
		</div>

		<button type="submit" name="register-submit" value="register-submit">
			Register
		</button>

		<p>
			Sudah memiliki akun? <a href="login.php">Login</a>
		</p>
</form>
</body>

</html>