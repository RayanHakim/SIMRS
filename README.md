# SIMRS-Lite (Sistem Informasi Manajemen Rumah Sakit)

SIMRS-Lite adalah prototipe aplikasi Manajemen Rumah Sakit berbasis web yang fokus pada efisiensi alur pasien, mulai dari pendaftaran mandiri hingga pemeriksaan medis digital. Proyek ini dibangun untuk mendemonstrasikan penerapan **Role-Based Access Control (RBAC)** dan integritas data pada sistem informasi kesehatan.

## 🚀 Fitur Utama

- **Pendaftaran Pasien Online:** Pasien dapat mendaftar berobat secara mandiri dan mendapatkan nomor antrean secara real-time.
- **Manajemen Antrean Dokter:** Dokter memiliki dashboard khusus untuk melihat daftar antrean pasien yang harus diperiksa hari ini.
- **Electronic Medical Record (EMR):** Input hasil pemeriksaan, diagnosa, dan tindakan medis yang tersimpan secara terpusat.
- **RBAC (Role-Based Access Control):** Keamanan akses menggunakan Spatie Permission untuk membedakan hak akses Admin, Dokter, Pasien, dan Apoteker.
- **Format Antrean Cantik:** Penomoran otomatis (001, 002, dst) yang mempermudah identifikasi di poli.

## 🛠️ Tech Stack

- **Backend:** [Laravel 11](https://laravel.com) (PHP 8.3)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com) & [Blade Template](https://laravel.com/docs/11.x/blade)
- **Database:** SQLite (Lightweight & Portable)
- **Security:** [Spatie Laravel-Permission](https://spatie.be/docs/laravel-permission)
- **Starter Kit:** [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)

## 🔑 Akun Demo (Default Credentials)

Gunakan akun berikut untuk melakukan pengujian fungsionalitas sistem:

| Role | Email | Password | Kegunaan |
| :--- | :--- | :--- | :--- |
| **Pasien** | `pasien@simrs.com` | `password` | Simulasi daftar berobat online. |
| **Dokter** | `dokter@simrs.com` | `password` | Simulasi input diagnosa pasien. |
| **Admin** | `admin@simrs.com` | `password` | Mengelola data master & monitoring. |

## 🔗 Panduan Cek Link (Endpoint)

Setelah login, Anda dapat mengakses fitur utama melalui sidebar atau link berikut:

- **Dashboard Utama:** `http://localhost:8000/dashboard`
- **Form Daftar Pasien:** `http://localhost:8000/pendaftaran/create`
- **Tabel Antrean (Admin):** `http://localhost:8000/pendaftaran`
- **Antrean Pasien (Dokter):** `http://localhost:8000/pemeriksaan`

## ⚙️ Cara Instalasi

1. **Clone Repositori:**
   ```bash
   git clone [https://github.com/RayanHakim/SIMRS.git](https://github.com/username-kamu/SIMRS.git)
   cd SIMRS
Instalasi Dependensi:

Bash
composer install
npm install && npm run build
Setup Environment:

Bash
cp .env.example .env
php artisan key:generate
Migrasi & Seeding (PENTING):

Bash
# Perintah ini akan mereset database dan mengisi akun demo
php artisan migrate:fresh --seed
Jalankan Aplikasi:

Bash
php artisan serve
