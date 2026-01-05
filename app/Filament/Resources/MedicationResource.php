<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationResource\Pages;
use App\Models\Category;
use App\Models\Medication;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Traits\HasAutoTablePdf;

class MedicationResource extends Resource
{
    use HasAutoTablePdf; // ✅ لإضافة زر PDF تلقائي

    // الربط بنموذج Medication
    protected static ?string $model = Medication::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'pharmacy Management';

    // تعريف الفورم لإضافة/تعديل الأدوية
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // اسم الدواء
                TextInput::make('name')
                    ->label('Medication Name')
                    ->required(),

                // اختيار الفئة المرتبطة بالدواء
                Select::make('categoryId')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),

                // الباركود
                TextInput::make('parcode')
                    ->label('Barcode')
                    ->required(),

                // السعر
                TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),

                // كمية المخزون
                TextInput::make('stockQuantity')
                    ->label('Stock Quantity')
                    ->numeric()
                    ->required(),

                // وصف الدواء
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),

                // صورة الدواء
                FileUpload::make('imgUrl')
                    ->label('Image')
                    ->image()
                    ->directory('image')
                    ->nullable(),
            ]);
    }

    // تعريف الجدول في لوحة Filament
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                static::getAutoPdfAction(), // ✅ زر PDF موحد
            ])
            ->columns([
                TextColumn::make('name')
                    ->label('Medication Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('parcode')
                    ->label('Barcode')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('stockQuantity')
                    ->label('Stock Quantity')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                // يمكن إضافة فلاتر لاحقًا
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // زر تعديل
                Tables\Actions\DeleteAction::make(), // زر حذف
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // حذف جماعي
                ]),
            ]);
    }

    // العلاقات (حالياً لا توجد علاقات مضافة)
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedications::route('/'), // صفحة القائمة
            'create' => Pages\CreateMedication::route('/create'), // صفحة إضافة دواء
            'edit' => Pages\EditMedication::route('/{record}/edit'), // صفحة تعديل دواء
        ];
    }
}
