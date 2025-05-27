<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class AdminSliderController
{
    public function page(): Application|Factory|View
    {
        return view('admin.main.slider');
    }

    public function handle(): RedirectResponse
    {
        return back();
    }
}
