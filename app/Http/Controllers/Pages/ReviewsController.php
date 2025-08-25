<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewCreateRequest;
use App\Models\Review;
use App\ViewModels\ReviewsFormViewModel;
use App\ViewModels\ReviewsViewModel;
use Illuminate\Support\Facades\Storage;

class ReviewsController extends Controller
{
    public function page()
    {
        return (new ReviewsViewModel())->view('pages.reviews');
    }

    public function form()
    {
        return (new ReviewsFormViewModel())->view('pages.reviews_form');
    }

    public function send(ReviewCreateRequest $request)
    {
        $path = '';

        if ($request->exists('image')) {
            $file = $request->file('image');
            $path = Storage::disk('images')
                ->put('reviews', $file);
        }

        $review = new Review();
        $review->title = $request->get('title');
        $review->description = $request->get('description');
        $review->image = $path;
        $review->active = false;
        $review->save();
        flash()->info('Сохранили ваш отзыв! Он появится здесь после прохождения модерации.');
        session()->put('disallowSendReview', now()->addDay());
        return redirect()->route('reviews.page');
    }
}
