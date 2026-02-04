<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - RasaKaltim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            z-index: 100;
        }

        .sidebar-sticky {
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Nav Link Styling */
        .nav-link {
            color: #555;
            padding: 12px 20px;
            margin-bottom: 8px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease-in-out;
            display: flex;
            align-items: center;
        }

        .nav-link:hover {
            background-color: #f0f0f0;
            color: #333;
            transform: translateX(3px);
        }

        .nav-link.active {
            background-color: #6ee7b7;
            color: #064e3b !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .nav-link i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
            font-size: 1.1em;
        }

        /* Brand Styling */
        .sidebar-brand {
            padding: 0 20px 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-brand-text {
            font-size: 1.25rem;
            font-weight: 800;
            color: #27443A;
        }

        /* Logout Button Area */
        .sidebar-logout {
            margin-top: auto;
            padding: 10px;
            border-top: 1px solid #eee;
        }

        .btn-logout {
            color: #dc3545;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            transition: 0.2s;
            border-radius: 8px;
        }

        .btn-logout:hover {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        /* Mobile Header */
        .mobile-header {
            display: none;
            background: white;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 767.98px) {
            .mobile-header {
                display: flex;
            }

            .sidebar {
                min-height: auto;
                box-shadow: none;
            }

            .sidebar-sticky {
                height: auto;
                position: static;
                padding-top: 10px;
            }

            #sidebarMenu.collapse:not(.show) {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Mobile Header (Visible on Mobile Only) -->
    <div class="mobile-header d-md-none sticky-top">
        <a class="fw-bold text-decoration-none text-dark d-flex align-items-center" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
            <span>Admin Panel</span>
        </a>
        <button class="navbar-toggler border-0 bg-transparent p-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars fa-lg text-dark"></i>
        </button>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse">
                <div class="sidebar-sticky">
                    <!-- Brand (Desktop) -->
                    <div class="sidebar-brand d-none d-md-block">
                        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" height="40" class="me-2">
                            <span class="sidebar-brand-text">Admin Panel</span>
                        </a>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="px-2">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-th-large"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.makanan.*') ? 'active' : '' }}" href="{{ route('admin.makanan.index') }}">
                                    <i class="fas fa-utensils"></i> Data Kuliner
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.rumah-makan.*') ? 'active' : '' }}" href="{{ route('admin.rumah-makan.index') }}">
                                    <i class="fas fa-store"></i> Data RM
                                </a>
                            </li>
                            <!-- Logout Button (Pushed to bottom) -->
                            <div class="sidebar-logout">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-logout w-100 border-0 bg-transparent text-start">
                                        <i class="fas fa-sign-out-alt me-3"></i> Log Out
                                    </button>
                                </form>
                            </div>
                        </ul>
                    </div>


                </div>
            </nav>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 min-vh-100">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert Logic (Sama seperti sebelumnya)
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
        @endif
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
        });
        @endif
    </script>
</body>