<?php

namespace App\Http\Controllers\Pages;

use App\Models\Price;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PricesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $prices = Price::query()
            ->orderBy('sort')
            ->get();

        return view('pages.price', compact('prices'));
    }
}
