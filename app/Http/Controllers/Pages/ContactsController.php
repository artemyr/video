<?php

namespace App\Http\Controllers\Pages;

use Domain\Pages\SettingViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ContactsController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $text1 = SettingViewModel::make()
            ->contactText1OnContactsPage();

        $author = SettingViewModel::make()
            ->logoOnContactsPage();

        return view('pages.contacts', compact('text1', 'author'));
    }
}
