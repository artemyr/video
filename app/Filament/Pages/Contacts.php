<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Support\Enums\SettingsEnum;
use BackedEnum;

class Contacts extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.contacts';

    public ?array $author = null;

    public function mount(): void
    {
        $s = Setting::query()
            ->where('code', SettingsEnum::CONTACTS_LOGO->value)
            ->first();

        $this->form->fill([
            'author' => [
                $s->value
            ],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                FileUpload::make('author')
                    ->required()
                ->disk('images')
                ->directory('contacts'),
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!empty($data['author'])) {
            Setting::query()->updateOrCreate([
                'code' => SettingsEnum::CONTACTS_LOGO->value
            ], [
                'value' => $data['author'],
            ]);
        }
    }
}
