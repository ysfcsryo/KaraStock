@extends('layout.main')

@section('title', 'Profile')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Profile Card -->
            <div class="card shadow-sm">
                <div class="card-header" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                    <h4 class="mb-0 text-white">
                        <i class="bi bi-person-circle me-2"></i>Profil Pengguna
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="profile-avatar mb-3">
                                <i class="bi bi-person-circle" style="font-size: 120px; color: #6366f1;"></i>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h3 class="mb-3">{{ Auth::user()->name }}</h3>
                            
                            <div class="mb-3">
                                <label class="text-muted fw-bold mb-1">
                                    <i class="bi bi-envelope me-2"></i>Email
                                </label>
                                <p class="mb-0">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <label class="text-muted fw-bold mb-1">
                                    <i class="bi bi-calendar-check me-2"></i>Terdaftar Sejak
                                </label>
                                <p class="mb-0">{{ Auth::user()->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <label class="text-muted fw-bold mb-1">
                                    <i class="bi bi-clock-history me-2"></i>Terakhir Login
                                </label>
                                <p class="mb-0">{{ Auth::user()->updated_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('/') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
