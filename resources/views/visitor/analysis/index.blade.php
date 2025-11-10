@extends('layouts.app')
@section('content')

<section class="about-hero-section py-5 text-center bg-light">
    <div class="container">
        <h2 class="hero-title">Departments & Medical Services</h2>
        <p class="hero-description">
            Venice Hospital has been a pioneer in healthcare since 1985. Our facility in Benghazi offers state-of-the-art medical services in a patient-friendly environment.
        </p>
    </div>
</section>

{{-- Search Form --}}
<div class="container">
    <form method="GET" action="{{ url()->current() }}" class="search-wrapper">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="ابحث عن خدمة أو قسم...">
        <button type="submit" class="btn btn-search">Search</button>
    </form>
</div>

<div class="container py-4">

    {{-- التحاليل --}}
    <h4 class="section-title">تحاليل طبية</h4>
    <div class="row g-4 mb-5">
        @forelse($tests as $test)
            <div class="col-12 col-md-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5>{{ $test->name }}</h5>
                        <p class="text-muted">{{ Str::limit($test->description, 80) }}</p>
                        <p class="text-success fw-bold">السعر: {{ $test->price }} د.ل</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد تحاليل حالياً.</p>
        @endforelse
    </div>

    {{-- المختبرات --}}
    <h4 class="section-title">المختبرات</h4>
    <div class="row g-4 mb-5">
        @forelse($labs as $lab)
            <div class="col-12 col-md-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5>{{ $lab->name }}</h5>
                        <p class="text-muted">{{ Str::limit($lab->description, 80) }}</p>
                        <p class="text-success fw-bold">التكلفة: {{ $lab->price }} د.ل</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد مختبرات حالياً.</p>
        @endforelse
    </div>

    {{-- الأجهزة --}}
    <h4 class="section-title">الأجهزة الطبية</h4>
    <div class="row g-4 mb-5">
        @forelse($devices as $device)
            <div class="col-12 col-md-4">
                <div class="card card-custom shadow-sm h-100">
                    <div class="card-body text-center">
                        <h5>{{ $device->name }}</h5>
                        <p class="text-muted">{{ Str::limit($device->description, 80) }}</p>
                        <p class="text-success fw-bold">السعر: {{ $device->price }} د.ل</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد أجهزة حالياً.</p>
        @endforelse
    </div>

</div>

@endsection
