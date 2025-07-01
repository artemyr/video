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
        $author = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_AUTHOR->value)
            ->first();

        if (!empty($s)) {
            $author = asset('storage/images/' . $s->value);
        }

        $logo = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_LOGO->value)
            ->first();

        if (!empty($s)) {
            $logo = asset('storage/images/' . $s->value);
        }

        $favicon = '';

        $s = Setting::query()
            ->where('code', SettingsEnum::MAIN_FAVICON->value)
            ->first();

        if (!empty($s)) {
            $favicon = asset('storage/images/' . $s->value);
        }

        $robots = '';

        $robotsFile = public_path('robots.txt');
        if (file_exists($robotsFile)) {
            $robots = file_get_contents($robotsFile);
        }

        return view('admin.main.index', compact('author', 'favicon', 'robots', 'logo'));
    }

    public function handle(HomeRequest $request)
    {
        $this->saveFileSetting($request, SettingsEnum::MAIN_LOGO->value, 'logo', 'logo');
        $this->saveFileSetting($request, SettingsEnum::MAIN_AUTHOR->value, 'author', 'author');
        $this->saveFileSetting($request, SettingsEnum::MAIN_FAVICON->value, 'favicon', 'favicon');

        if ($request->has('robots')) {
            $robotsFile = public_path('robots.txt');
            file_put_contents($robotsFile, $request->get('robots'));
        }

        return back();
    }

    private function saveFileSetting($request, string $code, string $name, string $path)
    {
        if (!$request->has($name)) {
            return;
        }

        $storageImages = Storage::disk('images');

        $s = Setting::query()
            ->where('code', $code)
            ->first();

        if (!empty($s->value)) {
            if ($storageImages->exists($s->value)) {
                $storageImages->delete($s->value);
            }
        }

        $logoPath = $storageImages
            ->put("main/$path", $request->file($name));

        Setting::query()->updateOrCreate([
            'code' => $code
        ], [
            'value' => $logoPath
        ]);
    }
}
