@extends('layouts.siderbar')
@section('content')
<div class="container-fluid p-0">
    <h2><i class="bi bi-speedometer2 me-2"></i> Dashboard</h2>
    @php
        $cards =
        [
            ['name'=>'Departments','count'=>$DepartmentsCount,'route'=>route('department.index'),'color'=>'#0d6efd','text'=>'white'],
            ['name'=>'Doctors','count'=>$DoctorsCount,'route'=>route('Admin.doctor.index'),'color'=>'#198754','text'=>'white'],
            ['name'=>'Employees','count'=>$EmployeesCount,'route'=>route('employee.index'),'color'=>'#ffc107','text'=>'dark'],
            ['name'=>'Categories','count'=>$CategoriesCount,'route'=>route('category.index'),'color'=>'#0dcaf0','text'=>'dark'],
            ['name'=>'Medications','count'=>$MedicationsCount,'route'=>route('medication.index'),'color'=>'#6c757d','text'=>'white'],
            ['name'=>'Bookings','count'=>$BookingsCount,'route'=>route('Admin.booking.index'),'color'=>'#dc3545','text'=>'white'],
            ['name'=>'Appointments','count'=>$AppointmentsCount,'route'=>route('appointment.index'),'color'=>'#6f42c1','text'=>'white'],
            ['name'=>'Labs','count'=>$labCount,'route'=>route('Admin.lab.index'),'color'=>'#6610f2','text'=>'white'],
            ['name'=>'Tests','count'=>$TestCount,'route'=>route('Admin.Test.index'),'color'=>'#fd7e14','text'=>'white'],
            ['name'=>'Devices','count'=>$DeviceCount,'route'=>route('Admin.Device.index'),'color'=>'#20c997','text'=>'white'],
        ];
    @endphp

    <div class="row g-4 mt-3">
        @foreach($cards as $card)
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="p-4 rounded shadow" style="background-color: {{ $card['color'] }}; color: {{ $card['text'] }};">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5>{{ $card['name'] }}</h5>
                        <div class="fs-3 fw-bold">{{ $card['count'] ?? 0 }}</div>
                    </div>
                    <i class="bi bi-graph-up fs-1"></i>
                </div>
                <a href="{{ $card['route'] }}" class="btn btn-light mt-3 text-dark w-100">View Details</a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Appointments Status Pie Chart --}}
    <div class="mt-5">
        <h3 class="mb-3">Completed vs Canceled Appointments</h3>
        <canvas id="statusPieChart" height="120"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const pieCtx = document.getElementById('statusPieChart').getContext('2d');
const statusPieChart = new Chart(pieCtx, {
    type: 'doughnut',
    data: {
        labels: ['Completed', 'Canceled'],
        datasets: [{
            data: [{{ $completedCount ?? 0 }}, {{ $canceledCount ?? 0 }}],
            backgroundColor: ['#198754', '#dc3545']
        }]
    },
    options: { responsive: true }
});
</script>

{{-- Dashboard Bar Chart --}}
<div class="mt-5">
    <h3 class="mb-3">System Statistics</h3>
    <canvas id="dashboardChart" height="120"></canvas>
</div>

<script>
const ctx = document.getElementById('dashboardChart').getContext('2d');
const cardColors = @json(array_column($cards, 'color'));
const labels = @json(array_column($cards, 'name'));
const counts = @json(array_column($cards, 'count'));

const dashboardChart = new Chart(ctx,
{
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Count',
            data: counts,
            backgroundColor: cardColors,
            borderColor: '#fff',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: { display: true, text: 'Dashboard Statistics' }
        },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        }
    }
});
</script>
@endsection
