<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\SliderController;
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

                Route::get('/admin/meta', [MetaController::class, 'page'])
                    ->name('admin.main.meta');

                Route::get('/admin/media', [MediaController::class, 'page'])
                    ->name('admin.media');

                Route::controller(TextController::class)
                    ->group(function () {
                        Route::get('/admin/text/add', 'pageCreate')
                            ->name('admin.text.create');

                        Route::post('/admin/text/{text}/update', 'update')
                            ->name('admin.text.update');

                        Route::get('/admin/text/{id}/detail', 'detail')
                            ->name('admin.text.detail');

                        Route::delete('/admin/text/{text}/destroy', 'destroy')
                            ->name('admin.text.destroy');

                        Route::get('/admin/text/index', 'page')
                            ->name('admin.text.index');
                    });

                Route::controller(MediaController::class)
                    ->group(function () {
                        Route::get('/admin/media', 'page')->name('admin.media.index');
                        Route::get('/admin/media/list', 'handle')->name('admin.media.list');
                    });

                Route::controller(SliderController::class)
                    ->group(function () {
                        Route::get('/admin/main/slider', 'page')
                            ->name('admin.main.slider');

                        Route::post('/admin/main/slider', 'handle')
                            ->name('admin.main.slider.handle');
                    });

            });
    }
}
