# BlogBilal

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.0-38B2AC?style=for-the-badge&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)

**BlogBilal** adalah aplikasi web Sistem Informasi Blog sederhana yang dibangun menggunakan framework Laravel. Proyek ini dikembangkan sebagai syarat pemenuhan tugas **Ujian Akhir Semester (UAS) Mata Kuliah Pemrograman Internet**.

Aplikasi ini memungkinkan penulis untuk mempublikasikan artikel dan pengunjung untuk membaca serta menyukai (like) artikel tersebut.

## 🌟 Fitur Utama

1. **Halaman Publik (Public View)**
   - Desain responsif dan modern menggunakan Tailwind CSS.
   - Menampilkan daftar artikel terbaru.
   - Detail artikel dengan estimasi waktu baca.

2. **Autentikasi Pengguna**
   - Sistem Login dan Register untuk pengguna.
   - Proteksi rute (Route Protection) untuk fitur khusus member.

3. **Manajemen Konten (Dashboard)**
   - CRUD (Create, Read, Update, Delete) Artikel.
   - Upload gambar fitur (Featured Image) untuk setiap artikel.

4. **Interaksi Pembaca**
   - **Fitur Like**: Pengguna yang login dapat menyukai artikel.
   - **Profil Penulis**: Integrasi tombol link ke Instagram penulis.

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 11 Framework
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL
- **Assets Management**: Vite

## 🚀 Cara Instalasi (Installation)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek ini di komputer lokal (Localhost):

### 1. Clone Repository
Pastikan Git sudah terinstall, lalu jalankan perintah:
```bash
git clone [https://github.com/ALastkiss/basicblog.git](https://github.com/ALastkiss/basicblog.git)
cd basicblog
# 2. Install dependensi PHP & JavaScript
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env

# Edit file .env dan sesuaikan database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=

# 4. Generate application key
php artisan key:generate

# 5. Migrasi database
php artisan migrate

# 6. Buat symbolic link storage
php artisan storage:link

# 7. Jalankan aplikasi (gunakan 2 terminal)
npm run dev
php artisan serve

