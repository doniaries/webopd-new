# Panduan Perintah (Command Guide)

Daftar perintah yang sering digunakan dalam pengembangan aplikasi Web OPD ini.

## Perintah Artisan (Laravel)

### Server & Cache

| Perintah                     | Deskripsi                                        |
| ---------------------------- | ------------------------------------------------ |
| `php artisan serve`          | Menjalankan server pengembangan                  |
| `php artisan route:list`     | Menampilkan semua daftar route                   |
| `php artisan config:clear`   | Menghapus cache konfigurasi                      |
| `php artisan cache:clear`    | Menghapus cache aplikasi                         |
| `php artisan view:clear`     | Menghapus cache view/blade                       |
| `php artisan optimize:clear` | Menghapus semua cache (config, route, view, etc) |

### Database & Migrasi

| Perintah                                      | Deskripsi                                                 |
| --------------------------------------------- | --------------------------------------------------------- |
| `php artisan migrate`                         | Jalankan migrasi tabel yang belum ada                     |
| `php artisan migrate:rollback`                | Membatalkan migrasi terakhir                              |
| `php artisan migrate:fresh --seed`            | Menghapus semua tabel dan jalankan ulang migrasi + seeder |
| `php artisan db:seed`                         | Menjalankan seeder saja                                   |
| `php artisan make:migration create_xxx_table` | Membuat file migrasi baru                                 |

### Pembuatan File (Generators)

| Perintah                                       | Deskripsi                                  |
| ---------------------------------------------- | ------------------------------------------ |
| `php artisan make:model NamaModel -m`          | Membuat Model sekaligus file migorasinya   |
| `php artisan make:controller NamaController`   | Membuat Controller baru                    |
| `php artisan make:filament-resource NamaModel` | Membuat CRUD Filament untuk model tertentu |

---

## Perintah Maintenance & Log

### Membersihkan Log

Gunakan perintah ini jika file `storage/logs/laravel.log` terlalu besar:

- **PowerShell:**
    ```powershell
    Clear-Content storage\logs\laravel.log
    ```
- **Command Prompt (CMD):**
    ```cmd
    type nul > storage\logs\laravel.log
    ```
- **Bash / Linux:**
    ```bash
    > storage/logs/laravel.log
    ```

### Storage Link

Perintah untuk membuat link folder public ke storage (wajib jika gambar tidak muncul):

```bash
php artisan storage:link
```

---

## Perintah Frontend (Node.js/NPM)

| Perintah        | Deskripsi                                       |
| --------------- | ----------------------------------------------- |
| `npm install`   | Instal semua dependensi dari package.json       |
| `npm run dev`   | Menjalankan Vite untuk development (hot reload) |
| `npm run build` | Kompilasi asset untuk produksi                  |

---

## Perintah Composer (PHP)

| Perintah                 | Deskripsi                                                       |
| ------------------------ | --------------------------------------------------------------- |
| `composer install`       | Instal dependensi dari composer.lock                            |
| `composer update`        | Update semua package ke versi terbaru yang diizinkan            |
| `composer dump-autoload` | Mengindeks ulang class-class (berguna jika ada class not found) |
| `composer run dev`       | Menjalankan server, queue, dan vite sekaligus                   |
