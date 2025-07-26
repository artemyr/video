<?php

namespace Domain\Pages;

use App\Models\Text;
use Illuminate\Support\Facades\Cache;
use Support\Enums\TextsEnum;
use Support\Traits\Makeable;

class TextViewModel
{
    use Makeable;

    public function homePage()
    {
        return Cache::tags(Text::getCacheTag())->rememberForever('text_home_page', function () {
            return Text::query()
                ->where('code', TextsEnum::MAIN_ABOUT->value)
                ->first();
        });
    }

    public function bottomTextOnPricePage()
    {
        return Cache::tags(Text::getCacheTag())->rememberForever('text_bottom_on_prices_page', function () {
            return Text::query()
                ->where('code', TextsEnum::PRICES_BOTTOM_TEXT->value)
                ->first();
        });
    }
}
