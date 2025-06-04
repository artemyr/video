<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\TextController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

class AdminRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['web', AdminMiddleware::class])
            ->group(function() {

                Route::get('/admin', function () {
                    return view('admin.index');
                })->name('admin.index');

                Route::get('/admin/main', function() {
                    return view('admin.main.index');
                })->name('admin.main');

                Route::get('/admin/media', [MediaController::class, 'page'])->name('admin.media');
                Route::get('/admin/text', [TextController::class, 'page'])->name('admin.text');

                Route::controller(MediaController::class)
                    ->group(function () {
                        Route::get('/admin/media', 'page')->name('admin.media.index');
                        Route::get('/admin/media/list', 'handle')->name('admin.media.list');
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
