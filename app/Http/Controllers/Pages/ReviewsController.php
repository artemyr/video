<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\ViewModels\ReviewsViewModel;

class ReviewsController extends Controller
{
    public function page()
    {
        return (new ReviewsViewModel)->view('pages.reviews');
    }
}
