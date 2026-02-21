# Web OPD New

Aplikasi Web OPD (Organisasi Perangkat Daerah) berbasis Laravel 12 dan Filament 4.

> [!TIP]
> Lihat [Panduan Perintah](file:///c:/larag- [x] Add Log Maintenance guide to README

- [x] Create PANDUAN_PERINTAH.md and link from README
      daftar perintah cepat Laravel, Filament, dan Maintenance.

## Prasyarat (Prerequisites)

Sebelum menginstal, pastikan sistem Anda memiliki:

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laragon atau XAMPP (Direkomendasikan Laragon untuk pengguna Windows)

## Instalasi Lokal (Local Installation)

Ikuti langkah-langkah berikut untuk menjalankan project ini di komputer lokal Anda:

### 1. Kloning dari GitHub (Cloning from GitHub)

Buka terminal atau command prompt, lalu jalankan:

```bash
git clone https://github.com/doniaries/webopd-new.git
cd webopd-new
```

### 2. Instal Dependensi PHP (Install PHP Dependencies)

```bash
composer install
```

### 3. Pengaturan Lingkungan (Environment Setup)

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Kemudian, buat database baru di MySQL (misalnya: `webopd_new`) dan sesuaikan konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=webopd
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Migrasi dan Seeding Database (Database Migration & Seeding)

Jalankan migrasi untuk membuat tabel dan seeder untuk data awal:

```bash
php artisan migrate --seed
```

### 6. Instal Dependensi JS & Build Asset (Install JS & Build Assets)

```bash
npm install
npm run build
```

### 7. Link Storage

```bash
php artisan storage:link
```

## Petunjuk Penggunaan (Usage Instructions)

### Menjalankan Server Pengembangan (Running Dev Server)

Anda bisa menggunakan perintah bawaan Laravel:

```bash
php artisan serve
```

Atau jika ingin menjalankan server beserta Vite dan Queue secara bersamaan (menggunakan script yang sudah ada di `composer.json`):

```bash
composer run dev
```

### Akses Aplikasi

- **Frontend:** [http://localhost:8000](http://localhost:8000)
- **Admin Panel (Filament):** [http://localhost:8000/admin](http://localhost:8000/admin)

### Kredensial Default (Default Credentials)

Gunakan akun berikut untuk login ke panel admin:

- **Email:** `admin@example.com`
- **Password:** `password`

## Fitur Utama

- Manajemen Berita/Post
- Manajemen Galeri & Infografis
- Manajemen Dokumen & Pengumuman
- Agenda Kegiatan
- Struktur Organisasi & Visi Misi
- Pengaturan Website Dinamis
- Role & Permission Management (Filament Shield)

## Troubleshooting

### Error: npm ENOENT `C:\Users\donia\AppData\Roaming\npm`

Jika Anda mendapatkan error `ENOENT` yang menyatakan folder `npm` di `AppData\Roaming` tidak ada, silakan buat folder tersebut secara manual atau jalankan perintah ini di PowerShell:

```powershell
New-Item -Path "$env:APPDATA\npm" -ItemType Directory -Force
```

Setelah itu, coba jalankan kembali `npm install` lalu `composer run dev`.

### Membersihkan Log yang Menumpuk

Jika file `storage/logs/laravel.log` sudah terlalu besar, Anda bisa mengosongkannya dengan perintah:

- **PowerShell:** `Clear-Content storage\logs\laravel.log`
- **Command Prompt:** `type nul > storage\logs\laravel.log`
- **Git Bash / Linux:** `> storage/logs/laravel.log`

**Tips:** Agar log tidak menumpuk di satu file, ubah pengaturan di `.env` agar log disimpan harian:

```env
LOG_CHANNEL=daily
```

Dengan ini, Laravel akan membuat file log baru setiap hari dan menghapus yang lama secara otomatis (default: 14 hari terakhir).

## Lisensi

Aplikasi ini bersifat open-source di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
