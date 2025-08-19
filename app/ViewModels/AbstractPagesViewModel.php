<?php

namespace App\ViewModels;

use App\Models\Setting;
use App\Models\Text;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

abstract class AbstractPagesViewModel extends ViewModel
{
    protected string $routeName;

    public function __construct()
    {
        $routeName = request()->route()?->getName();

        if (empty($routeName) || str($routeName)->startsWith('admin')) {
            return;
        }

        $this->routeName = $routeName;
    }

    public function displayPhone()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_phone', function () {
            return Setting::query()
                ->where('code', SettingsEnum::MAIN_PHONE->value)
                ->first() ?? false;
        });
    }

    public function phone()
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

    public function title()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_title_' . $this->routeName, function () {
            return Setting::query()
                ->where('code', 'title.' . $this->routeName)
                ->first() ?? false;
        });
    }

    public function description()
    {
        return Cache::tags(Setting::getCacheTag())
            ->rememberForever('setting_description_' . $this->routeName, function () {
                return Setting::query()
                    ->where('code', 'description.' . $this->routeName)
                    ->first() ?? false;
            });
    }

    public function footerText()
    {
        return Cache::tags(Text::getCacheTag())->rememberForever('setting_footer_text', function () {
            return Text::query()
                ->where('code', TextsEnum::MAIN_FOOTER_TEXT->value)
                ->first() ?? false;
        });
    }

    public function tg()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_tg', function () {
            return Setting::query()
                ->where('code', SettingsEnum::MAIN_TG->value)
                ->first() ?? false;
        });
    }

    public function favicon()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_favicon', function () {

            $favicon = '';

            $s = Setting::query()
                ->where('code', SettingsEnum::MAIN_FAVICON->value)
                ->first();

            if (!empty($s)) {
                $favicon = 'storage/images/' . $s->value;
            }

            return $favicon;
        });
    }

    public function logo()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_logo', function () {

            $logo = '';

            $s = Setting::query()
                ->where('code', SettingsEnum::MAIN_LOGO->value)
                ->first();

            if (!empty($s)) {
                $logo = 'storage/images/' . $s->value;
            }

            return $logo;
        });
    }
}
