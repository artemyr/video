<?php

namespace App\Routing\Pages;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class SliderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::controller(SliderController::class)
                    ->group(function () {
                        Route::get('/admin/main/slider', 'index')
                            ->name('admin.main.slider.index');

                        Route::delete('/admin/main/slider/{item}/destroy', 'destroy')
                            ->name('admin.main.slider.destroy');

                        Route::get('/admin/main/slider/create', 'pageCreate')
                            ->name('admin.main.slider.create.page');

                        Route::post('/admin/main/slider/create', 'create')
                            ->name('admin.main.slider.create');

                        Route::get('/admin/main/slider/{item}', 'detail')
                            ->name('admin.main.slider.detail');

                        Route::post('/admin/main/slider/{item}/update', 'update')
                            ->name('admin.main.slider.update');
                    });

            });
    }
}
