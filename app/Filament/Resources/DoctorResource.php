<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use App\Filament\Traits\HasAutoTablePdf;

class DoctorResource extends Resource
{
    use HasAutoTablePdf; // ✅ لإضافة زر PDF تلقائي

    // الربط بنموذج Doctor
    protected static ?string $model = Doctor::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'Doctors Management';

    // تعريف الفورم لإضافة/تعديل الأطباء
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // الاسم الكامل للطبيب
                TextInput::make('fullName')
                    ->label('Full Name')
                    ->required(),

                // البريد الإلكتروني
                TextInput::make('email')
                    ->email()
                    ->label('Email')
                    ->required(),

                // كلمة المرور (مشفرة عند الحفظ)
                TextInput::make('password')
                    ->password()
                    ->label('Password')
                    ->dehydrateStateUsing(fn ($state, $record) => $state ? Hash::make($state) : ($record?->password ?? null))
                    ->required(fn ($record) => !$record), // مطلوب فقط عند الإضافة

                // التخصص
                TextInput::make('specialty')
                    ->label('Specialty')
                    ->required(),

                // رقم الهاتف
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20)
                    ->label('Phone')
                    ->required(),

                // رفع صورة الطبيب (اختياري)
                FileUpload::make('imgUrl')
                    ->label('Profile Image')
                    ->image()
                    ->directory('doctors')
                    ->disk('public')
                    ->nullable()
                    ->imagePreviewHeight('150'),

                // اختيار القسم المرتبط بالطبيب
                Select::make('departmentId')
                    ->label('Department')
                    ->relationship('Department', 'name')
                    ->required(),

                // حالة الطبيب: مفعل/غير مفعل
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required(),
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
                // الاسم
                TextColumn::make('fullName')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                // التخصص
                TextColumn::make('specialty')
                    ->sortable()
                    ->searchable(),

                // الهاتف
                TextColumn::make('phone')
                    ->sortable(),

                // حالة الطبيب مع تمييز اللون
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state) => match($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),

                // تاريخ الإنشاء
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime(),
            ])
            ->filters([
                // فلتر حالة الطبيب
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
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

    // العلاقات (حالياً لا توجد علاقات)
    public static function getRelations(): array
    {
        return [];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'), // صفحة القائمة
            'create' => Pages\CreateDoctor::route('/create'), // صفحة إضافة طبيب
            'edit' => Pages\EditDoctor::route('/{record}/edit'), // صفحة تعديل طبيب
        ];
    }
}
