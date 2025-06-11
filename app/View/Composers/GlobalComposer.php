<?php

namespace App\View\Composers;

use App\Models\Setting;
use App\Models\Text;
use Illuminate\View\View;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

class GlobalComposer
{
    public function compose(View $view): void
    {
        [$displayPhone, $phone] = $this->getPhone();
        [$title, $description] = $this->getMeta();

        $view->with('phone', $phone);
        $view->with('displayPhone', $displayPhone);
        $view->with('footerText', $this->getFooterText());
        $view->with('editMode', $this->getEditMode());
        $view->with('title', $title);
        $view->with('description', $description);
    }

    private function getPhone(): array
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

        return [$displayPhone, $phone];
    }

    private function getEditMode(): bool
    {
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

        return $editMode;
    }

    private function getMeta(): array
    {
        $routeName = request()->route()->getName();

        $title = Setting::query()
            ->where('code', 'title.' . $routeName)
            ->first();

        $description = Setting::query()
            ->where('code', 'description.' . $routeName)
            ->first();

        return [$title?->value, $description?->value];
    }

    private function getFooterText()
    {
        return Text::query()
            ->where('code', TextsEnum::MAIN_FOOTER_TEXT->value)
            ->first();
    }
}
