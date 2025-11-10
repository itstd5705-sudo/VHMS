@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Lab Details</h2>
    <div class="card p-3">
        <p><strong>Name:</strong> {{ $lab->name }}</p>
        <p><strong>Description:</strong> {{ $lab->description ?? 'No description' }}</p>
        <p><strong>د.ل Price:</strong> {{ $lab->price }}</p>
        <a href="{{ route('Admin.lab.index') }}" class="btn btn-secondary mt-2">Back</a>
    </div>
</div>
@endsection
