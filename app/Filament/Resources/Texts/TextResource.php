<?php

namespace App\Filament\Resources\Texts;

use App\Filament\Resources\Texts\Pages\CreateText;
use App\Filament\Resources\Texts\Pages\EditText;
use App\Filament\Resources\Texts\Pages\ListTexts;
use App\Filament\Resources\Texts\Schemas\TextForm;
use App\Filament\Resources\Texts\Tables\TextsTable;
use App\Models\Text;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TextResource extends Resource
{
    protected static ?string $model = Text::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return TextForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TextsTable::configure($table);
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
            'index' => ListTexts::route('/'),
            'create' => CreateText::route('/create'),
            'edit' => EditText::route('/{record}/edit'),
        ];
    }
}
