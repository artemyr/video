<?php

namespace App\ViewModels;

use App\Models\Portfolio;
use Illuminate\Support\Collection;

class PortfolioViewModel extends AbstractPagesViewModel
{
    public function portfolios(): Collection
    {
        return Portfolio::query()
            ->sorted()
            ->filtered()
            ->get();
    }
}
