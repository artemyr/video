<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use App\Rules\SizeRule;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Support\ValueObjects\Size;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('active')
                    ->default(true)
                    ->required(),
                TextInput::make('title'),
                TextInput::make('sort')
                    ->required()
                    ->numeric()
                    ->default(500),
                TextInput::make('size')
                    ->rules([new SizeRule()])
                    ->afterStateHydrated(function ($component, $state) {
                        if ($state instanceof Size) {
                            $component->state($state->row());
                        }
                    })
                    ->dehydrateStateUsing(function ($state, $component) {
                        return new Size($state);
                    }),
                FileUpload::make('image')
                    ->disk('images')
                    ->directory('portfolio')
                    ->image()
                    ->required(),
                FileUpload::make('video')
                    ->disk('video')
                    ->directory('portfolio')
                    ->required(),
            ]);
    }
}
