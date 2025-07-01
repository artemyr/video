<?php

namespace App\Http\Controllers\Pages;

use Domain\Pages\SettingViewModel;

abstract class BasePagesController
{
    public function __construct()
    {
        $this->initGlobalVars();
    }

    private function initGlobalVars(): void
    {
        foreach ($this->getGlobalVars() as $name => $value) {
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
            'favicon' => $this->getFavicon(),
            'logo' => $this->getLogo()
        ];
    }

    private function getPhone(): array
    {
        $displayPhone = SettingViewModel::make()
            ->phone();

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

        $title = SettingViewModel::make()
            ->title($routeName);

        $description = SettingViewModel::make()
            ->description($routeName);

        return [$title?->value, $description?->value];
    }

    private function getFooterText()
    {
        return SettingViewModel::make()
            ->footerText();
    }

    private function getTg()
    {
        return SettingViewModel::make()
            ->tg();
    }

    private function getFavicon()
    {
        return SettingViewModel::make()
            ->favicon();
    }

    private function getLogo()
    {
        return SettingViewModel::make()
            ->logo();
    }
}
