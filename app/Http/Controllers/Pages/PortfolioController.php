<?php

namespace App\Http\Controllers\Pages;

use Domain\Pages\PortfolioViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $portfolios = PortfolioViewModel::make()
            ->portfolioPage();

        return view('pages.portfolio', compact('portfolios'));
    }
}
