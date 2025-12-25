# 📚 Dokumentasi KaraStock

Selamat datang di dokumentasi lengkap sistem KaraStock - Decision Support System untuk prediksi stok Karawo.

---

## 🚀 Quick Start

**Baru pertama kali menggunakan KaraStock?**

1. 📘 **[MANUAL_BOOK.md](MANUAL_BOOK.md)** - **BACA INI DULU!**  
   Manual lengkap penggunaan sistem dari A sampai Z

2. 🔐 **[QUICKSTART_LOGIN.md](QUICKSTART_LOGIN.md)**  
   Panduan cepat login dan akses pertama kali

---

## 📖 Dokumentasi Lengkap

### 📘 Untuk User

| Dokumen                                        | Deskripsi                  | Target     |
| ---------------------------------------------- | -------------------------- | ---------- |
| **[MANUAL_BOOK.md](MANUAL_BOOK.md)**           | 📕 Manual book lengkap A-Z | Semua user |
| **[QUICKSTART_LOGIN.md](QUICKSTART_LOGIN.md)** | Login pertama kali         | User baru  |
| **[LOGIN_GUIDE.md](LOGIN_GUIDE.md)**           | Panduan login detail       | Semua user |

### 🔧 Untuk Developer

| Dokumen                                                | Deskripsi                      | Kegunaan              |
| ------------------------------------------------------ | ------------------------------ | --------------------- |
| **[CARA_KERJA_SISTEM.md](CARA_KERJA_SISTEM.md)**       | Algoritma Decision Tree & flow | Memahami logic sistem |
| **[STRUKTUR_FOLDER.md](STRUKTUR_FOLDER.md)**           | Struktur folder project        | Navigasi codebase     |
| **[FOLDER_STRUCTURE.md](FOLDER_STRUCTURE.md)**         | Detail struktur lengkap        | Deep dive codebase    |
| **[AUTH_UPDATE.md](AUTH_UPDATE.md)**                   | Sistem autentikasi & role      | Development auth      |
| **[FORMAT_UPGRADE_GUIDE.md](FORMAT_UPGRADE_GUIDE.md)** | Panduan upgrade format CSV     | Migrasi data          |

### 📝 Changelog

| Dokumen                                      | Deskripsi                      |
| -------------------------------------------- | ------------------------------ |
| **[CLEANUP_SUMMARY.md](CLEANUP_SUMMARY.md)** | Catatan pembersihan & optimasi |

---

## 🎯 Panduan Berdasarkan Role

### 👑 Super Admin (Pemilik Lapak)

**Yang Perlu Dibaca:**

1. ✅ [MANUAL_BOOK.md](MANUAL_BOOK.md) - Bab 1-4 (Intro, Install, Login, Manajemen User)
2. ✅ [MANUAL_BOOK.md](MANUAL_BOOK.md) - Bab 5-8 (Upload, Hasil, Riwayat, Profil)
3. 📖 [CARA_KERJA_SISTEM.md](CARA_KERJA_SISTEM.md) - Memahami algoritma (opsional)

**Tugas Utama:**

-   Kelola user/karyawan (tambah, edit, hapus)
-   Monitor siapa upload apa
-   Lihat semua hasil analisa

---

### 👨‍💼 Admin (Staff/Kasir)

**Yang Perlu Dibaca:**

1. ✅ [QUICKSTART_LOGIN.md](QUICKSTART_LOGIN.md) - Akses pertama kali
2. ✅ [MANUAL_BOOK.md](MANUAL_BOOK.md) - Bab 5-8 (Upload, Hasil, Riwayat, Profil)
3. 📄 File contoh di `sample-data/` - Format CSV yang benar

**Tugas Utama:**

-   Upload data penjualan
-   Analisa stok
-   Lihat hasil & rekomendasi
-   Update profil sendiri

---

### 👨‍💻 Developer/Programmer

**Yang Perlu Dibaca:**

1. ✅ [FOLDER_STRUCTURE.md](FOLDER_STRUCTURE.md) - Struktur project
2. ✅ [CARA_KERJA_SISTEM.md](CARA_KERJA_SISTEM.md) - Algoritma & logic
3. ✅ [AUTH_UPDATE.md](AUTH_UPDATE.md) - Autentikasi & role system
4. ✅ [FORMAT_UPGRADE_GUIDE.md](FORMAT_UPGRADE_GUIDE.md) - Migrasi data
5. ✅ [MANUAL_BOOK.md](MANUAL_BOOK.md) - Bab 2 & 9 (Install & Sistem)

**Tugas Development:**

-   Setup environment
-   Database migration
-   Extend features
-   Bug fixing
-   Maintenance

---

## 📊 Fitur Utama Sistem

| Fitur                  | Deskripsi                  | Dokumentasi          |
| ---------------------- | -------------------------- | -------------------- |
| 📤 **Upload CSV**      | Upload data penjualan      | Manual Book Bab 5    |
| 🤖 **AI Prediction**   | Decision Tree algorithm    | CARA_KERJA_SISTEM.md |
| 📊 **Visualisasi**     | Chart & grafik interaktif  | Manual Book Bab 6    |
| 👥 **User Management** | Kelola user dengan role    | Manual Book Bab 4    |
| 📜 **Riwayat**         | Tracking upload & uploader | Manual Book Bab 7    |
| 👤 **Profile**         | Kelola profil sendiri      | Manual Book Bab 8    |

---

## 🔧 Teknologi Stack

```
Frontend:
- Bootstrap 5.3.0 (UI Framework)
- Chart.js (Visualisasi)
- JavaScript/jQuery

Backend:
- Laravel 10.x (PHP Framework)
- PHP-ML (Machine Learning)
- MySQL (Database)

Development:
- Composer (Dependency Manager)
- NPM (Package Manager)
- Git (Version Control)
```

---

## 📁 Struktur File Dokumentasi

```
docs/
├── INDEX.md                     ← 📍 Anda di sini
├── MANUAL_BOOK.md              ← 📘 MANUAL UTAMA (READ FIRST!)
│
├── [User Guide]
│   ├── QUICKSTART_LOGIN.md     ← Quick start
│   └── LOGIN_GUIDE.md          ← Login detail
│
├── [Technical Docs]
│   ├── CARA_KERJA_SISTEM.md    ← Algoritma & flow
│   ├── FOLDER_STRUCTURE.md     ← Project structure
│   ├── AUTH_UPDATE.md          ← Authentication
│   └── FORMAT_UPGRADE_GUIDE.md ← Data migration
│
└── [Changelog]
    └── CLEANUP_SUMMARY.md      ← Update history
```

---

## ⚡ Quick Links

### Instalasi

-   [Requirement & Setup](MANUAL_BOOK.md#21-requirement-sistem)
-   [Database Configuration](MANUAL_BOOK.md#22-langkah-instalasi)
-   [Buat User Pertama](MANUAL_BOOK.md#22-langkah-instalasi)

### User Guide

-   [Cara Login](QUICKSTART_LOGIN.md)
-   [Upload Data CSV](MANUAL_BOOK.md#5-upload--analisa-data)
-   [Membaca Hasil](MANUAL_BOOK.md#6-hasil-analisa)
-   [Kelola User](MANUAL_BOOK.md#4-manajemen-user-super-admin)

### Technical

-   [Decision Tree Algorithm](CARA_KERJA_SISTEM.md)
-   [Database Schema](MANUAL_BOOK.md#93-database-schema)
-   [API Routes](FOLDER_STRUCTURE.md)

### Troubleshooting

-   [Error Upload](MANUAL_BOOK.md#101-error-upload-file)
-   [Tidak Bisa Login](MANUAL_BOOK.md#103-tidak-bisa-login)
-   [Chart Tidak Muncul](MANUAL_BOOK.md#105-chart-tidak-muncul)

---

## 🆘 Butuh Bantuan?

1. 🔍 **Cek Troubleshooting** - [Manual Book Bab 10](MANUAL_BOOK.md#10-troubleshooting)
2. 📧 **Email Support** - support@karastock.com
3. 🐛 **Report Bug** - [GitHub Issues](https://github.com/ysfcsryo/KaraStock/issues)
4. 📚 **Baca Docs** - Dokumen yang relevan di atas

---

## 📝 Version Info

| Info             | Value               |
| ---------------- | ------------------- |
| **Version**      | 1.0.0               |
| **Release Date** | 25 Desember 2025    |
| **Status**       | ✅ Production Ready |
| **Last Update**  | 25 Desember 2025    |

---

## 🎉 Selamat Menggunakan!

**KaraStock** dikembangkan untuk membantu UMKM Lapak Karawo mengoptimalkan manajemen stok dan meningkatkan efisiensi bisnis melalui teknologi Decision Support System.

---

_© 2025 KaraStock - Decision Support System_
