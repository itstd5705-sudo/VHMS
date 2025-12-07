<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    // عرض نموذج الحجز
    public function showBookingForm($appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $user = Auth::user();

        $currentCount = Booking::where('appointmentId', $appointmentId)->count();
        $expectedQueue = $currentCount + 1;
        $peopleBefore = $currentCount;

        return view('visitor.booking.book_appointment', compact(
            'appointment',
            'user',
            'expectedQueue',
            'peopleBefore'
        ));
    }

    // تأكيد الحجز
    public function confirmBooking(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $user = Auth::user();

        // تحقق من رصيد المستخدم
        if ($user->balance < $appointment->price) {
            return redirect()->back()->with('error', 'رصيد المحفظة غير كافي.');
        }

        // تحقق من الحد الأقصى للحجوزات
        $currentBookings = $appointment->bookings()->count();
        if ($currentBookings >= $appointment->max_bookings) {
            return redirect()->back()->with('error', 'تم اكتمال الحجوزات لهذا الموعد.');
        }

        // تحقق إذا المستخدم حجز هذا الموعد مسبقاً
        $existingBooking = Booking::where('userId', $user->id)
                                  ->where('appointmentId', $appointment->id)
                                  ->first();

        if ($existingBooking && !$request->has('confirm_double_booking')) {
            return redirect()->back()->with(
                'warning',
                'لقد حجزت هذا الموعد مسبقاً. هل أنت متأكد من الحجز مرة أخرى؟'
            );
        }

        // احسب رقم الدور التالي
        $lastNumber = Booking::where('appointmentId', $appointment->id)->max('queue_number');
        $queueNumber = $lastNumber ? $lastNumber + 1 : 1;

        // خصم الرصيد
        $user->balance -= $appointment->price;
        $user->save();

        // إنشاء الحجز مع رقم الدور
        $booking = Booking::create([
            'userName'      => $user->userName,
            'phone'         => $user->phone,
            'status'        => 'approved',
            'note'          => $request->note ?? null,
            'userId'        => $user->id,
            'appointmentId' => $appointment->id,
            'queue_number'  => $queueNumber,
        ]);

        return redirect()
            ->route('user.booking.confirm', $booking->id)
            ->with('success', 'تم الحجز بنجاح!');
    }

    // صفحة تأكيد الحجز
    public function bookingConfirm($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $appointment = $booking->appointment;
        $user = Auth::user();

        // رقم الدور المتوقع وعدد الأشخاص قبل المستخدم
        $lastNumber = Booking::where('appointmentId', $appointment->id)->max('queue_number');
        $expectedQueue = $booking->queue_number ?? ($lastNumber ? $lastNumber : 1);
        $peopleBefore = $expectedQueue - 1;

        return view('visitor.booking.booking_confirm', compact(
            'booking',
            'appointment',
            'user',
            'expectedQueue',
            'peopleBefore'
        ));
    }

    // عرض كل حجوزات المستخدم
    public function myBookings()
    {
        $user = Auth::user();
        $bookings = Booking::with('appointment.doctor')
            ->where('userId', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // أضف معلومات الطابور لكل حجز
        foreach ($bookings as $booking) {
            $lastNumber = Booking::where('appointmentId', $booking->appointmentId)->max('queue_number');
            $booking->expectedQueue = $booking->queue_number ?? ($lastNumber ? $lastNumber : 1);
            $booking->peopleBefore = $booking->expectedQueue - 1;
        }

        return view('User.profile.my_bookings', compact('bookings'));
    }

    // شحن المحفظة
    public function rechargeWallet(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
        ]);

        $card = Card::where('card_number', $request->card_number)->first();

        if (!$card) {
            return back()->with('error', 'رقم الكرت غير صحيح');
        }

        if ($card->used) {
            return back()->with('error', 'تم استخدام الكرت مسبقاً');
        }

        $user = Auth::user();
        $user->balance += $card->category->price;
        $user->save();

        $card->used = true;
        $card->save();

        return back()->with(
            'success',
            'تم شحن المحفظة بنجاح! +' . $card->category->price . ' د.ل'
        );
    }

    // إلغاء الحجز
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->userId != Auth::id()) {
            return back()->with('error', 'ليس لديك صلاحية لإلغاء هذا الحجز.');
        }

        $bookingTime = \Carbon\Carbon::parse($booking->created_at);
        $now = \Carbon\Carbon::now();

        if ($bookingTime->diffInHours($now) >= 3) {
            return back()->with('error', 'انتهت صلاحية إلغاء هذا الحجز.');
        }

        $booking->delete();

        return back()->with('success', 'تم إلغاء الحجز بنجاح.');
    }

    // حالة الطابور (JSON)
    public function queueStatus($appointmentId)
    {
        $count = Booking::where('appointmentId', $appointmentId)->count();

        return response()->json([
            'current_queue'  => $count + 1,
            'people_before'  => $count,
        ]);
    }
}
