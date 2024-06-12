# Aplikasi Pengajuan Pembelian Barang - Backend

Aplikasi ini adalah backend untuk sistem pengajuan pembelian barang yang dibangun menggunakan framework CodeIgniter 4. Proyek ini mencakup berbagai fitur dan API untuk mendukung frontend aplikasi.

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur](#fitur)
- [Prasyarat](#prasyarat)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Penggunaan](#penggunaan)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Kontak](#kontak)
  
## Tentang Proyek

Proyek ini adalah aplikasi web untuk mengelola pengajuan pembelian barang. Proyek ini menyediakan berbagai API untuk mendukung fungsi-fungsi pada frontend aplikasi.

## Fitur

1. **Autentikasi dan Otorisasi**
   - Login
   - Middleware untuk proteksi rute
     
2. **Manajemen Pengguna**
   - CRUD pengguna

3. **Manajemen Data**
   - API untuk mengelola data yang dibutuhkan aplikasi

## Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut:

- [PHP](https://www.php.net/) versi 7.3 atau lebih baru
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) atau [MariaDB](https://mariadb.org/)

## Instalasi

Berikut adalah langkah-langkah untuk menginstal proyek ini secara lokal.

1. Clone repository ini:

   ```bash
   git clone https://github.com/ramaleksana/Pengajuan-Pembelian-Barang-Backend.git
   ```

2. Masuk ke direktori proyek:

   ```bash
   cd Pengajuan-Pembelian-Barang-Backend
   ```

3. Instal dependensi menggunakan Composer:

   ```bash
   composer install
   ```
   
4. Salin file .env.example menjadi .env dan sesuaikan konfigurasi yang diperlukan:
   ```bash
   cp .env.example .env
   ```

## Konfigurasi

1. Sesuaikan konfigurasi database pada file .env:
   ```plaintext
     database.default.hostname = localhost
     database.default.database = nama_database
     database.default.username = nama_pengguna
     database.default.password = kata_sandi
     database.default.DBDriver = MySQLi
   ```

2. Tambahkan konfigurasi untuk JWT pada file .env:
   ```plaintext
   JWT_SECRET_KEY = your_secret_key
   JWT_TTL = 60
   ```

3. Generate kunci enkripsi aplikasi:
   ```bash
   php spark key:generate
   ```
4. Migrasi dan seed database:
   ```bash
   php spark migrate
   php spark db:seed
   ```
## Penggunaan

Berikut adalah langkah-langkah untuk menjalankan proyek ini secara lokal.

1. Jalankan server pengembangan:

   ```bash
   php spark serve
   ```
2. Aplikasi akan berjalan di http://localhost:8080.

## Teknologi yang Digunakan

- [CodeIgniter 4](https://codeigniter.com/)
- [PHP](https://www.php.net/) versi 7.3 atau lebih baru
- [Composer](https://getcomposer.org/)
  
## Dependensi
- [Firebase/PHP-JWT](https://github.com/firebase/php-jwt)

## Kontak
- ramaleksana@gmail.com
- https://github.com/ramaleksana/Pengajuan-Pembelian-Barang-Frontend
