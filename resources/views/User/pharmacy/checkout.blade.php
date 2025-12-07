@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">تأكيد بيانات الاستلام والدفع</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="mb-3 text-end">
      <strong>رصيدك في المحفظة:
        <span class="text-success">{{ number_format($user->balance ?? 0,2) }} LYD</span>
      </strong>

      @if(($user->balance ?? 0) < $total)
        <div class="mt-2">
            <a href="{{ route('user.rechargeWallet') }}" class="btn btn-sm btn-outline-primary">شحن المحفظة</a>
        </div>
      @endif
    </div>

    <form action="{{ route('pharmacy.checkout') }}" method="POST" class="shadow-sm p-4 rounded bg-white">
        @csrf

        <!-- بيانات المستخدم -->
        <div class="mb-3">
            <label for="phoneNumber" class="form-label fw-semibold">رقم الهاتف</label>
            <input type="text" name="phoneNumber" id="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber ?? '') }}" class="form-control rounded-pill border-primary" required>
            @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="address" class="form-label fw-semibold">العنوان</label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->address ?? '') }}" class="form-control rounded-pill border-primary" required>
            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <!-- سلة المشتريات -->
        <h4 class="mt-4 fw-bold">سلة المشتريات</h4>
        <ul class="list-group mb-3 shadow-sm">
            @foreach($cart as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item['name'] }} (x{{ $item['quantity'] }})
                    <span class="fw-bold text-primary">{{ number_format($item['price'] * $item['quantity'], 2) }} LYD</span>
                </li>
            @endforeach
        </ul>

        <div class="mb-3 text-end">
            <strong class="fs-5">المجموع: <span class="text-success" id="total-amount">{{ number_format($total, 2) }} LYD</span></strong>
        </div>

       <div class="text-center">
          <button type="submit" class="btn btn-lg btn-gradient-primary rounded-pill px-5 py-2" @if(($user->balance ?? 0) < $total) disabled @endif>
              الدفع من المحفظة
          </button>
       </div>
    </form>
</div>
@endsection

