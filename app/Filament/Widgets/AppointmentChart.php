<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Appointment;

class AppointmentChart extends ChartWidget
{
    // عنوان الـ Chart
    protected static ?string $heading = 'المواعيد حسب الحالة';

    // تجهيز بيانات الـ Chart
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'المواعيد', // اسم مجموعة البيانات
                    'data' => [
                        // عدد المواعيد المفتوحة
                        Appointment::where('status','open')->count(),
                        // عدد المواعيد المغلقة
                        Appointment::where('status','closed')->count(),
                    ],
                    // ألوان الباي
                    'backgroundColor' => ['#10B981', '#EF4444'], // أخضر للأوبن، أحمر للكلوزد
                ],
            ],
            // أسماء الفئات
            'labels' => ['مفتوحة','مغلقة'],
        ];
    }

    // نوع الرسم البياني
    protected function getType(): string
    {
        return 'pie'; // باي Chart
    }
}
