<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class DoctorsRelationManager extends RelationManager
{
    protected static string $relationship = 'doctors';

    public function form(Form $form): Form
    {
        return $form
             ->schema([
                TextInput::make('fullName')->label('Full Name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
                TextInput::make('specialty')->required(),
                TextInput::make('phone')->tel()->maxLength(20)->required(),
                FileUpload::make('imgUrl')->image()->directory('doctors')->label('Profile Image')->nullable(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('fullName')->label('Name')->sortable()->searchable(),
                TextColumn::make('specialty')->sortable()->searchable(),
                TextColumn::make('phone')->sortable(),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->getStateUsing(fn($record) => $record->status === 'active' ? 'Active' : 'Inactive')
                    ->colors([
                        'success' => fn($record) => $record->status === 'active',
                        'danger'  => fn($record) => $record->status === 'inactive',
                    ])
                    ->sortable(),
                ImageColumn::make('imgUrl')->label('Image'),
                TextColumn::make('created_at')->dateTime()->label('Created At'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
