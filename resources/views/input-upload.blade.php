@extends('layout.main')

@section('page_title', 'Upload & Analisa Data Penjualan')

@section('content')

@if(session('success'))
<div class="alert alert-success border-left-4 bg-success-subtle text-success d-flex align-items-center" role="alert">
    <i class="bi bi-check-circle-fill me-3 fs-5"></i>
    <div>
        <strong>Sukses!</strong> {{ session('success') }}
    </div>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger border-left-4 bg-danger-subtle text-danger" role="alert">
    <div class="d-flex align-items-start">
        <i class="bi bi-exclamation-triangle-fill me-3 mt-1 fs-5"></i>
        <div>
            <strong>Terjadi kesalahan pada file yang diupload:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif

<!-- Main Content -->
<div class="row g-4">
    <!-- Upload Section -->
    <div class="col-12">
        <div class="card card-interactive shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-start mb-4">
                    <div class="icon-badge icon-badge-success me-3">
                        <i class="bi bi-cloud-arrow-up"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold mb-0 upload-title">Unggah Data Penjualan</h4>
                        <small class="text-muted">Pilih file CSV berisi data penjualan Anda</small>
                    </div>
                </div>

                <p class="text-muted mb-4">
                    Sistem akan menganalisis data Anda menggunakan algoritma <strong>Decision Tree</strong>
                    untuk memberikan rekomendasi stok yang optimal.
                </p>

                <!-- Download Template -->
                <div class="alert alert-success border-0 mb-4 template-download-alert">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="fw-bold mb-1 template-download-title">
                                <i class="bi bi-download"></i> Belum punya template?
                            </h6>
                            <small class="text-muted">Download template CSV dan isi dengan data penjualan Anda</small>
                        </div>
                        <a href="{{ asset('template_karastock.csv') }}" download="Template_KaraStock.csv" class="btn btn-sm template-download-btn">
                            <i class="bi bi-file-earmark-arrow-down"></i> Download Template
                        </a>
                    </div>
                </div>

                <!-- Upload Area -->
                <form action="{{ url('/proses-csv') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf

                    <div class="upload-area" id="dropZone">
                        <div class="mb-3">
                            <i class="bi bi-file-earmark-spreadsheet display-3 mb-3 upload-icon-primary"></i>
                            <h6 class="fw-bold text-dark">Seret file CSV ke sini</h6>
                            <p class="text-muted small mb-3">atau klik untuk memilih file</p>
                        </div>
                        <input type="file" id="fileInput" name="file_csv" accept=".csv" class="d-none" required>
                        <button type="button" class="btn btn-upload mb-3" onclick="document.getElementById('fileInput').click()">
                            <i class="bi bi-folder-open"></i> Pilih File CSV
                        </button>
                        <p class="text-muted small mb-0">Ukuran maksimal: 5MB · Format: .csv</p>
                    </div>

                    <div id="fileInfo" class="mt-3 d-none">
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            <div>
                                File terpilih: <strong id="fileName"></strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-upload btn-lg">
                            <i class="bi bi-rocket-takeoff"></i> Jalankan Analisa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Info Section -->
<div class="row g-3 mt-2">
    <!-- How It Works - More Compact -->
    <div class="col-lg-4">
        <div class="card card-interactive shadow-sm h-100">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-3 section-title-sm">
                    <i class="bi bi-gear section-icon-primary"></i> Cara Kerja Sistem
                </h6>
                <ol class="ps-3 mb-0 text-content-sm">
                    <li class="mb-2"><strong>Unggah</strong> data CSV</li>
                    <li class="mb-2"><strong>Labeling</strong> otomatis</li>
                    <li class="mb-2"><strong>Training</strong> Decision Tree</li>
                    <li class="mb-0"><strong>Rekomendasi</strong> stok</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Format Data - Compact -->
    <div class="col-lg-4">
        <div class="card card-interactive shadow-sm h-100">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-3 section-title-sm">
                    <i class="bi bi-file-earmark-spreadsheet section-icon-success"></i> Format Data
                </h6>
                <ul class="feature-list mb-0 feature-list-sm">
                    <li><strong>Produk</strong> - nama produk</li>
                    <li><strong>Kategori</strong> - jenis produk</li>
                    <li><strong>Kelas Harga</strong> - Ekonomis/Standar/Premium</li>
                    <li><strong>Performa</strong> - Laris/Sedang/Macet</li>
                    <li><strong>Durasi Endap</strong> - Baru/Normal/Lama</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Panduan Kategorisasi - Compact Accordion -->
    <div class="col-lg-4">
        <div class="card card-interactive shadow-sm h-100">
            <div class="card-body p-3">
                <h6 class="fw-bold mb-3 section-title-sm">
                    <i class="bi bi-info-circle-fill section-icon-warning"></i> Panduan Kategorisasi
                </h6>
                <div class="accordion accordion-flush accordion-compact" id="panduanAccordion">
                    <div class="accordion-item border-0 mb-1 accordion-item-compact">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-2 accordion-button-compact" type="button" data-bs-toggle="collapse" data-bs-target="#collapseHarga">
                                <i class="bi bi-tag-fill text-primary me-2"></i> Kelas Harga
                            </button>
                        </h2>
                        <div id="collapseHarga" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
                            <div class="accordion-body p-2 accordion-body-sm">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">< Rp 150k</span>
                                    <span class="badge bg-success badge-compact">Ekonomis</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Rp 150k-250k</span>
                                    <span class="badge bg-warning text-dark badge-compact">Standar</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">> Rp 250k</span>
                                    <span class="badge bg-danger badge-compact">Premium</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-1 accordion-item-compact">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-2 accordion-button-compact" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePerforma">
                                <i class="bi bi-graph-up-arrow text-primary me-2"></i> Performa
                            </button>
                        </h2>
                        <div id="collapsePerforma" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
                            <div class="accordion-body p-2 accordion-body-sm">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">< 10 pcs</span>
                                    <span class="badge bg-danger badge-compact">Macet</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">10-30 pcs</span>
                                    <span class="badge bg-warning text-dark badge-compact">Sedang</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">> 30 pcs</span>
                                    <span class="badge bg-success badge-compact">Laris</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 accordion-item-compact">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed p-2 accordion-button-compact" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDurasi">
                                <i class="bi bi-clock-history text-primary me-2"></i> Durasi Endap
                            </button>
                        </h2>
                        <div id="collapseDurasi" class="accordion-collapse collapse" data-bs-parent="#panduanAccordion">
                            <div class="accordion-body p-2 accordion-body-sm">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">< 30 hari</span>
                                    <span class="badge bg-success badge-compact">Baru</span>
                                </div>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">30-60 hari</span>
                                    <span class="badge bg-warning text-dark badge-compact">Normal</span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted">> 60 hari</span>
                                    <span class="badge bg-danger badge-compact">Lama</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="row g-4 mt-2">
    <div class="col-md-6">
        <div class="card card-interactive shadow-sm">
            <div class="card-body p-4 text-center">
                <div class="icon-badge icon-badge-primary mx-auto mb-3">
                    <i class="bi bi-speedometer"></i>
                </div>
                <h6 class="fw-bold">Analisis Cepat</h6>
                <p class="text-muted small mb-0">Dapatkan hasil analisa dalam hitungan detik</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-interactive shadow-sm">
            <div class="card-body p-4 text-center">
                <div class="icon-badge icon-badge-primary mx-auto mb-3">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h6 class="fw-bold">Akurat & Terpercaya</h6>
                <p class="text-muted small mb-0">Berbasis algoritma machine learning terbukti</p>
            </div>
        </div>
    </div>
</div>

<!-- Analysis Results Section -->
@if(session('list_produk'))
<div class="mt-5 pt-5 border-top">
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1 fw-bold text-primary">
                        <i class="bi bi-check2-circle"></i> Ringkasan Analisa
                    </h5>
                    <small class="text-muted">
                        Hasil analisis Decision Tree dari file: <strong>{{ session('last_uploaded_file') }}</strong>
                    </small>
                </div>
                <div class="text-end">
                    <div class="badge bg-primary-subtle text-primary rounded-pill mb-1">
                        <i class="bi bi-diagram-3"></i> Decision Tree Model
                    </div>
                    <div class="small text-muted">
                        Total produk: <strong>{{ count(session('list_produk')) }}</strong>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('pemrosesan-file', ['file' => session('last_uploaded_file')]) }}" class="btn btn-primary">
                    <i class="bi bi-diagram-3"></i> Visualisasi Decision Tree
                </a>
                <a href="{{ route('pemrosesan-file', ['file' => session('last_uploaded_file')]) }}#entropy" class="btn btn-success">
                    <i class="bi bi-calculator"></i> Entropy & Information Gain
                </a>
                <a href="{{ url('/hasil-analisa') }}" class="btn btn-info">
                    <i class="bi bi-eye"></i> Lihat Halaman Hasil Analisa
                </a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold">
                    Detail Rekomendasi Per Produk
                </h5>
                <span class="badge bg-light text-secondary border">
                    <i class="bi bi-lightbulb"></i> Hijau: Tingkatkan · Merah: Kurangi
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="bg-white border rounded-3 overflow-hidden shadow-sm">
                <div class="bg-light px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bi bi-list-check me-2 results-list-icon"></i>
                        Rekomendasi Per Produk
                    </h5>
                    <span class="badge bg-primary">{{ count(session('list_produk')) }} Produk</span>
                </div>
                <div class="results-scroll-container">
                    @foreach(session('list_produk') as $index => $item)
                    <div class="results-grid-row">
                        <div class="results-row-number">{{ $index + 1 }}</div>
                        <div class="results-row-product">{{ $item['nama'] }}</div>
                        <div class="results-row-sold">
                            <strong>{{ $item['terjual'] }} pcs</strong>
                        </div>
                        <div>
                            @php $isIncrease = strpos($item['status'], 'TINGKATKAN') !== false; @endphp
                            <span class="badge {{ $isIncrease ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                {{ $isIncrease ? '↑' : '↓' }} {{ str_replace('STOCK', 'STOK', $item['status']) }}
                            </span>
                        </div>
                        <div class="results-row-suggestion">
                            <i class="bi bi-lightbulb me-1"></i> {{ $item['saran'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const fileInfo = document.getElementById('fileInfo');
    const fileName = document.getElementById('fileName');

    // Drag and Drop Events
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('drag-over');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('drag-over');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('drag-over');

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            updateFileInfo(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            updateFileInfo(e.target.files[0]);
        }
    });

    function updateFileInfo(file) {
        fileName.textContent = file.name;
        fileInfo.classList.remove('d-none');
    }

    // Form submission with loading state
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        const btn = this.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sedang memproses...';

        setTimeout(() => {
            this.submit();
        }, 300);
    });
</script>

<script>
    // Save analysis data after upload - store multiple analyses
    @if(session('list_produk'))
    const listProduk = @json(session('list_produk'));
    const fileName = "{{ session('last_uploaded_file') ?? '' }}";

    // Create unique key for each file analysis
    const analysisKey = 'karastockAnalysis_' + fileName.replace(/[^a-zA-Z0-9]/g, '_');

    const analysisData = {
        list_produk: listProduk,
        file_name: fileName,
        timestamp: new Date().getTime()
    };

    // Save individual file analysis
    localStorage.setItem(analysisKey, JSON.stringify(analysisData));

    // Also maintain list of all uploaded files
    let filesList = localStorage.getItem('karastockFilesList');
    filesList = filesList ? JSON.parse(filesList) : [];

    // Add file to list if not already there
    if (!filesList.find(f => f.file_name === fileName)) {
        filesList.push({
            file_name: fileName,
            timestamp: new Date().getTime()
        });
    }

    localStorage.setItem('karastockFilesList', JSON.stringify(filesList));
    console.log('Analysis saved for file: ' + fileName);
    @endif

    // Load analysis data from localStorage on page load
    function restoreAnalysis() {
        const savedFiles = localStorage.getItem('karastockFilesList');

        if (savedFiles) {
            try {
                const filesList = JSON.parse(savedFiles);
                const now = new Date().getTime();

                // Filter out expired analyses (24 hours)
                const validFiles = filesList.filter(file => {
                    const hourDiff = (now - file.timestamp) / (1000 * 60 * 60);
                    return hourDiff < 24;
                });

                // Update stored list
                localStorage.setItem('karastockFilesList', JSON.stringify(validFiles));
                console.log('Valid analysis files: ' + validFiles.length);
            } catch (e) {
                console.error('Error checking analysis:', e);
            }
        }
    }

    // Check on page load
    document.addEventListener('DOMContentLoaded', function() {
        restoreAnalysis();
    });
</script>

@endsection