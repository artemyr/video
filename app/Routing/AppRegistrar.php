<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Pages\PortfolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\ContactsController;
use App\Http\Controllers\Pages\PricesController;
use App\Http\Controllers\Pages\ReviewsController;
use App\Http\Middleware\EditModeMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', EditModeMiddleware::class])
            ->group(function () {
                Route::get('/', HomeController::class)
                    ->name('home');
                Route::get('/portfolio', [PortfolioController::class, 'page'])
                    ->name('portfolio.page');
                Route::get('/price', [PricesController::class, 'page'])
                    ->name('price.page');
                Route::get('/reviews', [ReviewsController::class, 'page'])
                    ->name('reviews.page');
                Route::get('/contacts', [ContactsController::class, 'page'])
                    ->name('contacts.page');
            });
    }
}
