# 🎯 KaraStock - Decision Support System

**Sistem Prediksi Stok Cerdas untuk UMKM Lapak Karawo**

![Laravel](https://img.shields.io/badge/Laravel-10.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-orange?style=flat-square&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat-square&logo=bootstrap)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## 📖 Tentang KaraStock

KaraStock adalah **Decision Support System (DSS)** berbasis web yang dirancang untuk membantu UMKM Lapak Karawo dalam memprediksi dan mengelola stok produk Karawo menggunakan algoritma **Decision Tree**.

Sistem ini membantu pemilik dan staff toko untuk:

-   ✅ Memprediksi produk mana yang perlu di-**restock segera**
-   ✅ Mengetahui produk mana yang **stoknya berlebih**
-   ✅ Mengoptimalkan **rotasi stok** berdasarkan data penjualan
-   ✅ Membuat **keputusan bisnis yang data-driven**

---

## ✨ Fitur Utama

| Fitur                    | Deskripsi                                       |
| ------------------------ | ----------------------------------------------- |
| 🤖 **AI Prediction**     | Algoritma Decision Tree untuk prediksi otomatis |
| 📤 **Upload CSV**        | Import data penjualan dalam format CSV          |
| 📊 **Visualisasi**       | Chart & grafik interaktif (Pie & Bar Chart)     |
| 👥 **User Management**   | Role-based access (Super Admin & Admin)         |
| 📜 **Riwayat Lengkap**   | Tracking siapa upload apa dan kapan             |
| 🎨 **Responsive Design** | Bisa diakses dari desktop & mobile              |
| 🔐 **Secure Auth**       | Login aman dengan hashed password               |
| 📸 **Profile Photo**     | Upload & manage foto profil dengan custom modal |
| 🎯 **Clean Code**        | Semua styles terpusat di app.css (no inline)    |

---

## 🚀 Quick Start

### 📋 Prerequisites

Pastikan sudah terinstall:

-   **PHP** >= 8.1
-   **Composer**
-   **MySQL** >= 5.7
-   **Node.js** & NPM (opsional)

### 📦 Instalasi

```bash
# Clone repository
git clone https://github.com/ysfcsryo/KaraStock.git
cd KaraStock

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database (edit .env dulu!)
php artisan migrate

# Buat user super admin
php artisan tinker
```

Di tinker, jalankan:

```php
\App\Models\User::create([
    'name' => 'Admin Lapak',
    'email' => 'admin@karastock.com',
    'password' => bcrypt('admin123'),
    'role' => 'super_admin'
]);
exit
```

```bash
# Jalankan server
php artisan serve
```

Akses di browser: **http://localhost:8000**

**Login dengan:**

-   Email: `admin@karastock.com`
-   Password: `admin123`

---

## 📚 Dokumentasi

📁 **Semua dokumentasi ada di folder `/docs`**

### 🎯 Untuk User

| Dokumen                                            | Deskripsi                            |
| -------------------------------------------------- | ------------------------------------ |
| **[📘 MANUAL_BOOK.md](docs/MANUAL_BOOK.md)**       | **Manual lengkap A-Z (WAJIB BACA!)** |
| [🔐 QUICKSTART_LOGIN.md](docs/QUICKSTART_LOGIN.md) | Panduan login pertama kali           |
| [📖 LOGIN_GUIDE.md](docs/LOGIN_GUIDE.md)           | Troubleshooting login                |

### 🔧 Untuk Developer

| Dokumen                                              | Deskripsi                   |
| ---------------------------------------------------- | --------------------------- |
| [📍 INDEX.md](docs/INDEX.md)                         | **Index semua dokumentasi** |
| [⚙️ CARA_KERJA_SISTEM.md](docs/CARA_KERJA_SISTEM.md) | Algoritma & flow sistem     |
| [📂 STRUKTUR_FOLDER.md](docs/STRUKTUR_FOLDER.md)     | Struktur folder project     |
| [📂 FOLDER_STRUCTURE.md](docs/FOLDER_STRUCTURE.md)   | Detail struktur lengkap     |
| [🔐 AUTH_UPDATE.md](docs/AUTH_UPDATE.md)             | Sistem autentikasi          |

**👉 Mulai dari:** [docs/INDEX.md](docs/INDEX.md)

---

## 📁 Struktur Project

```
KaraStock/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Logic aplikasi
│   │   └── Middleware/       # Auth & security
│   └── Models/               # Database models
├── database/
│   └── migrations/           # Database schema
├── docs/                     # 📚 DOKUMENTASI LENGKAP
│   ├── INDEX.md             # Index semua docs
│   └── MANUAL_BOOK.md       # Manual utama
├── public/
│   ├── assets/              # Images, files
│   └── css/                 # Stylesheets
├── resources/
│   ├── views/               # Blade templates
│   └── css/                 # Source CSS
├── routes/
│   └── web.php              # Route definitions
├── sample-data/             # Contoh data CSV
├── scripts/                 # Utility scripts
└── storage/
    └── uploads/             # Uploaded files
```

---

## 🎮 Cara Penggunaan

### 1️⃣ Login

-   Buka browser ke `http://localhost:8000/login`
-   Masukkan email & password
-   Klik "Login"

### 2️⃣ Upload Data CSV

-   Sidebar → **Upload & Analisa**
-   Pilih file CSV (format di `sample-data/`)
-   Klik "Upload & Analisa"

### 3️⃣ Lihat Hasil

-   Otomatis redirect ke **Hasil Analisa**
-   Lihat tabel hasil prediksi
-   Badge warna:
    -   🔴 **SEGERA STOK** - Restock sekarang
    -   🟢 **PERTAHANKAN** - Stok aman
    -   🟡 **KURANGI STOK** - Terlalu banyak

### 4️⃣ Kelola User (Super Admin Only)

-   Sidebar → **Kelola User**
-   Tambah, Edit, atau Hapus user
-   Set role: Super Admin atau Admin

---

## 📊 Format Data CSV

File CSV harus memiliki kolom berikut:

```csv
nama_produk,kategori,kelas_harga,performa_jual,durasi_endap
Karawo Bunga Merah,pakaian,sedang,tinggi,cepat
Karawo Motif Naga,aksesoris,mahal,rendah,lama
```

**Nilai yang Diterima:**

| Kolom           | Nilai                          |
| --------------- | ------------------------------ |
| `kategori`      | pakaian / aksesoris / dekorasi |
| `kelas_harga`   | murah / sedang / mahal         |
| `performa_jual` | rendah / sedang / tinggi       |
| `durasi_endap`  | cepat / sedang / lama          |

📄 **Contoh file di:** `sample-data/sample_data_raw.csv`

---

## 🧠 Teknologi

### Backend

-   **Laravel 10.x** - PHP Framework
-   **PHP-ML** - Machine Learning Library
-   **MySQL** - Database

### Frontend

-   **Bootstrap 5.3.0** - UI Framework
-   **Chart.js** - Data Visualization
-   **Blade** - Template Engine

### Tools

-   **Composer** - PHP Dependency Manager
-   **NPM** - Node Package Manager
-   **Git** - Version Control

---

## 👥 User Roles

| Role            | Akses                               |
| --------------- | ----------------------------------- |
| **Super Admin** | ✅ Semua fitur + Kelola User        |
| **Admin**       | ✅ Upload, Analisa, Riwayat, Profil |

---

## 🛠️ Troubleshooting

### ❌ Error "Class not found"

```bash
composer dump-autoload
php artisan cache:clear
```

### ❌ Tidak bisa login

-   Cek database: `SELECT * FROM users;`
-   Reset password via tinker (lihat Instalasi)

### ❌ Chart tidak muncul

-   Refresh browser (Ctrl+F5)
-   Cek console browser (F12)
-   Pastikan koneksi internet (Chart.js dari CDN)

**📖 Lebih lengkap:** [docs/MANUAL_BOOK.md](docs/MANUAL_BOOK.md)

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📝 License

Project ini menggunakan lisensi **MIT License**.

---

## 📞 Kontak

**Developer:** KaraStock Team  
**Email:** support@karastock.com  
**GitHub:** [@ysfcsryo](https://github.com/ysfcsryo)  
**Repository:** [KaraStock](https://github.com/ysfcsryo/KaraStock)

---

## 🎉 Credits

Dikembangkan dengan ❤️ untuk membantu UMKM Lapak Karawo mengoptimalkan manajemen stok.

**Special Thanks:**

-   Laravel Community
-   PHP-ML Contributors
-   Bootstrap Team
-   Chart.js Team

---

## 📈 Changelog

### Version 1.1 (26 Des 2025)

-   ✅ **Profile photo upload** dengan custom modal (no Bootstrap modal)
-   ✅ **Clean architecture** - semua inline styles dipindahkan ke app.css
-   ✅ **Template CSV** dengan 8 data contoh
-   ✅ **Deployment ready** dengan security & performance optimization
-   ✅ **HTTPS force** di production environment
-   ✅ Complete deployment checklist & guides

### Version 1.0.0 (25 Des 2025)

-   ✅ Decision Tree algorithm implementation
-   ✅ User management dengan role system
-   ✅ Upload & analisa CSV
-   ✅ Interactive charts (Pie & Bar)
-   ✅ History tracking dengan info uploader
-   ✅ Responsive design
-   ✅ Profile management
-   ✅ Complete documentation

---

<div align="center">

**⭐ Star this repository jika bermanfaat!**

**[📘 Baca Dokumentasi](docs/INDEX.md)** • **[🐛 Report Bug](https://github.com/ysfcsryo/KaraStock/issues)** • **[💡 Request Feature](https://github.com/ysfcsryo/KaraStock/issues)**

_© 2025 KaraStock - Decision Support System_

</div>
