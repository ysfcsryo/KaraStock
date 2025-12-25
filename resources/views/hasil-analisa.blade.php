@extends('layout.main')

@section('page_title', 'Hasil Analisa')

@section('content')

<div class="container-fluid px-0">

    {{-- BAGIAN HEADER & FILTER --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body py-3">
            <div class="row align-items-center g-3">
                
                {{-- Judul & Info File --}}
                <div class="col-md-5">
                    <h4 class="fw-bold text-primary mb-1">
                        <i class="bi bi-clipboard-data"></i> Hasil Analisa
                    </h4>
                    <p class="text-muted mb-0 small">
                        @if($selected_file)
                            File Aktif: <strong class="text-dark">{{ $selected_file }}</strong>
                        @else
                            <span class="text-danger">Belum ada file dipilih.</span>
                        @endif
                    </p>
                </div>

                {{-- Form Filter Dropdown & Tombol Aksi --}}
                <div class="col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                    
                    {{-- Form Pilih File (History) --}}
                    <form action="{{ route('hasil.analisa') }}" method="GET" class="d-flex align-items-center gap-2 flex-grow-1 justify-content-md-end" style="min-width: 200px;">
                        
                        {{-- Tombol Reset (Muncul jika ada filter file di URL) --}}
                        @if(request('file'))
                            <a href="{{ route('hasil.analisa') }}" class="btn btn-sm btn-light border" title="Reset Filter">
                                <i class="bi bi-x-lg text-muted"></i>
                            </a>
                        @endif

                        <div class="input-group input-group-sm" style="max-width: 280px;">
                            <span class="input-group-text bg-white border-primary text-primary">
                                <i class="bi bi-clock-history"></i>
                            </span>
                            <select name="file" class="form-select border-primary" onchange="this.form.submit()">
                                @if($files->isEmpty())
                                    <option value="">History Kosong</option>
                                @else
                                    <option disabled {{ !$selected_file ? 'selected' : '' }}>-- Pilih Riwayat File --</option>
                                    @foreach($files as $f)
                                        <option value="{{ $f->nama_file }}" {{ $selected_file == $f->nama_file ? 'selected' : '' }}>
                                            {{ \Illuminate\Support\Str::limit($f->nama_file, 20) }} ({{ \Carbon\Carbon::parse($f->tgl_upload)->format('d/m H:i') }})
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </form>

                    <div class="vr mx-1 d-none d-md-block"></div>

                    {{-- Tombol Lihat Tree (Hanya muncul jika ada file) --}}
                    @if($selected_file)
                        <a href="{{ route('proses.file', ['file' => $selected_file]) }}" class="btn btn-sm btn-primary shadow-sm fw-bold">
                            <i class="bi bi-diagram-3-fill me-1"></i> Lihat Tree
                        </a>
                    @endif

                    {{-- Tombol Upload Baru --}}
                    <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-upload"></i> <span class="d-none d-sm-inline">Upload Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if($data->isEmpty())
        {{-- JIKA DATA KOSONG --}}
        <div class="alert alert-light border shadow-sm py-5 text-center" role="alert">
            <div class="mb-3">
                <span class="bg-light p-3 rounded-circle border">
                    <i class="bi bi-folder2-open fs-1 text-secondary"></i>
                </span>
            </div>
            <h5 class="fw-bold text-dark">Data Tidak Ditemukan</h5>
            <p class="text-muted mb-4">
                File yang Anda cari tidak memiliki data atau belum dipilih.<br>
                Silakan pilih dari riwayat atau upload file baru.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary px-4">
                <i class="bi bi-upload me-2"></i> Upload File CSV
            </a>
        </div>
    @else
        {{-- INFO SUMMARY & RINGKASAN --}}
        <div class="row mb-4 g-3">
            {{-- Kartu Total Produk --}}
            <div class="col-lg-3 col-md-4">
                <div class="card shadow-sm border-0 h-100 bg-primary text-white position-relative overflow-hidden">
                    <div class="position-absolute top-0 end-0 p-3 opacity-25">
                        <i class="bi bi-box-seam fs-1" style="transform: rotate(15deg);"></i>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center">
                        <div class="small text-white-50 text-uppercase fw-bold">Total Data</div>
                        <div class="display-5 fw-bold">{{ count($data) }}</div>
                        <div class="small text-white-50">Produk Dianalisa</div>
                    </div>
                </div>
            </div>

            {{-- Kartu Statistik Status (Quick Count - Responsive Grid) --}}
            <div class="col-lg-9 col-md-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            {{-- Gunakan col-6 agar di HP jadi 2 kolom (grid), bukan 1 panjang ke bawah --}}
                            <div class="col-6 col-md-3 border-end border-bottom-0-md border-bottom-sm">
                                <div class="p-3 text-center h-100 d-flex flex-column justify-content-center">
                                    <h6 class="text-muted small fw-bold mb-1">PRIORITAS</h6>
                                    <h3 class="text-success fw-bold mb-0">
                                        {{ $data->filter(fn($r) => str_contains(strtolower($r['status']), 'prioritas'))->count() }}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 border-end border-bottom-0-md border-bottom-sm">
                                <div class="p-3 text-center h-100 d-flex flex-column justify-content-center">
                                    <h6 class="text-muted small fw-bold mb-1">RESTOCK</h6>
                                    <h3 class="text-info fw-bold mb-0">
                                        {{ $data->filter(fn($r) => str_contains(strtolower($r['status']), 'restock'))->count() }}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 border-end">
                                <div class="p-3 text-center h-100 d-flex flex-column justify-content-center">
                                    <h6 class="text-muted small fw-bold mb-1">WARNING</h6>
                                    <h3 class="text-warning fw-bold mb-0">
                                        {{ $data->filter(fn($r) => str_contains(strtolower($r['status']), 'warning'))->count() }}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="p-3 text-center h-100 d-flex flex-column justify-content-center">
                                    <h6 class="text-muted small fw-bold mb-1">DEAD STOCK</h6>
                                    <h3 class="text-dark fw-bold mb-0">
                                        {{ $data->filter(fn($r) => str_contains(strtolower($r['status']), 'dead'))->count() }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL HASIL --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0 text-dark fw-semibold">
                    <i class="bi bi-table me-2 text-primary"></i>Detail Rekomendasi
                </h5>
                <button class="btn btn-sm btn-light text-muted border" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Cetak / PDF
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 table-striped">
                        <thead class="bg-light text-secondary">
                            <tr>
                                <th class="ps-4 text-center" width="5%">No</th>
                                <th width="20%">Nama Produk</th>
                                <th width="15%">Kategori</th>
                                <th width="20%">Atribut (Harga / Jual / Endap)</th>
                                <th width="15%" class="text-center">Status Prediksi</th>
                                <th width="25%">Rekomendasi Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $row)
                                <tr>
                                    <td class="text-center text-muted fw-bold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $row['nama'] }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-white text-dark border">{{ $row['kategori'] }}</span>
                                    </td>
                                    <td>
                                        <div class="small lh-sm text-secondary">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span><i class="bi bi-tag"></i></span> <span>{{ $row['kelas'] }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between mb-1">
                                                <span><i class="bi bi-graph-up"></i></span> <span>{{ $row['performa'] }}</span>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <span><i class="bi bi-hourglass-split"></i></span> <span>{{ $row['durasi'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $row['warna'] }} px-3 py-2 rounded-pill shadow-sm">
                                            {{ $row['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-start">
                                            <i class="bi bi-info-circle-fill text-{{ strpos($row['warna'], 'warning') !== false ? 'warning' : ($row['warna'] == 'dark' ? 'danger' : 'primary') }} me-2 mt-1"></i>
                                            <small class="text-muted fw-semibold" style="line-height: 1.4;">
                                                {{ $row['saran'] }}
                                            </small>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card-footer bg-white py-2 text-center">
               <small class="text-muted fst-italic">Generated by ID3 Algorithm System</small>
            </div>
        </div>
    @endif
</div>

@endsection