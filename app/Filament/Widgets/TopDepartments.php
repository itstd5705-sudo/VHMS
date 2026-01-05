<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Department;

class TopDepartments extends TableWidget
{
    // عنوان الويدجت
    protected static ?string $heading = 'الأقسام الأكثر نشاطًا';

    // عرض العمود: كامل العرض
    protected int|string|array $columnSpan = 'full';

    // تعريف الجدول
    public function table(Table $table): Table
    {
        return $table
            // استعلام لجلب الأقسام مع عدد الأطباء وترتيبها تنازليًا حسب العدد
            ->query(
                Department::withCount('doctors')
                          ->orderByDesc('doctors_count')
            )
            ->columns([
                // اسم القسم
                Tables\Columns\TextColumn::make('name')
                    ->label('القسم')
                    ->sortable(),

                // عدد الأطباء في القسم مع شارة ولون
                Tables\Columns\TextColumn::make('doctors_count')
                    ->label('عدد الأطباء')
                    ->sortable()
                    ->badge()
                    ->color('success'),
            ]);
    }
}
