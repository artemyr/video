<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdminController
{
    public function page(): Application|Factory|View
    {
        $sliders = Slider::query()->limit(10)->get();

        return view('admin.index', compact('sliders'));
    }
}
