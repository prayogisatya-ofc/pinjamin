# Website Pinjam Buku
Website peminjaman buku sederhana menggunakan Laravel 11.

## Deskripsi
Website ini memungkinkan pengguna untuk meminjam buku dan mengembalikan buku yang telah dipinjam. Website ini juga memiliki fitur untuk mengelola buku dan pengguna.

## Team
1. Prayogi Setiawan as Project Manager
2. Muhammad Rizki as Backend Developer
3. Alif Zulfahmi Yusuf as Backend Developer
4. Ahmad Ubaidilah as Frontend Developer
5. Lisma as Frontend Developer

## Cara Install
1. Clone repository ini ke komputer Anda.
2. Buka terminal dan jalankan perintah `composer install` untuk menginstal dependencies yang dibutuhkan.
3. Copy file `.env.example` menjadi `.env` dan isi dengan konfigurasi database Anda.
4. Jalankan perintah `php artisan migrate` untuk membuat tabel database.
5. Jalankan perintah `php artisan key:generate` untuk membuat key aplikasi.
6. Jalankan perintah `php artisan db:seed` untuk membuat data awal.
6. Jalankan perintah `php artisan db:seed --class=CategorySeeder` untuk membuat data awal kategori.
6. Jalankan perintah `php artisan db:seed --class=SettingSeeder` untuk membuat data awal setting.
7. Jalankan perintah `php artisan storage:link` untuk membuat link storage.
8. Jalankan perintah `php artisan serve` untuk menjalankan web server.
9. Buka browser dan akses website di `http://localhost:8000`.