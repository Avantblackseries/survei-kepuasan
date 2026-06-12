<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Survei Kepuasan Pelanggan')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f0f4f8; }
        .navbar { background: linear-gradient(135deg, #1565C0, #1976D2); }
        .card { border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.08); border-radius: 12px; }
        .sidebar { background: linear-gradient(180deg, #1565C0, #0D47A1); min-height: 100vh; }
        .sidebar a { color: rgba(255,255,255,0.8); text-decoration: none; padding: 10px 15px; display: block; border-radius: 8px; margin: 2px 0; }
        .sidebar a:hover { background: rgba(255,255,255,0.15); color: white; }
        .sidebar a.active { background: rgba(255,255,255,0.2); color: white; }
        .stat-card { border-radius: 12px; color: white; padding: 20px; }
        .rating-star { color: #FFC107; font-size: 1.2rem; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-chart-bar me-2"></i>SurveiKu
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <span class="text-white">
                <i class="fas fa-user-circle me-1"></i>
                {{ Auth::user()->name }}
                <span class="badge bg-{{ Auth::user()->isAdmin() ? 'warning' : 'success' }} ms-1">
                    {{ Auth::user()->isAdmin() ? 'Admin' : 'User' }}
                </span>
            </span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                </button>
            </form>
        </div>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            @if(Auth::user()->isAdmin())
            <p class="text-white-50 small mb-2 mt-2">ADMIN MENU</p>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
            </a>
            <a href="{{ route('surveys.index') }}" class="{{ request()->routeIs('surveys.*') ? 'active' : '' }}">
                <i class="fas fa-clipboard-list me-2"></i>Kelola Survei
            </a>
            @else
            <p class="text-white-50 small mb-2 mt-2">USER MENU</p>
            <a href="{{ route('user.dashboard') }}" class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i>Dashboard
            </a>
            <a href="{{ route('my.responses') }}" class="{{ request()->routeIs('my.responses') ? 'active' : '' }}">
                <i class="fas fa-history me-2"></i>Riwayat Survei
            </a>
            @endif
        </div>
        <div class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>