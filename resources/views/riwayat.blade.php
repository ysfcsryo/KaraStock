@extends('layout.main')

@section('page_title', 'Riwayat Analisa')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-1">
            <i class="bi bi-clock-history"></i> Riwayat Unggahan
        </h4>
        
        @if($histories->count() > 0)
        <form action="{{ route('riwayat.hapusSemua') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA riwayat? Data tidak bisa dikembalikan.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm shadow-sm">
                <i class="bi bi-trash"></i> Hapus Semua Data
            </button>
        </form>
        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="bi bi-folder"></i> File Tersimpan
                </div>
                <div class="list-group list-group-flush">
                    @forelse($files as $f)
                        <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <div class="text-truncate me-2">
                                <i class="bi bi-file-earmark-spreadsheet text-success me-2"></i>
                                <span class="fw-bold text-dark">{{ $f }}</span>
                            </div>
                            
                            <div class="btn-group">
                                <a href="{{ route('proses.file', ['file' => $f]) }}" class="btn btn-sm btn-outline-primary" title="Lihat Visualisasi Tree & Entropy">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <form action="{{ route('riwayat.hapusByFile') }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus riwayat untuk file ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="file" value="{{ $f }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus File">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada riwayat file yang diupload.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white fw-bold py-3 d-flex justify-content-between">
                    <span><i class="bi bi-table"></i> Preview Data (Terbaru)</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 600px;">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Kelas</th>
                                    <th>Status (Label)</th>
                                    <th>File Sumber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($histories as $h)
                                <tr>
                                    <td>{{ $h->nama_produk }}</td>
                                    <td>{{ $h->kategori }}</td>
                                    <td>{{ $h->kelas_harga }}</td>
                                    <td>
                                        @php
                                            $badge = 'bg-secondary';
                                            $s = strtolower($h->status);
                                            if(strpos($s,'prioritas')!==false) $badge='bg-success';
                                            elseif(strpos($s,'dead')!==false) $badge='bg-dark';
                                            elseif(strpos($s,'warning')!==false) $badge='bg-danger';
                                            elseif(strpos($s,'restock')!==false) $badge='bg-info';
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ $h->status }}</span>
                                    </td>
                                    <td class="small text-muted">{{ $h->nama_file }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Data Kosong</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection