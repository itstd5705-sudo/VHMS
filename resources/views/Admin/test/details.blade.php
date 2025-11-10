@extends('layouts.siderbar')

@section('content')
<div class="container mt-5">
    <h2>Test Details</h2>
    <div class="card p-3">
        <p><strong>Name:</strong> {{ $test->name }}</p>
        <p><strong>Description:</strong> {{ $test->description ?? 'No description' }}</p>
        <p><strong>Price:</strong> ${{ number_format($test->price, 2) }}</p>
        <a href="{{ route('Admin.Test.index') }}" class="btn btn-secondary mt-2">Back</a>
    </div>
</div>
@endsection
