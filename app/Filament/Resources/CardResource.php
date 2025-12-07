<?php

namespace App\Filament\Resources;

use App\Filament\Exports\CardExporter;
use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Illuminate\Support\Facades\Response;

class CardResource extends Resource
{
    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     protected static ?string $navigationGroup = 'Card Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('card_number')->required(),
                Forms\Components\Toggle::make('used'),
                Forms\Components\Select::make('card_category_id')
                    ->label('فئة الكارت')
                    ->relationship('category', 'price')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('card_number')->label('رقم الكارت'),
                Tables\Columns\TextColumn::make('used')
                ->label('حالة الاستخدام')
                ->badge()
                ->formatStateUsing(fn ($state) => $state ? 'مستخدم' : 'غير مستخدم')
                ->color(fn ($state) => $state ? 'success' : 'danger')
                ->sortable(),
                Tables\Columns\TextColumn::make('category.price')->label('سعر الفئة'),
            ])
            ->filters([

                SelectFilter::make('used')
                    ->label('حالة الاستخدام')
                    ->options([
                        0 => 'غير مستخدم',
                        1 => 'مستخدم',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()->exporter(CardExporter::class)
                ->formats([
                    ExportFormat::Csv
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()->exporter(CardExporter::class)
                ->formats([
                    ExportFormat::Csv
                ])

            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),

            ]);

    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }
}
