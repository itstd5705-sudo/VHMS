<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Venice Hospital</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/aboute.css') }}">
<link rel="stylesheet" href="{{ asset('css/Service.css') }}">
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<link rel="stylesheet" href="{{ asset('css/public.css') }}">
<link rel="stylesheet" href="{{ asset('css/lab.css') }}">
<link rel="stylesheet" href="{{ asset('css/pharmacy.css') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<header class="medinest-header sticky-top">
<nav class="navbar navbar-expand-lg navbar-light bg-white container">
    <a class="navbar-brand medinest-logo ms-auto" href="#">Venice Hospital</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" {{ request()->routeIs('services') ? 'active' : '' }}href="{{ route('services') }}">Services</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('departments.index') ? 'active' : '' }}" href="#">Department</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('analyses.index') ? 'active' : '' }}" href="{{ route('analyses.index') }}">Lab Tests</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('pharmacy.index') ? 'active' : '' }}" href="{{ route('pharmacy.index') }}">Pharmacy</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
            </li>
        </ul>

<ul class="navbar-nav ms-auto align-items-center">

    {{-- إذا المستخدم غير مسجل دخول --}}
    @guest('web')
        <li class="nav-item">
            <a href="{{ route('user.login.form') }}" class="btn btn-outline-primary btn-sm me-2">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('register.form') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-person-plus"></i> Create Account
            </a>
        </li>
    @endguest

    {{-- إذا المستخدم مسجل دخول --}}
    @auth('web')

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </li>
    @endauth

</ul>


<div class="d-flex align-items-center">
    <button class="btn btn-sm btn-outline-secondary me-2" onclick="changeLanguage('en')">EN</button>
    <button class="btn btn-sm btn-outline-secondary me-3" onclick="changeLanguage('ar')">AR</button>
</div>
</nav>
</header>
@yield('content')

<footer class="medinest-footer">
<div class="container py-5">
<div class="row g-5">
<div class="col-lg-4 col-md-6 medinest-contact-info">
<h4 class="medinest-footer-logo mb-4">Hosptial</h4>
<p>A108 Adam Street</p>
<p>New York, NY 535022</p>
<p class="mt-3"><strong>Phone:</strong> +1 5589 55488 55</p>
<p><strong>Email:</strong> <span>[email protected]</span></p>
<div class="medinest-social-links mt-3">
<a href="#" class="medinest-social-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16"><path d="M5.026 15c-.06.012-.12-.008-.173-.046a.5.5 0 0 1-.225-.333V4.3a.5.5 0 0 1 .158-.383.5.5 0 0 1 .45-.116l9 3.5a.5.5 0 0 1 .198.539L13.8 15.3c-.012.06-.03.118-.052.172a.5.5 0 0 1-.365.263L5.026 15z"/></svg></a>
<a href="#" class="medinest-social-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"><path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625H4.881V8.05h1.869V6.425c0-1.851 1.13-2.848 2.768-2.848.79 0 1.637.142 1.637.142v1.8H9.72c-.927 0-1.21.576-1.21 1.17v1.432h2.008l-.32 2.075H9.418V16c3.824-.604 6.75-3.934 6.75-7.951z"/></svg></a>
<a href="#" class="medinest-social-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16"><path d="M8 0C3.58 0 0 3.58 0 8c0 4.42 3.58 8 8 8s8-3.58 8-8c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/><path d="M12 4.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6zm-4 3a4 4 0 1 1 8 0 4 4 0 0 1-8 0z"/></svg></a>
<a href="#" class="medinest-social-link"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16"><path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.195 12.378H1.815V6.752h2.38v7.272zm-1.19-8.498a1.2 1.2 0 1 1 0-2.4 1.2 1.2 0 0 1 0 2.4zm10.59 8.498h-2.38V9.664c0-.79-.014-1.808-1.1-1.808-1.1 0-1.272.859-1.272 1.75V13.52h-2.38V6.752h2.27V7.81h.03c.316-.6 1.092-1.23 2.247-1.23 2.404 0 2.846 1.583 2.846 3.63V13.52z"/></svg></a>
</div>
</div>
<div class="col-lg-2 col-md-6">
<h4 class="medinest-footer-heading mb-4">Useful Links</h4>
<ul class="medinest-footer-links list-unstyled">
<li><a href="#">Home</a></li>
<li><a href="#">About us</a></li>
<li><a href="#">Services</a></li>
<li><a href="#">Terms of service</a></li>
<li><a href="#">Privacy policy</a></li>
</ul>
</div>
<div class="col-lg-2 col-md-6">
<h4 class="medinest-footer-heading mb-4">Our Services</h4>
<ul class="medinest-footer-links list-unstyled">
<li><a href="#">Web Design</a></li>
<li><a href="#">Web Development</a></li>
<li><a href="#">Product Management</a></li>
<li><a href="#">Marketing</a></li>
<li><a href="#">Graphic Design</a></li>
</ul>
</div>
<div class="col-lg-4 col-md-6">
<h4 class="medinest-footer-heading mb-4">Hit solidastp</h4>
<div class="row">
<div class="col-6">
<ul class="medinest-footer-links list-unstyled">
<li><a href="#">Nobilis illum</a></li>
<li><a href="#">Ipsum</a></li>
<li><a href="#">Laudantiumdoloum</a></li>
<li><a href="#">Divera</a></li>
</ul>
</div>
<div class="col-6">
<ul class="medinest-footer-links list-unstyled">
<li><a href="#">Molestiae accusamus are</a></li>
<li><a href="#">Excepturi dignissimos</a></li>
<li><a href="#">Suscipe distinctio</a></li>
<li><a href="#">Dilecta</a></li>
<li><a href="#">Fledo</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="medinest-copyright py-4">
<div class="container text-center">
<p class="mb-0">&copy; Copyright <strong>MediNest</strong>. All Rights Reserved</p>
<p class="mb-0">Designed by <a href="http://bootstrapmade.com/" target="_blank">BootstrapMade</a></p>
</div>
</div>
</footer>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>
<script>
function showLoginAlert()
{
  alert("يجب عليك تسجيل الدخول للموقع أولاً.");
}
</script>
<script src="{{asset('JS/main.js')}}">
</script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

</body>
</html>


