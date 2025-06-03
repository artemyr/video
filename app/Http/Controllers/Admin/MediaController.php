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
        return view('admin.media.index');
    }

    public function handle(): View|Factory|Application|RedirectResponse
    {
        $videos = Download::query()
            ->orderBy('id','desc')
            ->paginate(10)
            ->withPath('/admin/media');

        return view('admin.media.list', compact('videos'));
    }
}
