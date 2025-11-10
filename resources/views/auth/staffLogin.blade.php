<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تسجيل دخول المسؤولين</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-card">

    <h3 class="auth-title">🔐 تسجيل دخول الموظفين</h3>

    @if(session('error'))
      <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('staff.login') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">البريد الإلكتروني</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">كلمة المرور</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">الدور</label>
        <select name="role" class="form-select" required>
          <option value="">اختر نوع الحساب</option>
          <option value="admin">مدير</option>
          <option value="doctor">طبيب</option>
          <option value="employee">موظف</option>
        </select>
      </div>

      <button type="submit" class="btn btn-dark auth-btn">تسجيل الدخول</button>
    </form>

</div>

</body>
</html>
