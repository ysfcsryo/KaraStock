@extends('layout.main')

@section('title', 'Profile')

@section('content')
<style>
    .profile-header-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 3rem 2rem;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }
    
    .profile-header-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
        opacity: 0.5;
    }
    
    .profile-avatar-wrapper {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        margin-top: -80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        padding: 6px;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.4);
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .profile-avatar-inner {
        width: 100%;
        height: 100%;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .profile-avatar-inner i {
        font-size: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .profile-card-modern {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .profile-card-modern:hover {
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }
    
    .profile-info-item {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-radius: 15px;
        margin-bottom: 1rem;
        border-left: 4px solid;
        transition: all 0.3s ease;
    }
    
    .profile-info-item:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .profile-info-item.email {
        border-left-color: #667eea;
    }
    
    .profile-info-item.date {
        border-left-color: #764ba2;
    }
    
    .profile-info-item.login {
        border-left-color: #f093fb;
    }
    
    .profile-info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .profile-info-label i {
        margin-right: 0.5rem;
        font-size: 1rem;
    }
    
    .profile-info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }
    
    .profile-name-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-align: center;
    }
    
    .profile-stats {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }
    
    .stat-card {
        flex: 1;
        min-width: 150px;
        background: white;
        padding: 1.25rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
    }
    
    .stat-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin: 0;
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-modern {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
    
    .btn-modern.btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .btn-modern.btn-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .btn-modern.btn-secondary {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #2d3748;
    }
</style>

<div class="container-fluid px-4 py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <!-- Profile Card -->
            <div class="profile-card-modern">
                <!-- Header with Gradient -->
                <div class="profile-header-gradient">
                    <div class="text-center position-relative">
                        <h2 class="text-white fw-bold mb-2">Profil Pengguna</h2>
                        <p class="text-white-50 mb-0">Informasi akun Anda di KaraStock</p>
                    </div>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <!-- Avatar -->
                    <div class="profile-avatar-wrapper">
                        <div class="profile-avatar-inner">
                            <i class="bi bi-person-fill"></i>
                        </div>
                    </div>
                    
                    <!-- Name -->
                    <h2 class="profile-name-badge mt-4">{{ Auth::user()->name }}</h2>
                    
                    <!-- Stats Cards -->
                    <div class="profile-stats">
                        <div class="stat-card">
                            <i class="bi bi-shield-check stat-icon"></i>
                            <p class="stat-value">Aktif</p>
                            <p class="stat-label">Status</p>
                        </div>
                        <div class="stat-card">
                            <i class="bi bi-calendar-event stat-icon"></i>
                            <p class="stat-value">{{ Auth::user()->created_at->diffForHumans() }}</p>
                            <p class="stat-label">Bergabung</p>
                        </div>
                        <div class="stat-card">
                            <i class="bi bi-clock-history stat-icon"></i>
                            <p class="stat-value">{{ Auth::user()->updated_at->diffForHumans() }}</p>
                            <p class="stat-label">Aktif</p>
                        </div>
                    </div>
                    
                    <!-- Info Cards -->
                    <div class="mt-4">
                        <div class="profile-info-item email">
                            <div class="profile-info-label">
                                <i class="bi bi-envelope-fill"></i>
                                Alamat Email
                            </div>
                            <p class="profile-info-value">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <div class="profile-info-item date">
                            <div class="profile-info-label">
                                <i class="bi bi-calendar-check-fill"></i>
                                Tanggal Terdaftar
                            </div>
                            <p class="profile-info-value">{{ Auth::user()->created_at->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
                        </div>
                        
                        <div class="profile-info-item login">
                            <div class="profile-info-label">
                                <i class="bi bi-clock-fill"></i>
                                Terakhir Aktif
                            </div>
                            <p class="profile-info-value">{{ Auth::user()->updated_at->isoFormat('dddd, D MMMM Y - HH:mm') }} WIB</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <a href="{{ url('/') }}" class="btn btn-modern btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali ke Dashboard
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-modern btn-danger">
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
