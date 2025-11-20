<?php  
require_once __DIR__ . '/../validators/form_pendaftaran_validator.php';
if(isset($_POST['submit'])){
	$nama_lengkap = $_POST['nama_lengkap'];
	$nik = $_POST['nik'];
	$jenis_kelamin = $_POST['jenis_kelamin'];
	$tempat_lahir = $_POST['tempat_lahir'];
	$tanggal_lahir = $_POST['tanggal_lahir'];
	$asal_sekolah = $_POST['asal_sekolah'];
	$akta_kelahiran = $_FILES['akta_kelahiran'] ?? null;
	$kartu_keluarga = $_FILES['kartu_keluarga'] ?? null ;
	$rapor = $_FILES['rapor'] ?? null;
	$surat_keterangan_lulus = $_FILES['surat_keterangan_lulus'] ?? null;
	$surat_kesehatan = $_FILES['surat_kesehatan'] ?? null;
	$pasfoto = $_FILES['pasfoto'] ?? null;
	$persetujuan_asrama = isset($_POST['persetujuan_asrama']) ? 1:0;
	$persetujuan_tidak_membawa_hp = isset($_POST['persetujuan_tidak_membawa_hp']) ? 1:0;
}

?>
<form method="POST" enctype="multipart/form-data">
	<p><label id="nama_lengkap">nama_lengkap : </label><input type="text" name="nama_lengkap" value="<?= $nama_lengkap ?? '' ?>"><div class="error-val"></div></p>
	<p><label id="nik">nik : </label><input type="text" name="nik" value="<?= $nik ?? '' ?>"><div class="error-val"></div></p>
	<p><label id="jenis_kelamin">jenis_kelamin : </label><input type="text" name="jenis_kelamin" value="<?= $jenis_kelamin ?? ''?>"><div class="error-val"></div></p>
	<p><label id="tempat_lahir">tempat_lahir : </label><input type="text" name="tempat_lahir" value="<?= $tempat_lahir ?? ''?>"><div class="error-val"></div></p>
	<p><label id="tanggal_lahir">tanggal_lahir : </label><input type="date" name="tanggal_lahir" value="<?= $tanggal_lahir?>"><div class="error-val"></div></p>
	<p><label id="asal_sekolah">asal_sekolah : </label><input type="text" name="asal_sekolah" value="<?=$asal_sekolah?>"><div class="error-val"></div></p>
	<p><label id="akta_kelahiran">akta_kelahiran : </label><input type="file" name="akta_kelahiran" value="<?=$akta_kelahiran ?? ''?>"><div class="error-val"></div></p>
	<p><label id="kartu_keluarga">kartu_keluarga : </label><input type="file" name="kartu_keluarga" value="<?= $kartu_keluarga ?? ''?>"><div class="error-val"></div></p>
	<p><label id="rapor">rapor : </label><input type="file" name="rapor" value="<?=$rapor ?? ''?>"><div class="error-val"></div></p>
	<p><label id="surat_keterangan_lulus">surat_keterangan_lulus : </label><input type="file" name="surat_keterangan_lulus" value="<?= $surat_keterangan_lulus ?? ''?> "><div class="error-val"></div></p>
	<p><label id="surat_kesehatan">surat_kesehatan : </label><input type="file" name="surat_kesehatan" value="<?=$surat_kesehatan ?? ''?>"><div class="error-val"></div></p>
	<p><label id="pasfoto">pasfoto : </label><input type="file" name="pasfoto" value="<?=$pasfoto ?? ''?>"><div class="error-val"></div></p>
	<p><label id="persetujuan_asrama">persetujuan_asrama : </label><input type="checkbox" name="persetujuan_asrama" value="<?=$persetujuan_asrama ?? ''?>"><div class="error-val"></div></p>
	<p><label id="persetujuan_tidak_membawa_hp">persetujuan_tidak_membawa_hp : </label><input type="checkbox" name="persetujuan_tidak_membawa_hp" value="<?=$persetujuan_tidak_membawa_hp ?? ''?>"><div class="error-val"></div></p>
	<p><button type="submit" name="submit">Daftar</button></p>
</form>