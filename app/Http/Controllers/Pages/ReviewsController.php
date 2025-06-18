<?php

namespace App\Http\Controllers\Pages;

use App\Models\Review;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ReviewsController extends BasePagesController
{
    public function page(): View|Factory|Application|RedirectResponse
    {
        $reviews = Review::query()
            ->sorted()
            ->get();

        return view('pages.reviews', compact('reviews'));
    }
}
