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
                    <img src="{{ asset('assets/images/logoKaraStock.png') }}" alt="KaraStock Logo" style="width: 45px; height: 45px; object-fit: contain;" class="me-2">
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

                <!-- Spacer untuk push ke bawah -->
                <div style="flex: 1;"></div>

                <!-- Divider -->
                <div style="border-top: 2px solid #e2e8f0; margin: 0.5rem 0.75rem;"></div>

                <!-- Profile Dropdown -->
                <div class="dropdown dropup">
                    <a class="list-group-item list-group-item-action dropdown-toggle {{ Request::is('profile') ? 'active' : '' }}" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2"></i>
                        <span class="menu-text">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end w-100" aria-labelledby="profileDropdown" style="margin-bottom: 0.5rem;">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="bi bi-person-badge me-2 text-primary"></i>
                                <span>Profil Saya</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                @csrf
                                <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    <span>Logout</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div id="page-content-wrapper">

            <!-- Top Navbar with Burger Menu -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top shadow-sm">
                <div class="container-fluid">
                    <!-- Burger Menu Button (Works on all screen sizes) -->
                    <button class="navbar-toggler border-0 shadow-none me-2" id="sidebarToggle" type="button" title="Toggle Menu">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    
                    <!-- Page Title/Breadcrumb - Show on all screen sizes -->
                    <div class="navbar-brand mb-0 h1 ms-2">
                        <img src="{{ asset('assets/images/logoKaraStock.png') }}" alt="KaraStock" style="width: 32px; height: 32px; object-fit: contain;" class="me-2">
                        <span class="fw-semibold">KaraStock</span>
                    </div>

                    <!-- Right Side Actions -->
                    <div class="ms-auto d-flex align-items-center gap-2">
                        <!-- Tombol bantuan dihapus -->
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
                &copy; {{ date('Y') }} KaraStock · <span style="color: var(--color-primary);">Decision Support System</span>
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
            
            // Close sidebar when clicking menu item on mobile
            const menuItems = document.querySelectorAll('#sidebar-wrapper .list-group-item');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    if (window.innerWidth <= 768) {
                        closeSidebar();
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