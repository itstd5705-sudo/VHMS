<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use App\Filament\Traits\HasAutoTablePdf; // ✅ لإضافة زر PDF تلقائي

class AppointmentResource extends Resource
{
    // الربط بنموذج Appointment
    protected static ?string $model = Appointment::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-s-calendar';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'Doctors Management';

    use HasAutoTablePdf;

    // تعريف نموذج الفورم لإضافة/تعديل المواعيد
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // اختيار الطبيب المرتبط بالموعد
                Select::make('doctorId')
                    ->label('Doctor')
                    ->relationship('Doctor', 'fullName')
                    ->required(),

                // اختيار يوم الموعد
                Select::make('day')
                    ->label('Day')
                    ->options([
                        'السبت' => 'السبت',
                        'الأحد' => 'الأحد',
                        'الاثنين' => 'الاثنين',
                        'الثلاثاء' => 'الثلاثاء',
                        'الأربعاء' => 'الأربعاء',
                        'الخميس' => 'الخميس',
                        'الجمعة' => 'الجمعة',
                    ])
                    ->required(),

                // توقيت البداية والنهاية للموعد
                TimePicker::make('from_time')->label('From Time')->required(),
                TimePicker::make('to_time')->label('To Time')->required(),

                // حالة الموعد: مفتوح أو مسكر
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'open',
                        'closed' => 'closed',
                    ])
                    ->required(),

                // السعر والحد الأقصى للحجوزات
                TextInput::make('price')->numeric()->required(),
                TextInput::make('max_bookings')->numeric()->required(),
            ]);
    }

    // تعريف جدول المواعيد في لوحة Filament
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                static::getAutoPdfAction(), // ✅ زر PDF
            ])
            ->columns([
                // اسم الطبيب المرتبط بالموعد
                TextColumn::make('Doctor.fullName')
                    ->label('Doctor')
                    ->sortable()
                    ->searchable(),

                // اليوم والوقت
                TextColumn::make('day')->label('Day')->sortable(),
                TextColumn::make('from_time')->label('From'),
                TextColumn::make('to_time')->label('To'),

                // حالة الموعد مع تمييز اللون
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'open',
                        'danger' => 'closed',
                    ])
                    ->sortable(),

                // السعر والحد الأقصى للحجوزات
                TextColumn::make('price')->sortable(),
                TextColumn::make('max_bookings')->label('Max Bookings')->sortable(),

                // تاريخ الإنشاء
                TextColumn::make('created_at')->dateTime()->label('Created At'),
            ])
            ->filters([
                // فلتر لحالة الموعد (مفتوح / مسكر)
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'open' => 'Open',
                        'closed' => 'Closed',
                    ]),
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

    // العلاقات (حالياً لا توجد علاقات إضافية)
    public static function getRelations(): array
    {
        return [];
    }

    // صفحات الموارد: القائمة، الإضافة، التعديل
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
