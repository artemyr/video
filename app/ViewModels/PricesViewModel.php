<?php

namespace App\ViewModels;

use App\Models\Price;
use App\Models\Text;
use Illuminate\Support\Facades\Cache;
use Support\Enums\TextsEnum;

class PricesViewModel extends AbstractPagesViewModel
{
    public function prices()
    {
        return Cache::tags(Price::getCacheTag())->rememberForever('price_on_price_page', function () {
            return Price::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }

    public function bottomText()
    {
        return Cache::tags(Text::getCacheTag())->rememberForever('text_bottom_on_prices_page', function () {
            return Text::query()
                ->where('code', TextsEnum::PRICES_BOTTOM_TEXT->value)
                ->first();
        });
    }
}
