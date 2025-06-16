<?php

namespace App\Http\Controllers\Pages;

use App\Models\Setting;
use App\Models\Text;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

abstract class BasePagesController
{
    public function __construct()
    {
        $this->initGlobalVars();
    }

    private function initGlobalVars(): void
    {
        foreach( $this->getGlobalVars() as $name => $value ) {
            view()->share($name, $value);
        }
    }

    private function getGlobalVars(): array
    {
        [$displayPhone, $phone] = $this->getPhone();
        [$title, $description] = $this->getMeta();

        return [
            'phone' => $phone,
            'displayPhone' => $displayPhone,
            'footerText' => $this->getFooterText(),
            'title' => $title,
            'description' => $description,
            'tg' => $this->getTg(),
            'editMode' => $this->getEditMode()
        ];
    }

    private function getEditMode()
    {
        $editMode = false;
        $session = session();
        if (request('edit') === 'y' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', true);
        }
        if (request('edit') === 'n' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', false);
        }
        if (auth()->id() > 0 && auth()->user()->role === 'admin' && $session->get('editMode') === true) {
            $editMode = true;
        }
        return $editMode;
    }

    private function getPhone(): array
    {
        $displayPhone = Setting::query()
            ->where('code', SettingsEnum::MAIN_PHONE->value)
            ->first();

        $phone = '';
        if (!empty($displayPhone)) {
            $phone = preg_replace('/[^0-9]/', '', $displayPhone->value);
            if (str_starts_with($phone, '8')) {
                $phone = '+7' . substr($phone, 1, strlen($phone));
            }
        }

        return [$displayPhone, $phone];
    }

    private function getMeta(): array
    {
        $routeName = request()->route()?->getName();

        if (empty($routeName) || str($routeName)->startsWith('admin')) {
            return [null, null];
        }

        $title = Setting::query()
            ->where('code', 'title.' . $routeName)
            ->first();

        $description = Setting::query()
            ->where('code', 'description.' . $routeName)
            ->first();

        return [$title?->value, $description?->value];
    }

    private function getFooterText()
    {
        return Text::query()
            ->where('code', TextsEnum::MAIN_FOOTER_TEXT->value)
            ->first();
    }

    private function getTg()
    {
        return Setting::query()
            ->where('code', SettingsEnum::MAIN_TG->value)
            ->first();
    }
}
