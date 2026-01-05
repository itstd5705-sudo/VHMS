<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Card;

class CardChart extends ChartWidget
{
    // عنوان الـ Chart
    protected static ?string $heading = 'حالة الكروت';

    // تجهيز بيانات الـ Chart
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'الكروت', // اسم مجموعة البيانات
                    'data' => [
                        // عدد الكروت غير المستخدمة
                        Card::where('used',0)->count(),
                        // عدد الكروت المستخدمة
                        Card::where('used',1)->count(),
                    ],
                    // ألوان الدونات
                    'backgroundColor' => ['#3B82F6', '#EF4444'], // أزرق للغير مستخدم، أحمر للمستخدم
                ],
            ],
            // أسماء الفئات
            'labels' => ['غير مستخدم','مستخدم'],
        ];
    }

    // نوع الرسم البياني
    protected function getType(): string
    {
        return 'doughnut'; // دونات Chart
    }
}
