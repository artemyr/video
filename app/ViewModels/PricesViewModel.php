<?php

namespace App\ViewModels;

use App\Models\Price;
use App\Models\Text;
use Illuminate\Support\Collection;
use Support\Enums\TextsEnum;

class PricesViewModel extends AbstractPagesViewModel
{
    public function prices(): Collection
    {
        return Price::query()
            ->sorted()
            ->filtered()
            ->get();
    }

    public function bottomText(): Text
    {
        return Text::query()
            ->where('code', TextsEnum::PRICES_BOTTOM_TEXT->value)
            ->first();
    }
}
