<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Appointment;
use App\Models\Card;
use Carbon\Carbon;

class MonthlyStats extends StatsOverviewWidget
{
    // الحصول على الإحصائيات الشهرية
    protected function getStats(): array
    {
        $month = Carbon::now()->month; // الشهر الحالي
        $year  = Carbon::now()->year;  // السنة الحالية

        return [
            // عدد المواعيد لهذا الشهر
            Stat::make('مواعيد هذا الشهر',
                Appointment::whereMonth('created_at', $month)
                           ->whereYear('created_at', $year)
                           ->count()
            )->color('primary'),

            // عدد المواعيد المكتملة (attended) لهذا الشهر
            Stat::make('مواعيد مكتملة',
                Appointment::where('status','attended')
                           ->whereMonth('created_at', $month)
                           ->count()
            )->color('success'),

            // عدد الكروت المستخدمة هذا الشهر
            Stat::make('كروت مستخدمة هذا الشهر',
                Card::where('used',1)
                    ->whereMonth('created_at', $month)
                    ->count()
            )->color('warning'),
        ];
    }
}
