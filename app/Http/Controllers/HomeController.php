<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\BasePagesController;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Support\Enums\TextsEnum;

class HomeController extends BasePagesController
{
    public function __invoke(): Factory|View|Application
    {
        $sliders = Slider::query()
            ->sorted()
            ->get();

        $about = Text::query()
            ->where('code', TextsEnum::MAIN_ABOUT->value)
            ->first();

        return view('index', compact('sliders', 'about'));
    }
}
