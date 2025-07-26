<?php

namespace Domain\Pages;

use App\Models\Slider;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class SliderViewModel
{
    use Makeable;

    public function homePage()
    {
        return Cache::tags(Slider::getCacheTag())->rememberForever('slider_home_page', function () {
            return Slider::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
