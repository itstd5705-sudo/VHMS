@extends('layouts.app')
@section('content')
<section class="medinest-hero-section py-5">
    <div class="container">
            <div class="col-lg-7 ">
                <div class="medinest-hero-content ps-lg-4">
                    <span class="medinest-trusted-badge mb-3 d-inline-block"> WeLecome Venezia Hospitial </span>
                    <h1 class="medinest-main-title mb-4">
                            مرحبا بكم في مستشفى فينيسيا  <br><span class="highlight">رعايتكم اهتمامنا الاول</span>
                    </h1>
                    <p class="medinest-description mb-4">
                      اهلا وسهلا بكم .......في مستشفانا نؤمن ان الصحه اغلى ما يملك الانسان , لذلك نضع خبرتنا وامكانياتنا لخدمتكم , لنقدم لكم رعاية طبية تحترم تطلعاتكم وتلبي احتياجاتكم باعلى مستوى .
                    </p>
                    <div class="medinest-feature-bar d-flex flex-wrap gap-4 mb-5">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-award-fill me-2 medinest-feature-icon"></i>
                            <div>
                                <h5 class="medinest-feature-value mb-0">35+ Years</h5>
                                <p class="medinest-feature-label mb-0">Experience</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-badge-fill me-2 medinest-feature-icon"></i>
                            <div>
                                <h5 class="medinest-feature-value mb-0">150+</h5>
                                <p class="medinest-feature-label mb-0">Medical Specialists</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill me-2 medinest-feature-icon"></i>
                            <div>
                                <h5 class="medinest-feature-value mb-0">+35 </h5>
                                <p class="medinest-feature-label mb-0">عيادات تخصصية</p>
                            </div>
                        </div>
                    </div>
                    <div class="medinest-cta-buttons d-flex flex-wrap gap-3">

                        <a href="#" class="btn btn-outline-secondary medinesttt-watch-btn"> احجز موعدك الان</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="medinest-excellence-section container my-5 py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="medinest-excellence-title mb-3">نحنا في خدمتكم دائما</h2>
            <p class="medinest-excellence-description mx-auto">
                في مستشفى فينيسيا -بنغازي نؤمن ان رعاية المرضى تبدأ متميزين وطاقم متخصص يضم المستشفى شبكة واسعة من الاطباء الاستشارين والمتخصصين في مختلف المجالات الطبية كل الخدمات الطبية في المستشفى تعتمد على احدث الاجهزة والمعدات الطبية وفق معايير الجودة العالمية لضمان دقة التشخيص وفعالية العلاج .
            </p>
        </div>
    </div>
</section>
<section id="why-choose-us" class="why-choose-us py-5">
    <div class="container">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0 image-collage" data-aos="fade-right" data-aos-delay="100">
                <div class="row g-4">
                    <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="image-box position-relative overflow-hidden">
                            <img src="{{ asset('images/lab5.jpg') }}" alt="JCI Accredited" class="img-fluid">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2 fs-6">JCI Accredited</span>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-box overflow-hidden">
                            <img src="{{ asset('images/lab6.jpg') }}" alt="Doctor patient discussion" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="image-box overflow-hidden">
                            <img src="{{ asset('images/lab6.jpg') }}" alt="Surgery team" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                <div class="feature-box mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-center mb-3">
                          <i class="bi bi-heart-fill fs-4 icon me-3  text-align-right"></i>
                        <h3 class="h4 fw-bold mb-0">اولويتنا هي المريض </h3>

                    </div>
                    <p class="text-muted mb-0">
                        يتم تخصيص كل خطة علاج بعناية لتلبية احتياجات المريض لضمان الوصول معا لافضل خطة علاج ونتيجة
                    </p>
                </div>
                <ul class="list-unstyled mb-4 feature-list">
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">تكنولوجيا التشخيص المتقدمة والاجهزة الحديثة</h4>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">الاطباء والمتخصصون المعتمدون من مجلس الادارة ذوي خبره وكفاءة عاليه </h4>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">خدمات الطوارئ والرعاية على مدار الساعة </h4>
                            </div>
                    </li>
                </ul>
                <div class="row text-center mb-4 stats-box">
                    <div class="col-6" data-aos="fade-up" data-aos-delay="600">
                        <h3 class="display-4 fw-bold">95%</h3>
                        <p class="text-muted">رضى المرضى </p>
                    </div>
                    <div class="col-6" data-aos="fade-up" data-aos-delay="700">
                        <h3 class="display-4 fw-bold">35K+</h3>
                        <p class="text-muted">عمليات ناجحة </p>
                    </div>
                </div>
                <div class="medinest-cta-buttons d-flex flex-column flex-md-row " data-aos="fade-up" data-aos-delay="800">
                        <a href="#" class="btn btn-outline-secondary medinest-scheudule-btn"><i class="bi bi-play-circle me-2"></i> Schedule Consultation</a>
                    </div>
                 </div>
        </div>
    </div>
</section>
<section class="medinest-excellence-section container my-5 py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="medinest-excellence-title mb-3">نبذة عن اقسامنا </h2>
            <p class="medinest-excellence-description mx-auto">
            تحتوي المستشفى على مجموعة اقسام وتخصصات شاملة ومتنوعة
            </p>
        </div>
    </div>
</section>
<section id="departments" class="departments-section py-5">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="dept-card p-4 rounded-3 shadow-sm border">
                    <div class="icon-header d-flex align-items-center mb-3">
                        <div class="icon-wrap me-3">

                              <i class="bi bi-heart-pulse fs-3 dept-icon"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-0">طب الاطفال </h4>
                    </div>
                    <p class="card-text text-muted">
                    يختص طب الاطفال برعاية صحة الاطفال منذ الولادة وحتى سن الملراهقة ويشمل متابعه النمو الجسدي والعقلي والوقاية من الامراض وتشخيص الحالات الطبية المختلفة ومعالجتها
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                         <div class="medinest-cta-buttons d-flex flex-wrap gap-3">

                        <a href="#" class="btn btn-outline-secondary medinest-watch-btn"> عرض الاطباء والحجز </a>
                    </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="dept-card p-4 rounded-3 shadow-sm border">
                    <div class="icon-header d-flex align-items-center mb-3">
                        <div class="icon-wrap me-3">
                            <i class="bi bi-eye-fill fs-3 dept-icon"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-0"> طب العيون والليزك</h4>
                    </div>
                    <p class="card-text text-muted">
                        يقوم قسمنا بتشخيص وعلاج جميع الحالات المتعلقة بصحة العينين , في مستشفى فنيسيا نركز على تقديم رعاية شاملة ومتخصصة للعين مع متابعة دقيقة لكل حالة .
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                         <div class="medinest-cta-buttons d-flex flex-wrap gap-3">

                        <a href="#" class="btn btn-outline-secondary medinest-watch-btn">عرض الاطباء والحجز </a>
                    </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="dept-card p-4 rounded-3 shadow-sm border">
                    <div class="icon-header d-flex align-items-center mb-3">
                        <div class="icon-wrap me-3">
                            <i class="bi bi-bandaid-fill fs-3 dept-icon"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-0">طب الجلدية </h4>
                    </div>
                    <p class="card-text text-muted">
                     يعني طب الجلدية بتشخيص وعلاج جميع الامراض والحالات المتعلقة ب الجلد والشعر والاظافر بالاضافة الى العلاجات التجميلية غير الجراحية .
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                     <div class="medinest-cta-buttons d-flex flex-wrap gap-3">

                        <a href="#" class="btn btn-outline-secondary medinest-watch-btn">عرض الاطباء والحجز</a>
                    </div>

                    </div>
                </div>
            </div>
</section>
<section id="stats-features" class="stats-features py-4">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-card p-4 text-center rounded-3 shadow-sm">
                    <div class="icon-wrap mb-3">
                        <i class="bi bi-calendar-check fs-2 stat-icon"></i>
                    </div>
                    <h4 class="stat-number fw-bold mb-0">35+</h4>
                    <p class="stat-label text-muted mb-0">Years Experience</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-card p-4 text-center rounded-3 shadow-sm">
                    <div class="icon-wrap mb-3">
                        <i class="bi bi-person-badge fs-2 stat-icon"></i>
                    </div>
                    <h4 class="stat-number fw-bold mb-0">150+</h4>
                    <p class="stat-label text-muted mb-0">Medical Specialists</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-card p-4 text-center rounded-3 shadow-sm">
                    <div class="icon-wrap mb-3">
                        <i class="bi bi-geo-alt fs-2 stat-icon"></i>
                    </div>
                    <h4 class="stat-number fw-bold mb-0">12</h4>
                    <p class="stat-label text-muted mb-0">Clinic Locations</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-card p-4 text-center rounded-3 shadow-sm">
                    <div class="icon-wrap mb-3">
                        <i class="bi bi-heart-pulse fs-2 stat-icon"></i>
                    </div>
                    <h4 class="stat-number fw-bold mb-0">25K+</h4>
                    <p class="stat-label text-muted mb-0">Patients Treated</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="doctors" class="doctors-section py-5">
    <div class="container">
    <section class="medinest-excellence-section container my-5 py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="medinest-excellence-title mb-3">اطبائنا</h2>
            <p class="medinest-excellence-description mx-auto">
        تعرّف على جزء من طاقمنا الطبي الذي يضم نخبة من الاخصائيين والاستشارين المعتمدين .
            </p>
        </div>
    </div>
</section>
<div class="row g-4 justify-content-center">

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/السالمي المسلاتي.jpg') }}" alt="Dr. Jennifer Morgan" class="doctor-img rounded-circle me-3">

                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د . السالمي المسلاتي </h4>
                            <p class="doctor-speciality text-primary mb-1">طبيب الاطغال </p>
                            <small class="text-muted">MD, FACC | 18 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/امال المعداني.jpg') }}" alt="Dr. Robert Kim" class="doctor-img rounded-circle me-3">
                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د . امال المعداني </h4>
                            <p class="doctor-speciality text-primary mb-1">نساء وولادة </p>
                            <small class="text-muted">MD, PhD | 24 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/احمد دومه.jpg') }}" alt="Dr. Sarah Thompson" class="doctor-img rounded-circle me-3">
                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د. احمد دومه</h4>
                            <p class="doctor-speciality text-primary mb-1">طبيب جراحة اعصاب </p>
                            <small class="text-muted">MD, FAAP | 12 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/فتحي العبيدي.jpg') }}" alt="Dr. Sarah Thompson" class="doctor-img rounded-circle me-3">
                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د. فتحي العبيدي </h4>
                            <p class="doctor-speciality text-primary mb-1">طبيب تجميل </p>
                            <small class="text-muted">MD, FAAP | 12 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/مرعي الجهاني.jpg') }}" alt="Dr. Sarah Thompson" class="doctor-img rounded-circle me-3">
                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د. مرعي الجهاني </h4>
                            <p class="doctor-speciality text-primary mb-1">طبيب جراحة عامة </p>
                            <small class="text-muted">MD, FAAP | 12 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="doctor-card p-4 rounded-3 shadow-sm border">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('images/مهند البركي.jpg') }}" alt="Dr. Sarah Thompson" class="doctor-img rounded-circle me-3">
                        <div>
                            <h4 class="doctor-name fw-bold mb-0">د. مهند البركي </h4>
                            <p class="doctor-speciality text-primary mb-1">طبيب جراحة مسالك</p>
                            <small class="text-muted">MD, FAAP | 12 years experience</small>
                        </div>
                    </div>

                    <div class="ratings d-flex align-items-center mb-3">
                        <i class="bi bi-star-fill text-warning me-1"></i>
                        <span class="rating-value fw-bold me-2">5.0</span>
                        <span class="text-muted">(156 patients reviews)</span>
                    </div>

                    <div class="d-flex justify-content-start gap-2">
                        <a href="#" class="btn btn-primary btn-sm flex-fill">عرض جدول المواعيد</a>
                    </div>
                </div>
            </div>
            </div>
    </div>
</section>
@endsection
