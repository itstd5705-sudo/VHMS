<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تسجيل دخول المستخدم</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-card">

    <h3 class="auth-title">👤 تسجيل الدخول</h3>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('user.login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">اسم المستخدم</label>
            <input type="text" name="userName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-secondary auth-btn">تسجيل الدخول</button>
    </form>

    <div class="auth-link">
        <small>ليس لديك حساب؟ <a href="{{ route('register.form') }}">إنشاء حساب</a></small>
    </div>

</div>

</body>
</html>
