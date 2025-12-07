@extends('layouts.app')
@section('content')
<section id="lab-tests-catalog" class="lab-tests-section py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 section-header"> التحاليل الطبية </h2>

            <div class="accordion accordion-flush" id="testsAccordion">

                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingBlood">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBlood" aria-expanded="false" aria-controls="collapseBlood">
                            <i class="bi bi-droplet-half me-3"></i> 🩸 تحاليل الدم الأساسية والشاملة
                        </button>
                    </h3>
                    <div id="collapseBlood" class="accordion-collapse collapse" aria-labelledby="headingBlood" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                            <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/تحليل دم.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="صورة الدم الكاملة">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">صورة الدم الكاملة (CBC)</h5>
                                                    <p class="card-text small text-muted mb-3">تقييم شامل لخلايا الدم الحمراء والبيضاء والصفائح الدموية.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">150.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/الدم التراكمي.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="سكر الدم العشوائي">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">سكر الدم التراكمي (HbA1c)</h5>
                                                    <p class="card-text small text-muted mb-3">لتقييم متوسط مستويات السكر في الدم على مدى 3 أشهر.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">120.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingOrgans">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrgans" aria-expanded="false" aria-controls="collapseOrgans">
                            <i class="bi bi-activity me-3"></i> 🩺 تحاليل وظائف الكلى والكبد
                        </button>
                    </h3>
                    <div id="collapseOrgans" class="accordion-collapse collapse" aria-labelledby="headingOrgans" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/الكبد الشامل.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="وظائف الكبد">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">وظائف الكبد الشاملة (LFT)</h5>
                                                    <p class="card-text small text-muted mb-3">تقييم شامل لكفاءة الكبد وإنزيماته والصفراء.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">220.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/البول واليوريا.jpg') }}" class="img-fluid rounded-start-4 test-image" alt="الكرياتينين واليوريا">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">البول واليوريا والكرياتينين</h5>
                                                    <p class="card-text small text-muted mb-3">تقييم شامل لوظيفة الكلى والترشيح.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">110.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/البروتين الكلي.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="البروتين الكلي">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">البروتين الكلي والألبومين</h5>
                                                    <p class="card-text small text-muted mb-3">مؤشر على التغذية ووظائف الكلى والكبد.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">160.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingVitamins">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVitamins" aria-expanded="false" aria-controls="collapseVitamins">
                            <i class="bi bi-capsule me-3"></i> ✨ تحاليل الفيتامينات والمعادن
                        </button>
                    </h3>
                    <div id="collapseVitamins" class="accordion-collapse collapse" aria-labelledby="headingVitamins" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/فيتامين دال.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="فيتامين د">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">فيتامين د (25-OH)</h5>
                                                    <p class="card-text small text-muted mb-3">قياس مستوى فيتامين د الضروري للعظام والمناعة.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">300.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/مخزون الحديد.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="مخزون الحديد">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">مخزون الحديد (فيريتين)</h5>
                                                    <p class="card-text small text-muted mb-3">مؤشر على نقص الحديد وفقر الدم المحتمل.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">180.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="{{ asset('image/بي 12.jpg') }}"  class="img-fluid rounded-start-4 test-image" alt="فيتامين ب12">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">فيتامين ب12</h5>
                                                    <p class="card-text small text-muted mb-3">ضروري لصحة الأعصاب وتكوين الدم.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">250.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingChronic">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChronic" aria-expanded="false" aria-controls="collapseChronic">
                            <i class="bi bi-heart-pulse me-3"></i> 🧡 تحاليل الأمراض المزمنة والهرمونات
                        </button>
                    </h3>
                    <div id="collapseChronic" class="accordion-collapse collapse" aria-labelledby="headingChronic" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/6f42c1/ffffff?text=TSH+Test" class="img-fluid rounded-start-4 test-image" alt="الغدة الدرقية">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">فحص شامل للغدة الدرقية (TSH, T3, T4)</h5>
                                                    <p class="card-text small text-muted mb-3">لتقييم نشاط وقصور الغدة الدرقية.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">350.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/0d6efd/ffffff?text=Cholesterol" class="img-fluid rounded-start-4 test-image" alt="الكوليسترول">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">ملف الدهون والكوليسترول</h5>
                                                    <p class="card-text small text-muted mb-3">تحديد مستويات الدهون لتقييم خطر أمراض القلب.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">140.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingInfection">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInfection" aria-expanded="false" aria-controls="collapseInfection">
                            <i class="bi bi-virus me-3"></i> 🦠 تحاليل الأمراض المعدية والمناعة
                        </button>
                    </h3>
                    <div id="collapseInfection" class="accordion-collapse collapse" aria-labelledby="headingInfection" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/198754/ffffff?text=Hep+B" class="img-fluid rounded-start-4 test-image" alt="التهاب الكبد ب">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">فحص التهاب الكبد (B و C)</h5>
                                                    <p class="card-text small text-muted mb-3">الكشف عن الأجسام المضادة للفيروسات الكبدية.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">450.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/0dcaf0/333333?text=PCR" class="img-fluid rounded-start-4 test-image" alt="PCR">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">اختبار تفاعل البوليميراز المتسلسل (PCR)</h5>
                                                    <p class="card-text small text-muted mb-3">للكشف عن العدوى الفيروسية النشطة (مثل كورونا).</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">300.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingWomenChild">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWomenChild" aria-expanded="false" aria-controls="collapseWomenChild">
                            <i class="bi bi-mother me-3"></i> 👩‍👧 تحاليل صحة المرأة والطفل
                        </button>
                    </h3>
                    <div id="collapseWomenChild" class="accordion-collapse collapse" aria-labelledby="headingWomenChild" data-bs-parent="#testsAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/e83e8c/ffffff?text=HCG" class="img-fluid rounded-start-4 test-image" alt="فحص الحمل">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">اختبار الحمل الرقمي (HCG)</h5>
                                                    <p class="card-text small text-muted mb-3">تأكيد الحمل وتحديد مستواه (كمي).</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">100.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/ff8c00/ffffff?text=Stool" class="img-fluid rounded-start-4 test-image" alt="تحليل براز">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">تحليل البراز للأطفال</h5>
                                                    <p class="card-text small text-muted mb-3">للكشف عن الطفيليات والعدوى المعوية.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">80.00 ر.س</span>
                                                        <button class="btn btn-sm btn-outline-primary rounded-pill">إضافة للسلة</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                <h2 class="text-center fw-bold mb-5 section-header" style="margin-top: 50px;">
                <i class="bi bi-gear-wide-connected me-2"></i>  الأجهزة الطبية والتصوير
            </h2>

            <div class="accordion accordion-flush" id="devicesAccordion">

                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingImaging">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseImaging" aria-expanded="false" aria-controls="collapseImaging">
                            <i class="bi bi-x-ray me-3"></i> ☢️ التصوير الإشعاعي والمقطعي
                        </button>
                    </h3>
                    <div id="collapseImaging" class="accordion-collapse collapse" aria-labelledby="headingImaging" data-bs-parent="#devicesAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/00bcd4/ffffff?text=MRI" class="img-fluid rounded-start-4 test-image" alt="جهاز الرنين المغناطيسي">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">الرنين المغناطيسي (MRI)</h5>
                                                    <p class="card-text small text-muted mb-3">تصوير تفصيلي للأنسجة الرخوة والأعصاب دون إشعاع مؤين.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">1200.00 ر.س</span>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/ff4081/ffffff?text=X-Ray" class="img-fluid rounded-start-4 test-image" alt="جهاز الأشعة السينية">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">الأشعة السينية (X-Ray)</h5>
                                                    <p class="card-text small text-muted mb-3">تصوير سريع الهياكل العظمية والرئتين.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">80.00 ر.س</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/795548/ffffff?text=CT" class="img-fluid rounded-start-4 test-image" alt="الأشعة المقطعية">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">الأشعة المقطعية (CT Scan)</h5>
                                                    <p class="card-text small text-muted mb-3">تصوير مقطعي تفصيلي للأعضاء الداخلية والأوعية الدموية.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">650.00 ر.س</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item test-category-item rounded-3 shadow-sm mb-3">
                    <h3 class="accordion-header" id="headingUltrasound">
                        <button class="accordion-button fw-bold fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUltrasound" aria-expanded="false" aria-controls="collapseUltrasound">
                            <i class="bi bi-soundwave me-3"></i> 🔊 الموجات فوق الصوتية والإيكو
                        </button>
                    </h3>
                    <div id="collapseUltrasound" class="accordion-collapse collapse" aria-labelledby="headingUltrasound" data-bs-parent="#devicesAccordion">
                        <div class="accordion-body">
                             <div class="row g-4">

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/9c27b0/ffffff?text=Ultrasound" class="img-fluid rounded-start-4 test-image" alt="الموجات فوق الصوتية">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">جهاز الموجات فوق الصوتية</h5>
                                                    <p class="card-text small text-muted mb-3">تصوير الأعضاء الداخلية وتصوير الحمل دون إشعاع.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">250.00 ر.س</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="card test-card h-100 rounded-4 shadow-sm border-0">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-4 test-image-col">
                                                <img src="https://via.placeholder.com/150x150/e91e63/ffffff?text=ECHO" class="img-fluid rounded-start-4 test-image" alt="تخطيط صدى القلب">
                                            </div>
                                            <div class="col-8">
                                                <div class="card-body p-3">
                                                    <h5 class="card-title fw-bold text-primary">تخطيط صدى القلب (ECHO)</h5>
                                                    <p class="card-text small text-muted mb-3">تصوير مفصل لوظائف القلب وصماماته.</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span class="price-tag fw-bold fs-6">400.00 ر.س</span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
            </div>
        </div>

    </section>
    @endsection
