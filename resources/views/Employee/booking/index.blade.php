@extends('layouts.employeeApp')
@section('content')
<div class="container mt-4">
    <h2>Bookings</h2>
    <a href="{{ route('Employee.booking.create') }}" class="btn btn-success mb-3">Add New Booking</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Gender</th>
                <th>Year of Birth</th>
                <th>Status</th>
                <th>Phone</th>
                <th>User</th>
                <th>Appointment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $booking->userName }}</td>
                <td>{{ ucfirst($booking->gender) }}</td>
                <td>{{ $booking->yearOfBirth }}</td>
                <td>
                    @php
                        $statusColors = [
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'cancelled' => 'secondary'
                        ];
                    @endphp
                    <span class="badge bg-{{ $statusColors[$booking->status] ?? 'light' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </td>
                <td>{{ $booking->phone ?? '-' }}</td>
                <td>{{ $booking->User->userName ?? '-' }}</td>
                <td>{{ $booking->Appointment->id ?? '-' }}</td>
                <td>
                    <a href="{{ route('Employee.booking.show', $booking->id) }}" class="btn btn-warning btn-sm">view</a>
                    <a href="{{ route('Employee.booking.edit', $booking->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('Employee.booking.destroy', $booking->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this booking?');">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="9">No bookings found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
