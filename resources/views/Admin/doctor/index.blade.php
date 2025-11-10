@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Doctors</h2>
        <a href="{{ route('Admin.doctor.create') }}" class="btn btn-success">
            + Add New Doctor
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
                        <th>Full Name</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $doctor->fullName }}</td>
                            <td>{{ $doctor->Department->name ?? '-' }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>
                                <a href="{{ route('Admin.doctor.show', $doctor) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('Admin.doctor.edit', $doctor) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('Admin.doctor.destroy', $doctor) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this doctor?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted py-3">No doctors found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
