# 📁 Struktur Folder KaraStock - Ringkasan

## ✅ Folder yang Sudah Dirapihkan

### 📂 Root Folder
```
KaraStock/
├── docs/           ← Semua dokumentasi .md
├── sample-data/    ← Semua file CSV contoh
├── scripts/        ← Script utilities (.bat, .php)
├── app/           ← Source code aplikasi
├── resources/     ← Views, CSS, JS source
├── public/        ← Assets publik
├── database/      ← Migrations, seeders
├── storage/       ← Uploads & logs
└── README.md      ← Dokumentasi utama
```

---

## 📚 Folder: docs/

**Semua dokumentasi sistem:**
- `AUTH_UPDATE.md` - Detail sistem autentikasi
- `CARA_KERJA_SISTEM.md` - Penjelasan Decision Tree
- `FORMAT_UPGRADE_GUIDE.md` - Panduan format data
- `LOGIN_GUIDE.md` - Panduan login lengkap
- `QUICKSTART_LOGIN.md` - Quick start guide
- `README.md` - Index dokumentasi

**Dipindahkan dari:** Root folder → `docs/`

---

## 📊 Folder: sample-data/

**Contoh file CSV untuk testing:**
- `sample_data_raw.csv` - Data mentah
- `sample_data_training.csv` - Data training
- `sample_data_kategori.csv` - Data dengan kategori
- `sample_data_training_kategori.csv` - Training dengan kategori
- `README.md` - Panduan penggunaan sample data

**Dipindahkan dari:** Root folder → `sample-data/`

---

## 🔧 Folder: scripts/

**Utility scripts untuk development:**
- `sync-css.bat` - Sync CSS resources → public
- `generate_tree.php` - Generate decision tree
- `simulate_upload.php` - Testing upload
- `README.md` - Panduan penggunaan scripts

**Dipindahkan dari:** Root folder → `scripts/`

**File dihapus:**
- ❌ `pem_fresh.html` (testing)
- ❌ `response.html` (testing)
- ❌ `response2.html` (testing)
- ❌ `tree_fresh.json` (output testing)
- ❌ `tree_output.json` (output testing)
- ❌ `tree_output2.json` (output testing)

---

## 🗑️ File yang Dihapus

### public/build/ (Folder dihapus)
- Berisi Vite build artifacts yang tidak terpakai
- `app-BMLUEr52.css`
- `app-C3DcDIpR.js`
- `manifest.json`

**Alasan:** Aplikasi tidak menggunakan Vite build, CSS di-copy manual

---

## 📁 Struktur Lengkap

```
KaraStock/
│
├── 📚 docs/                           # Dokumentasi
│   ├── AUTH_UPDATE.md                 # Update autentikasi
│   ├── CARA_KERJA_SISTEM.md          # Cara kerja sistem
│   ├── FORMAT_UPGRADE_GUIDE.md       # Panduan format
│   ├── LOGIN_GUIDE.md                # Panduan login
│   ├── QUICKSTART_LOGIN.md           # Quick start
│   └── README.md                     # Index dokumentasi
│
├── 📊 sample-data/                   # Data contoh CSV
│   ├── sample_data_raw.csv           # Data mentah
│   ├── sample_data_training.csv      # Training data
│   ├── sample_data_kategori.csv      # Data kategori
│   ├── sample_data_training_kategori.csv
│   └── README.md                     # Panduan sample data
│
├── 🔧 scripts/                       # Utility scripts
│   ├── sync-css.bat                  # Sync CSS
│   ├── generate_tree.php             # Generate tree
│   ├── simulate_upload.php           # Testing upload
│   └── README.md                     # Panduan scripts
│
├── 💻 app/                           # Source code aplikasi
│   ├── Http/Controllers/             # Controllers
│   │   ├── ProductController.php     # Main controller
│   │   └── AuthController.php        # Auth controller
│   └── Models/                       # Models
│       └── User.php                  # User model
│
├── 🗄️ database/                      # Database
│   ├── migrations/                   # Migrations
│   │   ├── create_users_table.php
│   │   ├── create_password_reset_tokens_table.php
│   │   ├── create_failed_jobs_table.php
│   │   ├── create_personal_access_tokens_table.php
│   │   └── create_history_table.php
│   └── seeders/                      # Seeders
│       └── UserSeeder.php            # Default user
│
├── 🎨 resources/                     # Source files
│   ├── css/                          # Source CSS
│   │   └── app.css                   # Main CSS (edit disini)
│   ├── js/                           # Source JS
│   │   └── app.js
│   └── views/                        # Blade templates
│       ├── auth/                     # Auth views
│       │   ├── login.blade.php       # Login page
│       │   └── profile.blade.php     # Profile page
│       ├── layout/                   # Layouts
│       │   └── main.blade.php        # Main layout
│       ├── input-upload.blade.php    # Upload page
│       ├── hasil-analisa.blade.php   # Results page
│       ├── pemrosesan-file.blade.php # Tree visualization
│       ├── riwayat.blade.php         # History page
│       └── evaluasi.blade.php        # Evaluation page
│
├── 🌐 public/                        # Public assets
│   ├── assets/                       # Static assets
│   │   └── images/                   # Images
│   │       └── logoKaraStock.png     # Logo aplikasi
│   ├── css/                          # Compiled CSS
│   │   └── app.css                   # (Copy dari resources)
│   ├── template_karastock.csv        # Template download
│   ├── .htaccess                     # Apache config
│   ├── index.php                     # Entry point
│   ├── favicon.ico                   # Favicon
│   └── robots.txt                    # Robots config
│
├── 🛣️ routes/                        # Routes
│   └── web.php                       # Web routes
│
├── 💾 storage/                       # Storage
│   ├── app/                          # Uploaded files
│   │   └── public/                   # Public uploads
│   ├── framework/                    # Framework files
│   └── logs/                         # Application logs
│
├── 🧪 tests/                         # Tests
│
├── 📦 vendor/                        # Composer packages
│
├── 🔧 node_modules/                  # NPM packages
│
├── ⚙️ Config Files (Root)
│   ├── .env                          # Environment config
│   ├── .env.example                  # Environment template
│   ├── .gitignore                    # Git ignore
│   ├── .editorconfig                 # Editor config
│   ├── composer.json                 # PHP dependencies
│   ├── package.json                  # Node dependencies
│   ├── phpunit.xml                   # PHPUnit config
│   ├── vite.config.js                # Vite config
│   └── artisan                       # Laravel CLI
│
└── 📖 README.md                      # Dokumentasi utama

```

---

## 🎯 Keuntungan Struktur Baru

### ✅ Lebih Rapi
- Dokumentasi terpusat di `docs/`
- Sample data di `sample-data/`
- Scripts di `scripts/`
- Root folder bersih

### ✅ Mudah Navigasi
- Setiap folder punya `README.md`
- Struktur jelas dan konsisten
- File tersusun berdasarkan fungsi

### ✅ Maintenance Mudah
- Script terpisah dari source code
- Dokumentasi mudah ditemukan
- File testing sudah dihapus

### ✅ Professional
- Struktur standar Laravel
- Best practices folder organization
- Clean code structure

---

## 📝 Catatan Penting

### File yang Tetap di Root
- `README.md` - Dokumentasi utama (best practice)
- `.env` - Environment config
- `composer.json`, `package.json` - Dependencies
- `artisan` - Laravel CLI
- Config files lainnya

### File yang TIDAK Dihapus
- ✅ Semua file dokumentasi (dipindah ke `docs/`)
- ✅ Semua file config (.env, composer.json, dll)
- ✅ Semua source code
- ✅ Semua dependencies (vendor, node_modules)

### File yang Dihapus
- ❌ File testing HTML/JSON di `scripts/`
- ❌ Folder `public/build/` (Vite artifacts)

---

## 🚀 Quick Access

### Dokumentasi
```bash
# Buka folder docs
cd docs

# Baca panduan login
cat docs/LOGIN_GUIDE.md

# Baca cara kerja sistem
cat docs/CARA_KERJA_SISTEM.md
```

### Sample Data
```bash
# Lihat sample data
cd sample-data

# Gunakan untuk testing
# Upload file: sample_data_raw.csv
```

### Scripts
```bash
# Sync CSS (Windows)
scripts\sync-css.bat

# Generate tree
php scripts/generate_tree.php

# Testing upload
php scripts/simulate_upload.php
```

---

**📅 Tanggal Rapih:** 25 Desember 2025  
**✅ Status:** Clean & Organized  
**📁 Total Folder:** 3 folder baru (docs, sample-data, scripts sudah ada)  
**🗑️ File Dihapus:** 7 file (6 testing + 1 folder build)  
**📄 File Dipindahkan:** 10 file (5 docs + 4 CSV + 1 bat)
