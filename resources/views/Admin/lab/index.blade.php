@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Labs</h2>
        <a href="{{ route('Admin.lab.create') }}" class="btn btn-success">
            + Add New Lab
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped table-hover text-center mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($labs as $lab)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $lab->name }}</td>
                            <td>${{ number_format($lab->price, 2) }}</td>
                            <td>
                                <a href="{{ route('Admin.lab.show', $lab) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('Admin.lab.edit', $lab) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('Admin.lab.destroy', $lab) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this lab?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">No labs found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
