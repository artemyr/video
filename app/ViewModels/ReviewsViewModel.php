<?php

namespace App\ViewModels;

use App\Models\Review;
use Illuminate\Support\Collection;

class ReviewsViewModel extends AbstractPagesViewModel
{
    public function reviews(): Collection
    {
        return Review::query()
            ->sorted()
            ->filtered()
            ->get();
    }
}
