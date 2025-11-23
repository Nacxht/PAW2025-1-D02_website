<?php
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
</head>

<body>
	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
	<?php include_once __DIR__ . "/../components/layouts/navbar.php" ?>
	<div class="container">
		<h1>Selamat Datang <?= $_SESSION['username'] ?></h1>
	</div>

</body>

</html>