<?php

namespace App\ViewModels;

use App\Models\Setting;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Support\Collection;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

class HomePageViewModel extends AbstractPagesViewModel
{
    public function sliders(): Collection
    {
        return Slider::query()
            ->sorted()
            ->filtered()
            ->get();
    }

    public function about(): Text
    {
        return Text::query()
            ->where('code', TextsEnum::MAIN_ABOUT->value)
            ->first();
    }

    public function author(): string
    {
        $author = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_AUTHOR->value)
            ->first();

        if (!empty($s)) {
            $author = 'storage/images/' . $s->value;
        }

        return $author;
    }
}
