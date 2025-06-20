<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class PriceRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::controller(PriceController::class)
                    ->group(function () {
                        Route::get('/admin/price', 'index')
                            ->name('admin.price.index');

                        Route::delete('/admin/price/{item}/destroy', 'destroy')
                            ->name('admin.price.destroy');

                        Route::get('/admin/price/create', 'pageCreate')
                            ->name('admin.price.create.page');

                        Route::post('/admin/price/create', 'create')
                            ->name('admin.price.create');

                        Route::get('/admin/price/{item}', 'detail')
                            ->name('admin.price.detail');

                        Route::post('/admin/price/{item}/update', 'update')
                            ->name('admin.price.update');
                    });

            });
    }
}
