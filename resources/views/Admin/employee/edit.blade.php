@extends('layouts.siderbar')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Edit Employee</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">الاسم الكامل</label>
            <input type="text" name="fullName" value="{{ $employee->fullName }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ $employee->email }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رقم الهاتف</label>
            <input type="text" name="phone" value="{{ $employee->phone }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">كلمة المرور</label>
            <input type="password" name="password" value="{{ $employee->password }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الصورة الحالية</label><br>
            @if($employee->imgUrl)
                <img src="{{ $employee->imgUrl }}" width="80" class="rounded mb-2">
            @else
                <p class="text-muted">لا توجد صورة</p>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="text-center">
            <button class="btn btn-warning">تحديث</button>
            <a href="{{ route('employee.index') }}" class="btn btn-secondary">رجوع</a>
        </div>
    </form>
</div>
@endsection
