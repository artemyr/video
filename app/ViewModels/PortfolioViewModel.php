<?php

namespace App\ViewModels;

use App\Models\Portfolio;
use Illuminate\Support\Facades\Cache;

class PortfolioViewModel extends AbstractPagesViewModel
{
    public function portfolios()
    {
        return Cache::tags(Portfolio::getCacheTag())->rememberForever('portfolio_on_portfolio_page', function () {
            return Portfolio::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
