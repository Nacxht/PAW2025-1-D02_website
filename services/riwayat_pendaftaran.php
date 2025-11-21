<?php
require_once __DIR__ . '/../db_conn.php';


function ambilRiwayatPendaftaran()
{
	try {
		$sql = 'SELECT * FROM form_pendaftaran WHERE id_user = :id_user';
		$stmt = DBH->prepare($sql);
		$stmt->execute([
			':id_user' => $_SESSION['id_user']
		]);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// var_dump($data);
		return $data;

	} catch (PDOException $e) {
		echo 'Error : ' . $e->getMessage();
	}
}
