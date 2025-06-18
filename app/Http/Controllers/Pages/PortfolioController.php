<?php

namespace App\Http\Controllers\Pages;

use App\Models\Portfolio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PortfolioController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $portfolios = Portfolio::query()
            ->sorted()
            ->filtered()
            ->get();

        return view('pages.portfolio', compact('portfolios'));
    }
}
