@extends('layouts.app')
{{-- استخدام القالب الرئيسي للتطبيق --}}
@section('content')

{{-- شريط البحث عن الأقسام --}}
<div class="unique-search-bar">
    <form method="GET" action="{{ route('departments.index') }}" class="row g-2">
        <div class="col-md-9">
            {{-- حقل إدخال نص البحث --}}
            <input type="text" name="search" class="form-control"
                   placeholder="ابحث عن قسم"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            {{-- زر تنفيذ البحث --}}
            <button class="btn btn-info w-100 text-white">
                بحث
            </button>
        </div>
    </form>
</div>

{{-- قسم عرض الأقسام الطبية --}}
<section id="medical-departments" class="unique-med-dept-section">
    <div class="container">
        <div class="row g-4">

            {{-- تكرار عرض كل قسم طبي --}}
            @foreach ($departments as $dept)

                {{-- توليد ألوان عشوائية لاسم القسم والبادج --}}
                @php
                    $nameColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    $badgeColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                @endphp

                <div class="col-lg-3 col-md-6 col-sm-12">
                    {{-- رابط الانتقال إلى أطباء القسم --}}
                    <a href="{{ route('departments.doctors', $dept->id) }}" class="text-decoration-none">

                        {{-- كرت القسم --}}
                        <div class="unique-med-card h-100 rounded-4 shadow-sm border-0 d-flex flex-column">

                            {{-- صورة القسم --}}
                            <div class="unique-med-card-img-wrapper">
                                <img src="{{ $dept->imgUrl ? asset('storage/'.$dept->imgUrl) : asset('images/default.jpg') }}"
                                     alt="{{ $dept->name }}">
                            </div>

                            {{-- محتوى الكرت --}}
                            <div class="unique-med-dept-body d-flex flex-column">

                                {{-- معلومات القسم --}}
                                <div class="dept-info">
                                    <h5 class="unique-med-card-title fw-bold"
                                        style="color: {{ $nameColor }}">
                                        {{ $dept->name }}
                                    </h5>

                                    {{-- وصف القسم --}}
                                    <p class="unique-med-dept-bio">
                                        {{ $dept->description ?? 'لا يوجد وصف متوفر.' }}
                                    </p>
                                </div>

                                {{-- تذييل الكرت (عدد الأطباء) --}}
                                <div class="unique-med-dept-footer d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">
                                        عدد الأطباء:
                                    </span>

                                    <span class="badge unique-med-dept-badge fs-6"
                                          style="background-color: {{ $badgeColor }}">
                                        {{ $dept->doctors_count ?? 0 }} طبيب
                                    </span>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>

            @endforeach
            {{-- نهاية التكرار --}}
        </div>
    </div>

    {{-- روابط الترقيم (Pagination) --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $departments->links() }}
    </div>
</section>

@endsection
{{-- نهاية المحتوى --}}
