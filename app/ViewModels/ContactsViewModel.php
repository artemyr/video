<?php

namespace App\ViewModels;

use App\Models\Setting;
use Support\Enums\SettingsEnum;

class ContactsViewModel extends AbstractPagesViewModel
{
    public function text1(): Setting
    {
        return Setting::query()
            ->where('code', SettingsEnum::CONTACT_TEXT_1->value)
            ->first();
    }

    public function author(): string
    {
        $author = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::CONTACTS_LOGO->value)
            ->first();

        if (!empty($s)) {
            $author = 'storage/images/' . $s->value;
        }

        return $author;
    }
}
