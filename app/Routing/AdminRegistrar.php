<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::controller(AdminController::class)
                    ->group(function () {
                        Route::get('/admin', 'page')
                            ->name('admin.index');
                    });

                Route::controller(AdminSliderController::class)
                    ->group(function () {
                        Route::get('/admin/main/slider', 'page')
                            ->name('admin.main.slider');

                        Route::post('/admin/main/slider', 'handle')
                            ->name('admin.main.slider.handle');
                    });

            });
    }
}
