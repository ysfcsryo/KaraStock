# Panduan Login KaraStock

## Default Credentials

Gunakan kredensial berikut untuk login ke sistem:

```
Email    : admin@karastock.com
Password : admin123
```

## Cara Login

1. Akses aplikasi di browser
2. Anda akan diarahkan otomatis ke halaman login
3. Masukkan email dan password di atas
4. Klik tombol "Masuk"
5. Anda akan diarahkan ke dashboard utama

## Fitur Autentikasi

- **Login**: Halaman login dengan validasi email dan password
- **Remember Me**: Opsi untuk tetap login
- **Logout**: Tersedia di sidebar menu Profile
- **Profile**: Lihat informasi user yang sedang login
- **Protected Routes**: Semua halaman sistem memerlukan login terlebih dahulu

## Menambah User Baru

Jika ingin menambah user baru, jalankan perintah berikut di terminal:

```bash
php artisan tinker
```

Lalu ketik:

```php
\App\Models\User::create([
    'name' => 'Nama User',
    'email' => 'email@contoh.com',
    'password' => bcrypt('password123')
]);
```

## Mengganti Password

Untuk mengganti password user yang ada:

```bash
php artisan tinker
```

Lalu:

```php
$user = \App\Models\User::where('email', 'admin@karastock.com')->first();
$user->password = bcrypt('password_baru');
$user->save();
```

## Troubleshooting

### Tidak bisa login
- Pastikan database sudah di-migrate
- Pastikan user seeder sudah dijalankan
- Cek koneksi database di file `.env`

### Session tidak tersimpan
- Pastikan APP_KEY sudah di-generate: `php artisan key:generate`
- Clear cache: `php artisan config:clear`
- Clear session: `php artisan session:clear`
