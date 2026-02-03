<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RasaKaltim') - Jelajah Rasa Kalimantan Timur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            transition: background-color 0.3s ease;
        }

        body:not(.home-page) .navbar {
            background-color: #27443A;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #FCC549 !important;
        }

        .navbar-brand i {
            color: #FCC549;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            margin-left: 1.5rem;
            position: relative;
            padding-bottom: 5px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 0;
            background-color: #FCC549;
            transition: width 0.3s ease-in-out;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff !important;
        }

        .card-kuliner {
            transition: transform 0.3s;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .card-kuliner:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #1a252f;
            color: #bdc3c7;
        }

        .footer-link {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            margin-bottom: 0.5rem;
        }

        .footer-link:hover {
            color: #fff;
        }

        .social-icon {
            color: #fff;
            font-size: 1.2rem;
            margin-right: 15px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark {{ request()->is('/') ? 'fixed-top' : 'sticky-top' }} py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
                RasaKaltim
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3"><a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('kuliner.*') ? 'active' : '' }}" href="{{ route('kuliner.index') }}">Kuliner</a></li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold text-white mb-3">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
                        RasaKaltim
                    </h5>
                    <p class="small mb-4">Jembatan digital untuk menikmati kekayaan kuliner Bumi Etam. Dukung UMKM lokal dengan makan enak!</p>
                </div>
                <div class="col-lg-2 offset-lg-2">
                    <h6 class="fw-bold text-white mb-3">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="footer-link">Beranda</a></li>
                        <li><a href="{{ route('kuliner.index') }}" class="footer-link">Kuliner</a></li>
                        <li><a href="{{ route('login') }}" class="footer-link">Masuk</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-bold text-white mb-3">Hubungi Kami</h6>
                    <p class="small mb-3">rasakaltim@gmail.com</p>
                    <div class="d-flex">
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a> <!-- X icon -->
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center small">
                &copy; 2026 RasaKaltim - Kuliner Khas Kaltim.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek apakah ada session 'success' dari Controller
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
        @endif

        // Cek apakah ada session 'error'
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
        });
        @endif
    </script>
    @stack('scripts')
</body>

</html>