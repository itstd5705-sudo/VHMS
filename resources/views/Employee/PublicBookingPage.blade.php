@extends('layouts.employeeApp') {{-- استخدم الـ layout المناسب لصفحتك العامة --}}

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Confirmed Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Doctor Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr class="text-center">
                    {{-- رقم تسلسلي --}}
                    <td>{{ $loop->iteration }}</td>

                    {{-- اسم المستخدم بالكامل --}}
                    <td>{{ $booking->userName }}</td>

                    {{-- تاريخ ووقت الموعد --}}
                    <td>{{ $booking->Appointment->date ?? 'N/A' }}</td>
                    <td>{{ $booking->Appointment->time ?? 'N/A' }}</td>

                    {{-- اسم الطبيب --}}
                    <td>{{ $booking->Appointment->Doctor->fullName ?? 'Unknown Doctor' }}</td>

                    {{-- الحالة --}}
                    <td>
                        <span class="badge bg-success">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="6">No confirmed bookings found at this time.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
