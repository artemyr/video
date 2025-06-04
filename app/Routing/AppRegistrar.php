<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\PricesController;
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

                Route::get('/portfolio', fn () => view('pages.portfolio'))
                    ->name('portfolio.page');
                Route::get('/price', [PricesController::class, 'page'])
                    ->name('price.page');
                Route::get('/reviews', fn () => view('pages.reviews'))
                    ->name('reviews.page');
                Route::get('/contacts', fn () => view('pages.contacts'))
                    ->name('contacts.page');

                Route::resource('/admin/download', DownloadController::class)
                    ->only(['store','update','destroy'])
                    ->name('destroy', 'admin.download.destroy');
            });

        Route::get('/thumbnail/{dir}/{method}/{size}/{file}', ThumbnailController::class)
            ->name('thumbnail');
    }
}
