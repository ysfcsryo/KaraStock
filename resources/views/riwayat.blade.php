@extends('layout.main')

@section('page_title', 'Riwayat Analisa')

@section('content')
<div class="container-fluid px-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-1">
            <i class="bi bi-clock-history"></i> Riwayat Unggahan
        </h4>
        
        @if($histories->count() > 0)
        <button type="button" class="btn btn-danger btn-sm shadow-sm" onclick="showDeleteAllModal()">
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
                        <div class="list-group-item py-4 {{ request('file') == $f ? 'bg-primary bg-opacity-10 border-start border-4 border-primary' : '' }}">
                            <a href="{{ route('riwayat.index', ['file' => $f]) }}" 
                               class="text-decoration-none d-block">
                                <div class="text-center mb-3">
                                    <i class="bi bi-file-earmark-spreadsheet {{ request('file') == $f ? 'text-primary' : 'text-success' }} fs-1 mb-2"></i>
                                    <h6 class="fw-bold mb-0 {{ request('file') == $f ? 'text-primary' : 'text-dark' }}">
                                        {{ Str::limit($f, 30) }}
                                    </h6>
                                </div>
                                <div class="text-center mb-3">
                                    <div class="mb-1">
                                        <i class="bi bi-database text-muted"></i> 
                                        <small class="text-muted">{{ $histories->where('nama_file', $f)->count() }} data</small>
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-clock text-muted"></i> 
                                        <small class="text-muted">
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
                                    </div>
                                    <div>
                                        <i class="bi bi-person-fill text-muted"></i> 
                                        <small class="text-muted">
                                            @if(isset($fileUploaders[$f]) && $fileUploaders[$f])
                                                {{ $fileUploaders[$f]->name }}
                                            @else
                                                <span class="fst-italic">Tidak diketahui</span>
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </a>
                            
                            <div class="d-flex gap-2">
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

<!-- Modal Delete All - Custom Modal -->
<div id="deleteAllModal" class="custom-modal hidden">
    <div class="custom-modal-overlay" onclick="closeDeleteAllModal()"></div>
    <div class="custom-modal-content">
        <div class="modal-content border-0 shadow-lg modal-rounded">
            <div class="modal-header bg-gradient text-white border-0" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus Semua
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeDeleteAllModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5 px-4">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10" style="width: 80px; height: 80px;">
                        <i class="bi bi-trash3-fill text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Hapus Semua Riwayat?</h4>
                <p class="text-muted mb-4 fs-6">Yakin ingin menghapus <strong>SEMUA</strong> riwayat yang tersimpan?</p>
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <small class="text-danger fw-semibold">Data yang dihapus tidak dapat dikembalikan lagi!</small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                <button type="button" class="btn btn-lg btn-light px-5 shadow-sm" onclick="closeDeleteAllModal()">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <form action="{{ route('riwayat.hapusSemua') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-danger px-5 shadow-sm">
                        <i class="bi bi-trash-fill me-2"></i>Ya, Hapus Semua
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete File - Custom Modal -->
<div id="deleteFileModal" class="custom-modal hidden">
    <div class="custom-modal-overlay" onclick="closeDeleteFileModal()"></div>
    <div class="custom-modal-content">
        <div class="modal-content border-0 shadow-lg modal-rounded">
            <div class="modal-header bg-gradient text-white border-0" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>Konfirmasi Hapus File
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeDeleteFileModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5 px-4">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10" style="width: 80px; height: 80px;">
                        <i class="bi bi-file-earmark-x-fill text-warning" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Hapus Riwayat File?</h4>
                <p class="text-muted mb-2 fs-6">Hapus semua riwayat untuk file:</p>
                <div class="alert alert-warning border-0 bg-warning bg-opacity-10 mb-3">
                    <i class="bi bi-file-earmark-spreadsheet-fill me-2 text-warning"></i>
                    <strong class="text-dark" id="deleteFileName">-</strong>
                </div>
                <small class="text-muted d-block">
                    <i class="bi bi-info-circle-fill me-1"></i>
                    Data yang dihapus tidak dapat dikembalikan
                </small>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                <button type="button" class="btn btn-lg btn-light px-5 shadow-sm" onclick="closeDeleteFileModal()">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-lg btn-danger px-5 shadow-sm" id="confirmDeleteFile">
                    <i class="bi bi-trash-fill me-2"></i>Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Custom Modal Functions
    let currentForm = null;
    
    function showDeleteAllModal() {
        const modal = document.getElementById('deleteAllModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteAllModal() {
        const modal = document.getElementById('deleteAllModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
    
    function showDeleteFileModal() {
        const modal = document.getElementById('deleteFileModal');
        modal.classList.remove('hidden');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteFileModal() {
        const modal = document.getElementById('deleteFileModal');
        modal.classList.add('hidden');
        modal.style.display = 'none';
        document.body.style.overflow = '';
        currentForm = null;
    }
    
    // Handle delete file button click
    document.addEventListener('DOMContentLoaded', function() {
        const deleteFileButtons = document.querySelectorAll('.delete-file-btn');
        const confirmDeleteBtn = document.getElementById('confirmDeleteFile');
        const deleteFileNameEl = document.getElementById('deleteFileName');
        
        deleteFileButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filename = this.getAttribute('data-filename');
                currentForm = this.closest('.delete-file-form');
                deleteFileNameEl.textContent = filename;
                showDeleteFileModal();
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