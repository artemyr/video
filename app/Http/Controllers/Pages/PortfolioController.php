<?php

namespace App\Http\Controllers\Pages;

use App\Models\Portfolio;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PortfolioController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $portfolios = Portfolio::query()
            ->orderBy('sort')
            ->get();

        return view('pages.portfolio', compact('portfolios'));
    }
}
