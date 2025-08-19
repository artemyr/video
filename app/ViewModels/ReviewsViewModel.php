<?php

namespace App\ViewModels;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;

class ReviewsViewModel extends AbstractPagesViewModel
{
    public function reviews()
    {
        return Cache::tags(Review::getCacheTag())->rememberForever('reviews_on_reviews_page', function () {
            return Review::query()
                ->sorted()
                ->filtered()
                ->get();
        });
    }
}
