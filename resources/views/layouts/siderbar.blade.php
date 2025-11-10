<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>

<div class="d-flex">
    <div class="sidebar bg-light p-3" style="width: 250px;">
        <h4><i class="bi bi-gear-fill me-2"></i> Admin Panel</h4>
        <div class="p-3">
            <input type="text" class="form-control" placeholder="Search...">
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                    <i class="bi bi-house-door-fill"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('department.*') ? 'active' : '' }}" href="{{ route('department.index') }}">
                    <i class="bi bi-building"></i> Departments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('doctor.*') ? 'active' : '' }}" href="{{ route('Admin.doctor.index') }}">
                    <i class="bi bi-person-badge"></i> Doctors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('employee.*') ? 'active' : '' }}" href="{{ route('employee.index') }}">
                    <i class="bi bi-people"></i> Employees
                </a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}" href="{{ route('category.index') }}">
                    <i class="bi bi-tags-fill"></i> Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('medication.*') ? 'active' : '' }}" href="{{ route('medication.index') }}">
                    <i class="bi bi-capsule"></i> Medications
                </a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('Admin.lab.*') ? 'active' : '' }}" href="{{ route('Admin.lab.index') }}">
                    <i class="bi bi-hdd-stack"></i> Labs
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('Admin.Test.*') ? 'active' : '' }}" href="{{ route('Admin.Test.index') }}">
                    <i class="bi bi-clipboard-data"></i> Tests
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('Admin.Device.*') ? 'active' : '' }}" href="{{ route('Admin.Device.index') }}">
                    <i class="bi bi-hdd-stack"></i> Devices
                </a>
            </li>
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('appointment.*') ? 'active' : '' }}" href="{{ route('appointment.index') }}">
                    <i class="bi bi-calendar-check"></i> Appointments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('Admin.booking.index') ? 'active' : '' }}" href="{{ route('Admin.booking.index') }}">
                    <i class="bi bi-calendar-check-fill"></i> Bookings
                </a>
            </li>

             <li class="nav-item">
             <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-danger w-100 text-start">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </li>
        </ul>
    </div>

    <div class="main-content flex-grow-1">
        <div class="content-box p-3">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
