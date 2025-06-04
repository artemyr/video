<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class TextController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        return view('admin.text.index');
    }

//    public function handle(): View|Factory|Application|RedirectResponse
//    {
//
//    }
}
