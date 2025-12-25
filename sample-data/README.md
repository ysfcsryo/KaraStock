# 📊 Sample Data CSV

Folder ini berisi file-file contoh CSV untuk upload dan testing sistem KaraStock.

---

## 📄 Daftar File

| File | Deskripsi | Kegunaan |
|------|-----------|----------|
| **template_upload.csv** | 📝 Template kosong | Download untuk format upload |
| **sample_data_raw.csv** | Data tanpa label | Upload & test prediksi AI |
| **sample_data_training.csv** | Data dengan label | Training Decision Tree |
| **sample_data_kategori.csv** | Data dengan kategori | Test filter kategori |
| **sample_data_training_kategori.csv** | Training + kategori lengkap | Full training data |

---

## 📋 Format CSV yang Benar

### Header (Baris Pertama):
```csv
nama_produk,kategori,kelas_harga,performa_jual,durasi_endap
```

### Contoh Data:
```csv
nama_produk,kategori,kelas_harga,performa_jual,durasi_endap
Karawo Bunga Merah,pakaian,sedang,tinggi,cepat
Karawo Motif Naga,aksesoris,mahal,rendah,lama
Karawo Geometris,dekorasi,murah,sedang,sedang
```

---

## ✅ Nilai yang Diterima

| Kolom | Nilai yang Valid |
|-------|------------------|
| **kategori** | `pakaian` / `aksesoris` / `dekorasi` |
| **kelas_harga** | `murah` / `sedang` / `mahal` |
| **performa_jual** | `rendah` / `sedang` / `tinggi` |
| **durasi_endap** | `cepat` / `sedang` / `lama` |

### Kolom Opsional:
- **label** - Status sudah diketahui (untuk training): `SEGERA STOK` / `PERTAHANKAN` / `KURANGI STOK`

---

## 🚀 Cara Menggunakan

### 1️⃣ Download Template
- Gunakan **template_upload.csv** sebagai template
- Isi data produk Anda sesuai format

### 2️⃣ Upload File
- Login ke sistem
- Menu: **Upload & Analisa**
- Pilih file CSV
- Klik "Upload & Analisa"

### 3️⃣ Lihat Hasil
- Sistem akan otomatis redirect ke **Hasil Analisa**
- Lihat prediksi untuk setiap produk

---

## 📌 Tips

- **Jangan ubah header** - Harus sesuai format
- **Gunakan huruf kecil** - untuk kategori, kelas_harga, dll
- **Cek validasi** - Pastikan nilai sesuai yang diterima
- **Test dulu** - Pakai sample data sebelum upload data asli

---

## 🆘 Troubleshooting

**Error: "Invalid format"**
- Cek header CSV sesuai format
- Pastikan delimiter menggunakan koma (,)

**Error: "Invalid value"**
- Cek nilai kategori, kelas_harga, performa_jual, durasi_endap
- Harus sesuai nilai yang valid (lihat tabel di atas)

**Data tidak muncul:**
- Refresh halaman hasil analisa
- Cek database apakah data tersimpan

---

**📖 Untuk panduan lengkap, baca [Manual Book](../docs/MANUAL_BOOK.md)**
