<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <title>Sistem Karawo - Decision Tree</title>
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

    <div class="d-flex" id="wrapper">

        <div id="sidebar-wrapper">

            <div class="sidebar-header">

                <button id="sidebarToggle" title="Buka/Tutup Menu">
                    <i class="bi bi-list"></i>
                </button>

                <div class="brand-container">
                    <i class="bi bi-diagram-3 fs-4 me-2" style="color: var(--color-accent);"></i>
                    <div class="d-flex flex-column">
                        <span class="brand-text fw-bold fs-5">KaraStock</span>
                        <span class="small text-white-50">Decision Tree Stock Advisor</span>
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
            </div>
        </div>

        <div id="page-content-wrapper">

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
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>

    @stack('scripts')

</body>

</html>