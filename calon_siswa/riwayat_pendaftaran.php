<?php
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
require_once __DIR__ . '/../services/riwayat_pendaftaran.php';


$data = ambilRiwayatPendaftaran();
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


	<?php include_once __DIR__ . "/../components/layouts/navbar.php" ?>

	<div class="container">
		<h1>Riwayat Pendaftaran Anda</h1>
		<?php foreach ($data as $dt): ?>
			<a href="">
				<p>Tanggal Daftar : <?= $dt['tanggal_daftar'] ?></p>
			</a>

			<P>Nama Lengkap : <?= $dt['nama_lengkap'] ?></P>
			<P>Nik : <?= $dt['nik'] ?></P>
			<P>Jenis Kelamin : <?= $dt['jenis_kelamin'] ?></P>
			<P>Tempat Lahir : <?= $dt['tempat_lahir'] ?></P>
			<P>Tanggal lahir : <?= $dt['tanggal_lahir'] ?></P>
			<P>Asal Sekolah : <?= $dt['asal_sekolah'] ?></P>
			<P>Jurusan : <?= $dt['jurusan'] ?></P>
			<P>Akta Kelahiran : <a href="../assets/uploads/<?= $dt['akta_kelahiran'] ?? '' ?>">Lihat</a></P>
			<P>Kartu Keluarga : <a href="../assets/uploads/<?= $dt['kartu_keluarga'] ?? '' ?>">Lihat</a></P>
			<P>Rapor : <a href="../assets/uploads/<?= $dt['rapor'] ?? '' ?>">Lihat</a></P>
			<P>Surat Keterangan Lulus : <a href="../assets/uploads/<?= $dt['surat_keterangan_lulus'] ?? '' ?>">Lihat</a></P>
			<P>Surat Kesehatan :<a href="../assets/uploads/<?= $dt['surat_kesehatan'] ?? '' ?>">Lihat</a></P>
			<P>Foto : <a href="../assets/uploads/<?= $dt['pasfoto'] ?? '' ?>">Lihat</a></P>
			<p>=============================================</p>
		<?php endforeach ?>
	</div>


	<?php include_once __DIR__ . "/../components/layouts/footer.php" ?>

</body>