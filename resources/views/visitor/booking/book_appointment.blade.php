@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/booking.css') }}">

<div class="container py-5">

    <h3 class="booking-title">
        حجز موعد مع الدكتور {{ $appointment->doctor->fullName }}
    </h3>

    <div class="card booking-card p-4 position-relative">

        {{-- تفاصيل الموعد --}}
        <div class="appointment-box mb-4">
            <p class="label-title">اليوم</p>
            <p class="label-value">{{ $appointment->day }}</p>

            <p class="label-title">الوقت</p>
            <p class="label-value">
                {{ $appointment->from_time }} - {{ $appointment->to_time }}
            </p>

            <p class="label-title">السعر</p>
            <p class="price-text">
                {{ $appointment->price }} د.ل
            </p>

            <div class="d-flex justify-content-between align-items-start mt-3 flex-wrap">

                {{-- رصيد المستخدم --}}
                <div class="mb-3">
                    <p class="label-title">رصيدك الحالي</p>
                    <p class="price-text">{{ $user->balance }} د.ل</p>
                </div>

                {{-- الطابور --}}
                <div class="queue-box">
                    <p class="fw-bold text-primary mb-1">
                        رقمك المتوقع في الطابور: {{ $expectedQueue }}
                    </p>
                    <p class="text-secondary mb-0">
                        عدد الأشخاص قبلك: {{ $peopleBefore }}
                    </p>
                </div>

                {{-- زر المحفظة --}}
                <button type="button"
                        class="wallet-btn shadow-sm border-0 ms-auto"
                        id="walletToggleBtn">
                    <i class="bi bi-wallet2 fs-5 text-primary"></i>
                </button>

            </div>
        </div>

        {{-- رسائل الأخطاء --}}
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- رسالة التحذير للحجز المكرر --}}
        @if(session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}

                <form action="{{ route('user.confirmBooking', $appointment->id) }}"
                      method="POST" class="d-inline ms-2">
                    @csrf
                    <input type="hidden" name="confirm_double_booking" value="1">
                    <button type="submit" class="btn btn-sm btn-warning">
                        تأكيد الحجز مرة أخرى
                    </button>
                </form>
            </div>
        @endif

        {{-- تأكيد الحجز --}}
        <form action="{{ route('user.confirmBooking', $appointment->id) }}"
              method="POST" class="mb-4">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">ملاحظة (اختياري)</label>
                <textarea name="note" class="form-control" rows="3"
                          placeholder="اكتب ملاحظتك هنا..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-bold">
                تأكيد الحجز والدفع من المحفظة
            </button>
        </form>

        <hr>

        {{-- نموذج شحن المحفظة --}}
        <div id="walletForm" class="wallet-form d-none">
            <h5 class="mb-3 fw-bold">شحن المحفظة</h5>

            <form action="{{ route('user.rechargeWallet') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">رقم الكرت</label>
                    <input type="text" name="card_number"
                           class="form-control"
                           placeholder="xxxx-xxxx-xxxx-xxxx"
                           required>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold">
                    شحن المحفظة
                </button>
            </form>
        </div>

    </div>
</div>

{{-- Bootstrap Icons --}}
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

{{-- Script --}}
<script>
    const btn = document.getElementById('walletToggleBtn');
    const form = document.getElementById('walletForm');

    if(btn){
        btn.addEventListener('click', () => {
            form.classList.toggle('d-none');

            btn.style.transform = form.classList.contains('d-none')
                ? 'rotate(0deg)'
                : 'rotate(20deg)';
        });
    }
</script>

@endsection
