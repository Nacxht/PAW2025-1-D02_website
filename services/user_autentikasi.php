<?php 
require_once __DIR__ . '/../db_conn.php';

function connUser(string $username, string $email, string $password){
	try{
		$sqlCheckUsername = "SELECT * FROM users WHERE username = :username";
		$stmtCheckUsername = DBH->prepare($sqlCheckUsername);
		$stmtCheckUsername->execute([
			':username' => $username
		]);

		$user = $stmtCheckUsername->fetch();
		if(!$user){
			$hashPassword = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO users(username,email,password,role) VALUES(:username,:email,:password,:calon_siswa)";
			$stmt = DBH->prepare($sql);
			$stmt->execute([
				':username' => $username,
				':email' => $email,
				':password' => $hashPassword,
				':calon_siswa' => 'calon_siswa'
			]);

		}else{
			$akunSudahAda = 'Akun Sudah Ada';
			echo $akunSudahAda;
		}
	}catch(pdoexception $e){
		echo 'Error : ' . $e->getmessage();
	}
}


 ?>