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
                    ->default(request('code'))
                    ->required(),
                TextInput::make('sort')
                    ->required()
                    ->default('500'),
                TextInput::make('description'),
                Textarea::make('text')
                    ->helperText("<p>...</p> - параграф; text-xl - большой текст; mb-[18px] - отступ снизу 18 пикселей; my-[14px] - отступ по горизонтали 14 пикселей")
                    ->required()
                    ->rows(20)
                    ->columnSpanFull(),
            ]);
    }
}
