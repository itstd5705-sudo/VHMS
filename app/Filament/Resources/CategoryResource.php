<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers\MedicationsRelationManager;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Traits\HasAutoTablePdf;

class CategoryResource extends Resource
{
    use HasAutoTablePdf; // ✅ لإضافة زر PDF تلقائي

    // الربط بنموذج Category
    protected static ?string $model = Category::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-s-rectangle-stack';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'pharmacy Management';

    // تعريف الفورم لإضافة/تعديل الفئات
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // اسم الفئة (مطلوب)
                TextInput::make('name')
                    ->label('اسم الفئة')
                    ->required(),

                // صورة الفئة (اختياري)
                FileUpload::make('image')
                    ->label('صورة الفئة')
                    ->disk('public')
                    ->directory('categores')
                    ->nullable(),

                // وصف الفئة (مطلوب)
                TextInput::make('description')
                    ->label('الوصف')
                    ->required(),
            ]);
    }

    // تعريف الجدول في لوحة Filament
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // ✅ زر PDF موحد
                static::getAutoPdfAction(),
            ])
            ->columns([
                // اسم الفئة
                TextColumn::make('name')
                    ->label('اسم الفئة')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                // تاريخ الإنشاء
                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->actions([
                // أزرار تعديل وحذف لكل سجل
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

    // العلاقات: ربط الفئة بالأدوية المرتبطة بها
    public static function getRelations(): array
    {
        return [
            MedicationsRelationManager::class,
        ];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),       // صفحة القائمة
            'create' => Pages\CreateCategory::route('/create'), // صفحة إضافة فئة
            'edit' => Pages\EditCategory::route('/{record}/edit'), // صفحة تعديل فئة
        ];
    }
}
