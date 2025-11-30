# Todo:

- Memberi komentar ke setiap utilities/fungsi/kode yang sekiranya perlu diberi fungsi
- Mencari elemen tambahan untuk form pendaftaran
- Menambahkan anti XSS ke setiap form yang sekiranya diperlukan
- Jika sempat memberikan notifikasi/pemberitahuan ketika suatu proses bisnis berhasil dieksekusi
- Memberikan title ke setiap halaman

- validasi
    - Menambahkan panjang maksimal untuk username
    - Menambahkan validasi kombinasi untuk password
    

- admin
    - Membuat sidebar admin
    - Membuat dashboard admin
    - Menyambungkan halaman profil dengan admin
    - Membuat pengelolaan akun
        - Melihat daftar akun
        - Menyunting akun
        - Menghapus akun (hanya berlaku jika calon siswa)
    - Membuat pengelolaan form pendaftaran
        - Melihat daftar form pendaftaran
        - Menghapus form pendaftaran
        - Memverifikasi form pendaftaran
        - Mengelola dokumen yang diupload
            - Melihat daftar dokumen yang diupload
            - Menghapus dokumen yang diupload
    - Membuat pengelolaan jenis dokumen
        - Melihat daftar jenis dokumen
        - Menambah jenis dokumen
        - Menyunting jenis dokumen
        - Menghapus jenis dokumen
    - Membuat pengelolaan jurusan
        - Melihat daftar jurusan
        - Menambah daftar jurusan
        - Menyunting daftar jurusan
        - Menghapus daftar jurusan

- calon siswa
    - Membuat halaman index
    - Styling halaman index

- Last step
    - Memvalidasi setiap halaman di website https://validator.w3.org/
    - Melakukan unit-testing ke setiap halaman website/fitur/form.

# Pembagian Tugas

- Bersama-sama:
    - Penentuan fitur-fitur yang diperlukan
    - Perancangan use-case
    - Perancangan form-form kasaran (menyesuaikan dari use-case)
    - Perancangan CDM & PDM
    - Menentukan aturan penulisan kode
        - Penulisan file menggunakan snake_case
        - Penulisan fungsi & variabel menggunakan camelCase
        - Penulisan key associative array menggunakan snake_case
- Anggota 1 - Wildan Haydar Amru:
    - Menyusun struktur direktori proyek & file kosongannya
    - Validasi & proses bisnis fitur register
    - Middleware autentikasi dan logout
    - Proses logout
    - Mengatur styling & struktur HTML dari keseluruhan halaman website (Frontend)
- Anggota 2 - Ahmad Soleh Majid:
    - Validasi & proses bisnis fitur register
    - Validasi & proses bisnis fitur pendaftaran
    - Validasi & proses bisnis fitur riwayat pendaftaran