<?php

namespace Domain\Pages;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Support\Traits\Makeable;

class ReviewsViewModel
{
    use Makeable;

    public function reviewsPage()
    {
        return Cache::rememberForever('reviews_on_reviews_page', function () {
            return Review::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
