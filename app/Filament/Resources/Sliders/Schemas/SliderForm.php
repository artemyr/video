<?php

namespace App\Filament\Resources\Sliders\Schemas;

use App\Rules\SizeRule;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Support\ValueObjects\Size;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('active')
                    ->required(),
                TextInput::make('title')
                    ->required(),
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
                    ->directory('slider')
                    ->image()
                    ->required(),
                FileUpload::make('video')
                    ->disk('video')
                    ->directory('slider')
                    ->required(),
            ]);
    }
}
