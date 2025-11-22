<?php
require_once __DIR__ . "/../auth_middleware/after_login_middleware.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<p>
		<h1>Selamat Datang <?= $_SESSION['username']?></h1>
	</p>
</body>
</html>