<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers\DoctorsRelationManager;
use App\Models\Department;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Traits\HasAutoTablePdf;

class DepartmentResource extends Resource
{
    use HasAutoTablePdf; // ✅ زر PDF تلقائي

    // الربط بنموذج Department
    protected static ?string $model = Department::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-s-building-office';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'Doctors Management';

    // تعريف الفورم لإضافة/تعديل الأقسام
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // اسم القسم (مطلوب)
                TextInput::make('name')
                    ->label('Department Name')
                    ->required(),

                // وصف القسم (اختياري)
                Textarea::make('description')
                    ->label('Description')
                    ->rows(3)
                    ->nullable(),

                // صورة القسم (اختياري)
                FileUpload::make('imgUrl')
                    ->image()
                    ->directory('image')
                    ->label('Image')
                    ->nullable(),
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
                // اسم القسم
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                // وصف القسم
                TextColumn::make('description')
                    ->label('Description'),

                // تاريخ الإنشاء
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                // فلتر البحث حسب اسم القسم
                Filter::make('name')
                    ->form([
                        TextInput::make('name')->label('Search Name'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['name'] ?? null, fn ($q, $value) =>
                                $q->where('name', 'like', "%$value%")
                            );
                    }),
            ])
            ->actions([
                // أزرار تعديل وحذف لكل سجل
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // الحذف الجماعي
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // العلاقات: ربط القسم بقائمة الأطباء
    public static function getRelations(): array
    {
        return [
            DoctorsRelationManager::class,
        ];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),        // صفحة القائمة
            'create' => Pages\CreateDepartment::route('/create'), // صفحة إضافة قسم
            'edit' => Pages\EditDepartment::route('/{record}/edit'), // صفحة تعديل قسم
        ];
    }
}
