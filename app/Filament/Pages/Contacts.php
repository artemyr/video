<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Support\Enums\SettingsEnum;

class Contacts extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.contacts';

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

    public function form(Form $form): Form
    {
        return $form
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
