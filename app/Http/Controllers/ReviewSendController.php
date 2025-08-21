<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewCreateRequest;

class ReviewSendController extends Controller
{
    public function handle(ReviewCreateRequest $request)
    {
        dd($request->toArray());
    }
}
