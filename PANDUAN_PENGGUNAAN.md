# KaraStock - Decision Tree Stock Advisor

## 📊 Tentang Sistem

KaraStock adalah aplikasi web interaktif yang menggunakan algoritma **Decision Tree** untuk memberikan rekomendasi stok penjualan yang akurat dan berbasis data. Sistem ini membantu bisnis mengoptimalkan manajemen inventori dengan analisis cerdas terhadap pola penjualan dan karakteristik produk.

## 🎯 Fitur Utama

### 1. **Upload & Analisa Data**

-   Upload file CSV berisi data penjualan produk
-   Proses otomatis dengan Decision Tree algorithm
-   Hasil analisa instan dengan rekomendasi stok per produk

### 2. **Riwayat Analisa**

-   Menyimpan semua hasil analisa sebelumnya
-   Filter berdasarkan file, status, tanggal, dan nama produk
-   Visualisasi statistik lengkap dengan cards interaktif

### 3. **Hasil Prediksi**

-   Tampilan detail untuk setiap produk
-   Rekomendasi: **TINGKATKAN STOCK** atau **KURANGI STOCK**
-   Penjelasan alasan mengapa sistem memberikan rekomendasi tersebut

### 4. **Evaluasi Model**

-   Melihat akurasi model Decision Tree
-   Confusion Matrix untuk analisis performa
-   Data training & testing statistics

## 📋 Format Data CSV yang Didukung

File CSV harus memiliki kolom dengan header berikut:

| Kolom           | Tipe   | Deskripsi                                      |
| --------------- | ------ | ---------------------------------------------- |
| **Nama**        | Text   | Nama produk                                    |
| **Kategori**    | Text   | Kategori produk                                |
| **Harga**       | Number | Harga produk                                   |
| **Terjual**     | Number | Jumlah unit terjual dalam periode tertentu     |
| **Lama Barang** | Number | Umur barang dalam hari (berapa lama di gudang) |

### Contoh CSV:

```
Nama,Kategori,Harga,Terjual,Lama Barang
Kemeja Biru,Pakaian,150000,75,15
Celana Hitam,Pakaian,200000,45,25
Sepatu Olahraga,Sepatu,350000,30,45
Kaos Putih,Pakaian,50000,120,5
```

## 🔍 Logika Keputusan Decision Tree

Sistem menggunakan logika pohon keputusan sebagai berikut:

```
┌─── Terjual ≥ 50 pcs? ───┐
│                          │
YES                        NO
│                          │
TINGKATKAN STOCK    Lama Barang < 30 hari?
                           │
                      YES    NO
                      │      │
                  TINGKATKAN KURANGI STOCK
                  STOCK
```

### Penjelasan:

1. **Node 1 (Root)**: Jika penjualan ≥ 50 unit → TINGKATKAN STOCK
2. **Node 2 (Left Branch)**: Jika penjualan < 50 dan umur < 30 hari → TINGKATKAN STOCK (produk baru dan sedang mencari pasar)
3. **Node 3 (Right Branch)**: Jika penjualan < 50 dan umur ≥ 30 hari → KURANGI STOCK (produk lama dan tidak laku)

## 💡 Tips Menggunakan Sistem

### ✅ Best Practices

1. **Kualitas Data**: Pastikan data penjualan akurat dan konsisten
2. **Periode Waktu**: Gunakan periode waktu yang konsisten (misal 30-90 hari terakhir)
3. **Jumlah Data**: Semakin banyak data berkualitas, semakin akurat prediksi
4. **Update Rutin**: Lakukan analisa secara berkala untuk hasil yang up-to-date

### ⚠️ Hal yang Perlu Diperhatikan

-   Pastikan data tidak ada yang kosong (NULL)
-   Gunakan format angka yang konsisten (tanpa simbol mata uang)
-   Hindari nama produk yang terlalu panjang
-   Periksa kembali data sebelum mengupload

### 🎯 Interpretasi Hasil

-   **TINGKATKAN STOCK**: Produk laris, tingkatkan persediaan
-   **KURANGI STOCK**: Produk tidak laku, kurangi atau review strategi pemasaran

## 🚀 Panduan Penggunaan

### Langkah 1: Upload Data

1. Klik menu "Upload & Analisa"
2. Seret file CSV atau klik untuk memilih
3. Klik "Jalankan Analisa"

### Langkah 2: Lihat Hasil

-   Sistem akan menampilkan rekomendasi per produk
-   Baca penjelasan alasan untuk setiap rekomendasi

### Langkah 3: Cek Riwayat

1. Klik menu "Riwayat Analisa"
2. Gunakan filter untuk melihat data spesifik
3. Analisis tren dari waktu ke waktu

### Langkah 4: Evaluasi Model

-   Klik "Evaluasi Model" untuk melihat akurasi
-   Confusion Matrix menunjukkan performa detail

## 🎨 Desain & User Experience

Sistem ini dirancang dengan:

-   **Modern UI**: Gradient, animasi smooth, dan ikon Bootstrap Icons
-   **Responsive Design**: Optimal di desktop, tablet, dan mobile
-   **Interactive Cards**: Hover effects untuk pengalaman interaktif
-   **Intuitive Navigation**: Menu sidebar yang mudah dipahami
-   **Color Coding**: Hijau untuk "tingkatkan", merah untuk "kurangi"

## 🔧 Teknologi

-   **Backend**: Laravel 11 (PHP Framework)
-   **Frontend**: Bootstrap 5, HTML, CSS, JavaScript
-   **Database**: MySQL/SQLite
-   **Algorithm**: Decision Tree (Scikit-learn via Python)
-   **UI Library**: Bootstrap Icons, Animate CSS

## 📞 Support & Feedback

Jika mengalami kendala atau memiliki saran:

1. Periksa format CSV terlebih dahulu
2. Pastikan browser sudah ter-update
3. Clear cache browser jika ada masalah loading
4. Hubungi tim technical support

## 📝 Catatan Penting

-   Data riwayat dapat dihapus sesuai kebutuhan
-   Setiap analisa baru akan memperbaharui model prediksi
-   Accuracy akan meningkat seiring bertambahnya data
-   Sistem akan menyimpan history untuk audit trail

---

**Versi**: 1.0.0  
**Last Updated**: Desember 2025  
**Status**: Active & Production Ready
