@extends('layouts.employeeApp')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">إدارة الحجوزات المعلقة</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="table-primary text-center">
            <tr>
                <th>#</th>
                <th>اسم المستخدم</th>
                <th>الهاتف</th>
                <th>الملاحظات</th>
                <th>الدكتور / الموعد</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->userName }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->note ?? '-' }}</td>
                    <td>
                        {{ $booking->Appointment->Doctor->fullName ?? 'غير محدد' }}<br>
                        {{ $booking->Appointment->date ?? '-' }} {{ $booking->Appointment->time ?? '' }}
                    </td>
                    <td class="status">
                        @if($booking->status == 'pending')
                            <span class="badge bg-warning text-dark">معلق</span>
                        @elseif($booking->status == 'approved')
                            <span class="badge bg-success">مقبول</span>
                        @else
                            <span class="badge bg-danger">مرفوض</span>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ route('employee.bookings.approve', $booking->id) }}" style="display:inline;">
                            @csrf
                            <button class="btn btn-success btn-sm">موافقة ✅</button>
                        </form>
                        <form method="POST" action="{{ route('employee.bookings.reject', $booking->id) }}" style="display:inline;">
                            @csrf
                            <button class="btn btn-danger btn-sm">رفض ❌</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted">لا توجد حجوزات معلقة حاليا</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
