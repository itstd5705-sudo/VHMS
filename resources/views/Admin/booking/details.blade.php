@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Booking Details</h2>
    <div class="card">
        <p><strong>Full Name:</strong> {{ $booking->fullName }}</p>
        <p><strong>Phone:</strong> {{ $booking->phoneUser }}</p>
        <p><strong>Gender:</strong> {{ $booking->gender }}</p>
        <p><strong>Year of Birth:</strong> {{ $booking->yearOfBirth }}</p>
        <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
        <p><strong>Appointment:</strong> {{ $booking->Appointment->name ?? '-' }}</p>
        <p><strong>User:</strong> {{ $booking->User->name ?? '-' }}</p>
        <p><strong>Note:</strong> {{ $booking->note ?? '-' }}</p>
        <hr>
        <a href="{{ route('Admin.booking.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
