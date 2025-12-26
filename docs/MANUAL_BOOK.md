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

| Versi | Tanggal     | Deskripsi Perubahan                          | Penulis          |
| ----- | ----------- | -------------------------------------------- | ---------------- |
| 0.1   | 20 Des 2025 | Draft awal                                   | Development Team |
| 0.5   | 23 Des 2025 | Review internal                              | QA Team          |
| 1.0   | 26 Des 2025 | Rilis final                                  | Project Manager  |
| 1.1   | 26 Des 2025 | Update fitur profile photo & UI improvements | Development Team |

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
14. [Deployment & Hosting](#14-deployment--hosting)

##---

<div style="page-break-after: always;"></div>

## 13. PROFIL PENGGUNA

### 13.1 Mengakses Halaman Profil

**Cara Akses:**

**Method 1: Via Navbar**

1. Klik **avatar/foto profil** di pojok kanan atas navbar
2. Klik menu **"Edit Profil"**
3. Anda akan diarahkan ke halaman profil

**Method 2: Via URL**

```
http://your-domain.com/profile
```

### 13.2 Informasi Profil

Halaman profil menampilkan:

**Header Section:**

-   🎨 Background gradient dengan pattern
-   👤 Foto profil (jika sudah diupload) atau avatar default
-   📧 Nama pengguna
-   🏷️ Role/Jabatan (Super Admin atau Admin)

**Info Cards:**

-   ✉️ Email address
-   📅 Tanggal terdaftar
-   ⏰ Terakhir aktif

**Statistics:**

-   ✅ Status akun (Aktif)
-   📆 Waktu bergabung
-   🕒 Last activity

### 13.3 Upload & Edit Foto Profil

**Cara Upload Foto Profil:**

**Step 1:** Klik **icon kamera** (📷) pada avatar

**Step 2:** Pilih foto dari komputer Anda

-   Format: JPG, PNG, GIF
-   Ukuran maksimal: 2MB
-   Rekomendasi: 500x500px untuk hasil terbaik

**Step 3:** Preview foto akan muncul di modal popup

-   Lihat preview dalam format circular
-   Pastikan foto terlihat bagus

**Step 4:** Klik **"Upload Sekarang"** untuk konfirmasi

-   Foto akan langsung disimpan
-   Loading indicator akan muncul
-   Notifikasi sukses akan tampil

**Step 5:** Foto profil Anda ter-update di:

-   ✓ Navbar (pojok kanan atas)
-   ✓ Sidebar (jika masih ada)
-   ✓ Dropdown menu
-   ✓ Halaman profile

**Hapus Foto Profil:**

1. Scroll ke bawah di halaman profil
2. Klik tombol **"Hapus Foto"**
3. Konfirmasi di modal popup
4. Foto akan dihapus, kembali ke avatar default

⚠️ **PERHATIAN:**

-   Hanya foto dengan format JPG, PNG, atau GIF yang diterima
-   File lebih dari 2MB akan ditolak
-   Foto lama otomatis dihapus saat upload foto baru

💡 **TIPS:**

-   Gunakan foto wajah untuk identifikasi mudah
-   Crop foto menjadi square (1:1 ratio) sebelum upload
-   Compress foto jika ukuran terlalu besar

### 13.4 Edit Informasi Profil

**Data yang Bisa Diubah:**

**1. Nama Pengguna**

-   Klik pada field nama
-   Ketik nama baru
-   Klik **"Simpan Perubahan"**

**2. Email Address**

-   Klik pada field email
-   Ketik email baru
-   Email harus unik (tidak dipakai user lain)
-   Klik **"Simpan Perubahan"**

⚠️ **PERHATIAN:**

-   Email digunakan untuk login
-   Pastikan email valid dan aktif
-   Setelah ganti email, gunakan email baru untuk login berikutnya

### 13.5 Ganti Password

🔧 **TEKNIS:** Fitur ganti password saat ini harus melalui admin.

**Prosedur Ganti Password:**

1. Hubungi Super Admin
2. Minta reset password
3. Super Admin akan set password temporary
4. Login dengan password baru
5. (Optional) Minta admin set password permanent sesuai keinginan

**Best Practice Password:**

```
✅ Minimal 8 karakter
✅ Kombinasi huruf besar & kecil
✅ Mengandung angka
✅ Mengandung simbol (@, #, !, dll)
❌ Jangan gunakan: 123456, password, nama sendiri
```

### 13.6 Validasi & Error Messages

**Upload Foto:**

| Error Message                             | Penyebab           | Solusi                             |
| ----------------------------------------- | ------------------ | ---------------------------------- |
| "Ukuran file terlalu besar! Maksimal 2MB" | File > 2MB         | Compress foto atau pilih foto lain |
| "File harus berupa gambar!"               | Bukan format image | Upload JPG, PNG, atau GIF          |
| "Foto profile berhasil diupload!"         | Sukses             | -                                  |

**Edit Data:**

| Error Message                      | Penyebab                      | Solusi             |
| ---------------------------------- | ----------------------------- | ------------------ |
| "The email has already been taken" | Email sudah dipakai user lain | Gunakan email lain |
| "The name field is required"       | Nama kosong                   | Isi field nama     |
| "Profile berhasil diupdate!"       | Sukses                        | -                  |

### 13.7 Keamanan Profil

**Proteksi Data:**

-   ✅ Hanya pemilik akun yang bisa edit profil sendiri
-   ✅ Foto profil disimpan dengan nama unik (tidak bisa ditebak)
-   ✅ Email ter-validasi format dan uniqueness
-   ✅ Password ter-enkripsi (tidak bisa dilihat siapapun)

**Privacy:**

-   Foto profil visible untuk user lain di sistem
-   Email hanya visible untuk user sendiri dan super admin
-   Activity timestamp visible untuk semua user

### 13.8 Fitur Premium UI

**Design Modern:**

-   🎨 Gradient background dengan animasi float
-   💫 Avatar circular dengan border gradient
-   🎭 Modal popup untuk konfirmasi upload
-   ✨ Smooth transitions dan hover effects
-   🎯 Responsive design (mobile & desktop)

**User Experience:**

-   📸 Live preview sebelum upload
-   🔄 Auto-refresh avatar setelah upload
-   💾 Auto-save saat edit data
-   🎪 Loading indicators untuk feedback
-   ✅ Success notifications

**Modal Upload Preview:**

-   Preview foto dalam format circular 200x200px
-   Background gradient dengan border
-   Tombol "Batal" dan "Upload Sekarang"
-   Animasi slide-up dan zoom-in

**Modal Hapus Foto:**

-   Icon trash besar untuk visual cue
-   Pesan konfirmasi yang jelas
-   Tombol "Batal" dan "Hapus Foto"
-   Color coding merah untuk warning

### 13.9 Troubleshooting Profil

**Foto Tidak Muncul:**

-   Cek ukuran file (max 2MB)
-   Cek format file (JPG/PNG/GIF)
-   Cek koneksi internet
-   Hard refresh browser (Ctrl + F5)

**Gagal Update Data:**

-   Cek koneksi internet
-   Pastikan semua field terisi
-   Cek apakah email sudah dipakai user lain
-   Logout dan login kembali

**Modal Tidak Muncul:**

-   Clear browser cache
-   Hard refresh (Ctrl + F5)
-   Coba browser lain
-   Disable browser extensions yang mungkin block popup

---

<div style="page-break-after: always;"></div>

## 14. DEPLOYMENT & HOSTING

### 14.1 Persiapan Sebelum Hosting

**Checklist Pre-Deployment:**

✅ **File & Folder:**

-   Semua file blade sudah bebas inline styles
-   CSS terpusat di `public/css/app.css`
-   Template CSV sudah berisi data contoh
-   Folder `public/uploads/profiles/` sudah ada
-   Folder `storage/` memiliki permission yang benar

✅ **Konfigurasi:**

-   File `.env` sudah diatur untuk production
-   `APP_DEBUG=false` untuk keamanan
-   `APP_URL` sesuai domain hosting
-   Database credentials sudah benar
-   `APP_KEY` sudah di-generate

✅ **Database:**

-   Migration sudah dijalankan
-   Seeder sudah dijalankan (minimal user super admin)
-   Backup database development tersimpan

✅ **Testing:**

-   Login berhasil
-   Upload file CSV berfungsi
-   Analisa data berfungsi
-   Upload foto profil berfungsi
-   Semua halaman responsive

### 14.2 Konfigurasi Environment Production

**Edit file `.env` untuk production:**

```env
# Application
APP_NAME=KaraStock
APP_ENV=production
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxx
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (sesuaikan dengan hosting)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=karastock_db
DB_USERNAME=karastock_user
DB_PASSWORD=your_secure_password

# Session (untuk keamanan)
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_SECURE_COOKIE=true

# Cache (optional, untuk performa)
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

⚠️ **PENTING:**

-   Jangan commit file `.env` ke Git
-   Gunakan `.env.example` sebagai template
-   Simpan `.env` production dengan aman

### 14.3 Langkah-Langkah Deployment

**Method 1: Manual Upload (cPanel/FTP)**

**Step 1: Persiapan File**

```bash
# Di local development
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Step 2: Upload File ke Server**

-   Upload semua file kecuali `node_modules/` dan `.git/`
-   Pastikan struktur folder tetap sama
-   Upload ke folder `public_html/` atau sesuai konfigurasi hosting

**Step 3: Set Permission**

```bash
# Set permission untuk storage dan bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

**Step 4: Setup Database**

-   Buat database baru di cPanel MySQL
-   Buat user database dengan password kuat
-   Import database jika ada
-   Atau jalankan migration:

```bash
php artisan migrate --force
php artisan db:seed --force
```

**Step 5: Konfigurasi Web Server**

-   Document root harus mengarah ke folder `public/`
-   Buat file `.htaccess` jika belum ada
-   Enable `mod_rewrite` Apache

**Method 2: Git Deployment (Shared Hosting dengan SSH)**

```bash
# Clone repository
git clone https://github.com/yourrepo/karastock.git

# Masuk ke folder
cd karastock

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --force
php artisan db:seed --force

# Setup permission
chmod -R 775 storage bootstrap/cache
```

**Method 3: VPS/Dedicated Server (with Nginx)**

```nginx
# /etc/nginx/sites-available/karastock
server {
    listen 80;
    server_name yourdomain.com www.yourdomain.com;
    root /var/www/karastock/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 14.4 SSL Certificate (HTTPS)

**Mengapa Perlu SSL:**

-   ✅ Keamanan data (enkripsi)
-   ✅ Trust dari pengguna
-   ✅ SEO boost dari Google
-   ✅ Required untuk fitur modern browser

**Install SSL dengan Let's Encrypt (FREE):**

```bash
# Install Certbot
sudo apt install certbot python3-certbot-nginx

# Generate certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com

# Auto-renewal (cron job)
sudo certbot renew --dry-run
```

**Konfigurasi Laravel untuk HTTPS:**

```env
# .env
APP_URL=https://yourdomain.com
SESSION_SECURE_COOKIE=true
```

```php
// app/Providers/AppServiceProvider.php
public function boot()
{
    if ($this->app->environment('production')) {
        \URL::forceScheme('https');
    }
}
```

### 14.5 Optimasi Performance

**1. Enable OPcache (PHP)**

```ini
; php.ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60
```

**2. Laravel Caching**

```bash
# Cache configuration
php artisan config:cache

# Cache routes
php artisan route:cache

# Cache views
php artisan view:cache

# Clear all cache (jika ada update)
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

**3. Asset Optimization**

```bash
# Minify CSS/JS
npm run build

# Enable Gzip compression di .htaccess
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

**4. Database Optimization**

```bash
# Enable query cache
# Gunakan indexes pada kolom yang sering di-query
# Optimize tables berkala
OPTIMIZE TABLE users, histories;
```

### 14.6 Security Checklist

**✅ Keamanan Production:**

```env
# .env - WAJIB
APP_DEBUG=false
APP_ENV=production
SESSION_SECURE_COOKIE=true
```

**🔒 File Permissions:**

```bash
# Jangan 777!
chmod 755 /path/to/project
chmod -R 775 storage bootstrap/cache
chmod 644 .env
```

**🛡️ Web Server Security:**

```apache
# .htaccess - Protect sensitive files
<FilesMatch "^\.env">
    Order allow,deny
    Deny from all
</FilesMatch>

<FilesMatch "composer\.(json|lock)">
    Order allow,deny
    Deny from all
</FilesMatch>
```

**🔐 Database Security:**

-   Password kuat (min 16 karakter random)
-   Remote access disabled jika tidak perlu
-   Regular backup otomatis
-   User database hanya punya privilege yang diperlukan

### 14.7 Monitoring & Maintenance

**Logs Monitoring:**

```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Web server logs
tail -f /var/log/nginx/error.log
tail -f /var/log/apache2/error.log
```

**Backup Strategy:**

```bash
# Backup database daily
0 2 * * * mysqldump -u user -p password karastock_db > /backups/karastock_$(date +\%Y\%m\%d).sql

# Backup files weekly
0 3 * * 0 tar -czf /backups/karastock_files_$(date +\%Y\%m\%d).tar.gz /var/www/karastock
```

**Update Regular:**

```bash
# Update Laravel dependencies (security patches)
composer update --no-dev

# Clear cache after update
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 14.8 Troubleshooting Deployment

**500 Internal Server Error:**

-   Cek `storage/logs/laravel.log`
-   Pastikan permission folder benar (775)
-   Cek `.env` sudah ada dan benar
-   Pastikan `APP_KEY` sudah di-generate

**404 Not Found (All Routes):**

-   Pastikan document root ke `public/`
-   Enable `mod_rewrite` (Apache)
-   Cek file `.htaccess` ada di `public/`

**Database Connection Error:**

-   Cek credentials di `.env`
-   Cek database sudah dibuat
-   Cek user database punya akses
-   Test koneksi: `php artisan migrate:status`

**CSS/JS Not Loading:**

-   Jalankan `npm run build`
-   Cek `APP_URL` di `.env`
-   Clear browser cache
-   Cek permission folder `public/`

**File Upload Failed:**

-   Cek permission folder `storage/` dan `public/uploads/`
-   Cek `upload_max_filesize` dan `post_max_size` di php.ini
-   Cek disk space server

### 14.9 Post-Deployment Checklist

**✅ Verifikasi Setelah Deploy:**

1. **Access & Login**

    - [ ] Domain bisa diakses
    - [ ] Login berhasil
    - [ ] Session management berfungsi

2. **Core Functions**

    - [ ] Upload CSV berfungsi
    - [ ] Analisa data berfungsi
    - [ ] Download template berfungsi
    - [ ] Visualisasi hasil OK

3. **User Features**

    - [ ] Upload foto profil berfungsi
    - [ ] Edit profil berfungsi
    - [ ] Logout berfungsi
    - [ ] History tracking berfungsi

4. **Admin Features** (jika ada)

    - [ ] Kelola user berfungsi
    - [ ] View all history berfungsi
    - [ ] Export data berfungsi

5. **Performance & Security**

    - [ ] Page load < 3 detik
    - [ ] HTTPS aktif (SSL valid)
    - [ ] APP_DEBUG=false
    - [ ] Error pages custom (404, 500)

6. **Responsive Design**
    - [ ] Desktop view OK
    - [ ] Tablet view OK
    - [ ] Mobile view OK

**🎉 Jika semua checklist OK, sistem siap production!**

### 14.10 Contact & Support

**Untuk Bantuan Deployment:**

📧 **Email:** support@karastock.com  
💬 **WhatsApp:** +62 XXX-XXXX-XXXX  
🌐 **Website:** https://karastock.com  
📚 **Documentation:** https://docs.karastock.com

**Include saat request support:**

-   Laravel version: `php artisan --version`
-   PHP version: `php -v`
-   Server OS & Web server
-   Error logs dari `storage/logs/laravel.log`
-   Screenshot error (jika ada)

---

<div style="page-break-after: always;"></div>

# BAGIAN IV: PANDUAN ADMINISTRATOR

15. [Manajemen User](#15-manajemen-user)
16. [Hak Akses & Role](#16-hak-akses--role)
17. [Monitoring Aktivitas](#17-monitoring-aktivitas)
18. [Backup & Maintenance](#18-backup--maintenance)

### BAGIAN V: TEKNIS & REFERENSI

19. [Cara Kerja Algoritma](#19-cara-kerja-algoritma)
20. [Format Data & Validasi](#20-format-data--validasi)
21. [Troubleshooting](#21-troubleshooting)
22. [FAQ - Pertanyaan Umum](#22-faq---pertanyaan-umum)
23. [Glossary - Istilah](#23-glossary---istilah)

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
