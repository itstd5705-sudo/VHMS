<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a2d9d5a64a.js" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1f2937;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 25px;
            transition: 0.3s;
        }

        .sidebar h4 {
            font-size: 22px;
            margin-bottom: 25px;
        }

        .sidebar a {
            color: #d1d5db;
            padding: 14px 20px;
            display: block;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #374151;
            color: white;
        }

        /* Main Area */
        .content-area {
            margin-left: 260px;
            padding: 30px;
            width: calc(100% - 260px);
            transition: 0.3s;
        }

        /* Sidebar Toggle */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 270px;
            font-size: 26px;
            cursor: pointer;
            z-index: 1000;
            color: #1f2937;
            transition: 0.3s;
        }

        .collapsed-sidebar {
            width: 70px !important;
        }

        .collapsed-content {
            margin-left: 70px !important;
            width: calc(100% - 70px) !important;
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <h4 class="text-center">Dashboard</h4>

    <a href="{{ route('home') }}"><i class="fas fa-home me-2"></i> Home</a>
    <a href="#"><i class="fas fa-cog me-2"></i> Settings</a>
</div>

<!-- Toggle Button -->
<div class="toggle-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</div>

<!-- Main Content -->
<div class="content-area" id="content-area">
    @yield('content')
</div>

<!-- Scripts -->
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('collapsed-sidebar');
        document.getElementById('content-area').classList.toggle('collapsed-content');
    }
</script>

@yield('scripts')

</body>
</html>
