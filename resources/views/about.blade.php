@extends('layouts.app')
@section('content')

<section class="about-hero-section py-5 text-center bg-light">
    <div class="container">
        <h2 class="hero-title">About Venice Hospital</h2>
       <p class="hero-description">
            Venice Hospital has been a pioneer in healthcare since 1985. Our facility in Benghazi offers state-of-the-art medical services in a patient-friendly environment.
        </p>
    </div>
</section>
<section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="intro-section">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="fade-up" data-aos-delay="100">
                    <h2>Excellence in Healthcare Since 1985</h2>
                    <p class="lead">We believe that exceptional medical care begins with understanding. Our dedicated team of professionals combines cutting-edge technology with compassionate, personalized treatment to ensure every patient receives the highest standard of care.</p>
                </div>
            </div>
        </div>

        <div class="image-stats-section">
            <div class="row align-items-center">
                <div class="col-lg-7" data-aos="fade-right" data-aos-delay="200">
                    <div class="image-gallery">
                        <div class="main-image-container">
                            <img src="image/photo_2025-11-08_14-10-00.jpg" class="img-fluid main-image" alt="Medical facility">
                        </div>
                        <div class="secondary-images">
                            <img src="image/photo_2025-11-07_19-13-48.jpg" class="img-fluid secondary-image" alt="Medical team">
                            <img src="image/photo_2025-11-07_19-13-48.jpg" class="img-fluid secondary-image" alt="Patient consultation">
                        </div>
                    </div>
                </div>

                <div class="col-lg-5" data-aos="fade-left" data-aos-delay="300">
                    <div class="stats-content">
                        <h3>Trusted Healthcare Provider</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                        <div class="stats-list">
                            <div class="stat-row">
                                <div class="stat-number">
                                    <span class="purecounter">22000</span>
                                </div>
                                <div class="stat-info">
                                    <h5>Successful Treatments</h5>
                                    <p>Completed with excellent patient outcomes</p>
                                </div>
                            </div>

                            <div class="stat-row">
                                <div class="stat-number">
                                    <span class="purecounter">95</span>%
                                </div>
                                <div class="stat-info">
                                    <h5>Patient Satisfaction</h5>
                                    <p>Based on comprehensive feedback surveys</p>
                                </div>
                            </div>

                            <div class="stat-row">
                                <div class="stat-number">
                                    <span class="purecounter">85</span>
                                </div>
                                <div class="stat-info">
                                    <h5>Medical Professionals</h5>
                                    <p>Specialists across various departments</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mission-section" data-aos="fade-up" data-aos-delay="400">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h4>Our Mission</h4>
                        <p>To provide comprehensive, patient-centered healthcare that combines medical excellence with genuine compassion.</p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h4>Our Vision</h4>
                        <p>To be the leading healthcare provider in our region, recognized for innovative treatments and exceptional outcomes.</p>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="mission-item">
                        <div class="mission-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <h4>Our Promise</h4>
                        <p>Every patient will receive the highest quality care in a comfortable, supportive environment.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="specialties-section" data-aos="fade-up" data-aos-delay="500">
            <div class="row text-center">
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="specialty-item"><i class="bi bi-activity"></i><span>Cardiology</span></div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                    <div class="specialty-item"><i class="bi bi-brain"></i><span>Neurology</span></div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="specialty-item"><i class="bi bi-person-hearts"></i><span>Pediatrics</span></div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                    <div class="specialty-item"><i class="bi bi-scissors"></i><span>Surgery</span></div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="specialty-item"><i class="bi bi-file-medical"></i><span>Oncology</span></div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                    <div class="specialty-item"><i class="bi bi-clipboard2-pulse"></i><span>Emergency</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
