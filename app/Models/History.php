<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'kategori',       // <--- INI WAJIB ADA
        'kelas_harga',    // <--- INI WAJIB ADA
        'performa_jual',  // <--- INI WAJIB ADA
        'durasi_endap',   // <--- INI WAJIB ADA
        'status',
        'rekomendasi',
        'warna',
        'nama_file'
    ];
}