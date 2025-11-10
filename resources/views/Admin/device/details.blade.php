@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Device Details</h2>
    <div class="card p-3">
        <p><strong>Name:</strong> {{ $device->name }}</p>
        <p><strong>Description:</strong> {{ $device->description}}</p>
        <p><strong>د.ل Price:</strong> {{ $device->price }}</p>
        <a href="{{ route('Admin.Device.index') }}" class="btn btn-secondary mt-2">Back</a>
    </div>
</div>
@endsection
