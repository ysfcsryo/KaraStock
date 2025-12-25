@extends('layout.main')

@section('title', 'Tambah User')

@section('content')
<style>
    .form-modern {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        padding: 2.5rem;
    }
    
    .form-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }
    
    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-header">
                <h2 class="mb-2"><i class="bi bi-person-plus-fill me-2"></i>Tambah User Baru</h2>
                <p class="mb-0 opacity-75">Isi form di bawah untuk menambahkan user baru</p>
            </div>

            <div class="form-modern">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="bi bi-person me-1"></i>Nama Lengkap
                        </label>
                        <input type="text" 
                               class="form-control @error('name') is-invalid @enderror" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus
                               placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope me-1"></i>Email
                        </label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required
                               placeholder="contoh@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mb-4">
                        <label for="role" class="form-label">
                            <i class="bi bi-shield-check me-1"></i>Role / Jabatan
                        </label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin (Full Access)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Kelola Stok & Analisa)</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>
                                <strong>Super Admin:</strong> Kelola user & full akses<br>
                                <strong>Admin:</strong> Upload, analisa, hapus data
                            </small>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-key me-1"></i>Password
                        </label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required
                               placeholder="Minimal 8 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-key-fill me-1"></i>Konfirmasi Password
                        </label>
                        <input type="password" 
                               class="form-control" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               placeholder="Ketik ulang password">
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Simpan User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
