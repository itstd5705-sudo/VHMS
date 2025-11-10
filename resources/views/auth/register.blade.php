<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إنشاء حساب جديد</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-card">

    <h3 class="auth-title">📝 إنشاء حساب</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">اسم المستخدم</label>
            <input type="text" name="userName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الجنس</label>
            <select name="gender" class="form-select" required>
                <option value="">اختر</option>
                <option value="ذكر">ذكر</option>
                <option value="أنثى">أنثى</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">سنة الميلاد</label>
            <input type="number" name="yearOfBirth" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success auth-btn">إنشاء الحساب</button>
    </form>

    <div class="auth-link">
        <small>لديك حساب؟ <a href="{{ route('user.login.form') }}">تسجيل الدخول</a></small>
    </div>

</div>

</body>
</html>
