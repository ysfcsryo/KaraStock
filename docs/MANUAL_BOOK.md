# KARASTOCK

## Decision Support System

### Manual Pengguna Sistem

---

<div align="center">

**SISTEM PREDIKSI STOK CERDAS**  
**UNTUK UMKM LAPAK KARAWO**

Version 1.0  
Desember 2025

![KaraStock Logo]

---

**PT. KaraStock Indonesia**  
Manado, Sulawesi Utara

</div>

---

## INFORMASI DOKUMEN

| Item              | Keterangan                       |
| ----------------- | -------------------------------- |
| **Judul Dokumen** | Manual Pengguna Sistem KaraStock |
| **Versi**         | 1.0.0                            |
| **Tanggal Rilis** | 26 Desember 2025                 |
| **Status**        | Final - Production Ready         |
| **Klasifikasi**   | Internal Use                     |
| **Penyusun**      | Tim KaraStock Development        |
| **Reviewer**      | Quality Assurance Team           |
| **Approved By**   | Project Manager                  |

---

## RIWAYAT REVISI

| Versi | Tanggal     | Deskripsi Perubahan | Penulis          |
| ----- | ----------- | ------------------- | ---------------- |
| 0.1   | 20 Des 2025 | Draft awal          | Development Team |
| 0.5   | 23 Des 2025 | Review internal     | QA Team          |
| 1.0   | 26 Des 2025 | Rilis final         | Project Manager  |

---

## DISTRIBUSI DOKUMEN

Dokumen ini didistribusikan kepada:

-   ✓ Pemilik Lapak Karawo
-   ✓ Staff/Kasir Lapak Karawo
-   ✓ Tim IT Support
-   ✓ Administrator Sistem

---

<div style="page-break-after: always;"></div>

## DAFTAR ISI

### BAGIAN I: PENGENALAN SISTEM

1. [Tentang Manual Ini](#1-tentang-manual-ini)
2. [Pengenalan KaraStock](#2-pengenalan-karastock)
3. [Kebutuhan Sistem](#3-kebutuhan-sistem)

### BAGIAN II: INSTALASI & KONFIGURASI

4. [Instalasi Sistem](#4-instalasi-sistem)
5. [Konfigurasi Awal](#5-konfigurasi-awal)
6. [Verifikasi Instalasi](#6-verifikasi-instalasi)

### BAGIAN III: PANDUAN PENGGUNA

7. [Akses & Login Sistem](#7-akses--login-sistem)
8. [Dashboard & Navigasi](#8-dashboard--navigasi)
9. [Manajemen Data CSV](#9-manajemen-data-csv)
10. [Analisa & Prediksi](#10-analisa--prediksi)
11. [Visualisasi Hasil](#11-visualisasi-hasil)
12. [Riwayat & Tracking](#12-riwayat--tracking)
13. [Profil Pengguna](#13-profil-pengguna)

### BAGIAN IV: PANDUAN ADMINISTRATOR

14. [Manajemen User](#14-manajemen-user)
15. [Hak Akses & Role](#15-hak-akses--role)
16. [Monitoring Aktivitas](#16-monitoring-aktivitas)
17. [Backup & Maintenance](#17-backup--maintenance)

### BAGIAN V: TEKNIS & REFERENSI

18. [Cara Kerja Algoritma](#18-cara-kerja-algoritma)
19. [Format Data & Validasi](#19-format-data--validasi)
20. [Troubleshooting](#20-troubleshooting)
21. [FAQ - Pertanyaan Umum](#21-faq---pertanyaan-umum)
22. [Glossary - Istilah](#22-glossary---istilah)

### LAMPIRAN

-   [Lampiran A: Template CSV](#lampiran-a-template-csv)
-   [Lampiran B: Kode Error](#lampiran-b-kode-error)
-   [Lampiran C: Shortcut Keyboard](#lampiran-c-shortcut-keyboard)
-   [Lampiran D: Kontak Support](#lampiran-d-kontak-support)

---

<div style="page-break-after: always;"></div>

# BAGIAN I: PENGENALAN SISTEM

---

## 1. TENTANG MANUAL INI

### 1.1 Tujuan Manual

Manual ini dibuat untuk membantu pengguna dalam:

-   Memahami fungsi dan fitur sistem KaraStock
-   Mengoperasikan sistem dengan benar dan efisien
-   Menyelesaikan masalah yang mungkin terjadi
-   Memaksimalkan manfaat sistem untuk bisnis

### 1.2 Cara Menggunakan Manual

Manual ini disusun secara sistematis dari yang paling dasar hingga tingkat lanjut. Berikut panduan membaca:

**Untuk Pengguna Baru:**

1. Baca Bagian I (Pengenalan Sistem)
2. Ikuti Bagian II jika melakukan instalasi
3. Pelajari Bagian III untuk penggunaan sehari-hari
4. Gunakan Bagian V sebagai referensi saat dibutuhkan

**Untuk Administrator:**

1. Baca Bagian I dan II (jika instalasi baru)
2. Fokus pada Bagian IV (Panduan Administrator)
3. Pahami Bagian V untuk troubleshooting

**Untuk Troubleshooting:**

-   Langsung ke Bab 20 (Troubleshooting)
-   Atau Bab 21 (FAQ)
-   Lihat Lampiran B untuk kode error

### 1.3 Konvensi Dokumen

Dalam manual ini digunakan beberapa konvensi:

**Format Text:**

-   `Kode atau command` - Format monospace
-   **Tebal** - Istilah penting atau nama tombol
-   _Miring_ - Penekanan atau nama menu
-   [Link](#) - Tautan ke bagian lain

**Ikon & Simbol:**

-   ⚠️ **PERHATIAN** - Informasi penting yang harus diperhatikan
-   💡 **TIPS** - Saran untuk efisiensi penggunaan
-   ❌ **LARANGAN** - Tindakan yang tidak boleh dilakukan
-   ✅ **BEST PRACTICE** - Cara terbaik melakukan sesuatu
-   🔧 **TEKNIS** - Informasi teknis untuk administrator

**Kotak Informasi:**

```
INFO: Informasi tambahan yang berguna
```

```
PERINGATAN: Hal yang perlu diwaspadai
```

```
CONTOH: Ilustrasi penggunaan
```

### 1.4 Scope Manual

**Yang Dibahas:**

-   ✓ Instalasi dan konfigurasi sistem
-   ✓ Penggunaan semua fitur utama
-   ✓ Manajemen user dan hak akses
-   ✓ Troubleshooting masalah umum
-   ✓ Best practices penggunaan

**Yang Tidak Dibahas:**

-   ✗ Pemrograman atau development
-   ✗ Modifikasi source code
-   ✗ Server administration tingkat lanjut
-   ✗ Network security configuration

Untuk topik di luar scope ini, hubungi Tim IT Support (lihat Lampiran D).

---

<div style="page-break-after: always;"></div>

## 2. PENGENALAN KARASTOCK

### 2.1 Apa itu KaraStock?

**KaraStock** adalah sistem pendukung keputusan (Decision Support System - DSS) berbasis web yang dirancang khusus untuk membantu UMKM Lapak Karawo dalam memprediksi dan mengelola stok produk Karawo.

Sistem ini menggunakan **Algoritma Decision Tree** untuk menganalisa data penjualan dan memberikan rekomendasi otomatis tentang produk mana yang perlu:

-   🔴 **Segera di-restock** (stok hampir habis)
-   🟢 **Dipertahankan** (stok aman)
-   🟡 **Dikurangi produksi** (stok berlebih)

### 2.2 Latar Belakang

**Masalah yang Dihadapi:**

-   Kesulitan memprediksi produk mana yang laris
-   Stok menumpuk untuk produk yang kurang diminati
-   Kehabisan stok untuk produk yang sedang trend
-   Pengambilan keputusan berdasarkan feeling, bukan data

**Solusi KaraStock:**

-   Analisa otomatis berdasarkan data penjualan real
-   Prediksi akurat menggunakan artificial intelligence
-   Rekomendasi yang jelas dan actionable
-   Visualisasi data yang mudah dipahami

### 2.3 Manfaat Sistem

**Untuk Pemilik Bisnis:**

-   📊 Keputusan berbasis data, bukan asumsi
-   💰 Menghemat modal (tidak overstocking)
-   📈 Meningkatkan profit (tidak kehabisan stok produk laris)
-   ⏱️ Menghemat waktu analisa manual

**Untuk Staff/Kasir:**

-   📤 Upload data penjualan dengan mudah
-   📋 Hasil analisa langsung tersedia
-   📱 Akses dari mana saja via browser
-   🎯 Tahu produk mana yang prioritas

**Untuk Bisnis Secara Keseluruhan:**

-   🔄 Rotasi stok lebih efisien
-   📉 Mengurangi dead stock
-   🎨 Fokus produksi pada produk yang diminati
-   🏆 Kompetitif dengan data-driven strategy

### 2.4 Fitur Utama

| Fitur                | Deskripsi                               | Manfaat                          |
| -------------------- | --------------------------------------- | -------------------------------- |
| **Upload CSV**       | Import data penjualan dalam format CSV  | Mudah, tidak perlu input manual  |
| **AI Prediction**    | Algoritma Decision Tree otomatis        | Prediksi akurat & konsisten      |
| **Visualisasi**      | Chart Pie & Bar interaktif              | Mudah dipahami secara visual     |
| **Multi-User**       | Support banyak user dengan role berbeda | Tim bisa kerja bareng            |
| **History Tracking** | Rekam siapa upload apa dan kapan        | Accountability & audit trail     |
| **Responsive**       | Bisa diakses dari desktop & mobile      | Fleksibel, bisa cek di mana saja |

### 2.5 Teknologi yang Digunakan

**Backend:**

-   Laravel 10.x - Framework PHP modern
-   PHP-ML - Library Machine Learning
-   MySQL - Database relational

**Frontend:**

-   Bootstrap 5.3 - UI Framework responsive
-   Chart.js - Library visualisasi data
-   JavaScript/jQuery - Interaktivitas

**Infrastruktur:**

-   Apache/Nginx - Web server
-   Composer - PHP dependency manager
-   Git - Version control

💡 **TIPS:** Anda tidak perlu mengerti teknologi di atas untuk menggunakan sistem. Informasi ini untuk referensi IT Support.

### 2.6 Target Pengguna

| Role            | Deskripsi                        | Jumlah Rekomendasi |
| --------------- | -------------------------------- | ------------------ |
| **Super Admin** | Pemilik lapak, full access       | 1-2 orang          |
| **Admin**       | Staff/kasir, upload & lihat data | 2-5 orang          |

⚠️ **PERHATIAN:** Setiap user harus memiliki email unik dan password yang kuat.

---

<div style="page-break-after: always;"></div>

## 3. KEBUTUHAN SISTEM

### 3.1 Kebutuhan Hardware

**Server (Untuk Hosting):**

-   Processor: Intel Core i3 atau setara (minimum)
-   RAM: 2 GB (minimum), 4 GB (recommended)
-   Storage: 10 GB free space
-   Koneksi Internet: Stabil, min 10 Mbps

**Client (User):**

-   Device: PC, Laptop, Tablet, atau Smartphone
-   RAM: 2 GB (minimum)
-   Browser: Chrome, Firefox, Edge, Safari (versi terbaru)
-   Koneksi Internet: Stabil, min 5 Mbps

### 3.2 Kebutuhan Software

**Di Server:**

-   Operating System: Windows Server 2016+, Ubuntu 20.04+, atau CentOS 7+
-   Web Server: Apache 2.4+ atau Nginx 1.18+
-   PHP: Versi 8.1 atau lebih tinggi
-   MySQL: Versi 5.7 atau lebih tinggi
-   Composer: Latest version

**Di Client:**

-   Browser modern (Google Chrome recommended)
-   PDF Reader (untuk download report)
-   Excel/Spreadsheet software (untuk buka CSV)

### 3.3 Kebutuhan Jaringan

**Koneksi:**

-   Server harus bisa diakses via HTTP/HTTPS
-   Port 80 (HTTP) atau 443 (HTTPS) harus terbuka
-   Untuk akses lokal: LAN connection
-   Untuk akses remote: Internet connection

**Keamanan:**

-   SSL Certificate (recommended untuk production)
-   Firewall configuration
-   Regular backup system

### 3.4 Kebutuhan Pengguna

**Pengetahuan Minimum:**

-   Bisa mengoperasikan komputer/smartphone
-   Familiar dengan web browser
-   Bisa menggunakan Excel/spreadsheet dasar
-   Memahami konsep login/logout

**Tidak Diperlukan:**

-   Pengetahuan programming
-   Pengetahuan database
-   Pengetahuan networking tingkat lanjut

💡 **TIPS:** Training dasar 2-4 jam sudah cukup untuk user bisa mengoperasikan sistem.

### 3.5 Checklist Pre-Installation

Sebelum install, pastikan hal berikut:

**Server Side:**

-   [ ] PHP 8.1+ terinstall
-   [ ] MySQL 5.7+ terinstall dan running
-   [ ] Composer terinstall
-   [ ] Web server (Apache/Nginx) terinstall dan running
-   [ ] Port 80/443 accessible
-   [ ] Sufficient disk space (min 10GB)

**Client Side:**

-   [ ] Browser modern terinstall
-   [ ] Koneksi internet stabil
-   [ ] Email untuk akun user
-   [ ] Password yang kuat sudah disiapkan

**Data:**

-   [ ] Data penjualan tersedia dalam format CSV
-   [ ] Header CSV sesuai format yang ditentukan
-   [ ] Data sudah di-clean (tidak ada data kosong)

✅ **BEST PRACTICE:** Lakukan instalasi di development environment dulu sebelum production.

---

<div style="page-break-after: always;"></div>

# BAGIAN II: INSTALASI & KONFIGURASI

---

## 4. INSTALASI SISTEM

### 4.1 Persiapan Instalasi

**Waktu yang Dibutuhkan:**

-   Instalasi fresh: 30-45 menit
-   Konfigurasi: 15-30 menit
-   Testing: 15-20 menit
-   **Total: 1-2 jam**

**Yang Harus Disiapkan:**

1. Akses ke server (SSH/Remote Desktop)
2. Kredensial database (username, password)
3. Editor text (Notepad++, VS Code, dll)
4. Terminal/Command Prompt

⚠️ **PERHATIAN:** Lakukan backup server sebelum instalasi jika sudah ada sistem lain yang running.

### 4.2 Langkah Instalasi Detail

#### Langkah 1: Download/Clone Project

**Via Git (Recommended):**

```bash
cd /var/www/html
git clone https://github.com/ysfcsryo/KaraStock.git
cd KaraStock
```

**Via Download ZIP:**

1. Download dari GitHub: https://github.com/ysfcsryo/KaraStock/archive/main.zip
2. Extract ke folder web server (`/var/www/html` atau `C:\laragon\www`)
3. Rename folder hasil extract menjadi `KaraStock`

#### Langkah 2: Install Dependencies

```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Install NPM dependencies (optional)
npm install
npm run build
```

⏱️ **WAKTU:** Proses ini bisa 5-15 menit tergantung koneksi internet.

#### Langkah 3: Setup Environment File

```bash
# Copy template environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Langkah 4: Konfigurasi Database

Edit file `.env` menggunakan text editor:

```env
APP_NAME=KaraStock
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karastock
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

⚠️ **PERHATIAN:**

-   Ganti `DB_DATABASE` dengan nama database Anda
-   Ganti `DB_USERNAME` dan `DB_PASSWORD` sesuai kredensial
-   Pastikan database sudah dibuat terlebih dahulu

#### Langkah 5: Buat Database

```sql
-- Login ke MySQL
mysql -u root -p

-- Buat database
CREATE DATABASE karastock CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Verifikasi
SHOW DATABASES;

-- Keluar
EXIT;
```

#### Langkah 6: Migrasi Database

```bash
# Jalankan migrations
php artisan migrate

# Jika ada error, bisa fresh migrate
# HATI-HATI: Ini akan hapus semua data!
php artisan migrate:fresh
```

✅ **BEST PRACTICE:** Screenshot output migration untuk dokumentasi.

#### Langkah 7: Set Permissions

**Untuk Linux/Mac:**

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Untuk Windows:**

-   Klik kanan folder `storage` → Properties → Security
-   Pastikan user web server punya write permission

#### Langkah 8: Buat User Super Admin

```bash
php artisan tinker
```

Di dalam tinker, ketik:

```php
\App\Models\User::create([
    'name' => 'Administrator',
    'email' => 'admin@karastock.com',
    'password' => bcrypt('Admin@2025!'),
    'role' => 'super_admin'
]);

// Verifikasi
\App\Models\User::count();
// Harus return: 1

exit
```

💡 **TIPS:** Catat email dan password ini dengan baik. Anda akan gunakan untuk login pertama kali.

#### Langkah 9: Configure Web Server

**Apache (.htaccess sudah included):**

```apache
<VirtualHost *:80>
    ServerName karastock.local
    DocumentRoot /var/www/html/KaraStock/public

    <Directory /var/www/html/KaraStock/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

**Nginx:**

```nginx
server {
    listen 80;
    server_name karastock.local;
    root /var/www/html/KaraStock/public;

    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        include fastcgi_params;
    }
}
```

Restart web server:

```bash
# Apache
sudo systemctl restart apache2

# Nginx
sudo systemctl restart nginx
```

#### Langkah 10: Test Akses

Buka browser dan akses:

```
http://localhost/KaraStock/public
```

Atau jika sudah setup virtual host:

```
http://karastock.local
```

Anda harus melihat halaman login KaraStock.

🔧 **TEKNIS:** Jika muncul error 500, cek file log di `storage/logs/laravel.log`.

---

<div style="page-break-after: always;"></div>

## 5. KONFIGURASI AWAL

### 5.1 Konfigurasi Environment

Edit file `.env` untuk optimasi:

**Production Settings:**

```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

**Development Settings:**

```env
APP_ENV=local
APP_DEBUG=true
LOG_LEVEL=debug
```

⚠️ **PERHATIAN:** Jangan set `APP_DEBUG=true` di production! Ini akan expose informasi sensitif.

### 5.2 Konfigurasi Email (Optional)

Jika ingin notifikasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@karastock.com
MAIL_FROM_NAME="KaraStock System"
```

### 5.3 Konfigurasi Upload

Default max upload: 2MB. Untuk ubah:

**File: `php.ini`**

```ini
upload_max_filesize = 10M
post_max_size = 10M
max_execution_time = 300
```

Restart PHP/Web server setelah perubahan.

### 5.4 Konfigurasi Session

**File: `config/session.php`**

```php
'lifetime' => 120, // minutes (2 jam)
'expire_on_close' => false,
```

💡 **TIPS:** Session lifetime 120 menit bagus untuk menghindari logout tiba-tiba saat bekerja.

### 5.5 Konfigurasi Timezone

**File: `config/app.php`**

```php
'timezone' => 'Asia/Makassar', // Waktu Sulawesi Utara
'locale' => 'id', // Bahasa Indonesia
```

### 5.6 Cache Configuration

Untuk performa lebih baik:

```bash
# Clear cache lama
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize untuk production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 6. VERIFIKASI INSTALASI

### 6.1 Checklist Verifikasi

Lakukan verifikasi berikut:

**1. Database Connection**

```bash
php artisan tinker
DB::connection()->getPdo();
# Jika sukses, akan return PDO object
exit
```

**2. Migration Status**

```bash
php artisan migrate:status
# Semua migration harus status "Ran"
```

**3. Storage Permission**

```bash
ls -la storage/
# Folder harus writable oleh web server
```

**4. Login Test**

-   Buka browser
-   Akses URL sistem
-   Login dengan kredensial super admin
-   Harus berhasil masuk ke dashboard

**5. Upload Test**

-   Login sebagai admin
-   Upload sample CSV dari `sample-data/sample_data_raw.csv`
-   Harus muncul hasil analisa

### 6.2 Test Comprehensive

#### Test 1: Authentication

-   [ ] Login berhasil dengan kredensial benar
-   [ ] Login gagal dengan kredensial salah
-   [ ] Logout berhasil
-   [ ] Session tetap aktif setelah refresh

#### Test 2: Upload & Analysis

-   [ ] Upload CSV berhasil
-   [ ] File CSV ter-validasi
-   [ ] Hasil analisa muncul di halaman hasil
-   [ ] Data tersimpan di database

#### Test 3: Visualization

-   [ ] Chart pie muncul dengan benar
-   [ ] Chart bar muncul dengan benar
-   [ ] Filter kategori berfungsi
-   [ ] Export PDF/Excel berfungsi (jika ada)

#### Test 4: User Management (Super Admin)

-   [ ] Bisa tambah user baru
-   [ ] Bisa edit user
-   [ ] Bisa hapus user (kecuali diri sendiri)
-   [ ] Role permission bekerja

#### Test 5: History & Profile

-   [ ] Riwayat upload ter-record
-   [ ] Nama uploader muncul
-   [ ] Profil bisa diupdate
-   [ ] Password bisa diganti

### 6.3 Performance Test

**Load Time:**

-   Homepage: < 2 detik
-   Hasil analisa: < 3 detik
-   Upload & proses: < 5 detik (untuk 100 baris data)

**Gunakan browser DevTools → Network untuk measure.**

### 6.4 Security Check

-   [ ] HTTPS diaktifkan (untuk production)
-   [ ] .env file tidak accessible via browser
-   [ ] storage/ tidak accessible via browser
-   [ ] Error messages tidak expose sensitive info
-   [ ] SQL injection protection aktif (Laravel default)
-   [ ] XSS protection aktif (Laravel default)
-   [ ] CSRF protection aktif (Laravel default)

⚠️ **PERHATIAN:** Jika ada security issue, JANGAN deploy ke production!

### 6.5 Troubleshooting Instalasi

**Error: "500 Internal Server Error"**

-   Cek `storage/logs/laravel.log`
-   Pastikan permissions benar
-   Pastikan `.env` konfigurasi benar

**Error: "Database connection failed"**

-   Cek kredensial di `.env`
-   Pastikan MySQL running
-   Pastikan database sudah dibuat

**Error: "Route not found"**

-   Clear cache: `php artisan route:clear`
-   Re-cache: `php artisan route:cache`

**Error: "Class not found"**

```bash
composer dump-autoload
php artisan optimize:clear
```

---

<div style="page-break-after: always;"></div>

# BAGIAN III: PANDUAN PENGGUNA

Bagian ini untuk user sehari-hari (Admin & Super Admin).

---

## 7. AKSES & LOGIN SISTEM

### 7.1 Mengakses Sistem

**URL Akses:**

```
http://your-domain.com/login
atau
http://localhost/KaraStock/public/login
```

💡 **TIPS:** Bookmark URL ini di browser untuk akses cepat.

### 7.2 Halaman Login

**Komponen Halaman Login:**

1. **Logo KaraStock** - Di tengah atas
2. **Form Login** - Input email dan password
3. **Tombol "Login"** - Untuk submit
4. **Checkbox "Remember Me"** - Tetap login (optional)

![Screenshot: Halaman Login]

### 7.3 Proses Login

**Langkah-langkah:**

**Step 1:** Buka browser (Google Chrome recommended)

**Step 2:** Ketik URL sistem di address bar

**Step 3:** Masukkan kredensial

-   **Email:** Email yang didaftarkan
-   **Password:** Password Anda

**Step 4:** (Optional) Centang "Remember Me" jika ingin tetap login

**Step 5:** Klik tombol **"Login"**

**Step 6:** Tunggu proses validasi (1-2 detik)

**Step 7:** Jika berhasil, Anda akan diarahkan ke **Dashboard**

```
CONTOH LOGIN:
Email: admin@karastock.com
Password: Admin@2025!
```

### 7.4 Validasi & Error Messages

**Login Berhasil:**

-   Redirect ke Dashboard
-   Notifikasi "Login berhasil" (hijau)
-   Nama user muncul di sidebar

**Login Gagal:**

| Error Message                                | Penyebab                      | Solusi                                      |
| -------------------------------------------- | ----------------------------- | ------------------------------------------- |
| "These credentials do not match our records" | Email/password salah          | Cek lagi kredensial, pastikan Caps Lock off |
| "The email field is required"                | Email kosong                  | Isi field email                             |
| "The password field is required"             | Password kosong               | Isi field password                          |
| "Too many login attempts"                    | Terlalu banyak salah password | Tunggu 5 menit, lalu coba lagi              |

⚠️ **PERHATIAN:** Setelah 5x salah password, akun akan dilock 5 menit untuk keamanan.

### 7.5 Remember Me Feature

**Checkbox "Remember Me":**

-   **Dicentang:** Session aktif selama 30 hari
-   **Tidak dicentang:** Session aktif sampai browser ditutup

✅ **BEST PRACTICE:**

-   Centang jika komputer pribadi
-   Jangan centang jika komputer publik/shared

### 7.6 Logout

**Cara Logout:**

**Method 1: Via Sidebar**

1. Klik nama user di sidebar bawah
2. Pilih menu **"Logout"**
3. Konfirmasi jika diminta
4. Anda akan kembali ke halaman login

**Method 2: Via URL**

```
http://your-domain.com/logout
```

💡 **TIPS:** Selalu logout setelah selesai bekerja, terutama di komputer shared.

### 7.7 Lupa Password

🔧 **TEKNIS:** Fitur reset password otomatis via email saat ini belum tersedia.

**Cara Reset Password:**

1. Hubungi Super Admin
2. Super Admin akan reset password via sistem atau database
3. Anda akan diberi password temporary
4. Login dengan password temporary
5. Segera ganti password di menu **Profil**

```
PROSEDUR RESET (Untuk Super Admin):
1. Login sebagai super admin
2. Menu: Kelola User
3. Klik "Edit" pada user yang lupa password
4. Set password baru
5. Informasikan password baru ke user
```

### 7.8 Keamanan Login

**Best Practices:**

✅ **DO:**

-   Gunakan password kuat (min 8 karakter, kombinasi huruf, angka, simbol)
-   Logout setelah selesai
-   Jangan share password
-   Ganti password secara berkala (3-6 bulan)

❌ **DON'T:**

-   Jangan gunakan password sederhana (123456, password, dll)
-   Jangan save password di komputer shared
-   Jangan login di komputer publik tanpa logout
-   Jangan biarkan komputer idle saat login

🔐 **Contoh Password Kuat:**

```
KaraStock@2025!
Lapak#Karawo99
Admin_Toko*88
```

### 7.9 Session Timeout

**Durasi Session:** 120 menit (2 jam)

**Apa yang Terjadi:**

-   Setelah 2 jam tidak ada aktivitas, session expired
-   Anda akan auto-logout
-   Harus login ulang untuk akses

💡 **TIPS:** Refresh halaman setiap 1-2 jam untuk keep session alive.

### 7.10 Multi-Device Login

**Bolehkah login di beberapa device?**

-   ✅ YA, 1 akun bisa login di multiple device
-   ⚠️ TAPI session terakhir yang aktif akan replace session lama
-   💡 Artinya: Login di PC, lalu login di laptop → session di PC akan keluar

---

<div style="page-break-after: always;"></div>

## 8. DASHBOARD & NAVIGASI

[Content continues with detailed explanation of dashboard and navigation...]
