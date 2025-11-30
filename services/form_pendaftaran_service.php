<?php
require_once __DIR__ . "/../db_conn.php";
require_once __DIR__ . "/../config.php";

/**
 * Fungsi untuk menambahkan data ke dalam tabel form pendaftaran
 * 
 * Fungsi ini juga menangani jika folder untuk menyimpan file-file upload
 * belum tersedia. Jika folder belum tersedia, maka folder untuk menyimpan
 * file-file upload akan secara otomatis dibuat.
 * 
 * Data-data yang dilewatkan ke parameter-parameter dibawah ini harus sudah
 * dalam keadaan divalidasi!
 * 
 * @param string $idCalonSiswa - ID dari pendaftar
 * @param string $idJurusan - ID Jurusan yang dipilih oleh pendaftar
 * @param string $idProgram - ID Program yang dipilih oleh pendaftar
 * @param string $namaLengkap - Nama lengkap pendaftar
 * @param int $nik - NIK pendaftar
 * @param string $jenisKelamin - Jenis kelamin pendaftar
 * @param string $tempatLahir - Tempat lahir pendaftar
 * @param string $tanggalLahir - Tanggal lahir pendaftar
 * @param string $asalSekolah - Asal sekolah pendaftar
 * @param string $persetujuanAsrama - Persetujuan asrama yang disetujui oleh pendaftar
 * @param string $persetujuanHp - Persetujuan tidak membawa HP yang disetujui oleh pendaftar
 * @param array $files - File-file yang diupload oleh pendaftar
 */
function tambahFormPendaftaranService(

    string $idCalonSiswa,
    string $idJurusan,
    string $idProgram,
    string $namaLengkap,
    int $nik,
    string $jenisKelamin,
    string $tempatLahir,
    string $tanggalLahir,
    string $asalSekolah,
    string $persetujuanAsrama,
    string $persetujuanHp,
    array $files,
) {
    try {
        // memasukkan data ke dalam database selain file
        $stmt = DBH->prepare(
            "INSERT INTO
                form_pendaftaran
                (
                    id_calon_siswa,
                    id_jurusan,
                    id_program,
                    nama_lengkap,
                    nik,
                    jenis_kelamin,
                    tempat_lahir,
                    tanggal_lahir,
                    asal_sekolah,
                    persetujuan_tidak_membawa_hp,
                    persetujuan_asrama
                )
            VALUES
                (
                    :id_calon_siswa,
                    :id_jurusan,
                    :id_program,
                    :nama_lengkap,
                    :nik,
                    :jenis_kelamin,
                    :tempat_lahir,
                    :tanggal_lahir,
                    :asal_sekolah,
                    :persetujuan_tidak_membawa_hp,
                    :persetujuan_asrama
                )"
        );

        $stmt->execute([
            ":id_calon_siswa" => $idCalonSiswa,
            ":id_jurusan" => $idJurusan,
            ":id_program" => $idProgram,
            ":nama_lengkap" => $namaLengkap,
            ":nik" => $nik,
            ":jenis_kelamin" => $jenisKelamin,
            ":tempat_lahir" => $tempatLahir,
            ":tanggal_lahir" => $tanggalLahir,
            ":asal_sekolah" => $asalSekolah,
            ":persetujuan_tidak_membawa_hp" => $persetujuanHp,
            ":persetujuan_asrama" => $persetujuanAsrama
        ]);

        // mengambil id dari data yang baru dimasukkan
        $idFormPendaftaranBaru = DBH->lastInsertId();

        // path dari folder upload
        $pathUpload = __DIR__ . "/../assets/uploads/";

        // membuat folder upload jika belum tersedia
        if (!is_dir($pathUpload)) {
            $hasil = mkdir($pathUpload, 0755, true);

            if (!$hasil) {
                die("Fatal Error: Gagal membuat folder upload");
            }
        } else if (is_writable($pathUpload)) {
            die("Fatal Error: Folder upload tidak dapat ditulis");
        }

        // melakukan proses pemindahan untuk setiap file yang diupload
        foreach ($files as $namaKey => $file) {
            $idJenisDokumen = $file["id-jenis-dokumen"];
            $file = $file["file"];

            $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);
            $filename = str_replace("-", "_", $namaKey) . "_" . time() . "." . $fileExt;

            move_uploaded_file($file["tmp_name"], $pathUpload . $filename);

            // memasukkan path file ke dalam database
            $stmt = DBH->prepare(
                "INSERT INTO
                    dokumen
                    (
                        id_jenis_dokumen,
                        id_form_pendaftaran,
                        path_dokumen
                    )
                VALUES
                    (
                        :id_jenis_dokumen,
                        :id_form_pendaftaran,
                        :path_dokumen
                    )"
            );

            $stmt->execute([
                ":id_jenis_dokumen" => $idJenisDokumen,
                ":id_form_pendaftaran" => $idFormPendaftaranBaru,
                ":path_dokumen" => $filename
            ]);
        }

        header("Location: " . BASE_URL . "calon_siswa/riwayat_pendaftaran.php");
        exit();
    } catch (Exception $error) {
        var_dump($error->getMessage());
        die();
    }
}

/**
 * Fungsi untuk mendapatkan semua data dari tabel form pendaftaran
 * 
 * @param string $namaCalonSiswa - Nama dari pendaftar
 */
function daftarFormPendaftaranService(string $namaCalonSiswa)
{
    try {
        // 
    } catch (Exception $error) {
        // 
    }
}

/**
 * Fungsi untuk mendapatkan data spesifik dari tabel form pendaftaran
 * berdasarkan ID-nya
 * 
 * @param int $id - ID data dari tabel form pendaftaran
 */
function detailFormPendaftaranService(int $id)
{
    try {
        // 
    } catch (Exception $error) {
        // 
    }
}

/**
 * Fungsi untuk memperbarui data spesifik dari tabel form pendaftaran
 * berdasarkan ID-nya
 * 
 * @param array $data - Data baru yang telah tervalidasi
 * @param int $id - ID data dari tabel form pendaftaran
 */
function suntingFormPendaftaranService(array $data, int $id)
{
    try {
        // 
    } catch (Exception $error) {
        // 
    }
}

/**
 * Fungsi untuk menghapus data spesifik dari tabel form pendaftaran
 * berdasarkan ID-nya
 * 
 * @param int $id - ID data dari tabel form pendaftaran
 */
function hapusFormPendaftaranService(int $id)
{
    try {
        // 
    } catch (Exception $error) {
        //
    }
}

/**
 * Fungsi untuk menampilkan riwayat pendaftaran dari pendaftar
 * 
 * @param int $idCalonSiswa - ID dari calon siswa
 */
function daftarRiwayatPendaftaran(int $idCalonSiswa)
{
    try {
        // 
    } catch (Exception $error) {
        // 
    }
}
