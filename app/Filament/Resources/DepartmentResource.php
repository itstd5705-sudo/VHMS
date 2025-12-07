<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartmentResource\Pages;
use App\Filament\Resources\DepartmentResource\RelationManagers;
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
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office';

    protected static ?string $navigationGroup = 'Doctors Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Department Name')->required(),
                TextInput::make('location')->label('Location')->required(),
                Textarea::make('description')->label('Description')->rows(3)->nullable(),
                FileUpload::make('imgUrl')->image()->directory('image')->label('Image')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Name')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('location')->label('Location')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('created_at')
                ->label('Created At')
                ->dateTime()
                ->sortable()
                ->searchable()
                ->toggleable(),
                  ImageColumn::make('imgUrl')
                    ->label('Profile')
                    ->disk('public')
                    ->circular()
                    ->size(50),
            ])

            ->filters([
                Filter::make('name')
                ->form([TextInput::make('name')->label('Search Name'),
                ])
                ->query(function (Builder $query, array $data)
                {
               return $query
               ->when($data['name'] ?? null, fn ($q, $value) => $q->where('name', 'like', "%$value%"));
              }),
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
            DoctorsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}
