# Quick Start - Sistem Login KaraStock

## ✅ Setup Selesai!

Sistem autentikasi KaraStock sudah siap digunakan dengan fitur:

### 🔐 Fitur Login
- Halaman login dengan design modern
- Validasi email & password
- Remember me (ingat saya)
- Flash message untuk notifikasi

### 👤 Fitur Profile  
- Menu profile di sidebar (bawah kiri)
- Dropdown dengan opsi:
  - Profil Saya
  - Logout
- Halaman detail profile user

### 🛡️ Security
- Semua halaman protected dengan middleware auth
- Session management yang aman
- CSRF protection

---

## 🚀 Cara Login

### Akses Aplikasi
```
URL: http://localhost/karastock
```

### Default Admin
```
Email    : admin@karastock.com
Password : admin123
```

### Langkah Login
1. Buka browser, akses aplikasi
2. Otomatis diarahkan ke halaman login
3. Masukkan email dan password di atas
4. Klik tombol "Masuk"
5. Anda akan masuk ke dashboard

---

## 📋 Menu di Sidebar

Setelah login, Anda akan melihat menu:

1. **Upload & Analisa** - Upload file CSV
2. **Hasil Analisa** - Lihat hasil prediksi
3. **Riwayat Analisa** - History upload

**Di bagian bawah sidebar:**
4. **Admin KaraStock** (nama user) - Klik untuk dropdown
   - Profil Saya
   - Logout

---

## 🔄 Cara Logout

**Opsi 1: Dari Sidebar**
1. Klik nama user di bawah sidebar
2. Pilih "Logout"

**Opsi 2: Dari Halaman Profile**
1. Klik nama user di sidebar
2. Pilih "Profil Saya"
3. Klik tombol "Logout" merah

---

## ⚙️ Konfigurasi Tambahan (Opsional)

### Menambah User Baru

```bash
php artisan tinker
```

```php
\App\Models\User::create([
    'name' => 'User Baru',
    'email' => 'userbaru@email.com',
    'password' => bcrypt('password123')
]);
```

### Ganti Password Admin

```bash
php artisan tinker
```

```php
$admin = \App\Models\User::where('email', 'admin@karastock.com')->first();
$admin->password = bcrypt('passwordbaru');
$admin->save();
```

---

## 🐛 Troubleshooting

### Tidak bisa login?

```bash
# Clear cache
php artisan config:clear
php artisan cache:clear

# Pastikan user ada
php artisan db:seed --class=UserSeeder
```

### Halaman blank/error?

```bash
# Regenerate key
php artisan key:generate

# Dump autoload
composer dump-autoload
```

---

## 📁 File Penting

| File | Fungsi |
|------|--------|
| `AuthController.php` | Logic login/logout |
| `auth/login.blade.php` | Tampilan login |
| `auth/profile.blade.php` | Tampilan profile |
| `layout/main.blade.php` | Layout dengan menu profile |
| `routes/web.php` | Route dengan middleware auth |

---

## 💡 Tips

1. **Jangan lupa logout** saat selesai menggunakan sistem
2. **Gunakan Remember Me** jika menggunakan komputer pribadi
3. **Ganti password default** untuk keamanan
4. **Backup database** sebelum membuat perubahan

---

## 📞 Dokumentasi Lengkap

- **LOGIN_GUIDE.md** - Panduan login lengkap
- **AUTH_UPDATE.md** - Detail perubahan sistem
- **README.md** - Dokumentasi utama aplikasi

---

**✨ Sistem siap digunakan!** Silakan login dan mulai analisa stok barang Anda.
