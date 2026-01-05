@extends('layouts.app')

@section('content')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/doctors.css') }}">
@endsection

<div class="container my-5">
    <!-- العنوان -->
    <h2 class="text-center mb-4 display-5 fw-bold text-secondary">
        <i class="fas fa-user-md me-2"></i>
        @isset($department)
            دكاترة قسم {{ $department->name }}
        @else
            نتائج البحث
        @endisset
    </h2>
       <!-- 🔍 شريط البحث -->
    <div class="bg-light p-3 rounded-4 shadow-sm mb-5 border">
        <form method="GET" action="{{ route('doctors.search') }}"  class="row g-2 align-items-center">
            <div class="col-md-5">
                <input type="text" name="name" class="form-control rounded-pill" placeholder="ابحث عن طبيب" value="{{ request('name') }}">
            </div>
<div class="col-md-4 position-relative">
    <select name="department" class="form-select rounded-pill department-select">
        <option value="">كل الأقسام</option>
        @foreach($departments as $dep)
            <option value="{{ $dep->id }}" @selected(request('department') == $dep->id)>
                {{ $dep->name }}
            </option>
        @endforeach
    </select>
</div>

            <div class="col-md-3">
                <button class="btn btn-info w-100 rounded-pill text-white">بحث</button>
            </div>
        </form>
    </div>


    <hr class="mb-5">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

      @forelse($doctors as $doctor)

        <div class="col">
            <div class="card h-100 shadow-lg border-0 doctor-card overflow-hidden position-relative">

              <img src="{{ asset('image/photo_2025-12-07_16-40-49.jpg') }}"
     class="doctor-img" alt="{{ $doctor->fullName }}">


                <span class="badge text-white position-absolute top-0 start-0 m-2"
                      style="background-color: {{ $doctor->status == 'active' ? '#28a745' : '#dc3545' }}">
                    {{ ucfirst($doctor->status) }}
                </span>

                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold mb-1">{{ $doctor->fullName }}</h5>

                    <p class="card-text text-secondary small mb-2">
                        {{ $doctor->specialty ?? ($department->name ?? '') }}
                    </p>

                    <div class="mb-3">
                        @if(isset($department))
                            <span class="badge rounded-pill text-bg-info">{{ $department->name }}</span>
                        @endif

                        @if($doctor->specialty)
                            <span class="badge rounded-pill text-bg-light border text-secondary">
                                {{ $doctor->specialty }}
                            </span>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between mt-auto gap-2">

                        <a href="{{ route('doctor.appointments', $doctor->id) }}"
                           class="btn btn-outline-info flex-grow-1 rounded-pill view-profile-btn">
                            عرض المواعيد
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center text-muted">لا توجد نتائج</p>
        @endforelse

    </div>
</div>
 <div class="mt-5 d-flex justify-content-center">
        {{ $doctors->links() }}
    </div>
@endsection
