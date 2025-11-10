<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة الموظف')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        /* ---------------------- */
        /*  Navbar Active Link    */
        /* ---------------------- */
        .navbar-nav .nav-link.active {
            color: #099aa7 !important;
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 4px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ route('employee.dashboard') }}">لوحة الموظف</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#employeeNavbar"
                aria-controls="employeeNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="employeeNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('Employee.booking.index') ? 'active' : '' }}"
                           href="{{ route('Employee.booking.index') }}">الحجوزات📋</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('Employee.booking') ? 'active' : '' }}"
                           href="{{ route('Employee.booking') }}">إدارة الحجوزات 📋</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.bookings.index') ? 'active' : '' }}"
                           href="{{ route('public.bookings.index') }}">حجوزات العامة📋</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">تسجيل الخروج ⬅️</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
