<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم الطبيب</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body { font-family: 'Cairo', sans-serif; }
        .card-rounded { border-radius: 1rem; }
        .shadow-lg { box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15)!important; }
        .table th, .table td { vertical-align: middle; }
        .btn-small { padding: 0.25rem 0.5rem; font-size: 0.85rem; }
        .search-input { max-width: 200px; display: inline-block; }
        .disabled-btn { opacity: 0.45; cursor: not-allowed; pointer-events: none; filter: grayscale(100%); }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">

    {{-- بطاقة بيانات الطبيب --}}
    <div class="card mb-4 p-4 shadow-lg card-rounded text-white" style="background:#148994;">
        <div class="row align-items-center">
            <div class="col-md-3 text-center mb-3">
                <img src="{{ asset('image/photo_2025-12-07_16-40-49.jpg') }}" class="rounded-circle border"
                     width="140" height="140" style="object-fit:cover;">
            </div>
            <div class="col-md-9">
                <h3 class="fw-bold mb-2">{{ $doctor->fullName }}</h3>
                <div class="row">
                    <div class="col-6 mb-1">🩺 التخصص: {{ $doctor->specialty }}</div>
                    <div class="col-6 mb-1">🏥 القسم: {{ $doctor->Department->name ?? 'غير محدد' }}</div>
                    <div class="col-6 mb-1">📧 الإيميل: {{ $doctor->email }}</div>
                    <div class="col-6 mb-1">📞 الهاتف: {{ $doctor->phone }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- بطاقة عدد الحجوزات --}}
    <div class="row text-center mb-4 g-3">
        <div class="col-md-6">
            <div class="card p-4 card-rounded shadow-sm">
                <h6 class="fw-bold">عدد الحجوزات</h6>
                <span class="fs-4 fw-bold">{{ $appointmentsCount }}</span>
            </div>
        </div>
    </div>

    {{-- فلترة الحجوزات حسب اليوم --}}
    <div class="card p-4 card-rounded shadow-sm mb-4">
        <form method="GET" action="{{ route('doctor.dashboard') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="fw-bold mb-1">اختر اليوم</label>
                <select name="filter_day" class="form-select">
                    <option value="">كل الأيام</option>
                    @foreach($appointmentsByDay as $day => $items)
                        <option value="{{ $day }}" @selected(request('filter_day') == $day)>{{ $day }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn w-100 text-white" style="background:#148994;">فلترة</button>
            </div>
        </form>
        <a href="{{ route('doctor.archive') }}" class="btn btn-secondary mt-3">📂 سجل الحجوزات</a>
    </div>

    {{-- بحث عن المريض --}}
    <form method="GET" action="{{ route('doctor.dashboard') }}" class="d-flex align-items-end gap-1 mb-4">
        <input type="text" name="patient_code" placeholder="رقم المريض" class="form-control search-input">
        <button type="submit" class="btn btn-secondary btn-small">بحث</button>
    </form>

    {{-- بيانات المريض --}}
    @if($user)
        <div class="card p-4 card-rounded shadow-sm mb-4">
            <h5 class="fw-bold mb-3">بيانات المريض</h5>
            <p><strong>الاسم:</strong> {{ $user->userName }}</p>
            <p><strong>رقم المريض:</strong> {{ $user->patient_code }}</p>
            <p><strong>فصيلة الدم:</strong> {{ $user->blood_type ?? 'غير محددة' }}</p>
            <p><strong>الأمراض المزمنة:</strong>
                @if(!empty($user->chronic_diseases))
                    <ul class="mb-0">
                        @foreach(explode(',', $user->chronic_diseases) as $disease)
                            <li>{{ trim($disease) }}</li>
                        @endforeach
                    </ul>
                @else --- @endif
            </p>
            <p><strong>الأدوية الحالية:</strong>
                @if(!empty($user->current_medications))
                    <ul class="mb-0">
                        @foreach(explode(',', $user->current_medications) as $med)
                            <li>{{ trim($med) }}</li>
                        @endforeach
                    </ul>
                @else --- @endif
            </p>
        </div>
    @endif

@php
    $todayArabic = \Carbon\Carbon::now()->locale('ar')->isoFormat('dddd');
    $todayNormalized = str_replace('ال', '', $todayArabic);

    $data = (request('filter_day') && !empty($filteredAppointments))
        ? [request('filter_day') => $filteredAppointments]
        : $appointmentsByDay;
@endphp

@foreach($data as $day => $appointments)
    @php
        $dayNormalized = str_replace('ال', '', $day);
        $isToday = (mb_strtolower($dayNormalized) === mb_strtolower($todayNormalized));
        $isClosed = empty($appointments); // كل الحجوزات مؤرشفة

        $statusColors = [
            'waiting' => 'warning',
            'checked_in' => 'info',
            'done' => 'success',
            'cancelled' => 'danger',
        ];
    @endphp

    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
        <h5>📅 {{ $day }}</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>المريض</th>
                    <th>رقم المريض</th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
            @forelse($appointments as $i => $a)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $a['user']->userName ?? '---' }}</td>
                    <td>{{ $a['user']->patient_code ?? '---' }}</td>
                    <td>{{ $a['from_time'] }}</td>
                    <td>{{ $a['to_time'] }}</td>
                    <td>
                        <form method="POST" action="{{ route('doctor.booking.updateStatus', $a['id']) }}">
                            @csrf
                            <select name="status" class="form-select form-select-sm mb-1">
                                @if($a['status'] !== 'done')
                                    <option value="waiting" @selected($a['status']=='waiting')>Waiting</option>
                                @endif
                                <option value="checked_in" @selected($a['status']=='checked_in')>Checked In</option>
                                <option value="cancelled" @selected($a['status']=='cancelled')>Cancelled</option>
                            </select>
                            <button class="btn btn-success btn-small w-100">Save</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">📌 جميع الحجوزات لليوم تم تحديثها وأرشفتها.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endforeach

<form method="POST" action="{{ route('doctor.logout') }}" class="mt-4">
    @csrf
    <button class="btn w-100 text-white fw-bold" style="background:#148994;">
        تسجيل الخروج
    </button>
</form>

</div>
</body>
</html>
