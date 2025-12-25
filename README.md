# 🎯 KaraStock - Sistem Prediksi Stok Penjualan

## Decision Tree ID3 Algorithm (Pure PHP Implementation)

Sistem prediksi dan klasifikasi stok penjualan berbasis algoritma **Decision Tree ID3** murni (tanpa library eksternal) dengan preprocessing otomatis untuk data RAW.

---

## ✨ Fitur Utama

### 🤖 **Preprocessing Otomatis**

-   Input data RAW (Harga, Terjual, Lama Barang)
-   Sistem otomatis convert ke fitur kategoris
-   Threshold customizable sesuai bisnis

### 🧠 **Pure ID3 Algorithm**

-   Shannon Entropy calculation
-   Information Gain untuk split decision
-   Recursive tree building
-   No external ML libraries

### 📊 **Complete ML Pipeline**

-   CSV Upload dengan validasi
-   Automatic feature engineering
-   Model training & evaluation
-   Prediction & classification
-   Tree visualization dengan IG values

### 🎨 **Premium UI/UX**

-   Modern responsive design
-   Glassmorphism effects
-   Interactive animations
-   Mobile-first approach
-   Premium color palette (no clash)

---

## 📋 Format Data CSV (v2.0 - UPGRADE)

### ✅ Format Baru - Data RAW

Sistem sekarang menerima data mentah dan preprocessing otomatis:

```csv
Nama,Kategori,Harga,Terjual,Lama Barang
Kemeja Batik Gorontalo,Kemeja,175000,48,25
Blus Tenun Karawo Merah,Blus,220000,15,85
Celana Karawo Hitam,Celana,195000,42,18
```

**Preprocessing Otomatis:**

-   **Harga** → Kelas Harga (Ekonomis/Standar/Premium)
-   **Terjual** → Performa Jual (Macet/Sedang/Laris)
-   **Lama Barang** → Durasi Endap (Baru/Normal/Lama)

### 📝 Format Training (Opsional dengan Label)

```csv
Nama,Kategori,Harga,Terjual,Lama Barang,Target Class
Kemeja A,Kemeja,175000,45,20,Prioritas Utama
Blus B,Blus,280000,8,110,Dead Stock
```

---

## 🚀 Teknologi

-   **Backend:** Laravel 10.x
-   **Frontend:** Bootstrap 5.3, Blade Templates
-   **Algorithm:** Pure PHP ID3 (Custom Implementation)
-   **Database:** MySQL
-   **Assets:** Vite, Animate.css
-   **Design:** Premium glassmorphism UI

---

## 📦 Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
cd KaraStock
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuration

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karastock
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migration

```bash
php artisan migrate
```

### 6. Sync CSS (Important!)

```bash
# Windows
sync-css.bat

# Atau manual
copy resources\css\app.css public\css\app.css
php artisan cache:clear
```

### 7. Start Development Server

```bash
php artisan serve
```

Buka: `http://localhost:8000`

---

## 📚 Dokumentasi Lengkap

| File                                                   | Deskripsi                             |
| ------------------------------------------------------ | ------------------------------------- |
| [CARA_KERJA_SISTEM.md](CARA_KERJA_SISTEM.md)           | Panduan lengkap format CSV & workflow |
| [PREMIUM_DESIGN_SYSTEM.md](PREMIUM_DESIGN_SYSTEM.md)   | Color palette & design guidelines     |
| [MOBILE_UX_IMPROVEMENTS.md](MOBILE_UX_IMPROVEMENTS.md) | Mobile responsive documentation       |
| [REFRESH_PANDUAN.md](REFRESH_PANDUAN.md)               | Troubleshooting & CSS sync guide      |

---

## 🎯 Cara Penggunaan

### 1. **Upload Data CSV**

-   Siapkan file CSV dengan format baru (data RAW)
-   Upload melalui menu **Input Data**
-   Sistem otomatis preprocessing & prediksi

### 2. **Training Model ID3**

-   Menu **Evaluasi** → **Train Model**
-   Gunakan data dengan label (Target Class)
-   Model tersimpan di `storage/app/id3_model.json`

### 3. **Lihat Hasil**

-   Menu **Hasil Analisa**
-   Filter berdasarkan kategori
-   Lihat distribusi prediksi

### 4. **Visualisasi Tree**

-   Menu **Evaluasi** → **Visualisasi Tree**
-   Lihat struktur decision tree
-   Setiap node menampilkan Information Gain

---

## 🧮 Algoritma ID3

### Shannon Entropy

```
H(S) = -Σ(p_i * log₂(p_i))
```

### Information Gain

```
IG(S, A) = H(S) - Σ(|Sv|/|S| * H(Sv))
```

### Tree Building

1. Hitung entropy dataset
2. Hitung IG untuk setiap fitur
3. Pilih fitur dengan IG tertinggi
4. Split data berdasarkan fitur terpilih
5. Recursive untuk setiap subset
6. Stop jika pure atau max depth

**File Implementation:** `app/Services/ID3DecisionTree.php`

---

## 📊 Target Classes

| Class               | Deskripsi                       |
| ------------------- | ------------------------------- |
| **Prioritas Utama** | Produk hot seller, restock ASAP |
| **Restock Normal**  | Produk stabil, restock rutin    |
| **Pertahankan**     | Produk bagus, maintain stock    |
| **Warning**         | Produk slow, perlu evaluasi     |
| **Dead Stock**      | Produk macet, stop produksi     |

---

## 🎨 Premium Design Features

-   **Color System:** Monochromatic indigo + complementary coral
-   **Shadows:** Multi-layer premium shadows (6 levels)
-   **Animations:** Cubic-bezier smooth transitions
-   **Glassmorphism:** Blur + saturation effects
-   **Responsive:** Mobile-first dengan burger menu slide
-   **Accessibility:** WCAG AA compliant

---

## � Struktur Folder

```
KaraStock/
├── app/                    # Source code aplikasi
│   ├── Http/
│   │   └── Controllers/    # Controllers (ProductController, AuthController)
│   └── Models/            # Eloquent models (User, dll)
│
├── database/              # Database files
│   ├── migrations/        # Database migrations
│   └── seeders/          # Database seeders (UserSeeder)
│
├── public/               # Public assets (accessible via web)
│   ├── assets/
│   │   └── images/       # Logo dan gambar
│   ├── css/             # Compiled CSS
│   └── template_karastock.csv  # Template CSV download
│
├── resources/           # Source files
│   ├── css/            # Source CSS (edit di sini)
│   ├── js/             # Source JavaScript
│   └── views/          # Blade templates
│       ├── auth/       # Login & profile views
│       └── layout/     # Main layout
│
├── routes/             # Route definitions
│   └── web.php        # Web routes
│
├── storage/           # Storage files
│   ├── app/          # Uploaded files
│   └── logs/         # Application logs
│
├── docs/             # 📚 Dokumentasi lengkap
│   ├── AUTH_UPDATE.md
│   ├── CARA_KERJA_SISTEM.md
│   ├── FORMAT_UPGRADE_GUIDE.md
│   ├── LOGIN_GUIDE.md
│   └── QUICKSTART_LOGIN.md
│
├── sample-data/      # 📊 Contoh file CSV
│   ├── sample_data_raw.csv
│   ├── sample_data_training.csv
│   ├── sample_data_kategori.csv
│   └── sample_data_training_kategori.csv
│
├── scripts/          # 🔧 Utility scripts
│   ├── sync-css.bat         # Sync CSS ke public
│   ├── generate_tree.php    # Generate decision tree
│   └── simulate_upload.php  # Testing upload
│
└── README.md         # ← File ini (dokumentasi utama)
```

### 📚 Dokumentasi

Semua dokumentasi ada di folder `docs/`:

-   **LOGIN_GUIDE.md** - Panduan login sistem
-   **AUTH_UPDATE.md** - Detail sistem autentikasi
-   **QUICKSTART_LOGIN.md** - Quick start login
-   **CARA_KERJA_SISTEM.md** - Cara kerja Decision Tree
-   **FORMAT_UPGRADE_GUIDE.md** - Panduan format data

### 📊 Sample Data

File contoh CSV ada di folder `sample-data/`:

-   `sample_data_raw.csv` - Data mentah tanpa kategori
-   `sample_data_training.csv` - Data training
-   `sample_data_kategori.csv` - Data dengan kategori
-   Template resmi: `public/template_karastock.csv`

---

## 🛠️ Development

### CSS Workflow

```bash
# Edit CSS
nano resources/css/app.css

# Sync ke public (Windows)
scripts\sync-css.bat

# Clear cache
php artisan cache:clear
```

### Database Reset

```bash
php artisan migrate:fresh
php artisan db:seed --class=UserSeeder
```

### Testing Upload

```bash
# Gunakan sample data
# File ada di: sample-data/sample_data_raw.csv

# Atau jalankan simulate upload
php scripts/simulate_upload.php
```

---

## 🔐 Autentikasi

Sistem dilengkapi dengan autentikasi user:

**Default Login:**

```
Email    : admin@karastock.com
Password : admin123
```

**Fitur:**

-   ✅ Login dengan validasi
-   ✅ Remember me
-   ✅ Profile user
-   ✅ Logout
-   ✅ Protected routes

Lihat dokumentasi lengkap di: `docs/LOGIN_GUIDE.md`

---

## 📄 License

MIT License - Feel free to use for learning or commercial projects.

---

## 👨‍💻 Credits

**Developed with ❤️ using:**

-   Laravel Framework
-   Pure PHP (No ML Libraries)
-   Bootstrap 5
-   Custom ID3 Algorithm

**Design Philosophy:**

> "Simplicity is sophistication. Premium feel without complexity."

---

**Version:** 2.0 (Preprocessing Otomatis)  
**Last Updated:** 25 Desember 2025  
**Status:** ✅ Production Ready
