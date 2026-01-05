<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>أرشيف الحجوزات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Cairo', sans-serif;" class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">📂 أرشيف الحجوزات للطبيب {{ $doctor->fullName }}</h2>

    @forelse($appointmentsByDay as $day => $appointments)
        <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
            <h5>📅 {{ $day }}</h5>

            @if(isset($dailyReports[$day]))
                <a href="{{ route('doctor.archive', ['download_day' => $day]) }}"
                   class="btn btn-success btn-sm">
                    💰 تحميل كشف مالي
                </a>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>المريض</th>
                        <th>رقم المريض</th>
                        <th>قيمة ربح اليوم</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalDay = 0;
                        $totalPaid = 0;
                    @endphp
                    @forelse($appointments as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a['user']->userName ?? '---' }}</td>
                            <td>{{ $a['user']->patient_code ?? '---' }}</td>
                            <td class="text-success fw-bold">
                                {{ number_format($a['price'] * 0.60, 2) }} LYD
                            </td>
                            <td>{{ ucfirst($a['status']) }}</td>
                        </tr>
                        @php
                            $totalDay += $a['price'] * 0.60;
                            if(in_array($a['status'], ['checked_in','done'])){
                                $totalPaid += $a['price'] * 0.60;
                            }
                        @endphp
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">لا توجد حجوزات مؤرشفة في هذا اليوم</td>
                        </tr>
                    @endforelse

                    <!-- مجموع ربح اليوم -->
                    <tr style="font-weight:bold; background-color:#f9f9f9;">
                        <td colspan="3">مجموع ربح اليوم</td>
                        <td colspan="2" class="text-success">{{ number_format($totalDay, 2) }} LYD</td>
                    </tr>

                    <!-- مجموع ربح الحالات المدفوعة فقط -->
                    <tr style="font-weight:bold; background-color:#e0f7e0;">
                        <td colspan="3">مجموع ربح الحالات المدفوعة (Checked In + Done)</td>
                        <td colspan="2" class="text-success">{{ number_format($totalPaid, 2) }} LYD</td>
                    </tr>

                </tbody>
            </table>
        </div>
    @empty
        <div class="alert alert-info">لا توجد حجوزات مؤرشفة بعد.</div>
    @endforelse

    <a href="{{ route('doctor.dashboard') }}" class="btn btn-primary mt-4">🔙 العودة للوحة التحكم</a>

</div>
</body>
</html>
