<?php

namespace Domain\Pages;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class PortfolioViewModel
{
    use Makeable;

    public function portfolioPage()
    {
        return Cache::tags(Portfolio::getCacheTag())->rememberForever('portfolio_on_portfolio_page', function () {
            return Portfolio::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
