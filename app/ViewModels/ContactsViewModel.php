<?php

namespace App\ViewModels;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Support\Enums\SettingsEnum;

class ContactsViewModel extends AbstractPagesViewModel
{
    public function text1()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_text_1_on_contact_page', function () {
            return Setting::query()
                ->where('code', SettingsEnum::CONTACT_TEXT_1->value)
                ->first();
        });
    }

    public function author()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_logo_on_contact_page', function () {
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
}
