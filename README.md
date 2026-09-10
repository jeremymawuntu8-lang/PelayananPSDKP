# PSDKP Pelayanan — Laravel

Sistem web pelayanan/konsultasi PSDKP dengan tiga role: **Admin, Petugas, Pemilik Kapal/Company**.

## Fitur
- Login Admin/Petugas menggunakan email + password.
- Pemilik Kapal login menggunakan Google OAuth.
- Master Company/Pemilik Kapal.
- Master Kapal dengan data transmitter, buku kapal, alat tangkap, ukuran, SIPI, DPI, pelabuhan, SLO, jenis izin.
- Petugas membuat pelayanan berdasarkan struktur informasi Lensa: objek pelaporan, analisis, indikasi, perizinan/kapal, tanggal, koordinat.
- Setiap pelayanan menghasilkan link unik untuk Pemilik Kapal.
- Link dapat dikirim melalui WhatsApp.
- Pemilik Kapal mengisi respons dan upload dokumen.
- Petugas memproses status: draft, submitted, in_review, need_revision, completed, cancelled.
- Admin dapat mengelola user.
- Tidak ada data kapal/perusahaan nyata di dalam aplikasi. Seeder hanya menyediakan akun demo teknis.

## Kebutuhan
- PHP 8.2+
- Composer
- SQLite atau MySQL
- Extension PHP: PDO, OpenSSL, Mbstring, Fileinfo, Ctype, JSON

## Instalasi Windows/XAMPP
1. Extract ZIP.
2. Buka terminal di folder project.
3. `composer install`
4. Salin `.env.example` menjadi `.env`.
5. Pastikan `DB_CONNECTION=sqlite` dan file `database/database.sqlite` ada.
6. `php artisan key:generate`
7. `php artisan migrate --seed`
8. `php artisan storage:link`
9. `php artisan serve`
10. Buka `http://127.0.0.1:8000`.

## Akun demo
- Admin: `admin@psdkp.local` / `password`
- Petugas: `petugas@psdkp.local` / `password`
- Company: login Google setelah konfigurasi OAuth. Seeder membuat record `company@example.com` sebagai placeholder, bukan akun Google nyata.

**Segera ganti password demo sebelum deployment.**

## Google OAuth
Buat OAuth Client ID di Google Cloud Console, lalu isi `.env`:

`GOOGLE_CLIENT_ID=...`
`GOOGLE_CLIENT_SECRET=...`
`GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback`

Tambahkan redirect URI yang sama di Google Cloud. Admin harus lebih dulu membuat user role `company` dengan email Google pemilik kapal. Callback hanya mengizinkan user role `company`.

## Produksi
- Gunakan MySQL/PostgreSQL.
- Gunakan HTTPS.
- Set `APP_DEBUG=false`.
- Gunakan password admin yang kuat.
- Konfigurasikan storage/object storage dan backup database.
- Tambahkan rate limiting pada endpoint publik sebelum dibuka ke internet.
- Untuk WhatsApp resmi, gunakan WhatsApp Business Cloud API/provider resmi; tombol WhatsApp saat ini membuat pesan/link yang dapat dikirim manual.

## Catatan desain
UI mengambil inspirasi struktur visual dari screenshot Lensa yang diberikan: sidebar gelap, panel informasi, tabel, status, objek pelaporan, analisis, perizinan, dan timeline-like workflow. Ini bukan salinan kode/website Lensa.
