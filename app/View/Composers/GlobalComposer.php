<?php

namespace App\View\Composers;

use App\Menu\Menu;
use App\Menu\MenuItem;
use App\Models\Setting;
use Illuminate\Contracts\Session\Session;
use Illuminate\View\View;
use Support\Enums\SettingsEnum;

class GlobalComposer
{
    public function compose(View $view): void
    {
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

        $editMode = false;
        $session = session();
        if (request('edit') === 'y' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', true);
        }
        if (request('edit') === 'n' && auth()->id() > 0 && auth()->user()->role === 'admin') {
            $session->put('editMode', false);
        }
        if (auth()->id() > 0 && auth()->user()->role === 'admin' && $session->get('editMode') === true) {
            $editMode = true;
        }

        $view->with('phone', $phone);
        $view->with('displayPhone', $displayPhone);
        $view->with('editMode', $editMode);
    }
}
