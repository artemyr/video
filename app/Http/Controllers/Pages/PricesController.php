<?php

namespace App\Http\Controllers\Pages;

use Domain\Pages\PriceViewModel;
use Domain\Pages\TextViewModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class PricesController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $prices = PriceViewModel::make()
            ->pricesPage();

        $bottomText = TextViewModel::make()
            ->bottomTextOnPricePage();

        return view('pages.price', compact('prices', 'bottomText'));
    }
}
