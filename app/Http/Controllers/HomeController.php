<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\BasePagesController;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

class HomeController extends BasePagesController
{
    public function __invoke(): Factory|View|Application
    {
        $sliders = Slider::query()
            ->sorted()
            ->filtered()
            ->get();

        $about = Text::query()
            ->where('code', TextsEnum::MAIN_ABOUT->value)
            ->first();

        $author = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if (!empty($s)) {
            $author = asset('storage/images/' . $s->value);
        }

        return view('index', compact('sliders', 'about', 'author'));
    }
}
