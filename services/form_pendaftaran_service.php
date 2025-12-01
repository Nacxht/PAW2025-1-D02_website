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
            ":id_calon_siswa" => htmlspecialchars($idCalonSiswa),
            ":id_jurusan" => htmlspecialchars($idJurusan),
            ":id_program" => htmlspecialchars($idProgram),
            ":nama_lengkap" => htmlspecialchars($namaLengkap),
            ":nik" => htmlspecialchars($nik),
            ":jenis_kelamin" => htmlspecialchars($jenisKelamin),
            ":tempat_lahir" => htmlspecialchars($tempatLahir),
            ":tanggal_lahir" => htmlspecialchars($tanggalLahir),
            ":asal_sekolah" => htmlspecialchars($asalSekolah),
            ":persetujuan_tidak_membawa_hp" => htmlspecialchars($persetujuanHp),
            ":persetujuan_asrama" => htmlspecialchars($persetujuanAsrama)
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
        die("Terdapat masalah pada server");
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
        die("Terdapat masalah pada server");
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
        die("Terdapat masalah pada server");
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
        die("Terdapat masalah pada server");
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
        die("Terdapat masalah pada server");
    }
}

/**
 * Fungsi untuk menampilkan riwayat pendaftaran dari pendaftar
 * 
 * Fungsi ini tidak mengembalikan informasi dari dokumen yang diupload,
 * hal ini terjadi dikarenakan tidak memungkinkan.
 * 
 * @param int $idCalonSiswa - ID dari calon siswa
 */
function daftarRiwayatPendaftaran(int $idCalonSiswa)
{
    try {
        $stmt = DBH->prepare(
            "SELECT
                fp.id_form_pendaftaran,
                fp.nama_lengkap,
                fp.nik,
                fp.jenis_kelamin,
                fp.tempat_lahir,
                fp.tanggal_lahir,
                fp.asal_sekolah,
                fp.persetujuan_tidak_membawa_hp,
                fp.persetujuan_asrama,
                date(fp.created_at) tanggal_pendaftaran,
                j.nama_jurusan,
                p.nama_program,
                fp.status
            FROM
                form_pendaftaran fp
            JOIN
                jurusan j ON fp.id_jurusan = j.id_jurusan
            JOIN
                program p ON fp.id_program = p.id_program
            WHERE
                fp.id_calon_siswa = :id_calon_siswa"
        );

        $stmt->execute([":id_calon_siswa" => $idCalonSiswa]);
        return $stmt->fetchAll();
        exit();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}

/**
 * Fungsi untuk menampilkan daftar dokumen yang diupload berdasarkan
 * ID dari form pendaftaran
 * 
 * @param int $idFormPendaftaran - ID dari form pendaftaran
 */
function daftarRiwayatUploadDokumen(int $idFormPendaftaran)
{
    try {
        $stmt = DBH->prepare(
            "SELECT
                d.id_dokumen,
                d.path_dokumen,
                jd.jenis_dokumen
            FROM 
                dokumen d
            INNER JOIN
                jenis_dokumen jd ON d.id_jenis_dokumen = jd.id_jenis_dokumen
            WHERE d.id_form_pendaftaran = :id_form_pendaftaran"
        );

        $stmt->execute([
            ":id_form_pendaftaran" => $idFormPendaftaran
        ]);

        return $stmt->fetchAll();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}
