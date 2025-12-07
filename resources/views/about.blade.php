@extends('layouts.app')
@section('content')

<section class="mission-vision-section">
    <div class="container">
        <div class="vision-box">
            <i class="fa-solid fa-eye"></i>
            <h3>Our Vision</h3>
            <p>To be the leading global health center, recognized for exceptional patient care, innovative research, and commitment to community wellness.</p>
        </div>
        <div class="mission-box">
            <i class="fa-solid fa-bullseye"></i>
            <h3>Our Mission</h3>
            <p>Providing compassionate, personalized, and high-quality medical services using state-of-the-art technology to achieve the best health outcomes for every patient.</p>
        </div>
    </div>
</section>

<section class="main-content-area">
    <div class="container">
        <div class="doctor-image-container">
            <img src="{{ asset('image/photo_2025-11-08_14-10-00.jpg') }}" alt="صورة">
        </div>

        <div class="features-wrapper">
            <div class="header-content">
                <h3>What Makes Us Different</h3>
                <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of the moment.</p>
            </div>

            <div class="features-list">
                <div class="feature-row">
                    <div class="feature-col left-feature">
                        <i class="fa-solid fa-user-doctor"></i>
                        <h3>
                            FREE
                            <br>
                            CONSULTATION
                        </h3>
                    </div>
                    <div class="feature-col right-feature">
                        <i class="fa-solid fa-credit-card"></i>
                        <h3>
                            AFFORDABLE
                            <br>
                            PRICES
                        </h3>
                    </div>
                </div>
                <div class="feature-row">
                    <div class="feature-col left-feature">
                        <i class="fa-solid fa-user-group"></i>
                        <h3>
                            QUALIFIED
                            <br>
                            DOCTORS
                        </h3>
                    </div>
                    <div class="feature-col right-feature">
                        <i class="fa-solid fa-laptop-medical"></i>
                        <h3>
                            PROFESSIONAL
                            <br>
                            STAFF
                        </h3>
                    </div>
                </div>
                <div class="feature-row last-row">
                    <div class="feature-col left-feature">
                        <i class="fa-solid fa-clock"></i>
                        <h3>
                            24/7
                            <br>
                            OPENED
                        </h3>
                    </div>
                    <div class="feature-col right-feature">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <h3>
                            ~50000
                            <br>
                            HAPPY CLIENTS
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="stat-item">
            <i class="fa-solid fa-hospital"></i>
            <span class="stat-number">25+</span>
            <p class="stat-label">Years of Experience</p>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-user-tie"></i>
            <span class="stat-number">150</span>
            <p class="stat-label">Qualified Doctors</p>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-bed"></i>
            <span class="stat-number">400</span>
            <p class="stat-label">Available Beds</p>
        </div>
        <div class="stat-item">
            <i class="fa-solid fa-award"></i>
            <span class="stat-number">98%</span>
            <p class="stat-label">Patient Satisfaction</p>
        </div>
    </div>
</section>

<section class="testimonial-section">
    <div class="background-overlay">
        <div class="container text-center">
            <h2 class="section-title">What patients say About Valeo</h2>
            <div class="testimonial-slider-item">
                <blockquote class="patient-quote">
                    "The Cancer team at Valeo are nothing short of miracle workers - they were able to help me overcome my Leukemia in just 6 months"
                </blockquote>
                <p class="patient-info">
                    CHRISTINE BLAINE, BLOOD PATIENT
                </p>
            </div>
            <div class="slider-indicators">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
</section>

@endsection
