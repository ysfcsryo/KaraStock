<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <title>KaraStock</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Prediksi Stok Penjualan berbasis Decision Tree untuk Karawo">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">

            <div class="sidebar-header">
                <div class="brand-container">
                    <img src="{{ asset('assets/images/logoKaraStock.png') }}" alt="KaraStock Logo" class="me-2 logo-sidebar">
                    <div class="d-flex flex-column">
                        <span class="brand-text fw-bold fs-5">KaraStock</span>
                        <span class="small text-white-50 brand-subtitle">Decision Tree Stock Advisor</span>
                    </div>
                </div>
            </div>

            <div class="list-group list-group-flush mt-2">
                <a class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                    <i class="bi bi-cloud-upload me-2"></i>
                    <span class="menu-text">Upload & Analisa</span>
                </a>

                <a class="list-group-item list-group-item-action {{ Request::is('hasil-analisa') ? 'active' : '' }}" href="{{ url('/hasil-analisa') }}">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    <span class="menu-text">Hasil Analisa</span>
                </a>

                <a class="list-group-item list-group-item-action {{ Request::is('riwayat') ? 'active' : '' }}" href="{{ url('/riwayat') }}">
                    <i class="bi bi-clock-history me-2"></i>
                    <span class="menu-text">Riwayat Analisa</span>
                </a>

                @if(Auth::check() && Auth::user()->role === 'super_admin')
                <a class="list-group-item list-group-item-action {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill me-2"></i>
                    <span class="menu-text">Kelola User</span>
                </a>
                @endif


            </div>
        </div>

        <!-- Main Content -->
        <div id="page-content-wrapper">

            <!-- Top Navbar with Burger Menu -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
                <div class="container-fluid">
                    <!-- Burger Menu Button (Works on all screen sizes) -->
                    <button class="navbar-toggler border-0 shadow-none me-2" id="sidebarToggle" type="button" title="Toggle Menu">
                        <i class="bi bi-list fs-4 text-white"></i>
                    </button>
                    
                    <!-- Page Title/Breadcrumb - Show on all screen sizes -->
                    <div class="navbar-brand mb-0 h1 ms-2">
                        <img src="{{ asset('assets/images/logoKaraStock.png') }}" alt="KaraStock" class="me-2 logo-navbar">
                        <span class="fw-semibold">KaraStock</span>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="ms-auto d-flex align-items-center gap-2">
                        <!-- Profile Dropdown -->
                        <div class="dropdown profile-dropdown">
                            <button class="nav-profile-trigger d-flex align-items-center gap-2 text-decoration-none border-0 bg-transparent profile-dropdown-trigger" type="button" id="navProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-info text-end d-none d-md-block">
                                    <div class="nav-profile-name">{{ Auth::user()->name }}</div>
                                    <div class="nav-profile-role">{{ Auth::user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</div>
                                </div>
                                <div class="nav-profile-avatar">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ asset(Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}">
                                    @else
                                        <i class="bi bi-person-circle"></i>
                                    @endif
                                </div>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end profile-menu shadow-lg profile-dropdown-menu" aria-labelledby="navProfileDropdown">
                                <!-- Profile Header with Background -->
                                <li class="dropdown-header p-0 border-0">
                                    <div class="profile-menu-header">
                                        <div class="d-flex align-items-center p-3">
                                            <div class="profile-avatar-large me-3">
                                                @if(Auth::user()->profile_photo)
                                                    <img src="{{ asset(Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="profile-avatar-img">
                                                @else
                                                    <i class="bi bi-person-circle"></i>
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="profile-menu-name">{{ Auth::user()->name }}</div>
                                                <div class="profile-menu-email">{{ Auth::user()->email }}</div>
                                                <div class="profile-menu-badge mt-1">
                                                    <span class="badge-role">{{ Auth::user()->role === 'super_admin' ? 'Super Admin' : 'Admin' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li class="px-2 py-1">
                                    <a class="dropdown-item profile-menu-item" href="{{ route('profile') }}">
                                        <div class="profile-menu-icon">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                        <span>Edit Profil</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li class="px-2 py-1">
                                    <form action="{{ route('logout') }}" method="POST" id="logoutFormNav">
                                        @csrf
                                        <a class="dropdown-item profile-menu-item profile-menu-logout" href="#" onclick="event.preventDefault(); document.getElementById('logoutFormNav').submit();">
                                            <div class="profile-menu-icon">
                                                <i class="bi bi-box-arrow-right"></i>
                                            </div>
                                            <span>Logout</span>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="container-fluid px-4 pb-4 pt-4">
                @if(session('success') || session('error'))
                <div class="mb-3">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                @endif
                @yield('content')
            </div>

            <footer class="text-center text-muted small pb-3 mt-2">
                &copy; {{ date('Y') }} KaraStock · <span class="footer-primary-text">Decision Support System</span>
            </footer>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.querySelector('#sidebarToggle');
            const sidebarOverlay = document.querySelector('#sidebar-overlay');
            
            // Toggle sidebar function
            function toggleSidebar() {
                const isToggled = document.body.classList.toggle('sb-sidenav-toggled');
                
                // Only show overlay on mobile
                if (window.innerWidth <= 768) {
                    if (isToggled) {
                        sidebarOverlay.classList.add('active');
                    } else {
                        sidebarOverlay.classList.remove('active');
                    }
                } else {
                    // Always hide overlay on desktop
                    sidebarOverlay.classList.remove('active');
                }
            }
            
            // Close sidebar function
            function closeSidebar() {
                document.body.classList.remove('sb-sidenav-toggled');
                sidebarOverlay.classList.remove('active');
            }
            
            // Burger button click
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    event.stopPropagation();
                    toggleSidebar();
                });
            }
            
            // Overlay click (close sidebar on mobile)
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    closeSidebar();
                });
            }
            
            // Handle profile dropdown specifically
            const profileDropdown = document.querySelector('#profileDropdown');
            if (profileDropdown) {
                profileDropdown.addEventListener('click', (e) => {
                    // Jika sidebar tertutup (pada desktop), buka dulu sidebar dan cegah dropdown
                    if (window.innerWidth > 768 && document.body.classList.contains('sb-sidenav-toggled')) {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleSidebar(); // Buka sidebar
                        return false;
                    }
                });
            }
            
            // Handle menu item clicks
            const menuItems = document.querySelectorAll('#sidebar-wrapper .list-group-item:not(#profileDropdown)');
            menuItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    // Jika sidebar tertutup (pada desktop), buka dulu sidebar
                    if (window.innerWidth > 768 && document.body.classList.contains('sb-sidenav-toggled')) {
                        e.preventDefault(); // Cegah navigasi
                        toggleSidebar(); // Buka sidebar
                        return false;
                    }
                    
                    // Pada mobile, tutup sidebar setelah klik
                    if (window.innerWidth <= 768) {
                        // Biarkan navigasi terjadi, tapi tutup sidebar
                        setTimeout(() => closeSidebar(), 100);
                    }
                });
            });
            
            // Handle window resize
            window.addEventListener('resize', () => {
                if (window.innerWidth > 768) {
                    sidebarOverlay.classList.remove('active');
                }
            });

            // Add smooth scroll behavior
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#') {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({ behavior: 'smooth' });
                        }
                    }
                });
            });
        });
    </script>

    @stack('scripts')

</body>

</html>