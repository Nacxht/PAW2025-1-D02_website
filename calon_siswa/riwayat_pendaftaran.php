<?php
require_once __DIR__ . "/../auth_middleware/before_login_middleware.php";
require_once __DIR__ . '/../services/form_pendaftaran_service.php';
require_once __DIR__ . "/../config.php";

$daftarRiwayatFormPendaftaran = daftarRiwayatPendaftaran($_SESSION["id_user"]);
?>

<!DOCTYPE html>
<html>

<head>
	<?php include_once __DIR__ . "/../components/layouts/meta_title.php" ?>

	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/main.css" ?>">
	<link rel="stylesheet" href="<?= BASE_URL . "assets/css/calon_siswa.css" ?>">
</head>

<body>
	<?php include_once __DIR__ . "/../components/layouts/navbar.php" ?>

	<div class="container" id="calon-siswa-riwayat-pendaftaran">
		<h1>
			Riwayat Pendaftaran Anda
		</h1>

		<hr class="divider">

		<div class="riwayat-container">
			<?php if ($daftarRiwayatFormPendaftaran): ?>
				<?php foreach ($daftarRiwayatFormPendaftaran as $data): ?>
					<?php $dokumenUpload = daftarRiwayatUploadDokumen($data["id_form_pendaftaran"]) ?>

					<table>
						<?php foreach ($data as $namaKey => $nilai): ?>
							<?php
							$namaBaris = ucwords(str_replace("_", " ", $namaKey));
							$namaKelasStatus = "";

							if ($namaKey == "status") {
								$namaKelasStatus = $nilai;
							}

							if ($namaKey == "id_form_pendaftaran") {
								continue;
							}
							?>

							<tr>
								<th>
									<?= $namaBaris ?>
								</th>

								<td>:</td>

								<td class="<?= $namaKelasStatus ?? "" ?>">
									<?php
									switch ($namaKey) {
										case "jenis_kelamin":
											echo $nilai == "P" ? "Perempuan" : "Laki-Laki";
											break;

										case "persetujuan_tidak_membawa_hp":
											echo $nilai == "true" ? "Setuju" : "Tidak Setuju";
											break;

										case "persetujuan_asrama":
											echo $nilai == "true" ? "Setuju" : "Tidak Setuju";
											break;

										default:
											echo ucwords($nilai);
											break;
									}
									?>
								</td>
							</tr>
						<?php endforeach ?>

						<?php foreach ($dokumenUpload as $dokumen): ?>
							<?php $namaBaris = ucfirst(str_replace("_", " ", $dokumen["jenis_dokumen"])) ?>

							<tr>
								<th>
									<?= $namaBaris ?>
								</th>

								<td>:</td>

								<td>
									<a href="<?= BASE_URL . "assets/uploads/" . $dokumen["path_dokumen"] ?>" target="__blank">
										Klik disini untuk melihat gambar
									</a>
								</td>
							</tr>
						<?php endforeach ?>
					</table>
				<?php endforeach ?>
			<?php else: ?>
				<div class="riwayat-card">
					<!--  -->
				</div>
			<?php endif ?>
		</div>
	</div>


	<?php include_once __DIR__ . "/../components/layouts/footer.php" ?>
</body>