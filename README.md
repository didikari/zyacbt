# ZYA CBT (Computer Based Test)

ZYA CBT adalah aplikasi Ujian Online Berbasis Komputer (Computer Based Test) yang ringan, cepat, dan mudah digunakan. Aplikasi ini dibangun di atas framework PHP CodeIgniter 3 dan sangat cocok digunakan oleh institusi pendidikan (sekolah/kampus) atau lembaga bimbingan belajar untuk menyelenggarakan ujian mandiri secara lokal maupun online.

---

## Prasyarat Sistem (Prerequisites)

Sebelum melakukan instalasi, pastikan server atau lingkungan lokal Anda memenuhi persyaratan berikut:

- **Web Server:** Apache atau Nginx (dengan modul `mod_rewrite` diaktifkan).
- **PHP:** Versi 7.4 hingga PHP 8.2 (direkomendasikan PHP 7.4 atau PHP 8.0/8.1 demi kompatibilitas penuh pustaka PHPExcel bawaan).
- **Database:** MySQL atau MariaDB.
- **Ekstensi PHP:**
  - `mysqli`
  - `gd` (untuk ckeditor/rendering gambar)
  - `zip` & `xml` (untuk export/import soal spreadsheet)
  - `mbstring`

---

## Langkah-Langkah Instalasi

Ikuti langkah-langkah di bawah ini untuk memasang ZYA CBT pada komputer lokal Anda (menggunakan XAMPP/Laragon/MAMP) atau web server hosting:

### 1. Salin Berkas Aplikasi
Ekstrak atau salin seluruh folder proyek `zyacbtpublic` ke direktori web server Anda:
- **XAMPP (Windows):** `C:\xampp\htdocs\zyacbtpublic`
- **Laragon (Windows):** `C:\laragon\www\zyacbtpublic`
- **Linux (Apache):** `/var/www/html/zyacbtpublic`
- **macOS (MAMP):** `/Applications/MAMP/htdocs/zyacbtpublic`

### 2. Import Database
1. Buka database manager Anda (misalnya **phpMyAdmin** lewat alamat `http://localhost/phpmyadmin`).
2. Buat database baru dengan nama `zyacbtpublic` (atau nama lain pilihan Anda).
3. Import salah satu file SQL yang berada di folder root proyek:
   - **`zyacbt-public-2024-05-05-dengan-database.sql`** (Direkomendasikan: berisi struktur tabel beserta contoh data grup, peserta, dan modul soal uji coba).
   - **`zyacbt-public-2024-05-05-tanpa-database.sql`** (Berisi struktur tabel kosong siap pakai).

### 3. Konfigurasi Database
Buka file konfigurasi database yang terletak di:
`[root_aplikasi]/application/config/database.php`

Sesuaikan parameter koneksi database Anda (biasanya pada baris ke-76):
```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',      // Sesuaikan username database Anda
	'password' => 'password',  // Sesuaikan password database Anda (kosongkan jika tanpa password)
	'database' => 'zyacbtpublic', // Nama database yang Anda buat di Langkah 2
	'dbdriver' => 'mysqli',
    // ...
);
```

### 4. Konfigurasi URL Aplikasi (Opsional)
Aplikasi ini sudah dilengkapi dengan pendeteksi domain otomatis pada berkas `application/config/config.php`. Namun, jika Anda ingin menyetel alamat secara statis, Anda dapat mengubah parameter `$config['base_url']`:
```php
$config['base_url'] = 'http://localhost/zyacbtpublic/';
```

---

## Akses Akun & Login Bawaan (Default Credentials)

Setelah instalasi selesai, buka browser Anda dan akses alamat berikut:

### A. Panel Ujian Peserta (Siswa)
- **Alamat URL:** `http://localhost/zyacbtpublic/`
- **Akun Demo Siswa:**
  - Username: `lutfi` | Password: `lutfi`
  - Username: `joko` | Password: `joko`

### B. Panel Administrasi / Operator
- **Alamat URL:** `http://localhost/zyacbtpublic/index.php/manager`
- **Akun Default Admin:**
  - Username: `admin` | Password: `admin`
  - Username: `operator` | Password: `operator`

> [!IMPORTANT]
> Demi keamanan, **SEGERA** ubah password default `admin` dan `operator` melalui menu **Pengaturan User** setelah Anda pertama kali berhasil login di panel administrasi.

---

## Fitur Utama

- **Import Soal Praktis:** Mendukung import soal secara massal menggunakan file Excel/Spreadsheet dan dokumen Microsoft Word.
- **Tipe Soal Beragam:** Pilihan Ganda (Single & Multiple Answers), Jawaban Singkat, Menjodohkan, dan Soal Essay.
- **Exam Browser Lock:** Fitur penguncian browser mobile (Exam Browser/Xambro) agar peserta tidak bisa keluar dari aplikasi ujian.
- **Manajemen Kartu Ujian:** Generate dan cetak kartu ujian peserta secara otomatis langsung dari dasbor admin.
- **Keamanan Terkini:** Menggunakan Bcrypt hashing untuk akun admin, enkripsi simetris (AES-256) untuk password peserta, penanganan cookies aman (HttpOnly), serta pencegahan SQL Injection dengan Query Bindings.
