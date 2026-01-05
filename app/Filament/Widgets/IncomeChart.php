<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Appointment;
use Carbon\Carbon;

class IncomeChart extends ChartWidget
{
    // عنوان المخطط
    protected static ?string $heading = 'الأرباح خلال آخر 7 أيام';

    // تجهيز بيانات المخطط
    protected function getData(): array
    {
        $labels = []; // لتخزين أسماء الأيام
        $data = [];   // لتخزين الأرباح لكل يوم

        // حلقة لآخر 7 أيام (من الأقدم للأحدث)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->format('d/m'); // صيغة اليوم/الشهر
            $data[] = Appointment::where('status', 'attended') // فقط المواعيد التي تمت حضورها
                                ->whereDate('created_at', $date) // حسب اليوم الحالي
                                ->sum('price'); // مجموع الأرباح
        }

        return [
            'datasets' => [
                [
                    'label' => 'الدخل (د.ل)', // تسمية البيانات
                    'data' => $data,
                    'borderColor' => '#10B981', // لون الخط (أخضر)
                    'backgroundColor' => 'rgba(16,185,129,0.2)', // خلفية شفافة
                    'fill' => true, // تفعيل التعبئة تحت الخط
                    'tension' => 0.3, // نعومة الخط
                ]
            ],
            'labels' => $labels
        ];
    }

    // نوع الرسم البياني
    protected function getType(): string
    {
        return 'line'; // مخطط خطي
    }
}
