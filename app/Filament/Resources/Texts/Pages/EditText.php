<?php

namespace App\Filament\Resources\Texts\Pages;

use App\Filament\Resources\Texts\TextResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditText extends EditRecord
{
    protected static string $resource = TextResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
