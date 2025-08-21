<?php

namespace App\ViewModels;

use App\Models\Setting;
use App\Models\Text;
use Spatie\ViewModels\ViewModel;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

abstract class AbstractPagesViewModel extends ViewModel
{
    protected string $routeName;

    public function __construct()
    {
        $routeName = request()->route()->getName();
        $this->routeName = $routeName;
    }

    public function displayPhone(): ?Setting
    {
        return Setting::query()
            ->where('code', SettingsEnum::MAIN_PHONE->value)
            ->first();
    }

    public function phone(): string
    {
        $displayPhone = $this->displayPhone();

        $phone = '';
        if (!empty($displayPhone)) {
            $phone = preg_replace('/[^0-9]/', '', $displayPhone->value);
            if (str_starts_with($phone, '8')) {
                $phone = '+7' . substr($phone, 1, strlen($phone));
            }
        }

        return $phone;
    }

    public function title(): ?Setting
    {
        return Setting::query()
            ->where('code', 'title.' . $this->routeName)
            ->first();
    }

    public function description(): ?Setting
    {
        return Setting::query()
            ->where('code', 'description.' . $this->routeName)
            ->first();
    }

    public function footerText(): ?Text
    {
        return Text::query()
            ->where('code', TextsEnum::MAIN_FOOTER_TEXT->value)
            ->first();
    }

    public function tg(): ?Setting
    {
        return Setting::query()
            ->where('code', SettingsEnum::MAIN_TG->value)
            ->first();
    }

    public function favicon(): string
    {
        $favicon = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_FAVICON->value)
            ->first();

        if (!empty($s)) {
            $favicon = 'storage/images/' . $s->value;
        }

        return $favicon;
    }

    public function logo(): string
    {
        $logo = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if (!empty($s)) {
            $logo = 'storage/images/' . $s->value;
        }

        return $logo;
    }

    public function showCaptcha(): bool
    {
        return $this->routeName === 'reviews.page';
    }
}
