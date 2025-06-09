<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class TextController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $texts = Text::query()
            ->orderBy('sort')
            ->get();

        return view('admin.text.index', compact('texts'));
    }

//    public function handle(): View|Factory|Application|RedirectResponse
//    {
//
//    }
}
