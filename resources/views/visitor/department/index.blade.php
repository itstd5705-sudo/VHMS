@extends('layouts.app')
@section('content')
<section class="about-hero-section">
    <div class="container text-center">
        <h2 class="hero-title">الأقسام الطبية</h2>
        <p class="hero-description">اكتشف جميع الأقسام الطبية والأطباء المتخصصين في كل قسم بسهولة</p>
    </div>
</section>

<!-- 🔍 شريط البحث -->
<div class="bg-light p-3 rounded-4 shadow-sm mb-5 border">
    <form action="{{ route('doctors.search') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="name" class="form-control rounded-pill" placeholder="ابحث عن قسم" value="{{ request('name') }}">
        </div>

        <div class="col-md-4">
            <select name="department" class="form-select rounded-pill">
                <option value="">موقع</option>
                @foreach($departments as $dep)
                    <option value="{{ $dep->location }}" @selected(request('department') == $dep->location)>
                        {{ $dep->location }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-info w-100 rounded-pill text-white">بحث</button>
        </div>
    </form>
</div>

<section id="medical-departments" class="departments-section py-5">
    <div class="container">
        <div class="row g-4">
            @foreach ($departments as $dept)
                @php
                    // توليد ألوان عشوائية للاسم وعدد الأطباء
                    $nameColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $badgeColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="{{ route('departments.doctors', $dept->id) }}" class="text-decoration-none">
                        <div class="card h-100 rounded-4 shadow-sm border-0 overflow-hidden d-flex flex-column">

                            <!-- صورة القسم -->
                            <div class="card-img-wrapper">
                                <img src="{{ $dept->imgUrl ? asset('storage/'.$dept->imgUrl) : asset('images/default.jpg') }}"
                                     alt="{{ $dept->name }}">
                            </div>

                            <!-- بيانات القسم -->
                            <div class="department_body d-flex flex-column">
                                <div class="dept-info">
                                    <h5 class="card-title fw-bold" style="color: {{ $nameColor }}">
                                        {{ $dept->name }}
                                    </h5>
                                    <p class="card-text small text-muted dept-bio">
                                        {{ $dept->description ?? 'لا يوجد وصف متوفر.' }}
                                    </p>
                                </div>

                                <div class="department-footer d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">عدد الأطباء:</span>
                                    <span class="badge department-badge fs-6" style="background-color: {{ $badgeColor }}">
                                        {{ $dept->doctors_count ?? 0 }} طبيب
                                    </span>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
