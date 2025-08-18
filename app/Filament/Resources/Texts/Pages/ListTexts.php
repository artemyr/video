<?php

namespace App\Filament\Resources\Texts\Pages;

use App\Filament\Resources\Texts\TextResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTexts extends ListRecords
{
    protected static string $resource = TextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
