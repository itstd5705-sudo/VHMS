@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Medications</h2>
        <a href="{{ route('medication.create') }}" class="btn btn-success">
            + Add New Medication
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($medications as $medication)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $medication->name }}</td>
                        <td>{{ $medication->Category->name ?? '-' }}</td>
                        <td>${{ number_format($medication->price, 2) }}</td>
                        <td>{{ $medication->stockQuantity }}</td>
                        <td>
                            <a href="{{ route('medication.show', $medication) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('medication.edit', $medication) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('medication.destroy', $medication) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-muted py-3">No medications found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
