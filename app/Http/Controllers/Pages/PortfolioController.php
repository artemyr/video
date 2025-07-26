<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\ViewModels\PortfolioViewModel;

class PortfolioController extends Controller
{
    public function page()
    {
        return (new PortfolioViewModel())->view('pages.portfolio');
    }
}
