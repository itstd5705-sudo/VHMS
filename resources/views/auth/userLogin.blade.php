<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة تسجيل الدخول وإنشاء الحساب</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-body">
    <div class="background-wave"></div>

    <div class="flip-container" id="flipContainer">
        <div class="flipper">

            <!-- نموذج تسجيل الدخول -->
            <div class="front">
                <div class="login-container">
                    <div class="avatar-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>

                    <form action="{{ route('user.login.form') }}" method="POST">
                        @csrf
                        <h1>تسجيل الدخول</h1>

                        <div class="social-container">
                            <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-google"></i></a>
                        </div>
                        <span>أو استخدم حسابك</span>

                        <div class="input-group">
                            <input type="text" name="userName" placeholder="اسم المستخدم" required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="كلمة المرور" required>
                        </div>

                        @if(session('error'))
                            <p style="color:red">{{ session('error') }}</p>
                        @endif

                        <a href="#" class="forgot-password">هل نسيت كلمة المرور؟</a>

                        <button type="submit">دخول</button>
                        <button type="button" class="switch-btn" id="signUpBtn">إنشاء حساب</button>
                    </form>
                </div>
            </div>

            <!-- نموذج إنشاء حساب -->
            <div class="back">
                <div class="login-container">
                    <div class="avatar-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <h1>إنشاء حساب</h1>

                        <div class="input-group">
                            <input type="text" name="userName" placeholder="اسم المستخدم" required>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="كلمة المرور" required>
                        </div>
                        <div class="input-group">
                            <input type="text" name="phone" placeholder="رقم الهاتف" required>
                        </div>
                          <!-- اختيار الجنس -->
                        <div class="input-group">
                            <select name="gender" required>
                            <option value="">اختر الجنس</option>
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <select name="yearOfBirth" required>
                            <option value="">اختر سنة الميلاد</option>
                            </select>
                        </div>

                        @if(session('success'))
                            <p style="color:green">{{ session('success') }}</p>
                        @endif

                        <button type="submit">تسجيل</button>
                        <button type="button" class="switch-btn" id="signInBtn">لدي حساب بالفعل (دخول)</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        const flipContainer = document.getElementById('flipContainer');
        const signUpBtn = document.getElementById('signUpBtn');
        const signInBtn = document.getElementById('signInBtn');

        // قلب الصفحة لإظهار نموذج التسجيل
        signUpBtn.addEventListener('click', () => {
            flipContainer.classList.add('flipped');
        });

        // قلب الصفحة للعودة لنموذج تسجيل الدخول
        signInBtn.addEventListener('click', () => {
            flipContainer.classList.remove('flipped');
        });
    </script>

    <script>
    const selectYear = document.querySelector('select[name="yearOfBirth"]');
    const currentYear = new Date().getFullYear();
    for(let year = currentYear; year >= 1600; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        selectYear.appendChild(option);
    }
    </script>
</body>
</html>
