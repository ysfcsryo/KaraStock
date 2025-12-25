# 🔄 UPGRADE FORMAT DATA v2.0

## 📊 Perubahan Format CSV

### ❌ Format LAMA (Deprecated)

```csv
No,Produk,Kategori,Kelas Harga,Performa Jual,Durasi Endap
1,Kemeja A,Kemeja,Premium,Laris,Baru
```

**Masalah:**

-   User harus manual kategorisasi (Harga → Kelas Harga)
-   Threshold tidak fleksibel
-   Butuh pengetahuan domain
-   Prone to human error

---

### ✅ Format BARU (Recommended)

```csv
Nama,Kategori,Harga,Terjual,Lama Barang
Kemeja A,Kemeja,280000,48,25
```

**Keuntungan:**

-   ✅ Data langsung dari sistem POS/inventory
-   ✅ Tidak perlu kategorisasi manual
-   ✅ Sistem otomatis preprocessing
-   ✅ Threshold customizable
-   ✅ Lebih akurat & natural

---

## 🤖 Preprocessing Otomatis

Sistem akan otomatis convert:

### 1. Harga (Rupiah) → Kelas Harga

| Range Harga       | Kategori |
| ----------------- | -------- |
| < 150.000         | Ekonomis |
| 150.000 - 250.000 | Standar  |
| > 250.000         | Premium  |

### 2. Terjual (Pcs) → Performa Jual

| Jumlah Terjual | Kategori |
| -------------- | -------- |
| < 10 pcs       | Macet    |
| 10 - 30 pcs    | Sedang   |
| > 30 pcs       | Laris    |

### 3. Lama Barang (Hari) → Durasi Endap

| Umur Barang  | Kategori |
| ------------ | -------- |
| < 30 hari    | Baru     |
| 30 - 60 hari | Normal   |
| > 60 hari    | Lama     |

---

## 📝 Template CSV

### Untuk Prediksi (Tanpa Label)

```csv
Nama,Kategori,Harga,Terjual,Lama Barang
Kemeja Batik Gorontalo,Kemeja,175000,48,25
Blus Tenun Karawo,Blus,220000,15,85
Celana Karawo Hitam,Celana,195000,42,18
```

**Gunakan untuk:**

-   Upload data baru yang ingin diprediksi
-   Data produksi terbaru
-   Analisis stok real-time

---

### Untuk Training Model (Dengan Label)

```csv
Nama,Kategori,Harga,Terjual,Lama Barang,Target Class
Kemeja Premium,Kemeja,280000,48,25,Prioritas Utama
Blus Slow,Blus,220000,8,110,Dead Stock
Celana Best,Celana,195000,55,18,Prioritas Utama
```

**Gunakan untuk:**

-   Training model ID3
-   Data historis dengan hasil yang sudah diketahui
-   Meningkatkan akurasi model

---

## 🎯 Target Classes

| Class               | Kriteria       | Aksi Bisnis                     |
| ------------------- | -------------- | ------------------------------- |
| **Prioritas Utama** | Laris, Baru    | Produksi ASAP, restock agresif  |
| **Restock Normal**  | Steady, Normal | Restock rutin sesuai jadwal     |
| **Pertahankan**     | Bagus, Stabil  | Maintain, tidak perlu perubahan |
| **Warning**         | Slow, Aging    | Evaluasi, promo/diskon          |
| **Dead Stock**      | Macet, Lama    | Stop produksi, clearance sale   |

---

## 📥 Sample Files

Sudah disediakan 2 file contoh:

1. **sample_data_raw.csv**

    - Format baru (data RAW)
    - Untuk prediksi
    - 15 produk contoh

2. **sample_data_training.csv**
    - Format dengan label
    - Untuk training model
    - 20 produk dengan target class

---

## 🔧 Customization

Jika bisnis Anda butuh threshold berbeda, edit di:

**File:** `app/Http/Controllers/ProductController.php`

```php
private function categorizePrice($harga) {
    // Sesuaikan threshold
    if ($harga < 150000) return 'Ekonomis';
    if ($harga <= 250000) return 'Standar';
    return 'Premium';
}

private function categorizeSales($terjual) {
    // Sesuaikan threshold
    if ($terjual < 10) return 'Macet';
    if ($terjual <= 30) return 'Sedang';
    return 'Laris';
}

private function categorizeDuration($lama) {
    // Sesuaikan threshold
    if ($lama < 30) return 'Baru';
    if ($lama <= 60) return 'Normal';
    return 'Lama';
}
```

---

## 🚀 Migration Guide

### Jika Anda Punya Data Lama

**Option 1: Convert Manual**

1. Export data lama
2. Tambah kolom: Harga (angka), Terjual (angka), Lama Barang (angka)
3. Isi dengan data aktual
4. Upload format baru

**Option 2: Backward Compatible**

-   Format lama masih didukung
-   Sistem detect otomatis
-   Tapi disarankan migrate ke format baru

---

## ✅ Validation Rules

### Format BENAR ✅

```csv
✓ Header persis: Nama,Kategori,Harga,Terjual,Lama Barang
✓ Harga: integer (150000, 200000)
✓ Terjual: integer (45, 12, 38)
✓ Lama Barang: integer (30, 90, 15)
✓ Kategori: string (Kemeja, Blus, Celana, Bahan)
```

### Format SALAH ❌

```csv
❌ Header berbeda: Product,Category,Price
❌ Harga string: "seratus ribu"
❌ Terjual string: "banyak"
❌ Lama Barang string: "lama"
❌ Missing columns
```

---

## 📊 Comparison

| Aspect          | Format Lama            | Format Baru             |
| --------------- | ---------------------- | ----------------------- |
| **Ease of Use** | ⭐⭐ Manual work       | ⭐⭐⭐⭐⭐ Plug & play  |
| **Accuracy**    | ⭐⭐⭐ Fixed threshold | ⭐⭐⭐⭐⭐ Auto optimal |
| **Flexibility** | ⭐⭐ Hard-coded        | ⭐⭐⭐⭐⭐ Customizable |
| **Error Rate**  | ⭐⭐ Human error       | ⭐⭐⭐⭐ Validated      |
| **Speed**       | ⭐⭐ Slow prep         | ⭐⭐⭐⭐⭐ Instant      |

---

## 🎓 Best Practices

1. **Gunakan Data Aktual**

    - Ambil dari sistem POS
    - Jangan estimasi manual
    - Update berkala

2. **Maintain Data Quality**

    - Pastikan angka akurat
    - Bersihkan data outlier
    - Validasi sebelum upload

3. **Regular Training**

    - Train model setiap bulan
    - Gunakan data 3-6 bulan terakhir
    - Update threshold jika perlu

4. **Monitor Akurasi**
    - Cek hasil prediksi vs aktual
    - Adjust threshold jika akurasi < 80%
    - Document improvement

---

## 💡 FAQ

**Q: Apakah format lama masih bisa dipakai?**  
A: Ya, tapi disarankan migrate ke format baru untuk hasil lebih baik.

**Q: Bagaimana cara mengubah threshold?**  
A: Edit function categorize\* di ProductController.php sesuai bisnis Anda.

**Q: Apakah bisa custom kategori produk?**  
A: Ya! Kategori bebas, sistem akan encode otomatis.

**Q: Berapa minimal data untuk training?**  
A: Minimal 20 baris, ideal 100+ untuk akurasi tinggi.

**Q: Apakah harus ada kolom Target Class?**  
A: Tidak. Opsional untuk training, sistem bisa prediksi tanpa label.

---

**Updated:** 25 Desember 2025  
**Version:** 2.0  
**Status:** ✅ Production Ready
