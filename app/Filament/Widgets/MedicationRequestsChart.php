<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Medication;

class MedicationRequestsChart extends ChartWidget
{
    // عنوان الويجت
    protected static ?string $heading = 'طلبات الأدوية اليومية';

    // نوع الرسم البياني
    protected function getType(): string
    {
        return 'line'; // رسم خطي
    }

    // بيانات الرسم البياني
    protected function getData(): array
    {
        // آخر 7 أيام (اليوم الأخير هو اليوم الحالي)
        $days = collect(range(6, 0, -1))
            ->map(fn($i) => now()->subDays($i)->format('Y-m-d'));

        // عدّ الطلبات لكل يوم
        $counts = $days->map(fn($day) =>
            Medication::whereDate('created_at', $day)->count()
        );

        return [
            // التسميات على المحور X
            'labels' => $days->map(fn($d) => now()->parse($d)->format('d M'))->toArray(),

            // البيانات لكل خط في الرسم
            'datasets' => [
                [
                    'label' => 'عدد الطلبات',
                    'data' => $counts->toArray(),
                    'fill' => false,             // لا تملأ المساحة تحت الخط
                    'borderColor' => '#3B82F6',  // اللون الأزرق
                    'tension' => 0.3,            // نعومة الخط (انحناء بسيط)
                ],
            ],
        ];
    }
}
