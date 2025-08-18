<?php

namespace App\Filament\Resources\Reviews\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('active')
                    ->required(),
                TextInput::make('title'),
                TextInput::make('sort')
                    ->required()
                    ->numeric()
                    ->default(500),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('images')
                    ->directory('reviews')
                    ->image()
                    ->required(),
            ]);
    }
}
