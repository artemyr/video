<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    public function __invoke(): Factory|View|Application
    {
        $sliders = Slider::query()->limit(10)->get();

        $about = Text::query()->where('code', 'main.about')->first()->text;

        return view('index', compact('sliders', 'about'));
    }
}
