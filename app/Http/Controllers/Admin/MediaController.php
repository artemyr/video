<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class MediaController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $videos = Download::query()
            ->orderBy('id','desc')
            ->paginate(10);

        return view('admin.media', compact('videos'));
    }
}
