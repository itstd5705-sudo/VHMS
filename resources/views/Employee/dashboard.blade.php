@include('layouts.employeeApp')
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>لوحة تحكم الموظف</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <style>
    body { background-color: #f8f9fa; }
    .card { border-radius: 12px; }
    .section-title { font-weight: bold; margin-top: 30px; margin-bottom: 15px; }
  </style>
</head>
<body>
<div class="container mt-5 pt-3">
  <!-- الإحصائيات -->
  <div class="row">
    <div class="col-md-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5>الحجوزات المعلقة</h5>
          <h3 class="text-warning">{{ $pendingBookings }}</h3>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h5>إجمالي المرضى</h5>
          <h3 class="text-primary">{{ $totalPatients }}</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- أحدث الحجوزات -->
  <div class="section-title">📋 أحدث الحجوزات</div>
  <table class="table table-striped shadow-sm">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>اسم المريض</th>
        <th>رقم الهاتف</th>
        <th>الحالة</th>
        <th>تاريخ الإنشاء</th>
      </tr>
    </thead>
    <tbody>
      @forelse($recentBookings as $booking)
      <tr>
        <td>{{ $booking->id }}</td>
        <td>{{ $booking->userName }}</td>
        <td>{{ $booking->phone }}</td>
        <td>
          @if($booking->status == 'pending')
            <span class="badge bg-warning text-dark">معلق</span>
          @elseif($booking->status == 'approved')
            <span class="badge bg-success">مقبول</span>
          @else
            <span class="badge bg-danger">مرفوض</span>
          @endif
        </td>
        <td>{{ $booking->created_at->format('d-m-Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="5" class="text-center text-muted">لا توجد حجوزات حديثة</td></tr>
      @endforelse
    </tbody>
  </table>

</div>

</body>
</html>
