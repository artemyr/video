<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Pages\PortfolioController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\ContactsController;
use App\Http\Controllers\Pages\PricesController;
use App\Http\Controllers\Pages\ReviewsController;
use App\Http\Controllers\ThumbnailController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AppRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware('web')
            ->group(function() {
                Route::get('/', HomeController::class)->name('home');

                Route::get('/portfolio', [PortfolioController::class, 'page'])
                    ->name('portfolio.page');
                Route::get('/price', [PricesController::class, 'page'])
                    ->name('price.page');
                Route::get('/reviews', [ReviewsController::class, 'page'])
                    ->name('reviews.page');
                Route::get('/contacts', [ContactsController::class, 'page'])
                    ->name('contacts.page');

                Route::resource('/admin/download', DownloadController::class)
                    ->only(['store','update','destroy'])
                    ->name('destroy', 'admin.download.destroy');
            });

        Route::get('/thumbnail/{dir}/{method}/{size}/{file}', ThumbnailController::class)
            ->name('thumbnail');
    }
}
