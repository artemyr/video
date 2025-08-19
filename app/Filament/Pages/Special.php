<?php

namespace App\Filament\Pages;

use App\Models\Portfolio;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Slider;
use Carbon\Carbon;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Support\Enums\SettingsEnum;

class Special extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.special';

    public int $countUnusedFiles = 0;
    public array $unusedFiles = [];
    public Carbon $date;
    public array $resizes = [];
    public float $videoSize = 0;
    public int $resizesCount = 0;

    public function mount(): void
    {
        $this->getResult();
    }

    private function getResult(): void
    {
        [
            'unusedFiles' => $this->unusedFiles,
            'countUnusedFiles' => $this->countUnusedFiles,
            'date' => $this->date,
            'resizes' => $this->resizes,
            'videoSize' => $this->videoSize,
            'resizesCount' => $this->resizesCount,
        ] = Cache::rememberForever('system_unused_files_data', function () {
            return $this->getData();
        });
    }

    public function reload(): void
    {
        Cache::forget('system_unused_files_data');
        $this->getResult();
    }

    public function clearResizes(): void
    {
        foreach (Storage::disk('images')->allFiles() as $file) {
            if (str_contains($file, '/resize/')) {
                Storage::disk('images')->delete($file);
            }
        }
        Cache::forget('system_unused_files_data');
        $this->getResult();
    }

    private function getData(): array
    {
        $usedFiles = [];
        $unusedFiles = [];
        $resizes = [];
        $videoSize = 0;
        $resizesCount = 0;

        Slider::query()
            ->select(['id', 'image', 'video'])
            ->get()
            ->map(function ($item) use (&$usedFiles) {
                $usedFiles[] = $item->image;
                $usedFiles[] = $item->video;
            });

        Portfolio::query()
            ->select(['id', 'image', 'video'])
            ->get()->map(function ($item) use (&$usedFiles) {
                $usedFiles[] = $item->image;
                $usedFiles[] = $item->video;
            });

        Review::query()->select(['id', 'image'])
            ->get()
            ->map(function ($item) use (&$usedFiles) {
                $usedFiles[] = $item->image;
            });

        tap(
            Setting::query()
                ->where('code', SettingsEnum::CONTACTS_LOGO->value)
                ->first(),
            function ($model) use (&$usedFiles) {
                $usedFiles[] = $model->value;
            }
        );
        tap(
            Setting::query()
                ->where('code', SettingsEnum::MAIN_AUTHOR->value)
                ->first(),
            function ($model) use (&$usedFiles) {
                $usedFiles[] = $model->value;
            }
        );
        tap(
            Setting::query()
                ->where('code', SettingsEnum::MAIN_LOGO->value)
                ->first(),
            function ($model) use (&$usedFiles) {
                $usedFiles[] = $model->value;
            }
        );
        tap(
            Setting::query()
                ->where('code', SettingsEnum::MAIN_FAVICON->value)
                ->first(),
            function ($model) use (&$usedFiles) {
                $usedFiles[] = $model->value;
            }
        );

        $images = Storage::disk('images')
            ->allFiles();

        foreach ($images as $imagePath) {
            if (str_contains($imagePath, '/resize/')) {
                $resizes[] = $imagePath;
                continue;
            }
            if (!in_array($imagePath, $usedFiles)) {
                $unusedFiles[] = $imagePath;
            }
        }

        $videos = Storage::disk('video')
            ->allFiles();

        foreach ($videos as $videoPath) {
            if (Storage::disk('video')->exists($videoPath)) {
                $size = Storage::disk('video')->size($videoPath);
                $videoSize += $size / 1000 / 1000;
            }
            if (!in_array($videoPath, $usedFiles)) {
                $unusedFiles[] = $videoPath;
            }
        }

        $countUnusedFiles = count($unusedFiles);

        $date = now();

        $videoSize = number_format($videoSize, 2);

        $resizesCount = count($resizes);

        return compact('unusedFiles', 'countUnusedFiles', 'date', 'resizes', 'videoSize', 'resizesCount');
    }
}
