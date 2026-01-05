<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBookingController extends Controller
{
    /* ================== عرض نموذج الحجز ================== */
    public function showBookingForm($appointmentId)
    {
        // التأكد من أن المستخدم مسجل دخول
        if (!Auth::check())
        {
           return redirect()->back()
            ->with('warning', '⚠️ يجب تسجيل الدخول قبل الحجز.');
        }

        // جلب تفاصيل الموعد
        $appointment = Appointment::findOrFail($appointmentId);
        $user = Auth::user();

        // حساب عدد الحجوزات الحالية للموعد
        $currentCount = Booking::where('appointmentId', $appointmentId)->count();
        $expectedQueue = $currentCount + 1; // رقم الدور المتوقع للمستخدم
        $peopleBefore = $currentCount;       // عدد الأشخاص قبل المستخدم

        // عرض صفحة الحجز مع المعلومات
        return view('visitor.booking.book_appointment', compact(
            'appointment',
            'user',
            'expectedQueue',
            'peopleBefore'
        ));
    }

    /* ================== تأكيد الحجز ================== */
    public function confirmBooking(Request $request, $appointmentId)
    {
        $user = Auth::user();

        try {
            // استخدام Transaction لحماية البيانات من أي أخطاء أو Race Conditions
            DB::transaction(function() use ($request, $appointmentId, $user) {

                // قفل السطر لمنع أي مستخدم آخر من تعديل نفس الموعد في نفس الوقت
                $appointment = Appointment::lockForUpdate()->findOrFail($appointmentId);

                // تحقق من الحد الأقصى للحجوزات
                $currentBookings = $appointment->bookings()->count();
                if ($currentBookings >= $appointment->max_bookings)
                {
                    throw new \Exception('⚠️ تم اكتمال الحجوزات لهذا الموعد.');
                }

                // تحقق من رصيد المستخدم
                if ($user->balance < $appointment->price) {
                    throw new \Exception('⚠️ رصيد المحفظة غير كافي للحجز.');
                }

                // تحقق إذا المستخدم حجز هذا الموعد مسبقًا
                $existingBooking = Booking::where('userId', $user->id)
                                          ->where('appointmentId', $appointment->id)
                                          ->first();
                if ($existingBooking && !$request->has('confirm_double_booking'))
                {
                   return redirect()->back()
                   ->with('warning', 'لقد حجزت هذا الموعد مسبقاً. إذا أردت الحجز مرة أخرى، يرجى تأكيد ذلك.');
                }

                // خصم الرصيد من المستخدم
                $user->balance -= $appointment->price;
                $user->save();

                // احسب رقم الدور التالي في الطابور
                $lastNumber = Booking::where('appointmentId', $appointment->id)->max('queue_number');
                $queueNumber = $lastNumber ? $lastNumber + 1 : 1;

                // إنشاء الحجز
                Booking::create([
                    'userName'      => $user->userName,
                    'phone'         => $user->phone,
                    'status'        => 'waiting',   // الحالة الافتراضية
                    'note'          => $request->note ?? null,
                    'userId'        => $user->id,
                    'appointmentId' => $appointment->id,
                    'queue_number'  => $queueNumber,
                    'archived'      => false,       // غير مؤرشف
                ]);
            });

            return redirect()->back()->with('success', '✅ تم الحجز بنجاح!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /* ================== عرض كل حجوزات المستخدم ================== */
    public function myBookings()
    {
        $user = Auth::user();

        // جلب جميع الحجوزات الحالية (غير مؤرشفة)
        $bookings = Booking::with('appointment.doctor')
            ->where('userId', $user->id)
            ->where('archived', false)
            ->orderBy('created_at', 'desc')
            ->get();

        // حساب الرقم المتوقع وعدد الأشخاص قبل كل حجز
        foreach ($bookings as $booking) {
            $lastNumber = Booking::where('appointmentId', $booking->appointmentId)
                                 ->where('archived', false)
                                 ->max('queue_number');
            $booking->expectedQueue = $booking->queue_number ?? ($lastNumber ? $lastNumber : 1);
            $booking->peopleBefore = $booking->expectedQueue - 1;
        }

        return view('User.profile.my_bookings', compact('bookings'));
    }

    /* ================== أرشفة الحجز ================== */
    public function archiveBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // التحقق من ملكية الحجز
        if ($booking->userId != Auth::id()) {
            return back()->with('error', 'ليس لديك صلاحية لأرشفة هذا الحجز.');
        }

        $booking->archived = true;
        $booking->save();

        return back()->with('success', 'تم أرشفة الحجز بنجاح.');
    }

    /* ================== شحن المحفظة ================== */
    public function rechargeWallet(Request $request)
    {
        $request->validate([
            'card_number' => 'required|string',
        ]);

        // جلب الكرت والتحقق منه
        $card = Card::where('card_number', $request->card_number)->first();

        if (!$card) {
            return back()->with('error', 'رقم الكرت غير صحيح');
        }

        if ($card->used) {
            return back()->with('error', 'تم استخدام الكرت مسبقاً');
        }

        // شحن رصيد المستخدم بقيمة الكرت
        $user = Auth::user();
        $user->balance += $card->category->price;
        $user->save();

        // تمييز الكرت كمستخدم
        $card->used = true;
        $card->save();

        return back()->with(
            'success',
            'تم شحن المحفظة بنجاح! +' . $card->category->price . ' د.ل'
        );
    }

    /* ================== حالة الطابور (JSON) ================== */
    public function queueStatus($appointmentId)
    {
        $count = Booking::where('appointmentId', $appointmentId)->count();

        return response()->json([
            'current_queue' => $count + 1,
            'people_before' => $count,
        ]);
    }
}
