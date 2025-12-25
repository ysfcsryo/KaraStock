@extends('layout.main')

@section('page_title', 'Hasil Prediksi Produk')

@section('content')

<style>
    .result-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .result-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border: 1px solid #e2e8f0;
    }

    .result-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .result-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .result-title {
        position: relative;
        z-index: 1;
    }

    .result-body {
        padding: 2.5rem;
        text-align: center;
    }

    .product-name {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        margin: 1.5rem 0;
    }

    .condition-info {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        gap: 2rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .condition-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .condition-item-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .sold-icon {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .age-icon {
        background: rgba(249, 115, 22, 0.1);
        color: #f97316;
    }

    .condition-value {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .condition-label {
        font-size: 0.75rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .condition-number {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
    }

    .status-large {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 2rem 0 1.5rem;
        line-height: 1;
    }

    .status-increase {
        color: #10b981;
    }

    .status-decrease {
        color: #ef4444;
    }

    .status-label {
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }

    .rekomendasi-box {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-left: 4px solid #6366f1;
        border-radius: 8px;
        padding: 1.5rem;
        margin: 2rem 0;
        text-align: left;
    }

    .rekomendasi-title {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rekomendasi-text {
        color: #475569;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-primary-large {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        border: none;
        color: white;
        font-weight: 600;
        padding: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-primary-large:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
        color: white;
    }

    .btn-secondary-large {
        background: white;
        border: 2px solid #e2e8f0;
        color: #6366f1;
        font-weight: 600;
        padding: 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-secondary-large:hover {
        border-color: #6366f1;
        background: #f8fafc;
        color: #6366f1;
    }

    @media (max-width: 640px) {
        .action-buttons {
            grid-template-columns: 1fr;
        }

        .condition-info {
            gap: 1rem;
        }

        .result-body {
            padding: 1.5rem;
        }

        .status-large {
            font-size: 2.5rem;
        }
    }
</style>

<div class="result-container">
    <div class="result-card animate__animated animate__fadeInUp">
        <!-- Header -->
        <div class="result-header">
            <div class="result-title">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-white bg-opacity-25 text-white">
                        <i class="bi bi-diagram-3"></i> Decision Tree Model
                    </span>
                </div>
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-bar-chart-line"></i> Hasil Analisa Prediksi
                </h4>
            </div>
        </div>

        <!-- Body -->
        <div class="result-body">
            <!-- Product Name -->
            <div class="product-name">{{ $nama }}</div>

            <!-- Condition Information -->
            <div class="condition-info">
                <div class="condition-item">
                    <div class="condition-item-icon sold-icon">
                        <i class="bi bi-box2-heart"></i>
                    </div>
                    <div class="condition-value">
                        <span class="condition-label">Terjual</span>
                        <span class="condition-number">{{ $terjual }}</span>
                    </div>
                </div>
                <div class="condition-item">
                    <div class="condition-item-icon age-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="condition-value">
                        <span class="condition-label">Umur Barang</span>
                        <span class="condition-number">{{ $lama }} hari</span>
                    </div>
                </div>
            </div>

            <!-- Status Result -->
            <div class="status-label" style="color: {{ $status === 'TINGKATKAN STOCK' ? '#059669' : '#991b1b' }};">
                Rekomendasi Sistem
            </div>
            <div class="status-large {{ $status === 'TINGKATKAN STOCK' ? 'status-increase' : 'status-decrease' }}">
                {{ str_replace('STOCK', 'STOK', $status) }}
            </div>

            <!-- Recommendation Box -->
            <div class="rekomendasi-box">
                <div class="rekomendasi-title">
                    <i class="bi bi-lightbulb"></i>
                    Analisis & Saran
                </div>
                <p class="rekomendasi-text">{{ $rekomendasi }}</p>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ url('/') }}" class="btn-primary-large">
                    <i class="bi bi-cloud-arrow-up"></i> Analisa Produk Lain
                </a>
                <a href="{{ url('/riwayat') }}" class="btn-secondary-large">
                    <i class="bi bi-clock-history"></i> Lihat Riwayat
                </a>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="mt-4 p-3 text-center text-muted small">
        <i class="bi bi-info-circle"></i> 
        Hasil prediksi ini didasarkan pada model Decision Tree yang telah dilatih dengan data historis Anda
    </div>
</div>

@endsection