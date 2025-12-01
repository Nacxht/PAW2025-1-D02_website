<?php
// Memasukkan file-file yang diperlukan
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
        // Query untuk memasukkan data (selain file)
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

        // Mengeksekusi query
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

        // Mengambil id dari data yang terakhir kali dimasukkan
        $idFormPendaftaranBaru = DBH->lastInsertId();

        // Path atau jalur dari folder untuk menyimpan file upload
        $pathUpload = __DIR__ . "/../assets/uploads/";

        // Membuat folder upload jika belum tersedia
        if (!is_dir($pathUpload)) {
            $hasil = mkdir($pathUpload, 0755, true);

            if (!$hasil) {
                die("Fatal Error: Gagal membuat folder upload");
            }
        } else if (is_writable($pathUpload)) {
            die("Fatal Error: Folder upload tidak dapat ditulis");
        }

        // Melakukan proses pemindahan untuk setiap file yang diupload
        foreach ($files as $namaKey => $file) {
            // Mendapatkan ID jenis dokumen
            $idJenisDokumen = $file["id-jenis-dokumen"];

            // Mendapatkan array assosiatif dari $_FILES
            $file = $file["file"];

            // Mendapatkan ekstensi file yang diunggah
            $fileExt = pathinfo($file["name"], PATHINFO_EXTENSION);

            // Membuat nama baru untuk file yang diupload
            $filename = str_replace("-", "_", $namaKey) . "_" . time() . "." . $fileExt;

            // Memindahkan file yang diupload dari folder sementara ke folder upload
            move_uploaded_file($file["tmp_name"], $pathUpload . $filename);

            // Query untuk memasukkan path file ke dalam database
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

            // Mengeksekusi query
            $stmt->execute([
                ":id_jenis_dokumen" => $idJenisDokumen,
                ":id_form_pendaftaran" => $idFormPendaftaranBaru,
                ":path_dokumen" => $filename
            ]);
        }

        // Mengarahkan user ke halaman riwayat pendaftaran ketika berhasil mendaftar
        header("Location: " . BASE_URL . "calon_siswa/riwayat_pendaftaran.php");
        exit();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}

/**
 * Fungsi untuk mendapatkan semua data dari tabel form pendaftaran.
 */
function daftarFormPendaftaranService()
{
    try {
        /**
         * Query untuk menampilkan semua data dari tabel form pendaftaran.
         * 
         * Query ini melakukan dua kali join, untuk menampilkan nama program,
         * dan nama jurusan.
         * 
         * Pada kolom created_at diubah namanya menjadi tanggal_pendaftaran,
         * dan diubah formatnya menjadi tanggal (tanpa waktu).
         */
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
                program p ON fp.id_program = p.id_program"
        );

        // mengeksekusi query
        $stmt->execute();
        return $stmt->fetchAll();
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
        // Query untuk mendapatkan data spesifik dari tabel form pendaftaran
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
                fp.id_form_pendaftaran = :id_form_pendaftaran"
        );

        // Mengeksekusi query
        $stmt->execute([":id_form_pendaftaran" => $id]);
        return $stmt->fetch();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}

/**
 * Fungsi untuk memperbarui status (verifikasi) dari form pendaftaran
 * berdasarkan ID nya.
 * 
 * @param string $status - Status setelah diverifikasi & divalidasi (diterima / ditolak).
 * @param int $id - ID data dari tabel form pendaftaran
 */
function verifikasiFormPendaftaran(string $status, int $id)
{
    try {
        // Query untuk memperbarui status form pendaftaran
        $stmt = DBH->prepare(
            "UPDATE
                form_pendaftaran
            SET
                status = :status
            WHERE id_form_pendaftaran = :id_form_pendaftaran"
        );

        // Mengeksekusi query
        $stmt->execute([
            ":status" => $status,
            ":id_form_pendaftaran" => $id
        ]);
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
 * Perbedaan fungsi ini dengan service "daftarFormPendaftaranService" adalah,
 * fungsi ini mengembalikan daftar form pendaftaran berdasarkan ID milik
 * calon siswa.
 * 
 * @param int $idCalonSiswa - ID dari calon siswa
 */
function daftarRiwayatPendaftaranService(int $idCalonSiswa)
{
    try {
        // Query untuk menampilkan daftar riwayat pendaftaran suatu calon siswa
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

        // Mengeksekusi query
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
        // Menampilkan daftar dokumen yang diupload berdasarkan ID milik form pendaftaran
        $stmt = DBH->prepare(
            "SELECT
                d.id_dokumen,
                d.path_dokumen,
                jd.jenis_dokumen
            FROM 
                dokumen d
            JOIN
                jenis_dokumen jd ON d.id_jenis_dokumen = jd.id_jenis_dokumen
            WHERE d.id_form_pendaftaran = :id_form_pendaftaran"
        );

        // Mengeksekusi query
        $stmt->execute([
            ":id_form_pendaftaran" => $idFormPendaftaran
        ]);

        return $stmt->fetchAll();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}

/**
 * Fungsi untuk mendapatkan jumlah form pendaftaran (jumlah pendaftar)
 */
function jumlahPendaftarService()
{
    try {
        // Query untuk mendapatkan semua data
        $stmt = DBH->prepare(
            "SELECT
                id_form_pendaftaran
            FROM
                form_pendaftaran"
        );

        // Mengeksekusi query
        $stmt->execute();

        // Mengembalikan jumlah baris
        return $stmt->rowCount();
    } catch (Exception $error) {
        die("Terdapat masalah pada server");
    }
}
