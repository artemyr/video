<?php

namespace App\Http\Controllers\Pages;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\Enums\SettingsEnum;

class ContactsController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $text1 = Setting::query()
            ->where('code', SettingsEnum::CONTACT_TEXT_1->value)
            ->first();

        $displayPhone = Setting::query()
            ->where('code', SettingsEnum::MAIN_PHONE->value)
            ->first();

        $phone = '';
        if (!empty($displayPhone)) {
            $phone = preg_replace('/[^0-9]/', '', $displayPhone->value);
            if (substr($phone, 0, 1) === '8') {
                $phone = '+7' . substr($phone, 1, strlen($phone));
            }
        }

        return view('pages.contacts', compact('text1', 'displayPhone', 'phone'));
    }
}
