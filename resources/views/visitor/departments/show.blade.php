@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>{{ $department->name }}</h2>
            <p><i class="bi bi-geo-alt"></i> {{ $department->location }}</p>
            <p>{{ $department->description }}</p>
            <a href="{{ route('departments.index') }}" class="btn btn-outline-secondary">Back to Departments</a>
        </div>
    </div>
</div>
@endsection
