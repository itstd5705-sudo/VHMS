@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2>Medication Details</h2>
    <div class="card">
        <p><strong>Name:</strong> {{ $medication->name }}</p>
        <p><strong>Barcode:</strong> {{ $medication->parcode }}</p>
        <p><strong>Category:</strong> {{ $medication->Category->name ?? '-' }}</p>
        <p><strong>د.ل price:</strong> {{ $medication->price }}</p>
        <p><strong>Stock Quantity:</strong> {{ $medication->stockQuantity }}</p>
        @if($medication->imgUrl)
            <p><strong>Image:</strong><br><img src="{{ $medication->imgUrl }}" width="120" class="rounded border border-2"></p>
        @endif
        <hr>
        <a href="{{ route('medication.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
