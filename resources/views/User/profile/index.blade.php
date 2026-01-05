@extends('layouts.app')

@section('content')
<section class="user-dashboard-wrapper">
    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <aside class="col-lg-3 user-dashboard-sidebar">
                <div class="sidebar-top text-center">
                    <img src="{{ asset('image/تنزيل.png') }}" alt="User Avatar" class="avatar-img mb-2">
                    <h5>{{ Auth::user()->userName }}</h5>
                </div>
                <ul class="nav flex-column mt-4">
                    <li class="nav-item">
                        <a href="{{ route('profile.edit') }}" class="nav-link active">
                            <i class="bi bi-house-door-fill me-2"></i> لوحة التحكم
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" id="editProfileBtn">
                            <i class="bi bi-pencil-square me-2"></i> تعديل الملف الشخصي
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.booking.myBookings') }}" class="nav-link">
                            <i class="bi bi-calendar-check me-2"></i> مواعيدي
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('user.myOrders') }}" class="nav-link">
                            <i class="bi bi-bell me-2"></i> طلباتي
                        </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-danger p-0">
                                <i class="bi bi-box-arrow-right me-2"></i> تسجيل الخروج
                            </button>
                        </form>
                    </li>
                </ul>
            </aside>

            <!-- Main Content -->
            <main class="col-lg-9 main-content p-4">
                <h2 class="mb-4">ملف الشخصي</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Profile Info -->
                <div class="user-profile-card p-4 mb-4" id="profileInfo">
                    <div class="info-row"><h5>الاسم الكامل:</h5> <span>{{ Auth::user()->userName }}</span></div>
                    <div class="info-row"><h5>رقم الهاتف:</h5> <span>{{ Auth::user()->phone }}</span></div>
                    <div class="info-row"><h5>سنة الميلاد:</h5> <span>{{ Auth::user()->yearOfBirth }}</span></div>
                    <div class="info-row"><h5>رقم المريض:</h5> <span>{{ $user->patient_code }}</span></div>

                    <!-- Wallet Section -->
                    <div class="user-wallet-section mt-3">
                        <div class="user-wallet-summary" onclick="toggleWallet()">
                            <i class="bi bi-wallet2"></i>
                            <span>رصيدك الحالي: <strong>{{ Auth::user()->balance }} د.ل</strong></span>
                        </div>
                        <div class="user-wallet-collapse mt-2" style="display:none;">
                            <form action="{{ route('wallet.charge') }}" method="POST">
                                @csrf
                                <input type="text" name="card_number" placeholder="أدخل رقم الكرت" required class="form-control mb-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-credit-card-2-front-fill me-2"></i> شحن الرصيد
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Profile Edit Form -->
                <div id="profileFormWrapper" style="display:none;">
                    <div class="mb-4 text-start">
                        <button type="button" class="btn btn-secondary" id="backToProfile">
                            <i class="bi bi-arrow-left-circle me-2"></i> رجوع
                        </button>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="user-profile-form">
                        @csrf
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">الاسم الكامل</label>
                                <input type="text" name="userName" class="form-control" value="{{ Auth::user()->userName }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الجنس</label>
                                <select name="gender" class="form-control" required>
                                    <option value="ذكر" {{ Auth::user()->gender=='ذكر' ? 'selected' : '' }}>ذكر</option>
                                    <option value="أنثى" {{ Auth::user()->gender=='أنثى' ? 'selected' : '' }}>أنثى</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">رقم الهاتف</label>
                                <input type="tel" name="phone" class="form-control" value="{{ Auth::user()->phone }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">سنة الميلاد</label>
                                <input type="number" name="yearOfBirth" class="form-control" value="{{ Auth::user()->yearOfBirth }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">كلمة المرور الجديدة (اختياري)</label>
                                <div class="user-input-group-password">
                                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="اتركها فارغة إذا لم ترغب بالتغيير">
                                    <button type="button" class="user-password-toggle" id="togglePassword">إظهار</button>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">فصيلة الدم</label>
                                <input type="text" name="blood_type" class="form-control" value="{{ Auth::user()->blood_type }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الأمراض المزمنة</label>
                                <textarea name="chronic_diseases" class="form-control">{{ Auth::user()->chronic_diseases }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">الأدوية الحالية</label>
                                <textarea name="current_medications" class="form-control">{{ Auth::user()->current_medications }}</textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-update mt-3">تحديث الملف الشخصي</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</section>

<script>
// Toggle Wallet Form
function toggleWallet() {
    const walletCollapse = document.querySelector('.user-wallet-collapse');
    walletCollapse.style.display = walletCollapse.style.display === 'none' ? 'block' : 'none';
}

// Toggle Profile Info / Edit Form
document.getElementById('editProfileBtn').addEventListener('click', function(e){
    e.preventDefault();
    document.getElementById('profileInfo').style.display = 'none';
    document.getElementById('profileFormWrapper').style.display = 'block';
});

// زر الرجوع داخل الفورم
document.getElementById('backToProfile').addEventListener('click', function(){
    document.getElementById('profileFormWrapper').style.display = 'none';
    document.getElementById('profileInfo').style.display = 'block';
});

// Show / Hide Password
document.getElementById('togglePassword').addEventListener('click', function(){
    const passwordInput = document.getElementById('passwordInput');
    if(passwordInput.type === 'password'){
        passwordInput.type = 'text';
        this.textContent = 'إخفاء';
    } else {
        passwordInput.type = 'password';
        this.textContent = 'إظهار';
    }
});
</script>
@endsection
