<?php

namespace App\ViewModels;

use App\Models\Setting;
use App\Models\Slider;
use App\Models\Text;
use Illuminate\Support\Facades\Cache;
use Support\Enums\SettingsEnum;
use Support\Enums\TextsEnum;

class HomePageViewModel extends AbstractPagesViewModel
{
    public function sliders()
    {
        return Cache::tags(Slider::getCacheTag())->rememberForever('slider_home_page', function () {
            return Slider::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }

    public function about()
    {
        return Cache::tags(Text::getCacheTag())->rememberForever('text_home_page', function () {
            return Text::query()
                ->where('code', TextsEnum::MAIN_ABOUT->value)
                ->first();
        });
    }

    public function author()
    {
        return Cache::tags(Setting::getCacheTag())->rememberForever('setting_home_page', function () {

            $author = '';

            $s = Setting::query()
                ->where('code', SettingsEnum::MAIN_AUTHOR->value)
                ->first();

            if (!empty($s)) {
                $author = 'storage/images/' . $s->value;
            }

            return $author;
        });
    }
}
