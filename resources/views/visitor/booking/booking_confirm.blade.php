@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 p-4 text-center">

        {{-- أيقونة نجاح --}}
        <div class="mb-3">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
        </div>

        <h3 class="fw-bold mb-3">تم الحجز بنجاح!</h3>

        <div class="text-start mx-auto" style="max-width: 400px;">
            <p><i class="bi bi-person-circle me-2"></i>موعدك مع الدكتور: <strong>{{ $booking->appointment->doctor->fullName }}</strong></p>
            <p><i class="bi bi-calendar-event me-2"></i>اليوم:<strong>{{ $booking->appointment->day }}</strong></p>
            <p><i class="bi bi-clock me-2"></i>الوقت: <strong>{{ $booking->appointment->from_time }} - {{ $booking->appointment->to_time }}</strong></p>
            <p><i class="bi bi-info-circle me-2"></i>الحالة:
                @if($booking->status == 'مؤكد')
                    <span class="badge bg-success">{{ $booking->status }}</span>
                @elseif($booking->status == 'معلق')
                    <span class="badge bg-warning text-dark">{{ $booking->status }}</span>
                @else
                    <span class="badge bg-secondary">{{ $booking->status }}</span>
                @endif
            </p>
            <div class="bg-indigo-50 p-4 rounded-xl mt-3">
    <p class="font-bold text-indigo-700">
        رقمك المتوقع في الدور: {{ $expectedQueue }}
    </p>

    <p class="text-sm text-gray-600">
        عدد الأشخاص قبلك: {{ $peopleBefore }}
    </p>
</div>

        </div>

        <a href="{{ route('user.booking.myBookings') }}" class="btn btn-primary mt-4 px-4 fw-bold">
            عرض جميع حجوزاتي
        </a>

    </div>
</div>
<script>
    function updateQueueLive() {
        fetch("{{ route('user.queueStatus', $appointment->id) }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById('liveQueue').innerText = data.current_queue;
                document.getElementById('livePeopleBefore').innerText = data.people_before;
                document.getElementById('liveWaiting').innerText = data.waiting_time;
            });
    }

    // تحديث كل 5 ثواني
    setInterval(updateQueueLive, 5000);
</script>

@endsection
