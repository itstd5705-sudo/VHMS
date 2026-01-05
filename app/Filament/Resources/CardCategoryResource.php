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
use App\Filament\Traits\HasAutoTablePdf;

class CardCategoryResource extends Resource
{
    use HasAutoTablePdf; // ✅ لإضافة زر PDF تلقائي لكل جدول

    // الربط بنموذج CardCategory
    protected static ?string $model = CardCategory::class;

    // أيقونة التنقل في لوحة Filament
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // مجموعة التنقل في لوحة Filament
    protected static ?string $navigationGroup = 'Card Management';

    // تعريف نموذج الفورم لإضافة/تعديل فئات الكروت
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // حقل السعر
                Forms\Components\TextInput::make('price')
                    ->label('السعر')
                    ->required()
                    ->numeric(),
            ]);
    }

    // تعريف جدول فئات الكروت
    public static function table(Table $table): Table
    {
        return $table
            ->headerActions([
                // ✅ زر PDF
                static::getAutoPdfAction(),
            ])
            ->columns([
                // العمود: ID
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                // العمود: السعر
                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                // العمود: عدد الكروت المرتبطة بالفئة
                Tables\Columns\TextColumn::make('cards_count')
                    ->counts('cards')
                    ->label('عدد الكروت')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->actions([
                // زر توليد الكروت
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
                                'card_number' => str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT),
                                'used' => false,
                                'card_category_id' => $record->id,
                            ]);
                        }
                    }),
            ])
            ->filters([
                // يمكن إضافة فلتر لاحقًا إذا أردت
            ])
            ->bulkActions([
                // يمكن إضافة حذف جماعي أو غيره لاحقًا
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
            'index' => Pages\ListCardCategories::route('/'),
            'create' => Pages\CreateCardCategory::route('/create'),
            'edit' => Pages\EditCardCategory::route('/{record}/edit'),
        ];
    }
}
