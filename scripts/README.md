# Scripts - KaraStock Utilities

Folder ini berisi script utilities untuk membantu development dan maintenance KaraStock.

## Script yang Tersedia

### 🎨 sync-css.bat

**Fungsi**: Sync CSS dari `resources/css/app.css` ke `public/css/app.css`

**Cara Menggunakan**:

```bash
# Windows
cd c:\laragon\www\KaraStock
scripts\sync-css.bat

# Atau double-click file sync-css.bat dari File Explorer
```

**Yang Dilakukan**:

1. Copy CSS dari resources ke public
2. Clear cache Laravel (config, view, cache)
3. Siap refresh browser

### 🔧 generate_tree.php

**Fungsi**: Generate decision tree structure dari data

**Cara Menggunakan**:

```bash
php scripts/generate_tree.php
```

### 🧪 simulate_upload.php

**Fungsi**: Simulasi upload file untuk testing

**Cara Menggunakan**:

```bash
php scripts/simulate_upload.php
```

## Workflow Development

### Edit CSS

```
1. Edit file: resources/css/app.css
2. Run: scripts\sync-css.bat
3. Refresh browser (Ctrl + F5)
```

### Edit Blade Template

```
1. Edit file: resources/views/*.blade.php
2. Clear cache: php artisan view:clear
3. Refresh browser
```

### Testing Upload

```
1. Run: php scripts/simulate_upload.php
2. Atau gunakan sample data dari folder sample-data/
```

## Catatan

-   ✅ Script dapat dijalankan dari terminal atau double-click
-   ✅ Pastikan berada di root folder KaraStock saat menjalankan
-   ✅ Untuk Windows, gunakan .bat files
-   ✅ Untuk PHP scripts, gunakan `php scripts/nama-file.php`

## File Lain yang Dihapus

File-file berikut telah dihapus karena tidak terpakai:

-   ❌ pem_fresh.html (testing HTML)
-   ❌ response.html (testing response)
-   ❌ response2.html (testing response)
-   ❌ tree_fresh.json (output testing)
-   ❌ tree_output.json (output testing)
-   ❌ tree_output2.json (output testing)

File-file tersebut adalah hasil testing development dan tidak diperlukan lagi.
