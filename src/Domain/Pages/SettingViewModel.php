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
                ->where('code', SettingsEnum::MAIN_AUTHOR->value)
                ->first();

            if (!empty($s)) {
                $author = 'storage/images/' . $s->value;
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

    public function contactText1OnContactsPage()
    {
        return Cache::rememberForever('setting_text_1_on_contact_page', function () {
            return Setting::query()
                ->where('code', SettingsEnum::CONTACT_TEXT_1->value)
                ->first();
        });
    }

    public function logoOnContactsPage()
    {
        return Cache::rememberForever('setting_logo_on_contact_page', function () {
            $author = '';

            $s = Setting::query()
                ->where('code', SettingsEnum::CONTACTS_LOGO->value)
                ->first();

            if (!empty($s)) {
                $author = 'storage/images/' . $s->value;
            }

            return $author;
        });
    }

    public function favicon()
    {
        return Cache::rememberForever('setting_favicon', function () {

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
        return Cache::rememberForever('setting_logo', function () {

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
