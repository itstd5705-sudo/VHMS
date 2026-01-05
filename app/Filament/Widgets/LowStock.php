<?php

namespace App\Filament\Widgets;

use App\Models\Medication;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LowStock extends TableWidget
{
    // يجعل الجدول يمتد عبر كامل الصفحة
    protected int|string|array $columnSpan = 'full';

    // تعريف الجدول
    public function table(Table $table): Table
    {
        return $table
            // الاستعلام لجلب الأدوية التي كمية مخزونها أقل من 10
            ->query(
                Medication::query()->where('stockQuantity', '<', 10)
            )
            // الأعمدة المعروضة في الجدول
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('اسم الدواء')
                    ->searchable(), // حقل قابل للبحث

                Tables\Columns\TextColumn::make('stockQuantity')
                    ->label('الكمية')
                    ->sortable() // قابل للفرز
                    ->color('danger'), // لون أحمر للكمية المنخفضة
            ])
            ->filters([
                // يمكن إضافة فلاتر لاحقًا، مثل تصفية حسب الفئة
            ])
            ->headerActions([
                // يمكن إضافة أزرار إنشاء أو تصدير إذا رغبت
            ])
            ->actions([
                // أزرار تعديل وحذف لكل سجل (اختياري)
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // أزرار الحذف الجماعي
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
