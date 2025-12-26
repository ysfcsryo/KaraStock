@extends('layout.main')

@section('page_title', 'Riwayat Analisa')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-1">
            <i class="bi bi-clock-history"></i> Riwayat Unggahan
        </h4>
        
        @if($histories->count() > 0)
        <button type="button" class="btn btn-danger btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteAllModal">
            <i class="bi bi-trash"></i> Hapus Semua Data
        </button>
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
                    @if(!request('file'))
                        <small class="text-muted">(Klik untuk filter)</small>
                    @endif
                </div>
                <div class="list-group list-group-flush">
                    @forelse($files as $f)
                        <div class="list-group-item p-0 {{ request('file') == $f ? 'bg-primary bg-opacity-10' : '' }}">
                            <a href="{{ route('riwayat.index', ['file' => $f]) }}" 
                               class="d-block p-3 text-decoration-none file-list-item-transition {{ request('file') == $f ? 'border-start border-4 border-primary' : '' }}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1 me-2">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="bi bi-file-earmark-spreadsheet {{ request('file') == $f ? 'text-primary' : 'text-success' }} me-2 fs-5"></i>
                                            <span class="fw-bold {{ request('file') == $f ? 'text-primary' : 'text-dark' }}">
                                                {{ Str::limit($f, 30) }}
                                            </span>
                                        </div>
                                        <small class="text-muted d-block mb-1">
                                            <i class="bi bi-database"></i> {{ $histories->where('nama_file', $f)->count() }} data
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="bi bi-clock"></i> 
                                            @if($fileTimestamps[$f])
                                                @php
                                                    $uploadTime = \Carbon\Carbon::parse($fileTimestamps[$f]);
                                                    $diffInDays = $uploadTime->diffInDays(now());
                                                @endphp
                                                @if($diffInDays >= 2)
                                                    {{ $uploadTime->locale('id')->isoFormat('D MMM YYYY, HH:mm') }}
                                                @else
                                                    {{ $uploadTime->locale('id')->diffForHumans() }}
                                                @endif
                                            @else
                                                -
                                            @endif
                                        </small>
                                        <small class="text-muted d-block">
                                            <i class="bi bi-person-fill"></i> 
                                            @if(isset($fileUploaders[$f]) && $fileUploaders[$f])
                                                {{ $fileUploaders[$f]->name }}
                                            @else
                                                <span class="text-muted fst-italic">Tidak diketahui</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </a>
                            
                            <div class="d-flex gap-1 px-3 pb-3 pt-0">
                                <a href="{{ route('proses.file', ['file' => $f]) }}" 
                                   class="btn btn-sm btn-outline-primary flex-fill" 
                                   title="Lihat Visualisasi">
                                    <i class="bi bi-diagram-3"></i> Visualisasi
                                </a>

                                <form action="{{ route('riwayat.hapusByFile') }}" 
                                      method="POST" 
                                      class="flex-fill delete-file-form">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="file" value="{{ $f }}">
                                    <button type="button" class="btn btn-sm btn-outline-danger w-100 delete-file-btn" 
                                            data-filename="{{ $f }}" 
                                            title="Hapus File">
                                        <i class="bi bi-trash"></i> Hapus
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
                <div class="card-header bg-white fw-bold py-3 d-flex justify-content-between align-items-center">
                    <span>
                        <i class="bi bi-table"></i> Preview Data
                        @if(request('file'))
                            <span class="badge bg-primary ms-2">{{ request('file') }}</span>
                        @else
                            <span class="text-muted small">(Semua File)</span>
                        @endif
                    </span>
                    @if(request('file'))
                        <a href="{{ route('riwayat.index') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Lihat Semua
                        </a>
                    @endif
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-scroll-container">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light sticky-top">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Produk</th>
                                    <th>Kategori</th>
                                    <th>Kelas</th>
                                    <th>Klasifikasi</th>
                                    <th>File Sumber</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $filteredHistories = request('file') 
                                        ? $histories->where('nama_file', request('file')) 
                                        : $histories;
                                @endphp
                                @forelse($filteredHistories as $index => $h)
                                <tr>
                                    <td class="text-center text-muted">{{ $index + 1 }}</td>
                                    <td>{{ $h->nama_produk }}</td>
                                    <td>{{ $h->kategori }}</td>
                                    <td>{{ $h->kelas_harga }}</td>
                                    <td>
                                        @php
                                            $badge = 'bg-secondary';
                                            $s = strtolower($h->status);
                                            if(strpos($s,'segera')!==false) $badge='bg-success';
                                            elseif(strpos($s,'mati')!==false) $badge='bg-dark';
                                            elseif(strpos($s,'evaluasi')!==false) $badge='bg-warning text-dark';
                                            elseif(strpos($s,'terjadwal')!==false) $badge='bg-info';
                                            elseif(strpos($s,'optimal')!==false) $badge='bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ $h->status }}</span>
                                    </td>
                                    <td class="small text-muted">{{ $h->nama_file }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        @if(request('file'))
                                            Tidak ada data untuk file ini
                                        @else
                                            Belum ada data riwayat
                                        @endif
                                    </td>
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

<!-- Modal Delete All -->
<div class="modal fade" id="deleteAllModal" tabindex="-1" aria-labelledby="deleteAllModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title" id="deleteAllModalLabel">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus Semua
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-trash3 text-danger mb-3 modal-icon-lg"></i>
                <h6 class="fw-bold mb-2">Yakin ingin menghapus SEMUA riwayat?</h6>
                <p class="text-muted mb-0">Data yang dihapus tidak dapat dikembalikan lagi.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <form action="{{ route('riwayat.hapusSemua') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4">
                        <i class="bi bi-trash me-1"></i> Ya, Hapus Semua
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete File -->
<div class="modal fade" id="deleteFileModal" tabindex="-1" aria-labelledby="deleteFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning border-0">
                <h5 class="modal-title text-dark" id="deleteFileModalLabel">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>Konfirmasi Hapus File
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-file-earmark-x text-warning mb-3 modal-icon-lg"></i>
                <h6 class="fw-bold mb-2">Hapus riwayat untuk file:</h6>
                <p class="text-primary fw-bold mb-2" id="deleteFileName"></p>
                <p class="text-muted small mb-0">Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="button" class="btn btn-danger px-4" id="confirmDeleteFile">
                    <i class="bi bi-trash me-1"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle delete file button click
    let currentForm = null;
    
    document.addEventListener('DOMContentLoaded', function() {
        const deleteFileButtons = document.querySelectorAll('.delete-file-btn');
        const deleteFileModal = new bootstrap.Modal(document.getElementById('deleteFileModal'));
        const confirmDeleteBtn = document.getElementById('confirmDeleteFile');
        const deleteFileNameEl = document.getElementById('deleteFileName');
        
        deleteFileButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filename = this.getAttribute('data-filename');
                currentForm = this.closest('.delete-file-form');
                deleteFileNameEl.textContent = filename;
                deleteFileModal.show();
            });
        });
        
        confirmDeleteBtn.addEventListener('click', function() {
            if (currentForm) {
                currentForm.submit();
            }
        });
    });
</script>

@endsection