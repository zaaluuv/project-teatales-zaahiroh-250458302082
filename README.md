<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TeaTales+ (Platform Berbagi Cerita Reflektif)

TeaTales+ adalah sebuah platform komunitas berbasis web yang dirancang sebagai ruang aman dan nyaman bagi pengguna untuk mempublikasikan, membaca, dan berinteraksi dengan tulisan-tulisan reflektif, kutipan inspiratif, dan cerita kehidupan yang bermakna. Mengusung konsep Medium-lite, aplikasi ini fokus pada pengalaman membaca yang bersih dan interaksi yang positif.

## FITUR UTAMA

Fitur Publik (Frontend)
- Landing Page Dinamis: Menampilkan kutipan acak (Random Quote) dan navigasi responsif.
- Explore & Search: Jelajahi cerita berdasarkan kategori atau cari topik spesifik secara real-time.
- Baca Cerita (Story Detail): Tampilan artikel yang nyaman dengan estimasi waktu baca dan view counter.
- Interaksi Pengguna:
  Like: Apresiasi tulisan favorit.
  Komentar: Diskusi interaktif di setiap cerita.
  Favorite/Bookmark: Simpan cerita untuk dibaca nanti.
  Re-share: Bagikan ulang postingan menarik ke profil sendiri (seperti Retweet).
  Share: Salin tautan untuk membagikan ke media sosial eksternal.
- Profil Pengguna: Halaman profil personal dengan tab Postingan Asli, Re-share, dan Bio.
- Follow System: Ikuti penulis favorit agar tidak ketinggalan cerita terbaru mereka.

Fitur Member (Penulis)
- Tulis Cerita: Editor teks kaya (Rich Text Editor via CKEditor) untuk menulis cerita panjang.
- Draft & Auto-Save: Tulisan otomatis tersimpan sebagai draf sebelum dipublikasikan.
- Manajemen Profil: Edit foto profil, nama, dan bio.

Fitur Admin (Backend)
- Dashboard Eksklusif (Filament V3): Panel admin modern dan responsif.
- Moderasi Konten: Hapus atau sembunyikan postingan yang melanggar aturan.
- Manajemen Pengguna: Lihat daftar pengguna, blokir akun, atau ubah peran (role).
- Manajemen Kategori & Quotes: Tambah/Edit/Hapus kategori cerita dan kutipan harian.

## Teknologi yang Digunakan
Aplikasi ini dibangun dengan arsitektur Monolith Modern menggunakan ekosistem Laravel terbaru:
- Backend Framework: Laravel 12
- Frontend Interactivity: Laravel Livewire 3
- Styling: Tailwind CSS
- Admin Panel: Filament V3
- Authentication: Laravel Breeze
- Database: MySQL 8.0+

## Cara Instalasi (Local Development)
Ikuti langkah-langkah ini untuk menjalankan proyek di komputer lokal Anda.

PRASYARAT
Pastikan Anda sudah menginstal:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / MariaDB

Langkah-langkah
- Clone Repositori
  git clone [https://github.com/username-anda/teatales.git](https://github.com/username-anda/teatales.git)
  cd teatales

- Install Dependensi PHP & JS
  composer install
  npm install

- Setup Environment
  Salin file .env.example menjadi .env:
      cp .env.example .env

  Buka file .env dan sesuaikan konfigurasi database Anda:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_teatales
    DB_USERNAME=root
    DB_PASSWORD=

- Generate App Key
  php artisan key:generate

- Setup Storage Link (Wajib agar gambar profil/postingan muncul)
  php artisan storage:link

- Migrasi Database & Seeder
  Jalankan migrasi dan isi data awal (termasuk akun Admin):
    php artisan migrate:fresh --seed

  Jalankan Aplikasi
  Buka dua terminal terpisah:
    Terminal 1 (Jalankan Vite untuk aset frontend):
    npm run dev

    Terminal 2 (Jalankan Server Laravel):
    php artisan serve

- Akses Aplikasi
  Frontend (User): Buka http://127.0.0.1:8000
  Backend (Admin): Buka http://127.0.0.1:8000/admin

## Akun Demo (Default Seeder)

Jika Anda menjalankan php artisan db:seed, gunakan akun berikut untuk login:
- Role
  Admin

      Email
      adminteatales@gmail.com

      Password
      password

- User Biasa
(Daftar sendiri via Register)

(Password Sesuai input)


## Struktur Folder Penting

app/Filament/Resources : Logika CRUD Admin Panel (Post, User, Category).

app/Livewire : Logika komponen interaktif (LikeButton, PostForm, dll).

resources/views/livewire : Tampilan (View) komponen Livewire.

resources/views/welcome.blade.php : Landing Page utama.

routes/web.php : Definisi rute aplikasi web.


## Kontribusi

Proyek ini dikembangkan untuk tujuan pembelajaran. Jika Anda ingin berkontribusi:

Fork repositori ini.

Buat branch fitur baru (git checkout -b fitur-keren).

Commit perubahan Anda (git commit -m 'Menambahkan fitur keren').

Push ke branch (git push origin fitur-keren).

Buat Pull Request.
