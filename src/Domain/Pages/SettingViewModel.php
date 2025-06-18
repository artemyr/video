<?php

namespace Domain\Pages;

use App\Models\Setting;
use App\Models\Text;
use Illuminate\Support\Facades\Cache;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;
use Support\Traits\Makeable;

class SettingViewModel
{
    use Makeable;

    public function homePage()
    {
        return Cache::rememberForever('setting_home_page', function () {

            $author = '';

            $s = Setting::query()
                ->where('code', SettingsEnum::MAIN_LOGO->value)
                ->first();

            if (!empty($s)) {
                $author = asset('storage/images/' . $s->value);
            }

            return $author;
        });
    }

    public function phone()
    {
        return Cache::rememberForever('setting_phone', function () {
            return Setting::query()
                ->where('code', SettingsEnum::MAIN_PHONE->value)
                ->first();
        });
    }

    public function title(string $pageName)
    {
        return Cache::rememberForever('setting_title_' . $pageName, function () use ($pageName) {
            return Setting::query()
                ->where('code', 'title.' . $pageName)
                ->first();
        });
    }

    public function description(string $pageName)
    {
        return Cache::rememberForever('setting_description_' . $pageName, function () use ($pageName) {
            return Setting::query()
                ->where('code', 'description.' . $pageName)
                ->first();
        });
    }

    public function footerText()
    {
        return Cache::rememberForever('setting_footer_text', function () {
            return Text::query()
                ->where('code', TextsEnum::MAIN_FOOTER_TEXT->value)
                ->first();
        });
    }

    public function tg()
    {
        return Cache::rememberForever('setting_tg', function () {
            return Setting::query()
                ->where('code', SettingsEnum::MAIN_TG->value)
                ->first();
        });
    }
}
