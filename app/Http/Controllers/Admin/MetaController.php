<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class MetaController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $settings = Setting::query()
            ->orderBy('sort')
            ->get();

        return view('admin.main.meta', compact('settings'));
    }

//    public function handle(): View|Factory|Application|RedirectResponse
//    {
//
//    }
}
