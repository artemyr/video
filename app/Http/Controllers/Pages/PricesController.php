<?php

namespace App\Http\Controllers\Pages;

use App\Models\Price;
use App\Models\Text;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Support\Enums\TextsEnum;

class PricesController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $prices = Price::query()
            ->orderBy('sort')
            ->get();

        $bottomText = Text::query()
            ->where('code', TextsEnum::PRICES_BOTTOM_TEXT->value)
            ->first();

        return view('pages.price', compact('prices', 'bottomText'));
    }
}
