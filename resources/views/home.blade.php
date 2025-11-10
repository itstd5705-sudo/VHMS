@extends('layouts.app')
@section('content')
<section class="medinest-hero-section py-5">
    <div class="container">
        <div class="row g-5 align-items-center ">
            <div class="col-lg-5 position-relative ">
                <div class="medinest-hero-image-wrapper rounded-4 shadow-lg overflow-hidden">
                    <img src="{{ asset('image/photo_2025-11-08_14-09-59.jpg') }}" class="img-fluid" alt="طبيب MediNest">

                    <div class="medinest-emergency-card rounded-3 shadow-lg p-3">
                        <i class="bi bi-telephone-fill me-2"></i>
                        <span class="medinest-emergency-text">24/7 Emergency</span>
                        <h5 class="medinest-emergency-phone">+1 (555) 911-2468</h5>
                    </div>

                    <div class="medinest-stats-overlay d-flex justify-content-around p-3">
                        <div class="text-center">
                            <h4 class="medinest-stat-number">25K+</h4>
                            <p class="medinest-stat-label mb-0">Patients Treated</p>
                        </div>
                        <div class="text-center">
                            <h4 class="medinest-stat-number">98%</h4>
                            <p class="medinest-stat-label mb-0">Satisfaction Rate</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 ">
                <div class="medinest-hero-content ps-lg-4">
                    <span class="medinest-trusted-badge mb-3 d-inline-block">TRUSTED HEALTHCARE PROVIDER</span>
                    <h1 class="medinest-main-title mb-4">
                        Excellence in Medical Care <br><span class="highlight">Since 1985</span>
                    </h1>
                    <p class="medinest-description mb-4">
                        Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
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
                                <h5 class="medinest-feature-value mb-0">12 Clinic</h5>
                                <p class="medinest-feature-label mb-0">Locations</p>
                            </div>
                        </div>
                    </div>
                    <div class="medinest-cta-buttons d-flex flex-wrap gap-3">
                        <a href="#" class="btn btn-primary medinest-schedule-btn">Schedule Consultation</a>
                        <a href="#" class="btn btn-outline-secondary medinest-watch-btn"><i class="bi bi-play-circle me-2"></i> Watch Our Story</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="medinest-excellence-section container my-5 py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="medinest-excellence-title mb-3">Excellence in Healthcare Since 1985</h2>
            <p class="medinest-excellence-description mx-auto">
            We are committed to providing world-class medical care through innovation, compassion, and unwavering dedication to our patients' wellbeing and recovery
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
                            <img src="{{ asset('image/photo_2025-11-08_14-10-03.jpg') }}" alt="JCI Accredited" class="img-fluid">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-3 px-3 py-2 fs-6">JCI Accredited</span>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="image-box overflow-hidden">
                            <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" alt="Doctor patient discussion" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="image-box overflow-hidden">
                            <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" alt="Surgery team" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="100">
                <div class="feature-box mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-heart-fill fs-4 icon me-3"></i>
                        <h3 class="h4 fw-bold mb-0">Patient-Centered Approach</h3>
                    </div>
                    <p class="text-muted mb-0">
                        Every treatment plan is carefully customized to meet individual patient needs and medical history to ensure the best outcome.
                    </p>
                </div>
                <ul class="list-unstyled mb-4 feature-list">
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">Advanced diagnostic technology and imaging</h4>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">Board-certified physicians and specialists</h4>
                        </div>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-up" data-aos-delay="500">
                        <i class="bi bi-check-circle-fill me-2 mt-1"></i>
                        <div>
                            <h4 class="h6 fw-bold mb-0">24/7 emergency and critical care services</h4>
                        </div>
                    </li>
                </ul>
                <div class="row text-center mb-4 stats-box">
                    <div class="col-6" data-aos="fade-up" data-aos-delay="600">
                        <h3 class="display-4 fw-bold">95%</h3>
                        <p class="text-muted">Patient Satisfaction</p>
                    </div>
                    <div class="col-6" data-aos="fade-up" data-aos-delay="700">
                        <h3 class="display-4 fw-bold">35K+</h3>
                        <p class="text-muted">Successful Treatments</p>
                    </div>
                </div>
                <div class="medinest-cta-buttons d-flex flex-column flex-md-row " data-aos="fade-up" data-aos-delay="800">
                        <a href="#" class="btn btn-primary medinest-explore-btn btn-lg me-md-3 mb-3 mb-md-0">Explore Our Services</a>
                        <a href="#" class="btn btn-outline-secondary medinest-scheudule-btn"><i class="bi bi-play-circle me-2"></i> Schedule Consultation</a>
                    </div>
            </div>
        </div>
    </div>
</section>
<section id="emergency-services" class="emergency-services py-5">
    <div class="container">
        <div class="row gx-5 align-items-center">
            <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right" data-aos-delay="100">
                <h6 class=" text-uppercase text-primary fw-bold small-heading">EMERGENCY MEDICINE</h6>
                <h3 class="display-5 fw-bold mt-2 mb-4">24/7 Emergency Care Services</h3>
                <p class="lead text-muted mb-4">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                </p>
                <ul class="list-unstyled feature-list mb-5">
                    <li class="d-flex align-items-start mb-3" data-aos="fade-right" data-aos-delay="200">
                        <i class="bi bi-check-circle-fill me-3 mt-1 feature-icon"></i>
                        <span>24/7 Emergency Response</span>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-right" data-aos-delay="300">
                        <i class="bi bi-check-circle-fill me-3 mt-1 feature-icon"></i>
                        <span>Advanced Life Support</span>
                    </li>
                    <li class="d-flex align-items-start mb-3" data-aos="fade-right" data-aos-delay="400">
                        <i class="bi bi-check-circle-fill me-3 mt-1 feature-icon"></i>
                        <span>Trauma Care Specialists</span>
                    </li>
                </ul>

                <a href="#" class="btn btn-link link-primary p-0 fw-bold" data-aos="fade-up" data-aos-delay="500">
                    Learn More
                    <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="col-lg-6 order-1 order-lg-2 image-column mb-4 mb-lg-0" data-aos="fade-left" data-aos-delay="100">
                <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" class="img-fluid rounded shadow-lg" alt="Emergency care in action">
            </div>

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
                            <i class="bi bi-baby-fill fs-3 dept-icon"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-0">Pediatrics</h4>
                    </div>
                    <p class="card-text text-muted">
                        Quaerat voluptatem ut enim ad minima veniam quis nostrum exercitationem ullam corporis suscipit laboriosam.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">10+</h5>
                            <small class="text-muted">PEDIATRICIANS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">2000+</h5>
                            <small class="text-muted">YOUNG PATIENTS</small>
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
                        <h4 class="card-title fw-bold mb-0">Ophthalmology</h4>
                    </div>
                    <p class="card-text text-muted">
                        Nisi ut aliquid ex ea commodi consequatur quis autem vel eum iure reprehenderit qui in ea voluptate velit esse.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">6+</h5>
                            <small class="text-muted">EYE DOCTORS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">800+</h5>
                            <small class="text-muted">EYE EXAMS</small>
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
                        <h4 class="card-title fw-bold mb-0">Dermatology</h4>
                    </div>
                    <p class="card-text text-muted">
                        Quam nihil molestiae consequatur vel illum qui dolorem eum fugiat quo voluptas nulla pariatur at vero eos.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">7+</h5>
                            <small class="text-muted">DERMATOLOGISTS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">600+</h5>
                            <small class="text-muted">SKIN TREATMENTS</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="dept-card p-4 rounded-3 shadow-sm border">
                    <div class="icon-header d-flex align-items-center mb-3">
                        <div class="icon-wrap me-3">
                            <i class="bi bi-baby-fill fs-3 dept-icon"></i>
                        </div>
                        <h4 class="card-title fw-bold mb-0">Pediatrics</h4>
                    </div>
                    <p class="card-text text-muted">
                        Quaerat voluptatem ut enim ad minima veniam quis nostrum exercitationem ullam corporis suscipit laboriosam.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">10+</h5>
                            <small class="text-muted">PEDIATRICIANS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">2000+</h5>
                            <small class="text-muted">YOUNG PATIENTS</small>
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
                        <h4 class="card-title fw-bold mb-0">Ophthalmology</h4>
                    </div>
                    <p class="card-text text-muted">
                        Nisi ut aliquid ex ea commodi consequatur quis autem vel eum iure reprehenderit qui in ea voluptate velit esse.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">6+</h5>
                            <small class="text-muted">EYE DOCTORS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">800+</h5>
                            <small class="text-muted">EYE EXAMS</small>
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
                        <h4 class="card-title fw-bold mb-0">Dermatology</h4>
                    </div>
                    <p class="card-text text-muted">
                        Quam nihil molestiae consequatur vel illum qui dolorem eum fugiat quo voluptas nulla pariatur at vero eos.
                    </p>
                    <div class="stats-footer mt-4 d-flex justify-content-between">
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">7+</h5>
                            <small class="text-muted">DERMATOLOGISTS</small>
                        </div>
                        <div class="stat-item text-center">
                            <h5 class="stat-number mb-0 fw-bold">600+</h5>
                            <small class="text-muted">SKIN TREATMENTS</small>
                        </div>
                    </div>
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
<section id="health-articles" class="health-articles-section py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Health News & Articles</h2>
      <p class="text-muted">Stay informed with the latest medical insights, health tips, and hospital news</p>
    </div>
    <div class="row g-4">

      <!-- مقال 1 -->
      <div class="col-md-4" data-aos="fade-up">
        <div class="card shadow-sm border-0 h-100">
          <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" class="card-img-top" alt="Article 1">
          <div class="card-body">
            <h5 class="card-title fw-bold">5 Tips for a Healthy Heart</h5>
            <p class="card-text text-muted">Learn how simple lifestyle changes can improve your heart health and prevent diseases.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <!-- مقال 2 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card shadow-sm border-0 h-100">
          <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" class="card-img-top" alt="Article 2">
          <div class="card-body">
            <h5 class="card-title fw-bold">Understanding Diabetes</h5>
            <p class="card-text text-muted">Discover the causes, symptoms, and treatments for diabetes to manage your health better.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

      <!-- مقال 3 -->
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card shadow-sm border-0 h-100">
          <img src="{{ asset('image/photo_2025-11-08_14-10-04.jpg') }}" class="card-img-top" alt="Article 3">
          <div class="card-body">
            <h5 class="card-title fw-bold">Mental Health Awareness</h5>
            <p class="card-text text-muted">Tips and strategies to maintain mental wellness and cope with stress effectively.</p>
            <a href="#" class="btn btn-outline-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>

    </div>

    <div class="text-center mt-4">
      <a href="#" class="btn btn-primary btn-lg">View All Articles</a>
    </div>
  </div>
</section>
@endsection
