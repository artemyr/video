<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\ViewModels\PricesViewModel;

class PricesController extends Controller
{
    public function page()
    {
        return (new PricesViewModel)->view('pages.price');
    }
}
