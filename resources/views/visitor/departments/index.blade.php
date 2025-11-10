@extends('layouts.app')

@section('content')

{{-- Hero Section --}}
<section class="about-hero-section">
    <div class="container text-center">
        <h2 class="hero-title">Departments Venice Hospital</h2>
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

{{-- Departments Grid --}}
<div class="container py-4">
    <div class="row g-4">
        @forelse ($departments as $dept)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card department-card">
                    <div class="card-body text-center">
                        <h5>{{ $dept->name }}</h5>
                        <p><i class="bi bi-geo-alt"></i> {{ $dept->location }}</p>
                        <a href="{{ route('departments.show', $dept->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">لا توجد أقسام حالياً.</p>
        @endforelse
    </div>
</div>

@endsection
