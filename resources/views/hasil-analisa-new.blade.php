@extends('layout.main')

@section('page_title', 'Hasil Analisa - Decision Tree')

@section('content')

<div class="container-fluid px-0">
    <!-- Header with Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-primary mb-1">
                <i class="bi bi-bar-chart-fill"></i> Hasil Analisa Decision Tree
            </h4>
            <small class="text-muted">Ringkasan analisa dan rekomendasi stok untuk produk Anda</small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                <i class="bi bi-cloud-arrow-up"></i> Upload Data
            </a>
            <a href="{{ url('/riwayat') }}" class="btn btn-outline-info">
                <i class="bi bi-clock-history"></i> Riwayat
            </a>
        </div>
    </div>

    <!-- Analysis Container -->
    <div id="analisisContent"></div>

    <!-- Empty State -->
    <div id="emptyState" class="card shadow-sm border-0 d-none">
        <div class="card-body text-center py-5">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📊</div>
            <h5 class="fw-bold mb-2">Belum Ada Data Analisa</h5>
            <p class="text-muted mb-4">
                Silahkan upload file CSV terlebih dahulu untuk mendapatkan hasil analisa Decision Tree.
            </p>
            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="bi bi-cloud-arrow-up"></i> Upload File CSV
            </a>
        </div>
    </div>
</div>

<script>
    function loadAnalysis() {
        const savedAnalysis = localStorage.getItem('karastockAnalysis');
        const container = document.getElementById('analisisContent');
        const emptyState = document.getElementById('emptyState');

        if (savedAnalysis) {
            try {
                const data = JSON.parse(savedAnalysis);
                const now = new Date().getTime();
                const hourDiff = (now - data.timestamp) / (1000 * 60 * 60);

                if (hourDiff < 24) {
                    renderAnalysis(container, data.list_produk, data.last_uploaded_file);
                    emptyState.classList.add('d-none');
                    return;
                } else {
                    localStorage.removeItem('karastockAnalysis');
                    localStorage.removeItem('karastockAnalysisHTML');
                }
            } catch (e) {
                console.error('Error loading analysis:', e);
            }
        }

        emptyState.classList.remove('d-none');
    }

    function renderAnalysis(container, listProduk, lastFile) {
        if (!listProduk || listProduk.length === 0) return;

        let html = `
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="mb-1 fw-bold text-primary">
                        <i class="bi bi-check2-circle"></i> Ringkasan Analisa
                    </h5>
                    <small class="text-muted">
                        Hasil keputusan model Decision Tree berdasarkan file yang diupload.
                    </small>
                </div>
                <div class="text-end">
                    <div class="badge bg-primary-subtle text-primary rounded-pill mb-1">
                        <i class="bi bi-diagram-3"></i> Decision Tree Model
                    </div>
                    <div class="small text-muted">
                        Total produk: <strong>${listProduk.length}</strong>
                    </div>
                </div>
            </div>
            
            <div class="d-flex gap-2 flex-wrap">
                <a href="/pemrosesan-file?file=${encodeURIComponent(lastFile)}" class="btn btn-primary btn-sm">
                    <i class="bi bi-diagram-3"></i> Visualisasi Decision Tree
                </a>
                <a href="/pemrosesan-file?file=${encodeURIComponent(lastFile)}#entropy" class="btn btn-success btn-sm">
                    <i class="bi bi-calculator"></i> Entropy & Information Gain
                </a>
                <button class="btn btn-outline-secondary btn-sm" onclick="clearAnalysisCache()">
                    <i class="bi bi-trash"></i> Hapus Data
                </button>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-dark fw-semibold">
                    Visualisasi Pohon Keputusan (Sederhana)
                </h5>
                <span class="badge bg-primary-subtle text-primary border-0">
                    <i class="bi bi-diagram-3"></i> Decision Tree Logic
                </span>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center text-center gap-3 small">
                <div class="p-3 border rounded-3 bg-light shadow-sm flex-fill" style="max-width:260px;">
                    <div class="fw-bold mb-1">Node 1</div>
                    <div class="text-muted">Apakah penjualan bagus?</div>
                    <div class="mt-2"><code>Terjual ≥ 50</code></div>
                    <div class="mt-2">
                        <span class="badge bg-success">TINGKATKAN STOCK</span>
                    </div>
                </div>

                <div class="d-flex flex-md-column align-items-center justify-content-center text-muted">
                    <i class="bi bi-arrow-down-short d-none d-md-block fs-3"></i>
                    <i class="bi bi-arrow-right-short d-md-none fs-3"></i>
                </div>

                <div class="p-3 border rounded-3 bg-light shadow-sm flex-fill" style="max-width:260px;">
                    <div class="fw-bold mb-1">Node 2</div>
                    <div class="text-muted">Jika Terjual &lt; 50</div>
                    <div class="mt-2"><code>Lama Barang &lt; 30 hari</code></div>
                    <div class="mt-2">
                        <span class="badge bg-primary">TINGKATKAN STOCK</span>
                    </div>
                </div>

                <div class="d-flex flex-md-column align-items-center justify-content-center text-muted">
                    <i class="bi bi-arrow-down-short d-none d-md-block fs-3"></i>
                    <i class="bi bi-arrow-right-short d-md-none fs-3"></i>
                </div>

                <div class="p-3 border rounded-3 bg-light shadow-sm flex-fill" style="max-width:260px;">
                    <div class="fw-bold mb-1">Node 3</div>
                    <div class="text-muted">Jika Terjual &lt; 50 &amp; Lama ≥ 30</div>
                    <div class="mt-2"><code>Barang lama &amp; kurang laku</code></div>
                    <div class="mt-2">
                        <span class="badge bg-danger">KURANGI STOCK</span>
                    </div>
                </div>
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
                        <i class="bi bi-list-check me-2" style="color: #6366f1;"></i>
                        Rekomendasi Per Produk
                    </h5>
                    <span class="badge bg-primary">${listProduk.length} Produk</span>
                </div>
                <div>
                    ${listProduk.map((item, index) => {
                        const isIncrease = item.status.includes('TINGKATKAN');
                        return `
                    <div class="product-row" style="display: grid; grid-template-columns: 60px 2fr 1fr 1.5fr 2fr; gap: 1rem; align-items: center; padding: 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <div style="text-align: center; color: #94a3b8; font-weight: 600;">${index + 1}</div>
                        <div style="font-weight: 600; color: #1e293b;">${item.nama}</div>
                        <div style="background: #f8fafc; padding: 0.5rem; border-radius: 8px; text-align: center; font-size: 0.85rem;">
                            <strong>${item.terjual} pcs</strong>
                        </div>
                        <div>
                            <span class="badge ${isIncrease ? 'bg-success' : 'bg-danger'} px-3 py-2">
                                ${isIncrease ? '↑' : '↓'} ${item.status.replace('STOCK', 'STOK')}
                            </span>
                        </div>
                        <div style="color: #64748b; font-size: 0.85rem;">
                            <i class="bi bi-lightbulb me-1"></i> ${item.saran}
                        </div>
                    </div>
                        `;
                    }).join('')}
                </div>
            </div>
        </div>
    </div>
    `;

        container.innerHTML = html;
    }

    function clearAnalysisCache() {
        if (confirm('Yakin ingin menghapus data analisa?')) {
            localStorage.removeItem('karastockAnalysis');
            localStorage.removeItem('karastockAnalysisHTML');
            loadAnalysis();
        }
    }

    // Load analysis when page loads
    document.addEventListener('DOMContentLoaded', function() {
        loadAnalysis();
    });
</script>

@endsection