@extends('layouts.app')

@section('content')
<section class="doctors-listing py-5" style="margin-top: 80px;">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Certified Specialists</h2>

        <!-- بحث -->
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-8 col-md-10">
                <form action="{{ route('doctor.index') }}" method="GET">
                    <div class="input-group search-bar-custom shadow-sm rounded-pill">
                        <input type="text" class="form-control form-control-lg border-0 ps-4"
                               placeholder="Search by Doctor Name or Specialty..." name="query"
                               value="{{ $query }}">
                        <button class="btn btn-primary rounded-pill px-4" type="submit">
                            <i class="bi bi-search me-2"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @forelse($doctors as $doctor)
        <div class="row mb-5">
            <div class="col-12">
                <div class="card shadow-lg p-4 rounded-4 profile-card">
                    <div class="row g-4">

                        <!-- بيانات الطبيب -->
                        <div class="col-lg-4 text-center">
                            <h3 class="fw-bold">{{ $doctor->fullName }}</h3>
                            <h5 class="text-muted">{{ $doctor->specialty }}</h5>
                        </div>

                        <!-- مواعيد الطبيب -->
                        <div class="col-lg-8">
                            <h4 class="mb-3 fw-bold">Appointments</h4>
                            @if($doctor->appointments->count())
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($doctor->appointments as $appointment)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</td>
                                                <td>{{ $appointment->time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No appointments available.</p>
                            @endif

                            <!-- زر الحجز -->
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#bookingModal-{{ $doctor->id }}">
                                <i class="bi bi-calendar-check me-2"></i> Book Appointment
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p class="text-center">No doctors found.</p>
        @endforelse

    </div>
</section>
@endsection
