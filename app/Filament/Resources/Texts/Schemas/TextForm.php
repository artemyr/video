<?php

namespace App\Filament\Resources\Texts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TextForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                TextInput::make('sort')
                    ->required()
                    ->default('500'),
                TextInput::make('description'),
                Textarea::make('text')
                    ->required()
                    ->rows(20)
                    ->columnSpanFull(),
            ]);
    }
}
