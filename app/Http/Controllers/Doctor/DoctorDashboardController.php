<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class DoctorDashboardController extends Controller
{
    /* ============================
       تحويل اسم اليوم بين العربية والانجليزية
       تستخدم لتوحيد أسماء الأيام في التطبيق
    ============================ */
    private function normalizeDay($day)
    {
        $map = [
            'Saturday'  => 'السبت',    'السبت'     => 'Saturday',
            'Sunday'    => 'الأحد',    'الأحد'     => 'Sunday', 'الاحد' => 'Sunday',
            'Monday'    => 'الإثنين',  'الإثنين'   => 'Monday', 'الاثنين' => 'Monday',
            'Tuesday'   => 'الثلاثاء', 'الثلاثاء'  => 'Tuesday',
            'Wednesday' => 'الأربعاء', 'الأربعاء'  => 'Wednesday',
            'Thursday'  => 'الخميس',   'الخميس'    => 'Thursday',
            'Friday'    => 'الجمعة',   'الجمعة'    => 'Friday',
        ];

        return $map[$day] ?? $day;
    }

    /* ============================
       لوحة التحكم الرئيسية للطبيب
       تعرض الحجوزات حسب اليوم وتدعم الفلترة والبحث
    ============================ */
    public function index(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        // اليوم الحالي بالإنجليزية ثم تحويله للعربية
        $todayEn = now()->format('l');
        $todayArabic = $this->normalizeDay($todayEn);

        // جلب جميع المواعيد مع الحجوزات غير المؤرشفة
        $appointments = $doctor->appointments()->with([
            'bookings' => fn($q) => $q->where('archived', false)->with('user')
        ])->get();

        // تنظيم الحجوزات حسب اليوم
        $appointmentsByDay = [];
        foreach ($appointments as $appointment) {
            $dayArabic = $this->normalizeDay($appointment->day);
            foreach ($appointment->bookings as $booking) {
                $appointmentsByDay[$dayArabic][] = [
                    'id'        => $booking->id,
                    'status'    => $booking->status,
                    'from_time' => $appointment->from_time,
                    'to_time'   => $appointment->to_time,
                    'price'     => $appointment->price,
                    'user'      => $booking->user,
                ];
            }
        }

        // حساب إجمالي عدد الحجوزات
        $appointmentsCount = collect($appointmentsByDay)->sum(fn($i) => count($i));

        // فلترة الحجوزات حسب اليوم إذا تم تحديده
        $filteredAppointments = [];
        $filteredTotal = 0;
        if ($request->filled('filter_day') && isset($appointmentsByDay[$request->filter_day])) {
            $filteredAppointments = $appointmentsByDay[$request->filter_day];
            $filteredTotal = collect($filteredAppointments)->sum(fn($a) => $a['price'] * 0.60);
        }

        // البحث عن المريض برمز المريض
        $user = null;
        if ($request->filled('patient_code')) {
            $patient = User::where('patient_code', $request->patient_code)->first();
            if ($patient) {
                $hasBooking = collect($appointmentsByDay)
                    ->flatten(1)
                    ->where('user.id', $patient->id)
                    ->count() > 0;
                if ($hasBooking) {
                    $user = $patient;
                }
            }
        }

        return view('doctor.dashboard', compact(
            'doctor',
            'appointmentsByDay',
            'appointmentsCount',
            'filteredAppointments',
            'filteredTotal',
            'todayArabic',
            'user'
        ));
    }

    /* ============================
       تحديث حالة الحجز
       - يثبت الحالة ويأرشف الحجز
       - يعيد المبلغ للمريض إذا لم يكن 'done'
    ============================ */
    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:waiting,checked_in,done,cancelled'
        ]);

        $booking = Booking::with('user', 'appointment')->findOrFail($id);

        if ($booking->archived) {
            return back()->with('error', 'تم تثبيت حالة هذا الحجز ولا يمكن تعديلها');
        }

        $booking->status = $request->status;
        $booking->archived = true;
        $booking->save();

        // إذا لم يكن الحجز مكتمل، نعيد المبلغ للمريض
        if ($request->status !== 'done') {
            $booking->user->balance += $booking->appointment->price;
            $booking->user->save();
        }

        return back()->with('success', 'تم تثبيت الحالة بنجاح');
    }

    /* ============================
       أرشيف الحجوزات
       - يجمع الحجوزات المؤرشفة حسب اليوم
       - يدعم تحميل كشف مالي PDF
    ============================ */
    public function archive(Request $request)
    {
        $doctor = Auth::guard('doctor')->user();

        $appointments = $doctor->appointments()->with([
            'bookings' => fn($q) => $q->where('archived', true)->with('user')
        ])->get();

        $appointmentsByDay = [];
        $dailyReports = [];

        foreach ($appointments as $appointment) {
            $dayArabic = $this->normalizeDay($appointment->day);

            foreach ($appointment->bookings as $booking) {
                $appointmentsByDay[$dayArabic][] = [
                    'id'        => $booking->id,
                    'user'      => $booking->user,
                    'from_time' => $appointment->from_time,
                    'to_time'   => $appointment->to_time,
                    'price'     => $appointment->price,
                    'status'    => $booking->status,
                ];
            }

            // حساب إجمالي ربح اليوم من الحجوزات المكتملة
            $paid = $appointment->bookings->whereIn('status', ['checked_in', 'done']);
            if ($paid->isNotEmpty()) {
                $dailyReports[$dayArabic] = [
                    'day'   => $appointment->day,
                    'total' => $paid->sum(fn() => $appointment->price * 0.60),
                ];
            }
        }

        // تحميل كشف مالي PDF
        if ($request->filled('download_day') && isset($dailyReports[$request->download_day])) {
            $day = $request->download_day;

            $bookings = Booking::whereHas('appointment', fn($q) => $q
                ->where('doctorId', $doctor->id)
                ->where('day', $this->normalizeDay($day))
            )
            ->where('archived', true)
            ->whereIn('status', ['checked_in', 'done'])
            ->with(['user', 'appointment'])
            ->get();

            return $this->generateDailyPDF($doctor, $day, $day); // تمرير اسم اليوم لPDF
        }

        return view('doctor.archive', compact(
            'appointmentsByDay',
            'dailyReports',
            'doctor'
        ));
    }

    /* ============================
       توليد HTML للـ PDF
       - يستخدم بيانات الحجوزات لعرض جدول كشف مالي
    ============================ */
    private function buildPDFHtml($bookings, $dayArabic, $date)
    {
        $html = '
        <h2 style="text-align:center; font-family: Cairo; margin-bottom: 20px;">
            كشف مالي ليوم '.$dayArabic.' ('.$date.')</h2>

        <table border="1" width="100%" cellpadding="8" cellspacing="0"
               style="border-collapse:collapse; font-family: Cairo; text-align:center;">
            <thead style="background-color:#f0f0f0;">
                <tr>
                    <th>المريض</th>
                    <th>الوقت</th>
                    <th>السعر</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>';

        $total = 0;
        foreach ($bookings as $booking) {
            $html .= '<tr>
                <td>'.($booking->user?->userName ?? 'غير متوفر').'</td>
                <td>'.$booking->appointment->from_time.' - '.$booking->appointment->to_time.'</td>
                <td>'.$booking->appointment->price.'</td>
                <td>'.$booking->status.'</td>
            </tr>';
            $total += $booking->appointment->price * 0.60;
        }

        $html .= '<tr style="font-weight:bold; background-color:#f9f9f9;">
            <td colspan="2">المجموع</td>
            <td colspan="2">'.$total.' د.ل</td>
        </tr>';

        $html .= '</tbody></table>';

        return $html;
    }

    /* ============================
       توليد ملف PDF باستخدام mPDF
    ============================ */
    private function generateDailyPDF($doctor, $day, $dayArabic)
    {
        $bookings = Booking::whereHas('appointment', fn($q) => $q
            ->where('doctorId', $doctor->id)
            ->where('day', $this->normalizeDay($day))
        )
        ->where('archived', true)
        ->whereIn('status', ['checked_in', 'done'])
        ->with(['user', 'appointment'])
        ->get();

        $html = $this->buildPDFHtml($bookings, $dayArabic, $day);

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'Cairo'
        ]);

        $mpdf->WriteHTML($html);

        return $mpdf->Output("كشف_مالي_{$day}.pdf", 'D');
    }
}
