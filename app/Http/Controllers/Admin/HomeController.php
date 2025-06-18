<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\HomeRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Support\Enums\SettingsEnum;

class HomeController
{
    public function page()
    {
        $image = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if (!empty($s)) {
            $image = asset('storage/images/' . $s->value);
        }

        return view('admin.main.index', compact('image'));
    }

    public function handle(HomeRequest $request)
    {
        $storageImages = Storage::disk('images');

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if ($request->has('logo')) {
            if (!empty($s->value)) {
                if ($storageImages->exists($s->value)) {
                    $storageImages->delete($s->value);
                }
            }
        }

        $logoPath =$storageImages
            ->put('main/logo', $request->file('logo'));

        Setting::query()->updateOrCreate([
            'code' => SettingsEnum::MAIN_LOGO->value
        ],[
            'value' => $logoPath
        ]);

        return redirect(route('admin.main.index'));
    }
}
