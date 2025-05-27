<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSliderController
{
    public function page(): Application|Factory|View
    {
        return view('admin.main.slider');
    }

    public function handle(Request $request): RedirectResponse
    {
        $videoPath = Storage::disk('video')
            ->put('slider', $request->file('video'));

        $photoPath = Storage::disk('images')
            ->put('slider', $request->file('photo'));

        Slider::create([
            'title' => $request->get('title'),
            'video' => $videoPath,
            'photo' => $photoPath,
        ]);

        return redirect('admin');
    }
}
