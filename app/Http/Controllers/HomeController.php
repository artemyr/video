<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pages\BasePagesController;
use Domain\Pages\SettingViewModel;
use Domain\Pages\SliderViewModel;
use Domain\Pages\TextViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class HomeController extends BasePagesController
{
    public function __invoke(): Factory|View|Application
    {
        $sliders = SliderViewModel::make()
            ->homePage();

        $about = TextViewModel::make()
            ->homePage();

        $author = SettingViewModel::make()
            ->homePage();

        return view('index', compact('sliders', 'about', 'author'));
    }
}
