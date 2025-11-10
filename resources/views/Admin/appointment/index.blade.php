@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Appointments</h2>
        <a href="{{ route('appointment.create') }}" class="btn btn-success">
            + Add New Appointment
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Available</th>
                        <th>Status</th>
                        <th width="220px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $appointment->Doctor->fullName ?? '-' }}</td>
                            <td>{{ $appointment->day }}</td>
                            <td>{{ $appointment->time }}</td>
                            <td>{{ $appointment->availableSchedule ? 'Yes' : 'No' }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td>
                                <a href="{{ route('appointment.show', $appointment) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('appointment.edit', $appointment) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('appointment.destroy', $appointment) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this appointment?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted py-3">No appointments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
