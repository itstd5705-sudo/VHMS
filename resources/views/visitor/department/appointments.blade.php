@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/doctor.css') }}">
@endsection

@section('content')
<div class="container py-4">
    <div class="row gy-3">

        <!-- 🧑‍⚕️ كرت الدكتور -->
        <div class="col-md-4">
            <div class="card doctor-card shadow-sm border-0">
              <img src="{{ asset('image/photo_2025-12-07_16-40-49.jpg') }}"
                class="doctor-img" alt="{{ $doctor->fullName }}">
                <div class="card-body text-center p-2">
                    <h6 class="fw-bold mb-1">{{ $doctor->fullName }}</h6>
                    <small class="text-muted">{{ $doctor->specialty }}</small>
                    <p class="text-secondary mt-1 mb-0" style="font-size:0.8rem">{{ $doctor->department->name ?? '' }}</p>
                </div>
            </div>
        </div>

        <!-- 📅 جدول المواعيد -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-2 rounded-3">

                @if($appointments->isNotEmpty())
                    @foreach($appointments as $item)
                        @php
                            $remaining = $item->max_bookings - $item->bookings->count();
                        @endphp
                        <div class="d-flex justify-content-between align-items-center bg-light rounded-2 p-2 mb-2 flex-wrap">
                            <div class="me-2">
                                <small class="appointment-day">{{ $item->day }}</small>
                                <h6 class="appointment-time mb-3">{{ $item->from_time }} - {{ $item->to_time }}</h6>
                                <h2 class="text-danger mb-2" style="font-size:0.9rem">السعر: {{ number_format($item->price, 2) }} د.ل</h2>
                            </div>
                            <div class="text-end">
                                <span class="badge
                                    @if($remaining > 0) bg-success
                                    @else bg-danger
                                    @endif
                                    text-white mb-1">
                                    {{ $remaining > 0 ? 'متاح' : 'مكتمل' }}
                                </span>
                                <p class="remaining mb-1">متبقي: {{ $remaining }}</p>

                                <!-- زر الحجز -->
                                @if($remaining > 0)
                                    <a href="{{ route('user.book', $item->id) }}" class="btn btn-info btn-sm rounded-pill">
                                        حجز الآن
                                    </a>
                                @else
                                    <button class="btn btn-secondary btn-sm rounded-pill" disabled>
                                        غير متاح
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-muted">لا توجد مواعيد متاحة.</p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
