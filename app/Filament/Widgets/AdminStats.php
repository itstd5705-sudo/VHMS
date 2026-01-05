<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Medication;
use App\Models\Card;

class AdminStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // عدد الأطباء
            Stat::make('الأطباء', Doctor::count())
                ->color(Doctor::count() > 10 ? 'success' : 'danger')
                ->icon('heroicon-s-user-group'),

            // عدد الأقسام
            Stat::make('الأقسام', Department::count())
                ->color('primary')
                ->icon('heroicon-s-building-office'),

            // عدد مواعيد اليوم
            Stat::make('مواعيد اليوم', Appointment::whereDate('created_at', today())->count())
                ->color('warning')
                ->icon('heroicon-s-calendar'),

            // عدد المواعيد المفتوحة
            Stat::make('مواعيد مفتوحة', Appointment::where('status','open')->count())
                ->color('success')
                ->icon('heroicon-s-clock'),

            // عدد الأدوية
            Stat::make('الأدوية', Medication::count())
                ->color('info')
                ->icon('heroicon-s-cube'),

            // عدد الكروت المستخدمة
            Stat::make('الكروت المستخدمة', Card::where('used',1)->count())
                ->color('danger')
                ->icon('heroicon-s-credit-card'),
        ];
    }
}
