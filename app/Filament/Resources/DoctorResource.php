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

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'Doctors Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('fullName')->label('Full Name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state, $record) => $state ? Hash::make($state) : ($record?->password ?? null))
                    ->label('Password')
                    ->required(fn ($record) => !$record),
                TextInput::make('specialty')->required(),
                TextInput::make('phone')->tel()->maxLength(20)->required(),
                FileUpload::make('imgUrl')
                    ->label('Profile Image')
                    ->image()
                    ->directory('doctors')
                    ->disk('public')
                    ->nullable()
                    ->imagePreviewHeight('150'),
                Select::make('departmentId')
                    ->label('Department')
                    ->relationship('Department', 'name')
                    ->required(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imgUrl')
                    ->label('Profile')
                    ->disk('public')
                    ->circular()
                    ->size(50),
                TextColumn::make('fullName')->label('Name')->sortable()->searchable(),
                TextColumn::make('specialty')->sortable()->searchable(),
                TextColumn::make('phone')->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state) => match($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'secondary',
                    })
                    ->sortable(),
                TextColumn::make('created_at')->dateTime()->label('Created At'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
