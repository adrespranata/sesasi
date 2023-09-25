# Dokumentasi Tugas Aplikasi Catatan (Notes App)

Ini adalah dokumentasi untuk tugas aplikasi "Catatan" yang mencakup berbagai aspek seperti penggunaan, instalasi, rute, endpoint, dan penjelasan singkat tentang aplikasi ini.

## Deskripsi Proyek

Aplikasi "Catatan" adalah sebuah aplikasi sederhana untuk mencatat dan mengelola catatan. Aplikasi ini memiliki beberapa fitur utama, termasuk:
- Membuat, membaca, memperbarui, dan menghapus catatan.
- Otentikasi pengguna dengan Laravel Sanctum.
- Otorisasi berbasis peran (admin, editor, pengguna biasa).
- Menyimpan catatan berdasarkan pengguna yang terotentikasi.
- Endpoint API RESTful untuk operasi CRUD.


## Langkah Installasi Lokal

1. Clone Repository
    ```bash
    git clone https://github.com/adrespranata/sesasi.git
    ```
2. Copy file `.env.example` menjadi file `.env` untuk konfigurasi koneksi antara database.

3. Sesuaikan database environment
    ```
    DB_HOST=db / 127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sesasi
    DB_USERNAME=username
    DB_PASSWORD=
    ```
4. Jalankan perintah `php artisan key:generate` untuk Generate APP_KEY
    ```bash
    php artisan key:generate
    ```
5. Jalankan perinta `composer install` untuk mengunduh package
    ```bash
    composer install
    ```
6. Jalankan migrasi dengan perintah `php artisan migrate` untuk membuat tabel yang diperlukan.
    ```bash
    php artisan migrate
    ```
    atau
    ```bash
    php artisan migrate:fresh
    ```
7. Jalankan perintah `php artisan serve` untuk menjalankan aplikasi.
    ```bash
    php artisan serve
    ```

## Penggunaan

- Akses aplikasi melalui peramban web Anda dengan alamat `http://localhost:8000`.
- Untuk mengakses API, gunakan endpoint yang tersedia, misalnya `http://localhost:8000/api/notes`.
- Anda perlu mendaftar dan login untuk mengakses beberapa fitur, tergantung pada peran pengguna Anda.

## Dokumentasi Postman

Dokumentasi Postman untuk API aplikasi Catatan dapat ditemukan di sini: [Dokumentasi Postman](https://documenter.getpostman.com/view/29804014/2s9YJXYQSw)

## Rute dan Endpoint

Aplikasi ini memiliki beberapa rute dan endpoint yang berbeda untuk berbagai operasi. Di bawah ini adalah beberapa endpoint utama yang tersedia:

- `GET /api/notes`: Mengambil semua catatan.
- `POST /api/notes`: Membuat catatan baru.
- `GET /api/notes/{id}`: Mengambil catatan berdasarkan ID.
- `PUT /api/notes/{id}`: Memperbarui catatan berdasarkan ID.
- `DELETE /api/notes/{id}`: Menghapus catatan berdasarkan ID.

Anda juga dapat menyesuaikan rute dan endpoint sesuai kebutuhan Anda.