@extends('layout.main')

@section('title', 'Kelola User')

@section('content')
<style>
    .admin-header {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        color: #2d3748;
        margin-bottom: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
    }
    
    .user-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        height: 100%;
        min-height: 280px;
        display: flex;
        flex-direction: column;
    }
    
    .user-card .card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    
    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    }
    
    .role-badge {
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .role-super-admin {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
    }
    
    .role-admin {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .role-staff {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #2d3748;
    }
    
    .btn-modern {
        border-radius: 50px;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    
    .user-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        font-weight: 700;
        flex-shrink: 0;
        overflow: hidden;
        border: 3px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .stats-card {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
</style>

<div class="container-fluid px-4 py-4">
    <!-- Header -->
    <div class="admin-header">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="mb-2 text-dark"><i class="bi bi-people-fill me-2 text-primary"></i>Kelola User</h2>
                <p class="mb-0 text-muted">Manajemen pengguna sistem KaraStock</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-modern">
                <i class="bi bi-plus-circle me-2"></i>Tambah User Baru
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $users->count() }}</div>
                <div class="text-muted small text-uppercase fw-bold">Total User</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $users->where('role', 'super_admin')->count() }}</div>
                <div class="text-muted small text-uppercase fw-bold">Super Admin</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stats-card">
                <div class="stats-number">{{ $users->where('role', 'admin')->count() }}</div>
                <div class="text-muted small text-uppercase fw-bold">Admin</div>
            </div>
        </div>
    </div>

    <!-- User List -->
    <div class="row">
        @foreach($users as $user)
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 mb-4 d-flex">
            <div class="user-card card w-100">
                <div class="card-body p-4 d-flex flex-column">
                    <div class="d-flex align-items-start mb-4">
                        <div class="user-avatar me-3">
                            @if($user->profile_photo)
                                <img src="{{ asset($user->profile_photo) }}" alt="{{ $user->name }}">
                            @else
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-2 fw-bold">{{ $user->name }}</h5>
                            <p class="text-muted small mb-2 user-info-compact">
                                <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                            </p>
                            <span class="role-badge role-{{ str_replace('_', '-', $user->role) }}">
                                {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                            </span>
                        </div>
                    </div>

                    <div class="small text-muted mb-3 flex-grow-1">
                        <div class="mb-1">
                            <i class="bi bi-calendar-check me-1"></i>
                            Bergabung: {{ $user->created_at->format('d M Y') }}
                        </div>
                        <div>
                            <i class="bi bi-clock-history me-1"></i>
                            Aktif: {{ $user->updated_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-auto action-buttons-container">
                        @if($user->id !== auth()->id() || $user->role === 'super_admin')
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary flex-grow-1">
                            <i class="bi bi-pencil me-1"></i>Edit
                        </a>
                        @endif
                        
                        @if($user->id !== auth()->id() && $user->role !== 'super_admin')
                        <button type="button" class="btn btn-sm btn-danger flex-grow-1 delete-user-btn" 
                                data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}">
                            <i class="bi bi-trash me-1"></i>Hapus
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($users->isEmpty())
    <div class="text-center py-5">
        <i class="bi bi-people empty-state-icon"></i>
        <p class="text-muted mt-3">Belum ada user terdaftar</p>
    </div>
    @endif
</div>

<!-- Modal Konfirmasi Hapus User - Custom Modal -->
<div id="deleteUserModal" class="custom-modal hidden">
    <div class="custom-modal-overlay" onclick="closeDeleteUserModal()"></div>
    <div class="custom-modal-content">
        <div class="modal-content border-0 shadow-lg modal-rounded">
            <div class="modal-header bg-gradient text-white border-0" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus User
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeDeleteUserModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5 px-4">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger bg-opacity-10" style="width: 80px; height: 80px;">
                        <i class="bi bi-person-x-fill text-danger" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Hapus User Ini?</h4>
                <p class="text-muted mb-3 fs-6">Yakin ingin menghapus user berikut dari sistem?</p>
                <div class="alert alert-light border mb-3">
                    <div class="text-start mb-2">
                        <i class="bi bi-person-fill text-primary me-2"></i>
                        <strong>Nama:</strong>
                        <span id="modal-user-name" class="ms-2 text-dark">-</span>
                    </div>
                    <div class="text-start">
                        <i class="bi bi-envelope-fill text-primary me-2"></i>
                        <strong>Email:</strong>
                        <span id="modal-user-email" class="ms-2 text-dark">-</span>
                    </div>
                </div>
                <div class="alert alert-danger border-0 bg-danger bg-opacity-10 mb-0">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    <small class="text-danger fw-semibold">Data user akan dihapus permanen dan tidak dapat dikembalikan!</small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                <button type="button" class="btn btn-lg btn-light px-5 shadow-sm" onclick="closeDeleteUserModal()">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <form id="delete-user-form" method="POST" action="" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-lg btn-danger px-5 shadow-sm">
                        <i class="bi bi-trash-fill me-2"></i>Ya, Hapus User
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Custom Modal Functions
function showDeleteUserModal() {
    const modal = document.getElementById('deleteUserModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDeleteUserModal() {
    const modal = document.getElementById('deleteUserModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

// Handle modal data population
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-user-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.getAttribute('data-user-name');
            const userEmail = this.getAttribute('data-user-email');
            
            // Update modal content
            document.getElementById('modal-user-name').textContent = userName;
            document.getElementById('modal-user-email').textContent = userEmail;
            
            // Update form action
            const form = document.getElementById('delete-user-form');
            form.action = '{{ route("admin.users.index") }}/' + userId;
            
            // Show modal
            showDeleteUserModal();
        });
    });
});
</script>
@endsection
