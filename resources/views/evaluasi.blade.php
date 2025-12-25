@extends('layout.main')

@section('page_title', 'Evaluasi Model Decision Tree')

@section('content')
<div class="card shadow border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-graph-up-arrow"></i> Evaluasi Model Decision Tree
            </h5>
            <small class="text-muted">Training & testing menggunakan data pada riwayat keputusan.</small>
        </div>
        <a href="{{ url('/') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="card-body">
        @if(!$enough_data ?? false)
            <div class="alert alert-warning border-0 bg-warning-subtle text-warning mb-0">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ $message ?? 'Data pada riwayat belum mencukupi untuk evaluasi.' }}
            </div>
        @else
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="border rounded-3 p-3 bg-light text-center h-100">
                        <div class="small text-muted mb-1">Total Data</div>
                        <div class="fs-4 fw-bold">{{ $total }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded-3 p-3 bg-light text-center h-100">
                        <div class="small text-muted mb-1">Data Training</div>
                        <div class="fs-4 fw-bold text-primary">{{ $train_count }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded-3 p-3 bg-light text-center h-100">
                        <div class="small text-muted mb-1">Data Testing</div>
                        <div class="fs-4 fw-bold text-primary">{{ $test_count }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="border rounded-3 p-3 bg-success-subtle text-success text-center h-100">
                        <div class="small text-muted mb-1">Akurasi</div>
                        <div class="fs-4 fw-bold">{{ number_format($accuracy * 100, 2) }}%</div>
                    </div>
                </div>
            </div>

            <h6 class="fw-bold mb-2"><i class="bi bi-grid-3x3-gap"></i> Confusion Matrix (ringkas)</h6>
            <div class="table-responsive mb-3">
                <table class="table table-sm table-bordered align-middle text-center">
                    <style>
                        .stats-grid {
                            display: grid;
                            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                            gap: 1.5rem;
                            margin-bottom: 2rem;
                        }

                        .stat-card {
                            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
                            border: 2px solid #e2e8f0;
                            border-radius: 12px;
                            padding: 1.5rem;
                            text-align: center;
                            transition: all 0.3s ease;
                        }

                        .stat-card:hover {
                            transform: translateY(-4px);
                            border-color: #6366f1;
                            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.1);
                        }

                        .stat-label {
                            font-size: 0.8rem;
                            color: #64748b;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            margin-bottom: 0.5rem;
                        }

                        .stat-value {
                            font-size: 2.5rem;
                            font-weight: 700;
                            background: linear-gradient(135deg, #6366f1, #f97316);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent;
                            background-clip: text;
                        }

                        .accuracy-card {
                            background: linear-gradient(135deg, #10b981, #059669);
                            color: white;
                            border-radius: 16px;
                            padding: 2rem;
                            text-align: center;
                            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
                        }

                        .accuracy-label {
                            font-size: 0.9rem;
                            opacity: 0.9;
                            text-transform: uppercase;
                            letter-spacing: 0.5px;
                            margin-bottom: 0.5rem;
                        }

                        .accuracy-value {
                            font-size: 3.5rem;
                            font-weight: 800;
                            line-height: 1;
                        }

                        .confusion-container {
                            background: white;
                            border-radius: 12px;
                            padding: 2rem;
                            margin-bottom: 2rem;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
                        }

                        .confusion-table {
                            margin-bottom: 0;
                        }

                        .confusion-table thead {
                            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
                        }

                        .confusion-table thead th {
                            font-weight: 600;
                            color: #475569;
                            padding: 1rem;
                            text-transform: uppercase;
                            font-size: 0.85rem;
                            letter-spacing: 0.5px;
                        }

                        .confusion-table tbody td {
                            padding: 1rem;
                            border-bottom: 1px solid #e2e8f0;
                        }

                        .confusion-table tbody tr:hover {
                            background: #f8fafc;
                        }

                        .info-box {
                            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(59, 130, 246, 0.02));
                            border-left: 4px solid #3b82f6;
                            border-radius: 8px;
                            padding: 1.5rem;
                        }

                        .info-box-title {
                            font-weight: 600;
                            color: #1e293b;
                            margin-bottom: 1rem;
                        }

                        .info-item {
                            margin-bottom: 0.75rem;
                            color: #475569;
                            font-size: 0.9rem;
                            line-height: 1.6;
                        }

                        .info-item code {
                            background: rgba(99, 102, 241, 0.1);
                            color: #6366f1;
                            padding: 0.2rem 0.5rem;
                            border-radius: 4px;
                            font-family: 'Courier New', monospace;
                        }
                    </style>
                        <tr>
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h4 class="fw-bold mb-1">
                                <i class="bi bi-graph-up-arrow icon-primary"></i> Evaluasi Model Decision Tree
                            </h4>
                            <p class="text-muted small mb-0">Analisis performa model dengan data training dan testing</p>
                        </div>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                            <th>Label</th>
                    @if(!$enough_data ?? false)
                        <div class="alert alert-warning border-left-4 bg-warning-subtle text-warning d-flex align-items-start" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-3 mt-1 fs-5"></i>
                            <div>
                                <strong>Data Tidak Cukup</strong><br>
                                {{ $message ?? 'Data pada riwayat belum mencukupi untuk evaluasi model.' }}
                            </div>
                        </div>
                    @else
                        <!-- Statistics Grid -->
                        <div class="stats-grid">
                            <div class="stat-card">
                                <div class="stat-label"><i class="bi bi-file-earmark"></i> Total Data</div>
                                <div class="stat-value">{{ $total }}</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-label"><i class="bi bi-book"></i> Data Training</div>
                                <div class="stat-value stat-value-primary">{{ $train_count }}</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-label"><i class="bi bi-clipboard-check"></i> Data Testing</div>
                                <div class="stat-value stat-value-accent">{{ $test_count }}</div>
                            </div>
                        </div>

                        <!-- Accuracy Card -->
                        <div class="accuracy-card mb-4">
                            <div class="accuracy-label">Model Accuracy</div>
                            <div class="accuracy-value">{{ number_format($accuracy * 100, 2) }}%</div>
                            <p class="small mb-0 mt-3 opacity-75">Persentase prediksi yang benar dari total data testing</p>
                        </div>
                            <th>TP</th>
                        <!-- Confusion Matrix -->
                        <div class="confusion-container">
                            <h5 class="fw-bold mb-4">
                                <i class="bi bi-grid-3x3-gap me-2 icon-primary"></i>
                                Confusion Matrix
                            </h5>
                            <div class="table-responsive">
                                <table class="table confusion-table align-middle text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Label Prediksi</th>
                                            <th><i class="bi bi-check-circle icon-success"></i> TP</th>
                                            <th><i class="bi bi-x-circle icon-accent"></i> FP</th>
                                            <th><i class="bi bi-exclamation-circle icon-danger"></i> FN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($confusion as $label => $row)
                                        <tr>
                                            <td class="text-start fw-bold">
                                                <span class="badge {{ strpos($label, 'TINGKATKAN') !== false ? 'bg-success' : 'bg-danger' }}">
                                                    {{ str_replace('STOCK', 'STOK', $label) }}
                                                </span>
                                            </td>
                                            <td><strong class="text-success-custom">{{ $row['TP'] }}</strong></td>
                                            <td><strong class="text-accent-custom">{{ $row['FP'] }}</strong></td>
                                            <td><strong class="text-danger-custom">{{ $row['FN'] }}</strong></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                            <th>FP</th>
                        <!-- Information Box -->
                        <div class="info-box">
                            <div class="info-box-title">
                                <i class="bi bi-info-circle me-2"></i>
                                Penjelasan Confusion Matrix
                            </div>
                            <div class="info-item">
                                <code>TP (True Positive)</code> – Model memprediksi benar untuk label ini
                            </div>
                            <div class="info-item">
                                <code>FP (False Positive)</code> – Model memprediksi label ini, tetapi sebenarnya label lain
                            </div>
                            <div class="info-item">
                                <code>FN (False Negative)</code> – Data sebenarnya label ini, tetapi model memprediksi label lain
                            </div>
                            <div class="info-item mb-0">
                                <i class="bi bi-lightbulb me-2"></i>
                                <strong>Semakin tinggi accuracy, semakin akurat model dalam membuat prediksi</strong>
                            </div>
                        </div>
                    @endif
                            <th>FN</th>



