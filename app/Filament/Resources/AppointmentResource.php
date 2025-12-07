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

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar';

    protected static ?string $navigationGroup = 'Doctors Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('doctorId')
                    ->label('Doctor')
                    ->relationship('Doctor', 'fullName')
                    ->required(),

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

                TimePicker::make('from_time')->label('From Time')->required(),
                TimePicker::make('to_time')->label('To Time')->required(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'available' => 'Available',
                        'full' => 'Full',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),

                TextInput::make('price')->numeric()->required(),
                TextInput::make('max_bookings')->numeric()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('Doctor.fullName')
                    ->label('Doctor')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => mb_convert_encoding($state, 'UTF-8', 'UTF-8')),

                TextColumn::make('day')
                    ->label('Day')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => mb_convert_encoding($state, 'UTF-8', 'UTF-8')),

                TextColumn::make('from_time')->label('From'),
                TextColumn::make('to_time')->label('To'),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn ($record) => match($record->status) {
                        'available' => 'Available',
                        'full' => 'Full',
                        'cancelled' => 'Cancelled',
                        default => $record->status,
                    })
                    ->colors([
                        'success' => fn ($record) => $record->status === 'available',
                        'warning' => fn ($record) => $record->status === 'full',
                        'danger'  => fn ($record) => $record->status === 'cancelled',
                    ])
                    ->sortable(),

                TextColumn::make('price')->sortable(),
                TextColumn::make('max_bookings')->label('Max Bookings')->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created At'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
