<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardCategoryResource\Pages;
use App\Models\CardCategory;
use App\Models\Card;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Response;

class CardCategoryResource extends Resource
{
    protected static ?string $model = CardCategory::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Card Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('price')
                    ->label('السعر')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->sortable()
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('price')
                ->label('السعر')
                ->sortable()
                ->searchable()
                ->toggleable(),
                Tables\Columns\TextColumn::make('cards_count')
                ->counts('cards')
                ->label('عدد الكروت')
                ->sortable()
                ->searchable()
                ->toggleable(),
            ])
            ->actions([
                // زر توليد الكروت لكل فئة
                Action::make('generate_cards')
                    ->label('توليد كروت')
                    ->form([
                        Forms\Components\TextInput::make('count')
                            ->label('عدد الكروت')
                            ->default(15)
                            ->numeric()
                            ->required(),
                    ])
                    ->action(function (CardCategory $record, array $data) {
                        $count = $data['count'];
                        for ($i = 0; $i < $count; $i++) {
                            Card::create([
                                'card_number' => str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT), // أرقام فقط
                                'used' => false,
                                'card_category_id' => $record->id,
                            ]);
                        }
                    }),
                  //  Tables\Actions\DeleteAction::make(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCardCategories::route('/'),
            'create' => Pages\CreateCardCategory::route('/create'),
            'edit' => Pages\EditCardCategory::route('/{record}/edit'),
        ];
    }
}
