@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/service.css') }}">

{{-- Hero Section --}}
<section class="service-hero-section">
    <div class="container">
        <h2 class="hero-title">Services Venice Hospital</h2>
         <p class="hero-description">
            Venice Hospital has been a pioneer in healthcare since 1985. Our facility in Benghazi offers state-of-the-art medical services in a patient-friendly environment.
        </p>
    </div>
</section>

{{-- Services Grid --}}
<div class="row g-4 justify-content-center mt-4">

    {{-- Service 1 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                    <i class="bi bi-heart-pulse-fill service-icon"></i>
                </div>
                <h4 class="card-title mb-0">الأشعة والتصوير الطبي</h4>
            </div>
            <p class="card-text">
                نقدم خدمات التصوير بالرنين المغناطيسي، الأشعة السينية، والتصوير المقطعي المحوسب بأحدث الأجهزة.
            </p>
            <img src="{{ asset('image/photo_2025-11-08_14-10-00.jpg') }}" alt="Radiology">
        </div>
    </div>

    {{-- Service 2 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                   <i class="bi bi-hdd-stack"></i>
                </div>
                <h4 class="card-title mb-0">المختبرات والتحاليل الطبية</h4>
            </div>
            <p class="card-text">
                إجراء جميع الفحوصات الكيميائية، الدموية، الميكروبيولوجية والباثولوجية بدقة عالية.
            </p>
            <img src="{{ asset('image/photo_2025-11-08_14-10-00.jpg') }}" alt="Laboratory">
        </div>
    </div>

    {{-- Service 3 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                    <i class="bi bi-capsule service-icon"></i>
                </div>
                <h4 class="card-title mb-0">الصيدلية</h4>
            </div>
            <p class="card-text">
                توفير وتوزيع الأدوية والوصفات الطبية للمرضى الداخليين والخارجيين.
            </p>
            <img src="{{ asset('image/photo_2025-11-08_14-10-00.jpg') }}" alt="Pharmacy">
        </div>
    </div>

    {{-- Service 4 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                    <i class="bi bi-emoji-smile service-icon"></i>
                </div>
                <h4 class="card-title mb-0">الدعم النفسي والاجتماعي</h4>
            </div>
            <p class="card-text">
                تقديم خدمات الصحة النفسية ومساعدة المرضى وأسرهم في التعامل مع الآثار الاجتماعية والنفسية للمرض.
            </p>
            <img src="{{ asset('image/photo_2025-11-07_19-13-48.jpg') }}" alt="Psychological Support">
        </div>
    </div>

    {{-- Service 5 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="500">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                    <i class="bi bi-heart service-icon"></i>
                </div>
                <h4 class="card-title mb-0">الرعاية المتقدمة والحرجة</h4>
            </div>
            <p class="card-text">
                توفير مراقبة ورعاية متقدمة للمرضى ذوي الحالات الحرجة ورعاية مركزة ومراقبة عن كثب.
            </p>
            <img src="{{ asset('image/photo_2025-11-07_19-14-06.jpg') }}" alt="Critical Care">
        </div>
    </div>

    {{-- Service 6 --}}
    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="600">
        <div class="service-card shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <div class="icon-wrap me-3">
                    <i class="bi bi-ambulance service-icon"></i>
                </div>
                <h4 class="card-title mb-0">الإسعاف والطوارئ</h4>
            </div>
            <p class="card-text">
                تقديم الرعاية العاجلة على مدار الساعة للحالات الحرجة والحوادث.
            </p>
            <img src="{{ asset('image/photo_2025-11-08_14-10-00.jpg') }}" alt="Emergency">
        </div>
    </div>

</div>
@endsection
