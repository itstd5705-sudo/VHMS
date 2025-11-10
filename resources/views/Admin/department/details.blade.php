@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Department Details</h2>
    <div class="card">
        <p><strong>Name:</strong> {{ $department->name }}</p>
        <p><strong>Location:</strong> {{ $department->location }}</p>
        @if($department->imgUrl)
            <p><strong>Image:</strong><br><img src="{{ $department->imgUrl }}" width="120" class="rounded border border-2"></p>
        @endif
        <p><strong>Description:</strong> {{ $department->description }}</p>
        <hr>
        <a href="{{ route('department.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
