@extends('layouts.app')
@section('content')
<section class="vh-hero-area">
    <div class="vh-container-boxx">
    <h2 class="vh-container-boxx">جميع الأقسام الطبية</h2>
    <p class="vh-sub-text">استعرض جميع الأقسام الطبية المتوفرة، وتعرف على الأطباء المتخصصين في كل قسم بسهولة وسرعة.</p>
    </div>
</section>

<div class="unique-search-bar">
    <form action="{{ route('doctors.search') }}" method="GET" class="row g-2 align-items-center">
        <div class="col-md-5">
            <input type="text" name="name" class="form-control unique-search-input" placeholder="ابحث عن قسم" value="{{ request('name') }}">
        </div>

        <div class="col-md-4">
            <select name="department" class="form-select unique-search-select">
                <option value="">موقع</option>
                @foreach($departments as $dep)
                    <option value="{{ $dep->location }}" @selected(request('department') == $dep->location)>
                        {{ $dep->location }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button class="btn btn-info w-100 unique-search-btn text-white">بحث</button>
        </div>
    </form>
</div>

<section id="medical-departments" class="unique-med-dept-section">
    <div class="container">
        <div class="row g-4">
            @foreach ($departments as $dept)
                @php
                    $nameColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $badgeColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                @endphp
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <a href="{{ route('departments.doctors', $dept->id) }}" class="text-decoration-none">
                        <div class="unique-med-card h-100 rounded-4 shadow-sm border-0 d-flex flex-column">

                            <div class="unique-med-card-img-wrapper">
                                <img src="{{ $dept->imgUrl ? asset('storage/'.$dept->imgUrl) : asset('images/default.jpg') }}"
                                     alt="{{ $dept->name }}">
                            </div>

                            <div class="unique-med-dept-body d-flex flex-column">
                                <div class="dept-info">
                                    <h5 class="unique-med-card-title fw-bold" style="color: {{ $nameColor }}">
                                        {{ $dept->name }}
                                    </h5>
                                    <p class="unique-med-dept-bio">
                                        {{ $dept->description ?? 'لا يوجد وصف متوفر.' }}
                                    </p>
                                </div>

                                <div class="unique-med-dept-footer d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">عدد الأطباء:</span>
                                    <span class="badge unique-med-dept-badge fs-6" style="background-color: {{ $badgeColor }}">
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
