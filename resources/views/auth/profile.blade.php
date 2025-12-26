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
        overflow: hidden;
    }
    
    .profile-avatar-inner i {
        font-size: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .profile-avatar-inner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .photo-upload-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        border: 4px solid white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .photo-upload-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }
    
    .photo-upload-btn i {
        color: white;
        font-size: 1.2rem;
    }
    
    #profilePhotoInput {
        display: none;
    }
    
    .profile-name-input {
        outline: none;
        box-shadow: none !important;
    }
    
    .profile-name-input:focus {
        border-bottom: 2px solid #667eea !important;
    }
    
    .profile-info-item input.form-control {
        outline: none;
        padding: 0.5rem 0;
    }
    
    .profile-info-item input.form-control:focus {
        border-bottom: 2px solid #667eea;
        box-shadow: none;
    }
    
    /* Modal Styling */
    .modal-content {
        animation: modalSlideUp 0.3s ease-out;
    }
    
    @keyframes modalSlideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .preview-container {
        animation: zoomIn 0.4s ease-out;
    }
    
    @keyframes zoomIn {
        from {
            opacity: 0;
            transform: scale(0.8);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
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
    
    .profile-info-item.email input {
        word-break: break-all;
        font-size: 0.95rem;
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
                    <!-- Avatar with Upload Button -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                        @csrf
                        <!-- Hidden input for trigger photo upload only -->
                        <input type="hidden" name="upload_type" value="full" id="uploadType">
                        
                        <div class="profile-avatar-wrapper">
                            <div class="profile-avatar-inner">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ asset(Auth::user()->profile_photo) }}" alt="Profile Photo" id="profilePreview">
                                @else
                                    <i class="bi bi-person-fill" id="defaultAvatar"></i>
                                @endif
                            </div>
                            <label for="profilePhotoInput" class="photo-upload-btn" title="Ubah Foto Profile">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" class="hidden">
                        </div>
                    
                    <!-- Name (Editable) -->
                    <div class="mt-4 text-center">
                        <input type="text" name="name" class="form-control text-center fw-bold fs-4 border-0 bg-transparent profile-name-input profile-name-gradient" 
                               value="{{ Auth::user()->name }}" required>
                    </div>
                    
                    <!-- Email (Editable) -->
                    <div class="mt-3 px-4">
                        <div class="profile-info-item email">
                            <div class="profile-info-label">
                                <i class="bi bi-envelope-fill"></i>
                                Alamat Email
                            </div>
                            <input type="email" name="email" class="form-control border-0 bg-transparent fw-semibold" 
                                   value="{{ Auth::user()->email }}" required>
                        </div>
                    </div>
                    
                    <!-- Save Button -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-modern btn-primary">
                            <i class="bi bi-check2-circle me-2"></i>Simpan Perubahan
                        </button>
                        @if(Auth::user()->profile_photo)
                        <button type="button" class="btn btn-modern btn-secondary" onclick="deletePhoto()">
                            <i class="bi bi-trash me-2"></i>Hapus Foto
                        </button>
                        @endif
                    </div>
                    </form>
                    
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
                    <div class="mt-4 px-4">
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

<!-- Form untuk hapus foto -->
<form id="deletePhotoForm" action="{{ route('profile.deletePhoto') }}" method="POST" class="profile-form-hidden">
    @csrf
</form>

<!-- Modal Preview Upload - Custom Simple Modal -->
<div id="uploadPreviewModal" class="custom-modal hidden">
    <div class="custom-modal-overlay" onclick="closeUploadModal()"></div>
    <div class="custom-modal-content">
        <div class="modal-content border-0 shadow-lg modal-rounded">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-camera-fill me-2"></i>Preview Foto Profile
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeUploadModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5 px-4">
                <div class="mb-4">
                    <div class="preview-container-circle mx-auto" style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; border: 4px solid #6366f1; box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3);">
                        <img id="modalPreviewImage" src="" alt="Preview" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <h4 class="fw-bold mb-2 text-dark">Upload Foto Ini?</h4>
                <p class="text-muted mb-0 fs-6">Foto akan langsung disimpan sebagai profile Anda</p>
                <div class="alert alert-info border-0 bg-primary bg-opacity-10 mt-3 mb-0">
                    <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                    <small class="text-primary fw-semibold">Maksimal ukuran: 2MB</small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                <button type="button" class="btn btn-lg btn-light px-5 shadow-sm" onclick="closeUploadModal()">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-lg btn-primary px-5 shadow-sm" onclick="submitUpload()">
                    <i class="bi bi-upload me-2"></i>Upload Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus - Custom Simple Modal -->
<div id="deletePhotoModal" class="custom-modal hidden">
    <div class="custom-modal-overlay" onclick="closeDeleteModal()"></div>
    <div class="custom-modal-content">
        <div class="modal-content border-0 shadow-lg modal-rounded">
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                <h5 class="modal-title text-white fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus Foto
                </h5>
                <button type="button" class="btn-close btn-close-white" onclick="closeDeleteModal()" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center py-5 px-4">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background: rgba(236, 72, 153, 0.1);">
                        <i class="bi bi-trash-fill" style="font-size: 2.5rem; color: #ec4899;"></i>
                    </div>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Hapus Foto Profile?</h4>
                <p class="text-muted mb-3 fs-6">Foto profile Anda akan dihapus dan kembali ke avatar default.</p>
                <div class="alert alert-warning border-0 bg-warning bg-opacity-10 mb-0">
                    <i class="bi bi-info-circle-fill me-2 text-warning"></i>
                    <small class="text-dark fw-semibold">Anda dapat upload foto baru kapan saja</small>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pb-4 gap-2">
                <button type="button" class="btn btn-lg btn-light px-5 shadow-sm" onclick="closeDeleteModal()">
                    <i class="bi bi-x-circle me-2"></i>Batal
                </button>
                <button type="button" class="btn btn-lg btn-danger px-5 shadow-sm" onclick="submitDelete()">
                    <i class="bi bi-trash-fill me-2"></i>Hapus Foto
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.custom-modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.custom-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.custom-modal-content {
    position: relative;
    z-index: 2;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    max-width: 500px;
    width: 90%;
    animation: modalSlideIn 0.3s ease-out;
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
        </div>
    </div>
</div>

<script>
// Simple modal functions without Bootstrap
function showUploadModal() {
    const modal = document.getElementById('uploadPreviewModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeUploadModal() {
    const modal = document.getElementById('uploadPreviewModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

function showDeleteModal() {
    const modal = document.getElementById('deletePhotoModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    const modal = document.getElementById('deletePhotoModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    document.body.style.overflow = '';
}

function submitUpload() {
    const form = document.getElementById('profileForm');
    const photoInput = document.getElementById('profilePhotoInput');
    
    if (!photoInput.files || photoInput.files.length === 0) {
        alert('Tidak ada file yang dipilih');
        closeUploadModal();
        return;
    }
    
    // Set flag bahwa ini upload photo only
    const uploadType = document.getElementById('uploadType');
    if (uploadType) {
        uploadType.value = 'photo_only';
    }
    
    closeUploadModal();
    
    // Create FormData to ensure file is included
    const formData = new FormData(form);
    
    // Use XMLHttpRequest to submit with file
    const xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            window.location.reload();
        } else {
            alert('Upload gagal. Silakan coba lagi.');
            window.location.reload();
        }
    };
    
    xhr.onerror = function() {
        alert('Terjadi kesalahan. Silakan coba lagi.');
        window.location.reload();
    };
    
    xhr.send(formData);
}

function submitDelete() {
    closeDeleteModal();
    document.getElementById('deletePhotoForm').submit();
}

// Main initialization
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('profilePhotoInput');
    const modalPreviewImage = document.getElementById('modalPreviewImage');

    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            // Validasi ukuran (max 2MB)
            if (file.size > 2048000) {
                alert('Ukuran file terlalu besar! Maksimal 2MB');
                this.value = '';
                return;
            }
            
            // Validasi tipe file
            if (!file.type.match('image.*')) {
                alert('File harus berupa gambar!');
                this.value = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                // Update preview di modal
                if (modalPreviewImage) {
                    modalPreviewImage.src = e.target.result;
                }
                
                // Update preview utama
                const avatarInner = document.querySelector('.profile-avatar-inner');
                if (avatarInner) {
                    const defaultAvatar = document.getElementById('defaultAvatar');
                    if (defaultAvatar) defaultAvatar.remove();
                    
                    let img = document.getElementById('profilePreview');
                    if (!img) {
                        img = document.createElement('img');
                        img.id = 'profilePreview';
                        img.alt = 'Profile Photo';
                        img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                        avatarInner.appendChild(img);
                    }
                    img.src = e.target.result;
                }
                
                // Tampilkan modal
                showUploadModal();
            };
            reader.readAsDataURL(file);
        });
    }
});

// Fungsi untuk hapus foto (dipanggil dari button)
function deletePhoto() {
    showDeleteModal();
}
</script>
@endsection
