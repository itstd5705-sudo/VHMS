<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicationResource\Pages;
use App\Filament\Resources\MedicationResource\RelationManagers;
use App\Models\Category;
use App\Models\Medication;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class MedicationResource extends Resource
{
    protected static ?string $model = Medication::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'pharmacy Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('categoryId')
                ->options(Category::all())
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),
                TextInput::make('parcode')->required(),
                TextInput::make('price')->numeric()->required(),
                TextInput::make('stockQuantity')->numeric()->required(),
                Textarea::make('description')->label('Description')->rows(3)->nullable(),
                FileUpload::make('imgUrl')->image()->directory('image')->label('image')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('parcode')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('price')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('stockQuantity')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('category.name')
                ->label('Category')
                ->sortable()
                ->searchable()
                ->toggleable(),
                TextColumn::make('created_at')->dateTime()->label('Created At')
                ->sortable()
                ->searchable()
                ->toggleable(),

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
            'index' => Pages\ListMedications::route('/'),
            'create' => Pages\CreateMedication::route('/create'),
            'edit' => Pages\EditMedication::route('/{record}/edit'),
        ];
    }
}
