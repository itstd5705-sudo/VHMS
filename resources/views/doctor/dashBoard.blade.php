<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Doctor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light" style="font-family: 'Cairo', sans-serif;">

<div class="container py-5">

    {{-- بطاقة معلومات الدكتور --}}
    <div class="card mb-4 p-4 shadow-lg rounded-4 text-white" style="background-color: #148994;">
        <div class="row align-items-center">
            <div class="col-md-3 text-center mb-3 mb-md-0">
                <img src="{{ asset('image/datek2.jpg.webp') }}"
                     alt="Doctor Image"
                     class="rounded-circle border border-2"
                     width="140" height="140" style="object-fit: cover;">
            </div>
            <div class="col-md-9">
                <h2 class="fw-bold mb-3">{{ $doctor->fullName }}</h2>
                <div class="row">
                    <div class="col-6 mb-2">
                        <i class="bi bi-book me-1"></i>
                        <span class="fw-bold">التخصص:</span> {{ $doctor->specialty }}
                    </div>
                    <div class="col-6 mb-2">
                        <i class="bi bi-building me-1"></i>
                        <span class="fw-bold">القسم:</span> {{ $doctor->Department->name ?? 'غير محدد' }}
                    </div>
                    <div class="col-6 mb-2">
                        <i class="bi bi-envelope me-1"></i>
                        <span class="fw-bold">البريد الألكتروني:</span> {{ $doctor->email }}
                    </div>
                    <div class="col-6 mb-2">
                        <i class="bi bi-telephone me-1"></i>
                        <span class="fw-bold">الهاتف:</span> {{ $doctor->phone }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- الإحصائيات --}}
    <div class="row mb-4 text-center">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card p-4 shadow-sm rounded-4 text-white" style="background-color: #148994;">
                <h6 class="fw-bold">عدد جميع الحجوزات</h6>
                <span class="badge bg-light text-dark fs-5 mt-2">{{ $appointmentsCount }}</span>
            </div>
        </div>

        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card p-4 shadow-sm rounded-4 bg-success text-white">
                <h6 class="fw-bold">إجمالي أرباح اليوم (60%)</h6>
                <span class="badge bg-light text-dark fs-5 mt-2">{{ number_format($todayTotal, 2) }} LYD</span>
            </div>
        </div>
    </div>

    {{-- فلترة حسب التاريخ --}}
    <div class="card p-4 shadow-sm rounded-4 mb-4">
        <h5 class="mb-3 fw-bold">فلترة حسب التاريخ</h5>
        <form method="GET" action="{{ route('doctor.dashboard') }}" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label for="filter_date" class="form-label fw-bold">اختر اليوم</label>
                <input type="date" id="filter_date" name="filter_date" class="form-control"
                       value="{{ request('filter_date') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn w-100 rounded-4 py-2 text-white" style="background-color: #148994;">
                    عرض
                </button>
            </div>
            @if(isset($filteredTotal))
                <div class="col-md-6">
                    <div class="alert alert-success mb-0 py-2">
                        إجمالي أرباح اليوم المحدد (60%):
                        <strong>{{ number_format($filteredTotal, 2) }} LYD</strong>
                    </div>
                </div>
            @endif
        </form>
    </div>
    {{-- جدول المواعيد --}}
    <div class="card p-4 shadow-sm rounded-4 mb-4">
        <h5 class="mb-3 fw-bold">حجوزاتك {{ request('filter_date') ? 'لليوم المحدد' : 'اليوم' }}</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>اسم المريض</th>
                        <th>اليوم</th>
                        <th>من الساعة</th>
                        <th>الى الساعة</th>
                        <th>السعر</th>
                        <th>نصيبك (60%)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $index => $a)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $a->Bookings->first()->user->userName ?? 'غير موجود' }}</td>
                            <td>{{ $a->day }}</td>
                            <td>{{ $a->from_time }}</td>
                            <td>{{ $a->to_time }}</td>
                            <td>{{ $a->price }} LYD</td>
                            <td class="fw-bold text-success">{{ number_format($a->price * 0.60, 2) }} LYD</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- زر تسجيل الخروج --}}
    <form action="{{ route('doctor.logout') }}" method="POST">
        @csrf
        <button class="btn w-100 rounded-4 py-2 fw-bold text-white" style="background-color: #148994;">
            تسجيل الخروج
        </button>
    </form>

</div>
</body>
</html>
