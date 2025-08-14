<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Support\Enums\SettingsEnum;

class Home extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.main';

    public ?array $author = null;
    public ?array $logo = null;
    public ?array $favicon = null;
    public ?string $robots = null;

    public function mount(): void
    {
        $author = Setting::query()
            ->where('code', SettingsEnum::MAIN_AUTHOR->value)
            ->first();

        $logo = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        $favicon = Setting::query()
            ->where('code', SettingsEnum::MAIN_FAVICON->value)
            ->first();

        $robots = '';

        $robotsFile = public_path('robots.txt');
        if (file_exists($robotsFile)) {
            $robots = file_get_contents($robotsFile);
        }

        $this->form->fill([
            'author' => [
                $author->value
            ],
            'logo' => [
                $logo->value
            ],
            'favicon' => [
                $favicon->value
            ],
            'robots' => $robots
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('author')
                    ->required()
                    ->disk('images')
                    ->directory('main'),
                FileUpload::make('logo')
                    ->required()
                    ->disk('images')
                    ->directory('main'),
                FileUpload::make('favicon')
                    ->required()
                    ->disk('images')
                    ->directory('main'),
                Textarea::make('robots')
                    ->rows(20)
            ]);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        if (!empty($data['author'])) {
            Setting::query()->updateOrCreate([
                'code' => SettingsEnum::MAIN_AUTHOR->value
            ], [
                'value' => $data['author'],
            ]);
        }

        if (!empty($data['logo'])) {
            Setting::query()->updateOrCreate([
                'code' => SettingsEnum::MAIN_LOGO->value
            ], [
                'value' => $data['logo'],
            ]);
        }

        if (!empty($data['favicon'])) {
            Setting::query()->updateOrCreate([
                'code' => SettingsEnum::MAIN_FAVICON->value
            ], [
                'value' => $data['favicon'],
            ]);
        }

        $robotsFile = public_path('robots.txt');
        file_put_contents($robotsFile, $data['robots']);
    }
}
