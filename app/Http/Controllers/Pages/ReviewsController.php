<?php

namespace App\Http\Controllers\Pages;

use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ReviewsController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $reviews = Review::query()
            ->orderBy('sort')
            ->get();

        return view('pages.reviews', compact('reviews'));
    }
}
