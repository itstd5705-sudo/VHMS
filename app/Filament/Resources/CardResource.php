<?php

namespace App\Filament\Resources;

use App\Filament\Exports\CardExporter;
use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Illuminate\Support\Facades\Response;
use App\Filament\Traits\HasAutoTablePdf;

class CardResource extends Resource
{
    use HasAutoTablePdf; // ✅ زر PDF تلقائي

    // الربط بنموذج Card
    protected static ?string $model = Card::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'Card Management';

    // تعريف الفورم لإضافة/تعديل الكروت
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // رقم الكارت (مطلوب)
                Forms\Components\TextInput::make('card_number')
                    ->label('رقم الكارت')
                    ->required(),

                // حالة الاستخدام: مستخدم / غير مستخدم
                Forms\Components\Toggle::make('used')
                    ->label('حالة الاستخدام'),

                // اختيار فئة الكارت
                Forms\Components\Select::make('card_category_id')
                    ->label('فئة الكارت')
                    ->relationship('category', 'price')
                    ->required(),
            ]);
    }

    // تعريف جدول الكروت في لوحة Filament
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // ✅ زر PDF
                static::getAutoPdfAction(),
            ])
            ->columns([
                // رقم الكارت
                Tables\Columns\TextColumn::make('card_number')
                    ->label('رقم الكارت'),

                // حالة الاستخدام مع شارة ملونة
                Tables\Columns\TextColumn::make('used')
                    ->label('حالة الاستخدام')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? 'مستخدم' : 'غير مستخدم')
                    ->color(fn ($state) => $state ? 'success' : 'danger')
                    ->sortable(),

                // سعر فئة الكارت
                Tables\Columns\TextColumn::make('category.price')
                    ->label('سعر الفئة'),
            ])
            ->filters([
                // فلتر حسب حالة الاستخدام
                SelectFilter::make('used')
                    ->label('حالة الاستخدام')
                    ->options([
                        0 => 'غير مستخدم',
                        1 => 'مستخدم',
                    ]),
            ])
            ->actions([
                // أزرار تعديل وحذف
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // الحذف الجماعي
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                // زر إضافة سجل جديد عند عدم وجود بيانات
                Tables\Actions\CreateAction::make(),
            ]);
    }

    // العلاقات (حالياً لا توجد علاقات إضافية)
    public static function getRelations(): array
    {
        return [];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
