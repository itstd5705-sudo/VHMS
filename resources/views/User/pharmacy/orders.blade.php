@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">طلباتي</h2>

    @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <strong>رقم الطلب:</strong> {{ $order->id }} |
                    <strong>الحالة:</strong>
                    @if($order->status == 'pending')
                        <span class="badge bg-warning text-dark">قيد الانتظار</span>
                    @elseif($order->status == 'processing')
                        <span class="badge bg-info text-dark">قيد المعالجة</span>
                    @elseif($order->status == 'completed')
                        <span class="badge bg-success">مكتمل</span>
                    @else
                        <span class="badge bg-secondary">{{ $order->status }}</span>
                    @endif
                </div>
                <div>
                    <strong>المجموع:</strong> {{ number_format($order->total, 2) }} LYD
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped shadow-sm">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>رقم الطلب</th>
            <th>الهاتف</th>
            <th>الإجمالي</th>
            <th>الحالة</th>
            <th>تاريخ الطلب</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $order->id }}</td>
            <td>{{ $order->phoneNumber }}</td>
            <td>{{ $order->total }} د.ل</td>
            <!-- هنا حالة الطلب -->
            <td>
                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark">معلق</span>
                @elseif($order->status == 'approved')
                    <span class="badge bg-success">تم قبول الطلب</span>
                @else
                    <span class="badge bg-danger">مرفوض</span>
                @endif
            </td>
            <td>{{ $order->created_at->format('d-m-Y') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">لا توجد طلبات</td>
        </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>
        @endforeach
    @else
        <p class="text-center fs-5">لا توجد طلبات سابقة</p>
        <div class="text-center mt-3">
            <a href="{{ route('pharmacy.index') }}" class="btn btn-primary">العودة للفئات</a>
        </div>
    @endif
</div>
@endsection
