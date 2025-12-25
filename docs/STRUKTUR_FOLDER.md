# 📦 Struktur Folder KaraStock (Clean & Organized)

**Tanggal Update:** 26 Desember 2025  
**Status:** ✅ Production Ready & Optimized

---

## 🎯 Struktur Utama

```
KaraStock/
│
├── 📁 app/                          # Laravel Application
│   ├── Http/
│   │   ├── Controllers/            # Business Logic
│   │   │   ├── AuthController.php
│   │   │   ├── ProductController.php
│   │   │   └── UserManagementController.php
│   │   └── Middleware/
│   │       ├── Authenticate.php
│   │       └── CheckSuperAdmin.php
│   └── Models/
│       ├── User.php
│       └── History.php
│
├── 📁 config/                       # Configuration Files
│   ├── app.php
│   ├── auth.php
│   └── database.php
│
├── 📁 database/                     # Database & Migrations
│   └── migrations/
│       ├── create_users_table.php
│       ├── create_history_table.php
│       ├── add_role_to_users_table.php
│       └── add_user_id_to_histories_table.php
│
├── 📁 docs/                         # 📚 DOKUMENTASI LENGKAP
│   ├── INDEX.md                    # 📍 Index master
│   ├── MANUAL_BOOK.md              # 📘 Manual A-Z
│   ├── STRUKTUR_FOLDER.md          # 📋 Struktur detail
│   ├── FOLDER_STRUCTURE.md         # 📂 Deep dive structure
│   ├── CARA_KERJA_SISTEM.md        # ⚙️ Algoritma
│   ├── QUICKSTART_LOGIN.md         # 🚀 Quick start
│   ├── LOGIN_GUIDE.md              # 🔐 Login guide
│   ├── AUTH_UPDATE.md              # 🔑 Auth system
│   ├── FORMAT_UPGRADE_GUIDE.md     # 📝 Format guide
│   ├── CLEANUP_SUMMARY.md          # 🧹 Changelog
│   └── README.md                   # Intro docs
│
├── 📁 public/                       # Public Assets
│   ├── assets/
│   │   └── images/
│   │       └── logoKaraStock.png
│   ├── css/
│   │   └── app.css                # Compiled CSS
│   ├── .htaccess
│   ├── favicon.ico
│   ├── index.php                  # Entry point
│   └── robots.txt
│
├── 📁 resources/                    # Source Files
│   ├── css/
│   │   └── app.css                # Source CSS
│   └── views/                     # Blade Templates
│       ├── layout/
│       │   └── main.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── profile.blade.php
│       ├── admin/
│       │   └── users/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       └── edit.blade.php
│       ├── upload.blade.php
│       ├── hasil-analisa.blade.php
│       ├── riwayat.blade.php
│       └── proses-visualisasi.blade.php
│
├── 📁 routes/                       # Application Routes
│   └── web.php
│
├── 📁 sample-data/                  # 📊 Sample CSV Files
│   ├── README.md
│   ├── template_upload.csv        # ⭐ Template kosong
│   ├── sample_data_raw.csv
│   ├── sample_data_training.csv
│   ├── sample_data_kategori.csv
│   └── sample_data_training_kategori.csv
│
├── 📁 scripts/                      # 🛠️ Utility Scripts
│   ├── README.md
│   ├── sync-css.bat
│   ├── generate_tree.php
│   └── simulate_upload.php
│
├── 📁 storage/                      # Storage & Logs
│   ├── app/
│   ├── framework/
│   ├── logs/
│   └── [upload files here]
│
├── 📁 tests/                        # Unit Tests
│   ├── Feature/
│   └── Unit/
│
├── 📄 .env                          # Environment Config
├── 📄 .env.example                  # Template .env
├── 📄 .gitignore                    # Git ignore rules
├── 📄 README.md                     # 📖 Project Overview
├── 📄 composer.json                 # PHP Dependencies
├── 📄 package.json                  # NPM Dependencies
└── 📄 artisan                       # Laravel CLI

```

---

## ✅ File yang Dihapus (Cleanup)

| File                               | Alasan                                        |
| ---------------------------------- | --------------------------------------------- |
| ❌ `README_OLD.md`                 | Backup lama, sudah tidak diperlukan           |
| ❌ `public/template_karastock.csv` | Dipindah ke `sample-data/template_upload.csv` |

---

## 📁 File yang Dipindahkan

| Dari                            | Ke                                | Alasan                           |
| ------------------------------- | --------------------------------- | -------------------------------- |
| `STRUKTUR_FOLDER.md`            | `docs/STRUKTUR_FOLDER.md`         | Dokumentasi harus di folder docs |
| `public/template_karastock.csv` | `sample-data/template_upload.csv` | Lebih tepat di sample-data       |

---

## 🎯 Navigasi Cepat

### 📚 Dokumentasi

```
docs/
├── START HERE → INDEX.md
├── USER GUIDE → MANUAL_BOOK.md
└── DEVELOPER → CARA_KERJA_SISTEM.md
```

### 📊 Sample Data

```
sample-data/
├── Template → template_upload.csv
├── Test Upload → sample_data_raw.csv
└── Training → sample_data_training.csv
```

### 🛠️ Scripts

```
scripts/
├── CSS Sync → sync-css.bat
├── Tree Generator → generate_tree.php
└── Upload Test → simulate_upload.php
```

---

## 📖 Cara Baca Dokumentasi

### Untuk User Baru:

1. [README.md](../README.md) - Project overview
2. [docs/INDEX.md](INDEX.md) - Index dokumentasi
3. [docs/MANUAL_BOOK.md](MANUAL_BOOK.md) - Manual lengkap

### Untuk Developer:

1. [docs/STRUKTUR_FOLDER.md](STRUKTUR_FOLDER.md) - File ini!
2. [docs/FOLDER_STRUCTURE.md](FOLDER_STRUCTURE.md) - Detail lengkap
3. [docs/CARA_KERJA_SISTEM.md](CARA_KERJA_SISTEM.md) - Algoritma

---

## 🔍 File Penting

### Configuration

-   `.env` - Environment variables
-   `config/database.php` - Database setup
-   `config/auth.php` - Authentication config

### Core Files

-   `routes/web.php` - All routes
-   `app/Http/Controllers/ProductController.php` - Main logic
-   `app/Models/History.php` - History model dengan user relation

### Views

-   `resources/views/layout/main.blade.php` - Master template
-   `resources/views/hasil-analisa.blade.php` - Results page
-   `resources/views/admin/users/index.blade.php` - User management

---

## 📊 Database Tables

| Table       | Fungsi                   | File Migration             |
| ----------- | ------------------------ | -------------------------- |
| `users`     | User accounts            | `create_users_table.php`   |
| `histories` | Upload history & results | `create_history_table.php` |

**Relations:**

-   `histories.user_id` → `users.id` (Foreign Key)

---

## 🎨 CSS Workflow

1. Edit: `resources/css/app.css`
2. Sync: Run `scripts/sync-css.bat`
3. Result: `public/css/app.css` (deployed)

---

## 📦 Dependencies

### PHP (Composer)

-   Laravel 10.x
-   PHP-ML (Machine Learning)
-   Laravel Sanctum

### JavaScript (NPM)

-   Bootstrap 5.3.0
-   Chart.js
-   Vite (build tool)

---

## 🔐 Security

**Protected Folders:**

-   `app/` - Not web accessible
-   `database/` - Not web accessible
-   `storage/` - Secured via .htaccess
-   `config/` - Not web accessible

**Public Folder:**

-   `public/` - Only folder accessible via web

---

## 🚀 Quick Commands

```bash
# Development
php artisan serve

# Clear cache
php artisan cache:clear
php artisan config:clear

# Database
php artisan migrate
php artisan migrate:fresh --seed

# Sync CSS
scripts/sync-css.bat
```

---

## 📌 Catatan Penting

✅ **File terorganisir** - Semua file di tempat yang tepat  
✅ **Dokumentasi lengkap** - Ada di folder `docs/`  
✅ **Sample data rapi** - Template + contoh di `sample-data/`  
✅ **No redundancy** - File duplikat sudah dihapus  
✅ **Clean structure** - Mudah di-navigate

---

**📖 Untuk detail lengkap, lihat [FOLDER_STRUCTURE.md](FOLDER_STRUCTURE.md)**

---

_© 2025 KaraStock - Clean & Organized Structure_
