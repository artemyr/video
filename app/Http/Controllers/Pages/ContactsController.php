<?php

namespace App\Http\Controllers\Pages;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\Enums\SettingsEnum;

class ContactsController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $text1 = Setting::query()
            ->where('code', SettingsEnum::CONTACT_TEXT_1->value)
            ->first();

        $author = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if (!empty($s)) {
            $author = asset('storage/images/' . $s->value);
        }

        return view('pages.contacts', compact('text1', 'author'));
    }
}
