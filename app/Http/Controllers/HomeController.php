<?php

namespace App\Http\Controllers;

use App\ViewModels\HomePageViewModel;

class HomeController extends Controller
{
    public function __invoke()
    {
        return (new HomePageViewModel())->view('index');
    }
}
