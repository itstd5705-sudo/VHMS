@extends('layouts.employeeApp')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    {{-- *** CARDS *** --}}
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    الحجوزات المعلقة: {{ $pendingBookings }}
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="{{ route('Employee.booking') }}">عرض</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    إجمالي المرضى: {{ $totalPatients }}
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="#">عرض</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    إجمالي الحجوزات: {{ $recentBookings->count() }}
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="small text-white stretched-link" href="{{ route('public.bookings.index') }}">عرض</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

    </div>


    {{-- *** CHARTS *** --}}
    <div class="row">

        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    الحجوزات لكل شهر
                </div>
                <div class="card-body">
                    <canvas id="bookingsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    المرضى الجدد لكل شهر
                </div>
                <div class="card-body">
                    <canvas id="patientsChart"></canvas>
                </div>
            </div>
        </div>

    </div>


    {{-- *** RECENT BOOKINGS TABLE *** --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            أحدث الحجوزات
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>المريض</th>
                        <th>الدكتور</th>
                        <th>التاريخ</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentBookings as $booking)
                    <tr>
                        <td>{{ $booking->user->fullName ?? 'غير معروف' }}</td>
                        <td>{{ $booking->doctor->fullName ?? 'غير معروف' }}</td>
                        <td>{{ $booking->created_at->format('Y-m-d') }}</td>
                        <td>{{ $booking->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection



@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

{{-- تحويل البيانات من Laravel لجافاسكريبت --}}
<script>
    const bookingsData = @json(array_values($bookingsPerMonth->toArray()));
    const bookingsLabels = @json(array_keys($bookingsPerMonth->toArray()));

    const patientsData = @json(array_values($patientsPerMonth->toArray()));
    const patientsLabels = @json(array_keys($patientsPerMonth->toArray()));
</script>


{{-- *** BOOKINGS CHART *** --}}
<script>
    new Chart(document.getElementById("bookingsChart"), {
        type: 'line',
        data: {
            labels: bookingsLabels.map(m => "شهر " + m),
            datasets: [{
                label: "عدد الحجوزات",
                data: bookingsData,
                borderWidth: 2,
                fill: true
            }]
        }
    });
</script>


{{-- *** PATIENTS CHART *** --}}
<script>
    new Chart(document.getElementById("patientsChart"), {
        type: 'bar',
        data: {
            labels: patientsLabels.map(m => "شهر " + m),
            datasets: [{
                label: "عدد المرضى الجدد",
                data: patientsData,
                borderWidth: 2,
            }]
        }
    });
</script>

@endsection
