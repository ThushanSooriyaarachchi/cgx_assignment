<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Image Manager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            background-size: cover;
        }
        
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
        }
        
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        .sidebar .nav-link.active {
            color: #fff;
            font-weight: bold;
        }
        
        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        
        .thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }
        
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        .border-left-primary {
            border-left: 0.25rem solid #4e73df !important;
        }
        
        .border-left-success {
            border-left: 0.25rem solid #1cc88a !important;
        }
        
        .border-left-warning {
            border-left: 0.25rem solid #f6c23e !important;
        }
        
        .border-left-danger {
            border-left: 0.25rem solid #e74a3b !important;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        @auth
            <div class="sidebar col-md-3 col-lg-2 d-md-block collapse">
                <div class="position-sticky">
                    <div class="d-flex align-items-center justify-content-center py-4">
                        <h4 class="text-white m-0">Image Admin</h4>
                    </div>
                    <hr class="bg-white">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-fw fa-tachometer-alt me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.images.index') ? 'active' : '' }}" href="{{ route('admin.images.index') }}">
                                <i class="fas fa-fw fa-images me-2"></i>
                                All Images
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.images.pending') ? 'active' : '' }}" href="{{ route('admin.images.pending') }}">
                                <i class="fas fa-fw fa-clock me-2"></i>
                                Pending Images
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.images.approved') ? 'active' : '' }}" href="{{ route('admin.images.approved') }}">
                                <i class="fas fa-fw fa-check-circle me-2"></i>
                                Approved Images
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.images.rejected') ? 'active' : '' }}" href="{{ route('admin.images.rejected') }}">
                                <i class="fas fa-fw fa-ban me-2"></i>
                                Rejected Images
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="{{ route('admin.logout') }}">
                                <i class="fas fa-fw fa-sign-out-alt me-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth

        <!-- Main Content -->
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @auth
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button class="btn d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="ms-auto">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <span class="text-gray-600">Welcome, {{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </nav>
            @endauth

            <!-- Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>