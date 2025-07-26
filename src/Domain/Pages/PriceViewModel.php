<?php

namespace Domain\Pages;

use App\Models\Price;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class PriceViewModel
{
    use Makeable;

    public function pricesPage()
    {
        return Cache::tags(Price::getCacheTag())->rememberForever('price_on_price_page', function () {
            return Price::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
