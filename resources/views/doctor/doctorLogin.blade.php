<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول الدكتور</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="{{ asset('CSS/doctor-auth.css') }}" rel="stylesheet">
</head>
<body class="doc-auth-body">

    <!-- الخلفية الموجية -->
    <div class="doc-background-wave"></div>

    <div class="doc-flip-container">
        <div class="doc-flipper">

            <div class="doc-front doc-login-container">
                <div class="text-center mb-4">
                    <img src="{{ asset('image/تنزيل.png') }}" alt="Doctor" class="doc-avatar-img">
                    <h3 class="mt-3 fw-bold">مرحبا بالدكتور</h3>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('doctor.login.post') }}" method="POST">
                    @csrf

                    <div class="doc-input-group">
                        <label class="form-label fw-bold">البريد الإلكتروني</label>
                        <input type="email" name="email" placeholder="Enter Email" required>
                    </div>

                    <div class="doc-input-group">
                        <label class="form-label fw-bold">كلمة المرور</label>
                        <input type="password" name="password" placeholder="********" required>
                    </div>

                    <button type="submit" class="doc-btn">تسجيل الدخول</button>
                </form>

                <p class="text-center mt-3 doc-forgot-password">
                    نسيت كلمة المرور؟ <a href="#" class="text-primary fw-bold">استعادة</a>
                </p>
            </div>

        </div>
    </div>

</body>
</html>
