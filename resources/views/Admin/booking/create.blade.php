@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Add New Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('Admin.booking.store') }}" method="POST" class="p-4 shadow rounded bg-light">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="userName" class="form-control" value="{{ old('userName') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                    <option value="">-- Select Gender --</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Year of Birth</label>
                <input type="number" name="yearOfBirth" class="form-control" value="{{ old('yearOfBirth') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Appointment</label>
                <select name="appointmentId" class="form-select" required>
                    <option value="">-- Select Appointment --</option>
                    @foreach ($appointments as $appointment)
                        <option value="{{ $appointment->id }}">
                            {{ $appointment->Doctor->fullName ?? 'Unknown Doctor' }} —
                            {{ $appointment->date ?? 'N/A' }} —
                            {{ $appointment->time ?? '' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Note</label>
                <textarea name="note" class="form-control" rows="3">{{ old('note') }}</textarea>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('Admin.booking.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
