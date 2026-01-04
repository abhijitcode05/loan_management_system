<!DOCTYPE html>
<html>
<head>
    <title>Loan Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Load Tailwind-built CSS and app JS via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { min-height: 100vh; }
        .sidebar { min-width: 220px; max-width: 220px; background-color: #343a40; color: white; min-height: 100vh; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 15px; }
        .sidebar a:hover { background-color: #495057; }
        .content { margin-left: 220px; padding: 20px; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar position-fixed">
        <h4 class="text-center mt-3">Dashboard</h4>
        <hr class="bg-light">
        <a href="{{ route('loans.index') }}">Loans</a>
        <a href="{{ route('customers.index') }}">Customers</a>
        <a href="#">Reports</a>
    </div>

    <!-- Main content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container-fluid">
                <span class="navbar-brand">Loan Management System</span>
                <div class="d-flex">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm me-2">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Page Content --}}
        @hasSection('content')
            @yield('content')
        @else
            {{ $slot }}
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
