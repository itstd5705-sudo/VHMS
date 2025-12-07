@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<div class="container py-5">
    <h3 class="mb-4 fw-bold text-center">حجوزاتي</h3>

   <div class="mb-4 text-start">
    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left-circle me-2"></i> رجوع
    </a>
</div>


    @if($bookings->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i>لا توجد حجوزات حالياً.
        </div>
    @else
        <div class="row g-4">
            @foreach($bookings as $booking)
                @php
                    $bookingTime = \Carbon\Carbon::parse($booking->created_at);
                    $now = \Carbon\Carbon::now();
                    $hoursPassed = $bookingTime->diffInHours($now);

                    // حساب رقم الدور ووقت الانتظار
                    $lastNumber = \App\Models\Booking::where('appointmentId', $booking->appointmentId)
                                     ->max('queue_number');
                    $booking->expectedQueue = $booking->queue_number ?? ($lastNumber ? $lastNumber : 1);
                    $booking->peopleBefore = $booking->expectedQueue - 1;
                    $minutesPerPatient = 10;
                    $booking->estimatedWaitingTime = $booking->peopleBefore * $minutesPerPatient;
                @endphp

                <div class="col-md-6 col-lg-4 booking-card" data-created="{{ $booking->created_at }}">
                    <div class="card shadow-sm border-0 rounded-4 p-4 h-100 hover-shadow">

                        {{-- رقم ترتيب الحجز --}}
                        <h6 style="color:red;">رقم الحجز: {{ $loop->iteration }}</h6>

                        {{-- تفاصيل الحجز --}}
                        <h5 class="fw-bold mb-2">{{ $booking->appointment->doctor->fullName }}</h5>
                        <p>الاختصاص: {{ $booking->appointment->doctor->specialty }}</p>
                        <p>التاريخ: {{ $booking->appointment->day }}</p>
                        <p>الوقت: {{ $booking->appointment->from_time }} - {{ $booking->appointment->to_time }}</p>
                        <p>السعر: {{ $booking->appointment->price }} د.ل</p>
                        @if($booking->note)
                            <p>ملاحظة: {{ $booking->note }}</p>
                        @endif

                        {{-- معلومات الطابور --}}
                        <p>رقم الدور المتوقع: <strong>{{ $booking->expectedQueue }}</strong></p>
                        <p>عدد الأشخاص قبلك: <strong>{{ $booking->peopleBefore }}</strong></p>


                        {{-- زر الإلغاء إذا لم تمضِ 3 ساعات --}}
                        @if($hoursPassed < 3)
                            <form action="{{ route('booking.cancel', $booking->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100 mt-2">
                                    <i class="bi bi-x-circle me-2"></i> إلغاء الحجز
                                </button>
                            </form>
                        @else
                            <span class="text-muted">انتهت صلاحية الإلغاء</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Hover shadow effect --}}
<style>
.hover-shadow:hover {
    transform: translateY(-5px);
    transition: 0.3s;
    box-shadow: 0 0.75rem 1.5rem rgba(0,0,0,0.15)!important;
}
</style>

@endsection
