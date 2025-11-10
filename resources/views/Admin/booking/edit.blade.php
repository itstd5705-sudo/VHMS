@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('Admin.booking.update', $booking->id) }}" method="POST" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullName" value="{{ $booking->fullName }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="male" @if($booking->gender=='male') selected @endif>Male</option>
                <option value="female" @if($booking->gender=='female') selected @endif>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Year of Birth</label>
            <input type="number" name="yearOfBirth" value="{{ $booking->yearOfBirth }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" @if($booking->status=='pending') selected @endif>Pending</option>
                <option value="approved" @if($booking->status=='approved') selected @endif>Approved</option>
                <option value="rejected" @if($booking->status=='rejected') selected @endif>Rejected</option>
                <option value="cancelled" @if($booking->status=='cancelled') selected @endif>Cancelled</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phoneUser" value="{{ $booking->User->phone ?? '' }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Note</label>
            <textarea name="note" class="form-control" rows="3">{{ $booking->note }}</textarea>
        </div>

        <div class="text-center">
            <button class="btn btn-warning">Update</button>
            <a href="{{ route('Admin.booking.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
