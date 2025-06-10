<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

class HomeController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        $sliders = Slider::query()->orderBy('sort')->get();

        $about = Text::query()
            ->where('code', TextsEnum::MAIN_ABOUT->value)
            ->first();

        $displayPhone = Setting::query()
            ->where('code', SettingsEnum::MAIN_PHONE->value)
            ->first();

        return view('index', compact('sliders', 'about', 'displayPhone'));
    }
}
