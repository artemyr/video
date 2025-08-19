<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SettingForm
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
                TextInput::make('value')
                    ->required(),
                TextInput::make('description'),
            ]);
    }
}
