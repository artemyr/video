<?php

namespace App\Filament\Resources\Prices\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PriceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('active')
                    ->default(true)
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('sort')
                    ->required()
                    ->numeric()
                    ->default(500),
                RichEditor::make('description')
                    ->columnSpanFull(),
            ]);
    }
}
