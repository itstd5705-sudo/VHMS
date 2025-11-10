@extends('layouts.siderbar')

@section('content')
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">Laboratory Tests</h2>
        <a href="{{ route('Admin.Test.create') }}" class="btn btn-success">
            + Add New Test
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
                        <th>Test Name</th>
                        <th>Price</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($tests as $test)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $test->name }}</td>
                        <td>${{ number_format($test->price, 2) }}</td>
                        <td>
                            <a href="{{ route('Admin.Test.show', $test) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('Admin.Test.edit', $test) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('Admin.Test.destroy', $test) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this test?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted py-3">No tests found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
