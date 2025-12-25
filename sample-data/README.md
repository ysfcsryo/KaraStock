# Sample Data - KaraStock

Folder ini berisi contoh file CSV untuk testing dan demonstrasi sistem KaraStock.

## File yang Tersedia

### 📊 Data Raw (Mentah)

-   **sample_data_raw.csv** - Data mentah tanpa kategori
    -   Format: Nama Produk, Kategori Harga, Kategori Performa, Kategori Durasi Endap, Klasifikasi

### 📈 Data Training

-   **sample_data_training.csv** - Data training untuk model Decision Tree
    -   Sudah termasuk klasifikasi untuk training algoritma

### 🏷️ Data Kategori

-   **sample_data_kategori.csv** - Data dengan kategori lengkap

    -   Format: Nama, Harga, Performa, Durasi, Klasifikasi

-   **sample_data_training_kategori.csv** - Training data dengan kategori
    -   Kombinasi kategori dan klasifikasi

## Cara Menggunakan

1. **Untuk Testing Upload**

    - Gunakan salah satu file CSV di atas
    - Upload melalui halaman "Upload & Analisa"
    - Sistem akan memproses dan menampilkan hasil

2. **Untuk Template**

    - Template resmi ada di: `public/template_karastock.csv`
    - Download dari halaman upload

3. **Format Data**
    ```
    Nama Produk,Kategori Harga,Kategori Performa,Kategori Durasi Endap,Klasifikasi
    Produk A,Murah,Tinggi,Cepat,Restock Segera
    ```

## Kategori yang Valid

### Kategori Harga

-   Murah (< Rp 10,000)
-   Sedang (Rp 10,000 - Rp 50,000)
-   Mahal (> Rp 50,000)

### Kategori Performa

-   Rendah (< 10 unit/bulan)
-   Sedang (10-50 unit/bulan)
-   Tinggi (> 50 unit/bulan)

### Kategori Durasi Endap

-   Cepat (< 7 hari)
-   Sedang (7-30 hari)
-   Lama (> 30 hari)

### Klasifikasi Hasil

-   Restock Segera
-   Restock Terjadwal
-   Stok Optimal
-   Perlu Evaluasi
-   Stok Mati

## Tips

💡 **Gunakan sample data ini untuk**:

-   Testing sistem Decision Tree
-   Memahami format CSV yang benar
-   Eksperimen dengan berbagai kategori
-   Training dan evaluasi model

⚠️ **Jangan**:

-   Upload data production ke sample data folder ini
-   Edit file sample (buat copy jika ingin modifikasi)
